<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$contract_id = (isset($_POST['contract_id'])) ? $_POST['contract_id'] :'';
$contract_totcost = (isset($_POST['contract_totcost'])) ? $_POST['contract_totcost'] :'';
$refno = trim((isset($_POST['refno'])) ? $_POST['refno'] :'');

$periodcov_start = (isset($_POST['periodcov_start'])) ? $_POST['periodcov_start'] :'';
$periodcov_end = (isset($_POST['periodcov_end'])) ? $_POST['periodcov_end'] :'';
if(strtotime($periodcov_end)>=strtotime($periodcov_start)) {
	$periodcovstartfin=$periodcov_start;
	$periodcovendfin=$periodcov_end;
} else {
	$periodcovstartfin=$periodcov_start;
	$periodcovendfin=$periodcov_start;
} // if-else

$contractinvoice_num = trim((isset($_POST['contractinvoice_num'])) ? $_POST['contractinvoice_num'] :'');
$contractinvoice_milestone = trim((isset($_POST['contractinvoice_milestone'])) ? $_POST['contractinvoice_milestone'] :'');
$contractinvoice_plan_inv_date = (isset($_POST['contractinvoice_plan_inv_date'])) ? $_POST['contractinvoice_plan_inv_date'] :'';

// PLANNED
$invplanchksw = (isset($_POST['invplanchksw'])) ? $_POST['invplanchksw'] :'';
$contractinvoice_plan_inv_amt = (isset($_POST['contractinvoice_plan_inv_amt'])) ? $_POST['contractinvoice_plan_inv_amt'] :'';
$contractinvoice_plan_inv_pct = (isset($_POST['contractinvoice_plan_inv_pct'])) ? $_POST['contractinvoice_plan_inv_pct'] :'';
if($contractinvoice_plan_inv_pct=='') { $contractinvoice_plan_inv_pct=0; } //20221122
$planinvamtfin=0; $planinvpctfin=0;
/* if($invplanchksw=='amount') {
	$planinvamtfin=$contractinvoice_plan_inv_amt;
	if($contractinvoice_plan_inv_pct!=0) { $planinvpctfin=$contractinvoice_plan_inv_pct; } else { $planinvpctfin=0; }
} else if($invplanchksw=='percent') {
	$planinvamtfin=$contract_totcost*($contractinvoice_plan_inv_pct/100);
	$planinvpctfin=$contractinvoice_plan_inv_pct;
} // if-else
if($planinvamtfin=='') { $planinvamtfin=0; }
$planinvamtfin=sprintf('%0.2f', $planinvamtfin);
if($planinvpctfin=='') { $planinvpctfin=0; }
$planinvpctfin=sprintf('%0.1f', $planinvpctfin); */
$planinvamtfin=$contractinvoice_plan_inv_amt;
$planinvpctfin=$contractinvoice_plan_inv_pct;

$invvatplanchksw = (isset($_POST['invvatplanchksw'])) ? $_POST['invvatplanchksw'] :'';
$contractinvoice_plan_vat_pct = (isset($_POST['contractinvoice_plan_vat_pct'])) ? $_POST['contractinvoice_plan_vat_pct'] :'';
$contractinvoice_plan_vat_amt = (isset($_POST['contractinvoice_plan_vat_amt'])) ? $_POST['contractinvoice_plan_vat_amt'] :'';
if($contractinvoice_plan_vat_pct=='') { $contractinvoice_plan_vat_pct=0; } //20221122
/* $planvatamtfin=0; $planvatpctfin=0;
if($invvatplanchksw=='amount') {
	$planvatamtfin=$contractinvoice_plan_vat_amt;
	if($contractinvoice_plan_vat_pct!=0) { $planvatpctfin=$contractinvoice_plan_vat_pct; } else { $planvatpctfin=0; }
} else if($invvatplanchksw=='percent') {
	$planvatamtfin=$planinvamtfin*($contractinvoice_plan_vat_pct/100);
	$planvatpctfin=$contractinvoice_plan_vat_pct;
} // if-else
if($planvatamtfin=='') { $planvatamtfin=0; }
$planvatamtfin=sprintf('%0.2f', $planvatamtfin);
if($planvatpctfin=='') { $planvatpctfin=0; }
$planvatpctfin=sprintf('%0.1f', $planvatpctfin); */
$planvatamtfin=$contractinvoice_plan_vat_amt;
$planvatpctfin=$contractinvoice_plan_vat_pct;

$contractinvoice_plan_subm_date = (isset($_POST['contractinvoice_plan_subm_date'])) ? $_POST['contractinvoice_plan_subm_date'] :'';

