<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$projassignid = (isset($_GET['prjid'])) ? $_GET['prjid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

	 ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	 <?php

	 $resquery = "SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'";
	 $result=$dbh2->query($resquery);
	 if($result->num_rows>0) {
		 while($myrow=$result->fetch_assoc()) {
		 $found=1;
		 $name_last = $myrow['name_last'];
		 $name_first = $myrow['name_first'];
		 $name_middle = $myrow['name_middle'];
		 $position = $myrow['position'];
		 } // while($myrow=$result->fetch_assoc())
	 } // if($result->num_rows>0))

	 ?>

 <?php

     echo "<div class = 'shadow border px-5 py-3 mb-4'><h4>Edit Project Assignment of <span class ='fw-semibold'>$name_last, $name_first $name_middle[0] ($employeeid) - $position</span></h4>";
	echo "</div>";
echo "<div class = 'p-4 shadow border'>";
echo "";
     echo "<table class = 'table table-bordered table-striped table-hover'>";

	if ($employeeid == '') {
	echo "<tr><td colspan=\"2\"><font color=red>Sorry. No data available</td></tr>";
	} else {


// start project assignments

	$res3query = "SELECT tblprojassign.projassignid, tblprojassign.projdate, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign.employeeid0, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.empprojctr, tblprojassign.position, tblprojassign.salary, tblprojassign.salarycurrency, tblprojassign.salarytype, tblprojassign.allow_inc, tblprojassign.allow_inc_currency, tblprojassign.allow_inc_paytype, tblprojassign.allow_proj, tblprojassign.allow_proj_currency, tblprojassign.allow_proj_paytype, tblprojassign.ecola1, tblprojassign.ecola1_currency, tblprojassign.ecola2, tblprojassign.ecola2_currency, tblprojassign.allow_field_currency, tblprojassign.allow_field_paytype, tblprojassign.allow_field, tblprojassign.allow_accomm, tblprojassign.allow_accomm_currency, tblprojassign.allow_accomm_paytype, tblprojassign.allow_transpo, tblprojassign.allow_transpo_currency, tblprojassign.allow_transpo_paytype, tblprojassign.allow_comm, tblprojassign.allow_comm_currency, tblprojassign.allow_comm_paytype, tblprojassign.perdiem, tblprojassign.perdiem_currency, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.durationtotal, tblprojassign.durationtotprop, tblprojassign.durationfrom2, tblprojassign.durationto2, tblprojassign.duration2total, tblprojassign.duration2totprop, tblprojassign.durationprojassigntot, tblprojassign.durationprojassigntotprop, tblprojassign.term_resign, tblprojassign.remarks, tblprojassign.remarks2, tblprojassign.net_of_tax, tblprojassign.filepath, tblprojassign.filename, tblprojassign.idhrpositionctg, tblprojassign.allow_fixed, tblprojassign.allow_fixed_currency, tblprojassign.allow_fixed_paytype FROM tblprojassign WHERE employeeid = '$employeeid' AND projassignid = $projassignid";
	$result3="";
	$result3=$dbh2->query($res3query);
	if($result3->num_rows>0) {
		while($myrow3=$result3->fetch_assoc()) {
	  $found3 = 1;
	  $projassignid = $myrow3['projassignid'];
	  $projdate = $myrow3['projdate'];
	  $ref_no = $myrow3['ref_no'];
	  $employeeid = $myrow3['employeeid'];
	  $currempid = $myrow3['employeeid0'];
	  $proj_code = $myrow3['proj_code'];
	  $proj_name = $myrow3['proj_name'];
	  $empprojctr = $myrow3['empprojctr'];
	  $position = $myrow3['position'];
	  $salary = $myrow3['salary'];
	  $salarycurrency = $myrow3['salarycurrency'];
	  $salarytype = $myrow3['salarytype'];
	  $allow_inc = $myrow3['allow_inc'];
	  $allow_inc_currency = $myrow3['allow_inc_currency'];
	  $allow_inc_paytype = $myrow3['allow_inc_paytype'];
	  $allow_proj = $myrow3['allow_proj'];
	  $allow_proj_currency = $myrow3['allow_proj_currency'];
	  $allow_proj_paytype = $myrow3['allow_proj_paytype'];
	  $ecola1 = $myrow3['ecola1'];
	  $ecola1_currency = $myrow3['ecola1_currency'];
	  $ecola2 = $myrow3['ecola2'];
	  $ecola2_currency = $myrow3['ecola2_currency'];
	  $allow_field_currency = $myrow3['allow_field_currency'];
	  $allow_field_paytype = $myrow3['allow_field_paytype'];
	  $allow_field = $myrow3['allow_field'];
	  $allow_accomm = $myrow3['allow_accomm'];
	  $allow_accomm_currency = $myrow3['allow_accomm_currency'];
	  $allow_accomm_paytype = $myrow3['allow_accomm_paytype'];
	  $allow_transpo = $myrow3['allow_transpo'];
	  $allow_transpo_currency = $myrow3['allow_transpo_currency'];
	  $allow_transpo_paytype = $myrow3['allow_transpo_paytype'];
	  $allow_comm = $myrow3['allow_comm'];
	  $allow_comm_currency = $myrow3['allow_comm_currency'];
	  $allow_comm_paytype = $myrow3['allow_comm_paytype'];
	  $perdiem = $myrow3['perdiem'];
	  $perdiem_currency = $myrow3['perdiem_currency'];
	  $durationfrom = $myrow3['durationfrom'];
	  $durationto = $myrow3['durationto'];
	  $durationtotal = $myrow3['durationtotal'];
	  $durationtotprop = $myrow3['durationtotprop'];
	  $durationfrom2 = $myrow3['durationfrom2'];
	  $durationto2 = $myrow3['durationto2'];
	  $duration2total = $myrow3['duration2total'];
	  $duration2totprop = $myrow3['duration2totprop'];
	  $durationprojassigntot = $myrow3['durationprojassigntot'];
	  $durationprojassigntotprop = $myrow3['durationprojassigntotprop'];
	  $term_resign = $myrow3['term_resign'];
	  $remarks = $myrow3['remarks'];
	  $remarks2 = $myrow3['remarks2'];
	  $net_of_tax = $myrow3['net_of_tax'];
	  $filepath3 = $myrow3['filepath'];
	  $filename3 = $myrow3['filename'];
		$idhrpositionctg3 = $myrow3['idhrpositionctg'];
		$allow_fixed = $myrow3['allow_fixed'];
		$allow_fixed_currency = $myrow3['allow_fixed_currency'];
		$allow_fixed_paytype = $myrow3['allow_fixed_paytype'];
		} // while($myrow3=$result3->fetch_assoc())
	} // if($result3->num_rows>0)

	echo "<form  enctype=\"multipart/form-data\" action=\"personnelprojassignedit2.php?loginid=$loginid&eid=$employeeid&pid=$projassignid\" method=\"post\" name=\"form1\">";

	echo "<tr><td align=\"right\">Date</td><td>";
	echo "<input class = 'form-control'  placeholder ='00.00' type = 'date' class = 'form-control' value = '$projdate' name = 'projdate'>";
	// if ($projdate == '')
	// { echo "Blank <a href=personnelprojassignchgprojdate.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&pdate=$projdate>Change</a>"; }
	// else { echo "$projdate <a href=personnelprojassignchgprojdate.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&pdate=$projdate>Change</a>";
	// }
	echo "</td>";
	
	echo "<tr><td align=\"right\">Contract Reference Number</td><td><input class = 'form-control'  placeholder ='00.00' class = 'form-control' placeholder ='Contact Reference number here....' name=ref_no value=\"$ref_no\"></td></tr>";

	$res4query = "SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '$proj_code'";
	$result4="";
	$result4=$dbh2->query($res4query);
	if($result4->num_rows>0) {
		while($myrow4=$result4->fetch_assoc()) {
	  $found4 = 1;
	  $proj_fname = $myrow4['proj_fname'];
	  $proj_sname = $myrow4['proj_sname'];
		} // while($myrow4=$result4->fetch_assoc())
	} // if($result4->num_rows>0)

	// echo "<tr><th align='center' colspan = '2'>Projects</th></tr>";
	echo "<tr><td align=\"right\">Single Projects</td>";

	echo "<td align=\"left\">$proj_code - $proj_name ($proj_fname) 
	<a href=\"personnelprojassignchgproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&prjcd=$proj_code\" class = 'text-info btn'>change project name</a></td></tr>";

	echo "<tr><td align=\"right\">Multiple Projects <div class = 'text-end m-1'><a href=\"personnelprojassignaddproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\" class = 'btn bg-success text-white'>Add project</a></div></td><td>";
	echo "";
	
	echo "<table width=\"100%\" class=\"table table-striped table-hover table-bordered\">";
	$res5query = "SELECT idprojcdassign, projectid, projcode, projname, duration, durationprop FROM tblprojcdassign WHERE projassignid=$projassignid AND empid=\"$employeeid\"";
	$result5=""; $found5=0; $ctr5=0;
	$result5=$dbh2->query($res5query);
	if($result5->num_rows>0) {
		while($myrow5=$result5->fetch_assoc()) {
		$found5 = 1;
		$idprojcdassign5 = $myrow5['idprojcdassign'];
		$projectid5 = $myrow5['projectid'];
		$projcode5 = $myrow5['projcode'];
		$projname5 = $myrow5['projname'];
		$duration5 = $myrow5['duration'];
		$durationprop5 = $myrow5['durationprop'];
		echo "<tr><td>$projcode5&nbsp;-&nbsp;$projname5</td>";
		if(($duration5 != 0) || ($duration5 != '')) {
			echo "<td>$duration5&nbsp;$durationprop5</td>";
		} else { echo "<td></td>"; }
		echo "<td><a href=\"personnelprojassigneditproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&idprjcdasgn=$idprojcdassign5\" class = 'btn text-white bg-success mx-1'>Edit</a>";
		echo "<a onclick=\"return confirm('Delete entry?');\" href=\"personnelprojassigndelproj.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&idprjcdasgn=$idprojcdassign5\" class='btn text-white bg-danger mx-1'>Delete</a></td></tr>";

		} // while($myrow5=$result5->fetch_assoc())
	} // if($result5->num_rows>0)

	echo "</table>";
	echo "</td></tr>";

	echo "<tr><td align=\"right\">Position</td><td>";
	// echo "<input class = 'form-control'  placeholder ='00.00' size=50 name=position value=\"$position\">";
	if($idhrpositionctg3==0) {
		echo "$position<br>";	
	} // if($idhrpositionctg!=0)
	echo "<select class = 'form-selector'  class = 'form-selector' name=\"idhrpositionctg\">";
	if($idhrpositionctg3==0) {
		echo "<option value=0>select position</option>";
	} // if($idhrpositionctg3==0)
	$res6query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg ORDER BY name ASC";
	$result6=""; $found6=0;
	$result6=$dbh2->query($res6query);
	if($result6->num_rows>0) {
		while($myrow6=$result6->fetch_assoc()) {
		$found6=1;
		$idhrpositionctg6 = $myrow6['idhrpositionctg'];
		$code6 = $myrow6['code'];
		$name6 = $myrow6['name'];
		$deptcd6 = $myrow6['deptcd'];
		if($idhrpositionctg6==$idhrpositionctg3) { $idhrposctgsel="selected"; } else { $idhrposctgsel=""; }
		echo "<option value=\"$idhrpositionctg6\" $idhrposctgsel>$name6</option>";
		} // while($myrow6=$result6->fetch_assoc())
	} // if($result6->num_rows>0)
	echo "</select>";
	echo "</td></tr>";

//	start salary rate details
	echo "<tr><td align=\"right\">Salary Rate</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' placeholder ='00.00' name=salary value=$salary></td>";
	if($salarycurrency == 'usd') {
	  $salarycurrencyusd = 'selected';
	} else if($salarycurrency == 'php') {
	  $salarycurrencyphp = 'selected';
	} else {
	  $salarycurrencyothers = 'selected';
	} // if($salarycurrency == 'usd')
	echo "<td><select class = 'form-selector' name=salarycurrency>";
	echo "<option value=php $salarycurrencyphp>PhP</option>";
	echo "<option value=usd $salarycurrencyusd>US$</option>";
	echo "<option value=others $salarycurrencyothers>Others</option>";
	echo "</select></td>";
	if($salarytype == 'lumpsum') {
	  $salarytypelumpsum = 'selected';
	} else if($salarytype == 'monthly') {
	  $salarytypemonthly = 'selected';
	} else if($salarytype == 'weekly') {
	  $salarytypeweekly = 'selected';
	} else if ($salarytype == 'daily') {
	  $salarytypedaily = 'selected';
	} else {
	  $salarytypeothers = 'selected';
	} // if($salarytype == 'lumpsum')
	echo "<td><select class = 'form-selector' name=salarytype>";
	echo "<option value=lumpsum $salarytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $salarytypemonthly>Monthly</option>";
	echo "<option value=weekly $salarytypeweekly>Weekly</option>";
	echo "<option value=daily $salarytypedaily>Daily</option>";
	echo "<option value=others $salarytypeothers>Others</option>";
	echo "</select></td>";
	echo "<td>";
	if($net_of_tax == 'on') {
	  $netoftaxon = checked;
	} // if($net_of_tax == 'on')
	echo "<input class = 'mx-3'  placeholder ='00.00' type=\"checkbox\"  name=\"net_of_tax\" $netoftaxon>Net of Tax</td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end salary rate details

// 20190507
//	start fixed allowance details
	echo "<tr><td align=\"right\">Fixed Allowance</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' placeholder ='00.00' name=allow_fixed value=$allow_fixed></td>";
	if($allow_fixed_currency == 'usd') {
	  $allow_fixed_currencyusd = 'selected';
	} elseif ($allow_fixed_currency == 'php') {
	  $allow_fixed_currencyphp = 'selected';
	} else {
	  $allow_fixed_currencyothers = 'selected';
	} // if($allow_inc_currency == 'usd')
	echo "<td><select class = 'form-selector' name=allow_fixed_currency>";
	echo "<option value=php $allow_fixed_currencyphp>PhP</option>";
	echo "<option value=usd $allow_fixed_currencyusd>US$</option>";
	echo "<option value=others $allow_fixed_currencyothers>Others</option>";
	echo "</select></td>";
	if($allow_fixed_paytype == 'lumpsum') {
	  $allow_fixed_paytypelumpsum = 'selected';
	} else if($allow_fixed_paytype == 'monthly') {
	  $allow_fixed_paytypemonthly = 'selected';
	} else if($allow_fixed_paytype == 'weekly') {
	  $allow_fixed_paytypeweekly = 'selected';
	} else if($allow_fixed_paytype == 'daily') {
	  $allow_fixed_paytypedaily = 'selected';
	} else {
	  $allow_fixed_paytypeothers = 'selected';
	}
	echo "<td><select class = 'form-selector' name=allow_fixed_paytype>";
	echo "<option value=lumpsum $allow_fixed_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_fixed_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_fixed_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_fixed_paytypedaily>Daily</option>";
	echo "<option value=others $allow_fixed_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end fixed allowance details

//	start income allowance details
	echo "<tr><td align=\"right\">Incentive Allowance</td><td><table><tr><td><input  placeholder ='00.00' class = 'form-control' name=allow_inc value=$allow_inc></td>";
	if($allow_inc_currency == 'usd') {
	  $allow_inc_currencyusd = 'selected';
	} elseif ($allow_inc_currency == 'php') {
	  $allow_inc_currencyphp = 'selected';
	} else {
	  $allow_inc_currencyothers = 'selected';
	} // if($allow_inc_currency == 'usd')
	echo "<td><select class = 'form-selector' name=allow_inc_currency>";
	echo "<option value=php $allow_inc_currencyphp>PhP</option>";
	echo "<option value=usd $allow_inc_currencyusd>US$</option>";
	echo "<option value=others $allow_inc_currencyothers>Others</option>";
	echo "</select></td>";
	if($allow_inc_paytype == 'lumpsum') {
	  $allow_inc_paytypelumpsum = 'selected';
	} else if($allow_inc_paytype == 'monthly') {
	  $allow_inc_paytypemonthly = 'selected';
	} else if($allow_inc_paytype == 'weekly') {
	  $allow_inc_paytypeweekly = 'selected';
	} else if($allow_inc_paytype == 'daily') {
	  $allow_inc_paytypedaily = 'selected';
	} else {
	  $allow_inc_paytypeothers = 'selected';
	}
	echo "<td><select class = 'form-selector' name=allow_inc_paytype>";
	echo "<option value=lumpsum $allow_inc_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_inc_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_inc_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_inc_paytypedaily>Daily</option>";
	echo "<option value=others $allow_inc_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end income allowance details

//	start project allowance details
	echo "<tr><td align=\"right\">Project Allowance</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' name=allow_proj value=$allow_proj></td>";
	if($allow_proj_currency == 'usd') {
	  $allow_proj_currencyusd = 'selected';
	} else if($allow_proj_currency == 'php') {
	  $allow_proj_currencyphp = 'selected';
	} else {
	  $allow_proj_currencyothers = 'selected';
	} // if($allow_proj_currency == 'usd')
	echo "<td><select class = 'form-selector' name=allow_proj_currency>";
	echo "<option value=php $allow_proj_currencyphp>PhP</option>";
	echo "<option value=usd $allow_proj_currencyusd>US$</option>";
	echo "<option value=others $allow_proj_currencyothers>Others</option>";
	echo "</select></td>";
	if ($allow_proj_paytype == 'lumpsum') {
	  $allow_proj_paytypelumpsum = 'selected';
	} else if($allow_proj_paytype == 'monthly') {
	  $allow_proj_paytypemonthly = 'selected';
	} else if($allow_proj_paytype == 'weekly') {
	  $allow_proj_paytypeweekly = 'selected';
	} else if ($allow_proj_paytype == 'daily') {
	  $allow_proj_paytypedaily = 'selected';
	} else {
	  $allow_proj_paytypeothers = 'selected';
	}
	echo "<td><select class = 'form-selector' name=allow_proj_paytype>";
	echo "<option value=lumpsum $allow_proj_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_proj_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_proj_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_proj_paytypedaily>Daily</option>";
	echo "<option value=others $allow_proj_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end project allowance details

//	start field allowance details
	echo "<tr><td align=\"right\">Field Allowance</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' name=allow_field value=$allow_field></td>";
	if($allow_field_currency == 'usd') {
	  $allow_field_currencyusd = 'selected';
	} else if($allow_field_currency == 'php') {
	  $allow_field_currencyphp = 'selected';
	} else {
	  $allow_field_currencyothers = 'selected';
	} // if($allow_field_currency == 'usd')
	echo "<td><select class = 'form-selector' name=allow_field_currency>";
	echo "<option value=php $allow_field_currencyphp>PhP</option>";
	echo "<option value=usd $allow_field_currencyusd>US$</option>";
	echo "<option value=others $allow_field_currencyothers>Others</option>";
	echo "</select></td>";
	if($allow_field_paytype == 'lumpsum') {
	  $allow_field_paytypelumpsum = 'selected';
	} else if($allow_field_paytype == 'monthly') {
	  $allow_field_paytypemonthly = 'selected';
	} else if($allow_field_paytype == 'weekly') {
	  $allow_field_paytypeweekly = 'selected';
	} else if($allow_field_paytype == 'daily') {
	  $allow_field_paytypedaily = 'selected';
	} else {
	  $allow_field_paytypeothers = 'selected';
	} // if($allow_field_paytype == 'lumpsum')
	echo "<td><select class = 'form-selector' name=allow_field_paytype>";
	echo "<option value=lumpsum $allow_field_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_field_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_field_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_field_paytypedaily>Daily</option>";
	echo "<option value=others $allow_field_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end field allowance details

//	start accommodation allowance details
	echo "<tr><td align=\"right\">Accommodation Allowance</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' name=allow_accomm value=$allow_accomm></td>";
	if($allow_accomm_currency == 'usd') {
	  $allow_accomm_currencyusd = 'selected';
	} else if($allow_accomm_currency == 'php') {
	  $allow_accomm_currencyphp = 'selected';
	} else {
	  $allow_accomm_currencyothers = 'selected';
	} // if($allow_accomm_currency == 'usd')
	echo "<td><select class = 'form-selector' name=allow_accomm_currency>";
	echo "<option value=php $allow_accomm_currencyphp>PhP</option>";
	echo "<option value=usd $allow_accomm_currencyusd>US$</option>";
	echo "<option value=others $allow_accomm_currencyothers>Others</option>";
	echo "</select></td>";
	if($allow_accomm_paytype == 'lumpsum') {
	  $allow_accomm_paytypelumpsum = 'selected';
	} else if($allow_accomm_paytype == 'monthly') {
	  $allow_accomm_paytypemonthly = 'selected';
	} else if($allow_accomm_paytype == 'weekly') {
	  $allow_accomm_paytypeweekly = 'selected';
	} else if($allow_accomm_paytype == 'night') {
	  $allow_accomm_paytypenight = 'selected';
	}
	/*
	else if ($allow_accomm_paytype == 'daily')
	{
	  $allow_accomm_paytypedaily = 'selected';
	}
	*/
	else {
	  $allow_accomm_paytypeothers = 'selected';
	} // if($allow_accomm_paytype == 'lumpsum')
	echo "<td><select class = 'form-selector' name=\"allow_accomm_paytype\">";
	echo "<option value=\"lumpsum\" $allow_accomm_paytypelumpsum>Lumpsum</option>";
	echo "<option value=\"monthly\" $allow_accomm_paytypemonthly>Monthly</option>";
	echo "<option value=\"weekly\" $allow_accomm_paytypeweekly>Weekly</option>";
	echo "<option value=\"night\" $allow_accomm_paytypenight>Night</option>";
	// echo "<option value=daily $allow_accomm_paytypedaily>Daily</option>";
	echo "<option value=\"others\" $allow_accomm_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i><br>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end accommodation allowance details

//	start transportation allowance details
	echo "<tr><td align=\"right\">Transportation Allowance</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' name=allow_transpo value=$allow_transpo></td>";
	if($allow_transpo_currency == 'usd') {
	  $allow_transpo_currencyusd = 'selected';
	} else if($allow_transpo_currency == 'php') {
	  $allow_transpo_currencyphp = 'selected';
	} else {
	  $allow_transpo_currencyothers = 'selected';
	}
	echo "<td><select class = 'form-selector' name=allow_transpo_currency>";
	echo "<option value=php $allow_transpo_currencyphp>PhP</option>";
	echo "<option value=usd $allow_transpo_currencyusd>US$</option>";
	echo "<option value=others $allow_transpo_currencyothers>Others</option>";
	echo "</select></td>";
	if($allow_transpo_paytype == 'lumpsum') {
	  $allow_transpo_paytypelumpsum = 'selected';
	} else if($allow_transpo_paytype == 'monthly') {
	  $allow_transpo_paytypemonthly = 'selected';
	} else if($allow_transpo_paytype == 'weekly') {
	  $allow_transpo_paytypeweekly = 'selected';
	} else if($allow_transpo_paytype == 'daily') {
	  $allow_transpo_paytypedaily = 'selected';
	} else {
	  $allow_transpo_paytypeothers = 'selected';
	} // if($allow_transpo_paytype == 'lumpsum')
	echo "<td><select class = 'form-selector' name=allow_transpo_paytype>";
	echo "<option value=lumpsum $allow_transpo_paytypelumpsum>Lumpsum</option>";
	echo "<option value=monthly $allow_transpo_paytypemonthly>Monthly</option>";
	echo "<option value=weekly $allow_transpo_paytypeweekly>Weekly</option>";
	echo "<option value=daily $allow_transpo_paytypedaily>Daily</option>";
	echo "<option value=others $allow_transpo_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end transportation allowance details

//	start communication allowance details
	echo "<tr><td align=\"right\">Communication Allowance</td><td><table border=\"0\" spacing=\"0\"><tr><td><input class = 'form-control'  placeholder ='00.00' name=\"allow_comm\" value=\"$allow_comm\"></td>";
	if($allow_comm_currency == 'usd') {
	  $allow_comm_currencyusd = 'selected';
	} else if($allow_comm_currency == 'php') {
	  $allow_comm_currencyphp = 'selected';
	} else {
	  $allow_comm_currencyothers = 'selected';
	} // if($allow_comm_currency == 'usd')
	echo "<td><select class = 'form-selector' name=\"allow_comm_currency\">";
	echo "<option value=\"php\" $allow_comm_currencyphp>PhP</option>";
	echo "<option value=\"usd\" $allow_comm_currencyusd>US$</option>";
	echo "<option value=\"others\" $allow_comm_currencyothers>Others</option>";
	echo "</select></td>";
	if($allow_comm_paytype == 'lumpsum') {
	  $allow_comm_paytypelumpsum = 'selected';
	} else if($allow_comm_paytype == 'monthly') {
	  $allow_comm_paytypemonthly = 'selected';
	} else if($allow_comm_paytype == 'weekly') {
	  $allow_comm_paytypeweekly = 'selected';
	} else if($allow_comm_paytype == 'daily') {
	  $allow_comm_paytypedaily = 'selected';
	} else {
	  $allow_comm_paytypeothers = 'selected';
	} // if($allow_comm_paytype == 'lumpsum')
	echo "<td><select class = 'form-selector' name=\"allow_comm_paytype\">";
	echo "<option value=\"lumpsum\" $allow_comm_paytypelumpsum>Lumpsum</option>";
	echo "<option value=\"monthly\" $allow_comm_paytypemonthly>Monthly</option>";
	echo "<option value=\"weekly\" $allow_comm_paytypeweekly>Weekly</option>";
	echo "<option value=\"daily\" $allow_comm_paytypedaily>Daily</option>";
	echo "<option value=\"others\" $allow_comm_paytypeothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td><td><i>PayType</i></td></tr></table>";
	echo "</td></tr>";
//	end communication allowance details

//	start perdiem details
	echo "<tr><td align=\"right\">Per diem</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' name=perdiem value=$perdiem></td>";
	if($perdiem_currency == 'usd') {
	  $perdiem_currencyusd = 'selected';
	} else if($perdiem_currency == 'php') {
	  $perdiem_currencyphp = 'selected';
	} else {
	  $perdiem_currencyothers = 'selected';
	} // if($perdiem_currency == 'usd')
	echo "<td><select class = 'form-selector' name=perdiem_currency>";
	echo "<option value=php $perdiem_currencyphp>PhP</option>";
	echo "<option value=usd $perdiem_currencyusd>US$</option>";
	echo "<option value=others $perdiem_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end perdiem details

//	start ecola1
	echo "<tr><td align=\"right\">ECOLA 1</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' name=ecola1 value=\"$ecola1\"></td>";
	if($ecola1_currency == 'usd') {
	  $ecola1_currencyusd = 'selected';
	} else if($ecola1_currency == 'php') {
	  $ecola1_currencyphp = 'selected';
	} else {
	  $ecola1_currencyothers = 'selected';
	} // if($ecola1_currency == 'usd')
	echo "<td><select class = 'form-selector' name=ecola1_currency>";
	echo "<option value=php $ecola1_currencyphp>PhP</option>";
	echo "<option value=usd $ecola1_currencyusd>US$</option>";
	echo "<option value=others $ecola1_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end ecola1

//	start ecola2
	echo "<tr><td align=\"right\">ECOLA 2</td><td><table><tr><td><input class = 'form-control'  placeholder ='00.00' name=ecola2 value=\"$ecola2\"></td>";
	if($ecola2_currency == 'usd') {
	  $ecola2_currencyusd = 'selected';
	} else if($ecola2_currency == 'php') {
	  $ecola2_currencyphp = 'selected';
	} else {
	  $ecola2_currencyothers = 'selected';
	} // if($ecola2_currency == 'usd')
	echo "<td><select class = 'form-selector' name=ecola2_currency>";
	echo "<option value=php $ecola2_currencyphp>PhP</option>";
	echo "<option value=usd $ecola2_currencyusd>US$</option>";
	echo "<option value=others $ecola2_currencyothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>Amount</i></td><td><i>Currency</i></td></tr></table>";
	echo "</td></tr>";
//	end ecola2

//	start durations

	echo "<tr><td align=\"right\">Duration 1</td>";
	echo "<td>
	<table>";
	echo "<tr>
	<td><i>From</i></td>
	<td><input value = '$durationfrom' type='date' name='duration1from' class ='form-control'></td>";
	echo "<td><input class = 'form-control'   name=durationtotal size=8 value=\"$durationtotal\"><br><i><center>Total Duration</center></i></td>";
	if($durationtotprop == 'months') {
	  $durationtotpropmonths = 'selected';
	} else if($durationtotprop == 'days') {
	  $durationtotpropdays = 'selected';
	} else if($durationtotprop == 'hours') {
	  $durationtotprophours = 'selected';
	} else if($durationtotprop == 'years') {
	  $durationtotpropyears = 'selected';
	} else {
	  $durationtotpropothers = 'selected';
	} // if($durationtotprop == 'months')
	echo "<td ><select class = 'form-selector' name=durationtotprop>";
	echo "<option value=months $durationtotpropmonths>Months</option>";
	echo "<option value=days $durationtotpropdays>Days</option>";
	echo "<option value=hours $durationtotprophours>Hours</option>";
	echo "<option value=years $durationtotpropyears>Years</option>";
	echo "<option value=others $durationtotpropothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>To</i></td><td><input value = '$durationto' type='date' name='duration1to' class ='form-control'></td>";
	echo "</table></td></tr>";



	echo "<tr><td align=\"right\">Duration 2</td>";
	echo "<td><table>";
	echo "<tr><td><i>From</i></td><td><input value = '$durationfrom' type='date' name='duration2from' class ='form-control'></td>";
	echo "<td rowspan=2>&nbsp;</td>";
	echo "<td ><input class = 'form-control'   name=duration2total size=8 value=\"$duration2total\"><br><i><center>Total Duration</center></i></td>";
	if($duration2totprop == 'months') {
	  $duration2totpropmonths = 'selected';
	} else if($duration2totprop == 'days') {
	  $duration2totpropdays = 'selected';
	} else if($duration2totprop == 'hours') {
	  $duration2totprophours = 'selected';
	} else if($duration2totprop == 'years') {
	  $duration2totpropyears = 'selected';
	} else {
	  $duration2totpropothers = 'selected';
	} // if($duration2totprop == 'months')
	echo "<td ><select class = 'form-selector' name=duration2totprop>";
	echo "<option value=months $duration2totpropmonths>Months</option>";
	echo "<option value=days $duration2totpropdays>Days</option>";
	echo "<option value=hours $duration2totprophours>Hours</option>";
	echo "<option value=years $duration2totpropyears>Years</option>";
	echo "<option value=others $duration2totpropothers>Others</option>";
	echo "</select></td></tr>";
	echo "<tr><td><i>To</i></td><td><input value = '$durationto2' type='date' name='duration2to' class ='form-control'></td>";
	echo "</tr>";
	echo "</table></td></tr>";

	echo "<tr><td align=\"right\">Total Duration</td>";
	echo "<td><input class = 'form-control'  placeholder ='00.00' name=durationprojassigntot value=\"$durationprojassigntot\"></td>";
	if($durationprojassigntotprop == 'man-months') {
	  $durationprojassigntotpropmm = 'selected';
	} else if($durationprojassigntotprop == 'man-days') {
	  $durationprojassigntotpropmd = 'selected';
	} else if($durationprojassigntotprop == 'man-hours') {
	  $durationprojassigntotpropmh = 'selected';
	} else if($durationprojassigntotprop == 'man-years') {
	  $durationprojassigntotpropmy = 'selected';
	} else {
	  $durationprojassigntotpropot = 'selected';
	} // if($durationprojassigntotprop == 'man-months')
	echo "<td><select class = 'form-selector' name=durationprojassigntotprop>";
	echo "<option value=\"man-months\" $durationprojassigntotpropmm>Man-Months</option>";
	echo "<option value=\"man-days\" $durationprojassigntotpropmd>Man-Days</option>";
	echo "<option value=\"man-hours\" $durationprojassigntotpropmh>Man-Hours</option>";
	echo "<option value=\"man-years\" $durationprojassigntotpropmy>Man-Years</option>";
	echo "<option value=\"others\" $durationprojassigntotpropot>Others</option>";
	echo "</select></td></tr>";
//	end durations

	echo "<tr><td align=\"right\">Term_Resign</td><td><input value = '$term_resign' class = 'form-control' type = 'date' name='termresign'></td></tr>";

	echo "<tr><td align=\"right\">Remarks</td><td><textarea class ='form-control' placeholder='Remarks here..' name=remarks>$remarks</textarea></td></tr>";
	echo "<tr><td align=\"right\">Remarks2</td><td><textarea class ='form-control' placeholder='Remarks here..' name=remarks2>$remarks2</textarea></td></tr>";

	echo "<tr>";
	echo "<td align=\"right\">Attachment</td><td>";
	echo "<form action=\"\" method=\"\" name=\"\">";
	if($filename3 != "") {
    echo "<a href=\"$filepath3/$filename3\" target=\"_blank\">$filename3</a>&nbsp;&nbsp;&nbsp;<i><a href=\"persprojassigndelfile.php?loginid=$loginid&eid=$employeeid&pid=$projassignid\">Remove</a></i><br>";    
	} else {
    echo "<input class = 'form-control'  placeholder ='00.00' type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"20000000\" />";
    echo "<input class = 'form-control'  placeholder ='00.00' name=\"uploadedfile\" type=\"file\" />";		
	} // if($filename3 != "")
		echo "<button type='submit' class='btn btn-primary' name='btnCVfileupload' value=1></button>";
	echo "</form>";
	echo "</td>";

	echo "</tr>";


	echo "</table>";
?>
</div>
<style>
	.updatess{
		position: sticky !important;
		bottom: 20 !important;
		z-index: 1 !important;
	}
</style>
	<div class = 'updatess bg-white shadow my-2 border text-end p-4'> <a href="<?php echo 'personneledit2.php?loginid=' . $loginid . '&pid=' . $employeeid ?>" class=" mx-1  btn">
			 Cancel
		 </a><button class = 'mx-1   btn bg-success text-white'  type='submit' >Update</button></div>

<?php
	echo "</form>";
// end project assignments

     }

     // echo "<p><a href=\"personneledit2.php?loginid=$loginid&pid=$employeeid\" class='btn btn-default' role='button'>Back</a><br>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid"; 
		$result=$dbh2->query($resquery);

     include ("footer.php");
	 
	 ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	// Initialize Select2
	$(document).ready(function() {
$('.form-selector').select2();
});
</script>


<?php
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
