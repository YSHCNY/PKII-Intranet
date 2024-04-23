<?php 
// session
session_start();
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$adminuid = (isset($_POST['adminuid'])) ? trim($_POST['adminuid']) :'';
$adminpw1 = (isset($_POST['adminpw1'])) ? trim($_POST['adminpw1']) :'';
$adminpw2 = (isset($_POST['adminpw2'])) ? trim($_POST['adminpw2']) :'';
$employeeid00 = (isset($_POST['employeeid'])) ? trim($_POST['employeeid']) :'';
$accesslevel0 = (isset($_POST['accesslevel'])) ? trim($_POST['accesslevel']) :'';

$defaultadminloginlevel = "00000000000000000000000000000000000000010101000010";

$found = 0;
$found11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

  if($accesslevel >= 4 && $accesslevel <= 5) {

   

// check passwords
    if($adminuid != '' && $adminpw1 != '' && $adminpw2 != '' && $adminpw1 == $adminpw2 && $employeeid00 != '') {
      $res11query = "SELECT adminuid FROM tbladminlogin WHERE adminuid = \"$adminuid\"";
			$result11=""; $found11=0;
			$result11=$dbh2->query($res11query);
      if($result11->num_rows>0) {
	while($myrow11=$result11->fetch_assoc()) {
	  $found11 = 1;
	  $adminuid11 = $myrow11['adminuid'];
	} // while($myrow11=$result11->fetch_assoc())
      } // if($result11->num_rows>0)

	if($found11 == 1) {


				  $message = "Sorry, username already on database. Please try again.";
				  $_SESSION['message'] = $message;

	} else {

	  $res12query = "SELECT employeeid FROM tbladminlogin WHERE employeeid = \"$employeeid00\"";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
	    $found12 = 1;
	    $employeeid12 = $myrow12['employeeid'];
			} // while($myrow12=$result12->fetch_assoc())
		} // if($result12->num_rows>0)

	  if($found12 == 1) {

	    $res13query = "SELECT adminuid FROM tbladminlogin WHERE employeeid=\"$employeeid12\"";
			$result13=""; $found13=0;
			$result13=$dbh2->query($res13query);
			if($result13->num_rows>0) {
				while($myrow13=$result13->fetch_assoc()) {
	      $found13 = 1;
	      $adminuid13 = $myrow13['adminuid'];
				} // while($myrow13=$result13->fetch_assoc())
			} // if($result13->num_rows>0)
	    // echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, personnel selected already has a login name: <b>$adminuid13</b>. Please try again.</font></td></tr>";

			$message = "ERROR Adding User, Sorry, personnel selected already has a login name: $adminuid13. Please try again.";
			$_SESSION['message'] = $message;

	  } else {



		$message = "New admin user: <b>$adminuid</b> saved. <span class = 'fs-6'> $adminuid | $datenow | 0 | $defaultadminloginlevel |  $employeeid00 |  $accesslevel0</span>";
		// Set the session variable to store the message
		$_SESSION['success'] = $message;

	    // insert new user into tbladminlogin
	    $res14query = "INSERT INTO tbladminlogin SET adminuid=\"$adminuid\", adminpw=md5('$adminpw1'), date_created=\"$datenow\", adminloginstat=0, adminloginlevel=\"$defaultadminloginlevel\", employeeid=\"$employeeid00\", accesslevel=$accesslevel0";
			$result14="";
			$result14=$dbh2->query($res14query);

	    echo "<tr><td>details</td><td>";
	    echo "$adminuid<br>$datenow<br>0<br>$defaultadminloginlevel<br>$employeeid00<br>$accesslevel0</td></tr>";

	    // create log
	    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
			$result16=""; $found16=0;
			$result16=$dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16=$result16->fetch_assoc()) {
				$adminuid16=$myrow16['adminuid'];
				} // while($myrow16=$result16->fetch_assoc())
			} // if($result16->num_rows>0)
	    $adminlogdetails = "$loginid:$adminloginuid - Add new admin user:$adminuid with employeeid:$employeeid00";
	    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"";
			$result17="";
			$result17=$dbh2->query($res17query);
	  } // if($found12 == 1)
	} // if($found11 == 1)

    } else {
		
 
		$message = "ERROR Adding User, Sorry, passwords do not match and/or fields should not be blank. Please try again";
		$_SESSION['message'] = $message;
		
	 
    } // if($adminuid != '' && $adminpw1 != '' && $adminpw2 != '' && $adminpw1 == $adminpw2 && $employeeid00 != '')
   
	echo '<script>';
echo 'window.location.href = "mngadmusers.php?loginid=' . $loginid . '";';
echo '</script>';
	exit; 
  } // if($accesslevel >= 4 && $accesslevel <= 5)

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
