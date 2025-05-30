<?php
// projbillcontredt2.php fr projbillcontredt.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$contract_id = (isset($_POST['contractid'])) ? $_POST['contractid'] :'';
$proj_code = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($proj_code!='' && $contract_id!='') {

	// query tblcontract if proj_code exists
	$res11query="SELECT contract_filepath, contract_filename FROM tblcontract WHERE fk_projcode='$proj_code' AND contract_id=$contract_id";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$contract_filepath11 = $myrow11['contract_filepath'];
		$contract_filename11 = $myrow11['contract_filename'];
		} // while
	} // if

	if($found11==1) {

	// query tblcontractinvoice
	$res12query="SELECT contractinvoice_id, contractinvoice_filepath, contractinvoice_filename FROM tblcontractinvoice WHERE fk_contract_id=$contract_id";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$found12=1;
		$ctr12=$ctr12+1;
		$contractinvoice_id12 = $myrow12['contractinvoice_id'];
		$contractinvoice_filepath12 = $myrow12['contractinvoice_filepath'];
		$contractinvoice_filename12 = $myrow12['contractinvoice_filename'];
		// delete file attachment from tblcontractinvoice
		if($contractinvoice_filename12!='') {
			$filetodelete1 = "$contractinvoice_filepath12/$contractinvoice_filename12";
 	  	unlink("$filetodelete1");
		} // if
		// delete from tblcontractinvoice
		$res14query="DELETE FROM tblcontractinvoice WHERE contractinvoice_id=$contractinvoice_id12 AND fk_contract_id=$contract_id";
		$result14="";
		$result14=$dbh2->query($res14query);
		} // while
	} // if

	// delete file attachment from tblcontract
	if($contract_filename11!='') {
			$filetodelete = "$contract_filepath11/$contract_filename11";
 	  	unlink("$filetodelete");
	} // if
	// delete from tblcontract
	$res15query="DELETE FROM tblcontract WHERE contract_id=$contract_id AND fk_projcode='$proj_code'";
	$result15="";
	$result15=$dbh2->query($res15query);

	// log
	$logdetails="Deleted contract with id:$contract_id projcode:$proj_code including its invoices";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);

	} // if

	// redirect
	header("Location: projbilling.php?loginid=$loginid");
	exit;

} // if

// echo "<p>vartest f11:$found11, prjcd:$proj_code, title:$contract_title<br>res12qry:$res12query<br>logqry:$res16query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
