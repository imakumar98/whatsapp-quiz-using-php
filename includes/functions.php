<?php
	require_once 'connect.php';

	//FUNCTION TO ESCAPE STRING
	function escape_string($string){
		global $connect;
		return mysqli_real_escape_string($connect, $string);
	}

	//FUNCTION TO REDIRECT PAGE
	function redirect($url){
		header("Location: $url");
	}


	//FUNCTION TO RETURN HASH
	function get_hash($string){
		if(!$string){
			return "Please pass string ";
		}
		return sha1($string);
	}

	
	//FUNCTION TO GENERATE ARRAY OF QUESTION IDS
	function get_question_array($min_id, $max_id, $length){
		$id_array = array();
		$generated_id = rand($min_id, $max_id);
		for($i=0;$i<$length;$i++){
			while(in_array($generated_id, $id_array)){
				$generated_id = rand($min_id, $max_id);
			}
			$id_array[$i] = $generated_id;
		}
		return $id_array;
		

	}

	//FUNCTION TO GET QUESTIONS LIST
	function get_questions_list(){

		global $connect;

		$questions = get_question_array(MIN_QUESTION_ID, MAX_QUESTION_ID, NUMBER_OF_QUESTIONS_TO_ASK);

		for($i=0;$i< count($questions); $i++){

			$sql = "SELECT * FROM questions WHERE id = '$questions[$i]'";

			$result = mysqli_query($connect, $sql);

			$question = mysqli_fetch_array($result);

			?>
			<div class="question col-md-8 offset-md-2 inactive-question" id="question" qid="<?php echo $question['id'] ?>">
	            <div class="text-center">
	                <p>Question <span style="font-weight:bold; color:rgb(153, 0, 59) !important"><?php echo $i+1; ?></span> of <?php echo count($questions); ?></p>
	            </div>
	            <p class="text-center question-text"><?php echo $question['text'] ?></p>
	            <div class="options">
	                <div class="row">
	                    <div class="col-md-6 col-sm-6 col-xs-6">
	                        <div class="option" value="1">
	                            <div class="text-center">
	                                <img class="img-fluid rounded" src="./images/<?php echo $question['option1_pic'] ?>" alt="">    
	                                <p><?php echo $question['option1'] ?></p> 
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6 col-sm-6 col-xs-6">
	                        <div class="option" value="2">
	                            <div class="text-center">
	                                <img class="img-fluid rounded" src="./images/<?php echo $question['option2_pic'] ?>" alt="">    
	                                <p><?php echo $question['option2'] ?></p> 
	                            </div>
	                        </div>
	                    </div>
	                    <?php
	                    	if(!empty($question['option3'])){
	                    		?>
									<div class="col-md-6 col-sm-6 col-xs-6">
			                            <div class="option" value="3">
			                                <div class="text-center">
			                                    <img class="img-fluid rounded" src="./images/<?php echo $question['option3_pic'] ?>" alt="">    
			                                    <p><?php echo $question['option3'] ?></p> 
			                                </div>
			                            </div>
			                        </div>
	                    		<?php
	                    	}
	                    	if(!empty($question['option4'])){
	                    		?>
									<div class="col-md-6 col-sm-6 col-xs-6">
			                            <div class="option" value="3">
			                                <div class="text-center">
			                                    <img class="img-fluid rounded" src="./images/<?php echo $question['option4_pic'] ?>" alt="">    
			                                    <p><?php echo $question['option4'] ?></p> 
			                                </div>
			                            </div>
			                        </div>
	                    		<?php
	                    	}
	                    	if(!empty($question['option5'])){
	                    		?>
									<div class="col-md-6 col-sm-6 col-xs-6">
			                            <div class="option" value="3">
			                                <div class="text-center">
			                                    <img class="img-fluid rounded" src="./images/<?php echo $question['option5_pic'] ?>" alt="">    
			                                    <p><?php echo $question['option5']; ?></p> 
			                                </div>
			                            </div>
			                        </div>
	                    		<?php
	                    	}
	                    	if(!empty($question['option6'])){
	                    		?>
									<div class="col-md-6 col-sm-6 col-xs-6">
			                            <div class="option" value="3">
			                                <div class="text-center">
			                                    <img class="img-fluid rounded" src="./images/<?php echo $question['option6_pic'] ?>" alt="">    
			                                    <p><?php echo $question['option6']; ?></p> 
			                                </div>
			                            </div>
			                        </div>
	                    		<?php
	                    	}

						?>
	                </div>
	            </div>
	        </div>
			<?php

		}
	}


	//FUNCTION TO CREATE QUIZ
	function create_quiz($username, $answers){

		global $connect;

		$id_hash = sha1(time());
		
		$sql = "INSERT INTO users (name,id_hash) VALUES ('$username', '$id_hash')";

		$result = mysqli_query($connect,$sql);

		if($result){

			$id = mysqli_insert_id($connect);

			$i = 1;
			foreach ($answers as $question_id => $answer) {
				$question_column_name = 'q'.$i;
				$answer_column_name = 'ans'.$i;
				update_row('users', $question_column_name, $question_id, $id);
				update_row('users', $answer_column_name, $answer, $id);
				$i++;
			}
			return $id;

		}else{

			die('User creation failed');
		}

	}

	//FUNCTION TO CALCULATE QUIZ SCORE AFTER SAVING ANSWERS TO DB

	//FUNCTION TO UPDATE ROW
	function update_row($table_name, $column_name, $column_value, $id){
		global $connect;

		$sql = "UPDATE $table_name SET $column_name = '$column_value' WHERE id = '$id'";

		$result = mysqli_query($connect, $sql);

		if($result){
			return true;
		}else{
			die("Query failed");
		}
	}

	//FUNCTION TO CHECK IF USER EXIST
	function is_user_exist($id){
		global $connect;

		$sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";

		$result = mysqli_query($connect, $sql);

		if(mysqli_num_rows($result)==1){
			return true;
		}

		return false;
	}

	//FUNCTION TO GET PREVIOUS SCORES
	function get_previous_score($id){
		global $connect;

		$sql = "SELECT * FROM user_friends WHERE user_id = '$id'";

		$result = mysqli_query($connect, $sql);

		if(mysqli_num_rows($result)==0){
			?><tr>No user available yet</tr><?php
		}else{
			while($user = mysqli_fetch_array($result)){
				?>
					<tr>
	                    <td><?php echo $user['name']; ?></td>
	                    <td><?php echo get_friend_score($id); ?></td>
	                </tr>
			
				<?php
			}
		}
	}

	//FUNCTION TO GET FRIEND'S SCORE
	function get_friend_score($id){
		return 20;
	}

	//FUNCTION TO GET USER QUIZ QUESTIONS LIST
	function get_user_quiz_questions($id){

		global $connect;

		$questions = get_user_question_array($id);

		for($i=0;$i< count($questions); $i++){

			$sql = "SELECT * FROM questions WHERE id = '$questions[$i]'";

			$result = mysqli_query($connect, $sql);

			$question = mysqli_fetch_array($result);

			?>
			<div class="question col-md-8 offset-md-2 inactive-question" id="question" qid="<?php echo $question['id'] ?>">
	            <div class="text-center">
	                <p>Question <span style="font-weight:bold; color:rgb(153, 0, 59) !important"><?php echo $i+1; ?></span> of <?php echo count($questions); ?></p>
	            </div>
	            <p class="text-center question-text"><?php echo $question['text'] ?></p>
	            <div class="options">
	                <div class="row">
	                    <div class="col-md-6 col-sm-6 col-xs-6">
	                        <div class="option option2" value="1">
	                            <div class="text-center">
	                                <img class="img-fluid rounded" src="./images/<?php echo $question['option1_pic'] ?>" alt="">    
	                                <p><?php echo $question['option1'] ?></p> 
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6 col-sm-6 col-xs-6">
	                        <div class="option option2" value="2">
	                            <div class="text-center">
	                                <img class="img-fluid rounded" src="./images/<?php echo $question['option2_pic'] ?>" alt="">    
	                                <p><?php echo $question['option2'] ?></p> 
	                            </div>
	                        </div>
	                    </div>
	                    <?php
	                    	if(!empty($question['option3'])){
	                    		?>
									<div class="col-md-6 col-sm-6 col-xs-6">
			                            <div class="option option2" value="3">
			                                <div class="text-center">
			                                    <img class="img-fluid rounded" src="./images/<?php echo $question['option3_pic'] ?>" alt="">    
			                                    <p><?php echo $question['option3'] ?></p> 
			                                </div>
			                            </div>
			                        </div>
	                    		<?php
	                    	}
	                    	if(!empty($question['option4'])){
	                    		?>
									<div class="col-md-6 col-sm-6 col-xs-6">
			                            <div class="option option2" value="3">
			                                <div class="text-center">
			                                    <img class="img-fluid rounded" src="./images/<?php echo $question['option4_pic'] ?>" alt="">    
			                                    <p><?php echo $question['option4'] ?></p> 
			                                </div>
			                            </div>
			                        </div>
	                    		<?php
	                    	}
	                    	if(!empty($question['option5'])){
	                    		?>
									<div class="col-md-6 col-sm-6 col-xs-6">
			                            <div class="option option2" value="3">
			                                <div class="text-center">
			                                    <img class="img-fluid rounded" src="./images/<?php echo $question['option5_pic'] ?>" alt="">    
			                                    <p><?php echo $question['option5']; ?></p> 
			                                </div>
			                            </div>
			                        </div>
	                    		<?php
	                    	}
	                    	if(!empty($question['option6'])){
	                    		?>
									<div class="col-md-6 col-sm-6 col-xs-6">
			                            <div class="option option2" value="3">
			                                <div class="text-center">
			                                    <img class="img-fluid rounded" src="./images/<?php echo $question['option6_pic'] ?>" alt="">    
			                                    <p><?php echo $question['option6']; ?></p> 
			                                </div>
			                            </div>
			                        </div>
	                    		<?php
	                    	}

						?>
	                </div>
	            </div>
	        </div>
			<?php

		}
	}


	//FUNCTION TO RETURN USER'S QUESTION ARRAY
	function get_user_question_array($id){
		global $connect;

		$user_question_array = array();

		$sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";

		$result = mysqli_query($connect, $sql);

		if(mysqli_num_rows($result)==0){
			die("No user found!!");
		}

		$user = mysqli_fetch_array($result);

		for($i=1;$i<=NUMBER_OF_QUESTIONS_TO_ASK;$i++){
			$column_name = 'q'.$i;
			array_push($user_question_array, $user[$column_name]);
		}

		return $user_question_array;




	}







?>