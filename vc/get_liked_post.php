<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$user_id = $_SESSION['user_id'];
$liked_posts = [];

$sql = "SELECT post_id FROM likes WHERE user_id = $user_id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $liked_posts[] = $row['post_id'];
}

echo json_encode($liked_posts);
$conn->close();
?>
