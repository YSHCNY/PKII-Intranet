<?php
$host = "localhost";
$user = "root"; // Change if needed
$pass = "sysad";
$dbname = "maindb";

$conn = new mysqli($host, $user, $pass, $dbname);
$conn->set_charset("utf8mb4"); // Ensures emoji storage

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}





$user = htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8');
$content = $_POST['content'];

$image = "";
$video = "";

$fileSizeLimit = 10 * 1024 * 1024; // 10MB

// Handle File Upload
if (!empty($_FILES['file']['name'])) {
    $file = $_FILES['file'];
    $fileSize = $file['size'];
    
    // Check file size
    if ($fileSize > $fileSizeLimit) {
        echo json_encode(["error" => "File size exceeds the limit of 10MB."]);
        exit();
    }

    $fileName = time() . "_" . basename($file["name"]);
    $targetFile = "uploads/" . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allowed file types
    $imageTypes = ['jpg', 'png', 'jpeg', 'gif'];
    $videoTypes = ['mp4', 'mov', 'avi'];

    if (in_array($fileType, $imageTypes)) {
        move_uploaded_file($file["tmp_name"], $targetFile);
        $image = $fileName;
    } elseif (in_array($fileType, $videoTypes)) {
        move_uploaded_file($file["tmp_name"], $targetFile);
        $video = $fileName;
    } else {
        echo json_encode(["error" => "Invalid file type. Only images (JPG, PNG, GIF) and videos (MP4, MOV, AVI) are allowed."]);
        exit();
    }
}

// Ensure either content or a valid file exists
if (empty($content) && empty($image) && empty($video)) {
    echo json_encode(["error" => "Error: The file may be over the 10MB limit or missing."]);
    exit();
}

// Insert into database
header('Content-Type: application/json; charset=utf-8'); // Ensure correct encoding in response
$sql = "INSERT INTO intranews (user, content, image, video, filesize) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit();
}

$stmt->bind_param("sssss", $user, $content, $image, $video, $fileSize);

if ($stmt->execute()) {
    $post_id = $stmt->insert_id;
    $result = $conn->query("SELECT * FROM intranews WHERE id = $post_id");
    $post = $result->fetch_assoc();
    echo json_encode($post, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

} else {
    echo json_encode(["error" => "Failed to save post: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
