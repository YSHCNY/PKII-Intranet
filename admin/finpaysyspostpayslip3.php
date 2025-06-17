<?php
//
// finpaysyspostpayslip3.php 20250127
// fr finpaysyspostpayslip2.php where incl fr finpaysyspostpayslip.php
//

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$from = (isset($_POST['from'])) ? $_POST['from'] :'';
$from .= "$from\r\nContent-Type: text/plain; charset=utf-8";
$subject = (isset($_POST['subject'])) ? $_POST['subject'] :'';
$header = (isset($_POST['header'])) ? $_POST['header'] :'';
$salary = (isset($_POST['salary'])) ? $_POST['salary'] :'';
$footer = (isset($_POST['footer'])) ? $_POST['footer'] :'';
$notes = (isset($_POST['notes'])) ? $_POST['notes'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
    include ("header.php");
    include ("sidebar.php");

?>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
<?php
// start contents here...

if($idpaygroup!=0 && $idcutoff!=0) {
    echo "<html><pre>";
    foreach($employeeid as $value) {
		$res12query=""; $result12=""; $found12=0; $ctr12=0;
		$res12query="SELECT tblemppayroll.emppayrollid, tblemppayroll.emp_salary, tblemppayroll.absentamt, tblemppayroll.otherincometaxable, tblemppayroll.otherincome, tblemppayroll.net_pay, tblemppayroll.totaltardy, tblemppayroll.emp_dep, tblemppayroll.nightdiffamt, tblemppayroll.overamt, tblemppayroll.otsundayamt, tblemppayroll.speholidayamt, tblemppayroll.regholidayamt, tblemppayroll.tax, tblemppayroll.ss, tblemppayroll.ec, tblemppayroll.philemp, tblemppayroll.pagibig, tblemppayroll.otherdeduction, tblemppayroll.emp_sick, tblemppayroll.emp_vacation, tblemppayroll.cut_start, tblemppayroll.cut_end, tblemppayroll.vlused, tblemppayroll.slused, tblemppayroll.deduction, tblemppayroll.emp_over_duration, tblemppayroll.otsunday, tblemppayroll.regholiday, tblemppayroll.speholiday, tblemppayroll.nightdiffminutes, tblemppayroll.projcode, tblemppayroll.ottotval, tblemppayroll.ottotamt, tblemppayroll.otrest8val, tblemppayroll.otrest8amt, tblemppayroll.otspsun8val, tblemppayroll.otspsun8amt, tblemppayroll.otlegal8val, tblemppayroll.otlegal8amt, tblemppayroll.otlegalsunval, tblemppayroll.otlegalsunamt, tblemppayroll.otlegalsun8val, tblemppayroll.otlegalsun8amt, tblemppayroll.otsp8val, tblemppayroll.otsp8amt, tblemppayroll.otrestval, tblemppayroll.otrestamt, tblemppayroll.transpoallow, tblemppayroll.transpoallowamt, tblemppayroll.mealallow, tblemppayroll.mealallowamt, tblemppayroll.sdval, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblcontact.email2 FROM tblemppayroll LEFT JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid WHERE tblemppayroll.employeeid=\"$value\" AND fk_idhrtapaygrp=$idpaygroup AND fk_idhrtacutoff=$idcutoff AND tblcontact.contact_type=\"personnel\"";
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
				$found12=1; $ctr12++;
				$emppayrollid12 = $myrow12['emppayrollid'];
				$emp_salary12 = $myrow12['emp_salary'];
				$absentamt12 = $myrow12['absentamt'];
				$otherincometaxable12 = $myrow12['otherincometaxable'];
				$otherincome12 = $myrow12['otherincome'];
				$net_pay12 = $myrow12['net_pay'];
				$totaltardy12 = $myrow12['totaltardy'];
				$emp_dep12 = $myrow12['emp_dep'];
				$nightdiffamt12 = $myrow12['nightdiffamt'];
				$overamt12 = $myrow12['overamt'];
				$otsundayamt12 = $myrow12['otsundayamt'];
				$speholidayamt12 = $myrow12['speholidayamt'];
				$regholidayamt12 = $myrow12['regholidayamt'];
				$tax12 = $myrow12['tax'];
				$ss12 = $myrow12['ss'];
				$ec12 = $myrow12['ec'];
				$philemp12 = $myrow12['philemp'];
				$pagibig12 = $myrow12['pagibig'];
				$otherdeduction12 = $myrow12['otherdeduction'];
				$emp_sick12 = $myrow12['emp_sick'];
				$emp_vacation12 = $myrow12['emp_vacation'];
				
				$cut_start12 = $myrow12['cut_start'];
				$start=$cut_start12;
				$cut_end12 = $myrow12['cut_end'];
				$end=$cut_end12;
				
				$vlused12 = $myrow12['vlused'];
				$slused12 = $myrow12['slused'];
				$deduction12 = $myrow12['deduction'];
				$emp_over_duration12 = $myrow12['emp_over_duration'];
				$otsunday12 = $myrow12['otsunday'];
				$regholiday12 = $myrow12['regholiday'];
				$speholiday12 = $myrow12['speholiday'];
				$nightdiffminutes12 = $myrow12['nightdiffminutes'];
				$projcode12 = $myrow12['projcode'];
				
				$ottotval12 = $myrow12['ottotval'];
				$ottotamt12 = $myrow12['ottotamt'];
				$otrest8val12 = $myrow12['otrest8val'];
				$otrest8amt12 = $myrow12['otrest8amt'];
				$otspsun8val12 = $myrow12['otspsun8val'];
				$otspsun8amt12 = $myrow12['otspsun8amt'];
				$otlegal8val12 = $myrow12['otlegal8val'];
				$otlegal8amt12 = $myrow12['otlegal8amt'];
				$otlegalsunval12 = $myrow12['otlegalsunval'];
				$otlegalsunamt12 = $myrow12['otlegalsunamt'];
				$otlegalsun8val12 = $myrow12['otlegalsun8val'];
				$otlegalsun8amt12 = $myrow12['otlegalsun8amt'];
				$otsp8val12 = $myrow12['otsp8val'];
				$otsp8amt12 = $myrow12['otsp8amt'];
				$otrestval12 = $myrow12['otrestval'];
				$otrestamt12 = $myrow12['otrestamt'];
				$transpoallow12 = $myrow12['transpoallow'];
				$transpoallowamt12 = $myrow12['transpoallowamt'];
				$mealallow12 = $myrow12['mealallow'];
				$mealallowamt12 = $myrow12['mealallowamt'];
				$sdval12 = $myrow12['sdval'];
				
				$name_last12 = $myrow12['name_last'];
				$name_first12 = $myrow12['name_first'];
				$name_middle12 = $myrow12['name_middle'];
				$email112 = $myrow12['email1'];
			if($email112!="") { $email=$email112; }
				$email212 = $myrow12['email2'];
				
    // $payrate = $emp_salary12 / 2;
	$payrate = $emp_salary12;
    $totallateabsent = $totaltardy12 + $absentamt12;
    $netbasicpay = $payrate - $totallateabsent;
	
    // $totalovertime = $nightdiffamt12 + $overamt12 + $otsundayamt12 + $speholidayamt12 + $regholidayamt12;
	$totalovertime = $nightdiffamt12 + $overamt12 + $otsundayamt12 + $speholidayamt12 + $regholidayamt12 + $otrest8amt12 + $otspsun8amt12 + $otlegal8amt12 + $otlegalsunamt12 + $otlegalsun8amt12 + $otsp8amt12 + $otrestamt12; //20250617upd
	$totalovertime = number_format($totalovertime,2);
	
	$otsumrestval = $otsunday12 + $otrest8val12 + $otrestval12;
	$otsumrestamt = number_format($otrest8amt12 + $otsundayamt12 + $otrestamt12,2);
	
	$otsumspeholidayamt = number_format($speholidayamt12 + $otsp8amt12 + $otspsun8amt12,2);
	
	$otsumlegalholiamt = number_format($regholidayamt12 + $otlegal8amt12 + $otlegalsunamt12 + $otlegalsun8amt12,2);

    $grosspay = $netbasicpay + $totalovertime + $otherincometaxable12 + $otherincome12;
    $deductionstotal = $tax12 + $deduction12 + $philemp12 + $pagibig12 + $otherdeduction12;

    $message = "";
	$message = $message . "$header\n\n";
	
	$message = $message . "cutoff period: $start -to- $end\n\n";
	
	$message = $message . "Employee ID: $value\n";
	$message = $message . "Employee Name: $name_first12 $name_middle12[0] $name_last12\n";
	$message = $message . "Project: $emp_dep12\n\n";
	
	$message = $message . "PAY RATE: " . formatMoney($payrate) . "\n\n";
	$message = $message . "Total Late_Absent: " . $totallateabsent . "\n";
	$message = $message . "NET BASIC PAY: " . formatMoney($netbasicpay) . "\n\n";
	
	$message = $message . "Regular Overtime: " . formatMoney($overamt12) . "\n";
	// $message = $message . "Reg.Sun/Sat. OT: " . $otsunday . " (mins) - " . formatMoney($otsundayamt12) . "\n";
	$message = $message . "Reg.Sun/Sat. OT: " . $otsumrestval . " (hrs) - " . formatMoney($otsumrestamt) . "\n";
	// $message = $message . "Legal Holiday OT: " . formatMoney($regholidayamt12) . "\n";
	$message = $message . "Legal Holiday OT: " . formatMoney($otsumlegalholiamt) . "\n";
	// $message = $message . "Special Holiday OT: " . formatMoney($speholidayamt12) . "\n";
	$message = $message . "Special Holiday OT: " . formatMoney($otsumspeholidayamt) . "\n";
	$message = $message . "Night Differential: " . formatMoney($nightdiffamt12) . "\n";
	$message = $message . "TOTAL OVERTIME: " . formatMoney($totalovertime) . "\n\n";

    $message = $message . "Additional Income:\n";
	
	$message = $message . "Taxable Income:\n";
    $res14aquery=""; $result14a=""; $found14a=0; $ctr14a=0;
	$res14aquery = "SELECT description, amount, projcode FROM tblfinpayprocsupprec WHERE tblfinpayprocsupprec.employeeid=\"$value\" AND tblfinpayprocsupprec.type=\"taxable\" AND fk_idhrtapaygrp=$idpaygroup AND fk_idhrtacutoff=$idcutoff"; 
	$result14a=$dbh2->query($res14aquery);
	if($result14a->num_rows>0) {
		while($myrow14a=$result14a->fetch_assoc()) {
		$found14a=1; $ctr14a++;
		$description14a = $myrow14a['description'];
		$amount14a = $myrow14a['amount'];
		$message = $message . "$description14a: ".number_format($amount14a,2)."\n";
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)
	$message = $message . "TOTAL Taxable Income: " . formatMoney($otherincometaxable12) . "\n\n";

	$message = $message . "Non-taxable Income:\n";
    $res14bquery=""; $result14b=""; $found14b=0; $ctr14b=0;
	$res14bquery = "SELECT description, amount, projcode FROM tblfinpayprocsupprec WHERE tblfinpayprocsupprec.employeeid=\"$value\" AND tblfinpayprocsupprec.type=\"nontaxable\" AND fk_idhrtapaygrp=$idpaygroup AND fk_idhrtacutoff=$idcutoff"; 
	$result14b=$dbh2->query($res14bquery);
	if($result14b->num_rows>0) {
		while($myrow14b=$result14b->fetch_assoc()) {
		$found14b=1; $ctr14b++;
		$description14b = $myrow14b['description'];
		$amount14b = $myrow14b['amount'];
		$message = $message . "$description14b: ".number_format($amount14b,2)."\n";
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)
	$message = $message . "TOTAL Non-Taxable Income: " . formatMoney($otherincome12) . "\n\n";

    $message = $message . "GROSS PAY: " . formatMoney($grosspay) . "\n\n";
	
	$message = $message . "Withholding Tax: " . formatMoney($tax12) . "\n";
	$message = $message . "SSS: " . formatMoney($deduction12) . "\n";
	$message = $message . "Philhealth: " . formatMoney($philemp12) . "\n";
	$message = $message . "Pag-ibig: " . formatMoney($pagibig12) . "\n\n";

    $message = $message . "Other Deductions:\n";

    $res14cquery=""; $result14c=""; $found14c=0; $ctr14c=0;
	$res14cquery = "SELECT description, amount, projcode FROM tblfinpayprocsupprec WHERE tblfinpayprocsupprec.employeeid=\"$value\" AND tblfinpayprocsupprec.type=\"deduction\" AND fk_idhrtapaygrp=$idpaygroup AND fk_idhrtacutoff=$idcutoff"; 
	$result14c=$dbh2->query($res14cquery);
	if($result14c->num_rows>0) {
		while($myrow14c=$result14c->fetch_assoc()) {
		$found14c=1;
		$description14c = $myrow14c['description'];
		$amount14c = $myrow14c['amount'];
		$message = $message . "$description14c: ".number_format($amount14c,2)."\n";
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

    $message = $message . "Total Other Deductions: " . formatMoney($otherdeduction12) . "\n\n";
	$message = $message . "TOTAL DEDUCTIONS: " . formatMoney($deductionstotal) . "\n\n";
	
	$message = $message . "NET PAY: " . formatMoney($net_pay12) . "\n\n";
	$message = $message . "$footer\n\n$notes\n\n";
	
	echo "$message<br>";

    // send individual email/s
    $ok = "";
	$ok = mail("$email", "$subject", "$message", "From: $from");
	if($ok) {
		echo "<p class='text-success'>Congratulations! email SENT successfuly</p>";
		
		$processed = $processed . $message . "------------------------------------------------------------------------------------------------------------\n";
	} else { // if($ok)
	    echo "<p><font color=red>Sorry, the email was not sent. Pls try again.</font></p>";
	} // if($ok)
		
	echo "email: $email<hr>";

			} //while
		} //if
	} //foreach($employeeid as $value)
    echo "</pre></html>";
	
    $File = "/var/www/pkii/admin/logs/". date("y-m-d_H:i:s", time()) . "_" . $start . "_" . $end . ".txt";
	$Handle = fopen($File, 'w');
	$Data = $processed; 
	fwrite($Handle, $Data);
	fclose($Handle);
	
	// insert logs
	$adminlogdetails = "$loginid:$username - send employees payslip (PayrollV2) thru their individual emails with cutoff period: $start -to- $end file:$File";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
	$result17=$dbh2->query($res17query);

} //if($idpaygroup!=0 && $idcutoff!=0)
	
    echo "<p><a href=\"finpaysyspost.php?loginid=$loginid\" class='btn mainbtnclr text-white' >Back</a></p>";

// end contents here...

    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid"; 
    $result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

function FormatMoney($number) {
    $number = preg_replace("/[^0-9\.]/", "", str_replace(',','.',$number));
    if (substr($number,-3,1)=='.') {
        $sents = '.'.substr($number,-2);
        $number = substr($number,0,strlen($number)-3);
    } elseif (substr($number,-2,1)=='.') {
        $sents = '.'.substr($number,-1);
        $number = substr($number,0,strlen($number)-2);
    } else {
        $sents = '.00';
    }
    $number = preg_replace("/[^0-9]/", "", $number);
    return 'P' . number_format($number.$sents,2,'.','');
}

// close database
$dbh2->close();
?>