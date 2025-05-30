<?php 
include("../db1.php");

$id = $_POST['id'];
$resquery = "SELECT * FROM tblcompany WHERE company_type = 'supplier' AND companyid=".$id;
$result = $dbh2->query($resquery);
$row1 = '';
$row2 = '';
$row3 = '';
$row4 = '';
$row5 = '';
$row6 = '';
$row7 = '';
$row8 = '';

while($myrow = $result->fetch_assoc()) {
	$row1 = $myrow['company'];
	$row2 = $myrow['ofc_address1'];
	$row3 = $myrow['ofc_address2'];
	$row4 = $myrow['ofc_city'];
	$row5 = $myrow['personnel'];
	$row6 = $myrow['ofc_num1'];
	$row7 = $myrow['ofc_fax'];
	$row8 = $myrow['tin_number'];


} 

$returnArray = array(
	'1'  => $row1,
	'2'  => $row2,
	'3'  => $row3,
	'4'  => $row4,
	'5'  => $row5,
	'6'  => $row6,
	'7'  => $row7,
	'8'  => $row8,
);

echo  json_encode($returnArray);


?>
