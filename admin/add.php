<?php

  // Include database file
  include 'exam.php';

  $customerObj = new Exam();

  // Insert Record in customer table
  if(isset($_POST['submit'])) {
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

<div class="container">
  <form action="add.php" method="POST">
    <div class="form-group">
      <label for="course_name">Name:</label>
      <input type="text" class="form-control" name="course_name" placeholder="Enter Course Name" required="">
    </div>
    <div class="form-group">
      <label for="semester_year">Year/ Semester:</label>
      <select class="form-control" id="semester_year" name="semester_year">
      <option selected>Select Year/Semester</option>
      <?php
        foreach($semesters as $code => $sem) {
          echo "<option value='$code'> $sem</option>";
        }
      ?>
      </select>
    </div>
    <div class="form-group">
      <label for="exam_date">Exam Date:</label>
      <input type="date" class="form-control" name="exam_date" placeholder="Enter Exam Date" required="">
    </div>
    <div class="form-group">
      <label for="exam_limit">Exam Limit (Minutes):</label>
      <input type="number" class="form-control" name="exam_limit" placeholder="Enter Exam Limit" required="">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>

<?php
  include("_footer.php");
?>
