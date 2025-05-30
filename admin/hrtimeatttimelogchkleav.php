<?php

if(($leavecd[$val] != "") && ($leavedaydur[$val] != "0.00")) {
					// echo "test0 leavecd & leavedaydur not null\n";
					if($leavecd[$val] == "sd") {
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
								$leavetypeval = "sd";
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
								$leavetypeval = "ob";
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
?>
