<?php 
$action = $_POST['id'];
$message = $_POST['message'];

include("../../admin/db1.php");
$result = mysql_query("UPDATE tblhrtaotreq SET comments = '".$message."' WHERE idhrtaotreq = ".$action, $dbh);
mysql_close($dbh);

// include("../../admin/db1.php");
// $result = mysql_query("UPDATE tblhrtaotreq SET comments = '".$message."' WHERE idhrtaotreq = ".$action, $dbh);
// mysql_close($dbh);


?>