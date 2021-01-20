<?php
if (!isset($_SESSION)) {
  session_start();
}

include '../vendor/autoload.php';

class Exam
{
  private $servername = "localhost";
  private $username   = "root";
  private $password   = "Cmt322Root";
  private $database   = "examination-system";
  public  $con;


  // Database Connection 
  public function __construct()
  {
    $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
    if (mysqli_connect_error()) {
      trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
      return $this->con;
    }
  }

  // Insert exam data into exam table
  public function insertData($post)
  {
    $fileExistsFlag = 0;
    $course_name = $this->con->real_escape_string($_POST['course_name']);
    $semester_year = $this->con->real_escape_string($_POST['semester_year']);
    $exam_date = $this->con->real_escape_string($_POST['exam_date']);
    $exam_limit = $this->con->real_escape_string($_POST['exam_limit']);

    $exam_file_name = $_FILES["exam_file"]["name"];

    $examQuery = "INSERT INTO exams(course_name,semester_year,exam_date, exam_limit, exam_file) VALUES(?, ?, ?, ?, ?)";
    $examStmt = $this->con->prepare($examQuery);
    $examStmt->bind_param("sisis", $course_name, $semester_year, $exam_date, $exam_limit, $exam_file_name);

    $fileQuery = "SELECT exam_file FROM exams WHERE exam_file=?";
    $filestmt = $this->con->prepare($fileQuery);
    $filestmt->bind_param("s", $exam_file_name);

    $filestmt->execute();
    $result = $filestmt->get_result();
    if ($row = $result->fetch_assoc()) {
      if ($row['exam_file'] == $exam_file_name) {
        $fileExistsFlag = 1;
      }
    }

    if ($fileExistsFlag == 0) {
      $target = "../uploads/";
      $fileTarget = $target . $exam_file_name;
      $tempFileName = $_FILES["exam_file"]["tmp_name"];
      $result = move_uploaded_file($tempFileName, $fileTarget);
      /*
			*	If file was successfully uploaded in the destination folder
			*/
      if ($result) {
        echo "Your file <html><b><i>" . $exam_file_name . "</i></b></html> has been successfully uploaded";
        if ($examStmt->execute()) {
          $exam_id = $examStmt->insert_id;
          $examStmt->close();
          $filestmt->close();
          // if ($status) header("Location:admin.php?msg1=insert");
        } else {
          echo $this->con->error;
        }

        if ($_FILES["import_excel"]["name"] != '') {
          $allowed_extension = array('xls', 'csv', 'xlsx');
          $file_array = explode(".", $_FILES["import_excel"]["name"]);
          $file_extension = end($file_array);

          if (in_array($file_extension, $allowed_extension)) {
            $file_name = time() . '.' . $file_extension;
            move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
            $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

            $spreadsheet = $reader->load($file_name);

            unlink($file_name);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $data = $sheet->rangeToArray(
              'A2:' . $highestColumn . $highestRow,
              NULL,
              TRUE,
              FALSE
            );

            foreach ($data as $row) {
              $query = "INSERT INTO `students`(`name`, `email`, `exam_id`) VALUES (?, ?, ?)";

              $statement = $this->con->prepare($query);
              $statement->bind_param("ssi", $row[0], $row[1], $exam_id);
              $statement->execute();
            }
            $message = '<div class="alert alert-success">Data Imported Successfully</div>';
          } else {
            $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
          }
        } else {
          $message = '<div class="alert alert-danger">Please Select File</div>';
        }
      } else {
        echo "Sorry !!! There was an error in uploading your file";
      }
    }
    /*
		* 	If file is already present in the destination folder
		*/ else {
      echo "File <html><b><i>" . $exam_file_name . "</i></b></html> already exists in your folder. Please rename the file and try again.";
    }
    header("location:admin.php?msg=insert");
  }

