<?php 
$inventory = $_POST['inventory'];
$comment = $_POST['comment'];
$date = date('Y-m-d H:i:s');
$quantity = $_POST['quantity'];
$username = $_POST['actionId'];
$requesttype = $_POST['requesttype'];
$newid = $_POST['newid'];

include("../db1.php");
$inventoryid = 0;
if($requesttype == '0' || $requesttype == 0){
	$inventoryid = 6;
}
else{
	$resquery = "SELECT * from tblinventory WHERE inventory_code='".$inventory."'";
	$result = $dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow = $result->fetch_assoc()) {
			$inventoryid = $myrow['inventory_id'];
			$requesttype = $myrow['inventory_type'];
		} 
	} 
}




	$result = mysql_query("INSERT INTO tblinventoryrequest SET fk_inventory_id=\"$inventoryid\",request_comment=\"$comment\",request_type=\"$requesttype\",requested_by=\"$username\", request_date=\"$date\", request_quantity=\"$quantity\", request_status='Pending', approved_by='N/A'", $dbh);
	echo "2";



mysql_close($dbh);



?>