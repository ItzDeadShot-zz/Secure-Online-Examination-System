<?php

// Include database file
include 'exam.php';

$customerObj = new Exam();

// Delete record from table
if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
  $deleteId = $_GET['deleteId'];
  $customerObj->deleteRecord($deleteId);
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
  </div><br><br>

  <div class="container">
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
              Your Registration updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Record deleted successfully
            </div>";
    }
    ?>

    <h2>View Records
      <a href="add.php" class="btn btn-primary" style="float:right;">Add New Record</a>
    </h2>

    <div class="input-group"> <span class="input-group-addon">Filter</span>
      <input id="filter" type="text" class="form-control" placeholder="Type here...">
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
        $customers = $customerObj->displayData();
        if ($customers != null)
          foreach ($customers as $customer) {
        ?>
          <tr>
            <td><?php echo $customer['course_name'] ?></td>
            <td><?php echo $customer['semester_year'] ?></td>
            <td><?php echo $customer['exam_date'] ?></td>
            <td><?php echo $customer['exam_limit'] ?></td>
            <td>
              <a href="edit.php?editId=<?php echo $customer['exam_id'] ?>" style="color:green">
                <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
              <a href="index.php?deleteId=<?php echo $customer['exam_id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
</body>

</html>


