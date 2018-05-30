<?php
include('functions.php');

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (isset($_POST["action"])) {
	switch($_POST["action"]) {
		case "logout":
			logout();
			break;
		case "login":
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			$result = login($_POST["username"], $_POST["password"]);
			if($result["return"]) {
				$_SESSION["user"] = $result["user"];
				unset($_SESSION["error"]);
			} else {
				$_SESSION["error"] = $result["error"];
				unset($_SESSION["user"]);
			}
			break;
	}
}
?>