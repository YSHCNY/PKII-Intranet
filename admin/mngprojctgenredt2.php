<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idprojctgenr = (isset($_POST['idpce'])) ? $_POST['idpce'] :'';
$code = trim((isset($_POST['code'])) ? $_POST['code'] :'');
$name_e = trim((isset($_POST['name_e'])) ? $_POST['name_e'] :'');
$name_j = trim((isset($_POST['name_j'])) ? $_POST['name_j'] :'');
$seq = (isset($_POST['seq'])) ? $_POST['seq'] :'';
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($code!='') {
	// query tblprojctgmilestone if code exists
	$res11query="SELECT idprojctgenr FROM tblprojctgenr WHERE idprojctgenr='$idprojctgenr'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idprojctgenr11=$myrow11['idprojctgenr'];
		} // while
	} // if

	if($found11==1) {
	//proceed
	$res12query="UPDATE tblprojctgenr SET timestamp='$now', loginid=$loginid, code='$code', name_e='$name_e', name_j='$name_j', seq='$seq', remarks='$remarks' WHERE idprojctgenr=$idprojctgenr";
	$result12=$dbh2->query($res12query);
	// log
	$logdetails="Modified Proj ENR category in tblprojctgenr. id:$idprojctgenr code:$code name_e:$name name_j:$name_j seq:$seq";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	header("Location: mngprojenrctg.php?loginid=$loginid");
	exit;
	} else {
	// halt
	echo "<h3 class='text-danger'>Sorry. Missing id.</h3>";
	echo "<p><a href='mngprojenrctg.php?loginid=$loginid' class='btn btn-primary'>back</a></p>";
	} // if-else

} // if

// echo "<p>vartest f11:$found11, cd:$code, nm:$name<br>res12qry:$res12query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>