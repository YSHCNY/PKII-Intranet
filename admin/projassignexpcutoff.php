<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$cutoffdate = $_GET['codate1'];
$cutoffdate0 = $_POST['codate'];

if ($cutoffdate0 <> '')
{ $cutoffdate = $cutoffdate0; }

$stat_finalized = 'no';
$stat_finalized2 = 'no';

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
     echo "<p><font size=1>Modules >> Project Assignments >> List of Expiring Contracts</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=\"40\">List of Expiring Contracts</th></tr>";

// start contents here...

     echo "<tr><td colspan=\"40\">Choose cutoff period:<br>";

     echo "<form action=projassignexpcutoff.php?loginid=$loginid&codate=$cutoffdate0 method=POST>";
     echo "<select name=codate>";

     $result = mysql_query("SELECT DISTINCT cutoffdate, cutoffname FROM tblprojassignexpiring ORDER BY cutoffdate DESC", $dbh);

     echo "<option value=select>Select</option>";

     while ($myrow = mysql_fetch_row($result))
     {
	$cutoffdate0 = $myrow[0];
	$cutoffname0 = $myrow[1];
	if($cutoffdate == $cutoffdate0) { $cutoffdtsel="selected"; } else { $cutoffdtsel=""; }
	echo "<option value=\"$cutoffdate0\" $cutoffdtsel>$cutoffdate0</option>";
     }

     echo "</select>";

     echo "<input type=submit value=Go></form>";
     echo "</td>";

     echo "</td></tr>";

     if ($cutoffdate <> '')
     {

	$result21 = mysql_query("SELECT projassignexpiringid, cutoffdate, cutoffname, projassignid, projassign0id, employeeid, remarks, stat_finalized, stat_emailed FROM tblprojassignexpiring WHERE cutoffdate = \"$cutoffdate\"", $dbh);

	echo "<tr><th>Ctr</th><th>Reference No.</th><th>Employee No.</th><th>LastName</th><th>FirstName</th><th>M.I.</th><th>Project Code</th><th>Project Name</th><th>Position</th><th>Date Start</th><th>Date End</th><th>Remarks</th><th>Action</th>";
	echo "<th colspan=\"3\">Salary</th><th colspan=\"3\">Incentive allowance</th><th colspan=\"3\">Project allowance</th><th colspan=\"3\">Field allowance</th><th colspan=\"3\">Accommodation allowance</th><th colspan=\"3\">Transpo allowance</th><th colspan=\"3\">Communication allowance</th><th colspan=\"2\">Per diem</th><th colspan=\"2\">Ecola1</th><th colspan=\"2\">Ecola2</th>";
	echo "</tr>";

	$ctr21 = 0;

	while($myrow21 = mysql_fetch_row($result21))
	{
	  $found21 = 1;
	  $ctr21 = $ctr21 + 1;
	  $projassignexpiringid = $myrow21[0];
	  $cutoffdate = $myrow21[1];
	  $cutoffname = $myrow21[2];
	  $projassignid = $myrow21[3];
	  $projassign0id = $myrow21[4];
	  $employeeid = $myrow21[5];
	  $remarks = $myrow21[6];
	  $stat_finalized = $myrow21[7];
	  $stat_emailed = $myrow21[8];

	  $result22 = mysql_query("SELECT projassignid, ref_no, employeeid, proj_code, proj_name, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, allow_comm, allow_comm_currency, allow_comm_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationfrom2, durationto2, idhrpositionctg FROM tblprojassign WHERE projassignid = \"$projassignid\" AND employeeid = \"$employeeid\"", $dbh);

	  while($myrow22 = mysql_fetch_row($result22))
	  {
	    $found22 = 1;
//	    $projassignid = $myrow22[0];
	    $ref_no = $myrow22[1];
//	    $employeeid = $myrow22[2];
	    $proj_code = $myrow22[3];
	    $proj_name = $myrow22[4];
	    $position = $myrow22[5];
			$salary = $myrow22[6];
			$salarycurrency = $myrow22[7];
			$salarytype = $myrow22[8];
			$allow_inc = $myrow22[9];
			$allow_inc_currency = $myrow22[10];
			$allow_inc_paytype = $myrow22[11];
			$allow_proj = $myrow22[12];
			$allow_proj_currency = $myrow22[13];
			$allow_proj_paytype = $myrow22[14];
			$ecola1 = $myrow22[15];
			$ecola1_currency = $myrow22[16];
			$ecola2 = $myrow22[17];
			$ecola2_currency = $myrow22[18];
			$allow_field_currency = $myrow22[19];
			$allow_field_paytype = $myrow22[20];
			$allow_field = $myrow22[21];
			$allow_accomm = $myrow22[22];
			$allow_accomm_currency = $myrow22[23];
			$allow_accomm_paytype = $myrow22[24];
			$allow_transpo = $myrow22[25];
			$allow_transpo_currency = $myrow22[26];
			$allow_transpo_paytype = $myrow22[27];
			$allow_comm = $myrow22[28];
			$allow_comm_currency = $myrow22[29];
			$allow_comm_paytype = $myrow22[30];
			$perdiem = $myrow22[31];
			$perdiem_currency = $myrow22[32];
	    $durationfrom = $myrow22[33];
	    $durationto = $myrow22[34];
	    $durationfrom2 = $myrow22[35];
	    $durationto2 = $myrow22[36];
			$idhrpositionctg = $myrow22[37];

	    if ($durationto2 <> '')
	    {
	      if ($durationto2 <> '0000-00-00')
	      {
		if ($durationto2 <= "$cutoffdate")
		{
		  $durationto = $durationto2;
		}
	      }
	    }

	    $result23 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = \"$employeeid\"", $dbh);

	    while($myrow23 = mysql_fetch_row($result23))
	    {
	      $found23 = 1;
//	      $employeeid = $myrow23[0];
	      $name_last = $myrow23[1];
	      $name_first = $myrow23[2];
	      $name_middle = $myrow23[3];

	      echo "<tr><td>$ctr21</td><td><a href=projassignmore.php?loginid=$loginid&eid=$employeeid&pid=$projassignid target=_blank>$ref_no</a></td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
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

		// 20180606
		if($position=='' && $idhrpositionctg!=0) {
			// query tblhrpositionctg
			$res19query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg";
			$result19=""; $found19=0;
			$result19=$dbh2->query($res19query);
			if($result19->num_rows>0) {
				while($myrow19=$result19->fetch_assoc()) {
				$found19 = 1;
				$idhrpositionctg19 = $myrow19['idhrpositionctg'];
				$code19 = $myrow19['code'];
				$name19 = $myrow19['name'];
				$deptcd19 = $myrow19['deptcd'];
				} // while($myrow19=$result19->fetch_assoc())
			} // if($result19->num_rows>0)
			echo "<td>$name19</td>";
		} else {
			echo "<td>$position</td>";
		} // if

		echo "<td>".date("Y-M-d", strtotime($durationfrom))."</td><td>".date("Y-M-d", strtotime($durationto))."</td>";

	  if ($stat_finalized == 'yes') {
			echo "<td>$remarks</td>";
			if ($remarks != '') {
			  echo "<td>Finalized</td>";
			  $stat_finalized2 = $stat_finalized;
			} else {
			  echo "<td>&nbsp;</td>";
			}
	  } else {
			echo "<td><form action=projassignexpremupda.php?loginid=$loginid&prexpid=$projassignexpiringid&codate=$cutoffdate&prid=$projassignid&eid=$employeeid method=post><input size=30 name=remarks value=\"$remarks\"></td>";
			echo "<td><input type=submit value=\"Update\"></td></form>";
	  }

	// insert salaries & allowances here...
	if($salary != 0 || $salary > 0) {
		echo "<td align=\"right\">".number_format($salary, 2)."</td><td>$salarycurrency</td><td>$salarytype</td>";
	} else {
		echo "<td></td><td></td><td></td>";
	}
	if($allow_inc != 0 || $allow_inc > 0) {
		echo "<td align=\"right\">".number_format($allow_inc, 2)."</td><td>$allow_inc_currency</td><td>$allow_inc_paytype</td>";
	} else {
		echo "<td></td><td></td><td></td>";
	}
	if($allow_proj != 0 || $allow_proj > 0) {
		echo "<td align=\"right\">".number_format($allow_proj, 2)."</td><td>$allow_proj_currency</td><td>$allow_proj_paytype</td>";
	} else {
		echo "<td></td><td></td><td></td>";
	}
	if($allow_field != 0 || $allow_field > 0) {
		echo "<td align=\"right\">".number_format($allow_field, 2)."</td><td>$allow_field_currency</td><td>$allow_field_paytype</td>";
	} else {
		echo "<td></td><td></td><td></td>";
	}
	if($allow_accomm != 0 || $allow_accomm > 0) {
		echo "<td align=\"right\">".number_format($allow_accomm, 2)."</td><td>$allow_accomm_currency</td><td>$allow_accomm_paytype</td>";
	} else {
		echo "<td></td><td></td><td></td>";
	}
	if($allow_transpo != 0 || $allow_transpo > 0) {
		echo "<td align=\"right\">".number_format($allow_transpo, 2)."</td><td>$allow_transpo_currency</td><td>$allow_transpo_paytype</td>";
	} else {
		echo "<td></td><td></td><td></td>";
	}
	if($allow_comm != 0 || $allow_comm > 0) {
		echo "<td align=\"right\">".number_format($allow_comm, 2)."</td><td>$allow_comm_currency</td><td>$allow_comm_paytype</td>";
	} else {
		echo "<td></td><td></td><td></td>";
	}
	if($perdiem != 0 || $perdiem > 0) {
		echo "<td align=\"right\">".number_format($perdiem, 2)."</td><td>$perdiem_currency</td>";
	} else {
		echo "<td></td><td></td>";
	}
	if($ecola1 != 0 || $ecola1 > 0) {
		echo "<td align=\"right\">".number_format($ecola1, 2)."</td><td>$ecola1_currency</td>";
	} else {
		echo "<td></td><td></td>";
	}
	if($ecola2 != 0 || $ecola2 > 0) {
		echo "<td align=\"right\">$ecola2</td><td>$ecola2_currency</td>";
	} else {
		echo "<td></td><td></td>";
	}
			echo "</tr>";

	    }
	  }

	  $result12 = mysql_query("SELECT projectassign0id, ref_no, employeeid1, name_last, name_first, name_middle, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2 FROM tblprojassign0 WHERE projectassign0id = \"$projassign0id\" AND employeeid1 = \"$employeeid\"", $dbh);

//	  echo "<tr><td bgcolor=lightgray colspan=13>Results from tmp.Project Assignment</td></tr>";

//	  $ctr12 = $ctr21;

	  while($myrow12 = mysql_fetch_row($result12))
	  {
	    $found12 = 1;
//	    $ctr12 = $ctr12 + 1;
	    $projectassign0id = $myrow12[0];
	    $ref_no12 = $myrow12[1];
	    $employeeid12 = $myrow12[2];
	    $name_last12 = $myrow12[3];
	    $name_first12 = $myrow12[4];
	    $name_middle12 = $myrow12[5];
	    $proj_code12 = $myrow12[6];
	    $proj_name12 = $myrow12[7];
	    $position12 = $myrow12[8];
	    $durationfrom12 = $myrow12[9];
	    $durationto12 = $myrow12[10];
	    $durationfrom212 = $myrow12[11];
	    $durationto212 = $myrow12[12];

	    if ($durationto212 <> '')
	    {
	      if ($durationto212 <> '0000-00-00')
	      {
		if ($durationto212 <= "$cutoffdate")
		{
		  $durationto12 = $durationto212;
		}
	      }
	    }

	    echo "<tr><td>$ctr21</td><td><a href=projassignmore2.php?loginid=$loginid&e0id=$employeeid12&p0id=$projectassign0id target=_blank>$ref_no12</a></td><td>$employeeid12</td><td>$name_last12</td><td>$name_first12</td><td>$name_middle12[0]</td><td>$proj_code12</td><td>$proj_name12</td><td>$position12</td><td>$durationfrom12</td><td>$durationto12</td>";

	    if ($stat_finalized == 'yes')
	    {
	      echo "<td>$remarks</td>";
	      if ($remarks != '')
	      {
		echo "<td>Finalized</td>";
		$stat_finalized2 = $stat_finalized;
	      }
	      else
	      {
		echo "<td>&nbsp;</td>";
		echo "</tr>";
	      }
	    }
	    else
	    {
	      echo "<td><form action=projassignexpremupdb.php?loginid=$loginid&prexpid=$projassignexpiringid&codate=$cutoffdate&pr0id=$projectassign0id&eid=$employeeid12 method=post><input size=30 name=remarks12 value=\"$remarks\"></td>";
	      echo "<td><input type=submit value=\"Update\"></td></form>";
	      echo "</tr>";
	    }
	  }

	}

	echo "<tr><td colspan=\"40\">";
	echo "<table width=100% border=0 spacing=0><tr>";

	if ($stat_finalized2 != 'yes')
	{
	  echo "<td valign=top><form action=projassignexpfinalize.php?loginid=$loginid&codate=$cutoffdate method=post><input type=submit value=\"Finalize\"></form></td>";
	}
	echo "<td align=top><form action=projassignexpemail.php?loginid=$loginid&codate=$cutoffdate method=post><input type=submit value=\"Send email\"></form></td>"; 
	echo "<td valign=top><form action=projassignexpdel.php?loginid=$loginid&codate=$cutoffdate method=post><input type=submit value=\"Delete cut-off\"></form></td>";
	echo "</tr></table>";
	echo "</td></tr>";

     echo "</table>";
     }

// end contents here...

     echo "</td></tr></table>";

// edit body-footer
     echo "<p><a href=projassignexpiring.php?loginid=$loginid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 