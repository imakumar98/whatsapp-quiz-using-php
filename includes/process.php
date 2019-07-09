<?php

	require_once 'functions.php';
	
	//CREATE QUIZ
	if(isset($_POST['create_quiz']) && isset($_POST['answers'])){
		$username = $_COOKIE['name'];
		$data = json_decode($_POST['answers']);


		$quiz_id = create_quiz($username, $data);

		echo $quiz_id;
		
		

		

	}


	//FIND SCORE
	if(isset($_POST['find_score']) && isset($_POST['friend_answers'])){
		$friend_name = $_COOKIE['friend_name'];
		$data = json_decode($_POST['friend_answers']);
		$user_id = $_POST['user_id'];
		$score = calculate_quiz_score($friend_name, $data, $user_id);
		echo $score;
	}



	if(isset($_POST['stored_user_id'])){

		$user_id = $_POST['stored_user_id'];

		get_previous_score($user_id);

	}




?>