// ACTUAL
$contractinvoice_actl_inv_date = (isset($_POST['contractinvoice_actl_inv_date'])) ? $_POST['contractinvoice_actl_inv_date'] :'';

$invactlchksw = (isset($_POST['invactlchksw'])) ? $_POST['invactlchksw'] :'';
$contractinvoice_actl_inv_amt = (isset($_POST['contractinvoice_actl_inv_amt'])) ? $_POST['contractinvoice_actl_inv_amt'] :'';
$contractinvoice_actl_inv_pct = (isset($_POST['contractinvoice_actl_inv_pct'])) ? $_POST['contractinvoice_actl_inv_pct'] :'';
if($contractinvoice_actl_inv_pct=='') { $contractinvoice_actl_inv_pct=0; } //20221122
/* $actlinvamtfin=0; $actlinvpctfin=0;
if($invactlchksw=='amount') {
	$actlinvamtfin=$contractinvoice_actl_inv_amt;
	if($contractinvoice_actl_inv_pct!=0) { $actlinvpctfin=$contractinvoice_actl_inv_pct; } else { $actlinvpctfin=0; } 
} else if($invactlchksw=='percent') {
	$actlinvpctfin=$contractinvoice_actl_inv_pct;
	if($contractinvoice_actl_inv_amt!=0) { $actlinvamtfin=$contractinvoice_actl_inv_amt; } else { $actlinvamtfin=$contract_totcost*($contractinvoice_actl_inv_pct/100); }
} // if-else
if($actlinvamtfin=='') { $actlinvamtfin=0; }
$actlinvamtfin=sprintf('%0.2f', $actlinvamtfin);
if($actlinvpctfin=='') { $actlinvpctfin=0; }
$actlinvpctfin=sprintf('%0.1f', $actlinvpctfin); */
$actlinvamtfin=$contractinvoice_actl_inv_amt;
$actlinvpctfin=$contractinvoice_actl_inv_pct;

$invvatactlchksw = (isset($_POST['invvatactlchksw'])) ? $_POST['invvatactlchksw'] :'';
$contractinvoice_actl_vat_pct = (isset($_POST['contractinvoice_actl_vat_pct'])) ? $_POST['contractinvoice_actl_vat_pct'] :'';
$contractinvoice_actl_vat_amt = (isset($_POST['contractinvoice_actl_vat_amt'])) ? $_POST['contractinvoice_actl_vat_amt'] :'';
if($contractinvoice_actl_vat_pct=='') { $contractinvoice_actl_vat_pct=0; } //20221122
/* $actlvatamtfin=0; $actlvatpctfin=0;
if($invvatactlchksw=='amount') {
	$actlvatamtfin=$contractinvoice_actl_vat_amt;
	if($contractinvoice_actl_vat_pct!=0) { $actlvatpctfin=$contractinvoice_actl_vat_pct; } else { $actlvatpctfin=0; }
} else if($invvatactlchksw=='percent') {
	$actlvatamtfin=$actlinvamtfin*($contractinvoice_actl_vat_pct/100);
	$actlvatpctfin=$contractinvoice_actl_vat_pct;
} // if-else
if($actlvatamtfin=='') { $actlvatamtfin=0; }
$actlvatamtfin=sprintf('%0.2f', $actlvatamtfin);
if($actlvatpctfin=='') { $actlvatpctfin=0; }
$actlvatpctfin=sprintf('%0.1f', $actlvatpctfin); */
$actlvatamtfin=$contractinvoice_actl_vat_amt;
$actlvatpctfin=$contractinvoice_actl_vat_pct;

$contractinvoice_actl_subm_date = (isset($_POST['contractinvoice_actl_subm_date'])) ? $_POST['contractinvoice_actl_subm_date'] :'';

// REVISED
$contractinvoice_revised_inv_date = (isset($_POST['contractinvoice_revised_inv_date'])) ? $_POST['contractinvoice_revised_inv_date'] :'';

