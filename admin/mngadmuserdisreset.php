<?php
//
// 20221021 mngadmuserdisreset.php
// fr mngadmuseredit.php

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$adminloginid = (isset($_GET['admlid'])) ? $_GET['admlid'] :'';
$idtblsysusracctmgt = (isset($_GET['idsuam'])) ? $_GET['idsuam'] :'';

    //update query if idsuam exists
    $res11query=""; $result11=""; $found11=0; $attempt=0; $attemptstamp="NULL";
    $res11query="UPDATE tblsysusracctmgt SET timestamp=\"$now\", attempt=$attempt, attemptstamp=$attemptstamp  WHERE idtblsysusracctmgt=$idtblsysusracctmgt";
    $result11=$dbh2->query($res11query);

    //update query for tblloginstatus for admin
    $res12query=""; $result12=""; $found12=0; $logintype=2; $status=1; $disabled=0;
    $res12query="UPDATE tblloginstatus SET disabled=$disabled, status=$status WHERE loginid=$adminloginid AND logintype=$logintype";
    $result12=$dbh2->query($res12query);

    //chk non-admin loginid of user if exists and reset
    $res14query=""; $result14=""; $found14=0;
    $res14query="SELECT employeeid FROM tblsysusracctmgt WHERE admloginid=$adminloginid LIMIT 1";
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
        while($myrow14=$result14->fetch_assoc()) {
        $found14=1;
        $employeeid14=$myrow14['employeeid'];
        } //while
    } //if
    if($found14==1) {
        $res15query=""; $result15=""; $found15=0;
        $res15query="SELECT loginid FROM tblsysusracctmgt WHERE employeeid=\"$employeeid14\" AND admloginid=0 LIMIT 1";
        $result15=$dbh2->query($res15query);
        if($result15->num_rows>0) {
            while($myrow15=$result15->fetch_assoc()) {
            $found15=1;
            $loginid15=$myrow15['loginid'];
            } //while
        } //if
        if($found15==1) {
    //update query for tblloginstatus for non-admin
    $res16query=""; $result16=""; $found16=0; $logintype=1; $status=1; $disabled=0;
    $res16query="UPDATE tblloginstatus SET disabled=$disabled, status=$status WHERE loginid=$loginid15 AND logintype=$logintype";
    $result16=$dbh2->query($res16query);
	// 20240603 remove word:disabled on col:remarks_login fr:tblloginstatus
	$res16bquery=""; $result16b="";
	$res16bquery="UPDATE tbllogin SET remarks_login=\"\" WHERE loginid=$loginid15 AND employeeid=\"$employeeid14\"";
	$result16b=$dbh2->query($res16bquery);
        } //if
    } //if

    //log reset
    if($result11 && $result12) {
      // create log 
        //get username of logged-in user
        $res15query=""; $result15=""; $found15=0;
        $res15query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
        $result15=$dbh2->query($res15query);
        if($result15->num_rows>0) {
            while($myrow15=$result15->fetch_assoc()) {
            $found15=1;
            $adminuid15 = $myrow15['adminuid'];
            } //while
        } //if
      // get username of subject
      $res16query=""; $result16=""; $found16=1;
      $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$adminloginid";
			$result16=""; $found16=0;
			$result16=$dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16=$result16->fetch_assoc()) {
				$found16=1;
				$adminuid16=$myrow16['adminuid'];
				} // 
			} // 
      $adminlogdetails = "$loginid:$adminuid15 Reset user:$adminuid16, pwretr:0, idtblsysusracctmgt:$idtblsysusracctmgt, status:$status, disabled:$disabled";
      $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid15\", adminlogdetails=\"$adminlogdetails\"";
			$result17="";
			$result17=$dbh2->query($res17query);
    } //if

    //redirect
    header('Location: ./mngadmuseredit.php?loginid='.$loginid.'&admid='.$adminloginid.'');
    exit;
    // echo "<p>$res11query<br>$res12query<br>$found14|$res14query<br>$found15|$res15query<br>$res16query</p>";
    // echo "<p><a href=\"mngadmuseredit.php?loginid=$loginid&admid=$adminloginid\">back</a></p>";

$dbh2->close();
?>
