<?php 
$id = $_POST['id'];
include("../db1.php");


	$result = mysql_query("UPDATE tblinventoryrequest SET request_status = 'Cancelled' WHERE request_id = ".$id, $dbh);



mysql_close($dbh);



?>