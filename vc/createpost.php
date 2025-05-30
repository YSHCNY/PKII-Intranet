<?php
session_start();


$loginid = $_GET['loginid'];
$sess = $_GET['sess'];

$host = 'localhost'; 
$dbname = 'maindb'; 
$username = 'root'; 
$password = 'sysad'; 


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "connected!";
}





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   


    $userimg = $_POST['userimgpath'];
    $usern = $_POST['usern']; 
    $post_content = $_POST['shrdpst']; 
    $empid = $_POST['empid']; 
    $anonymous = isset($_POST['anonflag']) ? '1' : '0';

    // Validate input
    if (!empty($post_content)) {
        
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO tblshrdpst (usern, empid, userimg, shrdpst, anonflag, timestamp) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sissi", $usern, $empid, $userimg, $post_content, $anonymous); 

        // Execute the query
        if ($stmt->execute()) {
            echo "Post created successfully!";
            $_SESSION['alert_message'] = "Great! Post Created!";
            header("location: index.php?lst=1&lid=$loginid&sess=$session&p=43&title=Intra%20Feed%20");
        } else {
        $_SESSION['alert_message'] = "Something's Wrong!";

            echo "Error creating post.";
            header("location: index.php?lst=1&lid=$loginid&sess=$session&p=43&title=Intra%20Feed%20");

        }
        
        $stmt->close();
    } else {
                    header("location: index.php?lst=1&lid=$loginid&sess=$session&p=43&title=Intra%20Feed%20");

    }
}


$conn->close();

?>
