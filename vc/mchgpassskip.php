<?php
//
// mchgpassskip.php
// fr: vc/loginverify.php
//page 412

$loginid0 = (isset($_GET['lid'])) ? $_GET['lid'] :'';

    // proceed update query
		include '../m/qryupdsysusracctmgt2.php';

    if($result8!="") {

					// display success and logout button
	$clstxtclr="text-success";
	$h4txtdisp="Password changed reminder skipped by user.";
	$frmact="./index.php";
	$frmnm="login";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-success";
	$btnnm="Login";
	include 'vnotif.php';

    // log
		$logdetails="Password changed reminder skipped for user:$username with loginid:$loginid0";
		include '../m/qryinslog.php';

    } //if

// echo "<p>r8q: $res8query<br /></p>";


?>
