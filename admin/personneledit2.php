<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';
$employeeid = $pid;

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Personnel Info</font></p>";

		echo "<table class=\"fin\"><tr><td>";

     echo "<table width=\"100%\" class=\"fin2\">";
     echo "<tr><td bgcolor=blue colspan=\"3\"><font color=white><b>Edit Personnel Information</b></font></td></tr>";

    $res0query = "SELECT name_last, name_first, name_middle, picfn, picpath FROM tblcontact WHERE employeeid=\"$pid\"";
		$result0=$dbh2->query($res0query);
		if($result0->num_rows>0) {
			while($myrow0 = $result0->fetch_assoc()) {
			$name_last = $myrow0['name_last'];
			$name_first = $myrow0['name_first'];
			$name_middle = $myrow0['name_middle'];
			$picfn = $myrow0['picfn'];
			$picpath = $myrow0['picpath'];
			} // while($myrow0 = $result0->fetch_assoc())
		} // if($result0->num_rows>0)

     echo "<tr><td><b>$pid - $name_last, $name_first $name_middle</b></td>";
     echo "<td align=center>";
     if($picfn != "") {
     echo "<img src=\"images/$picfn\" height=\"150\">";
     echo "<br>"; }
     echo "<input type=\"button\" value=\"upload pic\" onclick=\"popupwindow('$loginid', '$pid')\"></td>";
     echo "<form action=\"personneldel.php?loginid=$loginid&eid=$employeeid\" method=\"post\" name=\"personneldel\"><td align=\"center\"><input type=\"submit\" value=\"Delete this record\"></td></form></tr></table><p>"; 

	if($pid == '') {
	echo "<p><font color=\"red\"><b>Sorry. No data available</b></font></p>";
	} else {

// start employment details form
	$res2query = "SELECT tblemployee.emp_ref_num, tblemployee.date, tblemployee.date_hired, tblemployee.date_expired, tblemployee.emp_birthdate, tblemployee.emp_birthplace, tblemployee.emp_civilstatus, tblemployee.emp_num, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis, tblemployee.emp_skills, tblemployee.emp_status, tblemployee.emp_remarks, tblemployee.employee_type, tblemployee.term_resign, tblemployee.emp_record, tblemployee.emptaxstatus FROM tblemployee WHERE tblemployee.employeeid='$employeeid'";
	$result2=""; $found2=0; $ctr2=0;
	$result2=$dbh2->query($res2query);
	if($result2->num_rows>0) {
		while($myrow2=$result2->fetch_assoc()) {
		$found2 = 1;
	  $emp_ref_num = $myrow2['emp_ref_num'];
	  $date = $myrow2['date'];
	  $date_hired = $myrow2['date_hired'];
	  $date_expired = $myrow2['date_expired'];
	  $emp_birthdate = $myrow2['emp_birthdate'];
	  $emp_birthplace = $myrow2['emp_birthplace'];
	  $emp_civilstatus = $myrow2['emp_civilstatus'];
	  $emp_num = $myrow2['emp_num'];
	  $emp_tin = $myrow2['emp_tin'];
	  $emp_sss = $myrow2['emp_sss'];
	  $emp_philhealth = $myrow2['emp_philhealth'];
	  $emp_pagibig = $myrow2['emp_pagibig'];
		$emp_pagibig2 = $myrow2['emp_pagibig2'];
	  $emp_gsis = $myrow2['emp_gsis'];
	  $emp_skills = $myrow2['emp_skills'];
	  $emp_status = $myrow2['emp_status'];
	  $emp_remarks = $myrow2['emp_remarks'];
	  $employee_type = $myrow2['employee_type'];
	  $term_resign = $myrow2['term_resign'];
	  $emp_record = $myrow2['emp_record'];
		$emptaxstatus = $myrow2['emptaxstatus'];
		} // while($myrow2=$result2->fetch_assoc())
	} // if($result2->num_rows>0)

// start insert tblempdetails
	$res8query = "SELECT empdetailsid, empdepartment, empposition, emppositionlevel, empsalarygrade, idhrpositionctg FROM tblempdetails WHERE employeeid = '$employeeid'";
	$result8=""; $found8=0; $ctr8=0;
	$result8=$dbh2->query($res8query);
	if($result8->num_rows>0) {
		while($myrow8=$result8->fetch_assoc()) {
	  $empdetailsid = $myrow8['empdetailsid'];
	  $empdepartment = $myrow8['empdepartment'];
	  $empposition = $myrow8['empposition'];
	  $emppositionlevel = $myrow8['emppositionlevel'];
	  $empsalarygrade = $myrow8['empsalarygrade'];
		$idhrpositionctg = $myrow8['idhrpositionctg'];
		} // while($myrow8=$result8->fetch_assoc())
	} // if($result8->num_rows>0)
// end insert tblempdetails

     echo "<table width=\"100%\" class=\"fin2\" border=\"1\">";
     echo "<tr><th colspan=2>Employment Details</th></tr>";
	echo "<tr><th align=\"right\">Employee No.</th><td>";

	echo "<form action=personnelchgempid.php?pid=$pid&loginid=$loginid method=post name=\"personnelchgempid\">";
  echo "<div class='form-group'>";
	echo "<table class=\"fin2\"><tr><td align=\"center\">$employeeid</td>";
	echo "<td align=\"center\"><input type=\"submit\" value=\"Change Employee Number\"></td></tr></table>";
  echo "</div>"; // <div class='form-group'>
  echo "</form>";

	echo "</td></tr>";
	echo "<form action=\"personnelupdemployment.php?pid=$pid&loginid=$loginid\" method=\"post\" name=\"personnelupdemployment\">";
  echo "<div class='form-group'>";
	echo "<tr><th align=\"right\">Reference No.</th><td><input name=emp_ref_num value=$emp_ref_num></td></tr>";
	echo "<tr><th align=\"right\">Position</th><td>";
	if($idhrpositionctg==0) {
	echo "$empposition<br>";
	} // if($idhrpositionctg==0)
	echo "<select name=\"idhrpositionctg\">";
	echo "<option value=0>select job position</option>";
	$res18query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg ORDER BY name ASC";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$idhrpositionctg18 = $myrow18['idhrpositionctg'];
		$code18 = $myrow18['code'];
		$name18 = $myrow18['name'];
		$deptcd18 = $myrow18['deptcd'];
		if($idhrpositionctg18==$idhrpositionctg) { $idhrposctgsel="selected"; } else { $idhrposctgsel=""; }
		echo "<option value=\"$idhrpositionctg18\" $idhrposctgsel>$name18</option>";
		} // while($myrow18=$result18->fetch_assoc())
	} // if($result18->num_rows>0)
	echo "</select>";
	echo "</td></tr>";
	// echo "<tr><td>Department</td><td>$empdepartment</td></tr>";
	echo "<tr><th align=\"right\">Department</th><td>";
		echo "<select name=\"empdepartment\">";
		echo "<option value=''>select deptcd</option>";
		$res15query = "SELECT code, name FROM tbldeptcd";
		$result15=""; $found15=0;
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15 = 1;
			$deptcode15 = $myrow15['code'];
			$deptname15 = $myrow15['name'];
			if($deptcode15 == $empdepartment) { $deptcdsel="selected"; } else { $deptcdsel=""; }
			echo "<option value=\"$deptcode15\" $deptcdsel>$deptcode15 - $deptname15</option>";
			} // while($myrow15=$result15->fetch_assoc())
		} // if($result15->num_rows>0)
		echo "</select>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">Position Level</th><td><input type=\"number\" min=\"0\" max=\"5\" name=\"emppositionlevel\" value=\"$emppositionlevel\" class='form-control'></td></tr>";
	echo "<tr><th align=\"right\">Salary Grade</th><td><input type=\"number\" min=\"0\" max=\"12\" name=\"empsalarygrade\" value=\"$empsalarygrade\" class='form-control'></td></tr>";
	echo "<tr><th align=\"right\">Date of Birth</th><td>".date("Y-M-d", strtotime($emp_birthdate))."&nbsp;<a href=\"personnelchgempbirthdate.php?loginid=$loginid&pid=$employeeid&emp_birthdate=$emp_birthdate\"><font size=\"1\"><i>change</i></font></a></td></tr>";
	echo "<tr><th align=\"right\">Place of Birth</th><td><input size=50 name=emp_birthplace value=\"$emp_birthplace\"></td></tr>";

	echo "<tr><th align=\"right\">Civil Status</th>";
	if ($emp_civilstatus == 'Single') {
	  $singleselected = 'selected';
	} else if ($emp_civilstatus == 'Married') {
	  $marriedselected = 'selected';
	} else if ($emp_civilstatus == 'Separated') {
	  $separatedselected = 'selected';
	} else if ($emp_civilstatus == 'Divorced') {
	  $divorcedselected = 'selected';
	} else if ($emp_civilstatus == 'Annulled') {
	  $annulledselected = 'selected';
	} else if ($emp_civilstatus == 'Widow') {
	  $swidowselected = 'selected';
	} else if ($emp_civilstatus == 'Widower') {
	  $widowerselected = 'selected';
	} else {
	  $select == 'selected';
	}
	echo "<td><select name=\"emp_civilstatus\">";
	echo "<option value=\"Select\" $select>Select</option>";
	echo "<option value=\"Single\" $singleselected>Single</option>";
	echo "<option value=\"Married\" $marriedselected>Married</option>";
	echo "<option value=\"Separated\" $separatedselected>Separated</option>";
	echo "<option value=\"Divorced\" $divorcedselected>Divorced</option>";
	echo "<option value=\"Annulled\" $annulledselected>Annulled</option>";
	echo "<option value=\"Widow\" $widowselected>Widow</option>";
	echo "<option value=\"Widower\" $widowerselected>Widower</option>";
	echo "</select></td></tr>";

	echo "<tr><th align=\"right\">Tax Identification No.</th><td><input name=emp_tin value=$emp_tin></td></tr>";
	echo "<tr><th align=\"right\">Tax exempt status</th><td>";
	echo "<select name=\"emptaxstatus\">";
	if($emptaxstatus == "") { echo "<option>select</option>"; }
	$res16query = "SELECT id, taxcode FROM tblwtaxexempt";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$found16 = 1;
		$id16 = $myrow16['id'];
		$taxcode16 = $myrow16['taxcode'];
		if($taxcode16 == $emptaxstatus) { $emptaxstatsel="selected"; } else { $emptaxstatsel=""; }
		echo "<option value=\"$taxcode16\" $emptaxstatsel>$taxcode16</option>";
		} // while($myrow16=$result16->fetch_assoc())
	} // if($result16->num_rows>0)
	echo "</select>";
	echo "</td>";
	echo "<tr><th align=\"right\">SSS No.</th><td><input name=\"emp_sss\" value=\"$emp_sss\"></td></tr>";
	echo "<tr><th align=\"right\">Philhealth</th><td><input name=\"emp_philhealth\" value=\"$emp_philhealth\"></td></tr>";
	echo "<tr><th align=\"right\">Pag-IBIG</th><td><input name=\"emp_pagibig\" value=\"$emp_pagibig\"></td></tr>";
	echo "<tr><th align=\"right\">Pag-IBIG2</th><td><input name=\"emp_pagibig2\" value=\"$emp_pagibig2\"></td></tr>";
	echo "<tr><th align=\"right\">GSIS</th><td><input name=\"emp_gsis\" value=\"$emp_gsis\"></td></tr>";
	echo "<tr><th align=\"right\">Skills</th><td><textarea name=\"emp_skills\" rows=\"2\" cols=\"50\">$emp_skills</textarea></td></tr>";

	if($employee_type == 'employee') {
	  echo "<tr><th align=\"right\">Employment Status</th>";
	  if($emp_status == 'R') {
	    $r_selected = 'selected';
	  } else if($emp_status == 'P') {
	    $p_selected = 'selected';
	  } else if($emp_status == 'T') {
	    $t_selected = 'selected';
	  } else if($emp_status == 'I') {
        $i_selected = 'selected';
	  } else {
	    $select = 'selected';
    } //if-else
	  echo "<td><select name=\"emp_status\">";
	  echo "<option value=\"select\" $select>Select</option>";
	  echo "<option value=\"R\" $r_selected>Regular</option>";
	  echo "<option value=\"P\" $p_selected>Probationary</option>";
	  echo "<option value=\"T\" $t_selected>Temporary</option>";
	  echo "<option value=\"I\" $i_selected>Intern</option>";
	  echo "</select></td></tr>";
	}

	echo "<tr><th align=\"right\">Remarks</th><td><textarea name=\"emp_remarks\" rows=\"2\" cols=\"50\">$emp_remarks</textarea></td></tr>";
	echo "<tr><th align=\"right\">Employee Type</th>";
	if($employee_type == 'employee') {
	  $employeeselected = 'selected';
	} else if($employee_type == 'consultant') {
	  $consultantselected = 'selected';
	} else if($employee_type == 'others') {
	  $othersselected = 'selected';
	} else {
	  $select = 'selected';
	}
	echo "<td><select name=\"employee_type\">";
	echo "<option value=\"select\" $select>Select</option>";
	echo "<option value=\"employee\" $employeeselected>Employee</option>";
	echo "<option value=\"consultant\" $consultantselected>Consultant</option>";
	echo "<option value=\"others\" $othersselected>Others</option>";
	echo "</select></td></tr>";

	echo "<tr><th align=\"right\">Date Hired</th><td>".date("Y-M-d", strtotime($date_hired))."&nbsp;<a href=\"personnelchgempdatehired.php?loginid=$loginid&pid=$employeeid&date_hired=$date_hired\"><font size=\"1\"><i>change</i></font></a></td></tr>";
	if($term_resign == "0000-00-00") {
	echo "<tr><th align=\"right\">Date Resigned</th><td>$term_resign&nbsp;<a href=\"personnelchgempterm_resign.php?loginid=$loginid&pid=$employeeid&term_resign=$term_resign\"><font size=\"1\"><i>change</i></font></a></td></tr>";
	} else {
	echo "<tr><th align=\"right\">Date Resigned</th><td>".date("Y-M-d", strtotime($term_resign))."&nbsp;<a href=\"personnelchgempterm_resign.php?loginid=$loginid&pid=$employeeid&term_resign=$term_resign\"><font size=\"1\"><i>change</i></font></a></td></tr>";
	}

