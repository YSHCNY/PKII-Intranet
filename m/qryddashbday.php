<?php
//
// qryddashbday.php
// fr: ./vc/ddash.php

// db conn string
include '../includes/dbh.php';

	// $res11query="SELECT tblemployee.emp_birthdate, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.picfn FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE (DATE(CONCAT(YEAR(CURDATE()), RIGHT(tblemployee.emp_birthdate, 6))) BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) AND tblemployee.emp_record='active' AND tblemployee.employee_type='employee' ORDER BY DATE_FORMAT(tblemployee.emp_birthdate, '%m-%d') limit 6";
	$res11query="SELECT tblemployee.emp_birthdate, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.picfn FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE (DATE(CONCAT(YEAR(CURDATE()), RIGHT(tblemployee.emp_birthdate, 6))) BETWEEN DATE_SUB(CURDATE(), INTERVAL 0 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) AND tblemployee.emp_record='active' AND tblemployee.employee_type='employee' ORDER BY DATE_FORMAT(tblemployee.emp_birthdate, '%m-%d') LIMIT 5";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);
	$emp_birthdate11Arr=array();
	$employeeid11Arr=array();
	$name_last11Arr=array();
	$name_first11Arr=array();
	$name_middle11Arr=array();
	$picfn11Arr=array();
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		array_push($emp_birthdate11Arr, $myrow11['emp_birthdate']);
		array_push($employeeid11Arr, $myrow11['employeeid']);
		array_push($name_last11Arr, $myrow11['name_last']);
		array_push($name_first11Arr, $myrow11['name_first']);
		array_push($name_middle11Arr, $myrow11['name_middle']);
		array_push($picfn11Arr, $myrow11['picfn']);
		} // while
	} // if

// close database
$dbh->close();
?>
