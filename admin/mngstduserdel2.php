<?php 
// session
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$loginid0 = $_GET['stdlid'];
$username0 = $_GET['stduid'];

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

// delete record
  $result11 = mysql_query("DELETE FROM tbllogin WHERE loginid=$loginid0 AND username=\"$username0\"", $dbh);


// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted standard user id:$loginid0, uid:$username0";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

    $message = "Success! user <b>$username0</b>(account) has been <b>REMOVED</b> to the system.";
		$_SESSION['success'] = $message;

  header("Location: mngstdusers.php?loginid=$loginid");
  echo '<script>';
  echo 'window.location.href = "mngstdusers.php?loginid=' . $loginid . '";';
  echo '</script>';
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

