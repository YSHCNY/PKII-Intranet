<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsr = (isset($_GET['itsr'])) ? $_GET['itsr'] :'';

$found = 0;

if($loginid != "") {

     include("logincheck.php");

}

if ($found == 1) {

	// check first if dept code or dept name exists
	$res12query = "SELECT code, name, ctgtype FROM tblitctgsuppreq WHERE idtblctgsuppreq=$iditsr";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$code12 = $myrow12['code'];
		$name12 = $myrow12['name'];
		$ctgtype12 = $myrow12['ctgtype'];
		} // while($myrow12 = $result12->fetch_assoc())
	} // if($result12->num_rows>0)

	if($found12 == 1) {

	// insert records to tbldeptcd
	$res14query = "DELETE FROM tblitctgsuppreq WHERE idtblctgsuppreq=$iditsr";
	$result14 = $dbh2->query($res14query);

	// create log
    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid = $myrow16['adminuid'];
			} // while($myrow16 = $result16->fetch_assoc())
		} // if($result16->num_rows>0)
    
    $adminlogdetails = "$loginid:$adminuid - Deleted an item in IT support request category $iditsr:$itsrcd:$itsrname";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect back
  header("Location: mngitsuppreq.php?loginid=$loginid");
  exit;

	} // if($found12 == 1)

} else {

     include ("logindeny.php");

}

$dbh2->close();
?> 
