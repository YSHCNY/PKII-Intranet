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
    $res11query=""; $result11=""; $found11=0; $attempt=5; $attemptstamp="$now";
    $res11query="UPDATE tblsysusracctmgt SET timestamp=\"$now\", attempt=$attempt, attemptstamp=\"$attemptstamp\"  WHERE idtblsysusracctmgt=$idtblsysusracctmgt";
    $result11=$dbh2->query($res11query);

    //log reset
    if($result11) {
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
      $adminlogdetails = "$loginid: Disable admin user:$adminuid16, pwretr:$attempt, idtblsysusracctmgt:$idtblsysusracctmgt";
      $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid15\", adminlogdetails=\"$adminlogdetails\"";
			$result17="";
			$result17=$dbh2->query($res17query);
    } //if

    //redirect
    header('Location: ./mngadmuseredit.php?loginid='.$loginid.'&admid='.$adminloginid.'');
    // echo "<p>$res11query</p>";
    // echo "<p><a href=\"mngadmuseredit.php?loginid=$loginid&admid=$adminloginid\">back</a></p>";

$dbh2->close();
?>
