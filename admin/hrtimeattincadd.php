<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';

$nontaxable = (isset($_POST['nontaxable'])) ? $_POST['nontaxable'] :'';
if($nontaxable=="on") { $nontaxableval=1; } else { $nontaxableval=0; }
$vatinclusive = (isset($_POST['vatinclusive'])) ? $_POST['vatinclusive'] :'';
if($vatinclusive=="on") { $vatinclusiveval=1; } else { $vatinclusiveval=0; }
$schedule = (isset($_POST['schedule'])) ? $_POST['schedule'] :'';
$status = (isset($_POST['status'])) ? $_POST['status'] :'';
if($status=="on") { $statusval=1; } else { $statusval=0; }

$filesrc = (isset($_POST['filesrc'])) ? $_POST['filesrc'] :'';
$tabinctyp = (isset($_POST['tabinctyp'])) ? $_POST['tabinctyp'] :'';
if($tabinctyp=="list") { $tab="l"; } else if($tabinctyp=="add") { $tab="a"; }

//20200204
$rdinctyp = (isset($_POST['rdinctyp'])) ? $_POST['rdinctyp'] :''; // values: projallow or manual
$projassignid = (isset($_POST['projassignid'])) ? $_POST['projassignid'] :'';	

// echo "<p>rdinctyp:$rdinctyp, prjid:$projassignid</p>";

if($rdinctyp=='projallow') {

// query allowances under projassignid
	$res16qry=""; $result16=""; $found16=0; $ctr16=0;
	$res16qry="SELECT ref_no, proj_code, proj_name, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, allow_comm, allow_comm_currency, allow_comm_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationfrom2, durationto2, net_of_tax, allow_fixed, allow_fixed_currency, allow_fixed_paytype FROM tblprojassign WHERE employeeid=\"$employeeid\" AND projassignid=$projassignid";
	$result16=$dbh2->query($res16qry);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$ctr16=$ctr16+1;
			$ref_no16 = $myrow16['ref_no'];
			$proj_code16 = $myrow16['proj_code'];
			$proj_name16 = $myrow16['proj_name'];
			$allow_inc16 = $myrow16['allow_inc'];
			$allow_inc_currency16 = $myrow16['allow_inc_currency'];
			$allow_inc_paytype16 = $myrow16['allow_inc_paytype'];
			$allow_proj16 = $myrow16['allow_proj'];
			$allow_proj_currency16 = $myrow16['allow_proj_currency'];
			$allow_proj_paytype16 = $myrow16['allow_proj_paytype'];
			$ecola116 = $myrow16['ecola1'];
			$ecola1_currency16 = $myrow16['ecola1_currency'];
			$ecola216 = $myrow16['ecola2'];
			$ecola2_currency16 = $myrow16['ecola2_currency'];
			$allow_field_currency16 = $myrow16['allow_field_currency'];
			$allow_field_paytype16 = $myrow16['allow_field_paytype'];
			$allow_field16 = $myrow16['allow_field'];
			$allow_accomm16 = $myrow16['allow_accomm'];
			$allow_accomm_currency16 = $myrow16['allow_accomm_currency'];
			$allow_accomm_paytype16 = $myrow16['allow_accomm_paytype'];
			$allow_transpo16 = $myrow16['allow_transpo'];
			$allow_transpo_currency16 = $myrow16['allow_transpo_currency'];
			$allow_transpo_paytype16 = $myrow16['allow_transpo_paytype'];
			$allow_comm16 = $myrow16['allow_comm'];
			$allow_comm_currency16 = $myrow16['allow_comm_currency'];
			$allow_comm_paytype16 = $myrow16['allow_comm_paytype'];
			$perdiem16 = $myrow16['perdiem'];
			$perdiem_currency16 = $myrow16['perdiem_currency'];
			$durationfrom16 = $myrow16['durationfrom'];
			$durationto16 = $myrow16['durationto'];
			$durationfrom216 = $myrow16['durationfrom2'];
			$durationto216 = $myrow16['durationto2'];
			$net_of_tax16 = $myrow16['net_of_tax'];
			$allow_fixed16 = $myrow16['allow_fixed'];
			$allow_fixed_currency16 = $myrow16['allow_fixed_currency'];
			$allow_fixed_paytype16 = $myrow16['allow_fixed_paytype'];
			if($allow_inc16!=0) {
				$allowamt = $allow_inc16;
				$allowtyp = "Incentive,&nbsp;";
			} // if
			if($allow_proj16!=0) {
				$allowamt = $allowamt+$allow_proj16;
				$allowtyp .= "Project,&nbsp;";
			} // if
			if($ecola116!=0) {
				$allowamt = $allowamt+$ecola116;
				$allowtyp .= "ECola1,&nbsp;";
			} // if
			if($ecola216!=0) {
				$allowamt = $allowamt+$ecola216;
				$allowtyp .= "Ecola2,&nbsp;";
			} // if
			if($allow_field16!=0) {
				$allowamt = $allowamt+$allow_field16;
				$allowtyp .= "Field,&nbsp;";
			} // if
			if($allow_accomm16!=0) {
				$allowamt = $allowamt+$allow_accomm16;
				$allowtyp .= "Accommodation,&nbsp;";
			} // if
			if($allow_transpo16!=0) {
				$allowamt = $allowamt+$allow_transpo16;
				$allowtyp .= "Transportation,&nbsp;";
			} // if
			if($allow_comm16!=0) {
				$allowamt = $allowamt+$allow_comm16;
				$allowtyp .= "Communication,&nbsp;";
			} // if
			if($perdiem16!=0) {
				$allowamt = $allowamt+$perdiem16;
				$allowtyp .= "Per diem,&nbsp;";
			} // if
			if($allow_fixed16!=0) {
				$allowamt = $allowamt+$allow_fixed16;
				$allowtyp .= "Fixed";
			} // if
      $allowamthf = $allowamt/2;
      $allowamtdly = $allowamt/30;
		} // while
	} // if
	$amount = $allowamthf;
	$incomename = $allowtyp;
	$datestart = $durationfrom16;
	if($durationto16=='0000-00-00') {
		// get current year and set to last day of year
		$durationtotmp="$yearnow-12-31";
		$durationtofin = date("Y-m-d", strtotime($durationtotmp));
	    $dateend = $durationtofin;
	} else {
		$dateend = $durationto16;
	} // if-else

} else if($rdinctyp=='manual') {

$incomename = (isset($_POST['incomename'])) ? $_POST['incomename'] :'';
$amount = (isset($_POST['amount'])) ? $_POST['amount'] :'';
$datestart = (isset($_POST['datestart'])) ? $_POST['datestart'] :'';
$dateend = (isset($_POST['dateend'])) ? $_POST['dateend'] :'';

} // if-else

