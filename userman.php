<?php
	include("template/topbar.php");
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_SESSION["user"])) {
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>NikhilMTomy</title>
		<?php
			echo "<link href=\"/css/bootstrap.css?v=" . time() . "\" rel=\"stylesheet\"/>";
			echo "<link href=\"/css/userman.css?v=" . time() . "\" rel=\"stylesheet\"/>";
		?>
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="/js/userman.js"></script>
		<script src="/js/topbar.js"></script>
	</head>
	<body>
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
	} else {
		header("Location: login.php", true, 303);
		exit;
	}
?>
	</body>
</html>