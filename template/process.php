<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $username = $_POST["username"];
  $password = $_POST["password"];
  /*$_SESSION["error"] = "";
  if(isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
  }
  require_once("dbconfig.php");
  $dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_user;password=$db_pass";
  try {
    $conn = new PDO($dsn);
    if($conn) {
      $sql = "SELECT EXISTS(SELECT 1 FROM users WHERE username='$username' AND password='$password')";
      $result = $conn->prepare($sql);
      $result->execute();
      if($result->fetchColumn()=="t") {
        $sql = "SELECT username, email, created, displayname FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->prepare($sql);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_ASSOC);

        $_SESSION["user"] = $user;
        unset($_SESSION["error"]);
      } else {
        $_SESSION["error"] = "Invalid username or password";
      }
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }*/
  include_once("functions.php");
  $result = login($username, $password);
  if($result["return"]) {
    $_SESSION["user"] = $result["user"];
    unset($_SESSION["error"]);
  } else {
    $_SESSION["error"] = $result["error"];
    unset($_SESSION["user"]);
  }
  header("Location: /", true, 303);
  exit;
?>
