<?php
header('Content-Type: application/json');

// Database connection
$host = "localhost";
$user = "root";
$pass = "sysad";
$dbname = "maindb";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Query to get data
// $sql = "SELECT proj_period AS full_range, COUNT(projectid) AS proj_period_count FROM tblproject1 GROUP BY full_range ORDER BY `full_range` ASC"; detailed

$sql = "SELECT proj_period AS full_range, COUNT(projectid) AS proj_period_count FROM tblproject1 WHERE `projstatus`='On-Going' GROUP BY full_range ORDER BY `full_range` ASC";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

// Return JSON
echo json_encode($data);
?>
