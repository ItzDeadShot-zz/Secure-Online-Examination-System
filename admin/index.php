<?php

// Include database file
include 'exam.php';

$examObj = new Exam();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">

    <!-- ===== JS ===== -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <title><?php echo $title; ?></title>
</head>
<div class="row">
	<div class="col-md-4"></div>
		<div class="col-md-4" >
			<div style="display: flex; justify-content: center; align-items: center;padding:2rem;padding-top:20%;">
				<img src="../assets/img/Logo.ico"></img>
			</div>
			<div class="card card-black">
			  <div class="card-header">
				<h3 class="card-title">Log In</h3>
			  </div>
			<!-- form start -->
				  <form class="form-horizontal" action="login.php" method="POST">
					<div class="card-body">
					  <div class="form-group row">
						<div class="col-sm-12">
						  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
						</div>
					  </div>
					  <div class="form-group row">
						<div class="col-sm-12">
						  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
					  </div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
					  <a href="signup.php" class="btn btn-default" value="Login">Sign up</a>
					  <button type="submit" class="btn btn-default float-right">Sign in</button>
					</div>
					<!-- /.card-footer -->
				  </form>
			</div>
		</div>
	<div class="col-md-4"></div>
</div>
<?php
include("_footer.php");
?>


