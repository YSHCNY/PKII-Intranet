<?php
//
// qrymactlogadd.php
// fr: ./vc/mactivitylogedt.php

// db conn string
require '../includes/dbh.php';

	// insert query
	$res11query="DELETE FROM tblhractlog WHERE hractlogid=$hractlogid";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);

// close database
$dbh->close();
?>
