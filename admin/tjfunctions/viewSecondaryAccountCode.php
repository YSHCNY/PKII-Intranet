

<?php 
include("../db1.php");

$id = $_POST['id'];
$resquery = "SELECT * from tblfinprojinsecondary WHERE projinsecondary_id=".$id;
$result = $dbh2->query($resquery);
$row1 = '';
$row2 = '';
$row3 = '';
$row4 = '';


while($myrow = $result->fetch_assoc()) {
	$row1 = $myrow['fk_projinprimary_id'];
	$row2 = $myrow['acctcode_from'];
	$row3 = $myrow['acctcode_to'];
	$row4 = $myrow['secondary_account_name'];
} 


$returnArray = array(
	'1'  => $row1,
	'2'  => $row2,
	'3'  => $row3,
	'4'  => $row4,
);

echo  json_encode($returnArray);


?>