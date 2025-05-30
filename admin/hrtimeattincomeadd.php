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


  if($accesslevel >= 4) {

	if ($pyrllpage != ""){
		echo "<a  class=\"btn mainbtnclr text-white mb-3\" href=\"finpaysys.php?loginid=$loginid\">Back</a>";

	} else {
		include 'timeattmenu.php';

	}



	echo "<tr><td colspan=\"2\">";

	// display header

	echo "</td></tr>";

  echo "<tr><td colspan=\"2\">";

	echo "<div class=\"shadow border px-5 py-4 mb-3\" border=\"0\">";
	echo "<div class = 'mb-5'><h5 class = 'fw-bold mb-0 p-0'>Additional Allowance</h5><p>Manage Employees' additional allowances per paygroup</p></div>";
	echo "<tr>";
		echo "<form action=\"hrtimeattincome.php?loginid=$loginid\" method=\"post\" name=\"modhrtaindivinfo\">";
		echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"add\">";
		// pay group name dropdown
    echo "<div class = 'row'><div class = 'col-5 '><select name=\"idpaygroup\" class = 'GlobalSelectWx w-100' onchange=\"this.form.submit()\">";
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
		echo "</select></div>";

		// individual personnel dropdown
		if($idpaygroup != "") {
		echo "<div class = 'col-5 '>";
		echo "<select name=\"empid\" class = 'GlobalSelectWx w-100' onchange=\"this.form.submit()\">";
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
		echo "</div>";
		}
		echo "<div class = 'col-2'><button type=\"submit\" class=\"btn btn-success\">Submit</button></div>";

		// submit button
		echo "</div>";
		// echo "<input type=\"submit\">";
    echo "</td>";

		echo "</form>";
	echo "</tr>";
	echo "</div>";

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

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
