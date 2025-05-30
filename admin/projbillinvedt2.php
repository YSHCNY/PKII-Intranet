<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$contract_id = (isset($_POST['contractid'])) ? $_POST['contractid'] :'';
$contractinvoice_id = (isset($_POST['contractinvoiceid'])) ? $_POST['contractinvoiceid'] :'';
$proj_code = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';
// $contract_totcost = (isset($_POST['contract_totcost'])) ? $_POST['contract_totcost'] :'';
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

// PLANNED
$contractinvoice_plan_inv_date = (isset($_POST['contractinvoice_plan_inv_date'])) ? $_POST['contractinvoice_plan_inv_date'] :'';

$contractinvoice_plan_inv_amt = (isset($_POST['contractinvoice_plan_inv_amt'])) ? $_POST['contractinvoice_plan_inv_amt'] :'';
$contractinvoice_plan_inv_pct = (isset($_POST['contractinvoice_plan_inv_pct'])) ? $_POST['contractinvoice_plan_inv_pct'] :'';

$contractinvoice_plan_vat_pct = (isset($_POST['contractinvoice_plan_vat_pct'])) ? $_POST['contractinvoice_plan_vat_pct'] :'';
$contractinvoice_plan_vat_amt = (isset($_POST['contractinvoice_plan_vat_amt'])) ? $_POST['contractinvoice_plan_vat_amt'] :'';

$contractinvoice_plan_subm_date = (isset($_POST['contractinvoice_plan_subm_date'])) ? $_POST['contractinvoice_plan_subm_date'] :'';

// ACTUAL
$contractinvoice_actl_inv_date = (isset($_POST['contractinvoice_actl_inv_date'])) ? $_POST['contractinvoice_actl_inv_date'] :'';

$contractinvoice_actl_inv_amt = (isset($_POST['contractinvoice_actl_inv_amt'])) ? $_POST['contractinvoice_actl_inv_amt'] :'';
$contractinvoice_actl_inv_pct = (isset($_POST['contractinvoice_actl_inv_pct'])) ? $_POST['contractinvoice_actl_inv_pct'] :'';

$contractinvoice_actl_vat_pct = (isset($_POST['contractinvoice_actl_vat_pct'])) ? $_POST['contractinvoice_actl_vat_pct'] :'';
$contractinvoice_actl_vat_amt = (isset($_POST['contractinvoice_actl_vat_amt'])) ? $_POST['contractinvoice_actl_vat_amt'] :'';

$contractinvoice_actl_subm_date = (isset($_POST['contractinvoice_actl_subm_date'])) ? $_POST['contractinvoice_actl_subm_date'] :'';

// REVISED
$contractinvoice_revised_inv_date = (isset($_POST['contractinvoice_revised_inv_date'])) ? $_POST['contractinvoice_revised_inv_date'] :'';

$contractinvoice_revised_inv_amt = (isset($_POST['contractinvoice_revised_inv_amt'])) ? $_POST['contractinvoice_revised_inv_amt'] :'';
$contractinvoice_revised_inv_pct = (isset($_POST['contractinvoice_revised_inv_pct'])) ? $_POST['contractinvoice_revised_inv_pct'] :'';

$contractinvoice_revised_vat_pct = (isset($_POST['contractinvoice_revised_vat_pct'])) ? $_POST['contractinvoice_revised_vat_pct'] :'';
$contractinvoice_revised_vat_amt = (isset($_POST['contractinvoice_revised_vat_amt'])) ? $_POST['contractinvoice_revised_vat_amt'] :'';

$contractinvoice_revised_subm_date = (isset($_POST['contractinvoice_revised_subm_date'])) ? $_POST['contractinvoice_revised_subm_date'] :'';

$contractinvoice_collected_date = (isset($_POST['contractinvoice_collected_date'])) ? $_POST['contractinvoice_collected_date'] :'';
$contractinvoice_collected_amount = (isset($_POST['contractinvoice_collected_amount'])) ? $_POST['contractinvoice_collected_amount'] :'';

