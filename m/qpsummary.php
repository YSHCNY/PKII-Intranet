<?php
//
// qpayrollsumm.php
// fr: 

// db conn string
include '../includes/dbh.php';




    
	$res3query = mysql_query("SELECT * FROM tblemppayroll WHERE employeeid = '$employeeid0' ORDER BY cut_start DESC", $dbh);
	$result2=""; $found2=0; $ctr11=0;
	 $result2=$dbh->query($res3query);
	$emppayrollidArr=array();
	$employeeid0Arr=array();
	$emp_salaryArr=array();
	$deductionArr=array();
	$phil_dedArr=array();
	$taxArr=array();
	$emp_over_durationArr=array();
	$net_payArr=array();
	$emp_date_wrkArr=array();
	$emp_sickArr=array();
	$emp_vacationArr=array();
	$cut_startArr=array();
	$cut_endArr=array();
	$regholidayArr=array();
	$speholidayArr=array();
	$otsundayArr=array();
	$regholidayamtArr=array();
	$speholidayamtArr=array();
	$otsundayamtArr=array();
	$overamtArr=array();
	$nightdiffminutesArr=array();
	$nightdiffamtArr=array();
	$totaltardyArr=array();
	$otherincomeArr=array();
	$otherincometaxableArr=array();
	$otherdeductionArr=array();
	$emp_depArr=array();
	$pagibigArr=array();
	$vlusedArr=array();
	$slusedArr=array();
	$philempArr=array();
	$ssArr=array();
	$ecArr=array();
	$bracketArr=array();
	$absentamtArr=array();
	
	if($result2->num_rows>0) {
		while($myrow2=$result2->fetch_assoc()) {
		 $found2=1;
		array_push($emppayrollidArr, $myrow2['emppayrollid']);
		array_push($employeeid0Arr, $myrow2['employeeid']);
		array_push($emp_salaryArr, $myrow2['emp_salary']);
		array_push($deductionArr, $myrow2['deduction']);
		array_push($phil_dedArr, $myrow2['phil_ded']);
		array_push($taxArr, $myrow2['tax']);
		array_push($emp_over_durationArr, $myrow2['emp_over_duration']);
		array_push($net_payArr, $myrow2['net_pay']);
		array_push($emp_date_wrkArr, $myrow2['emp_date_wrk']);
		array_push($emp_sickArr, $myrow2['emp_sick']);
		array_push($emp_vacationArr, $myrow2['emp_vacation']);
		array_push($cut_startArr, $myrow2['cut_start']);
		array_push($cut_endArr, $myrow2['cut_end']);
		array_push($regholidayArr, $myrow2['regholiday']);
		array_push($speholidayArr, $myrow2['speholiday']);
		$payrate = 0;
		$totallateabsent = 0;
		$netbasicpay = 0;
		$totalovertime = 0;
		$grosspay = 0;
		$deductionstotal = 0;
		
	/*if($result2->num_rows>0) {
	while($myrow2=$result2->fetch_assoc()) {
	 
	  
		$payrate = 0;
		$totallateabsent = 0;
		$netbasicpay = 0;
		$totalovertime = 0;
		$grosspay = 0;
		$deductionstotal = 0;

		    $emppayrollid = $myrow2['emppayrollid'];
			$employeeid0 = $myrow2['employeeid'];
			$emp_salary = $myrow2['emp_salary'];
			$deduction = $myrow2['deduction'];
			$phil_ded = $myrow2['phil_ded'];
			$tax = $myrow2['tax'];
			$emp_over_duration = $myrow2['emp_over_duration'];
			$net_pay = $myrow2['net_pay'];
			$emp_date_wrk = $myrow2['emp_date_wrk'];
			$emp_sick = $myrow2['emp_sick'];
			$emp_vacation = $myrow2['emp_vacation'];
			$cut_start = $myrow2['cut_start'];
			$cut_end = $myrow2['cut_end'];
			$regholiday = $myrow2['regholiday'];
			$speholiday = $myrow2['speholiday'];
			$emp_late_duration = $myrow2['emp_late_duration'];
			$otsunday = $myrow2['otsunday'];
			$regholidayamt = $myrow2['regholidayamt'];
			$speholidayamt = $myrow2['speholidayamt'];
			$otsundayamt = $myrow2['otsundayamt'];
			$overamt = $myrow2['overamt'];
			$nightdiffminutes = $myrow2['nightdiffminutes'];
			$nightdiffamt = $myrow2['nightdiffamt'];
			$totaltardy = $myrow2['totaltardy'];
			$otherincome = $myrow2['otherincome'];
			$otherincometaxable = $myrow2['otherincometaxable'];
			$otherdeduction = $myrow2['otherdeduction'];
			$emp_dep = $myrow2['emp_dep'];
			$pagibig = $myrow2['pagibig'];
			$vlused = $myrow2['vlused'];
			$slused = $myrow2['slused'];
			$philemp = $myrow2['philemp'];
			$ss = $myrow2['ss'];
			$ec = $myrow2['ec'];
			$bracket = $myrow2['bracket'];
			$absentamt = $myrow2['absentamt'];*/

			/*$payrate = $emp_salary / 2;
			$totallateabsent = $totaltardy + $absentamt;
			$netbasicpay = ($emp_salary / 2) - $totallateabsent;
			$totalovertime = $nightdiffamt + $overamt + $otsundayamt + $speholidayamt + $regholidayamt;
			$grosspay = $netbasicpay + $totalovertime + $otherincometaxable + $otherincome;
			$deductionstotal = $tax + $deduction + $philemp + $pagibig + $otherdeduction;
	*/
	  }
	
	}
	
	mysql_close($dbh);
	?>