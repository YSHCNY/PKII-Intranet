<?php
//
// qrymactivitylog6b.php
// fr: ./vc/mactivitylog.php
// to count number of task/activity per day
// req:tblhractlog.date

// db conn string

require '../includes/dbh.php';

$dateval=date('Y-m-d', strtotime($dateval));

	$res16aquery=""; $result16a=""; $found16a=0; $ctr16a=0;
	$res16aquery="SELECT count(*) AS actrowctr FROM tblhractlog WHERE tblhractlog.date=\"$dateval\" AND tblhractlog.employeeid=\"$employeeid0\"";
	// $res16query="SELECT hractlogid, activity, remarks, remarksby, projcode, timestart, timeend FROM tblhractlog WHERE date=\"$arrcutdate0\" AND employeeid=\"$employeeid0\" ORDER BY timestamp DESC";
	$result16a=$dbh->query($res16aquery);
	$actrowctr16aArr=array();
	if($result16a->num_rows>0) {
                $found16a=1;
		while($myrow16a=$result16a->fetch_assoc()) {
		array_push($actrowctr16aArr, $myrow16a['actrowctr']);
		} // while
	} // if

// close database
$dbh->close();
?>
