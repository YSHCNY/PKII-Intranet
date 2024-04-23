

<?php 
include("../db1.php");

$id = $_POST['id'];
$resquery = "SELECT * from tblfinprojinprimary WHERE projinprim_id=".$id;
$result = $dbh2->query($resquery);
$row1 = '';
$row2 = '';


while($myrow = $result->fetch_assoc()) {
	$row1 = $myrow['account_code'];
	$row2 = $myrow['account_name'];
} 


$returnArray = array(
	'1'  => $row1,
	'2'  => $row2,
);

echo  json_encode($returnArray);


?>