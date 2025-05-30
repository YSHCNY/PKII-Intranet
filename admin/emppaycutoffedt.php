<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$cutstart0 = (isset($_GET['cutstart0'])) ? $_GET['cutstart0'] :'';
$cutend0 = (isset($_GET['cutend0'])) ? $_GET['cutend0'] :'';
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';
if($cutstart0!='') { $cutstart=$cutstart0; }
if($cutend0!='') { $cutend=$cutend0; }
if($cutstart0!='' && $cutend0!='') {
	$cutoff = "$cutstart0:$cutend0";
} // if

$submit = (isset($_POST['submit'])) ? $_POST['submit'] :'';
if($submit==1) {
$cutoff = (isset($_POST['cutoff'])) ? $_POST['cutoff'] :'';
$cutoffarr = split(':', $cutoff);
$cutstart = $cutoffarr[0];
$cutend = $cutoffarr[1];	
} // if

$found = 0;

$secsubtotarr = array();

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>

<?php
// start contents here

  echo "<p><font size=1>Modules >> Employees' payslip email notifier >> Custom cutoff >> Edit</font></p>";

//
// dropdown cutoff periods
//
?>
    <div class="table">
	<table class="table">
	<form action="emppaycutoffedt.php?loginid=<?php echo $loginid; ?>" method="POST" name="emppaycutoffaddremove">
    <thead><tr><th colspan="3">Choose cutoff period</th>
	</tr></thead>
	<tbody>
<?php
    echo "<tr><td colspan='3'>";
    echo "<div class='form-group'><select name='cutoff'>";
	// query tblemppayroll
	$res11qry="";
	$res11qry="SELECT DISTINCT cut_start, cut_end FROM tblemppayroll ORDER BY cut_start DESC";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$cutstart11 = $myrow11['cut_start'];
			$cutend11 = $myrow11['cut_end'];
			$cutfin11 = "$cutstart11:$cutend11";
			if($cutfin11==$cutoff) {
				$cutfinsel="selected";
			} else {
				$cutfinsel="";
			} // if-else
    echo "<option value='$cutfin11' $cutfinsel>$cutstart11-to-$cutend11</option>";
		} // while
	} // if
	echo "</select></div>";
	echo "<button type='submit' class='btn btn-primary' name='submit' value=1>Submit</button>";
	echo "</td></tr>";
	// var_dump($res11qry);
?>
</form>
	</tbody>
	</table>
	</div>
