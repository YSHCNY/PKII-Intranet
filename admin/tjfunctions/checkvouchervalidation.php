<?php 
include("../db1.php");

$cvnumber = $_POST['cvnumber'];
$resquery = "SELECT * from tblfindisbursement WHERE disbursementnumber='".$cvnumber."'";
$result = $dbh2->query($resquery);
if($result->num_rows > 0){
	echo '1';
}
else {
	echo '0';
}

?>