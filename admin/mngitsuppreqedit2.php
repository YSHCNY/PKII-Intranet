<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsr = (isset($_GET['itsr'])) ? $_GET['itsr'] :'';

$itsrcd = (isset($_POST['itsrcd'])) ? trim($_POST['itsrcd']) :'';
$itsrname = (isset($_POST['itsrname'])) ? trim($_POST['itsrname']) :'';
$itsrtype = (isset($_POST['itsrtype'])) ? trim($_POST['itsrtype']) :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

	if(($itsrcd == "") || ($itsrname == "")) {

	// display dept code or name exists warning and display back hyperlink
	echo "<html>";
	echo "<p><font color=\"red\">sorry support request code or name should not be blank. pls try again.</font></p>";
	echo "<p><a href=\"mngitsuppreq.php?loginid=$loginid\">back</a></p>";
	echo "</html>";

	} else {

	// insert records to tbldeptcd
	$res14query = "UPDATE tblitctgsuppreq SET timestamp=\"$now\", loginid=$loginid, code=\"$itsrcd\", name=\"$itsrname\", ctgtype=\"$itsrtype\" WHERE idtblctgsuppreq=$iditsr";
	$result14 = $dbh2->query($res14query);

	// create log
    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid = $myrow16['adminuid'];
			} // while($myrow16 = $result16->fetch_assoc())
		} // if($result16->num_rows>0)
    
    $adminlogdetails = "$loginid:$adminuid - Modified IT support request category item in Manage Categories > IT Support Request $itsrcd:$itsrname type:$itsrtype";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect back
  header("Location: mngitsuppreq.php?loginid=$loginid");
  exit;

	} // if(($itsrcd != "") && ($itsrname != ""))

} else {

     include ("logindeny.php");

}

$dbh2->close();
?> 
