$(document).ready(function(){



	$('#tokenIntrospectionEndpoint').blur(function(event){
		event.preventDefault();
		var post = $( "#tokenIntrospectionEndpoint" ).serialize();
		$.post( OC.filePath('user_oauth_unity', 'ajax', 'seturl.php') , post, function(data){
			$('#user_oauth_unity .msg').text('Finished saving: ' + data);
		});
	});



});

