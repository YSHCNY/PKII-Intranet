<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$code = $_POST['code'];
$name = $_POST['name'];

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

	// foreach and update query
	foreach($_POST['code'] as $key1 => $code) {
		// $name = implode(', ', $_POST['name']);
		// echo "<p>vartest key1:$key1 key2s:";
		foreach($_POST['name'] as $key2 => $name) {
			if($key2==$key1) {
			$namefin=$name;
			// echo "$key2:$namefin<br>";
		// query tblhrpersreqstepsctg
		$res11query="SELECT idhrpersreqstepsctg FROM tblhrpersreqstepsctg WHERE code=\"$code\" ORDER BY idhrpersreqstepsctg ASC LIMIT 1";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$idhrpersreqstepsctg11 = $myrow11['idhrpersreqstepsctg'];
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)
		// echo "qry11:$req11query<br>";
			} // if($item2==$item1)
		} // foreach($_POST['name'] as $name => $item2)

		// if exists, update query, else create query
		if($found11==1) {
			$res12query="UPDATE tblhrpersreqstepsctg SET timestamp=\"$now\", loginid=$loginid, name=\"$namefin\" WHERE idhrpersreqstepsctg=\"$idhrpersreqstepsctg11\" AND code=\"$code\"";
			$result12=""; $found12=0;
			$result12=$dbh2->query($res12query);
		} else if($found11==0) {
			$res12query="INSERT INTO tblhrpersreqstepsctg SET timestamp=\"$now\", loginid=$loginid, code=\"$code\", name=\"$namefin\"";
			$result12=""; $found12=0;
			$result12=$dbh2->query($res12query);
		} // if($found11==1)
		// echo "<br>code:$code, f11:$found11, name:$namefin, id:$idhrpersreqstepsctg<br>qry12:$res12query</p>";
		// reset variable
		$namefin="";
	} // foreach($_POST['code'] as $code)

		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16 = $result16->fetch_assoc())
		} // if($result16->num_rows>0)
		$adminlogdetails = "$loginid:$adminuid - updated HRD personnel recruitment steps category";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect
	header("Location: mnghrpersreqsteps.php?loginid=$loginid");
	exit;

} else {
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?>
