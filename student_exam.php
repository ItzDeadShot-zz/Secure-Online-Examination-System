<?php

if (!isset($_SESSION)) {
	session_start();
}

class StudentExam
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

	public function insertData($post, $id)
	{
		$answer = $this->con->real_escape_string($_POST['answer']);

		$responseQuery = "INSERT INTO response(stud_id, response) VALUES(?, ?)";
		$responseStmt = $this->con->prepare($responseQuery);
		$responseStmt->bind_param("is", $id, $answer);
		if ($responseStmt->execute()) {
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
	public function displyaRecordById($email)
	{
		$query = "SELECT * FROM students INNER JOIN exams ON students.exam_id = exams.exam_id WHERE email = ?";
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s", $email);
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

	// Fetch single data for edit from exam table
	public function getExamInfo($id)
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
}
