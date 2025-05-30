<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$projectassign0id = $_GET['pr0id'];
$employeeid = $_GET['eid'];
$projectassign0id = $_GET['prjid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

echo "<h1>TEST</h1>";
	 echo "<table class = 'table table-striped table-hover table-bordered'>";


     if ($employeeid == '')
     {
	$result3 = mysql_query("SELECT * FROM tblprojassign0 WHERE projectassign0id = $projectassign0id", $dbh);

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

	echo "<form action=personneltmpprojassignedit4.php?loginid=$loginid&pr0id=$projectassign0id&eid=$employeeid1&pid=$projectassign0id method=post>";


	echo "<tr><td align = 'right'>Employee Number</td><td><input class = 'form-control' placeholder = 'Employee ID number here..' name='employeeidnew'> <p class = 'text-danger'>Warning: No employee number for this record. Please assign one. Thank you.</p></td></tr>";
	echo "<tr><td align = 'right'>Full Name</td><td>$name_last, $name_first $name_middle</td></tr>";

	echo "<tr><td align = 'right'>Date</td><td>";
	echo "$projdate";
//	if ($projdate == '')
//	{ echo "Blank <a href=personnelprojassignchgprojdate.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&pdate=$projdate>Change</a>"; }
//	else { echo "$projdate <a href=personnelprojassignchgprojdate.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&pdate=$projdate>Change</a>";
//	}
	echo "</td><tr><td>Contract Reference No.</td><td>$ref_no</td></tr>";

	$result4 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$proj_code'", $dbh);
	while ($myrow4 = mysql_fetch_row($result4))
	{
	  $found4 = 1;
	  $proj_fname = $myrow4[0];
	  $proj_sname = $myrow4[1];
	}

//	echo "<tr><td>Project Code</td><td>$proj_code</td></tr>";
	echo "<tr><td align = 'right'>Project Acronym</td><td>$proj_name</td></tr>";
//	echo "<tr><td>Proj. Name</td><td>$proj_fname</td></tr>";
//	echo "<tr><td colspan=2 align=center><a href=personnelprojassignchgproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassign0id&prjcd=$proj_code>Change Project Name</a></td></tr>";

	echo "<tr><td align = 'right'>Position</td><td>$position</td></tr>";
//	echo "<tr><td>Duration From</td><td>$durationfrom <a href=personnelprojassigndatefrom.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&datefr=$durationfrom>Change</td></tr>";
//	echo "<tr><td>Duration From</td><td>$durationfrom</td></tr>";
//	echo "<tr><td>Duration To</td><td>$durationto</td></tr>";

//	start salary rate details
	echo "<tr><td align = 'right'>Salary Rate</td><td><i>tmpvalue</i><br><input name=salaryremarks value=\"$salaryremarks\"><br><table border=0 spacing=0><tr><td><input name=salary value=$salary></td>";

	if ($salarycurrency == 'usd')
	{
	  $salarycurrencyusd = 'selected';
	}
	elseif ($salarycurrency == 'php')
	{
	  $salarycurrencyphp = 'selected';
	}
	else
	{
	  $salarycurrencyothers = 'selected';
	}
	echo "<td><select class = 'GlobalSelect' name=salarycurrency>";
	echo "<option value=php $salarycurrencyphp>PhP</option>";
	echo "<option value=usd $salarycurrencyusd>US$</option>";
	echo "<option value=others $salarycurrencyothers>Others</option>";
	echo "</select></td>";
	if ($salarytype == 'lumpsum')
	{
	  $salarytypelumpsum = 'selected';
	}
	else if ($salarytype == 'monthly')
	{
	  $salarytypemonthly = 'selected';
	}
	else if ($salarytype == 'weekly')
	{
	  $salarytypeweekly = 'selected';
	}
	else if ($salarytype == 'daily')
	{
	  $salarytypedaily = 'selected';
	}
	else
	{
	  $salarytypeothers = 'selected';
	}
	echo "<td><select  name=salarytype>";
	echo "<option value=lumpsum $salarytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $salarytypemonthly>Monthly</option>";
	echo "<option value=weekly $salarytypeweekly>Weekly</option>";
	echo "<option value=daily $salarytypedaily>Daily</option>";
	echo "<option value=others $salarytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end salary rate details

//	start income allowance details
	echo "<tr><td>Income Allowance</td><td><table border=0 spacing=0><tr><td><input name=allow_inc value=$allow_inc></td>";
	if ($allow_inc_currency == 'usd')
	{
	  $allow_inc_currencyusd = 'selected';
	}
	elseif ($allow_inc_currency == 'php')
	{
	  $allow_inc_currencyphp = 'selected';
	}
	else
	{
	  $allow_inc_currencyothers = 'selected';
	}
	echo "<td><select  name=allow_inc_currency>";
	echo "<option value=php $allow_inc_currencyphp>PhP</option>";
	echo "<option value=usd $allow_inc_currencyusd>US$</option>";
	echo "<option value=others $allow_inc_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_inc_paytype == 'lumpsum')
	{
	  $allow_inc_paytypelumpsum = 'selected';
	}
	else if ($allow_inc_paytype == 'monthly')
	{
	  $allow_inc_paytypemonthly = 'selected';
	}
	else if ($allow_inc_paytype == 'weekly')
	{
	  $allow_inc_paytypeweekly = 'selected';
	}
	else if ($allow_inc_paytype == 'daily')
	{
	  $allow_inc_paytypedaily = 'selected';
	}
	else
	{
	  $allow_inc_paytypeothers = 'selected';
	}
	echo "<td><select  name=allow_inc_paytype>";
	echo "<option value=lumpsum $allow_inc_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_inc_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_inc_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_inc_paytypedaily>Daily</option>";
	echo "<option value=others $allow_inc_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end income allowance details

//	start project allowance details
	echo "<tr><td>Project Allowance</td><td><i>tmpvalue</i><br><input name=allow_proj value=\"$allow_proj\"><br><table border=0 spacing=0><tr><td><input name=allow_proj_fin value=$allow_proj_fin></td>";
	if ($allow_proj_currency == 'usd')
	{
	  $allow_proj_currencyusd = 'selected';
	}
	elseif ($allow_proj_currency == 'php')
	{
	  $allow_proj_currencyphp = 'selected';
	}
	else
	{
	  $allow_proj_currencyothers = 'selected';
	}
	echo "<td><select  name=allow_proj_currency>";
	echo "<option value=php $allow_proj_currencyphp>PhP</option>";
	echo "<option value=usd $allow_proj_currencyusd>US$</option>";
	echo "<option value=others $allow_proj_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_proj_paytype == 'lumpsum')
	{
	  $allow_proj_paytypelumpsum = 'selected';
	}
	else if ($allow_proj_paytype == 'monthly')
	{
	  $allow_proj_paytypemonthly = 'selected';
	}
	else if ($allow_proj_paytype == 'weekly')
	{
	  $allow_proj_paytypeweekly = 'selected';
	}
	else if ($allow_proj_paytype == 'daily')
	{
	  $allow_proj_paytypedaily = 'selected';
	}
	else
	{
	  $allow_proj_paytypeothers = 'selected';
	}
	echo "<td><select  name=allow_proj_paytype>";
	echo "<option value=lumpsum $allow_proj_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_proj_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_proj_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_proj_paytypedaily>Daily</option>";
	echo "<option value=others $allow_proj_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end project allowance details

//	start field allowance details
	echo "<tr><td>Field Allowance</td><td><table border=0 spacing=0><tr><td><input name=allow_field value=$allow_field></td>";
	if ($allow_field_currency == 'usd')
	{
	  $allow_field_currencyusd = 'selected';
	}
	elseif ($allow_field_currency == 'php')
	{
	  $allow_field_currencyphp = 'selected';
	}
	else
	{
	  $allow_field_currencyothers = 'selected';
	}
	echo "<td><select  name=allow_field_currency>";
	echo "<option value=php $allow_field_currencyphp>PhP</option>";
	echo "<option value=usd $allow_field_currencyusd>US$</option>";
	echo "<option value=others $allow_field_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_field_paytype == 'lumpsum')
	{
	  $allow_field_paytypelumpsum = 'selected';
	}
	else if ($allow_field_paytype == 'monthly')
	{
	  $allow_field_paytypemonthly = 'selected';
	}
	else if ($allow_field_paytype == 'weekly')
	{
	  $allow_field_paytypeweekly = 'selected';
	}
	else if ($allow_field_paytype == 'daily')
	{
	  $allow_field_paytypedaily = 'selected';
	}
	else
	{
	  $allow_field_paytypeothers = 'selected';
	}
	echo "<td><select  name=allow_field_paytype>";
	echo "<option value=lumpsum $allow_field_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_field_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_field_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_field_paytypedaily>Daily</option>";
	echo "<option value=others $allow_field_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end field allowance details

//	start accommodation allowance details
	echo "<tr><td>Accommodation Allowance</td><td><table border=0 spacing=0><tr><td><input name=allow_accomm value=$allow_accomm></td>";
	if ($allow_accomm_currency == 'usd')
	{
	  $allow_accomm_currencyusd = 'selected';
	}
	elseif ($allow_accomm_currency == 'php')
	{
	  $allow_accomm_currencyphp = 'selected';
	}
	else
	{
	  $allow_accomm_currencyothers = 'selected';
	}
	echo "<td><select  name=allow_accomm_currency>";
	echo "<option value=php $allow_accomm_currencyphp>PhP</option>";
	echo "<option value=usd $allow_accomm_currencyusd>US$</option>";
	echo "<option value=others $allow_accomm_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_accomm_paytype == 'lumpsum')
	{
	  $allow_accomm_paytypelumpsum = 'selected';
	}
	else if ($allow_accomm_paytype == 'monthly')
	{
	  $allow_accomm_paytypemonthly = 'selected';
	}
	else if ($allow_accomm_paytype == 'weekly')
	{
	  $allow_accomm_paytypeweekly = 'selected';
	}
	else if ($allow_accomm_paytype == 'daily')
	{
	  $allow_accomm_paytypedaily = 'selected';
	}
	else
	{
	  $allow_accomm_paytypeothers = 'selected';
	}
	echo "<td><select  name=allow_accomm_paytype>";
	echo "<option value=lumpsum $allow_accomm_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_accomm_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_accomm_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_accomm_paytypedaily>Daily</option>";
	echo "<option value=others $allow_accomm_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end accommodation allowance details

//	start transportation allowance details
	echo "<tr><td>Transportation Allowance</td><td><table border=0 spacing=0><tr><td><input name=allow_transpo value=$allow_transpo></td>";
	if ($allow_transpo_currency == 'usd')
	{
	  $allow_transpo_currencyusd = 'selected';
	}
	elseif ($allow_transpo_currency == 'php')
	{
	  $allow_transpo_currencyphp = 'selected';
	}
	else
	{
	  $allow_transpo_currencyothers = 'selected';
	}
	echo "<td><select  name=allow_transpo_currency>";
	echo "<option value=php $allow_transpo_currencyphp>PhP</option>";
	echo "<option value=usd $allow_transpo_currencyusd>US$</option>";
	echo "<option value=others $allow_transpo_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_transpo_paytype == 'lumpsum')
	{
	  $allow_transpo_paytypelumpsum = 'selected';
	}
	else if ($allow_transpo_paytype == 'monthly')
	{
	  $allow_transpo_paytypemonthly = 'selected';
	}
	else if ($allow_transpo_paytype == 'weekly')
	{
	  $allow_transpo_paytypeweekly = 'selected';
	}
	else if ($allow_transpo_paytype == 'daily')
	{
	  $allow_transpo_paytypedaily = 'selected';
	}
	else
	{
	  $allow_transpo_paytypeothers = 'selected';
	}
	echo "<td><select  name=allow_transpo_paytype>";
	echo "<option value=lumpsum $allow_transpo_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_transpo_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_transpo_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_transpo_paytypedaily>Daily</option>";
	echo "<option value=others $allow_transpo_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end transportation allowance details

//	start perdiem details
	echo "<tr><td>Per diem</td><td><i>tmpvalue</i><br><input name=perdiem value=\"$perdiem\"><br><table border=0 spacing=0><tr><td><input name=perdiem_fin value=$perdiem_fin></td>";
	if ($perdiem_currency == 'usd')
	{
	  $perdiem_currencyusd = 'selected';
	}
	elseif ($perdiem_currency == 'php')
	{
	  $perdiem_currencyphp = 'selected';
	}
	else
	{
	  $perdiem_currencyothers = 'selected';
	}
	echo "<td><select  name=perdiem_currency>";
	echo "<option value=php $perdiem_currencyphp>PhP</option>";
	echo "<option value=usd $perdiem_currencyusd>US$</option>";
	echo "<option value=others $perdiem_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end perdiem details

//	start ecola1
	echo "<tr><td>ecola1</td><td><table border=0 spacing=0><tr><td><input name=ecola1 value=\"$ecola1\"></td>";
	if ($ecola1_currency == 'usd')
	{
	  $ecola1_currencyusd = 'selected';
	}
	elseif ($ecola1_currency == 'php')
	{
	  $ecola1_currencyphp = 'selected';
	}
	else
	{
	  $ecola1_currencyothers = 'selected';
	}
	echo "<td><select  name=ecola1_currency>";
	echo "<option value=php $ecola1_currencyphp>PhP</option>";
	echo "<option value=usd $ecola1_currencyusd>US$</option>";
	echo "<option value=others $ecola1_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end ecola1

//	start ecola2
	echo "<tr><td>ecola2</td><td><table border=0 spacing=0><tr><td><input name=ecola2 value=\"$ecola2\"></td>";
	if ($ecola2_currency == 'usd')
	{
	  $ecola2_currencyusd = 'selected';
	}
	elseif ($ecola2_currency == 'php')
	{
	  $ecola2_currencyphp = 'selected';
	}
	else
	{
	  $ecola2_currencyothers = 'selected';
	}
	echo "<td><select  name=ecola2_currency>";
	echo "<option value=php $ecola2_currencyphp>PhP</option>";
	echo "<option value=usd $ecola2_currencyusd>US$</option>";
	echo "<option value=others $ecola2_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end ecola2

	echo "<tr><td>Duration1</td><td>";
	echo "<i>From:</i><input name=durationfrom value=\"$durationfrom\"> <i>To:</i><input name=durationto value=\"$durationto\">";
	echo "</td></tr>";

	echo "<tr><td>Duration2</td><td>";
	echo "<i>From:</i><input name=durationfrom2 value=\"$durationfrom2\"> <i>To:</i><input name=durationto2 value=\"$durationto2\">";
	echo "</td></tr>";

	echo "<tr><td>Total Duration</td><td><i>tmp.value</i><br><input name=durationtotal value=\"$durationtotal\"><br>";
	echo "<table border=0 spacing=0><tr><td><input name=durationtotal_fin value=\"$durationtotal_fin\"><br>Final value:</td>";
	echo "<td><input name=durationtotprop value=\"$durationtotprop\"><br>Property:</td></tr></table>";

	echo "<tr><td>Term_Resign</td><td><input name=term_resign value=\"$term_resign\"></td></tr>";

	echo "<tr><td>Remarks</td><td><textarea rows=3 cols=50 name=remarks>$remarks</textarea></td></tr>";
	echo "<tr><td>Remarks2</td><td><textarea rows=3 cols=50 name=remarks2>$remarks2</textarea></td></tr>";

	echo "<tr><td>&nbsp</td><td><input type=submit value=\"Update tmp.Project Assignment\"></td></tr>";
	echo "</form>";
     }
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

	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</td</tr>";

// start project assignments

	$result3 = mysql_query("SELECT * FROM tblprojassign0 WHERE employeeid1 = '$employeeid' AND projectassign0id = $projectassign0id", $dbh);

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

	echo "<form action=personneltmpprojassignedit4.php?loginid=$loginid&eid=$employeeid1&pid=$projectassign0id method=post>";

	echo "<tr><td align = 'right'>Employee No.</td><td><input class = 'form-control' placeholder = 'Employee Number here..' required name=employeeidnew2 value=\"$employeeid1\"></td></tr>";
	echo "<tr><td align = 'right'>Date</td><td>";
	if ($projdate == ''){
		echo "0000-00-00";

	} else {
		$projdate = $projdate;
	}
//	if ($projdate == '')
//	{ echo "Blank <a href=personnelprojassignchgprojdate.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&pdate=$projdate>Change</a>"; }
//	else { echo "$projdate <a href=personnelprojassignchgprojdate.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&pdate=$projdate>Change</a>";
//	}
	echo "</td><tr><td align = 'right'>Contract Reference Number</td><td>$ref_no</td></tr>";

	$result4 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$proj_code'", $dbh);
	while ($myrow4 = mysql_fetch_row($result4))
	{
	  $found4 = 1;
	  $proj_fname = $myrow4[0];
	  $proj_sname = $myrow4[1];
	}

//	echo "<tr><td>Project Code</td><td>$proj_code</td></tr>";
	echo "<tr><td align = 'right'>Project Acronym</td><td>$proj_name</td></tr>";
//	echo "<tr><td>Proj. Name</td><td>$proj_fname</td></tr>";
//	echo "<tr><td colspan=2 align=center><a href=personnelprojassignchgproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassign0id&prjcd=$proj_code>Change Project Name</a></td></tr>";

	echo "<tr><td align = 'right'>Position</td><td>$position</td></tr>";
//	echo "<tr><td>Duration From</td><td>$durationfrom <a href=personnelprojassigndatefrom.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&datefr=$durationfrom>Change</td></tr>";
//	echo "<tr><td>Duration From</td><td>$durationfrom</td></tr>";
//	echo "<tr><td>Duration To</td><td>$durationto</td></tr>";

//	start salary rate details
	echo "<tr><td align = 'right'>Salary Rate</td><td>temporary value<br><input class = 'form-control' placeholder = 'temporary value here...' required name=salaryremarks value=\"$salaryremarks\"><br><table border=0 spacing=0><tr><td><input class = 'form-control' placeholder = 'Amount here...' required name=salary value=$salary></td>";

	if ($salarycurrency == 'usd')
	{
	  $salarycurrencyusd = 'selected';
	}
	elseif ($salarycurrency == 'php')
	{
	  $salarycurrencyphp = 'selected';
	}
	else
	{
	  $salarycurrencyothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' id = 'GlobalSelect' name=salarycurrency>";
	echo "<option value=php $salarycurrencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $salarycurrencyusd>US Dollars (USD)</option>";
	echo "<option value=others $salarycurrencyothers>Others</option>";
	echo "</select></td>";
	if ($salarytype == 'lumpsum')
	{
	  $salarytypelumpsum = 'selected';
	}
	else if ($salarytype == 'monthly')
	{
	  $salarytypemonthly = 'selected';
	}
	else if ($salarytype == 'weekly')
	{
	  $salarytypeweekly = 'selected';
	}
	else if ($salarytype == 'daily')
	{
	  $salarytypedaily = 'selected';
	}
	else
	{
	  $salarytypeothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect'  name=salarytype>";
	echo "<option value=lumpsum $salarytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $salarytypemonthly>Monthly</option>";
	echo "<option value=weekly $salarytypeweekly>Weekly</option>";
	echo "<option value=daily $salarytypedaily>Daily</option>";
	echo "<option value=others $salarytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end salary rate details

//	start income allowance details
	echo "<tr><td align = 'right'>Income Allowance</td><td><table ><tr><td><input class ='form-control' placeholder = 'Amount here..' required name=allow_inc value=$allow_inc></td>";
	if ($allow_inc_currency == 'usd')
	{
	  $allow_inc_currencyusd = 'selected';
	}
	elseif ($allow_inc_currency == 'php')
	{
	  $allow_inc_currencyphp = 'selected';
	}
	else
	{
	  $allow_inc_currencyothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_inc_currency>";
	echo "<option value=php $allow_inc_currencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $allow_inc_currencyusd>US Dollars (USD)</option>";
	echo "<option value=others $allow_inc_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_inc_paytype == 'lumpsum')
	{
	  $allow_inc_paytypelumpsum = 'selected';
	}
	else if ($allow_inc_paytype == 'monthly')
	{
	  $allow_inc_paytypemonthly = 'selected';
	}
	else if ($allow_inc_paytype == 'weekly')
	{
	  $allow_inc_paytypeweekly = 'selected';
	}
	else if ($allow_inc_paytype == 'daily')
	{
	  $allow_inc_paytypedaily = 'selected';
	}
	else
	{
	  $allow_inc_paytypeothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_inc_paytype>";
	echo "<option value=lumpsum $allow_inc_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_inc_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_inc_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_inc_paytypedaily>Daily</option>";
	echo "<option value=others $allow_inc_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end income allowance details

//	start project allowance details
	echo "<tr><td align = 'right'>Project Allowance</td><td><i>Termporary value</i><br><input class ='form-control' placeholder = 'Amount here..' required name=allow_proj value=\"$allow_proj\"><br><table border=0 spacing=0><tr><td><input class ='form-control' placeholder = 'Amount here..' required name=allow_proj_fin value=$allow_proj_fin></td>";
	if ($allow_proj_currency == 'usd')
	{
	  $allow_proj_currencyusd = 'selected';
	}
	elseif ($allow_proj_currency == 'php')
	{
	  $allow_proj_currencyphp = 'selected';
	}
	else
	{
	  $allow_proj_currencyothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_proj_currency>";
	echo "<option value=php $allow_proj_currencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $allow_proj_currencyusd>US Dollars (USD)</option>";
	echo "<option value=others $allow_proj_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_proj_paytype == 'lumpsum')
	{
	  $allow_proj_paytypelumpsum = 'selected';
	}
	else if ($allow_proj_paytype == 'monthly')
	{
	  $allow_proj_paytypemonthly = 'selected';
	}
	else if ($allow_proj_paytype == 'weekly')
	{
	  $allow_proj_paytypeweekly = 'selected';
	}
	else if ($allow_proj_paytype == 'daily')
	{
	  $allow_proj_paytypedaily = 'selected';
	}
	else
	{
	  $allow_proj_paytypeothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_proj_paytype>";
	echo "<option value=lumpsum $allow_proj_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_proj_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_proj_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_proj_paytypedaily>Daily</option>";
	echo "<option value=others $allow_proj_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end project allowance details

//	start field allowance details
	echo "<tr><td align = 'right'>Field Allowance</td><td><table border=0 spacing=0><tr><td><input class ='form-control' placeholder = 'Amount here..' required name=allow_field value=$allow_field></td>";
	if ($allow_field_currency == 'usd')
	{
	  $allow_field_currencyusd = 'selected';
	}
	elseif ($allow_field_currency == 'php')
	{
	  $allow_field_currencyphp = 'selected';
	}
	else
	{
	  $allow_field_currencyothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_field_currency>";
	echo "<option value=php $allow_field_currencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $allow_field_currencyusd>US Dollars (USD)</option>";
	echo "<option value=others $allow_field_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_field_paytype == 'lumpsum')
	{
	  $allow_field_paytypelumpsum = 'selected';
	}
	else if ($allow_field_paytype == 'monthly')
	{
	  $allow_field_paytypemonthly = 'selected';
	}
	else if ($allow_field_paytype == 'weekly')
	{
	  $allow_field_paytypeweekly = 'selected';
	}
	else if ($allow_field_paytype == 'daily')
	{
	  $allow_field_paytypedaily = 'selected';
	}
	else
	{
	  $allow_field_paytypeothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_field_paytype>";
	echo "<option value=lumpsum $allow_field_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_field_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_field_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_field_paytypedaily>Daily</option>";
	echo "<option value=others $allow_field_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end field allowance details

//	start accommodation allowance details
	echo "<tr><td align = 'right'>Accommodation Allowance</td><td><table border=0 spacing=0><tr><td><input name=allow_accomm class ='form-control' placeholder = 'Amount here..' required value=$allow_accomm></td>";
	if ($allow_accomm_currency == 'usd')
	{
	  $allow_accomm_currencyusd = 'selected';
	}
	elseif ($allow_accomm_currency == 'php')
	{
	  $allow_accomm_currencyphp = 'selected';
	}
	else
	{
	  $allow_accomm_currencyothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_accomm_currency>";
	echo "<option value=php $allow_accomm_currencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $allow_accomm_currencyusd>US Dollars (USD)</option>";
	echo "<option value=others $allow_accomm_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_accomm_paytype == 'lumpsum')
	{
	  $allow_accomm_paytypelumpsum = 'selected';
	}
	else if ($allow_accomm_paytype == 'monthly')
	{
	  $allow_accomm_paytypemonthly = 'selected';
	}
	else if ($allow_accomm_paytype == 'weekly')
	{
	  $allow_accomm_paytypeweekly = 'selected';
	}
	else if ($allow_accomm_paytype == 'daily')
	{
	  $allow_accomm_paytypedaily = 'selected';
	}
	else
	{
	  $allow_accomm_paytypeothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_accomm_paytype>";
	echo "<option value=lumpsum $allow_accomm_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_accomm_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_accomm_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_accomm_paytypedaily>Daily</option>";
	echo "<option value=others $allow_accomm_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end accommodation allowance details

//	start transportation allowance details
	echo "<tr><td align = 'right'>Transportation Allowance</td><td><table border=0 spacing=0><tr><td><input name=allow_transpo class ='form-control' placeholder = 'Amount here..' required value=$allow_transpo></td>";
	if ($allow_transpo_currency == 'usd')
	{
	  $allow_transpo_currencyusd = 'selected';
	}
	elseif ($allow_transpo_currency == 'php')
	{
	  $allow_transpo_currencyphp = 'selected';
	}
	else
	{
	  $allow_transpo_currencyothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_transpo_currency>";
	echo "<option value=php $allow_transpo_currencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $allow_transpo_currencyusd>US Dollars (USD)</option>";
	echo "<option value=others $allow_transpo_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_transpo_paytype == 'lumpsum')
	{
	  $allow_transpo_paytypelumpsum = 'selected';
	}
	else if ($allow_transpo_paytype == 'monthly')
	{
	  $allow_transpo_paytypemonthly = 'selected';
	}
	else if ($allow_transpo_paytype == 'weekly')
	{
	  $allow_transpo_paytypeweekly = 'selected';
	}
	else if ($allow_transpo_paytype == 'daily')
	{
	  $allow_transpo_paytypedaily = 'selected';
	}
	else
	{
	  $allow_transpo_paytypeothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=allow_transpo_paytype>";
	echo "<option value=lumpsum $allow_transpo_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_transpo_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_transpo_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_transpo_paytypedaily>Daily</option>";
	echo "<option value=others $allow_transpo_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end transportation allowance details

//	start perdiem details
	echo "<tr><td align = 'right'>Per diem</td><td><i>Temporary Value</i><br><input name=perdiem class ='form-control' placeholder = 'Amount here..' required value=\"$perdiem\"><br><table border=0 spacing=0><tr><td><input class ='form-control' placeholder = 'Amount here..' required name=perdiem_fin value=$perdiem_fin></td>";
	if ($perdiem_currency == 'usd')
	{
	  $perdiem_currencyusd = 'selected';
	}
	elseif ($perdiem_currency == 'php')
	{
	  $perdiem_currencyphp = 'selected';
	}
	else
	{
	  $perdiem_currencyothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=perdiem_currency>";
	echo "<option value=php $perdiem_currencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $perdiem_currencyusd>US Dollars (USD)</option>";
	echo "<option value=others $perdiem_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end perdiem details

//	start ecola1
	echo "<tr><td align = 'right'>ECOLA 1</td><td><table border=0 spacing=0><tr><td><input class ='form-control' placeholder = 'Amount here..' required name=ecola1 value=\"$ecola1\"></td>";
	if ($ecola1_currency == 'usd')
	{
	  $ecola1_currencyusd = 'selected';
	}
	elseif ($ecola1_currency == 'php')
	{
	  $ecola1_currencyphp = 'selected';
	}
	else
	{
	  $ecola1_currencyothers = 'selected';
	}
	echo "<td><select  class = 'GlobalSelect' name=ecola1_currency>";
	echo "<option value=php $ecola1_currencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $ecola1_currencyusd>US Dollars (USD)</option>";
	echo "<option value=others $ecola1_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end ecola1

//	start ecola2
	echo "<tr><td align = 'right'>ECOLA 2</td><td><table border=0 spacing=0><tr><td><input class ='form-control' placeholder = 'Amount here..' required name=ecola2 value=\"$ecola2\"></td>";
	if ($ecola2_currency == 'usd')
	{
	  $ecola2_currencyusd = 'selected';
	}
	elseif ($ecola2_currency == 'php')
	{
	  $ecola2_currencyphp = 'selected';
	}
	else
	{
	  $ecola2_currencyothers = 'selected';
	}
	echo "<td><select class = 'GlobalSelect'  name=ecola2_currency>";
	echo "<option value=php $ecola2_currencyphp>Pesos (PHP)</option>";
	echo "<option value=usd $ecola2_currencyusd>US Dollars (USD)</option>";
	echo "<option value=others $ecola2_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end ecola2

	echo "<tr><td align = 'right'>Duration 1</td><td> <div class = 'row'>";
	echo "<div class = 'col'><i>From:</i><input name=durationfrom type = 'date' class = 'form-control' value=\"$durationfrom\"> </div><div class = 'col'><i>To:</i><input type = 'date' class = 'form-control' name=durationto value=\"$durationto\">";
	echo "</div></div></td></tr>";

	echo "<tr><td align = 'right'>Duration 2</td><td> <div class = 'row'>";
	echo "<div class = 'col'><i>From:</i><input name=durationfrom2 type = 'date' class = 'form-control' value=\"$durationfrom2\"> </div><div class = 'col'><i>To:</i><input type = 'date' class = 'form-control' name=durationto2 value=\"$durationto2\">";
	echo "</div></div></td></tr>";

	echo "<tr><td align = 'right'>Total Duration</td><td><i>Temporary value</i><br><input class = 'form-control' placeholder = 'temporary value here...' required name=durationtotal value=\"$durationtotal\"><br>";
	echo "<table border=0 spacing=0><tr><td><input  class = 'form-control' placeholder = 'Final Value here...' required name=durationtotal_fin value=\"$durationtotal_fin\"><br>Final value:</td>";
	echo "<td><input  class = 'form-control' placeholder = 'Property Value here...' required name=durationtotprop value=\"$durationtotprop\"><br>Property:</td></tr></table>";

	echo "<tr><td align = 'right'>Term_Resign</td><td><inputv  class = 'form-control' placeholder = 'Amount here...' required name=term_resign value=\"$term_resign\"></td></tr>";

	echo "<tr><td align = 'right'>Remarks</td><td><textarea rows=3 cols=50 name=remarks>$remarks</textarea></td></tr>";
	echo "<tr><td align = 'right'>Remarks2</td><td><textarea rows=3 cols=50 name=remarks2>$remarks2</textarea></td></tr>";

	echo "<tr><td colspan=2 align=center><input type=submit value=\"Update tmp.Project Assignment\"></td></tr>";
	echo "</form>";

	echo "<form action=personneltmpprojassignupd2.php?loginid=$loginid&eid=$employeeid1&prjid=$projectassign0id method=post>";
	echo "<tr><td colspan=2 align=center><input type=submit value=\"Propagate\"></td></tr>";
	echo "</form>";

     }

	echo "</table>";

// end project assignments

     echo "<p><a href=personneltmpprojassignmng.php?loginid=$loginid>Back to Manage tmp.Project Assignment</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
