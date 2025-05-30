<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$cutoffdate = $_GET['codate'];

$notifierid = 3;
// test only
// $to = "brfuertes@philkoei.com.ph";
// $cc = "brfuertes@philkoei.com.ph";
$to = "psamoza@philkoei.com.ph";
$cc = "gnbenitez@philkoei.com.ph";

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
     echo "<p><font size=1>Modules >> Project Assignments >> List of Expiring Contracts >> Email notifier</font></p>";

// start contents here...
     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>List of Expiring Contracts - Email Notifier</b></font></td></tr>";

     echo "<tr><td colspan=2>Philkoei International Inc. - List of Expiring Contracts</td></tr>";

     echo "<form action=projassignexpemail2.php?loginid=$loginid&codate=$cutoffdate method=POST target=\"_blank\">";

     $result1 = mysql_query("SELECT adminuid, employeeid FROM tbladminlogin WHERE adminloginid = $loginid", $dbh);
     while ($myrow1 = mysql_fetch_row($result1))
     {
	$adminuid = $myrow1[0];
	$eid = $myrow1[1];
     }

     $result2 = mysql_query("SELECT name_first, name_last, email1 FROM tblcontact WHERE employeeid ='$eid'", $dbh);
     while ($myrow2 = mysql_fetch_row($result2))
     {    
	$name_first = $myrow2[0];
	$name_last = $myrow2[1];
	$email1 = $myrow2[2];
     }

     echo "<tr><td>Cut-off date</td><td>".date("Y-M-d", strtotime($cutoffdate))."</td></tr>";

     echo "<tr><td>From</td><td><input name=from value=\"$name_first $name_last <$email1>\" size=50></td></tr>";

     echo "<tr><td>To</td><td><input name=to value=$to size=50></td></tr>";

     echo "<tr><td>Cc</td><td><input name=cc value=$cc size=50></td></tr>";

     echo "<tr><td>Bcc</td><td><input name=bcc value=$email1 size=50></td></tr>";
   
     $result3 = mysql_query("SELECT subject, header, footer, notes FROM tblemailnotifier WHERE notifierid=$notifierid", $dbh); 

     while ($myrow3 = mysql_fetch_row($result3))
     {
          $subject = $myrow3[0];
          $header = $myrow3[1];
          $footer = $myrow3[2];
	  $notes = $myrow3[3];
     }

     echo "<tr><td>Subject</td><td><input name=subject size=50 value=\"$subject - $cutoffdate\"></td></tr>";
     echo "<tr><td>Header</td><td><textarea name=header rows=3 cols=50>$header $cutoffdate</textarea></td></tr>";

