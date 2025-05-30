<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$employeetype = $_POST['employeetype'];
$employeeorder = $_POST['employeeorder'];
$employmentstatus = $_POST['employmentstatus'];

if($employeetype == "active-employees") { $activeempsel="selected"; $inactiveempsel=""; $allempsel=""; }
else if ($employeetype == "inactive-employees") { $activeempsel=""; $inactiveempsel="selected"; $allempsel=""; }
else if ($employeetype == "all-employees") { $activeempsel=""; $inactiveempsel=""; $allempsel="selected"; }
else { $activeempsel="selected"; $inactiveempsel=""; $allempsel=""; }

if($employeeorder == "tblcontact.employeeid") { $employeeidsel="selected"; $name_lastsel=""; $name_firstsel=""; $emp_birthdatesel=""; $date_hiredsel=""; }
else if($employeeorder == "tblcontact.name_last") { $employeeidsel=""; $name_lastsel="selected"; $name_firstsel=""; $emp_birthdatesel=""; $date_hiredsel=""; }
else if($employeeorder == "tblcontact.name_first") { $employeeidsel=""; $name_lastsel=""; $name_firstsel="selected"; $emp_birthdatesel=""; $date_hiredsel=""; }
else if($employeeorder == "tblemployee.emp_birthdate") { $employeeidsel=""; $name_lastsel=""; $name_firstsel=""; $emp_birthdatesel="selected"; $date_hiredsel=""; }
else if($employeeorder == "tblemployee.date_hired") { $employeeidsel=""; $name_lastsel=""; $name_firstsel=""; $emp_birthdatesel=""; $date_hiredsel="selected"; }
else { $employeeidsel=""; $name_lastsel="selected"; $name_firstsel=""; $emp_birthdatesel=""; $date_hiredsel=""; }

if($employmentstatus == "R") { $empstatr="selected"; $empstatp=""; $empstatt=""; $empstatrp=""; $empstatpt=""; $empstatun=""; $empstatall=""; }
else if($employmentstatus == "P") { $empstatr=""; $empstatp="selected"; $empstatt=""; $empstatrp=""; $empstatpt=""; $empstatun=""; $empstatall=""; }
else if($employmentstatus == "T") { $empstatr=""; $empstatp=""; $empstatt="selected"; $empstatrp=""; $empstatpt=""; $empstatun=""; $empstatall=""; }
else if($employmentstatus == "R+P") { $empstatr=""; $empstatp=""; $empstatt=""; $empstatrp="selected"; $empstatpt=""; $empstatun=""; $empstatall=""; }
else if($employmentstatus == "P+T") { $empstatr=""; $empstatp=""; $empstatt=""; $empstatrp=""; $empstatpt="selected"; $empstatun=""; $empstatall=""; }
else if($employmentstatus == "undefined") { $empstatr=""; $empstatp=""; $empstatt=""; $empstatrp=""; $empstatpt=""; $empstatun="selected"; $empstatall=""; }
else if($employmentstatus == "all") { $empstatr=""; $empstatp=""; $empstatt=""; $empstatrp=""; $empstatpt=""; $empstatun=""; $empstatall="selected"; }
else { $empstatr="selected"; $empstatp=""; $empstatt=""; $empstatrp=""; $empstatpt=""; $empstatun=""; $empstatall=""; }

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> <a href=\"persrptmnu.php?loginid=$loginid\">HR Reports</a> >> List of Employees</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=12><font color=white><b>List of Employees</b></font></td></tr>";

     echo "<tr><td colspan=12>";

     echo "<form action=\"persrptphilhealther2.php?loginid=$loginid\" method=\"POST\">";
     echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr>";

     echo "<td valign=bottom><font size=1>Choose criteria</font><br>";
     echo "<select name=\"employeetype\">";
     echo "<option value=\"active-employees\" $activeempsel>Active Employees</option>";
     echo "<option value=\"inactive-employees\" $inactiveempsel>Inactive Employees</option>";
     echo "<option value=\"all-employees\" $allempsel>All Employees</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>Sort by</font><br>";
     echo "<select name=\"employeeorder\">";
     echo "<option value=\"tblcontact.employeeid\" $employeeidsel>Employee Number</option>";
     echo "<option value=\"tblcontact.name_last\" $name_lastsel>Last Name</option>";
     echo "<option value=\"tblcontact.name_first\" $name_firstsel>First Name</option>";
     echo "<option value=\"tblemployee.emp_birthdate\" $emp_birthdatesel>Birthdate</option>";
     echo "<option value=\"tblemployee.date_hired\" $date_hiredsel>DateHired</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>Status</font><br>";
     echo "<select name=\"employmentstatus\">";
     echo "<option value=\"R\" $empstatr>Regular</option>";
     echo "<option value=\"P\" $empstatp>Probationary</option>";
     echo "<option value=\"T\" $empstatt>Temporary</option>";
     echo "<option value=\"R+P\" $empstatrp>Regular+Probationary</option>";
     echo "<option value=\"P+T\" $empstatpt>Probationary+Temporary</option>";
     echo "<option value=\"undefined\" $empstatun>undefined</option>";
     echo "<option value=\"all\" $empstatall>All</option>";

     echo "<td valign=bottom><input type=submit value=Go></td>";
     echo "</tr></table>";
     echo "</form>";

     echo "</td></tr>";

