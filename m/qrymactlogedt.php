<?php
//
// qrymactlogadd.php
// fr: ./vc/mactivitylogedt.php

// db conn string
require '../includes/dbh.php';

	// insert query
	$res11query="UPDATE tblhractlog SET timestamp=\"$now\", loginid=$idlogin, date=\"$actdate\", employeeid=\"$employeeid\", activity=\"$actdetails\", projcode=\"$projcode\", timestart=\"$timestartfin\", timeend=\"$timeendfin\" WHERE hractlogid=$actlogid";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);
	
	if($result11!='') {
		// query username and prep vars for ./m/qryinslog.php
		$res12aquery="";
		$res12aquery="SELECT username FROM tbllogin WHERE loginid=$idlogin";
		$result12a=""; $found12a=0;
		$result12a=$dbh->query($res12aquery);
		if($result12a->num_rows>0) {
			while($myrow12a=$result12a->fetch_assoc()) {
				$found12a=1;
				$username12a = $myrow12a['username'];
			} // while
		} // if
		
		if($found12a==1) { $username0=$username12a; $loginid=$idlogin; }

	// create log
	$logdetails = "modified activity log with id:$actlogid for date:$actdate";
	include '../m/qryinslog.php';

	} // if

// close database
$dbh->close();
?>