// check if personnel has reemployment data
	$res12query = "SELECT daterehired, dateresigned, remarks FROM tblemprehire WHERE employeeid=\"$employeeid\" ORDER BY daterehired DESC";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
	  $found12 = 1;
	  $daterehired12 = $myrow12['daterehired'];
	  $dateresigned12 = $myrow12['dateresigned'];
	  $remarks12 = $myrow12['remarks'];
		} // while($myrow12=$result12->fetch_assoc())
	} // if($result12->num_rows>0)
	if($found12 == 1) {
	  echo "<tr><th align=\"right\">Re-hired or Re-employed</th><td>";
	  echo "<table border=\"1\" spacing=\"1\" cellspacing=\"1\" cellpadding=\"1\">";
	  echo "<tr><td><font size=\"1\"><i>From</i></font></td><td><font size=\"1\"><i>To</i></font></td><td colspan=\"2\"><font size=\"1\"><i>Action</i></font></td></tr>";
	  $res14query = "SELECT emprehireid, daterehired, dateresigned, remarks FROM tblemprehire WHERE employeeid=\"$employeeid\" ORDER BY daterehired DESC";
		$result14=""; $found14=0; $ctr14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
	    $found14 = 1;
	    $emprehireid14 = $myrow14['emprehireid'];
	    $daterehired14 = $myrow14['daterehired'];
	    $dateresigned14 = $myrow14['dateresigned'];
	    $remarks14 = $myrow14['remarks'];
	    echo "<tr><td>".date("Y-M-d", strtotime($daterehired14))."</td>";
			$dtresignyyyy=substr($dateresigned14,0,4);
			if($dtresignyyyy=="0000") {
			echo "<td>$dateresigned14</td><td><a href=\"personnelrehiredel.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\">Delete</a></td><td><a href=\"personnelrehireedit.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\">Edit</a></td></tr>";
			} else {
			echo "<td>".date("Y-M-d", strtotime($dateresigned14))."</td><td><a href=\"personnelrehiredel.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\">Delete</a></td><td><a href=\"personnelrehireedit.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\">Edit</a></td></tr>";
			} // if($dtresignyyyy=="0000")
			} // while($myrow14=$result14->fetch_assoc())
		} // if($result14->num_rows>0)
	  echo "</table>";
	  echo "</td></tr>";
	}
