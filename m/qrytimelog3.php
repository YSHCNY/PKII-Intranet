<?php
//
// qrymactivitylog4.php
// fr: ./vc/mactivitylog.php

// db conn string

require '../includes/dbh.php';
// if
/*$res14query="SELECT tblhrattcheckinout.att_checktime FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid0\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC";
			$result14=""; $found14=0;
			$result14=$dbh->query($res14query);
			$hrattcheckinoutid14Arr = array();
			$timein14Arr = array();
			$att_userid14Arr = array();
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
			//array_push($hrattcheckinoutid14Arr, $myrow14['hrattcheckinoutid']);
			//array_push($att_userid14Arr, $myrow14['att_userid']);
				$found14 = 1;
				array_push($timein14Arr, $myrow14['att_checktime']);
				}
			}*/
			
// $res14query="SELECT tblhrattcheckinout.att_checktime FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid0\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC";
$res14query="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid0\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC LIMIT 1";
			$result14=""; $found14=0;
			$result14=$dbh->query($res14query);
			if($result14->num_rows>0) {
				while($myrow14=$result14->fetch_assoc()) {
				$found14 = 1;
				$timein14 = $myrow14['att_checktime'];
				}
			}
// close database
$dbh->close();
?>
