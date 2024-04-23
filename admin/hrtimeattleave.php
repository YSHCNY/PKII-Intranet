<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

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

	//
	// add function
	//
	echo "<form action=\"hrtimeattleaveadd.php?loginid=$loginid\" method=\"post\" name=\"modhrtaleave\">";
	echo "<tr><th align=\"right\">leave code</th><td><input name=\"code\" size=\"10\"></td></tr>";
	echo "<tr><th align=\"right\">leave name</th><td><input name=\"name\" size=\"30\"></td></tr>";
	echo "<tr><th align=\"right\">leave quota</th><td><input type=\"number\" name=\"quota\" size=\"2\" value=\"0\"></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"add new\"></td></tr>";
	echo "</form>";

	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
	echo "<tr><th>ctr</th><th>code</th><th>name</th><th>quota</th><th colspan=\"2\">action</th></tr>";
	$res11query="SELECT idhrtaleavectg, code, name, quota FROM tblhrtaleavectg";
	$result11=""; $found11=0; $ctr11=0;
	/*
	$result11 = mysql_query("", $dbh);
	if($result != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
	*/
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$idhrtaleavectg11 = $myrow11['idhrtaleavectg'];
		$code11 = $myrow11['code'];
		$name11 = $myrow11['name'];
		$quota11 = $myrow11['quota'];
		$ctr11 = $ctr11 + 1;
		echo "<tr><td>$ctr11</td><td>$code11</td><td>$name11</td><td>$quota11</td>";
		echo "<td><a href=\"hrtimeattleaveedit.php?loginid=$loginid&idl=$idhrtaleavectg11\">edit</a></td>";
		echo "<td><a href=\"hrtimeattleavedel.php?loginid=$loginid&idl=$idhrtaleavectg11\">del</a></td>";
		echo "</tr>";
		}
	}
	echo "</table>";
	echo "</td></tr>";

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mnghrmod.php?loginid=$loginid\">Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
