<?php
session_start();
include("db1.php");


$tobedelid = (isset($_GET['delid'])) ? $_GET['delid'] :'';
$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

if($tobedelid != ''){
    $delsql = "DELETE FROM tblManagerApproverOTLeave WHERE ManagerApproverID = $tobedelid";
    $resDelete = $dbh2->query($delsql);

    if ($resDelete == TRUE){
        $_SESSION['success_message'] = "Approver Removed!";
        header("Location: otlvappmng.php?loginid=$loginid");
        exit;


    } else {
        $_SESSION['error_message'] = "Error on Removing approver";
        header("Location: otlvappmng.php?loginid=$loginid");
        exit;

    }
} else {
    $_SESSION['error_message'] = "ID EMPTY! DEBUG NEEDED";
    header("Location: otlvappmng.php?loginid=$loginid");
    exit;
    echo "empty";
}


?>