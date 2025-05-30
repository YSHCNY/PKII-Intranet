<?php
$host = "localhost";
$user = "root";
$pass = "sysad";
$dbname = "maindb";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT id, user, content, image, video, created_at FROM intranews ORDER BY created_at DESC LIMIT 4";
$result = $conn->query($query);

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

echo json_encode($posts);
?>
