<?php
//
// qrymitsuppreq.php
// fr: ./vc/mitsuppreq.php

// db conn string

require '../includes/dbh.php';

	$res11query="SELECT DISTINCT DATE_FORMAT(stamprequest, '%Y-%m' ) AS yyyymm FROM tblitsupportreq WHERE ((requestorid=$loginid OR employeeid=\"$employeeid0\") OR approveempid=\"$employeeid0\") ORDER BY stamprequest DESC, timestamp DESC";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);
	$yyyymm11Arr=array();
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		array_push($yyyymm11Arr, $myrow11['yyyymm']);
		} // while
	} // if

// close database
$dbh->close();
?>