<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idprojctgmilestone = (isset($_GET['idpms'])) ? $_GET['idpms'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($idprojctgmilestone!='') {
	// query tblprojctgservices if code exists
	$res11query="SELECT code, name, seq FROM tblprojctgmilestone WHERE idprojctgmilestone='$idprojctgmilestone'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		// $idprojctgservices11=$myrow11['idprojctgservices'];
		$code11=$myrow11['code'];
		$name11=$myrow11['name'];
		$seq11=$myrow11['seq'];
		} // while
	} // if

	if($found11==1) {
	//proceed
	$res12query="DELETE FROM tblprojctgmilestone WHERE idprojctgmilestone=$idprojctgmilestone";
	$result12=$dbh2->query($res12query);
	// log
	$logdetails="Deleted a category in tblprojctgmilestone. id:$idprojctgmilestone code:$code11 name:$name11 seq:$seq11";
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
