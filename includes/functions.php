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

	//TEST FUNCTION
	function test_function(){
		echo "Hello World";
	}


	//FUNCTION TO GET NEW QUESTION
	function get_first_question(){
		global $connect;

		$id = rand(MIN_QUESTION_ID, MAX_QUESTION_ID);
		$sql = "SELECT * FROM questions WHERE id = '$id'";
		$result = mysqli_query($connect, $sql);
		$array = mysqli_fetch_array($result);
		?>
		<div class="question col-md-8 offset-md-2" id="question" qid="<?php echo $array['id'] ?>">
            <div class="text-center">
                <p>Question <span style="font-weight:bold; color:rgb(153, 0, 59) !important">1</span> of 20</p>
            </div>
            <p class="text-center question-text"><?php echo $array['text'] ?></p>
            <div class="options">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="option" value="1">
                            <div class="text-center">
                                <img class="img-fluid rounded" src="./images/<?php echo $array['option1_pic'] ?>" alt="">    
                                <p><?php echo $array['option1'] ?></p> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="option" value="2">
                            <div class="text-center">
                                <img class="img-fluid rounded" src="./images/<?php echo $array['option2_pic'] ?>" alt="">    
                                <p><?php echo $array['option2'] ?></p> 
                            </div>
                        </div>
                    </div>
                    <?php
                    	if(!empty($array['option3'])){
                    		?>
								<div class="col-md-6 col-sm-6 col-xs-6">
		                            <div class="option" value="3">
		                                <div class="text-center">
		                                    <img class="img-fluid rounded" src="./images/<?php echo $array['option3_pic'] ?>" alt="">    
		                                    <p><?php echo $array['option3'] ?></p> 
		                                </div>
		                            </div>
		                        </div>
                    		<?php
                    	}
                    	if(!empty($array['option4'])){
                    		?>
								<div class="col-md-6 col-sm-6 col-xs-6">
		                            <div class="option" value="3">
		                                <div class="text-center">
		                                    <img class="img-fluid rounded" src="./images/<?php echo $array['option4_pic'] ?>" alt="">    
		                                    <p><?php echo $array['option4'] ?></p> 
		                                </div>
		                            </div>
		                        </div>
                    		<?php
                    	}
                    	if(!empty($array['option5'])){
                    		?>
								<div class="col-md-6 col-sm-6 col-xs-6">
		                            <div class="option" value="3">
		                                <div class="text-center">
		                                    <img class="img-fluid rounded" src="./images/<?php echo $array['option5_pic'] ?>" alt="">    
		                                    <p><?php echo $array['option5']; ?></p> 
		                                </div>
		                            </div>
		                        </div>
                    		<?php
                    	}
                    	if(!empty($array['option6'])){
                    		?>
								<div class="col-md-6 col-sm-6 col-xs-6">
		                            <div class="option" value="3">
		                                <div class="text-center">
		                                    <img class="img-fluid rounded" src="./images/<?php echo $array['option6_pic'] ?>" alt="">    
		                                    <p><?php echo $array['option6']; ?></p> 
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

	//FUNCTION TO GET QUESTION BY ID
	function get_question_by_id($id){
		global $connect;
		if(empty($id)){
			die("Id value is empty");
		}

		$sql = "SELECT * FROM questions WHERE id = '$id'";
		$result = mysqli_query($connect, $sql);
		$array = mysqli_fetch_array($result);
		?>
		<div class="question col-md-8 offset-md-2" id="question" qid="<?php echo $array['id'] ?>">
            <div class="text-center">
                <p>Question <span style="font-weight:bold; color:rgb(153, 0, 59) !important"><?php count($_SESSION['user_array']) ?></span> of 20</p>
            </div>
            <p class="text-center question-text"><?php echo $array['text'] ?></p>
            <div class="options">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="option" value="1">
                            <div class="text-center">
                                <img class="img-fluid rounded" src="./images/<?php echo $array['option1_pic'] ?>" alt="">    
                                <p><?php echo $array['option1'] ?></p> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="option" value="2">
                            <div class="text-center">
                                <img class="img-fluid rounded" src="./images/<?php echo $array['option2_pic'] ?>" alt="">    
                                <p><?php echo $array['option2'] ?></p> 
                            </div>
                        </div>
                    </div>
                    <?php
                    	if(!empty($array['option3'])){
                    		?>
								<div class="col-md-6 col-sm-6 col-xs-6">
		                            <div class="option" value="3">
		                                <div class="text-center">
		                                    <img class="img-fluid rounded" src="./images/<?php echo $array['option3_pic'] ?>" alt="">    
		                                    <p><?php echo $array['option3'] ?></p> 
		                                </div>
		                            </div>
		                        </div>
                    		<?php
                    	}
                    	if(!empty($array['option4'])){
                    		?>
								<div class="col-md-6 col-sm-6 col-xs-6">
		                            <div class="option" value="3">
		                                <div class="text-center">
		                                    <img class="img-fluid rounded" src="./images/<?php echo $array['option4_pic'] ?>" alt="">    
		                                    <p><?php echo $array['option4'] ?></p> 
		                                </div>
		                            </div>
		                        </div>
                    		<?php
                    	}
                    	if(!empty($array['option5'])){
                    		?>
								<div class="col-md-6 col-sm-6 col-xs-6">
		                            <div class="option" value="3">
		                                <div class="text-center">
		                                    <img class="img-fluid rounded" src="./images/<?php echo $array['option5_pic'] ?>" alt="">    
		                                    <p><?php echo $array['option5']; ?></p> 
		                                </div>
		                            </div>
		                        </div>
                    		<?php
                    	}
                    	if(!empty($array['option6'])){
                    		?>
								<div class="col-md-6 col-sm-6 col-xs-6">
		                            <div class="option" value="3">
		                                <div class="text-center">
		                                    <img class="img-fluid rounded" src="./images/<?php echo $array['option6_pic'] ?>" alt="">    
		                                    <p><?php echo $array['option6']; ?></p> 
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

	//FUNCTION TO GENERATE NEXT QUESTION ID
	function generate_next_question_id($user_array){
		$generated_id = rand(MIN_QUESTION_ID, MAX_QUESTION_ID);
		
		while(array_key_exists($generated_id, $user_array)){
			$generated_id = rand(MIN_QUESTION_ID, MAX_QUESTION_ID);
		}
		return $generated_id;

	}

	//FUNCTION TO GET NEXT QUESTION
	function get_next_question(){
		$id = generate_next_question_id($_SESSION['user_array']);
		get_question_by_id($id);
	}






?>