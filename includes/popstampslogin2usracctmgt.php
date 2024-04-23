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

    echo "<tr><th colspan='5'>Propagating records fr tbllogin to tblsysusracctmgt...</th></tr>";

    // select query tbllogin
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT tbllogin.loginid, tbllogin.username, tbllogin.password, tbllogin.time_login, tbllogin.time_logout, tbllogin.employeeid FROM tbllogin WHERE tbllogin.loginid<>0 AND tbllogin.username<>'' AND tbllogin.employeeid<>'' ORDER BY tbllogin.loginid ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=0;
        $ctr11++;
        $loginid11 = $myrow11['loginid'];
        $username11 = trim($myrow11['username']);
        $password11 = trim($myrow11['password']);
        $time_login11 = $myrow11['time_login'];
        $time_logout11 = $myrow11['time_logout'];
        $employeeid11 = trim($myrow11['employeeid']);

        // check if record exists in tblsysusracctmgt
        $res14query=""; $result14=""; $found14=0;
        $res14query="SELECT idtblsysusracctmgt FROM tblsysusracctmgt WHERE loginid=$loginid11 AND employeeid=\"$employeeid11\"";
        $result14=$dbh2->query($res14query);
        if($result14->num_rows>0) {
            while($myrow14=$result14->fetch_assoc()) {
            $found14=1;
            } //while
        } //if

        if($found14==1) {
            // skip
            echo "<tr><td>$ctr11</td><td>$username11</td><td>$employeeid11</td><td>$time_login11 - $time_logout11</td><td class='text-default'>record exists - skipped</td></tr>";


        } else {
            // insert
        // prep vars
        $admloginid=0; $attempt=0; $attemptstamp=""; $pwchangedt=""; $skippwctr=0; $skiplastdt="";

        // insert query tblsysusracctmgt
        $res12query=""; $result12=""; $found12=0;
        $res12query="INSERT INTO tblsysusracctmgt SET timestamp=\"$now\", loginid=$loginid11, admloginid=$admloginid, employeeid=\"$employeeid11\", loginstamp=\"$time_login11\", logoutstamp=\"$time_logout11\", attempt=$attempt, pwlast=\"$password11\"";
        $result12=$dbh2->query($res12query);

        if($result12!="") {
            // success
            echo "<tr><td>$ctr11</td><td>$username11</td><td>$employeeid11</td><td>$time_login11 - $time_logout11</td><td class='text-success'><font color='green'>inserted</font></td></tr>";

        } else {
            // insert query failed
            echo "<tr><td>$ctr11</td><td>$username11</td><td>$employeeid11</td><td>$time_login11 - $time_logout11</td><td class='text-danger'><font color='red'>insert failed</font></td></tr>";

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
