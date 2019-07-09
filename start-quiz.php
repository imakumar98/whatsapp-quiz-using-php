<?php
    require_once './includes/init.php';

    if(!isset($_COOKIE['friend_name'])){
        redirect(APP_URL);
    }


    if(!isset($_GET['uid'])){
        die("Invalid URL");
    }else{
        $uid = escape_string($_GET['uid']); //WHO CREATED QUIZ

        if(!is_user_exist($uid)){
            die("User not exist");
        }
    }
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <?php require_once './includes/meta-tags.php'; ?>
        <script type="text/javascript" src="./js/app-url.js"></script>
        
    </head>
    <body>
        <?php require_once('./includes/header.php'); ?>

        <div id="question-wrapper">
            <div class="container">
                <div class="row" id="main-questions-wrapper" user-id="<?php echo $uid; ?>">
                    <?php get_user_quiz_questions($uid); ?>
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