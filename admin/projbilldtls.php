<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$contract_id0 = (isset($_GET['cid'])) ? $_GET['cid'] :'';
$proj_code0 = (isset($_GET['prjcd'])) ? $_GET['prjcd'] :'';

$contract_id = (isset($_POST['contractid'])) ? $_POST['contractid'] :'';
$proj_code = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';

if($contract_id0!='') { $contract_id=$contract_id0; }
if($proj_code0!='') { $proj_code=$proj_code0; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
} // if

if($found == 1 && substr($level, -33, 1) == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Project Billing</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

	// title head
	echo "<tr><th colspan=\"2\">Project Billing</th></tr>";
	
  echo "<tr><td>";
	// column1

	// for encoders
  if($accesslevel >= 3) {
	echo "<table width='100%' class='fin' border='1'>";
	// query tblcontract
	$res11query="SELECT tblcontract.contract_title, tblcontract.contract_num, tblcontract.contract_type, tblcontract.contract_totcost_balance, tblcontract.contract_totcost_paid, tblcontract.contract_totcost_directcost, tblcontract.contract_totcost_remuneration, tblcontract.contract_totcost_tax, tblcontract.contract_recoupment_pct, tblcontract.contract_recoupment_amt, tblcontract.contract_recoupment_balance, tblcontract.contract_filepath, tblcontract.contract_filename, tblcontract.contract_remarks, tblproject1.proj_sname, tblproject1.proj_services, tblproject1.date_start, tblproject1.date_end, tblproject1.date_mob, tblproject1.fk_companyid_client, tblproject1.fk_companyid_funding_agency, tblproject1.fk_companyid_implementing_agency, tblproject1.fk_contactid_client, tblproject1.fk_contactid_funding_agency, tblproject1.fk_contactid_implementing_agency, tblproject1.employeeid FROM tblcontract INNER JOIN tblproject1 ON tblcontract.fk_projcode=tblproject1.proj_code WHERE tblcontract.contract_id=$contract_id AND tblcontract.fk_projcode='$proj_code'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$ctr11=$ctr11+1;
		$contract_title11 = $myrow11['contract_title'];
		$contract_num11 = $myrow11['contract_num'];
		$contract_type11 = $myrow11['contract_type'];
		$contract_totcost_balance11 = $myrow11['contract_totcost_balance'];
		$contract_totcost_paid11 = $myrow11['contract_totcost_paid'];
		$contract_totcost_directcost11 = $myrow11['contract_totcost_directcost'];
		$contract_totcost_tax11 = $myrow11['contract_totcost_tax'];
		$contract_totcost_remuneration11 = $myrow11['contract_totcost_remuneration'];
		$contract_recoupment_pct11 = $myrow11['contract_recoupment_pct'];
		$contract_recoupment_amt11 = $myrow11['contract_recoupment_amt'];
		$contract_recoupment_balance11 = $myrow11['contract_recoupment_balance'];
		$contract_filepath11 = $myrow11['contract_filepath'];
		$contract_filename11 = $myrow11['contract_filename'];
		$contract_remarks11 = $myrow11['contract_remarks'];
		$proj_sname11 = $myrow11['proj_sname'];
		$proj_services11 = $myrow11['proj_services'];
		$date_start11 = $myrow11['date_start'];
		$date_end11 = $myrow11['date_end'];
		$date_mob11 = $myrow11['date_mob'];
		$fk_companyid_client11 = $myrow11['fk_companyid_client'];
		$fk_companyid_funding_agency11 = $myrow11['fk_companyid_funding_agency'];
		$fk_companyid_implementing_agency11 = $myrow11['fk_companyid_implementing_agency'];
		$fk_contactid_client11 = $myrow11['fk_contactid_client'];
		$fk_contactid_funding_agency11 = $myrow11['fk_contactid_funding_agency'];
		$fk_contactid_implementing_agency11 = $myrow11['fk_contactid_implementing_agency'];
		$employeeid11 = $myrow11['employeeid'];
		echo "</tr>";
		} // while
	} // if
	echo "<tr><th class='text-right'>Project code</th><td>$proj_code</td></tr>";
	if($proj_sname11!='') { echo "<tr><th class='text-right'>Project acronym</th><td>$proj_sname11</td></tr>"; }
	echo "<tr><th class='text-right'>Project title</th><td>$contract_title11</td></tr>";
	echo "<tr><th class='text-right'>Project number</th><td>$contract_num11</td></tr>";
	echo "<tr><th class='text-right'>Duration</th><td>";
	if(checkmydate($date_start11)) {
	echo "".date('Y-M-d D', strtotime($date_start11))."";
	} // if
	echo "<br>-to-<br>";
	if(checkmydate($date_end11)) {
	echo "".date('Y-M-d D', strtotime($date_end11))."";
	} // if
	echo "</td></tr>";
	echo "<tr><th class='text-right'>Mobilization date</th><td>";
	if(checkmydate($date_mob11)) {
	echo "".date('Y-M-d D', strtotime($date_mob11))."";
	} // if
	echo "</td></tr>";
	echo "<tr><th class='text-right'>Services</th><td>$proj_services11</td></tr>";
	// client
	if($fk_companyid_client11!=0 || $fk_contactid_client11!=0) {
		if($fk_companyid_client11!=0) {
		// query tblcompany
		$res12query="SELECT company, branch FROM tblcompany WHERE companyid=$fk_companyid_client11 LIMIT 1";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$company12 = $myrow12['company'];
			$branch12 = $myrow12['branch'];
			} // while
		} // if
		echo "<tr><th class='text-right'>Client</th><td>$company12";
		if($branch12!='') { echo "&nbsp;-&nbsp$branch12"; }
		echo "</td></tr>";
		} else if($fk_contactid_client11!=0) {
		// query tblcontact
		$res12query="SELECT name_last, name_first, name_middle FROM tblcontact WHERE contactid=$fk_contactid_client11 LIMIT 1";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$name_last12 = $myrow12['name_last'];
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];
			} // while
		} // if
		echo "<tr><th class='text-right'>Client</th><td>$name_last12, $name_first12 $name_middle12[0]</td></tr>";
		} // if-else
	} // if
	// funding_agency
	if($fk_companyid_funding_agency11!=0 || $fk_contactid_funding_agency11!=0) {
		if($fk_companyid_funding_agency11!=0) {
		$res14query="SELECT company, branch FROM tblcompany WHERE companyid=$fk_companyid_funding_agency11 LIMIT 1";
		$result14=""; $found14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$company14 = $myrow14['company'];
			$branch14 = $myrow14['branch'];
			} // while
		} // if
		echo "<tr><th class='text-right'>Funding agency</th><td>$company14";
		if($branch14!='') { echo "&nbsp;-&nbsp;$branch14"; }
		echo "</td></tr>";
		} else if($fk_contactid_funding_agency11!=0) {
		$res14query="SELECT name_last, name_first, name_middle FROM tblcontact WHERE contactid=$fk_contactid_funding_agency11 LIMIT 1";
		$result14=""; $found14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$name_last14 = $myrow14['name_last'];
			$name_first14 = $myrow14['name_first'];
			$name_middle14 = $myrow14['name_middle'];
			} // while
		} // if
		echo "<tr><th class='text-right'>Funding agency</th><td>$name_last14, $name_first14 $name_middle14[0]</td></tr>";
		} // if-else
	} // if
	// implementing_agency
	if($fk_companyid_implementing_agency11!=0 || $fk_contactid_implementing_agency11!=0) {
		if($fk_companyid_implementing_agency11!=0) {
		$res15query="SELECT company, branch FROM tblcompany WHERE companyid=$fk_companyid_implementing_agency11 LIMIT 1";
		$result15=""; $found15=0;
		$result15=$dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15=1;
			$company15 = $myrow15['company'];
			$branch15 = $myrow15['branch'];
			} // while
		} // if
		echo "<tr><th class='text-right'>Implementing agency</th><td>$company15";
		if($branch15!='') { echo "&nbsp;-&nbsp;$branch15"; }
		echo "</td></tr>";
		} else if($fk_contactid_implementing_agency11!=0) {
		$res15query="SELECT name_last, name_first, name_middle FROM tblcontact WHERE contactid=$fk_contactid_implementing_agency11 LIMIT 1";
		$result15=""; $found15=0;
		$result15=$dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15=1;
			$name_last15 = $myrow15['name_last'];
			$name_first15 = $myrow15['name_first'];
			$name_middle15 = $myrow15['name_middle'];
			} // while
		} // if
		echo "<tr><th class='text-right'>Implementing agency</th><td>$name_last15, $name_first15 $name_middle15[0]</td></tr>";
		} // if-else
	} // if
	echo "<tr><th class='text-right'>Assigned Acct. Ofcr.|$employeeid11</th><td>";
	if($employeeid11!='' || $employeeid11!='selec') {
	$res17query="SELECT name_last, name_first, name_middle, email1 FROM tblcontact WHERE employeeid='$employeeid11' AND contact_type='personnel'";
	$result17=""; $found17=0;
	$result17=$dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17=$result17->fetch_assoc()) {
		$found17=1;
		$name_last17 = $myrow17['name_last'];
		$name_first17 = $myrow17['name_first'];
		$name_middle17 = $myrow17['name_middle'];
		$email117 = $myrow17['email1'];
		} // while
	} // if
	if($found17==1) {
	echo "$name_last17, $name_first17 $name_middle17[0]";
	if($email117!='') {
	echo " - <a href='mailto:$email117'>$email117</a>";
	} // if
	} else {
	echo "";
	} // if-else
	} else {
	echo "";
	} // if-else
	echo "</td></tr>";
	// attached_doc
	echo "<tr><th class='text-right'>Document attached</th><td>";
	if($contract_filename11!='') {
	echo "<a href='./$contract_filepath11/$contract_filename11' target='_blank'>$contract_filename11</a>";
	} else {
	echo "";
	} // if-else
	echo "</td></tr>";
	echo "<tr><th class='text-right'>Remarks</th><td>".nl2br($contract_remarks11)."</td></tr>";
	echo "<tr>";
	echo "<td align='center' colspan='2'>";
	echo "<table width='100%' class='fin' border='0'>";
	echo "<tr><td align='center'>";
	echo "<form action='projbillcontredt.php?loginid=$loginid' method='POST' name='projbillcontredt'>";
	echo "<input type='hidden' name='contractid' value='$contract_id'>";
	echo "<input type='hidden' name='projcode' value='$proj_code'>";
	echo "<button type='submit' class='btn btn-warning'>Edit</button>";
	echo "</form>";
	echo "</td><td align='center'>";
	echo "<form action='projbillcontrdel.php?loginid=$loginid' method='POST' name='projbillcontrdel'>";
	echo "<input type='hidden' name='contractid' value='$contract_id'>";
	echo "<input type='hidden' name='projcode' value='$proj_code'>";
	echo "<button type='submit' class='btn btn-danger'>Del</button>";
	echo "</form>";
	echo "</td></tr>";
	echo "</table>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</td><td>";
	// column2
	echo "<table width='100%' class='fin' border='1'>";
	echo "<tr><th>Total Contract Cost</th><th>Paid</th><th>Balance</th></tr>";
	$contract_totcost = $contract_totcost_directcost11 + (($contract_totcost_directcost11*$contract_totcost_tax11)/100) + $contract_totcost_remuneration11;
	echo "<tr><td>".number_format($contract_totcost)."</td><td>".number_format($contract_totcost_paid11)."</td><td>".number_format($contract_totcost - $contract_totcost_paid11)."</td></tr>";
	echo "<form action='projbillinvnew.php?loginid=$loginid' method='POST' name='projbillinv'>";
	echo "<input type='hidden' name='contract_id' value='$contract_id'>";
	echo "<input type='hidden' name='proj_code' value='$proj_code'>";
	echo "<tr><td colspan='3' align='center'><button type='submit' class='btn btn-success'>Add invoice</button></td></tr>";
	echo "</form>";
	echo "</table><br><table class='fin' border='1'>";
	// header
	echo "<tr><th>Invoice no.</th><th>Invoice<br>date</th><th>Milestone</th><th>Amount</th>";
  // echo "<th>Percent</th>";
  echo "<th>Attachment</th><th>Status</th><th>Action</th></tr>";
	// query tblcontractinvoice
	$res16query="SELECT contractinvoice_id, contractinvoice_num, contractinvoice_refnum, contractinvoice_milestone, contractinvoice_periodcov_start, contractinvoice_periodcov_end, contractinvoice_percent, contractinvoice_recoup_pct, contractinvoice_recoup_amt, contractinvoice_plan_inv_date, contractinvoice_plan_inv_amt, contractinvoice_plan_inv_pct, contractinvoice_plan_vat_pct, contractinvoice_plan_vat_amt, contractinvoice_plan_subm_date, contractinvoice_actl_inv_date, contractinvoice_actl_inv_amt, contractinvoice_actl_vat_pct, contractinvoice_actl_vat_amt, contractinvoice_actl_subm_date, contractinvoice_revised_inv_date, contractinvoice_revised_inv_amt, contractinvoice_revised_inv_pct, contractinvoice_revised_vat_pct, contractinvoice_revised_vat_amt, contractinvoice_revised_subm_date, contractinvoice_collected_date, contractinvoice_collected_amt, contractinvoice_status, contractinvoice_remarks, contractinvoice_filepath, contractinvoice_filename, fk_contract_id, tblcontractinvoice.billingst_num, tblcontractinvoice.contractinvoice_plan_reimb_amt, tblcontractinvoice.contractinvoice_actl_reimb_amt, tblcontractinvoice.contractinvoice_revised_reimb_amt FROM tblcontractinvoice WHERE fk_contract_id=$contract_id";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$found16=1;
		$ctr16=$ctr16+1;
		$contractinvoice_id16 = $myrow16['contractinvoice_id'];
		$contractinvoice_num16 = $myrow16['contractinvoice_num'];
		$contractinvoice_refnum16 = $myrow16['contractinvoice_refnum'];
		$contractinvoice_milestone16 = $myrow16['contractinvoice_milestone'];
		$contractinvoice_periodcov_start16 = $myrow16['contractinvoice_periodcov_start'];
		$contractinvoice_periodcov_end16 = $myrow16['contractinvoice_periodcov_end'];
		$contractinvoice_percent16 = $myrow16['contractinvoice_percent'];
		$contractinvoice_recoup_pct16 = $myrow16['contractinvoice_recoup_pct'];
		$contractinvoice_recoup_amt16 = $myrow16['contractinvoice_recoup_amt'];
		$contractinvoice_plan_inv_date16 = $myrow16['contractinvoice_plan_inv_date'];
		$contractinvoice_plan_inv_amt16 = $myrow16['contractinvoice_plan_inv_amt'];
		$contractinvoice_plan_inv_pct16 = $myrow16['contractinvoice_plan_inv_pct'];
		$contractinvoice_plan_vat_pct16 = $myrow16['contractinvoice_plan_vat_pct'];
		$contractinvoice_plan_vat_amt16 = $myrow16['contractinvoice_plan_vat_amt'];
		$contractinvoice_plan_subm_date16 = $myrow16['contractinvoice_plan_subm_date'];
		$contractinvoice_actl_inv_date16 = $myrow16['contractinvoice_actl_inv_date'];
		$contractinvoice_actl_inv_amt16 = $myrow16['contractinvoice_actl_inv_amt'];
		$contractinvoice_actl_inv_pct16 = $myrow16['contractinvoice_actl_inv_pct'];
		$contractinvoice_actl_vat_pct16 = $myrow16['contractinvoice_actl_vat_pct'];
		$contractinvoice_actl_vat_amt16 = $myrow16['contractinvoice_actl_vat_amt'];
		$contractinvoice_actl_subm_date16 = $myrow16['contractinvoice_actl_subm_date'];
		$contractinvoice_revised_inv_date16 = $myrow16['contractinvoice_revised_inv_date'];
		$contractinvoice_revised_inv_amt16 = $myrow16['contractinvoice_revised_inv_amt'];
		$contractinvoice_revised_inv_pct16 = $myrow16['contractinvoice_revised_inv_pct'];
		$contractinvoice_revised_vat_pct16 = $myrow16['contractinvoice_revised_vat_pct'];
		$contractinvoice_revised_vat_amt16 = $myrow16['contractinvoice_revised_vat_amt'];
		$contractinvoice_revised_subm_date16 = $myrow16['contractinvoice_revised_subm_date'];
		$contractinvoice_collected_date16 = $myrow16['contractinvoice_collected_date'];
		$contractinvoice_collected_amt16 = $myrow16['contractinvoice_collected_amt'];
		$contractinvoice_status16 = $myrow16['contractinvoice_status'];
		$contractinvoice_remarks16 = $myrow16['contractinvoice_remarks'];
		$contractinvoice_filepath16 = $myrow16['contractinvoice_filepath'];
		$contractinvoice_filename16 = $myrow16['contractinvoice_filename'];
		$fk_contract_id16 = $myrow16['fk_contract_id'];
    $billingst_num16 = $myrow16['billingst_num'];
    $contractinvoice_plan_reimb_amt16 = $myrow16['contractinvoice_plan_reimb_amt'];
    $contractinvoice_actl_reimb_amt16 = $myrow16['contractinvoice_actl_reimb_amt'];
    $contractinvoice_revised_reimb_amt16 = $myrow16['contractinvoice_revised_reimb_amt'];

		// invoice no. date
		echo "<tr><td>$contractinvoice_num16</td>";

    // invoice date
		echo "<td>planned:<br>";
		if($contractinvoice_plan_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
		echo "".date('Y-M-d D', strtotime($contractinvoice_plan_inv_date16))."";
		} // if-else
		if($contractinvoice_actl_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
		echo "<br>actual:<br>";
		echo "".date('Y-M-d D', strtotime($contractinvoice_actl_inv_date16))."";
		} // if-else
		if($contractinvoice_revised_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
		echo "<br>revised:<br>";
		echo "".date('Y-M-d D', strtotime($contractinvoice_revised_inv_date16))."";
		} // if-else
		echo "</td>";

    // invoice milestone
		echo "<td>$contractinvoice_milestone16</td>";

		// invoice amount
