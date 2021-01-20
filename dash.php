<?php
include("student_exam.php");
$title = "SEOE";
include("_header.php");

$studExamObj = new StudentExam();
$exams = $studExamObj->displyaRecordById($_SESSION["email"]);
// include("_navbar.php");
?>

<div style="padding-top: 5rem;">
	<div class="row">
		<div class="col-6">
			<!--Today Card-->
			<div class="cards" style="margin-bottom: 2rem;">
				<div class="card-title"><b>Today</b></div>
				
				<!--Course Card-->
				<div class="card-first">
					<div>
						<h4>CMT222</h4>
						<span>SYSTEM ANALYSIS&DESIGN</span>
					</div>
					<div>
						<h5>Test 1</h5>
						<span>2.00pm - 4.00pm</span>
						<div><button type="button" class="btn btn-outline-light float-right"style="margin-top:1rem;">Enter</button></div>
					</div>
				</div>
				<!--Course Card End-->
				
			</div>
			<!--Today Card End-->
			
			<!--Upcoming Card-->
			<div class="cards">
				<div class="card-title"><b>Upcoming</b></div>
				
				<!--Course Card-->
				<div class="card-second">
					<div>
						<h4>CMT222</h4>
						<span>SYSTEM ANALYSIS&DESIGN</span>
					</div>
					<div>
						<h5>Test 1</h5>
						<span>2.00pm - 4.00pm</span><br>
						<span><b>17th March 2020</b></span>
					</div>
				</div>
				<!--Course Card End-->
				
			</div>
			<!--Upcoming Card End-->
		</div>
	</div>
</div>

<?php
include("_footer.php");
?>