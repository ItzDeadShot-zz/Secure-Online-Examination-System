<?php

if (!isset($_SESSION)) {
    session_start();
}

// Include database file
include 'exam.php';
$title = "Edit Exam";
$examObj = new Exam();
$semesters = array(
  "201" => "Year 20/21 Semester 1",
  "202" => "Year 20/21 Semester 2",
  "211" => "Year 21/22 Semester 1",
  "212" => "Year 21/22 Semester 2",
  "221" => "Year 22/23 Semester 1",
  "222" => "Year 22/23 Semester 2",
);
// Edit customer record
if (isset($_GET['editId']) && !empty($_GET['editId'])) {
  $editId = $_GET['editId'];
  $exam = $examObj->displyaRecordById($editId);
  $stud = $examObj->getStudents($editId);
}

// Update Record in customer table
if (isset($_POST['update'])) {
  $examObj->updateRecord($_POST);
}
include("_header.php");
include("_navbar.php");
?>
<div class="container" style="padding-top:5rem">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Exam Desciption</h3>
		</div>
		
	    <form method="post" id="load_excel_form" enctype="multipart/form-data" action="">
		
			<div class="card-body">
				<div class="form-group">
					<label for="course_name">Name:</label>
					<input type="text" class="form-control" name="course_name" placeholder="Enter Course Name" value="<?php echo $exam['course_name']; ?>" required="">
				</div>

				<div class="form-group">
					<label for="semester_year">Year/ Semester:</label>
					<select class="form-control" id="semester_year" name="semester_year">
						<?php
							foreach ($semesters as $code => $sem) {
							  if ($exam['semester_year'] == $code)
								echo "<option value='$code' selected> $sem</option>";
							  else
								echo "<option value='$code'> $sem</option>";
							}
						?>
					</select>
				</div>

				<div class="form-group">
					<label for="exam_date">Exam Date:</label>
					<input type="datetime-local" class="form-control" name="exam_date" placeholder="Enter Exam Date" value="<?php echo $exam['custom_date']; ?>" required="">
				</div>

				<div class="form-group">
					<label for="exam_limit">Exam Limit (Minutes):</label>
					<input type="number" class="form-control" name="exam_limit" placeholder="Enter Exam Limit" value="<?php echo $exam['exam_limit']; ?>" required="">
				</div>
				
				<div class="form-group">
				  <input type="hidden" name="id" value="<?php echo $exam['exam_id']; ?>">
				</div>

				<div class="form-group">
					  <label for="exam_limit">Update the Exam File (pdf), current file is "<?php echo $exam['exam_file']; ?>" : </label>
					  <input type="file" class="form-control" name="exam_file" accept=".pdf" value="<?php echo $exam['exam_file']; ?>">
				</div>

				<label for="exam_limit">Select Students (xls, xlsx): </label>
				<table class="table">
					<tr>
						<td width="25%" align="right">Select Excel File</td>
						<td width="50%"><input type="file" name="import_excel" id="import_excel" accept=".xls,.xlsx" /></td>
					</tr>
				</table>

				<div id="excel_area">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Email</th>
							</tr>
						</thead>
						<tbody>
						<?php
						  foreach ($stud as $s) { ?>
							<tr>
								<td><?php echo $s['name']; ?></td>
								<td><?php echo $s['email']; ?></td>
							</tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!--card body end-->
			<div class="card-footer">
				<input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Update">
			</div>
		</form>
	</div>
</div>

<script>
  $(document).ready(function() {
    $('#import_excel').on('change', function(event) {
      event.preventDefault();
      $.ajax({
        url: "upload.php",
        method: "POST",
        data: new FormData(document.getElementById('load_excel_form')),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          console.log(data);
          $('#excel_area').html(data);
          // $('table').css('width', '100%');
          $('table').addClass('table');
          $('table').removeClass('gridlines');
        }
      })
    });
  });
  moment(date).format("YYYY-MM-DDTkk:mm");
</script>
<?php
include("_footer.php");
?>