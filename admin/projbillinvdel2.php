<?php
// projbillinvdel2.php fr projbillinvdel.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$contract_id = (isset($_POST['contractid'])) ? $_POST['contractid'] :'';
$proj_code = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';
$contractinvoice_id = (isset($_POST['contractinvoiceid'])) ? $_POST['contractinvoiceid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($contractinvoice_id!='' && $contract_id!='') {

	// query tblcontract if proj_code exists
	$res11query="SELECT contractinvoice_num, contractinvoice_filepath, contractinvoice_filename FROM tblcontractinvoice WHERE contractinvoice_id=$contractinvoice_id AND fk_contract_id=$contract_id";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$contractinvoice_num11 = $myrow11['contractinvoice_num'];
		$contract_filepath11 = $myrow11['contract_filepath'];
		$contract_filename11 = $myrow11['contract_filename'];
		} // while
	} // if

	if($found11==1) {

		// delete file attachment from tblcontractinvoice
		if($contractinvoice_filename11!='') {
			$filetodelete1 = "$contractinvoice_filepath12/$contractinvoice_filename12";
 	  	unlink("$filetodelete1");
		} // if

		// delete query
		$res14query="DELETE FROM tblcontractinvoice WHERE contractinvoice_id=$contractinvoice_id AND fk_contract_id=$contract_id";
		$result14="";
		$result14=$dbh2->query($res14query);

	// log
	$logdetails="Deleted invoice with id:$contractinvoice_id invoice no.:$contractinvoice_num11 from contractid:$contract_id and projcode:$proj_code";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);

	} // if

	// redirect
	header("Location: projbilldtls.php?loginid=$loginid&cid=$contract_id&prjcd=$proj_code");
	exit;

} // if

// echo "<p>vartest f11:$found11, prjcd:$proj_code, title:$contract_title<br>res12qry:$res12query<br>logqry:$res16query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
