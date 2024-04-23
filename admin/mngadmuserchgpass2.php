<?php 
// session
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$adminloginid0 = $_GET['admid'];
$adminuid0 = $_GET['admuid'];

$adminpwnew = trim($_POST['adminpwnew']);

$found = 0;
$found11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
 

  if($accesslevel >= 4 && $accesslevel <= 5)
  {


//    if($adminloginid0 != '' && $adminuid0 != '')
//    {
      if($adminpwnew != '')
      {
        // update user settings into tbladminlogin
        $result14 = mysql_query("UPDATE tbladminlogin SET adminpw=md5('$adminpwnew') WHERE adminloginid=$adminloginid0 AND adminuid=\"$adminuid0\"", $dbh);

				// check non-admin login if username exists then update password also
				$result15=""; $found15=0; $ctr15=0;
				$result15 = mysql_query("SELECT loginid, employeeid, contactid FROM tbllogin WHERE username=\"$adminuid0\"", $dbh);
				if($result15 != "") {
					while($myrow15 = mysql_fetch_row($result15)) {
					$found15 = 1;
					$loginid15 = $myrow15[0];
					$employeeid15 = $myrow15[1];
					$contactid15 = $myrow15[2];
					}
				}

				if($found15 == 1) {
					$result15b = mysql_query("UPDATE tbllogin SET password=md5('$adminpwnew') WHERE loginid=$loginid15 AND username=\"$adminuid0\"", $dbh);
				}

				$message = "Success! Password Changed for $adminuid0!";
				$_SESSION['success'] = $message;

	// create log
	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
	while($myrow16 = mysql_fetch_row($result16))
	{ $adminuid16=$myrow16[0]; }
	$adminlogdetails = "$loginid:$adminloginuid - Changed password for user:$adminuid0";
	$result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"", $dbh);
      }
      else
      {

	$message = "ERROR Changing Password. passwords should not be blank.";
	$_SESSION['changepass'] = $message;
      }

//    }



  }
  echo '<script>';
  echo 'window.location.href = "mngadmusers.php?loginid=' . $loginid . '";';
  echo '</script>';
	  exit; 
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
