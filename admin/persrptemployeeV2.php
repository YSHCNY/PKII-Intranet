<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$employeetype = $_POST['employeetype'];
$employeeorder = $_POST['employeeorder'];
$employmentstatus = $_POST['employmentstatus'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> HR Reports >> List of Employees</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=12><font color=white><b>List of Employees</b></font></td></tr>";

     echo "<tr><td colspan=12>";

     echo "<form action=persrptemployee.php?loginid=$loginid method=POST>";
     echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr>";

     echo "<td valign=bottom><font size=1>Choose criteria</font><br>";
     echo "<select name=employeetype>";
     echo "<option value=active-employees selected>Active Employees</option>";
     echo "<option value=inactive-employees>Inactive Employees</option>";
     echo "<option value=all-employees>All Employees</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>Sort by</font><br>";
     echo "<select name=employeeorder>";
     echo "<option value=tblcontact.employeeid>Employee Number</option>";
     echo "<option value=tblcontact.name_last selected>Last Name</option>";
     echo "<option value=tblcontact.name_first>First Name</option>";
     echo "<option value=tblemployee.emp_birthdate>Birthdate</option>";
     echo "<option value=tblemployee.date_hired>DateHired</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>Status</font><br>";
     echo "<select name=employmentstatus>";
     echo "<option value=\"R\" selected>Regular</option>";
     echo "<option value=\"P\">Probationary</option>";
     echo "<option value=\"T\">Temporary</option>";
     echo "<option value=\"P+T\">Probationary+Temporary</option>";
     echo "<option>undefined</option>";
     echo "<option value=\"all\">All</option>";

     echo "<td valign=bottom><input type=submit value=Go></td>";
     echo "</tr></table>";
     echo "</form>";

     echo "</td></tr>";

// echo "vartest employmentstatus:$employmentstatus<br>";

    if ($employmentstatus == 'undefined')
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != 'T' AND tblemployee.emp_status != 'P' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != 'T' AND tblemployee.emp_status != 'P' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != 'T' AND tblemployee.emp_status != 'P' ORDER BY $employeeorder", $dbh);
     }
    }
    else if ($employmentstatus == 'P+T')
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
    }
    else if ($employmentstatus == 'all')
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' ORDER BY $employeeorder", $dbh);
     }
    }
    else
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status = '$employmentstatus' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' AND tblemployee.emp_status = '$employmentstatus' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_status = '$employmentstatus' ORDER BY $employeeorder", $dbh);
     }
    }

     echo "<tr><td colspan=12>Displaying list: <b>$employeetype</b> in <b>$employeeorder</b>, order by <b>$employmentstatus</b></td></tr>";
     echo "<tr bgcolor=yellow><td>Count</td><td>EmpNum</td><td>LastName</td><td>FirstName</td><td>MI</td><td>Gender</td><td>Address</td><td>Birthdate</td><td>Position</td><td>Level</td><td>Salary Grade</td><td>Date Hired</td><td>Date Resigned</td><td>Status</td>";
     echo "<td colspan=\"23\">";
     echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
     echo "<tr><td colspan=\"23\" align=\"center\">Project Assignment Details</td></tr>";
//     echo "<tr><td width=\"6%\">RefNum</td><td width=\"6%\">Project</td><td width=\"8%\">Position</td><td width=\"4%\">Salary</td><td width=\"4%\">Currency-Type</td><td width=\"4%\">Incentives Allowance</td><td width=\"4%\">Currency-Type</td><td width=\"4%\">Project Allowance</td><td width=\"4%\">Currency-Type</td><td width=\"4%\">ECola1</td><td width=\"4%\">Currency</td><td width=\"4%\">ECola2</td><td width=\"4%\">Currency</td><td width=\"4%\">Field Allowance</td><td width=\"4%\">Currency-Type</td><td width=\"4%\">Accommodation Allowance</td><td width=\"4%\">Currency-Type</td><td width=\"4%\">Transportation Allowance</td><td width=\"4%\">Currency-Type</td><td width=\"4%\">Per diem</td><td width=\"4%\">Currency</td><td width=\"4%\">From</td><td width=\"4%\">To</td>";
     echo "</table>";
