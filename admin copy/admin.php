<?php
    include "dbConnect.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>SEOE</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SEOE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Exam List</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    Welcome to the fucking website admin.
    <div class="content read">
	<h2>Read Contacts</h2>
	<a href="create.php" class="create-contact">Create Contact</a>
  <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>Course</td>
                <td>Course Name</td>
                <td>Session</td>
                <td>Exam Date</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $con->prepare('SELECT * from exams');
            $stmt->execute();
            $results = $stmt->get_result();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
                <td><?=$row['exam_id']?></td>
                <td><?=$row['course_code']?></td>
                <td><?=$row['course_name']?></td>
                <td><?=$row['semester_year']?></td>
                <td><?=$row['exam_date']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$row['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$row['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php
              }
            ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>
</div>
<!-- JavaScripts -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/jquery-3.5.1.min.js"></script>
</body>
</html>