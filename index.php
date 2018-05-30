<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>NikhilMTomy</title>
			<link href="/css/bootstrap.css" rel="stylesheet"/>
			<link href="/css/index.css" rel="stylesheet"/>
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="/js/topbar.js"></script>
	</head>
	<body>
<?php
	include("template/topbar.php");
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_SESSION["user"])) {
		require_once("template/home.php");
	} else {
		header("Location: login.php", true, 303);
		exit;
	}
?>
	</body>
</html>
