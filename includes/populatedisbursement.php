<?php

$hostname	= "localhost";
$dbname		= "db24";
$dbusername	= "root";
$dbuserpass	= "sysad";

$connection = mysql_connect("$hostname", "$dbusername", "$dbuserpass") or die("Cannot connect to MySQL server: " . mysql_error());
$db_selected = mysql_select_db('$dbname', $connection);

$data = mysql_query("LOAD DATA LOCAL INFILE '/home/brian/Downloads/disbursement20110816.csv'

INTO TABLE db24.disbursement
FIELDS ENCLOSED BY '"'
FIELDS TERMINATED BY '}'
LINES TERMINATED BY '\n'
(voucher, date, glcode, projcode, blank, particulars, debit, credit, explanation, payee, basic, wtax, cib, cr2, vat, par, amount, sl2)")
or die(mysql_error());

?> 
