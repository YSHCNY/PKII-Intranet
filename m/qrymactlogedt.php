<?php
//
// qrymactlogadd.php
// fr: ./vc/mactivitylogedt.php

// db conn string
require '../includes/dbh.php';
$now = mysqli_real_escape_string($dbh, $now);
$idlogin = (int)$idlogin; // Ensure numeric value
$actdate = mysqli_real_escape_string($dbh, $actdate);
$employeeid = mysqli_real_escape_string($dbh, $employeeid);
$actdetails = mysqli_real_escape_string($dbh, $actdetails);
$currproj = mysqli_real_escape_string($dbh, $currproj);
$timestartfin = mysqli_real_escape_string($dbh, $timestartfin);
$timeendfin = mysqli_real_escape_string($dbh, $timeendfin);
$actlogid = (int)$actlogid;
$proj_code9 = mysqli_real_escape_string($dbh, $proj_code9);
$proj_name9 = mysqli_real_escape_string($dbh, $proj_name9);
$concat_proj = mysqli_real_escape_string($dbh, "$proj_code9 - $proj_name9,");

	// insert query
	$res9qry="SELECT DISTINCT proj_code, proj_name FROM tblprojassign WHERE proj_code = '$projcode' AND employeeid = '$employeeid'";
	$result9=$dbh->query($res9qry);
	if($result9->num_rows>0) {
		while($myrow9=$result9->fetch_assoc()) {
			$found9=1;
			$ctr9=$ctr9+1;
			$proj_code9 = trim($myrow9['proj_code']);
			$proj_name9 = trim($myrow9['proj_name']);
			if($proj_code9==$projcode16) {
				$projcodesel="selected";
			} else {
				$projcodesel="";
			} // if-else
			
		} // while
	} // if
	

	if ($projcode != ""){
	$updatethisfirst = "UPDATE tblhractlog SET  projcode = '$currproj' WHERE hractlogid=$actlogid";
	$resultfirst = $dbh->query($updatethisfirst);

	if($resultfirst!=""){

		$res11query="UPDATE tblhractlog SET timestamp=\"$now\", loginid=$idlogin, date=\"$actdate\", employeeid=\"$employeeid\", activity=\"$actdetails\", projcode = CONCAT(projcode, '\n', '$proj_code9 - $proj_name9,'), timestart=\"$timestartfin\", timeend=\"$timeendfin\" WHERE hractlogid=$actlogid AND employeeid=\"$employeeid\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh->query($res11query);
		echo "$res11query";
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
	}
} else {
	$res11query="UPDATE tblhractlog SET timestamp=\"$now\", loginid=$idlogin, date=\"$actdate\", employeeid=\"$employeeid\", activity=\"$actdetails\", projcode = \"$currproj\", timestart=\"$timestartfin\", timeend=\"$timeendfin\" WHERE hractlogid=$actlogid AND employeeid=\"$employeeid\"";
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
}


	
// close database
$dbh->close();
?>
