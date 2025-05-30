<?php

// compute otut
					// check if($otbeforeinsw==1)
					if(($otbeforeinsw[$val] == 1) && ($timein1unx < $shiftinunx)) {
						if($totaltime[$val] > 8) {
							$otbeforeinval = (($shiftinunx - $timein1unx)/60)/60;
						} else {
							$otbeforeinval = 0;
						} // if($totaltime[$val] > 8)
					} else {
						$otbeforeinval = 0;
					}
  // echo "<br>otbisw:".$otbeforeinsw[$val].", otbeforein:$otbeforeinval ";

					// check if($otafteroutsw==1)
					// if(($otafteroutsw[$val] == "1") && (strtotime($shiftout) < (strtotime($timeout1)))) {
					if($otafteroutsw[$val] == 1) {
						if($totaltime[$val] > 8) {
							if($timeout1unx > $shiftoutunx) {
								$otafteroutval = (($timeout1unx - $shiftoutunx)/60)/60;
							} else {
                $otafteroutval = 0;
              }// if(strtotime($shiftout) > strtotime($timeout1))
						} // if($totaltime[$val] > 8)
  // echo "otaosw:".$otafteroutsw[$val].", otafterout:$otafteroutval ";

						// compute undertime of timein
						if($timein1unx > $shiftinunx) {
							$utbeforeinval = (($timein1unx - $shiftinunx)/60)/60;
						} else {
							$utbeforeinval = 0;
						} // if($timein1unx > $shiftinunx)

						// compute undertime of timeout
						if($timeout1unx < $shiftoutunx) {
							$utafteroutval = (($shiftoutunx - $timeout1unx)/60)/60;
						} else {
							$utafteroutval = 0;
						} // if($timeoutunx < $shiftoutunx)
					} else {
						$otafteroutval = 0; $utbeforeinval = 0; $utafteroutval = 0;
					} // if($otafteroutsw[$val] == 1)

					// compute otutval
					// $otutval[$val] = ($otbeforeinval + $otafteroutval) - $utbeforeinval - $utafteroutval;
					$otutval1 = ($otbeforeinval + $otafteroutval) - $utbeforeinval - $utafteroutval;
					// $utval[$val] = $utbeforeinval + $utafteroutval;
					$utval1 = $utbeforeinval + $utafteroutval;
					// $otval[$val] = $otbeforeinval + $otafteroutval;
					$otval1 = $otbeforeinval + $otafteroutval;

  // echo "<br>otbfinval:$otbeforeinval, otafoutval:$otafteroutval, otutval:".$otutval[$val]."|$otutval1, otval:".$otval[$val]."|$otval1, utbfinval:$utbeforeinval, utafoutval:$utafteroutval, utval:$utval1, toutunx:$timeout1unx, shftoutunx:$shiftoutunx, shiftin:$shiftin, shiftout:$shiftout ";

?>

