<?php
//
// qryproj.php
// fr: ../vc/vprojects.php
//
require '../includes/dbh.php';

	if($disptyp=='' || $disptyp=='all') {
		$res11query="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid  WHERE tblemployee.employeeid!='' AND tblemployee.emp_record='active' ORDER BY tblcontact.name_last";
	} else {
		$res11query="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.picfn FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid  WHERE tblemployee.employee_type='$disptyp' AND tblemployee.emp_record='active' ORDER BY tblcontact.name_last";
	}
	$result11=""; $found11=0; $ctr11=0; $data="";
	$result11=$dbh->query($res11query);
	$employeeidArr=array();
	$name_firstArr=array();
	$name_lastArr=array();
	$name_middleArr=array();
	$email1Arr=array();
	$num_mobile1_ccArr=array();
	$num_mobile1_acArr=array();
	$num_mobile1Arr=array();
	$num_mobile2_ccArr=array();
	$num_mobile2_acArr=array();
	$num_mobile2Arr=array();
	$picfnArr=array();
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		array_push($employeeidArr, $myrow11['employeeid']);
		array_push($name_firstArr, $myrow11['name_first']);
		array_push($name_lastArr, $myrow11['name_last']);
		array_push($name_middleArr, $myrow11['name_middle']);
		array_push($email1Arr, $myrow11['email1']);
		array_push($num_mobile1_ccArr, $myrow11['num_mobile1_cc']);
		array_push($num_mobile1_acArr, $myrow11['num_mobile1_ac']);
		array_push($num_mobile1Arr, $myrow11['num_mobile1']);
		array_push($num_mobile2_ccArr, $myrow11['num_mobile2_cc']);
		array_push($num_mobile2_acArr, $myrow11['num_mobile2_ac']);
		array_push($num_mobile2Arr, $myrow11['num_mobile2']);
		array_push($picfnArr, $myrow11['picfn']);
		} // while
	} // if
		
$dbh->close();
?> 
