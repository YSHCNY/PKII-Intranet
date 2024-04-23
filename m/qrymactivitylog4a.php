<?php
//
// qrymactivitylog4a.php
// fr: ./vc/mactivitylog.php
// 20210709 - query first timein
// db conn string

require '../includes/dbh.php';

	$res14aquery="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid0\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC LIMIT 1";
	$result14a=""; $found14a=0; $ctr14a=0;
	$result14a=$dbh->query($res14aquery);
	if($result14a->num_rows>0) {
		while($myrow14a=$result14a->fetch_assoc()) {
                $found14a = 1;
		$hrattcheckinoutid14a = $myrow14a['hrattcheckinoutid'];
		$timein14a = $myrow14a['att_checktime'];
		$att_userid14a = $myrow14a['att_userid'];
		} // while
	} // if

// close database
$dbh->close();
?>
