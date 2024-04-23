<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtaleavectg = (isset($_GET['idl'])) ? $_GET['idl'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Leave category</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

	echo "<tr><th colspan=\"2\">Manage leave category</th></tr>";

  // query leave based on id
	$res11query="SELECT code, name, quota FROM tblhrtaleavectg WHERE idhrtaleavectg=$idhrtaleavectg";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$found11 = 1;
		$code11 = $myrow11['code'];
		$name11 = $myrow11['name'];
		$quota11 = $myrow11['quota'];
		} // while
	} // if

	//
	// edit function
	//
	echo "<form action=\"hrtimeattleaveedit2.php?loginid=$loginid&idl=$idhrtaleavectg\" method=\"post\" name=\"modhrtaleave\">";
	echo "<tr><th align=\"right\">leave code</th><td><input name=\"code\" size=\"10\" value=\"$code11\"></td></tr>";
	echo "<tr><th align=\"right\">leave name</th><td><input name=\"name\" size=\"30\" value=\"$name11\"></td></tr>";
	echo "<tr><th align=\"right\">leave quota</th><td><input type=\"number\" name=\"quota\" size=\"2\" value=\"$quota11\"></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><button type=\"submit\" class=\"btn btn-primary\">Update</button></td></tr>";
	echo "</form>";

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"hrtimeattleave.php?loginid=$loginid\">Back</a></p>";

	$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
