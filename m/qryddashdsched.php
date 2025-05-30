<?php
//
// qryddashdsched.php
// fr: ./vc/ddash.php

// db conn string
include '../includes/dbh.php';

	$datenowplus1mo = date("Y-m-d", strtotime("+ 30 day", strtotime($datenow)));
	$datenowplus2mo = date("Y-m-d", strtotime("+ 60 day", strtotime($datenow)));
	$datenowplus3mo = date("Y-m-d", strtotime("+ 90 day", strtotime($datenow)));
	$datenowplus4mo = date("Y-m-d", strtotime("+ 120 day", strtotime($datenow)));

    //20230523
    if($empdepartment0=='FIN') {

    $res14query="SELECT idtblscheduler, loginid, lastupdate, schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere FROM tblscheduler WHERE ((datefrom >= \"$datenow\" AND dateto <= \"$datenowplus4mo\") OR (DATE_FORMAT(datefrom, '%y-%m-%d') >= DATE_FORMAT('$datenow', '%m-%d') AND DATE_FORMAT(datefrom, '%m-%d') <= DATE_FORMAT('$datenowplus4mo', '%m-%d') AND recurring=1)) AND deptcd LIKE \"%$empdepartment0%\" ORDER BY DATE_FORMAT(datefrom, '%m-%d') ASC LIMIT 10";

    } else {

    $res14query="SELECT idtblscheduler, loginid, lastupdate, schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere FROM tblscheduler WHERE ((datefrom >= \"$datenow\" AND dateto <= \"$datenowplus2mo\") OR (DATE_FORMAT(datefrom, '%y-%m-%d') >= DATE_FORMAT('$datenow', '%m-%d') AND DATE_FORMAT(datefrom, '%m-%d') <= DATE_FORMAT('$datenowplus2mo', '%m-%d') AND recurring=1)) AND deptcd LIKE \"%$empdepartment0%\" ORDER BY DATE_FORMAT(datefrom, '%m-%d') ASC LIMIT 10";

    } //if-else

	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh->query($res14query);
	$idscheduler14Arr=array();
	$loginid14Arr=array();
	$lastupdate14Arr=array();
	$schedname14Arr=array();
	$datefrom14Arr=array();
	$dateto14Arr=array();
	$details14Arr=array();
	$recurring14Arr=array();
	$deptcd14Arr=array();
	$notifysw14Arr=array();
	$notifywhen14Arr=array();
	$notifywho14Arr=array();
	$displaywhere14Arr=array();
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		array_push($idscheduler14Arr, $myrow14['idtblscheduler']);
		array_push($loginid14Arr, $myrow14['loginid']);
		array_push($lastupdate14Arr, $myrow14['lastupdate']);
		array_push($schedname14Arr, $myrow14['schedname']);
		array_push($datefrom14Arr, $myrow14['datefrom']);
		array_push($dateto14Arr, $myrow14['dateto']);
		array_push($details14Arr, $myrow14['details']);
		array_push($recurring14Arr, $myrow14['recurring']);
		array_push($deptcd14Arr, $myrow14['deptcd']);
		array_push($notifysw14Arr, $myrow14['notifysw']);
		array_push($notifywhen14Arr, $myrow14['notifywhen']);
		array_push($notifywho14Arr, $myrow14['notifywho']);
		array_push($displaywhere14Arr, $myrow14['displaywhere']);
		} // while
	} // if

// close database
$dbh->close();
?>
