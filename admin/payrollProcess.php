<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff0 = (isset($_GET['idct'])) ? $_GET['idct'] :'';
$disptyp0 = (isset($_GET['dtyp'])) ? $_GET['dtyp'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';


// echo "idpaygrp: $idpaygroup <br> idcutoff: $idcutoff <br> disptyp: $disptyp <br> empid: $employeeid <br><br><br>";
// echo "idpaygrp2: $idpaygroup0 <br> idcutoff2: $idcutoff0 <br> disptyp2: $disptyp0  <br><br><br>";


// vars below incl in config.inc
// $yearMonths = 12;
// $workingHours = 8;
// $mealAllowanceAmount = 100;
// $transportAllowanceAmount = 60;
// vars below queried in tblemppayrollctg
// $yearWorkingDays = 314;
// $otPercentage = 1.25;
// $nightdiffPercentage = 0.10;
// $otRestdayPercentage = 1.3;
// $legalHolidayPercentage = 2.6;
// $specialHolidayPercentage = 1.69;


if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($idcutoff0 != "") { $idcutoff=$idcutoff0; }
if($disptyp0 != "") { $disptyp=$disptyp0; }

// echo "<p>vartest idpg:$idpaygroup, idct:$idcutoff, dtyp:$disptyp</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
	 $showDetail = 0;

	 if ($showDetail == 1){
		$dis = "d-none";
	 } else {
		$dis = "";

	 }
	 ?>
	 
<style>
	th{
		position: sticky !important;
		top: 55;
		white-space: nowrap !important;
	}
</style>

<?php
// edit body-header

// start contents here...

    // 20241113 get cutoff period dates based on $idcutoff
	$res10query=""; $result10=""; $found10=0; $ctr10=0;
	$res10query="SELECT cutstart, cutend, paygroupname FROM tblhrtacutoff WHERE idhrtapaygrp=$idpaygroup AND idhrtacutoff=$idcutoff";
	$result10=$dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10=$result10->fetch_assoc()) {
			$found10=1; $ctr10++;
			$cutstart10 = $myrow10['cutstart'];
			$cutend10 = $myrow10['cutend'];
			$paygroupname10 = $myrow10['paygroupname'];
		} //while
	} //if

    // query payroll rates
	$res11query=""; $result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT `idemppayrollctg`, `code`, `name`, `amount` FROM `tblemppayrollctg` ORDER BY `idemppayrollctg` ASC";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
	    while($myrow11=$result11->fetch_assoc()) {
        $found11=1; $ctr11++;
		$idemppayrollctg11 = $myrow11['idemppayrollctg'];
		$code11 = $myrow11['code'];
		$name11 = $myrow11['name'];
		$amount11 = $myrow11['amount'];
		if($code11=='dmwrate') { $dmwrate=$amount11; }
		else if($code11=='otordval') { $otPercentage=$amount11; }
		else if($code11=='otrestspval') { $otRestdayPercentage=$amount11; }
		else if($code11=='otrestsp8val') { $otrestsp8val=$amount11; }
		else if($code11=='otlegalval') { $legalHolidayPercentage=$amount11; }
		else if($code11=='otlegal8val') { $otlegal8val=$amount11; }
		else if($code11=='otspsunval') { $otspsunval=$amount11; }
		else if($code11=='otspsun8val') { $otspsun8val=$amount11; }
		else if($code11=='otlegalsunval') { $otlegalsunval=$amount11; }
		else if($code11=='otlegalsun8val') { $otlegalsun8val=$amount11; }
		else if($code11=='nightdiff') { $nightdiffPercentage=$amount11; }
		else if($code11=='pagibigee') { $pagibigee=$amount11; }
		else if($code11=='pagibiger') { $pagibiger=$amount11; }
		else if($code11=='transportAllowanceAmount') { $transportAllowanceAmount=$amount11; }
		else if($code11=='mealAllowanceAmount') { $mealAllowanceAmount=$amount11; }
		else if($code11=='yearWorkingDays') { $yearWorkingDays=$amount11; }
		else if($code11=='workingHours') { $workingHours=$amount11; }
		else if($code11=='yearMonths') { $yearMonths=$amount11; }
		} //while
	} //if
	
     echo "<table width=\"100%\" class='table table-striped table-hover table-bordered ' >";
	// echo "<tr><td colspan='21'><p>varpayctg: dmwrate:$yearWorkingDays, otordval:$otPercentage, otrestspval:$otRestdayPercentage, otrestsp8val:$otrestsp8val, otlegalval:$legalHolidayPercentage, otlegal8val:$otlegal8val, otspsunval:$otspsunval, otspsun8val:$otspsun8val, otlegalsunval:$otlegalsunval, otlegalsun8val:$otlegalsun8val, nightdiff:$nightdiffPercentage</p></td></tr>";
	echo "<tr><th>Employee</th>";
	// echo "<th>PrefTime</th><th colspan=\"2\">Date</th><th>TimeIN</th><th>TimeOUT</th>";
	// echo "<th>Hrs</th><th>OT</th><th>UT</th><th>OT/UT</th><th>Night diff</th>";
	// echo "<th>Rest Day Time</th>";
	// echo "<th>Special Holiday Time</th>";
	// echo "<th>Legal Holiday Time</th>";
	// echo "<th>Meal Allowances</th>";

	echo "<th>Employee Salary</th>";
	// echo "<th>Pay/day</th>";
	// echo "<th>Pay/hr</th>";
	echo "<th>Late/Absences</th>";
	echo "<th>Net Basic Pay</th>";
	echo "<th>Overtime</th>";
	if ($showDetail == 1){
	echo "<th>OT:OrdDay|RestDay|SpHoli|LegalHoli</th>";
	
	echo "<th>Allow:NightDiff|Meal|Transpo</th>"; }
	echo "<th>Taxable Income</th>";
	echo "<th>Other Income(Non-Taxable)</th>";
	echo "<th>Gross Pay</th>";
	echo "<th>Withholding Tax</th>";
	echo "<th>SSS</th>";
	echo "<th>Philhealth</th>";
	echo "<th>PAGIBIG</th>";
	echo "<th>Other Deductions</th>";
	echo "<th>Total Deductions</th>";
	echo "<th>Net Pay</th>";
	
	echo "</tr>";


	$res23query=""; $result23=""; $found23=0; $ctr23=0; $empidcurr=""; $empidnxt="";
	// $res23query="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblhrtaemptimelog.cutstart FROM tblhrtaemptimelog LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtapaygrpemplst.projcode != '' AND tblhrtaemptimelog.employeeid=tblcontact.employeeid ORDER BY tblhrtaemptimelog.employeeid ASC";
	$res23query="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblhrtaemptimelog.cutstart FROM tblhrtaemptimelog LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.employeeid=tblcontact.employeeid ORDER BY tblhrtaemptimelog.employeeid ASC";
	$result23 = $dbh2->query($res23query);

	if($result23->num_rows>0) {
		while($myrow23 = $result23->fetch_assoc()) {
		$found23 = 1;
		$ctr23 += 1;
		$employeeid23 = $myrow23['employeeid'];
		$name_last23 = $myrow23['name_last'];
		$name_first23 = $myrow23['name_first'];
		$name_middle23 = $myrow23['name_middle'];
		$cutoffStart = $myrow23['cutstart'];
		// $projcode23 = $myrow23['projcode'];

		$cutwhat=date("d", strtotime($cutoffStart));


		
		// echo "<br>$name_last23";
		// echo "<br>$res23query";

        // query projassignid if exists or query latest rec
		$res25query=""; $result25=""; $found25=0; $ctr25=0;
		$res25query="SELECT tblhrtapaygrpemplst.idhrtapaygrpemplst, tblhrtapaygrpemplst.projassignid, tblhrtapaygrpemplst.projcode FROM tblhrtapaygrpemplst WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid23\" AND  tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup";
		$result25=$dbh2->query($res25query);
		if($result25->num_rows>0) {
			while($myrow25=$result25->fetch_assoc()) {
				$found25=1;
				$idhrtapaygrpemplst25 = $myrow25['idhrtapaygrpemplst'];
				$projassignid25 = $myrow25['projassignid'];
				$projcode25 = $myrow25['projcode'];
			} //while
		} //if
		
		//get proj short name
		if($found25==1 && $projcode25!="") {
			$res25bquery=""; $result25b=""; $found25=0;
			$res25bquery="SELECT proj_sname FROM tblproject1 WHERE proj_code=\"$projcode25\"";
			$result25b=$dbh2->query($res25bquery);
			if($result25b->num_rows>0) {
				while($myrow25b=$result25b->fetch_assoc()) {
					$proj_sname25b = $myrow25b['proj_sname'];
					if($proj_sname25b=="") {
						$proj_sname25b=$projcode25;
					}//if
				} //while
			} //if
		} //if

		
		echo "";

        if($found25!=0 && ($projassignid25!=0 || $projcode25!="")) {
			if($projcode!="") {
		$res3query = "SELECT tblprojassign.projassignid, tblprojassign.projdate, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign.employeeid0, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.empprojctr, tblprojassign.position, tblprojassign.salary, tblprojassign.salarycurrency, tblprojassign.salarytype, tblprojassign.allow_inc, tblprojassign.allow_inc_currency, tblprojassign.allow_inc_paytype, tblprojassign.allow_proj, tblprojassign.allow_proj_currency, tblprojassign.allow_proj_paytype, tblprojassign.ecola1, tblprojassign.ecola1_currency, tblprojassign.ecola2, tblprojassign.ecola2_currency, tblprojassign.allow_field_currency, tblprojassign.allow_field_paytype, tblprojassign.allow_field, tblprojassign.allow_accomm, tblprojassign.allow_accomm_currency, tblprojassign.allow_accomm_paytype, tblprojassign.allow_transpo, tblprojassign.allow_transpo_currency, tblprojassign.allow_transpo_paytype, tblprojassign.allow_comm, tblprojassign.allow_comm_currency, tblprojassign.allow_comm_paytype, tblprojassign.perdiem, tblprojassign.perdiem_currency, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.durationtotal, tblprojassign.durationtotprop, tblprojassign.durationfrom2, tblprojassign.durationto2, tblprojassign.duration2total, tblprojassign.duration2totprop, tblprojassign.durationprojassigntot, tblprojassign.durationprojassigntotprop, tblprojassign.term_resign, tblprojassign.remarks, tblprojassign.remarks2, tblprojassign.net_of_tax, tblprojassign.filepath, tblprojassign.filename, tblprojassign.idhrpositionctg FROM tblprojassign WHERE employeeid=\"$employeeid23\" AND proj_code=$projcode25";				
			} else {
		$res3query = "SELECT tblprojassign.projassignid, tblprojassign.projdate, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign.employeeid0, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.empprojctr, tblprojassign.position, tblprojassign.salary, tblprojassign.salarycurrency, tblprojassign.salarytype, tblprojassign.allow_inc, tblprojassign.allow_inc_currency, tblprojassign.allow_inc_paytype, tblprojassign.allow_proj, tblprojassign.allow_proj_currency, tblprojassign.allow_proj_paytype, tblprojassign.ecola1, tblprojassign.ecola1_currency, tblprojassign.ecola2, tblprojassign.ecola2_currency, tblprojassign.allow_field_currency, tblprojassign.allow_field_paytype, tblprojassign.allow_field, tblprojassign.allow_accomm, tblprojassign.allow_accomm_currency, tblprojassign.allow_accomm_paytype, tblprojassign.allow_transpo, tblprojassign.allow_transpo_currency, tblprojassign.allow_transpo_paytype, tblprojassign.allow_comm, tblprojassign.allow_comm_currency, tblprojassign.allow_comm_paytype, tblprojassign.perdiem, tblprojassign.perdiem_currency, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.durationtotal, tblprojassign.durationtotprop, tblprojassign.durationfrom2, tblprojassign.durationto2, tblprojassign.duration2total, tblprojassign.duration2totprop, tblprojassign.durationprojassigntot, tblprojassign.durationprojassigntotprop, tblprojassign.term_resign, tblprojassign.remarks, tblprojassign.remarks2, tblprojassign.net_of_tax, tblprojassign.filepath, tblprojassign.filename, tblprojassign.idhrpositionctg FROM tblprojassign WHERE employeeid=\"$employeeid23\" AND projassignid=$projassignid25";				
			}
			
		} else {
		$res3query = "SELECT tblprojassign.projassignid, tblprojassign.projdate, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign.employeeid0, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.empprojctr, tblprojassign.position, tblprojassign.salary, tblprojassign.salarycurrency, tblprojassign.salarytype, tblprojassign.allow_inc, tblprojassign.allow_inc_currency, tblprojassign.allow_inc_paytype, tblprojassign.allow_proj, tblprojassign.allow_proj_currency, tblprojassign.allow_proj_paytype, tblprojassign.ecola1, tblprojassign.ecola1_currency, tblprojassign.ecola2, tblprojassign.ecola2_currency, tblprojassign.allow_field_currency, tblprojassign.allow_field_paytype, tblprojassign.allow_field, tblprojassign.allow_accomm, tblprojassign.allow_accomm_currency, tblprojassign.allow_accomm_paytype, tblprojassign.allow_transpo, tblprojassign.allow_transpo_currency, tblprojassign.allow_transpo_paytype, tblprojassign.allow_comm, tblprojassign.allow_comm_currency, tblprojassign.allow_comm_paytype, tblprojassign.perdiem, tblprojassign.perdiem_currency, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.durationtotal, tblprojassign.durationtotprop, tblprojassign.durationfrom2, tblprojassign.durationto2, tblprojassign.duration2total, tblprojassign.duration2totprop, tblprojassign.durationprojassigntot, tblprojassign.durationprojassigntotprop, tblprojassign.term_resign, tblprojassign.remarks, tblprojassign.remarks2, tblprojassign.net_of_tax, tblprojassign.filepath, tblprojassign.filename, tblprojassign.idhrpositionctg FROM tblprojassign WHERE employeeid=\"$employeeid23\" AND durationto=\"0000-00-00\" AND tblprojassign.salary<>0 ORDER BY projassignid DESC LIMIT 1";			
		} //if-else


// echo "$res3query <br>";
	
		// echo "Has($found25,$projassignid25) $res3query<br><br>";
			$result3=""; $found3=0; $ctr3=0;
			$result3=$dbh2->query($res3query);
			if($result3->num_rows>0) {
				while($myrow3=$result3->fetch_assoc()) {
			  $found3 = 1; $ctr3++;
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
			  $filepath3 = $myrow3['filepath3'];
			  $filename3 = $myrow3['filename3'];
				$idhrpositionctg3 = $myrow3['idhrpositionctg'];
				} // while($myrow3=$result3->fetch_assoc())
			} // if($result3->num_rows>0)
// echo "$ref_no <br>";
			// echo "<h1>$res3query Here</h1>";
		// $res24query="SELECT tblhrtaemptimelog.idhrtaemptimelog, tblhrtaemptimelog.logdate, tblhrtaemptimelog.timein, tblhrtaemptimelog.timeout, tblhrtaemptimelog.otbeforeinsw, tblhrtaemptimelog.otafteroutsw, tblhrtaemptimelog.restdaysw,  tblhrtaemptimelog.nextdaysw, tblhrtaemptimelog.mealallowsw, tblhrtaemptimelog.transpo, tblhrtaemptimelog.leavetype, tblhrtaemptimelog.leaveduration,  tblhrtaemptimelog.manualcompsw, tblhrtaemptimelog.totaltime, tblhrtaemptimelog.otval, tblhrtaemptimelog.utval, tblhrtaemptimelog.otutval, tblhrtaemptimelog.nightdiffval, tblhrtaemptimelog.nootsw, tblhrtaemptimelog.noutsw, tblhrtaemptimelog.projcharge, tblhrtaemptimelog.projpercent, tblhrtaemptimelog.nofindings, tblhrtaemptimelog.remarks, tblhrtaemptimelog.leaveid, tblhrtaemptimelog.holiday, tblhrtaemptimelog.timein2, tblhrtaemptimelog.timeout2,  tblhrtaemptimelog.nextday2insw, tblhrtaemptimelog.nextday2outsw, tblhrtaemptimelog.otordval, tblhrtaemptimelog.otrestval, tblhrtaemptimelog.otlegalval, tblhrtaemptimelog.otrest8val, tblhrtaemptimelog.otspsunval, tblhrtaemptimelog.otspsun8val, tblhrtaemptimelog.otlegal8val, tblhrtaemptimelog.otlegalsunval, tblhrtaemptimelog.otlegalsun8val, tblhrtaemptimelog.otspval, tblhrtaemptimelog.otsp8val, tblhrtapaygrpemplst.contactid, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday, tblhrtapaygrpemplst.projcode, tblhrtapaygrpemplst.activesw, tblhrtapayshiftctg.shiftin, tblhrtaholidays.holidaytype FROM tblhrtaemptimelog LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid LEFT JOIN tblhrtapayshiftctg ON tblhrtapaygrpemplst.idhrtapayshiftctg=tblhrtapayshiftctg.idhrtapayshiftctg LEFT JOIN tblhrtaholidays ON tblhrtaemptimelog.logdate=tblhrtaholidays.applic_date LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtaemptimelog.employeeid=\"$employeeid23\" AND  tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.employeeid=tblcontact.employeeid GROUP BY idhrtaemptimelog ORDER BY tblhrtaemptimelog.employeeid ASC";

		$res24query="SELECT 
    SUM(tblhrtaemptimelog.totaltime) AS total_time,
    SUM(tblhrtaemptimelog.otval) AS total_otval,
    SUM(tblhrtaemptimelog.utval) AS total_utval,
    SUM(tblhrtaemptimelog.otutval) AS total_otutval,
    SUM(tblhrtaemptimelog.nightdiffval) AS total_nightdiffval,
    SUM(tblhrtaemptimelog.otordval) AS total_otordval,
    SUM(tblhrtaemptimelog.otrestval) AS total_otrestval,
    SUM(tblhrtaemptimelog.otlegalval) AS total_otlegalval,
    SUM(tblhrtaemptimelog.otrest8val) AS total_otrest8val,
    SUM(tblhrtaemptimelog.otspsunval) AS total_otspsunval,
    SUM(tblhrtaemptimelog.otspsun8val) AS total_otspsun8val,
    SUM(tblhrtaemptimelog.otlegal8val) AS total_otlegal8val,
    SUM(tblhrtaemptimelog.otlegalsunval) AS total_otlegalsunval,
    SUM(tblhrtaemptimelog.otlegalsun8val) AS total_otlegalsun8val,
    SUM(tblhrtaemptimelog.otspval) AS total_otspval,
    SUM(tblhrtaemptimelog.otsp8val) AS total_otsp8val,
    SUM(tblhrtaemptimelog.mealallowsw) AS total_mealallowsw,
    SUM(tblhrtaemptimelog.transpo) AS total_transpo



FROM 
    tblhrtaemptimelog
WHERE 
    tblhrtaemptimelog.employeeid = $employeeid23 
    AND tblhrtaemptimelog.idpaygroup = $idpaygroup 
    AND tblhrtaemptimelog.idcutoff = $idcutoff ";
	
		$result24=""; $found24=0; $ctr24=0;
		$result24 = $dbh2->query($res24query);


		// echo "$res24query<br>";

		if($result24->num_rows>0) {
			while($myrow24 = $result24->fetch_assoc()) {
			$found24=1;
			$logdate24 = $myrow24['logdate'];
			$timein24 = $myrow24['timein'];
			$timeout24 = $myrow24['timeout'];
			$otbeforeinsw24 = $myrow24['otbeforeinsw'];
			$otafteroutsw24 = $myrow24['otafteroutsw'];
			$restdaysw24 = $myrow24['restdaysw'];
			$nextdaysw24 = $myrow24['nextdaysw'];
			$mealallowsw24 = $myrow24['mealallowsw'];
			$transpo24 = $myrow24['transpo'];
			$leavetype24 = $myrow24['leavetype'];
			$leaveduration24 = $myrow24['leaveduration'];
			$manualcompsw24 = $myrow24['manualcompsw'];
			$totaltime24 = $myrow24['totaltime'];
			$otval24 = $myrow24['otval'];
			$total_utval = $myrow24['utval'];
			$otutval24 = $myrow24['otutval'];
			$nightdiffval24 = $myrow24['nightdiffval'];
			$nootsw24 = $myrow24['nootsw'];
			$noutsw24 = $myrow24['noutsw'];
			$projcharge24 = $myrow24['projcharge'];
			$projpercent24 = $myrow24['projpercent'];
			$nofindings24 = $myrow24['nofindings'];
			$remarks24 = $myrow24['remarks'];
			
			$leaveid24 = $myrow24['leaveid'];
			$holiday24 = $myrow24['holiday'];
			
			$timein224 = $myrow24['timein2'];
			$timeout224 = $myrow24['timeout2'];
			$nextday2insw24 = $myrow24['nextday2insw'];
			$nextday2outsw24 = $myrow24['nextday2outsw'];
			
			// $otordval24 = $myrow24['otordval'];
			// $otrestval24 = $myrow24['otrestval'];
			// $otlegalval24 = $myrow24['otlegalval'];
			// $otrest8val24 = $myrow24['otrest8val'];
			// $otspsunval24 = $myrow24['otspsunval'];
			// $otspsun8val24 = $myrow24['otspsun8val'];
			// $otlegal8val24 = $myrow24['otlegal8val'];
			// $otlegalsunval24 = $myrow24['otlegalsunval'];
			// $otlegalsun8val24 = $myrow24['otlegalsun8val'];
			// $otspval24 = $myrow24['otspval'];
			// $otsp8val24 = $myrow24['otsp8val'];


			$total_time = $myrow24['total_time'];
			$total_otval = $myrow24['total_otval'];
			$total_utval = $myrow24['total_utval'];
			$total_otutval = $myrow24['total_otutval'];
			$total_nightdiffval = $myrow24['total_nightdiffval'];

			$total_otordval = $myrow24['total_otordval'];
			$total_otrestval = $myrow24['total_otrestval'];
			$total_otlegalval = $myrow24['total_otlegalval'];
			$total_otrest8val = $myrow24['total_otrest8val'];
			$total_otspsunval = $myrow24['total_otspsunval'];
			$total_otspsun8val = $myrow24['total_otspsun8val'];
			$total_otlegal8val = $myrow24['total_otlegal8val'];
			$total_otlegalsunval = $myrow24['total_otlegalsunval'];
			$total_otlegalsun8val = $myrow24['total_otlegalsun8val'];
			$total_otspval = $myrow24['total_otspval'];
			$total_otsp8val = $myrow24['total_otsp8val'];

			$total_mealallowsw = $myrow24['total_mealallowsw'];
			$total_transpo = $myrow24['total_transpo'];


				// echo " <h1>$total_mealallowsw HERE</h1>";
			
			
			$contactid24 = $myrow24['contactid'];
			$bankacctid24 = $myrow24['bankacctid'];
			$restday24 = $myrow24['restday'];
			$projcode24 = $myrow24['projcode'];
			$activesw24 = $myrow24['activesw'];
			$shiftin24 = $myrow24['shiftin'];
			$holidaytype24 = $myrow24['holidaytype'];



		
			} // while($myrow24 = $result24->fetch_assoc())
		} // if($result24->num_rows>0)

		$res241query="SELECT
	SUM(tblhrtaemptimelog.leaveduration) AS leaveduration,
	leavetype
	FROM 
		tblhrtaemptimelog
	WHERE 
		tblhrtaemptimelog.employeeid = $employeeid23 
		AND tblhrtaemptimelog.idpaygroup = $idpaygroup 
		AND tblhrtaemptimelog.idcutoff = $idcutoff 
		AND (leavetype  = 'vacation' OR leavetype  = 'sick' OR  leavetype  = 'sd')";
		$result241 = $dbh2->query($res241query);
		if($result241->num_rows>0) {
			while($myrow241 = $result241->fetch_assoc()) {
				$leavetype241 = $myrow241['leavetype'];
				$leaveduration241 = $myrow241['leaveduration'];
			}
		}

		
// echo "$res241query <br>";
		// echo "<tr><td colspan=\"5\">display summary eid:$employeeid23, curr:$empidcurr, nxt:$empidnxt</td></tr>";
		// display total
			$ctr23b += 1;
			$perDay = (($salary*$yearMonths) / $yearWorkingDays );
			$perHr = $perDay/$workingHours;

			// echo "$perHr <br>";
		// 20241112 new computations
		// A.1. Overtime of ordinary days
		if($total_otordval!=0 || $total_otordval!='') {
			$otordamt = $total_otordval * $otPercentage * $perHr;
		} else {
			$otordamt=0;
		} //if-else

	

		// 2. Overtime during Rest days
	    if($total_otrestval!=0 || $total_otrestval!='') {
			$otrestamt = $total_otrestval * $otRestdayPercentage * $perHr;
		} else {
			$otrestamt=0;
		} //if-else

		// 3. Overtime during Rest days in excess of 8 Hrs
	    if($total_otrest8val!=0 || $total_otrest8val!='') {
			$otrest8amt = $total_otrest8val * $otrestsp8val * $perHr;
		} else {
			$otrest8amt=0;
		} //if-else
		// 4. OT on Special Holiday
	    if($total_otspval!=0 || $total_otspval!='') {
			$otspamt = $total_otspval * $otRestdayPercentage * $perHr;
		} else {
			$otspamt=0;
		} //if-else
		// 5. OT on Special Holiday in excess of 8 hrs.
	    if($total_otsp8val!=0 || $total_otsp8val!='') {
			$otsp8amt = $total_otsp8val * $otrestsp8val * $perHr;
		} else {
			$otsp8amt=0;
		} //if-else
		// 6. OT on Special Holiday that falls on a Sunday
	    if($total_otspsunval!=0 || $total_otspsunval!='') {
			$otspsunamt = $total_otspsunval * $otspsunval * $perHr;
		} else {
			$otspsunamt=0;
		} //if-else
		// 7. OT on Special Holiday during Sunday in excess of 8hrs.
	    if($total_otspsun8val!=0 || $total_otspsun8val!='') {
			$otspsun8amt = $total_otspsun8val * $otspsun8val * $perHr;
		} else {
			$otspsun8amt=0;
		} //if-else
		// 8. OT on Legal Holiday (for ordinary days - not Sunday)
	    if($total_otlegalval!=0 || $total_otlegalval!='') {
			$otlegalamt = $total_otlegalval * $legalHolidayPercentage * $perHr;
		} else {
			$otlegalamt=0;
		} //if-else
		// 9. OT on Legal Holiday (for ordinary days) in excess of 8hrs.
	    if($total_otlegal8val!=0 || $total_otlegal8val!='') {
			$otlegal8amt = $total_otlegal8val * $otlegal8val * $perHr;
		} else {
			$otlegal8amt=0;
		} //if-else
		// 10. OT on Legal Holiday during Sunday
	    if($total_otlegalsunval!=0 || $total_otlegalsunval!='') {
			$otlegalsunamt = $total_otlegalsunval * $otlegalsunval * $perHr;
		} else {
			$otlegalsunamt=0;
		} //if-else
		// 11. OT on Legal Holiday during Sunday in excess of 8hrs.
	    if($total_otlegalsun8val!=0 || $total_otlegalsun8val!='') {
			$otlegalsun8amt = $total_otlegalsun8val * $otlegalsun8val * $perHr;
		} else {
			$otlegalsun8amt=0;
		} //if-else


	    // C. Night Differential //relocate before compute total OT on 20250513 fr after B. UT compute
		if($total_nightdiffval!=0 || $total_nightdiffval!='') {
			$nightdiffamt = $total_nightdiffval * ($perHr * .10);
		} else {
			$nightdiffamt=0;
		} //if-else
		//
	    // compute total OT
		$otvaltot = $total_otordval + $total_otrestval + $total_otrest8val + $total_otspval + $otsp8val24 + $total_otspsunval + $total_otspsun8val + $total_otlegalval + $total_otlegal8val + $total_otlegalsunval + $total_otlegalsun8val + $total_nightdiffval;
		// echo "$otvaltot";
		if($otval24==$otvaltot) {
			$otvaltrue=1;
		} else {
			$otvaltrue=0;
		} //if-else
		if($otvaltrue==1) {
		    // compute amount for overtime
		    $otamttot = $otordamt + $otrestamt + $otrest8amt + $otspamt + $otsp8amt + $otspsunamt + $otspsun8amt + $otlegalamt + $otlegal8amt + $otlegalsunamt + $otlegalsun8amt + $nightdiffamt; 
        } else {
			$otamttot=0;
		} //if-else

		// B. Undertime computations
		// get hourly rates first
		$perHr = (($salary*$yearMonths) / $yearWorkingDays ) / $workingHours;		
        if($total_utval!=0 || $total_utval!='') {
            $utamt = $total_utval * $perHr;
		} else {
			$utamt=0;
		} //if-else
				
	    // D. Transporation Allowance
		if($total_transpo!=0 || $transpo24!='') {
			$transpoamt = $total_transpo * $transportAllowanceAmount;
		} else {
			$transpoamt=0;
		} //if-else
		
	    // E. Meal Allowance
		if($total_mealallowsw!=0 || $total_mealallowsw!='') {
			$mealallowamt = $total_mealallowsw * $mealAllowanceAmount;
		} else {
			$mealallowamt=0;
		} //if-else
			
		// F. Salary Deduction (SD)
		$res22query=""; $result22=""; $found22=0; $ctr22=0; $sdtotval=0; $sdtotamt=0;
		$res22query="SELECT id, count, identifier FROM leavesaver WHERE empid=\"$employeeid23\" AND grpid=$idpaygroup AND (leavecode=\"sd\" OR leavecode=\"hsd\") AND (leavedays BETWEEN \"$cutstart10\" AND \"$cutend10\")";
		$result22=$dbh2->query($res22query);
		if($result22->num_rows>0) {
			while($myrow22=$result22->fetch_assoc()) {
				$found22=1; $ctr22++;
				$id22 = $myrow22['id'];
				$count22 = $myrow22['count'];
				$identifier22 = $myrow22['identifier'];				
				$sdtotval += $count22;
			} //while
		} //if
		if($sdtotval>0) {
			$sdtotamt = $sdtotval * $perDay;
		} else {
			$sdtotamt = 0;
		} //if-else

        // echo "<tr><td colspan='21'><p>r3q: $res3query<br>r24q: $res24query</p></td></tr>";
/* start hide old codes
			if($tot_totaltime!=0) {
			// echo "<td align=\"right\">".number_format($tot_totaltime, 2)."</td>";
			} else {
			// echo "<td align=\"center\">-</td>";
			}
			if($tot_otval!=0) {
			// echo "<td align=\"right\">".number_format($tot_otval, 2)."</td>";
				$overtimesubtot = ($perHr * $otPercentage)  * $tot_otval;
			} else {
				$overtimesubtot = 0;
			// echo "<td align=\"center\">-</td>";
			}

			if($tot_utval!=0) {
				if($tot_utval<0) {
				// echo "<td align=\"right\"><font color=\"red\">".number_format($tot_utval, 2)."</font></td>";
				$latesubtot = $perHr * $tot_utval * -1;
				} else {
				// echo "<td align=\"right\">".number_format($tot_utval, 2)."</td>";
				}
			} else {
			// echo "<td align=\"center\">-</td>";
			}
			if($tot_otutval!=0) {
				if($tot_otutval<0) {
				// echo "<td align=\"right\"><font color=\"red\">".number_format($tot_otutval, 2)."</font></td>";
				} else {
				// echo "<td align=\"right\">".number_format($tot_otutval, 2)."</td>";
				}
			} else {
			// echo "<td align=\"center\">-</td>";
			}
			if($tot_ndval!=0) {
			// echo "<td align=\"right\">".number_format($tot_ndval, 2)."</td>";
			$nigthdifsubtot = ($perHr * $nightdiffPercentage) * $tot_ndval;
			} else {
			// echo "<td align=\"center\">-</td>";
			}

			if($tot_restdaytime!=0) {
			// echo "<td align=\"center\">$tot_restdaytime</td>";
			} else {
			// echo "<td align=\"center\">-</td>";
			}

			if($tot_specialholidaytime!=0) {
			// echo "<td align=\"center\">$tot_specialholidaytime</td>";
			} else {
			// echo "<td align=\"center\">-</td>";
			}

			if($tot_legalholidaytime!=0) {
			// echo "<td align=\"center\">$tot_legalholidaytime</td>";
			} else {
			// echo "<td align=\"center\">-</td>";
			}

			if($tot_meal!=0) {
			// echo "<td align=\"center\">$tot_meal</td>";
			} else {
			// echo "<td align=\"center\">-</td>";
			}
*/
			echo "<tr><td>$name_last23, $name_first23 $name_middle23[0] ($employeeid23)</td>";

			$empsalaryhf = $salary;

            echo "<td align=\"center\">";
			if($empsalaryhf!=0) {
			    echo number_format($empsalaryhf,2); 
			} else {
			    echo "-";
			} //if-else
				echo "</td>";

			// $netbasicpay = $empsalaryhf - ($latesubtot);
			// if($tot_totaltime >= 80) {
				$totalSalary = $salary / 2;
			// } else {
			//	$totalSalary = $tot_totaltime*$perHr;
			// } //if-else

            echo "<td class=''>";
            /* if($latesubtot>0) {
				echo number_format($latesubtot,2);
			} else {
				echo "-";
			} //if-else */

			if ($showDetail == 1){
				if($utamt>0) {
					echo $total_utval.",".$perHr."|".number_format($utamt,2);
					// echo number_format($utamt,2);
				} else {
					echo "-";
				} //if-else
			} else {
				// echo "Total Under time: $total_utval <br><br>  Converted Amount: $utamt";
				echo number_format($utamt,2);
			}


			echo "</td>";

			// $netbasicpay = $totalSalary - $latesubtot;
			$netbasicpay = $totalSalary - $utamt;
			
            echo "<td class=''>";
			if($netbasicpay>0) {
				echo number_format($netbasicpay, 2);
			} else {
				echo "-";
			} //if-else
			echo "</td>";
			$otvaltot = $total_otordval + $total_otrestval + $total_otrest8val + $total_otspval + $otsp8val24 + $total_otspsunval + $total_otspsun8val + $total_otlegalval + $total_otlegal8val + $total_otlegalsunval + $total_otlegalsun8val + $total_nightdiffval;

			$otamttot = $otordamt + $otrestamt + $otrest8amt + $otspamt + $otsp8amt + $otspsunamt + $otspsun8amt + $otlegalamt + $otlegal8amt + $otlegalsunamt + $otlegalsun8amt + $nightdiffamt; 
			
            // echo "<td class=''> ";
			// /* if($overtimesubtot>0) {
			// 	echo number_format($overtimesubtot, 2);
			// } else {
			// 	echo "-";
			// } //if-else */
			// if ($showDetail == 1){
			// 	if($otvaltot>0) {
			// 		echo $otvaltot."|".number_format($otamttot,2);
			// 		// echo number_format($otamttot,2);
			// 	} else {
			// 		echo "-";
			// 	} //if-else
			// }else {
			// 	echo number_format($otamttot,2);
				
			// 	// echo "Total Overtime: $otvaltot <br> <br> Converted Amount:" .number_format($otamttot,2);
			// }
			// echo "</td>";

			if ($showDetail == 1){
		    // test disp OT brkdowns
		    echo "<td>";
			echo "$total_otval * $otPercentage * $perHr<br>";
			echo "ord:".$total_otordval.":(".$otordamt.")|<br>
			rest:".$total_otrestval.":(".$otrestamt.")|<br>
			rest8:".$total_otrest8val.":(".$otrest8amt.")|<br>
			sp:".$otspval24.":(".$otspamt.")|<br>
			sp8:".$otsp8val24.":(".$otsp8amt.")|<br>
			spsun:".$otspsunval24.":(".$otspsunamt.")|<br>
			spsun8:".$otspsun8val24.":(".$otspsun8amt.")|<br>
			legal:".$otlegalval24.":(".$otlegalamt.")|<br>
			legal8:".$otlegal8val24.":(".$otlegal8amt.")|<br>
			legalsun:".$otlegalsunval24.":(".$otlegalsunamt.")|<br>
			legalsun8:".$otlegalsun8val24.":(".$otlegalsun8amt;
			echo "</td>";
			
			// test disp allowances
			echo "<td>";
			echo "nd:".$total_nightdiffval."*".$perHr.": (".$nightdiffamt." ) |
			 <br>transpo:".$total_transpo."*".$transportAllowanceAmount.": (".$transpoamt.") |
			 <br>meal:".$total_mealallowsw."*".$mealAllowanceAmount.": (".$mealallowamt;
			echo "</td>";
			} else {
			// $overtimesubtotal = $otamttot + $nightdiffamt;
			$overtimesubtotal = $otamttot; //20250513

				echo "<td>".number_format($overtimesubtotal,2)."</td>";
			}
/*
				$totalRestday = ($perHr * $otRestdayPercentage)  * $tot_restdaytime;
				$totalLegalHoliday = ($perHr * $legalHolidayPercentage)  * $tot_legalholidaytime;
				$totalSpecialHoliday = ($perHr * $specialHolidayPercentage)  * $tot_specialholidaytime;
				$totalMealAllowance = $mealAllowanceAmount * $tot_meal;
*/

			// $overtimesubtotal = $overtimesubtot + $nigthdifsubtot + $totalLegalHoliday + $totalSpecialHoliday + $totalRestday;
			// $overtimesubtotal = $otamttot + $nightdiffamt + $transpoamt + $mealallowamt;
			$overtimesubtotal = $otamttot + $transpoamt + $mealallowamt;
			// $overtimeTaxable = $otamttot + $nightdiffamt;
			$overtimeTaxable = $otamttot;
			$comprate = $netbasicpay + $totalVatableIncome + $overtimeTaxable;

			// echo "<td align=\"center\">";
			// echo number_format($perDay,2);
			// echo "</td>";

			// echo "<td align=\"center\">";
			// echo number_format($perHr,2);
			// echo "</td>";

			// echo "<td align=\"center\">";
			// echo number_format($overtimesubtot,2);
			// echo "</td>";

			// echo "<td align=\"center\">";
			// echo number_format($nigthdifsubtot,2);
			// echo "</td>";

			// echo "<td align=\"center\">";
			// echo number_format($totalRestday,2);
			// echo "</td>";

			// echo "<td align=\"center\">";
			// echo number_format($totalSpecialHoliday,2);
			// echo "</td>";

			// echo "<td align=\"center\">";
			// echo number_format($totalLegalHoliday,2);
			// echo "</td>";

			// echo "<td align=\"center\">";
			// echo number_format($totalMealAllowance,2);
			// echo "</td>";
			
			//additonal incomes

			$result15=""; $found15=0; $ctr15=0;
			// $res15query = "SELECT idhrtaempincome, name, amount, datestart, dateend, nontaxable, vatinclusive, status, schedule FROM tblhrtaempincome WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid23\" ORDER BY dateend DESC, datestart DESC";
			$res15query = "SELECT idhrtaempincome, name, amount, datestart, dateend, nontaxable, vatinclusive, status, schedule, projassignid, allowtyp, lumpsumsw, amtlumpsumtotal, amtlumpsumbalance FROM tblhrtaempincome WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid23\" AND (datestart<=\"$cutstart10\" AND dateend>=\"$cutend10\") AND status=1 ORDER BY dateend DESC, datestart DESC";
			// echo $res15query."<br>"; changed datestart<=\"$cutstart10\" AND dateend>=\"$cutend10\" from datestart>=\"$cutstart10\" AND dateend<=\"$cutend10\"

				$result15 = $dbh2->query($res15query);
				// echo $res15query ."<br>";
				$totalVatableIncome = 0; 
				$totalNonvatableIncome = 0;
				if($result15->num_rows>0) {	
					while($myrow15 = $result15->fetch_assoc()) {
					$found15 = 1;
					$idhrtaempincome15 = $myrow15['idhrtaempincome'];
					$name15 = $myrow15['name'];
					$amount15 = $myrow15['amount'];
					$datestart15 = $myrow15['datestart'];
					$dateend15 = $myrow15['dateend'];
					$nontaxable15 = $myrow15['nontaxable'];
					$vatinclusive15 = $myrow15['vatinclusive'];
					$status15 = $myrow15['status'];
					$schedule15 = $myrow15['schedule'];
					$projassignid15 = $myrow15['projassignid'];
					$allowtyp15 = $myrow15['allowtyp'];
					$lumpsumsw15 = $myrow15['lumpsumsw'];
					$amtlumpsumtotal15 = $myrow15['amtlumpsumtotal'];
					$amtlumpsumbalance15 = $myrow15['amtlumpsumbalance'];
					
					$deductedallow = round((($amount15 * 12) / 313) * $leaveduration241, 2);


					if ($allowtyp15 == 'PA' || $allowtyp15 == 'CA' || $allowtyp15 == 'TA'){
						$amount15 = $amount15 - $deductedallow;
						
						// echo $leavetype241 . "<br>";
						// echo "Allowance: $allowtyp15 <br>";
						// echo "Amount: $amount15 <br>";
						// echo "leave: $leaveduration241  <br>";
						// echo "solving $allowtyp15: $amount15 - $deductedallow <br>";
						// echo "New Amount: ".$amount15 . "<br> <br>";

					} else if ($leavetype241 == 'sd' && ($allowtyp15 == 'EC1' || $allowtyp15 == 'EC2')  ) {
						$amount15 = $amount15 - $deductedallow;

						// echo "- for ecola deductions, compute 1 month of ecola (ecola * 12) / 313 before deduction total SD <br>";
						// echo $leavetype241 . "<br>";
						// echo "Allowance: $allowtyp15 <br>";
						// echo "Amount: $amount15 <br>";
						// echo "leave: $leaveduration241  <br>";
						// echo "solving $allowtyp15: $amount15 - $deductedallow <br>";
						// echo "New Amount SD: ".$amount15 . "<br> <br>";

					

					} else {
						$amount15 = $amount15;

						// echo $leavetype241 . "<br>";
						// echo "Allowance: $allowtyp15 <br>";
						// echo "Amount: $amount15 <br>";
						// echo "leave: $leaveduration241  <br>";
						// echo "sAME Amount : ".$amount15 . "<br> <br>";
						// echo "Allowance: not pa or ca or ta <br>";
						// echo "Amount: $amount15 <br>";
						// echo "leave: $leaveduration241 <br>";
						// echo "Same Amount: ".$amount15 . "<br> <br>";

					}
				
			
				

					
					if($schedule15!="all") {
						if($schedule15=="15th") {
							if($cutwhat>='01' && $cutwhat<='15') {
								
							    if($nontaxable15 == 1) {
									$totalNonvatableIncome += $amount15; $proctyp="nontaxable"; $vattyp=0;
								} else {
									$totalVatableIncome += $amount15; $proctyp="taxable"; $vattyp=0;
								} //if-else($nontaxable15 == 1)

							} else { //($cutwhat>='01' && $cutwhat<='15')
								$totalNonvatableIncome=0; $totalVatableIncome=0;
							} //if-else($cutwhat>='01' && $cutwhat<='15')
							
						} elseif($schedule15=="30th") { //($schedule15=="15th")
							if($cutwhat>='01' && $cutwhat<='15') {
								$totalNonvatableIncome=0; $totalVatableIncome=0;
							} else { //($cutwhat>='01' && $cutwhat<='15')
								
							    if($nontaxable15 == 1) {
									$totalNonvatableIncome += $amount15; $proctyp="nontaxable"; $vattyp=0;
								} else {
									$totalVatableIncome += $amount15; $proctyp="taxable"; $vattyp=0;
								} //if-else

							} //if-else($cutwhat>='01' && $cutwhat<='15')
						} //if-else($schedule15=="15th")
					
					} else { //($schedule15!="all")
						
					    if($nontaxable15 == 1) {
							$totalNonvatableIncome += $amount15; $proctyp="nontaxable"; $vattyp=0;
						} else { //($nontaxable15 == 1)
						    $totalVatableIncome += $amount15; $proctyp="taxable"; $vattyp=0;
						} //if-else($nontaxable15 == 1)
						
					} //if-else($schedule15!="all")
											
					// insert query to tblfinpayprocsupprec
					$res16query=""; $result16=""; $found16=0;
					$res16query="INSERT INTO tblfinpayprocsupprec SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, employeeid=\"$employeeid23\", type=\"$proctyp\", description=\"$name15\", amount=\"$amount15\", allowtype = '$allowtyp15', vat=$vattyp, projcode=\"$projassignid15\", cutstart=\"$cutstart10\", cutend=\"$cutend10\", fk_idhrtapaygrp=$idpaygroup, fk_idhrtacutoff=$idcutoff";

					$result16=$dbh2->query($res16query);
				
					if($result16!='') {
						
					} //if
				
				    } //while


					// echo '<td class="text-right">'.number_format($totalVatableIncome,2).'</td>';
					// echo '<td class="text-right">'.number_format($totalNonvatableIncome,2).'</td>';

					
				} else { //if-else
					// echo '<td class="text-center">-</td>';
					// echo '<td class="text-center">-</td>';
				} //if-else
				// var_dump($res16query."\n");
				// echo $res16query;
            echo "<td class=\"text-right\">";
            if($totalVatableIncome>0) {
                echo number_format($totalVatableIncome,2);
            } else {
				echo "-";
			} //if-else
			echo "</td>";
			
            echo "<td class=\"text-right\">";
            if($totalNonvatableIncome>0) {
				echo number_format($totalNonvatableIncome,2);
			} else {
				echo "-";
			} //if-else
			echo "</td>";

			//end additional incomes

			$grosspay = $comprate + $totalNonvatableIncome + $totalMealAllowance + $totalVatableIncome;

			echo "<td class=\"text-right\">";
			echo number_format($grosspay,2);
			echo "</td>";
			//deductions
			// $res100query = "SELECT idtblfinpaydeduct, deductname, deductamount, deducttotal, deductbalance, datestart, dateend, status, schedule FROM tblfinpaydeduct WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid23\" ORDER BY dateend DESC, datestart DESC";
			$res100query = "SELECT idtblfinpaydeduct, deductname, deductamount, deducttotal, deductbalance, datestart, dateend, status, schedule FROM tblfinpaydeduct WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid23\" AND (datestart <=\"$cutstart10\" AND dateend >=\"$cutend10\") AND status=1 ORDER BY dateend DESC, datestart DESC";
			$result100=""; $found100=0; $ctr100=0;
			$result100 = $dbh2->query($res100query);
			if($result100->num_rows>0) {
				while($myrow100 = $result100->fetch_assoc()) {
					$found100 = 1;
					$idtblfinpaydeduct100 = $myrow100['idtblfinpaydeduct'];
					$deductname100 = $myrow100['deductname'];
					$deductamount100 = $myrow100['deductamount'];
					$deducttotal100 = $myrow100['deducttotal'];
					$deductbalance100 = $myrow100['deductbalance'];
					$datestart100 = $myrow100['datestart'];
					$dateend100 = $myrow100['dateend'];
					$status100 = $myrow100['status'];
					$schedule100 = $myrow100['schedule'];

					$totaldeductamount += $deductamount100;
					
					//insert query tblfinpayprosupprec
					$proctyp="deduction"; $vattyp=0; $projassignid15=0;
					$res17query=""; $result17=""; $found17=0;
					$res17query="INSERT INTO tblfinpayprocsupprec SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, employeeid=\"$employeeid23\", type=\"$proctyp\", description=\"$deductname100\", amount=\"$deductamount100\", vat=$vattyp, projcode=\"$projassignid15\", cutstart=\"$cutstart10\", cutend=\"$cutend10\", fk_idhrtapaygrp=$idpaygroup, fk_idhrtacutoff=$idcutoff";
					$result17=$dbh2->query($res17query);
					if($result17!="") {
						
					} 
					//if
					// var_dump($res17query."\n");
				}

			} else {
				// echo '<td align="center">-</td>';
			}
			//end deductions 


			//start sss and philhealth

			//formulas 

			//end formulas


			if($cutwhat>='01' && $cutwhat<='15') {

				//
				// 1. get netbasicpay and grosspay of prev 16-30cutoff
				$prevMonth = date('Y-m-d', strtotime('-1 month', strtotime($cutstart10)));
				// compile previous cutoff
				$prevCutStart = date('Y-m', strtotime($prevMonth)) . "-" . "16";
				// get last day of month's prev cutoff
				$prevCutEnd = date('Y-m-t', strtotime($prevCutStart));
				// query based on paygroup
				$res20query=""; $result20=""; $found20=0; $ctr20=0;
				$res20query="SELECT emppayrollid, emp_salary, regholidayamt, speholidayamt, otsundayamt, overamt, nightdiffamt, totaltardy, otherincome, otherincometaxable, absentamt, ottotamt, otrest8amt, otspsun8amt, otlegal8amt, otlegalsunamt, otlegalsun8amt, otsp8amt FROM tblemppayroll WHERE fk_idhrtapaygrp=$idpaygroup AND employeeid=\"$employeeid23\" AND cut_start=\"$prevCutStart\" AND cut_end=\"$prevCutEnd\"";
				// echo "$res20query";
				$result20=$dbh2->query($res20query);
				if($result20->num_rows>0) {
					while($myrow20=$result20->fetch_assoc()) {
						$found20=1; $ctr20++;
						$prevemppayrollid = $myrow20['emppayrollid'];
						$prevemp_salary = $myrow20['emp_salary'];
						$prevregholidayamt = $myrow20['regholidayamt'];
						$prevspeholidayamt = $myrow20['speholidayamt'];
						$prevotsundayamt = $myrow20['otsundayamt'];
						$prevoveramt = $myrow20['overamt'];
						$prevnightdiffamt = $myrow20['nightdiffamt'];
						$prevtotaltardy = $myrow20['totaltardy'];
						$prevotherincome = $myrow20['otherincome'];
						$prevotherincometaxable = $myrow20['otherincometaxable'];
						$prevabsentamt = $myrow20['absentamt'];
						$prevottotamt = $myrow20['ottotamt'];
						$prevotrest8amt = $myrow20['otrest8amt'];
						$prevotspsun8amt = $myrow20['otspsun8amt'];
						$prevotlegal8amt = $myrow20['otlegal8amt'];
						$prevotlegalsunamt = $myrow20['otlegalsunamt'];
						$prevotlegalsun8amt = $myrow20['otlegalsun8amt'];
						$prevotsp8amt = $myrow20['otsp8amt'];
						
					} //while
				} //if
				
				if($found20 != 1) {
						$res21query=""; $result21=""; $found21=0; $ctr21=0;
					$res21query="SELECT emppayrollid, emp_salary, regholidayamt, speholidayamt, otsundayamt, overamt, nightdiffamt, totaltardy, otherincome, otherincometaxable, absentamt FROM tblemppayroll WHERE (cut_start>=\"$prevCutStart\" AND cut_end<=\"$prevCutEnd\") AND employeeid=\"$employeeid23\"";
					// echo $res21query ."<br>";
					$result21=$dbh2->query($res21query);
					if($result21->num_rows>0) {
						while($myrow21=$result21->fetch_assoc()) {
							$found21=1; $ctr21++;
							$prevemppayrollid = $myrow21['emppayrollid'];
							$prevemp_salary = $myrow21['emp_salary'];
							$prevregholidayamt = $myrow21['regholidayamt'];
							$prevspeholidayamt = $myrow21['speholidayamt'];
							$prevotsundayamt = $myrow21['otsundayamt'];
							$prevoveramt = $myrow21['overamt'];
							$prevnightdiffamt = $myrow21['nightdiffamt'];
							$prevtotaltardy = $myrow21['totaltardy'];
							$prevotherincome = $myrow21['otherincome'];
							$prevotherincometaxable = $myrow21['otherincometaxable'];
							$prevabsentamt = $myrow21['absentamt'];
							
						} //while
					} //if
				} //if


				if ($found20 != 1){
					$prevpayrate = $prevemp_salary / 2;

				} else {
					$prevpayrate = $prevemp_salary;

				}

				$prevtotallateabsent = $prevtotaltardy + $prevabsentamt;
				// get netbasicpay from prev cutoff
				$prevnetbasicpay = $prevpayrate - $prevtotallateabsent; // for philhealth

				$prevtotalovertime = $prevnightdiffamt + $prevoveramt + $prevotsundayamt + $prevspeholidayamt + $prevregholidayamt + $prevotrest8amt + $prevotspsun8amt + $prevotlegal8amt + $prevotlegalsunamt + $prevotlegalsun8amt + $prevotsp8amt;
				$prevgrosspay = $prevnetbasicpay + $prevtotalovertime + $prevotherincometaxable + $prevotherincome; // for SSS
				// if no prev cutoff, set req vars to zero
				if($found20==0 && $found21==0) {
					$prevnetbasicpay=0; $prevpayrate=0; $prevtotallateabsent=0; //for_philhealth
					$prevgrosspay=0; $prevtotalovertime=0; $prevotherincometaxable=0; $prevotherincome=0; //for_sss
				} //if
				// combine current 01-15cutoff $netbasicpay and set var to $philhealthnetbasicpay
				$philhealthnetbasicpay = $prevnetbasicpay + $netbasicpay;					
				// combine with curr 01-15cutoff $grosspay and set var to $sssgrosspay
				$sssgrosspay = $prevgrosspay + $grosspay;

				// echo "$philhealthnetbasicpay ($prevnetbasicpay + $netbasicpay) <br><br><br>";
				//
				// compute for philhealth
				//
				// $subtotnetbasicpay = $netbasicpay;
				$res101query=""; $result101=""; $found101=0;
				// $res101query="SELECT idphlhealth2018, mbsmin, mbsmax, pct, maxpremium FROM tblphlhealth2018 WHERE mbsmin<=$subtotnetbasicpay AND mbsmax>=$subtotnetbasicpay";
                $res101query="SELECT idphilhealth2020, mbsmin, mbsmax, prrate FROM tblphilhealth2020 WHERE compyear=\"2025-01-01\" AND mbsmin<=$philhealthnetbasicpay AND mbsmax>=$philhealthnetbasicpay LIMIT 1";
				// echo $res101query."<br>"; 
				$result101=$dbh2->query($res101query);
				if($result101->num_rows>0) {
					while($myrow101=$result101->fetch_assoc()) {
					$found101=1;
					$idphilhealth2020101 = $myrow101['idphilhealth2020'];
					$mbsmin101 = $myrow101['mbsmin'];
					$mbsmax101 = $myrow101['mbsmax'];
					$prrate101 = $myrow101['prrate'];
					// $maxpremium101 = $myrow101['maxpremium'];
					} // while($myrow101=$result101->fetch_assoc())
				} // if($result101->num_rows>0)
				if($found101==1) {
					if($prrate101!=0) {
					// $phlhealth2018 = round(($emp_salary12 * ($pct101/101)), 2);
					$philhealth2020 = round(($philhealthnetbasicpay * ($prrate101/100)), 2);
					$phlhlthee = $philhealth2020 / 2;
					$phlhlther = $philhealth2020 / 2;
					} else { // if($pct101!=0)
					// $philhealth2020 = $maxpremium101;
					$phlhlthee = $philhealth2020 / 2;
					$phlhlther = $philhealth2020 / 2;
					} // if($pct101!=0)


					if($philhealthnetbasicpay<10000) {
						$phlhlthee = 250;
						$phlhlther = 250;
					} //if
				} // if($found101==1)

                //
                // compute for sss
				// $res19query="SELECT idsss201904, salcredit, sscer, sscee, ssctotal, eccer, tcer, tcee, tctotal FROM tblsss201904 WHERE compfrom<=$grosspay AND compto>=$grosspay";
				// $res19query="SELECT ssscontributionid, salarycredit, sser, ssee, sstotal, ecer, tcer, tcee, tctotal FROM tblssscontribution WHERE compfrom<=$grosspay AND compto>=$grosspay";
				// query latest sss table
				$res19query=""; $result19=""; $found19=0; $ctr19=0;
                // $res19query="SELECT idsss2023, salcredit, provfund, rsser, rssee, ecer, wisper, wispee, tcer, tcee, tctotal FROM tblsss2023 WHERE compfrom<=$sssgrosspay AND compto>=$sssgrosspay";
				$res19query="SELECT idsss2025, salcredit, provfund, rsser, rssee, ecer, wisper, wispee, tcer, tcee, tctotal FROM tblsss2025 WHERE compfrom<=$sssgrosspay AND compto>=$sssgrosspay";
				$result19=$dbh2->query($res19query);
				if($result19->num_rows>0) {
					while($myrow19=$result19->fetch_assoc()) {
					$found19=1; $ctr19++;
					// $idsss201904 = $myrow19['idsss201904'];
					$idsss2025 = $myrow19['idsss2025'];
					$salcredit = $myrow19['salcredit'];
					// $sscer = $myrow19['sscer'];
					// $sscee = $myrow19['sscee'];
					// $ssctotal = $myrow19['ssctotal'];
					// $eccer = $myrow19['eccer'];
					$provfund = $myrow19['provfund'];
					$rsser = $myrow19['rsser'];
					$rssee = $myrow19['rssee'];
					$ecer = $myrow19['ecer'];
					$wisper = $myrow19['wisper'];
					$wispee = $myrow19['wispee'];
					$tcer = $myrow19['tcer'];
					$tcee = $myrow19['tcee'];
					$tctotal = $myrow19['tctotal'];
					} // while
				} // if
				if($found19==1) {
					$deductionfin=$tcee;
					// $ecfin=$eccer;
					$ecfin=$ecer;
					// $ssfin=$sscer;
					$ssfin=$sscer;
				} else {
					$deductionfin=0;
					$ecfin=0;
					$ssfin=0;
				} // if

				
			} else if($cutwhat>='16' && $cutwhat<='31') { //if($cutwhat=='16')
			
				$deductionfin="0.00";
				// $phlhealth2018="0.00";
				$philhealth2020="0.00";
				// echo "<td align=\"center\">";
				// echo $philhealth2020;
				// echo "</td>";
				// echo "<td align=\"center\">";
				// echo $deductionfin;
				// echo "</td>";
				
			} //if($cutwhat=='16')

			//end sss and philhealth
			
            $totalContributions = $phlhlthee + $deductionfin + $pagibigee;
		

			//tax
			// get new wtax based on comprate
			$wtaxsched='sm';
			// echo $totalContributions;
			$res14query="SELECT idwtax2023, crmin, crmax, percent, prescramt FROM tblwtax2023 WHERE sched=\"$wtaxsched\" AND (crmin<=$comprate AND crmax>=$comprate) LIMIT 1";
			// echo $res14query . "<br>";
			// $res14query="SELECT idwtax2018, crmin, crmax, percent, prescramt FROM tblwtax2018 WHERE sched='sm' AND (crmin<=$comprate AND crmax>=$comprate) LIMIT 1";
			$result14=""; $found14=0;
			$result14=$dbh2->query($res14query);
			if($result14->num_rows>0) {
				while($myrow14=$result14->fetch_assoc()) {
				$found14=1;
				$idwtax202314 = $myrow14['idwtax2023'];
				$crmin14 = $myrow14['crmin'];
				$crmax14 = $myrow14['crmax'];
				$percent14 = $myrow14['percent'];
				$prescramt14 = $myrow14['prescramt'];
				} // while($myrow14=$resul14->fetch_assoc())
			} // if($result14->num_rows>0)
			if($found14==1) {
				if($percent14!=0) {
				// include overtime in comprate
				// $comprate2 = $comprate - $totalContributions;
				$comprate2 = $comprate;

				$wtax2023 = ((($comprate2 - $crmin14) * ($percent14/100)) + $prescramt14);
				$flg='wpct';
				} else { // if($percent14==0)
				// $wtax2018 = round((($comprate - $crmin14) + $prescramt14), 2);
				$wtax2023 = ((($comprate - $crmin14) * ($percent14/100)) + $prescramt14);
				$flg='0pct';
				} // if($percent14==0)
			} // if($found14==1)

			echo "<td class=\"text-right\">";
			echo number_format($wtax2023,2);
			// echo "<br>f14:".$found14.",idwtx:".$idwtax202314.",pct:".$percent14.",cmprt:".$comprate.",crmin:".$crmin14.",prescramt:".$prescramt14.",wtax2k23:".$wtax2023;
			echo "</td>";

			//end tax

            // sss
			echo "<td class=\"text-right\">";
			if($deductionfin>0) {
				echo number_format($deductionfin,2);
				// echo "<br>f20:".$found20.",f21:".$found21.",ssgross:".$sssgrosspay.",prevgross:".$prevgrosspay.",currgross:".$grosspay."|f19:".$found19.",prevnetbasic:".$prevnetbasicpay.",prevtotalot:".$prevtotalovertime.",prevotherincmtax:".$prevotherincometaxable.",prevotherinc:".$prevotherincome."|tcer:".$tcer.",tcee:".$tcee;
			} else {
				echo "-";
			} //if-else
			echo "</td>";

            // philhealth
			echo "<td class=\"text-right\">";
            // if($philhealth2020>0) {
			if($phlhlther>0){
				// echo number_format($philhealth2020,2);
				echo number_format($phlhlther,2);
				// echo "<br>f20:".$found20.",f21:".$found21.",".$philhealthnetbasicpay.",".$prevnetbasicpay.":".$prevpayrate.":".$prevtotallateabsent.",".$netbasicpay.",".$prrate101;
			} else {
				echo "-";
			} //if-else
			echo "</td>";

            // pag-ibig
			echo "<td class=\"text-right\">";
            if($pagibigee>0) {
				echo number_format($pagibigee, 2);
			} else {
				echo "-";
			} //if-else
			echo "</td>";

            // other Deductions
			echo "<td class=\"text-right\">";
			if($totaldeductamount>0) {
				echo number_format($totaldeductamount,2);
			} else {
				echo "-";
			} //if-else
			echo "</td>";

			$totalDeductions = $wtax2023 + $totalContributions + $totaldeductamount + $latesubtot;
			$totalNetPay = $grosspay - $totalDeductions;

			echo "<td class=\"text-right\">".number_format($totalDeductions,2)."</td>";

			echo "<td class=\"text-right\">";
			echo number_format($totalNetPay,2);
			echo "</td>";
			
			echo "</tr>";
			
			// query tblemployee get vl & sl quotas
			$res26query=""; $result26=""; $found26=0; $ctr26=0;
			$res26query="SELECT vacation, sick, paternity, maternityn, maternityc, special FROM tblemployee WHERE employeeid=\"$employeeid23\" LIMIT 1";
			$result26=$dbh2->query($res26query);
			if($result26->num_rows>0) {
				while($myrow26=$result26->fetch_assoc()) {
				$found26=1;
				$vacation26 = $myrow26['vacation'];
				$sick26 = $myrow26['sick'];
				$paternity26 = $myrow26['paternity'];
				$maternityn26 = $myrow26['maternityn'];
				$maternityc26 = $myrow26['maternityc'];
				$special26 = $myrow26['special'];
				} //while
			} //if
			// query leavesaver get vl & sl used
			$res27query=""; $result27=""; $found27=0; $ctr27=0;
			$res27query="SELECT id, count, leavid, leavecode, identifier FROM leavesaver WHERE empid=\"$employeeid23\" AND grpid=$idpaygroup AND leavedays BETWEEN (\"$cutstart10\" AND \"$cutend10\")";
			$result27=$dbh2->query($res27query);
			if($result27->num_rows>0) {
				while($myrow27=$result27->fetch_assoc()) {
				$found27=1; $ctr27++;
				$id27 = $myrow27['id'];
				$count27 = $myrow27['count'];
				$leavid27 = $myrow27['leavid'];
				$leavecode27 = $myrow27['leavecode'];
				$identifier27 = $myrow27['identifier'];
				if($leavecode27=='sick' || $leavecode27=='hds') {
					$slusedtot += $count27;
				} //if
				if($leavecode27=='vacation' || $leavecode27=='hdv') {
					$vlusedtot += $count27;
				} //if
				} //while
			} //if
			
			// query tblproject1
		if($projcode25=="") {
			
			if($proj_code!="") {
			$res28query=""; $result28=""; $found28=0; $ctr28=0;
			$res28query="SELECT projectid, proj_code, proj_sname, proj_fname FROM tblproject1 WHERE proj_code=\"$proj_code\"";
			$result28=$dbh2->query($res28query);
			// echo $res28query . "<br>";
			if($result28->num_rows>0) {
				while($myrow28=$result28->fetch_assoc()) {
				$found28=1;
				$projectid28 = $myrow28['projectid'];
				$proj_code28 = $myrow28['proj_code'];
				$proj_sname28 = $myrow28['proj_sname'];
				$proj_fname28 = $myrow28['proj_fname'];
				if($proj_sname28=='') {
					$proj_sname28=$proj_code28;
				} //if
				
				} //while
			} //if($result28->num_rows>0)				
			} //if($proj_code!="")
			
		} else {
			$proj_code28=$projcode25;
			$proj_sname28=$proj_sname25b;
		} //if

/*			
			echo "<tr><td colspan='21'><p>";
			echo "netbasicpay:$netbasicpay; totalSalary:$totalSalary; latesubtot:$latesubtot;";
			echo "overtimesubtotal:$overtimesubtotal; overtimesubtot:$overtimesubtot; nigthdifsubtot:$nigthdifsubtot; totalLegalHoliday:$totalLegalHoliday; totalSpecialHoliday:$totalSpecialHoliday; totalRestday:$totalRestday;";
			echo "comprate:$comprate; netbasicpay:$netbasicpay; totalVatableIncome:$totalVatableIncome; overtimesubtotal:$overtimesubtotal ;";
			echo "grosspay:$grosspay; comprate:$comprate; overtimesubtotal:$overtimesubtotal; totalNonvatableIncome:$totalNonvatableIncome; totalMealAllowance:$totalMealAllowance";
			echo "</p></td></tr>";
*/
			// echo "<tr><td colspan='21'><p>r101q: $res101query<br>r19q: $res19query<br>r14q: $res14query</p></td></tr>";

            // insert query tblemppayroll
			// prereq queries/vars:
			// 1. vl, sl
			// 2. leavesaver > sd + value to absentamt
			// 3. projassignid or projcode to emp_dep
			$employeeid23 = isset($employeeid23) && !empty($employeeid23) ? $employeeid23 : 'default_employeeid';
		$totalSalary = isset($totalSalary) && !empty($totalSalary) ? $totalSalary : 0;
		$deductionfin = isset($deductionfin) && !empty($deductionfin) ? $deductionfin : 0;
		$phlhlther = isset($phlhlther) && !empty($phlhlther) ? $phlhlther : 0;
		$wtax2023 = isset($wtax2023) && !empty($wtax2023) ? $wtax2023 : 0;
		$otordval24 = isset($otordval24) && !empty($otordval24) ? $otordval24 : 0;
		$totalNetPay = isset($totalNetPay) && !empty($totalNetPay) ? $totalNetPay : 0;
		$sick26 = isset($sick26) && !empty($sick26) ? $sick26 : 0;
		$vacation26 = isset($vacation26) && !empty($vacation26) ? $vacation26 : 0;
		$cutstart10 = isset($cutstart10) && !empty($cutstart10) ? $cutstart10 : '0000-00-00';
		$cutend10 = isset($cutend10) && !empty($cutend10) ? $cutend10 : '0000-00-00';
		$otlegalval24 = isset($otlegalval24) && !empty($otlegalval24) ? $otlegalval24 : 0;
		$otspval24 = isset($otspval24) && !empty($otspval24) ? $otspval24 : 0;
		$total_utval = isset($total_utval) && !empty($total_utval) ? $total_utval : 0;
		$otspsunval24 = isset($otspsunval24) && !empty($otspsunval24) ? $otspsunval24 : 0;
		$otlegalamt = isset($otlegalamt) && !empty($otlegalamt) ? $otlegalamt : 0;
		$otspamt = isset($otspamt) && !empty($otspamt) ? $otspamt : 0;
		$otspsunamt = isset($otspsunamt) && !empty($otspsunamt) ? $otspsunamt : 0;
		$otordamt = isset($otordamt) && !empty($otordamt) ? $otordamt : 0;
		$nightdiffval24 = isset($nightdiffval24) && !empty($nightdiffval24) ? $nightdiffval24 : 0;
		$nightdiffamt = isset($nightdiffamt) && !empty($nightdiffamt) ? $nightdiffamt : 0;
		$utamt = isset($utamt) && !empty($utamt) ? $utamt : 0;
		$totalNonvatableIncome = isset($totalNonvatableIncome) && !empty($totalNonvatableIncome) ? $totalNonvatableIncome : 0;
		$totalVatableIncome = isset($totalVatableIncome) && !empty($totalVatableIncome) ? $totalVatableIncome : 0;
		$totaldeductamount = isset($totaldeductamount) && !empty($totaldeductamount) ? $totaldeductamount : 0;
		// $proj_sname28 = isset($proj_sname28) && !empty($proj_sname28) ? $proj_sname28 : 'GAE';
		$pagibigee = isset($pagibigee) && !empty($pagibigee) ? $pagibigee : 0;
		$vlusedtot = isset($vlusedtot) && !empty($vlusedtot) ? $vlusedtot : 0;
		$slusedtot = isset($slusedtot) && !empty($slusedtot) ? $slusedtot : 0;
		$phlhlthee = isset($phlhlthee) && !empty($phlhlthee) ? $phlhlthee : 0;
		$sdtotamt = isset($sdtotamt) && !empty($sdtotamt) ? $sdtotamt : 0;
		$otvaltot = isset($otvaltot) && !empty($otvaltot) ? $otvaltot : 0;
		$otamttot = isset($otamttot) && !empty($otamttot) ? $otamttot : 0;
		$otrest8val24 = isset($otrest8val24) && !empty($otrest8val24) ? $otrest8val24 : 0;
		$otrest8amt = isset($otrest8amt) && !empty($otrest8amt) ? $otrest8amt : 0;
		$otspsun8val24 = isset($otspsun8val24) && !empty($otspsun8val24) ? $otspsun8val24 : 0;
		$otspsun8amt = isset($otspsun8amt) && !empty($otspsun8amt) ? $otspsun8amt : 0;
		$otlegal8val24 = isset($otlegal8val24) && !empty($otlegal8val24) ? $otlegal8val24 : 0;
		$otlegal8amt = isset($otlegal8amt) && !empty($otlegal8amt) ? $otlegal8amt : 0;
		$otlegalsunval24 = isset($otlegalsunval24) && !empty($otlegalsunval24) ? $otlegalsunval24 : 0;
		$otlegalsunamt = isset($otlegalsunamt) && !empty($otlegalsunamt) ? $otlegalsunamt : 0;
		$otlegalsun8val24 = isset($otlegalsun8val24) && !empty($otlegalsun8val24) ? $otlegalsun8val24 : 0;
		$otlegalsun8amt = isset($otlegalsun8amt) && !empty($otlegalsun8amt) ? $otlegalsun8amt : 0;
		$otsp8val24 = isset($otsp8val24) && !empty($otsp8val24) ? $otsp8val24 : 0;
		$otsp8amt = isset($otsp8amt) && !empty($otsp8amt) ? $otsp8amt : 0;
		$idpaygroup = isset($idpaygroup) && !empty($idpaygroup) ? $idpaygroup : 0;
		$idcutoff = isset($idcutoff) && !empty($idcutoff) ? $idcutoff : 0;
		$otrestval24 = isset($otrestval24) && !empty($otrestval24) ? $otrestval24 : 0;
		$otrestamt = isset($otrestamt) && !empty($otrestamt) ? $otrestamt : 0;
		$transpo24 = isset($transpo24) && !empty($transpo24) ? $transpo24 : 0;
		$transpoamt = isset($transpoamt) && !empty($transpoamt) ? $transpoamt : 0;
		$mealallowsw24 = isset($mealallowsw24) && !empty($mealallowsw24) ? $mealallowsw24 : 0;
		$mealallowamt = isset($mealallowamt) && !empty($mealallowamt) ? $mealallowamt : 0;
		$sdtotval = isset($sdtotval) && !empty($sdtotval) ? $sdtotval : 0;
		// $proj_code28 = isset($proj_code28) && !empty($proj_code28) ? $proj_code28 : 'C00-001';

        // reset all prev cutoff vars
		$prevtotallateabsent = isset($prevtotallateabsent) && !empty($prevtotallateabsent) ? $prevtotallateabsent : 0;
		$prevtotaltardy = isset($prevtotaltardy) && !empty($prevtotaltardy) ? $prevtotaltardy : 0;
		$prevabsentamt = isset($prevabsentamt) && !empty($prevabsentamt) ? $prevabsentamt : 0;
		$prevnetbasicpay = isset($prevnetbasicpay) && !empty($prevnetbasicpay) ? $prevnetbasicpay : 0;
		$prevpayrate = isset($prevpayrate) && !empty($prevpayrate) ? $prevpayrate : 0;
		$prevtotalovertime = isset($prevtotalovertime) && !empty($prevtotalovertime) ? $prevtotalovertime : 0;
		$prevnightdiffamt = isset($prevnightdiffamt) && !empty($prevnightdiffamt) ? $prevnightdiffamt : 0;
		$prevoveramt = isset($prevoveramt) && !empty($prevoveramt) ? $prevoveramt : 0;
		$prevotsundayamt = isset($prevotsundayamt) && !empty($prevotsundayamt) ? $prevotsundayamt : 0;
		$prevspeholidayamt = isset($prevspeholidayamt) && !empty($prevspeholidayamt) ? $prevspeholidayamt : 0;
		$prevregholidayamt = isset($prevregholidayamt) && !empty($prevregholidayamt) ? $prevregholidayamt : 0;
		$prevotrest8amt = isset($prevotrest8amt) && !empty($prevotrest8amt) ? $prevotrest8amt : 0;
		$prevotspsun8amt = isset($prevotspsun8amt) && !empty($prevotspsun8amt) ? $prevotspsun8amt : 0;
		$prevotlegal8amt = isset($prevotlegal8amt) && !empty($prevotlegal8amt) ? $prevotlegal8amt : 0;
		$prevotlegalsunamt = isset($prevotlegalsunamt) && !empty($prevotlegalsunamt) ? $prevotlegalsunamt : 0;
		$prevotlegalsun8amt = isset($prevotlegalsun8amt) && !empty($prevotlegalsun8amt) ? $prevotlegalsun8amt : 0;
		$prevotsp8amt = isset($prevotsp8amt) && !empty($prevotsp8amt) ? $prevotsp8amt : 0;
		$prevgrosspay = isset($prevgrosspay) && !empty($prevgrosspay) ? $prevgrosspay : 0;
		$prevotherincometaxable = isset($prevotherincometaxable) && !empty($prevotherincometaxable) ? $prevotherincometaxable : 0;
		$prevotherincome = isset($prevotherincome) && !empty($prevotherincome) ? $prevotherincome : 0;
		$prevemp_salary = isset($prevemp_salary) && !empty($prevemp_salary) ? $prevemp_salary : 0;

		$resthisquery = "SELECT *
FROM tblemppaycutoff
WHERE  paygroupname = '$paygroupname10' 
  AND cutstart = '$cutstart10' 
  AND cutend = '$cutend10' 
  AND idhrtacutoff = '$idcutoff' 
  AND idhrtapaygrp = '$idpaygroup';
";

// echo $resthisquery . "<br> <br>";
$result1811=$dbh2->query($resthisquery);
$flagthis = 0;
if ($result1811->num_rows>0){
	while($thisrow = $result1811->fetch_assoc()){
		$flagthis = 1;
	}
}
// echo "$flagthis";

if ($flagthis == 1){
	// echo "already processed to tblemppayroll <br> ";

} else {
	$res18query=""; $result18=""; $found18=0;
	// $res18query="INSERT INTO tblemppayroll SET employeeid=\"$employeeid23\", emp_salary=$totalSalary, deduction=$deductionfin, phil_ded=$phlhlther, tax=$wtax2023, emp_over_duration=$otordval24, net_pay=$totalNetPay, emp_date_wrk=0, emp_sick=$sick26, emp_vacation=$vacation26, cut_start=\"$cutstart10\", cut_end=\"$cutend10\", regholiday=$otlegalval24, speholiday=$otspval24, emp_late_duration=$total_utval, otsunday=$otspsunval24, regholidayamt=$otlegalamt, speholidayamt=$otspamt, otsundayamt=$otspsunamt, overamt=$otordamt, nightdiffminutes=$nightdiffval24, nightdiffamt=$nightdiffamt, totaltardy=$utamt, otherincome=$totalNonvatableIncome, otherincometaxable=$totalVatableIncome, otherdeduction=$totaldeductamount, emp_dep=\"$proj_sname28\", pagibig=$pagibigee, vlused=$vlusedtot, slused=$slusedtot, philemp=$phlhlthee, ss=0, ec=0, bracket=0, absentamt=$sdtotamt, ottotval=$otvaltot, ottotamt=$otamttot, otrest8val=$otrest8val24, otrest8amt=$otrest8amt, otspsun8val=$otspsun8val24, otspsun8amt=$otspsun8amt, otlegal8val=$otlegal8val24, otlegal8amt=$otlegal8amt, otlegalsunval=$otlegalsunval24, otlegalsunamt=$otlegalsunamt, otlegalsun8val=$otlegalsun8val24, otlegalsun8amt=$otlegalsun8amt, otsp8val=$otsp8val24, otsp8amt=$otsp8amt, fk_idhrtapaygrp=$idpaygroup, fk_idhrtacutoff=$idcutoff, otrestval=$otrestval24, otrestamt=$otrestamt, transpoallow=$transpo24, transpoallowamt=$transpoamt, mealallow=$mealallowsw24, mealallowamt=$mealallowamt, sdval=$sdtotval, projcode=\"$proj_code28\"";
	$res18query="INSERT INTO tblemppayroll SET employeeid=\"$employeeid23\", emp_salary=$totalSalary, deduction=$deductionfin, phil_ded=$phlhlther, tax=$wtax2023, emp_over_duration=$total_otordval, net_pay=$totalNetPay, emp_date_wrk=0, emp_sick=$sick26, emp_vacation=$vacation26, cut_start=\"$cutstart10\", cut_end=\"$cutend10\", regholiday=$total_otlegalval, speholiday=$total_otspval, emp_late_duration=$total_utval, otsunday=$total_otspsunval, regholidayamt=$otlegalamt, speholidayamt=$otspamt, otsundayamt=$otspsunamt, overamt=$otordamt, nightdiffminutes=$total_nightdiffval, nightdiffamt=$nightdiffamt, totaltardy=$utamt, otherincome=$totalNonvatableIncome, otherincometaxable=$totalVatableIncome, otherdeduction=$totaldeductamount, emp_dep=\"$proj_sname28\", pagibig=$pagibigee, vlused=$vlusedtot, slused=$slusedtot, philemp=$phlhlthee, ss=0, ec=0, bracket=0, absentamt=$sdtotamt, ottotval=$otvaltot, ottotamt=$otamttot, otrest8val=$total_otrest8val, otrest8amt=$otrest8amt, otspsun8val=$total_otspsun8val, otspsun8amt=$otspsun8amt, otlegal8val=$total_otlegal8val, otlegal8amt=$otlegal8amt, otlegalsunval=$total_otlegalsunval, otlegalsunamt=$otlegalsunamt, otlegalsun8val=$total_otlegalsun8val, otlegalsun8amt=$otlegalsun8amt, otsp8val=$total_otsp8val, otsp8amt=$otsp8amt, fk_idhrtapaygrp=$idpaygroup, fk_idhrtacutoff=$idcutoff, otrestval=$total_otrestval, otrestamt=$otrestamt, transpoallow=$total_transpo, transpoallowamt=$transpoamt, mealallow=$total_mealallowsw, mealallowamt=$mealallowamt, sdval=$sdtotval, projcode=\"$proj_code28\""; //upd20250513

	$result18=$dbh2->query($res18query);
	
	if($result18 == TRUE) {
// echo "<tr><td colspan='18'>$employeeid23 - $name_last23, $name_first23 $name_middle23[0] r18q: $res18query</td></tr>";
	}

}

           


		
			
// // 			echo "$sqlins <br><br>";
// 			echo "<br> Timestamp: $now\n";
// echo "<br> Login ID: $loginid\n";
// echo "<br> Date Created: $now\n";
// echo "<br> Created By: $loginid\n";
// echo "<br> Pay Group Name: $paygroupname10\n";
// echo "<br> Cut Start: $cutstart10\n";
// echo "<br> Cut End: $cutend10\n";
// echo "<br> ID HRTA Cutoff: $idcutoff\n";
// echo "<br> ID HRTA Pay Group: $idpaygroup\n";
			 //if

			// echo "$res18query <br><br><br>";
			// var_dump($res18query,"\n");
			
			// reset totals
			$tot_totaltime=0; $tot_otval=0; $tot_utval=0; $tot_otutval=0; $tot_ndval=0; $tot_meal=0; $tot_lvtyp_sick=0; $tot_lvtyp_vacation=0; $tot_lvtyp_paternity=0; $tot_lvtyp_maternityn=0; $tot_lvtyp_maternityc=0; $tot_lvtyp_special=0; $tot_lvtyp_accumulated=0; $tot_lvtyp_absent=0; $tot_lvtyp_sd=0; $tot_lvtyp_cc=0; $tot_lvtyp_ob=0; $fintxtlvtyp=""; $fintotlvdur=0;$latesubtot =0; $overtimesubtot=0; $nigthdifsubtot = 0; $totalDeductions = 0; $totaldeductamount=0; $totalNetPay =0; $grosspay =0; $totalRestday =0;$totalLegalHoliday = 0; $totalSpecialHoliday = 0; $tot_specialholidaytime =0; $tot_legalholidaytime =0; $tot_restdaytime = 0; $latesubtot= 0; $totalMealAllowance=0;
			$wtax2023=0; $philhealth2020=0; $deductionfin=0; $sdtotval=0; $sdtotamt=0;
			$totalVatableIncome=0; //20250513 //20250527 moved fr ln:1346


		} // while($myrow23 = mysql_fetch_row($result23))

		if ($flagthis == 1){
			// echo "already processed to tblemppaycutoff ";
		   } else {
			$sqlins = "INSERT INTO tblemppaycutoff SET timestamp=\"$now\", loginid ='$loginid', datecreated = '$now', createdby = '$loginid', paygroupname = '$paygroupname10', cutstart = '$cutstart10', cutend = '$cutend10', idhrtacutoff = '$idcutoff', idhrtapaygrp='$idpaygroup' ";
		$result12=$dbh2->query($sqlins);

			  
		   }

		   
		


			// echo "$sqlins <br> <br>";
	} // if($result23 != "")

	
	echo "</table>";


// end contents here...


// edit body-footer
     echo "<p><a href=\"cutoff.php?loginid=$loginid\" class='btn btn-primary' role='button'>Email Payslip</a></p>";
     echo "<p><a href=\"finpaysystasumm.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid"; 
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