// start display list of expiring contracts
     echo "<tr><td colspan=2>List Details</td></tr>";
     echo "<tr><td colspan=2><table width=\"100%\" class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th>Ctr</th><th>Ref.No.</th><th>Employee No.</th><th>LastName</th><th>FirstName</th><th>Project Name</th><th>Position</th><th>Date Start</th><th>Date End</th>";
		echo "<th colspan=\"3\">Salary</th><th colspan=\"3\">Incentive allowance</th><th colspan=\"3\">Project allowance</th><th colspan=\"3\">Field allowance</th><th colspan=\"3\">Accommodation allowance</th><th colspan=\"3\">Transpo allowance</th><th colspan=\"3\">Communication allowance</th><th colspan=\"2\">Per diem</th><th colspan=\"2\">Ecola1</th><th colspan=\"2\">Ecola2</th>";
		echo "</tr>";

     $ctr4 = 0;

     $result4 = mysql_query("SELECT projassignexpiringid, cutoffdate, cutoffname, projassignid, projassign0id, employeeid, remarks, stat_finalized, stat_emailed FROM tblprojassignexpiring WHERE cutoffdate = \"$cutoffdate\"", $dbh);
     while($myrow4 = mysql_fetch_row($result4))
     {
	$found4 = 1;
	$ctr4++;
	$projassignexpiringid = $myrow4[0];
	$cutoffdate = $myrow4[1];
	$cutoffname = $myrow4[2];
	$projassignid = $myrow4[3];
	$projassign0id = $myrow4[4];
	$employeeid = $myrow4[5];
	$remarks = $myrow4[6];
	$stat_finalized = $myrow4[7];
	$stat_emailed = $myrow4[8];

//	echo "vartest ctr:$ctr4 id:$projassignexpiringid prjid:$projassignid eid:$employeeid<br>";

	$result5 = mysql_query("SELECT projassignid, ref_no, employeeid, proj_code, proj_name, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, allow_comm, allow_comm_currency, allow_comm_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationfrom2, durationto2 FROM tblprojassign WHERE projassignid = \"$projassignid\" AND employeeid = \"$employeeid\" ORDER BY durationto DESC, durationto2 DESC", $dbh);
	while($myrow5 = mysql_fetch_row($result5))
	{
	  $found5 = 1;
//	  $projassignid = $myrow5[0];
	  $ref_no = $myrow5[1];
//	  $employeeid = $myrow5[2];
	  $proj_code = $myrow5[3];
	  $proj_name = $myrow5[4];
	  $position = $myrow5[5];
		$salary = $myrow5[6];
		$salarycurrency = $myrow5[7];
		$salarytype = $myrow5[8];
		$allow_inc = $myrow5[9];
		$allow_inc_currency = $myrow5[10];
		$allow_inc_paytype = $myrow5[11];
		$allow_proj = $myrow5[12];
		$allow_proj_currency = $myrow5[13];
		$allow_proj_paytype = $myrow5[14];
		$ecola1 = $myrow5[15];
		$ecola1_currency = $myrow5[16];
		$ecola2 = $myrow5[17];
		$ecola2_currency = $myrow5[18];
		$allow_field_currency = $myrow5[19];
		$allow_field_paytype = $myrow5[20];
		$allow_field = $myrow5[21];
		$allow_accomm = $myrow5[22];
		$allow_accomm_currency = $myrow5[23];
		$allow_accomm_paytype = $myrow5[24];
		$allow_transpo = $myrow5[25];
		$allow_transpo_currency = $myrow5[26];
		$allow_transpo_paytype = $myrow5[27];
		$allow_comm = $myrow5[28];
		$allow_comm_currency = $myrow5[29];
		$allow_comm_paytype = $myrow5[30];
		$perdiem = $myrow5[31];
		$perdiem_currency = $myrow5[32];
	  $durationfrom = $myrow5[33];
	  $durationto = $myrow5[34];
	  $durationfrom2 = $myrow5[35];
	  $durationto2 = $myrow5[36];

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

	  $result6 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = \"$employeeid\"", $dbh);
	  while($myrow6 = mysql_fetch_row($result6))
	  {
	    $found6 = 1;
//	    $employeeid6 = $myrow6[0];
	    $name_last6 = $myrow6[1];
	    $name_first6 = $myrow6[2];
	    $name_middle6 = $myrow6[3];

	    echo "<tr><td>$ctr4</td><td>$ref_no</td><td>$employeeid</td><td>$name_last6</td><td>$name_first6</td>";
			// echo "<td>$proj_name</td>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		echo "<td>";
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
		echo "<td>$proj_code - ";
		if($proj_sname3 != '') {
			echo "$proj_sname3</td>";
		} else if($proj_fname3 != '') {
			$projfnamefin=strpos("$proj_fname3", 20, 0);
			echo "$projfnamefin</td>";
		} else if($proj_name != '') {
			echo "$proj_name</td>";
		} else { echo "</td>"; }
	}

			echo "<td>$position</td><td>".date("Y-M-d", strtotime($durationfrom))."</td><td>".date("Y-M-d", strtotime($durationto))."</td>";

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

	$result7 = mysql_query("SELECT projectassign0id, ref_no, employeeid1, name_last, name_first, name_middle, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2 FROM tblprojassign0 WHERE projectassign0id = \"$projassign0id\" AND employeeid1 = \"$employeeid\" ORDER BY durationto DESC, durationto2 DESC", $dbh);
	while($myrow7 = mysql_fetch_row($result7))
	{
	  $found7 = 1;
	  $projectassign0id = $myrow7[0];
	  $ref_no12 = $myrow7[1];
	  $employeeid12 = $myrow7[2];
	  $name_last12 = $myrow7[3];
	  $name_first12 = $myrow7[4];
	  $name_middle12 = $myrow7[5];
	  $proj_code12 = $myrow7[6];
	  $proj_name12 = $myrow7[7];
	  $position12 = $myrow7[8];
	  $durationfrom12 = $myrow7[9];
	  $durationto12 = $myrow7[10];
	  $durationfrom212 = $myrow7[11];
	  $durationto212 = $myrow7[12];

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

	  echo "<tr><td>$ctr4</td><td>$ref_no12</a></td><td>$employeeid12</td><td>$name_last12</td><td>$name_first12</td><td>$proj_name12</td><td>$position12</td><td>$durationfrom12</td><td>$durationto12</td></tr>";

	}

     }
     echo "</table></td></tr>";
// end display list of expiring contracts

     echo "<tr><td valign=top>Footer</td><td><textarea name=footer rows=5 cols=50>$footer</textarea></td></tr>";
     echo "<tr><td valign=top>Notes</td><td><textarea name=notes rows=3 cols=50>$notes</textarea></td></tr>";

     echo "<tr><td>&nbsp</td><td><input type=submit value=\"Send E-mail\"></td></tr>";
     echo "</form>";
     echo "</table>";

// end contents here...

// edit body-footer
     echo "<p><a href=projassignexpiring.php?loginid=$loginid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
