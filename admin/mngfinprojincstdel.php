<?php
//
// fn:mngfinprojincstdel.php
// fr:mngfinprojincst.php
//

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idprojincstcdctg = (isset($_GET['pisid'])) ? $_GET['pisid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($idprojincstcdctg!="") {
	// query tblfinprojincstcdctg if id exists
	$res11query=""; $result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT idprojincstcdctg FROM tblfinprojincstcdctg WHERE idprojincstcdctg=$idprojincstcdctg";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idprojincstcdctg11=$myrow11['idprojincstcdctg'];
		} // while
	} // if

	if($found11==1) {
	// proceed
	$res12query="DELETE FROM tblfinprojincstcdctg WHERE idprojincstcdctg=$idprojincstcdctg";
	$result12=$dbh2->query($res12query);
	// log
	$logdetails="Deleted code category in tblfinprojincstcdctg for code categ of Project Income Statement with id:$idprojincstcdctg";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	header("Location: mngfinprojincst.php?loginid=$loginid");
	exit;
	} else {
	// do not proceed
	echo "<h3 class='text-danger'>Sorry. Cannot find record id. Pls try again.</h3>";
	echo "<p><a href='mngfinprojincst.php?loginid=$loginid' class='btn btn-secondary'>back</a></p>";
	} // if-else

} // if

// echo "<p>vartest f11:$found11 r11qry: $res11query<br>r12qry: $res12query<br>r16qry: $res16query</p>";
// echo "<p><a href=\"./mngfinstfinpos.php?loginid=$loginid\">back</a></p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
