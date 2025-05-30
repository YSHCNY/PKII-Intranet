<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$code = trim(addslashes((isset($_POST['code'])) ? $_POST['code'] :''));
$name = trim(addslashes((isset($_POST['name'])) ? $_POST['name'] :''));
$description = trim(addslashes((isset($_POST['description'])) ? $_POST['description'] :''));
$remarks = trim(addslashes((isset($_POST['remarks'])) ? $_POST['remarks'] :''));

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($code!='' && $name!='') {
	// query tblprojctgservices if code exists
	$res11query="SELECT idadmctgmtgrm FROM tbladmctgmtgrm WHERE code='$code' OR name='$name'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idadmctgmtgrm11=$myrow11['id'];
		} // while
	} // if

	if($found11==1) {
	// halt
	echo "<h3 class='text-danger'>Sorry. Code or name exists.</h3>";
	echo "<p><a href='mngadmmtgrmctg.php?loginid=$loginid' class='btn btn-default'>back</a></p>";
	} else {
	//proceed
	$res12query="INSERT INTO tbladmctgmtgrm SET `timestamp`=\"$now\", `loginid`=$loginid, `code`=\"$code\", `name`=\"$name\", `description`=\"$description\", `remarks`=\"$remarks\"";
	$result12=$dbh2->query($res12query);
	// log
	$logdetails="Add new category in tbladmctgmtgrm. code:$code name:$name";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	exit(header("Location: mngadmmtgrmctg.php?loginid=$loginid"));
	} // if-else

} // if

// echo "<p>vartest f11:$found11, cd:$code, nm:$name<br>res12qry:$res12query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
