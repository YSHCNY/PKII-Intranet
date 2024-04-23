<?php

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$groupname = $_POST['groupname'];
$filename = $_POST['uploaded'];

$data = mysql_query("LOAD DATA LOCAL INFILE '/var/www/pkii/admin/transfers/*.csv'

INTO TABLE maindb.tblemppaybonus
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
(groupname, employeeid, grossamt, taxpercent, taxdeduct, otherdeduct, netamt)")
or die(mysql_error());

?> 
