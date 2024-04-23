<?php
$host = "localhost";
$user = "root";
$pass = "sysad";
$dbname = "maindb";

$connection = mysql_connect("$host", "$user", "$pass") or die("Cannot connect to MySQL server: " . mysql_error());
$db_selected = mysql_select_db('$dbname', $connection);

// $data = mysql_query("LOAD data LOCAL INFILE 'C:\\\Documents and Settings\\\Administrator.PHILKOEI\\\Desktop\\\Synchronizer\\\Projects.txt'
$data = mysql_query("LOAD DATA LOCAL INFILE '/home/sysad/Projects.txt'
INTO TABLE maindb.tblproject1
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
(proj_num, proj_code, proj_fname, proj_sname, proj_services, proj_period, proj_duty)")
or die(mysql_error());

?> 
