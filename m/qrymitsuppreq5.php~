<?php
//
// qrymitsuppreq.php
// fr: ./vc/mitsuppreq.php

// db conn string

require '../includes/dbh.php';

	$res15query="SELECT name FROM tblitctgsuppreq WHERE code='".$actionctg12Arr[$x]."'";
	$result15=""; $found15=0; $ctr15=0;
	$result15=$dbh->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
		$name15 = $myrow15['name'];
		} // while
	} // if

// close database
$dbh->close();
?>
