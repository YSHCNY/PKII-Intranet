<?php
//
// qrymitsuppreq8e.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string

require '../includes/dbh.php';

	$res18equery="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$approveempid16\" LIMIT 1";
	$result18e=""; $found18e=0; $ctr18e=0;
	$result18e=$dbh->query($res18equery);
	if($result18e->num_rows>0) {
		while($myrow18e=$result18e->fetch_assoc()) {
		$name_last18e = $myrow18e['name_last'];
		$name_first18e = $myrow18e['name_first'];
		$name_middle18e = $myrow18e['name_middle'];
		$email118e = $myrow18e['email1'];
		$empposition18e = $myrow18e['empposition'];
		$empdepartment18e = $myrow18e['empdepartment'];
		} // while
	} // if

// close database
$dbh->close();
?>
