<?php
//
// qrymitsuppreq9.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string

require '../includes/dbh.php';

	$res20aquery="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, requestctr=$requestctrfin WHERE iditsupportreq=$iditsupportreq AND requestorid=$loginid";
	$result20a=""; $found20a=0; $ctr20a=0;
	$result20a=$dbh->query($res20aquery);

// close database
$dbh->close();
?>
