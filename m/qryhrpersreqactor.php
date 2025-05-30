<?php
//
// qryhrpersreqactor.php
// fr: ../vc/mhrpersreq.php; ../vc/mhrpersreqadd.php
// note: need actorempid var

require '../includes/dbh.php';

	$res12query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.email1 FROM tblcontact WHERE tblcontact.contact_type=\"personnel\" AND tblcontact.employeeid=\"$actorempid\"";
	$result12=""; $found12=0; $ctr12=0; $data="";
	$result12=$dbh->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$found12=1;
		$name_last12 = $myrow12['name_last'];
		$name_first12 = $myrow12['name_first'];
		$name_middle12 = $myrow12['name_middle'];
		$contact_gender12 = $myrow12['contact_gender'];
		$email112 = $myrow12['email1'];		
		} // while
	} // if
		
$dbh->close();
?>
