<?php
// 
// hrtimeattcutrestor.php
// fr hrtimeattcutoffadd.php
// 20200205

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtapaygrp = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idhrtacutoff = (isset($_GET['idct'])) ? $_GET['idct'] :'';

  // echo "<p>vartest idpg:$idhrtapaygrp, idct:$idhrtacutoff</p>";

$found = 0;

if($loginid != "") {
    include("logincheck.php");
}

if($found == 1) {

    if(($idhrtacutoff!=0 || $idhrtacutoff!='') && ($idhrtapaygrp!=0 || $idhrtapaygrp!='')) {
	// set status=1
	$res11qry=""; $result11=""; $found11=0;
	$res11qry="UPDATE tblhrtacutoff SET status=1 WHERE idhrtacutoff=$idhrtacutoff AND idhrtapaygrp=$idhrtapaygrp";
	$result11=$dbh2->query($res11qry);
	
	// insert log
	$adminlogdetails = "$loginid:$adminuid - restore cutoff and set active=1 for HR time & attendance system paygroupid:$idhrtapaygrp, idcutoff:$idhrtacutoff";
	$res17qry="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17=$dbh2->query($res17qry);
    } // if

  // echo "<p>vartest r11q:$res11qry<br>r17q:$res17qry</p>";
    // redirect
	header("Location: hrtimeattcutoff.php?loginid=$loginid&idpg=$idhrtapaygrp");
	exit;

  
} else {
    include ("logindeny.php");
} // if-else

$dbh2->close();
?>