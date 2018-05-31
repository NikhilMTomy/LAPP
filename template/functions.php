<?php

function logout() {
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
	unset($_SESSION["user"]);
  exit();
}

function login($username, $password) {
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  require("dbconfig.php");
  $dsn = "pgsql:host={$db_host};port={$db_port};dbname={$db_name};user={$db_user};password={$db_pass}";
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
        $conn = null;
        echo "true";
				return true;
      } else {
        error_log("functions.php :: Invalid username or password [$username, $password]");
        $_SESSION["error"] = "Invalid username or password";
        unset($_SESSION["user"]);
      }
      $conn = null;
    }
  } catch (PDOException $e) {
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
  }
  echo "false";
  return false;
  exit();
}
function usernameExists($username) {
  require("dbconfig.php");
  $dsn = "pgsql:host={$db_host};port={$db_port};dbname={$db_name};user={$db_user};password={$db_pass}";
  try {
    $conn = new PDO($dsn);
    if($conn) {
      $sql = "SELECT EXISTS(SELECT 1 FROM users WHERE username='$username')";
      $output = $conn->prepare($sql);
      $output->execute();
      if($output->fetchColumn()=="t") {
        echo "true";
        $conn = null;
      } else {
        echo "false";
        $conn = null;
      }
    }
  } catch (PDOException $e) {
    $conn = null;
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
  }
  exit();
}
function emailExists($email) {
  require("dbconfig.php");
  $dsn = "pgsql:host={$db_host};port={$db_port};dbname={$db_name};user={$db_user};password={$db_pass}";
  try {
    $conn = new PDO($dsn);
    if($conn) {
      $sql = "SELECT EXISTS(SELECT 1 FROM users WHERE email='$email')";
      $output = $conn->prepare($sql);
      if (!$output) {
        error_log(print_r($conn->errorInfo(), true));
      }
      $output->execute();
      if($output->fetchColumn()=="t") {
        echo "true";
        $conn = null;
      } else {
        echo "false";
        $conn = null;
      }
    }
  } catch (PDOException $e) {
    $conn = null;
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
  }
  exit();
}
function createUser($displayname, $username, $email, $password, $role) {
  require("dbconfig.php");
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $dsn = "pgsql:host={$db_host};port={$db_port};dbname={$db_name};user={$db_user};password={$db_pass}";
  try {
    $conn = new PDO($dsn);
    if($conn) {
      $sql = "INSERT INTO users (displayname, username, email, password, role) VALUES ('$displayname', '$username', '$email', '$password', '$role')";
      $output = $conn->prepare($sql);
      if (!$output) {
        error_log(print_r($conn->errorInfo(), true));
      } else {
        $output->execute();
        login($username, $password);
        header("Location: /index.php, true, 303");
        echo "true";
      }
    }
    $conn = null;
  } catch (PDOException $e) {
    $conn = null;
    error_log("functions.php :: PDOException :: {}");
    return false;
  }
  return true;
  exit();
}
?>