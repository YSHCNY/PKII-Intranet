<?php
//
// qryhrpersreqactor3.php
// fr: ../vc/mhrpersreqrecoappr.php
// note: need actorempid var

require '../includes/dbh.php';

	$res16query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.contact_type=\"personnel\" AND tblcontact.employeeid=\"$actorempid\"";
	$result16=""; $found16=0; $ctr16=0; $data="";
	$result16=$dbh->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$found16=1;
		$name_last16 = $myrow16['name_last'];
		$name_first16 = $myrow16['name_first'];
		$name_middle16 = $myrow16['name_middle'];
		$contact_gender16 = $myrow16['contact_gender'];
		$email116 = $myrow16['email1'];
		$empposition16 = $myrow16['empposition'];
		$empdepartment16 = $myrow16['empdepartment'];
		} // while
	} // if

$dbh->close();
?>