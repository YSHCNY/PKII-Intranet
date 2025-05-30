<?php 
$action = $_POST['id'];

include("../../admin/db1.php");
$resquery="UPDATE tblhrtalvreq SET statusta = 2 WHERE idhrtalvreq = ".$action"";
$result=$dbh2->query($resquery);
// mysql_close($dbh);
$dbh2->close();

// include("../../admin/db1.php");
// $result = mysql_query("UPDATE tblhrtaotreq SET statusta = 2 WHERE idhrtaotreq = ".$action, $dbh);
// mysql_close($dbh);

?>
