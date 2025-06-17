<script src="https://cdn.jsdelivr.net/npm/exceljs@4.3.0/dist/exceljs.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>

<?php
//
// finpaysyspostresult2.php on 20250115
// incl. in finpaysyspostresult.php

// query date start and date end of cutoff period
    $res15bquery="SELECT DISTINCT cut_start, cut_end FROM tblemppayroll WHERE fk_idhrtapaygrp=$idpaygroup  AND fk_idhrtacutoff=$idcutoff";
	$result15b=""; $found15b=0; $ctr15b=0;
	$result15b = $dbh2->query($res15bquery);
	if($result15b->num_rows>0) {
		while($myrow15b = $result15b->fetch_assoc()) {
			$found15b = 1; $ctr15b++;
			$cut_start15b = $myrow15b['cut_start'];
			$cut_end15b = $myrow15b['cut_end'];
		} //while
	} //if



echo "<div class=''>
<button class = 'btn  btn-success my-3' onclick='exportToExcel()'><i class='bi bi-file-earmark-excel '></i> Export to Excel</button>
<table class='table table-hover table-striped table-bordered table-sm' id = 'payrollsummary'>";
echo "<thead>";
// disp title
echo "<tr><td colspan='15' class ='h4 fw-bold'>Philkoei International Inc. (Employees Payroll Summary From ".date('Y-M-d', strtotime($cut_start15b))." To ".date('Y-M-d', strtotime($cut_end15b)).")</td> 
</tr>";
// disp column header
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Employee Salary</th>";
echo "<th>Total L/A</th>";
echo "<th>Net Basic Pay</th>";
echo "<th>Overtime</th>";
echo "<th>Taxable Income</th>";
echo "<th>Non-Taxable Income</th>";
echo "<th>Gross Pay</th>";
echo "<th>Withholding Tax</th>";
echo "<th>SSS Deduction</th>";
echo "<th>Philhealth Deduction</th>";
echo "<th>Pag-IBIG Deduction</th>";
echo "<th>Other Deductions</th>";
echo "<th>Total Deductions</th>";
echo "<th>Net Pay</th>";
// echo "<th>Project</th></tr>";
echo "</thead>";

