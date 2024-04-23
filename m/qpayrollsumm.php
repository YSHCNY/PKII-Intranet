<?php
//
// qpayrollsumm.php
// fr: 

// db conn string
include '../includes/dbh.php';

$found = 0;

if($found==1)
{

	$res0query = mysql_query("SELECT employeeid FROM tbllogin WHERE loginid = $loginid", $dbh);
	$result0=""; 
	$result0=$dbh->query($res0query);
	if($result0->num_rows>0) {
		while($myrow0=$result0->fetch_assoc()) {

		$employeeid0 = $myrow0['employeeid'];
	}
	
	$res1query = mysql_query("SELECT * FROM tblcontact WHERE employeeid = '$employeeid0'", $dbh);
	$result1="";
	$result1=$dbh->query($res1query);
	if($result1->num_rows>0) {
	while($myrow11=$result1->fetch_assoc()) {
	  
	  $employeeid0 = $myrow11['employeeid'];
	  $name_last = $myrow11['name_last'];
	  $name_first = $myrow11['name_first'];
	  $name_middle = $myrow11['name_middle'];
	  $position = $myrow11['position'];
	}
	
     //echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 bordercolor=black>";

     $found11 = 0; 

     $res2query = mysql_query("SELECT DISTINCT employeeid FROM tblemppayroll WHERE employeeid = '$employeeid0' ORDER BY cut_start DESC", $dbh);
	 $result11="";
	 $result11=$dbh->query($res2query);
	if($result11->num_rows>0) {
	while($myrow1=$result11->fetch_assoc()) {
		$found11=1;
		$employeeid0 = $myrow1['employeeid'];
		$name_last = $myrow1['name_last'];
		$name_first = $myrow1['name_first'];
		$name_middle = $myrow1['name_middle'];
		$position = $myrow1['position'];
	 

	}
	
	if($found11==1)
	{
	$res3query = mysql_query("SELECT * FROM tblemppayroll WHERE employeeid = '$employeeid0' ORDER BY cut_start DESC", $dbh);
	$result2="";
	 $result2=$dbh->query($res3query);
	if($result2->num_rows>0) {
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
			$absentamt = $myrow2['absentamt'];

			$payrate = $emp_salary / 2;
			$totallateabsent = $totaltardy + $absentamt;
			$netbasicpay = ($emp_salary / 2) - $totallateabsent;
			$totalovertime = $nightdiffamt + $overamt + $otsundayamt + $speholidayamt + $regholidayamt;
			$grosspay = $netbasicpay + $totalovertime + $otherincometaxable + $otherincome;
			$deductionstotal = $tax + $deduction + $philemp + $pagibig + $otherdeduction;
	
	  }
	}
	}
	}
	}
	}
}
	/*$result1 = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblcontact.url, tblcontact.remarks_contact, tblcontact.picfn, tblemployee.emp_ref_num, tblemployee.date, tblemployee.date_hired, tblemployee.date_expired, tblemployee.emp_birthdate, tblemployee.emp_birthplace, tblemployee.emp_civilstatus, tblemployee.empeducationid, tblemployee.emp_num1, tblemployee.emp_tin, tblemployee.emp_sss, tblemployee.emp_philhealth, tblemployee.emp_pagibig, tblemployee.emp_pagibig2, tblemployee.emp_gsis, tblemployee.emp_insuranceid, tblemployee.emp_emergencyid, tblemployee.emp_skills, tblemployee.emp_status, tblemployee.emp_remarks, tblemployee.employee_type, tblemployee.term_resign FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.employeeid=\"$employeeid0\" AND tblcontact.contactid=$contactid0";
	
	$result0=""; $found1=0;
	$result0=$dbh->query($res0query);
	if($result0->num_rows>0) {
		while($myrow1=$result0->fetch_assoc()) {
		$found1=1;
		$employeeid = $myrow1['employeeid'];
		$name_last = $myrow1['name_last'];
		$name_first = $myrow1['name_first'];
		$name_middle = $myrow1['name_middle'];
		$position = $myrow1['position'];
	 
		}
	}*/
	
    mysql_close($dbh);
?> 