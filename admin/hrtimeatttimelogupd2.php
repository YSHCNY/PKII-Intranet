<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff = (isset($_GET['idct'])) ? $_GET['idct'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$idhrtapaygrpemplst = (isset($_POST['idhrtapaygrpemplst'])) ? $_POST['idhrtapaygrpemplst'] :'';

// $nofindings = (isset($_POST['nofindings'])) ? $_POST['nofindings'] :'';

// arrays
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';

$restdaysw = (isset($_POST['restdaysw'])) ? $_POST['restdaysw'] :'';

$time_in1_hh = (isset($_POST['time_in1_hh'])) ? $_POST['time_in1_hh'] :'';
$time_in1_mm = (isset($_POST['time_in1_mm'])) ? $_POST['time_in1_mm'] :'';

$otbeforeinsw = (isset($_POST['otbeforeinsw'])) ? $_POST['otbeforeinsw'] :'';

$time_out1_hh = (isset($_POST['time_out1_hh'])) ? $_POST['time_out1_hh'] :'';
$time_out1_mm = (isset($_POST['time_out1_mm'])) ? $_POST['time_out1_mm'] :'';

$totaltime = (isset($_POST['totaltime'])) ? $_POST['totaltime'] :'';

$otafteroutsw = (isset($_POST['otafteroutsw'])) ? $_POST['otafteroutsw'] :'';

$nextday = (isset($_POST['nextday'])) ? $_POST['nextday'] :'';

$mealallow = (isset($_POST['mealallow'])) ? $_POST['mealallow'] :'';

$leaveid = (isset($_POST['leaveid'])) ? $_POST['leaveid'] :'';
$leavecd = (isset($_POST['leavecd'])) ? $_POST['leavecd'] :'';
$leavedaydur = (isset($_POST['leavedaydur'])) ? $_POST['leavedaydur'] :'';
 
$projcharge = (isset($_POST['projcharge'])) ? $_POST['projcharge'] :'';

$checkboxman = (isset($_POST['checkboxman'])) ? $_POST['checkboxman'] :'';
$otval = (isset($_POST['otval'])) ? $_POST['otval'] :'';
$utval = (isset($_POST['utval'])) ? $_POST['utval'] :'';
$otutval = (isset($_POST['otutval'])) ? $_POST['otutval'] :'';

$nightdiffval = (isset($_POST['nightdiffval'])) ? $_POST['nightdiffval'] :'';

$nofindings = (isset($_POST['nofindings'])) ? $_POST['nofindings'] :'';

$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

echo "<html><pre>";

echo "<p>vartests...<br>GET: loginid:$loginid, idpaygroup:$idpaygroup, idcutoff:$idcutoff<br>";
echo "POST: EmpID:$employeeid, idhrtapaygrpemplst:$idhrtapaygrpemplst</p>";

echo "<p>Arrays:<br>";

    // start for loop
    foreach($cutstart as $val => $n) {

    echo "cutstart:".$cutstart[$val].", val:$val, n:$n, restdaysw:".$restdaysw[$val].", timeinhh:".$time_in1_hh[$val].", timeinmm:".$time_in1_mm[$val].", otbeforeinsw:".$otbeforeinsw[$val].", timeouthh:".$time_out1_hh[$val].", timeoutmm:".$time_out1_mm[$val].", totaltime:".$totaltime[$val].", otafteroutsw:".$otafteroutsw[$val]."<br>nextday:".$nextday[$val].", mealallow:".$mealallow[$val].", leavid:".$leaveid[$val].", leavecd:".$leavecd[$val]."; leavedaydur:".$leavedaydur[$val].", projcharge:".$projcharge[$val]."<br>";

        // prepare variables
	$leavetypeval = $leavecd[$val];

	// format time in yyyy-mm-dd hh:mm:ss
	$timein1a = $n." ".$time_in1_hh[$val].":".$time_in1_mm[$val].":00";
	$timein1b = $time_in1_hh[$val].":".$time_in1_mm[$val].":00";
	$timein1c = strtotime($timein1b);
	$timein1 = date("Y-m-d H:i:s", strtotime($timein1a));
	$timein1unx = strtotime($timein1);
	if($nextday[$val]==1) {
	// add 1 day
	    $n2 = date("Y-m-d", strtotime($n . " +1 days"));
	} else {
	    $n2 = date("Y-m-d", strtotime($n));
	} //if-else
	$timeout1a = $n2." ".$time_out1_hh[$val].":".$time_out1_mm[$val].":00";
	$timeout1 = date("Y-m-d H:i:s", strtotime($timeout1a));
	// for db insert update purposes only
	// $timeout1b = $n." ".$time_out1_hh[$val].":".$time_out1_mm[$val].":00";
	$timeout1b = $n2." ".$time_out1_hh[$val].":".$time_out1_mm[$val].":00";
	$timeout1c = date("Y-m-d H:i:s", strtotime($timeout1b));
	$timeout1unx = strtotime($timeout1c);

        // compute totaltime in decimal by hour
	$totaltime[$val] = ((strtotime($timeout1) - strtotime($timein1))/60)/60;
  // echo "test03 $n tottime:".$totaltime[$val].",";

        // deduct lunch break
	if((strtotime($timein1)<=strtotime("$n 12:00 pm")) && (strtotime($timeout1)>=strtotime("$n 01:00 pm"))) {
	    $totaltime[$val] = (((strtotime($timeout1) - strtotime($timein1))/60)/60) - 1;
	} //if
  // echo " tottimewlunch:".$totaltime[$val]." ";


    // start loop for manual checkbox
    $checkboxmanual=0;
    foreach($checkboxman as $val3 => $n3) {
        if($n3==$n) { $checkboxmanual=1; }
    } //foreach($checkboxman as $val3 => $n3)

    $otvalman=0; $utvalman=0; $otutuvalman=0; $nightdiffvalman=0;
    if($checkboxmanual==1) {
        // get input fields POST vars as manual entries
        $otvalman = $otval[$val];
	$utvalman = $utval[$val];
        $otutvalman = $otutval[$val];
	$nightdiffvalman = $nightdiffval[$val];

    } else { //if-else if(checkboxmanual==1)
        // proceed to compute

			// compute otutval
			if($restdaysw[$val] == 1) {
			// $otutval[$val] = $totaltime[$val];
				// added 20161116
				// check if($otafterouwsw==1)
				// if($otafteroutsw[$val] == "1") {
					// $otutval[$val] = $totaltime[$val];
				// } else {
					// $otutval[$val] = 0;
				// } // if($otafteroutsw[$val] == "1")
        $otval1 = $totaltime[$val];
        $otutval1 = $totaltime[$val];
        $utval1 = $utval[$val];
			} else {
				// get emp shiftinoutcateg
				$res21query="SELECT tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapayshiftctg.shiftin, tblhrtapayshiftctg.shiftout, tblhrtapayshiftctg.lunchstart, tblhrtapayshiftctg.lunchend FROM tblhrtapaygrpemplst LEFT JOIN tblhrtapayshiftctg ON tblhrtapaygrpemplst.idhrtapayshiftctg=tblhrtapayshiftctg.idhrtapayshiftctg WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblhrtapaygrpemplst.idtblhrtapaygrp=$idpaygroup";
				$result21=""; $found21=0; $ctr21=0;
				$result21 = $dbh2->query($res21query);
				if($result21->num_rows>0) {
					while($myrow21 = $result21->fetch_assoc()) {
					$found21 = 1;
					$idhrtapayshiftctg21 = $myrow21['idhrtapayshiftctg'];
					$shiftin21 = $myrow21['shiftin'];
					$shiftout21 = $myrow21['shiftout'];
					$lunchstart21 = $myrow21['lunchstart'];
					$lunchend21 = $myrow21['lunchend'];

					$shiftina = $n." ".$shiftin21;
					$shiftouta = $n." ".$shiftout21;
					$shiftin = date("Y-m-d H:i:s", strtotime($shiftina));
					$shiftout = date("Y-m-d H:i:s", strtotime($shiftouta));
					$shiftinunx = strtotime($shiftin);
					$shiftoutunx = strtotime($shiftout);

					$lunchstarta = $n." ".$lunchstart21;
					$lunchenda = $n." ".$lunchend21;
					$lunchstart = date("Y-m-d H:i:s", strtotime($lunchstarta));
					$lunchend = date("Y-m-d H:i:s", strtotime($lunchenda));
					$lunchstartunx = strtotime($lunchstart);
					$lunchendunx = strtotime($lunchend);
					// $lunchdur = strtotime($lunchend21) - strtotime($lunchstart21);
					$lunchdur = $lunchendunx - $lunchstartunx;

					// get halfoutam
					$halfoutam0 = strtotime('+ 4 hours', $shiftinunx);
					if(($halfoutam0 > $lunchstartunx) && ($halfoutam0 < $lunchendunx)) {
						// deduct lunch brk
						$halfoutamdiff = $lunchendunx - $halfoutam0;
						$halfoutamunx = $lunchendunx + $halfoutamdiff;
					} else if ($halfoutam0 >= $lunchendunx) {
						$halfoutamunx = strtotime('+ 1 hours', $halfoutam0);
					} else {
						$halfoutamunx = $halfoutam0;
					} // if($halfoutam0 > $lunchstart)
					$halfoutam = date("Y-m-d H:i:s", $halfoutamunx);

					// get halfinpm
					$halfinpm0 = strtotime('-4 hours', $shiftoutunx);
					if(($halfinpm0 > $lunchstartunx) && ($halfinpm0 < $lunchendunx)) {
						// deduct lunch brk
						$halfinpmdiff = $halfinpm0 - $lunchstartunx;
						$halfinpmunx = $lunchstartunx - $halfinpmdiff;
					} else {
						$halfinpmunx = $halfinpm0;
					} // if(($halfinpm0 > strtotime($lunchstart21)) && ($halfinpm0 < strtotime($lunchend21)))
					$halfinpm = date("Y-m-d H:i:s", $halfinpmunx);

					} // while($myrow21 = $result21->fetch_assoc())
				} // if($result21->num_rows>0)

  // echo "<br>shiftin:$shiftin, shiftout:$shiftout, lunchstart:$lunchstart|$halfoutam, lunchend:$lunchend|$halfinpm ";

				// check for leaves first
				if(($leavecd[$val] != "") && ($leavedaydur[$val] != "0.00")) {
					// echo "test0 leavecd & leavedaydur not null\n";
					if($leavecd[$val] == "absent") {
					// echo "test1a with leavecd absent\n";
						if($leavedaydur[$val]=="1.00") {
							$totaltime[$val] = 8;
							$otutval[$val] = 0;
						} else if($leavedaydur[$val]=="0.50a") {
							// get pm half-day shift schedule
							$shiftpmin0 = strtotime('-4 hours', $shiftout21);
							if($shiftpmin0>=$lunchend) {
								$shiftpmin = $shiftpmin0;
							} else {
								// deduct lunch break
								if($shiftpmin0<=$lunchstart) {

								} // if($shiftpmin0<=$lunchstart)
							}// if($shiftpmin0>=$lunchend21)
						} else if($leavedaydur[$val]=="0.50p") {

						} // if($leavedaydur[$val]==1)
					} else {
						// echo "test1b with leavecd not absent\n";
						if($leavedaydur[$val]=="1.00") {
							// echo "test2 leavedur:1\n";
							$otutval[$val] = $totaltime[$val] - 8;
						} else if($leavedaydur[$val]=="0.50a") {
							// echo "test2 leavedur:".$leavedaydur[$val]." halfinpm:$halfinpm|".strtotime($halfinpm)."|".date("H:i:s", $halfinpm)."\n";
							// check leave credits balance if enough for deduction
							$leavedaydurval = 0.5;
							$leavereqtot = $leavereqtot + $leavedaydurval;
							include("hrtimeatttimelogchkleavcr.php");
							if($leavereqstat==1) {
								// compute total time of half-day pm
								$totaltime[$val] = (((strtotime($timeout1) - strtotime($timein1))/60)/60) + 4;
								// deduct lunch break
								if(strtotime($timein1) <= strtotime($lunchstart)) {
									$totaltime[$val] = $totaltime[$val] - 1;
									$cond = "timein1b <= lunchstart";
								} else if((strtotime($timein1) > strtotime($lunchstart)) && (strtotime($timein1) < strtotime($lunchend))) {
									// compute lunch time diff and deduct in totaltime
									$lunchdiff = ((strtotime($lunchend) - strtotime($timein1))/60)/60;
									$totaltime[$val] = $totaltime[$val] - $lunchdiff;
									$cond = "timein1b > lunchstart & < lunchend";
								} // if($timein1c <= strtotime($lunchstart21))
							} else { // if($leavereqstat==1)
								// deny leave request, revert to absent
								$leavetypeval = "absent";
								$totaltime[$val] = (((strtotime($timeout1) - strtotime($timein1))/60)/60) + 4;
								// deduct lunch break
								if(strtotime($timein1) <= strtotime($lunchstart21)) {
									$totaltime[$val] = $totaltime[$val] - 1;
								} else if((strotime($timein1) > strtotime($lunchstart21)) && ($timein1 <= strtotime($lunchend21))) {
									// compute lunch time diff and deduct in totaltime
									$lunchdiff = strotime($lunchend21) - strtotime($timein1);
									$totaltime[$val] = $totaltime[$val] - $lunchdiff;
								} // if($halfoutam0 >= strtotime($lunchend21))
							} // if($leavereqstat==1)

							// prepare half-day variables for otut
							$shiftinunx = $halfinpmunx;
							// $shiftout = $halfoutam;
							include("hrtimeattotutval.php");
			
							// echo "test2 leavetyp:$leavetypeval leavereqstat:$leavereqstat fnd20:$found20 loc:pre-lunch cond:$cond \n";
							// echo "test3 inout:$timein1unx-to-$timeout1unx shift:$shiftinunx-to-$shiftoutunx lunch:$lunchstartunx-to-$lunchendunx half:$halfoutamunx|$halfinpmunx\n";
							// echo "test4 otbeforein:$otbeforeinval otafterout:$otafteroutval utbeforein:$utbeforeinval\n";
							// echo "test5 lvreqstat:$leavereqstat timelog:".strtotime($timein1)."-to-".strtotime($timeout1)." shift:".strtotime($shiftin)."|$halfinpm-to-".strtotime($shiftouta)." half:$halfoutam|$halfinpm lunch:".strtotime($lunchstart)."-to-".strtotime($lunchend21)." lunchdur:$lunchdur lunchdiff:$lunchdiff halfinpm0:".date("H:i:s", $halfinpm0)." diff:$halfinpmdiff  tottime:".$totaltime[$val]." leavereqtot:$leavereqtot \n";
							// echo "test5b halfinpm0:$halfinpm0 diff:$halfinpmdiff halfinpm:$halfinpm halfinpmunx:$halfinpmunx\n";
							// echo "test6 otin:".$otbeforeinsw[$val]." otout:".$otafteroutsw[$val]." otbeforein:$otbeforeinval otafterout:$otafteroutval utbeforein:$utbeforeinval otutval:$otutval \n";
						} else if($leavedaydur[$val]=="0.50p") {
							// echo "test2 leavedur:0.50p halfoutam:$halfoutam|".strtotime($halfoutam)."|".date("H:i:s", $halfoutam)."\n";
							// check leave credits balance if enough for deduction
							$leavedaydurval = 0.5;
							$leavereqtot = $leavereqtot + $leavedaydurval;
							include("hrtimeatttimelogchkleavcr.php");
							if($leavereqstat==1) {
								// compute total time of half-day pm
								$totaltime[$val] = (((strtotime($timeout1) - strtotime($timein1))/60)/60) + 4;
								// deduct lunch break
								if($timeout1unx >= $lunchendunx) {
									$totaltime[$val] = $totaltime[$val] - 1;
									$cond = "timeout1 >= lunchend";
								} else if(($timeout1unx >= $lunchstartunx) && ($timeout1unx <= $lunchendunx)) {
									// compute lunch time diff and deduct in totaltime
									$lunchdiff = (($timeout1unx - $lunchstartunx)/60)/60;
									$totaltime[$val] = $totaltime[$val] - $lunchdiff;
									$cond = "timeout1 > lunchstart & < lunchend";
								} // if($halfoutam0 >= strtotime($lunchend21))
							} else { // if($leavereqstat==1)
								// deny leave request, revert to absent
								$leavetypeval = "absent";
								$totaltime[$val] = (((strtotime($timeout1) - strtotime($timein1))/60)/60) + 4;
								// deduct lunch break
								if($timeout1unx >= $lunchendunx) {
									$totaltime[$val] = $totaltime[$val] - 1;
									$cond = "timeout1 >= lunchend";
								} else if(($timeout1unx >= $lunchstartunx) && ($timeout1unx <= $lunchendunx)) {
									// compute lunch time diff and deduct in totaltime
									$lunchdiff = (($timeout1unx - $lunchstartunx)/60)/60;
									$totaltime[$val] = $totaltime[$val] - $lunchdiff;
									$cond = "timeout1 > lunchstart & < lunchend";
								} // if($halfoutam0 >= strtotime($lunchend21))
							} // if($leavereqstat==1)

							// prepare half-day variables for otut
							// $shiftinunx = $halfinpmunx;
							$shiftoutunx = $halfoutamunx;
							include("hrtimeattotutval.php");
							/*
							echo "test3 inout:$timein1unx-to-$timeout1unx shift:$shiftinunx-to-$shiftoutunx lunch:$lunchstartunx-to-$lunchendunx half:$halfoutamunx,$halfoutam|$halfinpmunx\n";
							echo "test4 otbeforein:$otbeforeinval otafterout:$otafteroutval utbeforein:$utbeforeinval\n";
							echo "test5 lvreqstat:$leavereqstat shift:$shiftin21-to-$shiftout21 lunch:$lunchstart21-to-$lunchend21 lunchdur:$lunchdur halfinam:$halfinam halfoutam0:".date("H:i:s", $halfoutam0)." lunchstart0:$lunchstart0 diff:$halfoutamdiff tottime:".$totaltime[$val]."\n";
							echo "test6 otin:".$otbeforeinsw[$val]." otout:".$otafteroutsw[$val]." otbeforein:$otbeforeinval otafterout:$otafteroutval utbeforein:$utbeforeinval otutval:".$otutval[$val]."\n";
							*/
						} // if($leavedaydur[$val]==1)
					} // if($leavecd[$val] == "absent")
				} else {
					// compute otut
					include("hrtimeattotutval.php");
				}
			} // end if($restdaysw[$val] == 1)

			// put in array otutval
			// $otutval[$val] = $otutval;

			// compute night differential
			if(strtotime($timeout1) > strtotime("$n 10:00 pm")) {
				// $nightdiffval[$val] = ((strtotime($timeout1) - strtotime("$n 10:00 pm"))/60)/60;
				$nightdiffval2[$val] = ((strtotime($timeout1) - strtotime("$n 10:00 pm"))/60)/60;
			} else {
                            $nightdiffval2[$val]=0;
                        } // if
			
			// echo "test1 $n chk:$checkboxmanual, timein:".$timein1." timeout:".$timeout1." totaltime:".$totaltime[$val].", ot:".$otval[$val].", ut:".$utval[$val].", otutval:".$otutval[$val].", nightdiff:".$nightdiffval[$val]."\n";

    } //if-else if(checkboxmanual==1)

    // start loop for no_findings checkbox
    $nofindingsval=0;
    foreach($nofindings as $val2 => $n2) {
        if($n2==$n) { $nofindingsval=1; }
    } // foreach($nofindings as $val2 => $n2)

    echo "checkboxmanual:".$checkboxmanual.", otval:$otvalman|".$otval[$val].", utval:$utvalman|".$utval[$val].", otutval:$otutvalman|".$otutval[$val].", nightdiffval:$nightdiffvalman|".$nightdiffval[$val]."|".$nightdiffval2[$val].", nofindingsval:$nofindingsval, remarks:".$remarks[$val]."\r\n<br>";

    // prepare variables
			$otbeforeinswval = $otbeforeinsw[$val];
			$otafteroutswval = $otafteroutsw[$val];
			$restdayswval = $restdaysw[$val];
			$nextdayswval = $nextday[$val];
			$mealallowswval = $mealallow[$val];
			// $leavetypeval = $leavecd[$val];
			// $leavedurationval = $leavedaydur[$val];
			// $totaltimeval = round($totaltime[$val], 2);
			$totaltimeval = $totaltime[$val];

            // set fin vars to 0 first
            $otvalfin=0; $utvalfin=0; $otutuvalfin=0; $nightdiffvalfin=0;
            if($checkboxmanual==1) {
            // echo "test0 $n chk:$checkboxmanual, ot:".$otval[$val].", ut:".$utval[$val].", otutval:".$otutval[$val].", nightdiff:".$nightdiffval[$val]."\n";
            // $totaltimeval = $totaltime[$val];
            $otvalfin = $otvalman;
            $utvalfin = $utvalman;
            $otutvalfin = $otutvalman;
            $nightdiffvalfin = $nightdiffvalman;
            } else {
		$otvalfin = round($otval1, 2);
		$utvalfin = round($utval1, 2);
		$otutvalfin = round($otutval1, 2);
		$nightdiffvalfin = $nightdiffval2[$val];
            } // if-else

			// $otval = round($otval[$val], 2);
			// $utval = round($utval[$val], 2);
			// $otutval = $otutval[$val];
			// $nightdiffval = round($nightdiffval2[$val], 2);
			$projchargeval = $projcharge[$val];
			$remarksval = $remarks[$val];
			// $remarksval = "rest:$restdayswval, tottime:$totaltimeval, otut:$otutval, ot:$otval, ut:$utval";
			// if($leavetypeval=="") { $leavedurationval=0; } else { $leavedurationval=1; }
			if($nightdiffval=="") { $nightdiffval=0; }
			
			
			/*$nofindingsval=0;
			foreach($nofindings as $val2 => $n2) {
				if($n2==$n) { $nofindingsval=1; }
			} // foreach($nofindings as $val2 => $n2) */

		//
		// db queries
		//
		// chk if exists and get id and update else insert
		$res11query = "SELECT idhrtaemptimelog FROM tblhrtaemptimelog WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idcutoff=$idcutoff AND logdate=\"$n\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idhrtaemptimelog11 = $myrow11['idhrtaemptimelog'];
			} // while($myrow11 = $result11->fetch_assoc())
		} // if($result11->num_rows>0)

		if($found11 == 1) {
			// update based on id
			if($otutval == ''){
				$otutval = 0;
			}
			$res12update = "UPDATE tblhrtaemptimelog SET timestamp=\"$now\", lastupdate=$loginid, timein='".$timein1."', timeout='".$timeout1c."', otbeforeinsw=$otbeforeinswval, otafteroutsw=$otafteroutswval, restdaysw=$restdayswval, nextdaysw=$nextdayswval, mealallowsw=$mealallowswval, leavetype=\"$leavetypeval\", leaveduration=\"".$leavedaydur[$val]."\", manualcompsw=$checkboxmanual, totaltime=$totaltimeval, otval=$otvalfin, utval=$utvalfin, otutval=$otutvalfin, nightdiffval=$nightdiffvalfin, projcharge=\"$projchargeval\", nofindings=$nofindingsval, remarks=\"$remarksval\" WHERE idhrtaemptimelog=".$idhrtaemptimelog11;
		$result12 = $dbh2->query($res12update);
		echo "r12upd:$res12update";				
			var_dump($result12);
		} else {
			// insert query
			$res12insert = "INSERT INTO tblhrtaemptimelog SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, employeeid=\"$employeeid\", idpaygroup=$idpaygroup, idcutoff=$idcutoff, cutstart=\"$cutstart14\", cutend=\"$cutend14\", logdate=\"$n\", timein=\"$timein1\", timeout=\"$timeout1c\", otbeforeinsw=$otbeforeinswval, otafteroutsw=$otafteroutswval, restdaysw=$restdayswval, nextdaysw=$nextdayswval, mealallowsw=$mealallowswval, leavetype=\"$leavetypeval\", leaveduration=\"".$leavedaydur[$val]."\", manualcompsw=$checkboxmanual, totaltime=$totaltimeval, otval=$otvalfin, utval=$utvalfin, otutval=$otutvalfin, nightdiffval=$nightdiffvalfin, projcharge=\"$projchargeval\", nofindings=$nofindingsval, remarks=\"$remarksval\"";
			$result12 = $dbh2->query($res12insert);
			$insid = mysql_insert_id();
		} // end if($found11 == 1)

		//
		// display vars
		//

		//
		// reset variables
    $otval1=0; $utval1=0; $otutval1=0;

    } // foreach($cutstart as $val => $n)

echo "</p>";

echo "</pre></html>";

	//
	// redirect
	// header("Location: hrtimeatttimelogs.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
	// exit;

	echo "<p><a href=\"hrtimeatttimelogs.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid\">back</a></p>";
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
