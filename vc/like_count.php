<?php
$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$post_id = $_GET['post_id'];

$query = $mysqli->prepare("SELECT COUNT(*) AS count FROM likes WHERE post_id = ?");
$query->bind_param("i", $post_id);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

echo json_encode(["count" => $row['count']]);

$mysqli->close();
?>