echo "<tbody>";
// query tblemppayroll
    $res16query=""; $result16=""; $found16=0; $ctr16=0;
	
	$res16query="SELECT tblemppayroll.emppayrollid, tblemppayroll.employeeid, tblemppayroll.emp_salary, tblemppayroll.deduction, tblemppayroll.phil_ded, tblemppayroll.tax, tblemppayroll.emp_over_duration, tblemppayroll.net_pay, tblemppayroll.emp_date_wrk, tblemppayroll.emp_sick, tblemppayroll.emp_vacation, tblemppayroll.cut_start, tblemppayroll.cut_end, tblemppayroll.regholiday, tblemppayroll.speholiday, tblemppayroll.emp_late_duration, tblemppayroll.otsunday, tblemppayroll.regholidayamt, tblemppayroll.speholidayamt, tblemppayroll.otsundayamt, tblemppayroll.overamt, tblemppayroll.nightdiffminutes, tblemppayroll.nightdiffamt, tblemppayroll.totaltardy, tblemppayroll.otherincome, tblemppayroll.otherincometaxable, tblemppayroll.otherdeduction, tblemppayroll.emp_dep, tblemppayroll.pagibig, tblemppayroll.vlused, tblemppayroll.slused, tblemppayroll.philemp, tblemppayroll.ss, tblemppayroll.ec, tblemppayroll.bracket, tblemppayroll.absentamt, tblemppayroll.ottotval, tblemppayroll.ottotamt, tblemppayroll.otrest8val, tblemppayroll.otrest8amt, tblemppayroll.otspsun8val, tblemppayroll.otspsun8amt, tblemppayroll.otlegal8val, tblemppayroll.otlegal8amt, tblemppayroll.otlegalsunval, tblemppayroll.otlegalsunamt, tblemppayroll.otlegalsun8val, tblemppayroll.otlegalsun8amt, tblemppayroll.otsp8val, tblemppayroll.otsp8amt, tblemppayroll.otrestval, tblemppayroll.otrestamt, tblemppayroll.transpoallow, tblemppayroll.transpoallowamt, tblemppayroll.mealallow, tblemppayroll.mealallowamt, tblemppayroll.sdval, tblemppayroll.projcode, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblproject1.proj_fname, tblproject1.proj_sname FROM tblemppayroll LEFT JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid LEFT JOIN tblproject1 ON tblemppayroll.projcode=tblproject1.proj_code WHERE tblemppayroll.fk_idhrtapaygrp=$idpaygroup AND tblemppayroll.fk_idhrtacutoff=$idcutoff ORDER BY tblemppayroll.projcode ASC, tblcontact.name_last ASC, tblcontact.name_first ASC";
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$found16=1; $ctr16++;
		// indicate relevant fields only for display Summary
		$emppayrollid16 = $myrow16['emppayrollid'];
		$employeeid16 = $myrow16['employeeid'];
		$emp_salary16 = $myrow16['emp_salary'];
		$deduction16 = $myrow16['deduction'];
		$phil_ded16 = $myrow16['phil_ded'];
		$tax16 = $myrow16['tax'];
		$emp_over_duration16 = $myrow16['emp_over_duration'];
		$net_pay16 = $myrow16['net_pay'];
		$emp_date_wrk16 = $myrow16['emp_date_wrk'];
		$emp_sick16 = $myrow16['emp_sick'];
		$emp_vacation16 = $myrow16['emp_vacation'];
		$cut_start16 = $myrow16['cut_start'];
		$cut_end16 = $myrow16['cut_end'];
		$regholiday16 = $myrow16['regholiday'];
		$speholiday16 = $myrow16['speholiday'];
		$emp_late_duration16 = $myrow16['emp_late_duration'];
		$otsunday16 = $myrow16['otsunday'];
		$regholidayamt16 = $myrow16['regholidayamt'];
		$speholidayamt16 = $myrow16['speholidayamt'];
		$otsundayamt16 = $myrow16['otsundayamt'];
		$overamt16 = $myrow16['overamt'];
		$nightdiffminutes16 = $myrow16['nightdiffminutes'];
		$nightdiffamt16 = $myrow16['nightdiffamt'];
		$totaltardy16 = $myrow16['totaltardy'];
		$otherincome16 = $myrow16['otherincome'];
		$otherincometaxable16 = $myrow16['otherincometaxable'];
		$otherdeduction16 = $myrow16['otherdeduction'];
		$emp_dep16 = $myrow16['emp_dep'];
		$pagibig16 = $myrow16['pagibig'];
		$vlused16 = $myrow16['vlused'];
		$slused16 = $myrow16['slused'];
		$philemp16 = $myrow16['philemp'];
		$ss16 = $myrow16['ss'];
		$ec16 = $myrow16['ec'];
		$bracket16 = $myrow16['bracket'];
		$absentamt16 = $myrow16['absentamt'];
		$ottotval16 = $myrow16['ottotval'];
		$ottotamt16 = $myrow16['ottotamt'];
		$otrest8val16 = $myrow16['otrest8val'];
		$otrest8amt16 = $myrow16['otrest8amt'];
		$otspsun8val16 = $myrow16['otspsun8val'];
		$otspsun8amt16 = $myrow16['otspsun8amt'];
		$otlegal8val16 = $myrow16['otlegal8val'];
		$otlegal8amt16 = $myrow16['otlegal8amt'];
		$otlegalsunval16 = $myrow16['otlegalsunval'];
		$otlegalsunamt16 = $myrow16['otlegalsunamt'];
		$otlegalsun8val16 = $myrow16['otlegalsun8val'];
		$otlegalsun8amt16 = $myrow16['otlegalsun8amt'];
		$otsp8val16 = $myrow16['otsp8val'];
		$otsp8amt16 = $myrow16['otsp8amt'];
		$otrestval16 = $myrow16['otrestval'];
		$otrestamt16 = $myrow16['otrestamt'];
		$transpoallow16 = $myrow16['transpoallow'];
		$transpoallowamt16 = $myrow16['transpoallowamt'];
		$mealallow16 = $myrow16['mealallow'];
		$mealallowamt16 = $myrow16['mealallowamt'];
		$sdval16 = $myrow16['sdval'];
		$projcode16 = $myrow16['projcode'];
		$projassignid16 = $myrow16['projassignid'];
		$name_last16 = $myrow16['name_last'];
		$name_first16 = $myrow16['name_first'];
		$name_middle16 = $myrow16['name_middle'];
		$proj_fname16 = $myrow16['proj_fname'];
		$proj_sname16 = $myrow16['proj_sname'];
		
		// additional computations
		$payrate = $emp_salary16 / 2;
		$totallateabsent = $totaltardy16 + $absentamt16;
		// $netbasicpay = $payrate - $totallateabsent;
		$netbasicpay = $emp_salary16 - $totallateabsent;
		// $totalovertime = $nightdiffamt16 + $overamt16 + $otsundayamt16 + $speholidayamt16 + $regholidayamt16 + $otrestamt16;
		$totalovertime = $nightdiffamt16 + $regholidayamt16 + $speholidayamt16 + $otsundayamt16 + $overamt16 + $otrest8amt16 + $otspsun8amt16 + $otlegal8amt16 + $otlegalsunamt16 + $otlegalsun8amt16 + $otsp8amt16 + $otrestamt16;

		$grosspay = $netbasicpay + $totalovertime + $otherincometaxable16 + $otherincome16;
		$deductionstotal = $tax16 + $deduction16 + $philemp16 + $pagibig16 + $otherdeduction16;
		
		if($prevprojcode<>$projcode16) {
			$res16aquery=""; $result16a=""; $found16a=0; $ctr16a=0;
			$res16aquery="SELECT projectid, proj_fname, proj_sname WHERE proj_code=\"$projcode16\"";
			$result16a=$dbh2->query($res16aquery);
			if($result16a->num_rows>0) {
			    while($myrow16a=$result16a->fetch_assoc()) {
				$found16a=1; $ctr16a++;
				$projectid16a=$myrow16a['projectid'];
				$proj_fname16a = $myrow16a['proj_fname'];
				$proj_sname16a = $myrow16a['proj_sname'];
				} //while
			} //if

			if($projcode16=="C00-001" || $projcode16=="") {
				echo "<tr><td colspan='15' class = 'fw-bold h4'>GAE</td></tr>";
			} else {
				if($proj_sname16!="") {
		        echo "<tr><td colspan='15' class = 'fw-bold h4'>$proj_sname16</td></tr>";												
				} else {
				echo "<tr><td colspan='15' class = 'fw-bold h4'>".substr($proj_fname16,0,25)."</td></tr>";
				} //if-else
			} //if
		} //if
		echo "<tr><td>$employeeid16</td><td>$name_last16, $name_first16 $name_middle16[0]</td>";
        // echo "<td class='text-right'>".number_format($payrate, 2)."</td>";
		echo "<td class='text-right'>".number_format($emp_salary16, 2)."</td>";
		echo "<td class='text-right'>".number_format($totallateabsent, 2)."</td>";
		echo "<td class='text-right'>".number_format($netbasicpay, 2)."</td>";
		echo "<td class='text-right'>".number_format($totalovertime, 2)."";
		// echo "<br>nd:$nightdiffamt16,ot:$overamt16,otsun:$otsundayamt16,spholi:$speholidayamt16,regholi:$regholidayamt16,otrest:$otrestamt16";
		echo "</td>";
		echo "<td class='text-right'>".number_format($otherincometaxable16, 2)."</td>";
		echo "<td class='text-right'>".number_format($otherincome16, 2)."</td>";
		echo "<td class='text-right'>".number_format($grosspay, 2)."</td>";
		echo "<td class='text-right'>".number_format($tax16, 2)."</td>";
		echo "<td class='text-right'>".number_format($deduction16, 2)."</td>";
		echo "<td class='text-right'>".number_format($philemp16, 2)."</td>";
		echo "<td class='text-right'>".number_format($pagibig16, 2)."</td>";
		echo "<td class='text-right'>".number_format($otherdeduction16, 2)."</td>";
		echo "<td class='text-right'>".number_format($deductionstotal, 2)."</td>";
		echo "<td class='text-right'>".number_format($net_pay16, 2)."</td>";
		// echo "<td>$projcode16</td>";
		echo "</tr>";

		// compute (grand) total
        $totdeduction += $deduction16;
		$totphilded += $phil_ded16;
		$tottax += $tax16;
		$totempoverduration += $emp_over_duration16;
		$totnetpay += $net_pay16;
		$totempdate += $emp_date_wrk16;
		$totregholiday += $regholiday16;
		$totspeholiday += $speholiday16;
		$totemplateduration += $emp_late_duration16;
		$tototsunday += $otsunday16;
		$totregholiday += $regholidayamt16;
		$totspeholidayamt += $speholidayamt16;
		$tototsundayamt += $otsundayamt16;
		$totoveramt += $overamt16;
		$totnightdiffminutes += $nightdiffminutes16;
		$totnightdiffamt += $nightdiffamt16;
		$tottotaltardy += $totaltardy16;
		$tototherincome += $otherincome16;
		$tototherincometaxable += $otherincometaxable16;
		$tototherdeduction += $otherdeduction16;

		$totpagibig += $pagibig16;
		$totphilemp += $philemp16;
		$totss += $ss16;
		$totec += $ec16;
		$totbracket += $bracket16;
		$totabsentamt += $absentamt16;

		$tottotallateabsent += $totallateabsent;
		$totnetbasicpay += $netbasicpay;
		$tottotalovertime += $totalovertime;
		$totgrosspay += $grosspay;
		$totdeductionstotal += $deductionstotal;
		
		$prevprojcode = $projcode16;
		
        // reset variables
		$payrate = 0;
		$totallateabsent = 0;
		$netbasicpay = 0;
		$totalovertime = 0;
		$grosspay = 0;
		$deductionstotal = 0;
		$projcode16="";

		} //while
	} //if
	
	if($found16==1) {
		
	// display summary (grand) total



	echo "<tr>";
	echo "<th></th>";
	echo "<th></th><th colspan=\"\" class='text-right'>Grand TOTAL</th>";
	echo "<th class='text-right'>".number_format($tottotallateabsent, 2)."</th>";
	echo "<th class='text-right'>".number_format($totnetbasicpay, 2)."</th>";
	echo "<th class='text-right'>".number_format($tottotalovertime, 2)."</th>";
	echo "<th class='text-right'>".number_format($tototherincometaxable, 2)."</th>";
	echo "<th class='text-right'>".number_format($tototherincome, 2)."</th>";
	echo "<th class='text-right'>".number_format($totgrosspay, 2)."</th>";
	echo "<th class='text-right'>".number_format($tottax, 2)."</th>";
	echo "<th class='text-right'>".number_format($totdeduction, 2)."</th>";
	echo "<th class='text-right'>".number_format($totphilemp, 2)."</th>";
	echo "<th class='text-right'>".number_format($totpagibig, 2)."</th>";
	echo "<th class='text-right'>".number_format($tototherdeduction, 2)."</th>";
	echo "<th class='text-right'>".number_format($totdeductionstotal, 2)."</th>";
	echo "<th class='text-right'>".number_format($totnetpay, 2)."</th>";
	echo "</tr>";
	
	} //if($found16==1)
	
	// display signatories

	echo "<tr></tr>";
	echo "<tr></tr>";
	echo "<tr  class ='markedTR'>";
	// prepared
	echo "<td align = 'center' colspan='4'>Prepared by:</td>";
	// checked
	echo "<td align = 'center' colspan='4'>Checked by:</td>";
	// noted
	echo "<td align = 'center' colspan='4'>Noted by:</td>";
	// approved
	echo "<td align = 'center' colspan='4'>Approved by:</td>";
	echo "</tr>";

	echo "<tr  class ='markedTR'>";
	// prepared
	echo "<td align = 'center' colspan='4'>";
	echo "________________________"; 
	echo "</td>";
	// checked
	echo "<td align = 'center' colspan='4'>";
	echo "________________________"; 
	echo "</td>";
	// noted
	echo "<td align = 'center' colspan='4'>";
	echo "________________________"; 
	echo "</td>";
	// approved
	echo "<td align = 'center' colspan='4'>";
	echo "________________________"; 
	echo "</td>";
	echo "</tr>";

	echo "<tr  class ='markedTR'>";
	// prepared
	echo "<td class = 'fw-bold h4' align = 'center' colspan='4'>$preparedbyname</td>";
	// checked
	echo "<td class = 'fw-bold h4' align = 'center' colspan='4'>$checkedbyname</td>";
	// noted
	echo "<td class = 'fw-bold h4' align = 'center' colspan='4'>$notedbyname</td>";
	// approved
	echo "<td class = 'fw-bold h4' align = 'center' colspan='4'>$approvedbyname</td>";
	echo "</tr>";

	echo "<tr  class ='markedTR'>";
	// prepared
	echo "<td align = 'center' colspan='4'>$preparedbyposition</td>";
	// checked
	echo "<td align = 'center' colspan='4'>$checkedbyposition</td>";
	// noted
	echo "<td align = 'center' colspan='4'>$notedbyposition</td>";
	// approved
	echo "<td align = 'center' colspan='4'>$approvedbyposition</td>";
	echo "</tr>";


	
