<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idadmctgmtgrm = trim((isset($_POST['idadmctgmtgrm'])) ? $_POST['idadmctgmtgrm'] :'');
if($idadmctgmtgrm!='') {
$code = trim((isset($_POST['code'])) ? $_POST['code'] :'');
$name = trim(addslashes((isset($_POST['name'])) ? $_POST['name'] :''));
$description = trim(addslashes((isset($_POST['description'])) ? $_POST['description'] :''));
$remarks = trim(addslashes((isset($_POST['remarks'])) ? $_POST['remarks'] :''));	
} //if

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($code!='' && $name!='') {
	// query tblprojctgservices if code exists
	$res11query="UPDATE tbladmctgmtgrm SET `name`=\"$name\", `description`=\"$description\", `remarks`=\"$remarks\" WHERE idadmctgmtgrm=$idadmctgmtgrm";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11!='') {
	// log
	$logdetails="Edit category in tbladmctgmtgrm. code:$code name:$name";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);		
	} //if
} // if

// echo "<p>vartest f11:$found11, cd:$code, nm:$name<br>res11qry:$res11query<br>";
// echo "<a href='mngadmmtgrmctg.php?loginid=$loginid'>back</a></p>";

	// redirect
	exit(header("Location: mngadmmtgrmctg.php?loginid=$loginid"));

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>