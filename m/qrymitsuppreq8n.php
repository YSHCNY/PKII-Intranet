<?php
//
// qrymitsuppreq8d.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string
require '../includes/dbh.php';

	$res18nquery="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$approver3empid18b\" LIMIT 1";
	$result18n=""; $found18n=0; $ctr18n=0;
	$result18n=$dbh->query($res18nquery);
	if($result18n->num_rows>0) {
		while($myrow18n=$result18n->fetch_assoc()) {
		$name_last18n = $myrow18n['name_last'];
		$name_first18n = $myrow18n['name_first'];
		$name_middle18n = $myrow18n['name_middle'];
		$email118n = $myrow18n['email1'];
		$empposition18n = $myrow18n['empposition'];
		$empdepartment18n = $myrow18n['empdepartment'];
		} // while
	} // if

// close database
$dbh->close();
?>
