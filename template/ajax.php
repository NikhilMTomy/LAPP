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
		case "checkIfUsernameExists":
			checkIfUsernameExists();
			break;
	}
}
?>