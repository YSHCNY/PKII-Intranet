<?php
//
// 20200118
// emppayrptrecompute.php
// fr:cutoff.php
// 
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$submitsw = (isset($_GET['submitsw'])) ? $_GET['submitsw'] :'';
$cutoff = (isset($_POST['cutoff'])) ? $_POST['cutoff'] :'';

if($submitsw==1) {
	$cutstart=$cutoff;
	// query cutoff periods
	$res11query="SELECT cut_end FROM tblemppayroll WHERE cut_start=\"$cutoff\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$ctr11=$ctr11+1;
		$cutend=$myrow11['cut_end'];
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)
} // if($submitsw==1)

$found = 0;

$secsubtotarr = array();

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
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
  echo "<p><font size=1>Modules >> Employees' payslip email notifier >> re-computations</font></p>";

  echo "<table class=\"fin2\" border=\"1\">";

  // display cutoff period dropdown
  echo "<tr>";
    echo "<form action=\"emppayrptrecompute.php?loginid=$loginid&submitsw=1\" method=\"POST\" name=\"emppayrptrecompute\">";
    echo "<td colspan=\"2\" nowrap>";
		echo "<select name=\"cutoff\">";
		// disp dropdown avlbl cutoff periods
		$res11query="SELECT DISTINCT cut_start, cut_end FROM tblemppayroll ORDER BY cut_start DESC";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$cutstart11 = $myrow11['cut_start'];
			$cutend11 = $myrow11['cut_end'];
			if($cutoff==$cutstart11) { $cutoffsel="selected"; } else { $cutoffsel=""; }
			echo "<option value=\"$cutstart11\" $cutoffsel>$cutstart11 -to- $cutend11</option>";
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)
		echo "</select>";
    // echo "<input type=\"submit\" value=\"Submit\" id=\"myOrder1\">";
    echo "<button type=\"submit\" class=\"btn btn-success\" id=\"myOrder1\">Submit</button>";
    echo "</td></form>";
  echo "</tr>";

  // display results
	echo "<tr><td colspan=\"2\">";

	if($submitsw==1) {

		echo "<table id=\"ReportTable\" class=\"fin2\">";
		echo "<tr><th colspan=\"2\" align=\"left\">Philkoei International Inc.&nbsp;<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">Employees Payroll Summary</th></tr>";
		echo "<tr><th colspan=\"2\" align=\"left\">".date('Y-M-d', strtotime($cutstart))." -to- ".date('Y-M-d', strtotime($cutend))."</th></tr>";
    echo "<tr><td colspan=\"2\">";
    // start table display
echo "<table width=\"100%\" class=\"fin\" border=\"1\">";
		echo "<tr><th>Count</th><th>Employee No.</th><th>Name</th>";
		echo "<th>Emp_Salary</th><th>Total Late/Absent</th><th>Net Basic Pay</th><th>Emp Overtime</th><th>Taxable Income</th><th>Other Income<br>Non-Taxable</th><th>Gross Pay</th><th><i>Withholding Tax</i></th><th>WTAX (new-comp)</th><th>SSS Deduction</th><th><i>Philhealth Deduction</i></th><th>Philhealth (NEW 2019+)</th><th>Pag-IBIG Deduction</th><th>Other Deduction</th><th>Total Deductions</th><th>Total Deductions (new-comp)</th><th>Net Pay</th><th>Net Pay (new-comp)</th>";
		echo "</tr>";

		// query cutoffs for label
		$res12query = "SELECT tblemppayroll.emppayrollid, tblemppayroll.employeeid, tblemppayroll.emp_salary, tblemppayroll.deduction, tblemppayroll.phil_ded, tblemppayroll.tax, tblemppayroll.emp_over_duration, tblemppayroll.net_pay, tblemppayroll.emp_date_wrk, tblemppayroll.cut_start, tblemppayroll.cut_end, tblemppayroll.regholiday, tblemppayroll.speholiday, tblemppayroll.emp_late_duration, tblemppayroll.otsunday, tblemppayroll.regholidayamt, tblemppayroll.speholidayamt, tblemppayroll.otsundayamt, tblemppayroll.overamt, tblemppayroll.nightdiffminutes, tblemppayroll.nightdiffamt, tblemppayroll.totaltardy, tblemppayroll.otherincome, tblemppayroll.otherincometaxable, tblemppayroll.otherdeduction, tblemppayroll.emp_dep, tblemppayroll.pagibig, tblemppayroll.philemp, tblemppayroll.ss, tblemppayroll.ec, tblemppayroll.bracket, tblemppayroll.absentamt, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemppayroll LEFT JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid WHERE tblemppayroll.cut_start=\"$cutstart\" AND tblemppayroll.cut_end=\"$cutend\" AND tblcontact.contact_type=\"personnel\" ORDER BY tblemppayroll.emp_dep ASC, tblcontact.name_last ASC";
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
			// $netbasicpay = $payrate - $totallateabsent;
			$netbasicpay = $payrate;
			$totalovertime = $nightdiffamt12 + $overamt12 + $otsundayamt12 + $speholidayamt12 + $regholidayamt12;
			$grosspay = $netbasicpay + $totalovertime + $otherincometaxable12 + $otherincome12;
			$deductionstotal = $tax12 + $deduction12 + $philemp12 + $pagibig12 + $otherdeduction12;
			
		    // 20200226 determine type of philhealth table based on year
			$cutyear = date("Y", strtotime($cutstart));
			$cutwhat = date("d", strtotime($cutstart));
			
         // check first if 1st half then apply philhealth computation and sss2019apr else 0
			if($cutwhat=='01') {

			// get new philhealth based on monthly basic salary
			// query previous cutoff and get netbasicpay, then add in current netbasicpay
			$res18query="SELECT DISTINCT cut_start, cut_end, net_pay, emp_salary, totaltardy, absentamt FROM tblemppayroll WHERE cut_start<\"$cutstart\" AND cut_end<\"$cutend\" AND employeeid=\"$employeeid12\" ORDER BY cut_start DESC LIMIT 1";
			$result18=""; $found18=0; $ctr18=0;
			$result18=$dbh2->query($res18query);
			if($result18->num_rows>0) {
				while($myrow18=$result18->fetch_assoc()) {
				$found18=1;
				$ctr18=$ctr18+1;
				$cut_start18 = $myrow18['cut_start'];
				$cut_end18 = $myrow18['cut_end'];
				$net_pay18 = $myrow18['net_pay'];
				$emp_salary18 = $myrow18['emp_salary'];
				$totaltardy18 = $myrow18['totaltardy'];
				$absentamt18 = $myrow18['absentamt'];
				} // while($myrow18=$result18->fetch_assoc())
			} // if($result18->num_rows>0)
			if($found18!=0) {
			// compute required fields
			$prevempsalaryhf = $emp_salary18 / 2;
			$prevnetbasicpay = $prevempsalaryhf - ($totaltardy18 + $absentamt18);
			$subtotnetbasicpay = $prevnetbasicpay + $netbasicpay;
			$fullempsalary = $emp_salary18;
			} else {
			$subtotnetbasicpay = $netbasicpay;
			$fullempsalary = $emp_salary12;
			} // if($found18!=0)
						
		if($cutyear<'2019') {
			
			// $res15query="SELECT idphlhealth2018, mbsmin, mbsmax, pct, maxpremium FROM tblphlhealth2018 WHERE mbsmin<=$emp_salary12 AND mbsmax>=$emp_salary12";
			$res15query="SELECT idphlhealth2018, mbsmin, mbsmax, pct, maxpremium FROM tblphlhealth2018 WHERE mbsmin<=$subtotnetbasicpay AND mbsmax>=$subtotnetbasicpay";
			$result15=""; $found15=0;
			$result15=$dbh2->query($res15query);
			if($result15->num_rows>0) {
				while($myrow15=$result15->fetch_assoc()) {
				$found15=1;
				$idphlhealth201815 = $myrow15['idphlhealth2018'];
				$mbsmin15 = $myrow15['mbsmin'];
				$mbsmax15 = $myrow15['mbsmax'];
				$pct15 = $myrow15['pct'];
				$maxpremium15 = $myrow15['maxpremium'];
				} // while($myrow15=$result15->fetch_assoc())
			} // if($result15->num_rows>0)
			if($found15==1) {
				if($pct15!=0) {
				// $phlhealth2018 = round(($emp_salary12 * ($pct15/100)), 2);
				$phlhealth2018 = round(($subtotnetbasicpay * ($pct15/100)), 2);
				$phlhlthee = $phlhealth2018 / 2;
				$phlhlther = $phlhealth2018 / 2;
				} else { // if($pct15!=0)
				$phlhealth2018 = $maxpremium15;
				$phlhlthee = $phlhealth2018 / 2;
				$phlhlther = $phlhealth2018 / 2;
				} // if($pct15!=0)
			} // if($found15==1)
				
		} else if($cutyear>='2019') {
				
            // philhealth 2020
            $res15query=""; $result15=""; $found15=0; $ctr15=0;
			$res15query="SELECT idphilhealth2020, compyear, mbsmin, mbsmax, prrate FROM tblphilhealth2020 WHERE mbsmin<=$subtotnetbasicpay AND mbsmax>=$subtotnetbasicpay LIMIT 1";
			$result15=$dbh2->query($res15query);
			if($result15->num_rows>0) {
				while($myrow15=$result15->fetch_assoc()) {
					$found15=1;
					$idphilhealth202015 = $myrow15['idphilhealth2020'];
					$compyear15 = $myrow15['compyear'];
					$mbsmin15 = $myrow15['mbsmin'];
					$mbsmax15 = $myrow15['mbsmax'];
					$prrate15 = $myrow15['prrate'];
					// get maxpremium
					$maxpremium = round($mbsmax15 * ($prrate15/100), 2);
				} // while
			} // if
			if($found15==1) {
				if($subtotnetbasicpay>$mbsmax15) {
				$philhealth2020 = $maxpremium;
				$found15a=1; $found15b=0;
				} else if($subtotnetbasicpay<=$mbsmax15){
				$philhealth2020 = round($subtotnetbasicpay * ($prrate15/100), 2);
				$found15a=0; $found15b=1;
				}
				$phlhlthee = $philhealth2020 / 2;
				$phlhlther = $philhealth2020 / 2;
			} else {
				$phlhlthee = 0;
				$phlhlther = 0;				
			} // if($found15==1)

		} // if-else

			// get new sss201904 based on grosspay from last cutoff and latest cutoff
			// query previous cutoff and get netbasicpay, then add in current netbasicpay
			$res20query="SELECT cut_start, cut_end, emp_salary, totaltardy, absentamt, otherincometaxable, regholidayamt, speholidayamt, otsundayamt, overamt, nightdiffamt, otherincome FROM tblemppayroll WHERE cut_start<\"$cut_start12\" AND cut_end<\"$cut_end12\" AND employeeid=\"$employeeid12\" ORDER BY cut_start DESC, cut_end DESC LIMIT 1";
			$result20=""; $found20=0;
			$result20=$dbh2->query($res20query);
			if($result20->num_rows>0) {
				while($myrow20=$result20->fetch_assoc()) {
					$found20=1;
					$cut_start20 = $myrow20['cut_start'];
					$cut_end20 = $myrow20['cut_end'];
					$emp_salary20 = $myrow20['emp_salary'];
					$totaltardy20 = $myrow20['totaltardy'];
					$absentamt20 = $myrow20['absentamt'];
					$otherincometaxable20 = $myrow20['otherincometaxable'];
					$regholidayamt20 = $myrow20['regholidayamt'];
					$speholidayamt20 = $myrow20['speholidayamt'];
					$otsundayamt20 = $myrow20['otsundayamt'];
					$overamt20 = $myrow20['overamt'];
					$nightdiffamt20 = $myrow20['nightdiffamt'];
					$otherincome20 = $myrow20['otherincome'];
				} // while
			} // if
			if($found20==1) {
			// compute previous grosspay
			$prevempsalaryhf = $emp_salary20 / 2;
			$prevnetbasicpay = $prevempsalaryhf - ($totaltardy20 + $absentamt20);
			$prevcomprate = $prevnetbasicpay + $otherincometaxable20;
			$prevovertimesubtot = $regholidayamt20 + $speholidayamt20 + $otsundayamt20 + $overamt20 + $nightdiffamt20;
			$prevgrosspay = $prevcomprate + $prevovertimesubtot + $otherincome20;
			$grosspayjoined = $prevgrosspay + $grosspay;
			$res19query="SELECT idsss201904, salcredit, sscer, sscee, ssctotal, eccer, tcer, tcee, tctotal FROM tblsss201904 WHERE compfrom<=$grosspayjoined AND compto>=$grosspayjoined";
			$result19=""; $found19=0; $ctr19=0;
			$result19=$dbh2->query($res19query);
			if($result19->num_rows>0) {
				while($myrow19=$result19->fetch_assoc()) {
				$found19=1;
				$idsss201904 = $myrow19['idsss201904'];
				$salcredit = $myrow19['salcredit'];
				$sscer = $myrow19['sscer'];
				$sscee = $myrow19['sscee'];
				$ssctotal = $myrow19['ssctotal'];
				$eccer = $myrow19['eccer'];
				$tcer = $myrow19['tcer'];
				$tcee = $myrow19['tcee'];
				$tctotal = $myrow19['tctotal'];
				} // while
			} // if
			if($found19==1) {
			$deductionfin=$tcee;
			$ecfin=$eccer;
			$ssfin=$sscer;
			} else {
			$deductionfin=0;
			$ecfin=0;
			$ssfin=0;
			} // if
			} else {
			$prevempsalaryhf = 0;
			$prevnetbasicpay = 0;
			$prevcomprate = 0;
			$prevovertimesubtot = 0;
			$prevgrosspay = 0;
			$grosspayjoined = 0;
			$deductionfin=0;
			$ecfin=0;
			$ssfin=0;

			} //  if($found20==1)

			} else { //if($cutwhat=='01')
				$phlhealth2018 = 0;
				$phlhlthee = 0;
				$phlhlther = 0;
			$deductionfin=0;
			$ecfin=0;
			$ssfin=0;

			} //if($cutwhat=='01')

        // query emppayrollctg for current dmwrate and compare vs basic_salary before computing wtax if above min.wage
		$res16qry=""; $result16=""; $found16=0;
		$res16qry="SELECT name, amount FROM tblemppayrollctg WHERE code=\"dmwrate\"";
		$result16=$dbh2->query($res16qry);
		if($result16->num_rows>0) {
		  while($myrow16=$result16->fetch_assoc()) {
		  $found16=1;
		  $name16 = $myrow16['name'];
		  $amount16 = $myrow16['amount'];
		  } // while
		} // if
		
		if($found16==1) {
			// compute basic salary to daily rate
			$dbsalary = ($emp_salary12 * 12) / 314;
			// compare dwmrate with basic salary daily rate if need to compute wtax
			if($dbsalary>$amount16) {
				$gowtaxcompute=1;
			} else {
				$gowtaxcompute=0;
			} // if-else
		}

    if($gowtaxcompute==1) {			
      // try 2018wtax computation but modify to new formulas
			// $comprate = $netbasicpay + ($otherincometaxable12 - $otherincome12);
			$comprate = $netbasicpay + $otherincometaxable12;
      $comprate2 = $comprate + $totalovertime;
			$wtaxsched='sm';
			$res14query="SELECT idwtax2018, crmin, crmax, percent, prescramt FROM tblwtax2018 WHERE sched='$wtaxsched' AND (crmin<=$comprate2 AND crmax>=$comprate2) LIMIT 1";
			$result14=""; $found14=0;
			$result14=$dbh2->query($res14query);
			if($result14->num_rows>0) {
				while($myrow14=$result14->fetch_assoc()) {
				$found14=1;
				$idwtax201814 = $myrow14['idwtax2018'];
				$crmin14 = $myrow14['crmin'];
				$crmax14 = $myrow14['crmax'];
				$percent14 = $myrow14['percent'];
				$prescramt14 = $myrow14['prescramt'];
				} // while($myrow14=$resul14->fetch_assoc())
			} // if($result14->num_rows>0)
			if($found14==1) {
				if($percent14!=0) {
				// include overtime in comprate
				$flg='wpct';
        $pct = ($comprate2 - $crmin14) * ($percent14/100);
        $wtax2020 = $pct + $prescramt14;
				} else { // if($percent14==0)
				$flg='0pct';
        $wtax2020=0;
				} // if($percent14==0)
			} // if($found14==1)
		} else {
		$wtax2020=0;
		} // if($gowtaxcompute==1)				

    // other new computations
    // $deductionstotal2020 = $wtax2020 + $deduction12 + $philemp12 + $pagibig12 + $otherdeduction12;
	$deductionstotal2020 = $wtax2020 + $deduction12 + $phlhlthee + $pagibig12 + $otherdeduction12;
    $netpay2020 = $grosspay - $deductionstotal2020;

			// display results

			if($emp_dep12!=$prev_emp_dep && $prev_emp_dep!='') {

				// display sub-total per project then reset variable
			echo "<tr><th></th><th colspan=\"2\">Dept TOTAL</th><th></th>";
			echo "<th align=\"right\">".number_format($subtotallateabsent, 2)."</th>";
			echo "<th align=\"right\">".number_format($subnetbasicpay, 2)."</th>";
			echo "<th align=\"right\">".number_format($subtotalovertime, 2)."</th>";
			echo "<th align=\"right\">".number_format($subotherincometaxable, 2)."</th>";
			echo "<th align=\"right\">".number_format($subotherincome, 2)."</th>";
			echo "<th align=\"right\">".number_format($subgrosspay, 2)."</th>";
			echo "<th align=\"right\"><i>".number_format($subtax, 2)."</i></th>";
      echo "<th align=\"right\">".number_format($subwtax2020, 2)."</th>";
			echo "<th align=\"right\">".number_format($subdeduction, 2)."</th>";
			echo "<th align=\"right\"><i>".number_format($subphilemp, 2)."</i></th>";
			echo "<th align=\"right\">".number_format($subphlhlthee, 2)."</th>";
			echo "<th align=\"right\">".number_format($subpagibig, 2)."</th>";
			echo "<th align=\"right\">".number_format($subotherdeduction, 2)."</th>";
			echo "<th align=\"right\">".number_format($subdeductionstotal, 2)."</th>";
			echo "<th align=\"right\">".number_format($subdeductionstotal2020, 2)."</th>";
			echo "<th align=\"right\">".number_format($subnetpay, 2)."</th>";
			echo "<th align=\"right\">".number_format($subnetpay2020, 2)."</th>";
			echo "</tr>";

				// variable reset
			$subtotallateabsent = 0;
			$subnetbasicpay = 0;
			$subtotalovertime = 0;
			$subotherincometaxable=0;
			$subotherincome=0;
			$subgrosspay = 0;
			$subtax = 0;
      $subwtax2020 = 0;
			$subdeduction=0;
			$subphilemp=0; subphlhlthee;
			$subpagibig=0;
			$subotherdeduction=0;
			$subdeductionstotal = 0;
			$subnetpay=0;
			$subnetpay2020=0;

			} // if($emp_dep12!=$prev_emp_dep)

			if($emp_dep12!=$prev_emp_dep) {
			// display project
			echo "<tr><th colspan=\"17\" align=\"left\">$emp_dep12</th></tr>";
			} // if($emp_dep12!=$prev_emp_dep)

			echo "<tr><td>$ctr12</td>";
			echo "<td>$employeeid12</td><td>$name_last12, $name_first12 $name_middle12[0]</td>";
			echo "<td align=\"right\">".number_format($payrate, 2)."</td>";
			echo "<td align=\"right\">".number_format($totallateabsent, 2)."</td>";
			echo "<td align=\"right\">".number_format($netbasicpay, 2)."</td>";
			echo "<td align=\"right\">".number_format($totalovertime, 2)."</td>";
			echo "<td align=\"right\">".number_format($otherincometaxable12, 2)."</td>";
			echo "<td align=\"right\">".number_format($otherincome12, 2)."</td>";
			echo "<td align=\"right\">".number_format($grosspay, 2)."</td>";
			echo "<td align=\"right\"><i>".number_format($tax12, 2)."</i></td>";
			echo "<td align=\"right\"><b>".number_format($wtax2020, 2)."</b>";
			// echo "<br>mo_salary:$emp_salary12,daily_sal:$dbsalary,dminwage:$amount16,compute:$gowtaxcompute";
			// echo "<br>f14:$found14|pct14:$percent14|$comprate:$comprate2";
      // echo "<br>comprate2:$comprate2=$netbasicpay(netbasicpay),$otherincometaxable12(otherinctaxbl),tot_ot:$totalovertime";
      // echo "<br>newwtax:$wtax2020=($comprate2(comprate2)-$crmin14(crmin))*($percent14(pct)/100) + $prescramt14(prescramt)";
			echo "</td>";
			echo "<td align=\"right\">".number_format($deduction12, 2)."</td>";
			echo "<td align=\"right\"><i>".number_format($philemp12, 2)."</i></td>";
			echo "<td align=\"right\"><b>".number_format($phlhlthee, 2)."</b>";
			// echo "<br>ctwt:$cutwhat,cutst:$cutstart,yr:$cutyear<br>nbasic:$subtotnetbasicpay,f15:$found15,id:$idphilhealth202015,maxprem:$maxpremium,ph20k:$philhealth2020";
			echo "</td>";
			echo "<td align=\"right\">".number_format($pagibig12, 2)."</td>";
			echo "<td align=\"right\">".number_format($otherdeduction12, 2)."</td>";
			echo "<td align=\"right\"><i>".number_format($deductionstotal, 2)."</i></td>";
			echo "<td align=\"right\"><b>".number_format($deductionstotal2020, 2)."</b></td>";
			echo "<td align=\"right\"><i>".number_format($net_pay12, 2)."</i></td>";
			echo "<td align=\"right\"><b>".number_format($netpay2020, 2)."</b></td>";
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
			$subphlhlthee = $subphlhlthee + $phlhlthee;
			$subss = $subss + $ss12;
			$subec = $subec + $ec12;
			$subbracket = $subbracket + $bracket12;
			$subabsentamt = $subabsentamt + $absentamt12;

			$subtotallateabsent = $subtotallateabsent + $totallateabsent;
			$subnetbasicpay = $subnetbasicpay + $netbasicpay;
			$subtotalovertime = $subtotalovertime + $totalovertime;
			$subgrosspay = $subgrosspay + $grosspay;
			$subdeductionstotal = $subdeductionstotal + $deductionstotal;

			$subnetpay2020 = $subnetpay2020 + $netpay2020;
			$subdeductionstotal2020 = $subdeductionstotal2020 + $deductionstotal2020;
      $subwtax2020 = $subwtax2020 + $wtax2020;

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
			$totphlhlth = $totphlhlth + $phlhlthee;
			$totss = $totss + $ss12;
			$totec = $totec + $ec12;
			$totbracket = $totbracket + $bracket12;
			$totabsentamt = $totabsentamt + $absentamt12;

			$tottotallateabsent = $tottotallateabsent + $totallateabsent;
			$totnetbasicpay = $totnetbasicpay + $netbasicpay;
			$tottotalovertime = $tottotalovertime + $totalovertime;
			$totgrosspay = $totgrosspay + $grosspay;
			$totdeductionstotal = $totdeductionstotal + $deductionstotal;

			$totnetpay2020 = $totnetpay2020 + $netpay2020;
			$totdeductionstotal2020 = $totdeductionstotal2020 + $deductionstotal2020;
      $totwtax2020 = $totwtax2020 + $subwtax2020;

			// assign temp variable
			$prev_emp_dep = $emp_dep12;

			// reset variables
			$payrate = 0;
			$totallateabsent = 0;
			$netbasicpay = 0;
			$totalovertime = 0;
			$grosspay = 0;
			$deductionstotal = 0;
      $comprate2=0; $pct=0; $wtax2020=0; $deductionstotal2020=0;
 			$comprate=0; $netbasicpay=0; $otherincometaxable12=0; $otherincome12=0; $gowtaxcompute=0;


			} // while($myrow12=$result12->fetch_assoc())
		} // if($result12->num_rows>0)

				// display sub-total for the last queried project
			echo "<tr><th></th><th colspan=\"2\">Dept TOTAL</th><th></th>";
			echo "<th align=\"right\">".number_format($subtotallateabsent, 2)."</th>";
			echo "<th align=\"right\">".number_format($subnetbasicpay, 2)."</th>";
			echo "<th align=\"right\">".number_format($subtotalovertime, 2)."</th>";
			echo "<th align=\"right\">".number_format($subotherincometaxable, 2)."</th>";
			echo "<th align=\"right\">".number_format($subotherincome, 2)."</th>";
			echo "<th align=\"right\">".number_format($subgrosspay, 2)."</th>";
			echo "<th align=\"right\"><i>".number_format($subtax, 2)."</i></th>";
			echo "<th align=\"right\">".number_format($subwtax2020, 2)."</th>";
			echo "<th align=\"right\">".number_format($subdeduction, 2)."</th>";
			echo "<th align=\"right\"><i>".number_format($subphilemp, 2)."</i></th>";
			echo "<th align=\"right\">".number_format($subphlhlthee, 2)."</th>";
			echo "<th align=\"right\">".number_format($subpagibig, 2)."</th>";
			echo "<th align=\"right\">".number_format($subotherdeduction, 2)."</th>";
			echo "<th align=\"right\">".number_format($subdeductionstotal, 2)."</th>";
			echo "<th align=\"right\">".number_format($subdeductionstotal2020, 2)."</th>";
			echo "<th align=\"right\">".number_format($subnetpay, 2)."</th>";
			echo "<th align=\"right\">".number_format($subnetpay2020, 2)."</th>";
			echo "</tr>";

		// display totals
		echo "<tr><th colspan=\"4\" align=\"right\">Grand TOTAL</th>";
		echo "<th align=\"right\">".number_format($tottotallateabsent, 2)."</th>";
		echo "<th align=\"right\">".number_format($totnetbasicpay, 2)."</th>";
		echo "<th align=\"right\">".number_format($tottotalovertime, 2)."</th>";
		echo "<th align=\"right\">".number_format($tototherincometaxable, 2)."</th>";
		echo "<th align=\"right\">".number_format($tototherincome, 2)."</th>";
		echo "<th align=\"right\">".number_format($totgrosspay, 2)."</th>";
		echo "<th align=\"right\"><i>".number_format($tottax, 2)."</i></th>";
		echo "<th align=\"right\">".number_format($totwtax2020, 2)."</th>";
		echo "<th align=\"right\">".number_format($totdeduction, 2)."</th>";
		echo "<th align=\"right\"><i>".number_format($totphilemp, 2)."</i></th>";
		echo "<th align=\"right\">".number_format($totphlhlth, 2)."</th>";
		echo "<th align=\"right\">".number_format($totpagibig, 2)."</th>";
		echo "<th align=\"right\">".number_format($tototherdeduction, 2)."</th>";
		echo "<th align=\"right\">".number_format($totdeductionstotal, 2)."</th>";
		echo "<th align=\"right\">".number_format($totdeductionstotal2020, 2)."</th>";
		echo "<th align=\"right\">".number_format($totnetpay, 2)."</th>";
		echo "<th align=\"right\">".number_format($totnetpay2020, 2)."</th>";
		echo "</tr>";

		// re-display headers
		// echo "<tr><th>Count</th><th>Employee No.</th><th>Name</th>";
		// echo "<th>Emp_Salary</th><th>Total Late/Absent</th><th>Net Basic Pay</th><th>Emp Overtime</th><th>Taxable Income</th><th>Other Income<br>Non-Taxable</th><th>Gross Pay</th><th>Withholding Tax</th><th>SSS Deduction</th><th>Philhealth Deduction</th><th>Pag-IBIG Deduction</th><th>Other Deduction</th><th>Total Deductions</th><th>Net Pay</th>";
		// echo "</tr>";
