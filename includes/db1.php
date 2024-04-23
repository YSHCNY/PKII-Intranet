<?php

require('config.inc');

$dbh = mysql_connect("$hostname", "$dbuser", "$dbuserpass") or die("Connection Error");
mysql_select_db("$dbname", $dbh) or die('DBError - Could not connect: ' . mysql_error());

if(mysql_error() != '')
{
  echo "<font color=red><b>" . mysql_error() . "</b></font><br>";
}

?>
