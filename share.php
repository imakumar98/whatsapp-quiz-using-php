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



?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        
        <?php require_once './includes/meta-tags.php'; ?>
        <script src="./js/app-url.js"></script>
        <script>

            document.addEventListener('DOMContentLoaded', (event) => {
                if(localStorage.user_id){
                    var url_to_share = APP_URL + '/quiz.php?uid=' + localStorage.user_id;
                    document.getElementById('copy-textarea').value = url_to_share;
                    var whatsapp_url = 'whatsapp://send?text='+'You got real friendship challenge, click URL to accept it' + url_to_share;
                    var messenger_url = 'fb-messenger://share/?link=' + url_to_share;
                    document.getElementById('whatsapp-button').href=whatsapp_url;
                    document.getElementById('messenger-button').href= messenger_url;
                }else{
                    window.location.href= APP_URL + '/index.php';
                }
            })
            
            



        </script>
        
        
    </head>
    <body>
        <?php require_once('./includes/header.php'); ?>

        <div id="question-wrapper">
            <div class="container">
                <div class="row" id="main-questions-wrapper">
                    <div class="question col-md-8 offset-md-2" id="question" >
                        <div class="text-center challenge-completed-div">
                            <h2>Your Challenge is Ready</h2>
                            <h5>Share this link with your friends</h5>
                            <textarea class="form-control" id="copy-textarea"></textarea>
                            <button class="btn" id="copy-btn" onclick="copyText()">COPY</button>
                            <br/>
                            <div class="social-media-buttons row" style="margin-top:20px;">
                                <div class="text-center container">
                                    <a id="whatsapp-button" target="_blank" class="social-media-button" style="background:#25D366"><i class="fab fa-whatsapp"></i>&nbsp;Share on Whatsapp</a>
                                    <a id="messenger-button" target="_blank" class="social-media-button" style="background:#0084FF; color:#FFF"><i class="fab fa-facebook-messenger"></i>&nbsp;Messenger</a>
                                    <br/><br/>
                                    
                                    <div class="addthis_inline_share_toolbox"></div>
            
                                </div>

                                
                                

                                
                               

                            </div>
                            <br/><br/>
                            <div class="previous-users-div">
                                <h5 class="text-center">Who knows you best ?</h5>
                                <table class="table table-bordered" id="previous-users-table">
                                    <thead>
                                        <th>Name</th>
                                        <th>Score</th>
                                    </thead>
                                    <tbody>
                                        
                                        
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
            
            $(document).ready(function(){

                $.ajax({
                    url:'./includes/process.php',
                    method:'POST',
                    data: 'stored_user_id=' + localStorage.user_id,
                    success: function(res){
                        $('#previous-users-table tbody').html(res);
                    }
                });

            });
            
        
        </script>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d23a1b3b814eede"></script>

    </body>
</html>