//     echo "<td>From2</td><td>To2</td>";
     echo "<td>Action</td></tr>";

     $count = 0;

     while ($myrow = mysql_fetch_row($result))
     {
	$count = $count + 1;
	$pid = $myrow[0];
	$employeeid = $pid;

	$name_first = $myrow[1];
	$name_last = $myrow[2];
	$name_middle = $myrow[3];
	$contact_gender = $myrow[4];
	$contact_address1 = $myrow[5];
	$contact_address2 = $myrow[6];
	$contact_city = $myrow[7];
	$contact_province = $myrow[8];
	$contact_zipcode = $myrow[9];
	$contact_country = $myrow[10];

	$empposition = $myrow[11];
	$emppositionlevel = $myrow[12];
	$empsalarygrade = $myrow[13];

	$emp_birthdate = $myrow[14];
	$date_hired = $myrow[15];
	$emp_status = $myrow[16];
	$term_resign = $myrow[17];

	echo "<tr><td>$count</td><td>$employeeid</td>";
	echo "<td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td><td>$contact_gender</td>";
	echo "<td>$contact_address1";
	if($contact_address2 <> '') { echo ", $contact_address2"; }
	if($contact_city <> '') { echo ", $contact_city"; }
	if($contact_province <> '') { echo ", $contact_province"; }
	if($contact_zipcode <> '') { echo ", $contact_zipcode"; }
	if($contact_country <> '') { echo ", $contact_country"; }
	echo "<td>$emp_birthdate</td>";
	echo "<td>$empposition</td><td>$emppositionlevel</td><td>$empsalarygrade</td><td>$date_hired</td>";
	echo "<td>";
	if($term_resign <> '0000-00-00') { echo "$term_resign"; }
	echo "</td>";
	echo "<td>$emp_status</td>";

	echo "<td colspan=\"23\">";
	  echo "<table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
	  echo "<tr><td bgcolor=\"yellow\" width=\"6%\">RefNum</td><td bgcolor=\"yellow\" width=\"6%\">Project</td><td bgcolor=\"yellow\" width=\"8%\">Position</td><td bgcolor=\"yellow\" width=\"4%\">Salary</td><td bgcolor=\"yellow\" width=\"4%\">Currency-Type</td><td bgcolor=\"yellow\" width=\"4%\">Incentives Allowance</td><td bgcolor=\"yellow\" width=\"4%\">Currency-Type</td><td bgcolor=\"yellow\" width=\"4%\">Project Allowance</td><td bgcolor=\"yellow\" width=\"4%\">Currency-Type</td><td bgcolor=\"yellow\" width=\"4%\">ECola1</td><td bgcolor=\"yellow\" width=\"4%\">Currency</td><td bgcolor=\"yellow\" width=\"4%\">ECola2</td><td bgcolor=\"yellow\" width=\"4%\">Currency</td><td bgcolor=\"yellow\" width=\"4%\">Field Allowance</td><td bgcolor=\"yellow\" width=\"4%\">Currency-Type</td><td bgcolor=\"yellow\" width=\"4%\">Accommodation Allowance</td><td bgcolor=\"yellow\" width=\"4%\">Currency-Type</td><td bgcolor=\"yellow\" width=\"4%\">Transportation Allowance</td><td bgcolor=\"yellow\" width=\"4%\">Currency-Type</td><td bgcolor=\"yellow\" width=\"4%\">Per diem</td><td bgcolor=\"yellow\" width=\"4%\">Currency</td><td bgcolor=\"yellow\" width=\"4%\">From</td><td bgcolor=\"yellow\" width=\"4%\">To</td>";
	  echo "</td></tr>";
	$found2 = 0;

	$result2 = mysql_query ("SELECT DISTINCT employeeid, projdate, ref_no, proj_name, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationtotal, durationtotprop, durationfrom2, durationto2, duration2total, duration2totprop FROM tblprojassign WHERE employeeid = '$pid' ORDER BY durationfrom DESC, durationto DESC", $dbh);

	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $employeeid = $myrow2[0];
	  $projdate = $myrow2[1];
	  $ref_no = $myrow2[2];
	  $proj_name = $myrow2[3];
	  $position = $myrow2[4];
	  $salary = $myrow2[5];
	  $salarycurrency = $myrow2[6];
	  $salarytype = $myrow2[7];
	  $allow_inc = $myrow2[8];
	  $allow_inc_currency = $myrow2[9];
	  $allow_inc_paytype = $myrow2[10];
	  $allow_proj = $myrow2[11];
	  $allow_proj_currency = $myrow2[12];
	  $allow_proj_paytype = $myrow2[13];
	  $ecola1 = $myrow2[14];
	  $ecola1_currency = $myrow2[15];
	  $ecola2 = $myrow2[16];
	  $ecola2_currency = $myrow2[17];
	  $allow_field_currency = $myrow2[18];
	  $allow_field_paytype = $myrow2[19];
	  $allow_field = $myrow2[20];
	  $allow_accomm = $myrow2[21];
	  $allow_accomm_currency = $myrow2[22];
	  $allow_accomm_paytype = $myrow2[23];
	  $allow_transpo = $myrow2[24];
	  $allow_transpo_currency = $myrow2[25];
	  $allow_transpo_paytype = $myrow2[26];
	  $perdiem = $myrow2[27];
	  $perdiem_currency = $myrow2[28];
	  $durationfrom = $myrow2[29];
	  $durationto = $myrow2[30];
	  $durationtotal = $myrow2[31];
	  $durationtotprop = $myrow2[32];
	  $durationfrom2 = $myrow2[33];
	  $durationto2 = $myrow2[34];
	  $duration2total = $myrow2[35];
	  $duration2totprop = $myrow2[36];

	  // display latest proj assign details
	  if ($found2 == 1)
	  {
	    echo "<tr><td width=\"6%\">$ref_no</td><td width=\"6%\">$proj_name</td><td width=\"8%\">$position</td><td  width=\"4%\" align=\"right\">$salary</td><td width=\"4%\">$salarycurrency $salarytype</td><td  width=\"4%\" align=\"right\">$allow_inc</td><td width=\"4%\">$allow_inc_currency $allow_inc_paytype</td><td  width=\"4%\" align=\"right\">$allow_proj</td><td width=\"4%\">$allow_proj_currency $allow_proj_paytype</td><td  width=\"4%\" align=\"right\">$ecola1</td><td width=\"4%\">$ecola1_currency</td><td  width=\"4%\" align=\"right\">$ecola2</td><td width=\"4%\">$ecola2_currency</td><td  width=\"4%\" align=\"right\">$allow_field</td><td width=\"4%\">$allow_field_currency $allow_field_paytype</td><td  width=\"4%\" align=\"right\">$allow_accomm</td><td width=\"4%\">$allow_accomm_currency $allow_accomm_paytype</td><td  width=\"4%\" align=\"right\">$allow_transpo</td><td width=\"4%\">$allow_transpo_currency $allow_transpo_paytype</td><td  width=\"4%\" align=\"right\">$perdiem</td><td width=\"4%\">$perdiem_currency</td><td width=\"4%\">$durationfrom</td><td width=\"4%\">$durationto</td>";
//	    echo "<td>$durationfrom2</td><td>$durationto2</td>";
	  }
	  else
	  {
	    echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	  }
	}

	  echo "</tr></table>";
	echo "</td>";

	echo "<td><a href = personnelmoreinfo.php?pid=$pid&loginid=$loginid target=_blank>More</a></td></tr>";

     }

     echo "</table>"; 
   
     echo "<p><a href=persrptmnu.php?loginid=$loginid>Back to HR Reports Menu</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
