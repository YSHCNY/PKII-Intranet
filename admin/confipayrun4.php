<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$radiochecked = (isset($_GET['rs'])) ? $_GET['rs'] :'';
$groupname = (isset($_POST['gn'])) ? $_POST['gn'] :'';

if($radiochecked=="cutoff") {

$cutstart = (isset($_POST['cutstart'])) ? date("Y-m-d", strtotime($_POST['cutstart'])) :'';
$cutend = (isset($_POST['cutend'])) ? date("Y-m-d", strtotime($_POST['cutend'])) :'';

$daystart=date("d", strtotime($cutstart));
$dayend=date("d", strtotime($cutend));

$employeeid2 = (isset($_POST['employeeid2'])) ? $_POST['employeeid2'] :'';
$daysabsent = (isset($_POST['daysabsent'])) ? $_POST['daysabsent'] :'';

} else if($radiochecked=="onetime") {

$nameotp = (isset($_POST['nameotp'])) ? $_POST['nameotp'] :'';
$dateotp = (isset($_POST['dateotp'])) ? $_POST['dateotp'] :'';
$employeeid21 = (isset($_POST['employeeid21'])) ? $_POST['employeeid21'] :'';
$amountotp = (isset($_POST['amountotp'])) ? $_POST['amountotp'] :'';
$wtax = (isset($_POST['wtax'])) ? $_POST['wtax'] :'';
$otherded = (isset($_POST['otherded'])) ? $_POST['otherded'] :'';
$totaldeductions = (isset($_POST['totaldeductions'])) ? $_POST['totaldeductions'] :'';
$netpay = (isset($_POST['netpay'])) ? $_POST['netpay'] :'';
$netbasicpay2 = (isset($_POST['netbasicpay2'])) ? $_POST['netpasicpay2'] :'';
// $grosspay = (isset($_POST['grosspay'])) ? $_POST['grosspay'] :'';
$netbasicpay=$amountotp;
$netbasicpay2=$netbasicpay;
$otherdeductions=$otherded;

} // if($radiochecked=="onetime")

// echo "<p>vartest rs:$radiochecked gn:$groupname dt:$cutstart,$cutend,$dateotp eid:$employeeid21 amt:$amountotp net:$netpay</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
?>
	<html><head><STYLE TYPE="text/css">
	<!--
		Table {
			background:#D3E4E5;
			border:1px solid gray;
			border-collapse:collapse;
			font:normal 12px verdana, arial, helvetica, sans-serif;
		}
		TH {
			font-family: Helvetica; font-size: 10pt; font-weight: bold;
		}
	  TD {
	    font-family: Helvetica; font-size: 10pt
	  }
	  body {
	    font-family: Helvetica; font-size: 10pt
	  }
	  h1 {
	    font-size: 120%
	  }
	  h2 {
	    font-size: 100%
	  }
	  a {
	    text-decoration: none
	  }
	  p {
	    font-family: Helvetica; font-size: 10pt
	  }
	--->
	</STYLE></head>
	<body>
