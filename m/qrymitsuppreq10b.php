<?php
//
// qrymitsuppreq9.php
// fr: ./vc/mitsuppreqdtl.php

// db conn string
require '../includes/dbh.php';

	$res20bquery="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, approveid=$loginid, approvectr=$approvectrfin, approvestamp=\"$now\", apprdurationdt=\"$apprdurationdtfin\", apprdurationsw=$apprdurationswfin WHERE iditsupportreq=$iditsupportreq";
	$result20b=""; $found20b=0; $ctr20b=0;
	$result20b=$dbh->query($res20bquery);

// close database
$dbh->close();
?>