echo "</tbody>";
echo "</table></div>";







	if($found16==1) {
		
	// display additional income/s (taxable & non-taxable)
	echo "<div class='table'><table class='table'>";
	echo "<thead>";
	// disp title
	echo "<tr><th colspan='6'>Additional Income: Taxable</th></tr>";
	// disp column header
	echo "<tr><th>Count</th>";
	echo "<th>Employee No.</th>";
	echo "<th>Name</th>";
	echo "<th>Taxable Income</th>";
	echo "<th>ProjCode</th>";
	echo "<th>Amount</th>";
	echo "</tr>";
	
	echo "</thead>";
	
	echo "<tbody>";
	
	$res17query=""; $result17=""; $found17=0; $ctr17=0;
	$res17query="SELECT `tblfinpayprocsupprec`.`idtblfinpayprocsupprec`, `tblfinpayprocsupprec`.`employeeid`, `tblfinpayprocsupprec`.`description`, `tblfinpayprocsupprec`.`amount`, `tblfinpayprocsupprec`.`vat`, `tblfinpayprocsupprec`.`projcode`, `tblcontact`.`name_last`, `tblcontact`.`name_first`, `tblcontact`.`name_middle` FROM `tblfinpayprocsupprec` LEFT JOIN `tblcontact` ON `tblfinpayprocsupprec`.`employeeid`=`tblcontact`.`employeeid` WHERE `tblfinpayprocsupprec`.`type`=\"taxable\" AND `tblfinpayprocsupprec`.`fk_idhrtapaygrp`=$idpaygroup AND `tblfinpayprocsupprec`.`fk_idhrtacutoff`=$idcutoff AND `tblcontact`.`contact_type`=\"personnel\" ORDER BY `tblcontact`.`name_last` ASC, `tblcontact`.`name_first` ASC, `tblfinpayprocsupprec`.`projcode` ASC";
	$result17=$dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17=$result17->fetch_assoc()) {
			$found17=1; $ctr17++;
			$idtblfinpayprocsupprec17 = $myrow17['idtblfinpayprocsupprec'];
			$employeeid17 = $myrow17['employeeid'];
			$description17 = $myrow17['description'];
			$amount17 = $myrow17['amount'];
			$vat17 = $myrow17['vat'];
			$projcode17 = $myrow17['projcode'];
			$name_last17 = $myrow17['name_last'];
			$name_first17 = $myrow17['name_first'];
			$name_middle17 = $myrow17['name_middle'];
			$tot_amount += $amount17;
			
			echo "<tr><td>$ctr17</td><td>$employeeid17</td><td>$name_last17, $name_first17 $name_middle17[0]</td><td>$description17</td><td>$projcode17</td><td class='text-right'>".number_format($amount17,2)."</td></tr>";
			
		} //while
	} //if
    echo "<tr><th colspan='5' class='text-right'>TOTAL Taxable Income</th><th class='text-right'>".number_format($tot_amount,2)."</th></tr>";
	echo "</tbody>";
	echo "</table></div>";
