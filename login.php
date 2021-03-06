<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>NikhilMTomy</title>
		<link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/login.css" rel="stylesheet"/>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/login.js"></script>
	</head>
	<body>
    <?php
    	include("template/topbar.php");
    ?>
    <div class="container">
      <?php
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
      if (isset($_SESSION["error"])) {
        echo "<div id=\"login-card-error\" class=\"rounded\">";
      } else {
        echo "<div id=\"login-card\" class=\"rounded\">";
      }
      ?>
        <div class="card round-0">
          <img class="card-img-top round-0" src="img/user.png" alt="Card image cap">
          <div class="card-body round-0">
            <form id="idForm" onsubmit="login(); return false;">
							<div class="form-group">
								<label for="idUsername">Username</label>
	        			<input name="username" id="idUsername" class="form-control" type="text" placeholder="Username"/>
                <div class="invalid-feedback">
                  Invalid username
                </div>
							</div>
							<div class="form-group">
								<label for="idPassword">Password</label>
								<input name="password" id="idPassword" class="form-control" type="password" placeholder="Password"/>
                <div class="invalid-feedback">
                  Invalid password
                </div>
							</div>
        			<input value="Submit" class="btn btn-primary" type="submit"/>
        		</form>
          </div>
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
