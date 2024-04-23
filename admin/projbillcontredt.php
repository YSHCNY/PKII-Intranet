<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$contract_id0 = (isset($_GET['cid'])) ? $_GET['cid'] :'';
$proj_code0 = (isset($_GET['prjid'])) ? $_GET['prjid'] :'';

$contract_id = (isset($_POST['contractid'])) ? $_POST['contractid'] :'';
$proj_code = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';

if($contract_id0!='' && $proj_code0!='') {
    $contract_id=$contract_id0; $proj_code=$proj_code0;
} //if

$found = 0;

if($loginid != "") {
     include("logincheck.php");
} // if

if($found == 1 && substr($level, -33, 1) == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Project Billing >> Edit contract</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
?>
<script language="JavaScript" src="./js/auto_search.js"></script>
<?php
// start contents here...

if($contract_id!='') {

	// query tblcontract
	// $res11query="SELECT contract_title, contract_num, contract_start, contract_end, contract_type, contract_datemob, contract_totcost_balance, contract_totcost_paid, contract_totcost_directcost, contract_totcost_tax, contract_totcost_remuneration, contract_recoupment_pct, contract_recoupment_amt, contract_recoupment_balance, contract_filepath, contract_filename, contract_remarks, fk_companyid_client, fk_companyid_funding_agency, fk_companyid_implementing_agency, fk_contactid_client, fk_contactid_funding_agency, fk_contactid_implementing_agency FROM tblcontract WHERE contract_id=$contract_id AND fk_projcode='$proj_code' LIMIT 1";
	$res11query="SELECT contract_title, contract_num, contract_type, contract_totcost_balance, contract_totcost_paid, contract_totcost_directcost, contract_totcost_tax, contract_totcost_remuneration, contract_recoupment_pct, contract_recoupment_amt, contract_recoupment_balance, contract_filepath, contract_filename, contract_remarks FROM tblcontract WHERE contract_id=$contract_id AND fk_projcode='$proj_code' LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$contract_title11 = $myrow11['contract_title'];
		$contract_num11 = $myrow11['contract_num'];
		// $contract_start11 = date('Y-m-d', strtotime($myrow11['contract_start']));
		// $contract_end11 = date('Y-m-d', strtotime($myrow11['contract_end']));
		$contract_type11 = $myrow11['contract_type'];
		// $contract_datemob11 = date('Y-m-d', strtotime($myrow11['contract_datemob']));
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
		// $fk_companyid_client11 = $myrow11['fk_companyid_client'];
		// $fk_companyid_funding_agency11 = $myrow11['fk_companyid_funding_agency'];
		// $fk_companyid_implementing_agency11 = $myrow11['fk_companyid_implementing_agency'];
		// $fk_contactid_client11 = $myrow11['fk_contactid_client'];
		// $fk_contactid_funding_agency11 = $myrow11['fk_contactid_funding_agency'];
		// $fk_contactid_implementing_agency11 = $myrow11['fk_contactid_implementing_agency'];
		} // while
	} // if

	// date start <= date end
	if(strtotime($contract_start11)<=strtotime($contract_end11)) {
	$proceed=1;
	} else {
	$proceed=0;
	} // if-else
	// echo "<tr><td colspan=2>vartest f11:$found11 proceed:$proceed start:$contract_start11 end:$contract_end11</td></p>";

	if($found11==1 && $proceed==1) {
	
  echo "<tr><td colspan=\"2\">";
	echo "<table>";
	echo "<form enctype='multipart/form-data' action='projbillcontredt2.php?loginid=$loginid' method='POST' name='projbillcontradd'>";
	echo "<input type='hidden' name='contractid' value='$contract_id'>";
	echo "<input type='hidden' name='projcode' value='$proj_code'>";
	// for encoders
  // if($accesslevel >= 3) {
		// proj_code
		echo "<tr><th class='text-right'>Project code</th><td>$proj_code</td></tr>";
		// contract_title
		echo "<tr><th class='text-right'>Contract title</th><td><input size='100' name='contract_title' value='$contract_title11'></td></tr>";
		// contract_number
		echo "<tr><th class='text-right'>Contract number</th><td>";
		echo "<input size='25' name='contract_number' value='$contract_num11'>";
		echo "</td></tr>";
		echo "<tr><th class='text-right'>Contract type</th><td>";
		if($contract_type11=='lump_sum') {
		$lumpsumsel="selected"; $timebasedsel="";
		} else if($contract_type11=='time-based') {
		$lumpsumsel=""; $timebasedsel="selected";
		} // if-else
		echo "<select name='contract_type'>";
		echo "<option value='time-based' $timebasedsel>Time-based</option>";
		echo "<option value='lump_sum' $lumpsumsel>Lump_sum</option>";
		echo "</select>";
		echo "</td></tr>";
		// echo "<tr><th class='text-right'>Date start</th><td><input type='date' name='date_start' value='$contract_start11'></td></tr>";
		// echo "<tr><th class='text-right'>Date end</th><td><input type='date' name='date_end' value='$contract_end11'></td></tr>";
		// echo "<tr><th class='text-right'>Mobilization date</th><td><input type='date' name='date_mob' value='$contract_datemob11'></td></tr>";
		echo "<tr><th class='text-left' colspan='2'>Project cost</th></tr>";
		echo "<tr><th class='text-right'>Direct cost</th><td><input type='number' name='projcostdirect' step='0.01' value='$contract_totcost_directcost11'></td></tr>";
		echo "<tr><th class='text-right'>Tax</th><td><input type='number' name='projcosttaxpct' step='0.1' value='$contract_totcost_tax11'>%</td></tr>";
		echo "<tr><th class='text-right'>Remuneration</th><td><input type='number' name='projcostremuneration' step='0.01' value='$contract_totcost_remuneration11'>amount</td></tr>";
		echo "<tr><th class='text-right'>Recoupment</th><td><input type='number' name='recoupamt' step='0.01' value='$contract_recoupment_amt11'><br><input type='number' name='recouppct' step='0.1' value='$contract_recoupment_pct11'>%</td></tr>";
		
		echo "<tr><th class='text-right'>Remarks</th><td><textarea rows='4' cols='60' name='contract_remarks'>$contract_remarks11</textarea></td></tr>";
		echo "<tr><th class='text-right'>File attachment</th><td>";
			echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" />";
	    echo "<input name=\"uploadedfile\" type=\"file\" />";
		echo "&nbsp;<a href='./$contract_filepath11/$contract_filename11' target='_blank'>$contract_filename11</a>";
    if($contract_filename11!='') {
        echo "&nbsp;<a href=\"./projbillcontrdelfile.php?loginid=$loginid&cid=$contract_id&prjcd=$proj_code\" class='btn btn-danger btn-sm' role='button'>remove</a>";
    } //if
    echo "</td></tr>";
		echo "<tr><th class='text-right'></th><td><button type='submit' class='btn btn-success'>Save details</button></td></tr>";
		echo "</form>";
  // } // (if accesslevel >= 3)

	// for supervisors+
	if($accesslevel >= 4) {

	} // (if accesslevel >= 4)
	echo "</table>";
  echo "</td></tr>";

	} else { // if($found11==1)
	echo "<tr><th colspan=\"2\"><font color='red'>Failed to create contract</font></th></tr>";
	
  echo "<tr><td colspan=\"2\">";
// echo "<p>f:$found11 p:$proceed prjcd:$proj_code ".strtotime($date_start)." ".strtotime($date_end)."<br>$res11query</p>";
  echo "</td></tr>";

	} // if-else

} // if

