$(document).ready(function(){

	//ACTIVE FIRST QUESTION
	$('#main-questions-wrapper .question').first().removeClass('inactive-question');
	$('#main-questions-wrapper .question').first().addClass('active-question');

	//INITIALIZE NUMBER OF QUESTION ANSWERED
	var question_answered = 0;

	//REMOVE LOCALSTORAGE
	localStorage.removeItem('user_answers');
	localStorage.removeItem('user_friend_answers');
	
	$('.option').each(function(){
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

			if(question_answered==3){
				var obj = localStorage.user_answers;
				console.log(obj);
				
				$.ajax({
					url: './includes/process.php',
					data: 'create_quiz=' + 'true' + '&answers=' + obj,
					method: 'POST',
					success: function(res){
						localStorage.removeItem('user_answers');
						$('#main-questions-wrapper').html(res);

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

			if(question_answered==3){
				var obj = localStorage.user_friend_answers;
				console.log(obj);
				
				$.ajax({
					url: './includes/process.php',
					data: 'find_score=' + 'true' + '&answers=' + obj,
					method: 'POST',
					success: function(res){
						localStorage.removeItem('user_friend_answers');
						$('#main-questions-wrapper').html(res);

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