<?php 
// filenm: popstampslogin2usracctmgt.php 20220930
// desc: this will populate login/out of user timestamps from tbllogin to tblsysusracctmgt
// for FINANCE users, chg pw every 30days
// path: /pkii/includes

/////////////////////////
// database conn details
/////////////////////////
	$hostname	= "localhost";
	$dbname		= "maindb";
	$dbusername	= "root";
	$dbuserpass	= "sysad";

////////////////////////
// set timezone and other date/time variables
////////////////////////
	date_default_timezone_set('Asia/Manila');
	$now = date("Y-m-d H:i:s", time());
	$datenow = date("Y-m-d");
	$yearnow = date("Y");
	$monthnow = date("n");

$dbh2 = new mysqli("$hostname", "$dbusername", "$dbuserpass", "$dbname") or die ("Unable to connect to database");
// $loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;
/*
if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
*/
     // include ("../admin/header.php");
//     include ("sidebar.php");
// edit body-header
   //  echo "<p><font size=1>Main menu >> sub-menu >> sub-menu2</font></p>";

echo "<table border=1 spacing=1 cellspacing=1 cellpadding=1>";
// echo "<tr><td>";

// start contents here...

    echo "<tr><th colspan='5'>Propagating records fr tbladminlogin to tblsysusracctmgt...</th></tr>";

    // select query tbllogin
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT tbladminlogin.adminloginid, tbladminlogin.adminuid, tbladminlogin.adminpw, tbladminlogin.employeeid, tbladminlogin.lastlogin FROM tbladminlogin WHERE tbladminlogin.adminloginid<>0 AND tbladminlogin.adminuid<>'' AND tbladminlogin.employeeid<>'' ORDER BY tbladminlogin.adminloginid ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=0;
        $ctr11++;
        $adminloginid11 = $myrow11['adminloginid'];
        $adminuid11 = $myrow11['adminuid'];
        $adminpw11 = $myrow11['adminpw'];
        $employeeid11 = $myrow11['employeeid'];
        $lastlogin11 = $myrow11['lastlogin'];

        // check if record exists in tblsysusracctmgt
        $res14query=""; $result14=""; $found14=0;
        $res14query="SELECT idtblsysusracctmgt FROM tblsysusracctmgt WHERE admloginid=$adminloginid11 AND employeeid=\"$employeeid11\"";
        $result14=$dbh2->query($res14query);
        if($result14->num_rows>0) {
            while($myrow14=$result14->fetch_assoc()) {
            $found14=1;
            } //while
        } //if

        if($found14==1) {
            //skip
            echo "<tr><td>$ctr11</td><td>$adminuid11</td><td>$employeeid11</td><td>$lastlogin11</td><td class='text-success'>record exists - skipped</td></tr>";

        } else {
            // insert
        // prep vars
        $loginid=0; $attempt=0; $attemptstamp=''; $pwchangedt='';

        // insert query tblsysusracctmgt
        $res12query=""; $result12=""; $found12=0;
        $res12query="INSERT INTO tblsysusracctmgt SET timestamp=\"$now\", loginid=$loginid, admloginid=$adminloginid11, employeeid=\"$employeeid11\", loginstamp=\"$lastlogin11\", logoutstamp=\"$lastlogin11\", attempt=$attempt, pwlast=\"$adminpw11\"";
        $result12=$dbh2->query($res12query);

        if($result12!="") {
            // success
            echo "<tr><td>$ctr11</td><td>$adminuid11</td><td>$employeeid11</td><td>$lastlogin11</td><td class='text-success'><font color='green'>inserted</font></td></tr>";

        } else {
            // insert query failed
            echo "<tr><td>$ctr11</td><td>$adminuid11</td><td>$employeeid11</td><td>$lastlogin11</td><td class='text-danger'><font color='red'>insert failed</font></td></tr>";

        } //if-else

        } //if-else

        } //while
    } //if

        echo "<tr><td colspan='5'> - end of file - </td></tr>";

// end contents here...

// echo "</td></tr>";
echo "</table>";
/*
// edit body-footer
     echo "<p><a href=\"admlogin.php?loginid=$loginid\" class='btn btn-default' role='button'>Back to Main Menu</a></p>";

     $resquery("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}
*/
$dbh2->close();
?> 
