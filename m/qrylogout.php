<?php
//
// fr: ../views/loginverify.php
// ../models/qrylogin2.php
include '../includes/dbh.php';

	// set user var for tblloginstatus
	$logintype=1; // 1:non-admin, 2:admin
	$disabled=0; // 0:enabled, 1:disabled
	$loginstatus=0; // 0:logged-out, 1:logged-in
	$session="";

	// query tbllogin
	$res1query="UPDATE tbllogin SET time_logout=\"$now\", login_status=$loginstatus WHERE loginid=$loginid";
	$result1=$dbh->query($res1query);
	
	$res1aquery="";
	$res1aquery="INSERT INTO tbllogs SET timestamp=\"$now\", loginid=$loginid, username=\"$username0\", time_logout=\"$now\", logdetails=\"$logdetails\"";
	$result1a=$dbh->query($res1aquery);

	// update tblloginstatus
	$res2query="UPDATE tblloginstatus SET session=\"$session\", status=$loginstatus WHERE idloginstatus=$idloginstatus AND loginid=$loginid";
	$result2=$dbh->query($res2query);

    //20221011 update tblsysusracctmgt
    $res3query=""; $result3="";
    $res3query="UPDATE tblsysusracctmgt SET timestamp=\"$now\", logoutstamp=\"$now\" WHERE loginid=$loginid AND employeeid=\"$employeeid0\" AND admloginid=0";
    $result3=$dbh->query($res3query);



	// session_start();
	// session_destroy();
	header('location: ../vc/index.php?logged=out');
	// exit();
// close db conn
$dbh->close();
?>
