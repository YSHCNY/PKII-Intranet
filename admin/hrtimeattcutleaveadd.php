<?php 
// 20180908 hrtimeattcutleaveadd.php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$leavedate = (isset($_POST['leavedate'])) ? $_POST['leavedate'] :'';
$idleavectg = (isset($_POST['idleavectg'])) ? $_POST['idleavectg'] :'';
$leavedur = (isset($_POST['leavedur'])) ? $_POST['leavedur'] :'';
$reason = (isset($_POST['reason'])) ? $_POST['reason'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

// start contents here

	// query paygroup, cutoff and empid if exists
	$res14query="SELECT * FROM tblhrtapaygrp INNER JOIN tblhrtacutoff ON tblhrtapaygrp.idtblhrtapaygrp=tblhrtacutoff.idhrtapaygrp INNER JOIN tblhrtapaygrpemplst ON tblhrtacutoff.idhrtapaygrp=tblhrtapaygrpemplst.idtblhrtapaygrp WHERE tblhrtapaygrp.idtblhrtapaygrp=$idpaygroup AND tblhrtacutoff.idhrtacutoff=$idcutoff AND tblhrtapaygrpemplst.employeeid=\"$employeeid\" LIMIT 1";
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		} // while
	} // if

	// start deletion
if($found14==1) {

	// query paygroupname
	$res11query="SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idpaygroup";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$paygroupname11 = $myrow11['paygroupname'];
		} // while
	} // if

	// query leavename
	$res14query="SELECT name FROM tblhrtaleavectg WHERE idhrtaleavectg=$idleavectg";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		$name14 = $myrow14['name'];
		} // while
	} // if

	// delete from tblconfipaygrp
	$res12query="INSERT INTO tblhrtaempleavechglog SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", leavedate=\"$leavedate\", leavename=\"$name14\", leaveduration=\"$leavedur\", reason=\"$reason\", idhrtaleavectg=$idleavectg, idhrtacutoff=$idcutoff";
	$result12=$dbh2->query($res12query);

	// create log
    // include('datetimenow.php');
    $res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid LIMIT 1";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$adminuid=$myrows16['adminuid'];
			} // while
		} // if
    $adminlogdetails = "$loginid:$adminuid HR-TAL: Add leave entry empid: , paygrp: , cutoff: , leavedt: , leavetyp: , leavedur: ";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);

} // if

	// redirect
  header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
  exit;
	// echo "<p><a href=\"hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid\">back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result=$dbh2->query($resquery);

//     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
