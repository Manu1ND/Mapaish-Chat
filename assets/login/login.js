$(function () {
	$('.tab a').on('click', function (e) {
		e.preventDefault();
		$(this).children().removeClass('inactive');
		$(this).parent().siblings().children().children().addClass('inactive');
		target = $(this).attr('href');
		$('.tab-content > form').not(target).hide();
		$(target).fadeIn(600);
	});

	$('#loginSubmit').on('click', function(e){
		e.preventDefault();
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
                    window.location.href = "chat.html";
                }
			}
		});
	})
});
