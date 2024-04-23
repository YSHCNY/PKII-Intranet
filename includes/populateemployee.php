<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$emp_num = $_POST['emp_num'];
$date = $_POST['date'];
$emp_ref_num = $_POST['emp_ref_num'];
$employeeid = $_POST['employeeid'];
$emp_birthdate = $_POST['emp_birthdate'];
$emp_civilstatus = $_POST['emp_civilstatus'];
$emp_sss = $_POST['emp_sss'];
$emp_tin = $_POST['emp_tin'];
$emp_pagibig = $_POST['emp_pagibig'];
$emp_philhealth = $_POST['emp_philhealth'];
$emp_status = $_POST['emp_status'];
$date_hired = $_POST['date_hired'];
$term_resign = $_POST['term_resign'];

$employee_type = "";

if($employeeid == "")
{
     $employee_type = "others";
}
else
{
     $pos = strpos($employeeid, "C");

     if($pos > -1)
     {
          $employee_type = "consultant";
     }
     else
     {
          $employee_type = "employee";
     }
}

$result = mysql_query("INSERT INTO tblemployee (emp_num, date, emp_ref_num, employeeid, emp_birthdate, emp_civilstatus, emp_sss, emp_tin, emp_pagibig, emp_philhealth, emp_status, date_hired, term_resign, employee_type) VALUES ($emp_num, '$emp_date', '$emp_ref_num', '$employeeid', '$emp_birthdate', '$emp_civilstatus', '$emp_sss', '$emp_tin', '$emp_pagibig', '$emp_philhealth', '$emp_status', '$date_hired', '$term_resign', '$employee_type')", $dbh); 

echo "ok $employeeid $employee_type";

mysql_close($dbh);
?> 
