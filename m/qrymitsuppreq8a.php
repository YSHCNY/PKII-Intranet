<?php
//
// qrymitsuppreq5.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string

require '../includes/dbh.php';

	$res18aquery="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblcontact.contact_gender, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$approveempid16\" AND tblcontact.contact_type=\"personnel\" LIMIT 1";
	$result18a=""; $found18a=0; $ctr18a=0;
	$result18a=$dbh->query($res18aquery);
	if($result18a->num_rows>0) {
		while($myrow18a=$result18a->fetch_assoc()) {
		$found18a = 1;
		$name_last18a = $myrow18a['name_last'];
		$name_first18a = $myrow18a['name_first'];
		$name_middle18a = $myrow18a['name_middle'];
		$email118a = $myrow18a['email1'];
		$contact_gender18a = $myrow18a['contact_gender'];
		$empposition18a = $myrow18a['empposition'];
		$empdepartment18a = $myrow18a['empdepartment'];
		} // while
	} // if

// close database
$dbh->close();
?>
