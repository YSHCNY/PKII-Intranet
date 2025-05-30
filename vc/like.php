<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_POST['user_id']; // You need a user session
$post_id = $_POST['post_id'];

$sql = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Unlike if already liked
    $conn->query("DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
    echo json_encode(["status" => "unliked"]);
} else {
    // Like if not already liked
    $conn->query("INSERT INTO likes (post_id, user_id) VALUES ($post_id, $user_id)");
    echo json_encode(["status" => "liked"]);
}

$conn->close();
