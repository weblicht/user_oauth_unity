$(document).ready(function(){



	$('#tokeninfoEndpoint').blur(function(event){
		event.preventDefault();
		var post = $( "#tokeninfoEndpoint" ).serialize();
		$.post( OC.filePath('user_oauth_unity', 'ajax', 'set_tokeninfo_url.php') , post, function(data){
			$('#user_oauth_unity .msg').text('Finished saving: ' + data);
		});
	});



});

$(document).ready(function(){



	$('#userinfoEndpoint').blur(function(event){
		event.preventDefault();
		var post = $( "#userinfoEndpoint" ).serialize();
		$.post( OC.filePath('user_oauth_unity', 'ajax', 'set_userinfo_url.php') , post, function(data){
			$('#user_oauth_unity .msg').text('Finished saving: ' + data);
		});
	});



});
