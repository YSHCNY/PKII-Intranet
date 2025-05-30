<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$code = trim((isset($_POST['code'])) ? $_POST['code'] :'');
$name = trim((isset($_POST['name'])) ? $_POST['name'] :'');

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($code!='') {
	// query tblprojctgservices if code exists
	$res11query="SELECT idprojctgservices FROM tblprojctgservices WHERE code='$code'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idprojctgservices11=$myrow11['idprojctgservices'];
		} // while
	} // if

	if($found11==1) {
	// halt
	echo "<h3 class='text-danger'>Sorry. Code exists.</h3>";
	echo "<p><a href='mngprojctgsvcs.php?loginid=$loginid' class='btn btn-primary'>back</a></p>";
	} else {
	//proceed
	$res12query="INSERT INTO tblprojctgservices SET timestamp='$now', loginid=$loginid, code='$code', name='$name'";
	$result12=$dbh2->query($res12query);
	// log
	$logdetails="Add new category in tblprojctgservices. code:$code name:$name";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	header("Location: mngprojctgsvcs.php?loginid=$loginid");
	exit;
	} // if-else

} // if

// echo "<p>vartest f11:$found11, cd:$code, nm:$name<br>res12qry:$res12query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