// echo var_dump($res17query);
	echo "<div class='table'><table class='table'>";
	echo "<thead>";
	// disp title
	echo "<tr><th colspan='6'>Additional Income: Non-taxable</th></tr>";
	// disp column header
	echo "<tr><th>Count</th>";
	echo "<th>Employee No.</th>";
	echo "<th>Name</th>";
	echo "<th>Non-taxable Income</th>";
	echo "<th>ProjCode</th>";
	echo "<th>Amount</th>";
	echo "</tr>";
	
	echo "</thead>";
	
	echo "<tbody>";
	
	$res17bquery=""; $result17b=""; $found17b=0; $ctr17b=0;
	$res17bquery="SELECT `tblfinpayprocsupprec`.`idtblfinpayprocsupprec`, `tblfinpayprocsupprec`.`employeeid`, `tblfinpayprocsupprec`.`description`, `tblfinpayprocsupprec`.`amount`, `tblfinpayprocsupprec`.`vat`, `tblfinpayprocsupprec`.`projcode`, `tblcontact`.`name_last`, `tblcontact`.`name_first`, `tblcontact`.`name_middle` FROM `tblfinpayprocsupprec` LEFT JOIN `tblcontact` ON `tblfinpayprocsupprec`.`employeeid`=`tblcontact`.`employeeid` WHERE `tblfinpayprocsupprec`.`type`=\"nontaxable\" AND `tblfinpayprocsupprec`.`fk_idhrtapaygrp`=$idpaygroup AND `tblfinpayprocsupprec`.`fk_idhrtacutoff`=$idcutoff AND `tblcontact`.`contact_type`=\"personnel\" ORDER BY `tblcontact`.`name_last` ASC, `tblcontact`.`name_first` ASC, `tblfinpayprocsupprec`.`projcode` ASC";
	$result17b=$dbh2->query($res17bquery);
	if($result17b->num_rows>0) {
		while($myrow17b=$result17b->fetch_assoc()) {
			$found17b=1; $ctr17b++;
			$idtblfinpayprocsupprec17b = $myrow17b['idtblfinpayprocsupprec'];
			$employeeid17b = $myrow17b['employeeid'];
			$description17b = $myrow17b['description'];
			$amount17b = $myrow17b['amount'];
			$vat17b = $myrow17b['vat'];
			$projcode17b = $myrow17b['projcode'];
			$name_last17b = $myrow17b['name_last'];
			$name_first17b = $myrow17b['name_first'];
			$name_middle17b = $myrow17b['name_middle'];
			$tot_amountb += $amount17b;
			
			echo "<tr><td>$ctr17b</td><td>$employeeid17b</td><td>$name_last17b, $name_first17b $name_middle17b[0]</td><td>$description17b</td><td>$projcode17b</td><td class='text-right'>".number_format($amount17b,2)."</td></tr>";
			
		} //while
	} //if
    echo "<tr><th colspan='5' class='text-right'>TOTAL Non-taxable Income</th><th class='text-right'>".number_format($tot_amountb,2)."</th></tr>";
	echo "</tbody>";
	echo "</table></div>";

	
	// display Deductions
		echo "<div class='table'><table class='table'>";
	echo "<thead>";
	// disp title
	echo "<tr><th colspan='6'>Deductions</th></tr>";
	// disp column header
	echo "<tr><th>Count</th>";
	echo "<th>Employee No.</th>";
	echo "<th>Name</th>";
	echo "<th>Deductions</th>";
	echo "<th>ProjCode</th>";
	echo "<th>Amount</th>";
	echo "</tr>";
	
	echo "</thead>";
	
	echo "<tbody>";
	
	$res17cquery=""; $result17c=""; $found17c=0; $ctr17c=0;
	$res17cquery="SELECT `tblfinpayprocsupprec`.`idtblfinpayprocsupprec`, `tblfinpayprocsupprec`.`employeeid`, `tblfinpayprocsupprec`.`description`, `tblfinpayprocsupprec`.`amount`, `tblfinpayprocsupprec`.`vat`, `tblfinpayprocsupprec`.`projcode`, `tblcontact`.`name_last`, `tblcontact`.`name_first`, `tblcontact`.`name_middle` FROM `tblfinpayprocsupprec` LEFT JOIN `tblcontact` ON `tblfinpayprocsupprec`.`employeeid`=`tblcontact`.`employeeid` WHERE `tblfinpayprocsupprec`.`type`=\"deduction\" AND `tblfinpayprocsupprec`.`fk_idhrtapaygrp`=$idpaygroup AND `tblfinpayprocsupprec`.`fk_idhrtacutoff`=$idcutoff AND `tblcontact`.`contact_type`=\"personnel\" ORDER BY `tblcontact`.`name_last` ASC, `tblcontact`.`name_first` ASC, `tblfinpayprocsupprec`.`projcode` ASC";
	$result17c=$dbh2->query($res17cquery);
	if($result17c->num_rows>0) {
		while($myrow17c=$result17c->fetch_assoc()) {
			$found17c=1; $ctr17c++;
			$idtblfinpayprocsupprec17c = $myrow17c['idtblfinpayprocsupprec'];
			$employeeid17c = $myrow17c['employeeid'];
			$description17c = $myrow17c['description'];
			$amount17c = $myrow17c['amount'];
			$vat17c = $myrow17c['vat'];
			$projcode17c = $myrow17c['projcode'];
			$name_last17c = $myrow17c['name_last'];
			$name_first17c = $myrow17c['name_first'];
			$name_middle17c = $myrow17c['name_middle'];
			$tot_amountc += $amount17c;
			
			echo "<tr><td>$ctr17c</td><td>$employeeid17c</td><td>$name_last17c, $name_first17c $name_middle17c[0]</td><td>$description17c</td><td>$projcode17c</td><td class='text-right'>".number_format($amount17c,2)."</td></tr>";
			
		} //while
	} //if
    echo "<tr><th colspan='5' class='text-right'>TOTAL Deductions</th><th class='text-right'>".number_format($tot_amountc,2)."</th></tr>";
	echo "</tbody>";
	echo "</table></div>";
	
	// display footer

	} //if($found16==1)

	if($found16==0) {
		echo "<p class='text-color:red'>Sorry, No records for this cutoff period</p>";
	} //if


	$filetitle = date('Y-M-d', strtotime($cut_start15b)) ." To ". date('Y-M-d', strtotime($cut_end15b));

	
