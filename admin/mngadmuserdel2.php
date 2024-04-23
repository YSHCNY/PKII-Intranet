<?php 
// session
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$adminloginid0 = $_GET['admid'];
$adminuid0 = $_GET['admuid'];

$status = "pending";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Deleting CV particulars...</b></font></p>";

// delete record
  $result11 = mysql_query("DELETE FROM tbladminlogin WHERE adminloginid=$adminloginid0 AND adminuid=\"$adminuid0\"", $dbh);


// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted admin user:$adminuid0";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
    $message = "Success! user <b>$adminuid0</b>(account) has been <b>REMOVED</b> to the system.";
		$_SESSION['success'] = $message;


  echo '<script>';
  echo 'window.location.href = "mngadmusers.php?loginid=' . $loginid . '";';
  echo '</script>';
	  exit; 
  header("Location: mngadmusers.php?loginid=$loginid");
  exit;

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);


//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

