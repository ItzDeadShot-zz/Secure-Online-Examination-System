<?php

// Include database file
include 'exam.php';

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
}

// Update Record in customer table
if (isset($_POST['update'])) {
  $examObj->updateRecord($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
</head>

<body>

  <div class="card text-center" style="padding:15px;">
    <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
  </div><br>

  <div class="container">
    <form action="edit.php" method="POST">
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
        <input type="date" class="form-control" name="exam_date" placeholder="Enter Exam Date" value="<?php echo $exam['exam_date']; ?>" required="">
      </div>

      <div class="form-group">
        <label for="exam_limit">Exam Limit (Minutes):</label>
        <input type="number" class="form-control" name="exam_limit" placeholder="Enter Exam Limit" value="<?php echo $exam['exam_limit']; ?>" required="">
      </div>
      <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $exam['exam_id']; ?>">

        <input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Update">
      </div>

  </div>

  </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>