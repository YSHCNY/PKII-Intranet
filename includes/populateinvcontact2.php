<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$supplierid = $_POST['supplierid'];
$name_first = $_POST['name_first'];

if($supplierid != "")
{
	$result = mysql_query("INSERT INTO tblcontact (name_first, contact_type, supplierid) VALUES ('$name_first', 'supplier', '$supplierid')", $dbh); 
}

$id = mysql_insert_id();

echo "$id";

mysql_close($dbh);
?> 