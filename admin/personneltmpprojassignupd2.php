<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projectassign0id = $_GET['prjid'];

$found = 0;
$found3 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  echo "<p><font color=green><b>Project assignment propagated</b></font></p>";

  $result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {    
	$found = 1;
	$name_last = $myrow[1];
	$name_first = $myrow[2];
	$name_middle = $myrow[3];
  }
  echo "<p>For: $employeeid - $name_last, $name_first $name_middle[0]</p>";

	$result3 = mysql_query("SELECT * FROM tblprojassign0 WHERE projectassign0id = $projectassign0id AND employeeid1 = '$employeeid'", $dbh);

	echo "<table border=1 spacing=1>";

	while ($myrow3 = mysql_fetch_row($result3))
	{
	  $found3 = 1;
	  $projectassign0id = $myrow3[0];
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

//	echo "vartest tblprojassign0<br>";
//	echo "projectassign0id:$projectassign0id<br>";
//	echo "projdate:$projdate<br>";
//	echo "ref_no:$ref_no<br>";
//	echo "employeeid:$employeeid<br>";
//	echo "name:$name_last, $name_first $name_middle<br>";
//	echo "proj_code:$proj_code<br>";
//	echo "proj_name:$proj_name<br>";
//	echo "empprojctr:$empprojctr<br>";
//	echo "status:$status<br>";
//	echo "position:$position<br>";
//	echo "origdatehired:$origdatehired<br>";
//	echo "salaryremarks:$salaryremarks<br>";
//	echo "salary:$salary $salarycurrency $salarytype<br>";
//	echo "allow_inc:$allow_inc $allow_inc_currency $allow_inc_paytype<br>";
//	echo "allow_proj:$allow_proj_fin $allow_proj_currency $allow_proj_paytype<br>";
//	echo "ecola1:$ecola1<br>";
//	echo "ecola2:$ecola2<br>";
//	echo "allow_field:$allow_field $allow_field_currency $allow_field_paytype<br>";
//	echo "allow_accomm:$allow_accomm $allow_accomm_currency $allow_accomm_paytype<br>";
//	echo "perdiem:$perdiem_fin $perdiem_currency<br>";
//	echo "duration: from:$durationfrom to:$durationto<br>";
//	echo "duration2: from2:$durationfrom2 to:$durationto2<br>";
//	echo "durationtotal:$durationtotal<br>";
//	echo "term_resign:$term_resign<br>";
//	echo "remarks:$remarks<br>";
//	echo "remarks2:$remarks2<br>";

	if ($salary == '')
	{ $salary = 0.00; }
	if ($allow_inc == '')
	{ $allow_inc = 0.00; }
	if ($allow_proj_fin == '')
	{ $allow_proj_fin = 0.00; }
	if ($ecola1 == '')
	{ $ecola1 = 0.00; }
	if ($ecola2 == '')
	{ $ecola2 = 0.00; }
	if ($allow_field == '')
	{ $allow_field = 0.00; }
	if ($allow_accomm == '')
	{ $allow_accomm = 0.00; }
	if ($perdiem_fin == '')
	{ $perdiem_fin = 0.00; }

	if ($found3 == 1)
	{
		$result2 = mysql_query("INSERT INTO tblprojassign (projdate, ref_no, employeeid, employeeid0, proj_code, proj_name, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field, allow_field_currency, allow_field_paytype, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationtotal, durationtotprop, durationfrom2, durationto2, duration2total, duration2totprop, durationprojassigntot, durationprojassigntotprop, term_resign, remarks) VALUES ('$projdate', '$ref_no', '$employeeid1', '$employeeid', '$proj_code', \"$proj_name\", \"$position\", '$salary', '$salarycurrency', '$salarytype', '$allow_inc', '$allow_inc_currency', '$allow_inc_paytype', '$allow_proj_fin', '$allow_proj_currency', '$allow_proj_paytype', '$ecola1', '$ecola1_currency', '$ecola2', '$ecola2_currency', '$allow_field', '$allow_field_currency', '$allow_field_paytype', '$allow_accomm', '$allow_accomm_currency', '$allow_accomm_paytype', '$allow_transpo', '$allow_transpo_currency', '$allow_transpo_paytype', '$perdiem_fin', '$perdiem_currency', '$durationfrom', '$durationto', '$durationtotal_fin', '$durationtotprop', '$durationfrom2', '$durationto2', '$duration2total', '$duration2totprop', '$durationprojassigntot', '$durationprojassigntotprop','$term_resign', \"$remarks\")", $dbh) or die ("Couldn't execute query.".mysql_error());

		$result1 = mysql_query("DELETE FROM tblprojassign0 WHERE projectassign0id = $projectassign0id AND employeeid1 = '$employeeid1'", $dbh) or die ("Couldn't execute query.".mysql_error());

		echo "<b>Data transferred from maindb.tblprojassign0 to maindb.tblprojassign</b><br>";
		echo "Details:<br>";
		echo "projdate:$projdate<br>";
		echo "ref_no:$ref_no<br>";
		echo "oldempid:$employeeid<br>";
		echo "employeeid:$employeeid1<br>";
		echo "proj_code:$proj_code<br>";
		echo "proj_name:$proj_name<br>";
		echo "position:$position<br>";
		echo "salary:$salary $salarycurrency $salarytype<br>";
		echo "allow_inc:$allow_inc $allow_inc_currency $allow_inc_paytype<br>";
		echo "allow_proj:$allow_proj_fin $allow_proj_currency $allow_proj_paytype<br>";
		echo "ecola1:$ecola1<br>";
		echo "ecola2:$ecola2<br>";
		echo "allow_field:$allow_field $allow_field_currency $allow_field_paytype<br>";
		echo "allow_accomm:$allow_accomm $allow_accomm_currency $allow_accomm_paytype<br>";
		echo "perdiem:$perdiem_fin $perdiem_currency<br>";
		echo "duration: from:$durationfrom to:$durationto total:$durationtotal_fin $durationtotprop<br>";
		echo "duration2: from2:$durationfrom2 to2:$durationto2 total:$duration2total $duration2totprop<br>";
		echo "totalprojectduration:$durationprojassigntot $durationprojassigntotprop<br>";
		echo "term_resign:$term_resign<br>";
		echo "remarks:$remarks<br>";
		echo "remarks2:$remarks2<br>";
		echo "Update Record - OK<br>";
	}
	else
	{
		echo "<p><font color=red><b>Sorry. No data saved.</b></font></p>";
	}

  echo "<p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

  echo "<a href=personneltmpprojassignmng.php?loginid=$loginid>Back to Manage tmp.Project Assignment</a><br>";

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

