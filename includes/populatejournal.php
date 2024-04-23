<?php

$hostname	= "localhost";
$dbname		= "db24";
$dbusername	= " ";
$dbuserpass	= " ";

$connection = mysql_connect("$hostname", "$dbusername", "$dbuserpass") or die("Cannot connect to MySQL server: " . mysql_error());
$db_selected = mysql_select_db('$dbname', $connection);

$data = mysql_query("LOAD DATA LOCAL INFILE '/home/brian/Downloads/journ20110720.csv'

INTO TABLE db24.journal
FIELDS TERMINATED BY '}'
LINES TERMINATED BY '\n'
(voucher, date, glcode, projcode, blank, particulars, debit, credit, explanation, cr2, vat, gl2, sl2, par)")
or die(mysql_error());

?> 
