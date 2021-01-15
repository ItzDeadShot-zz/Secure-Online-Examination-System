<?php
include("dbConnect.php");
$title = "SEOE";
include("_header.php");
include("_navbar.php");
?>

<div class="container" style="padding-top: 10%;">
  <form action="login.php" method="POST">
    <div class="row">
      <div class="col-6">
        <label for="email">Email: </label>
      </div>
      <div class="col-6">
        <input type="email" name="email" id="email">
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <label for="password">Password: </label>
      </div>
      <div class="col-6">
        <input type="password" name="password" id="password">
      </div>
    </div>
    <input type="submit" value="Login">
  </form>
</div>


<?php
include("_footer.php");
?>