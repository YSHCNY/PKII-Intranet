<?php
//
// fr: ../views/loginverify.php
// ../models/qrylogin2.php
include '../includes/dbh.php';

	// start query verification
	$res11query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.email1 != '' AND tblemployee.emp_record=\"active\" ORDER BY name_last";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);
	$name_last11Arr=array();
	$name_first11Arr=array();
	$email111Arr=array();
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		array_push($name_last11Arr, $myrow11['name_last']);
		array_push($name_first11Arr, $myrow11['name_first']);
		array_push($email111Arr, $myrow11['email1']);
		} // while
	} // if

// close db conn
$dbh->close();
?>