<?php

	// query accesslevel
	$res11query="SELECT accesslevel FROM tblconfipaygrp WHERE groupname=\"$groupname\"";
	$result11=""; $found11=0; $ctr11=0;
	/*
	$result11 = mysql_query("$res11query", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
	*/
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$confiaccesslevel11 = $myrow11['accesslevel'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

//
//
// check pay type if cutoff or onetime
if($radiochecked=="cutoff") {

	// start payroll result
  echo "<b>Custom Payroll Process Result</b><br>";
  echo "Payroll group:<b>";
	if($confiaccesslevel11==5 && $accesslevel==5) {
	include("mcryptdec.php");
	echo "$groupname";
	include("mcryptenc.php");
	} else if($confiaccesslevel11<=4) {
	echo "$groupname";
	} // if($confiaccesslevel11==5 && $accesslevel==5)
	echo "</b><br>";
  echo "Cutoff period:<b>$cutstart -to- $cutend</b><br><br>";

	$resquery="SELECT confipaygrpid, employeeid, datecreated, accesslevel FROM tblconfipaygrp WHERE groupname=\"$groupname\" AND employeeid<>'' ORDER BY employeeid ASC";
	$result = $dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow = $result->fetch_assoc()) {
    $found = 1;
    $confipaygrpid = $myrow['confipaygrpid'];
    $employeeid = $myrow['employeeid'];
    $datecreated = $myrow['datecreated'];
    $accesslevel = $myrow['accesslevel'];

    if ($found == 1) {
      $monthlysalary = 0;
      $netbasicpay = 0;
      $daysabsentamt = 0;
      $netbasicpay2 = 0;
      $vatstatus = "";
      $vatrate = 0;
      $netofvat = 0;
      $projallow = 0;
      $projallowrate = 0;
      $projallowvalue = 0;
      $projallowfin = 0;
      $perdiem = 0;
      $perdiemrate = 0;
      $perdiemvalue = 0;
      $perdiemtotal = 0;
      $transpoallow = 0;
      $transpoallowrate = 0;
      $transpoallowvalue = 0;
      $transpoallowtotal = 0;
      $otherincome = 0;
      $otherincvatrate = 0;
      $otherincnetofvat = 0;
      $addincomevatinclval = 0;
      $$addincomevatinclvaltot = 0;
      $otherincomenontaxable = 0;
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

      foreach($employeeid2 as $key2=>$value2) {
        // echo "<p>vartest absent for eid:$employeeid ";
        // echo "count1:$key2>$value2, ";
        if($value2 == $employeeid) {
          // echo "empid:$value2=$employeeid, ";
          foreach($daysabsent as $key=>$value) {
            // echo "count2:$key>$value, ";
            if($key == $key2) {
              $daysabsentval = $value;
              // echo "absent:$value=$daysabsentval";
            } // if($key == $key2)
          } // foreach($daysabsent as $key->$value)
        } // if($value2 == $employeeid)
        // echo "</p>";
      } // foreach($employeeid2 as $key2=>$value2)

// END GET daysabsent OF EACH EMPLOYEE
// ----------------------------------- //

			/*
      $result2 = mysql_query("", $dbh);
      while ($myrow2 = mysql_fetch_row($result2)) {
			*/
			$res2query="SELECT confipaymemid, netbasicpay, projallow, perdiem, transpoallow, vatstatus, wtaxstatus, exemptstatus, withholdingtax, wtaxopt2, wtaxmode, sssstatus, sssee, ssser, sssec, sssmode, philhealthstatus, philhealthee, philhealther, philhealthmode, pagibigee, pagibiger, pagibigmode, empstatus, dependent, confipaygrpid, empalias, pagibigee2, pagibiger2, pagibigman1, pagibigman2 FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND empstatus=\"active\" AND groupname=\"$groupname\"";
			$result2=""; $found2=0; $ctr2=0;
			$result2 = $dbh2->query($res2query);
			if($result2->num_rows>0) {
				while($myrow2 = $result2->fetch_assoc()) {
	$found2 = 1;
	$confipaymemid = $myrow2['confipaymemid'];
	$netbasicpay = $myrow2['netbasicpay'];
	$projallow = $myrow2['projallow'];
	$perdiem = $myrow2['perdiem'];
	$transpoallow = $myrow2['transpoallow'];
	$vatstatus = $myrow2['vatstatus'];
	$wtaxstatus = $myrow2['wtaxstatus'];
	$exemptstatus = $myrow2['exemptstatus'];
	$withholdingtax = $myrow2['withholdingtax'];
	$wtaxopt2 = $myrow2['wtaxopt2'];
	$wtaxmode = $myrow2['wtaxmode'];
	$sssstatus = $myrow2['sssstatus'];
	$sssee = $myrow2['sssee'];
	$ssser = $myrow2['ssser'];
	$sssec = $myrow2['sssec'];
	$sssmode = $myrow2['sssmode'];
	$philhealthstatus = $myrow2['philhealthstatus'];
	$philhealthee = $myrow2['philhealthee'];
	$philhealther = $myrow2['philhealther'];
	$philhealthmode = $myrow2['philhealthmode'];
	$pagibigee = $myrow2['pagibigee'];
	$pagibiger = $myrow2['pagibiger'];
	$pagibigmode = $myrow2['pagibigmode'];
	$empstatus = $myrow2['empstatus'];
	$dependent = $myrow2['dependent'];
	$confipaygrpid = $myrow2['confipaygrpid'];
	$empalias = $myrow2['empalias'];
	$pagibigee2 = $myrow2['pagibigee2'];
	$pagibiger2 = $myrow2['pagibiger2'];
	$pagibigman1 = $myrow2['pagibigman1'];
	$pagibigman2 = $myrow2['pagibigman2'];

	if($confiaccesslevel11==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1=$employeeid;
	include("mcryptenc.php");
	} else if($confiaccesslevel11<=4) {
	$empid1=$employeeid;
	} // if($confiaccesslevel11==5 && $accesslevel==5)
	$res30query="SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\"";
	$result30=""; $found30=0; $ctr30=0;
	$result30 = $dbh2->query($res30query);
	if($result30->num_rows>0) {
		while($myrow30 = $result30->fetch_assoc()) {
	  $name_first = $myrow30['name_first'];
	  $name_middle = $myrow30['name_middle'];
	  $name_last = $myrow30['name_last'];
		} // while($myrow30 = $result30->fetch_assoc())
	} // if($result30->num_rows>0)

  echo "<p><table class=\"fin\" border=1 spacing=1><tr><th align=\"left\">For EmpID:";
	if($confiaccesslevel11==5 && $accesslevel==5) {
		include("mcryptdec.php");
		if($empalias!="") {
			echo "***";
		} else {
			echo "$employeeid";
		} // if($empalias!="")
		include("mcryptenc.php");
	} else if($confiaccesslevel11<=4) {
		echo "$employeeid";
	} // if($confiaccesslevel11==5 && $accesslevel==5)
	echo "</th></tr></table></p>";

// ----------------------- //
// START ADDITIONAL INCOME
				echo "<p><table class=\"fin\" border=1 spacing=1>";
				echo "<tr><th colspan=4 align=\"left\">Additional Income</th></tr>";
				echo "<tr><td>EmpID</td><td>FullName</td><td>AdditionalIncome</td><td>Amount</td></tr>";

				$otherincomenontaxable = 0;
				$otherincome = 0;
				$addincomevatinclval = 0;
				$addincomevatinclvaltot = 0;

				$res3query="SELECT confipayaddid, nameadd, addtotalamount, addamount, addbalamount, startadd, endadd, nontaxable, statusadd, addincomevatincl, confipaygrpid FROM tblconfipaymemadd WHERE employeeid=\"$employeeid\" AND statusadd=\"active\" AND groupname=\"$groupname\"";
				$result3=""; $found3=0; $ctr3=0;
				$result3 = $dbh2->query($res3query);
				if($result3->num_rows>0) {
					while($myrow3 = $result3->fetch_assoc()) {
				$found3 = 1;
				$confipayaddid = $myrow3['confipayaddid'];
				$nameadd = $myrow3['nameadd'];
				$addtotalamount = $myrow3['addtotalamount'];
				$addamount = $myrow3['addamount'];
				$addbalamount = $myrow3['addbalamount'];
				$startadd = $myrow3['startadd'];
				$endadd = $myrow3['endadd'];
				$nontaxable = $myrow3['nontaxable'];
				$statusadd = $myrow3['statusadd'];
				$addincomevatincl = $myrow3['addincomevatincl'];
				$confipaygrpid = $myrow3['confipaygrpid'];

				
					if ($addamount <> 0) {
				// echo "<tr><td colspan=\"2\">vartest absent:$daysabsentval, addl_income amt:$addamount";

						if ($cutstart >= $startadd && $cutend <= $endadd) {
				// echo "<td colspan=\"2\">cut:$startadd=$cutstart -to- $endadd=$cutend</td>";

							if ($nontaxable == 'yes') {
								$otherincomenontaxable = $addamount + $otherincomenontaxable;
							} else {
								$otherincome = $addamount + $otherincome;
								$nontaxable = 'no';
								if($addincomevatincl == "yes") { $addincomevatinclval = $addamount; }
								else { $addincomevatinclval = 0; }
								$addincomevatinclvaltot = $addincomevatinclvaltot + $addincomevatinclval;
							} // if ($nontaxable == 'yes')
							$addamount_fmt = round($addamount, 2);
							echo "<tr>";
							if($confiaccesslevel11==5 && $accesslevel==5) {
							include("mcryptdec.php");
							if($empalias!="") {
								echo "<td>***</td>";
								echo "<td>$empalias</td>";
							} else {
								echo "<td>$employeeid</td>";
								echo "<td>$name_last, $name_first $name_middle[0]</td>";
							} // if($empalias!="")
							include("mcryptenc.php");
							} else if($confiaccesslevel11<=4) {
							echo "<td>$employeeid</td>";
							echo "<td>$name_last, $name_first $name_middle[0]</td>";
							} // if($confiaccesslevel11==5 && $accesslevel==5)
							echo "<td>$nameadd</td><td align=right>$addamount</td></tr>";

							$res32query="INSERT INTO tblconfipayrolladd (timestamp, loginid, employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"$nameadd\", $addamount, \"$nontaxable\", $confipaygrpid)";
							$result32 = $dbh2->query($res32query);

							$addincomevatinclval = 0;
						} // if ($cutstart >= $startadd && $cutend <= $endadd)

				// echo "</tr>";
					} // if ($addamount <> 0)

					} // while($myrow3 = $result3->fetch_assoc())
				} // if($result3->num_rows>0)

				if($projallow != 0) {
				  $projallowrate = $projallow / 15;
				  $projallowvalue = $projallowrate * $daysabsentval;
				  $projallowtotal = $projallow - $projallowvalue;
				  $otherincome = $otherincome + $projallowtotal;
				  $projallowtotal_fmt = round($projallowtotal, 2);

				  echo "<tr>";

					if($confiaccesslevel11==5 && $accesslevel==5) {
					include("mcryptdec.php");
					if($empalias!="") {
						echo "<td>***</td>";
						echo "<td>$empalias</td>";
					} else {
						echo "<td>$employeeid</td>";
						echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($empalias!="")
					include("mcryptenc.php");
					} else if($confiaccesslevel11<=4) {
					echo "<td>$employeeid</td>";
					echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($confiaccesslevel11==5 && $accesslevel==5)

					echo "<td>Project Allowance</td><td align=\"right\">$projallowtotal_fmt</td></tr>";

					$res34query="INSERT INTO tblconfipayrolladd (timestamp, loginid, employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"Project Allowance\", $projallowtotal, \"no\", $confipaygrpid)";
					$result34 = $dbh2->query($res34query);
				} // if($projallow != 0)

				if($perdiem != 0) {
				  $perdiemrate = $perdiem / 15;
				  $perdiemvalue = $perdiemrate * $daysabsentval;
				  $perdiemtotal = $perdiem - $perdiemvalue;
				  $otherincomenontaxable = $perdiemtotal + $otherincomenontaxable;
				  $perdiemtotal_fmt = round($perdiemtotal, 2);

				  echo "<tr>";

					if($confiaccesslevel11==5 && $accesslevel==5) {
					include("mcryptdec.php");
					if($empalias!="") {
						echo "<td>***</td>";
						echo "<td>$empalias</td>";
					} else {
						echo "<td>$employeeid</td>";
						echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($empalias!="")
					include("mcryptenc.php");
					} else if($confiaccesslevel11<=4) {
					echo "<td>$employeeid</td>";
					echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($confiaccesslevel11==5 && $accesslevel==5)

					echo "<td>Per diem</td><td align=\"right\">$perdiemtotal_fmt</td></tr>";

					$res35query="INSERT INTO tblconfipayrolladd (timestamp, loginid, employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"Per diem\", $perdiemtotal, \"yes\", $confipaygrpid)";
					$result35 = $dbh2->query($res35query);
				} // if($perdiem != 0)

				if($transpoallow != 0) {
				  $transpoallowrate = $transpoallow / 15;
				  $transpoallowvalue = $transpoallowrate * $daysabsentval;
				  $transpoallowtotal = $transpoallow - $transpoallowvalue;
				  $otherincomenontaxable = $transpoallowtotal + $otherincomenontaxable;
				  $transpoallowtotal_fmt = round($transpoallowtotal, 2);

				  echo "<tr>";

					if($confiaccesslevel11==5 && $accesslevel==5) {
					include("mcryptdec.php");
					if($empalias!="") {
						echo "<td>***</td>";
						echo "<td>$empalias</td>";
					} else {
						echo "<td>$employeeid</td>";
						echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($empalias!="")
					include("mcryptenc.php");
					} else if($confiaccesslevel11<=4) {
					echo "<td>$employeeid</td>";
					echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($confiaccesslevel11==5 && $accesslevel==5)

					echo "<td>Transportaion Allowance</td><td align=\"right\">$transpoallowtotal_fmt</td></tr>";

					$res35query="INSERT INTO tblconfipayrolladd (timestamp, loginid, employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"Transportation Allowance\", $transpoallowtotal, \"yes\", $confipaygrpid)";
					$result35 = $dbh2->query($res35query);
				} // if($transpoallow != 0)

				echo "</table>";
// END ADDITIONAL INCOME
// --------------------- //

// ---------------------- //
// START OTHER DEDUCTIONS
				$otherdeductions = 0;

				echo "<p><table class=\"fin\" border=1 spacing=1>";
				echo "<tr><th colspan=\"5\" align=\"left\">Other Deductions</th></tr>";
				echo "<tr><td>EmpID</td><td>FullName</td><td>OtherDeductions</td><td>Amount</td><td>Tax</td></tr>";

				$res4query="SELECT confipaydeductid, namededuct, deducttotalamount, deductamount, deductbalamount, startdeduct, enddeduct, statusdeduct, confipaygrpid FROM tblconfipaymemdeduct WHERE employeeid=\"$employeeid\" AND statusdeduct=\"active\" AND groupname=\"$groupname\"";
				$result4=""; $found4=0; $ctr4=0;
				$result4 = $dbh2->query($res4query);
				if($result4->num_rows>0) {
					while($myrow4 = $result4->fetch_assoc()) {
					$found4 = 1;
					$confipaydeductid = $myrow4['confipaydeductid'];
					$namededuct = $myrow4['namededuct'];
					$deducttotalamount = $myrow4['deductotalamount'];
					$deductamount = $myrow4['deductamount'];
					$deductbalamount = $myrow4['deductbalamount'];
					$startdeduct = $myrow4['startdeduct'];
					$enddeduct = $myrow4['enddeduct'];
					$statusdeduct = $myrow4['statusdeduct'];
					$confipaygrpid = $myrow4['confipaygrpid'];

					if ($deductamount <> 0) {
						// if($deducttaxable == "yes")
						// {
						  if($wtaxmode == "percent") {
								$res55query="SELECT wtaxopt2 FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\"";
								$result55=""; $found55=0; $ctr55=0;
								$result55 = $dbh2->query($res55query);
								if($result55->num_rows>0) {
									while($myrow55 = $result55->fetch_assoc()) {
						      $found55 = 1;
						      $wtaxopt2 = $myrow55['wtaxopt'];
							    } // while($myrow55 = $result55->fetch_assoc())
								} // if($result55->num_rows>0)
						    $deducttaxval = $deductamount * $wtaxopt2;
						    $deductamount = $deductamount + $deducttaxval;
						  } // if($wtaxmode == "percent")
						// }

						if ($deductbalamount < $deductamount) {
							$deductamount2 = $deductbalamount;
							$deductbalamount = $deductbalamount - $deductamount;
						} else {
							$deductbalamount = $deductbalamount - $deductamount;

							if ($deductbalamount <= $deductamount) {
								$deductamount2 = $deductbalamount;
							} else {
								$deductamount2 = $deductamount;
							} // if ($deductbalamount <= $deductamount)
						} // if ($deductbalamount < $deductamount)

						$otherdeductions = $deductamount + $otherdeductions;

						$deductamount_fmt = round($deductamount, 2);
						$deducttaxval_fmt = round($deducttaxval, 2);
						$deductbalamount_fmt = round($deductbalamount, 2);
						$deductamount2_fmt = round($deductamount2, 2);

				  echo "<tr>";

					if($confiaccesslevel11==5 && $accesslevel==5) {
						include("mcryptdec.php");
						if($empalias!="") {
							echo "<td>***</td>";
							echo "<td>$empalias</td>";
						} else {
							echo "<td>$employeeid</td>";
							echo "<td>$name_last, $name_first $name_middle[0]</td>";
						}
						include("mcryptenc.php");
					} else if($confiaccesslevel11<=4) {
						echo "<td>$employeeid</td>";
						echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($confiaccesslevel11==5 && $accesslevel==5)

						echo "<td>$namededuct</td><td align=right>$deductamount_fmt</td><td align=\"right\"></td></tr>";

						$res41query="UPDATE tblconfipaymemdeduct SET timestamp=\"$now\", loginid=$loginid, deductbalamount=$deductbalamount, deductamount=$deductamount2, confipaygrpid=$confipaygrpid WHERE confipaydeductid=$confipaydeductid";
						$result41 = $dbh2->query($res41query);

						$res42query="INSERT INTO tblconfipayrolldeduct (timestamp, loginid, employeeid, groupname, cutstart, cutend, namededuct, deductamount, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"$namededuct\", $deductamount, $confipaygrpid)";
						$result42 = $dbh2->query($res42query);

					} else {

						$res41query="UPDATE tblconfipaymemdeduct SET timestamp=\"$now\", loginid=$loginid, deductbalamount=0, deductamount=0, confipaygrpid=$confipaygrpid WHERE confipaydeductid=$confipaydeductid";
						$result41 = $dbh2->query($res41query);

					} // if ($deductamount <> 0)

					} // while($myrow4 = $result4->fetch_assoc())
				} // if($result4->num_rows>0)

	if($daysabsentval != 0) {
//	  $daysabsentamt = ($daysabsentval * ($netbasicpay / 15));
	  $daysabsentamt = ($netbasicpay / 15) * (15 - (15 - $daysabsentval));
	  $netbasicpay2 = $netbasicpay - $daysabsentamt;
	  $daysabsentamt_fmt = round($daysabsentamt, 2);

				  echo "<tr>";

					if($confiaccesslevel11==5 && $accesslevel==5) {
						include("mcryptdec.php");
						if($empalias!="") {
							echo "<td>***</td>";
							echo "<td>$empalias</td>";
						} else {
							echo "<td>$employeeid</td>";
							echo "<td>$name_last, $name_first $name_middle[0]</td>";
						}
						include("mcryptenc.php");
					} else if($confiaccesslevel11<=4) {
						echo "<td>$employeeid</td>";
						echo "<td>$name_last, $name_first $name_middle[0]</td>";
					}

		echo "<td>Absent: $daysabsentval day(s)</td><td align=right>$daysabsentamt</td><td>&nbsp;</td></tr>";

		// sql query below should be disabled, values exists in tblconfipayroll
	  // $result43 = mysql_query("INSERT INTO tblconfipayrolldeduct (timestamp, loginid, employeeid, groupname, cutstart, cutend, namededuct, deductamount, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", \"$cutstart\", \"$cutend\", \"Absent: $daysabsentval day(s)\", $daysabsentamt, $confipaygrpid)", $dbh);

	} else {

	  $daysabsentamt = 0;
	  $netbasicpay2 = $netbasicpay;

	} // if($daysabsentval != 0)

				echo "</table>";
// END OTHER DEDUCTIONS
// -------------------- //


// ------------------------------- //
// Start Current Projects Involved //
  $found7 = 0;

  echo "<p><table border=\"1\" spacing=\"0\">";
  echo "<tr><th colspan=\"7\" align=\"left\">Current Projects</th></tr>";
  echo "<tr><td>empid</td><td>name</td><td>projname</td><td>position</td><td>man-months or lumpsum</td><td>amount</td><td>details</td></tr>";

	$res7query="SELECT confipaymemprojid, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2, manmonths, manmonthscurr, manmonthsreq, manmonthsbal, lumpsum, lumpsumcurr, lumpsumreq, lumpsumbal, amount, current, requested, balance, details FROM tblconfipaymemproj WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\"";
	$result7=""; $found7=0; $ctr7=0;
	$result7 = $dbh2->query($res7query);
	if($result7->num_rows>0) {
		while($myrow7 = $result7->fetch_assoc()) {
    $found7 = 1;
    $confipaymemprojid7 = $myrow7['confipaymemprojid'];
    $proj_code7 = $myrow7['proj_code'];
    $proj_name7 = $myrow7['proj_name'];
    $position7 = $myrow7['position'];
    $durationfrom7 = $myrow7['durationfrom'];
    $durationto7 = $myrow7['durationto'];
    $durationfrom27 = $myrow7['durationfrom2'];
    $durationto27 = $myrow7['durationto2'];
    $manmonths7 = $myrow7['manmonths'];
    $manmonthscurr7 = $myrow7['manmonthscurr'];
    $manmonthsreq7 = $myrow7['manmonthsreq'];
    $manmonthsbal7 = $myrow7['manmonthsbal'];
    $lumpsum7 = $myrow7['lumpsum'];
    $lumpsumcurr7 = $myrow7['lumpsumcurr'];
    $lumpsumreq7 = $myrow7['lumpsumreq'];
    $lumpsumbal7 = $myrow7['lumsumbal'];
    $amount7 = $myrow7['amount'];
    $current7 = $myrow7['current'];
    $requested7 = $myrow7['requested'];
    $balance7 = $myrow7['balance'];
    $details7 = $myrow7['details'];

				  echo "<tr>";

					if($confiaccesslevel11==5 && $accesslevel==5) {
						include("mcryptdec.php");
						if($empalias!="") {
							echo "<td>***</td>";
							echo "<td>$empalias</td>";
						} else {
							echo "<td>$employeeid</td>";
							echo "<td>$name_last, $name_first $name_middle[0]</td>";
						} // if($empalias!="")
						include("mcryptenc.php");
					} else if($confiaccesslevel11<=4) {
						echo "<td>$employeeid</td>";
						echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($confiaccesslevel11==5 && $accesslevel==5)

    echo "<td>$proj_code7 $proj_name7</td><td>$position7</td>";

    if($manmonthsreq7 != 0 && $manmonthsbal7 != 0 && $requested7 != 0 && $balance7 != 0) {
      $manmonthscurr = $manmonthscurr7 + $manmonthsreq7;
      $manmonthsbal = $manmonthsbal7 - $manmonthsreq7;
      $current = $current7 + $requested7;
      $balance = $balance7 - $requested7;
      echo "<td>$manmonthsreq7</td><td>$requested7</td>";

			$res8query="INSERT INTO tblconfipayrollproj SET timestamp=\"$now\", loginid=$loginid, employeeid=\"$employeeid\", groupname=\"$groupname\", cutstart=\"$cutstart\", cutend=\"$cutend\", proj_code=\"$proj_code7\", proj_name=\"$proj_name7\", position=\"$position7\", durationfrom=\"$durationfrom7\", durationto=\"$durationto7\", durationfrom2=\"$durationfrom27\", durationto2=\"$durationto27\", manmonths=$manmonths, manmonthscurr=$manmonthscurr, manmonthsreq=$manmonthsreq7, manmonthsbal=$manmonthsbal, amount=$amount7, current=$current, requested=$requested7, balance=$balance, details=\"$details7\", confipaygrpid=$confipaygrpid";
			$result8 = $dbh2->query($res8query);

			$res81query="UPDATE tblconfipaymemproj SET timestamp=\"$now\", loginid=$loginid, manmonthscurr=$manmonthscurr, manmonthsbal=$manmonthsbal, current=$current, balance=$balance, confipaygrpid=$confipaygrpid WHERE confipaymemprojid=$confipaymemprojid7 AND employeeid=\"$employeeid\" AND groupname=\"$groupname\"";
			$result81 = $dbh2->query($res81query);

    } else if($lumpsumreq7 != 0 && $lumpsumbal7 != 0 && $requested7 != 0 && $balance7 != 0) {
      $lumpsumcurr = $lumpsumcurr7 + $lumpsumreq7;
      $lumpsumbal = $lumpsumbal7 - $lumpsumreq7;
      $current = $current7 + $requested7;
      $balance = $balance7 - $requested7;
      echo "<td>$lumpsumreq7</td><td>$requested7</td>";

			$res8query="INSERT INTO tblconfipayrollproj SET timestamp=\"$now\", loginid=$loginid, employeeid=\"$employeeid\", groupname=\"$groupname\", cutstart=\"$cutstart\", cutend=\"$cutend\", proj_code=\"$proj_code7\", proj_name=\"$proj_name7\", position=\"$position7\", durationfrom=\"$durationfrom7\", durationto=\"$durationto7\", durationfrom2=\"$durationfrom27\", durationto2=\"$durationto27\", lumpsum=$lumpsum7, lumpsumcurr=$lumpsumcurr, lumpsumreq=$lumpsumreq7, lumpsumbal=$lumpsumbal, amount=$amount7, current=$current, requested=$requested7, balance=$balance, details=\"$details7\", confipaygrpid=$confipaygrpid";
			$result8 = $dbh2->query($res8query);

			$res81query="UPDATE tblconfipaymemproj SET timestamp=\"$now\", loginid=$loginid, lumpsumcurr=$lumpsumcurr, lumpsumbal=$lumpsumbal, current=$current, balance=$balance, confipaygrpid=$confipaygrpid WHERE confipaymemprojid=$confipaymemprojid7 AND employeeid=\"$employeeid\" AND groupname=\"$groupname\"";
			$result81 = $dbh2->query($res81query);
    } // if($manmonthsreq7 != 0 && $manmonthsbal7 != 0 && $requested7 != 0 && $balance7 != 0)

    echo "<td>$details7</td></tr>";

	  } // while($myrow7 = $result7->fetch_assoc())
	} // if($result7->num_rows>0)
  echo "</table>";

// End Current Projects Involved   //
// ------------------------------- //


// ------------------------------ //
// START MAIN PAYROLL COMPUTATION
// ------------------------------ //

	if($vatstatus == "on") {
	  $vatrate = $netbasicpay2 / 9.3333;
	  $netofvat = $netbasicpay2 - $vatrate;
	  $grosspay = $netbasicpay2 + $otherincome + $otherincomenontaxable;

	  if($addincomevatincl == "yes") {
	    $otherincvatrate = $addincomevatinclvaltot / 9.3333;
	    $otherincnetofvat = $addincomevatinclvaltot - $otherincvatrate;
	  } else {
	    $otherincvatrate = 0;
	    $otherincnetofvat = 0;
	  } // if($addincomevatincl == "yes")
	} else {
	  $vatrate = 0;
	  $netofvat = 0;
	  $grosspay = $netbasicpay2 + $otherincome + $otherincomenontaxable;
	} // if($vatstatus == "on")

// --------------------------------- //
// start withholding tax computation
			if($wtaxmode == "auto") {
				/*
				$res51query="SELECT * FROM tblwtaxtablesm WHERE status=\"$exemptstatus\" AND mintax<$grosspay AND $grosspay<maxtax";
				$result51=""; $found51=0; $ctr51=0;
				$result51 = $dbh2->query($res51query);
				if($result51->num_rows>0) {
					while($myrow51 = $result51->fetch_assoc()) {
					$found51 = 1;
					$int = $myrow51['int'];
					$mintax = $myrow51['mintax'];
					$maxtax = $myrow51['maxtax'];
					$deduction = $myrow51['deduction'];
					$over = $myrow51['over'];
					$status = $myrow51['status'];
					$exemption = $myrow51['exemption'];
					$totaltax = $myrow51['totaltax'];
					} // while($myrow51 = $result51->fetch_assoc())
				} // if($result51->num_rows>0)

				if($netofvat <> "" || $netofvat <> 0) {
				  if($otherincnetofvat <> "" || $otherincnetofvat <> 0) {
				    $totded = ($netofvat + $otherincnetofvat) - $deduction;
				  } else {
				    $totded = ($netofvat + $otherincome) - $deduction;
				  } // if($otherincnetofvat <> "" || $otherincnetofvat <> 0)
				} else {
				  $totded = ($netbasicpay + $otherincome) - $deduction;
				} // if($netofvat <> "" || $netofvat <> 0)
				$totover = $totded * $over;
				$wtax = $totover + $exemption;
				*/
				// 20180129
				// compute required fields
				$comprate = $netbasicpay2 + $otherincome;
				// 20180124
				// query tblwtax2018 based on grosspay
				$sched='sm';
				$res51query="SELECT idwtax2018, crmin, crmax, percent, prescramt FROM tblwtax2018 WHERE sched='sm' AND (crmin<=$comprate AND crmax>=$comprate) LIMIT 1";
				$result51=""; $found51=0; $ctr51=0;
				$result51=$dbh2->query($res51query);
				if($result51->num_rows>0) {
					while($myrow51=$result51->fetch_assoc()) {
					$found51=1;
					$ctr51=$ctr51+1;
					$idwtax201851 = $myrow51['idwtax2018'];
					$sched51 = $myrow51['sched'];
					$crmin51 = $myrow51['crmin'];
					$crmax51 = $myrow51['crmax'];
					$percent51 = $myrow51['percent'];
					$prescramt51 = $myrow51['prescramt'];
					} // while($myrow51=$result51->fetch_assoc())
				} // if($result51->num_rows>0)
				// compute for wtax
				// if($found51==1) {
					// $wtax = round(((($comprate - $crmin51) * ($percent51/100)) + $prescramt51), 2);
				// } // if($found51==1)
			if($found51==1) {
				if($percent51!=0) {
				// include overtime in comprate
				// $comprate2 = $comprate + $overtimesubtot;
				$wtax2018 = round(((($comprate - $crmin51) * ($percent51/100)) + $prescramt51), 2);
				$flg='wpct';
				} else { // if($percent14==0)
				// $wtax2018 = round((($comprate - $crmin14) + $prescramt14), 2);
				$wtax2018 = round(((($comprate - $crmin51) * ($percent51/100)) + $prescramt51), 2);
				$flg='0pct';
				} // if($percent14==0)
				$wtax = $wtax2018;
			} // if($found14==1)


			} else if($wtaxmode == "manual") {

				$wtax = $withholdingtax;

			} else if($wtaxmode == "percent") {
				/*
				$result54 = mysql_query("", $dbh);
				while($myrow54 = mysql_fetch_row($result54)) {
				*/
				$res54query="SELECT wtaxopt2 FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\"";
				$result54=""; $found54=0; $ctr54=0;
				$result54 = $dbh2->query($res54query);
				if($result54->num_rows>0) {
					while($myrow54 = $result54->fetch_assoc()) {
				  $found54 = 1;
				  $wtaxopt2 = $myrow54['wtaxopt2'];
					} // while($myrow54 = $result54->fetch_assoc())
				} // if($result54->num_rows>0)
				if($vatstatus == "on") {
				  if($otherincnetofvat <> "" || $otherincnetofvat <> 0) {
				    $wtax = (($netofvat + $otherincnetofvat) * $wtaxopt2) / 100;
				  } else {
				    $wtax = (($netofvat + $otherincome) * $wtaxopt2) / 100;
				  } // if($otherincnetofvat <> "" || $otherincnetofvat <> 0)
				} else {
				  $wtax = (($netbasicpay2 + $otherincome) * $wtaxopt2) / 100;
				} // if($vatstatus == "on")
			} // if($wtaxmode == "auto")
// end withholding tax computation
// --------------------------------- //

				if ($daystart == "01" AND $dayend == "15") {
					// $totaldeductions = $wtax + $otherdeductions;
					$sssee = 0;
					$ssser = 0;
					$sssec = 0;
					$ssstotalec = 0;
					$ssstotal = 0;
					$philhealthee = 0;
					$philhealther = 0;
					// $pagibigee = 0;
					// $pagibiger = 0;
					// $pagibigtotal = 0;
					$philhealthtotal = 0;

// ------------------------- //
// start pagibig computation
			if($pagibigmode == "off") {
			  $pagibigee = 0;
			  $pagibiger = 0;
			  $pagibigtotal = 0;
			} else if($pagibigmode == "manual") {
				if($pagibigman1 == 0) {
			  $pagibigee = 0;
			  $pagibiger = 0;
			  $pagibigtotal = 0;
				} else if($pagibigman1 == 1) {
				$pagibigtotal = $pagibigee + $pagibiger;
				}
			} // if($pagibigmode == "off")
				$pagibigee2 = 0;
				$pagibiger2 = 0;
				$pagibigtotal2 = 0;
// end pagibig computation
// ----------------------- //

					$totaldeductions = $wtax + $pagibigee + $otherdeductions;

				} else { // if ($daystart == 1 AND $dayend == 15)

					$monthlysalary = $netbasicpay * 2;

// --------------------- //
// start sss computation
			if($sssmode == "auto") {
				// if ($sssstatus == 'on') {
					/*
					$result52 = mysql_query("", $dbh);
					while ($myrow52 = mysql_fetch_row($result52)) {
					*/
					$res52query="SELECT * FROM tblssscontribution WHERE $monthlysalary>compfrom AND $monthlysalary<compto";
					$result52=""; $found52=0; $ctr52=0;
					$result52 = $dbh2->query($res52query);
					if($result52->num_rows>0) {
						while($myrow52 = $result52->fetch_assoc()) {
						$found52 = 1;
						$ssscontributionid = $myrow52['ssscontributionid'];
						$compfrom = $myrow52['compfrom'];
						$compto = $myrow52['compto'];
						$salarycredit = $myrow52['salarycredit'];
						$ssser = $myrow52['sser'];
						$sssee = $myrow52['ssee'];
						$sstotal = $myrow52['sstotal'];
						$sssec = $myrow52['ecer'];
						$tcer = $myrow52['tcer'];
						$tcee = $myrow52['tcee'];
						$ssstotalec = $myrow52['tctotal'];
						$ssstotal = $myrow52['totalcontribution'];
						} // while($myrow52 = $result52->fetch_assoc())
					} // if($result52->num_rows>0)
				// }
			} else if($sssmode == "manual") {
				$ssstotalec = $ssser + $sssec + $sssee;
				$ssstotal = $ssser + $sssee;
			} else if($sssmode == "off") {
			  $ssser = 0;
			  $sssec = 0;
			  $sssee = 0;
			  $ssstotalec = 0;
			  $ssstotal = 0;
			} // if($sssmode == "auto")
// end of sss computation
// ---------------------- //

// ---------------------------- //
// start philhealth computation

//					$monthlysalary = $netbasicpay * 2;

			if($philhealthmode == "auto") {

					/*
					$res53query="SELECT * FROM tblphilhealth WHERE $monthlysalary>=salarymin AND $monthlysalary<=salarymax";
					$result53=""; $found53=0; $ctr53=0;
					$result53 = $dbh2->query($res53query);
					if($result53->num_rows>0) {
						while($myrow53 = $result53->fetch_assoc()) {
						$found53 = 1;
						$salaryid = $myrow53['salaryid'];
						$salarymin = $myrow53['salarymin'];
						$salarymax = $myrow53['salarymax'];
						$salarybase = $myrow53['salarybase'];
						$philhealthtotal = $myrow53['totmonthpremium'];
						$philhealther = $myrow53['philhealther'];
						$philhealthee = $myrow53['philhealthee'];
						} // while($myrow53 = $result53->fetch_assoc())
					} // if($result53->num_rows>0)
					*/
				// 20180129
			// query previous cutoff and get netbasicpay, then add in current netbasicpay
			$res18query="SELECT DISTINCT cutstart, cutend, netbasicpay, daysabsentamt, netbasicpay2  FROM tblconfipayroll WHERE cutstart<>\"$cutstart\" AND cutend<>\"$cutend\" AND employeeid=\"$employeeid\" AND groupname=\"$groupname\" ORDER BY cutstart DESC LIMIT 1";
			$result18=""; $found18=0; $ctr18=0;
			$result18=$dbh2->query($res18query);
			if($result18->num_rows>0) {
				while($myrow18=$result18->fetch_assoc()) {
				$found18=1;
				$ctr18=$ctr18+1;
				$cutstart18 = $myrow18['cutstart'];
				$cutend18 = $myrow18['cutend'];
				$netbasicpay18 = $myrow18['netbasicpay'];
				$daysabsentamt18 = $myrow18['daysabsentamt'];
				$netbasicpay218 = $myrow18['netbasicpay2'];
				} // while($myrow18=$result18->fetch_assoc())
			} // if($result18->num_rows>0)
			if($found18!=0) {
			// compute required fields
			$prevempsalaryhf = $netbasicpay18 / 2;
			$prevnetbasicpay = $prevempsalaryhf - $daysabsentamt18;
			$subtotnetbasicpay = $prevnetbasicpay + $netbasicpay2;
			} else {
			$subtotnetbasicpay = $netbasicpay2;
			} // if($found18!=0)
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
					$philhealthtotal = round(($netbasicpay2 * ($pct15/100)), 2);
					$philhealthee = $philhealthtotal / 2;
					$philhealther = $philhealthtotal / 2;
					} else { // if($pct15!=0)
					$philhealthtotal = $maxpremium15;
					$philhealthee = $philhealthtotal / 2;
					$philhealther = $philhealthtotal / 2;
					} // if($pct15!=0)
				} // if($found15==1)

			} else if($philhealthmode == "manual") {

				$philhealthtotal = $philhealther + $philhealthee;

			} else if($philhealthmode == "off") {

			  $philhealther = 0;
			  $philhealthee = 0;
			  $philhealthmode = 0;

			} // if($philhealthmode == "auto")

// end of philhealth computation
// ----------------------------- //


// ------------------------- //
// start pagibig computation
			if($pagibigmode == "off") {
			  $pagibigee2 = 0;
			  $pagibiger2 = 0;
			  $pagibigtotal2 = 0;
			} else if($pagibigmode == "manual") {
				if($pagibigman2 == 0) {
			  $pagibigee2 = 0;
			  $pagibiger2 = 0;
			  $pagibigtotal2 = 0;
				} else if($pagibigman2 == 1) {
				$pagibigtotal2 = $pagibigee2 + $pagibiger2;
				}
			} // if($pagibigmode == "off")
				$pagibigee = 0;
				$pagibiger = 0;
				$pagibigtotal = 0;
// end pagibig computation
// ----------------------- //

					$totaldeductions = $wtax + $sssee + $philhealthee + $pagibigee2 + $otherdeductions;

				} // if ($daystart == 1 AND $dayend == 15)

				$pagibigeetot = $pagibigee + $pagibigee2;
				$pagibigertot = $pagibiger + $pagibiger2;
				$netpay = $grosspay - $totaldeductions;

				echo "<p>";
				echo "<table class=\"fin\" border=1 spacing=1>";
				echo "<tr><th colspan=17 align=\"left\">Payroll Summary</th></tr>";
				echo "<tr><td>EmpID</td><td>FullName</td><td>Prof.Fee</td><td>LateAbsent</td><td>NetBasicPay</td>";
				if($vatstatus == "on") { echo "<td>VATrate</td><td>NetofVAT</td>"; }
				echo "<td>Add'lIncome</td>";
				if($addincomevatincl == "yes") { echo "<td>OtherIncome VATrate</td><td>OtherIncome NetofVAT</td>"; }
				echo "<td>NonTaxableIncome</td><td>GrossPay</td><td>WTax</td><td>SSS</td><td>Philhealth</td><td>PagIBIG</td><td>OtherDeductions</td><td>TotalDeductions</td><th>NetPay</th></tr>";

				  echo "<tr>";

					if($confiaccesslevel11==5 && $accesslevel==5) {
						include("mcryptdec.php");
						if($empalias!="") {
							echo "<td>***</td>";
							echo "<td>$empalias</td>";
						} else {
							echo "<td>$employeeid</td>";
							echo "<td>$name_last, $name_first $name_middle[0]</td>";
						} // if($empalias!="")
						include("mcryptenc.php");
					} else if($confiaccesslevel11<=4) {
						echo "<td>$employeeid</td>";
						echo "<td>$name_last, $name_first $name_middle[0]</td>";
					} // if($confiaccesslevel11==5 && $accesslevel==5)

				echo "<td align=right>$netbasicpay</td><td>$daysabsentamt</td><td align=\"right\">$netbasicpay2</td>";
				if($vatstatus == "on") { echo "<td align=\"right\">$vatrate</td><td align=\"right\">$netofvat</td>"; }
				echo "<td align=right>$otherincome</td>";
				if($addincomevatincl == "yes") { echo "<td align=\"right\">$otherincvatrate</td><td align=\"right\">$otherincnetofvat</td>"; }
				echo "<td align=right>$otherincomenontaxable</td><td align=right>$grosspay</td><td align=right>$wtax</td><td align=right>$sssee</td><td align=right>$philhealthee</td><td align=right>$pagibigeetot</td><td align=right>$otherdeductions</td><td align=right>$totaldeductions</td><th align=right>$netpay</th></tr>";

				$res5query="INSERT INTO tblconfipayroll SET timestamp=\"$now\", loginid=$loginid, employeeid=\"$employeeid\", cutstart=\"$cutstart\", cutend=\"$cutend\", groupname=\"$groupname\", accesslevel=$accesslevel, netbasicpay=$netbasicpay, daysabsent=$daysabsentval, daysabsentamt=$daysabsentamt, netbasicpay2=$netbasicpay2, vatrate=$vatrate, netofvat=$netofvat, otherincome=$otherincome, otherincvatrate=$otherincvatrate, otherincnetofvat=$otherincnetofvat, otherincomenontaxable=$otherincomenontaxable, grosspay=$grosspay, withholdingtax=$wtax, sssee=$sssee, ssser=$ssser, sssec=$sssec, ssstotalec=$ssstotalec, ssstotal=$ssstotal, philhealthee=$philhealthee, philhealther=$philhealther, philhealthtotal=$philhealthtotal, pagibigee=$pagibigeetot, pagibiger=$pagibigertot, pagibigtotal=$pagibigtotal, otherdeductions=$otherdeductions, totaldeductions=$totaldeductions, netpay=$netpay, confipaygrpid=$confipaygrpid";
				$result5 = $dbh2->query($res5query);

				// echo "<tr><td colspan=\"19\">$res5query</td></tr>";
				echo "</table>";

				} // while($myrow2 = $result2->fetch_assoc())
			} // if($result2->num_rows>0)

			$totalnetbasic = $totalnetbasic + $netbasicpay;
			$totalnetbasic_fmt = round($totalnetbasic, 2);
			$totaldaysabsent = $totaldaysabsent + $daysabsentval;
			$totaldaysabsent_fmt = round($totalnetbasic, 2);
			$totaldaysabsentamt = $totaldaysabsentamt + $daysabsentamt;
			$totaldaysabsentamt_fmt = round($totaldaysabsentamt, 2);
			$totalnetbasicpay2 = $totalnetbasicpay2 + $netbasicpay2;
			$totalnetbasicpay2_fmt = round($totalnetbasicpay2, 2);
			$totalvatrate = $totalvatrate + $vatrate;
			$totalvatrate_fmt = round($totalvatrate, 2);
			$totalnetofvat = $totalnetofvat + $netofvat;
			$totalnetofvat_fmt = round($totalnetofvat, 2);
			$totalincome = $totalincome + $otherincome;
			$totalincome_fmt = round($totalincome, 2);
			$totalincnetofvat = $totalincnetofvat + $otherincnetofvat;
			$totalincnetofvat_fmt = round($totalincnetofvat, 2);
			$totalincomenontax = $totalincomenontax + $otherincomenontaxable;
			$totalincomenontax_fmt = round($totalincomenontax, 2);
			$totalgross = $totalgross + $grosspay;
			$totalgross_fmt = round($totalgross, 2);
			$totalwtax = $totalwtax + $wtax;
			$totalwtax_fmt = round($totalwtax, 2);
			$totalsssee = $totalsssee + $sssee;
			$totalsssee_fmt = round($totalsssee, 2);
			$totalssser = $totalssser + $ssser;
			$totalssser_fmt = round($totalssser, 2);
			$totalsssec = $totalsssec + $ssstotalec;
			$totalsssec_fmt = round($totalsssec, 2);
			$totalsssecer = $totalsssecer + $sssec;
			$totalsssecer_fmt = round($totalsssecer, 2);
			$totalsss = $totalsss + $ssstotal;
			$totalsss_fmt = round($totalsss, 2);
			$totalphilhealthee = $totalphilhealthee + $philhealthee;
			$totalphilhealthee_fmt = round($totalphilhealthee, 2);
			$totalphilhealther = $totalphilhealther + $philhealther;
			$totalphilhealther_fmt = round($totalphilhealther, 2);
			$totalphilhealth = $totalphilhealth + $philhealthtotal;
			$totalphilhealth_fmt = round($totalphilhealth, 2);
			$totalpagibigee = $totalpagibigee + $pagibigee;
			$totalpagibigee_fmt = round($totalpagibigee, 2);
			$totalpagibiger = $totalpagibiger + $pagibiger;
			$totalpagibiger_fmt = round($totalpagibiger, 2);
			$totalpagibig = $totalpagibig + $pagibigtotal + $pagibigtotal2;
			$totalpagibig_fmt = round($totalpagibig, 2);
			$totalotherdeductions = $totalotherdeductions + $otherdeductions;
			$totalotherdeductions_fmt = round($totalotherdeductions, 2);
			$totaldeductions2 = $totaldeductions2 + $totaldeductions;
			$totaldeductions2_fmt = round($totaldeductions2, 2);
			$totalnetpay = $totalnetpay + $netpay;
			$totalnetpay_fmt = round($totalnetpay, 2);
		} // if ($found == 1)

		} // while($myrow = $result->fetch_assoc())
	} // if($result->num_rows>0)

	$datecreated = date("Y-m-d");

//	echo "vartest date:$datecreated totnetbasic:$totalnetbasic totincome:$totalincome totincnontax:$totalincomenontax totgross:$totalgross totwtax:$totalwtax totsssee:$totalsssee, totssser:$totalssser totsssec:$totalsssec totsss:$totalsss totphicee:$totalphilhealthee totphicer:$totalphilhealther totphic:$totalphilhealth totpagibigee:$totalpagibigee totpagibiger:$totalpagibiger totpagibig:$totalpagibig tototherded:$totalotherdeductions totded:$totaldeductions2 totnetpay:$totalnetpay<br>";

	$res6query="INSERT INTO tblconfipayrolltotal (timestamp, loginid, datecreated, confipaygrpid, groupname, cutstart, cutend, totalnetbasic, totaldaysabsentamt, totalnetbasicpay2, totalnetofvat, totalincome, totalincnetofvat, totalincomenontax, totalgross, totalwtax, totalsssee, totalssser, totalsssecer, totalsssec, totalsss, totalphilhealthee, totalphilhealther, totalphilhealth, totalpagibigee, totalpagibiger, totalpagibig, totalotherdeductions, totaldeductions, totalnetpay) VALUES (\"$now\", $loginid, \"$datecreated\", $confipaygrpid, \"$groupname\", \"$cutstart\", \"$cutend\", $totalnetbasic_fmt, $totaldaysabsentamt_fmt, $totalnetbasicpay2_fmt, $totalnetofvat_fmt, $totalincome_fmt, $totalincnetofvat_fmt, $totalincomenontax_fmt, $totalgross_fmt, $totalwtax_fmt, $totalsssee_fmt, $totalssser_fmt, $totalsssecer_fmt, $totalsssec_fmt, $totalsss_fmt, $totalphilhealthee_fmt, $totalphilhealther_fmt, $totalphilhealth_fmt, $totalpagibigee_fmt, $totalpagibiger_fmt, $totalpagibig_fmt, $totalotherdeductions_fmt, $totaldeductions2_fmt, $totalnetpay_fmt)";
	$result6 = $dbh2->query($res6query);

// ---------------------------- //
// END MAIN PAYROLL COMPUTATION
// ---------------------------- //



//
//
// check pay type if cutoff or onetime
} else if($radiochecked=="onetime") { // if($radiochecked=="cutoff")

	//
	// start one-time pay result


	// get confipaygrpid
	$res14query="SELECT confipaygrpid FROM tblconfipaygrp WHERE groupname=\"$groupname\"";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$confipaygrpid = $myrow14['confipaygrpid'];
		} // while($myrow14=$result14->fetch_assoc())
	} // if($result14->num_rows>0)

// echo "<p>vartest rs:$radiochecked gn:$groupname dt:$cutstart,$cutend,$dateotp eid:$employeeid21 amt:$amountotp wt:$wtax oth:$otherded net:$netpay grpid:$confipaygrpid</p>";

	// check user's accesslevel
	$employeeid=$employeeid21;
	if($confiaccesslevel11==5 && $accesslevel==5) {
	include("mcryptdec.php");
	$empid1=$employeeid;
	include("mcryptenc.php");
	} else if($confiaccesslevel11<=4) {
	$empid1=$employeeid;
	} // if($confiaccesslevel11==5 && $accesslevel==5)
	$res30query="SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$empid1\" AND contact_type=\"personnel\"";
	$result30=""; $found30=0; $ctr30=0;
	$result30 = $dbh2->query($res30query);
	if($result30->num_rows>0) {
		while($myrow30 = $result30->fetch_assoc()) {
	  $name_first30 = $myrow30['name_first'];
	  $name_middle30 = $myrow30['name_middle'];
	  $name_last30 = $myrow30['name_last'];
		} // while($myrow30 = $result30->fetch_assoc())
	} // if($result30->num_rows>0)

		// prep variables befor query
		$cutstart=$dateotp;
		$cutend=$dateotp;
		$daysabsentval=0; $daysabsentamt=0; $vatrate=0; $netofvat=0; $otherincome=0; $otherincvatrate=0; $otherincnetofvat=0; $otherincomenontaxable=0; $sssee=0; $ssser=0; $sssec=0; $ssstotalec=0; $ssstotal=0; $philhealthee=0; $philhealther=0; $philhealthtotal=0; $pagibigeetot=0; $pagibigertot=0; $pagibigtotal=0; $totaldeductions=0;

	// 20180516 compute for grosspay
	$grosspay=$amountotp;

	// compute deductions and final net pay
	$totaldeductions=$wtax+$otherdeductions;
	$netpayfin=$grosspay-$wtax-$otherdeductions;

	// get id and other column values from tblconfipayroll if exists, update else insert
	$res15query="SELECT confipayrollid FROM tblconfipayroll WHERE employeeid=\"$employeeid21\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" AND groupname=\"$groupname\"";
	$result15=""; $found15=0; $ctr15=0;
	$result15=$dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
		$found15=1;
		$confipayrollid15 = $myrow15['confipayrollid'];
		} // while($myrow15=$result15->fetch_assoc())
	} // if($result15->num_rows>0)

	if($found15==1) {
		// update query
		$res5query="UPDATE tblconfipayroll SET timestamp=\"$now\", loginid=$loginid, employeeid=\"$employeeid21\", netbasicpay=$netbasicpay, daysabsent=$daysabsentval, daysabsentamt=$daysabsentamt, netbasicpay2=$netbasicpay2, vatrate=$vatrate, netofvat=$netofvat, otherincome=$otherincome, otherincvatrate=$otherincvatrate, otherincnetofvat=$otherincnetofvat, otherincomenontaxable=$otherincomenontaxable, grosspay=$grosspay, withholdingtax=$wtax, sssee=$sssee, ssser=$ssser, sssec=$sssec, ssstotalec=$ssstotalec, ssstotal=$ssstotal, philhealthee=$philhealthee, philhealther=$philhealther, philhealthtotal=$philhealthtotal, pagibigee=$pagibigeetot, pagibiger=$pagibigertot, pagibigtotal=$pagibigtotal, otherdeductions=$otherdeductions, totaldeductions=$totaldeductions, netpay=$netpayfin, confipaygrpid=$confipaygrpid WHERE confipayrollid=$confipayrollid15 AND employeeid=\"$employeeid21\" AND groupname=\"$groupname\" AND cutstart=\"$dateotp\" AND cutend=\"$dateotp\"";
	} else if($found15==0) {
		// insert query
		$res5query="INSERT INTO tblconfipayroll SET timestamp=\"$now\", loginid=$loginid, employeeid=\"$employeeid21\", cutstart=\"$dateotp\", cutend=\"$dateotp\", groupname=\"$groupname\", accesslevel=$accesslevel, netbasicpay=$netbasicpay, daysabsent=$daysabsentval, daysabsentamt=$daysabsentamt, netbasicpay2=$netbasicpay2, vatrate=$vatrate, netofvat=$netofvat, otherincome=$otherincome, otherincvatrate=$otherincvatrate, otherincnetofvat=$otherincnetofvat, otherincomenontaxable=$otherincomenontaxable, grosspay=$grosspay, withholdingtax=$wtax, sssee=$sssee, ssser=$ssser, sssec=$sssec, ssstotalec=$ssstotalec, ssstotal=$ssstotal, philhealthee=$philhealthee, philhealther=$philhealther, philhealthtotal=$philhealthtotal, pagibigee=$pagibigeetot, pagibiger=$pagibigertot, pagibigtotal=$pagibigtotal, otherdeductions=$otherdeductions, totaldeductions=$totaldeductions, netpay=$netpayfin, confipaygrpid=$confipaygrpid";
	} // if($found15==1)
		// execute query
		$result5 = $dbh2->query($res5query);
		// echo "<p>$empalias: $res5query</p>";

	//
	// prepare total here for tblconfipayrolltotal
	$res17query="SELECT confipaycutoffid FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$dateotp\" AND cutend=\"$dateotp\"";
	$result17=""; $found17=0; $ctr17=0;
	$result17=$dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17=$result17->fetch_assoc()) {
		$found17=1;
		$confipaycutoffid = $myrow17['confipaycutoffid'];
		} // while($myrow17=$result17->fetch_assoc())
	} // if($result17->num_rows>0)

	// set other vars to 0
	$totaldaysabsentamt=0; $totalnetofvat=0; $totalincome=0; $totalincnetofvat=0; $totalincomenontax=0; $totalsssee=0; $totalssser=0; $totalsssecer=0; $totalsssec=0; $totalsss=0; $totalphilhealthee=0; $totalphilhealther=0; $totalphilhealth=0; $totalpagibigee=0; $totalpagibiger=0; $totalpagibig=0;

	// query and sum tblconfipayroll records, then update query
	$res18query="SELECT netbasicpay, netbasicpay2, grosspay, withholdingtax, otherdeductions, totaldeductions, netpay FROM tblconfipayroll WHERE groupname=\"$groupname\" AND cutstart=\"$dateotp\" AND cutend=\"$dateotp\"";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$netbasicpay18 = $myrow18['netbasicpay'];
		$netbasicpay218 = $myrow18['netbasicpay2'];
		$grosspay18 = $myrow18['grosspay'];
		$withholdingtax18 = $myrow18['withholdingtax'];
		$otherdeductions18 = $myrow18['otherdeductions'];
		$totaldeductions18 = $myrow18['totaldeductions'];
		$netpay18 = $myrow18['netpay'];
		// compute total
		$totalnetbasicpay=$totalnetbasicpay+$netbasicpay18;
		$totalnetbasicpay2=$totalnetbasicpay2+$netbasicpay218;
		$totalgrosspay=$totalgrosspay+$grosspay18;
		$totalwithholdingtax=$totalwithholdingtax+$withholdingtax18;
		$totalotherdeductions=$totalotherdeductions+$otherdeductions18;
		$totaltotaldeductions=$totaltotaldeductions+$totaldeductions18;
		$totalnetpay=$totalnetpay+$netpay18;
		// reset vars
		$netbasicpay18=0; $netbasicpay218=0; $grosspay18=0; $withholdingtax18=0; $otherdeductions18=0; $totaldeductions18=0; $netpay18=0;
		} // while($myrow18=$result18->fetch_assoc())
	} // if($result18->num_rows>0)

	// round off total vars
	$totalnetbasicpay=round($totalnetbasicpay,2);
	$totalnetbasicpay2=round($totalnetbasicpay2,2);
	$totalgrosspay=round($totalgrosspay,2);
	$totalwithholdingtax=round($totalwithholdingtax,2);
	$totalotherdeductions=round($totalotherdeductions,2);
	$totaltotaldeductions=round($totaltotaldeductions,2);
	$totalnetpay=round($totalnetpay,2);

	if($found17==1) {
		// update query
		$res19query="UPDATE tblconfipayrolltotal SET timestamp=\"$now\", loginid=$loginid, totalnetbasic=$totalnetbasicpay, totalnetbasicpay2=$totalnetbasicpay2, totalgross=$totalgrosspay, totalwtax=$totalwithholdingtax, totalotherdeductions=$totalotherdeductions, totaldeductions=$totaltotaldeductions, totalnetpay=$totalnetpay, totaldaysabsentamt=$totaldaysabsentamt, totalnetofvat=$totalnetofvat, totalincome=$totalincome, totalincnetofvat=$totalincnetofvat, totalincomenontax=$totalincomenontax, totalsssee=$totalsssee, totalssser=$totalssser, totalsssecer=$totalsssecer, totalsssec=$totalsssec, totalsss=$totalsss, totalphilhealthee=$totalphilhealthee, totalphilhealther=$totalphilhealther, totalphilhealth=$totalphilhealth, totalpagibigee=$totalpagibigee, totalpagibiger=$totalpagibiger, totalpagibig=$totalpagibig WHERE groupname=\"$groupname\" AND cutstart=\"$dateotp\" AND cutend=\"$dateotp\" AND confipaycutoffid=$confipaycutoffid";
	} else if($found17==0) { // if($found17==1)
		// insert query
		$res19query="INSERT INTO tblconfipayrolltotal SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", confipaygrpid=$confipaygrpid, groupname=\"$groupname\", cutstart=\"$dateotp\", cutend=\"$dateotp\", totalnetbasic=$totalnetbasicpay, totalnetbasicpay2=$totalnetbasicpay2, totalgross=$totalgrosspay, totalwtax=$totalwithholdingtax, totalotherdeductions=$totalotherdeductions, totaldeductions=$totaltotaldeductions, totalnetpay=$totalnetpay, totaldaysabsentamt=$totaldaysabsentamt, totalnetofvat=$totalnetofvat, totalincome=$totalincome, totalincnetofvat=$totalincnetofvat, totalincomenontax=$totalincomenontax, totalsssee=$totalsssee, totalssser=$totalssser, totalsssecer=$totalsssecer, totalsssec=$totalsssec, totalsss=$totalsss, totalphilhealthee=$totalphilhealthee, totalphilhealther=$totalphilhealther, totalphilhealth=$totalphilhealth, totalpagibigee=$totalpagibigee, totalpagibiger=$totalpagibiger, totalpagibig=$totalpagibig";
	} // if($found17==1)

	// execute query
	$result19=""; $found20=0;
	$result19=$dbh2->query($res19query);
	// echo "<p>$res19query</p>";

	echo "<p><h2><font color=\"green\">Updated!</font></h2></p>";
	echo "<p>eid:$employeeid, gn:$groupname, dt:$dateotp, net:$netpay, grptotnet:$totalnetpay</p>";
	echo "<form action=\"confipayrun3.php?loginid=$loginid&rs=onetime\" method=\"POST\" name=\"myform\">";
	echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
	echo "<input type=\"hidden\" name=\"dateotp\" value=\"$dateotp\">";
	echo "<input type=\"hidden\" name=\"vpw\" value=\"1\">";
	echo "<p><input type=\"submit\" name=\"Continue\"></p>";
	echo "</form>";

	// echo "</table>";

//
//
// check pay type if cutoff or onetime
} // if($radiochecked=="cutoff")


	echo "</html>";
} else {
     include("logindeny.php");
}

$dbh2->close();
?>