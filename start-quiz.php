<?php
    require_once './includes/init.php';

    if(!isset($_COOKIE['friend_name'])){
        redirect(APP_URL);
    }


    if(!isset($_GET['uid'])){
        die("Invalid URL");
    }else{
        $uid = escape_string($_GET['uid']);

        if(!is_user_exist($uid)){
            die("User not exist");
        }
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
        <style>
            
            .active-question{
                display:block;

            }

            .inactive-question{
                display:none;
            }


        </style>
    </head>
    <body>
        <?php require_once('./includes/header.php'); ?>

        <div id="question-wrapper">
            <div class="container">
                <div class="row" id="main-questions-wrapper">
                    <?php get_user_quiz_questions($uid); ?>
                    <!-- <div class="question col-md-8 offset-md-2 inactive-question" id="question" >
                        <div class="text-center challenge-completed-div">
                            <h2>Your Challenge is Ready</h2>
                            <h5>Share this link with your friends</h5>
                            <textarea class="form-control" id="copy-textarea">https://sfdsdklffidhrlewrwe</textarea>
                            <button class="btn" id="copy-btn" onclick="copyText()">COPY</button>
                        </div>
                        
                    </div> -->
                </div>
            </div>
            
        </div>
		<hr/>
        <footer>
        	<div class="text-center">
        		<a href="contact.php">CONTACT US</a>
        	</div>
        	
        </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
    </body>
</html>