<?php 

require_once("dbh.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$username = (isset($_POST['username'])) ? $_POST['username'] :'';
$password = (isset($_POST['password'])) ? $_POST['password'] :'';

$found = 0;

if($loginid != "") {
	include("loginverify.php");
}

$employeeid0 = $employeeid;
$contactid0 = $contactid;

if ($found == 1) {
     include ("header.php");
     include ("menu.php");

// start contents here

     echo "<p>Welcome to Philkoei International Inc.'s Intranet<br>";

    //include('datetimenow.php');

     //echo "<< please choose a link on the left</p>";

			include("../vc/ddash.php");

// end contents here
     $resquery = "UPDATE tbllogin SET login_status=1 WHERE username='$username'";
		$result=$dbh->query($resquery);

     include ("footer.php");


$dbh->close();
?>
