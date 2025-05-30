<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpersreq = (isset($_GET['idhpr'])) ? $_GET['idhpr'] :'';

$name_last = trim((isset($_POST['name_last'])) ? $_POST['name_last'] :'');
$name_first = trim((isset($_POST['name_first'])) ? $_POST['name_first'] :'');
$name_middle = trim((isset($_POST['name_middle'])) ? $_POST['name_middle'] :'');
$gender = trim((isset($_POST['gender'])) ? $_POST['gender'] :'');

$contact_type = "applicant";

// echo "<p>vartest name $name_last, $name_first $name_middle</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

	// query tblcontact if exists
	$res11query="SELECT contactid, name_last, name_first FROM tblcontact WHERE name_last=\"$name_last\" AND name_first=\"$name_first\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$contactid11 = $myrow11['contactid'];
		$name_last11 = $myrow11['name_last'];
		$name_first11 = $myrow11['name_first'];
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	if($found11==1) {

		echo "<p><h2><font color=\"red\">Sorry, last_name:$name_last11 and first_name:$name_first11 already on record. id:$contactid11</font></h2></p>";
		echo "<p><a href=\"hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq\">back</a></p>";

	} else {
		// continue

	// insert or update query for tblcontact
	$res12query="INSERT INTO tblcontact SET loginid=0, companyid=0, employeeid='', name_last=\"$name_last\", name_first=\"$name_first\", name_middle=\"$name_middle\", contact_gender=\"$gender\", contact_type=\"$contact_type\"";
	$result12=""; $found12=0;
	$result12=$dbh2->query($res12query);
	// get contactid after insert
	$lastid=mysqli_insert_id($dbh2);

	// insert query for tblhrpersreqcand
	$res14query="INSERT INTO tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, contactid=$lastid, idhrpersreq=$idhrpersreq";
	$result14=""; $found14=0;
	$result14=$dbh2->query($res14query);

	// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16 = $result16->fetch_assoc())
		} // if($result16->num_rows>0)
		$adminlogdetails = "$loginid:$adminuid - add new candidate in HR personnel recruitment with id:$idhrpersreq name:$name_last, $name_first $name_middle";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// echo "<p>$res11query<br>$res12query<br>$res14query</p>";

	// redirect
	header("Location: hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq");
	exit;

	} // if($found11==1)

} else {
     include ("logindeny.php");
}
$dbh2->close();
?>