// compute total invoice amount
    $contractinvoice_plan_totinv_amt=0;
    $contractinvoice_plan_totinv_amt=$contractinvoice_plan_inv_amt16+$contractinvoice_plan_reimb_amt16+$contractinvoice_plan_vat_amt16;
		// echo "<td>".number_format($contractinvoice_amount16)."</td>";
		echo "<td>planned:<br>";
		if($contractinvoice_plan_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
			if($contractinvoice_plan_totinv_amt!=0) {
			echo "".number_format($contractinvoice_plan_totinv_amt, 2)."";
			} else {
			echo "-";
			}
		} // if-else
    $contractinvoice_actl_totinv_amt=0;
    $contractinvoice_actl_totinv_amt=$contractinvoice_actl_inv_amt16+$contractinvoice_actl_reimb_amt16+$contractinvoice_actl_vat_amt16;
		if($contractinvoice_actl_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
		echo "<br>actual:<br>";
			if($contractinvoice_actl_totinv_amt!=0) {
		echo "".number_format($contractinvoice_actl_totinv_amt, 2)."";
			} else {
			echo "-";
			} // if-else
		} // if-else
    $contractinvoice_revised_totinv_amt=0;
    $contractinvoice_revised_totinv_amt=$contractinvoice_revised_inv_amt16+$contractinvoice_revised_reimb_amt16+$contractinvoice_revised_vat_amt16;
		if($contractinvoice_revised_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
		echo "<br>revised:<br>";
			if($contractinvoice_revised_totinv_amt!=0) {
		echo "".number_format($contractinvoice_revised_totinv_amt, 2)."";
			} else {
		echo "-";
			} // if-else
		} // if-else
		echo "</td>";

		// invoice percentage
