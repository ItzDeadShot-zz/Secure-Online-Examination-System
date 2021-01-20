<?php
include("dbConnect.php");

if (isset($_POST["submit"])) {

  if (
    empty($_POST['name']) ||
    empty($_POST['password']) ||
    empty($_POST['email'])
  ) {

    die('Please fill all required fields!');
  }

  if (($_POST['password'] !== $_POST['confirm_password']) && ($_POST['email'] !== $_POST['confirm_email'])) {
    die('Password and Confirm password should match!');
  } else {
    /* Name. */
    $name = $_POST['name'];;

    /* Password. */
    $password = $_POST['password'];;

    /* Email */
    $email = $_POST['email'];

    $role = "student";
    /* Secure password hash. */
    $hash = password_hash($password, PASSWORD_DEFAULT);

    /* Insert query template. */
    $query = "INSERT INTO `accounts`( `name`, `password`, `email`, `role`) VALUES (?, ?, ?, ?)";

    /* Execute the query. */
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssss", $name, $hash, $email, $role);
    if ($stmt->execute()) {
      $stmt->close();
      header("location:signup.php");
    } else {
      $con->error;
    }
  }
}
