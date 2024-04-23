<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$code = trim((isset($_POST['code'])) ? $_POST['code'] :'');
$name = trim((isset($_POST['name'])) ? $_POST['name'] :'');
$seq = (isset($_POST['seq'])) ? $_POST['seq'] :'';
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

// start contents here

	// check first if code exists
	$res11query="SELECT idprojctgpkii FROM tblprojctgpkii WHERE code=\"$code\" LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idprojctgpkii11=$myrow11['idprojctgpkii'];
		} // while
	} // if

	if($found11==1) {

		// warn record exists
		echo "<h4><font color=\"red\">Sorry, code exists on record. Pls try again.</font></h4>";
		echo "<p><a href=\"mngprojctgpkiiadd.php?loginid=$loginid\">back</a></p>";

	} else if($found11==0) {

		// continue
  $res12query="INSERT INTO tblprojctgpkii SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, code=\"$code\", name=\"$name\", seq=$seq, remarks=\"$remarks\"";
	$result12=$dbh2->query($res12query);

// create log
    // include('datetimenow.php');
    $res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid LIMIT 1";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$adminuid=$myrows16['adminuid'];
			} // while
		} // if
    $adminlogdetails = "$loginid:$adminuid - Add new item on PKII Projects Category table with code:$code, name:$name, seq:$seq, remarks:$remarks";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);

	} // if

	// echo "<p>test f11:$found11, qry:$res12query</p>";

	// redirect
  header("Location: mngprojctgpkii.php?loginid=$loginid");
  exit;

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result=$dbh2->query($resquery);

//     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
