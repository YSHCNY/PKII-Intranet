<?php
$host = "localhost";
$user = "root";
$pass = "sysad";
$dbname = "maindb";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_POST['id'];
$sql = "DELETE FROM events WHERE id=$id";
$conn->query($sql);
$conn->close();

$conn->close();
?>
