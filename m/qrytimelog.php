<?php 

include '../includes/dbh.php';

// start contents here
	

	$res0query="SELECT tbllogin.employeeid, tblhrattuserinfo.att_userid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tbllogin INNER JOIN tblhrattuserinfo ON tbllogin.employeeid=tblhrattuserinfo.employeeid INNER JOIN tblcontact ON tbllogin.employeeid=tblcontact.employeeid WHERE tbllogin.loginid=$loginid";
	$result0=""; $found0=0;
	$result0=$dbh->query($res0query);
	if($result0->num_rows>0) {
		while($myrow0=$result0->fetch_assoc()) {
		$found0=1;
		$employeeid0 = $myrow0['employeeid'];
		$att_userid0 = $myrow0['att_userid'];
		$name_last0 = $myrow0['name_last'];
		$name_first0 = $myrow0['name_first'];
		$name_middle0 = $myrow0['name_middle'];
		} // while($myrow0=$result0->fetch_assoc())
	} // if($result0->num_rows>0)
		
	
	
	
$dbh->close();
?> 
