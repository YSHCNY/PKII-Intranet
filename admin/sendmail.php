<?php
require_once("db1.php");
// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$start = (isset($_GET['start'])) ? $_GET['start'] :'';
$end = (isset($_GET['end'])) ? $_GET['end'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$from = (isset($_POST['from'])) ? $_POST['from'] :'';
$subject = (isset($_POST['subject'])) ? $_POST['subject'] :'';
$header = (isset($_POST['header'])) ? $_POST['header'] :'';
$salary = (isset($_POST['salary'])) ? $_POST['salary'] :'';
$footer = (isset($_POST['footer'])) ? $_POST['footer'] :'';
$notes = (isset($_POST['notes'])) ? $_POST['notes'] :'';

$message = "$header\n\n$salary\n\n$footer\n\n$notes<br>";

echo "<html>";

echo "<pre>";

foreach($employeeid as $value) {
	$resquery = "SELECT emppayrollid, employeeid, emp_salary, absentamt, otherincometaxable, otherincome, net_pay, totaltardy, emp_dep, nightdiffamt, overamt, otsundayamt, speholidayamt, regholidayamt, tax, ss, ec, philemp, pagibig, otherdeduction, emp_sick, emp_vacation, vlused, slused, deduction, emp_over_duration, otsunday, regholiday, speholiday, nightdiffminutes FROM tblemppayroll WHERE employeeid = '$value' AND cut_start = '$start' AND cut_end = '$end'";
	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
		$emppayrollid = $myrow['emppayrollid'];
		$employeeid = $myrow['employeeid'];
		$emp_salary = $myrow['emp_salary'];
		$absentamt = $myrow['absentamt'];
		$otherincometaxable = $myrow['otherincometaxable'];
		$otherincome = $myrow['otherincome'];
		$net_pay = $myrow['net_pay'];
		$totaltardy = $myrow['totaltardy'];
		$emp_dep = $myrow['emp_dep'];
		$nightdiffamt = $myrow['nightdiffamt'];
		$overamt = $myrow['overamt'];
		$otsundayamt = $myrow['otsundayamt'];
		$speholidayamt = $myrow['speholidayamt'];
		$regholidayamt = $myrow['regholidayamt'];
		$tax = $myrow['tax'];
		$ss = $myrow['ss'];
		$ec = $myrow['ec'];
		$philemp = $myrow['philemp'];
		$pagibig = $myrow['pagibig'];
		$otherdeduction = $myrow['otherdeduction'];
		$emp_sick = $myrow['emp_sick'];
		$emp_vacation = $myrow['emp_vacation'];
		$vlused = $myrow['vlused'];
		$slused = $myrow['slused'];
		$deduction = $myrow['deduction'];
		$emp_over_duration = $myrow['emp_over_duration'];
		$otsunday = $myrow['otsunday'];
		$regholiday = $myrow['regholiday'];
		$speholiday = $myrow['speholiday'];
		$nightdiffminutes = $myrow['nightdiffminutes'];
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

	$resquery = "SELECT name_first, name_last, email1 FROM tblcontact WHERE employeeid = '$value'"; 
	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
    $name_first = $myrow['name_first'];
    $name_last = $myrow['name_last'];
    $email = $myrow['email1'];
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

     $payrate = $emp_salary / 2;
     $totallateabsent = $totaltardy + $absentamt;
     $netbasicpay = ($emp_salary / 2) - $totallateabsent;
     $totalovertime = $nightdiffamt + $overamt + $otsundayamt + $speholidayamt + $regholidayamt;
     $grosspay = $netbasicpay + $totalovertime + $otherincometaxable + $otherincome;
//     $ssstotal = $ss + $ec;
//     $deductionstotal = $tax + $ssstotal + $philemp + $pagibig + $otherdeduction;
     $deductionstotal = $tax + $deduction + $philemp + $pagibig + $otherdeduction;


     $message = "";
     $message = $message . "$header\n\n";

     $message = $message . "cutoff period: $start -to- $end\n\n";

     $message = $message . "Employee ID: $value\n";
     $message = $message . "Employee Name: $name_first $name_last\n";
     $message = $message . "Project: $emp_dep\n\n";

     $message = $message . "PAY RATE: " . formatMoney($payrate) . "\n\n";

//    $message = $message . "No. of VL: $emp_sick\n";
//     $message = $message . "No. of SL: $emp_vacation\n";
//     $message = $message . "Used VL: $vlused\n";
//     $message = $message . "Used SL: $slused\n\n";

     $message = $message . "Total Late_Absent: $totallateabsent\n";
     $message = $message . "NET BASIC PAY: " . formatMoney($netbasicpay) . "\n\n";

//     $message = $message . "Regular Overtime: $emp_over_duration" . " (mins) - " . formatMoney($overamt) . "\n";
     $message = $message . "Regular Overtime: " . formatMoney($overamt) . "\n";
     $message = $message . "Reg.Sun/Sat. OT: $otsunday" . " (mins) - " . formatMoney($otsundayamt) . "\n";
//     $message = $message . "Reg.Sun/Sat. OT: " . formatMoney($otsundayamt) . "\n";
//     $message = $message . "Legal Holiday OT: $regholiday" . " (mins) - " . formatMoney($regholidayamt) . "\n";
     $message = $message . "Legal Holiday OT: " . formatMoney($regholidayamt) . "\n";
//     $message = $message . "Special Holiday OT: $speholiday" . " (mins) - " . formatMoney($speholidayamt) . "\n";
     $message = $message . "Special Holiday OT: " . formatMoney($speholidayamt) . "\n";
//     $message = $message . "Night Differential: $nightdiffminutes" . " (mins) - " . formatMoney($nightdiffamt) . "\n";
     $message = $message . "Night Differential: " . formatMoney($nightdiffamt) . "\n";
     $message = $message . "TOTAL OVERTIME: " . formatMoney($totalovertime) . "\n\n";

// insert tblemppayincometaxable or add2 details

	$message = $message . "Additional Income:\n";

	$message = $message . "Taxable Income:\n";

	$resquery = "SELECT add_desc, amount FROM tblemppayincometaxable WHERE employeeid = '$employeeid' AND (start <= '$start' AND end >= '$end')"; 
	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
		$found=1;
		$add_desc = $myrow['add_desc'];
    $amount = $myrow['amount'];
    $message = $message . "$add_desc: $amount\n";
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

	$message = $message . "TOTAL Taxable Income: " . formatMoney($otherincometaxable) . "\n\n";

// insert tblemppayincomenontaxable or add details

	$message = $message . "Non-Taxable Income:\n";

	$resquery = "SELECT add_desc, amount FROM tblemppayincomenontaxable WHERE employeeid = '$employeeid' AND (start <= '$start' AND end >= '$end')"; 
	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
    $add_desc = $myrow['add_desc'];
    $amount = $myrow['amount'];
		$message = $message . "$add_desc: $amount\n";
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

	$message = $message . "TOTAL Non-Taxable Income: $otherincome\n\n";
	// $addlincome=round(($otherincometaxable+$otherincome), 2);
	// $message = $message . "TOTAL Additional Income: " . formatMoney($addlincome) . "\n\n";

     $message = $message . "GROSS PAY: " . formatMoney($grosspay) . "\n\n";

     $message = $message . "Withholding Tax: " . formatMoney($tax) . "\n";
     $message = $message . "SSS: " . formatMoney($deduction) . "\n";
     $message = $message . "Philhealth: " . formatMoney($philemp) . "\n";
     $message = $message . "Pag-ibig: " . formatMoney($pagibig) . "\n\n";

// insert tblemppayotherdeductions or deduct details

	$message = $message . "Other Deductions:\n";

	$resquery = "SELECT ded_desc, amountdeduct FROM tblemppayotherdeductions WHERE employeeid = '$employeeid' AND (start <= '$start' AND end >= '$end')"; 
	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
		$found=1;
		$ded_desc = $myrow['ded_desc'];
		$amountdeduct = $myrow['amountdeduct'];
		$message = $message . "$ded_desc: $amountdeduct\n";
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

     $message = $message . "TOTAL Other Deductions: " . formatMoney($otherdeduction) . "\n\n";
     $message = $message . "TOTAL DEDUCTIONS: " . formatMoney($deductionstotal) . "\n\n";

     $message = $message . "NET PAY: " . formatMoney($net_pay) . "\n\n";
     $message = $message . "$footer\n\n$notes\n\n";

     echo "$message<br>";

     $ok = "";

     $ok = mail("$email", "$subject", "$message", "From: $from");

     if($ok) {
          echo "<p>Congratulations your email has been sent</p>";

          $processed = $processed . $message . "------------------------------------------------------------------------------------------------------------\n";

     } else { // if($ok)
          echo "<p><font color=red>Sorry, the email was not sent. Pls try again.</font></p>";
     } // if($ok)

     echo "email: $email<hr>";
} // foreach($employeeid as $value)

echo "</pre>";

$File = "/var/www/pkii/admin/logs/". date("y-m-d_H:i:s", time()) . "_" . $start . "_" . $end . ".txt";
$Handle = fopen($File, 'w');
$Data = "$processed"; 
fwrite($Handle, $Data);
fclose($Handle);

// echo "<a href=emailnotifier.php?loginid=$loginid>Back</a><br>";
echo "</html>";

// mysql_close($dbh);
$dbh2->close();

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
?>
