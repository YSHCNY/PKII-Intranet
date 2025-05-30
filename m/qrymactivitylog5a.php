<?php
//
// qrymactivitylog5a.php
// fr: ./vc/mactivitylog.php
// 20210709 - query last timeout
// db conn string

require '../includes/dbh.php';

	$res15aquery="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid0\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"o\" ORDER BY tblhrattcheckinout.att_checktime DESC LIMIT 1";
	$result15a=""; $found15a=0; $ctr15a=0;
	$result15a=$dbh->query($res15aquery);
	if($result15a->num_rows>0) {
		while($myrow15a=$result15a->fetch_assoc()) {
                $found15a = 1;
		$hrattcheckinoutid15a = $myrow15a['hrattcheckinoutid'];
		$timeout15a = $myrow15a['att_checktime'];
		} // while
	} // if

// close database
$dbh->close();
?>
