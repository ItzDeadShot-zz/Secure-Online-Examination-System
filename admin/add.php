<?php
if (!isset($_SESSION)) {
    session_start();
}
// Include database file
include 'exam.php';

$customerObj = new Exam();

// Insert Record in customer table
if (isset($_POST['submit'])) {
  $customerObj->insertData($_POST);
}

$semesters = array(
  "201" => "Year 20/21 Semester 1",
  "202" => "Year 20/21 Semester 2",
  "211" => "Year 21/22 Semester 1",
  "212" => "Year 21/22 Semester 2",
  "221" => "Year 22/23 Semester 1",
  "222" => "Year 22/23 Semester 2",
);

include("_header.php");
include("_navbar.php");
?>

<br><br>

<div class="container" style="padding-top:3rem">
	<div class="card card-primary">
	  <div class="card-header">
		<h3 class="card-title">Add</h3>
	  </div>
		  <form method="post" id="load_excel_form" enctype="multipart/form-data" action="">
		  
		  <div class="card-body">
		  
			<div class="form-group">
			  <label for="course_name">Name:</label>
			  <input type="text" class="form-control" name="course_name" placeholder="Enter Course Name" required="">
			</div>
			<div class="form-group">
			  <label for="semester_year">Year/ Semester:</label>
			  <select class="form-control" id="semester_year" name="semester_year">
				<option selected>Select Year/Semester</option>
				<?php
				foreach ($semesters as $code => $sem) {
				  echo "<option value='$code'> $sem</option>";
				}
				?>
			  </select>
			</div>
			<div class="form-group">
			  <label for="exam_date">Exam Date:</label>
			  <input type="datetime-local" class="form-control" name="exam_date" placeholder="Enter Exam Date" required="">
			</div>

			<div class="form-group">
			  <label for="exam_limit">Exam Limit (Minutes):</label>
			  <input type="number" class="form-control" name="exam_limit" placeholder="Enter Exam Limit" required="">
			</div>

			<div class="form-group">
			  <label for="exam_limit">Select Exam File (pdf): </label>
			  <input type="file" class="form-control" name="exam_file" accept=".pdf" required="">
			</div>

			<label for="exam_limit">Select Students (xls, xlsx): </label>
			<table class="table">
			  <tr>
				<td width="25%" align="right">Select Excel File</td>
				<td width="50%"><input type="file" name="import_excel" id="import_excel" accept=".xls,.xlsx" required/></td>
			  </tr>
			</table>

			<div id="excel_area"></div>
			
			<div class="card-footer">
				<input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
			</div>
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
</script>
<?php
include("_footer.php");
?>