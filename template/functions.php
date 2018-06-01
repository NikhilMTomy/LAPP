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
  require "dbconfig.php";
  try {
    $db = new PDO($dsn);
    if($db) {
      $sql = "SELECT EXISTS(SELECT 1 FROM users WHERE username='$username' AND password='$password')";
      $query = $db->prepare($sql);
      $query->execute();
      if($query->fetchColumn()=="t") {
        // get userdata
        $sql = "SELECT userid, username, email, lastlog, created, displayname, role FROM users WHERE username='$username' AND password='$password'";
        $query = $db->prepare($sql);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // update lastlog
        $sql = "UPDATE users SET lastlog=NOW() WHERE username='$username' AND password='$password'";
        $query = $db->prepare($sql);
        $query->execute();

				$_SESSION["user"] = $user;
        unset($_SESSION["error"]);
        $db = null;
        echo "true";
				return true;
      } else {
        error_log("functions.php :: Invalid username or password [$username, $password]");
        $_SESSION["error"] = "Invalid username or password";
        unset($_SESSION["user"]);
      }
      $db = null;
    }
  } catch (PDOException $e) {
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
  }
  echo "false";
  return false;
  exit();
}
function usernameExists($username) {
  require "dbconfig.php";
  try {
    $db = new PDO($dsn);
    if($db) {
      $sql = "SELECT EXISTS(SELECT 1 FROM users WHERE username='$username')";
      $query = $db->prepare($sql);
      $query->execute();
      if($query->fetchColumn()=="t") {
        echo "true";
        $db = null;
      } else {
        echo "false";
        $db = null;
      }
    }
  } catch (PDOException $e) {
    $db = null;
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
  }
  exit();
}
function emailExists($email) {
  require "dbconfig.php";
  try {
    $db = new PDO($dsn);
    if($db) {
      $sql = "SELECT EXISTS(SELECT 1 FROM users WHERE email='$email')";
      $query = $db->prepare($sql);
      if (!$query) {
        error_log(print_r($db->errorInfo(), true));
      }
      $query->execute();
      if($query->fetchColumn()=="t") {
        echo "true";
        $db = null;
      } else {
        echo "false";
        $db = null;
      }
    }
  } catch (PDOException $e) {
    $db = null;
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
  }
  exit();
}
function createUser($displayname, $username, $email, $password, $role) {
  require "dbconfig.php";
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  try {
    $db = new PDO($dsn);require("dbconfig.php");
    if($db) {
      $sql = "INSERT INTO users (displayname, username, email, password, role) VALUES ('$displayname', '$username', '$email', '$password', '$role')";
      $query = $db->prepare($sql);
      if (!$query) {
        error_log(print_r($db->errorInfo(), true));
      } else {
        $query->execute();
        login($username, $password);
        header("Location: /index.php, true, 303");
        echo "true";
      }
    }
    $db = null;
  } catch (PDOException $e) {
    $db = null;
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
    return false;
  }
  return true;
  exit();
}
function listUsers() {
  require "dbconfig.php";
  try {
    $db = new PDO($dsn);
    if($db) {
      $sql = "SELECT userid, username FROM users ORDER BY userid";
      $query = $db->prepare($sql);
      if ($query) {
        $query->execute();
        $rows = $query->fetchAll();
        $db=null;
        return $rows;
      }
    }
    $db=null;
  } catch (PDOException $e) {
    $db=null;
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
  }
  return false;
}
function removeUser($userid, $username) {
  require "dbconfig.php";
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  try {
    $db = new PDO($dsn);
    if($db) {
      $sql = "DELETE FROM users WHERE userid=" . $userid . " AND username='" . $username . "'";
      error_log($sql);
      $query = $db->prepare($sql);
      if ($query) {
        $result = $query->execute();
        if ($result) {
          echo "true";
          $db = null;
          exit();
        }
      }
    }
    $db = null;
  } catch (PDOException $e) {
    $db = null;
    error_log("functions.php :: PDOException :: {$e->getMessage()}");
  }
  echo "false";
  exit();
}
?>