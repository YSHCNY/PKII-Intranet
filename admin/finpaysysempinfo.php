<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }

$filesrc = "finpaysysempinfo";

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Payroll System >> Individual info</font></p>";

    echo "<div class = 'row p-4 border shadow'>";
	echo "<h4 class = 'mb-0 pb-0 mt-4'>Personnel Information (from HRD)</h4>";
	echo "</div>";
	
     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

  echo "<tr><td colspan=\"2\">";

  if($accesslevel >= 4)
  {
	echo "<table class=\"fin\" border=\"0\">";
	echo "<tr>";
		echo "<form action=\"finpaysysempinfo.php?loginid=$loginid\" method=\"post\" name=\"finpaysysempinfo\">";

		// pay group name dropdown
    echo "<td><div class='form-group'><select class='form-control' name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select paygroup</option>";
		$res11query=""; $result11=""; $found11=0; $ctr11=0;
		$res11query = "SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
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
		echo "</select></div></td>";

		// individual personnel dropdown
		if($idpaygroup != "") {
		echo "<td><div class='form-group'>";
		echo "<select class='form-control' name=\"empid\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select personnel</option>";
		$res12query=""; $result12=""; $found12=0;
		$res12query = "SELECT tblhrtapaygrpemplst.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtapaygrpemplst LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup AND tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
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
		echo "</div></td>";
		}

		// submit button
		echo "<td>";
		echo "<button type=\"submit\" class='btn btn-primary'>Submit</button>";
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
	$res14query=""; $result14=""; $found14=0;
	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday, tblhrtapaygrpemplst.projcode, tblhrtapaygrpemplst.projchgtyp, tblhrtapaygrpemplst.allowotdflt, tblhrtapaygrpemplst.allowotbfidflt, tblhrtapaygrpemplst.activesw, tblhrtapaygrpemplst.flexitime FROM tblhrtapaygrpemplst LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\" AND tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup";
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
		$flexitime14 = $myrow14['flexitime'];
		}
	}

	// query leave summary
	$res17query=""; $result17=""; $found17=0; $ctr17=0;
	$res17query = "SELECT idhrtaempleavesumm, paygroupname, dateanniv, dateupd, vlquota, vlbal, vlcshcnv, vlaccumcr, vlretcr, vlforfeit, slquota, slbal, slcshcnv, slaccumcr, slretcr, slforfeit, splquota, splbal, paterquota, paterbal, maternquota, maternbal, matercquota, matercbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup ORDER BY dateupd DESC LIMIT 1";
	$result17 = $dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17 = $result17->fetch_assoc()) {
		$found17 = 1;
		$idhrtaempleavesumm17 = $myrow17['idhrtaempleavesumm'];
		$paygroupname17 = $myrow17['paygroupname'];
		$dateanniv17 = $myrow17['dateanniv'];
		$dateupd17 = $myrow17['dateupd'];
		$vlquota17 = $myrow17['vlquota'];
		$vlbal17 = $myrow17['vlbal'];
		$vlcshcnv17 = $myrow17['vlcshcnv'];
		$vlaccumcr17 = $myrow17['vlaccumcr'];
		$vlretcr17 = $myrow17['vlretcr'];
		$vlforfeit17 = $myrow17['vlforfeit'];
		$slquota17 = $myrow17['slquota'];
		$slbal17 = $myrow17['slbal'];
		$slcshcnv17 = $myrow17['slcshcnv'];
		$slaccumcr17 = $myrow17['slaccumcr'];
		$slretcr17 = $myrow17['slretcr'];
		$slforfeit17 = $myrow17['slforfeit'];
		$splquota17 = $myrow17['splquota'];
		$splbal17 = $myrow17['splbal'];
		$paterquota17 = $myrow17['paterquota'];
		$paterbal17 = $myrow17['paterbal'];
		$maternquota17 = $myrow17['maternquota'];
		$maternbal17 = $myrow17['maternbal'];
		$matercquota17 = $myrow17['matercquota'];
		$matercbal17 = $myrow17['matercbal'];
		}
	}
	if($found17 == 0) {
		// initialize leave credits to zeroes
		$vlbal17=0; $vlcshcnv17=0; $vlaccumcr17=0; $vlretcr17=0; $slbal17=0; $slcshcnv17=0; $paterbal17=0; $maternbal17=0; $matercbal17=0; $slaccumcr17=0; $slretcr17=0; $splbal17=0;
		// query leave credit defaults
		$res18sel=""; $result18=""; $found18=0; $ctr18=0;
		$res18sel="SELECT idhrtaleavectg, code, name, quota FROM tblhrtaleavectg";
		$result18 = $dbh2->query($res18sel);
		if($result18->num_rows>0) {
			while($myrow18 = $result18->fetch_assoc()) {
			$found18 = 1;
			$idhrtaleavectg18 = $myrow18['idhrtaleavectg'];
			$code18 = $myrow18['code'];
			$name18 = $myrow18['name'];
			$quota18 = $myrow18['quota'];
			if($code18 == "sick") { $slbal17=$quota18; }
			if($code18 == "vacation") { $vlbal17=$quota18; }
			if($code18 == "paternity") { $paterbal17=$quota18; }
			if($code18 == "maternityn") { $maternbal17=$quota18; }
			if($code18 == "maternityc") { $matercbal17=$quota18; }
			if($code18 == "special") { $splbal17=$quota18; }
			}
		}
	}

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
	$res11query=""; $result11=""; $found11=0; $ctr11=0;
	$res11query = "SELECT tblempdetails.empdepartment, tblempdetails.empposition, tblempdetails.idhrpositionctg, tbldeptcd.name FROM tblempdetails LEFT JOIN tbldeptcd ON tblempdetails.empdepartment=tbldeptcd.code WHERE tblempdetails.employeeid=\"$employeeid\"";
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$empdepartment11 = $myrow11['empdepartment'];
		$empposition11 = $myrow11['empposition'];
		$idhrpositionctg11 = $myrow11['idhrpositionctg'];
		$deptname11 = $myrow11['name'];
		}
	}
	if($idhrpositionctg11!=0) {
		// query Position
		$res11bquery=""; $result11b=""; $found11b=0;
		$res11bquery="SELECT `name` AS `positionname` FROM `tblhrpositionctg` WHERE `idhrpositionctg`=$idhrpositionctg11";
		$result11b=$dbh2->query($res11bquery);
		if($result11b->num_rows>0) {
			while($myrow11b=$result11b->fetch_assoc()) {
				$found11b=1;
				$positionname11b=$myrow11b['positionname'];
			} //while
		} //if
	} //if
	$res12query=""; $result12=""; $found12=0; $ctr12=0;
	$res12query = "SELECT date_hired, emp_status, emp_tin, emp_sss, emp_philhealth, emp_pagibig, emptaxstatus FROM tblemployee WHERE employeeid=\"$employeeid\"";
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
	$res14bquery=""; $result14b=""; $found14b=0; $ctr14b=0;
	if($emp_status12 == "R") {
	$res14bquery = "SELECT projassignid, proj_code, salary, salarycurrency FROM tblprojassign WHERE employeeid=\"$employeeid\" AND salary<>0 AND ref_no LIKE \"NSA%\" ORDER BY durationfrom DESC LIMIT 1";
	} else if($emp_status12 == "T") {
	$res14bquery = "SELECT projassignid, proj_code, salary, salarycurrency FROM tblprojassign WHERE employeeid=\"$employeeid\" AND salary<>0 AND ref_no LIKE \"SAT%\" ORDER BY durationfrom DESC LIMIT 1";
	} else if($emp_status12 == "P") {
	$res14bquery = "SELECT projassignid, proj_code, salary, salarycurrency FROM tblprojassign WHERE employeeid=\"$employeeid\" AND salary<>0 AND ref_no LIKE \"PR%\" ORDER BY durationfrom DESC LIMIT 1";
	}
	$result14b = $dbh2->query($res14bquery);
	if($result14b->num_rows>0) {
		while($myrow14b = $result14b->fetch_assoc()) {
		$found14b = 1;
		$projassignid = $myrow14b['projassignid'];
		$proj_code14 = $myrow14b['proj_code'];
		$salary14 = $myrow14b['salary'];
		$salarycurrency14 = $myrow14b['salarycurrency'];
		}
	}

	// row2
	echo "<tr>";
	echo "<td align=\"right\">Department:</td><th align=\"left\">$deptname11</th>";
	echo "<td align=\"right\">Vacation Leave:</td><th align=\"left\">$vlbal17</th>";
	echo "<td align=\"right\">Sick Leave:</td><th align=\"left\">$slbal17</th>";
	echo "</tr>";

	// row3
	echo "<tr>";
	echo "<td align=\"right\">Position:</td><th align=\"left\">";
	if($positionname11b!='') {
		echo "$positionname11b";
	} else {
	echo "$empposition11";
	} //if-else
	echo "</th>";
	echo "<td align=\"right\">VL Cash Conversion:</td><th align=\"left\">$vlcshcnv17</th>";
	echo "<td align=\"right\">SL Cash Conversion:</td><th align=\"left\">$slcshcnv17</th>";
	echo "</tr>";

	// row4
	echo "<tr>";
	echo "<td align=\"right\">Date hired:</td><th align=\"left\">".date("Y-M-d", strtotime($date_hired12))."</th>";
	echo "<td align=\"right\">Accumulated VL credit:</td><th align=\"left\">$vlaccumcr17</th>";
	echo "<td align=\"right\">Accumulated SL credit:</td><th align=\"left\">$slaccumcr17</th>";
	echo "</tr>";

	// row5
	echo "<tr>";
	echo "<td align=\"right\">Employment status:</td><th align=\"left\">$emp_status12</th>";
	echo "<td align=\"right\">Retained VL credit:</td><th align=\"left\">$vlretcr17</th>";
	echo "<td align=\"right\">Retained SL credit:</td><th align=\"left\">$slretcr17</th>";
	echo "</tr>";

	// row6
	echo "<tr>";
	echo "<td align=\"right\">Basic salary:</td><th align=\"left\">".strtoupper($salarycurrency14)."&nbsp;".number_format($salary14, 2)."</th>";
	if($contact_gender14 == "Male") {
	echo "<td align=\"right\">Paternity leave:</td>";
	echo "<th align=\"left\">$paterbal17</th>";
	} else if($contact_gender14 == "Female") {
	echo "<td align=\"right\">Maternity leave:</td>";
	echo "<th align=\"left\" nowrap>$maternbal17-N<br>$matercbal17-CS</th>";
	}
	echo "<td align=\"right\">Special Leave:</td><th align=\"left\">$splbal17</th>";
	echo "</tr>";

	// row7
	echo "<tr>";
	echo "<td align=\"right\">Bank account:</td><th align=\"left\" colspan=\"5\">";
	// if($bankacctid14 == 0 || $bankacctid14 == "") { echo "<option value=''>select</option>"; }
	$res15query=""; $result15=""; $found15=0; $ctr15=0;
	$res15query = "SELECT bankacctid, bank_name, bank_branch, acct_name, acct_num, acct_type, acct_currency, payrolldflt FROM tblbankacct WHERE employeeid=\"$employeeid\"";
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
		}
	}
	if($found15 == 1) {
		echo "$bank_name15";
		if($bank_branch != "") { echo "&nbsp;$bank_branch15"; }
		echo "&nbsp;$acct_num15";
		echo "&nbsp;$acct_type15";
		if($acct_currency15 != "" || $acct_currency15 != "Others") { echo "&nbsp;$acct_currency15"; }
		if($acct_currency15 != "") { echo "&nbsp;Acct_Name:&nbsp;$acct_name15"; }
	} // if($found15 == 1)
	echo "</th>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	// modified 20161114
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// row8
	echo "<tr>";
	echo "<td align=\"right\">T.I.N.:</td><th align=\"left\">$emp_tin12</th>";
	echo "<td align=\"right\">Tax status:</td><th align=\"left\" colspan='3'>$emptaxstatus12</th>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	// modified 20161114
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// row9
	echo "<tr>";
	echo "<td align=\"right\">SSS:</td><th align=\"left\">$emp_sss12</th>";
	echo "<td align=\"right\">Shift category</td><th align=\"left\"  colspan='3'>";
	if($flexitime14==1) {
	echo "flexi-time";	
	} else {
	$res16query=""; $result16=""; $found16=0; $ctr16=0;
	$res16query = "SELECT shiftin, shiftout FROM tblhrtapayshiftctg WHERE idhrtapayshiftctg=$idhrtapayshiftctg14";
	$result16 = $dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16 = $result16->fetch_assoc()) {
		$found16 = 1;
		// $idhrtapayshiftctg16 = $myrow16['idhrtapayshiftctg'];
		$shiftin16 = $myrow16['shiftin'];
		$shiftout16 = $myrow16['shiftout'];
		}
	}
	if($found16 == 1) {
		echo "$shiftin16 -to- $shiftout16";
	}		
	} //if-else
	echo "</th>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// row10
	echo "<tr>";
	echo "<td align=\"right\">Philhealth:</td><th align=\"left\">$emp_philhealth12</th>";