$lumpsumsw = (isset($_POST['lumpsumsw'])) ? $_POST['lumpsumsw'] :''; // value="on"
$amtlumpsumtotal = (isset($_POST['amtlumpsumtotal'])) ? $_POST['amtlumpsumtotal'] :'';
$amtlumpsumbalance = (isset($_POST['amtlumpsumbal'])) ? $_POST['amtlumpsumbal'] :'';

if($lumpsumsw!='on') {
	$amtlumpsumtotal=0; $amtlumpsumbalance=0;
} // if

// echo "<p>allowamt:$allowamt, allowhf:$allowamthf, allowdly:$allowamtdly, lumpsumsw:$lumpsumsw, lumpsumtot:$amtlumpsumtotal, lumpsumbal:$amtlumpsumbal";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
	// query paygroupname
	$result11=""; $found11=0; $ctr11=0;
	$res11query = "SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idpaygroup";
	/*
	$result11 = mysql_query("", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
	*/
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$paygroupname11 = $myrow11['paygroupname'];
		}
	}

// echo "<p>fnd:$found,f11:$found11,paygrp:$paygroupname11</p>";

	// query personnel name
	$result14=""; $found14=0;
	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender FROM tblhrtapaygrpemplst LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
	/*
	$result14 = mysql_query("", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
	*/
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$name_last14 = $myrow14['name_last'];
		$name_first14 = $myrow14['name_first'];
		$name_middle14 = $myrow14['name_middle'];
		$contact_gender14 = $myrow14['contact_gender'];
		}
	}

// echo "<p>f14:$found14, $name_last14, $name_first14</p>";

	if($found11 == 1 && $employeeid != "" && $dateend>=$datestart) {
		// insert into tblhrtaempincome
		$res12query = "INSERT INTO tblhrtaempincome SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", name=\"$incomename\", amount=\"$amount\", datestart=\"$datestart\", dateend=\"$dateend\", nontaxable=$nontaxableval, vatinclusive=$vatinclusiveval, status=$statusval, schedule=\"$schedule\", idpaygroup=$idpaygroup, projassignid=$projassignid, allowtyp=\"$allowtyp\", lumpsumsw=\"$lumpsumsw\", amtlumpsumtotal=$amtlumpsumtotal, amtlumpsumbalance=$amtlumpsumbalance";
		$result12 = $dbh2->query($res12query);
		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			}
		}
		$adminlogdetails = "$loginid:$adminuid - add new additional income for personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with income:$incomename amt:$amount dur:$datestart-to-$dateend, nontax:$nontaxable, vatinc:$vatinclusive, sched:$schedule, status:$status, projid:$projassignid, lumpsum:$lumpsumsw, lstot:$lumpsumtotal, lsbal:$lumpsumbalance";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect
	header("Location: $filesrc.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=$tab");
	exit;
	// echo "<p>vartest timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, paygroupname=\"$paygroupname\", employeeid=\"$employeeid\", name=\"$incomename\", amount=\"$amount\", datestart=\"$datestart\", dateend=\"$dateend\", nontaxable=$nontaxableval, vatinclusive=$vatinclusiveval, status=$statusval, schedule=\"$schedule\", idpaygroup=$idpaygroup</p>";
	// echo "<p>$adminlogdetails</p>";
  // echo "<p>$res12query</p>";
	// echo "<p><a href=\"hrtimeattincome.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid\">back</a></p>";
	}

// echo "<p>vartest in:$timein out:$timeout</p>";

} else {
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?>
