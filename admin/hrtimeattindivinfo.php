<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

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

// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Individual info</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";

  if($accesslevel >= 4) {
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr>";
		echo "<form action=\"hrtimeattindivinfo.php?loginid=$loginid\" method=\"post\" name=\"modhrtaindivinfo\">";

		// pay group name dropdown
    echo "<td><select name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select paygroup</option>";
		$res11query = "SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
		/*
		$result11 = mysql_query("", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
		*/
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
		$res12query = "SELECT tblhrtapaygrpemplst.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtapaygrpemplst LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup AND tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.employeeid ASC";
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
		echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
    echo "</td>";

		echo "</form>";
	echo "</tr>";
	echo "</table>";
  } // endif accesslevel >= 4

  echo "</td></tr>";

	//
	// display individual info based on selected dropdown personnel
	//
	if($employeeid != "") {
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
	// query personnel
	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday, tblhrtapaygrpemplst.projcode, tblhrtapaygrpemplst.projchgtyp, tblhrtapaygrpemplst.allowotdflt, tblhrtapaygrpemplst.allowotbfidflt, tblhrtapaygrpemplst.activesw, tblhrtapaygrpemplst.projassignid FROM tblhrtapaygrpemplst LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\" AND tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup";
	$result14=""; $found14=0;
	/*
	$result14 = mysql_query("", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
	*/
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$name_last14 = $myrow14['name_last'];
		$name_first14 = $myrow14['name_first'];
		$name_middle14 = $myrow14['name_middle'];
		$contact_gender14 = $myrow14['contact_gender'];
		$idhrtapayshiftctg14 = $myrow14['idhrtapayshiftctg'];
		$bankacctid14 = $myrow14['bankacctid'];
		$restday14 = $myrow14['restday'];
		$projcode14 = $myrow14['projcode'];
		$projchgtyp14 = $myrow14['projchgtyp'];
		$allowotdflt14 = $myrow14['allowotdflt'];
		$allowotbfidflt14 = $myrow14['allowotbfidflt'];
		$activesw14 = $myrow14['activesw'];
    $projassignid14 = $myrow14['projassignid'];
		}
	}

	echo "<form action=\"hrtimeattindivinfoupd.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"hrtimeattindivinfoupd\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";

	// row0
	echo "<tr><th colspan=\"6\">Details for employee no.: $employeeid</th></tr>";
	/*
	echo "<tr><td colspan=\"2\">columnA</td>";
	echo "<td colspan=\"2\">columnB</td>";
	echo "<td colspan=\"2\">columnC</td></tr>";
	*/
	// row1
	echo "<tr>";
	echo "<td align=\"right\">Last name:</td><th align=\"left\">".strtoupper($name_last14)."</th>";
	echo "<td align=\"right\">First name:</td><th align=\"left\">".strtoupper($name_first14)."</th>";
	echo "<td align=\"right\">Middle name:</td><th align=\"left\">".strtoupper($name_middle14)."</th>";
	echo "</tr>";
	$res11query = "SELECT tblempdetails.empdepartment, tblempdetails.empposition, tblempdetails.idhrpositionctg, tbldeptcd.name AS deptname, tblhrpositionctg.name AS posname FROM tblempdetails LEFT JOIN tbldeptcd ON tblempdetails.empdepartment=tbldeptcd.code LEFT JOIN tblhrpositionctg ON tblempdetails.idhrpositionctg=tblhrpositionctg.idhrpositionctg WHERE tblempdetails.employeeid=\"$employeeid\"";
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
		$empdepartment11 = $myrow11['empdepartment'];
		$idhrpositionctg11 = $myrow11['idhrpositionctg'];
		$empposition11 = $myrow11['empposition'];
		$deptname11 = $myrow11['deptname'];
		$posname11 = $myrow11['posname'];
		}
	}
	$res12query = "SELECT date_hired, emp_status, emp_tin, emp_sss, emp_philhealth, emp_pagibig, emptaxstatus FROM tblemployee WHERE employeeid=\"$employeeid\"";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$date_hired12 = $myrow12['date_hired'];
		$emp_status12 = $myrow12['emp_status'];
		$emp_tin12 = $myrow12['emp_tin'];
		$emp_sss12 = $myrow12['emp_sss'];
		$emp_philhealth12 = $myrow12['emp_philhealth'];
		$emp_pagibig12 = $myrow12['emp_pagibig'];
		$emptaxstatus12 = $myrow12['emptaxstatus'];
		}
	}
	$result14=""; $found14=0; $ctr14=0;
	if($emp_status12 == "R") {
	$res14query = "SELECT projassignid, proj_code, salary, salarycurrency FROM tblprojassign WHERE employeeid=\"$employeeid\" AND salary<>0 AND ref_no LIKE \"NSA%\" ORDER BY durationfrom DESC LIMIT 1";
	} else if($emp_status12 == "T") {
	$res14query = "SELECT projassignid, proj_code, salary, salarycurrency FROM tblprojassign WHERE employeeid=\"$employeeid\" AND salary<>0 AND ref_no LIKE \"SAT%\" ORDER BY durationfrom DESC LIMIT 1";
	} else if($emp_status12 == "P") {
	$res14query = "SELECT projassignid, proj_code, salary, salarycurrency FROM tblprojassign WHERE employeeid=\"$employeeid\" AND salary<>0 AND ref_no LIKE \"PR%\" ORDER BY durationfrom DESC LIMIT 1";
	}
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$projassignid = $myrow14['projassignid'];
		$proj_code14 = $myrow14['proj_code'];
		$salary14 = $myrow14['salary'];
		$salarycurrency14 = $myrow14['salarycurrency'];
		}
	}

	//
	// row2
	echo "<tr>";
	echo "<td align=\"right\">Department:</td><th align=\"left\">$deptname11</th>";
	//
	// VL
	echo "<td align=\"right\">Vacation Leave:</td><th align=\"left\">";
	// query tblhrtaempleavesumm for bal
	$where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=2 AND tblhrtaleavectg.code=\"vacation\")";
	$orderby17="tblhrtaempleavesumm.datestart DESC";
	include './hrtimeattqrylvsumm.php';
	if($found17==1) {
	$vlbal17=$bal17;
	echo "<input name=\"vlbal\" size=\"3\" value=\"$vlbal17\">";
	} else {
	// query tblhrtaleavectg for quota
	$where18="tblhrtaleavectg.idhrtaleavectg=2 AND tblhrtaleavectg.code=\"vacation\"";
	include './hrtimeattqrylvctg.php';
	echo "<input name=\"vlbal\" size=\"3\" value=\"$quota18\">";
	} // if
	echo "</th>";
	//
	// SL
	echo "<td align=\"right\">Sick Leave:</td><th align=\"left\">";
	// query tblhrtaempleavesumm for bal
	$where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=1 AND tblhrtaleavectg.code=\"sick\")";
	$orderby17="tblhrtaempleavesumm.datestart DESC";
	include './hrtimeattqrylvsumm.php';
	if($found17==1) {
	$slbal17=$bal17;
	echo "<input name=\"slbal\" size=\"3\" value=\"$slbal17\">";
	} else {
	// query tblhrtaleavectg for quota
	$where18="tblhrtaleavectg.idhrtaleavectg=1 AND tblhrtaleavectg.code=\"sick\"";
	include './hrtimeattqrylvctg.php';
	echo "<input name=\"slbal\" size=\"3\" value=\"$quota18\">";
	} // if
	echo "</th>";
	echo "</tr>";

	//
	// row3
	echo "<tr>";
	echo "<td align=\"right\">Position:</td><th align=\"left\">";
	if($accesslevel>=4) {
	if($idhrpositionctg11!=0) {
	echo "$posname11";
	} else {
	echo "$empposition11";
	} // if
	} else {
	echo "<font color=\"red\">Confidential</font>";
	} // if
	echo "</th>";
	//
	// Paternity
	if($contact_gender14 == "Male") {
	echo "<td align=\"right\">Paternity leave:</td><th align=\"left\">";
	// query tblhrtaempleavesumm for bal
	$where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=3 AND tblhrtaleavectg.code=\"paternity\")";
	$orderby17="tblhrtaempleavesumm.datestart DESC";
	include './hrtimeattqrylvsumm.php';
	if($found17==1) {
	$paterbal17=$bal17;
	echo "<input name=\"paterbal\" size=\"3\" value=\"$paterbal17\">";
	} else {
	// query tblhrtaleavectg for quota
	$where18="tblhrtaleavectg.idhrtaleavectg=3 AND tblhrtaleavectg.code=\"paternity\"";
	include './hrtimeattqrylvctg.php';
	echo "<input name=\"paterbal\" size=\"3\" value=\"$quota18\">";
	} // if
	echo "</th>";
	//
	// Maternity (N+CS)
	} else if($contact_gender14 == "Female") {
	echo "<td align=\"right\">Maternity leave:</td><th align=\"left\" nowrap>";
	// query tblhrtaempleavesumm for bal
	$where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=4 AND tblhrtaleavectg.code=\"maternityn\")";
	$orderby17="tblhrtaempleavesumm.datestart DESC";
	include './hrtimeattqrylvsumm.php';
	if($found17==1) {
	$maternbal17=$bal17;
	echo "<input name=\"maternbal\" size=\"3\" value=\"$maternbal17\">";
	} else {
	// query tblhrtaleavectg for quota
	$where18="tblhrtaleavectg.idhrtaleavectg=4 AND tblhrtaleavectg.code=\"maternityn\"";
	include './hrtimeattqrylvctg.php';
	echo "<input name=\"maternbal\" size=\"3\" value=\"$quota18\">";
	} // if
	echo "-N<br>";
	// query tblhrtaempleavesumm for bal
	$where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=5 AND tblhrtaleavectg.code=\"maternityc\")";
	$orderby17="tblhrtaempleavesumm.datestart DESC";
	include './hrtimeattqrylvsumm.php';
	if($found17==1) {
	$matercbal17=$bal17;
	echo "<input name=\"matercbal\" size=\"3\" value=\"$matercbal17\">";
	} else {
	// query tblhrtaleavectg for quota
	$where18="tblhrtaleavectg.idhrtaleavectg=5 AND tblhrtaleavectg.code=\"maternityc\"";
	include './hrtimeattqrylvctg.php';
	echo "<input name=\"matercbal\" size=\"3\" value=\"$quota18\">";
	} // if
	echo "-CS</th>";
	}
	//
	// VLCC
	// echo "<td align=\"right\">VL Cash Conversion:</td><th align=\"left\">";
	// query tblhrtaempleavesumm for bal
	// $where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=12 AND tblhrtaleavectg.code=\"vlcc\")";
	// $orderby17="tblhrtaempleavesumm.datestart DESC";
	// include './hrtimeattqrylvsumm.php';
	// if($found17==1) {
	// $vlcshcnv17=$bal17;
	// echo "<input name=\"vlcshcnv\" size=\"3\" value=\"$vlcshcnv17\">";
	// } else {
	// query tblhrtaleavectg for quota
	// $where18="tblhrtaleavectg.idhrtaleavectg=12 AND tblhrtaleavectg.code=\"vlcc\"";
	// include './hrtimeattqrylvctg.php';
	// echo "<input name=\"vlcshcnv\" size=\"3\" value=\"$quota18\">";
	// } // if
	//
	// Special lv
	echo "<td align=\"right\">Special Leave:</td><th align=\"left\">";
	// query tblhrtaempleavesumm for bal
	$where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=6 AND tblhrtaleavectg.code=\"special\")";
	$orderby17="tblhrtaempleavesumm.datestart DESC";
	include './hrtimeattqrylvsumm.php';
	if($found17==1) {
	$splbal17=$bal17;
	echo "<input name=\"splbal\" size=\"3\" value=\"$splbal17\">";
	} else {
	// query tblhrtaleavectg for quota
	$where18="tblhrtaleavectg.idhrtaleavectg=6 AND tblhrtaleavectg.code=\"special\"";
	include './hrtimeattqrylvctg.php';
	echo "<input name=\"splbal\" size=\"3\" value=\"$quota18\">";
	} // if
	//
	// SLCC
	// echo "<td align=\"right\">SL Cash Conversion:</td><th align=\"left\">";
	// query tblhrtaempleavesumm for bal
	// $where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=14 AND tblhrtaleavectg.code=\"slcc\")";
	// $orderby17="tblhrtaempleavesumm.datestart DESC";
	// include './hrtimeattqrylvsumm.php';
	// if($found17==1) {
	// $slcshcnv17=$bal17;
	// echo "<input name=\"slcshcnv\" size=\"3\" value=\"$slcshcnv17\">";
	// } else {
	// query tblhrtaleavectg for quota
	// $where18="tblhrtaleavectg.idhrtaleavectg=14 AND tblhrtaleavectg.code=\"slcc\"";
	// include './hrtimeattqrylvctg.php';
	// echo "<input name=\"slcshcnv\" size=\"3\" value=\"$quota18\">";
	// } // if
	echo "</th></tr>";

	//
	// row4
	echo "<tr>";
	echo "<td align=\"right\">Date hired:</td><th align=\"left\">".date("Y-M-d", strtotime($date_hired12))."";
	echo "</th>";
	echo "<td align=\"right\">Allow OT before IN default:</td><th align=\"left\">";
	if($allowotbfidflt14==1) { $allowotbfidfltselyes="selected"; $allowotbfidfltselno=""; }
	else if($allowotbfidflt14==0) { $allowotbfidfltselyes=""; $allowotbfidfltselno="selected"; }
	echo "<select name=\"allowotbfidflt\">";
	echo "<option value=\"0\" $allowotbfidfltselno>No</option>";
	echo "<option value=\"1\" $allowotbfidfltselyes>Yes</option>";
	echo "</select></th>";
	echo "<td align=\"right\">Allow OT default:</td><th align=\"left\">";
	if($allowotdflt14==1) { $allowotdfltselyes="selected"; $allowotdfltselno=""; }
	else if($allowotdflt14==0) { $allowotdfltselyes=""; $allowotdfltselno="selected"; }
	echo "<select name=\"allowotdflt\">";
	echo "<option value=\"0\" $allowotdfltselno>No</option>";
	echo "<option value=\"1\" $allowotdfltselyes>Yes</option>";
	echo "</select></th>";
	echo "</tr>";

	//
	// row5
	echo "<tr>";
	// echo "<td align=\"right\">Employment status:</td><th align=\"left\">$emp_status12</th>";

  // 20200107
  echo "<td align=\"right\">Basic salary:</td>";
  // echo "<th align=\"left\">".strtoupper($salarycurrency14)."&nbsp;".number_format($salary14, 2)."</th>";
  echo "<th colspan=\"5\" align=\"left\">";
  echo "<select name=\"projassignid\">";
  // query projassignid, provide dropdown selection
  if($projassignid14==0) {
    echo "<option value=0>select salary rate</option>";
  } // if
  $result21=""; $res21query=""; $found21=0; $ctr21=0;
  $res21query="SELECT projassignid, ref_no, proj_code, proj_name, salary, salarycurrency, salarytype, durationfrom, durationto, idhrpositionctg FROM tblprojassign WHERE employeeid=\"$employeeid\" AND salary<>0 ORDER BY durationfrom DESC";
  $result21=$dbh2->query($res21query);
  if($result21->num_rows>0) {
    while($myrow21=$result21->fetch_assoc()) {
    $found21=1;
    $projassignid21 = $myrow21['projassignid'];
    $ref_no21 = $myrow21['ref_no'];
    $proj_code21 = $myrow21['proj_code'];
    $proj_name21 = $myrow21['proj_name'];
    $salary21 = $myrow21['salary'];
    $salarycurrency21 = $myrow21['salarycurrency'];
    $salarytype21 = $myrow21['salarytype'];
    $durationfrom21 = $myrow21['durationfrom'];
    $durationto21 = $myrow21['durationto'];
    $idhrpositionctg21 = $myrow21['idhrpositionctg'];
    if($projassignid21==$projassignid14) { $projassignidsel="selected"; } else { $projassignidsel=""; }
    echo "<option value=\"$projassignid21\" $projassignidsel>$ref_no21 - $proj_code21 - $proj_name21 - $salary21 - $salarycurrency21 - $salarytype21 - $durationfrom21-to-$durationto21</option>";
    } // while
  } // if
  echo "</select>";
  echo "</th>";
	//
	// Retained SL cr
	// echo "<td align=\"right\">Retained SL credit:</td><th align=\"left\"><input name=\"slretcr\" size=\"3\" value=\"$slretcr17\"></th>";
	// echo "<td></td><th></th>";
	echo "</tr>";

	//
	// row6
	// echo "<tr>";
	//
	// Retained VL cr
	// echo "<td align=\"right\">Retained VL credit:</td><th align=\"left\"><input name=\"vlretcr\" size=\"3\" value=\"$vlretcr17\"></th>";
	// echo "<td></td><th></th>";	
	//
	// VL Accumulated
	// echo "<td align=\"right\">Accumulated VL credit:</td><th align=\"left\"><input name=\"vlaccumcr\" size=\"3\" value=\"$vlaccumcr17\"></th>";
	// echo "<td></td><th></th>";
	//
	// SL Accumulated
	// echo "<td align=\"right\">Accumulated SL credit:</td><th align=\"left\"><input name=\"slaccumcr\" size=\"3\" value=\"$slaccumcr17\"></th>";
	// echo "<td></td><th></th>";
	// echo "</tr>";

	// row7
	echo "<tr>";
	echo "<td align=\"right\">Bank account:</td><th align=\"left\" colspan=\"3\">";
	echo "<select name=\"bankacctid\">";
	// if($bankacctid14 == 0 || $bankacctid14 == "") { echo "<option value=''>select</option>"; }
	$res15query = "SELECT bankacctid, bank_name, bank_branch, acct_name, acct_num, acct_type, acct_currency, payrolldflt FROM tblbankacct WHERE employeeid=\"$employeeid\"";
	$result15=""; $found15=0; $ctr15=0;
	/*
	$result15 = mysql_query("", $dbh);
	if($result15 != "") {
		while($myrow15 = mysql_fetch_row($result15)) {
	*/
	$result15 = $dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15 = $result15->fetch_assoc()) {
		$found15 = 1;
		$bankacctid15 = $myrow15['bankacctid'];
		$bank_name15 = $myrow15['bank_name'];
		$bank_branch15 = $myrow15['bank_branch'];
		$acct_name15 = $myrow15['acct_name'];
		$acct_num15 = $myrow15['acct_num'];
		$acct_type15 = $myrow15['acct_type'];
		$acct_currency15 = $myrow15['acct_currency'];
		$payrolldflt15 = $myrow15['payrolldflt'];
		// if($bankacctid15 == $bankacctid14) { $bankacctidsel="selected"; } else { $bankacctidsel=""; }
		if($payrolldflt15 == 1) { $bankacctidsel="selected"; } else { $bankacctidsel=""; }
		echo "<option value=\"$bankacctid15\" $bankacctidsel>";
		echo "$bank_name15";
		if($bank_branch != "") { echo "&nbsp;$bank_branch15"; }
		echo "&nbsp;$acct_num15";
		echo "&nbsp;$acct_type15";
		if($acct_currency15 != "" || $acct_currency15 != "Others") { echo "&nbsp;$acct_currency15"; }
		if($acct_currency15 != "") { echo "&nbsp;Acct_Name:&nbsp;$acct_name15"; }
		echo "</option>";
		}
	}
	echo "</select>";
	echo "</th>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	// modified 20161114
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// row8
	echo "<tr>";
	echo "<td align=\"right\">T.I.N.:</td><th align=\"left\">$emp_tin12</th>";
	echo "<td align=\"right\">Tax status:</td><th align=\"left\">$emptaxstatus12</th>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	// modified 20161114
	// echo "<td></td><th></th>";
  // 20200107 moved from row6
  echo "<td align=\"right\">Employment status:</td><th align=\"left\">$emp_status12</th>";
	echo "</tr>";

	// row9
	echo "<tr>";
	echo "<td align=\"right\">SSS:</td><th align=\"left\">$emp_sss12</th>";
	echo "<td align=\"right\">Shift category</td><th align=\"left\" colspan=\"3\">";
	echo "<select name=\"idhrtapayshiftctg\">";
	if($idhrtapayshiftctg14 == 0 || $idhrtapayshiftctg14 == "") { echo "<option value=''>select</option>"; }
	$res16query = "SELECT idhrtapayshiftctg, shiftin, shiftout, lunchstart, lunchend FROM tblhrtapayshiftctg ORDER BY shiftin ASC";
	$result16=""; $found16=0; $ctr16=0;
	/*
	$result16 = mysql_query("", $dbh);
	if($result16 != "") {
		while($myrow16 = mysql_fetch_row($result16)) {
	*/
	$result16 = $dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16 = $result16->fetch_assoc()) {
		$found16 = 1;
		$idhrtapayshiftctg16 = $myrow16['idhrtapayshiftctg'];
		$shiftin16 = $myrow16['shiftin'];
		$shiftout16 = $myrow16['shiftout'];
		$lunchstart16 = $myrow16['lunchstart'];
		$lunchend16 = $myrow16['lunchend'];
		if($idhrtapayshiftctg16 == $idhrtapayshiftctg14) { $idhrtapscsel="selected"; } else { $idhrtapscsel=""; }
		echo "<option value=\"$idhrtapayshiftctg16\" $idhrtapscsel>".date("H:i", strtotime($shiftin16))."-".date("H:i", strtotime($lunchstart16))." -to- ".date("H:i", strtotime($lunchend16))."-".date("H:i", strtotime($shiftout16))."</option>";
		} // while
	} // if
	echo "</select>";
	echo "</th>";
	// echo "<td></td><th></th>";
	echo "</tr>";

	// row10
	echo "<tr>";
	echo "<td align=\"right\">Philhealth:</td><th align=\"left\">$emp_philhealth12</th>";
