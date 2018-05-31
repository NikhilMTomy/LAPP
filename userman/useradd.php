<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(!isset($_SESSION["user"])) {
		header("Location: login.php", true, 303);
		exit;
	} else {
		
	}
?>