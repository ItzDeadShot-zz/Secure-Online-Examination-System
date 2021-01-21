<?php
include("student_exam.php");
$title = "SEOE";
include("_header.php");

$studExamObj = new StudentExam();
$exams = $studExamObj->displyaRecordById($_SESSION["email"]);
// include("_navbar.php");
?>

<div style="padding-top: 5rem;">
	<form action="take_exam.php" method="POST">
	<div class="row">
		<div class="col-6">
			<!--Today Card-->
			<div class="cards" style="margin-bottom: 2rem;">
				<div class="card-title"><b>Exam</b></div>

				<!--Course Card-->
				<?php
				if ($exams == null) {
					echo "<br><br><br><p>No exam for now</p>";
				} else {
					foreach ($exams as $exam) {
				?>
						<div class="card-first">
							<div>
								<h4><?php echo $exam["course_name"]; ?></h4>
							</div>
							<div>
								<h5>Exam</h5>
								<span><?php echo $exam['exam_date']; ?></span>
								<?php
								if (strtotime((new DateTime())->format("d-m-Y H:i:s")) < strtotime($exam['exam_date'])) { ?>
									<button type="submit" class="btn btn-outline-light float-right" style="margin-top:1rem;" name="submit">Enter</button>
									<input type="hidden" name="exam_id" id="exam_id" value="<?php echo $exam['exam_id']; ?>">
								<?php } else { ?>
									<button type="submit" class="btn btn-outline-light float-right" style="margin-top:1rem;" name="Disabled" disabled="disabled">Enter</button>
								<?php
								}
								?>
							</div>
						</div>
				<?php
					}
				}
				?>
				<!--Course Card End-->

			</div>
			<!--Today Card End-->

		</div>
	</div>
	</form>
	
</div>

<?php
include("_footer.php");
?>