// echo "vartest employmentstatus:$employmentstatus<br>";

    if ($employmentstatus == 'undefined')
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != 'T' AND tblemployee.emp_status != 'P' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != 'T' AND tblemployee.emp_status != 'P' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != 'T' AND tblemployee.emp_status != 'P' ORDER BY $employeeorder", $dbh);
     }
    }
    else if ($employmentstatus == 'P+T')
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
    }
    else if ($employmentstatus == 'R+P')
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status != 'T' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' AND tblemployee.emp_status != 'T' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_status != 'R' AND tblemployee.emp_status != '' ORDER BY $employeeorder", $dbh);
     }
    }
    else if ($employmentstatus == 'all')
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' ORDER BY $employeeorder", $dbh);
     }
    }
    else
    {
     if($employeetype == 'active-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' AND tblemployee.emp_status = '$employmentstatus' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'inactive-employees')
     {
          $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' AND tblemployee.emp_status = '$employmentstatus' ORDER BY $employeeorder", $dbh);
     }
     else if($employeetype == 'all-employees')
     {
	$result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_status, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_gsis, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_status = '$employmentstatus' ORDER BY $employeeorder", $dbh);
     }
    }

     echo "<tr><td colspan=12>Displaying list: <b>$employeetype</b> in <b>$employeeorder</b>, order by <b>$employmentstatus</b></td></tr>";

     echo "<tr bgcolor=\"yellow\"><td>PHILHEALTH Number</td><td>Name of Employee</td><td>Position</td><td>Salary</td><td>Date of Employment</td><td>Eff Date of Coverage</td><td>Previous Employer</td><td>Action</td></tr>";

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
	$emp_tin = $myrow[17];
	$emp_sss = $myrow[18];
	$emp_philhealth = $myrow[19];
	$emp_pagibig = $myrow[20];
	$emp_gsis = $myrow[21];
	$term_resign = $myrow[22];

	$found2 = 0;

	$result2 = mysql_query ("SELECT employeeid, projdate, ref_no, proj_name, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationtotal, durationtotprop, durationfrom2, durationto2, duration2total, duration2totprop FROM tblprojassign WHERE employeeid = '$pid'  AND salary <> '0' ORDER BY salary ASC", $dbh);

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
	}

	echo "<tr>";

	if($emp_philhealth != "") { echo "<td>$emp_philhealth</td>"; }
	else if($emp_sss != "") { echo "<td>$emp_sss</td>"; }
	else if($emp_gsis != "") { echo "<td>$emp_gsis</td>"; }
	else { echo "<td></td>"; }

	echo "<td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\"><b>$name_last, $name_first</b> $name_middle</a></td>";

	echo "";

// display latest proj assign details
      if ($found2 == 1)
      {
	echo "<td>$position</td><td align=\"right\">$salary</td><td>$date_hired</td><td></td><td></td>";
//	echo "<td>$durationfrom2</td><td>$durationto2</td>";
      }
      else
      {
	echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
      }
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
