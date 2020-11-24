$(function () {
	$('.tab a').on('click', function (e) {
		e.preventDefault();
		$(this).children().removeClass('inactive');
		$(this).parent().siblings().children().children().addClass('inactive');
		target = $(this).attr('href');
		$('.tab-content > form').not(target).hide();
		$(target).fadeIn(600);
	});

	// Form validation
	$('#loginUsername').on('keyup', function () {
		var username = $('#loginUsername').val();
		var html = '';
		if (username) {
			$('#loginUsername').removeClass('is-invalid');
			$('#loginUsername').addClass('is-valid');
			$('#loginUsernameError').html(html);
			$('#loginUsernameValid').val(1);
		} else {
			$('#loginUsername').removeClass('is-valid');
			$('#loginUsername').addClass('is-invalid');
			html = `<strong>This field is required.</strong>`;
			$('#loginUsernameError').html(html);
			$('#loginUsernameValid').val(0);
		}
	});
	$('#loginPassword').on('keyup', function () {
		var username = $('#loginPassword').val();
		var html = '';
		if (username) {
			$('#loginPassword').removeClass('is-invalid');
			$('#loginPassword').addClass('is-valid');
			$('#loginPasswordError').html(html);
			$('#loginPasswordValid').val(1);
		} else {
			$('#loginPassword').removeClass('is-valid');
			$('#loginPassword').addClass('is-invalid');
			html = `<strong>This field is required.</strong>`;
			$('#loginPasswordError').html(html);
			$('#loginPasswordValid').val(0);
		}
	});

	$('#loginSubmit').on('click', function (e) {
		e.preventDefault();
		var usernameValid = $('#loginUsernameValid').val();
		var passwordValid = $('#loginPasswordValid').val();
		if (usernameValid && passwordValid) {
			var username = $('#loginUsername').val();
			var password = $('#loginPassword').val();
			$.ajax({
				method: "POST",
				url: "backend/login/login.php",
				data: {
					username: username,
					password: password
				},
				success: function (data) {
					if (data != "success") {
						alert("invalid id or password");
					} else {
						window.location.href = "chat.php";
					}
				}
			});
		}
	})
});
