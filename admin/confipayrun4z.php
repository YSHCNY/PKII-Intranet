<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$groupname = $_GET['gn'];
$month = $_GET['cutmonth'];
$daystart = $_GET['cutdaystart'];
$dayend = $_GET['cutdayend'];
$year = $_GET['cutyear'];

$employeeid2 = $_POST['employeeid2'];
$daysabsent = $_POST['daysabsent'];

$monthfull = date("F",$month);
$cutstart = "$year-$month-$daystart";
$cutend = "$year-$month-$dayend";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
  echo "<html><head><STYLE TYPE=\"text/css\">";
  echo "<!--";
  echo "p{font-family: Helvetica; font-size: 10pt;}";
  echo "B{font-family: Helvetica; font-size: 10pt;}";
  echo "TD{font-family: Helvetica; font-size: 10pt;}";
  echo "--->";
  echo "</STYLE></head>";

  echo "<b>ConfiPayroll Process Results</b><br>";
  echo "Payroll group:<b>$groupname</b><br>";
  echo "Cutoff period:<b>$cutstart -to- $cutend</b><br><br>";

  $result = mysql_query("SELECT * FROM tblconfipaygrp WHERE groupname = \"$groupname\" AND employeeid <> \"\"", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {
    $found = 1;
    $confipaygrpid = $myrow[0];
    $employeeid = $myrow[1];
    $groupname = $myrow[2];
    $datecreated = $myrow[3];
    $accesslevel = $myrow[4];

    if ($found == 1);
    {
      $monthlysalary = 0;
      $netbasicpay = 0;
      $projallow = 0;
      $perdiem = 0;
      $transpoallow = 0;
      $otherincome = 0;
      $grosspay = 0;
      $totded = 0;
      $totover = 0;
      $wtax = 0;
//      $withholdingtax = 0;
//      $sssee = 0;
//      $ssser = 0;
//      $sssec = 0;
      $ssstotalec = 0;
      $ssstotal = 0;
//      $philhealthee = 0;
//      $philhealther = 0;
      $philhealthtotal = 0;
      $pagibigee = 0;
      $pagibiger = 0;
      $pagibigtotal = 0;
      $otherdeductions = 0;
      $totaldeductions = 0;
      $netpay = 0;

// ------------------------------------- //
// START GET daysabsent OF EACH EMPLOYEE

      $key2 = 0;
      $key2b = 0;
      $key = 0;
      $daysabsentval = 0;

      foreach($employeeid2 as $key2=>$value2)
      {
        if($value2 == $employeeid)
        {
          foreach($daysabsent as $key=>$value)
          {
            if($key == $key2)
            {
//              echo "test: count1:$key2 = count2:$key = empid:$value2 = daysabsent:$value<br>";
              $daysabsentval = $value;
            }
          }
        }
      }

// END GET daysabsent OF EACH EMPLOYEE
// ----------------------------------- //

      echo "<p><table border=1 spacing=1><tr><td><b><i>For EmpID:$employeeid</i></b><br>";

      $result2 = mysql_query("SELECT * FROM tblconfipaymeminfo WHERE employeeid = \"$employeeid\" AND status = \"active\" AND groupname = \"$groupname\"", $dbh);
      while ($myrow2 = mysql_fetch_row($result2))
      {
	$found2 = 1;
//	$confipaymemid = $myrow2[0];
//	$employeeid = $myrow2[1];
	$groupname = $myrow2[2];
	$netbasicpay = $myrow2[3];
	$projallow = $myrow2[4];
	$perdiem = $myrow2[5];
	$transpoallow = $myrow2[6];
	$wtaxstatus = $myrow2[7];
	$exemptstatus = $myrow2[8];
	$withholdingtax = $myrow2[9];
	$wtaxopt2 = $myrow2[10];
	$wtaxmode = $myrow2[11];
	$sssstatus = $myrow2[12];
	$sssee = $myrow2[13];
	$ssser = $myrow2[14];
	$sssec = $myrow2[15];
	$sssmode = $myrow2[16];
	$philhealthstatus = $myrow2[17];
	$philhealthee = $myrow2[18];
	$philhealther = $myrow2[19];
	$philhealthmode = $myrow2[20];
	$pagibigee = $myrow2[21];
	$pagibiger = $myrow2[22];
	$pagibigmode = $myrow2[23];
	$status = $myrow2[24];
	$dependent = $myrow2[25];

	$result30 = mysql_query("SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow30 = mysql_fetch_row($result30))
	{
	  $name_first = $myrow30[1];
	  $name_middle = $myrow30[2];
	  $name_last = $myrow30[3];
	}

// ----------------------- //
// START ADDITIONAL INCOME
				echo "<p><table border=1 spacing=1>";
				echo "<tr><td colspan=4 bgcolor=blue><font color=white><b>Additional Income</b></font></td></tr>";
				echo "<tr><td>EmpID</td><td>FullName</td><td>AdditionalIncome</td><td>Amount</td></tr>";

				$result3 = mysql_query("SELECT * FROM tblconfipaymemadd WHERE employeeid = \"$employeeid\" AND statusadd = \"active\" AND groupname = \"$groupname\"", $dbh);

				$otherincomenontaxable = 0;
				$otherincome = 0;

				while ($myrow3 = mysql_fetch_row($result3))
				{
					$found3 = 1;
					$confipayaddid = $myrow3[0];
//					$employeeid = $myrow3[1];
					$groupname = $myrow3[2];
					$nameadd = $myrow3[3];
//					$addtotalamount = $myrow3[4];
					$addamount = $myrow3[5];
//					$addbalamount = $myrow3[6];
					$startadd = $myrow3[7];
					$endadd = $myrow3[8];
					$nontaxable = $myrow3[9];
					$statusadd = $myrow3[10];

					if ($addamount <> 0)
					{

						if ($startadd >= $cutstart || $endadd <= $cutend)
						{

							if ($nontaxable == 'yes')
							{
								$otherincomenontaxable = $addamount + $otherincomenontaxable;
							}
							else
							{
								$otherincome = $addamount + $otherincome;
								$nontaxable = 'no';
							}
							$addamount_fmt = number_format($addamount, 2);
							echo "<tr><td>$employeeid</td><td>$name_last, $name_first $name_middle[0]</td><td>$nameadd</td><td align=right>$addamount</td></tr>";

							$result32 = mysql_query("INSERT INTO tblconfipayrolladd (employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable) VALUES ('$employeeid', '$groupname', '$cutstart', '$cutend', '$nameadd', $addamount, '$nontaxable')", $dbh);

						}
						else
						{
							$result33 = mysql_query("UPDATE tblconfipaymemadd SET addamount = 0 WHERE confipayaddid = $confipayaddid", $dbh);
						}

					}
					else
					{
						$result31 = mysql_query("UPDATE tblconfipaymemadd SET addamount = 0 WHERE confipayaddid = $confipayaddid", $dbh);
					}
				}

				if($projallow != 0)
				{
				  $otherincome = $projallow + $otherincome;
				  $projallow_fmt = number_format($projallow, 2);
				  echo "<tr><td>$employeeid</td><td>$name_last, $name_first $name_middle[0]</td><td>Project Allowance</td><td align=\"right\">$projallow_fmt</td></tr>";
				  $result34 = mysql_query("INSERT INTO tblconfipayrolladd (employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable) VALUES (\"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"Project Allowance\", $projallow, \"no\")", $dbh);
				}

				if($perdiem != 0)
				{
				  $perdiemtotal = (15-$daysabsentval) * $perdiem;
				  $otherincomenontaxable = $perdiemtotal + $otherincomenontaxable;
				  $perdiemtotal_fmt = number_format($perdiemtotal, 2);
				  echo "<tr><td>$employeeid</td><td>$name_last, $name_first $name_middle[0]</td><td>Per diem</td><td align=\"right\">$perdiemtotal_fmt</td></tr>";
				  $result35 = mysql_query("INSERT INTO tblconfipayrolladd (employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable) VALUES (\"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"Per diem\", $perdiemtotal, \"yes\")", $dbh);
				}

				if($transpoallow != 0)
				{
				  $transpoallowhalf = $transpoallow / 2;
				  $otherincomenontaxable = $transpoallowhalf + $otherincomenontaxable;
				  $transpoallowhalf_fmt = number_format($transpoallowhalf, 2);
				  echo "<tr><td>$employeeid</td><td>$name_last, $name_first $name_middle[0]</td><td>Transportaion Allowance</td><td align=\"right\">$transpoallowhalf_fmt</td></tr>";
				  $result35 = mysql_query("INSERT INTO tblconfipayrolladd (employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable) VALUES (\"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"Transportation Allowance\", $transpoallow/2, \"yes\")", $dbh);
				}

				echo "</table>";
// END ADDITIONAL INCOME
// --------------------- //

				$grosspay = $netbasicpay + $otherincome + $otherincomenontaxable;

// ---------------------- //
// START OTHER DEDUCTIONS
				$result4 = mysql_query("SELECT * FROM tblconfipaymemdeduct WHERE employeeid = \"$employeeid\" AND statusdeduct = \"active\" AND groupname = \"$groupname\"", $dbh);

				$otherdeductions = 0;

				echo "<p><table border=1 spacing=1>";
				echo "<tr><td colspan=4  bgcolor=blue><font color=white><b>Other Deductions</b></font></td></tr>";
				echo "<tr><td>EmpID</td><td>FullName</td><td>OtherDeductions</td><td>Amount</td></tr>";

				while ($myrow4 = mysql_fetch_row($result4))
				{
					$found4 = 1;
					$confipaydeductid = $myrow4[0];
//					$employeeid = $myrow4[1];
					$groupname = $myrow4[2];
					$namededuct = $myrow4[3];
					$deducttotalamount = $myrow4[4];
					$deductamount = $myrow4[5];
					$deductbalamount = $myrow4[6];
//					$startdeduct = $myrow4[7];
//					$enddeduct = $myrow4[8];
					$statusdeduct = $myrow4[9];

					if ($deductamount <> 0)
					{
						if ($deductbalamount < $deductamount)
						{
							$deductamount2 = $deductbalamount;
							$deductbalamount = $deductbalamount - $deductamount;
						}
						else
						{
							$deductbalamount = $deductbalamount - $deductamount;

							if ($deductbalamount <= $deductamount)
							{
								$deductamount2 = $deductbalamount;
							}
							else
							{
								$deductamount2 = $deductamount;
							}
						}

						$otherdeductions = $deductamount + $otherdeductions;

//						$result40 = mysql_query("SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);

//						while ($myrow40 = mysql_fetch_row($result40))
//						{
//							$name_first = $myrow40[1];
//							$name_middle = $myrow40[2];
//							$name_last = $myrow40[3];
//						}
						$deductamount_fmt = number_format($deductamount, 2);
						echo "<tr><td>$employeeid</td><td>$name_last, $name_first $name_middle[0]</td><td>$namededuct</td><td align=right>$deductamount_fmt</td></tr>";

						$result41 = mysql_query("UPDATE tblconfipaymemdeduct SET deductbalamount = $deductbalamount, deductamount = $deductamount2 WHERE confipaydeductid = $confipaydeductid", $dbh);


						$result42 = mysql_query("INSERT INTO tblconfipayrolldeduct (employeeid, groupname, cutstart, cutend, namededuct, deductamount) VALUES ('$employeeid', '$groupname', '$cutstart', '$cutend', '$namededuct', $deductamount)", $dbh);

					}
					else
					{
						$result41 = mysql_query("UPDATE tblconfipaymemdeduct SET deductbalamount = 0, deductamount = 0 WHERE confipaydeductid = $confipaydeductid", $dbh);
					}

				}
			if($daysabsentval != 0)
			{
			  $daysabsentamt = ($daysabsentval * ($netbasicpay / 15));
			  $otherdeductions = $daysabsentamt + $otherdeductions;
			  $daysabsentamt_fmt = number_format($daysabsentamt, 2);
			  echo "<tr><td>$employeeid</td><td>$name_last, $name_first $name_middle[0]</td><td>Absent: $daysabsentval day(s)</td><td align=right>$daysabsentamt_fmt</td></tr>";

			  $result43 = mysql_query("INSERT INTO tblconfipayrolldeduct (employeeid, groupname, cutstart, cutend, namededuct, deductamount) VALUES ('$employeeid', '$groupname', '$cutstart', '$cutend', \"Absent: $daysabsentval day(s)\", $daysabsentamt)", $dbh);
			}
			else
			{
			  $daysabsentamt = 0;
			}
				echo "</table>";

// END OTHER DEDUCTIONS
// -------------------- //

// ------------------------------ //
// START MAIN PAYROLL COMPUTATION
// ------------------------------ //

// --------------------------------- //
// start withholding tax computation
			if($wtaxmode == "auto")
			{
				$result51 = mysql_query("SELECT * FROM tblwtaxtablesm WHERE status = '$exemptstatus' AND mintax < $grosspay AND $grosspay < maxtax", $dbh);
				while ($myrow51 = mysql_fetch_row($result51))
				{
					$found51 = 1;
					$int = $myrow51[0];
					$mintax = $myrow51[1];
					$maxtax = $myrow51[2];
					$deduction = $myrow51[3];
					$over = $myrow51[4];
					$status = $myrow51[5];
					$exemption = $myrow51[6];
					$totaltax = $myrow51[7];
				}

				$totded = ($netbasicpay + $otherincome) - $deduction;
				$totover = $totded * $over;
				$wtax = $totover + $exemption;
			}
			else if($wtaxmode == "manual")
			{
				$wtax = $withholdingtax;
			}
			else if($wtaxmode == "percent")
			{
				$result54 = mysql_query("SELECT wtaxopt2 FROM tblconfipaymeminfo WHERE employeeid = \"$employeeid\" AND groupname = \"$groupname\"", $dbh);
				while($myrow54 = mysql_fetch_row($result54))
				{
				  $found54 = 1;
				  $wtaxopt2 = $myrow54[0];
				}
				$wtax = (($netbasicpay + $otherincome) * $wtaxopt2) / 100;
			}
// end withholding tax computation
// --------------------------------- //

				if ($daystart == 1 AND $dayend == 15)
				{
//					$totaldeductions = $wtax + $pagibigee + $otherdeductions;
					$totaldeductions = $wtax + $otherdeductions;
					$sssee = 0;
					$ssser = 0;
					$sssec = 0;
					$ssstotalec = 0;
					$ssstotal = 0;
					$philhealthee = 0;
					$philhealther = 0;
					$pagibigee = 0;
					$pagibiger = 0;
					$pagibigtotal = 0;
					$philhealthtotal = 0;
				}
				else
				{
					$monthlysalary = $netbasicpay * 2;

// --------------------- //
// start sss computation
			if($sssmode == "auto")
			{
				if ($sssstatus == 'on')
				{
					$result52 = mysql_query("SELECT * FROM tblssscontribution WHERE $monthlysalary > compfrom AND $monthlysalary < compto", $dbh);
					while ($myrow52 = mysql_fetch_row($result52))
					{
						$found52 = 1;
						$ssscontributionid = $myrow52[0];
						$compfrom = $myrow52[1];
						$compto = $myrow52[2];
						$salarycredit = $myrow52[3];
						$ssser = $myrow52[4];
						$sssee = $myrow52[5];
						$sstotal = $myrow52[6];
						$sssec = $myrow52[7];
						$tcer = $myrow52[8];
						$tcee = $myrow52[9];
						$ssstotalec = $myrow52[10];
						$ssstotal = $myrow52[11];
					}
				}
			}
			else if($sssmode == "manual")
			{
				$ssstotalec = $ssser + $sssec + $sssee;
				$ssstotal = $ssser + $sssee;
			}
			else if($sssmode == "off")
			{
			  $ssser = 0;
			  $sssec = 0;
			  $sssee = 0;
			  $ssstotalec = 0;
			  $ssstotal = 0;
			}
// end of sss computation
// ---------------------- //

// ---------------------------- //
// start philhealth computation

//					$monthlysalary = $netbasicpay * 2;
			if($philhealthmode == "auto")
			{
				if ($philhealthstatus == 'on')
				{
					$result53 = mysql_query("SELECT * FROM tblphilhealth WHERE $monthlysalary >= salarymin AND $monthlysalary <= salarymax", $dbh);
					while ($myrow53 = mysql_fetch_row($result53))
					{
						$found53 = 1;
						$salaryid = $myrow53[0];
						$salarymin = $myrow53[1];
						$salarymax = $myrow53[2];
						$salarybase = $myrow53[3];
						$philhealthtotal = $myrow53[4];
						$philhealther = $myrow53[5];
						$philhealthee = $myrow53[6];
					}
				}
			}
			else if($philhealthmode == "manual")
			{
				$philhealthtotal = $philhealther + $philhealthee;
			}
			else if($philhealthmode == "off")
			{
			  $philhealther = 0;
			  $philhealthee = 0;
			  $philhealthmode = 0;
			}
// end of philhealth computation
// ----------------------------- //

// ------------------------- //
// start pagibig computation
			if($pagibigmode == "manual")
			{
				$pagibigtotal = $pagibigee + $pagibiger;
			}
			else if($pagibigmode == "off")
			{
			  $pagibigee = 0;
			  $pagibiger = 0;
			  $pagibigtotal = 0;
			}
// end pagibig computation
// ----------------------- //

					$totaldeductions = $wtax + $sssee + $philhealthee + $pagibigee + $otherdeductions;

				}

				$netpay = $grosspay - $totaldeductions;

				echo "<p><table border=1 spacing=1>";
				echo "<tr><td colspan=14  bgcolor=blue><font color=white><b>Payroll Summary</b></font></td></tr>";
				echo "<tr><td>EmpID</td><td>FullName</td><td>NetBasicPay</td><td>Add'lIncome</td><td>NonTaxableIncome</td><td>GrossPay</td><td>Days Absent</td><td>WTax</td><td>SSS</td><td>Philhealth</td><td>PagIBIG</td><td>OtherDeductions</td><td>TotalDeductions</td><td><b>NetPay</b></td>";

				$netbasicpay_fmt = number_format($netbasicpay, 2);
				$otherincome_fmt = number_format($otherincome, 2);
				$otherincomenontaxable_fmt = number_format($otherincomenontaxable, 2);
				$grosspay_fmt = number_format($grosspay, 2);
				$daysabsentval_fmt = number_format($daysabsentval, 2);
				$wtax_fmt = number_format($wtax, 2);
				$sssee_fmt = number_format($sssee, 2);
				$philhealthee_fmt = number_format($philhealthee, 2);
				$pagibigee_fmt = number_format($pagibigee, 2);
				$otherdeductions_fmt = number_format($otherdeductions, 2);
				$totaldeductions_fmt = number_format($totaldeductions, 2);
				$netpay_fmt = number_format($netpay, 2);

				echo "<tr><td>$employeeid</td><td>$name_last, $name_first $name_middle</td><td align=right>$netbasicpay_fmt</td><td align=right>$otherincome_fmt</td><td align=right>$otherincomenontaxable_fmt</td><td align=right>$grosspay_fmt</td><td>$daysabsentval_fmt</td><td align=right>$wtax_fmt</td><td align=right>$sssee_fmt</td><td align=right>$philhealthee_fmt</td><td align=right>$pagibigee_fmt</td><td align=right>$otherdeductions_fmt</td><td align=right>$totaldeductions_fmt</td><td align=right><b>$netpay_fmt</b></td></tr>";

				echo "</table>";

				echo "</td></tr></table>";

				$result5 = mysql_query("INSERT INTO tblconfipayroll (employeeid, cutstart, cutend, groupname, accesslevel, netbasicpay, otherincome, otherincomenontaxable, grosspay, withholdingtax, sssee, ssser, sssec, ssstotalec, ssstotal, philhealthee, philhealther, philhealthtotal, pagibigee, pagibiger, pagibigtotal, otherdeductions, totaldeductions, netpay) VALUES ('$employeeid', '$cutstart', '$cutend', '$groupname', $accesslevel, $netbasicpay, $otherincome, $otherincomenontaxable, $grosspay, $wtax, $sssee, $ssser, $sssec, $ssstotalec, $ssstotal, $philhealthee, $philhealther, $philhealthtotal, $pagibigee, $pagibiger, $pagibigtotal, $otherdeductions, $totaldeductions, $netpay)", $dbh);

			}

			$totalnetbasic = $totalnetbasic + $netbasicpay;
			$totalincome = $totalincome + $otherincome;
			$totalincomenontax = $totalincomenontax + $otherincomenontaxable;
			$totalgross = $totalgross + $grosspay;
			$totalwtax = $totalwtax + $wtax;
			$totalsssee = $totalsssee + $sssee;
			$totalssser = $totalssser + $ssser;
			$totalsssec = $totalsssec + $ssstotalec;
			$totalsssecer = $totalsssecer + $sssec;
			$totalsss = $totalsss + $ssstotal;
			$totalphilhealthee = $totalphilhealthee + $philhealthee;
			$totalphilhealther = $totalphilhealther + $philhealther;
			$totalphilhealth = $totalphilhealth + $philhealthtotal;
			$totalpagibigee = $totalpagibigee + $pagibigee;
			$totalpagibiger = $totalpagibiger + $pagibiger;
			$totalpagibig = $totalpagibig + $pagibigtotal;
			$totalotherdeductions = $totalotherdeductions + $otherdeductions;
			$totaldeductions2 = $totaldeductions2 + $totaldeductions;
			$totalnetpay = $totalnetpay + $netpay;
		}

	}

	$datecreated = date("Y-m-d");

//	echo "vartest date:$datecreated totnetbasic:$totalnetbasic totincome:$totalincome totincnontax:$totalincomenontax totgross:$totalgross totwtax:$totalwtax totsssee:$totalsssee, totssser:$totalssser totsssec:$totalsssec totsss:$totalsss totphicee:$totalphilhealthee totphicer:$totalphilhealther totphic:$totalphilhealth totpagibigee:$totalpagibigee totpagibiger:$totalpagibiger totpagibig:$totalpagibig tototherded:$totalotherdeductions totded:$totaldeductions2 totnetpay:$totalnetpay<br>";

	$result6 = mysql_query("INSERT INTO tblconfipayrolltotal (datecreated, confipaygrpid, groupname, cutstart, cutend, totalnetbasic, totalincome, totalincomenontax, totalgross, totalwtax, totalsssee, totalssser, totalsssecer, totalsssec, totalsss, totalphilhealthee, totalphilhealther, totalphilhealth, totalpagibigee, totalpagibiger, totalpagibig, totalotherdeductions, totaldeductions, totalnetpay) VALUES ('$datecreated', $confipaygrpid, '$groupname', '$cutstart', '$cutend', $totalnetbasic, $totalincome, $totalincomenontax, $totalgross, $totalwtax, $totalsssee, $totalssser, $totalsssecer, $totalsssec, $totalsss, $totalphilhealthee, $totalphilhealther, $totalphilhealth, $totalpagibigee, $totalpagibiger, $totalpagibig, $totalotherdeductions, $totaldeductions2, $totalnetpay)", $dbh);

// ---------------------------- //
// END MAIN PAYROLL COMPUTATION
// ---------------------------- //

//	$result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid", $dbh); 

//	while ($myrow = mysql_fetch_row($result))
//	{
//		$found = 1;
//	}

//	echo "<p><a href=confipay2.php?loginid=$loginid>Back</a><br>";

	echo "</html>";
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 