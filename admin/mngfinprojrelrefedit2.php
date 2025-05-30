<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$projrelrefid = (isset($_GET['prrid'])) ? $_GET['prrid'] :'';

$code = (isset($_POST['code'])) ? $_POST['code'] :'';
// $name = $_POST['name'];
$companytyp = (isset($_POST['companytyp'])) ? $_POST['companytyp'] :'';
$companyid = (isset($_POST['companyid'])) ? $_POST['companyid'] :'';
$company = (isset($_POST['company'])) ? $_POST['company'] :'';
$tablevel = (isset($_POST['tablevel'])) ? $_POST['tablevel'] :'';
$seq = (isset($_POST['seq'])) ? $_POST['seq'] :'';
$nkconso = (isset($_POST['nkconso'])) ? $_POST['nkconso'] :'';
$codeprev = (isset($_POST['codeprev'])) ? $_POST['codeprev'] :'';
$strvssht = (isset($_POST['strvssht'])) ? $_POST['strvssht'] :'';
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

// start contents here

if($companytyp=='dropdown') {
	// query tblcompany
	$res14query="SELECT company FROM tblcompany WHERE companyid=$companyid";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		$companyname=$myrow14['company'];
		} // while
	} // if
} else if($companytyp=='manual') {
	$companyid=0; $companyname=$company;
} // if

  $res12query="UPDATE tblprojrelref SET timestamp=\"$now\", loginid=$loginid, code=\"$code\", name=\"$companyname\", companyid=$companyid, level=$tablevel, seq=$seq, nkconso=$nkconso, codeprev=\"$codeprev\", strvssht=\"$strvssht\", remarks=\"$remarks\" WHERE projrelrefid=$projrelrefid";
	$result12=$dbh2->query($res12query);

echo "<p>typ:$companytyp, qry:$res12query</p>";

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
    $adminlogdetails = "$loginid:$adminuid - Project relationship item EDITED with id:$projrelrefid, details: $code - $name, compid:$companyid, level:$tablevel, seq:$seq, nkconso:$nkconso, codeprev:$codeprev, strvssht:$strvssht, remarks:$remarks";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);

  header("Location: mngfinprojrelref.php?loginid=$loginid");
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
