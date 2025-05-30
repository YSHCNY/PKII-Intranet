<?php
// emppaybongrpdel.php 20241216
// fr emppaybongrpadd.php

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';
$btnGrpnmDel = (isset($_POST['btnGrpnmDel'])) ? $_POST['btnGrpnmDel'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     // include ("header.php");
     // include ("sidebar.php");

     // echo "<p><font size=1>Modules >> Personnel Bonus Notifier >> Create group</font></p>";

if($groupname!='' && $btnGrpnmDel==1) {
// echo "<p>vartest id:$loginid, grp:$groupname, btn:$btnGrpnmDel</p>";
	// query tblemppaybongrp
	$res11query=""; $result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT emppaybongrpid, employeeid, groupname, datecreated, status FROM tblemppaybongrp WHERE groupname=\"$groupname\"";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1; $ctr11++;
			$emppaybongrpid11 = $myrow11['emppaybongrpid'];
			$employeeid11 = $myrow11['employeeid'];
			// $groupname11 = $myrow11['groupname'];
			$datecreated11 = $myrow11['datecreated'];
			$status11 = $myrow11['status'];
			
			$res11bquery=""; $result11b=""; $found11b=0;
			$res11bquery="DELETE FROM tblemppaybongrp WHERE groupname=\"$groupname\" AND emppaybongrpid=$emppaybongrpid11 AND employeeid=\"$employeeid11\"";
			$result11b=$dbh2->query($res11bquery);
			
	// query tblemppaybontotal
	$res12query=""; $result12=""; $found12=0; $ctr12=0;
	$res12query="SELECT emppaybontotalid, groupname, datecreated, totnetamt FROM tblemppaybontotal WHERE groupname=\"$groupname\"";
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
			$found12=1; $ctr12++;
			$tblemppaybontotalid12 = $myrow12['tblemppaybontotalid'];
			// $groupname12 = $myrow12['groupname'];
			$datecreated12 = $myrow12['datecreated'];
			$totnetamt12 = $myrow12['totnetamt'];
			
			$res12bquery=""; $result12b=""; $found12b=0;
			$res12bquery="DELETE FROM tblemppaybontotal WHERE groupname=\"$groupname\" AND emppaybontotalid=$tblemppaybontotalid12";
			$result12b=$dbh2->query($res12bquery);
			
		} //while
	} //if
	
	// query tblemppaybonus
	$res14query=""; $result14=""; $found14=0; $ctr14=0;
	$res14query="SELECT emppaybonusid, employeeid, groupname, date, netamt FROM tblemppaybonus WHERE groupname=\"$groupname\"";
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
			$found14=1; $ctr14++;
			$emppaybonusid14 = $myrow14['emppaybonusid'];
			$employeeid14 = $myrow14['employeeid'];
			// $groupname14 = $myrow14['groupname'];
			$date14 = $myrow14['date'];
			$netamt14 = $myrow14['netamt'];
			
			$res14bquery=""; $result14b=""; $found14b=0;
			$res14bquery="DELETE FROM tblemppaybonus WHERE groupname=\"$groupname\" AND emppaybonusid=$emppaybonusid14 AND employeeid=\"$employeeid14\"";
			$result14b=$dbh2->query($res14bquery);
			
		} //while
	} //if
	
		} //while
	} //if
	
	if($found11==1) {
	// insert logs
	$adminlogdetails = "$loginid:$username - deleted $groupname on Special Pay Notifier module with $ctr11 records on tblemppaybongrp, $totnetamt12 net amount on tblemppaybontotal, $ctr14 recs on tblemppaybonus";
	$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17=""; $found17=0;
	// $result17=$dbh2->query($res17query);
	} //if
	// echo "<p>$res11query<br>$res11bquery<br>$res12query<br>$res12bquery<br>$res14query<br>$res14bquery<br>$res17query</p>";
	
} //if

    // Redirect back to itadmsuppreq.php with notification
    header("Location: emppaybongrpadd.php?loginid=$loginid");
    exit();
	// echo "<p><a href=\"emppaybongrpadd.php?loginid=$loginid\">back</a></p>";
	
     // include ("footer.php");
} else {
     include ("logindeny.php");
}

// close database;
$dbh2->close();
?>