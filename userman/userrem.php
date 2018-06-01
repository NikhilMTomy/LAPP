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
		<link href="/css/userrem.css" rel="stylesheet"/>
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="/js/topbar.js"></script>
		<script src="/js/userrem.js"></script>
	</head>
	<body>
		<?php
		include("../template/topbar.php");
		?>
		<div class="container">
			<?php
			if (isset($_SESSION["error"])) {
				echo "<div id=\"rem-card-error\" class=\"rounded\">";
			} else {
				echo "<div id=\"rem-card\" class=\"rounded\">";
			}
			?>
			<div class="card round-0">
				<div id="idCardHead" class="bg-primary text-white">
					<div class="card-head">REMOVE USER</div>
				</div>
				<div class="card-body round-0">
					<?php
						require("../template/functions.php");
						$rows = listUsers();
						if(count($rows)-1 > 0) {
							echo "<select id=\"idUserSelect\">";
							foreach($rows as $row) {
								if ($row["username"] != $_SESSION["user"]["username"]) {
									echo "<option value=\"" . $row["userid"] . "\">" . $row["username"] . "</option>";
								}
							}
							echo "<select>
										<button onclick=\"remove()\" id=\"idRemove\" type=\"button\" class=\"btn btn-danger\">Remove</button>";
						} else {
							echo "<p>No users (other than you) found</p>";
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
}
?>