/*
		// display footer
		echo "<tr><td colspan=\"2\"></td>";
		// prepared
		echo "<td colspan=\"3\">Prepared by:</td>";
		// checked
		echo "<td colspan=\"4\">Checked by:</td>";
		// noted
		echo "<td colspan=\"4\">Noted by:</td>";
		// approved
		echo "<td colspan=\"4\">Approved by:</td>";
		echo "</tr>";

		echo "<tr><td colspan=\"2\"></td>";
		// prepared
		echo "<td colspan=\"3\">&nbsp;</td>";
		// checked
		echo "<td colspan=\"4\">&nbsp;</td>";
		// noted
		echo "<td colspan=\"4\">&nbsp;</td>";
		// approved
		echo "<td colspan=\"4\">&nbsp;</td>";
		echo "</tr>";

		echo "<tr><td colspan=\"2\"></td>";
		// prepared
		echo "<td colspan=\"3\">$preparedbyname</td>";
		// checked
		echo "<td colspan=\"4\">$checkedbyname</td>";
		// noted
		echo "<td colspan=\"4\">$notedbyname</td>";
		// approved
		echo "<td colspan=\"4\">$approvedbyname</td>";
		echo "</tr>";

		echo "<tr><td colspan=\"2\"></td>";
		// prepared
		echo "<td colspan=\"3\">$preparedbyposition</td>";
		// checked
		echo "<td colspan=\"4\">$checkedbyposition</td>";
		// noted
		echo "<td colspan=\"4\">$notedbyposition</td>";
		// approved
		echo "<td colspan=\"4\">$approvedbyposition</td>";
		echo "</tr>";
*/
		echo "</table>";
    // end table display
    echo "</td></tr>";
    echo "</table>"; // <table id=\"ReportTable\" class=\"fin2\">

  } // if(submitsw==1)

  echo "</td></tr>";
  echo "</table>";

  echo "<p><a href=\"cutoff.php?loginid=$loginid\">Back</a></p>";
// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>