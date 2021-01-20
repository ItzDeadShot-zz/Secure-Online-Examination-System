<?php
include("student_exam.php");
$title = "SEOE";
include("_header.php");

$studExamObj = new StudentExam();
$exams = $studExamObj->displyaRecordById($_SESSION["email"]);
?>

<div class="container">
    <form action="take_exam.php" method="POST">
        <div class="row">
            <div class="col-4">
                <?php
                if ($exams == null) {
                    echo "<br><br><br><p>No exam for now</p>";
                } else {
                    foreach ($exams as $exam) {
                ?>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="assets/img/Logo.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $exam["course_name"]; ?></h5>
                                <p class="card-text">Start time: <?php echo strtotime($exam['exam_date']); ?></p>
                                <p class="card-text">Current time: <?php echo time(); ?></p>
                                <?php
                                if (strtotime((new DateTime())->format("d-m-Y H:i:s")) < strtotime($exam['exam_date'])) { ?>
                                    <input type="submit" name="submit"
                                    class="btn btn-primary" />
                                    <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $exam['exam_id']; ?>">
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
    </form>

</div>

<?php
include("_footer.php");
?>