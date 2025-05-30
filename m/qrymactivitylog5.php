<?php
//
// qrymactivitylog5.php
// fr: ./vc/mactivitylog.php

// db conn string

require '../includes/dbh.php';

        $res15query="";
	$res15query="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid0\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"o\" ORDER BY tblhrattcheckinout.att_checktime DESC LIMIT 1";
	$result15=""; $found15=0; $ctr15=0;
	$result15=$dbh->query($res15query);
	$hrattcheckinoutid15Arr = array();
	$timeout15Arr = array();
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
                $found15=1;
		array_push($hrattcheckinoutid15Arr, $myrow15['hrattcheckinoutid']);
		array_push($timeout15Arr, $myrow15['att_checktime']);
		} // while
	} else {
        $res15bquery="";
        $res15bquery="SELECT hractlogid, timeend FROM tblhractlog WHERE date='$cutstart' AND employeeid='$employeeid0' ORDER BY timeend DESC LIMIT 1";
        $result15b=""; $found15b=0; $ctr15b=0;
        $result15b=$dbh->query($res15bquery);
        if($result15b->num_rows>0) {
            while($myrow15b=$result15b->fetch_assoc()) {
            $found15b=1;
            $hractlogid15b = $myrow15b['hractlogid'];
            $timeend15b = $myrow15b['timeend'];
            } //while
        } //if
        } // if

// close database
$dbh->close();
?>
