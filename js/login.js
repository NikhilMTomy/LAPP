$(document).ready(function() {
	$("#idUsername").focusout(checkEmptyUsername);
	$("#idPassword").focusout(checkEmptyPassword);
});
function checkEmptyUsername() {
	if ($.trim($("#idUsername").val()) == '') {
		$("#idUsername").addClass("is-invalid");
		return false;
	} else {
		$("#idUsername").removeClass("is-invalid");
		return true;
	}
}
function checkEmptyPassword() {
	if ($.trim($("#idPassword").val()) == '') {
		$("#idPassword").addClass("is-invalid");
		return false;
	} else {
		$("#idPassword").removeClass("is-invalid");
		return true;
	}
}
function checkEmptyField() {
	return (checkEmptyPassword() && checkEmptyUsername());
}
function login() {
	var username = $("#idUsername").val();
	var password = $("#idPassword").val();
	if (checkEmptyField()) {
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
}