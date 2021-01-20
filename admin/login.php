<?php
if (!isset($_SESSION)) {
    session_start();
}

include("../dbConnect.php");

if ( !isset($_POST['email'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

$role = 'admin';
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare("SELECT id, password FROM accounts WHERE email = ? and role = ?")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('ss', $_POST['email'], $role);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $pass);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $pass)) {
        //if ( $_POST['password'] === $pass) {
           
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['id'] = $id;
            $_SESSION['role'] = 'admin';

            header('location: admin.php');
        } else {
            // Incorrect password
            $_SESSION['errors'] = "Your username or password was incorrect.";
        }
    } else {
        // Incorrect username
        $_SESSION['errors'] = "Your username or password was incorrect.";
    }
    $stmt->close();
}
