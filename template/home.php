<div id="idMainHead" class="container">
  <?php
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    echo "<h1>Welcome, " . $_SESSION["user"]["displayname"] . "</h1>";
  ?>
</div>
<div id="idMainDiv" class="container-fluid">
  <a class="btn btn-primary" href="/resources/files/server.zip">server.zip</a>
</div>