echo "<td align=\"right\">Rest day</td><td align=\"left\" colspan=\"3\">";
	echo "<table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><td>";
	if(substr("$restday14", 0, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaysun\" checked>";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaysun\">";
	}
	echo "<br><font color=\"1\"><i>sun</i></font></td><td>";
	if(substr("$restday14", 1, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaymon\" checked>";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaymon\">";
	}
	echo "<br><font color=\"1\"><i>mon</i></font></td><td>";
	if(substr("$restday14", 2, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaytue\" checked>";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaytue\">";
	}
	echo "<br><font color=\"1\"><i>tue</i></font></td><td>";
	if(substr("$restday14", 3, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaywed\" checked>";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaywed\">";
	}
	echo "<br><font color=\"1\"><i>wed</i></font></td><td>";
	if(substr("$restday14", 4, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaythu\" checked>";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaythu\">";
	}
	echo "<br><font color=\"1\"><i>thu</i></font></td><td>";
	if(substr("$restday14", 5, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdayfri\" checked>";
	} else {
		echo "<input type=\"checkbox\" name=\"restdayfri\">";
	}
	echo "<br><font color=\"1\"><i>fri</i></font></td><td>";
	if(substr("$restday14", 6, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaysat\" checked>";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaysat\">";
	}
	echo "<br><font color=\"1\"><i>sat</i></font></td></tr>";
	echo "</table>";
	echo "</td>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// row11
	echo "<tr>";
	echo "<td align=\"right\">Pag-IBIG:</td><th align=\"left\">$emp_pagibig12</th>";
	echo "<td align=\"right\">Project charge type:</td><th align=\"left\" colspan=\"3\">";
	/*
	echo "<select name=\"projcode\">";
	// updated 20161102
	// -start-
	// $res19sel="SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 ORDER BY proj_code DESC";
	$res19sel="SELECT DISTINCT tblprojassign.proj_code, tblprojassign.proj_name, tblproject1.proj_fname FROM tblprojassign LEFT JOIN tblproject1 ON tblprojassign.proj_code=tblproject1.proj_code WHERE tblprojassign.employeeid=\"$employeeid\" ORDER BY tblprojassign.durationto DESC, tblprojassign.durationto2 DESC";
	$result19=""; $found19=0; $ctr19=0;
	$result19 = mysql_query("$res19sel", $dbh);
	if($result19 != "") {
		while($myrow19 = mysql_fetch_row($result19)) {
		$found19 = 1;
		// $projectid19 = $myrow19[0];
		$proj_code19 = $myrow19[0];
		$proj_name19 = $myrow19[1];
		$proj_fname19 = $myrow19[2];
		// $proj_sname19 = $myrow19[3];
		if($projcode14 == "") {
			if($proj_code19 == "C00-001") { $projcdsel="selected"; } else { $projcdsel=""; }
		} else {
			if($proj_code19 == $projcode14) { $projcdsel="selected"; } else { $projcdsel=""; }
		} // end if($projcode14 == "")
		echo "<option value=\"$proj_code19\" $projcdsel>$proj_code19 - ";
		if($proj_name19 != "") {
		echo "$proj_name19";
		} else {
		echo "".substr($proj_fname19, 0, 30)."";
		}
		echo "</option>";
		} // end while($myrow19 = mysql_fetch_row($result19))
	} // end if($result19 != "")
	// -end-
	echo "</select>";
	*/
	echo "<select name=\"projchgtyp\">";
	if($projchgtyp14 != "") {
		if($projchgtyp14 == "percent") { $projchgtyppctsel="selected"; $projchgtypdlysel=""; } else if($projchgtyp14 == "daily") { $projchgtyppctsel=""; $projchgtypdlysel="selected"; }
	} else { echo "<option value=''>select</option>"; }
	echo "<option value=\"percent\" $projchgtyppctsel>percentage</option>";
	echo "<option value=\"daily\" $projchgtypdlysel>daily</option>";
	echo "</select>";
	if($projchgtyp14=='daily') {
	// disp default proj_code dropdown
	$res20query="SELECT DISTINCT tblproject1.proj_code, tblproject1.proj_sname, tblproject1.proj_fname FROM tblproject1 WHERE ((tblproject1.proj_code>=\"C00-001\" AND tblproject1.proj_code<=\"C00-002\") OR tblproject1.proj_code>=\"C2008-01\") ORDER BY tblproject1.proj_code DESC";
	$result20=""; $found20=0; $ctr20=0;
	echo "<br /><select name=\"projcode\">";
	$result20=$dbh2->query($res20query);
	if($result20->num_rows>0) {
		while($myrow20=$result20->fetch_assoc()) {
		$found20=1;
		$proj_code20 = $myrow20['proj_code'];
		$proj_sname20 = $myrow20['proj_sname'];
		$proj_fname20 = $myrow20['proj_fname'];
		if($projcode14=='') {
			if($proj_code20 == "C00-001") { $projcdsel="selected"; } else { $projcdsel=""; }
		} else {
			if($proj_code20 == $projcode14) { $projcdsel="selected"; } else { $projcdsel=""; }
		} // if-else
		echo "<option value=\"$proj_code20\" $projcdsel>$proj_code20 - ";
		if($proj_sname20 != "") {
		echo "$proj_sname20";
		} else {
		echo "".substr($proj_fname20, 0, 30)."";
		} // if-else
		echo "</option>";
		} // while
	} // if
	echo "</select>";
	} // if
	echo "</th>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// row12
	echo "<tr>";
	echo "<td align=\"right\"></td><th align=\"left\"></th>";
	if($activesw14 == 1) { $activeswsel="checked"; } else if($activesw14 == 0) { $activeswsel=""; }
	echo "<td align=\"right\">Active status:</td><th align=\"left\"><input type=\"checkbox\" name=\"activesw\" $activeswsel></th>";
	echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	echo "<tr><td colspan=\"6\" align=\"center\"><button type=\"submit\" class=\"btn btn-success\">Update</button></td></tr>";
	echo "</form>";
	echo "</table>";
	echo "</td></tr>";
	}

	// display manage project percentage
	if($projchgtyp14 == "percent") {
		echo "<tr><th colspan=\"2\">Project percentage info</th></tr>";
		// disp labels
		echo "<tr><th>Add project percentage</th><th>Result/s</th></tr>";
		echo "<tr><td>";
		//
		// col1: mng projpct
			echo "<table class=\"fin\">";
			echo "<form action=\"hrtimeattindivprojpctadd.php?loginid=$loginid\" method=\"POST\" name=\"hrtimeattindivprojpctadd\">";
			echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
			$idcutoff=0;
			echo "<input type=\"hidden\" name=\"idcutoff\" value=\"$idcutoff\">";
			echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
			echo "<tr><th align=\"right\">Project</th><td>";
			echo "<select name=\"projcode\">";
			// query, disp dropdown of tblprojassign left join tblproject1 tblprojassign
			// $res17query="SELECT DISTINCT tblprojassign.proj_code, tblprojassign.proj_name, tblproject1.proj_fname FROM tblprojassign LEFT JOIN tblproject1 ON tblprojassign.proj_code=tblproject1.proj_code WHERE tblprojassign.employeeid=\"$employeeid\" ORDER BY tblprojassign.durationto DESC, tblprojassign.durationto2 DESC";
			$res17query="SELECT DISTINCT tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname FROM tblproject1 ORDER BY tblproject1.proj_code DESC";
			$result17=""; $found17=0; $ctr17=0;
			$result17=$dbh2->query($res17query);
			if($result17->num_rows>0) {
				while($myrow17=$result17->fetch_assoc()) {
				$found17=1;
				$proj_code17 = $myrow17['proj_code'];
				$proj_fname17 = $myrow17['proj_fname'];
				$proj_sname17 = $myrow17['proj_sname'];
				echo "<option value=\"$proj_code17\">";
				if($proj_sname17!='') {
					if($proj_code17!='') {
					echo "$proj_code17&nbsp;-&nbsp;";
					} // if
				echo "$proj_sname17";
				} else {
					if($proj_code17!='') {
					echo "$proj_code17&nbsp;-&nbsp;";
					} // if
				echo "".substr($proj_fname17, 0, 30)."";
				} // if-else
				echo "</option>";
				} // while
			} // if
			echo "</select>";
			echo "</td>";
			echo "<tr><th align=\"right\">Percent</th><td><input type=\"number\" min=\"0\" max=\"100\" step=\"1\" name=\"projpercent\" value=\"0\" /></td>";
			echo "<tr><td colspan=\"2\" align=\"center\"><button type=\"submit\" class=\"btn btn-success\">Add</button></td></tr>";
			echo "</form>";
			echo "</table>";
		echo "</td><td>";
		//
		// cols2: disp projpct
			echo "<table class=\"fin\">";
			// query tblhrtaempprojpct
			$res18query="SELECT tblhrtaempprojpct.idhrtaempprojpct, tblhrtaempprojpct.projcode, tblhrtaempprojpct.projpercent, proj_sname, proj_fname FROM tblhrtaempprojpct LEFT JOIN tblproject1 ON tblhrtaempprojpct.projcode=tblproject1.proj_code WHERE tblhrtaempprojpct.employeeid=\"$employeeid\" AND tblhrtaempprojpct.idpaygroup=$idpaygroup AND tblhrtaempprojpct.idcutoff=0";
			$result18=""; $found18=0; $ctr18=0;
			$result18=$dbh2->query($res18query);
			if($result18->num_rows>0) {
				while($myrow18=$result18->fetch_assoc()) {
				$found18=1;
				$idhrtaempprojpct18 = $myrow18['idhrtaempprojpct'];
				$projcode18 = $myrow18['projcode'];
				$projpercent18 = $myrow18['projpercent'];
				$proj_sname18 = $myrow18['proj_sname'];
				$proj_fname18 = $myrow18['proj_fname'];
				$projpcttot = $projpcttot + $projpercent18;
				echo "<tr><td>";
				if($projcode18!='') { echo "$projcode18&nbsp;-&nbsp;"; }
				if($proj_sname18!='') {
					echo "$proj_sname18";
				} else {
					echo "".substr($proj_fname18, 0, 30)."";
				} // if-else
				echo "</td>";
				echo "<td align=\"right\">$projpercent18&nbsp;%</td>";
			echo "<form action=\"hrtimeattindivprojpctdel.php?loginid=$loginid\" method=\"POST\" name=\"hrtimeattindivprojpctdel\">";
			echo "<input type=\"hidden\" name=\"idhrtaempprojpct\" value=\"$idhrtaempprojpct18\">";
			echo "<td>";
			echo "<button type=\"submit\" class=\"btn btn-danger\">Del</button>";
			echo "</td>";
			echo "</form>";
				echo "</tr>";
				} // while
			} // if
			if($found18==1) {
			echo "<tr><td><strong>Total</strong></td><td align=\"right\"><strong>$projpcttot&nbsp;%</strong></td>";
			echo "</tr>";
			} // if
			echo "</table>";
		echo "</td></tr>";
	} // if

// end contents here...

     echo "</table>";

// edit body-footer
     // echo "<p><a href=\"hrtimeatt.php?loginid=$loginid\">Back</a></p>";
	 echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"hrtimeatt.php?loginid=$loginid\">Back</a></button></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
