<?php
//
// qryinslog.php
// fr: ./vc/mactivitylogadd.php

// db conn string
require '../includes/dbh.php';

	// insert query
	$res12query="";
	$res12query="INSERT INTO tbllogs SET timestamp='$now', loginid=$loginid, username='$username0', logdetails='$logdetails'";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh->query($res12query);
	// clear logdetails
	$logdetails="";

// close database
$dbh->close();
?>
