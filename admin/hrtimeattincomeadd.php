<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$tab = (isset($_GET['tab'])) ? $_GET['tab'] :'';
$tabinctyp = (isset($_POST['tabinctyp'])) ? $_POST['tabinctyp'] :'';

if($tab!="") {
	if($tab=="l") { $tabinctyp="list"; }
	else if($tab=="a") { $tabinctyp="add"; }
}

if($tabinctyp!="") {
	if($tabinctyp=="list") { $tab="l"; }
	else if($tabinctyp=="add") { $tab="a"; }
}

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

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
     echo "<p><font size=1>Modules >> Time and Attendance >> Allowances</font></p>";

     echo "<table class=\"fin\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  if($accesslevel >= 4) {

	echo "<tr><td colspan=\"2\">";

	// display header
	include("hrtimeattincaddhdr.php");

	echo "</td></tr>";

  echo "<tr><td colspan=\"2\">";

	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr><th colspan=\"3\">List</th></tr>";
	echo "<tr>";
		echo "<form action=\"hrtimeattincomeadd.php?loginid=$loginid\" method=\"post\" name=\"modhrtaindivinfo\">";
		echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"add\">";
		// pay group name dropdown
    echo "<td><select name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select paygroup</option>";
		$res11query = "SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
		/*
		$result11 = mysql_query("", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
		*/
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
			$paygroupname11 = $myrow11['paygroupname'];
			if($idtblhrtapaygrp11 == $idpaygroup) { $idpaygrpsel="selected"; } else { $idpaygrpsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idpaygrpsel>$paygroupname11</option>";
			}
		}
		echo "</select></td>";

		// individual personnel dropdown
		if($idpaygroup != "") {
		echo "<td>";
		echo "<select name=\"empid\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select personnel</option>";
		$res12query = "SELECT tblhrtapaygrpemplst.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtapaygrpemplst INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup AND tblcontact.contact_type=\"personnel\"";
		$result12=""; $found12=0;
		/*
		$result12 = mysql_query("", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
		*/
		$result12 = $dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12 = $result12->fetch_assoc()) {
			$found12 = 1;
			$employeeid12 = $myrow12['employeeid'];
			$name_last12 = $myrow12['name_last'];
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];
			if($employeeid12 == $employeeid) { $empidsel="selected"; } else { $empidsel=""; }
			echo "<option value=\"$employeeid12\" $empidsel>$employeeid12 - $name_last12, $name_first12 $name_middle12[0]</option>";
			}
		}
		echo "</select>";
		echo "</td>";
		}

		// submit button
		echo "<td>";
		// echo "<input type=\"submit\">";
		echo "<button type=\"submit\" class=\"btn btn-success\">Submit</button>";
    echo "</td>";

		echo "</form>";
	echo "</tr>";
	echo "</table>";

  echo "</td></tr>";

  } // endif accesslevel >= 4

	//
	// display individual info based on selected dropdown personnel
	//
	$filesrc = "hrtimeattincomeadd";
	include("hrtimeattincome2.php");

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"hrtimeattincome.php?loginid=$loginid\">Back</a></button></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
