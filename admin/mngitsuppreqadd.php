<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$itsrcd = (isset($_POST['itsrcd'])) ? trim($_POST['itsrcd']) :'';
$itsrname = (isset($_POST['itsrname'])) ? trim($_POST['itsrname']) :'';
$itsrtype = (isset($_POST['itsrtype'])) ? trim($_POST['itsrtype']) :'';

$found = 0;

if($loginid != "") {

     include("logincheck.php");

}

if ($found == 1) {

	if(($itsrcd != "") && ($itsrname != "")) {

	// check first if dept code or dept name exists
	$res12query = "SELECT idtblctgsuppreq, code, name, ctgtype FROM tbldeptcd WHERE code=\"$itsrcd\" OR name=\"$itsrname\"";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$idtblctgsuppreq12 = $myrow12['idtblctgsuppreq'];
		$code12 = $myrow12['code'];
		$name12 = $myrow12['name'];
		$ctgtype12 = $myrow12['ctgtype'];
		} // while($myrow12 = $result12->fetch_assoc())
	} // if($result12->num_rows>0)

	if($found12 == 1) {

	// display dept code or name exists warning and display back hyperlink
	echo "<html>";
	echo "<p><font color=\"red\">sorry support request code or name exists. pls try again.</font></p>";
	echo "<p><a href=\"mngitsuppreq.php?loginid=$loginid\">back</a></p>";
	echo "</html>";

	} else {

	// insert records to tbldeptcd
	$res14query = "INSERT INTO tblitctgsuppreq SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, code=\"$itsrcd\", name=\"$itsrname\", ctgtype=\"$itsrtype\"";
	$result14 = $dbh2->query($res14query);

	// create log
    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid = $myrow16['adminuid'];
			} // while($myrow16 = $result16->fetch_assoc())
		} // if($result16->num_rows>0)
    
    $adminlogdetails = "$loginid:$adminuid - Add new IT support request category item in Manage Categories > IT Support Request $itsrcd:$itsrname type:$itsrtype";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect back
  header("Location: mngitsuppreq.php?loginid=$loginid");
  exit;

	} // if($found12 == 1)

	} else {

	echo "<html>";
	// display warning or error
	echo "<p><font color=\"red\">Sorry IT support request code or support request name should not be blank</font></p>";
	// display back button or hyperlink
	echo "<p><a href=\"mngitsuppreq.php?loginid=$loginid\">back</a></p>";
	echo "</html>";

	} // if(($itsrcd != "") && ($itsrname != ""))

} else {

     include ("logindeny.php");

}

$dbh2->close();
?> 
