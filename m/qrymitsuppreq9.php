<?php
//
// qrymitsuppreq9.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string

require '../includes/dbh.php';

	$res19query="SELECT name FROM tblitctgsuppreq WHERE ctgtype=\"ACT\" AND code=\"$actionctg16\" LIMIT 1";
	$result19=""; $found19=0; $ctr19=0;
	$result19=$dbh->query($res19query);
	if($result19->num_rows>0) {
		while($myrow19=$result19->fetch_assoc()) {
		$found19=1;
		$name19 = $myrow19['name'];
		} // while
	} // if

// close database
$dbh->close();
?>