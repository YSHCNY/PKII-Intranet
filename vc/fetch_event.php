<?php
$host = "localhost"; 
$user = "root"; 
$pass = "sysad"; 
$dbname = "maindb"; 

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employeeid = $_GET['employeeid'];
$sql = "SELECT * FROM events WHERE employee_id = '$employeeid'";
$result = $conn->query($sql);
$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
echo json_encode($events);
$conn->close();
?>
