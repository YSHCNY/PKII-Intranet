<?php
//
// qryproj.php
// fr: ../vc/vprojects.php
//
require '../includes/dbh.php';

	$res11query="SELECT tblproject1.projectid, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.date_start, tblproject1.date_end FROM tblproject1 ORDER BY tblproject1.projectid DESC";
	$result11=""; $found11=0; $ctr11=0; $data="";
	$result11=$dbh->query($res11query);
	$projectidArr=array();
	$proj_codeArr=array();
	$proj_fnameArr=array();
	$proj_snameArr=array();
	$date_startArr=array();
	$date_endArr=array();
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		array_push($projectidArr, $myrow11['projectid']);
		array_push($proj_codeArr, $myrow11['proj_code']);
		array_push($proj_fnameArr, $myrow11['proj_fname']);
		array_push($proj_snameArr, $myrow11['proj_sname']);
		array_push($date_startArr, $myrow11['date_start']);
		array_push($date_endArr, $myrow11['date_end']);
		} // while
	} // if
		
$dbh->close();
?> 
