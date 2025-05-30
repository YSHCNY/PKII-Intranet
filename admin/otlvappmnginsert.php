<?php
include("db1.php");

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the form
$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

    $fetchempid = $_POST['selectedUser'];
    $fetchdept = $_POST['selectedDept'];


    // Unset POST values after processing
    unset($_POST['selectedUser']);
    unset($_POST['selectedDept']);


    $options = ['cost' => 12];
$password = $_POST['pinapprt'];
$hashedPassword = crypt($password, '$2y$12$' . substr(str_replace('+', '.', base64_encode(openssl_random_pseudo_bytes(22))), 0, 22));
}



$queryChecker = "SELECT * FROM tblManagerApproverOTLeave WHERE deptcd = '$fetchdept' AND ManagerApproverID != 0";
$ExecQuery = $dbh2->query($queryChecker);
if ($ExecQuery->num_rows > 0){
    $_SESSION['error_message'] = "Someone is already appointed to $fetchdept";
    header("Location: otlvappmng.php?loginid=$loginid");
exit;

} else {
    $found = 0;
    $_SESSION['success_message'] = "New Approver to $fetchdept Appointed";

    $InsertNewApprove = "INSERT INTO tblManagerApproverOTLeave (`ManagerApproverID`, `deptcd`, `apprpin`) values ($fetchempid, '$fetchdept', '$hashedPassword')";
    $ExecuteSql = $dbh2->query($InsertNewApprove);
    if ($ExecuteSql == TRUE){
        echo "Success!";
    } else {
        echo "Error";
    }

    header("Location: otlvappmng.php?loginid=$loginid");
exit;
}

header("Location: otlvappmng.php?loginid=$loginid");
exit;
echo $queryChecker;


?>









<?php






?>