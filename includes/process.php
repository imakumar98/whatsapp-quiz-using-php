<?php

	require_once 'functions.php';
	session_start();

	if(isset($_POST['purpose']) && isset($_POST['qid']) && isset($_POST['ans'])){
		if($_POST['purpose']=='get_next_question'){





			$qid = $_POST['qid'];
			$ans = $_POST['ans'];

			if(isset($_SESSION['user_array'])){
				$_SESSION['user_array'][$qid] = $ans;
			}else{
				$user_array = array();
				$user_array[$qid] = $ans;
				$_SESSION['user_array'] = $user_array;

			}

			//CHECK QUESTIONS LENGTH
			$questions_length = count($_SESSION['user_array'])/2;
			if($questions_length==3){
				echo "Here I am showing you the result";
			}else{
				get_next_question();
			}

			
		}


	}


	if(isset($_POST['user_answers'])){

		//print_r($_POST['user_answers']);

		echo json_decode(json_encode($_POST['user_answers']), true);
	}




?>