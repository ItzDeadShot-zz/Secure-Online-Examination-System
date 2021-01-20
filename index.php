<?php
include("dbConnect.php");
$title = "SOES";
 
if(isset($_GET['lmsg']) && $_GET['lmsg'] == true)
{
	$errorMsg = "Login required to access dashboard";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/adminlte.min.css">

    <!-- ===== JS ===== -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <title><?php echo $title; ?></title>
</head>
<body>
	<div class="row">
		<div class="col-md-6" id="viewHeight">
			<figure>
				<img src="assets/img/Logo.ico" style="display:block"></img>
				<figcaption class="fs-4" style="text-align:center;padding-top:2rem">Secure Online <br>Examination System</figcaption>
			</figure>
		</div>		
			
		<div class="col-md-6" id="viewHeight2">
			<div style="width:60%;">
				<div>
					<h3>Log In</h3>
				</div>
				<!-- form start -->
				<form action="login.php" method="POST">
					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password">
					</div>
					<div style=" position: relative;">
						<button type="submit" class="btn btn-success" style="border-radius:20px" >Sign in</button>
						<a href="signup.php" class="btn btn-outline-primary float-right" style="border-radius:20px" value="Login">Sign up</a>	  
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
include("_footer.php");
?>