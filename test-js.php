<!doctype html>
<html class="no-js" lang="">
    <head>

    	<style>

    		.room{
				
				width:100%;
				padding:100px;
				height:100px;
				background:#000;
				color:#FFF;
				margin-bottom:20px;

    		}

    		.student{
				width:100px;
				height:100px;
    			float:left;
    			background:#FFF;
    			color:#000;
    			margin-right:20px;
    		}

			.active-question{
				
				display:block;

			}


			.inactive-question{

				display:none;
			}

    	</style>
       
    </head>
    <body>	
	<div id="school">
    	<div class="room active-question" id="10">
    		<h1>ROOM 1</h1>
    		<div class="student" roll = "1">I am student 1</div>
    		<div class="student" roll = "2">I am student 2</div>
    		<div class="student" roll = "3">I am student 3</div>
    		<div class="student" roll = "4">I am student 4</div>
    	</div>

    	<div class="room inactive-question" id="20">
    		<h1>ROOM 2</h1>
    		<div class="student" roll = "1">I am student 1</div>
    		<div class="student" roll = "2">I am student 2</div>
    		<div class="student" roll = "3">I am student 3</div>
    		<div class="student" roll = "4">I am student 4</div>
    	</div>

    	<div class="room inactive-question" id="30">
    		<h1>ROOM 3</h1>
    		<div class="student" roll = "1">I am student 1</div>
    		<div class="student" roll = "2">I am student 2</div>
    		<div class="student" roll = "3">I am student 3</div>
    		<div class="student" roll = "4">I am student 4</div>
    	</div>
    </div>



        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        
        <script>
			
			$(document).ready(function(){

				var question_array = [10,20,30];

				var number_of_questions_answered = 0

				// for(var i = 0; i<question_array.length ;i++){

				// 	$('#'+question_array[i]).removeClass('inactive-question');
				// 	$('#'+question_array[i]).addClass('active-question');

				// }



				$('.student').each(function(){
						$(this).on('click',function(){
							var selectedStudent = $(this).attr('roll');
							console.log(selectedStudent);
							$(this).parent().addClass('inactive-question');
							$(this).parent().removeClass('active-question','none');
							number_of_questions_answered = number_of_questions_answered + 1;

							console.log("Number of question answered : ",number_of_questions_answered);

							$(this).parent().next().removeClass('inactive-question');
							$(this).parent().next().addClass('active-question');
							
						});
					});



			});

            
        </script>
       
    </body>
</html>