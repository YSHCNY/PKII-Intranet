<?php
//
// fr: ../vc/mchgpassskip.php
// ../m/qryupdtblsysacctmgt2.php

require("../includes/dbh.php");

if($loginid0!=0) {

    // query tblsysusracctmgt
    $res7query=""; $result7=""; $found7=0;
    $res7query="SELECT idtblsysusracctmgt, employeeid, skippwctr FROM tblsysusracctmgt WHERE loginid=$loginid0 AND admloginid=0 LIMIT 1";
    $result7=$dbh->query($res7query);
    if($result7->num_rows>0) {
        while($myrow7=$result7->fetch_assoc()) {
        $found7=1;
        $idtblsysusracctmgt7 = $myrow7['idtblsysusracctmgt'];
        $employeeid7 = $myrow7['employeeid'];
        $skippwctr7 = $myrow7['skippwctr'];
        } //while
    } //if
    if($found7==1) {
    $skippwctr = $skippwctr7 + 1;
    } else {
    $skippwctr=1;
    } //if

    // update tblsysusracctmgt.php pwchangedt to $now+30d
    $pwskipdt = date('Y-m-d', strtotime('+1 month', strtotime($now)));
    $res8query=""; $result8=""; $found8=0;
    $res8query="UPDATE tblsysusracctmgt SET timestamp=\"$now\", skippwctr=$skippwctr, skiplastdt=\"$pwskipdt\" WHERE loginid=$loginid0 AND admloginid=0";
    $result8=$dbh->query($res8query);

    if($result8!="") {
    // also extend skiplastdt field for admin login, check first if user has admin login before proceeding
    $res9query=""; $result9=""; $found9=0;
    $res9query="SELECT idtblsysusracctmgt, employeeid, skippwctr FROM tblsysusracctmgt WHERE loginid=$loginid0 AND admloginid=0 LIMIT 1";
    $result9=$dbh->query($res9query);
    if($result9->num_rows>0) {
        while($myrow9=$result9->fetch_assoc()) {
        $found9=1;
        $idtblsysusracctmgt9 = $myrow9['idtblsysusracctmgt'];
        $employeeid9 = $myrow9['employeeid'];
        $skippwctr9 = $myrow9['skippwctr'];
        } //while
    } //if
    if($found9==1) {
    $skippwctradm = $skippwctr9 + 1;
    } else {
    $skippwctradm = 1;
    } //if-else

    if($found9==1 && $employeeid9!='') {
    $res10query=""; $result10=""; $found10=0;
    $res10query="SELECT idtblsysusracctmgt, admloginid, skiplastdt FROM tblsysusracctmgt WHERE employeeid=\"$employeeid9\" AND loginid=0 LIMIT 1";
    $result10=$dbh->query($res10query);
    if($result10->num_rows>0) {
        while($myrow10=$result10->fetch_assoc()) {
        $found10=1;
        $idtblsysusracctmgt10 = $myrow10['idtblsysusracctmgt'];
        $admloginid10 = $myrow10['admloginid'];
        $skiplastdt10 = $myrow10['skiplastdt'];
        } //while
    } //if
    } //ifif($found9==1 && $employeeid9!='')

    if($found10==1 && $admloginid10!=0) {
    $res11query=""; $result11=""; $found11=0;
    $res11query="UPDATE tblsysusracctmgt SET timestamp=\"$now\", skippwctr=$skippwctradm, skiplastdt=\"$pwskipdt\" WHERE loginid=0 AND admloginid=$admloginid10 AND employeeid=\"$employeeid9\"";
    $result11=$dbh->query($res11query);
    } //if

    } //if($result8!="")

} //if($loginid0!=0)
// var_dump($loginid0,$res8query);

// close db conn
// $dbh->close();
?>
