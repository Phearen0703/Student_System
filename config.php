<?php
$url = "http://localhost/Student_System/";

$host = "localhost";
$username = "root";
$password = "";
$dbname = "student_system";
$port = 3306;

$conn = new mysqli($host, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>