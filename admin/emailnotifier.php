<?php 

require_once("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'' ;
$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';
$cutoff = (isset($_POST['cutoff'])) ? $_POST['cutoff'] :'';
$checkall = (isset($_POST['checkall'])) ? $_POST['checkall'] :'';

$cutoffarray = explode(" ", $cutoff);
$start = $cutoffarray[0];
$end = $cutoffarray[1];

$found = 0;

if($loginid != "") {
     include("logincheck.php");
} // if($loginid != "")

if($found == 1) {
?>

<html>
<STYLE TYPE="text/css">
<!--
p{font-family: Helvetica; font-size: 10pt;}
B{font-family: Helvetica; font-size: 10pt;}
TD{font-family: Helvetica; font-size: 10pt;}

input {
font-size: 10px;
}

.page_break {
page-break-inside: avoid;
}
table.fin2 { background:#D3E4E5;
 border:1px solid gray;
 border-collapse:collapse;
 color:#fff;
 font:normal 12px verdana, arial, helvetica, sans-serif;
}
table.fin2 td, table.fin2 th { color:#363636;
}
table.fin2 thead th, table.fin2 tfoot th { background:#5C443A;
 color:#FFFFFF;
 text-align:left;
 text-transform:uppercase;
}
table.fin2 tbody td a { color:#363636;
 text-decoration:none;
}
/* table.fin tbody td a:visited { color:gray;
 text-decoration:line-through;
} */
table.fin2 tbody td a:hover { text-decoration:underline;
}
table.fin2 tbody th a { color:#363636;
 font-weight:normal;
 text-decoration:none;
}
table.fin2 tbody th a:hover { color:#363636;
}
table.fin2 tbody td+td+td+td a { background-image:url('bullet_blue.png');
 background-position:left center;
 background-repeat:no-repeat;
 color:#03476F;
}
table.fin2 tbody td+td+td+td a:visited { background-image:url('bullet_white.png');
 background-position:left center;
 background-repeat:no-repeat;
}
table.fin2 tbody th, table.fin2 tbody td { vertical-align:top; }
table.fin2 tfoot td { background:#5C443A;
 color:#FFFFFF;
}
</STYLE>

<?php
	echo "<form action=\"sendmail.php?loginid=$loginid&start=$start&end=$end\" method=\"POST\" name=\"myform\">";

	echo "<table class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	// echo "<tr><th>empID</th><th>empName</th><th>acct_num</th><th>net_pay</th><th>count</th><th>email</th><th>pay_rate</th><th>total_late_absent</th><th>net_basic_pay</th><th>wtax</th><th>total_overtime</th><th>gross_pay</th><th>total_deductions</th></tr>";
	echo "<tr><th>count</th><th>empID</th><th>empName</th><th>acct_num</th><th>email</th><th>pay_rate</th><th>total_late_absent</th><th>net_basic_pay</th><th>total_overtime</th><th>gross_pay</th><th>wtax</th><th>total_deductions</th><th>net_pay</th></tr>";
    
	$resquery="SELECT employeeid, name_first, name_middle, name_last, email1 FROM tblcontact WHERE email1 != '' AND employeeid !='' ORDER BY employeeid";
	// $resquery="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_middle, tblcontact.name_last, tblcontact.email1, acct_num, acct_type FROM tblcontact JOIN tblbankacct ON tblcontact.employeeid=tblbankacct.employeeid WHERE tblcontact.email1 != '' AND tblcontact.employeeid !='' AND tblbankacct.payrolldflt=1 ORDER BY tblcontact.employeeid";
	$result="";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
		$employeeid = $myrow['employeeid'];
    $name_first = $myrow['name_first'];
		$name_middle = $myrow['name_middle'];
    $name_last = $myrow['name_last'];
    $email = $myrow['email1'];

		$res1query="SELECT acct_num, acct_type FROM tblbankacct WHERE employeeid=\"$employeeid\" AND payrolldflt=1";
		$result1=$dbh2->query($res1query);
		if($result1->num_rows>0) {
			while($myrow1=$result1->fetch_assoc()) {
		$acct_num = $myrow1['acct_num'];
		$acct_type = $myrow1['acct_type'];			
			} // while
		} // if
 
    $include2 = 0;

    $res2query="SELECT emppayrollid, employeeid, emp_salary, deduction, phil_ded, tax, emp_over_duration, net_pay, emp_date_wrk, emp_sick, emp_vacation, cut_start, cut_end, regholiday, speholiday, emp_late_duration, otsunday, regholidayamt, speholidayamt, otsundayamt, overamt, nightdiffminutes, nightdiffamt, totaltardy, otherincome, otherincometaxable, otherdeduction, emp_dep, pagibig, vlused, slused, philemp, ss, ec, bracket, absentamt FROM tblemppayroll WHERE employeeid=\"$employeeid\" AND cut_start=\"$start\" AND cut_end=\"$end\"";
		$result2=""; $found2=0;
		$result2=$dbh2->query($res2query);
		if($result2->num_rows>0) {
			while($myrow2=$result2->fetch_assoc()) {
			$found2=1;
			$include2 = 1;
			$count2 = $count2 + 1;
			$emppayrollid2 = $myrow2['emppayrollid'];
			$employeeid2 = $myrow2['employeeid'];
			$emp_salary2 = $myrow2['emp_salary'];
			$deduction2 = $myrow2['deduction'];
			$phil_ded2 = $myrow2['phil_ded'];
			$tax2 = $myrow2['tax'];
			$emp_over_duration2 = $myrow2['emp_over_duration'];
			$net_pay2 = $myrow2['net_pay'];
			$emp_date_wrk2 = $myrow2['emp_date_wrk'];
			$emp_sick2 = $myrow2['emp_sick'];
			$emp_vacation2 = $myrow2['emp_vacation'];
			$cut_start2 = $myrow2['cut_start'];
			$cut_end2 = $myrow2['cut_end'];
			$regholiday2 = $myrow2['regholiday'];
			$speholiday2 = $myrow2['speholiday'];
			$emp_late_duration2 = $myrow2['emp_late_duration'];
			$otsunday2 = $myrow2['otsunday'];
			$regholidayamt2 = $myrow2['regholidayamt'];
			$speholidayamt2 = $myrow2['speholidayamt'];
			$otsundayamt2 = $myrow2['otsundayamt'];
			$overamt2 = $myrow2['overamt'];
			$nightdiffminutes2 = $myrow2['nightdiffminutes'];
			$nightdiffamt2 = $myrow2['nightdiffamt'];
			$totaltardy2 = $myrow2['totaltardy'];
			$otherincome2 = $myrow2['otherincome'];
			$otherincometaxable2 = $myrow2['otherincometaxable'];
			$otherdeduction2 = $myrow2['otherdeduction'];
			$emp_dep2 = $myrow2['emp_dep'];
			$pagibig2 = $myrow2['pagibig'];
			$vlused2 = $myrow2['vlused'];
			$slused2 = $myrow2['slused'];
			$philemp2 = $myrow2['philemp'];
			$ss2 = $myrow2['ss'];
			$ec2 = $myrow2['ec'];
			$bracket2 = $myrow2['bracket'];
			$absentamt2 = $myrow2['absentamt'];

			$payrate = $emp_salary2 / 2;
			$totallateabsent = $totaltardy2 + $absentamt2;
			$netbasicpay = $payrate - $totallateabsent;
			$totalovertime = $nightdiffamt2 + $overamt2 + $otsundayamt2 + $speholidayamt2 + $regholidayamt2;
			$grosspay = $netbasicpay + $totalovertime + $otherincometaxable2 + $otherincome2;
			$deductionstotal = $tax2 + $deduction2 + $philemp2 + $pagibig2 + $otherdeduction2;
			} // while($myrow2=$result2->fetch_assoc())
		} // if($result2->num_rows>0)
		if($include2 == 1) {
			if($checkall == "yes") {
				echo "<tr><td>$count2</td><td><input type=\"checkbox\" name=\"employeeid[]\" value=\"$employeeid\" checked>$employeeid</td>";
				echo "<td>$name_first $name_middle[0] $name_last</td><td>$acct_num</td><td>$email</td><td align=\"right\">$payrate</td><td align=\"right\">$totallateabsent</td><td align=\"right\">$netbasicpay</td><td align=\"right\">$totalovertime</td><td align=\"right\">$grosspay</td><td align=\"right\">$tax2</td><td align=\"right\">$deductionstotal</td><td align=\"right\">$net_pay2</td></tr>";
				$gtotpayrateyes = $gtotpayrateyes + $payrate;
				$gtottotallateabsentyes = $gtottotallateabsentyes + $totallateabsent;
				$gtotnetbasicpayyes = $gtotnetbasicpayyes + $netbasicpay;
				$gtottotalovertimeyes = $gtottotalovertimeyes + $totalovertime;
				$gtotgrosspayyes = $gtotgrosspayyes + $grosspay;
				$gtottax2yes = $gtottax2yes + $tax2;
				$gtotdeductionstotalyes = $gtotdeductionstotalyes + $deductionstotal;
				$gtotnet_pay2yes = $gtotnet_pay2yes + $net_pay2;
			} else { // if($checkall == "yes")
				echo "<tr><td>$count2</td><td><input type=\"checkbox\" name=\"employeeid[]\" value=\"$employeeid\">$employeeid</td>";
				echo "<td>$name_first $name_middle[0] $name_last</td><td>$acct_num</td><td>$email</td><td align=\"right\">$payrate</td><td align=\"right\">$totallateabsent</td><td align=\"right\">$netbasicpay</td><td align=\"right\">$totalovertime</td><td align=\"right\">$grosspay</td><td align=\"right\">$tax2</td><td align=\"right\">$deductionstotal</td><td align=\"right\">$net_pay2</td></tr>";
				$gtotpayrate = $gtotpayrate + $payrate;
				$gtottotallateabsent = $gtottotallateabsent + $totallateabsent;
				$gtotnetbasicpay = $gtotnetbasicpay + $netbasicpay;
				$gtottotalovertime = $gtottotalovertime + $totalovertime;
				$gtotgrosspay = $gtotgrosspay + $grosspay;
				$gtottax2 = $gtottax2 + $tax2;
				$gtotdeductionstotal = $gtotdeductionstotal + $deductionstotal;
				$gtotnet_pay2 = $gtotnet_pay2 + $net_pay2;
			} // if($checkall == "yes")
				// 1) net basic pay,  2) total overtime, 3) gross pay, 4) wtax, 5) total deductions at 6) net pay
		} // if($include2 == 1)
		$acct_num=''; $acct_type='';
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)
	// display grand total
    if($checkall=="yes") {
	echo "<tr><th colspan='5'>Grand Total</th><th>".number_format($gtotpayrateyes, 2)."</th><th>".number_format($gtottotallateabsentyes, 2)."</th><th>".number_format($gtotnetbasicpayyes, 2)."</th><th>".number_format($gtottotalovertimeyes, 2)."</th><th>".number_format($gtotgrosspayyes, 2)."</th><th>".number_format($gtottax2yes, 2)."</th><th>".number_format($gtotdeductionstotalyes, 2)."</th><th>".number_format($gtotnet_pay2yes, 2)."</th></tr>";		
	} else {
	echo "<tr><th colspan='5'>Grand Total</th><th>".number_format($gtotpayrate, 2)."</th><th>".number_format($gtottotallateabsent, 2)."</th><th>".number_format($gtotnetbasicpay, 2)."</th><th>".number_format($gtottotalovertime, 2)."</th><th>".number_format($gtotgrosspay, 2)."</th><th>".number_format($gtottax2, 2)."</th><th>".number_format($gtotdeductionstotal, 2)."</th><th>".number_format($gtotnet_pay2, 2)."</th></tr>";
	} // if-else

	echo "</table>";

	echo "<hr>";

	echo "<font size=2>The following have no email addresses. Please provide hard-copies of the pay advisory.</font><br><br>";

	echo "<table class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><th>empID</th><th>empName</th><th>pay_rate</th><th>total_late_absent</th><th>net_basic_pay</th><th>total_overtime</th><th>gross_pay</th><th>total_deductions</th><th>net_pay</th></tr>";

	$res1query = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.email1 FROM tblcontact WHERE tblcontact.email1 = '' AND tblcontact.employeeid !=''";
	$result1=""; $found1=0;
	$result1=$dbh2->query($res1query);
	if($result1->num_rows>0) {
		while($myrow1=$result1->fetch_assoc()) {
		$found1=1;
		$employeeid = $myrow1['employeeid'];
		$name_first = $myrow1['name_first'];
		$name_last = $myrow1['name_last'];
		$email = $myrow1['email1'];

		$include = 0;

		$res2query = "SELECT emppayrollid, employeeid, emp_salary, deduction, phil_ded, tax, emp_over_duration, net_pay, emp_date_wrk, emp_sick, emp_vacation, cut_start, cut_end, regholiday, speholiday, emp_late_duration, otsunday, regholidayamt, speholidayamt, otsundayamt, overamt, nightdiffminutes, nightdiffamt, totaltardy, otherincome, otherincometaxable, otherdeduction, emp_dep, pagibig, vlused, slused, philemp, ss, ec, bracket, absentamt FROM tblemppayroll WHERE employeeid=\"$employeeid\" AND cut_start=\"$start\" AND cut_end=\"$end\"";
		$result2=""; $found2=0;
		$result2=$dbh2->query($res2query);
		if($result2->num_rows>0) {
			while($myrow2=$result2->fetch_assoc()) {
			$found2=1;
			$include = 1;
			$emppayrollid2 = $myrow2['emppayrollid'];
			$employeeid2 = $myrow2['employeeid'];
			$emp_salary2 = $myrow2['emp_salary'];
			$deduction2 = $myrow2['deduction'];
			$phil_ded2 = $myrow2['phil_ded'];
			$tax2 = $myrow2['tax'];
			$emp_over_duration2 = $myrow2['emp_over_duration'];
			$net_pay2 = $myrow2['net_pay'];
			$emp_date_wrk2 = $myrow2['emp_date_wrk'];
			$emp_sick2 = $myrow2['emp_sick'];
			$emp_vacation2 = $myrow2['emp_vacation'];
			$cut_start2 = $myrow2['cut_start'];
			$cut_end2 = $myrow2['cut_end'];
			$regholiday2 = $myrow2['regholiday'];
			$speholiday2 = $myrow2['speholiday'];
			$emp_late_duration2 = $myrow2['emp_late_duration'];
			$otsunday2 = $myrow2['otsunday'];
			$regholidayamt2 = $myrow2['regholidayamt'];
			$speholidayamt2 = $myrow2['speholidayamt'];
			$otsundayamt2 = $myrow2['otsundayamt'];
			$overamt2 = $myrow2['overamt'];
			$nightdiffminutes2 = $myrow2['nightdiffminutes'];
			$nightdiffamt2 = $myrow2['nightdiffamt'];
			$totaltardy2 = $myrow2['totaltardy'];
			$otherincome2 = $myrow2['otherincome'];
			$otherincometaxable2 = $myrow2['otherincometaxable'];
			$otherdeduction2 = $myrow2['otherdeduction'];
			$emp_dep2 = $myrow2['emp_dep'];
			$pagibig2 = $myrow2['pagibig'];
			$vlused2 = $myrow2['vlused'];
			$slused2 = $myrow2['slused'];
			$philemp2 = $myrow2['philemp'];
			$ss2 = $myrow2['ss'];
			$ec2 = $myrow2['ec'];
			$bracket2 = $myrow2['bracket'];
			$absentamt2 = $myrow2['absentamt'];

			$payrate = $emp_salary2 / 2;
			$totallateabsent = $totaltardy2 + $absentamt2;
			$netbasicpay = $payrate - $totallateabsent;
			$totalovertime = $nightdiffamt2 + $overamt2 + $otsundayamt2 + $speholidayamt2 + $regholidayamt2;
			$grosspay = $netbasicpay + $totalovertime + $otherincometaxable2 + $otherincome2;
			$deductionstotal = $tax2 + $deduction2 + $philemp2 + $pagibig2 + $otherdeduction2;
			} // while($myrow2=$result2->fetch_assoc())
		} // if($result2->num_rows>0)

		if($include == 1) {
			echo "<tr><td>$employeeid</td>";
			echo "<td>$name_first $name_middle[0] $name_last</td><td align=\"right\">$payrate</td><td align=\"right\">$totallateabsent</td><td align=\"right\">$netbasicpay</td><td align=\"right\">$totalovertime</td><td align=\"right\">$grosspay</td><td align=\"right\">$deductionstotal</td><td align=\"right\">$net_pay2</td></tr>";
		} // if($include == 1)
		} // while($myrow1=$result1->fetch_assoc())
	} // if($result1->num_rows>0)

	echo "</table>";

	echo "<hr>";
   

	echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
  echo "<tr><td bgcolor=blue colspan=2><font color=white size=2><b>Email Template</b></font></td></tr>";

  $result = mysql_query("SELECT * FROM tblemailnotifier WHERE notifierid=0", $dbh); 
  while ($myrow = mysql_fetch_row($result)) {
		$from = $myrow[1];
    $subject = $myrow[2];
    $header = $myrow[3];
    $footer = $myrow[4];
    $notes = $myrow[5];
	}

	echo "<tr><td><font size=2>From</font></td><td><input name=from size=50 value=$from></td></tr>";
  echo "<tr><td><font size=2>Subject</font></td><td><input name=subject size=50 value=\"$subject\"></td></tr>";
  echo "<tr><td valign=top><font size=2>Header</font></td><td><textarea name=header rows=3 cols=50>$header</textarea></td></tr>";
  echo "<tr><td valign=top><font size=2>Salary Details</font></td><td><textarea name=salary rows=5 cols=50>(Pls. check attached email body details}</textarea></td></tr>";
  echo "<tr><td valign=top><font size=2>Footer</font></td><td><textarea name=footer rows=5 cols=50>$footer</textarea></td></tr>";
  echo "<tr><td valign=top><font size=2>Notes</font></td><td><textarea name=notes rows=5 cols=50>$notes</textarea></td></tr>";
  echo "<tr><td>&nbsp;</td><td><input type=submit value=Send></td></tr>";
  echo "</table>";

	echo "</form>";
?></html><?php

//     echo "<a href=admlogin.php?loginid=$loginid>Back</a><br>";

} else { // 
     include ("logindeny.php");
} // if($found == 1) 

$dbh2->close();
?> 