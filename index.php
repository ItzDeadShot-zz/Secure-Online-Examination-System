<?php
include("dbConnect.php");
$title = "SEOE";
include("_header.php");
include("_navbar.php");
?>

<div class="row">
	<div class="col-md-4"></div>
		<div class="col-md-4" >
			<div style="display: flex; justify-content: center; align-items: center;padding:2rem;padding-top:20%;">
				<img src="assets/img/Logo.ico"></img>
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
					  <button type="submit" class="btn btn-black" value="Login">Sign in</button>
					  <button type="submit" class="btn btn-default float-right">Cancel</button>
					</div>
					<!-- /.card-footer -->
				  </form>
			</div>
		</div>
	<div class="col-md-4"></div>
</div>
<?php
include("popup.php");
?>
<?php
include("_footer.php");
?>