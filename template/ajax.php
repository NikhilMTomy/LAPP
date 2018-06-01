<?php
include('functions.php');

if (isset($_POST["action"])) {
	switch($_POST["action"]) {
		case "logout":
			logout();
			break;
		case "login":
			login($_POST["username"], $_POST["password"]);
			break;
		case "usernameExists":
			usernameExists($_POST["username"]);
			break;
		case "emailExists":
			emailExists($_POST["email"]);
			break;
		case "createUser":
			createUser($_POST["displayname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["role"]);
			break;
		case "removeUser":
			removeUser($_POST["userid"], $_POST["username"]);
			break;
	}
}
?>