$invrevchksw = (isset($_POST['invrevchksw'])) ? $_POST['invrevchksw'] :'';
$contractinvoice_revised_inv_amt = (isset($_POST['contractinvoice_revised_inv_amt'])) ? $_POST['contractinvoice_revised_inv_amt'] :'';
$contractinvoice_revised_inv_pct = (isset($_POST['contractinvoice_revised_inv_pct'])) ? $_POST['contractinvoice_revised_inv_pct'] :'';
if($contractinvoice_revised_inv_pct=='') { $contractinvoice_revised_inv_pct=0; } //20221122
/* $revinvamtfin=0; $revinvpctfin=0;
if($invrevchksw=='amount') {
	$revinvamtfin=$contractinvoice_revised_inv_amt;
	if($contractinvoice_revised_inv_pct!=0) { $revinvpctfin=$contractinvoice_revised_inv_pct; } else { $revinvpctfin=0; } 
} else if($invrevchksw=='percent') {
	$revinvpctfin=$contractinvoice_revised_inv_pct;
	if($contractinvoice_revised_inv_amt!=0) { $revinvamtfin=$contractinvoice_revised_inv_amt; } else { $revinvamtfin=$contract_totcost*($contractinvoice_revised_inv_pct/100); }
} // if-else
if($revinvamtfin=='') { $revinvamtfin=0; }
$revinvamtfin=sprintf('%0.2f', $revinvamtfin);
if($revinvpctfin=='') { $revinvpctfin=0; }
$revinvpctfin=sprintf('%0.1f', $revinvpctfin); */
$revinvamtfin=$contractinvoice_revised_inv_amt;
$revinvpctfin=$contractinvoice_revised_inv_pct;

$invvatrevchksw = (isset($_POST['invvatrevchksw'])) ? $_POST['invvatrevchksw'] :'';
$contractinvoice_revised_vat_pct = (isset($_POST['contractinvoice_revised_vat_pct'])) ? $_POST['contractinvoice_revised_vat_pct'] :'';
$contractinvoice_revised_vat_amt = (isset($_POST['contractinvoice_revised_vat_amt'])) ? $_POST['contractinvoice_revised_vat_amt'] :'';
if($contractinvoice_revised_vat_pct=='') { $contractinvoice_revised_vat_pct=0; }
/* $revvatamtfin=0; $revvatpctfin=0;
if($invvatrevchksw=='amount') {
	$revvatamtfin=$contractinvoice_revised_vat_amt;
	if($contractinvoice_revised_vat_pct!=0) { $revvatpctfin=$contractinvoice_revised_vat_pct; } else { $revvatpctfin=0; }
} else if($invvatrevchksw=='percent') {
	$revvatamtfin=$revinvamtfin*($contractinvoice_revised_vat_pct/100);
	$revvatpctfin=$contractinvoice_revised_vat_pct;
} // if-else
if($revvatamtfin=='') { $revvatamtfin=0; }
$revvatamtfin=sprintf('%0.2f', $revvatamtfin);
if($revvatpctfin=='') { $revvatpctfin=0; }
$revvatpctfin=sprintf('%0.1f', $revvatpctfin); */
$revvatamtfin=$contractinvoice_revised_vat_amt;
$revvatpctfin=$contractinvoice_revised_vat_pct;

$contractinvoice_revised_subm_date = (isset($_POST['contractinvoice_revised_subm_date'])) ? $_POST['contractinvoice_revised_subm_date'] :'';

// 20221122
$contractinvoice_plan_reimb_amt = (isset($_POST['contractinvoice_plan_reimb_amt'])) ? $_POST['contractinvoice_plan_reimb_amt'] :'';
$contractinvoice_actl_reimb_amt = (isset($_POST['contractinvoice_actl_reimb_amt'])) ? $_POST['contractinvoice_actl_reimb_amt'] :'';
$contractinvoice_revised_reimb_amt = (isset($_POST['contractinvoice_revised_reimb_amt'])) ? $_POST['contractinvoice_revised_reimb_amt'] :'';
if($contractinvoice_plan_reimb_amt=='') { $contractinvoice_plan_reimb_amt=0; }
if($contractinvoice_actl_reimb_amt=='') { $contractinvoice_actl_reimb_amt=0; }
if($contractinvoice_revised_reimb_amt=='') { $contractinvoice_revised_reimb_amt=0; }

