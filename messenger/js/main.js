$("#register-btn").on('click', function(e){

		e.preventDefault();

		var btnHTML = $(this).html();
		$(this).html("<img id='loader' src='images/loader.svg' alt='Loading...!' />");

		var formData = new FormData();
		var fullname = $('#fullname').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var email = $('#email').val();
		var register_user = $('#register_user').val(); 
		var image = $('#image')[0].files[0];

		formData.append("fullname",fullname);
		formData.append("username",username);
		formData.append("password",password);
		formData.append("email",email);
		formData.append("register_user",register_user);
		formData.append('image', image);
		
		$.ajax({
			url : './process.php',
			method : 'POST',
			data : formData,
			processData : false,
			contentType : false,
			cache : false,
			success : function(response){

				$("#register-btn").html(btnHTML);
				console.log(response);
				$("#register-form").trigger("reset");
				changeForm($(".login-register-btn"));	
			},
			error : function(er){
				console.log(er);
			}

		});

	});

	$("#login-btn").on('click', function(){

		var btnHTML = $(this).html();
		$(this).html("<img id='loader' src='images/loader.svg' alt='Loading...!' />");

		$.ajax({
			url : './process.php',
			method : 'POST',
			data : $("#login-form").serialize(),
			success : function(resp){

				
				var response = JSON.parse(resp);

				console.log(response);

				if (response.status == 200) {
					var token = response.message.token;
					firebase.auth().signInWithCustomToken(token).catch(function(error) {
					  // Handle Errors here.
					  var errorCode = error.code;
					  var errorMessage = error.message;
					  alert(errorMessage);

					}).then(function(data){
						$("#login-btn").html(btnHTML);
						if (data.user.uid != "") {
							window.location.href = "chat.php";
						}
					});
				}else{
					alert(response.message);
				}

				

				
			}
		})


	});

		
	

	$(".login-register-btn").on('click', function(){

		changeForm(this)


	});


	function changeForm($this){
		$($this).children("span").toggleClass("active")

		$(".content").toggleClass('active');
	}

	$(".card input").on('focus blur', function(){

		$(".card").toggleClass("active");

	});