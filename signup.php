<?php
include("dbConnect.php");
$title = "SEOE";
include("_header.php");
include("_navbar.php");
?>

<div class="row">
	<div class="col-md-4"></div>
		<div class="col-md-4" >
			<div style="display: flex; justify-content: center; align-items: center;padding:2rem;padding-top:30%;">
				<img src="assets/img/Logo.ico"></img>
			</div>
			<div class="card card-black">
			  <div class="card-header">
				<h3 class="card-title">Sign Up</h3>
			  </div>
			<!-- form start -->
				  <form class="form-horizontal" action="register.php" method="POST">
					<div class="card-body">
					  <div class="form-group row">
						<div class="col-sm-12">
						  <input type="name" class="form-control" id="name" name="name" placeholder="Name" required>
						</div>
					  </div>
					  
                      <div class="form-group row">
						<div class="col-sm-12">
						  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
						</div>
					  </div>
					  
					  <div class="form-group row">
						<div class="col-sm-12">
						  <input type="email" class="form-control" id="email" name="confirm_email" placeholder="Confirm Email" required>
						</div>
					  </div>

					  <div class="form-group row">
						<div class="col-sm-12">
						  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						</div>
					  </div>
					  
					  <div class="form-group row">
						<div class="col-sm-12">
						  <input type="password" class="form-control" id="password" name="confirm_password" placeholder="Confirm Password" required>
						</div>
					  </div>

					</div>
					<!-- /.card-body -->
					<div class="card-footer">
					  <button type="submit" class="btn btn-default" name ="submit"value="Login">Sign up</button>
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