<?php
//
// qrymitsuppreq.php
// fr: ./vc/mitsuppreq.php

// db conn string

require '../includes/dbh.php';

	if($yyyymm=="all") {
	$res12query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp FROM tblitsupportreq WHERE ((tblitsupportreq.requestorid=$loginid OR tblitsupportreq.employeeid=\"$employeeid0\") OR tblitsupportreq.approveempid=\"$employeeid0\") ORDER BY tblitsupportreq.stamprequest DESC";
	} else {
	$res12query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp FROM tblitsupportreq WHERE ((tblitsupportreq.requestorid=$loginid OR tblitsupportreq.approveempid=\"$employeeid0\") OR tblitsupportreq.approveempid=\"$employeeid0\") AND (YEAR(tblitsupportreq.stamprequest)=\"$cutyear\" AND MONTH(tblitsupportreq.stamprequest)=\"$cutmonth\") ORDER BY tblitsupportreq.stamprequest DESC";
	} // if
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh->query($res12query);
	$iditsupportreq12Arr=array();
	$ticketnum12Arr=array();
	$stamprequest12Arr=array();
	$employeeid12Arr=array();
	$deptcd12Arr=array();
	$requestctg12Arr=array();
	$details12Arr=array();
	$requestctr12Arr=array();
	$approvectr12Arr=array();
	$approveid12Arr=array();
	$approveempid12Arr=array();
	$approvestamp12Arr=array();
	$actionctr12Arr=array();
	$actionctg12Arr=array();
	$actionid12Arr=array();
	$actionempid12Arr=array();
	$closeticketsw12Arr=array();
	$closestamp12Arr=array();
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		array_push($iditsupportreq12Arr, $myrow12['iditsupportreq']);
		array_push($ticketnum12Arr, $myrow12['ticketnum']);
		array_push($stamprequest12Arr, $myrow12['stamprequest']);
		array_push($employeeid12Arr, $myrow12['employeeid']);
		array_push($deptcd12Arr, $myrow12['deptcd']);
		array_push($requestctg12Arr, $myrow12['requestctg']);
		array_push($details12Arr, $myrow12['details']);
		array_push($requestctr12Arr, $myrow12['requestctr']);
		array_push($approvectr12Arr, $myrow12['approvectr']);
		array_push($approveid12Arr, $myrow12['approveid']);
		array_push($approveempid12Arr, $myrow12['approveempid']);
		array_push($approvestamp12Arr, $myrow12['approvestamp']);
		array_push($actionctr12Arr, $myrow12['actionctr']);
		array_push($actionctg12Arr, $myrow12['actionctg']);
		array_push($actionid12Arr, $myrow12['actionid']);
		array_push($actionempid12Arr, $myrow12['actionempid']);
		array_push($closeticketsw12Arr, $myrow12['closeticketsw']);
		array_push($closestamp12Arr, $myrow12['closestamp']);
		} // while
	} // if

// close database
$dbh->close();
?>