<?php

$hostname	= "localhost";
$dbname		= "nikka";
$dbusername	= "root";
$dbuserpass	= "sysad";

$connection = mysql_connect("$hostname", "$dbusername", "$dbuserpass") or die("Cannot connect to MySQL server: " . mysql_error());
$db_selected = mysql_select_db('$dbname', $connection);

$data = mysql_query("LOAD DATA LOCAL INFILE '/home/brian/Downloads/depedcarmen24V2.01.csv'

INTO TABLE nikka.projlocation
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
(projectid, item, schoolid, schoolname, barangay, municipality, legdistid, divisionname, region, drmech, drbasic, pl)")
or die(mysql_error());

?> 
