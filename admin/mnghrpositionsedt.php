<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpositionctg = (isset($_GET['idp'])) ? $_GET['idp'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> HR >> Job positions</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

	echo "<tr><th colspan=\"2\">Edit job position</th></tr>";

  // query leave based on id
	$res11query = "SELECT code, name, deptcd, salarygrade, positionlevel FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$code11 = $myrow11['code'];
		$name11 = $myrow11['name'];
		$deptcd11 = $myrow11['deptcd'];
		$positionlevel11 = $myrow11['salarygrade'];
		$salarygrade11 = $myrow11['positionlevel'];
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	//
	// edit function
	//
	echo "<form action=\"mnghrpositionsedt2.php?loginid=$loginid&idp=$idhrpositionctg\" method=\"post\" name=\"mnghrpositionsedt2\">";
  echo "<tr><th align=\"right\">position code</th><td><input name=\"code\" value=\"$code11\"></td></tr>";
  echo "<tr><th align=\"right\">position name</th><td><input size=\"40\" name=\"name\" value=\"$name11\"></td></tr>";
	echo "<tr><th align=\"right\">department</th><td>";
	echo "<select name=\"deptcd\">";
	if($deptcd11=='') {
	echo "<option value=''>-</option>";
	} // if($deptcd11=='')
	$res12query="SELECT iddeptcd, code, name FROM tbldeptcd";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$found12=1;
		$iddeptcd12 = $myrow12['iddeptcd'];
		$code12 = $myrow12['code'];
		$name12 = $myrow12['name'];
		if($deptcd11==$code12) { $deptcdsel="selected"; } else { $deptcdsel=''; }
		echo "<option value=\"$code12\" $deptcdsel>$name12</option>";
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">position level</th><td><input type=\"number\" min=\"0\" max=\"5\" name=\"positionlevel\" value=\"$positionlevel11\"></td></tr>";
	echo "<tr><th align=\"right\">salary grade</th><td><input type=\"number\" min=\"0\" max=\"12\" name=\"salarygrade\" value=\"$salarygrade11\"></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"update\"></td></tr>";
	echo "</form>";

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mnghrpositions.php?loginid=$loginid\">Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
