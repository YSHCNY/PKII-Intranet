<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$groupnamefin = (isset($_GET['gn'])) ? $_GET['gn'] :'';

$confiempid = (isset($_POST['confiempid'])) ? $_POST['confiempid'] :'';

$datecreated = date("Y-m-d");

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

	if(($groupnamefin != "") && ($confiempid != "")) {
	// query tblconfipaygrp
	$res11query="SELECT DISTINCT datecreated, accesslevel FROM tblconfipaygrp WHERE groupname=\"$groupnamefin\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$datecreated11 = $myrow11['datecreated'];
		$confiaccesslevel11 = $myrow11['accesslevel'];
		} // while
	} // if

	// prep encryption if level 5
	$employeeid=$confiempid;
	include("mcryptenc.php");

	// check first if employeeid exists from tblemppaybongrp
	$res12query="SELECT confipaygrpid FROM tblconfipaygrp WHERE employeeid=\"$employeeid\" AND groupname=\"$groupnamefin\" LIMIT 1";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$found12=1;
		$confipaygrpid12 = $myrow12['confipaygrpid'];
		} // while
	} // if

	if($found12 == 1) {

	// display empid exists warning and display back hyperlink
	echo "<html>";
	echo "<h2><font color=\"red\">sorry employeeid exists. pls try again.</font></h3>";
	echo "<p><a href=\"confipay2.php?loginid=$loginid&gn=$groupnamefin\">back</a></p>";
	echo "</html>";

	} else {

	// include("mcryptenc.php");

	// insert record to tblconfipaygrp
	$res14query="INSERT INTO tblconfipaygrp SET timestamp=\"$now\", loginid=$loginid, employeeid=\"$employeeid\", groupname=\"$groupnamefin\", datecreated=\"$datecreated11\", accesslevel=$confiaccesslevel11, status=\"active\"";
	$result14=$dbh2->query($res14query);

	// insert record to tblconfipaymeminfo
	$res15query="";
	// $result15=$dbh2->query($res15query);

	// include("mcryptdec.php");

	// create log
    $res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$adminuid=$myrow16['adminuid'];
		} // while
		} // if
    $adminlogdetails = "$loginid: Additional record EmpID:$confiempid inserted for Custom/Confi Pay group:$groupnamefin";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);

	// redirect back to emppayboninfo1.php
 // header("Location: emppayboninfo1.php?loginid=$loginid&groupname=$groupname");
 // exit;
	echo "<h3><font color=\"green\">Record added.</font></h3>";
	echo "<p>eid:$confiempid|$employeeid gn:$groupnamefin</p>";
	// echo "<p>tst res11qry:$res11query<br>res12qry:$res12query<br>res14qry:$res14query<br>res17qry:$res17query</p>";
	echo "<p><a href=\"confipay2.php?loginid=$loginid&gn=$groupnamefin\">back</a></p>";

	}

	} else {
	echo "<html>";
	// display warning or error
	echo "<p><font color=\"red\">Sorry no groupname selected or employeeid already on group</font></p>";
	// display back button or hyperlink
	echo "<p><a href=\"confipay2.php?loginid=$loginid&gn=$groupnamefin\">back</a></p>";
	echo "</html>";
	} // if

} else {
     include ("logindeny.php");
}

mysql_close($dbh); 
$dbh2->close();
?> 
