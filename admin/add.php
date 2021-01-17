<?php

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

<?php
if (isset($_POST["next"])) {
?>
  <div class="container">
    <form action="add.php" method="POST">
    <?php  
    for($i = 1; $i <= $_POST["num_of_questions"]; ++$i) {
      ?>
      <div class="form-group">
        <label for="course_name">Enter Question Number <?php echo $i;?>:</label>
        <input type="text" class="form-control" name="question<?php echo $i;?>" placeholder="Enter Question" required="">
      </div>
      <?php  
    }
      ?>
      <input type="hidden" name="course_name" value="<?php echo $_POST['course_name'];?>">
      <input type="hidden" name="semester_year" value="<?php echo $_POST['semester_year'];?>">
      <input type="hidden" name="num_of_questions" value="<?php echo $_POST['num_of_questions'];?>">
      <input type="hidden" name="exam_date" value="<?php echo $_POST['exam_date'];?>">
      <input type="hidden" name="exam_limit" value="<?php echo $_POST['exam_limit'];?>">
      <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Next">
    </form>

    <a href="add.php"><button type="button" name="previous" class="btn btn-primary" style="float:left;">Previous</button></a>
  </div>

<?php
} else {
?>
  <div class="container">
    <form action="" method="POST">
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
        <label for="num_of_questions">Number of Questions:</label>
        <input type="number" class="form-control" name="num_of_questions" placeholder="Enter number of questions" required="">
      </div>
      <div class="form-group">
        <label for="exam_date">Exam Date:</label>
        <input type="date" class="form-control" name="exam_date" placeholder="Enter Exam Date" required="">
      </div>
      <div class="form-group">
        <label for="exam_limit">Exam Limit (Minutes):</label>
        <input type="number" class="form-control" name="exam_limit" placeholder="Enter Exam Limit" required="">
      </div>
      <input type="submit" name="next" class="btn btn-primary" style="float:right;" value="Next">
    </form>
  </div>
<?php

}
?>
<?php
include("_footer.php");
?>