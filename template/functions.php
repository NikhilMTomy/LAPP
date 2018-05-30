<?php
function logout() {
	unset($_SESSION["user"]);
  header('Location: /');
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
        $sql = "SELECT username, email, created, displayname FROM users WHERE username='$username' AND password='$password'";
        $output = $conn->prepare($sql);
        $output->execute();
        $user = $output->fetch(PDO::FETCH_ASSOC);

        $result["user"] = $user;
				unset($result["error"]);
				$result["return"] = true;
				return $result;
      } else {
        $result["error"] = "Invalid username or password";
      }
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  $result["return"] = false;
	return $result;
}
?>