// end contents here...

     echo "</table>";

		echo "<form action='projbilldtls.php?loginid=$loginid' method='POST' name='projbilldtls'>";
		echo "<input type='hidden' name='contractid' value='$contract_id'>";
		echo "<input type='hidden' name='projcode' value='$proj_code'>";
     echo "<p><button type='submit' class='btn btn-primary'>Back</button></p>";
		echo "</form>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}
?>
<SCRIPT type="text/javascript" language="JavaScript">
function radioselecta1()
{
     document.getElementById('radioa1').checked = true;	
}
function radioselecta2()
{
     document.getElementById('radioa2').checked = true;	
}
function radioselectb1()
{
     document.getElementById('radiob1').checked = true;	
}
function radioselectb2()
{
     document.getElementById('radiob2').checked = true;	
}
function radioselectc1()
{
     document.getElementById('radioc1').checked = true;	
}
function radioselectc2()
{
     document.getElementById('radioc2').checked = true;	
}
function radioselecta1()
{
     document.getElementById('radioa1').checked = true;	
}
function radioselecta2()
{
     document.getElementById('radioa2').checked = true;	
}
function radioselectb1()
{
     document.getElementById('radiob1').checked = true;	
}
function radioselectb2()
{
     document.getElementById('radiob2').checked = true;	
}
function radioselectc1()
{
     document.getElementById('radioc1').checked = true;	
}
function radioselectc2()
{
     document.getElementById('radioc2').checked = true;	
}
</SCRIPT>
<?php
$dbh2->close();
?>

