<?php
//
// qrymactivitylog1.php //20210726
// fr: ./vc/mactivitylog.php

// db conn string

require '../includes/dbh.php';

	$res11bquery="SELECT DATE_FORMAT(applic_date, '%Y-%m-%d' ) AS yyyymmdd FROM tblhrtaholidays WHERE applic_date=\"$cutstart\" AND (holidaytype=\"legal\" OR holidaytype=\"special\") LIMIT 1";
	$result11b=""; $found11=0;
	$result11b=$dbh->query($res11bquery);
	if($result11b->num_rows>0) {
		while($myrow11b=$result11b->fetch_assoc()) {
                $found11b=1;
                $yyyymmdd11b = $myrow11b['yyyymmdd'];
		} // while
	} // if

// close database
$dbh->close();
?>
