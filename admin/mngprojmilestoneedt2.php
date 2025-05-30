<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idprojctgmilestone = (isset($_POST['idpms'])) ? $_POST['idpms'] :'';
$code = trim((isset($_POST['code'])) ? $_POST['code'] :'');
$name = trim((isset($_POST['name'])) ? $_POST['name'] :'');
$seq = (isset($_POST['seq'])) ? $_POST['seq'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($code!='') {
	// query tblprojctgmilestone if code exists
	$res11query="SELECT idprojctgmilestone FROM tblprojctgmilestone WHERE idprojctgmilestone='$idprojctgmilestone'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idprojctgmilestone11=$myrow11['idprojctgmilestone'];
		} // while
	} // if

	if($found11==1) {
	//proceed
	$res12query="UPDATE tblprojctgmilestone SET timestamp='$now', loginid=$loginid, code='$code', name='$name', seq='$seq' WHERE idprojctgmilestone=$idprojctgmilestone";
	$result12=$dbh2->query($res12query);
	// log
	$logdetails="Changed category in tblprojctgmilestone. id:$idprojctgmilestone code:$code name:$name seq:$seq";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	header("Location: mngprojmilestone.php?loginid=$loginid");
	exit;
	} else {
	// halt
	echo "<h3 class='text-danger'>Sorry. Missing id.</h3>";
	echo "<p><a href='mngprojmilestone.php?loginid=$loginid' class='btn btn-primary'>back</a></p>";
	} // if-else

} // if

// echo "<p>vartest f11:$found11, cd:$code, nm:$name<br>res12qry:$res12query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
