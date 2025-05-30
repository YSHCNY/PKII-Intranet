<?php
//
// qrymitsuppreq6.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string

require '../includes/dbh.php';

	$res21query="SELECT tblcontact.contactid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.email1 FROM tbllogin LEFT JOIN tblcontact ON tbllogin.employeeid=tblcontact.employeeid WHERE tbllogin.loginid=$loginid AND tblcontact.contact_type=\"personnel\" LIMIT 1";
	$result21=""; $found21=0; $ctr21=0;
	$result21=$dbh->query($res21query);
	if($result21->num_rows>0) {
		while($myrow21=$result21->fetch_assoc()) {
		$contactid21 = $myrow21['contactid'];
		$name_last21 = $myrow21['name_last'];
		$name_first21 = $myrow21['name_first'];
		$name_middle21 = $myrow21['name_middle'];
		$contact_gender21 = $myrow21['contact_gender'];
		$email121 = $myrow21['email1'];
		} // while
	} // if

// close database
$dbh->close();
?>
