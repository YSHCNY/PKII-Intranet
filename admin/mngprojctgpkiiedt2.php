<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idprojctgpkii = (isset($_POST['idprojctgpkii'])) ? $_POST['idprojctgpkii'] :'';
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

	if($idprojctgpkii!='') {

		// continue
  $res12query="UPDATE tblprojctgpkii SET timestamp=\"$now\", loginid=$loginid, code=\"$code\", name=\"$name\", seq=$seq, remarks=\"$remarks\" WHERE idprojctgpkii=$idprojctgpkii";
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
    $adminlogdetails = "$loginid:$adminuid - Modify item on PKII Projects Category table with id:$idprojctgpkii, code:$code, name:$name, seq:$seq, remarks:$remarks";
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