// link to add re-employment data
	echo "<tr><td>&nbsp;</td><td><a href=\"personnelrehireadd.php?loginid=$loginid&eid=$employeeid\"><font size=\"1\">Add re-hire/re-employment details</font></a></td></tr>";

// emp_record status/type
	echo "<tr><th align=\"right\">Record Status</th>";
	if($emp_record == 'inactive') { $inactiveselected='selected'; }
	else if($emp_record == 'active') { $activeselected='selected'; }
	echo "<td><select name=\"emp_record\">";
	echo "<option value=\"active\" $activeselected>Active</option>";
	echo "<option value=\"inactive\" $inactiveselected>Inactive</option>";
	echo "</select></td></tr>";

	echo "<tr><td></td><td><button type=\"submit\" class='btn btn-success'>Update Employment Details</button></td></tr>";
	echo "</table>";
  echo "</div>"; // <div class='form-group'>

  echo "</form>";

// end employment details form

// start project assignments

	$empprojctr = 0;

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=\"10\">Projects / Contracts</th></tr>";
	echo "<tr><td><font size=1>Ctr</font></td><td><font size=1>Ref#</font></td><td><font size=1>ProjCode</font></td><td><font size=1>Acronym</font></td><td><font size=1>Position</font></td><td><font size=1>From</font></td><td><font size=1>To</font></td><td><font size=\"1\">File</font></td><td colspan=\"2\" align=\"center\"><font size=1>Action</font></td></tr>";
	$res3query = "SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.filepath, tblprojassign.filename, tblprojassign.idhrpositionctg, tblproject1.proj_fname, tblproject1.proj_sname FROM tblprojassign LEFT JOIN tblproject1 ON tblprojassign.proj_code=tblproject1.proj_code WHERE tblprojassign.employeeid = '$pid' ORDER BY tblprojassign.durationfrom DESC";
	$result3=""; $found3=0; $ctr3=0;
	$result3=$dbh2->query($res3query);
	if($result3->num_rows>0) {
		while($myrow3=$result3->fetch_assoc()) {
	  $found3 = 1;
	  $projassignid = $myrow3['projassignid'];
	  $ref_no = $myrow3['ref_no'];
	  $proj_code = $myrow3['proj_code'];
	  $proj_name = $myrow3['proj_name'];
	  $position = $myrow3['position'];
	  $durationfrom = $myrow3['durationfrom'];
	  $durationto = $myrow3['durationto'];
	  $filepath3 = $myrow3['filepath'];
	  $filename3 = $myrow3['filename'];
		$idhrpositionctg3 = $myrow3['idhrpositionctg'];
		$proj_fname3 = $myrow3['proj_fname'];
		$proj_sname3 = $myrow3['proj_sname'];

	  $empprojctr = $empprojctr + 1;

	  echo "<tr><td>$empprojctr</td><td>$ref_no</td>";
		// modified 20180405
		echo "<td colspan=\"2\">";
		if($proj_code=='Select Pro') {
		echo "";
		} else {
		echo "$proj_code - ";
		} // if
		if($proj_sname3 != '') {
			echo "$proj_sname3";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "$projfnamefin";
		} else if($proj_name != '') {
			echo "$proj_name";
		}
		echo "<br>";
	// check if tblprojcdassign has related records
	$res5aquery = "SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$pid\"";
	$result5a=""; $found5a=0; $ctr5a=0;
	$result5a=$dbh2->query($res5aquery);
	if($result5a->num_rows>0) {
		while($myrow5a=$result5a->fetch_assoc()) {
		$found5a=1;
		$projectid5a = $myrow5a['projectid'];
		$projcode5a = $myrow5a['projcode'];
		$projname5a = $myrow5a['projname'];
		echo "$projcode5a - $projname5a<br>";
		} // while($myrow5a=$result5a->fetch_assoc())
	} // if($result5a=num_rows>0)
	echo "</td>";

	// 20171018 query tblhrpositionctg
	$res19query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg3";
	$result19=""; $found19=0;
	$result19=$dbh2->query($res19query);
	if($result19->num_rows>0) {
		while($myrow19=$result19->fetch_assoc()) {
		$found19 = 1;
		$idhrpositionctg19 = $myrow19['idhrpositionctg'];
		$code19 = $myrow19['code'];
		$name19 = $myrow19['name'];
		$deptcd19 = $myrow19['deptcd'];
		if($idhrpositionctg19==$idhrpositionctg3) { $idhrposctgsel="selected"; } else { $idhrposctgsel=""; }
		} // while($myrow19=$result19->fetch_assoc())
	} // if($result19->num_rows>0)
	if($found19==1 && $idhrpositionctg19!=0) {
		echo "<td>$name19</td>";
	} else {
		echo "<td>$position</td>";
	} // if($found19==1)
		$durfromyr=substr($durationfrom,0,4);
		$durtoyr=substr($durationto,0,4);
		if($durfromyr=="0000") {
			echo "<td></td>";
		} else {
			echo "<td>".date("Y-M-d", strtotime($durationfrom))."</td>";
		} // if($durfromyr=="0000")
		if($durtoyr=="0000") {
			echo "<td></td>";
		} else {
			echo "<td>".date("Y-M-d", strtotime($durationto))."</td>";
		} // if($durtoyr=="0000")

		if($filename3 != "") {
	    echo "<td><a href=\"$filepath3/$filename3\">&nbsp;</a></td>";
	  } else { echo "<td></td>"; }
	  echo "<td><a href=\"personnelprojassigndel.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\" class='btn btn-danger btn-sm' role='button'>Del</a></td>";
	  echo "<td><a href=\"personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\" class='btn btn-warning btn-sm' class='button'>Edit</a></td></tr>";
		} // while($myrow3=$result3->fetch_assoc())
	} // if($result3->num_rows>0)
	echo "<tr><td colspan=\"9\" align=\"center\"><a href=\"personnelprojassignadd.php?loginid=$loginid&eid=$employeeid\" class='btn btn-primary' role='button'>(+) Add new project assignment</a></td></tr>";

	echo "</table><p>";
