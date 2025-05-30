<?php 

//
// mngscheduler0.php //20200608
// fr sidebar.php
//

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$adminloginid = (isset($_GET['admid'])) ? $_GET['admid'] :'';

$deptcd = (isset($_POST['deptcd'])) ? trim($_POST['deptcd']) :'';
if($deptcd=="ALL") { $deptcdallsel="selected"; } else { $deptcdallsel=""; }

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	//
	// Manage scheduler
	//

	if($deptcd=='') {
		if($empdepartment0!='') {
			$deptcd=$empdepartment0;
		} // if($empdepartment0!='')
	} // if($deptcd=='')

	echo "<table class=\"fin\">";

	echo "<tr><th colspan=\"2\">Manage scheduler</th></tr>";

	// display add button
	echo "<tr>";

	echo "<td>";
	echo "<form action=\"mngschedulermtgrm.php?loginid=$loginid\" method=\"post\" name=\"mngschedulermtgrm\">";
	echo "<button type='submit' class='btn btn-primary'>Meeting rooms</button>";
	echo "</form>";
	echo "</td>";

	echo "<td>";
	echo "<form action=\"mngscheduler.php?loginid=$loginid\" method=\"post\" name=\"mngschedulermtgrm\">";
	echo "<button type='submit' class='btn btn-primary'>Departments or E-mail notifications</button>";
	echo "</form>";
	echo "</td>";

	echo "</tr>";

	echo "</table>";

	echo "<p><a href=\"index2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here
		$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
