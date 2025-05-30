<?php
session_start();
require_once 'db1.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';


ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('memory_limit', '128M');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != 0) {
        switch ($_FILES["file"]["error"]) {
            case UPLOAD_ERR_INI_SIZE:
                $_SESSION['error'] = "The uploaded file exceeds the maximum allowed size.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $_SESSION['error'] = "The uploaded file exceeds the maximum file size specified in the form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $_SESSION['error'] = "The file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $_SESSION['error'] = "No file was uploaded. Please select a file to upload.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $_SESSION['error'] = "Missing a temporary folder on the server.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $_SESSION['error'] = "Failed to write file to disk. Check server permissions.";
                break;
            case UPLOAD_ERR_EXTENSION:
                $_SESSION['error'] = "A PHP extension stopped the file upload.";
                break;
            default:
                $_SESSION['error'] = "An unknown error occurred during the file upload.";
                break;
        }
        header("Location: uploadimg.php"); // Redirect to reload the page with the error message
        exit;
    }
    
    // Define the directory to store uploads
    $targetDir = "../vc/img/";
    
    // Get the file information
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = array("jpg", "jpeg", "png");
 $flag = 1;
    if (in_array($fileType, $allowedTypes)) {
        // Move file to target directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $message = "Uploaded Successfully";
            $_SESSION['success_message'] = $message;


            // Prepare and execute the SQL statement
            $fileNameEscaped = mysqli_real_escape_string($dbh2, $fileName);
            $sql = "INSERT INTO logimg (`filename`, `activeimg`) VALUES ('$fileNameEscaped', $flag)";
            if ($dbh2->query($sql) === TRUE) {
                $message = "Uploaded Successfully";
                $_SESSION['success_message'] = $message;

                $newRecordId = $dbh2->insert_id;
                $sqlupdate = "UPDATE logimg SET activeimg = 0 WHERE id != $newRecordId";
                if ($dbh2->query($sqlupdate) === TRUE) {
                    $message = "Uploaded Successfully";
                    $_SESSION['success_message'] = $message;
                } else {
                    $message = "Change Error";
                    $_SESSION['error_message'] = $message;
                    echo "error change";
                }
    
            } else {
                $message = "Change Error";
                $_SESSION['error_message'] = $message;
                echo "error change";
            }

        // echo "$loginid this";
            header("Location: index2.php?loginid='$loginid'");
            exit;

        } else {
            $message = "Change Error";
            $_SESSION['error_message'] = $message;
            echo "error change";
        }
    } else {
        $message = "Change Error";
        $_SESSION['error_message'] = $message;
        echo "error change";
    }
} else {
    echo "Invalid request.";
}
?>
