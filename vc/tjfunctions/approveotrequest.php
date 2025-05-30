<?php 
$action = $_POST['id'];

include("../../admin/db1.php");
$resquery="UPDATE tblhrtaotreq SET statusta = 1 WHERE idhrtaotreq = ".$action;
$result=$dbh2->query($resquery);
$dbh2->close();

?>
