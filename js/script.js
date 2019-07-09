$(document).ready(function(){

	

	//ACTIVE FIRST QUESTION
	$('#main-questions-wrapper .question').first().removeClass('inactive-question');
	$('#main-questions-wrapper .question').first().addClass('active-question');

	//INITIALIZE NUMBER OF QUESTION ANSWERED
	var question_answered = 0;

	//REMOVE LOCALSTORAGE
	localStorage.removeItem('user_answers');
	localStorage.removeItem('user_friend_answers');
	
	$('.option1').each(function(){
		$(this).on('click',function(){
			var qid = $(this).parent().parent().parent().parent().attr('qid');
			var ans = $(this).attr('value');
			if(localStorage.user_answers){
				var obj = JSON.parse(localStorage.user_answers);
				obj[qid] = ans;
				localStorage.user_answers = JSON.stringify(obj);
				question_answered = question_answered + 1;
			}else{
				var obj = {};
				obj[qid] = ans;
				
				localStorage.user_answers = JSON.stringify(obj);
				question_answered = question_answered + 1;

			}
			$(this).parent().parent().parent().parent().removeClass('active-question');
			$(this).parent().parent().parent().parent().addClass('inactive-question');

			console.log('Question ID : ' + qid + ' Answer : ' + ans );


			$(this).parent().parent().parent().parent().next().removeClass('inactive-question');
			$(this).parent().parent().parent().parent().next().addClass('active-question');

			if(question_answered==NUMBER_OF_QUESTIONS_TO_ASK){
				var obj = localStorage.user_answers;
				console.log(obj);
				
				$.ajax({
					url: './includes/process.php',
					data: 'create_quiz=' + 'true' + '&answers=' + obj,
					method: 'POST',
					dataType: 'html',
					success: function(res){
						var quiz_id = res;
						localStorage.user_id = quiz_id;
						localStorage.removeItem('user_answers');
						window.location.href = APP_URL + '/share.php';
						

					}
				});

			}
		});
	});



	$('.option2').each(function(){
		$(this).on('click',function(){
			var qid = $(this).parent().parent().parent().parent().attr('qid');
			var ans = $(this).attr('value');
			if(localStorage.user_friend_answers){
				var obj = JSON.parse(localStorage.user_friend_answers);
				obj[qid] = ans;
				localStorage.user_friend_answers = JSON.stringify(obj);
				question_answered = question_answered + 1;
			}else{
				var obj = {};
				obj[qid] = ans;
				
				localStorage.user_friend_answers = JSON.stringify(obj);
				question_answered = question_answered + 1;

			}
			$(this).parent().parent().parent().parent().removeClass('active-question');
			$(this).parent().parent().parent().parent().addClass('inactive-question');

			console.log('Question ID : ' + qid + ' Answer : ' + ans );


			$(this).parent().parent().parent().parent().next().removeClass('inactive-question');
			$(this).parent().parent().parent().parent().next().addClass('active-question');

			if(question_answered==NUMBER_OF_QUESTIONS_TO_ASK){
				var obj = localStorage.user_friend_answers;
				var user_id = $('#main-questions-wrapper').attr('user-id');
				console.log(obj);
				
				$.ajax({
					url: './includes/process.php',
					data: 'find_score=' + 'true' + '&friend_answers=' + obj + '&user_id=' + user_id,
					method: 'POST',
					success: function(res){

						var score = res;
						localStorage.score = score;

						localStorage.removeItem('user_friend_answers');
						window.location.href = APP_URL + '/result.php?uid='+user_id;


					}
				});

			}
		});
	});

});


function copyText(){
	var copyText = document.getElementById("copy-textarea");

  	copyText.select();

 	document.execCommand("copy");
 	document.getElementById('copy-btn').innerHTML = 'COPIED';

}