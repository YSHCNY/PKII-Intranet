<?php
//
// qryddashadm.php
// fr index.php, index2.php > ddashadm.php 
//

// db conn string
include '../includes/dbh.php';

//
// model queries
//

$res015qry2="";
$res015qry2="SELECT count(*) AS ctrempactv FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblcontact.contact_gender = 'Female' AND tblemployee.emp_record = 'active'";
$result015=""; $found015=0;
$result015=$dbh->query($res015qry2);
if($result015->num_rows>0) {
	while($myrow015=$result015->fetch_assoc()) {
	$found015=1;
	$ctrempactvfem = $myrow015['ctrempactv'];		
	} // while
}



// count active employees
$res015qry="";
$res015qry="SELECT count(*) AS ctrempactv FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblcontact.contact_gender = 'Male' AND tblemployee.emp_record = 'active'";
$result015=""; $found015=0;
$result015=$dbh->query($res015qry);
if($result015->num_rows>0) {
	while($myrow015=$result015->fetch_assoc()) {
	$found015=1;
	$ctrempactv = $myrow015['ctrempactv'];		
	} // while
} // if
// $result015=$pdo->prepare($res015qry);
// $result015->execute();
// while($myrow015=$result015->fetch(PDO::FETCH_ASSOC)) {
// } // while

// qry active consultants
$res016qry="";
$res016qry="SELECT count(*) AS ctrconsactv FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'active'";
$result016=""; $found016=0;
$result016=$dbh->query($res016qry);
if($result016->num_rows>0) {
	while($myrow016=$result016->fetch_assoc()) {
		$found016=1;
		$ctrconsactv = $myrow016['ctrconsactv'];
	} // while
} // if

// qry expiring contracts within 15 or 30 days
$dateplus15d = date('Y-m-d', strtotime($datenow.' + 15 days'));
$dateplus30d = date('Y-m-d', strtotime($datenow.' + 30 days'));
$res017qry="";
$res017qry="SELECT count(*) AS ctrexpcontrct FROM tblprojassign WHERE (tblprojassign.durationto NOT LIKE '0000%' AND (tblprojassign.durationto BETWEEN '$datenow' AND '$dateplus15d')) OR (tblprojassign.durationto2 NOT LIKE '0000%' AND (tblprojassign.durationto2 BETWEEN '$datenow' AND '$dateplus15d'))";
$result017=""; $found017=0;
$result017=$dbh->query($res017qry);
if($result017->num_rows>0) {
	while($myrow017=$result017->fetch_assoc()) {
		$found017=1;
		$ctrexpcontrct = $myrow017['ctrexpcontrct'];
	} // while
} // if

// qry active projects
$res018qry="";
$res018qry="SELECT count(*) AS ctrprojactv FROM `tblproject1` WHERE `projstatus`='On-Going'";
$result018=""; $found018=0;
$result018=$dbh->query($res018qry);
if($result018->num_rows>0) {
	while($myrow018=$result018->fetch_assoc()) {
		$found018=1;
		$ctrprojactv = $myrow018['ctrprojactv'];
	} // while
} // if

// qry 2020 ecq days fr 2020-mar-17 due to covid-19
$ecq01covid19dtstart = new DateTime("2020-03-16");
$now = new DateTime("$datenow");
$ctrecq01covid19days = $now->diff($ecq01covid19dtstart)->format("%a");

// query tblscheduleremail for pkii health check
$datetimefrom=date('Y-m-d H:i:s', strtotime($datenow." 00:00:00"));
$datetimeto=date('Y-m-d H:i:s', strtotime($datenow." 23:59:59"));
    $res11qry=""; $result11=""; $found11=0;
	$res11qry="SELECT emlbody FROM tblscheduleremail WHERE emldatetime BETWEEN '$datetimefrom' AND '$datetimeto' AND emlsubject LIKE 'PKII Health Check - %'";
	$result11=$dbh->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$emlbody = $myrow11['emlbody'];
			// $emlbody = nl2br($emlbody);
		} // while
	} //if
?>
