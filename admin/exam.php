<?php
session_start();
class Exam
{
	private $servername = "localhost";
	private $username   = "root";
	private $password   = "";
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
		$course_name = $this->con->real_escape_string($_POST['course_name']);
		$semester_year = $this->con->real_escape_string($_POST['semester_year']);
		$exam_date = $this->con->real_escape_string($_POST['exam_date']);
		$exam_limit = $this->con->real_escape_string($_POST['exam_limit']);
		echo $exam_date;
		$query = "INSERT INTO exams(course_name,semester_year,exam_date, exam_limit) 
					VALUES('$course_name','$semester_year','$exam_date', '$exam_limit')";
		echo $query;
		$sql = $this->con->query($query);
		if ($sql == true) {
			header("Location:admin.php?msg1=insert");
		} else {
			echo $this->con->error;
		}
	}

	// Fetch exam records for show listing
	public function displayData()
	{
		$query = "SELECT * FROM exams";
		$result = $this->con->query($query);
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
		$query = "SELECT * FROM exams WHERE exam_id = '$id'";
		$result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		} else {
			echo "Record not found";
		}
	}

	// Update exam data into exam table
	public function updateRecord($postData)
	{
		$course_name = $this->con->real_escape_string($_POST['course_name']);
		$semester_year = $this->con->real_escape_string($_POST['semester_year']);
		$exam_date = $this->con->real_escape_string($_POST['exam_date']);
		$exam_limit = $this->con->real_escape_string($_POST['exam_limit']);
		$id = $this->con->real_escape_string($_POST['id']);
		if (!empty($id) && !empty($postData)) {
			$query = "UPDATE exams SET course_name = '$course_name', semester_year = '$semester_year', 
						exam_date = '$exam_date', exam_limit = '$exam_limit' WHERE exam_id = '$id'";
			$sql = $this->con->query($query);
			if ($sql == true) {
				header("Location:admin.php?msg2=update");
			} else {
				$this->con->error;
			}
		}
	}


	// Delete exam data from exam table
	public function deleteRecord($id)
	{
		$query = "DELETE FROM exams WHERE exam_id = '$id'";
		$sql = $this->con->query($query);
		if ($sql == true) {
			header("Location:admin.php?msg3=delete");
		} else {
			echo "Record does not delete try again";
		}
	}
}
?>