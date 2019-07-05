<?php 
    
    require_once './includes/init.php'; 

    if(!isset($_GET['uid'])){
        die("Invalid URL");
    }else{
        $uid = escape_string($_GET['uid']);

        if(!is_user_exist($uid)){
            die("User not exist");
        }
    }


    if(isset($_POST['submit'])){
        
        $name = escape_string($_POST['friend_name']);
        //echo $name;
        setcookie('friend_name', $name, time() + (86400 * 30));
        
        redirect(APP_URL.'/start.php?uid='.$uid);
    }



?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>2019 Friendship Dare</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <?php require_once('./includes/header.php'); ?>
        <div id="enter-form-wrapper">
        	<div class="container">
				<div class="row">
					<div class="form-box col-md-8 offset-md-2">
                        <div id="enter-form">
                            <form class="form" method='POST'>
                                <h4 class="text-center">2019 Friendship Dare</h4>
                                <h5 class="text-center">How well do you know <?php echo 'Username' ?> ?</h5>
                                <br/>
                                <p style="color:#50596c; font-size:20px;"><b>Enter Your Name : </b></p>
                                <input type="text" required class="form-control" name="friend_name" placeholder="Your name" value=""/>
                                
                                <br/>
                                <input type="submit" class="btn btn-block btn-primary" id="start-button" name="submit" value="START">
                            </form>
                            <br/>
                            <div class="previous-users-div">
                                <h5 class="text-center">Who knows Username best ?</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Name</th>
                                        <th>Score</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ashwani</td>
                                            <td>20</td>
                                        </tr>
                                        <tr>
                                            <td>Ashwani</td>
                                            <td>20</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="index.php" class="btn btn-block my-btn">Create Your Quiz</a>
                        </div>
						
                        
					</div>		
				</div>        		
        	</div>
			
        </div>
		<hr/>
        <footer>
        	<div class="text-center">
        		<a href="contact.php">CONTACT US</a>
        	</div>
        	
        </footer>
    </body>
</html>