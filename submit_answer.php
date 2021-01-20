<?php

include("student_exam.php");
$studExamObj = new StudentExam();
// include("_header.php");

if (isset($_POST["submitted"])) {
    $exams = $studExamObj->insertData($_POST, $_SESSION["id"]);
}

include("_header.php");
?>

<div id="viewHeight">
    <div class="row">
        <div class="col">
            <h2>You Exam Answers has been submitted, back to <a href="dash.php">dashboard!</a></h2>
        </div>
    </div>
</div>
</div>
<?php
include("_footer.php");
?>