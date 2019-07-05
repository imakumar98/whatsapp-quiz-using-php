<?php

	require_once 'functions.php';
	
	//CREATE QUIZ
	if(isset($_POST['create_quiz']) && isset($_POST['answers'])){
		$username = $_COOKIE['name'];
		$data = json_decode($_POST['answers']);


		$quiz_id = create_quiz($username, $data);

		

	}


	//FIND SCORE
	if(isset($_POST['find_score']) && isset($_POST['friend_answers'])){
		$friend_name = $_COOKIE['friend_name'];
		$data = json_decode($_POST['friend_answers']);

		$score = calculate_quiz_score($friend_name, $data);
	}




?>