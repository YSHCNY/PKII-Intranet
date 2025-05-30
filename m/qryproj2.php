<?php
//
// qryproj2.php
// fr: ../vc/vprojmore.php
//
require '../includes/dbh.php';

	$res11query="SELECT projectid, proj_code, proj_fname, proj_sname, date_start, date_end, proj_desc, proj_services, companyid, projstatus, proj_remarks, employeeid FROM tblproject1 WHERE proj_code=\"$projcode\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0; $data="";
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$projectid11 = $myrow11['projectid'];
		$proj_code11 = $myrow11['proj_code'];
		$proj_fname11 = $myrow11['proj_fname'];
		$proj_sname11 = $myrow11['proj_sname'];
		$date_start11 = $myrow11['date_start'];
		$date_end11 = $myrow11['date_end'];
		$proj_desc11 = $myrow11['proj_desc'];
		$proj_services11 = $myrow11['proj_services'];
		$companyid11 = $myrow11['companyid'];
		$projstatus11 = $myrow11['projstatus'];
		$proj_remarks11 = $myrow11['proj_remarks'];
		$employeeid11 = $myrow11['employeeid'];
		} // while
	} // if
		
$dbh->close();
?> 