/*		// echo "<td>$contractinvoice_percent16%</td>";
		echo "<td>planned:<br>";
		if($contractinvoice_plan_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
			if($contractinvoice_plan_inv_pct16!=0) {
			echo "".number_format($contractinvoice_plan_inv_pct16, 0)."%";
			} else {
			echo "-";
			}
		} // if-else
		if($contractinvoice_actl_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
		echo "<br>actual:<br>";
			if($contractinvoice_actl_inv_pct16!=0) {
		echo "".number_format($contractinvoice_actl_inv_pct16, 0)."%";
			} else {
			echo "-";
			} // if-else
		} // if-else
		if($contractinvoice_revised_inv_date16=='0000-00-00 00:00:00') {
		echo "";
		} else {
		echo "<br>revised:<br>";
			if($contractinvoice_revised_vat_pct16!=0) {
		echo "".number_format($contractinvoice_revised_vat_pct16, 0)."%";
			} else {
		echo "-";
			} // if-else
		} // if-else
		echo "</td>";
*/

    // attachment
    echo "<td>";
    if($contractinvoice_filename16!='') {
    echo "<a href=\"./$contractinvoice_filepath16/$contractinvoice_filename16\" target=\"_blank\">$contractinvoice_filename16</a>";
    } //if
    echo "</td>";

		// status
		echo "<td>";
		echo "</td>";

		// actions
		echo "<td nowrap>";
		echo "<form action='projbillinvedt.php?loginid=$loginid' method='POST' name='projbillinvdtl'>";
		echo "<input type='hidden' name='contractinvoiceid' value='$contractinvoice_id16'>";
		echo "<input type='hidden' name='contractid' value='$fk_contract_id16'>";
		echo "<button type='submit' class='btn btn-warning'>Edit</button></form>";
		echo "&nbsp;";
		echo "<form action='projbillinvdel.php?loginid=$loginid' method='POST' name='projbillinvdel'>";
		echo "<input type='hidden' name='contractinvoiceid' value='$contractinvoice_id16'>";
		echo "<input type='hidden' name='contractid' value='$fk_contract_id16'>";
		echo "<input type='hidden' name='projcode' value='$proj_code'>";
		echo "<button type='submit' class='btn btn-danger'>Del</button></form>";
		echo "</td>";
		echo "</tr>";
		} // while
	} // if
	echo "</table>";
	// echo "<br>qry:$res16query";
	echo "</td></tr>";

	} // if($accesslevel>=3)

// end contents here...

     echo "</table>";

     echo "<p><div id='redir_back2'><a href='projbilling.php?loginid=$loginid' class='btn btn-primary'>Back</a></div></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

function checkmydate($date) {
  $tempDate = explode('-', $date);
  // checkdate(month, day, year)
  return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
}

$dbh2->close();
?>

