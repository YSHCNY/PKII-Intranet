<?php
//
// from hrpersreqdtl2.php
//

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpersreq = (isset($_GET['idhpr'])) ? $_GET['idhpr'] :'';
$idhrpersreqcand = (isset($_POST['idhrpersreqcand'])) ? $_POST['idhrpersreqcand'] :'';
$stepcode = (isset($_POST['stepcd'])) ? $_POST['stepcd'] :'';
$sfinlabel = (isset($_POST['steplabel'])) ? $_POST['steplabel'] :'';
$sfinstatusval = (isset($_POST['stepstatusval'])) ? $_POST['stepstatusval'] :'';

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

// start contents here

	if($sfinstatusval==1) {

	// query name based on loginid and empid
	$res10query="SELECT tblcontact.name_last, tblcontact.name_first FROM tbladminlogin LEFT JOIN tblcontact ON tbladminlogin.employeeid=tblcontact.employeeid WHERE tbladminlogin.adminloginid=$loginid LIMIT 1";
	$result10=""; $found10=0; $ctr10=0;
	$result10 = $dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10 = $result10->fetch_assoc()) {
		$found10 = 1;
		$ctr10 = $ctr10 + 1;
		$name_last10 = $myrow10['name_last'];
		$name_first10 = $myrow10['name_first'];
		} // while$myrow10 = $result10->fetch_assoc())
	} // if($result10->num_rows>0)

	// prep variable
	$sfinstamplbl=strtolower($stepcode."stamp");
	// prep query
	$res11query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, $sfinlabel=$sfinstatusval, $sfinstamplbl=\"$now\" WHERE idhrpersreqcand=$idhrpersreqcand";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);

	// echo "<p>res11query:$res11query</p>";

		// prepare and log		
		$logdetails = "$loginid:$username - Marked as Completed step: $sfinlabel of HR Personnel request recruitment for candidate $idhrpersreqcand-$name_last11, $name_first11 $name_middle11[0] for id:$idhrpersreq";
		$res17query = "INSERT INTO tbllogs SET timestamp=\"$now\", loginid=$loginid, username=\"$username\", logdetails=\"$logdetails\"";
		$result17 = $dbh2->query($res17query);
		// echo "<br>$res17query</p>";

	} // if($sfinstatusval==1)

	// redirect
	header("Location: hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq");
	exit;

	// echo "<p><a href=\"hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq\">back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
