<?php
$host = "localhost"; // Change if necessary
$user = "root"; // Your database username
$pass = "sysad"; // Your database password
$dbname = "maindb"; // Your database name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$start = $_POST['start'];
$end = $_POST['end'];
$sql = "UPDATE events SET start='$start', end='$end' WHERE id=$id";
$conn->query($sql);
$conn->close();
?>