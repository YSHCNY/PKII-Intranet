<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$emp_num = $_POST['emp_num'];
$date = $_POST['date'];
$emp_ref_num = $_POST['emp_ref_num'];
$employeeid = $_POST['employeeid'];

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

$result = mysql_query("INSERT INTO tblemployee (emp_num, emp_ref_num, employeeid, employee_type) VALUES ($emp_num, '$emp_ref_num', '$employeeid', '$employee_type')", $dbh); 

echo "ok";

mysql_close($dbh);
?> 