// end project assignments

// start tmp.project assignments

	$empprojctr = 0;

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=darkgrey colspan=8><font color=white><b>tmp.Project Assignment(s)</b></font></td></tr>";
	echo "<tr><td><font size=1>Ctr</font></td><td><font size=1>Ref#</font></td><td><font size=1>Acronym</font></td><td><font size=1>Position</font></td><td><font size=1>From</font></td><td><font size=1>To</font></td><td><font size=1>Action1</font></td><td><font size=1>Action2</font></td></tr>";
	$res9query = "SELECT projectassign0id, ref_no, proj_code, proj_name, position, durationfrom, durationto FROM tblprojassign0 WHERE employeeid1 = '$pid' ORDER BY durationto DESC";
	$result9=""; $found9=0; $ctr9=0;
	$result9=$dbh2->query($res9query);
	if($result9->num_rows>0) {
		while($myrow9=$result9->fetch_assoc()) {
	  $found9 = 1;
	  $projectassign0id = $myrow9['projectassign0id'];
	  $ref_no = $myrow9['ref_no'];
	  $proj_code = $myrow9['proj_code'];
	  $proj_name = $myrow9['proj_name'];
	  $position = $myrow9['position'];
	  $durationfrom = $myrow9['durationfrom'];
	  $durationto = $myrow9['durationto'];
	  $empprojctr = $empprojctr + 1;
	  echo "<tr><td>$empprojctr</td><td>$ref_no</td><td>$proj_name</td><td>$position</td><td>$durationfrom</td><td>$durationto</td>";
	  echo "<td><a href=\"personneltmpprojassignupd.php?loginid=$loginid&eid=$employeeid&prjid=$projectassign0id\" class='btn btn-success btn-sm' role='button'>Propagate</a></td>";
	  echo "<td><a href=\"personneltmpprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projectassign0id\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";
		} // while($myrow9=$result9->fetch_assoc())
	} // if($result9->num_rows>0)

	echo "</table>";
// end tmp.project assignments

// start contact details form

	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblcontact.email3, tblcontact.url, tblcontact.remarks_contact FROM tblcontact WHERE tblcontact.employeeid='$pid'";
	$result=""; $found=0; $ctr=0;
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
	  $pid = $myrow['employeeid'];
	  $employeeid = $pid;
	  $name_last = $myrow['name_last'];
	  $name_first = $myrow['name_first'];
	  $name_middle = $myrow['name_middle'];
	  $contact_gender = $myrow['contact_gender'];
	  $picture = $myrow['picture'];
	  $position = $myrow['position'];
	  $contact_address1 = $myrow['contact_address1'];
	  $contact_address2 = $myrow['contact_address2'];
	  $contact_city = $myrow['contact_city'];
	  $contact_province = $myrow['contact_province'];
	  $contact_zipcode = $myrow['contact_zipcode'];
	  $contact_country = $myrow['contact_country'];
	  $num_res1_cc = $myrow['num_res1_cc'];
	  $num_res1_ac = $myrow['num_res1_ac'];
	  $num_res1 = $myrow['num_res1'];
	  $num_res2_cc = $myrow['num_res2_cc'];
	  $num_res2_ac = $myrow['num_res2_ac'];
	  $num_res2 = $myrow['num_res2'];
	  $num_mobile1_cc = $myrow['num_mobile1_cc'];
	  $num_mobile1_ac = $myrow['num_mobile1_ac'];
	  $num_mobile1 = $myrow['num_mobile1'];
	  $num_mobile2_cc = $myrow['num_mobile2_cc'];
	  $num_mobile2_ac = $myrow['num_mobile2_ac'];
	  $num_mobile2 = $myrow['num_mobile2'];
	  $num_mobile3_cc = $myrow['num_mobile3_cc'];
	  $num_mobile3_ac = $myrow['num_mobile3_ac'];
	  $num_mobile3 = $myrow['num_mobile3'];
	  $email1 = $myrow['email1'];
	  $email2 = $myrow['email2'];
	  $email3 = $myrow['email3'];
	  $url = $myrow['url'];
	  $remarks_contact = $myrow['remarks_contact'];
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

	echo "<form action=\"personnelupdcontact.php?pid=$pid&loginid=$loginid\" method=\"post\" name=\"personnelupdcontact\">";
     echo "<table width=100% class=\"fin2\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=\"2\">Contact Details</th></tr>";
	echo "<tr><th align=\"right\">Employee No.</th><td>$employeeid</td></tr>";
	echo "<tr><th align=\"right\">Employee Name</th>";
	echo "<td><table border=0 spacing=1><tr><td><input name=\"name_last\" value=\"$name_last\"></td><td><input name=\"name_first\" value=\"$name_first\"></td><td><input name=\"name_middle\" value=\"$name_middle\"></td></tr>";
	echo "<tr><td><font size=1>LastName</font></td><td><font size=1>FirstName</font></td><td><font size=1>MiddleName</font></td></tr></table></td></tr>";
