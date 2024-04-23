<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$allow_proj_cons = $_POST['allow_proj_cons'];
$field_allow = $_POST['field_allow'];
$perdiem = $_POST['perdiem'];
$remarks = $_POST['remarks'];

if($employeeid != "")
{
//     $result = mysql_query("INSERT INTO tblempsalary (employeeid, allow_proj_cons, field_allow, perdiem, remarks, term_resign) VALUES ('$employeeid', $allow_proj_cons, $field_allow, '$perdiem', '$remarks', '$term_resign')", $dbh);
     $result = mysql_query("INSERT INTO tblempsalary (employeeid, allow_proj_cons, perdiem, remarks) VALUES ('$employeeid', $allow_proj_cons, '$perdiem', '$remarks')", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 
