<?php
//
// qrymactivitylog6.php
// fr: ./vc/mactivitylog.php

// db conn string

require '../includes/dbh.php';

	$res16query="SELECT tblhractlog.hractlogid, tblhractlog.activity, tblhractlog.remarks, tblhractlog.remarksby, tblhractlog.projcode, tblhractlog.timestart, tblhractlog.timeend, tblhractlog.timeval, tblproject1.proj_fname, tblproject1.proj_sname FROM tblhractlog LEFT JOIN tblproject1 ON tblhractlog.projcode=tblproject1.proj_code WHERE tblhractlog.date=\"$arrcutdate0\" AND tblhractlog.employeeid=\"$employeeid0\" ORDER BY tblhractlog.timestamp DESC";
	// $res16query="SELECT hractlogid, activity, remarks, remarksby, projcode, timestart, timeend FROM tblhractlog WHERE date=\"$arrcutdate0\" AND employeeid=\"$employeeid0\" ORDER BY timestamp DESC";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh->query($res16query);
	$hractlogid16Arr=array();
	$activity16Arr=array();
	$remarks16Arr=array();
	$remarksby16Arr=array();
	$projcode16Arr=array();
	$timestart16Arr=array();
	$timeend16Arr=array();
	$timeval16Arr=array();
	$proj_fname16Arr=array();
	$proj_sname16Arr=array();
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		array_push($hractlogid16Arr, $myrow16['hractlogid']);
		array_push($activity16Arr, $myrow16['activity']);
		array_push($remarks16Arr, $myrow16['remarks']);
		array_push($remarksby16Arr, $myrow16['remarksby']);
		array_push($projcode16Arr, $myrow16['projcode']);
		array_push($timestart16Arr, $myrow16['timestart']);
		array_push($timeend16Arr, $myrow16['timeend']);
		array_push($timeval16Arr, $myrow16['timeval']);
		array_push($proj_fname16Arr, $myrow16['proj_fname']);
		array_push($proj_sname16Arr, $myrow16['proj_sname']);
		} // while
	} // if

// close database
$dbh->close();
?>