echo "<td align=\"right\">Rest day</td><td align=\"left\" colspan='3'>";
	echo "<table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><td>";
	if(substr("$restday14", 0, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaysun\" checked=\"checked\" disabled=\"disabled\">";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaysun\" disabled>";
	}
	echo "<br><font color=\"1\"><i>sun</i></font></td><td>";
	if(substr("$restday14", 1, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaymon\" checked=\"checked\" disabled=\"disabled\">";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaymon\" disabled>";
	}
	echo "<br><font color=\"1\"><i>mon</i></font></td><td>";
	if(substr("$restday14", 2, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaytue\" checked=\"checked\" disabled=\"disabled\">";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaytue\" disabled>";
	}
	echo "<br><font color=\"1\"><i>tue</i></font></td><td>";
	if(substr("$restday14", 3, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaywed\" checked=\"checked\" disabled=\"disabled\">";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaywed\" disabled>";
	}
	echo "<br><font color=\"1\"><i>wed</i></font></td><td>";
	if(substr("$restday14", 4, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaythu\" checked=\"checked\" disabled=\"disabled\">";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaythu\" disabled>";
	}
	echo "<br><font color=\"1\"><i>thu</i></font></td><td>";
	if(substr("$restday14", 5, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdayfri\" checked=\"checked\" disabled=\"disabled\">";
	} else {
		echo "<input type=\"checkbox\" name=\"restdayfri\" disabled>";
	}
	echo "<br><font color=\"1\"><i>fri</i></font></td><td>";
	if(substr("$restday14", 6, 1) == 1) {
		echo "<input type=\"checkbox\" name=\"restdaysat\" checked=\"checked\" disabled=\"disabled\">";
	} else {
		echo "<input type=\"checkbox\" name=\"restdaysat\" disabled>";
	}
	echo "<br><font color=\"1\"><i>sat</i></font></td></tr>";
	echo "</table>";
	echo "</td>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// echo "<form action=\"finpaysysempinfoupd.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"finpaysysempinfoupd\">";
	// echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";

	// row11
	echo "<tr>";
	echo "<td align=\"right\">Pag-IBIG:</td><th align=\"left\">$emp_pagibig12</th>";
	echo "<td align=\"right\">Project charge type:</td><th align=\"left\" colspan=\"3\">$projchgtyp14";
    if($projchgtyp14=='daily') {
	// disp default proj_code dropdown
	$res20query="SELECT DISTINCT tblproject1.proj_code, tblproject1.proj_sname, tblproject1.proj_fname FROM tblproject1 WHERE tblproject1.proj_code=\"$projcode14\"";
	$result20=""; $found20=0; $ctr20=0;
	$result20=$dbh2->query($res20query);
	if($result20->num_rows>0) {
		while($myrow20=$result20->fetch_assoc()) {
		$found20=1;
		$proj_code20 = $myrow20['proj_code'];
		$proj_sname20 = $myrow20['proj_sname'];
		$proj_fname20 = $myrow20['proj_fname'];
		echo " - $proj_code20";
		if($proj_sname20!="") {
		echo " - $proj_sname20";
		} else {
		echo "".substr($proj_fname20, 0, 30)."";
		} // if-else
		} // while
	} // if
	} // if
	echo "</th>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// row12
	echo "<tr>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	if($activesw14 == 1) { $activeswsel="checked"; } else if($activesw14 == 0) { $activeswsel=""; }
	echo "<td align=\"right\" colspan='3'>Active status:</td><th align=\"left\" colspan='3'><input type=\"checkbox\" name=\"activesw\" $activeswsel onclick=\"return false;\"></th>";
	// echo "<td align=\"right\"></td><th align=\"left\"></th>";
	echo "</tr>";

	// echo "<tr><td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Update\"></td></tr>";
	// echo "</form>";
	// echo "</table>";
	// echo "</td></tr>";

	// rows12-16
	if($projchgtyp14 != "" && $projchgtyp14 == "percent") {
	echo "<tr>";
	echo "<th colspan=\"6\">Percentage project charging:</td>";
	echo "</tr>";

	// proj percent 01
	echo "<tr><td colspan=\"3\"></td>";
	echo "<form action=\"finpaysysempprojchg.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"finpaysysempprojchg\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"set\" value=\"1\">";
	echo "<td align=\"left\"><select name=\"projchgpct01\">";
	// $res19aquery = "SELECT DISTINCT tblprojassign.proj_code, tblproject1.proj_fname, tblproject1.proj_sname FROM tblprojassign LEFT JOIN tblproject1 ON tblprojassign.proj_code=tblproject1.proj_code WHERE tblprojassign.employeeid=\"$employeeid\"";
	$res19aquery = "SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 ORDER BY proj_code DESC";
	$result19a=""; $found19a=0; $ctr19a=0;
	$result19a = $dbh2->query($res19aquery);
	if($result19a->num_rows>0) {
		while($myrow19a = $result19a->fetch_assoc()) {
		$found19a = 1;
		$projectid19a = $myrow19a['projectid'];
		$proj_code19a = $myrow19a['proj_code'];
		$proj_fname19a = substr($myrow19a['proj_fname'], 0, 25);
		$proj_sname19a = $myrow19a['proj_sname'];
		$res19abquery = "SELECT tblfinpayprojchg.projpct01, tblfinpayprojchg.projpctval01 FROM tblfinpayprojchg WHERE tblfinpayprojchg.employeeid=\"$employeeid\" AND tblfinpayprojchg.idpaygroup=$idpaygroup AND (tblfinpayprojchg.projpct01 IS NOT NULL OR tblfinpayprojchg.projpct01<>'')";
		$result19ab=""; $found19ab=0; $ctr19ab=0;
		$result19ab = $dbh2->query($res19abquery);
		if($result19ab->num_rows>0) {
			while($myrow19ab = $result19ab->fetch_assoc()) {
			$found19ab = 1;
			$projpct0119ab = $myrow19ab['projpct01'];
			$projpctval0119ab = $myrow19ab['projpctval01'];
			} // while($myrow19ab = $result19ab->fetch_assoc())
		} // if($result19ab->num_rows>0)
		if($projpct0119ab!='') {
			if($proj_code19a==$projpct0119ab) {
				$projcode19asel="selected";
			} else {
				$projcode19asel="";
			}
		} else {
			echo "<option value='' selected>-</option>"; $projcode19asel="";
		} // if($found19ab==1)
		echo "<option value=\"$proj_code19a\" $projcode19asel>$proj_code19a - ";
		if($proj_sname19a!="") {
			echo "$proj_sname19a";
		} else {
		echo "$proj_fname19a";
		}
		echo "</option>";
		} // while($myrow19a = $result19a->fetch_assoc())
	} // if($result19->num_rows>0)
	echo "</select></td>";
	if($projpctval0119ab=='') { $projpctval0119ab=0; }
	echo "<td nowrap><input type=\"number\" min=\"0\" max=\"100\" name=\"projchgpctval01\" value=\"$projpctval0119ab\">%</td><td><input type=\"submit\" value=\"update\"></td>";
	echo "</form>";
	echo "</tr>";

	// proj percent 02
	echo "<tr><td colspan=\"3\"></td>";
	echo "<form action=\"finpaysysempprojchg.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"finpaysysempprojchg\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"set\" value=\"2\">";
	echo "<td align=\"left\"><select name=\"projchgpct02\">";
	$res19bquery = "SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 ORDER BY proj_code DESC";
	$result19b=""; $found19b=0; $ctr19b=0;
	$result19b = $dbh2->query($res19bquery);
	if($result19b->num_rows>0) {
		while($myrow19b = $result19b->fetch_assoc()) {
		$found19b = 1;
		$projectid19b = $myrow19b['projectid'];
		$proj_code19b = $myrow19b['proj_code'];
		$proj_fname19b = substr($myrow19b['proj_fname'], 0, 25);
		$proj_sname19b = $myrow19b['proj_sname'];
		$res19bbquery = "SELECT tblfinpayprojchg.projpct02, tblfinpayprojchg.projpctval02 FROM tblfinpayprojchg WHERE tblfinpayprojchg.employeeid=\"$employeeid\" AND tblfinpayprojchg.idpaygroup=$idpaygroup AND (tblfinpayprojchg.projpct02 IS NOT NULL OR tblfinpayprojchg.projpct02<>'')";
		$result19bb=""; $found19bb=0; $ctr19bb=0;
		$result19bb = $dbh2->query($res19bbquery);
		if($result19bb->num_rows>0) {
			while($myrow19bb = $result19bb->fetch_assoc()) {
			$found19bb = 1;
			$projpct0219bb = $myrow19bb['projpct02'];
			$projpctval0219bb = $myrow19bb['projpctval02'];
			} // while($myrow19ab = $result19ab->fetch_assoc())
		} // if($result19ab->num_rows>0)
		if($projpct0219bb!='') {
			if($proj_code19b==$projpct0219bb) {
				$projcode19bsel="selected";
			} else {
				$projcode19bsel="";
			}
		} else {
			echo "<option value='' selected>-</option>"; $projcode19bsel="";
		} // if($found19ab==1)
		echo "<option value=\"$proj_code19b\" $projcode19bsel>$proj_code19b - ";
		if($proj_sname19b!="") {
			echo "$proj_sname19b";
		} else {
		echo "$proj_fname19b";
		}
		echo "</option>";
		} // while($myrow19a = $result19a->fetch_assoc())
	} // if($result19->num_rows>0)
	echo "</select></td>";
	if($projpctval0219bb=='') { $projpctval0219bb=0; }
	echo "<td nowrap><input type=\"number\" min=\"0\" max=\"100\" name=\"projchgpctval02\" value=\"$projpctval0219bb\">%</td><td><input type=\"submit\" value=\"update\"></td>";
	echo "</form>";
	echo "</tr>";

	// proj percent 03
	echo "<tr><td colspan=\"3\"></td>";
	echo "<form action=\"finpaysysempprojchg.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"finpaysysempprojchg\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"set\" value=\"3\">";
	echo "<td align=\"left\"><select name=\"projchgpct03\">";
	$res19cquery = "SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 ORDER BY proj_code DESC";
	$result19c=""; $found19c=0; $ctr19c=0;
	$result19c = $dbh2->query($res19cquery);
	if($result19c->num_rows>0) {
		while($myrow19c = $result19c->fetch_assoc()) {
		$found19c = 1;
		$projectid19c = $myrow19c['projectid'];
		$proj_code19c = $myrow19c['proj_code'];
		$proj_fname19c = substr($myrow19c['proj_fname'], 0, 25);
		$proj_sname19c = $myrow19c['proj_sname'];
		$res19cbquery = "SELECT tblfinpayprojchg.projpct03, tblfinpayprojchg.projpctval03 FROM tblfinpayprojchg WHERE tblfinpayprojchg.employeeid=\"$employeeid\" AND tblfinpayprojchg.idpaygroup=$idpaygroup AND (tblfinpayprojchg.projpct03 IS NOT NULL OR tblfinpayprojchg.projpct03<>'')";
		$result19cb=""; $found19cb=0; $ctr19cb=0;
		$result19cb = $dbh2->query($res19cbquery);
		if($result19cb->num_rows>0) {
			while($myrow19cb = $result19cb->fetch_assoc()) {
			$found19cb = 1;
			$projpct0319cb = $myrow19cb['projpct03'];
			$projpctval0319cb = $myrow19cb['projpctval03'];
			} // while($myrow19ab = $result19ab->fetch_assoc())
		} // if($result19ab->num_rows>0)
		if($projpct0319cb!='') {
			if($proj_code19c==$projpct0319cb) {
				$projcode19csel="selected";
			} else {
				$projcode19csel="";
			}
		} else {
			echo "<option value='' selected>-</option>"; $projcode19csel="";
		} // if($found19ab==1)
		echo "<option value=\"$proj_code19c\" $projcode19csel>$proj_code19c - ";
		if($proj_sname19c!="") {
			echo "$proj_sname19c";
		} else {
		echo "$proj_fname19c";
		}
		echo "</option>";
		} // while($myrow19a = $result19a->fetch_assoc())
	} // if($result19->num_rows>0)
	echo "</select></td>";
	if($projpctval0319cb=='') { $projpctval0c19cb=0; }
	echo "<td nowrap><input type=\"number\" min=\"0\" max=\"100\" name=\"projchgpctval03\" value=\"$projpctval0319cb\">%</td><td><input type=\"submit\" value=\"update\"></td>";
	echo "</form>";
	echo "</tr>";

	// proj percent 04
	echo "<tr><td colspan=\"3\"></td>";
	echo "<form action=\"finpaysysempprojchg.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"finpaysysempprojchg\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"set\" value=\"4\">";
	echo "<td align=\"left\"><select name=\"projchgpct04\">";
	$res19dquery = "SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 ORDER BY proj_code DESC";
	$result19d=""; $found19d=0; $ctr19d=0;
	$result19d = $dbh2->query($res19dquery);
	if($result19d->num_rows>0) {
		while($myrow19d = $result19d->fetch_assoc()) {
		$found19d = 1;
		$projectid19d = $myrow19d['projectid'];
		$proj_code19d = $myrow19d['proj_code'];
		$proj_fname19d = substr($myrow19d['proj_fname'], 0 ,25);
		$proj_sname19d = $myrow19d['proj_sname'];
		$res19dbquery = "SELECT tblfinpayprojchg.projpct04, tblfinpayprojchg.projpctval04 FROM tblfinpayprojchg WHERE tblfinpayprojchg.employeeid=\"$employeeid\" AND tblfinpayprojchg.idpaygroup=$idpaygroup AND (tblfinpayprojchg.projpct04 IS NOT NULL OR tblfinpayprojchg.projpct04<>'')";
		$result19db=""; $found19db=0; $ctr19db=0;
		$result19db = $dbh2->query($res19dbquery);
		if($result19db->num_rows>0) {
			while($myrow19db = $result19db->fetch_assoc()) {
			$found19db = 1;
			$projpct0419db = $myrow19db['projpct04'];
			$projpctval0419db = $myrow19db['projpctval04'];
			} // while($myrow19ab = $result19ab->fetch_assoc())
		} // if($result19ab->num_rows>0)
		if($projpct0419db!='') {
			if($proj_code19d==$projpct0419db) {
				$projcode19dsel="selected";
			} else {
				$projcode19dsel="";
			}
		} else {
			echo "<option value='' selected>-</option>"; $projcode19dsel="";
		} // if($found19ab==1)
		echo "<option value=\"$proj_code19d\" $projcode19dsel>$proj_code19d - ";
		if($proj_sname19d!="") {
			echo "$proj_sname19d";
		} else {
		echo "$proj_fname19d";
		}
		echo "</option>";
		} // while($myrow19a = $result19a->fetch_assoc())
	} // if($result19->num_rows>0)
	echo "</select></td>";
	if($projpctval0419db=='') { $projpctval0419db=0; }
	echo "<td nowrap><input type=\"number\" min=\"0\" max=\"100\" name=\"projchgpctval04\" value=\"$projpctval0419db\">%</td><td><input type=\"submit\" value=\"update\"></td>";
	echo "</form>";
	echo "</tr>";

	// proj percent 05
	echo "<tr><td colspan=\"3\"></td>";
	echo "<form action=\"finpaysysempprojchg.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"finpaysysempprojchg\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"set\" value=\"5\">";
	echo "<td align=\"left\"><select name=\"projchgpct05\">";
	$res19equery = "SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 ORDER BY proj_code DESC";
	$result193=""; $found19e=0; $ctr19e=0;
	$result19e = $dbh2->query($res19equery);
	if($result19e->num_rows>0) {
		while($myrow19e = $result19e->fetch_assoc()) {
		$found19e = 1;
		$projectid19e = $myrow19e['projectid'];
		$proj_code19e = $myrow19e['proj_code'];
		$proj_fname19e = substr($myrow19e['proj_fname'], 0, 25);
		$proj_sname19e = $myrow19e['proj_sname'];
		$res19ebquery = "SELECT tblfinpayprojchg.projpct05, tblfinpayprojchg.projpctval05 FROM tblfinpayprojchg WHERE tblfinpayprojchg.employeeid=\"$employeeid\" AND tblfinpayprojchg.idpaygroup=$idpaygroup AND (tblfinpayprojchg.projpct05 IS NOT NULL OR tblfinpayprojchg.projpct05<>'')";
		$result19eb=""; $found19eb=0; $ctr19eb=0;
		$result19eb = $dbh2->query($res19ebquery);
		if($result19eb->num_rows>0) {
			while($myrow19eb = $result19eb->fetch_assoc()) {
			$found19eb = 1;
			$projpct0519eb = $myrow19eb['projpct05'];
			$projpctval0519eb = $myrow19eb['projpctval05'];
			} // while($myrow19ab = $result19ab->fetch_assoc())
		} // if($result19ab->num_rows>0)
		if($projpct0519eb!='') {
			if($proj_code19e==$projpct0519eb) {
				$projcode19esel="selected";
			} else {
				$projcode19esel="";
			}
		} else {
			echo "<option value='' selected>-</option>"; $projcode19esel="";
		} // if($found19ab==1)
		echo "<option value=\"$proj_code19e\" $projcode19esel>$proj_code19e - ";
		if($proj_sname19e!="") {
			echo "$proj_sname19e";
		} else {
		echo "$proj_fname19e";
		}
		echo "</option>";
		} // while($myrow19a = $result19a->fetch_assoc())
	} // if($result19->num_rows>0)
	echo "</select></td>";
	if($projpctval0519eb=='') { $projpctval0519eb=0; }
	echo "<td nowrap><input type=\"number\" min=\"0\" max=\"100\" name=\"projchgpctval05\" value=\"$projpctval0519eb\">%</td><td><input type=\"submit\" value=\"update\"></td>";
	echo "</form>";
	echo "</tr>";

	$percentvaltot = $projpctval0119ab + $projpctval0219bb + $projpctval0319cb + $projpctval0419db + $projpctval0519eb;
	if($percentvaltot>100) {
	echo "<tr><th colspan=\"4\" align=\"right\"><font color=\"red\">Total</font></th>";
	echo "<th align=\"right\"><font color=\"red\">$percentvaltot&nbsp;%</font></th></tr>";
	echo "<tr><th colspan=\"5\" align=\"right\"><font color=\"red\">Warning: Total percentage should not exceed 100%</font></th></tr>";
	} else {
	echo "<tr><th colspan=\"4\" align=\"right\">Total</th>";
	echo "<th align=\"right\">$percentvaltot&nbsp;%</th></tr>";
	} // if($percentvaltot>100)

	} // if($projchgtyp14 != "" && $projchgtyp14 == "percent")

	echo "</table>";
	echo "</td></tr>";
	}

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"finpaysys.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
