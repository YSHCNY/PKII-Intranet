<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$contracttype = $_POST['contracttype'];
$contractorder = $_POST['contractorder'];
$sortorder = $_POST['sortorder'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Project Assignments</font></p>";

echo "<table class=\"fin2\"><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Project Assignments List</b></font></td></tr>";

// start contents here...

//     echo "<tr><td colspan=13>";
//     echo "<table border=0 spacing=0><tr>";
//     echo "<td><form action=projassignlist.php?loginid=$loginid method=POST>";
//     echo "<input type=submit value=\"List Project Assignments\"></form></td>";
//     echo "<td><form action=projassignexpiring.php?loginid=$loginid method=POST>";
//     echo "<input type=submit value=\"List of Expiring Contracts\"></form></td>";
//     echo "</tr></table>";
//     echo "</td></tr>";

     echo "<tr><td colspan=13>";
     echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr>";

     echo "<form action=projassign.php?loginid=$loginid method=POST>";

     echo "<td valign=bottom><font size=1>Choose criteria</font><br>";
     echo "<select name=contracttype>";
     echo "<option>Select</option>";
     echo "<option>>> >> Consultants << <<</option>";
     echo "<option value=\"p\">P   - New Contracts for Professionals</option>";
     echo "<option value=\"apd\">APD  - New Deployments for Professionals</option>";
     echo "<option value=\"ape\">APE - Amendment to Professional's Extension</option>";
     echo "<option value=\"apm\">APM - Amendment to Professional's Modification</option>";
     echo "<option value=\"pall\">All Consultants Contracts</option>";
     echo "<option>>> >> Employees << <<</option>";
     echo "<option value=\"pe\">P   - New Contracts for Regular Employees</option>";
     echo "<option value=\"d\">D   - New Deployments for Regular Employees</option>";
     echo "<option value=\"de\">DE  - Deployments Extension for Regular Employees</option>";
     echo "<option value=\"pr\">PR  - New Deployments for Probationary Status</option>";
     echo "<option value=\"r\">R   - For Regularization from Probationary Status</option>";
     echo "<option value=\"ncs\">NCS - Notice of Completion of Service Contract</option>";
     echo "<option value=\"nsa\">NSA - Notice of Salary Adjustments</option>";
     echo "<option value=\"t\">T   - Temporary Employees</option>";
     echo "<option value=\"ate\">ATE - Amendment of Temporary Employees with Extension</option>";
     echo "<option value=\"atm\">ATM - Amendment of Temporary Employees with Modified Contracts</option>";
     echo "<option value=\"sat\">SAT - Salary Adjustment of Temporary Employees</option>";
     echo "<option value=\"eall\">All Employees Contracts</option>";
     echo "<option>>> >> ALL << <<</option>";
     echo "<option value=\"allnoref\">ALL Employees & Consultants w/o Reference Numbers</option>";
     echo "<option value=\"all\">ALL Employees & Consultants Contracts</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>Sort by</font><br>";
     echo "<select name=contractorder>";
     echo "<option value=\"ref_no\">Reference Number</option>";
     echo "<option value=\"employeeid\">Employee Number</option>";
     echo "<option value=\"name_last\">Last Name</option>";
     echo "<option value=\"name_first\">First Name</option>";
     echo "<option value=\"proj_name\">Project</option>";
     echo "<option value=\"durationfrom\">Start Date</option>";
     echo "<option value=\"durationto\">End Date</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>&nbsp;</font><br>";
     echo "<select name=sortorder>";
     echo "<option value=\"asc\">ascending</option>";
     echo "<option value=\"desc\">descending</option>";
     echo "</select></td>";

     echo "<td valign=bottom><input type=submit value=Go></td></form>";
     echo "</tr></table>";
     echo "</td></tr>";

     echo "<tr><td>";

     if ($contracttype == 'p')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"P%\" AND tblprojassign.employeeid LIKE \"C%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: P - New Contracts for Professionals</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";

	// echo "<td>$proj_code</td><td>$proj_name</td>";

	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}

	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"P%\" AND tblprojassign0.employeeid1 LIKE \"C%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'apd')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"APD%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: APD - New Project Deployments for Professionals</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"APD%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'ape')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"APE%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: APE - Amendment to Professionals' Extension</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"APE%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'apm')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"APM%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: APM - Amendment to Professionals' Modification</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"APM%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'pall')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"APM%\" OR ref_no LIKE \"APE%\" OR ref_no LIKE \"P%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: All - Professional-Consultants Contracts</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"APM%\" OR ref_no LIKE \"APE%\" OR ref_no LIKE \"P%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
// start - newly added 20100819
     else if ($contracttype == 'pe')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"P%\" AND tblprojassign.employeeid NOT LIKE \"C%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: P - New Contracts for Employees</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"P%\" AND tblprojassign0.employeeid1 NOT LIKE \"C%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
// end - newly added 20100819

     else if ($contracttype == 'd')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"D-%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: D - New Deployments for Regular Employees</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// modified 20180405
	// to display main proj in tblprojassign, then in tblprojcdassign
	echo "<td colspan=\"2\" nowrap>";
	echo "$proj_code - $proj_name<br>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		$projectid5a=$myrow5a[0];
		$projcode5a=$myrow5a[1];
		$projname5a=$myrow5a[2];
		echo "$projcode5a - $projname5a<br>";
		}
	}
	echo "</td>";

	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"D-%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'de')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"DE%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: DE - Deployments Extension for Regular Employees</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"DE%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
