<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$code = trim((isset($_POST['code'])) ? $_POST['code'] :'');
$name = trim((isset($_POST['name'])) ? $_POST['name'] :'');
$seq = (isset($_POST['seq'])) ? $_POST['seq'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
//      include ("header.php");
//      include ("sidebar.php");

// start contents here...
  if($accesslevel >= 4) {

		// include '../m/qryselprojmilestone.sql';
		$res11query="SELECT idprojctgmilestone FROM tblprojctgmilestone WHERE code=\"$code\" OR name=\"$name\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11=1;
			$idprojctgmileston11 = $myrow11['idprojctgmilestone'];
			} // while
		} // if
		if($found11==1) {
		// halt
	echo "<h3 class='text-danger'>Sorry. Code or name existing.</h3>";
	echo "<p><a href='mngprojmilestone.php?loginid=$loginid' class='btn btn-primary'>back</a></p>";
		} else {
		// insert query
		$res12query="INSERT INTO tblprojctgmilestone SET timestamp='$now', loginid=$loginid, datecreated='$datenow', createdby=$loginid, code='$code', name='$name', seq='$seq', remarks=''";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
	// log
	$logdetails="Add new category in tblprojctgmilestone. code:$code name:$name seq:$seq";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	header("Location: mngprojmilestone.php?loginid=$loginid");
	exit;
		} // if

  } // if($accesslevel>=4)
// end contents here...


		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

//      include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?> 
