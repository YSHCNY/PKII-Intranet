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

// $sql = "SELECT 
//     SUM(CASE WHEN tblemployee.employee_type != 'consultant' THEN 1 ELSE 0 END) AS ctrempactv_non_consultant,
//     SUM(CASE WHEN tblemployee.employee_type = 'consultant' THEN 1 ELSE 0 END) AS ctrempactv_consultant
// FROM tblcontact 
// JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid 
// WHERE tblcontact.contact_type = 'personnel' 
// AND tblemployee.emp_record = 'active'";

$sql = "SELECT 
  YEAR(date_hired) AS hire_year, 
  COUNT(*) AS total_count
FROM tblcontact 
JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid 
WHERE tblcontact.contact_type = 'personnel' 
AND tblemployee.emp_record = 'active'
GROUP BY YEAR(date_hired)
ORDER BY hire_year";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

// Return JSON
echo json_encode($data);
?>
