<?php
//
// qrymitsuppreq14.php
// fr: ./vc/mitsuppreq2.php

// db conn string

require '../includes/dbh.php';

	$res12query="INSERT INTO tblsession SET timestamp=\"$now\", loginid=$loginid, sesschars=\"".genRandomString()."\", loginpath=\"$prevpath\", employeeid=\"$approver\", remarks=\"IT support request form for approval: dept:$deptcd empids:$requestorempid-to-$approver req:$requestcd tbl:tblitsupportreq id:$iditsupportreq\"";
	$result12 = $dbh->query($res12query);
	// echo "<br>$res12query";
	$idsession = mysqli_insert_id();

// close database
$dbh->close();
?>