$contractinvoice_plan_reimb_amt = (isset($_POST['contractinvoice_plan_reimb_amt'])) ? $_POST['contractinvoice_plan_reimb_amt'] :'';
$contractinvoice_actl_reimb_amt = (isset($_POST['contractinvoice_actl_reimb_amt'])) ? $_POST['contractinvoice_actl_reimb_amt'] :'';
$contractinvoice_revised_reimb_amt = (isset($_POST['contractinvoice_revised_reimb_amt'])) ? $_POST['contractinvoice_revised_reimb_amt'] :'';
if($contractinvoice_plan_reimb_amt=='') { $contractinvoice_plan_reimb_amt=0; }
if($contractinvoice_actl_reimb_amt=='') { $contractinvoice_actl_reimb_amt=0; }
if($contractinvoice_revised_reimb_amt=='') { $contractinvoice_revised_reimb_amt=0; }

$MAX_FILE_SIZE = (isset($_POST['MAX_FILE_SIZE'])) ? $_POST['MAX_FILE_SIZE'] :'';
$uploadedfile = trim((isset($_POST['uploadedfile'])) ? $_POST['uploadedfile'] :'');

$target_path1 = "./transfers/archives/PROJ";
$filename0 = basename( $_FILES['uploadedfile']['name'] );
$filename1 = str_replace(' ', '_', $filename0);
if($filename1 != "") { $filename = $proj_code."_I_".$filename1; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($contractinvoice_id!='' || $contractinvoice_id!=0) {
	// query tblcontractinvoice if contractinvoiceid exists
	$res11query="SELECT contractinvoice_id, contractinvoice_filename FROM tblcontractinvoice WHERE contractinvoice_id=$contractinvoice_id";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$contractinvoice_id11 = $myrow11['contractinvoice_id'];
		$filename11 = $myrow11['contractinvoice_filename'];
		} // while
	} // if
	// verify filename if changed
	if($filename11!='' && $filename=='') {
		// not changed
		$filename=$filename11;
	} // if
	if($filename11==$filename) {
		$fnstat='no_change';
	} else {
		$fnstat='changed';
	} // if-else

	if($found11==1) {
	//proceed
		if($filename!='') {
			// del old filename
			if($fnstat=='changed') {
			$filetodelete = "$target_path1/$filename11";
 	  	unlink("$filetodelete");
			} // if
		// start file upload if exists  
  $target_path = $target_path1 . "/" . $filename;
  if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {   
    $imagefile = $target_path1 . "/" . $filename1;    
    $newimagefile = $target_path1 . "/" . $filename;    
    rename($imagefile, $newimagefile);    
    echo "$target_path1/\n$filename\n"; 
  } else {
    echo "There was an error uploading the file, please try again!<br>";
  }
		} else {
		$target_path1=''; $filename='';
		} // if-else

// overrule all percentage values to init 0
    $contractinvoice_plan_inv_pct=0; $contractinvoice_plan_vat_pct=0;
    $contractinvoice_actl_inv_pct=0; $contractinvoice_actl_vat_pct=0;
    $contractinvoice_revised_inv_pct=0; $contractinvoice_revised_vat_pct=0;

	// update query
	$res12query="UPDATE tblcontractinvoice SET timestamp='$now', loginid=$loginid, contractinvoice_num='$contractinvoice_num', contractinvoice_refnum='$refno', contractinvoice_milestone='$contractinvoice_milestone', contractinvoice_periodcov_start='$periodcov_start', contractinvoice_periodcov_end='$periodcov_end', contractinvoice_plan_inv_date='$contractinvoice_plan_inv_date', contractinvoice_plan_inv_amt=$contractinvoice_plan_inv_amt, contractinvoice_plan_inv_pct=$contractinvoice_plan_inv_pct, contractinvoice_plan_vat_pct=$contractinvoice_plan_vat_pct, contractinvoice_plan_vat_amt=$contractinvoice_plan_vat_amt, contractinvoice_plan_subm_date='$contractinvoice_plan_subm_date', contractinvoice_actl_inv_date='$contractinvoice_actl_inv_date', contractinvoice_actl_inv_amt=$contractinvoice_actl_inv_amt, contractinvoice_actl_inv_pct=$contractinvoice_actl_inv_pct, contractinvoice_actl_vat_pct=$contractinvoice_actl_vat_pct, contractinvoice_actl_vat_amt=$contractinvoice_actl_vat_amt, contractinvoice_actl_subm_date='$contractinvoice_actl_subm_date', contractinvoice_revised_inv_date='$contractinvoice_revised_inv_date', contractinvoice_revised_inv_amt=$contractinvoice_revised_inv_amt, contractinvoice_revised_inv_pct=$contractinvoice_revised_inv_pct, contractinvoice_revised_vat_pct=$contractinvoice_revised_vat_pct, contractinvoice_revised_vat_amt=$contractinvoice_revised_vat_amt, contractinvoice_revised_subm_date='$contractinvoice_revised_subm_date', contractinvoice_collected_date='$contractinvoice_collected_date', contractinvoice_collected_amt=$contractinvoice_collected_amount, contractinvoice_filepath='$target_path1', contractinvoice_filename='$filename', contractinvoice_plan_reimb_amt = $contractinvoice_plan_reimb_amt, contractinvoice_actl_reimb_amt = $contractinvoice_actl_reimb_amt, contractinvoice_revised_reimb_amt = $contractinvoice_revised_reimb_amt WHERE contractinvoice_id=$contractinvoice_id AND fk_contract_id=$contract_id";
	$result12=""; $found12=0;
	$result12=$dbh2->query($res12query);

	$res99query="SELECT contract_totcost_paid FROM tblcontract WHERE tblcontract.contract_id=$contract_id AND tblcontract.fk_projcode='$proj_code'";
	$result99=""; $found99=0; $ctr99=0;
	$result99=$dbh2->query($res99query);
	if($result99->num_rows>0) {
		while($myrow99=$result99->fetch_assoc()) {
		$found99=1;
		$ctr99++;
		$contract_totcost_paid11 = $myrow99['contract_totcost_paid'];
		}
	} // if

	// $grandTotal = $contractinvoice_collected_amount + $contract_totcost_paid11;
    // $grandTotal = $contractinvoice_collected_amount;
	// var_dump($result99);

    $res100query=""; $result100=""; $found100=0;
    $res100query="SELECT contractinvoice_id, contractinvoice_collected_amt FROM tblcontractinvoice WHERE fk_contract_id=$contract_id";
    $result100=$dbh2->query($res100query);
    if($result100->num_rows>0) {
        while($myrow100=$result100->fetch_assoc()) {
        $found100=1;
        $contractinvoice_id100 = $myrow100['contractinvoice_id'];
        $contractinvoice_collected_amt100 = $myrow100['contractinvoice_collected_amt'];
        $grandTotal = $grandTotal + $contractinvoice_collected_amt100;
        } //while
    } //if


	$res13query="UPDATE tblcontract SET timestamp='$now', loginid=$loginid, contract_totcost_paid='$grandTotal' WHERE contract_id=$contract_id AND fk_projcode='$proj_code'";
	$result13=$dbh2->query($res13query);

	// success screen
	echo "<h3><font color='green'>Invoice updated</font></h3>";
echo "<p>id:$contractinvoice_id, no.:$contractinvoice_num projcd:$proj_code, ms:$contractinvoice_milestone</p>";
echo "<p>qry:$res12query</p>";
	// log
	$logdetails="Updated invoice id:$contractinvoice_id, no.:$contractinvoice_num for contractid:$contract_id projcode:$proj_code ms:$contractinvoice_milestone";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	// header("Location: projbilling.php?loginid=$loginid");
	// exit;
	echo "<form action='projbilldtls.php?loginid=$loginid' method='POST' name='projbilldtls'>";
	echo "<input type='hidden' name='contractid' value='$contract_id'>";
	echo "<input type='hidden' name='projcode' value='$proj_code'>";
	echo "<p><button type='submit' class='btn btn-primary'>back</button></p>";
	echo "</form>";
	} else {
	// halt
	echo "<h3 class='text-danger'>Sorry. Record missing.</h3>";
	echo "<p><button onClick='history.go(-1);' class='btn btn-primary'>back</button></p>";
	} // if-else

} // if

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
