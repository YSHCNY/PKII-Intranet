<?php 
$action = $_POST['id'];

include("../db1.php");
$result = mysql_query("UPDATE tblhrtalvreq SET statusta = 3 WHERE idhrtaotreq = ".$action, $dbh);
mysql_close($dbh);

?>