$date0 = '0000-00-00 00:00:00';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($contract_id!='') {
	// query tblcontractinvoice if invoicenumber exists
	$res11query="SELECT contractinvoice_id FROM tblcontractinvoice WHERE contractinvoice_num='$contractinvoice_num'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$contractinvoice_id11=$myrow11['contractinvoice_id'];
		} // while
	} // if

	if($found11==1) {
	// halt
	echo "<h3 class='text-danger'>Sorry. Invoice number exists.</h3>";
	echo "<p><button onclick=\"history.go(-1);\">Back </button></p>";
	} else {
	// query tblcontract
	$res14query="SELECT contract_start, contract_end, contract_totcost_balance, contract_totcost_paid, contract_totcost_directcost, contract_totcost_tax, contract_totcost_remuneration, contract_recoupment_pct, contract_recoupment_amt, contract_recoupment_balance, fk_projcode FROM tblcontract WHERE contract_id=$contract_id LIMIT 1";
	$result14=""; $found14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		$contract_start14 = $myrow14['contract_start'];
		$contract_end14 = $myrow14['contract_end'];
		$contract_totcost_balance14 = $myrow14['contract_totcost_balance'];
		$contract_totcost_paid14 = $myrow14['contract_totcost_paid'];
		$contract_totcost_directcost14 = $myrow14['contract_totcost_directcost'];
		$contract_totcost_tax14 = $myrow14['contract_totcost_tax'];
		$contract_totcost_remuneration14 = $myrow14['contract_totcost_remuneration'];
		$contract_recoupment_pct14 = $myrow14['contract_recoupment_pct'];
		$contract_recoupment_amt14 = $myrow14['contract_recoupment_amt'];
		$contract_recoupment_balance14 = $myrow14['contract_recoupment_balance'];
		$proj_code14 = $myrow14['fk_projcode'];
		} // while
	} // if
	if($found14==1) {
	//proceed
	$res12query="INSERT INTO tblcontractinvoice SET timestamp='$now', loginid=$loginid, datecreated='$now', createdby=$loginid, contractinvoice_num='$contractinvoice_num', contractinvoice_refnum='$refno', contractinvoice_milestone='$contractinvoice_milestone', contractinvoice_periodcov_start='$periodcovstartfin', contractinvoice_periodcov_end='$periodcovendfin', contractinvoice_percent=0, contractinvoice_recoup_pct=$contract_recoupment_pct14, contractinvoice_recoup_amt=$contract_recoupment_amt14, contractinvoice_plan_inv_date='$contractinvoice_plan_inv_date', contractinvoice_plan_inv_amt=$planinvamtfin, contractinvoice_plan_inv_pct=$planinvpctfin, contractinvoice_plan_vat_pct=$planvatpctfin, contractinvoice_plan_vat_amt=$planvatamtfin, contractinvoice_plan_subm_date='$contractinvoice_plan_subm_date', contractinvoice_actl_inv_date='$contractinvoice_actl_inv_date', contractinvoice_actl_inv_amt=$actlinvamtfin, contractinvoice_actl_inv_pct=$actlinvpctfin, contractinvoice_actl_vat_pct=$actlvatpctfin, contractinvoice_actl_vat_amt=$actlvatamtfin, contractinvoice_actl_subm_date='$contractinvoice_actl_subm_date', contractinvoice_revised_inv_date='$contractinvoice_revised_inv_date', contractinvoice_revised_inv_amt=$revinvamtfin, contractinvoice_revised_inv_pct=$revinvpctfin, contractinvoice_revised_vat_pct=$revvatpctfin, contractinvoice_revised_vat_amt=$revvatamtfin, contractinvoice_revised_subm_date='$contractinvoice_revised_subm_date', 
contractinvoice_collected_date='$date0', contractinvoice_collected_amt=0, contractinvoice_status='', contractinvoice_remarks='', contractinvoice_filepath='', contractinvoice_filename='', fk_contract_id=$contract_id, contractinvoice_plan_reimb_amt=$contractinvoice_plan_reimb_amt, contractinvoice_actl_reimb_amt=$contractinvoice_actl_reimb_amt, contractinvoice_revised_reimb_amt=$contractinvoice_revised_reimb_amt";
	$result12=$dbh2->query($res12query);
	// success screen
	echo "<h3><font color='green'>New invoice added</font></h3>";
	echo "<p>$contractinvoice_num<br>$contractinvoice_amount<br>$contractinvoice_milestone<br>$contractinvoice_percent<br>$contractinvoice_datesubmreq<br>$contractinvoice_datesubmact</p>";
	// log
	$logdetails="Add new invoice no.$contractinvoice_num for contractid:$contract_id projcode:$proj_code14 amt:$contractinvoice_amount ms:$contractinvoice_milestone datesubm:$contractinvoice_datesubmreq";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	// header("Location: projbilling.php?loginid=$loginid");
	// exit;
	echo "<form action='projbilldtls.php?loginid=$loginid' method='POST' name='projbilldtls'>";
	echo "<input type='hidden' name='contractid' value='$contract_id'>";
	echo "<input type='hidden' name='projcode' value='$proj_code14'>";
	echo "<p><button type='submit' class='btn btn-primary'>back</button></p>";
	echo "</form>";
	} // if
	} // if-else

} // if

// echo "<p>vartest f11:$found11, f14:$found14, contrctid:$contract_id, invvatplanchksw:$invvatplanchksw|amt:$planvatamtfin|totcost:$contract_totcost|pct:$contractinvoice_plan_inv_pct<br>res12qry:$res12query<br>logqry:$res16query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>