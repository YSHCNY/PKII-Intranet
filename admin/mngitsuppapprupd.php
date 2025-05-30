<?php
require("db1.php");
include("datetimenow.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';

$deptcd = isset($_POST['deptcd']) ? $_POST['deptcd'] : '';
$approver1empid = isset($_POST['approver1empid']) ? $_POST['approver1empid'] : '';
$approver2empid = isset($_POST['approver2empid']) ? $_POST['approver2empid'] : '';
$approver3empid = isset($_POST['approver3empid']) ? $_POST['approver3empid'] : ''; // Corrected this line

$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    foreach ($deptcd as $val => $n) {
        // Split approver1empid, approver2empid, and approver3empid
        $arrappr1emp = explode("-", $approver1empid[$val]);
        $appr1empdept = $arrappr1emp[0];
        $appr1empid = $arrappr1emp[1];

        $arrappr2emp = explode("-", $approver2empid[$val]);
        $appr2empdept = $arrappr2emp[0];
        $appr2empid = $arrappr2emp[1];

        $arrappr3emp = explode("-", $approver3empid[$val]); // New
        $appr3empdept = $arrappr3emp[0];
        $appr3empid = $arrappr3emp[1];

        // Query tblitctgsuppreq
        $res11query = "SELECT iditsupportapprover FROM tblitsupportapprover WHERE deptcd=\"$n\"";
        $result11 = "";
        $found11 = 0;
        $ctr11 = 0;
        $result11 = $dbh2->query($res11query);
        if ($result11->num_rows > 0) {
            while ($myrow11 = $result11->fetch_assoc()) {
                $found11 = 1;
                $ctr11++;
                $iditsupportapprover11 = $myrow11['iditsupportapprover'];
            }
        }
        if ($found11 == 1) {
            $res12query = "UPDATE tblitsupportapprover SET timestamp=\"$now\", loginid=\"$loginid\", approver1empid=\"$appr1empid\", approver2empid=\"$appr2empid\", approver3empid=\"$appr3empid\" WHERE deptcd=\"$n\""; // Updated
        } else if ($found11 == 0) {
            $res12query = "INSERT INTO tblitsupportapprover (timestamp, loginid, datecreated, createdby, approver1empid, approver2empid, approver3empid, deptcd) VALUES (\"$now\", \"$loginid\", \"$datenow\", \"$loginid\", \"$appr1empid\", \"$appr2empid\", \"$appr3empid\", \"$n\")"; // Updated
        }
        $result12 = $dbh2->query($res12query);

        // Reset variables
        $appr1empid = "";
        $appr2empid = "";
        $appr3empid = ""; // Reset this as well
    }

    $adminlogdetails = "$loginid:$username - updated Manage categories > IT support request approvers";
    $res17query = "INSERT INTO tbladminlogs (adminloginid, timestamp, adminuid, adminlogdetails) VALUES (\"$loginid\", \"$now\", \"$adminuid\", \"$adminlogdetails\")";
    $result17 = $dbh2->query($res17query);

    // Redirect
    header("Location: mngitsuppreqappr.php?loginid=$loginid");
    exit;
} else {
    include("logindeny.php");
}

$dbh2->close();
?>