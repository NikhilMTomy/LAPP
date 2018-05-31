<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(!isset($_SESSION["user"])) {
		header("Location: /login.php", true, 303);
		exit;
	} elseif($_SESSION["user"]["role"] != "admin") {
		echo "Only admin can manage users";
	} else {
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>NikhilMTomy</title>
		<link href="/css/bootstrap.css" rel="stylesheet"/>
		<link href="/css/userman.css" rel="stylesheet"/>
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="/js/userman.js"></script>
		<script src="/js/topbar.js"></script>
	</head>
	<body>
		<?php
			include("template/topbar.php");
		?>
		<div class="continer-fluid">
			<div class="row">
				<div class="col">
					<div id="iddivUserAdd" class="image-card">
						<a href="/userman/useradd.php">
							<img id="idimgUserAdd" src="/img/useradd.png"></img>
						</a>
					</div>
				</div>
				<div class="col">
					<div id="iddivUserRem" class="image-card">
						<a href="/userman/userrem.php">
							<img id="idimgUserRem" src="/img/userrem.png"></img>
						</a>
					</div>
				</div>
				<div class="col">
					<div id="iddivUserMod" class="image-card">
						<a href="/userman/usermod.php">
							<img id="idimgUserMod" src="/img/usermod.png"></img>
						</a>
					</div>
				</div>
			</div>
		</div>
<?php
	}
?>
	</body>
</html>