<?php
//
// fr: ../views/loginverify.php
// ../m/qryupdtblsysacctmgt.php
// require("../includes/dbh.php");

    if($loginid0!=0) {
    // update tblsysusracctmgt.php pwchangedt to $now
    $res8query=""; $result8=""; $found8=0;
    $res8query="UPDATE tblsysusracctmgt SET pwchangedt=\"$now\" WHERE loginid=$loginid0 AND admloginid=0";
    $result8=$dbh->query($res8query);
    } //if
// var_dump($loginid0,$res8query);

// close db conn
// $dbh->close();
?>
