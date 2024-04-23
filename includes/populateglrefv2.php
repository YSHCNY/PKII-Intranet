<?php

$hostname	= "localhost";
$dbname		= "maindb";
$dbusername	= " ";
$dbuserpass	= " ";

$connection = mysql_connect("$hostname", "$dbusername", "$dbuserpass") or die("Cannot connect to MySQL server: " . mysql_error());
$db_selected = mysql_select_db('$dbname', $connection);

$data = mysql_query("LOAD DATA LOCAL INFILE '/home/brfuertes/Downloads/glrefv2.csv'

INTO TABLE maindb.tblfinglref
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
(glcode, glname, version)")
or die(mysql_error());

?> 
