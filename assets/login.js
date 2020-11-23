$(document).ready(function () {
	$("#loginForm").submit(function (event) {
		event.preventDefault();
	});

	$('input').bind('input propertychange', function() {
		$('#output').html($(this).val());
	});

	$("#registerForm").submit(function (event) {
		event.preventDefault();
	});
});
