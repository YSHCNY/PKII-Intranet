<?php 
$name = $_POST['inventory'];
$code = $_POST['code'];
$classification = $_POST['classification'];
$holder = $_POST['holder'];
$date = date('Y-m-d',strtotime($_POST['date']));
$restock = $_POST['restock'];
$quantity = $_POST['quantity'];
$inventorytype = $_POST['inventorytype'];

include("../db1.php");

$singleResult = mysql_query("SELECT inventory_code FROM tblinventory WHERE inventory_code='".$code."' LIMIT 1");
$row = mysql_fetch_assoc($singleResult);
if($row)
{
	echo "1";
}
else
{
	$result = mysql_query("INSERT INTO tblinventory SET inventory_name=\"$name\",inventory_logged=\"$date\", inventory_code=\"$code\", inventory_class=\"$classification\", inventory_holder=\"$holder\", inventory_restock=\"$restock\", inventory_type=\"$inventorytype\", inventory_balance=\"$quantity\"", $dbh);
	echo "2";

}


mysql_close($dbh);



?>