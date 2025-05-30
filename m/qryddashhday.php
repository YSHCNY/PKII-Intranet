<?php
//
// qryddashbday.php
// fr: ./vc/ddash.php

// db conn string
include '../includes/dbh.php';

	/* $res12query="SELECT tblhrtaholidays.applic_date, tblhrtaholidays.holidayname, tblhrtaholidays.holidaytype
FROM tblhrtaholidays WHERE (DATE(CONCAT(YEAR(CURDATE()), RIGHT(tblhrtaholidays.applic_date, 6))) BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) AND YEAR(tblhrtaholidays.applic_date)=YEAR(CURDATE()) ORDER BY DATE_FORMAT(tblhrtaholidays.applic_date, '%Y-%m-%d') ASC";
    $res12query="SELECT tblhrtaholidays.applic_date, tblhrtaholidays.holidayname, tblhrtaholidays.holidaytype
FROM tblhrtaholidays WHERE (DATE(CONCAT(YEAR(CURDATE()), RIGHT(tblhrtaholidays.applic_date, 6))) BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) AND YEAR(tblhrtaholidays.applic_date)=YEAR(CURDATE()) ORDER BY DATE_FORMAT(tblhrtaholidays.applic_date, '%Y-%m-%d') ASC"; */
    $res12query="SELECT tblhrtaholidays.applic_date, tblhrtaholidays.holidayname, tblhrtaholidays.holidaytype
FROM tblhrtaholidays WHERE tblhrtaholidays.applic_date BETWEEN NOW() - INTERVAL 3 DAY AND NOW() + INTERVAL 30 DAY ORDER BY DATE_FORMAT(tblhrtaholidays.applic_date, '%Y-%m-%d') ASC;";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh->query($res12query);
	$applic_date12Arr=array();
	$holidayname12Arr=array();
	$holidaytype12Arr=array();
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		array_push($applic_date12Arr, $myrow12['applic_date']);
		array_push($holidayname12Arr, $myrow12['holidayname']);
		array_push($holidaytype12Arr, $myrow12['holidaytype']);
		} // while
	} // if

// close database
$dbh->close();
?>
