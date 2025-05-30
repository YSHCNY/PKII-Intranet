<?php 
$id = $_POST['restockId'];
$quantity = $_POST['quantity'];
include("../db1.php");
$result = mysql_query("UPDATE tblinventory SET inventory_balance = ".$quantity." WHERE inventory_id = ".$id, $dbh);
mysql_close($dbh);

?>