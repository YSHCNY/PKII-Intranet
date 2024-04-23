<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$supplierid = $_POST['supplierid'];
$suppliername = $_POST['suppliername'];
$suppliersince = $_POST['suppliersince'];
$lastinvoice = $_POST['lastinvoice'];

if($supplierid != "")
{
     $result = mysql_query("INSERT INTO tblinventorysupplier (supplierid, suppliername, suppliersince, lastinvoice, supplier_type) VALUES ('$supplierid', '$suppliername', '$suppliersince', '$lastinvoice', 'current')", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 