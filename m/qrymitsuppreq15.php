<?php
//
// qrymitsuppreq15.php
// fr: ./vc/mitsuppreqscore.php

// db conn string

require '../includes/dbh.php';

	$res15query="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, scoreval=\"$scoreval\", scorestamp=\"$now\", scoreempid=\"$employeeid\", scoreremarks=\"$scoreremarks\" WHERE iditsupportreq=$iditsupportreq";
	$result15 = $dbh->query($res15query);
	// echo "<br>$res12query";
	$idsession = mysqli_insert_id();

// close database
$dbh->close();
?>