//         echo "<tr><td>Position</td><td>$myrow[6]";

	echo "<tr><th align=\"right\">Sex</th>";
	if ($contact_gender == 'Male') {
	  $maleselected = 'selected';
	} else if ($contact_gender == 'Female') {
	  $femaleselected = 'selected';
	} else {
	  $select = 'selected';
	}
	echo "<td><select name=\"contact_gender\">";
	echo "<option value=\"select\" $select>Select</option>";
	echo "<option value=\"Male\" $maleselected>Male</option>";
	echo "<option value=\"Female\" $femaleselected>Female</option>";
	echo "</select></td>";

	echo "<tr><th align=\"right\">Address Line1</th><td><textarea name=\"contact_address1\" rows=2 cols=50>$contact_address1</textarea></td></tr>";
	echo "<tr><th align=\"right\">Address Line2</th><td><textarea name=\"contact_address2\" rows=2 cols=50>$contact_address2</textarea></td></tr>";
	echo "<tr><th align=\"right\">City</th><td><input name=\"contact_city\" value=\"$contact_city\"></td></tr>";
	echo "<tr><th align=\"right\">Province</th><td><input name=\"contact_province\" value=\"$contact_province\"></td></tr>";
	echo "<tr><th align=\"right\">Zip Code</th><td><input name=\"contact_zipcode\" value=\"$contact_zipcode\"></td></tr>";
	echo "<tr><th align=\"right\">Country</th><td><input name=\"contact_country\" value=\"$contact_country\"></td></tr>";

	echo "<tr><th align=\"right\">Landline1</th>";
	echo "<td><table border=0 spacing=0><tr><td>+<input size=4 name=\"num_res1_cc\" value=\"$num_res1_cc\"></td><td><input size=5 name=\"num_res1_ac\" value=\"$num_res1_ac\"></td><td><input name=\"num_res1\" value=\"$num_res1\"></td></tr>";
	echo "<tr><td><font size=1>Country</font></td><td><font size=1>Area</font></td><td><font size=1>PhoneNumber</font></td></tr></table></td></tr>";

	echo "<tr><th align=\"right\">Landline2</th><td><table border=0 spacing=0><tr><td>+<input size=4 name=\"num_res2_cc\" value=\"$num_res2_cc\"></td><td><input size=5 name=\"num_res2_ac\" value=\"$num_res2_ac\"></td><td><input name=\"num_res2\" value=\"$num_res2\"></td></tr>";
	echo "<tr><td><font size=1>Country</font></td><td><font size=1>Area</font></td><td><font size=1>PhoneNumber</font></td></tr></table></td></tr>";

	echo "<tr><th align=\"right\">Mobile1</th><td><table border=0 spacing=0><tr><td>+<input size=4 name=\"num_mobile1_cc\" value=\"$num_mobile1_cc\"></td><td><input size=5 name=\"num_mobile1_ac\" value=\"$num_mobile1_ac\"></td><td><input name=\"num_mobile1\" value=\"$num_mobile1\"></td></tr>";
	echo "<tr><td><font size=1>Country</font></td><td><font size=1>Area</font></td><td><font size=1>CellNumber</font></td></tr></table></td></tr>";

	echo "<tr><th align=\"right\">Mobile2</th><td><table border=0 spacing=0><tr><td>+<input size=4 name=\"num_mobile2_cc\" value=\"$num_mobile2_cc\"></td><td><input size=5 name=\"num_mobile2_ac\" value=\"$num_mobile2_ac\"></td><td><input name=\"num_mobile2\" value=\"$num_mobile2\"></td></tr>";
	echo "<tr><td><font size=1>Country</font></td><td><font size=1>Area</font></td><td><font size=1>CellNumber</font></td></tr></table></td></tr>";

	echo "<tr><th align=\"right\">Mobile3</th><td><table border=0 spacing=0><tr><td>+<input size=4 name=\"num_mobile3_cc\" value=\"$num_mobile3_cc\"></td><td><input size=5 name=\"num_mobile3_ac\" value=\"$num_mobile3_ac\"></td><td><input name=\"num_mobile3\" value=\"$num_mobile3\"></td></tr>";
	echo "<tr><td><font size=1>Country</font></td><td><font size=1>Area</font></td><td><font size=1>CellNumber</font></td></tr></table></td></tr>";

	echo "<tr><th align=\"right\">Email1</th><td><input size=50 name=\"email1\" value=\"$email1\"></td></tr>";
        echo "<tr><th align=\"right\">Email2</th><td><input size=50 name=\"email2\" value=\"$email2\"></td></tr>";
        echo "<tr><th align=\"right\">Email3</th><td><input size=50 name=\"email3\" value=\"$email3\"></td></tr>";

        echo "<tr><th align=\"right\">Website</th><td><input size=50 name=\"url\" value=\"$url\"></td></tr>";
        echo "<tr><th align=\"right\">Remarks</th><td><textarea name=\"remarks_contact\" value=\"$remarks_contact\" rows=3 cols=50>$remarks_contact</textarea></td></tr>";

	echo "<tr><td>&nbsp</td><td><button type=\"submit\" class='btn btn-success'>Update Contact Details</button></td></tr>";
	echo "</table></form>";
// end contact details form

// start bank account details

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=\"9\">Bank Account Details</th></tr>";
	echo "<tr><td><i>BankName</i></td><td><i>Branch</i></td><td><i>AcctNumber</i></td><td><i>Type</i></td><td><i>Currency</i></td><td><i>AcctName</i></td><td><i>Payroll<br>Acct</i></td><td colspan=\"2\"><i>Action</i></td></tr>";

	$res6query = "SELECT bankacctid, bankid, contactid, bank_name, bank_branch, acct_name, acct_num, acct_type, acct_currency, bankacctremarks, payrolldflt FROM tblbankacct WHERE employeeid = '$employeeid'";
	$result6=""; $found6=0; $ctr6=0;
	$result6=$dbh2->query($res6query);
	if($result6->num_rows>0) {
		while($myrow6=$result6->fetch_assoc()) {
	  $bankacctid = $myrow6['bankacctid'];
	  $bankid = $myrow6['bankid'];
	  $contactid = $myrow6['contactid'];
	  $bank_name = $myrow6['bank_name'];
	  $bank_branch = $myrow6['bank_branch'];
	  $acct_name = $myrow6['acct_name'];
	  $acct_num = $myrow6['acct_num'];
	  $acct_type = $myrow6['acct_type'];
	  $acct_currency = $myrow6['acct_currency'];
	  $bankacctremarks = $myrow6['bankacctremarks'];
		$payrolldflt = $myrow6['payrolldflt'];
	  echo "<tr><td>$bank_name</td><td>$bank_branch</td><td>$acct_num</td><td>$acct_type</td><td>$acct_currency</td><td>$acct_name</td>";
		if($payrolldflt==1) { $payrolldfltsel="Yes"; } else if($payrolldflt==0) { $payrolldfltsel=""; }
		echo "<td align=\"center\">$payrolldfltsel</td>";
		echo "<td><a href=\"personnelbankacctdel.php?loginid=$loginid&eid=$employeeid&bid=$bankacctid\" class='btn btn-danger btn-sm' role='button'>Del</a></td><td><a href=\"personnelbankacctedit.php?loginid=$loginid&eid=$employeeid&bid=$bankacctid\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";
		} // while($myrow6=$result6->fetch_assoc())
	} // if($result6->num_rows>0)

	echo "<tr><td colspan=\"9\" align=\"center\"><a href=\"personnelbankacctadd.php?loginid=$loginid&eid=$employeeid\" class='btn btn-primary' role='button'>(+) Add new Bank Account details</a></td></tr></table><p>";

