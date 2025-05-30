<?php 
include("../db1.php");

$id = $_POST['id'];
$resquery = "SELECT * from tblinventoryrequest WHERE request_id=".$id;
$result = $dbh2->query($resquery);
$row1 = '';
$row2 = '';
$row3 = '';
$row4 = '';
$row5 = '';
$row6 = '';
$row7 = '';
$inventory = '';
$row8 = '';
$row9 = '';


while($myrow = $result->fetch_assoc()) {
	$row1 = $myrow['request_id'];
	$row2 = $myrow['request_status'];
	$row3 = $myrow['request_date'];
	$row4 = $myrow['request_quantity'];
	$row5 = $myrow['approved_by'];
	$row6 = $myrow['request_comment'];
	$row7 = $myrow['request_remarks'];
	$row9 = $myrow['request_type'];
	$row10 = $myrow['request_budget'];

	$inventory = $myrow['fk_inventory_id'];
} 

$resquery1 = "SELECT * from tblinventory WHERE inventory_id=".$inventory;
$result1 = $dbh2->query($resquery1);
while($myrow1 = $result1->fetch_assoc()) {
	$row8 = $myrow1['inventory_code'] . '- ' . $myrow1['inventory_name'];
	if($myrow1['inventory_id'] != 6)
	{
		$row9 = $myrow1['inventory_type'];
	}
} 
$returnArray = array(
	'1'  => $row1,
	'2'  => $row8,
	'3'  => $row2,
	'4'  => $row3,
	'5'  => $row4,
	'6'  => $row5,
	'7'  => $row6,
	'8'  => $row7,
	'9'  => $row9,
	'10'  => $row10

);

echo  json_encode($returnArray);


?>