<?php
//
// qrymactivitylog6.php
// fr: ./vc/mactivitylog.php

// db conn string

require '../includes/dbh.php';

	$res16query="SELECT date, activity, remarks, remarksby, projcode, timestart, timeend FROM tblhractlog WHERE hractlogid=$hractlogid AND employeeid=\"$employeeid0\" LIMIT 1";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$date16 = $myrow16['date'];
		$activity16 = $myrow16['activity'];
		$remarks16 = $myrow16['remarks'];
		$remarksby16 = $myrow16['remarksby'];
		$projcode16 = $myrow16['projcode'];
		$timestart16 = $myrow16['timestart'];
		$timeend16 = $myrow16['timeend'];
		} // while
	} // if

// close database
$dbh->close();
?>
