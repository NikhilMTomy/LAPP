$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
$(document).ready(function() {
	$("#idUsername").focusout(checkUsername);
	$("#idDisplayname").focusout(checkDisplayname);
	$("#idPassword").focusout(checkPassword);
	$("#idPasswordConfirm").focusout(checkPasswordMatch);
	$("#idEmail").focusout(checkEmail);
});
function emailExists() {
	var data = {
		action: "emailExists",
		email: $("#idEmail").val()
	};
	var ajaxurl = "/template/ajax.php";
	$.post(ajaxurl, data, function (repsonse) {
		if (repsonse == "true") {
			$("#idEmailInvalid").html("Email already registered");
			$("#idEmail").addClass("is-invalid");
		} else {
			$("#idEmailInvalid").html("Invalid email");
		}
	});
}
function usernameExists() {
	var data = {
		action: "usernameExists",
		username: $("#idUsername").val()
	};
	var ajaxurl = "/template/ajax.php";
	$.post(ajaxurl, data, function (response) {
		if (response == "true") {
			$("#idUsernameInvalid").html("Username already taken");
			$("#idUsername").addClass("is-invalid");
		} else {
			$("#idUsernameInvalid").html("Invalid username");
		}
	});
}
function checkEmail() {
	var ele = $("#idEmail");
	var ret = false;
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if ($.trim(ele.val()) == '') {
		ele.addClass("is-invalid");
		ret = false;
	} else if (re.test(ele.val())) {
		ele.removeClass("is-invalid");
		ret = true;
	} else {
		ele.addClass("is-invalid");
		ret = false;
	}
	emailExists();
	return ret;
}
function checkUsername() {
	var ele = $("#idUsername");
	var ret = false;
	if ($.trim(ele.val()) == '') {
		ele.addClass("is-invalid");
		ret = false;
	} else {
		ele.removeClass("is-invalid");
		ret = true;
	}
	usernameExists();
	return ret;
}
function checkDisplayname() {
	var ele = $("#idDisplayname");
	if ($.trim(ele.val()) == '') {
		ele.addClass("is-invalid");
		return false;
	} else {
		ele.removeClass("is-invalid");
		return true;
	}
}
function checkPassword() {
	var ele = $("#idPassword");
	if ($.trim(ele.val()) == '') {
		ele.addClass("is-invalid");
		return false;
	} else {
		ele.removeClass("is-invalid");
		return true;
	}
}
function checkPasswordMatch() {
	var pass = $("#idPassword");
	var passc = $("#idPasswordConfirm");
	if(checkPassword()) {
		if(pass.val() != passc.val()) {
			passc.addClass("is-invalid");
			return false;
		} else {
			passc.removeClass("is-invalid");
		}
	}
}
function checkField() {
	checkUsername();
	checkDisplayname();
	checkPassword();
	checkPasswordMatch();
	checkEmail();
	var ret = true;
	$("input").each(function() {
		if($(this).hasClass("is-invalid")) {
			ret = false;
		}
	});
	return ret;
}
function signup() {
	var username = $("#idUsername").val();
	var password = $("#idPassword").val();
	var email = $("#idEmail").val();
	var displayname = $("#idDisplayname").val();
	var role = "user";
	if ($("#idRoleAdmin").prop("checked")) {
		role="admin";
	}
	if (checkField()) {
		var data = {
			action: "createUser",
			displayname: displayname,
			username: username,
			email: email,
			password: password,
			role: role
		};
		var ajaxurl = "/template/ajax.php";
		$.post(ajaxurl, data, function (response) {
			if (response == "true") {
				alert("/");
				window.location.href="/";
			}
		});
	}
}