// end bank account details

// start insurance details
	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr valign=top><th colspan=\"8\">Insurance</th></tr>";
	echo "<tr><td align=center><font size=1>InsuranceName</font></td><td align=center><font size=1>GroupPolicy#</font></td><td align=center><font size=1>EmployeePolicy#</font></td><td align=center><font size=1>From</font></td><td align=center><font size=1>To</font></td><td align=center><font size=1>Location</font></td><td align=center><font size=1>Action1</font></td><td align=center><font size=1>Action2</font></td></tr>";
	$res11query = "SELECT insuranceempid, policynum, insurancename, emppolicynum, durationfrom, durationto, location FROM tblinsuranceemp WHERE employeeid=\"$pid\" ORDER BY durationto DESC, durationfrom DESC";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
	  $insuranceempid = $myrow11['insuranceempid'];
	  $policynum = $myrow11['policynum'];
	  $insurancename = $myrow11['insurancename'];
	  $emppolicynum = $myrow11['emppolicynum'];
	  $durationfrom = $myrow11['durationfrom'];
	  $durationto = $myrow11['durationto'];
	  $location = $myrow11['location'];
	  echo "<tr><td>$insurancename</td><td>$policynum</td><td>$emppolicynum</td><td>$durationfrom</td><td>$durationto</td><td>$location</td><td><a href=\"personnelinsureempdel.php?loginid=$loginid&eid=$pid&ieid=$insuranceempid\" class='btn btn-danger btn-sm' role='button'>Del</a></td><td><a href=\"personnelinsureempedit.php?loginid=$loginid&eid=$pid&ieid=$insuranceempid\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "<tr><td colspan=8 align=center><a href=\"personnelinsureempadd.php?loginid=$loginid&eid=$pid\" class='btn btn-primary' role='button'>(+) Add new Insurance Policy</a></td></tr>";
	echo "</table><p>";
// end insurance details

// start prof license details
	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr valign=top><th colspan=\"6\">Professional License</th></tr>";
	echo "<tr><td align=center><font size=1>Regulatory Board</font></td><td align=center><font size=1>Profession</font></td><td align=center><font size=1>License Number</font></td><td align=center><font size=1>Date</font></td><td align=center><font size=1>Action1</font></td><td align=center><font size=1>Action2</font></td></tr>";
	$res10query = "SELECT empproflicenseid, regulatoryboard, profession, licensenumber, licensedate FROM tblempproflicense WHERE employeeid='$pid'";
	$result10=""; $found10=0; $ctr10=0;
	$result10=$dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10=$result10->fetch_assoc()) {
		$found10 = 1;
	  $empproflicenseid = $myrow10['empproflicenseid'];
	  $regulatoryboard = $myrow10['regulatoryboard'];
	  $profession = $myrow10['profession'];
	  $licensenumber = $myrow10['licensenumber'];
	  $licensedate = $myrow10['licensedate'];
	  echo "<tr><td>$regulatoryboard</td>";
	  echo "<td>$profession</td>";
	  echo "<td>$licensenumber</td>";
	  echo "<td>$licensedate</td>";
	  echo "<td><a href=\"personnelempproflicdel.php?loginid=$loginid&eid=$employeeid&eplid=$empproflicenseid\" class='btn btn-danger btn-sm' role='button'>Del</a></td>";
	  echo "<td><a href=\"personnelempproflicedit.php?loginid=$loginid&eid=$employeeid&eplid=$empproflicenseid\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";		
		} // while($myrow10=$result10->fetch_assoc())
	} // if($result10->num_rows>0)
	echo "<tr><td colspan=6 align=center><a href=\"personnelempproflicadd.php?loginid=$loginid&eid=$employeeid\" class='btn btn-primary' role='button'>(+) Add new Professional License</a></td></tr>";
	echo "</table><p>";
// end prof license details

//
// start passport details
// added 20161024
	echo "<table width=\"100%\" class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><th colspan=\"8\">Passport details</th></tr>";
	echo "<tr><td><i>Passport No.</i></td><td><i>Country</i></td><td><i>Date issued</i></td><td><i>Expiry date</i></td><td><i>Issued at</i></td><td><i>Remarks</i></td><td colspan=\"2\"><i>Action</i></td></tr>";
	$res17query="SELECT tblemppassport.idtblemppassport, tblemppassport.passportnum, tblemppassport.countrycd, tblemppassport.issuedby, tblemppassport.dateissued, tblemppassport.dateexpiry, tblemppassport.remarks, tblcountrycd.cname FROM tblemppassport LEFT JOIN tblcountrycd ON tblemppassport.countrycd=tblcountrycd.letter2cd WHERE tblemppassport.employeeid=\"$employeeid\" ORDER BY tblemppassport.dateexpiry DESC";
	$result17=""; $found17=0; $ctr17=0;
	$result17=$dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17=$result17->fetch_assoc()) {
		$found17 = 1;
		$ctr17 = $ctr17 + 1;
		$idtblemppassport17 = $myrow17['idtblemppassport'];
		$passportnum17 = $myrow17['passportnum'];
		$countrycd17 = $myrow17['countrycd'];
		$issuedby17 = $myrow17['issuedby'];
		$dateissued17 = $myrow17['dateissued'];
		$dateexpiry17 = $myrow17['dateexpiry'];
		$remarks17 = $myrow17['remarks'];
		$cname17 = $myrow17['cname'];
		echo "<tr><td>$passportnum17</td><td>$cname17</td><td>$dateissued17</td><td>$dateexpiry17</td><td>$issuedby17</td><td>$remarks17</td><td><a href=\"personnelpassportdel.php?loginid=$loginid&eid=$employeeid&idpp=$idtblemppassport17\" class='btn btn-danger btn-sm' role='button'>Del</a></td><td><a href=\"personnelpassportedt.php?loginid=$loginid&eid=$employeeid&idpp=$idtblemppassport17\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";
		}
	}	
	echo "<tr><td colspan=\"8\" align=\"center\"><a href=\"personnelpassportadd.php?loginid=$loginid&eid=$employeeid\" class='btn btn-primary' role='button'>(+) Add new Passport</a></td></tr>";
	echo "</table><p>";
