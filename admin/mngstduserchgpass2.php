<?php 
// session
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$loginid0 = (isset($_GET['stdlid'])) ? $_GET['stdlid'] :'';
$username0 = (isset($_GET['stduid'])) ? $_GET['stduid'] :'';

$newpassword = trim((isset($_POST['newpassword'])) ? $_POST['newpassword'] :'');

$found = 0;
$found11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

  if($accesslevel >= 4 && $accesslevel <= 5) {


//    if($adminloginid0 != '' && $adminuid0 != '')
//    {
      if($newpassword != '') {
        // update user settings into tbladminlogin
        $result14 = mysql_query("UPDATE tbllogin SET password=md5('$newpassword') WHERE loginid=$loginid0 AND username=\"$username0\"", $dbh);

        // update tblsysusracctmgt for loginid
        $res18query=""; $result18=""; $found18=0;
        $res18query="UPDATE tblsysusracctmgt SET pwchangedt=\"$now\", pwlast=md5('$newpassword'), attempt=0, attemptstamp=NULL, skippwctr=0, skiplastdt=NULL WHERE loginid=$loginid0 AND admloginid=0";
        $result18=$dbh2->query($res18query);

				// check admin login if username exists then update password also
				$result15=""; $found15=0; $ctr15=0;
				$result15 = mysql_query("SELECT adminloginid, employeeid, contactid FROM tbladminlogin WHERE adminuid=\"$username0\"", $dbh);
				if($result15 != "") {
					while($myrow15 = mysql_fetch_row($result15)) {
					$found15 = 1;
					$adminloginid15 = $myrow15[0];
					$employeeid15 = $myrow15[1];
					$contactid15 = $myrow15[2];
					}
				}

				if($found15 == 1) {
					$result15b = mysql_query("UPDATE tbladminlogin SET adminpw=md5('$newpassword') WHERE adminloginid=$adminloginid15 AND adminuid=\"$username0\"", $dbh);

        // update tblsysusracctmgt for admloginid
        $res18query=""; $result18=""; $found18=0;
        $res18query="UPDATE tblsysusracctmgt SET pwchangedt=\"$now\", pwlast=md5('$newpassword'), attempt=0, attemptstamp=NULL, skippwctr=0, skiplastdt=NULL WHERE loginid=0 AND admloginid=$adminloginid15 ";
        $result18=$dbh2->query($res18query);
				}

				$message = "Success! Password Changed for <b>$username0!</b>";
				$_SESSION['success'] = $message;

	// create log
	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
	while($myrow16 = mysql_fetch_row($result16))
	{ $adminuid16=$myrow16[0]; }
	$adminlogdetails = "$loginid:$adminloginuid - Changed password for standard user:$username0";
	$result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"", $dbh);
      } else {

          $message = "ERROR Changing Password. passwords should not be blank.";
          $_SESSION['changepass'] = $message;
      }

//    }

    echo '<script>';
    echo 'window.location.href = "mngstdusers.php?loginid=' . $loginid . '";';
    echo '</script>';
         exit; 
  }

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
