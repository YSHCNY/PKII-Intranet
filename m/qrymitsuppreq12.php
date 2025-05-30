<?php
//
// qrymitsuppreq22.php
// fr: ./vc/mitsuppreqcomments.php

// db conn string
require '../includes/dbh.php';

	$res22query="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, comments=\"$commentsfin\" WHERE iditsupportreq=$iditsupportreq";
	$result22=""; $found22=0; $ctr22=0;
	$result22=$dbh->query($res22query);

// close database
$dbh->close();
?>
