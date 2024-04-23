<?php
//
// qrymactivitylog4.php
// fr: ./vc/mactivitylog.php

// db conn string

require '../includes/dbh.php';

        $res14query="";
	$res14query="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid0\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC LIMIT 1";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh->query($res14query);
	$hrattcheckinoutid14Arr = array();
	$timein14Arr = array();
	$att_userid14Arr = array();
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
                $found14=1;
		array_push($hrattcheckinoutid14Arr, $myrow14['hrattcheckinoutid']);
		array_push($timein14Arr, $myrow14['att_checktime']);
		array_push($att_userid14Arr, $myrow14['att_userid']);
		} // while
	} else {
            $res14bquery="";
            $res14bquery="SELECT hractlogid, timestart FROM tblhractlog WHERE date='$cutstart' AND employeeid='$employeeid0' ORDER BY timestart ASC LIMIT 1";
            $result14b=""; $found14b=0; $ctr14b=0;
            $result14b=$dbh->query($res14bquery);
            if($result14b->num_rows>0) {
                while($myrow14b=$result14b->fetch_assoc()) {
                $found14b=1;
                $hractlogid14b = $myrow14b['hractlogid'];
                $timestart14b = $myrow14b['timestart'];
                } //while
            } //if
        } //if

// close database
$dbh->close();
?>
