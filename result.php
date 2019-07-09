<?php
    require_once './includes/init.php';

    // if(!isset($_COOKIE['user_id']) && !isset($_COOKIE['name'])){
    //     redirect(APP_URL);
    // }else if(!isset($_COOKIE['name'])){
    //     redirect(APP_URL);
    // }else if(!isset($_COOKIE['user_id'])){
    //     redirect(APP_URL.'/start.php');
    // }

    // if(!$_COOKIE['name']){
    //     redirect(APP_URL);
    // }


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
        <?php require_once './includes/meta-tags.php'; ?>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

        <script src="./js/app-url.js"></script>
        <script>

            document.addEventListener('DOMContentLoaded', (event) => {
               
            if(!localStorage.score){
                var user_id = document.getElementById('main-questions-wrapper')[0].getAttribute('user-id');
                window.location.href= APP_URL + '/quiz.php?uid=' + user_id;
            }


            document.getElementById('score').textContent = localStorage.score;







            })
            
            



        </script>
        <style>

            .social-media-button{
                color:#FFF;
                text-decoration:none;
                padding:8px;
                border-radius: 3px;
                cursor:pointer;
                margin-right:15px;
            }

            .social-media-button:hover{
                text-decoration:none;
                color:#FFF;
            }


        </style>
        
    </head>
    <body>
        <?php require_once('./includes/header.php'); ?>

        <div id="question-wrapper">
            <div class="container">
                <div class="row" id="main-questions-wrapper" user-id="<?php echo $uid;  ?>">
                    <div class="question col-md-8 offset-md-2" id="question" >
                        <div class="text-center challenge-completed-div">
                            <h5>Score : <span id="score"></span>/<?php echo NUMBER_OF_QUESTIONS_TO_ASK ?></h5>
                            <a class="btn btn-block" id="copy-btn" href="index.php">Create Your Quiz</a>
                            <br/>
                            <div class="previous-users-div">
                                <h5 class="text-center">Who knows <?php echo get_username($uid); ?> best ?</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Name</th>
                                        <th>Score</th>
                                    </thead>
                                    <tbody>
                                        <?php get_previous_score($uid); ?>
                                        
                                    </tbody>
                                </table>
                            </div>
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
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
        <script>
            
         
            
        
        </script>
    </body>
</html>