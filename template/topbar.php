<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/">
    <img src="/img/logo.svg" width="30" height="30" alt=""/>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
      $uri = $_SERVER["REQUEST_URI"];
      $home = "";
      $userman = "";
      $myprofile = "";
      echo "<ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">";
      if(substr($uri, 0, strlen("/login.php"))=="/login.php") {
        echo "<li class=\"nav-item active\">
                <a class=\"nav-link\" href=\"/login.php\">
                    Login
                </a>
              </li>";
      } elseif(isset($_SESSION["user"])) {
        if($uri == '/' or substr($uri, 0, strlen("/index.php"))=="/index.php") {
          $home = " active";
        } elseif(substr($uri, 0, strlen("/userman")) == "/userman") {
          $userman = " active";
        } elseif(substr($uri, 0, strlen("/myprofile")) == "/myprofile") {
          $myprofile = " active";
        }
        echo "<li class=\"nav-item" . $home . "\">
                <a class=\"nav-link\" href=\"/\">
                  Home
                  <span class=\"sr-only\">(current)</span>
                </a>
              </li>";
        if($_SESSION["user"]["role"]=="admin") {
          echo "<li class=\"nav-item dropdown" . $userman . "\">
                  <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"idUsersDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    Users
                  </a>
                  <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                    <a class=\"dropdown-item\" href=\"/userman/useradd.php\">Add User</a>
                    <a class=\"dropdown-item\" href=\"/userman/userrem.php\">Remove User</a>
                    <a class=\"dropdown-item\" href=\"/userman/usermod.php\">Modify User</a>
                  </div>
                </li>";
        }
        echo "<li class=\"nav-item\">
                <a class=\"nav-link\" href=\"javascript:logout()\">Logout</a>
              </li>";
      }
      echo "</ul>";
      if(isset($_SESSION["user"])) {
        echo "<ul class=\"nav navbar-nav navbar-right navbar-dark\">
                <li>
                  <a class=\"nav-link" . $myprofile . "\" href=\"/myprofile.php\">" .
                    $_SESSION["user"]["displayname"] .
             "    </a>
                </li>
              </ul>";
      }
    ?>
  </div>
</nav>
