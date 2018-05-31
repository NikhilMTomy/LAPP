<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$displayname = "";
$email = "";
$username = "";
$password = "";
$role = "";
if(isset($_SESSION["newuser"])) {
	$displayname = $_SESSION["newuser"]["displayname"];
	$usrname = $_SESSION["newuser"]["username"];
	$email = $_SESSION["newuser"]["email"];
	$password = $_SESSION["newuser"]["password"];
	$role = $_SESSION["newuser"]["role"];
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
		<link href="/css/useradd.css" rel="stylesheet"/>
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.js"></script>
		<script src="/js/topbar.js"></script>
		<script src="/js/useradd.js"></script>
	</head>
	<body>
		<?php
		include("../template/topbar.php");
		?>
		<div class="container">
			<?php
			if (isset($_SESSION["error"])) {
				echo "<div id=\"login-card-error\" class=\"rounded\">";
			} else {
				echo "<div id=\"login-card\" class=\"rounded\">";
			}
			?>
			<div class="card round-0">
				<div id="idCardHead" class="bg-primary text-white">
					<div class="card-head">ADD USER</div>
				</div>
				<div class="card-body round-0">
					<form id="idForm" onsubmit="signup(); return false;">
						<div class="form-group">
							<label for="idDisplayname">Display Name</label>
							<input value="<?php echo "$displayname"; ?>" data-toggle="tooltip" data-placement="bottom" title="Used for Greeting :)" name="displayname" type="text" class="form-control" id="idDisplayname" placeholder="Display Name"/>
							<div class="invalid-feedback">Invalid displayname</div>
						</div>
						<div class="form-group">
							<label for="idUsername">Username</label>
							<input value="<?php echo "$username"; ?>" name="username" type="text" class="form-control" id="idUsername" placeholder="Username"/>
							<div id="idUsernameInvalid" class="invalid-feedback">Invalid username</div>
						</div>
						<div class="form-group">
							<label for="idEmail">Email</label>
							<input value="<?php echo "$email"; ?>" name="email" type="email" class="form-control" id="idEmail" placeholder="username@domain.com"/>
							<div id="idEmailInvalid" class="invalid-feedback">Invalid email</div>
						</div>
						<div class="form-group">
							<label for="idPassword">Password</label>
							<input value="<?php echo "$password"; ?>" name="password" type="password" class="form-control" id="idPassword" placeholder="Password"/>
							<div class="invalid-feedback">Invalid password</div>
						</div>
						<div class="form-group">
							<label for="idPasswordConfirm">Confirm Password</label>
							<input name="passwordconfirm" type="password" class="form-control" id="idPasswordConfirm" placeholder="Confirm Password"/>
							<div class="invalid-feedback">Passwords does not match</div>
						</div>
						<fieldset class="form-group">
							<div class="row">
								<legend class="col-form-label col-sm-4 pt-0">Role</legend>
								<div class="col-sm-5">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="role" id="idRoleUser" value="user"
										<?php
											if($role!="admin") {
												echo "checked";
											}
										?>
										>
										<label class="form-check-label" for="idRoleUser">User</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="role" id="idRoleAdmin" value="admin"
										<?php
											if($role=="admin") {
												echo "checked";
											}
										?>
										>
										<label class="form-check-label" for="idRoleUser">Admin</label>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="form-group row">
							<button id="idSubmit" type="submit" class="btn btn-primary">Sign up</button>
						</div>
					</form>
				</div>
				<?php
          if (isset($_SESSION["error"])) {
            echo "<div id=\"idAlert\">" .
              $_SESSION["error"] .
              "</div>";
            unset($_SESSION["error"]);
          }
        ?>
			</div>
		</div>
	</body>
</html>
<?php
}
?>