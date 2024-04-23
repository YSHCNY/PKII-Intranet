<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$allow_proj = $_POST['allow_proj'];
$allow_inc = $_POST['allow_inc'];
$ecola1 = $_POST['ecola1'];
$field_allow = $_POST['field_allow'];
$perdiem = $_POST['perdiem'];
$remarks1 = $_POST['remarks1'];
$remarks = $_POST['remarks'];

if($employeeid != "")
{
//     $result = mysql_query("INSERT INTO tblempsalary (employeeid, allow_proj, allow_inc, ecola1, field_allow, perdiem, remarks1, remarks, term_resign) VALUES ('$employeeid', '$allow_proj', $allow_inc, $ecola1, $field_allow, '$perdiem', '$remarks1', '$remarks', '$term_resign')", $dbh);
     $result = mysql_query("INSERT INTO tblempsalary (employeeid, allow_proj, allow_inc, perdiem, remarks1, remarks) VALUES ('$employeeid', '$allow_proj', $allow_inc, '$perdiem', '$remarks1', '$remarks')", $dbh);
}

echo "ok";

mysql_close($dbh);
?> 
