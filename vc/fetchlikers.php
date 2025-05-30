<?php
$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }

$postId = isset($_GET["postId"]) ? intval($_GET["postId"]) : 0;

$sql = "SELECT DISTINCT r.user_id, r.post_id, u.usern, u.userimg, u.empid
             FROM likes r 
              left JOIN tblshrdpst u ON u.empid = r.user_id 
             WHERE r.post_id = $postId";
$result = $conn->query($sql);

$likers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $likers[] = [

            "replyId" => $row["post_id"],
            "username" =>  htmlspecialchars($row["usern"]),
            "userImg" => htmlspecialchars($row["userimg"]),
        ];

    }
}
echo json_encode($likers);

$conn->close();




?>
