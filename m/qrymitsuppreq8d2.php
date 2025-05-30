<?php
//
// qrymitsuppreq8d.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string

require '../includes/dbh.php';

	$res18d2query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$approver3empid18b\" LIMIT 1";
	$result18d2=""; $found18d2=0; $ctr18d2=0;
	$result18d2=$dbh->query($res18d2query);
	if($result18d2->num_rows>0) {
		while($myrow18d2=$result18d2->fetch_assoc()) {
		$name_last18d2 = $myrow18d2['name_last'];
		$name_first18d2 = $myrow18d2['name_first'];
		$name_middle18d2 = $myrow18d2['name_middle'];
		$email118d2 = $myrow18d2['email1'];
		$empposition18d2 = $myrow18d2['empposition'];
		$empdepartment18d2 = $myrow18d2['empdepartment'];
		} // while
	} // if

// close database
$dbh->close();
?>
