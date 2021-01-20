<?php
if (!isset($_SESSION)) {
    session_start();
}
include "_header.php";
include "_navbar.php";
include 'exam.php';
$title = "Admin";
$examObj = new Exam();

// Delete record from table
if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
  $deleteId = $_GET['deleteId'];
  $examObj->deleteRecord($deleteId);
}
?>

<div class="container" style="padding-top:5rem">
    <?php
    if (isset($_GET['msg1']) == "insert") {
        echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Exam Added Successfully!
            </div>";
    }
    if (isset($_GET['msg2']) == "update") {
        echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Exam Updated Successfully!
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
        echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Exam Deleted Successfully!
            </div>";
    }
    ?>

    <h2>View Exams
        <a href="add.php" class="btn btn-primary" style="float:right;">Add New Record</a>
    </h2>

    <div class="input-group" style="padding-bottom:1rem;">
		<span class="input-group-addon" style="align-self:center;padding-right:1rem;">Filter</span>
        <input id="filter" style="border-radius: 5px;" type="text" class="form-control" placeholder="Type here...">
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Course</th>
                <th>Semester</th>
                <th>Date</th>
                <th>Time Limit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="searchable">
            <tr class="no-data" style="display: none;text-align: center;">
                <td colspan="4">No data</td>
            </tr>
            <?php
            $exams = $examObj->displayData();
            if ($exams != null)
                foreach ($exams as $exam) {
            ?>
                <tr>
                    <td><?php echo $exam['course_name'] ?></td>
                    <td><?php echo $exam['semester_year'] ?></td>
                    <td><?php echo $exam['exam_date'] ?></td>
                    <td><?php echo $exam['exam_limit'] ?></td>
                    <td>
                        <a href="edit.php?editId=<?php echo $exam['exam_id'] ?>" style="color:green">
                        <button type="button" class="btn btn-primary">Update</button>
                            <!--<i class="fa fa-pencil" aria-hidden="true"></i>--></a>&nbsp 
                        <a href="admin.php?deleteId=<?php echo $exam['exam_id'] ?>" style="color:red" onclick="confirm('Are you sure you want to delete this exam?')">
                        <button type="button" class="btn btn-primary">Delete</button>
                            <!--<i class="fa fa-trash" aria-hidden="true">--></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- JavaScripts -->
<script>
    $(document).ready(function() {
        (function($) {
            $('#filter').keyup(function() {
                var rex = new RegExp($(this).val(), 'i');
                $('.searchable tr').hide();
                $('.searchable tr').filter(function() {
                    return rex.test($(this).text());
                }).show();
                $('.no-data').hide();
                if ($('.searchable tr:visible').length == 0) {
                    $('.no-data').show();
                }

            })

        }(jQuery));

    });
</script>
<?php
include("_footer.php");
?>