<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['e0id'];
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

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Project Assignment Details</b></font></td></tr>";

//     if ($employeeid == '')
//     {
//	echo "<tr><td><font color=red><b>Sorry. No data available</b></font></td></tr>";
//     }
//     else
//     {

//	$result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
//	while ($myrow = mysql_fetch_row($result))
//	{
//	  $found = 1;
//	  $name_last = $myrow[0];
//	  $name_first = $myrow[1];
//	  $name_middle = $myrow[2];
//	  $position = $myrow[3];
//	}

//	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</td></tr>";

// start project assignments

	$result3 = mysql_query("SELECT * FROM tblprojassign0 WHERE employeeid1 = '$employeeid' AND projectassign0id = $projectassign0id", $dbh);

	while ($myrow3 = mysql_fetch_row($result3))
	{
	  $found3 = 1;
//	  $projectassign0id = $myrow3[0];
	  $projdate = $myrow3[1];
	  $ref_no = $myrow3[2];
	  $employeeid = $myrow3[3];
	  $employeeid1 = $myrow3[4];
	  $name_last = $myrow3[5];
	  $name_first = $myrow3[6];
	  $name_middle = $myrow3[7];
	  $proj_code = $myrow3[8];
	  $proj_name = $myrow3[9];
	  $empprojctr = $myrow3[10];
	  $status = $myrow3[11];
	  $position = $myrow3[12];
	  $origdatehired = $myrow3[13];
	  $salaryremarks = $myrow3[14];
	  $salary = $myrow3[15];
	  $salarycurrency = $myrow3[16];
	  $salarytype = $myrow3[17];
	  $allow_inc = $myrow3[18];
	  $allow_inc_currency = $myrow3[19];
	  $allow_inc_paytype = $myrow3[20];
	  $allow_proj = $myrow3[21];
	  $allow_proj_fin = $myrow3[22];
	  $allow_proj_currency = $myrow3[23];
	  $allow_proj_paytype = $myrow3[24];
	  $ecola1 = $myrow3[25];
	  $ecola1_currency = $myrow3[26];
	  $ecola2 = $myrow3[27];
	  $ecola2_currency = $myrow3[28];
	  $allow_field = $myrow3[29];
	  $allow_field_currency = $myrow3[30];
	  $allow_field_paytype = $myrow3[31];
	  $allow_accomm = $myrow3[32];
	  $allow_accomm_currency = $myrow3[33];
	  $allow_accomm_paytype = $myrow3[34];
	  $allow_transpo = $myrow3[35];
	  $allow_transpo_currency = $myrow3[36];
	  $allow_transpo_paytype = $myrow3[37];
	  $perdiem = $myrow3[38];
	  $perdiem_fin = $myrow3[39];
	  $perdiem_currency = $myrow3[40];
	  $durationfrom = $myrow3[41];
	  $durationfrom2 = $myrow3[42];
	  $durationto = $myrow3[43];
	  $durationto2 = $myrow3[44];
	  $durationtotal = $myrow3[45];
	  $durationtotal_fin = $myrow3[46];
	  $durationtotprop = $myrow3[47];
	  $duration2total = $myrow3[48];
	  $duration2totprop = $myrow3[49];
	  $durationprojassigntot = $myrow3[50];
	  $durationprojassigntotprop = $myrow3[51];
	  $term_resign = $myrow3[52];
	  $remarks = $myrow3[53];
	  $remarks2 = $myrow3[54];
	}

	echo "<tr><td colspan=2>For: $employeeid1 - <b>$name_last, $name_first $name_middle[0]</b> - $position</td></tr>";
	echo "<tr><td>Date</td><td>$projdate</td></tr>";
	echo "<tr><td>Contract Reference No.</td><td>$ref_no</td></tr>";

//	$result4 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$proj_code'", $dbh);
//	while ($myrow4 = mysql_fetch_row($result4))
//	{
//	  $found4 = 1;
//	  $proj_fname = $myrow4[0];
//	  $proj_sname = $myrow4[1];
//	}

//	echo "<tr><td>Project Code</td><td>$proj_code</td></tr>";
	echo "<tr><td>Proj. Acronym</td><td>$proj_name</td></tr>";
//	echo "<tr><td>Proj. Name</td><td>$proj_fname</td></tr>";

	echo "<tr><td>Position</td><td>$position</td></tr>";
	echo "<tr><td>Orig date hired</td><td>$origdatehired</td></tr>";

	if($accesslevel>=5) {
	echo "<tr><td>Salary rate</td><td>$salaryremarks<br>$salary $salarycurrency $salarytype</td></tr>";
	echo "<tr><td>Incentive allowance</td><td>$allow_inc $allow_inc_currency $allow_inc_paytype</td></tr>";
	echo "<tr><td>Project allowance</td><td>$allow_proj<br>$allow_proj_fin $allow_proj_currency $allow_proj_paytype</td></tr>";
	echo "<tr><td>Field allowance</td><td>$allow_field $allow_field_currency $allow_field_paytype</td></tr>";
	echo "<tr><td>Accommodation allowance</td><td>$allow_accomm $allow_accomm_currency $allow_accomm_paytype</td></tr>";
	echo "<tr><td>Transportation allowance</td><td>$allow_transpo $allow_transpo_currency $allow_transpo_paytype</td></tr>";
	echo "<tr><td>Per diem</td><td>$perdiem<br>$perdiem_fin $perdiem_currency</td></tr>";
	echo "<tr><td>ECola1</td><td>$ecola1 $ecola1_currency</td></tr>";
	echo "<tr><td>ECola2</td><td>$ecola2 $ecola2_currency</td></tr>";
	} else { // if($accesslevel>=5)
	echo "<tr><td>Salary rate</td><td></td></tr>";
	echo "<tr><td>Incentive allowance</td><td></td></tr>";
	echo "<tr><td>Project allowance</td><td></td></tr>";
	echo "<tr><td>Field allowance</td><td></td></tr>";
	echo "<tr><td>Accommodation allowance</td><td></td></tr>";
	echo "<tr><td>Transportation allowance</td><td></td></tr>";
	echo "<tr><td>Per diem</td><td></td></tr>";
	echo "<tr><td>ECola1</td><td></td></tr>";
	echo "<tr><td>ECola2</td><td></td></tr>";
	} // if($accesslevel>=5)

	echo "<tr><td>Duration</td><td>$durationfrom to $durationto = $durationtotal $durationtotprop</td></tr>";
	echo "<tr><td>Duration2 (opt)</td><td>$durationfrom2 to $durationto2 = $duration2total $duration2totprop</td></tr>";
	echo "<tr><td>Total Duration</td><td>$durationprojassigntot $durationprojassigntotprop</td></tr>";
//	echo "<tr><td>Term Resign</td><td>$term_resign</td></tr>";
	echo "<tr><td>Remarks</td><td>$remarks</td></tr>";
	echo "<tr><td>Remarks2</td><td>$remarks2</td></tr>";

	echo "</table>";

// end project assignments

//     }
 
     echo "<p><FORM><INPUT TYPE='BUTTON' VALUE='Close Window' onClick='window.close()'></FORM></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
