<?php
session_start();
include("db1.php"); // Ensure this sets up $dbh
$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = isset($_GET['eid']) ? mysql_real_escape_string($_GET['eid']) : '';

if (!$employeeid) {
    die("Employee ID is missing or invalid.");
}

// Check if the file was uploaded without errors
if (!isset($_FILES['uploadedfile']) || $_FILES['uploadedfile']['error'] !== UPLOAD_ERR_OK) {
    die("Error uploading the file. Please try again.");
}

// Validate file size (max 10MB as set in the form)
$maxFileSize = 10 * 1024 * 1024; // 10MB
if ($_FILES['uploadedfile']['size'] > $maxFileSize) {
    die("File size exceeds the maximum limit of 10MB.");
}

// Validate file type (allow only jpg, png, gif)
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($_FILES['uploadedfile']['tmp_name']);

if (!in_array($mimeType, $allowedMimeTypes)) {
    die("Invalid file type. Only JPG, PNG, and GIF files are allowed.");
}

// Generate a unique filename to prevent overwriting or path traversal
$extension = pathinfo($_FILES['uploadedfile']['name'], PATHINFO_EXTENSION);
$uniqueFilename = uniqid('img_', true) . '.' . $extension;

// Define the target directory
$targetDirectory = "../vc/images/";

// Ensure the target directory exists
if (!is_dir($targetDirectory) && !mkdir($targetDirectory, 0755, true)) {
    die("Failed to create the target directory.");
}

// Full path for the uploaded file
$targetPath = $targetDirectory . $uniqueFilename;

// Move the uploaded file to the target directory
if (!move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $targetPath)) {
    die("There was an error uploading the file, please try again!");
}

// Update the database with the file name
$query = "UPDATE tblcontact SET picfn = '$uniqueFilename', picpath = '$targetDirectory' WHERE employeeid = '$employeeid'";
$result = mysql_query($query, $dbh);
echo "$targetDirectory <br>";
echo "$query";

if ($result) {
    echo "The file has been uploaded successfully.";
    $message = "Uploaded Successfully";
    $_SESSION['success_message'] = $message;
} else {
    // Optionally delete the uploaded file if the database update fails
    unlink($targetPath);
    die("Database update failed: " . mysql_error($dbh));
    $message = "Error upon upload!";
    $_SESSION['error_message'] = $message;
}

header("location: personneledit2.php?pid=$employeeid&loginid=$loginid");

// Close the database connection
mysql_close($dbh);
?>
