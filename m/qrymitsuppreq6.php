<?php
//
// qrymitsuppreq6.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string

require '../includes/dbh.php';

	$res17query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.email1, tblempdetails.empdepartment, tblempdetails.empposition FROM tbllogin LEFT JOIN tblcontact ON tbllogin.employeeid=tblcontact.employeeid LEFT JOIN tblempdetails ON tbllogin.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$employeeid16\" LIMIT 1";
	$result17=""; $found17=0; $ctr17=0;
	$result17=$dbh->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17=$result17->fetch_assoc()) {
		$name_last17 = $myrow17['name_last'];
		$name_first17 = $myrow17['name_first'];
		$name_middle17 = $myrow17['name_middle'];
		$contact_gender17 = $myrow17['contact_gender'];
		$email117 = $myrow17['email1'];
		$empdepartment17 = $myrow17['empdepartment'];
		$empposition17 = $myrow17['empposition'];
		} // while
	} // if

// close database
$dbh->close();
?>