<?php
	if($submit==1) {
//
// display result
//
  echo "<table class=\"table\">";

  if($cutstart!='' && $cutend!='') {
    // display header
		echo "<tr><th colspan=\"2\" align=\"left\">Philkoei International Inc.</th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Employees Payroll Summary</th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">From ".date("Y-M-d", strtotime($cutstart))." To ".date("Y-M-d", strtotime($cutend))."&nbsp;&nbsp;";
    echo "</th></tr>";

    // list content
    echo "<tr><td colspan=\"2\">";
    echo "<table class=\"table table-bordered table-striped\">";
    // display header of contents
	echo "<thead class='thead-dark'>";
		echo "<tr><th>Count</th><th>Employee No.</th><th>Name</th>";
		echo "<th>Proj</th>";
		echo "<th>Emp_Salary (1/2mo.)</th><th colspan=\"2\">Total Late/Absent</th><th>Net Basic Pay</th><th colspan=\"5\">Emp Overtime<br>nightdiffamt + overamt + otsundayamt + speholidayamt + regholidayamt</th><th>Taxable Income</th><th>Other Income<br>Non-Taxable</th><th>Gross Pay</th><th>Withholding Tax</th><th>SSS Deduction</th><th>Philhealth Deduction</th><th>Pag-IBIG Deduction</th><th>Other Deduction</th><th>Total Deductions</th><th>Net Pay</th><th>Action</th></tr>";
	echo "</thead>";

	echo "<tbody>";
    // query cutoff and display contents
		$res12query = "SELECT tblemppayroll.emppayrollid, tblemppayroll.employeeid, tblemppayroll.emp_salary, tblemppayroll.deduction, tblemppayroll.phil_ded, tblemppayroll.tax, tblemppayroll.emp_over_duration, tblemppayroll.net_pay, tblemppayroll.emp_date_wrk, tblemppayroll.cut_start, tblemppayroll.cut_end, tblemppayroll.regholiday, tblemppayroll.speholiday, tblemppayroll.emp_late_duration, tblemppayroll.otsunday, tblemppayroll.regholidayamt, tblemppayroll.speholidayamt, tblemppayroll.otsundayamt, tblemppayroll.overamt, tblemppayroll.nightdiffminutes, tblemppayroll.nightdiffamt, tblemppayroll.totaltardy, tblemppayroll.otherincome, tblemppayroll.otherincometaxable, tblemppayroll.otherdeduction, tblemppayroll.emp_dep, tblemppayroll.pagibig, tblemppayroll.philemp, tblemppayroll.ss, tblemppayroll.ec, tblemppayroll.bracket, tblemppayroll.absentamt, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemppayroll LEFT JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid WHERE tblemppayroll.cut_start=\"$cutstart\" AND tblemppayroll.cut_end=\"$cutend\" AND tblcontact.contact_type=\"personnel\" AND fk_idhrtapaygrp=0 AND fk_idhrtacutoff=0 ORDER BY tblemppayroll.emp_dep ASC, tblcontact.name_last ASC";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12=$ctr12+1;
			$emppayrollid12 = $myrow12['emppayrollid'];
			$employeeid12 = $myrow12['employeeid'];
			$emp_salary12 = $myrow12['emp_salary'];
			$deduction12 = $myrow12['deduction'];
			$phil_ded12 = $myrow12['phil_ded'];
			$tax12 = $myrow12['tax'];
			$emp_over_duration12 = $myrow12['emp_over_duration'];
			$net_pay12 = $myrow12['net_pay'];
			$emp_date_wrk12 = $myrow12['emp_date_wrk'];
			$cut_start12 = $myrow12['cut_start'];
			$cut_end12 = $myrow12['cut_end'];
			$regholiday12 = $myrow12['regholiday'];
			$speholiday12 = $myrow12['speholiday'];
			$emp_late_duration12 = $myrow12['emp_late_duration'];
			$otsunday12 = $myrow12['otsunday'];
			$regholidayamt12 = $myrow12['regholidayamt'];
			$speholidayamt12 = $myrow12['speholidayamt'];
			$otsundayamt12 = $myrow12['otsundayamt'];
			$overamt12 = $myrow12['overamt'];
			$nightdiffminutes12 = $myrow12['nightdiffminutes'];
			$nightdiffamt12 = $myrow12['nightdiffamt'];
			$totaltardy12 = $myrow12['totaltardy'];
			$otherincome12 = $myrow12['otherincome'];
			$otherincometaxable12 = $myrow12['otherincometaxable'];
			$otherdeduction12 = $myrow12['otherdeduction'];
			$emp_dep12 = $myrow12['emp_dep'];
			$pagibig12 = $myrow12['pagibig'];
			$philemp12 = $myrow12['philemp'];
			$ss12 = $myrow12['ss'];
			$ec12 = $myrow12['ec'];
			$bracket12 = $myrow12['bracket'];
			$absentamt12 = $myrow12['absentamt'];
			$name_last12 = $myrow12['name_last'];
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];

			// sp.column total
			$payrate = $emp_salary12 / 2;
			$totallateabsent = $totaltardy12 + $absentamt12;
			$netbasicpay = $payrate - $totallateabsent;
			$totalovertime = $nightdiffamt12 + $overamt12 + $otsundayamt12 + $speholidayamt12 + $regholidayamt12;
			$grosspay = $netbasicpay + $totalovertime + $otherincometaxable12 + $otherincome12;
			$deductionstotal = $tax12 + $deduction12 + $philemp12 + $pagibig12 + $otherdeduction12;

			// display results

			if($emp_dep12!=$prev_emp_dep && $prev_emp_dep!='') {

				// display sub-total per project then reset variable
			echo "<tr><th></th><th colspan=\"3\">Dept TOTAL</th><th></th>";
			echo "<th colspan=\"2\" class=\"text-right\">".number_format($subtotallateabsent, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subnetbasicpay, 2)."</th>";
			echo "<th colspan=\"5\" class=\"text-right\">".number_format($subtotalovertime, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subotherincometaxable, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subotherincome, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subgrosspay, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subtax, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subdeduction, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subphilemp, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subpagibig, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subotherdeduction, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subdeductionstotal, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subnetpay, 2)."</th>";
			echo "</tr>";

				// variable reset
			$subtotallateabsent = 0;
			$subnetbasicpay = 0;
			$subtotalovertime = 0;
			$subotherincometaxable=0;
			$subotherincome=0;
			$subgrosspay = 0;
			$subtax = 0;
			$subdeduction=0;
			$subphilemp=0;;
			$subpagibig=0;
			$subotherdeduction=0;
			$subdeductionstotal = 0;
			$subnetpay=0;

			} // if($emp_dep12!=$prev_emp_dep)

			if($emp_dep12!=$prev_emp_dep) {
			// display project
			echo "<tr><th colspan=\"17\" align=\"left\">$emp_dep12</th></tr>";
			} // if($emp_dep12!=$prev_emp_dep)

			echo "<tr><td>$ctr12</td>";
			echo "<td><strong>$employeeid12</strong></td><td><strong>$name_last12, $name_first12 $name_middle12[0].</strong></td>";

      echo "<form action=\"emppaycutoffedt2.php?loginid=$loginid\" method=\"POST\" name=\"emppaycutoffedt2\">";
      echo "<input type=\"hidden\" name=\"prefn\" value=\"emppaycutoffedt.php\">";
      echo "<input type=\"hidden\" name=\"emppayrollid\" value=\"$emppayrollid12\">";
      echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
      echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
      echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid12\">";
      // echo "<input type=\"hidden\" name=\"emp_salary\" value=\"$emp_salary12\">";

			echo "<td><input name=\"proj\" value=\"$emp_dep12\"></td>";

			// echo "<td class=\"text-right\">".number_format($payrate, 2)."</td>";
			echo "<td class=\"text-right\"><input size='8' name='payrate' value='$payrate'></td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"totaltardy\" value=\"$totaltardy12\"></td>";
			echo "<td class=\"text-right\"><input size=\"6\" name=\"absentamt\" value=\"$absentamt12\"></td>";

			echo "<td class=\"text-right\">".number_format($netbasicpay, 2)."</td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"nightdiffamt\" value=\"$nightdiffamt12\"></td>";
			echo "<td class=\"text-right\"><input size=\"6\" name=\"overamt\" value=\"$overamt12\"></td>";
			echo "<td class=\"text-right\"><input size=\"6\" name=\"otsundayamt\" value=\"$otsundayamt12\"></td>";
			echo "<td class=\"text-right\"><input size=\"6\" name=\"speholidayamt\" value=\"$speholidayamt12\"></td>";
			echo "<td class=\"text-right\"><input size=\"6\" name=\"regholidayamt\" value=\"$regholidayamt12\"></td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"otherincometaxable\" value=\"$otherincometaxable12\"></td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"otherincome\" value=\"$otherincome12\"></td>";

			echo "<td class=\"text-right\">".number_format($grosspay, 2)."</td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"tax\" value=\"$tax12\"></td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"deduction\" value=\"$deduction12\"></td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"philemp\" value=\"$philemp12\"></td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"pagibig\" value=\"$pagibig12\"></td>";

			echo "<td class=\"text-right\"><input size=\"6\" name=\"otherdeduction\" value=\"$otherdeduction12\"></td>";

			echo "<td class=\"text-right\">".number_format($deductionstotal, 2)."</td>";

			echo "<td class=\"text-right\">".number_format($net_pay12, 2)."</td>";
      echo "<input type=\"hidden\" name=\"net_pay\" value=\"$net_pay12\">";

      echo "<td><button type=\"submit\" class=\"btn btn-success btn-sm\">Update</button></td>";
      echo "</form>";

			echo "</tr>";

				// compute sub-total per project
			$subdeduction = $subdeduction + $deduction12;
			$subphilded = $subphilded + $phil_ded12;
			$subtax = $subtax + $tax12;
			$subempoverduration = $subempoverduration + $emp_over_duration12;
			$subnetpay = $subnetpay + $net_pay12;
			$subempdate = $subempdate + $emp_date_wrk12;
			$subregholiday = $subregholiday + $regholiday12;
			$subspeholiday = $subspeholiday + $speholiday12;
			$subemplateduration = $subemplateduration + $emp_late_duration12;
			$subotsunday = $subotsunday + $otsunday12;
			$subregholiday = $subregholiday + $regholidayamt12;
			$subspeholidayamt = $subspeholidayamt + $speholidayamt12;
			$subotsundayamt = $subotsundayamt + $otsundayamt12;
			$suboveramt = $suboveramt + $overamt12;
			$subnightdiffminutes = $subnightdiffminutes + $nightdiffminutes12;
			$subnightdiffamt = $subnightdiffamt + $nightdiffamt12;
			$subtotaltardy = $subtotaltardy + $totaltardy12;
			$subotherincome = $subotherincome + $otherincome12;
			$subotherincometaxable = $subotherincometaxable + $otherincometaxable12;
			$subotherdeduction = $subotherdeduction + $otherdeduction12;

			$subpagibig = $subpagibig + $pagibig12;
			$subphilemp = $subphilemp + $philemp12;
			$subss = $subss + $ss12;
			$subec = $subec + $ec12;
			$subbracket = $subbracket + $bracket12;
			$subabsentamt = $subabsentamt + $absentamt12;

			$subtotallateabsent = $subtotallateabsent + $totallateabsent;
			$subnetbasicpay = $subnetbasicpay + $netbasicpay;
			$subtotalovertime = $subtotalovertime + $totalovertime;
			$subgrosspay = $subgrosspay + $grosspay;
			$subdeductionstotal = $subdeductionstotal + $deductionstotal;

			// compute (grand) totals
			$totdeduction = $totdeduction+$deduction12;
			$totphilded = $totphilded + $phil_ded12;
			$tottax = $tottax + $tax12;
			$totempoverduration = $totempoverduration + $emp_over_duration12;
			$totnetpay = $totnetpay + $net_pay12;
			$totempdate = $totempdate + $emp_date_wrk12;
			$totregholiday = $totregholiday + $regholiday12;
			$totspeholiday = $totspeholiday + $speholiday12;
			$totemplateduration = $totemplateduration + $emp_late_duration12;
			$tototsunday = $tototsunday + $otsunday12;
			$totregholiday = $totregholiday + $regholidayamt12;
			$totspeholidayamt = $totspeholidayamt + $speholidayamt12;
			$tototsundayamt = $tototsundayamt + $otsundayamt12;
			$totoveramt = $totoveramt + $overamt12;
			$totnightdiffminutes = $totnightdiffminutes + $nightdiffminutes12;
			$totnightdiffamt = $totnightdiffamt + $nightdiffamt12;
			$tottotaltardy = $tottotaltardy + $totaltardy12;
			$tototherincome = $tototherincome + $otherincome12;
			$tototherincometaxable = $tototherincometaxable + $otherincometaxable12;
			$tototherdeduction = $tototherdeduction + $otherdeduction12;

			$totpagibig = $totpagibig + $pagibig12;
			$totphilemp = $totphilemp + $philemp12;
			$totss = $totss + $ss12;
			$totec = $totec + $ec12;
			$totbracket = $totbracket + $bracket12;
			$totabsentamt = $totabsentamt + $absentamt12;

			$tottotallateabsent = $tottotallateabsent + $totallateabsent;
			$totnetbasicpay = $totnetbasicpay + $netbasicpay;
			$tottotalovertime = $tottotalovertime + $totalovertime;
			$totgrosspay = $totgrosspay + $grosspay;
			$totdeductionstotal = $totdeductionstotal + $deductionstotal;

			// assign temp variable
			$prev_emp_dep = $emp_dep12;

			// reset variables
			$payrate = 0;
			$totallateabsent = 0;
			$netbasicpay = 0;
			$totalovertime = 0;
			$grosspay = 0;
			$deductionstotal = 0;

			} // while($myrow12=$result12->fetch_assoc())
		} // if($result12->num_rows>0)

				// display sub-total for the last queried project
			echo "<tr><th></th><th colspan=\"3\">Dept TOTAL</th><th></th>";
			echo "<th colspan=\"2\" class=\"text-right\">".number_format($subtotallateabsent, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subnetbasicpay, 2)."</th>";
			echo "<th colspan=\"5\" class=\"text-right\">".number_format($subtotalovertime, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subotherincometaxable, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subotherincome, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subgrosspay, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subtax, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subdeduction, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subphilemp, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subpagibig, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subotherdeduction, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subdeductionstotal, 2)."</th>";
			echo "<th class=\"text-right\">".number_format($subnetpay, 2)."</th>";
			echo "</tr>";

		// display totals
		echo "<tr><th colspan=\"5\" align=\"right\">Grand TOTAL</th>";
		echo "<th colspan=\"2\" class=\"text-right\">".number_format($tottotallateabsent, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($totnetbasicpay, 2)."</th>";
		echo "<th colspan=\"5\" class=\"text-right\">".number_format($tottotalovertime, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($tototherincometaxable, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($tototherincome, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($totgrosspay, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($tottax, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($totdeduction, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($totphilemp, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($totpagibig, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($tototherdeduction, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($totdeductionstotal, 2)."</th>";
		echo "<th class=\"text-right\">".number_format($totnetpay, 2)."</th>";
		echo "</tr>";
	echo "</tbody>";

    // display again header
	echo "<thead class='thead-dark'>";
		echo "<tr><th>Count</th><th>Employee No.</th><th>Name</th>";
		echo "<th>Proj</th>";
		echo "<th>Emp_Salary (1/2mo.)</th><th colspan=\"2\">Total Late/Absent</th><th>Net Basic Pay</th><th colspan=\"5\">Emp Overtime<br>nightdiffamt + overamt + otsundayamt + speholidayamt + regholidayamt</th><th>Taxable Income</th><th>Other Income<br>Non-Taxable</th><th>Gross Pay</th><th>Withholding Tax</th><th>SSS Deduction</th><th>Philhealth Deduction</th><th>Pag-IBIG Deduction</th><th>Other Deduction</th><th>Total Deductions</th><th>Net Pay</th><th>Action</th></tr>";
	echo "</thead>";

    echo "</table>";
    echo "</td></tr>";
  } // if

  echo "</table>";

	} // if($submit==1)

  echo "<p><a href=\"cutoff.php?loginid=$loginid\">Back</a></p>";

// end contents here

  $result = $dbh2->query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
