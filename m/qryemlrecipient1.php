<?php
//
// fr: ../vc/mhrotfrmreq2.php.php
// ../models/qryemlrecipient1.php
include '../includes/dbh.php';

	// start query verification
	$res11query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.employeeid='$empidselected' AND tblemployee.emp_record=\"active\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$name_last11, $myrow11['name_last']);
		$name_first11, $myrow11['name_first']);
		$email111, $myrow11['email1']);
		} // while
	} // if

// close db conn
$dbh->close();
?>