<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['pid'];
$employeeid0 = $_GET['e0id'];
$projectassign0id = $_GET['p0id'];

// echo "vartest loginid:$loginid employeeid:$employeeid projassignid:$projassignid employeeid0:$employeeid0 projectassign0id:$projectassign0id<br>";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
//     include ("sidebar.php");

//     echo "<p><font size=1>Modules >> Project Assignment >> More Info</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=\"2\">Project Assignment Details</th></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
//     else if ($employeeid0 == '')
//     {
//	echo "<tr><td><font color=red><b>Sorry. No data available</b></font></td></tr>";
//     }
     else
     {

	$result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $name_last = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $position = $myrow[3];
	}

	echo "<tr><th colspan=\"2\">For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</th></tr>";

// start project assignments

	$result3 = mysql_query("SELECT projassignid, projdate, ref_no, employeeid, employeeid0, proj_code, proj_name, empprojctr, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, allow_comm, allow_comm_currency, allow_comm_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationtotal, durationtotprop, durationfrom2, durationto2, duration2total, duration2totprop, durationprojassigntot, durationprojassigntotprop, term_resign, remarks, remarks2, filepath, filename, idhrpositionctg FROM tblprojassign WHERE employeeid = '$employeeid' AND projassignid = $projassignid", $dbh);

	while ($myrow3 = mysql_fetch_row($result3))
	{
	  $found3 = 1;
	  $projassignid = $myrow3[0];
	  $projdate = $myrow3[1];
	  $ref_no = $myrow3[2];
	  $employeeid = $myrow3[3];
	  $employeeid0 = $myrow3[4];
	  $proj_code = $myrow3[5];
	  $proj_name = $myrow3[6];
	  $empprojctr = $myrow3[7];
	  $position = $myrow3[8];
	  $salary = $myrow3[9];
	  $salarycurrency = $myrow3[10];
	  $salarytype = $myrow3[11];
	  $allow_inc = $myrow3[12];
	  $allow_inc_currency = $myrow3[13];
	  $allow_inc_paytype = $myrow3[14];
	  $allow_proj = $myrow3[15];
	  $allow_proj_currency = $myrow3[16];
	  $allow_proj_paytype = $myrow3[17];
	  $ecola1 = $myrow3[18];
	  $ecola1_currency = $myrow3[19];
	  $ecola2 = $myrow3[20];
	  $ecola2_currency = $myrow3[21];
	  $allow_field_currency = $myrow3[22];
	  $allow_field_paytype = $myrow3[23];
	  $allow_field = $myrow3[24];
	  $allow_accomm = $myrow3[25];
	  $allow_accomm_currency = $myrow3[26];
	  $allow_accomm_paytype = $myrow3[27];
	  $allow_transpo = $myrow3[28];
	  $allow_transpo_currency = $myrow3[29];
	  $allow_transpo_paytype = $myrow3[30];
	  $allow_comm = $myrow3[31];
	  $allow_comm_currency = $myrow3[32];
	  $allow_comm_paytype = $myrow3[33];
	  $perdiem = $myrow3[34];
	  $perdiem_currency = $myrow3[35];
	  $durationfrom = $myrow3[36];
	  $durationto = $myrow3[37];
	  $durationtotal = $myrow3[38];
	  $durationtotprop = $myrow3[39];
	  $durationfrom2 = $myrow3[40];
	  $durationto2 = $myrow3[41];
	  $duration2total = $myrow3[42];
	  $duration2totprop = $myrow3[43];
	  $durationprojassigntot = $myrow3[44];
	  $durationprojassigntotprop = $myrow3[45];
	  $term_resign = $myrow3[46];
	  $remarks = $myrow3[47];
	  $remarks2 = $myrow3[48];
	  $filepath3 = $myrow3[49];
	  $filename3 = $myrow3[50];
		$idhrpositionctg = $myrow3[51];
	}

	echo "<tr><th align=\"right\">Date</th><td>$projdate</td></tr>";
	echo "<tr><th align=\"right\">Contract Reference No.</th><td>$ref_no</td></tr>";

	$result4 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$proj_code'", $dbh);
	while ($myrow4 = mysql_fetch_row($result4))
	{
	  $found4 = 1;
	  $proj_fname = $myrow4[0];
	  $proj_sname = $myrow4[1];
	}

	// echo "<tr><th align=\"right\">Project Code</th><td>$proj_code</td></tr>";
	// echo "<tr><th align=\"right\">Proj. Acronym</th><td>$proj_name $proj_sname</td></tr>";
	// echo "<tr><th align=\"right\">Proj. Name</th><td>$proj_fname</td></tr>";
	echo "<tr><th align=\"right\">Project(s)</th><td>";
	// modified 20180405
	echo "$proj_code - $proj_sname - $proj_fname<br>";
	// check if tblprojcdassign has related records
	$result5a=""; $found5a=0;
	$result5a = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"", $dbh);
	if($result5a != "") {
		while($myrow5a = mysql_fetch_row($result5a)) {
		$found5a=1;
		}
	}
	if($found5a == 1) {
		$result5=""; $found5=0; $ctr5=0;
		$result5 = mysql_query("SELECT tblprojcdassign.projectid, tblprojcdassign.projcode, tblprojcdassign.projname, tblproject1.proj_sname, tblproject1.proj_fname FROM tblprojcdassign INNER JOIN tblproject1 ON tblprojcdassign.projcode=tblproject1.proj_code WHERE tblprojcdassign.projassignid=$projassignid AND tblprojcdassign.empid=\"$employeeid\"", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projectid5 = $myrow5[0];
			$projcode5 = $myrow5[1];
			$projname5 = $myrow5[2];
			$proj_sname5 = $myrow5[3];
			$proj_fname5 = $myrow5[4];
			echo "$projcode5 - $proj_sname5 - $proj_fname5<br>";
			}
		}
	}
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Position</th>";
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

	echo "</tr>";

	if($accesslevel>=5) {
	echo "<tr><th align=\"right\">Salary Rate</th><td>$salary $salarycurrency $salarytype</td></tr>";
	echo "<tr><th align=\"right\">Incentive Allowance</th><td>$allow_inc $allow_inc_currency $allow_inc_paytype</td></tr>";
	echo "<tr><th align=\"right\">Project Allowance</th><td>$allow_proj $allow_proj_currency $allow_proj_paytype</td></tr>";
	echo "<tr><th align=\"right\">Field Allowance</th><td>$allow_field $allow_field_currency $allow_field_paytype</td></tr>";
	echo "<tr><th align=\"right\">Accommodation Allowance</th><td>$allow_accomm $allow_accomm_currency $allow_accomm_paytype</td></tr>";
	echo "<tr><th align=\"right\">Transportation Allowance</th><td>$allow_transpo $allow_transpo_currency $allow_transpo_paytype</td></tr>";
	echo "<tr><th align=\"right\">Communication Allowance</th><td>$allow_comm $allow_comm_currency $allow_comm_paytype</td></tr>";
	echo "<tr><th align=\"right\">Per diem</th><td>$perdiem $perdiem_currency</td></tr>";
	echo "<tr><th align=\"right\">ECola1</th><td>$ecola1 $ecola1_currency</td></tr>";
	echo "<tr><th align=\"right\">ECola2</th><td>$ecola2 $ecola2_currency</td></tr>";
	} else { // if($accesslevel>=5)
	echo "<tr><th align=\"right\">Salary Rate</th><td></td></tr>";
	echo "<tr><th align=\"right\">Incentive Allowance</th><td></td></tr>";
	echo "<tr><th align=\"right\">Project Allowance</th><td></td></tr>";
	echo "<tr><th align=\"right\">Field Allowance</th><td></td></tr>";
	echo "<tr><th align=\"right\">Accommodation Allowance</th><td></td></tr>";
	echo "<tr><th align=\"right\">Transportation Allowance</th><td></td></tr>";
	echo "<tr><th align=\"right\">Communication Allowance</th><td></td></tr>";
	echo "<tr><th align=\"right\">Per diem</th><td></td></tr>";
	echo "<tr><th align=\"right\">ECola1</th><td></td></tr>";
	echo "<tr><th align=\"right\">ECola2</th><td></td></tr>";
	} // if($accesslevel>=5)

	echo "<tr><th align=\"right\">Duration</th><td>$durationfrom to $durationto = $durationtotal $durationtotprop</td></tr>";
	echo "<tr><th align=\"right\">Duration2 (opt)</th><td>$durationfrom2 to $durationto2 = $duration2total $duration2totprop</td></tr>";
	echo "<tr><th align=\"right\">Total Duration</th><td>$durationprojassigntot $durationprojassigntotprop</td></tr>";

	echo "<tr><th align=\"right\">Remarks</th><td>$remarks</td></tr>";
	echo "<tr><th align=\"right\">Remarks2</th><td>$remarks2</td></tr>";

	echo "<tr><th align=\"right\">Attachment</th>";
	if($filename3 != "") { echo "<td><a href=\"$filepath3/$filename3\">$filename3</a></td>"; }
	else { echo "<td></td>"; }
	echo "</tr>";

	echo "</table>";

// end project assignments

     }
 
     echo "<p><FORM><INPUT TYPE='BUTTON' VALUE='Close Window' onClick='window.close()'></FORM></p>";

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