// end passport details

//	Start Education background
	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr valign=top><td bgcolor=blue colspan=6><font color=white><b>Educational background</b></font></td></tr>";
	echo "<tr><td align=center><font size=1>Course</font></td><td align=center><font size=1>YearGraduated</font></td><td align=center><font size=1>School/University</font></td><td align=center><font size=1>Address</font></td><td align=center><font size=1>Action1</font></td><td align=center><font size=1>Action2</font></td></tr>";
	$res4query = "SELECT empeducationid, coursegraduated, yeargraduated, schoolgraduated, schooladdress FROM tblempeducation WHERE employeeid='$pid'";
	$result4=""; $found4=0; $ctr4=0;
	$result4=$dbh2->query($res4query);
	if($result4->num_rows>0) {
		while($myrow4=$result4->fetch_assoc()) {
	  $empeducationid = $myrow4['empeducationid'];
	  $coursegraduated = $myrow4['coursegraduated'];
	  $yeargraduated = $myrow4['yeargraduated'];
	  $schoolgraduated = $myrow4['schoolgraduated'];
	  $schooladdress = $myrow4['schooladdress'];
	  echo "<tr><td>$coursegraduated</td>";
	  echo "<td>$yeargraduated</td>";
	  echo "<td>$schoolgraduated</td>";
	  echo "<td>$schooladdress</td>";
	  echo "<td><a href=\"personnelempeducdel.php?loginid=$loginid&eid=$employeeid&edid=$empeducationid\" class='btn btn-danger btn-sm' role='button'>Del</a></td>";
	  echo "<td><a href=\"personnelempeducedit.php?loginid=$loginid&eid=$employeeid&edid=$empeducationid\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";
		} // while($myrow4=$result4->fetch_assoc())
	} // if($result4->num_rows>0)
	echo "<tr><td colspan=6 align=center><a href=\"personnelempeducadd.php?loginid=$loginid&eid=$employeeid\" class='btn btn-primary' role='button'>(+) Add new Educational Attainment</a></td></tr>";
	echo "</table><p>";
//	End Education background

// start emergency contact details

	$res7query = "SELECT contactid, name_last, name_first, name_middle, contact_address1, contact_address2, contact_city, contact_province, contact_zipcode, contact_country, num_res1_cc, num_res1_ac, num_res1, num_res2_cc, num_res2_ac, num_res2, num_mobile1_cc, num_mobile1_ac, num_mobile1, num_mobile2_cc, num_mobile2_ac, num_mobile2, email1, email2, emergrelation FROM tblcontact WHERE emergempid = '$employeeid' AND contact_type = 'emergency'";
	$result7=""; $found7=0; $ctr7=0;
	$result7=$dbh2->query($res7query);
	if($result7->num_rows>0) {
		while($myrow7=$result7->fetch_assoc()) {
    $found7=1;
	$em_contactid = $myrow7['contactid'];
	$em_name_last = $myrow7['name_last'];
	$em_name_first = $myrow7['name_first'];
	$em_name_middle = $myrow7['name_middle'];
	$em_contact_address1 = $myrow7['contact_address1'];
	$em_contact_address2 = $myrow7['contact_address2'];
	$em_contact_city = $myrow7['contact_city'];
	$em_contact_province = $myrow7['contact_province'];
	$em_contact_zipcode = $myrow7['zipcode'];
	$em_contact_country = $myrow7['country'];
	$em_num_res1_cc = $myrow7['num_res1_cc'];
	$em_num_res1_ac = $myrow7['num_res1_ac'];
	$em_num_res1 = $myrow7['num_res1'];
	$em_num_res2_cc = $myrow7['num_res2_cc'];
	$em_num_res2_ac = $myrow7['num_res2_ac'];
	$em_num_res2 = $myrow7['num_res2'];
	$em_num_mobile1_cc = $myrow7['num_mobile1_cc'];
	$em_num_mobile1_ac = $myrow7['num_mobile1_ac'];
	$em_num_mobile1 = $myrow7['num_mobile1'];
	$em_num_mobile2_cc = $myrow7['num_mobile1_cc'];
	$em_num_mobile2_ac = $myrow7['num_mobile2_ac'];
	$em_num_mobile2 = $myrow7['num_mobile2'];
	$em_email1 = $myrow7['email1'];
	$em_email2 = $myrow7['email2'];
	$em_emergrelation = $myrow7['emergrelation'];
		} // while($myrow7=$result7->fetch_assoc())
	} // if($result7->num_rows>0)

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=6><font color=white><b>Emergency contact info</b></font></td></tr>";
     echo "<tr><td><font size=1>Name</font></td><td><font size=1>Relation</font></td><td><font size=1>Landline</font></td><td><font size=1>Mobile</font></td><td><font size=1>Email</font></td><td><font size=1>Action1</font></td></tr>";
    if($found7==1) {
     echo "<tr><td>$em_name_first  $em_name_middle[0] $em_name_last</td><td>$em_emergrelation</td><td>$em_num_res1_cc $em_num_res1_ac $em_num_res1</td><td>$em_num_mobile1_cc $em_num_mobile1_ac $em_num_mobile1</td><td>$em_email1</td><td><a href=\"personnelemergencyedit.php?loginid=$loginid&eid=$employeeid&cid=$em_contactid\" class='btn btn-warning btn-sm' role='button'>Add/Edit</a></td></tr>";
    } //if
     echo "</table><p>";

// end emergency contact details

