<?php
//
// itadmsuppreqchgdtclstck.php 20221125
// fr itadmsuppreqdtl.php
//
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsupportreq = (isset($_GET['its'])) ? $_GET['its'] :'';

$newclosestamp = (isset($_POST['newclosestamp'])) ? $_POST['newclosestamp'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

    $res11query=""; $result11=""; $found11=0;
    $res11query="SELECT tblitsupportreq.closestamp FROM tblitsupportreq WHERE tblitsupportreq.iditsupportreq=$iditsupportreq";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $closestamp11 = $myrow11['closestamp'];
        } //while
    } //if

    if($found11==1) {
        $res12query=""; $result12=""; $found12=0;
        $res12query="UPDATE tblitsupportreq SET closestamp=\"$newclosestamp\" WHERE iditsupportreq=$iditsupportreq";
        $result12=$dbh2->query($res12query);
    } //if

    if($result12) {
	// log
	$logdetails="modify datetime stamp of Closed IT Support request with id:$iditsupportreq from:$closestamp11 to:$newclosestamp";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
    } //if

	// redirect
	header("Location: itadmsuppreqdtl.php?loginid=$loginid&its=$iditsupportreq");
	exit;

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>