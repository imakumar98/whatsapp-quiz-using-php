<?php
    require_once './includes/init.php';

    // if(!isset($_COOKIE['name'])){
    //     redirect(APP_URL);
    // }

    


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <?php require_once './includes/meta-tags.php'; ?>
        <script src="./js/app-url.js"></script>
        <script>
            
            if(localStorage.user_id){
                window.location.href= APP_URL + '/share.php';

            }
    
        </script>
        
    </head>
    <body>
        <?php require_once('./includes/header.php'); ?>

        <div id="question-wrapper">
            <div class="container">
                <div class="row" id="main-questions-wrapper">
                    <?php get_questions_list(); ?>
                    
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