else if ($contracttype == 'pr')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"PR%\" OR ref_no LIKE \"P%\" AND tblprojassign.employeeid NOT LIKE \"C%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: PR - Deployments for Probationary Status</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"PR%\" OR ref_no LIKE \"P%\" AND tblprojassign0.employeeid1 NOT LIKE \"C%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'r')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"R%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: R - Employees for Regularization from Probationary</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"R%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'ncs')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"NCS%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: NCS - Notice of ...</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"NCS%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'nsa')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"NSA%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: NSA - Notice of Salary Adjustment for Employees</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"NSA%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 't')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"T%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: T - Temporary Employees</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"T%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'ate')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"ATE%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: ATE - Amendment of Temporary employees with Extension</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"ATE%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'atm')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"ATM%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: ATM - Amendment of Temporary employees with Modified contracts</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"ATM%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'sat')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"SAT%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: SAT - Salary Adjustment of Temporary employees</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"SAT%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'eall')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE ref_no LIKE \"D%\" OR ref_no LIKE \"R%\" OR ref_no LIKE \"NSA%\" OR ref_no LIKE \"T%\" OR ref_no LIKE \"ATE%\" OR ref_no LIKE \"ATM%\" OR ref_no LIKE \"SAT%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: All - Employees' Contracts</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE ref_no LIKE \"D%\" OR ref_no LIKE \"R%\" OR ref_no LIKE \"NSA%\" OR ref_no LIKE \"T%\" OR ref_no LIKE \"ATE%\" OR ref_no LIKE \"ATM%\" OR ref_no LIKE \"SAT%\" ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'allnoref')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE tblprojassign.ref_no = '' ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: All - Contracts References of Employees & Consultants</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE tblprojassign0.ref_no = '' ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }
     else if ($contracttype == 'all')
     {
	$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid0, tblprojassign.employeeid, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.term_resign, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblprojassign JOIN tblcontact ON tblprojassign.employeeid = tblcontact.employeeid WHERE tblprojassign.projassignid <> 0 AND tblcontact.contact_type = 'personnel' ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Listing: All - Contracts References of Employees & Consultants</b></font></td></tr>";
	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Reference No.</td><td bgcolor=yellow>Proj.Emp.No.</td><td bgcolor=yellow>Employee No.</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>M.I.</td><td bgcolor=yellow>Project Code</td><td bgcolor=yellow>Project Name</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>Date Start</td><td bgcolor=yellow>Date End</td><td bgcolor=yellow>Action</td></tr>";

	$ctr1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $ctr1 = $ctr1 + 1;
	  $projassignid = $myrow1[0];
	  $ref_no = $myrow1[1];
	  $employeeid0 = $myrow1[2];
	  $employeeid = $myrow1[3];
	  $proj_code = $myrow1[4];
	  $proj_name = $myrow1[5];
	  $position = $myrow1[6];
	  $durationfrom = $myrow1[7];
	  $durationto = $myrow1[8];
	  $term_resign = $myrow1[9];
	  $name_last = $myrow1[10];
	  $name_first = $myrow1[11];
	  $name_middle = $myrow1[12];

	echo "<tr><td>$ctr1</td><td>$ref_no</td><td>$employeeid0</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	// echo "<td>$proj_code</td><td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td colspan=\"2\" nowrap>";
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			echo "$projcode5 - $projname5<br>";
			}
		}
		echo "</td>";
	} else {
		echo "<td>$proj_code</td>";
		if($proj_sname3 != '') {
			echo "<td>$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "<td>$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "<td>$proj_name</td>";
		} else { echo "<td></td>"; }
	}
	echo "<td>$position</td><td>$durationfrom</td><td>$durationto</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>More</a></td></tr>";
	}

	$result12 = mysql_query("SELECT tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid, tblprojassign0.employeeid1, tblprojassign0.proj_code, tblprojassign0.proj_name, tblprojassign0.position, tblprojassign0.durationfrom, tblprojassign0.durationto, tblprojassign0.term_resign, tblprojassign0.name_last, tblprojassign0.name_first, tblprojassign0.name_middle FROM tblprojassign0 WHERE tblprojassign0.projectassign0id <> 0 ORDER BY $contractorder $sortorder", $dbh);

	echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

	$ctr12 = $ctr1;

	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $ctr12 = $ctr12 + 1;
	  $projectassign0id = $myrow12[0];
	  $ref_no12 = $myrow12[1];
	  $employeeid12 = $myrow12[2];
	  $employeeid112 = $myrow12[3];
	  $proj_code12 = $myrow12[4];
	  $proj_name12 = $myrow12[5];
	  $position12 = $myrow12[6];
	  $durationfrom12 = $myrow12[7];
	  $durationto12 = $myrow12[8];
	  $term_resign12 = $myrow12[9];
	  $name_last12 = $myrow12[10];
	  $name_first12 = $myrow12[11];
	  $name_middle12 = $myrow12[12];

	echo "<tr><td>$ctr12</td><td>$ref_no12</td><td>$employeeid12</td><td>$employeeid112</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td>";
	echo "<td>$proj_code12</td><td>$proj_name12</td>";
	echo "<td>$position12</td><td>$durationfrom12</td><td>$durationto12</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>More</a></td></tr>";
	}
     }

     echo "</td></tr>";
     echo "</table>";

// end contents here...

     echo "</td></tr>";
     echo "</table>";

// edit body-footer
     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
