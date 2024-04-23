<?php 
$id = $_POST['approveId'];
$budget = $_POST['budget'];
$remarks = $_POST['approveRemarks'];
include("../db1.php");
$result = mysql_query("UPDATE tblinventoryrequest SET request_status = 'Approved', request_budget=".$budget." , request_remarks='".$remarks."' WHERE request_id = ".$id, $dbh);
mysql_close($dbh);

?>