<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$sql = "DELETE FROM tblcontact WHERE contact_type='supplier'";

$result = mysql_query($sql, $dbh); 

$sql = "DELETE FROM tblcompany WHERE company_type='supplier'";

$result = mysql_query($sql, $dbh); 

echo "ok";

mysql_close($dbh);
?> 