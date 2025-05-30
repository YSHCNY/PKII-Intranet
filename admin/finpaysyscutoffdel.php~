<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idemppaycutoff = (isset($_GET['idpc'])) ? $_GET['idpc'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

// start contents here

	if($idemppaycutoff!='') {

		// query tblemppaycutoff
	$res11query="SELECT paygroupname, cutstart, cutend, idhrtacutoff, idhrtapaygrp FROM tblemppaycutoff WHERE idemppaycutoff=$idemppaycutoff";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$paygroupname11 = $myrow11['paygroupname'];
		$cutstart11 = $myrow11['cutstart'];
		$cutend11 = $myrow11['cutend'];
		$idhrtacutoff11 = $myrow11['idhrtacutoff'];
		$idhrtapaygrp11 = $myrow11['idhrtapaygrp'];
		} // while
	} // if

		// query tblhrtaempleavechglog and update tblhrtaempleavesumm
	$res14query="SELECT tblhrtaempleavechglog.employeeid, tblhrtaempleavechglog.leaveduration, tblhrtaempleavechglog.idhrtaleavectg, tblhrtaleavectg.code, tblhrtaleavectg.name FROM tblhrtaempleavechglog INNER JOIN tblhrtaleavectg ON tblhrtaempleavechglog.idhrtaleavectg=tblhrtaleavectg.idhrtaleavectg WHERE tblhrtaempleavechglogidemppaycutoff=$idemppaycutoff";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		$ctr14=$ctr14+1;
		$employeeid14 = $myrow14['employeeid'];
		$leaveduration14 = $myrow14['leaveduration'];
		$idhrtaleavectg14 = $myrow14['idhrtaleavectg'];
		$leavecd14 = $myrow14['code'];
		$leavenm14 = $myrow14['name'];
		// query tblhrtaempleavesumm
		$res15query="SELECT idhrtaempleavesumm, dateanniv, vlbal, slbal, splbal, paterbal, maternbal, matercbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid14\" AND idpaygroup=$idhrtapaygrp11";
		$result15=""; $found15=0; $ctr15=0;
		$result15=$dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15=1;
			$ctr15=$ctr15+1;
			$idhrtaempleavesumm15 = $myrow15['idhrtaempleavesumm'];
			$dateanniv15 = $myrow15['dateanniv'];
			$vlbal15 = $myrow15['vlbal'];
			$slbal15 = $myrow15['slbal'];
			$splbal15 = $myrow15['splbal'];
			$paterbal15 = $myrow15['paterbal'];
			$maternbal15 = $myrow15['maternbal'];
			$matercbal15 = $myrow15['matercbal'];

			} // while
		} // if
		} // while
	} // if

		// delete record from tblemppaycutoff
  $res12query="DELETE FROM tblemppaycutoff WHERE idemppaycutoff=$idemppaycutoff";
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
    $adminlogdetails = "$loginid:$adminuid - Deleted processed payroll cutoff with id:$idemppaycutoff paygrpnm:$paygroupname11 cutoff:$cutstart11-to-$cutend11";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);

	} // if

	// echo "<p>test f11:$found11, qry:$res12query</p>";

	// redirect
  header("Location: finpaysyscompute.php?loginid=$loginid");
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
