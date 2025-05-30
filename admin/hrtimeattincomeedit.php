<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
</head>
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



// start contents here...



	//
	// display individual info based on selected dropdown personnel
	//
	if($employeeid != "") {

	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday FROM tblhrtapaygrpemplst INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
	$result14=""; $found14=0;

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


	


	echo "<div class = 'mb-3 border p-4 shadow'>
	<p class = 'text-secondary pb-0 mb-0'>Edit Additional Allowance for:</p>
	<h4> ".strtoupper($name_last14).", ".strtoupper($name_first14)." ".strtoupper($name_middle14[0]).". ($employeeid)</h4></div>";

	echo "<div class = 'shadow border p-4'>";

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
	echo "<div class = 'mb-3'> <td >";
	echo "<input type=\"radio\" name=\"rdinctyp\" value=\"projallow\" $projallowchk> From Allowances";
	echo "</td></div>";
    echo "<tr><td colspan=\"3\">";
	echo "<select name=\"projassignid\" id = 'selectAllowance'>";
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
      echo " >";
			if($allow_inc16!=0) {
				echo "Income: $allow_inc16 $allow_inc_currency16 $allow_inc_paytype16 |";
			} // if
			if($allow_proj16!=0) {
				echo " Project: $allow_proj16 $allow_proj_currency16 $allow_proj_paytype16 |";
			} // if
			if($ecola116!=0) {
				echo " ecola1: $ecola116 $ecola1_currency16 |";
			} // if
			if($ecola216!=0) {
				echo " ecola2: $ecola216 $ecola2_currency16 |";
			} // if
			if($allow_field16!=0) {
				echo " Field: $allow_field16 $allow_field_currency16 $allow_field_paytype16 |";
			} // if
			if($allow_accomm16!=0) {
				echo " Accommodation: $allow_accomm16 $allow_accomm_currency16 $allow_accomm_paytype16 |";
			} // if
			if($allow_transpo16!=0) {
				echo " Transportation: $allow_transpo16 $allow_transpo_currency16 $allow_transpo_paytype16 |";
			} // if
			if($allow_comm16!=0) {
				echo " Communication: $allow_comm16 $allow_comm_currency16 $allow_comm_paytype16 |";
			} // if
			if($perdiem16!=0) {
				echo " perdiem: $perdiem16 $perdiem_currency16 |";
			} // if
			if($allow_fixed16!=0) {
				echo " Fixed: $allow_fixed16 $allow_fixed_currency16 $allow_fixed_paytype16 ";
			} // if
			echo " $durationfrom16 -to- $durationto16";
			if($durationfrom2!='' && $durationto2!='') {
				echo " $durationfrom216 -to- $durationto216";
			} // if
			if($net_of_tax16=='on') {
				echo " - Net of tax";
			}
			echo "</option>";
		} // while
	} // if


	if($allowtyp1 == 'PA'){
		$allowtypename = 'Project Allowance';
	} elseif($allowtyp1 == 'FA'){
		$allowtypename = 'Field Allowance'; // Note: 'FA' is used twice; this uses the second meaning
	} elseif($allowtyp1 == 'IA'){
		$allowtypename = 'Incentive Allowance';
	} elseif($allowtyp1 == 'AA'){
		$allowtypename = 'Accommodation Allowance';
	} elseif($allowtyp1 == 'TA'){
		$allowtypename = 'Transportation Allowance';
	} elseif($allowtyp1 == 'CA'){
		$allowtypename = 'Communication Allowance';
	} elseif($allowtyp1 == 'PD'){
		$allowtypename = 'Per Diem';
	} elseif($allowtyp1 == 'EC1'){
		$allowtypename = 'ECOLA 1';
	} elseif($allowtyp1 == 'EC2'){
		$allowtypename = 'ECOLA 2';
	}else{
		$allowtypename = 'None Selected';
	}
	
	echo "</select>";
    echo "</td></tr>";	
	
	echo "<div class=\"\">";
	// 20200205
	echo "<div class = 'mb-3'>";
	echo "<input type=\"radio\" name=\"rdinctyp\" value=\"manual\" $rdinctypmanualchk> Custom";
	echo "</div>";

	echo "<div class = 'border'>";

	echo "<div class = 'row m-4'><div class = 'col'>";
	echo "<label for = 'input'>Name</label> <input name=\"incomename\" class = 'form-control' value=\"$name1\">";
	echo "</div>";
	echo "<div class = 'col'>";
	echo "<label for = 'select'>Type of Allowance</label>";
	echo "<select class = 'form-select h5 ' name = 'typeofallow'>
	<option value = '$allowtyp1' selected disabled>$allowtypename ($allowtyp1) </option>
	<option value='FA'> Fixed Allowance </option>
	<option value='IA'> Incentive Allowance </option>
	<option value='PA'> Project Allowance </option>
	<option value='FA'> Field Allowance </option>
	<option value='AA'> Accommodation Allowance  </option>
	<option value='TA'> Transportation Allowance  </option>
	<option value='CA'> Communication Allowance  </option>
	<option value='PD'>Per Diem</option>
	<option value='EC1'> ECOLA 1 </option>
	<option value='EC2'> ECOLA 2 </option>
	
	</select>
	";
	echo "</div>";
	echo "</div>";

	echo "<div class = 'mx-5 my-2'>";
	echo "<label for = 'input'>Amount</label> <input type=\"currency\" class = 'form-control' name=\"amount\"  value=\"$amount1\">";

	echo "</div>";

	echo "<div class = 'row m-4'>";
	echo "<div class = 'col'>";
	echo "<label for = 'input'>From </label><input type=\"date\" class = 'form-control' name=\"datestart\"  value=\"$datestart1\">";
	echo "</div>";

	echo "<div class = 'col'>";
	echo "<label for = 'input'>To</label><input type=\"date\" name=\"dateend\" class = 'form-control' value=\"$dateend1\">";
	echo "</div>";

	echo "</div>";
	echo "</div>";


	echo "</table>";

  // common options
	echo "<div class=\"fin\">";
  // row1
  echo "<div class = 'mt-4 mb-3'><h4 >Common options</h4></div>";
  if($lumpsumsw1=='on') {
	  $lumpsumchk="checked=\"checked\"";
  } else {
	  $lumpsumchk="";
  }
	echo "<div class = 'border p-4 mb-4'>";


  echo "<div class = 'row mx-4'><div class = 'mb-4'><input type=\"checkbox\" name=\"lumpsumsw\" value=\"on\" $lumpsumchk> For lumpsum, pls input total and balance</div>";
  echo "<div class = 'col'>Total<input type=\"currency\" class = 'form-control' name=\"amtlumpsumtotal\"  value=\"$amtlumpsumtotal1\"></div>";
  echo "<div class = 'col'>Balance<input type=\"currency\" class = 'form-control' name=\"amtlumpsumbal\"  value=\"$amtlumpsumbalance1\"></div>";
  echo "</div>";
	
    // row2
	echo "<div class = 'row mt-4 mx-4 '><div class = 'col'>";
	if($nontaxable1 == 1) { $nontaxablesel="checked"; } else { $nontaxablesel=""; }
	echo "<input type=\"checkbox\" name=\"nontaxable\" $nontaxablesel> Non-taxable";
	echo "</div><div class = 'col'>";
	if($vatinclusive1 == 1) { $vatinclusivesel="checked"; } else { $vatinclusivesel=""; }
	echo "<input type=\"checkbox\" name=\"vatinclusive\" $vatinclusivesel> VAT inclusive";
	echo "";
	echo "</div>";
	echo "<div class = 'col'>";
	if($schedule1 == "all") { $scheduleallsel="selected"; $schedule15sel=""; $schedule30sel=""; }
	else if($schedule1 == "15th") { $scheduleallsel=""; $schedule15sel="selected"; $schedule30sel=""; }
	else if($schedule1 == "30th") { $scheduleallsel=""; $schedule15sel=""; $schedule30sel="selected"; }
	echo "Schedule <select name=\"schedule\">";
	echo "<option value=\"all\" $scheduleallsel>all</option>";
	echo "<option value=\"15th\" $schedule15sel>15th only</option>";
	echo "<option value=\"30th\" $schedule30sel>30th only</option>";
	echo "</select>";
	echo "</div>";
	echo "<div class = 'col'>";
	if($status1 == 1) { $statussel="checked"; } else { $statussel=""; }
	echo "<input type=\"checkbox\" name=\"status\" $statussel> Active status";
	echo "</div>";
	echo "</div>";

	echo "</div>";



	echo "<div class = 'text-end'>";
	// echo "<input type=\"submit\" value=\"Update\">";
	echo "<a class=\"btn mb-3 text-dark\" href=\"hrtimeattincome.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=l\">Back</a>";
	echo "<button type=\"submit\" class=\"btn text-white bg-success\">Update</button>";
	echo "</div>";
	echo "</form>";



	echo "</div> ";
	}

// end contents here...


// edit body-footer

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");

	 ?>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('selectAllowance');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
      });
    });
  </script>
<?php
}

else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>

