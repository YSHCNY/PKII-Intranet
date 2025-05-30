<?php 
$action = $_POST['id'];

include("../db1.php");


		$result = mysql_query("UPDATE tblfinprojinprimary SET status = '0' WHERE projinprim_id = ".$action, $dbh);

mysql_close($dbh);



?>