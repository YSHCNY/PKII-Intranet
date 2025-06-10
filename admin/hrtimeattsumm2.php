<?php
// hrtimeattsumm2.php
// fr hrtimeattsumm.php & finpaysystasumm.php // updated 20241008

    // Convert to a timestamp
$startDate  = new DateTime($cutstart15);
$endDate  = new DateTime($cutend15);
$startMonthDay = $startDate->format('F j'); 
$endDay = $endDate->format('j'); 
$year = $endDate->format('Y'); 


$formattedDateRange = $startMonthDay . ' - ' . $endDay . ', ' . $year;

	if($disptyp=="detailed") {
	//
	// start display of detailed list
	//
	echo "<table width=\"100%\" align=\"center\" id = 'this' class = 'table table-hover table-bordered '>";
		echo "<thead >";
		echo "<tr><th  colspan='23'>Attendance Summary for the Period $formattedDateRange</th></tr>";
			echo "<tr>";

	
				echo "<th class = 'h5 text-light bg-secondary' colspan='8'>Personnel Attendance Information</th>";
				echo "<th class = 'h5 text-light bg-secondary' colspan='8'>Overtime</th>";
				echo "<th class = 'h5 text-light bg-secondary' colspan='5'>Leaves</th>";
				echo "<th class = 'h5 text-light bg-secondary' colspan='1'></th>";


			echo "</tr>";
			echo "<tr>";
				// echo "<th class = 'h5 text-light bg-secondary'>Ctr</th>";
				// echo "<th class = 'h5 text-light bg-secondary'>Employee ID</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Personnel Name</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Preffered Time</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Date</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Day</th>";

				echo "<th class = 'h5 text-light bg-secondary'>IN</th>";
				echo "<th class = 'h5 text-light bg-secondary'>OUT</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Hrs</th>";
				echo "<th class = 'h5 text-light bg-secondary'>UT</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Regular Day</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Rest Day</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Holiday Name
				
		
				<br> HRS | OT

	
				</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Meal allow.</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Trans allow.</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Proj/Dept</th>";

				echo "<th class = 'h5 text-light bg-secondary'>Night diff</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Total</th>";
				

				echo "<th class = 'h5 text-light bg-secondary'>VL</th>";
				echo "<th class = 'h5 text-light bg-secondary'>SL</th>";
				echo "<th class = 'h5 text-light bg-secondary'>SD</th>";

				echo "<th class = 'h5 text-light bg-secondary'>OB</th>";
				echo "<th class = 'h5 text-light bg-secondary'>SPL</th>";
				echo "<th class = 'h5 text-light bg-secondary'>Remarks</th>";
			echo "</tr>";
		echo "</thead>";

// if($result21->num_rows>0)

	$dbq21="SELECT 
    tblhrtaemptimelog.*, 
    tblhrtapaygrpemplst.*, 
    tblhrtapayshiftctg.*, 
    tblhrtaholidays.*,
	leavesaver.*,
    tblcontact.name_last, 
    tblcontact.name_first
FROM 
    tblhrtaemptimelog
LEFT JOIN 
    tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid = tblhrtapaygrpemplst.employeeid
LEFT JOIN 
    tblhrtapayshiftctg ON tblhrtapaygrpemplst.idhrtapayshiftctg = tblhrtapayshiftctg.idhrtapayshiftctg
LEFT JOIN 
    tblhrtaholidays ON tblhrtaemptimelog.logdate = tblhrtaholidays.applic_date
LEFT JOIN 
    tblcontact ON tblhrtapaygrpemplst.contactid = tblcontact.contactid
LEFT JOIN
	leavesaver ON tblhrtaemptimelog.logdate = leavesaver.leavedays
WHERE 
    tblhrtaemptimelog.idpaygroup = $idpaygroup
    AND tblhrtaemptimelog.idcutoff = $idcutoff
GROUP BY 
    tblhrtaemptimelog.idhrtaemptimelog
ORDER BY 
    tblcontact.name_last, 
	tblcontact.name_first,
    tblhrtaemptimelog.logdate ASC;
";

	// echo "$dbq21";
	$result21=""; $found21=0; $ctr21=0;
	/*
	$result21 = mysql_query("$dbq21", $dbh);
	if($result21 != "") {
		while($myrow21 = mysql_fetch_row($result21)) {
	*/


	$result21 = $dbh2->query($dbq21);
	if($result21->num_rows>0) {
		while($myrow21 = $result21->fetch_assoc()) {
		$found21 = 1;
		$idhrtaemptimelog21 = $myrow21['idhrtaemptimelog'];
		$employeeid21 = $myrow21['employeeid'];
		$logdate21 = $myrow21['logdate'];
		$timein21 = $myrow21['timein'];
		$timeout21 = $myrow21['timeout'];
		$otbeforeinsw21 = $myrow21['otbeforeinsw'];
		$otafteroutsw21 = $myrow21['otafteroutsw'];
		$restdaysw21 = $myrow21['restdaysw'];
		$nextdaysw21 = $myrow21['nextdaysw'];
		$mealallowsw21 = $myrow21['mealallowsw'];
		$leavetype21 = $myrow21['leavetype'];
		$leaveduration21 = number_format($myrow21['leaveduration'], 1);
		$manualcompsw21 = $myrow21['manualcompsw']; 
		$totaltime21 = $myrow21['totaltime'];
		$otval21 = $myrow21['otval'];
		$utval21 = $myrow21['utval'];
		$otutval21 = $myrow21['otutval'];
		$nightdiffval21 = $myrow21['nightdiffval'];
		$nootsw21 = $myrow21['nootsw'];
		$noutsw21 = $myrow21['noutsw'];
		$projcharge21 = $myrow21['projcharge'];
		$projpercent21 = $myrow21['projpercent'];
		$nofindings21 = $myrow21['nofindings'];
		$remarks21 = $myrow21['remarks'];
		// 20240916 <!--start-->
		$leaveid21 = $myrow21['leaveid'];
		$holiday21s = $myrow21['holiday'];
        $timein221 = $myrow21['timein2'];
        $timeout221 = $myrow21['timeout2'];
        $nextday2in21 = $myrow21['nextday2insw'];
        $nextday2out21 = $myrow21['nextday2outsw'];
		
		$otordval21 = $myrow21['otordval'];
		$otrestval21 = $myrow21['otrestval']; 
		$otlegalval21 = $myrow21['otlegalval']; 
		$otrest8val21 = $myrow21['otrest8val']; 
		$otspsunval21 = $myrow21['otspsunval']; 
		$otspsun8val21 = $myrow21['otspsun8val']; 
		$otlegal8val21 = $myrow21['otlegal8val']; 
		$otlegalsunval21 = $myrow21['otlegalsunval']; 
		$otlegalsun8val21 = $myrow21['otlegalsun8val']; 
		$otspval21 = $myrow21['otspval']; 
		$otsp8val21 = $myrow21['otsp8val']; 
		// 20240916 <!--end-->		
		$contactid21 = $myrow21['contactid'];
		$bankacctid21 = $myrow21['bankacctid'];
		$restday21 = $myrow21['restday'];
		$projcode21 = $myrow21['projcode'];
		$projchgtyp21 = $myrow21['projchgtyp']; 
		$allowotdflt21 = $myrow21['allowotdflt']; 
		$allowotbfidflt21 = $myrow21['allowotbfidflt']; 
		$activesw21 = $myrow21['activesw'];
		$projassignid21 = $myrow21['projassignid']; 
		$flexitime21 = $myrow21['flexitime']; 
		$shiftin21 = $myrow21['shiftin'];
		$shiftout21 = $myrow21['shiftout'];

		$holidaytype21 = $myrow21['holidaytype'];
		$name_last21 = $myrow21['name_last'];
		$name_first21 = $myrow21['name_first'];
		$name_middle21 = $myrow21['name_middle'];
		$transpo = $myrow21['transpo'];
		$holidaynamehere = $myrow21['holidayname'];
		$holitype = $myrow21['holidaytype'];
		$remarksthis = $myrow21['remarks'];
		$leavedurationsa = $myrow21['leaveduration']; 
		$coltr = $myrow21['coltrack'];
		$realwfhval = $myrow21['wfhval'];
		
		$leavedays = $myrow21['leavedays'];
		$leavecode = $myrow21['leavecode'];

		$ctr21 = $ctr21 + 1;

			// echo "$dbq21<br>";
		// pending
		if ($coltr == 1){
			$tdcolor = 'warning';

		} else {
			$tdcolor = 'white';

		}


		// for automated green
		if ($coltr == 2){
			$trcolor = 'success';

		}
		 else {
			$trcolor = 'white';
	

		}
		echo "<tbody>";
	
		// data-id='$ctr21'
	echo "<tr class= '$trcolor'>";
	
		// echo "<td>$ctr21</td>";
		// echo "<td>$employeeid21</td>";

		// name
		echo "<td align=\"center\">$name_last21, $name_first21 ";
		if($name_middle21 != "") { echo "$name_middle21[0]."; }
		echo "</td>";

		// shiftin
		if ($flexitime21 == 1){
			echo "<td align=\"center\">Flexi Time</td>";
		} else {
		echo "<td  align=\"center\">".date('g:i', strtotime($shiftin21))."</td>";
		}

		// date
		$dateday = date("D", strtotime($logdate21));
		echo "<td align=\"center\">".date("d M", strtotime($logdate21))."</td><td>$dateday</td>";

		// timein/timeout
		echo "<td align=\"center\">".date("G:i", strtotime($timein21))."</td>";
		echo "<td align=\"center\">".date("G:i", strtotime($timeout21))."</td>";

		// totaltime
		if($totaltime21!=0) {
		echo "<td align=\"center\">$totaltime21</td>";
		// compute subtotal
		$subtotaltime=round($subtotaltime+$totaltime21, 2);
		} else {
		echo "<td align=\"center\">---</td>";
		}



		// UnderTime

	
			if($utval21 != 0 && $realwfhval == 'NC'){
				echo "<td align=\"center\" class = 'text-danger'>$utval21</td>";
			} else if($utval21 != 0 && $realwfhval == 'WFH'){
				$utval21 = $utval21 / 8;

				echo "<td align=\"center\" class = 'text-primary'>$utval21</td>";
			} else {
				echo"<td></td> ";
			}
		

	








		// ot regular
		if($otordval21 != 0){
			echo "<td align=\"center\">$otordval21</td>";
		} else {
			echo"<td></td> ";
		}

		// otrest 
		if($otrestval21 != 0){
			echo "<td align=\"center\">$otrestval21</td>";
		} else {
			echo"<td></td> ";
		}



		// query holiday


		
		echo "<td align=\"center\" class = 'text-danger text-capitalize'>$holidaynamehere <br> <span class = 'text-center'>$holitype</span>";
	
		if ($holitype == 'special'){
			if ($otspval21 != 0 || $otsp8val21 != 0 ){
			echo "
			<br><span class = 'text-center'>$otspval21 | $otsp8val21</span> ";
		} else {
			echo "
			 ";
		}
		} else if ($holitype == 'legal'){

			if ($otlegalval21 != 0 || $otlegal8val21 != 0 ){
			echo "<br><span class = 'text-center'>$otlegalval21 | $otlegal8val21</span> ";
			} else {
				echo "
			 ";
			}
		} 

			echo "</td>";
		


	
		// meal allowance
		if($mealallowsw21!=0) {
			echo "<td align=\"center\">$mealallowsw21</td>";
			
			} else {
			echo "<td></td>";
			}

		// Transpo
		if($transpo!=0) {
			echo "<td align=\"center\">$transpo</td>";
			
			} else {
			echo "<td></td>";
			}



		// project/dept
		if($projcharge21=="NPL") {
		// $res22query="SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcharge21\"";
		// $result22=""; $found22=0; $ctr22=0;
		// $result22 = mysql_query("$res22query", $dbh);
		// if($result22 != "") {
		// 	while($myrow22 = mysql_fetch_row($result22)) {
		// 	$found22 = 1;
		// 	$proj_fname22 = $myrow22[0];
		// 	$proj_sname22 = $myrow22[1];
		// 	}
		// }
		// if($proj_sname22!="") {
		// echo "<td align=\"center\">$proj_sname22</td>";
		// } else {
		// echo "".strpos("$proj_fname22", 20, 0)."";
	
		echo "<td></td>";
			

		} else {
			
			$parts = explode(",", $projcharge21 );
echo "<td align=\"center\">";
			foreach($parts as $projthis){
				echo "$projthis <br>";
			}
	
echo "</td>";
		}

		
			// night diff

			if($nightdiffval21!=0) {
				echo "<td align=\"center\">$nightdiffval21</td>";
				
				} else {
				echo "<td></td>";
				}
				
			
				$totalperOT = $otordval21 + $otrestval21 + $otlegalval21 + $otrest8val21 + $otspsunval21 + $otspsun8val21 + $otlegal8val21 + $otlegalsunval21 + $otlegalsun8val21 + $otspval21 + $otsp8val21;

				if($totalperOT!=0) {
					echo "<td align=\"center\">$totalperOT</td>";
					
					} else {
					echo "<td></td>";
					}
			



// 					$leavetry = "SELECT * FROM leavesaver WHERE leavedays = '$logdate21' AND empid = '$employeeid21'";
// 					$resultleave = $dbh2->query($leavetry);
// 					if($resultleave->num_rows>0){
// 						while($row = $resultleave->fetch_assoc()){
// 							$code = $row['leavecode'];
// 						}

// 					}

// echo "$code <br>";

		// vacation leave
		if($leavetype21=="vacation" || $leavetype21=="hdv" ) {
					if($leavedurationsa!=0) {
							echo "<td class = '$tdcolor' align=\"center\">$leavedurationsa </td>";
							
							} else {
							echo "<td></td>";
							}
						}
				else {
					echo "<td></td>";

				}

		// sick 
		if($leavetype21=="sick" || $leavetype21=="hds" ) {
			if($leavedurationsa!=0) {
					echo "<td class = '$tdcolor' align=\"center\">$leavedurationsa </td>";
					
					} else {
					echo "<td></td>";
					}
				} else {
					echo "<td></td>";

				}



					// salary deduction
					if($leavetype21=="sd" || $leavetype21=="hsd" ) {
						if($leavedurationsa!=0) {
								echo "<td class = 'info' align=\"center\">$leavedurationsa</td>";
								
								} else {
								echo "<td></td>";
								}
							} else {
								echo "<td></td>";
			
							}


		// official business
		if($leavetype21=="ob") {
		echo "<td align=\"center\">$leaveduration21</td>";
		} else {
		echo "<td></td>";
		}

		// special leave
		if($leavetype21=="special") {
		echo "<td>$leaveduration21</td>";

		} else {
		echo "<td></td>";
		}



		// remarks
		
		echo "<td>$remarks21</td>";
		// remarks
		// echo "<td>";
		// if($nofindings21==1) { echo "No&nbsp;findings&nbsp;"; 
		
		// }
		// if($nofindings21==1 && $remarks21!="") {
		// 	 echo "<br>"; 
		// 	}
		// if($remarks21!="") { echo "$remarks21"; }
		// echo "</td>";


		
		echo "</tr>";
		
		}
	}
		// test sql
		// echo "<tr><td colspan='12'>".$dbq21."</td></tr>";
		
	// display sub-totals
	// echo "<tr><th colspan=\"8\" align=\"right\">Total</th><th align=\"right\">".number_format($subtotaltime, 2)."</th><th align=\"right\">".number_format($subotutval, 2)."</th><th>".number_format($subrestdayval, 2)."</th><th>".number_format($subholival, 2)."</th><th align=\"right\">".number_format($subnightdiffval, 2)."</th><th>$submeal</th><th></th>";
	// echo "<th>".number_format($sublvtypv, 1)."</th><th>".number_format($sublvtyps, 1)."</th><th>".number_format($sublvtypsd, 1)."</th><th>".number_format($sublvtypcc, 1)."</th><th>".number_format($sublvtypob, 1)."</th><th>".number_format($sublvtypsp, 1)."</th>";
	// echo "</tr>";
	echo "<tbody>";
	echo "</table>";
	//
	// end display of detailed list

	} 
	
	
	
	
	
	
	
	
	
	

	else if($disptyp=="summary") {
	//
	// start display of summarized list
	//
echo "<table width=\"100%\" class=\"table table-bordered table-striped table-hover\" id = 'sumtbl'>";
	echo "<tr class = ''><th>Name</th>";
	// echo "<th>PrefTime</th><th colspan=\"2\">Date</th><th>TimeIN</th><th>TimeOUT</th>";
	echo "<th>Hrs</th>
	<th>OT</th>
	<th>UT</th><th>Night differential</th><th>Meal allowance</th><th>Transportation allowance</th>";
	// echo "<th>Trans allow.</th><th>Proj/Dept</th>";
	echo "<th>VL</th><th>SL</th><th>SD</th><th>CC</th><th>OB</th><th>SPL</th></tr>";


	$res23query="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.employeeid=tblcontact.employeeid ORDER BY tblcontact.name_last ASC";
	$result23=""; $found23=0; $ctr23=0; $empidcurr=""; $empidnxt="";
	/*
	$result23 = mysql_query("$res23query", $dbh);
	if($result23 != "") {
		while($myrow23 = mysql_fetch_row($result23)) {
	*/
	$result23 = $dbh2->query($res23query);
	if($result23->num_rows>0) {
		while($myrow23 = $result23->fetch_assoc()) {
		$found23 = 1;
		$ctr23 += 1;
		$employeeid23 = $myrow23['employeeid'];
		$name_last23 = $myrow23['name_last'];
		$name_first23 = $myrow23['name_first'];
		$name_middle23 = $myrow23['name_middle'];

      
		// $res24query="SELECT tblhrtaemptimelog.idhrtaemptimelog, tblhrtaemptimelog.employeeid, tblhrtaemptimelog.logdate, tblhrtaemptimelog.timein, tblhrtaemptimelog.timeout, tblhrtaemptimelog.otbeforeinsw, tblhrtaemptimelog.otafteroutsw, tblhrtaemptimelog.restdaysw, tblhrtaemptimelog.nextdaysw, tblhrtaemptimelog.mealallowsw, tblhrtaemptimelog.leavetype, tblhrtaemptimelog.leaveduration, tblhrtaemptimelog.manualcompsw, tblhrtaemptimelog.totaltime, tblhrtaemptimelog.otval, tblhrtaemptimelog.utval, tblhrtaemptimelog.otutval, tblhrtaemptimelog.nightdiffval, tblhrtaemptimelog.nootsw, tblhrtaemptimelog.noutsw, tblhrtaemptimelog.projcharge, tblhrtaemptimelog.projpercent, tblhrtaemptimelog.nofindings, tblhrtaemptimelog.remarks, tblhrtaemptimelog.leaveid, tblhrtaemptimelog.holiday, tblhrtaemptimelog.timein2, tblhrtaemptimelog.timeout2, tblhrtaemptimelog.nextday2insw, tblhrtaemptimelog.nextday2outsw, tblhrtaemptimelog.otordval, tblhrtaemptimelog.otrestval, tblhrtaemptimelog.otlegalval, tblhrtaemptimelog.otrest8val, tblhrtaemptimelog.otspsunval, tblhrtaemptimelog.otspsun8val, tblhrtaemptimelog.otlegal8val, tblhrtaemptimelog.otlegalsunval, tblhrtaemptimelog.otlegalsun8val, tblhrtaemptimelog.otspval, tblhrtaemptimelog.otsp8val, tblhrtapaygrpemplst.contactid, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday, tblhrtapaygrpemplst.projcode, tblhrtapaygrpemplst.projchgtyp, tblhrtapaygrpemplst.allowotdflt, tblhrtapaygrpemplst.allowotbfidflt, tblhrtapaygrpemplst.activesw, tblhrtapaygrpemplst.projassignid, tblhrtapaygrpemplst.flexitime, tblhrtapayshiftctg.shiftin, tblhrtaholidays.holidaytype, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid=tblhrtapaygrpemplst.employeeid LEFT JOIN tblhrtapayshiftctg ON tblhrtapaygrpemplst.idhrtapayshiftctg=tblhrtapayshiftctg.idhrtapayshiftctg LEFT JOIN tblhrtaholidays ON tblhrtaemptimelog.logdate=tblhrtaholidays.applic_date LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtaemptimelog.employeeid=\"$employeeid23\" AND  tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.employeeid=tblcontact.employeeid GROUP BY idhrtaemptimelog ORDER BY tblhrtaemptimelog.employeeid ASC";

		$res24query = "SELECT 
    tblhrtaemptimelog.*, 
    tblhrtapaygrpemplst.*, 
    tblhrtapayshiftctg.*, 
    tblhrtaholidays.*, 
    tblcontact.name_last, 
    tblcontact.name_first
FROM 
    tblhrtaemptimelog
LEFT JOIN 
    tblhrtapaygrpemplst ON tblhrtaemptimelog.employeeid = tblhrtapaygrpemplst.employeeid
LEFT JOIN 
    tblhrtapayshiftctg ON tblhrtapaygrpemplst.idhrtapayshiftctg = tblhrtapayshiftctg.idhrtapayshiftctg
LEFT JOIN 
    tblhrtaholidays ON tblhrtaemptimelog.logdate = tblhrtaholidays.applic_date
LEFT JOIN 
    tblcontact ON tblhrtapaygrpemplst.contactid = tblcontact.contactid
WHERE 
    tblhrtaemptimelog.idpaygroup = $idpaygroup
    AND tblhrtaemptimelog.idcutoff = $idcutoff
	AND tblhrtaemptimelog.employeeid=$employeeid23
GROUP BY 
    tblhrtaemptimelog.idhrtaemptimelog
ORDER BY 
    tblhrtaemptimelog.employeeid ASC";
// echo $res24query . "<br>";
		

	
		$result24=""; $found24=0; $ctr24=0;
		$result24 = $dbh2->query($res24query);
		if($result24->num_rows>0) {
			while($myrow24 = $result24->fetch_assoc()) {
			$found24=1;

			$mealallowsw24 = $myrow24['mealallowsw'];
			$leavetype24 = $myrow24['leavetype'];
			$leaveduration24 = $myrow24['leaveduration'];
			$totaltime24 = $myrow24['totaltime'];
			$otval24 = $myrow24['otval'];
			$utval24 = $myrow24['utval'];
			$otutval24 = $myrow24['otutval'];
			$nightdiffval24 = $myrow24['nightdiffval'];
			$name_last24 = $myrow24['name_last']; 
			$name_first24 = $myrow24['name_first']; 
			$name_middle24 = $myrow24['name_middle']; 
			$transpo = $myrow24['transpo'];
		// compute
		// echo "<tr><td colspan=\"5\">compute eid:$employeeid23, curr:$empidcurr, nxt:$empidnxt</td></tr>";
		// compute total
			$tot_totaltime += $totaltime24;
			$tot_otval += $otval24;
			$tot_utval += $utval24;
			$tot_otutval += $otutval24;
			$tot_ndval += $nightdiffval24;
			$tot_meal += $mealallowsw24;
			$tot_trans += $transpo;
			
			if($leavetype24!="" && $leaveduration24!=0) {
				if($leavetype24=="sick" || $leavetype24 =="hds") {
					$tot_lvtyp_sick +=  $leaveduration24;
				} else if($leavetype24 == "vacation" || $leavetype24 == "hdv") {
    			$tot_lvtyp_vacation += $leaveduration24; // Now combines vacation + hdv
				} else if($leavetype24 =="paternity") {
					$tot_lvtyp_paternity = $leaveduration24;
				} else if($leavetype24 =="maternityn") {
					$tot_lvtyp_maternityn = $leaveduration24;
				} else if($leavetype24 =="maternityc") {
					$tot_lvtyp_maternityc = $leaveduration24;
				} else if($leavetype24 =="special") {
					$tot_lvtyp_special = $leaveduration24;
				} else if($leavetype24 =="accumulated") {
					$tot_lvtyp_accumulated = $leaveduration24;
				} else if($leavetype24 =="absent") {
					$tot_lvtyp_absent = $leaveduration24;
				} else if($leavetype24 =="sd") {
					$tot_lvtyp_sd = $leaveduration24;
				} else if($leavetype24 =="cc") {
					$tot_lvtyp_cc = $leaveduration24;
				} else if($leavetype24 =="ob") {
					$tot_lvtyp_ob = $leaveduration24;
				} else {
					// do nothing
				} // if($leavetype23=="sick")

				$totalVacation = $tot_lvtyp_vacation + $tot_lvtyp_hdv;
				$totalSick = $tot_lvtyp_sick + $tot_lvtyp_hds;
			} // if($leavetype23!="" && $leaveduration23!=0)

			} // while($myrow24 = $result24->fetch_assoc())

			
		} // if($result24->num_rows>0)

	
	
			$ctr23b += 1;
			
			echo "<tr>";
			
// 					echo "<td> Total Sick Leave: " . $tot_lvtyp_sick . "<br>";
// echo "Total Vacation Leave: " . $tot_lvtyp_vacation . "<br>";
// echo "Total Paternity Leave: " . $tot_lvtyp_paternity . "<br>";
// echo "Total Maternity (Normal) Leave: " . $tot_lvtyp_maternityn . "<br>";
// echo "Total Maternity (CS) Leave: " . $tot_lvtyp_maternityc . "<br>";
// echo "Total Special Leave: " . $tot_lvtyp_special . "<br>";
// echo "Total Accumulated Leave: " . $tot_lvtyp_accumulated . "<br>";
// echo "Total Absent: " . $tot_lvtyp_absent . "<br>";
// echo "Total SD Leave: " . $tot_lvtyp_sd . "<br>";
// echo "Total CC Leave: " . $tot_lvtyp_cc . "<br>";
// echo "Total OB Leave: " . $tot_lvtyp_ob . "<br>";
// echo "Total HDS Leave: " . $tot_lvtyp_hds . "<br>";
// echo "Total HDV Leave: " . $tot_lvtyp_hdv . "<br> </td>";
			echo"
			<td>$name_last23, $name_first23 $name_middle23[0] ($employeeid23)</td>";
			if($tot_totaltime!=0) {
			echo "<td align=\"right\">".number_format($tot_totaltime, 2)."</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_otval!=0) {
			echo "<td align=\"right\">".number_format($tot_otval, 2)."</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_utval!=0) {
				if($tot_utval<0) {
				echo "<td align=\"right\"><font color=\"red\">".number_format($tot_utval, 2)."</font></td>";
				} else {
				echo "<td align=\"right\">".number_format($tot_utval, 2)."</td>";
				}
			} else {
			echo "<td align=\"center\">-</td>";
			}
			// if($tot_otutval!=0) {
			// 	if($tot_otutval<0) {
			// 	echo "<td align=\"right\"><font color=\"red\">".number_format($tot_otutval, 2)."</font></td>";
			// 	} else {
			// 	echo "<td align=\"right\">".number_format($tot_otutval, 2)."</td>";
			// 	}
			// } else {
			// echo "<td align=\"center\">-</td>";
			// }
			if($tot_ndval!=0) {
			echo "<td align=\"right\">".number_format($tot_ndval, 2)."</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_meal!=0) {
			echo "<td align=\"center\">$tot_meal</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}

			if($tot_trans!=0) {
				echo "<td align=\"center\">$tot_trans</td>";
				} else {
				echo "<td align=\"center\">-</td>";
				}


			if($tot_lvtyp_vacation!=0 || $tot_lvtyp_hdv!=0) {
		
			echo "<td align=\"center\">$totalVacation </td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}


			if($tot_lvtyp_sick!=0 || $tot_lvtyp_hds!=0) {

			echo "<td align=\"center\">$totalSick</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}


			if($tot_lvtyp_sd!=0) {
			echo "<td align=\"center\">$tot_lvtyp_sd</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_lvtyp_cc!=0) {
			echo "<td align=\"center\">$tot_lvtyp_cc</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_lvtyp_ob!=0) {
			echo "<td align=\"center\">$tot_lvtyp_ob</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}
			if($tot_lvtyp_special!=0) {
			echo "<td align=\"center\">$tot_lvtyp_special</td>";
			} else {
			echo "<td align=\"center\">-</td>";
			}
			echo "</tr>";
			// reset totals
			$tot_totaltime=0; $tot_otval=0; $tot_utval=0; $tot_otutval=0; $tot_ndval=0; $tot_meal=0; $tot_lvtyp_sick=0; $tot_lvtyp_vacation=0; $tot_lvtyp_paternity=0; $tot_lvtyp_maternityn=0; $tot_lvtyp_maternityc=0; $tot_lvtyp_special=0; $tot_lvtyp_accumulated=0; $tot_lvtyp_absent=0; $tot_lvtyp_sd=0; $tot_lvtyp_cc=0; $tot_lvtyp_ob=0; $fintxtlvtyp=""; $fintotlvdur=0;$tot_trans=0;

		} // while($myrow23 = mysql_fetch_row($result23))
	} // if($result23 != "")

	// echo "<tr>";
	// echo "<td colspan='15'>";
	// echo "<form method='POST' action='payrollProcess.php?loginid=$loginid' name='processPayrollForm'>";
	// echo "<input type='hidden' name='idpaygroup' value='".$idpaygroup."' />";
	// echo "<input type='hidden' name='idcutoff' value='".$idcutoff."' />";
 //    echo "<button class='btn btn-success'>Process Payroll</button>";
 //    echo "</form>";
	// echo "</td>";
	// echo "</tr>";
	echo "</table>";
	//
	// end display of summarized list

	} // if($disptyp=="detailed")







?>




<style>
	#sumtbl th, td{
		text-align: center !important;
	}
	.floatmenot {
		background-color: #065535;
		right: 2%;
		bottom: 3%;
		border: 1px;
		padding: 10px;
		border-radius: 100%;
		position: fixed !important;
	}
	.floatmenot i{
		color: white;
	}
        table {
            width: 100%;
            border-collapse: collapse;
			white-space: nowrap !important;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
           
        }
        .warning {
            background-color: #e7e0bd;
        }
        .success {
            background-color: #c1d8b7;
            color: white;
        }
        .white {
            background-color: white;
        }
        @media print {
            @page {
                size: A3 landscape;
                margin: 20mm; /* Adjust margins as needed */
            }
			body {
        -webkit-print-color-adjust: exact !important; /* For Chrome */
        print-color-adjust: exact !important; /* For other browsers */
    }
            table {
                width: 100%; /* Ensure the table uses the full width */
            }
        }
    </style>



<script>
 function printTable() {
        const table = document.getElementById('this');
        const newWindow = window.open('', '_blank');
        newWindow.document.write('<html><head><title>Time log Summary</title>');
        newWindow.document.write('<style>');
        newWindow.document.write('table{font-size: 10px; font-family: "Trebuchet MS", sans-serif;}');
		
        newWindow.document.write('#this table { width: 100%; border-collapse: collapse;  white-space: nowrap; text-align: center;  color: black; }');
        newWindow.document.write('th, td { border: 1px solid black; padding: 5px;}');
        newWindow.document.write('th {background-color: gray; color: white;}');

        newWindow.document.write('h1{text-align: center; }');



        newWindow.document.write('.warning { background-color: #e7e0bd; }');
        newWindow.document.write('.success { background-color: #c1d8b7; }');
        newWindow.document.write('.white { background-color: white; }');
        newWindow.document.write('@media print { @page { size: A3 landscape; margin: 5mm; } }');
        newWindow.document.write('</style>');
        newWindow.document.write('</head><body>');


	
        newWindow.document.write(table.outerHTML);
   
		
        newWindow.document.write('</body></html>');
        newWindow.document.close();
        newWindow.print();
    }


</script>


<style>





#this th {
  flex: 1; /* Distribute space evenly */
  white-space: nowrap; /* Prevent wrapping */
  position: sticky !important;
  top: 6rem !important;
  text-align: center !important;
}



 #this {
	padding: 2px !important;
	border-collapse: separate !important; 
	z-index: -1;
}





		
</style>


<script>
//        let currentTr = null;

// // Use event delegation to handle hover and keydown events
// document.getElementById('this').addEventListener('mouseover', function (e) {
// 	// Check if the hovered element is a <tr> with the class 'table-row'
// 	if (e.target && e.target.closest('tr.table-row')) {
// 		currentTr = e.target.closest('tr.table-row');
// 	}
// });

// document.addEventListener('keydown', function (event) {
// 	if (!currentTr) return;

// 	switch (event.key.toLowerCase()) {
// 		case 'g':  // Orange
// 			currentTr.classList.remove('blue', 'yellow', 'reset', 'orange');
// 			currentTr.classList.add('green');
// 			break;
// 		case 'o':  // Orange
// 			currentTr.classList.remove('blue', 'yellow', 'reset', 'green');
// 			currentTr.classList.add('orange');
// 			break;
// 		case 'b':  // Blue
// 			currentTr.classList.remove('orange', 'yellow', 'reset', 'green');
// 			currentTr.classList.add('blue');
// 			break;
// 		case 'y':  // Yellow
// 			currentTr.classList.remove('blue', 'orange', 'reset', 'green');
// 			currentTr.classList.add('yellow');
// 			break;
// 		case 'c':  // Reset
// 			currentTr.classList.remove('orange', 'blue', 'yellow', 'green');
// 			currentTr.classList.add('reset');
// 			break;
// 	}
// });
</script>
