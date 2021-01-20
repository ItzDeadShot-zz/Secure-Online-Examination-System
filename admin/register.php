<?php
include("../dbConnect.php");

if (isset($_POST["submit"])) {

  if (($_POST['password'] !== $_POST['confirm_password'])) {
    $msg = "Password do not match!";
    echo $msg;
  } elseif (($_POST['email'] !== $_POST['confirm_email'])) {
    $msg = "Email do not match!";
    echo $msg;
  } else {
    /* Name. */
    $name = $_POST['name'];;

    /* Password. */
    $password = $_POST['password'];;

    /* Email */
    $email = $_POST['email'];

    $role = "admin";
    /* Secure password hash. */
    $hash = password_hash($password, PASSWORD_DEFAULT);

    /* Insert query template. */
    $query = "INSERT INTO `accounts`( `name`, `password`, `email`, `role`) VALUES (?, ?, ?, ?)";

    /* Execute the query. */
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssss", $name, $hash, $email, $role);
    if ($stmt->execute()) {
      $stmt->close();
      header("location:index.php");
    } else {
      $con->error;
    }
  }
} else {
  $msg = "Weak Password!";
  header("location:signup.php");
}
