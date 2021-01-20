<?php

include("student_exam.php");
$studExamObj = new StudentExam();
// include("_header.php");

if(isset($_POST["submitted"])) {
    $exams = $studExamObj->insertData($_POST, $_SESSION["id"]);
}


echo "hello to the other side!!";
?>


<?php
 include("_footer.php");
?>