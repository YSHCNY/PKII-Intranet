<?php 

require('./db1.php');
require('./db24.php');

include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$startsw = (isset($_POST['startsw'])) ? $_POST['startsw'] :'';
$startswadd = (isset($_POST['startswadd'])) ? $_POST['startswadd'] :'';
$startswadd2 = (isset($_POST['startswadd2'])) ? $_POST['startswadd2'] :'';
$startswdeduct = (isset($_POST['startswdeduct'])) ? $_POST['startswdeduct'] :'';

if($startsw=='') { $startsw=0; }
if($startswadd=='') { $startswadd=0; }
if($startswadd2=='') { $startswadd2=0; }
if($startswdeduct=='') { $startswdeduct=0; }

// echo "<p>sw:$startsw<br>";
// echo "swadd:$startswadd<br>";
// echo "swadd2:$startswadd2<br>";
// echo "swdeduct:$startswdeduct</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     // include ("header.php");
     // include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> Acctg Modules >> Sync db24 payroll</font></p>";

// start contents here...
  if($accesslevel >= 4) {

		echo "<table class=\"fin\"><tr>";
		echo "<td><form action=\"mngfinsyncdb24.php?loginid=$loginid\" method=\"post\"><input type=\"hidden\" name=\"startsw\" value=\"1\"><input type=submit value=\"sync sample > tblemppayroll\"></form></td>";
		echo "<td><form action=\"mngfinsyncdb24.php?loginid=$loginid\" method=\"post\"><input type=\"hidden\" name=\"startswadd\" value=\"1\"><input type=submit value=\"sync add > tblemppayincomenontaxable\"></form></td>";
		echo "<td><form action=\"mngfinsyncdb24.php?loginid=$loginid\" method=\"post\"><input type=\"hidden\" name=\"startswadd2\" value=\"1\"><input type=submit value=\"sync add2 > tblemppayincometaxable\"></form></td>";
		echo "<td><form action=\"mngfinsyncdb24.php?loginid=$loginid\" method=\"post\"><input type=\"hidden\" name=\"startswdeduct\" value=\"1\"><input type=submit value=\"sync deduct > tblemppayotherdeductions\"></form></td>";
		echo "</tr></table>";

		if($startsw == 1) {
		echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th colspan=\"36\">db24.sample</th><th>to</th><th colspan=\"4\">tblemppayroll</th><th>status</th></tr>";
		echo "<tr><th>ctr</th><th>emp_no</th><th>emp_salary</th><th>deduction</th><th>phil_ded</th><th>wtax</th><th>emp_over_duration</th><th>Net_Pay</th><th>emp_date_wrk</th><th>emp_sick</th><th>emp_vacation</th><th>cut_start</th><th>cut_end</th><th>regHoliday</th><th>speHoliday</th><th>emp_late_duration</th><th>otSunday</th><th>regHolidayamt</th><th>SpeHolidayamt</th><th>otSundayamt</th><th>overamt</th><th>NigthDiffMinutes</th><th>NIgthDiffAmt</th><th>TotalTardy</th><th>OtherIncome</th><th>OtherIncomeTaxable</th><th>OtherDeduction</th><th>emp_dep</th><th>pagibig</th><th>VLused</th><th>SLUsed</th><th>PHILEMP</th><th>SS</th><th>EC</th><th>bracket</th><th>AbsentAmt</th>";
		echo "<th></th>";
		echo "<th>id</th><th>emp_salary</th><th>deduction</th><th>over_amt</th><th></th></tr>";

		$res11qry=""; $result11=""; $found11=0; $ctr11=0;
		$res11qry="SELECT emp_no, emp_salary, deduction, phil_ded, emp_over_duration, Net_Pay, emp_date_wrk, emp_sick, emp_vacation, cut_start, cut_end, regHoliday, speHoliday, emp_late_duration, otSunday, regHolidayamt, SpeHolidayamt, otSundayamt, overamt, NigthDiffMinutes, NIgthDiffAmt, TotalTardy, OtherIncome, OtherIncomeTaxable, OtherDeduction, emp_dep, pagibig, VLused, SLUsed, PHILEMP, SS, EC, bracket, AbsentAmt, tax FROM sample WHERE emp_no<>'' ORDER BY cut_start ASC, emp_no ASC";
    $result11=$dbh24b->query($res11qry);
    if($result11->num_rows>0) {
      while($myrow11=$result11->fetch_assoc()) {
      $found11=1;
      $ctr11=$ctr11+1;
      $emp_no11 = trim($myrow11['emp_no']);
      $emp_salary11 = $myrow11['emp_salary'];
      $deduction11 = $myrow11['deduction'];
      $phil_ded11 = $myrow11['phil_ded'];
      $emp_over_duration11 = $myrow11['emp_over_duration'];
      $Net_Pay11 = $myrow11['Net_Pay'];
      $emp_date_wrk11 = $myrow11['emp_date_wrk'];
      $emp_sick11 = trim($myrow11['emp_sick']);
      $emp_vacation11 = trim($myrow11['emp_vacation']);
      $cut_start11 = substr($myrow11['cut_start'], 0, -9);
      $cut_end11 = substr($myrow11['cut_end'], 0, -9);
      $regHoliday11 = $myrow11['regHoliday'];
      $speHoliday11 = $myrow11['speHoliday'];
      $emp_late_duration11 = $myrow11['emp_late_duration'];
      $otSunday11 = $myrow11['otSunday'];
      $regHolidayamt11 = $myrow11['regHolidayamt'];
      $SpeHolidayamt11 = $myrow11['SpeHolidayamt'];
      $otSundayamt11 = $myrow11['otSundayamt'];
      $overamt11 = $myrow11['overamt'];
      $NigthDiffMinutes11 = $myrow11['NigthDiffMinutes'];
      $NIgthDiffAmt11 = $myrow11['NIgthDiffAmt'];
      $TotalTardy11 = $myrow11['TotalTardy'];
      $OtherIncome11 = $myrow11['OtherIncome'];
      $OtherIncomeTaxable11 = $myrow11['OtherIncomeTaxable'];
      $OtherDeduction11 = $myrow11['OtherDeduction'];
      $emp_dep11 = trim($myrow11['emp_dep']);
      $pagibig11 = $myrow11['pagibig'];
      $VLused11 = $myrow11['VLused'];
      $SLUsed11 = $myrow11['SLUsed'];
      $PHILEMP11 = $myrow11['PHILEMP'];
      $SS11 = $myrow11['SS'];
      $EC11 = $myrow11['EC'];
      $bracket11 = $myrow11['bracket'];
      $AbsentAmt11 = $myrow11['AbsentAmt'];
      $tax11 = $myrow11['tax'];
		
			echo "<tr><td>$ctr11</td><td>$emp_no11</td><td>$emp_salary11</td><td>$deduction11</td><td>$phil_ded11</td><td>$tax11</td><td>$emp_over_duration11</td><td>$Net_Pay11</td><td>$emp_date_wrk11</td><td>$emp_sick11</td><td>$emp_vacation11</td><td>$cut_start11</td><td>$cut_end11</td><td>$regHoliday11</td><td>$speHoliday11</td><td>$emp_late_duration11</td><td>$otSunday11</td><td>$regHolidayamt11</td><td>$SpeHolidayamt11</td><td>$otSundayamt11</td><td>$overamt11</td><td>$NigthDiffMinutes11</td><td>$NIgthDiffAmt11</td><td>$TotalTardy11</td><td>$OtherIncome11</td><td>$OtherIncomeTaxable11</td><td>$OtherDeduction11</td><td>$emp_dep11</td><td>$pagibig11</td><td>$VLused11</td><td>$SLUsed11</td><td>$PHILEMP11</td><td>$SS11</td><td>$EC11</td><td>$bracket11</td><td>$AbsentAmt11</td>";
			echo "<td></td>";

			$res12qry=""; $result12=""; $found12=0; $ctr12=0;
			$res12qry="SELECT emppayrollid, employeeid, emp_salary, deduction, phil_ded, emp_over_duration, net_pay, emp_date_wrk, emp_sick, emp_vacation, cut_start, cut_end, regholiday, speholiday, emp_late_duration, otsunday, regholidayamt, speholidayamt, otsundayamt, overamt, nightdiffminutes, nightdiffamt, totaltardy, otherincome, otherincometaxable, otherdeduction, emp_dep, pagibig, vlused, slused, philemp, ss, ec, bracket, absentamt, tax FROM tblemppayroll WHERE employeeid=\"$emp_no11\" AND cut_start=\"$cut_start11\" AND cut_end=\"$cut_end11\"";
      $result12=$dbh2->query($res12qry);
      if($result12->num_rows>0) {
        while($myrow12=$result12->fetch_assoc()) {
        $found12=1;
        $ctr12=$ctr12+1;
        $emppayrollid12 = $myrow12['emppayrollid'];
        $employeeid12 = $myrow12['employeeid'];
        $emp_salary12 = $myrow12['emp_salary'];
        $deduction12 = $myrow12['deduction'];
        $phil_ded12 = $myrow12['phil_ded'];
        $emp_over_duration12 = $myrow12['emp_over_duration'];
        $net_pay12 = $myrow12['net_pay'];
        $emp_date_wrk12 = $myrow12['emp_date_wrk'];
        $emp_sick12 = $myrow12['emp_sick'];
        $emp_vacation12 = $myrow12['emp_vacation'];
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
        $vlused12 = $myrow12['vlused'];
        $slused12 = $myrow12['slused'];
        $philemp12 = $myrow12['philemp'];
        $ss12 = $myrow12['ss'];
        $ec12 = $myrow12['ec'];
        $bracket12 = $myrow12['bracket'];
        $absentamt12 = $myrow12['absentamt'];
        $tax12 = $myrow12['tax'];
        } // while
      } // if

			if($found12 == 1) {
				echo "<td>$emppayrollid12</td><td>$emp_salary12</td><td>$deduction12</td><td>$overamt12</td>";
				echo "<td>record exists</td>";
			} else if($found12 == 0) {
        $res14qry=""; $result14="";
				$res14qry="INSERT INTO tblemppayroll SET employeeid=\"$emp_no11\", emp_salary=$emp_salary11, deduction=$deduction11, phil_ded=$phil_ded11, tax=$tax11, emp_over_duration=$emp_over_duration11, net_pay=$Net_Pay11, emp_date_wrk=$emp_date_wrk11, emp_sick=\"$emp_sick11\", emp_vacation=\"$emp_vacation11\", cut_start=\"$cut_start11\", cut_end=\"$cut_end11\", regholiday=$regHoliday11, speholiday=$speHoliday11, emp_late_duration=$emp_late_duration11, otsunday=$otSunday11, regholidayamt=$regHolidayamt11, speholidayamt=$SpeHolidayamt11, otsundayamt=$otSundayamt11, overamt=$overamt11, nightdiffminutes=$NigthDiffMinutes11, nightdiffamt=$NIgthDiffAmt11, totaltardy=$TotalTardy11, otherincome=$OtherIncome11, otherincometaxable=$OtherIncomeTaxable11, otherdeduction=$OtherDeduction11, emp_dep=\"$emp_dep11\", pagibig=$pagibig11, vlused=$VLused11, slused=$SLUsed11, philemp=$PHILEMP11, ss=$SS11, ec=$EC11, bracket=$bracket11, absentamt=$AbsentAmt11";
        $result14=$dbh2->query($res14qry);
				echo "<td><font color=\"green\">$emp_no11</td><td colspan=\"3\"></td>";
				echo "<td><font color=\"green\">inserted</font></td>";
			}
			echo "</tr>";
      } // while
    } // if
		echo "<tr><td colspan=\"35\">ok - eof - sample vs tblemppayroll</td><th>to</th><th colspan=\"4\"></th><th>end</th></tr>";
		echo "</table>";
		} // if($startsw == 1)

		if($startswadd == 1) {
		echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th colspan=\"5\">db24.add</th><th>to</th><th colspan=\"2\">tblemppayincomenontaxable</th><th>status</th></tr>";
		echo "<tr><th>ctr</th><th>empid</th><th>add_desc</th><th>duration</th><th>amount</th><th></th><th>id</th><th></th><th></th></tr>";
		$res21qry=""; $result21=""; $found21=0; $ctr21=0;
		$res21qry="SELECT emp_no, Add_desc, start, end, amount FROM `add` ORDER BY `start` ASC, `emp_no` ASC";
    $result21=$dbh24b->query($res21qry);
    if($result21->num_rows>0) {
      while($myrow21=$result21->fetch_assoc()) {
      $found21=1;
      $ctr21=$ctr21+1;
      $emp_no21 = trim($myrow21['emp_no']);
      $Add_desc21 = trim($myrow21['Add_desc']);
      $start21 = substr($myrow21['start'], 0, -9);
      $end21 = substr($myrow21['end'], 0, -9);
      $amount21 = number_format($myrow21['amount'], 2, '.', '');

			echo "<tr><tr><td>$ctr21</td><td>$emp_no21</td><td>$Add_desc21</td><td>$start21-to-$end21</td><td>$amount21</td><td></td>";

			$res22qry=""; $result22=""; $found22=0; $ctr22=0;
			$res22qry="SELECT employeeid, add_desc, start, end, amount FROM tblemppayincomenontaxable WHERE employeeid=\"$emp_no21\" AND add_desc=\"$Add_desc21\" AND start=\"$start21\" AND end=\"$end21\"";
      $result22=$dbh2->query($res22qry);
      if($result22->num_rows>0) {
        while($myrow22=$result22->fetch_assoc()) {
        $found22=1;
        $ctr22=$ctr22+1;
        $employeeid22 = $myrow22['employeeid'];
        $add_desc22 = $myrow22['add_desc'];
        $start22 = $myrow22['start'];
        $end22 = $myrow22['end'];
        $amount22 = $myrow22['amount'];
        } // while
      } // if

			if($found22 == 1) {
				echo "<td>$employeeid22</td><td>$amount22</td><td>record exists</td>";
			} else {
        $res23qry=""; $result23="";
				$res23qry="INSERT INTO tblemppayincomenontaxable SET employeeid=\"$emp_no21\", add_desc=\"$Add_desc21\", start=\"$start21\", end=\"$end21\", amount=$amount21";
        $result23=$dbh2->query($res23qry);
				// echo "<td>$emp_no21</td><td>$amount21</td><td><font color=\"green\">inserted</font></td>";
			}
			echo "</tr>";
      } // while
    } // if
		echo "<tr><th colspan=\"9\">ok - eof - add vs tblemppayincomenontaxable</th></tr>";
      echo "<tr><td colspan='5'>qry:$res21qry</td></tr>";

		echo "</table>";
		} // if($startswadd == 1)

		if($startswadd2 == 1) {
		echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th colspan=\"5\">db24.add2</th><th>to</th><th colspan=\"2\">tblemppayincometaxable</th><th>status</th></tr>";
		echo "<tr><th>ctr</th><th>empid</th><th>add2_desc</th><th>duration</th><th>amount</th><th></th><th>id</th><th></th><th></th></tr>";
		$res31qry=""; $result31=""; $found31=0; $ctr31=0;
		$res31qry="SELECT emp_no, Add_desc, start, end, amount FROM add2 ORDER BY start ASC, emp_no ASC";
    $result31=$dbh24b->query($res31qry);
    if($result31->num_rows>0) {
      while($myrow31=$result31->fetch_assoc()) {
      $found31=1;
      $ctr31=$ctr31+1;
      $emp_no31 = trim($myrow31['emp_no']);
      $Add_desc31 = trim($myrow31['Add_desc']);
      $start31 = substr($myrow31['start'], 0, -9);
      $end31 = substr($myrow31['end'], 0, -9);
      $amount31 = number_format($myrow31['amount'], 2, '.', '');

			echo "<tr><td>$ctr31</td><td>$emp_no31</td><td>$Add_desc31</td><td>$start31-to-$end31</td><td>$amount31</td>";

			$res32qry=""; $result32=""; $found32=0; $ctr32=0;
			$res32qry="SELECT employeeid, add_desc, start, end, amount FROM tblemppayincometaxable WHERE employeeid=\"$emp_no31\" AND add_desc=\"$Add_desc31\" AND start=\"$start31\" AND end=\"$end31\"";
      $result32=$dbh2->query($res32qry);
      if($result32->num_rows>0) {
        while($myrow32=$result32->fetch_assoc()) {
        $found32=1;
        $ctr32=$ctr32+1;
        $employeeid32 = $myrow32['employeeid'];
        $add_desc32 = $myrow32['add_desc'];
        $start32 = $myrow32['start'];
        $end32 = $myrow32['end'];
        $amount32 = $myrow32['amount'];
        } // while
      } // if

			if($found32 == 1) {
				echo "<td>$found32</td><td>$employeeid32</td><td>$amount32</td><td>record exists</td>";
			} else {
        $res33qry=""; $result33="";
				$res33qry="INSERT INTO tblemppayincometaxable SET employeeid=\"$emp_no31\", add_desc=\"$Add_desc31\", start=\"$start31\", end=\"$end31\", amount=$amount31";
        $result33=$dbh2->query($res33qry);
				echo "<td>$found32</td><td>$emp_no31</td><td>$amount31</td><td><font color=\"green\">inserted</font></td>";
			} // if($found32 == 1)
			echo "</tr>";
      } // while
    } // if
		echo "<tr><th colspan=\"9\">ok - eof - db24.add2 vs maindb.tblemppayincometaxable</th></tr>";
		echo "</table>";
		} // if($startswadd2 == 1)

		if($startswdeduct == 1) {
		echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th colspan=\"5\">db24.deduct</th><th>to</th><th colspan=\"2\">tblemppayotherdeductions</th><th>status</th></tr>";
		echo "<tr><th>ctr</th><th>empid</th><th>ded_desc</th><th>duration</th><th>amount</th><th></th><th>id</th><th></th><th></th></tr>";
		$res41qry=""; $result41=""; $found41=0; $ctr41=0;
		$res41qry="SELECT emp_no, ded_desc, start, end, amount, amountdeduct, balance FROM deduct ORDER BY start ASC, emp_no ASC";
    $result41=$dbh24b->query($res41qry);
    if($result41->num_rows>0) {
      while($myrow41=$result41->fetch_assoc()) {
      $found41=1;
      $ctr41=$ctr41+1;
      $emp_no41 = trim($myrow41['emp_no']);
      $ded_desc41 = trim($myrow41['ded_desc']);
      $start41 = substr($myrow41['start'], 0, -9);
      $end41 = substr($myrow41['end'], 0, -9);
      $amount41 = number_format($myrow41['amount'], 2, '.', '');
      $amountdeduct41 = number_format($myrow41['amountdeduct'], 2, '.', '');
      $balance41 = number_format($myrow41['balance'], 2, '.', '');

			echo "<tr><td>$ctr41</td><td>$emp_no41</td><td>$ded_desc41</td><td>$start41-to-$end41</td><td>$amount41 | $amountdeduct41 | $balance41</td><td></td>";

			$res42qry=""; $result42=""; $found42=0; $ctr42=0;
			$res42qry="SELECT employeeid, ded_desc, start, end, amount, amountdeduct, balance FROM tblemppayotherdeductions WHERE employeeid=\"$emp_no41\" AND ded_desc=\"$ded_desc41\" AND start=\"$start41\" AND end=\"$end41\"";
      $result42=$dbh2->query($res42qry);
      if($result42->num_rows>0) {
        while($myrow42=$result42->fetch_assoc()) {
        $found42=1;
        $ctr42=$ctr42+1;
        $employeeid42 = $myrow42['employeeid'];
        $ded_desc42 = $myrow42['ded_desc'];
        $start42 = $myrow42['start'];
        $end42 = $myrow42['end'];
        $amount42 = $myrow42['amount'];
        $amountdeduct42 = $myrow42['amountdeduct'];
        $balance42 = $myrow42['balance'];
        } // while
      } // if

			if($found42 == 1) {
				echo "<td>$employeeid42</td><td>$amount42 | $amountdeduct42 | $balance42</td><td>record exists</td>";
			} else {
        $res33qry=""; $result33="";
				$res33qry="INSERT INTO tblemppayotherdeductions SET employeeid=\"$emp_no41\", ded_desc=\"$ded_desc41\", start=\"$start41\", end=\"$end41\", amount=$amount41, amountdeduct=$amountdeduct41, balance=$balance41";
        $result33=$dbh2->query($res33qry);
				echo "<td>$emp_no41</td><td>$amount41 | $amountdeduct42 | $balance42</td><td><font color=\"green\">inserted</font></td>";
			} // if($found42 == 1)
			echo "</tr>";
      } // while
    } // if
		echo "<tr><th colspan=\"9\">ok - eof - deduct vs tblemppayotherdeductions</th></tr>";
		echo "</table>";
		} // if($startswdeduct == 1)

  } // if($accesslevel >= 4)

// end contents here...

// edit body-footer
     // echo "<p><a href=\"mngfinmods.php?loginid=$loginid\">Back</a></p>";
// display close window button
    echo "<button type=\"button\" class=\"btn btn-danger\"
        onclick=\"window.open('', '_self', ''); window.close();\">Close</button>";

     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

//     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
mysql_close($dbh24);
$dbh2->close();
$dbh24b->close();
?> 
