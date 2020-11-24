$(function () {
	// form validation
	$('#mem_name').on('keyup', function () {
		var mem_name = $('#mem_name').val();
		var html = '';
		if (mem_name) {
			$('#mem_nameError').html(html);
			$('#mem_name').removeClass('is-invalid');
			$('#mem_name').addClass('is-valid');
			$('#mem_nameValid').val(1);
		} else {
			html = `<strong>This field is required.</strong>`;
			$('#mem_nameError').html(html);
			$('#mem_name').removeClass('is-valid');
			$('#mem_name').addClass('is-invalid');
			$('#mem_nameValid').val(0);
		}
	});
	$('#username').on('keyup', function () {
		var username = $('#username').val();
		var html = '';
		if (username) {
			$.ajax({
				method: "POST",
				url: "backend/login/checkDuplicate.php",
				data: { username: username },
				success: function (data) {
					if (data) {
						html = `<strong>Duplicate Username</strong>
						</small>`;
						$('#username').removeClass('is-valid');
						$('#username').addClass('is-invalid');
						$('#usernameValid').val(0);
					} else {
						$('#username').removeClass('is-invalid');
						$('#username').addClass('is-valid');
						$('#usernameValid').val(1);
					}
					$('#usernameError').html(html);
				}
			});
		} else {
			$('#username').removeClass('is-valid');
			$('#username').addClass('is-invalid');
			html = `<strong>This field is required.</strong>`;
			$('#usernameError').html(html);
			$('#usernameValid').val(0);
		}
	});
	$('#email').on('keyup', function () {
		var email = $('#email').val();
		var html = '';
		if (email) {
			var emailFormat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			if (email.match(emailFormat)) {
				$.ajax({
					method: "POST",
					url: "backend/login/checkDuplicate.php",
					data: { email: email },
					success: function (data) {
						if (data) {
							html = `<strong>Duplicate Email</strong>
						</small>`;
							$('#email').removeClass('is-valid');
							$('#email').addClass('is-invalid');
							$('#emailValid').val(0);
						} else {
							$('#email').removeClass('is-invalid');
							$('#email').addClass('is-valid');
							$('#emailValid').val(1);
						}
						$('#emailError').html(html);
					}
				});
			} else {
				$('#email').removeClass('is-valid');
				$('#email').addClass('is-invalid');
				html = `<strong>Invalid E-Mail.</strong>`;
				$('#emailError').html(html);
				$('#emailValid').val(0);
			}
		} else {
			$('#email').removeClass('is-valid');
			$('#email').addClass('is-invalid');
			html = `<strong>This field is required.</strong>`;
			$('#emailError').html(html);
			$('#emailValid').val(0);
		}
	});
	$('#password').on('keyup', function () {
		var password = $('#password').val();
		var html = '';
		if (password) {
			var passwordFormat = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
			if (password.match(passwordFormat)) {
				$('#passwordError').html(html);
				$('#password').removeClass('is-invalid');
				$('#password').addClass('is-valid');
				$('#passwordValid').val(1);
			} else {
				html = `<strong>Password must contain minimum eight characters, at least one letter and one number.</strong>`;
				$('#passwordError').html(html);
				$('#password').removeClass('is-valid');
				$('#password').addClass('is-invalid');
				$('#passwordValid').val(0);
			}
		} else {
			html = `<strong>This field is required.</strong>`;
			$('#passwordError').html(html);
			$('#password').removeClass('is-valid');
			$('#password').addClass('is-invalid');
			$('#passwordValid').val(0);
		}
	});
	// Register Submit
	$('#registerSubmit').on('click', function (e) {
		e.preventDefault();
		var mem_nameValid = $('#mem_nameValid').val();
		var usernameValid = $('#usernameValid').val();
		var emailValid = $('#emailValid').val();
		var passwordValid = $('#passwordValid').val();
		console.log(mem_nameValid);
		console.log(usernameValid);
		console.log(emailValid);
		console.log(passwordValid);
		if (mem_nameValid && usernameValid && emailValid && passwordValid) {
			var mem_name = $('#mem_name').val();
			var username = $('#username').val();
			var email = $('#email').val();
			var password = $('#password').val();
			$.ajax({
				method: "POST",
				url: "backend/login/register.php",
				data: {
					mem_name: mem_name,
					username: username,
					email: email,
					password: password
				},
				success: function (data) {
					console.log(data);
					location.reload(true);
				}
			});
		}
	});
});