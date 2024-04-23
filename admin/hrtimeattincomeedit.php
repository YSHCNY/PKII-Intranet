<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtaempincome = (isset($_GET['empincid'])) ? $_GET['empincid'] :'';
$filesrc = (isset($_GET['fsrc'])) ? $_GET['fsrc'] :'';
// $idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$tab = (isset($_GET['tab'])) ? $_GET['tab'] :'';

if($tab!="") {
	if($tab=="l") { $tabinctyp="list"; }
	else if($tab=="a") { $tabinctyp="add"; }
}

$res1query = "SELECT paygroupname, employeeid, name, amount, datestart, dateend, nontaxable, vatinclusive, status, schedule, idpaygroup, projassignid, allowtyp, lumpsumsw, amtlumpsumtotal, amtlumpsumbalance FROM tblhrtaempincome WHERE idhrtaempincome=$idhrtaempincome";
$result1=""; $found1=0; $ctr1=0;
/*
$result1 = mysql_query("", $dbh);
if($result1 != "") {
	while($myrow1 = mysql_fetch_row($result1)) {
*/
$result1 = $dbh2->query($res1query);
if($result1->num_rows>0) {
	while($myrow1 = $result1->fetch_assoc()) {
	$found1 = 1;
	$paygroupname1 = $myrow1['paygroupname'];
	$employeeid1 = $myrow1['employeeid'];
	$name1 = $myrow1['name'];
	$amount1 = $myrow1['amount'];
	$datestart1 = $myrow1['datestart'];
	$dateend1 = $myrow1['dateend'];
	$nontaxable1 = $myrow1['nontaxable'];
	$vatinclusive1 = $myrow1['vatinclusive'];
	$status1 = $myrow1['status'];
	$schedule1 = $myrow1['schedule'];
	$idpaygroup1 = $myrow1['idpaygroup'];
	$projassignid1 = $myrow1['projassignid'];
	$allowtyp1 = $myrow1['allowtyp'];
	$lumpsumsw1 = $myrow1['lumpsumsw'];
	$amtlumpsumtotal1 = $myrow1['amtlumpsumtotal'];
	$amtlumpsumbalance1 = $myrow1['amtlumpsumbalance'];
	}
}
// $idpaygroup0 = $_GET['idpg'];
// $employeeid0 = $_GET['eid'];

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup == "") { $idpaygroup=$idpaygroup1; }
if($employeeid == "") { $employeeid=$employeeid1; }

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1)
{
     include("header.php");
     include("sidebar.php");
?>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Allowances</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

	echo "<tr><td colspan=\"2\">";

	// display add'l income header tabs
	include("hrtimeattincaddhdr.php");

	echo "</td></tr>";

	//
	// display individual info based on selected dropdown personnel
	//
	if($employeeid != "") {
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
	// query personnel
	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday FROM tblhrtapaygrpemplst INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
	$result14=""; $found14=0;
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
		$idhrtapayshiftctg14 = $myrow14['idhrtapayshiftctg'];
		$bankacctid14 = $myrow14['bankacctid'];
		$restday14 = $myrow14['restday'];
		}
	}

	echo "<tr><th colspan=\"2\">Details of additional income for personnel:<br>$employeeid - ".strtoupper($name_last14).",&nbsp;".strtoupper($name_first14)."&nbsp;".strtoupper($name_middle14)."</th></tr>";

	echo "<tr><td colspan=\"2\">";

	// add income screen
	echo "<form action=\"hrtimeattincedit2.php?loginid=$loginid&empincid=$idhrtaempincome\" method=\"post\" name=\"hrtimeattincedit2\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"list\">";
	
    // 20200205 for projassignid dropdown
	if($projassignid1!=0) {
		$projallowchk=""; $rdinctypmanualchk="checked=\"checked\"";
	} else {
		$projallowchk="checked=\"checked\""; $rdinctypmanualchk="";
	}
	echo "<table class=\"fin\">";
	echo "<tr><td colspan=\"3\">";
	echo "<input type=\"radio\" name=\"rdinctyp\" value=\"projallow\" $projallowchk>&nbsp;from Allowances";
	echo "</td></tr>";
    echo "<tr><td colspan=\"3\">";
	echo "<select name=\"projassignid\">";
  // query tblprojassign
	$res16qry=""; $result16=""; $found16=0; $ctr16=0;
	$res16qry="SELECT projassignid, ref_no, proj_code, proj_name, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, allow_comm, allow_comm_currency, allow_comm_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationfrom2, durationto2, net_of_tax, allow_fixed, allow_fixed_currency, allow_fixed_paytype FROM tblprojassign WHERE employeeid=\"$employeeid\" AND (allow_inc<>0 OR allow_proj<>0 OR ecola1<>0 OR ecola2<>0 OR allow_field<>0 OR allow_accomm<>0 OR allow_transpo<>0 OR allow_comm<>0 OR perdiem<>0 OR allow_fixed<>0) ORDER BY durationfrom DESC";
	$result16=$dbh2->query($res16qry);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$ctr16=$ctr16+1;
			$projassignid16 = $myrow16['projassignid'];
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
			if($projassignid16==$projassignid1) {
				$projassignidsel="selected";
			} else {
				$projassignidsel="";
			} // if-else
            echo "<option value=\"$projassignid16\" $projassignidsel>$ref_no16 - $proj_code16 - ";
			if($proj_name16!='') {
				echo "$proj_name16";
			} // if
      echo "&nbsp;>";
			if($allow_inc16!=0) {
				echo "Income: $allow_inc16&nbsp;$allow_inc_currency16&nbsp;$allow_inc_paytype16&nbsp;|";
			} // if
			if($allow_proj16!=0) {
				echo "&nbsp;Project: $allow_proj16&nbsp;$allow_proj_currency16&nbsp;$allow_proj_paytype16&nbsp;|";
			} // if
			if($ecola116!=0) {
				echo "&nbsp;ecola1: $ecola116&nbsp;$ecola1_currency16&nbsp;|";
			} // if
			if($ecola216!=0) {
				echo "&nbsp;ecola2: $ecola216&nbsp;$ecola2_currency16&nbsp;|";
			} // if
			if($allow_field16!=0) {
				echo "&nbsp;Field: $allow_field16&nbsp;$allow_field_currency16&nbsp;$allow_field_paytype16&nbsp;|";
			} // if
			if($allow_accomm16!=0) {
				echo "&nbsp;Accommodation: $allow_accomm16&nbsp;$allow_accomm_currency16&nbsp;$allow_accomm_paytype16&nbsp;|";
			} // if
			if($allow_transpo16!=0) {
				echo "&nbsp;Transportation: $allow_transpo16&nbsp;$allow_transpo_currency16&nbsp;$allow_transpo_paytype16&nbsp;|";
			} // if
			if($allow_comm16!=0) {
				echo "&nbsp;Communication: $allow_comm16&nbsp;$allow_comm_currency16&nbsp;$allow_comm_paytype16&nbsp;|";
			} // if
			if($perdiem16!=0) {
				echo "&nbsp;perdiem: $perdiem16&nbsp;$perdiem_currency16&nbsp;|";
			} // if
			if($allow_fixed16!=0) {
				echo "&nbsp;Fixed: $allow_fixed16&nbsp;$allow_fixed_currency16&nbsp;$allow_fixed_paytype16&nbsp;";
			} // if
			echo "&nbsp;$durationfrom16 -to- $durationto16";
			if($durationfrom2!='' && $durationto2!='') {
				echo "&nbsp;$durationfrom216 -to- $durationto216";
			} // if
			if($net_of_tax16=='on') {
				echo "&nbsp;-&nbsp;Net of tax";
			}
			echo "</option>";
		} // while
	} // if
	echo "</select>";
    echo "</td></tr>";	
	echo "</table>";
	
	echo "<table class=\"fin\">";
	// 20200205
	echo "<tr><td colspan=\"3\">";
	echo "<input type=\"radio\" name=\"rdinctyp\" value=\"manual\" $rdinctypmanualchk>&nbsp;Custom";
	echo "</td></tr>";

	echo "<tr><td>";
	echo "Name&nbsp;<input name=\"incomename\" size=\"30\" value=\"$name1\">";
	echo "</td>";
	echo "<td>";
	echo "Amount&nbsp;<input type=\"currency\" name=\"amount\" size=\"10\" value=\"$amount1\">";
	echo "</td>";
	echo "<td>";
	echo "<input type=\"date\" name=\"datestart\" size=\"10\" value=\"$datestart1\">";
		?>
	  <!-- <a href="javascript:show_calendar('document.modhrtaincedit2.datestart', document.modhrtaincedit2.datestart.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
	  <?php
	echo "From";
	echo "<br>";
	echo "<input type=\"date\" name=\"dateend\" size=\"10\" value=\"$dateend1\">";
		?>
	  <!-- <a href="javascript:show_calendar('document.modhrtaincedit2.dateend', document.modhrtaincedit2.dateend.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
	  <?php
	echo "To";
	echo "</td>";
	echo "</tr>";
	echo "</table>";

  // common options
	echo "<table class=\"fin\">";
  // row1
  echo "<tr><th colspan=\"3\">Common options</th></tr>";
  if($lumpsumsw1=='on') {
	  $lumpsumchk="checked=\"checked\"";
  } else {
	  $lumpsumchk="";
  }
  echo "<tr><td><input type=\"checkbox\" name=\"lumpsumsw\" value=\"on\" $lumpsumchk>For lumpsum, pls input total and balance</td>";
  echo "<td>Total<input type=\"currency\" name=\"amtlumpsumtotal\" size=\"10\" value=\"$amtlumpsumtotal1\"></td>";
  echo "<td>Balance<input type=\"currency\" name=\"amtlumpsumbal\" size=\"10\" value=\"$amtlumpsumbalance1\"></td>";
  echo "</tr>";
	
    // row2
	echo "<tr><td>";
	if($nontaxable1 == 1) { $nontaxablesel="checked"; } else { $nontaxablesel=""; }
	echo "<input type=\"checkbox\" name=\"nontaxable\" $nontaxablesel>Non-taxable";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if($vatinclusive1 == 1) { $vatinclusivesel="checked"; } else { $vatinclusivesel=""; }
	echo "<input type=\"checkbox\" name=\"vatinclusive\" $vatinclusivesel>VAT inclusive";
	echo "</td>";
	echo "<td>";
	if($schedule1 == "all") { $scheduleallsel="selected"; $schedule15sel=""; $schedule30sel=""; }
	else if($schedule1 == "15th") { $scheduleallsel=""; $schedule15sel="selected"; $schedule30sel=""; }
	else if($schedule1 == "30th") { $scheduleallsel=""; $schedule15sel=""; $schedule30sel="selected"; }
	echo "Schedule&nbsp;<select name=\"schedule\">";
	echo "<option value=\"all\" $scheduleallsel>all</option>";
	echo "<option value=\"15th\" $schedule15sel>15th only</option>";
	echo "<option value=\"30th\" $schedule30sel>30th only</option>";
	echo "</select>";
	echo "</td>";
	echo "<td>";
	if($status1 == 1) { $statussel="checked"; } else { $statussel=""; }
	echo "<input type=\"checkbox\" name=\"status\" $statussel>Active status";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td colspan=\"3\" align=\"center\">";
	// echo "<input type=\"submit\" value=\"Update\">";
	echo "<button type=\"submit\" class=\"btn btn-success\">Update</button>";
	echo "</td></tr";
	echo "</form>";
	echo "</table>";

	echo "</td></tr>";
	echo "</table>";

	echo "</td></tr>";
	}

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"$filesrc.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=l\">Back</a></button></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
