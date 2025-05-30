<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$email1 = $_POST['email1'];
$name_last = $_POST['name_last'];
$name_first = $_POST['name_first'];
$name_middle = $_POST['name_middle'];
$contact_address1 = $_POST['contact_address1'];
$num_res1 = $_POST['num_res1'];
$num_mobile1 = $_POST['num_mobile1'];

$result = mysql_query("INSERT INTO tblcontact (employeeid, email1, name_last, name_first, name_middle, contact_address1, num_res1, num_mobile1) VALUES ('$employeeid', '$email1', '$name_last', '$name_first', '$name_middle', '$contact_address1', '$num_res1', '$num_mobile1')", $dbh); 

$id = mysql_insert_id();

echo "$id";

mysql_close($dbh);
?> 