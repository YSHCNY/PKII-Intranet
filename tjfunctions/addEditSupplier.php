<?php 
$actionId = $_POST['actionId'];
$company = $_POST['company'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$personnel = $_POST['personnel'];
$fax = $_POST['fax'];
$tin = $_POST['tin'];


include("../db1.php");
if($actionId == 0){
$result = mysql_query("INSERT INTO tblcompany SET company=\"$company\",ofc_address1=\"$address1\",ofc_address2=\"$address2\", ofc_city=\"$city\", personnel=\"$personnel\", ofc_num1=\"$contact\", tin_number=\"$tin\", ofc_fax=\"$fax\"", $dbh);
}
else{
$result = mysql_query("UPDATE tblcompany SET company=\"$company\",ofc_address1=\"$address1\",ofc_address2=\"$address2\", ofc_city=\"$city\", personnel=\"$personnel\", ofc_num1=\"$contact\", tin_number=\"$tin\", ofc_fax=\"$fax\" WHERE companyid=".$actionId, $dbh);
}
	
mysql_close($dbh);



?>