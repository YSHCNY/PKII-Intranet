<?php
$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }// else {
//     echo "connected";
// }

date_default_timezone_set("Asia/Manila");

// Function to calculate "time ago"
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) return $diff . " sec ago";
    elseif ($diff < 3600) return floor($diff / 60) . " min ago";
    elseif ($diff < 86400) return floor($diff / 3600) . " hr ago";
    elseif ($diff < 2592000) return floor($diff / 86400) . " days ago";
    elseif ($diff < 31536000) return floor($diff / 2592000) . " months ago";
    else return floor($diff / 31536000) . " years ago";
}

// // Get the post ID from AJAX request
// $postId = 53;
$postId = isset($_GET["postId"]) ? intval($_GET["postId"]) : 0;

$sql = "SELECT DISTINCT r.flaganon, r.user_id, r.reply_text, r.timestamp, u.id, u.usern, u.empid, u.userimg 
             FROM replies r 
              left JOIN tblshrdpst u ON u.empid = r.user_id 
             WHERE r.post_id = $postId
             GROUP BY r.id 
             ORDER BY r.timestamp DESC";
$result = $conn->query($sql);
// $newReplyId = $result->insert_id;

$replies = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $replies[] = [

            "replyId" => $row["id"],
            "replyText" => htmlspecialchars($row["reply_text"]),
            "timestamp" => timeAgo($row["timestamp"]),
            "username" => ($row["flaganon"] == 1) ? "<span class='anon'>Anonymous</span>"  : htmlspecialchars($row["usern"]),
            "userImg" => ($row["flaganon"] == 1) ? "./img/anon.png" :htmlspecialchars($row["userimg"]),
        ];

    }
}
echo json_encode($replies);

$conn->close();




?>
