<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$proj_code = (isset($_POST['proj_code'])) ? $_POST['proj_code'] :'';

$contract_title = trim((isset($_POST['contract_title'])) ? $_POST['contract_title'] :'');
$contract_number = trim((isset($_POST['contract_number'])) ? $_POST['contract_number'] :'');

$contract_type = (isset($_POST['contract_type'])) ? $_POST['contract_type'] :'';

$date_start = (isset($_POST['date_start'])) ? $_POST['date_start'] :'';
$date_end = (isset($_POST['date_end'])) ? $_POST['date_end'] :'';

$date_mob = (isset($_POST['date_mob'])) ? $_POST['date_mob'] :'';

$projcostdirect = (isset($_POST['projcostdirect'])) ? $_POST['projcostdirect'] :'';
$projcosttaxpct = (isset($_POST['projcosttaxpct'])) ? $_POST['projcosttaxpct'] :'';
$projcostremuneration = (isset($_POST['projcostremuneration'])) ? $_POST['projcostremuneration'] :'';
$totprojcost=$projcostdirect+(($projcostdirect*$projcosttaxpct)/100)+$projcostremuneration;

$recoupamt = (isset($_POST['recoupamt'])) ? $_POST['recoupamt'] :'';
$recouppct = (isset($_POST['recouppct'])) ? $_POST['recouppct'] :'';
if($recouppct!=0 && $recoupamt==0) { $recoupamtfin=($totprojcost*$recouppct)/100; } else { $recoupamtfin=$recoupamt; }

$clientsw = (isset($_POST['clientsw'])) ? $_POST['clientsw'] :'';
$client_companyid = (isset($_POST['client_companyid'])) ? $_POST['client_companyid'] :'';
$client_contactid = (isset($_POST['client_contactid'])) ? $_POST['client_contactid'] :'';
if($clientsw=='company') {
// get companyid
$client_companyid_fin=$client_companyid; $client_contactid_fin=0;
} else if($clientsw=='contactperson') {
// get contactid
$client_companyid_fin=0; $client_contactid_fin=$client_contactid;
} else {
$client_companyid_fin=0; $client_contactid_fin=0;
} // if-else

$fundingagencysw = (isset($_POST['fundingagencysw'])) ? $_POST['fundingagencysw'] :'';
$fundingagency_companyid = (isset($_POST['fundingagency_companyid'])) ? $_POST['fundingagency_companyid'] :'';
$fundingagency_contactid = (isset($_POST['fundingagency_contactid'])) ? $_POST['fundingagency_contactid'] :'';
if($fundingagencysw=='company') {
// get companyid
$fundingagency_companyid_fin=$fundingagency_companyid; $fundingagency_contactid_fin=0;
} else if($fundingagencysw=='contactperson') {
// get contactid
$fundingagency_companyid_fin=0; $fundingagency_contactid_fin=$fundingagency_contactid;
} else {
$fundingagency_companyid_fin=0; $fundingagency_contactid_fin=0;
} // if-else

$implementingagencysw = (isset($_POST['implementingagencysw'])) ? $_POST['implementingagencysw'] :'';
$implementingagency_companyid = (isset($_POST['implementingagency_companyid'])) ? $_POST['implementingagency_companyid'] :'';
$implementingagency_contactid = (isset($_POST['implementingagency_contactid'])) ? $_POST['implementingagency_contactid'] :'';
if($implementingagencysw=='company') {
// get companyid
$implementingagency_companyid_fin=$implementingagency_companyid; $implementingagency_contactid_fin=0;
} else if($implementingagencysw=='contactperson') {
// get contactid
$implementingagency_companyid_fin=0; $implementingagency_contactid_fin=$implementingagency_contactid;
} else {
$implementingagency_companyid_fin=0; $implementingagency_contactid_fin=0;
} // if-else

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($proj_code!='') {
	// query tblcontract if proj_code exists
	$res11query="SELECT contract_id FROM tblcontract WHERE fk_projcode='$proj_code'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$contract_id11=$myrow11['contract_id'];
		} // while
	} // if

	if($found11==1) {
	// halt
	echo "<h3 class='text-danger'>Sorry. Project code exists.</h3>";
	echo "<p><a href='projbilling.php?loginid=$loginid' class='btn btn-primary'>back</a></p>";
	} else {
	//proceed
	$res12query="INSERT INTO tblcontract SET timestamp='$now', loginid=$loginid, datecreated='$now', createdby=$loginid, contract_title='$contract_title', contract_num='$contract_number', contract_start='$date_start', contract_end='$date_end', contract_type='$contract_type', contract_totcost_balance=$totprojcost, contract_totcost_paid=0, contract_totcost_directcost=$projcostdirect, contract_totcost_tax=$projcosttaxpct, contract_totcost_remuneration=$projcostremuneration, contract_recoupment_pct=$recouppct, contract_recoupment_amt=$recoupamtfin, contract_recoupment_balance=$recoupamtfin, contract_filepath='', contract_filename='', contract_remarks='', fk_projcode='$proj_code'";
	$result12=$dbh2->query($res12query);
	// success screen
	echo "<h3><font color='green'>New contract added</font></h3>";
	echo "<p>$proj_code<br>$contract_title<br>$contract_type<br>$date_start -to- $date_end</p>";
	// log
	$logdetails="Add new contract in tblcontract. projcode:$proj_code title:$contract_title type:$contract_type duration:$date_start-to-$date_end";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	// header("Location: projbilling.php?loginid=$loginid");
	// exit;
	echo "<p><a href='projbilling.php?loginid=$loginid' class='btn btn-primary'>back</a></p>";
	} // if-else

} // if

// echo "<p>vartest f11:$found11, prjcd:$proj_code, title:$contract_title<br>res12qry:$res12query<br>logqry:$res16query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>