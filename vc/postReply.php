


<?php
$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set("Asia/Manila");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postId = intval($_POST["postId"]);
    $replyText = trim($_POST["replyText"]);
    $currentuser = intval($_POST["currentuser"]);
    $anonymous = isset($_POST["anonflag"]) ? intval($_POST["anonflag"]) : 0;


    if (!empty($replyText)) {
        $stmt = $conn->prepare("INSERT INTO replies (post_id, user_id, reply_text, flaganon, timestamp) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("iisi", $postId, $currentuser, $replyText, $anonymous);
        
        if ($stmt->execute()) {
           echo "inserted!";
        } else {
            echo "err";
        }

        $stmt->close();
    } else {
        echo "err";
    }
}

$conn->close();
?>
