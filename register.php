<?php
include("dbConnect.php");

if (isset($_POST["submit"])) {
  /* Name. */
  $name = $_POST['name'];;

  /* Password. */
  $password = $_POST['password'];;

  /* Email */
  $email = $_POST['email'];

  /* Secure password hash. */
  $hash = password_hash($password, PASSWORD_DEFAULT);

  /* Insert query template. */
  $query = "INSERT INTO `accounts`( `name`, `password`, `email`) VALUES (?, ?, ?)";

  /* Execute the query. */
  $stmt = $con->prepare($query);
  $stmt->bind_param("sss", $name, $hash, $email);
  if ($stmt->execute()) {
    $stmt->close();
    header("location:signup.php");
  } else {
    $con->error;
  }
}
