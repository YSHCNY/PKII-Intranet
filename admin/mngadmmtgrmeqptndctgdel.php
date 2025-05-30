<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idadmctgmtgrmeqptlst = (isset($_GET['idmrel'])) ? $_GET['idmrel'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($idadmctgmtgrmeqptlst!='') {
	// query tblprojctgservices if code exists
	$res11query="DELETE FROM tbladmctgmtgrmeqptlst WHERE idadmctgmtgrmeqptlst=$idadmctgmtgrmeqptlst";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11!='') {
	// log
	$logdetails="Deleted category item in tbladmctgmtgrmeqptlst with id:$idadmctgmtgrmeqptlst";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	} // if

} // if

// echo "<p>vartest f11:$found11, cd:$code, nm:$name<br>res12qry:$res12query</p>";
	// redirect
	exit(header("Location: mngadmmtgrmeqptndctg.php?loginid=$loginid"));

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