?>


<script>
async function exportToExcel() {
  const workbook = new ExcelJS.Workbook();
  const worksheet = workbook.addWorksheet('PayrollSummary');

  const table = document.getElementById("payrollsummary");
  const rows = table.querySelectorAll('tr');
  const mergeRanges = [];

  rows.forEach((row, rowIndex) => {
    const cells = row.querySelectorAll('td, th');
    let excelCells = [];
    let currentColumn = 1;

    // Build row with merged cells based on colspan
    cells.forEach(cell => {
      const colspan = parseInt(cell.getAttribute('colspan')) || 1;
      const cellValue = cell.textContent.trim();

      // Set value in current column
      excelCells[currentColumn - 1] = cellValue;

      // Fill in the rest with nulls and prepare merge
      if (colspan > 1) {
        mergeRanges.push({
          start: { row: worksheet.rowCount + 1, column: currentColumn },
          end: { row: worksheet.rowCount + 1, column: currentColumn + colspan - 1 }
        });

        for (let i = 1; i < colspan; i++) {
          excelCells[currentColumn - 1 + i] = null;
        }
      }

      currentColumn += colspan;
    });

    const excelRow = worksheet.addRow(excelCells);

    // === Styling logic ===

    // If colspan=15 (e.g., title rows)
    const firstCell = cells[0];
    if (firstCell && firstCell.colSpan === 15) {
      excelRow.font = { bold: true, size: 14, color: { argb: '000000' } };
      excelRow.fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: { argb: 'E6E6E6' }
      };
      excelRow.alignment = {
        vertical: 'middle',
        wrapText: false
      };
      excelRow.height = 30;
    }

    // Grand TOTAL row styling
    else if (row.textContent.includes('Grand TOTAL')) {
      excelRow.font = { bold: true, size: 12 };
      excelRow.fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: { argb: 'F2F2F2' }
      };

      excelRow.eachCell((cell, colNumber) => {
        if (colNumber >= 4) {
          cell.alignment = {
            vertical: 'middle',
            horizontal: 'right',
            indent: 1
          };
          cell.numFmt = '#,##0.00';
        }
      });
    }

    // Header row
    else if (rowIndex === 0) {
      excelRow.font = { bold: true, size: 12 };
      excelRow.fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: { argb: 'D3D3D3' }
      };
      excelRow.alignment = {
        vertical: 'middle',
        horizontal: 'center',
        wrapText: false
      };
      excelRow.height = 25;
    }

	else if (row.classList.contains('markedTR')) {
	  excelRow.font = { bold: true, size: 12 };
	  excelRow.fill = {
		type: 'pattern',
		pattern: 'solid',
		fgColor: { argb: 'f2f2f2' }
	  };
	  excelRow.alignment = {
		vertical: 'middle',
		horizontal: 'center',
		wrapText: false
	  };
	  excelRow.height = 25;
	}

	// Normal rows
	else {
	  excelRow.font = { size: 11 };
	  excelRow.alignment = {
		vertical: 'middle',
		horizontal: 'right',
		wrapText: true
	  };
	  excelRow.height = 25;

	}

    // All rows
    excelRow.eachCell((cell, colNumber) => {
	
      cell.alignment = cell.alignment || {
        vertical: 'middle',
        horizontal: 'center',
        indent: 1
      };
      cell.border = {
        top: { style: 'thin' },
        left: { style: 'thin' },
        bottom: { style: 'thin' },
        right: { style: 'thin' }
      };

	    excelRow.height = 20;

      // Format numeric
      if (colNumber >= 4 && !isNaN(cell.value)) {
        cell.numFmt = '#,##0.00';
      }
    });
  });

  // Merge cells after adding rows
  mergeRanges.forEach(range => {
    try {
      worksheet.mergeCells(
        range.start.row, range.start.column,
        range.end.row, range.end.column
      );
    } catch (e) {
      console.warn('Merge failed:', range, e);
    }
  });

  // Set column widths
  worksheet.columns = [
    { width: 8 },  { width: 29 }, { width: 25 }, { width: 20 },
    { width: 20 }, { width: 20 }, { width: 20 }, { width: 20 },
    { width: 20 }, { width: 20 }, { width: 20 }, { width: 20 },
    { width: 20 }, { width: 20 }, { width: 20 }, { width: 20 },
    { width: 20 }
  ];

  const buffer = await workbook.xlsx.writeBuffer();
  saveAs(new Blob([buffer]), 'Payroll_SUMMARY<?= $filetitle ?>.xlsx');
}
</script>
