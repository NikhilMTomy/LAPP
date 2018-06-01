<?php
include('functions.php');

if (isset($_POST["action"])) {
	switch($_POST["action"]) {
		case "logout":
			if(logout()) {
				echo "true";
			} else {
				echo "false";
			}
			break;
		case "login":
			if(login($_POST["username"], $_POST["password"])) {
				echo "true";
			} else {
				echo "false";
			}
			break;
		case "usernameExists":
			if(usernameExists($_POST["username"])) {
				echo "true";
			} else {
				echo "false";
			}
			break;
		case "emailExists":
			if(emailExists($_POST["email"])) {
				echo "true";
			} else {
				echo "false";
			}
			break;
		case "createUser":
			if(createUser($_POST["displayname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["role"])) {
				echo "true";
			} else {
				echo "false";
			}
			break;
		case "removeUser":
			if(removeUser($_POST["userid"], $_POST["username"])) {
				echo "true";
			} else {
				echo "false";
			}
			break;
	}
}
?>