<?php 
    
    require_once './includes/init.php'; 

    if(isset($_POST['submit'])){
        
        $name = escape_string($_POST['name']);
        echo $name;
        setcookie('name', $name, time() + (86400 * 30));
        
        redirect(APP_URL.'/start.php');
    }else{
        $name = "";
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
					<div class="form-box col-md-6 offset-md-3">
						<form class="form" id="enter-form" method='POST'>
							<h4 class="text-center">2019 Friendship Dare</h4>
							<br/>
							<p style="color:#50596c; font-size:20px;"><b>Enter Your Name : </b></p>
							<input type="text"  class="form-control" name="name" placeholder="Your name" value=""/>
							
							<br/>
							<input type="submit" class="btn btn-block btn-primary" id="start-button" name="submit" value="START">
						</form>
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