<?php
	require_once 'config.php';
	$connect = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);


	if(!$connect){
		die("Database Connection Failed!!");
	}



?>