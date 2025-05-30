<?php
// Start session
session_start();

// Include necessary files
include("db1.php");
include("datetimenow.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';
$iditsupportreq = isset($_POST['idits']) ? $_POST['idits'] : '';

$found = 0;
$accesslevel11 = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    // Execute delete query
    $res12query = "DELETE FROM tblitsupportreq WHERE iditsupportreq=$iditsupportreq";
    $result12 = $dbh2->query($res12query);

    // Check if deletion was successful
    if ($result12) {
        // Set success message in session
        $_SESSION['notification'] = "The support request with ID $iditsupportreq has been deleted successfully from the table.";
        echo "deleted";
    } else {
        // Set error message in session
        $_SESSION['notification'] = "Error: Unable to delete support request.";
        echo "error";
    }

    // Redirect back to itadmsuppreq.php with notification
    header("Location: itsuppreqoriginal.php?loginid=$loginid");
    exit();
} else {
    include("logindeny.php");
}

$dbh2->close();
?>