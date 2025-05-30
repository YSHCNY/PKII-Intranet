<?php 
include("../db1.php");
$resquery = "SELECT * from tblfindisbursementtot ORDER BY disbursementtotid DESC LIMIT 1";
$result = $dbh2->query($resquery);
$disbursementnumber = 0;
while($myrow = $result->fetch_assoc()) {
	$disbursementnumber = $myrow['disbursementnumber'];
} 

$incrementeddisbursementnumber = $disbursementnumber + 1;

echo $incrementeddisbursementnumber;


?>