<?php
include("student_exam.php");
$title = "SEOE";
include("_header.php");

$studExamObj = new StudentExam();
$exams = $studExamObj->displyaRecordById($_SESSION["email"]);
// include("_navbar.php");
?>

<div class="container">
    <div class="row">
        <div class="col-4">
            <?php
            if (count($exams) < 0) {
                echo "<br><br><br><p>No exam for now</p>";
            } else {
                foreach ($exams as $exam) {
            ?>
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="assets/img/Logo.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $exam["course_name"]; ?></h5>
                            <p class="card-text">Start time: <?php echo strtotime($exam["exam_date"]); ?></p>
                            <p class="card-text">Start time: <?php echo time(); ?></p>
                            <?php
                            if (strtotime((new DateTime())->format("Y-m-d H:i:s")) > strtotime($row['exam_date'])) { ?>
                                <input name="Enabled" type="button" value="Enabled" class="btn btn-primary" onclick="location.href='../edit.php'" />
                            <?php } else { ?>
                                <input name="Disabled" type="button" class="btn btn-primary" disabled="disabled" value="Disabled" />
                            <?php
                            }
                            ?>

                        </div>
                <?php
                }
            }
                ?>

                    </div>
        </div>
    </div>

</div>

<?php
include("_footer.php");
?>