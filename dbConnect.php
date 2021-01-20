<?php
if (!isset($_SESSION)) {
	session_start();
}
$host = "localhost";
$username = "root";
$password = "Cmt322Root";
$db = "examination-system";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con = new mysqli($host, $username, $password, $db);
if ($con == false) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
