<?php 
$action = $_POST['id'];

include("../../admin/db1.php");
$resquery="UPDATE tblhrtaotreq SET statusta = 2 WHERE idhrtaotreq = ".$action;
$result=$dbh2->query($resquery);
$dbh2->close();
// include("../../admin/db1.php");
// $result = mysql_query("UPDATE tblhrtaotreq SET statusta = 2 WHERE idhrtaotreq = ".$action, $dbh);
// mysql_close($dbh);

?>
