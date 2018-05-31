$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
$(document).ready(function() {
	$("#idUsername").focusout(checkUsername);
	$("#idPassword").focusout(checkPassword);
});
function checkUsername() {
	if ($.trim($("#idUsername").val()) == '') {
		$("#idUsername").addClass("is-invalid");
		return false;
	} else {
		$("#idUsername").removeClass("is-invalid");
		return true;
	}
}
function checkPassword() {
	if ($.trim($("#idPassword").val()) == '') {
		$("#idPassword").addClass("is-invalid");
		return false;
	} else {
		$("#idPassword").removeClass("is-invalid");
		return true;
	}
}
function checkFields() {
	return (checkPassword() && checkUsername());
}
function login() {
	var username = $("#idUsername").val();
	var password = $("#idPassword").val();
	if (checkFields()) {
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