<?php

//
// mngschedmtgrmdel.php // 20200609
// fr mngschedulermtgrm.php

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$submswadmschedmtgdel = (isset($_POST['submswadmschedmtgdel'])) ? $_POST['submswadmschedmtgdel'] :'';
if($submswadmschedmtgdel=='submit') {
	$submmtgrmcdsw = (isset($_POST['submmtgrmcdsw'])) ? $_POST['submmtgrmcdsw'] :'';
	$mtgrmcodeid = (isset($_POST['mtgrmcdid'])) ? $_POST['mtgrmcdid'] :'';
	$idadmschedmtg = (isset($_POST['idadmschedmtg'])) ? $_POST['idadmschedmtg'] :'';
} //if
// echo "<p>vartst id:$loginid, sw:$submmtgrmadd2sw, mtgrmcdid:$mtgrmcdid, idctgmr:$idadmctgmtgrm</p>";
$found = 0;

if($loginid != "") {
     include("logincheck.php");
} //if

if($found == 1) {

if($submswadmschedmtgdel=='submit' && $idadmschedmtg!='') {
	// delete query
	$res11query="DELETE FROM tbladmmtgrm WHERE idadmmtgrm=$idadmschedmtg";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11!='') {
		$statustext="Successfully deleted meeting room scheduler record.";
	// log
	$logdetails="Deleted record in meeting room scheduler module. id:$idadmschedmtg";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	} else {
		$statustext = "Error in deleting record. Pls try again or contact IT system administrator.";
	} // if-else
} // if

echo "<p>$statustext</p>";

echo "<form action='mngschedulermtgrm.php?loginid=$loginid' method='POST' name='mngschedulermtgrm'>";
	echo "<input type='hidden' name='submmtgrmcdsw' value='$submmtgrmcdsw'>";
	echo "<input type='hidden' name='mtgrmcdid' value='$mtgrmcdid'>";
	// echo "<input type='hidden' name='submmtgrmaddsw' value='$submmtgrmaddsw'>";
	echo "<input type='hidden' name='idadmctgmtgrm' value='$mtgrmcodeid'>";
	// echo "<input type='hidden' name='submmtgrmadd2sw' value='$submmtgrmadd2sw'>";
echo "<p><button type='submit' class='btn btn-default' name='submmtgrmcdsw' value='$submmtgrmcdsw'>back</button></p>";
echo "</form>";
// echo "<p>vartest f11:$found11, cd:$code, nm:$name<br>res12qry:$res12query</p>";
	// redirect
	// exit(header("Location: mngschedulermtgrmctg.php?loginid=$loginid"));

} else {
     include ("logindeny.php");
}
// close db
$dbh2->close();
?>