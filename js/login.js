$(document).ready(function() {
	$("#idUsername").focusout(function() {
		if ($.trim($(this).val()) == '') {
			$(this).addClass("is-invalid");
		} else {
			$(this).removeClass("is-invalid");
		}
	});
	$("#idPassword").focusout(function() {
		if ($.trim($(this).val()) == '') {
			$(this).addClass("is-invalid");
		} else {
			$(this).removeClass("is-invalid");
		}
	});
});

function login() {
	var username = $("#idUsername").val();
	var password = $("#idPassword").val();
	var data = {
		action: "login",
		username: username,
		password: password
	};
	var ajaxurl = "/template/ajax.php";
	$.post(ajaxurl, data, function (response) {
		window.location.href = "/";
	});
}