  // Fetch exam records for show listing
  public function displayData()
  {
    $query = "SELECT * FROM exams";
    $stmt = $this->con->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    } else {
      return null;
    }
  }

  // Fetch single data for edit from exam table
  public function displyaRecordById($id)
  {
    $query = "SELECT *, DATE_FORMAT(exam_date, '%Y-%m-%dT%H:%i') as custom_date FROM exams WHERE exam_id = ?";
    $stmt = $this->con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row;
    } else {
      echo "Record not found";
    }
  }

  // Fetch single data for edit from exam table
  public function getStudents($id)
  {
    $query = "SELECT * FROM students WHERE exam_id=?";
    $stmt = $this->con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    } else {
      return $this->con->error;
    }
  }

  // Update customer data into customer table
  public function updateRecord($postData)
  {
    $status = true;
    $course_name = $this->con->real_escape_string($_POST['course_name']);
    $semester_year = $this->con->real_escape_string($_POST['semester_year']);
    $exam_date = $this->con->real_escape_string($_POST['exam_date']);
    $exam_limit = $this->con->real_escape_string($_POST['exam_limit']);
    $exam_file_name = $_FILES["exam_file"]["name"];
    $id = $this->con->real_escape_string($_POST['id']);

    $query = "SELECT * FROM exams WHERE exam_id = ?";
    $stmt = $this->con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    }

    if (!empty($id) && !empty($postData)) {
      if ($exam_file_name) {
        $target = "../uploads/";
        $fileTarget = $target . $exam_file_name;
        $tempFileName = $_FILES["exam_file"]["tmp_name"];
        unlink($fileTarget);
        $result = move_uploaded_file($tempFileName, $fileTarget);
      } else {
        $exam_file_name = $row["exam_file"];
      }

      $examUpdateQuery = "UPDATE exams SET course_name = ?, semester_year = ?, exam_date = ?, exam_limit = ?, exam_file = ? WHERE exam_id = ?";
      $examUpdateStmt = $this->con->prepare($examUpdateQuery);
      $examUpdateStmt->bind_param("sisisi", $course_name, $semester_year, $exam_date, $exam_limit, $exam_file_name, $id);

      if ($examUpdateStmt->execute()) {
        $examUpdateStmt->close();
        if ($_FILES["import_excel"]["name"] != '') {
          $allowed_extension = array('xls', 'csv', 'xlsx');
          $file_array = explode(".", $_FILES["import_excel"]["name"]);
          $file_extension = end($file_array);

          if (in_array($file_extension, $allowed_extension)) {
            $file_name = time() . '.' . $file_extension;
            move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
            $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

            $spreadsheet = $reader->load($file_name);

            unlink($file_name);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $data = $sheet->rangeToArray(
              'A2:' . $highestColumn . $highestRow,
              NULL,
              TRUE,
              FALSE
            );

            $studQuery = "DELETE FROM students WHERE exam_id = ?";
            $studStmt = $this->con->prepare($studQuery);
            $studStmt->bind_param("i", $id);
            if ($studStmt->execute()) {
              $studStmt->close();
              foreach ($data as $row) {
                $query = "INSERT INTO `students`(`name`, `email`, `exam_id`) VALUES (?, ?, ?, ?)";
                $statement = $this->con->prepare($query);
                $statement->bind_param("ssi", $row[0], $row[1], $id);
                $statement->execute();
                $statement->close();
              }
            } else {
              $this->con->error;
            }
            $message = '<div class="alert alert-success">Data Imported Successfully</div>';
          } else {
            $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
          }
        } else {
          $message = '<div class="alert alert-danger">Please Select File</div>';
        }
      } else {
        echo $this->con->error;
      }
    }
    header("location:admin.php?msg=update");
  }


  // Delete exam data from exam table
  public function deleteRecord($id)
  {
    $file_name = "";
    $exam_file_Query = "SELECT exam_file FROM exams WHERE exam_id = ?";
    $exam_file_stmt = $this->con->prepare($exam_file_Query);
    $exam_file_stmt->bind_param("i", $id);
    $exam_file_stmt->execute();
    $result = $exam_file_stmt->get_result();
    if ($row = $result->fetch_assoc()) {
      $file_name = $row["exam_file"];
    } else {
      echo "error";
    }
    $examQuery = "DELETE FROM exams WHERE exam_id = ?";
    $examStmt = $this->con->prepare($examQuery);
    $examStmt->bind_param("i", $id);
    if ($examStmt->execute() && unlink('../uploads/' . $file_name)) {
      header("Location:admin.php?msg3=delete");
    } else {
      $this->con->error;
    }
  }
}
