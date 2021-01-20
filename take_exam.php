<?php
include("student_exam.php");
$title = "SEOE";
include("_header.php");

$studExamObj = new StudentExam();
if (isset($_POST['submit']) && !empty($_POST['exam_id'])) {
    $exam = $studExamObj->getExamInfo($_POST['exam_id']);
}

echo $exam["exam_limit"];
// include("_navbar.php");
?>

<input type="hidden" value="<?php echo $exam["exam_limit"]; ?>" id="time_limit">
<div class="container-fluid" style="position: relative;">
    <form action="submit_answer.php" method="POST" id="Questions">
        <div class="row" style="padding-top: 10%;">
            <div class="col-6">
                <iframe src="uploads/<?php echo $exam["exam_file"]; ?>" width="100%" height="100%"></iframe>
            </div>
            <div class="col-6">
                <label for="answer">Enter your answer here:</label>
                <textarea rows="8" cols="8" name="answer" class="form-control" id="answer" placeholder="Write your answer here..." required></textarea>
            </div>
            <div class="col-6">
                <div id="time">

                </div>
            </div>
            <div class="col-6">
                <input name="submitted" type="submit" class="btn btn-primary" value="Submit Answers" onsubmit="sessionStorage.clear();" />
            </div>

        </div>
    </form>
</div>

<script type="text/javascript">
    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        var interVal = setInterval(function() {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.innerHTML = "<h3>" + minutes + " " + " " + seconds + "</h3>";

            if (--timer < 0) {
                clearInterval(interVal)
                SubmitFunction();
            }

            window.sessionStorage.setItem("seconds", seconds)
            window.sessionStorage.setItem("minutes", minutes)
        }, 1000);
    }

    window.onload = function() {
        sec = parseInt(window.sessionStorage.getItem("seconds"))
        min = parseInt(window.sessionStorage.getItem("minutes"))

        if (parseInt(min * sec)) {
            var time = (parseInt(min * 60) + sec);
        } else {
            var time = 60 * document.getElementById("time_limit").value;
        }
        // var time = 3;
        display = document.querySelector('#time');
        startTimer(time, display);
    };

    function SubmitFunction() {
        document.getElementById('Questions').submit();

    }
</script>
<?php
include("_footer.php");
?>