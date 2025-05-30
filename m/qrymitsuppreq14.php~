<?php
//
// qrymitsuppreq7.php
// fr: ./vc/mitsuppreq2.php

// db conn string

require '../includes/dbh.php';

	$res11query="INSERT INTO tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, ticketnum=000000000, stamprequest=\"$now\", requestorid=$loginid, employeeid=\"$requestorempid\", deptcd=\"$deptcd\", requestctg=\"$requestcdfin\", details=\"$details\", comments=\"\", requestctr=$requestctr, approvectr=$approvectr, approveid=$approveid, approveempid=\"$approver\", approvenotes=\"\", approvestamp=\"$approvestamp\", actionctr=$actionctr, actionctg=\"\", actiondetails=\"\", actionid=$actionid, actionempid=\"\", closeticketsw=$closeticketsw, closestamp=\"$closestamp\", actionremarks=\"\"";
	$result11 = $dbh->query($res11query);
	// echo "<p>$res11query";
	// get insert id
	$iditsupportreq = mysqli_insert_id();

// close database
$dbh->close();
?>
