<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$proj_code = (isset($_POST['proj_code'])) ? $_POST['proj_code'] :'';
$contract_title = stripslashes((isset($_POST['contract_title'])) ? $_POST['contract_title'] :'');
$contract_number = stripslashes((isset($_POST['contract_number'])) ? $_POST['contract_number'] :'');
$contract_type = (isset($_POST['contract_type'])) ? $_POST['contract_type'] :'';
// $date_start = (isset($_POST['date_start'])) ? $_POST['date_start'] :'';
// $date_end = (isset($_POST['date_end'])) ? $_POST['date_end'] :'';
// $date_mob = (isset($_POST['date_mob'])) ? $_POST['date_mob'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
} // if

if($found == 1 && substr($level, -33, 1) == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Project Billing >> Add new contract</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
?>
<script language="JavaScript" src="./js/auto_search.js"></script>
<?php
// start contents here...

if($proj_code!='') {

	// query proj_code
	$res11query="SELECT projectid, proj_code, proj_fname, proj_sname, proj_services FROM tblproject1 WHERE proj_code='$proj_code'";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$projectid11 = $myrow11['projectid'];
		$proj_code11 = $myrow11['proj_code'];
		$proj_fname11 = $myrow11['proj_fname'];
		$proj_sname11 = $myrow11['proj_sname'];
		$proj_services11 = $myrow11['proj_services'];
		} // while
	} // if

	// date start <= date end
	if(strtotime($date_start)<=strtotime($date_end)) {
	$proceed=1;
	} else {
	$proceed=0;
	} // if-else

	if($found11==1 && $proceed==1) {
	// query tblcontract if exists
	echo "<tr><th colspan=\"2\"><font color='green'>New contract confirmed.</font> Please fill-up details and click 'Save' button.</th></tr>";
	
  echo "<tr><td colspan=\"2\">";
	echo "<table>";
	echo "<form action='projbillcontradd.php?loginid=$loginid' method='POST' name='projbillcontradd'>";
	// for encoders
  if($accesslevel >= 3) {
		// proj_code
		echo "<tr><th class='text-right'>Project code<font color='red'>*</font></th><td>$proj_code</td></tr>";
		echo "<input type='hidden' name='proj_code' value='$proj_code'>";
		if($contract_title!='') {
		$contract_titlefin=$contract_title;
		} else {
		if($proj_fname11!='') { $contract_titlefin=$proj_fname11; } else if($proj_sname11!='') { $contract_titlefin=$proj_sname11; }
		} // if-else
		// contract_title
		echo "<tr><th class='text-right'>Contract title<font color='red'>*</font></th><td><input size='100' name='contract_title' value='$contract_titlefin'></td></tr>";
		// contract_number
		if($contract_number=='') { $contract_numberfin=$proj_code; }
		echo "<tr><th class='text-right'>Contract number<font color='red'>*</font></th><td>";
		echo "<input size='25' name='contract_number' value='$contract_numberfin'>";
		echo "</td></tr>";
		echo "<tr><th class='text-right'>Contract type</th><td>";
		if($contract_type=='lump_sum') {
		$lumpsumsel="selected"; $timebasedsel="";
		} else if($contract_type=='time-based') {
		$lumpsumsel=""; $timebasedsel="selected";
		} // if-else
		echo "<select name='contract_type'>";
		echo "<option value='time-based' $timebasedsel>Time-based</option>";
		echo "<option value='lump_sum' $lumpsumsel>Lump_sum</option>";
		echo "</select>";
		echo "</td></tr>";
		// echo "<tr><th class='text-right'>Date start</th><td><input type='date' name='date_start' value='$date_start'></td></tr>";
		// echo "<tr><th class='text-right'>Date end</th><td><input type='date' name='date_end' value='$date_end'></td></tr>";
		// echo "<tr><th class='text-right'>Mobilization date</th><td><input type='date' name='date_mob' value='$date_mob'></td></tr>";
		echo "<tr><th class='text-left' colspan='2'>Project cost</th></tr>";
		echo "<tr><th class='text-right'>Direct cost</th><td><input type='number' name='projcostdirect' step='0.01' value='0.00'></td></tr>";
		echo "<tr><th class='text-right'>Tax</th><td><input type='number' name='projcosttaxpct' step='0.1' value='12.0'>%</td></tr>";
		echo "<tr><th class='text-right'>Remuneration</th><td><input type='number' name='projcostremuneration' step='0.01' value='0.00'>amount</td></tr>";
		echo "<tr><th class='text-right'>Recoupment</th><td><input type='number' name='recoupamt' step='0.01' value='0.00'><br><input type='number' name='recouppct' step='0.1' value='0.0'>%</td></tr>";

		echo "<tr><th class='text-right'></th><td><button type='submit' class='btn btn-success'>Save details</button></td></tr>";
		echo "</form>";
  } // (if accesslevel >= 3)

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

     echo "<p><div id='redir_projbilling'><a href='projbilling.php?loginid=$loginid' class='btn btn-primary'>Back</a></div></p>";

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

</SCRIPT>
<?php
$dbh2->close();
?>

