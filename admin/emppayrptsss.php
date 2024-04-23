<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$submitsw = $_GET['submitsw'];

$yearmonthsel = $_POST['yearmonthsel'];
if($yearmonthsel != '') {
	// set cutoff coverage
	$arryearmonthsel = split("-", $yearmonthsel);
	$arryearsel = $arryearmonthsel[0];
	$arrmonthsel = $arryearmonthsel[1];
	$arrdaysel = $arryearmonthsel[2];
	$monthcut1tmp = strtotime(date("Y-m-d", strtotime($yearmonthsel)) . "-1 months");
	$monthcut1tmp2 = date("Y-m", $monthcut1tmp);
	$monthcut1 = $monthcut1tmp2 . "-" . "16";
	$monthcut2 = $arryearsel . "-" . $arrmonthsel . "-" . "15";
	// echo "<p>vartest: yearmonthsel:$yearmonthsel | monthcut1:$monthcut1 | monthcut2:$monthcut2</p>";
}

$found = 0;

$secsubtotarr = array();

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");
?>

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script language="JavaScript" src="ts_picker.js"></script>
<script type="text/javascript">
	$(function() {
		$("#exportToExcel").click(function() {
			var data='<table>' + $("#ReportTable").html().replace(/<a\/?[^>]+>/gi,'')+'</table>';
			$('body').prepend("<form method='post' action='exportexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"'></form>");
			$('#ReportTableData').submit().remove();
	});
});
</script>

<?php
// start contents here

    echo "<table class=\"fin2\" border=\"1\">";
    echo "<tr>";
    echo "<form action=\"emppayrptsss.php?loginid=$loginid&submitsw=1\" method=\"post\" name=\"emppayrptbasic\">";
    echo "<td colspan=\"2\" nowrap>";

		echo "<select name=\"yearmonthsel\">";
		if($submitsw == '') {
			echo "<option value=''>year-month</option>";
		}
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT DISTINCT cut_start, cut_end FROM tblemppayroll WHERE DATE_FORMAT(cut_start, \"%d\")>=\"01\" AND DATE_FORMAT(cut_end, \"%d\")<=\"15\" ORDER BY cut_start DESC", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$cut_start11 = $myrow11[0];
			$cut_end11 = $myrow11[1];
			if($cut_start11 == $yearmonthsel) { $cutstartsel="selected"; } else { $cutstartsel=""; }
			echo "<option value=\"$cut_start11\" $cutstartsel>".date("Y-M", strtotime($cut_start11))."</option>";
			}
		}
		echo "</select>";

    echo "<input type=\"submit\" value=\"Submit\" id=\"myOrder1\"></td></form>";
    echo "</tr>";


	echo "<tr><td colspan=\"2\">";

	// if(($datefrom <= $dateto) && (($datefrom != '') && ($dateto != ''))) {

		if(($yearmonthsel != '') && ($submitsw == 1)) {

		echo "<table id=\"ReportTable\" class=\"fin2\">";
		echo "<tr><th colspan=\"2\" align=\"left\">Employees Payroll - SSS&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		// echo "<tr><th colspan=\"2\" align=\"left\">Employees Payroll - SSS</th></tr>";
		// echo "<tr><th colspan=\"2\" align=\"left\">Duration from ".date("Y-M-d", strtotime($datefrom))." to ".date("Y-M-d", strtotime($dateto))."</th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Philkoei International Inc.</th></tr>";
		echo "<tr><td colspan=\"2\">Note: SSS Schedule of Contribution Table reference dated 2014. Archived schedules may have different output values.</td></tr>";
    echo "<tr><td colspan=\"2\">";
		echo "<table width=\"100%\" class=\"fin\" border=\"1\">";
		echo "<tr><th>Count</th><th>EmpName</th><th>EmpID</th>";

		// query cutoffs for label
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("SELECT DISTINCT cut_start, cut_end FROM tblemppayroll WHERE cut_start >= '$monthcut1' AND cut_end <= '$monthcut2' ORDER BY cut_start ASC", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
			$cut_start12 = $myrow12[0];
			$cut_end12 = $myrow12[1];
			$ctr12 = $ctr12 + 1;
			$arrcutstart = split("-", $cut_start12);
			$arrcutstartyyyy = $arrcutstart[0];
			$arrcutstartmm = $arrcutstart[1];
			$arrcutstartdd = $arrcutstart[2];
			$arrcutend = split("-", $cut_end12);
			$arrcutendyyyy = $arrcutend[0];
			$arrcutendmm = $arrcutend[1];
			$arrcutenddd = $arrcutend[2];
			echo "<th>" . date("Y", strtotime($cut_start12)) . "<br>" . date("M-d", strtotime($cut_start12));
			echo "-to-";
			if(($arrcutendyyyy == $arrcutstartyyyy) && ($arrcutendmm == $arrcutstartmm)) {
				echo "$arrcutenddd";
			} else {
  			echo "".date("Y", strtotime($cut_end12))."<br>".date("M-d", strtotime($cut_end12));
			}
			echo "</th>";
			}
		}
		echo "<th>Total<br>".date("F", strtotime($cut_end12))."</th>";
		echo "<th>EE<br>Ded<br>".date("M-d", strtotime($cut_start12))."-to-".date("d", strtotime($cut_end12))."</th>";
		echo "<th>EE<br>cont.<br>SSS</th>";
		echo "<th>Short<br><font color=\"red\">(Over)</font><br>Ded<br>SSS</th>";
		echo "<th>ERR<br>Share<br>SSS</th>";
		echo "<th>ERR<br>Share<br>ECC</th>";
		echo "<th>ERR<br>Total<br>Share</th>";
		echo "<th>TOTAL<br>CONT.<br>(EE+ERR)</th>";
		echo "<th>TOTAL<br>SSS</th></tr>";

		// start query of empid joined with names
		$result14=""; $found14=0; $ctr14=0;
		$result14 = mysql_query("SELECT DISTINCT tblemppayroll.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemppayroll INNER JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid WHERE tblcontact.contact_type=\"personnel\" AND tblemppayroll.cut_start>=\"$monthcut1\" AND tblemppayroll.cut_end<=\"$monthcut2\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first, tblemppayroll.cut_start ASC", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14 = 1;
			$employeeid14 = $myrow14[0];
			$name_last14 = $myrow14[1];
			$name_first14 = $myrow14[2];
			$name_middle14 = $myrow14[3];
			$ctr14 = $ctr14 + 1;
			echo "<tr><td align=\"center\">$ctr14</td><th>$name_last14, $name_first14 $name_middle14[0]</th><td align=\"center\">$employeeid14</td>";

			// query cutoff coverage
			$result15=""; $found15=0; $ctr15=0;
			$result15 = mysql_query("SELECT DISTINCT cut_start, cut_end FROM tblemppayroll WHERE cut_start>=\"$monthcut1\" AND cut_end<=\"$monthcut2\" ORDER BY cut_start ASC", $dbh);
			if($result15 != "") {
				while($myrow15 = mysql_fetch_row($result15)) {
				$found15=1;
				$cut_start15 = $myrow15[0];
				$cut_end15 = $myrow15[1];

				$result16=""; $found16=0; $ctr16=0;
				$result16 = mysql_query("SELECT emppayrollid, emp_salary, deduction, phil_ded, tax, emp_over_duration, net_pay, emp_date_wrk, emp_sick, emp_vacation, cut_start, cut_end, regholiday, speholiday, emp_late_duration, otsunday, regholidayamt, speholidayamt, otsundayamt, overamt, nightdiffminutes, nightdiffamt, totaltardy, otherincome, otherincometaxable, otherdeduction, emp_dep, pagibig, vlused, slused, philemp, ss, ec, bracket, absentamt FROM tblemppayroll WHERE employeeid=\"$employeeid14\" AND cut_start=\"$cut_start15\" AND cut_end=\"$cut_end15\" LIMIT 1", $dbh);
				if($result16 != "") {
					while($myrow16 = mysql_fetch_row($result16)) {
					$found16 = 1;
					$emppayrollid16 = $myrow16[0];
					$emp_salary16 = $myrow16[1];
					$deduction16 = $myrow16[2];
					$phil_ded16 = $myrow16[3];
					$tax16 = $myrow16[4];
					$emp_over_duration16 = $myrow16[5];
					$net_pay16 = $myrow16[6];
					$emp_date_wrk16 = $myrow16[7];
					$emp_sick16 = $myrow16[8];
					$emp_vacation16 = $myrow16[9];
					$cut_start16 = $myrow16[10];
					$cut_end16 = $myrow16[11];
					$regholiday16 = $myrow16[12];
					$speholiday16 = $myrow16[13];
					$emp_late_duration16 = $myrow16[14];
					$otsunday16 = $myrow16[15];
					$regholidayamt16 = $myrow16[16];
					$speholidayamt16 = $myrow16[17];
					$otsundayamt16 = $myrow16[18];
					$overamt16 = $myrow16[19];
					$nightdiffminutes16 = $myrow16[20];
					$nightdiffamt16 = $myrow16[21];
					$totaltardy16 = $myrow16[22];
					$otherincome16 = $myrow16[23];
					$otherincometaxable16 = $myrow16[24];
					$otherdeduction16 = $myrow16[25];
					$emp_dep16 = $myrow16[26];
					$pagibig16 = $myrow16[27];
					$vlused16 = $myrow16[28];
					$slused16 = $myrow16[29];
					$philemp16 = $myrow16[30];
					$ss16 = $myrow16[31];
					$ec16 = $myrow16[32];
					$bracket16 = $myrow16[33];
					$absentamt16 = $myrow16[34];
					
					}
				}

				if($found16 == 1) {

				$payrate = $emp_salary16 / 2;
				$totallateabsent = $totaltardy16 + $absentamt16;
				$netbasicpay = $payrate - $totallateabsent;
				$totalovertime = $nightdiffamt16 + $overamt16 + $otsundayamt16 + $speholidayamt16 + $regholidayamt16;
				$grosspay = $netbasicpay + $totalovertime + $otherincometaxable16 + $otherincome16;

				$grosspaytot = $grosspaytot + $grosspay;

					echo "<td align=\"right\">".number_format($grosspay, 2)."</td>";

				} else {

					echo "<td></td>";

				}

				$grosspay=0; $payrate=0; $totallateabsent=0; $netbasicpay=0;

				}
			}

			echo "<th>".number_format($grosspaytot, 2)."</th>";

			echo "<td align=\"right\">".number_format($deduction16, 2)."</td>";

			$result17=""; $found17=0; $ctr17=0;
			$result17 = mysql_query("SELECT ssscontributionid, compfrom, compto, salarycredit, sser, ssee, sstotal, ecer, tcer, tcee, tctotal, totalcontribution FROM tblssscontribution WHERE compfrom<=$grosspaytot AND compto>=$grosspaytot", $dbh);
			if($result17 != "") {
				while($myrow17 = mysql_fetch_row($result17)) {
				$found17 = 1;
				$ssscontributionid17 = $myrow17[0];
				$compfrom17 = $myrow17[1];
				$compto17 = $myrow17[2];
				$salarycredit17 = $myrow17[3];
				$sser17 = $myrow17[4];
				$ssee17 = $myrow17[5];
				$sstotal17 = $myrow17[6];
				$ecer17 = $myrow17[7];
				$tcer17 = $myrow17[8];
				$tcee17 = $myrow17[9];
				$tctotal17 = $myrow17[10];
				$totalcontribution17 = $myrow17[11];
				
				}
			}
			echo "<td align=\"right\">".number_format($ssee17, 2)."</td>";

			$shortded = $ssee17 - $deduction16;
			if($shortded != 0 || $shortded != "") {
				if($shortded < 0) {
				echo "<td align=\"right\"><font color=\"red\">".number_format($shortded, 2)."</font></td>";
				} else {
				echo "<td align=\"right\">".number_format($shortded, 2)."</td>";
				}
			} else {
			echo "<td></td>";
			}

			echo "<td align=\"right\">".number_format($sser17, 2)."</td>";
			echo "<td align=\"right\">$ecer17</td>";
			echo "<td align=\"right\">".number_format($tcer17, 2)."</td>";
			echo "<th align=\"right\">".number_format($tctotal17, 2)."</th>";
			echo "<th align=\"right\">".number_format($totalcontribution17, 2)."</th>";
			echo "</tr>";
			$empidtmp = $employeeid14;
			$grosspaytot=0; $shortded=0;
			}
		}

		echo "</table>";
    echo "</td></tr>";

    echo "</table>";

		}

	// }

	echo "</td></tr>";
	echo "</table>";

    echo "<p><a href=\"cutoff.php?loginid=$loginid\">Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
