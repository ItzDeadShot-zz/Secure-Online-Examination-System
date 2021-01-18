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
		$status = true;
		$course_name = $this->con->real_escape_string($_POST['course_name']);
		$semester_year = $this->con->real_escape_string($_POST['semester_year']);
		$exam_date = $this->con->real_escape_string($_POST['exam_date']);
		$exam_limit = $this->con->real_escape_string($_POST['exam_limit']);
		$query = "INSERT INTO exams(course_name,semester_year,exam_date, exam_limit) VALUES(?, ?, ?, ?)";
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("sisi", $course_name, $semester_year, $exam_date, $exam_limit);
		if ($stmt->execute()) {
			$exam_id = $this->con->insert_id;
			$stmt->close();
			for ($i = 1; $i <= $_POST["num_of_questions"]; $i++) {
				$question = $this->con->real_escape_string($_POST["question" . $i]);
				$query = "INSERT INTO questions(question, exam_id) VALUES(?, ?)";
				$stmt = $this->con->prepare($query);
				$stmt->bind_param("si", $question, $exam_id);
				if ($stmt->execute()) {
					$stmt->close();
				} else {
					$status = false;
					echo $this->con->error;
				}
			}
			if ($status) header("Location:admin.php?msg1=insert");
		} else {
			echo $this->con->error;
		}
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
		$query = "SELECT * FROM exams WHERE exam_id=?";
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

	// Fetch single data for edit from customer table
	public function getQuestions($id)
	{
		$query = "SELECT * FROM questions WHERE exam_id = ?";
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
			echo "Record not found";
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
		$id = $this->con->real_escape_string($_POST['id']);
		if (!empty($id) && !empty($postData)) {

			$examUpdateQuery = "UPDATE exams SET course_name = ?, semester_year = ?, exam_date = ?, exam_limit = ? WHERE exam_id = ?";
			$examUpdateStmt = $this->con->prepare($examUpdateQuery);
			$examUpdateStmt->bind_param("sisii", $course_name, $semester_year, $exam_date, $exam_limit, $id);


			if ($examUpdateStmt->execute()) {
				$examUpdateStmt->close();
				for ($i = 1; $i <= $_POST["num_of_questions"]; $i++) {
					$question = $this->con->real_escape_string($_POST["question" . $i]);
					$ques_id = $this->con->real_escape_string($_POST["ques". $i ."_id" ]);
					echo $ques_id . "<br>";
					$questionUpdateQuery = "UPDATE questions SET question = ? WHERE ques_id = ?";
					$questionUpdateStmt = $this->con->prepare($questionUpdateQuery);
					$questionUpdateStmt->bind_param("si", $question, $ques_id);
					if ($questionUpdateStmt->execute()) {
						$questionUpdateStmt->close();
					} else {
						$status = false;
						echo $this->con->error;
					}
				}
				if ($status) header("Location:admin.php?msg1=update");
			} else {
				echo $this->con->error;
			}
		}
	}


	// Delete exam data from exam table
	public function deleteRecord($id)
	{
		/* Delete Questions from Exams */
		$quesQuery = "DELETE FROM questions WHERE exam_id = ?";
		$quesStmt = $this->con->prepare($quesQuery);
		$quesStmt->bind_param("i", $id);
		// If questions are deleted successfully now delete Exam itself
		if ($quesStmt->execute()) {
			$examQuery = "DELETE FROM exams WHERE exam_id = ?";
			$examStmt = $this->con->prepare($examQuery);
			$examStmt->bind_param("i", $id);
			if ($examStmt->execute())
				header("Location:admin.php?msg3=delete");
			else $this->con->error;
		} else {
			echo "Record does not delete try again";
		}
	}
}
