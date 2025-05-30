<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';
$employeeorder = (isset($_POST['employeeorder'])) ? $_POST['employeeorder'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> <a href=\"persrptmnu.php?loginid=$loginid\">HR Reports</a> >> Govt Benefits ID Numbers</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=\"17\">Government Benefits ID Numbers</th></tr>";

     echo "<tr><td colspan=\"17\">";

     echo "<form action=persrptbenefits.php?loginid=$loginid method=POST>";
     echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr>";

     echo "<td valign=bottom><font size=1>Choose criteria</font><br>";
     echo "<select name=employeetype>";
     echo "<option value=active-employees selected>Active Employees</option>";
     echo "<option value=active-consultants>Active Consultants</option>";
     echo "<option value=active-employees-consultants>Active Employees & Consultants</option>";
     echo "<option value=inactive-employees>Inactive Employees</option>";
     echo "<option value=inactive-consultants>Inactive Consultants</option>";
     echo "<option value=inactive-employees-consultants>Inactive Employees & Consultants</option>";
     echo "<option>------------------</option>";
     echo "<option value=all-employees>All Employees</option>";
     echo "<option value=all-consultants>All Consultants</option>";
     echo "<option value=all-personnel>ALL</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>Sort by</font><br>";
     echo "<select name=employeeorder>";
     echo "<option value=tblcontact.employeeid>Employee Number</option>";
     echo "<option value=tblcontact.name_last selected>Last Name</option>";
     echo "<option value=tblcontact.name_first>First Name</option>";
     echo "<option value=tblcontact.name_middle>M.I.</option>";
     echo "<option value=tblempdetails.empposition>Position</option>";
     echo "<option value=tblemployee.emp_birthdate>Birthdate</option>";
     echo "<option value=tblemployee.date_hired>Date Hired</option>";
     echo "<option value=tblemployee.emp_tin>BIR-TIN</option>";
     echo "<option value=tblemployee.emp_sss>SSS</option>";
     echo "<option value=tblemployee.emp_philhealth>Philhealth</option>";
     echo "<option value=tblemployee.emp_pagibig>Pag-IBIG</option>";
     echo "<option value=tblemployee.emp_gsis>GSIS</option>";
     echo "</select></td>";

     echo "<td valign=bottom><input type=submit value=Go></td>";
     echo "</tr></table>";
     echo "</form>";

     echo "</td></tr>";

     if($employeetype == 'active-employees') {
          $resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
     } else if($employeetype == 'inactive-employees') {
          $resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
     } else if($employeetype == 'all-employees') {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' ORDER BY $employeeorder";
     } else if($employeetype == 'active-consultants') {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
     } else if($employeetype == 'inactive-consultants') {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
     } else if($employeetype == 'all-consultants') {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' ORDER BY $employeeorder";
     } else if($employeetype == 'all-personnel') {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' ORDER BY $employeeorder";
     } else if($employeetype == 'active-employees-consultants') {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
     } else if($employeetype == 'inactive-employees-consultants') {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblempdetails.empposition, tblempdetails.emppositionlevel, tblempdetails.empsalarygrade, tblemployee.emp_birthdate, tblemployee.date_hired, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid = tblempdetails.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
     }

     echo "<tr><tr colspan=\"17\">Displaying list: <b>$employeetype</b> in <b>$employeeorder</b> order</td></tr>";
     echo "<tr><th>Count</th><th>EmpNum</th><th>LastName</th><th>FirstName</th><th>Middle</th><th>Position</th><th>Level</th><th>Salary Grade</th><th>Birthdate</th><th>Date Hired</th><th>BIR-TIN</th><th>SSS</th><th>Philhealth</th><th>Pag-IBIG</th><th>Pag-IBIG2</th><th>GSIS</th><th>Action</th></tr>";

     $count = 0;

	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
	$count = $count + 1;
	$pid = $myrow['employeeid'];
	$employeeid = $pid;

	$name_first = $myrow['name_first'];
	$name_last = $myrow['name_last'];
	$name_middle = $myrow['name_middle'];

	$empposition = $myrow['empposition'];
	$emppositionlevel = $myrow['emppositionlevel'];
	$empsalarygrade = $myrow['empsalarygrade'];

	$emp_birthdate = $myrow['emp_birthdate'];
	$date_hired = $myrow['date_hired'];
	$emp_tin = $myrow['emp_tin'];
	$emp_sss = $myrow['emp_sss'];
	$emp_philhealth = $myrow['emp_philhealth'];
	$emp_pagibig = $myrow['emp_pagibig'];
	$emp_pagibig2 = $myrow['emp_pagibig2'];
	$emp_gsis = $myrow['emp_gsis'];

	echo "<tr><td>$count</td><td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\">$employeeid</a></td>";
	echo "<td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\"><b>$name_last</b></a></td><td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\"><b>$name_first</b></a></td><td><a href=\"personnelmoreinfo.php?pid=$pid&loginid=$loginid\" target=\"_blank\">$name_middle</a></td>";
	echo "<td>$empposition</td><td>$emppositionlevel</td><td>$empsalarygrade</td>";
	echo "<td>$emp_birthdate</td><td>$date_hired</td><td>$emp_tin</td><td>$emp_sss</td><td>$emp_philhealth</td><td>$emp_pagibig</td><td>$emp_pagibig2</td><td>$emp_gsis</td>";
	echo "<td><a href = personnelmoreinfo.php?pid=$pid&loginid=$loginid target=_blank>More</a></td></tr>";
		
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

     echo "</table>"; 
   
     echo "<p><a href=persrptmnu.php?loginid=$loginid>Back to HR Reports Menu</a><br>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery); 

     include ("footer.php");

} else {

     include("logindeny.php");

}

// mysql_close($dbh);
$dbh2->close();
?>
