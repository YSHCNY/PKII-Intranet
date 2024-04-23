<?php

$hostname	= "localhost";
$dbname		= "maindb";
$dbusername	= "root";
$dbuserpass	= "sysad";

$connection = mysql_connect("$hostname", "$dbusername", "$dbuserpass") or die("Cannot connect to MySQL server: " . mysql_error());
$db_selected = mysql_select_db('$dbname', $connection);

$data = mysql_query("LOAD DATA LOCAL INFILE '/home/brfuertes/Downloads/tblprojcdref.csv'

INTO TABLE maindb.tblprojcdref
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(projnum1, projcode0, projcode1, projfname1, projsname1, projsvcs1, projperiod1, projduty1)")
or die(mysql_error());

?> 