// start spouse details

  if ($emp_civilstatus <> "Single")
  {
	$res4query = "SELECT empspouseid, empspousectr, empspouselast, empspousefirst, empspousemiddle, empspousebirthdate FROM tblempspouse WHERE employeeid='$employeeid'";
	$result4=""; $found4=0; $ctr4=0;
	$result4=$dbh2->query($res4query);
	if($result4->num_rows>0) {
		while($myrow4=$result4->fetch_assoc()) {
		$found4=1;
	  $empspouseid = $myrow4['empspouseid'];
	  $empspousectr = $myrow4['empspousectr'];
	  $empspouselast = $myrow4['empspouselast'];
	  $empspousefirst = $myrow4['empspousefirst'];
	  $empspousemiddle = $myrow4['empspousemiddle'];
	  $empspousebirthdate = $myrow4['empspousebirthdate'];
		} // while($myrow4=$result4->fetch_assoc())
	} // if($result4->num_rows>0)

	$res41query = "SELECT tblempspouseemployer.empspouseemployerid, tblempspouseemployer.empspouseid, tblempspouseemployer.companyid, tblempspouseemployer.datefrom, tblempspouseemployer.dateto FROM tblempspouseemployer WHERE tblempspouseemployer.employeeid=\"$employeeid\"";
	$result41=""; $found41=0; $ctr41=0;
	$result41=$dbh2->query($res41query);
	if($result41->num_rows>0) {
		while($myrow41=$result41->fetch_assoc()) {
	  $found41 = 1;
	  $empspouseemployerid41 = $myrow41['empspouseemployerid'];
	  $empspouseid41 = $myrow41['empspouseid'];
	  $companyid41 = $myrow41['companyid'];
	  $datefrom41 = $myrow41['datefrom'];
	  $dateto41 = $myrow41['dateto'];
		} // while($myrow41=$result41->fetch_assoc())
	} // if($result41->num_rows>0)

	$res42query = "SELECT companyid, company, ofc_address1, ofc_num1, ofc_num2, ofc_email FROM tblcompany WHERE employeeid=\"$employeeid\" AND company_type=\"spouse_employer\"";
	$result42=""; $found42=0; $ctr42=0;
	$result42=$dbh2->query($res42query);
	if($result42->num_rows>0) {
		while($myrow42=$result42->fetch_assoc()) {
	  $found42 = 1;
	  $companyid42 = $myrow42['companyid'];
	  $company42 = $myrow42['company'];
	  $ofc_address142 = $myrow42['ofc_address1'];
	  $ofc_num142 = $myrow42['ofc_num1'];
	  $ofc_num242 = $myrow42['ofc_num2'];
	  $ofc_email42 = $myrow42['ofc_email'];
		} // while($myrow42=$result42->fetch_assoc())
	} // if($result42->num_rows>0)

	echo "<form action=\"personnelupdspouse.php?loginid=$loginid&eid=$employeeid\" method=\"post\" name=\"personnelupdspouse\">";
     echo "<table width=100% class=\"fin2\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=2>Spouse Details</th></tr>";
	echo "<tr><th align=\"right\">Full Name</th><td>";
	echo "<table border=0 spacing=0><tr>";
	echo "<td><input name=\"empspouselast\" value=\"$empspouselast\"></td>";
	echo "<td><input name=\"empspousefirst\" value=\"$empspousefirst\"></td>";
	echo "<td><input name=\"empspousemiddle\" value=\"$empspousemiddle\"></td></tr>";
	echo "<tr><td><font size=1><i>Last Name</i></td><td><font size=1><i>First Name</i></td><td><font size=1><i>Middle Name</i></td>";
	echo "</tr></table>";
	echo "</td></tr>";
	echo "<tr><th align=\"right\">Spouse' Birthdate</th><td>$empspousebirthdate <a href=\"personnelupdspousechgdate.php?loginid=$loginid&eid=$pid&spdate=$empspousebirthdate\">Change</a></td></tr>";
	echo "<tr><th align=\"right\">Employer</th><td><input name=\"empspouseemployer\" value=\"$company42\" size=\"30\"></td></tr>";
	echo "<tr><th align=\"right\">Employer address</th><td><textarea rows=\"2\" cols=\"30\" name=\"empspouseemployeraddress\">$ofc_address142</textarea></td></tr>";
	echo "<tr><th align=\"right\">Employer tel1.</th><td><input name=\"empspouseemployertel1\" value=\"$ofc_num142\"></td></tr>";
	echo "<tr><th align=\"right\">Employer tel2.</th><td><input name=\"empspouseemployertel2\" value=\"$ofc_num242\"></td></tr>";
	echo "<tr><th align=\"right\">Employer email</th><td><input name=\"empspouseemployeremail\" value=\"$ofc_email42\"></td></tr>";
	echo "<tr><th align=\"right\">Employment period</th><td>From&nbsp;<input name=\"empspouseemployerperiodfr\" value=\"$datefrom41\">&nbsp;To&nbsp;<input name=\"empspouseemployerperiodto\" value=\"$dateto41\"></td></tr>";
	echo "<tr><td></td><td><button type=\"submit\" class='btn btn-success'>Update Spouse Details</button></td></tr></table>";
	echo "</form>";
  }
  else
  {
  }
// end spouse details

// start dependents details

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=7>Dependents</th></tr>";
     echo "<tr><td><font size=1>FirstName</font></td><td><font size=1>Middle</font></td><td><font size=1>LastName</font></td><td><font size=1>Birthdate</font></td><td><font size=1>Relationship</font></td><td><font size=1>Action1</font></td><td><font size=1>Action2</font></td></tr>";
		$res5query = "SELECT empdependentid, empdependentctr, dependentlast, dependentfirst, dependentmiddle, dependentbirthdate, dependentrelation FROM tblempdependent WHERE employeeid='$employeeid'";
		$result5=""; $found5=0; $ctr5=0;
		$result5=$dbh2->query($res5query);
		if($result5->num_rows>0) {
			while($myrow5=$result5->fetch_assoc()) {
			$found5 = 1;
	$empdependentid = $myrow5['empdependentid'];
	$empdependentctr = $myrow5['empdependentctr'];
	$dependentlast = $myrow5['dependentlast'];
	$dependentfirst = $myrow5['dependentfirst'];
	$dependentmiddle = $myrow5['dependentmiddle'];
	$dependentbirthdate = $myrow5['dependentbirthdate'];
	$dependentrelation = $myrow5['dependentrelation'];
	if($dependentfirst != '') {
	echo "<tr><td>$dependentfirst</td><td>$dependentmiddle</td><td>$dependentlast</td><td>$dependentbirthdate</td><td>$dependentrelation</td><td><a href=\"personnelempdependentdel.php?loginid=$loginid&eid=$employeeid&did=$empdependentid\" class='btn btn-danger btn-sm' role='button'>Del</a></td><td><a href=\"personnelempdependentedit.php?loginid=$loginid&eid=$employeeid&did=$empdependentid\" class='btn btn-warning btn-sm' role='button'>Edit</a></td></tr>";
	} else {
	echo "<tr><td colspan=5><center>N/A</center></td><td>";
  // echo "<a href=\"personnelempdependentdel.php?loginid=$loginid&eid=$employeeid&did=$empdependentid\">Delete</a>";
  echo "</td><td>";
  // echo "<a href=\"personnelempdependentedit.php?loginid=$loginid&eid=$employeeid&did=$empdependentid\">Edit</a>";
  echo "</td></tr>";
	} // if($dependentfirst != '')
			} // while($myrow5=$result5->fetch_assoc())
		} // if($result5->num_rows>0)

     echo "<tr><td colspan=7><center><a href=\"personnelempdependentadd.php?loginid=$loginid&eid=$employeeid\" class='btn btn-primary' role='button'>(+) Add new Dependent</a></center></td></tr></table>";

// end dependents details

	} // if($pid == '')

echo "</td></tr></table>";

     echo "<p><a href=\"personneledit.php?loginid=$loginid\" class='btn btn-default'>Back</a></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery);

     include ("footer.php");

} else {

     include("logindeny.php");

}

// mysql_close($dbh);
$dbh2->close();
?> 

<script type="text/javascript">
function popupwindow(loginid, pid) {
//     alert("This is a test");
     window.open("personnelpicbrowse.php?loginid=" + loginid + "&eid=" + pid,"Upload","menubar=no,width=430,height=260,toolbar=no");
}
</script>