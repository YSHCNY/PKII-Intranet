<?php 
include("db1.php");
// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$emp_salary = $_POST['emp_salary'];
$deduction = $_POST['deduction'];
$net_pay = $_POST['net_pay'];
$cut_start = $_POST['cut_start'];
$cut_end = $_POST['cut_end'];
$phil_ded = $_POST['phil_ded'];
$tax = $_POST['tax'];
$emp_over_duration = $_POST['emp_over_duration'];
$emp_date_wrk = $_POST['emp_date_wrk'];
$emp_sick = $_POST['emp_sick'];
$emp_vacation = $_POST['emp_vacation'];
$regholiday = $_POST['regholiday'];
$speholiday = $_POST['speholiday'];
$emp_late_duration = $_POST['emp_late_duration'];
$otsunday = $_POST['otsunday'];
$regholidayamt = $_POST['regholidayamt'];
$speholidayamt = $_POST['speholidayamt'];
$otsundayamt = $_POST['otsundayamt'];
$overamt = $_POST['overamt'];
$nightdiffminutes = $_POST['nightdiffminutes'];
$nightdiffamt = $_POST['nightdiffamt'];
$totaltardy = $_POST['totaltardy'];
$otherincome = $_POST['otherincome'];
$otherincometaxable = $_POST['otherincometaxable'];
$otherdeduction = $_POST['otherdeduction'];
$emp_dep = $_POST['emp_dep'];
$pagibig = $_POST['pagibig'];
$vlused = $_POST['vlused'];
$slused = $_POST['slused'];
$philemp = $_POST['philemp'];
$ss = $_POST['ss'];
$ec = $_POST['ec'];
$bracket = $_POST['bracket'];
$absentamt = $_POST['absentamt'];

$result11=""; $found11=0; $ctr11=0;
$result11 = mysql_query("SELECT emppayrollid, employeeid, cut_start, cut_end FROM tblemppayroll WHERE employeeid=\"$employeeid\" AND cut_start=\"$cut_start\" AND cut_end=\"$cut_end\"", $dbh);
if($result11 != "") {
	while($myrow11 = mysql_fetch_row($result11)) {
	$found11=1;
	$emppayrollid11 = $myrow11[0];
	$employeeid11 = $myrow11[1];
	$cut_start11 = $myrow11[2];
	$cut_end11 = $myrow11[3];
	}
}

if($found11 != 1) {
	$result12 = mysql_query("INSERT INTO tblemppayroll (employeeid, emp_salary, deduction, net_pay, cut_start, cut_end, phil_ded, tax, emp_over_duration, emp_date_wrk, emp_sick, emp_vacation, regholiday, speholiday, emp_late_duration, otsunday, regholidayamt, speholidayamt, otsundayamt, overamt, nightdiffminutes, nightdiffamt, totaltardy, otherincome, otherincometaxable, otherdeduction, emp_dep, pagibig, vlused, slused, philemp, ss, ec, bracket, absentamt) VALUES ('$employeeid', $emp_salary, $deduction, $net_pay, '$cut_start', '$cut_end', $phil_ded, $tax, $emp_over_duration, $emp_date_wrk, '$emp_sick', '$emp_vacation', $regholiday, $speholiday, $emp_late_duration, $otsunday, $regholidayamt, $speholidayamt, $otsundayamt, $overamt, $nightdiffminutes, $nightdiffamt, $totaltardy, $otherincome, $otherincometaxable, $otherdeduction, '$emp_dep', $pagibig, $vlused, $slused, $philemp, $ss, $ec, $bracket, $absentamt)", $dbh);
} else if($found11 == 1) {
	$result14 = mysql_query("UPDATE tblemppayroll SET employeeid='$employeeid', emp_salary=$emp_salary, deduction=$deduction, net_pay=$net_pay, cut_start='$cut_start', cut_end='$cut_end', phil_ded=$phil_ded, tax=$tax, emp_over_duration=$emp_over_duration, emp_date_wrk=$emp_date_wrk, emp_sick='$emp_sick', emp_vacation='$emp_vacation', regholiday=$regholiday, speholiday=$speholiday, emp_late_duration=$emp_late_duration, otsunday=$otsunday, regholidayamt=$regholidayamt, speholidayamt=$speholidayamt, otsundayamt=$otsundayamt, overamt=$overamt, nightdiffminutes=$nightdiffminutes, nightdiffamt=$nightdiffamt, totaltardy=$totaltardy, otherincome=$otherincome, otherincometaxable=$otherincometaxable, otherdeduction=$otherdeduction, emp_dep='$emp_dep', pagibig=$pagibig, vlused=$vlused, slused=$slused, philemp=$philemp, ss=$ss, ec=$ec, bracket=$bracket, absentamt=$absentamt WHERE emppayrollid=$emppayrollid11 AND employeeid=\"$employeeid11\" AND cut_start=\"$cut_start11\" AND cut_end=\"$cut_end11\"", $dbh);
}

$id = mysql_insert_id();

//echo "$id";
echo "$employeeid - $cut_start - $cut_end";

mysql_close($dbh);
?> 
