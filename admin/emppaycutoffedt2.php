<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$prefn = $_POST['prefn'];
$emppayrollid = $_POST['emppayrollid'];
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';
$employeeid = $_POST['employeeid'];
// $emp_salary = $_POST['emp_salary'];
$totaltardy = $_POST['totaltardy'];
$absentamt = $_POST['absentamt'];
$nightdiffamt = $_POST['nightdiffamt'];
$overamt = $_POST['overamt'];
$otsundayamt = $_POST['otsundayamt'];
$speholidayamt = $_POST['speholidayamt'];
$regholidayamt = $_POST['regholidayamt'];
$otherincometaxable = $_POST['otherincometaxable'];
$otherincome = $_POST['otherincome'];
$tax = $_POST['tax'];
$deduction = $_POST['deduction'];
$philemp = $_POST['philemp'];
$pagibig = $_POST['pagibig'];
$otherdeduction = $_POST['otherdeduction'];
// $net_pay = $_POST['net_pay'];

// 20200426
$emp_dep = trim((isset($_POST['proj'])) ? $_POST['proj'] :'');
$payrate = (isset($_POST['payrate'])) ? $_POST['payrate'] :'';
$emp_salary = $payrate*2;

$found = 0;

$secsubtotarr = array();

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

  // prepare values incl formulas
			// $payrate = $emp_salary / 2;
			$totallateabsent = $totaltardy + $absentamt;
			$netbasicpay = $payrate - $totallateabsent;
			$totalovertime = $nightdiffamt + $overamt + $otsundayamt + $speholidayamt + $regholidayamt;
			$grosspay = $netbasicpay + $totalovertime + $otherincometaxable + $otherincome;
			$deductionstotal = $tax + $deduction + $philemp + $pagibig + $otherdeduction;
      $net_pay = $grosspay - $deductionstotal;

  // update query based on id
  $res11query=""; $result11=""; $found11=0;
  $res11query="UPDATE tblemppayroll SET emp_salary=\"$emp_salary\", deduction=\"$deduction\", tax=\"$tax\", net_pay=\"$net_pay\", regholidayamt=\"$regholidayamt\", speholidayamt=\"$speholidayamt\", otsundayamt=\"$otsundayamt\", overamt=\"$overamt\", nightdiffamt=\"$nightdiffamt\", totaltardy=\"$totaltardy\", otherincome=\"$otherincome\", otherincometaxable=\"$otherincometaxable\", otherdeduction=\"$otherdeduction\", emp_dep=\"$emp_dep\", pagibig=\"$pagibig\", philemp=\"$philemp\", absentamt=\"$absentamt\" WHERE emppayrollid=$emppayrollid AND employeeid=\"$employeeid\" AND cut_start=\"$cutstart\" AND cut_end=\"$cutend\"";
  $result11=$dbh2->query($res11query);

  // log
	$logdetails="Updated employees payslip for id:$emppayrollid with employeeid:$employeeid, cutoff:$cutstart-to-$cutend, gross:$grosspay, deductions:$deductionstotal, net:$net_pay";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);

  $result = $dbh2->query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'");

	// redirect
	header("Location: $prefn?loginid=$loginid&cutstart0=$cutstart&cutend0=$cutend");
	exit;
  // echo "<p>vartest id:$emppayrollid,prefn:$prefn<br>r11q:$res11query<br>r16q:$res16query</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>