<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Payroll System >> Compute</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr><th colspan=\"5\">Compute payroll</th></tr>";

	echo "<form method=\"post\" action=\"finpaysyscompute.php?loginid=$loginid\" name=\"finpaysyscompute\">";

		// pay group name dropdown
    echo "<td><select name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select paygroup</option>";
		$res11query = "SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
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
		echo "</select>";
		echo "</td>";

		if($idpaygroup!='') {
		// query cutoff dropdown (based on pay group), still not processed
		echo "<td><select name=\"idcutoff\" onchange=\"this.form.submit()\">";
		echo "<option value=''>cut-off period</option>";
		$res12query="SELECT tblhrtacutoff.idhrtacutoff, tblhrtacutoff.cutstart, tblhrtacutoff.cutend, tblhrtacutoff.paygroupname FROM tblhrtacutoff WHERE NOT EXISTS (SELECT idemppaycutoff FROM tblemppaycutoff WHERE tblemppaycutoff.idhrtacutoff=tblhrtacutoff.idhrtacutoff AND tblemppaycutoff.idhrtapaygrp=tblhrtacutoff.idhrtapaygrp AND tblemppaycutoff.idhrtapaygrp=$idpaygroup) AND tblhrtacutoff.idhrtapaygrp=$idpaygroup ORDER BY tblhrtacutoff.cutstart DESC";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12=$ctr12+1;
			$idhrtacutoff12 = $myrow12['idhrtacutoff'];
			$cutstart12 = $myrow12['cutstart'];
			$cutend12 = $myrow12['cutend'];
			$paygroupname12 = $myrow12['paygroupname'];
			if($idhrtacutoff12==$idcutoff) { $idcutoffsel="selected"; } else { $idcutoffsel=""; }
			echo "<option value='$idhrtacutoff12' $idcutoffsel>".date("Y-M-d", strtotime($cutstart12))."&nbsp;-to-&nbsp;".date("Y-M-d", strtotime($cutend12))."</option>";
			} // while
		} // if
		echo "</select></td>";
		} // if

		// submit button
		echo "<td>";
		echo "<input type=\"submit\" value=\"Go\">";
    echo "</td>";

		echo "</form>";

	//
	// display processed cutoffs based on paygroup
	if($idpaygroup!="" && $idcutoff=="") {
	echo "<tr><th colspan=\"5\">Processed cut-off periods</th></tr>";
	echo "<tr>";
	// query processed cutoff periods from selected pay group
	$res14query="SELECT tblemppaycutoff.idemppaycutoff, tblemppaycutoff.paygroupname, tblemppaycutoff.cutstart, tblemppaycutoff.cutend, tblemppaycutoff.idhrtacutoff FROM tblemppaycutoff WHERE tblemppaycutoff.idhrtapaygrp=$idpaygroup ORDER BY tblemppaycutoff.cutstart DESC";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		$ctr14=$ctr14+1;
		$idemppaycutoff14=$myrow14['idemppaycutoff'];
		$paygroupname14=$myrow14['paygroupname'];
		$cutstart14=$myrow14['cutstart'];
		$cutend14=$myrow14['cutend'];
		$idhrtacutoff14=$myrow14['idhrtacutoff'];
		echo "<td>".date("Y-M-d", strtotime($cutstart14))."&nbsp;-to-&nbsp;".date("Y-M-d", strtotime($cutend14))."</td><td><a href=\"finpaysyscutoffdel.php?loginid=$loginid&idpc=$idemppaycutoff14\">Delete</a></td>";
		} // while
	} // if
	echo "</tr>";
	} // if($idpaygroup!="")

	echo "</table>";
  echo "</td></tr>";

	//
	//
	// list summary of records based on selected paygroup and cutoff
	if($idpaygroup!='' && $idcutoff!='') {

	echo "<tr><td>";
	echo "<table class=\"fin\">";
	// display sub-title
	echo "<tr><th colspan=\"8\">Listing summary of records...</th></tr>";
	// display header
	echo "<tr></tr>";
	// query records
	$res15query="";
	$result15=""; $found15=0; $ctr15=0;
	$result15=$dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
		$found15=1;
		$ctr15=$ctr15+1;

		} // while
	} // if
	// display process payroll button
	echo "<tr><td colspan=\"8\" align=\"center\"><form action=\"finpaysyscompute2.php?loginid=$loginid\" method=\"POST\" name=\"finpaysyscompute2\">";
	echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
	echo "<input type=\"hidden\" name=\"idcutoff\" value=\"$idcutoff\">";
	echo "<input type=\"submit\" value=\"Process payroll\">";
	echo "</form></td></tr>";
	echo "</table>";
	echo "</td></tr>";

	} // if($idpaygroup!='' && $idcutoff!='')

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"finpaysys.php?loginid=$loginid\">Back</a></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
