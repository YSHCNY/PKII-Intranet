<?php
//
// qryhrpersreqactor.php
// fr: ../vc/mhrpersreq.php; ../vc/mhrpersreqadd.php
// note: need actorempid var

require '../includes/dbh.php';

	$res14query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.contact_type=\"personnel\" AND tblcontact.employeeid=\"$actorempid\"";
	$result14=""; $found14=0; $ctr14=0; $data="";
	$result14=$dbh->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		$name_last14 = $myrow14['name_last'];
		$name_first14 = $myrow14['name_first'];
		$name_middle14 = $myrow14['name_middle'];
		$contact_gender14 = $myrow14['contact_gender'];
		$email114 = $myrow14['email1'];
		$empposition14 = $myrow14['empposition'];
		$empdepartment14 = $myrow14['empdepartment'];
		} // while
	} // if
		
$dbh->close();
?>