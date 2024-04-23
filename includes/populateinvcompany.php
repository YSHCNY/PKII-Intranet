<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$supplierid = $_POST['supplierid'];
$company = $_POST['company'];
$ofc_address1 = $_POST['ofc_address1'];
$ofc_address2 = $_POST['ofc_address2'];
$ofc_city = $_POST['ofc_city'];
$ofc_num1 = $_POST['ofc_num1'];
$ofc_num2 = $_POST['ofc_num2'];
$ofc_num3 = $_POST['ofc_num3'];
$ofc_fax = $_POST['ofc_fax'];
$ofc_fax2 = $_POST['ofc_fax2'];

if($supplierid != "")
{
	$result = mysql_query("INSERT INTO tblcompany (company, ofc_address1, ofc_address2, ofc_city, ofc_num1, ofc_num2, ofc_num3, ofc_fax, ofc_fax2, company_type, supplierid) VALUES ('$company', '$ofc_address1', '$ofc_address2', '$ofc_city', '$ofc_num1', '$ofc_num2', '$ofc_num3', '$ofc_fax', '$ofc_fax2', 'supplier', '$supplierid')", $dbh); 
}

// $result = mysql_query("INSERT INTO tblcompany (company, ofc_address1, ofc_address2, ofc_city, ofc_num1, ofc_num2, ofc_num3, ofc_fax, ofc_fax2, company_type, supplierid) VALUES ('ABC Strategic Solutions., Inc', 'G/F Parksquare 1 Ayala Center Makati City', 'Office Address 2 here', 'City here', '752-7559', 'Landline2', 'Landline3', '752-7559', 'Fax2', 'supplier', 'ABC 167')", $dbh);

 
$id = mysql_insert_id();

echo "$id";

mysql_close($dbh);
?> 