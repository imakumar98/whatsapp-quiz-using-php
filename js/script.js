//$(document).ready(function(){

	
	$('.option').each(function(){
		$(this).on('click',function(){
			var qid = $('#question').attr('qid');
			var ans = $(this).attr('value');


 
			$.ajax({
				url: './includes/process.php',
				method: 'POST',
				data : 'qid='+ qid + '&ans=' + ans + '&purpose=' + 'get_next_question',
				success: function(res){
					//alert(res);
					$('#question-main-wrapper').html(res);
					
				}
			});
			return false;
		});
	});







	
//});