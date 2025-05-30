<?php
$host = "localhost"; // Change if necessary
$user = "root"; // Your database username
$pass = "sysad"; // Your database password
$dbname = "maindb"; // Your database name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employeeid = $_POST['employeeid'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$sql = "INSERT INTO events (employee_id, title, start, end) VALUES ('$employeeid', '$title', '$start', '$end')";
$conn->query($sql);
echo json_encode(["id" => $conn->insert_id]);
$conn->close();
?>
