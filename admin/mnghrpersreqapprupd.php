<?php 

require("db1.php");
include('datetimenow.php');

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$endorsedempid = (isset($_POST['endorsedempid'])) ? $_POST['endorsedempid'] :'';
$recoappricgempid = (isset($_POST['recoappricgempid'])) ? $_POST['recoappricgempid'] :'';
$recoapprdcgempid = (isset($_POST['recoapprdcgempid'])) ? $_POST['recoapprdcgempid'] :'';
$approveempid = (isset($_POST['approveempid'])) ? $_POST['approveempid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Manage >> HR Modules >> Update personnel requisition form approvers</font></p>";

	$res11query="SELECT idhrpersreqapprctg FROM tblhrpersreqctg WHERE idhrpersreqapprctg<>'' ORDER BY idhrpersreqapprctg ASC LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$idhrpersreqapprctg11 = $myrow11['idhrpersreqapprctg'];
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	if($found11==1) {
		// update query
		$res12query="UPDATE tblhrpersreqctg SET timestamp=\"$now\", loginid=$loginid, endorsedempid=\"$endorsedempid\", recoappricgempid=\"$recoappricgempid\", recoapprdcgempid=\"$recoapprdcgempid\", approveempid=\"$approveempid\" WHERE idhrpersreqapprctg=$idhrpersreqapprctg11";
		$result12="";
		$result12=$dbh2->query($res12query);

	} else if($found11==0) {
		// insert query
		$res12query="INSERT INTO tblhrpersreqctg SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, endorsedempid=\"$endorsedempid\", recoappricgempid=\"$recoappricgempid\", recoapprdcgempid=\"$recoapprdcgempid\", approveempid=\"$approveempid\"";
		$result12="";
		$result12=$dbh2->query($res12query);

	} // if($found11==1)

	echo "<p><h2><font color=green>Updated!</font></h2></p>";
	echo "<p>found: $found11<br>";
	echo "Endorsed by: $endorsedempid<br>";
	echo "Recommending approval for ICG: $recoappricgempid<br>";
	echo "Recommending approval for DCG: $recoapprdcgempid<br>";
	echo "Approved by: $approveempid</p>";

	// create log
    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16="";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16=$result16->fetch_assoc())
		} // if($result16->num_rows>0)
    $adminlogdetails = "$loginid:$adminloginuid - Update category for personnel requisition form approvers with details: endorsed:$endorsedempid, reco_approve_icg:$recoappricgempid, reco_approve_dcg:$recoapprdcgempid, approved:$approveempid";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
		$result17=$dbh2->query($res17query);


  echo "<p><a href=\"mnghrmod.php?loginid=$loginid\">back to manage HR categories</a></p>";

  $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
