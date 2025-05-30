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

$yearMonths = 12;
$yearWorkingDays = 314;
$workingHours = 8;
$otPercentage = 1.25;
$nightdiffPercentage = 0.10;
$otRestdayPercentage = 1.3;
$legalHolidayPercentage = 2.6;
$specialHolidayPercentage = 1.69;
$mealAllowanceAmount = 75;

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($idcutoff0 != "") { $idcutoff=$idcutoff0; }
if($disptyp0 != "") { $disptyp=$disptyp0; }

// echo "<p>vartest idpg:$idpaygroup, idct:$idcutoff, dtyp:$disptyp</p>";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");




// edit body-header
     echo "<p><font size=1>Modules >> Payroll >> Summary</font></p>";


// start contents here...
     echo "<table width=\"100%\" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable' border=\"1\">";
	echo "<tr><th>Ctr</th><th>EmpID</th><th>Name</th>";
	// echo "<th>PrefTime</th><th colspan=\"2\">Date</th><th>TimeIN</th><th>TimeOUT</th>";
	echo "<th>Hrs</th><th>OT</th><th>UT</th><th>OT/UT</th><th>Night diff</th>";
	echo "<th>Rest Day Time</th>";
	echo "<th>Special Holiday Time</th>";
	echo "<th>Legal Holiday Time</th>";
	echo "<th>Meal Allowances</th>";


	echo "<th>Basic Pay.</th><th>Pay/day</th>";
	echo "<th>Pay/hr</th>";
	echo "<th>Late/Absences</th>";
	echo "<th>Overtime</th>";
	echo "<th>Night Differential</th>";
	echo "<th>Rest Day</th>";
	echo "<th>Special Holiday</th>";
	echo "<th>Legal Holiday</th>";
	echo "<th>Meal Allowance</th>";
	echo "<th>Other Income(Non-Vatable)</th>";
	echo "<th>Other Income(Vatable)</th>";
	echo "<th>Other Deductions</th>";
	
	echo "<th>Philhealth</th>";
	echo "<th>SSS</th>";
	echo "<th>PAGIBIG</th>";
	echo "<th>Withholding Tax</th>";
	echo "<th>Gross Pay</th>";
	echo "<th>Total Deductions</th>";
	echo "<th>Net Pay</th>";



	$res23query="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblhrtaemptimelog.cutstart FROM tblhrtaemptimelog LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.employeeid=tblcontact.employeeid ORDER BY tblhrtaemptimelog.employeeid ASC";
	$result23=""; $found23=0; $ctr23=0; $empidcurr=""; $empidnxt="";
	/*
	$result23 = mysql_query("$res23query", $dbh);
	if($result23 != "") {
		while($myrow23 = mysql_fetch_row($result23)) {
	*/
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

		$cutwhat=date("d", strtotime($cutoffStart));




		$res3query = "SELECT tblprojassign.projassignid, tblprojassign.projdate, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign.employeeid0, tblprojassign.proj_code, tblprojassign.proj_name, tblprojassign.empprojctr, tblprojassign.position, tblprojassign.salary, tblprojassign.salarycurrency, tblprojassign.salarytype, tblprojassign.allow_inc, tblprojassign.allow_inc_currency, tblprojassign.allow_inc_paytype, tblprojassign.allow_proj, tblprojassign.allow_proj_currency, tblprojassign.allow_proj_paytype, tblprojassign.ecola1, tblprojassign.ecola1_currency, tblprojassign.ecola2, tblprojassign.ecola2_currency, tblprojassign.allow_field_currency, tblprojassign.allow_field_paytype, tblprojassign.allow_field, tblprojassign.allow_accomm, tblprojassign.allow_accomm_currency, tblprojassign.allow_accomm_paytype, tblprojassign.allow_transpo, tblprojassign.allow_transpo_currency, tblprojassign.allow_transpo_paytype, tblprojassign.allow_comm, tblprojassign.allow_comm_currency, tblprojassign.allow_comm_paytype, tblprojassign.perdiem, tblprojassign.perdiem_currency, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.durationtotal, tblprojassign.durationtotprop, tblprojassign.durationfrom2, tblprojassign.durationto2, tblprojassign.duration2total, tblprojassign.duration2totprop, tblprojassign.durationprojassigntot, tblprojassign.durationprojassigntotprop, tblprojassign.term_resign, tblprojassign.remarks, tblprojassign.remarks2, tblprojassign.net_of_tax, tblprojassign.filepath, tblprojassign.filename, tblprojassign.idhrpositionctg FROM tblprojassign WHERE employeeid = '$employeeid23' AND durationto = '0000-00-00' ORDER BY projassignid ASC";
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
			  $filepath3 = $myrow3['filepath3'];
			  $filename3 = $myrow3['filename3'];
				$idhrpositionctg3 = $myrow3['idhrpositionctg'];
				} // while($myrow3=$result3->fetch_assoc())
			} // if($result3->num_rows>0)

		$res24query="SELECT tblhrtaemptimelog.idhrtaemptimelog, tblhrtaemptimelog.logdate, tblhrtaemptimelog.timein, tblhrtaemptimelog.timeout, tblhrtaemptimelog.otbeforeinsw, tblhrtaemptimelog.otafteroutsw, tblhrtaemptimelog.restdaysw, tblhrtaemptimelog.nextdaysw, tblhrtaemptimelog.mealallowsw, tblhrtaemptimelog.leavetype, tblhrtaemptimelog.leaveduration, tblhrtaemptimelog.totaltime, tblhrtaemptimelog.otval, tblhrtaemptimelog.utval, tblhrtaemptimelog.otutval, tblhrtaemptimelog.nightdiffval, tblhrtaemptimelog.nootsw, tblhrtaemptimelog.noutsw, tblhrtaemptimelog.projcharge, tblhrtaemptimelog.projpercent, tblhrtaemptimelog.nofindings, tblhrtaemptimelog.remarks, tblhrtapaygrpemplst.contactid, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday, tblhrtapaygrpemplst.projcode, tblhrtapaygrpemplst.activesw, tblhrtapayshiftctg.shiftin, tblhrtaholidays.holidaytype FROM tblhrtaemptimelog LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid LEFT JOIN tblhrtapayshiftctg ON tblhrtapaygrpemplst.idhrtapayshiftctg=tblhrtapayshiftctg.idhrtapayshiftctg LEFT JOIN tblhrtaholidays ON tblhrtaemptimelog.logdate=tblhrtaholidays.applic_date LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtaemptimelog.employeeid=\"$employeeid23\" AND  tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.employeeid=tblcontact.employeeid GROUP BY idhrtaemptimelog ORDER BY tblhrtaemptimelog.employeeid ASC";
		$result24=""; $found24=0; $ctr24=0;
		$result24 = $dbh2->query($res24query);
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
			$leavetype24 = $myrow24['leavetype'];
			$leaveduration24 = $myrow24['leaveduration'];
			$totaltime24 = $myrow24['totaltime'];
			$otval24 = $myrow24['otval'];
			$utval24 = $myrow24['utval'];
			$otutval24 = $myrow24['otutval'];
			$nightdiffval24 = $myrow24['nightdiffval'];
			$nootsw24 = $myrow24['nootsw'];
			$noutsw24 = $myrow24['noutsw'];
			$projcharge24 = $myrow24['projcharge'];
			$projpercent24 = $myrow24['projpercent'];
			$nofindings24 = $myrow24['nofindings'];
			$remarks24 = $myrow24['remarks'];
			$contactid24 = $myrow24['contactid'];
			$bankacctid24 = $myrow24['bankacctid'];
			$restday23 = $myrow24['restday'];
			$projcode24 = $myrow24['projcode'];
			$activesw24 = $myrow24['activesw'];
			$shiftin24 = $myrow24['shiftin'];
			$holidaytype24 = $myrow24['holidaytype'];

		// compute
		// echo "<tr><td colspan=\"5\">compute eid:$employeeid23, curr:$empidcurr, nxt:$empidnxt</td></tr>";
		// compute total


			if($restdaysw24 == 1){
				$tot_restdaytime += $totaltime24;
			}
			else{
				$tot_restdaytime += 0;
				$tot_totaltime += $totaltime24;
			}

			if($holidaytype24 == 'legal'){
				$tot_legalholidaytime += $totaltime24;
			}else{
				$tot_legalholidaytime += 0;
			}

			if($holidaytype24 == 'special'){
				$tot_specialholidaytime += $totaltime24;
			}else{
				$tot_specialholidaytime += 0;
			}


			if($otutval24 > 0){
				$tot_otval += $otutval24;
			}
			else{
				$tot_utval += $otutval24;
			}
			$tot_otutval += $otutval24;
			$tot_ndval += $nightdiffval24;
			$tot_meal += $mealallowsw24;


			if($leavetype24!="" && $leaveduration24!=0) {
				if($leavetype24=="sick") {
					$tot_lvtyp_sick = $tot_lvtyp_sick + $leaveduration24;
				} else if($leavetype24=="vacation") {
					$tot_lvtyp_vacation = $tot_lvtyp_vacation + $leaveduration24;
				} else if($leavetype24=="paternity") {
					$tot_lvtyp_paternity = $tot_lvtyp_paternity + $leaveduration24;
				} else if($leavetype24=="maternityn") {
					$tot_lvtyp_maternityn = $tot_lvtyp_maternityn + $leaveduration24;
				} else if($leavetype24=="maternityc") {
					$tot_lvtyp_maternityc = $tot_lvtyp_maternityc + $leaveduration24;
				} else if($leavetype24=="special") {
					$tot_lvtyp_special = $tot_lvtyp_special + $leaveduration24;
				} else if($leavetype24=="accumulated") {
					$tot_lvtyp_accumulated = $tot_lvtyp_accumulated + $leaveduration24;
				} else if($leavetype24=="absent") {
					$tot_lvtyp_absent = $tot_lvtyp_absent + $leaveduration24;
				} else if($leavetype24=="sd") {
					$tot_lvtyp_sd = $tot_lvtyp_sd + $leaveduration24;
				} else if($leavetype24=="cc") {
					$tot_lvtyp_cc = $tot_lvtyp_cc + $leaveduration24;
				} else if($leavetype24=="ob") {
					$tot_lvtyp_ob = $tot_lvtyp_ob + $leaveduration24;
				} // if($leavetype23=="sick")
			} // if($leavetype23!="" && $leaveduration23!=0)

			} // while($myrow24 = $result24->fetch_assoc())
		} // if($result24->num_rows>0)

		// echo "<tr><td colspan=\"5\">display summary eid:$employeeid23, curr:$empidcurr, nxt:$empidnxt</td></tr>";
		// display total
			$ctr23b += 1;
			$perDay = (($salary*$yearMonths) / $yearWorkingDays );
			$perHr = (($salary*$yearMonths) / $yearWorkingDays ) / $workingHours;




			echo "<tr><td>$ctr23b</td><td>$employeeid23</td><td>$name_last23, $name_first23 $name_middle23[0]</td>";
			if($tot_totaltime!=0) {
			echo "<td align=\"right\">".number_format($tot_totaltime, 2)."</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_otval!=0) {
			echo "<td align=\"right\">".number_format($tot_otval, 2)."</td>";
				$overtimesubtot = ($perHr * $otPercentage)  * $tot_otval;
			} else {
				$overtimesubtot = 0;

			echo "<td align=\"center\">-</td>";
			}
			if($tot_utval!=0) {
				if($tot_utval<0) {
				echo "<td align=\"right\"><font color=\"red\">".number_format($tot_utval, 2)."</font></td>";
				$latesubtot = $perHr * $tot_utval * -1;
				} else {
				echo "<td align=\"right\">".number_format($tot_utval, 2)."</td>";
				}
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_otutval!=0) {
				if($tot_otutval<0) {
				echo "<td align=\"right\"><font color=\"red\">".number_format($tot_otutval, 2)."</font></td>";
				} else {
				echo "<td align=\"right\">".number_format($tot_otutval, 2)."</td>";
				}
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_ndval!=0) {
			echo "<td align=\"right\">".number_format($tot_ndval, 2)."</td>";
			$nigthdifsubtot = ($perHr * $nightdiffPercentage) * $tot_ndval;
			} else {
			echo "<td align=\"center\">-</td>";
			}

			if($tot_restdaytime!=0) {
			echo "<td align=\"center\">$tot_restdaytime</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}

			if($tot_specialholidaytime!=0) {
			echo "<td align=\"center\">$tot_specialholidaytime</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}

			if($tot_legalholidaytime!=0) {
			echo "<td align=\"center\">$tot_legalholidaytime</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}

			if($tot_meal!=0) {
			echo "<td align=\"center\">$tot_meal</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}


			if($salary!=0) {
			echo "<td align=\"center\">".number_format($salary,2)."</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}


			
				$totalRestday = ($perHr * $otRestdayPercentage)  * $tot_restdaytime;
				$totalLegalHoliday = ($perHr * $legalHolidayPercentage)  * $tot_legalholidaytime;
				$totalSpecialHoliday = ($perHr * $specialHolidayPercentage)  * $tot_specialholidaytime;
				$totalMealAllowance = $mealAllowanceAmount * $tot_meal;


			echo "<td align=\"center\">";
			echo number_format($perDay,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($perHr,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($latesubtot,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($overtimesubtot,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($nigthdifsubtot,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($totalRestday,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($totalSpecialHoliday,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($totalLegalHoliday,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($totalMealAllowance,2);
			echo "</td>";

			//additonal incomes

			$res15query = "SELECT idhrtaempincome, name, amount, datestart, dateend, nontaxable, vatinclusive, status, schedule FROM tblhrtaempincome WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid23\" ORDER BY dateend DESC, datestart DESC";
				$result15=""; $found15=0; $ctr15=0;
				/*
				$result15 = mysql_query("", $dbh);
				if($result15 != "") {
					while($myrow15 = mysql_fetch_row($result15)) {
				*/

				$result15 = $dbh2->query($res15query);
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

					if($nontaxable15 == 1){
						$totalNonvatableIncome += $amount15;
					}
					else{
						$totalVatableIncome += $amount15;
					}
				}

					echo '<td align="center">'.number_format($totalNonvatableIncome,2).'</td>';
					echo '<td align="center">'.number_format($totalVatableIncome,2).'</td>';
				}
				else{
					echo '<td align="center">-</td>';
					echo '<td align="center">-</td>';
				}

			//end additional incomes

			//deductions
				$res100query = "SELECT idtblfinpaydeduct, deductname, deductamount, deducttotal, deductbalance, datestart, dateend, status, schedule FROM tblfinpaydeduct WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid23\" ORDER BY dateend DESC, datestart DESC";
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
						}

						echo '<td align="center">'.number_format($totaldeductamount,2).'</td>';
					}
					else{
						echo '<td align="center">-</td>';
					}
			//end deductions 


			//start sss and philhealth

			//formulas 

			// $netbasicpay = $empsalaryhf - ($latesubtot);
			if($tot_totaltime >= 80)
			{
				$totalSalary = $salary / 2;          
			}
			else{
				$totalSalary = $tot_totaltime*$perHr;
			}


			$netbasicpay = ($totalSalary) - ($latesubtot);
			$overtimesubtotal = $overtimesubtot + $nigthdifsubtot + $totalLegalHoliday + $totalSpecialHoliday + $totalRestday;
			$comprate = $netbasicpay + $totalVatableIncome + $overtimesubtotal ;
			$grosspay = $comprate + $overtimesubtotal + $totalNonvatableIncome + $totalMealAllowance;

			//end formulas


			if($cutwhat=='01') {
				$subtotnetbasicpay = $netbasicpay;

				$res101query="SELECT idphlhealth2018, mbsmin, mbsmax, pct, maxpremium FROM tblphlhealth2018 WHERE mbsmin<=$subtotnetbasicpay AND mbsmax>=$subtotnetbasicpay";
				$result101=""; $found101=0;
				$result101=$dbh2->query($res101query);
				if($result101->num_rows>0) {
					while($myrow101=$result101->fetch_assoc()) {
					$found101=1;
					$idphlhealth2018101 = $myrow101['idphlhealth2018'];
					$mbsmin101 = $myrow101['mbsmin'];
					$mbsmax101 = $myrow101['mbsmax'];
					$pct101 = $myrow101['pct'];
					$maxpremium101 = $myrow101['maxpremium'];
					} // while($myrow101=$result101->fetch_assoc())
				} // if($result101->num_rows>0)
				if($found101==1) {
					if($pct101!=0) {
					// $phlhealth2018 = round(($emp_salary12 * ($pct101/101)), 2);
					$phlhealth2018 = round(($subtotnetbasicpay * ($pct101/101)), 2);
					$phlhlthee = $phlhealth2018 / 2;
					$phlhlther = $phlhealth2018 / 2;
					} else { // if($pct101!=0)
					$phlhealth2018 = $maxpremium101;
					$phlhlthee = $phlhealth2018 / 2;
					$phlhlther = $phlhealth2018 / 2;
					} // if($pct101!=0)
				} // if($found101==1)


				echo "<td align=\"center\">";
				echo number_format($phlhealth2018,2);
				echo "</td>";



				$res19query="SELECT idsss201904, salcredit, sscer, sscee, ssctotal, eccer, tcer, tcee, tctotal FROM tblsss201904 WHERE compfrom<=$grosspay AND compto>=$grosspay";


				// $res19query="SELECT ssscontributionid, salarycredit, sser, ssee, sstotal, ecer, tcer, tcee, tctotal FROM tblssscontribution WHERE compfrom<=$grosspay AND compto>=$grosspay";
				$result19=""; $found19=0; $ctr19=0;
				$result19=$dbh2->query($res19query);
				if($result19->num_rows>0) {
					while($myrow19=$result19->fetch_assoc()) {
					$found19=1;
					$idsss201904 = $myrow19['idsss201904'];
					$salcredit = $myrow19['salcredit'];
					$sscer = $myrow19['sscer'];
					$sscee = $myrow19['sscee'];
					$ssctotal = $myrow19['ssctotal'];
					$eccer = $myrow19['eccer'];
					$tcer = $myrow19['tcer'];
					$tcee = $myrow19['tcee'];
					$tctotal = $myrow19['tctotal'];
					} // while
				} // if
				if($found19==1) {
					$deductionfin=$tcee;
					$ecfin=$eccer;
					$ssfin=$sscer;
				} else {
					$deductionfin=0;
					$ecfin=0;
					$ssfin=0;
				} // if

				echo "<td align=\"center\">";
				echo number_format($deductionfin,2);
				echo "</td>";
			}

			else{
				$deductionfin=0;
				$phlhealth2018=0;
				echo "<td align=\"center\">";
				echo "0.00";
				echo "</td>";
				echo "<td align=\"center\">";
				echo "0.00";
				echo "</td>";
			}

			echo "<td align=\"center\">";
			echo "50.00";
			echo "</td>";

			//end sss and philhealth


			//tax
			// get new wtax based on comprate
			$wtaxsched='sm';
			$res14query="SELECT idwtax2018, crmin, crmax, percent, prescramt FROM tblwtax2018 WHERE sched='sm' AND (crmin<=$comprate AND crmax>=$comprate) LIMIT 1";
			$result14=""; $found14=0;
			$result14=$dbh2->query($res14query);
			if($result14->num_rows>0) {
				while($myrow14=$result14->fetch_assoc()) {
				$found14=1;
				$idwtax201814 = $myrow14['idwtax2018'];
				$crmin14 = $myrow14['crmin'];
				$crmax14 = $myrow14['crmax'];
				$percent14 = $myrow14['percent'];
				$prescramt14 = $myrow14['prescramt'];
				} // while($myrow14=$resul14->fetch_assoc())
			} // if($result14->num_rows>0)
			if($found14==1) {
				if($percent14!=0) {
				// include overtime in comprate
				$comprate2 = $comprate + $overtimesubtot;
				$wtax2018 = ((($comprate2 - $crmin14) * ($percent14/100)) + $prescramt14);
				$flg='wpct';
				} else { // if($percent14==0)
				// $wtax2018 = round((($comprate - $crmin14) + $prescramt14), 2);
				$wtax2018 = ((($comprate2 - $crmin14) * ($percent14/100)) + $prescramt14);
				$flg='0pct';
				} // if($percent14==0)
			} // if($found14==1)

			echo "<td align=\"center\">";
			echo number_format($wtax2018,2);
			echo "</td>";

			//end tax

			$totalDeductions = $wtax2018 + $phlhealth2018 + $deductionfin + $totaldeductamount + $latesubtot  + 50;
			$totalNetPay = $grosspay - $totalDeductions;


			echo "<td align=\"center\">";
			echo number_format($grosspay,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($totalDeductions,2);
			echo "</td>";

			echo "<td align=\"center\">";
			echo number_format($totalNetPay,2);
			echo "</td>";
			
			echo "</tr>";
			// reset totals
			$tot_totaltime=0; $tot_otval=0; $tot_utval=0; $tot_otutval=0; $tot_ndval=0; $tot_meal=0; $tot_lvtyp_sick=0; $tot_lvtyp_vacation=0; $tot_lvtyp_paternity=0; $tot_lvtyp_maternityn=0; $tot_lvtyp_maternityc=0; $tot_lvtyp_special=0; $tot_lvtyp_accumulated=0; $tot_lvtyp_absent=0; $tot_lvtyp_sd=0; $tot_lvtyp_cc=0; $tot_lvtyp_ob=0; $fintxtlvtyp=""; $fintotlvdur=0;$latesubtot =0; $overtimesubtot=0; $nigthdifsubtot = 0; $totalDeductions = 0; $totaldeductamount=0; $totalNetPay =0; $grosspay =0; $totalRestday =0;$totalLegalHoliday = 0; $totalSpecialHoliday = 0; $tot_specialholidaytime =0; $tot_legalholidaytime =0; $tot_restdaytime = 0; $latesubtot= 0; $totalMealAllowance=0;

		} // while($myrow23 = mysql_fetch_row($result23))
	} // if($result23 != "")

	
	echo "</table>";


// end contents here...


// edit body-footer
     echo "<p><a href=\"cutoff.php?loginid=$loginid\">Email Payslip</a></p>";
     echo "<p><a href=\"hrtimeatt.php?loginid=$loginid\">Back</a></p>";

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
