<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

function logout() {
	unset($_SESSION["user"]);
  exit;
}

function login($username, $password) {
  $result = array();
  require_once("dbconfig.php");
  $dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_user;password=$db_pass";
  try {
    $conn = new PDO($dsn);
    if($conn) {
      $sql = "SELECT EXISTS(SELECT 1 FROM users WHERE username='$username' AND password='$password')";
      $output = $conn->prepare($sql);
      $output->execute();
      if($output->fetchColumn()=="t") {
        // get userdata
        $sql = "SELECT userid, username, email, lastlog, created, displayname, role FROM users WHERE username='$username' AND password='$password'";
        $output = $conn->prepare($sql);
        $output->execute();
        $user = $output->fetch(PDO::FETCH_ASSOC);

        // update lastlog
        $sql = "UPDATE users SET lastlog=NOW() WHERE username='$username' AND password='$password'";
        $output = $conn->prepare($sql);
        $output->execute();

				$_SESSION["user"] = $user;
				unset($_SESSION["error"]);
				return true;
      } else {
        error_log("functions.php :: Invalid username or password [$username, $password]");
        $_SESSION["error"] = "Invalid username or password";
        unset($_SESSION["user"]);
      }
    }
  } catch (PDOException $e) {
    error_log("functions.php :: PDOException :: $e->getMessage()");
  }
  return false;
}

function checkIfUsernameExists($username) {
  $sql = "SELECT EXISTS(SELECT 1 FROM users WHERE username='$username'";
  return false;
}
?>