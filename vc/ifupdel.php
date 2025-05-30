<?php
session_start();


$loginid = $_GET['loginid'];
$sess = $_GET['sess'];
$taggedid = $_GET['delid'];


$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo $taggedid;

$sql = "DELETE FROM tblshrdpst WHERE id = $taggedid";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $taggedid);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Record deleted successfully!";
            $_SESSION['alert_message'] = "Post Removed!";

      header("location: index.php?lst=1&lid=$loginid&sess=$session&p=431&title=Created%20Posts");
} else {
    echo "No record found with the given ID.";
            $_SESSION['alert_message'] = "Something went wrong...";

      header("location: index.php?lst=1&lid=$loginid&sess=$session&p=431&title=Created%20Posts");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>