<?php
// session
session_start();
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
$holidate = (isset($_POST['holidate'])) ? $_POST['holidate'] :'';


$newempflaghidden = (isset($_POST['newempflaghidden'])) ? $_POST['newempflaghidden'] :'';

$time_in1_hh = (isset($_POST['time_in1_hh'])) ? $_POST['time_in1_hh'] :'';
$time_in1_mm = (isset($_POST['time_in1_mm'])) ? $_POST['time_in1_mm'] :'';

$otbeforeinsw = (isset($_POST['otbeforeinsw'])) ? $_POST['otbeforeinsw'] :'';
$veforeinnew = (isset($_POST['otbeforeinsw'])) ? $_POST['otbeforeinsw'] :'';


$time_out1_hh = (isset($_POST['time_out1_hh'])) ? $_POST['time_out1_hh'] :'';
$time_out1_mm = (isset($_POST['time_out1_mm'])) ? $_POST['time_out1_mm'] :'';

$shiftin20 = (isset($_POST['shiftin20'])) ? $_POST['shiftin20'] : '';
$shiftout20 = (isset($_POST['shiftout20'])) ? $_POST['shiftout20'] : '';


$totaltime = (isset($_POST['totaltime'])) ? $_POST['totaltime'] :'';

$otafteroutsw = (isset($_POST['otafteroutsw'])) ? $_POST['otafteroutsw'] :'';

$nextday = (isset($_POST['nextday'])) ? $_POST['nextday'] :'';

$mealallow = (isset($_POST['mealallow'])) ? $_POST['mealallow'] :'';
$transpo = (isset($_POST['transpo'])) ? $_POST['transpo'] : '';
$leaveid = (isset($_POST['leaveid'])) ? $_POST['leaveid'] :'';
$leavecd = (isset($_POST['leavecd'])) ? $_POST['leavecd'] :'';
$leavedaydur = (isset($_POST['leavedaydur'])) ? $_POST['leavedaydur'] :'';
 
$projcharge = (isset($_POST['projcharge'])) ? $_POST['projcharge'] :'';


$newempcheckbox = (isset($_POST['newempcheckbox'])) ? $_POST['newempcheckbox'] :'';
$checkboxman = (isset($_POST['checkboxman'])) ? $_POST['checkboxman'] :'';
$otval = (isset($_POST['otval'])) ? $_POST['otval'] :'';
$utval = (isset($_POST['utval'])) ? $_POST['utval'] :'';
$otutval = (isset($_POST['otutval'])) ? $_POST['otutval'] :'';

$nightdiffval = (isset($_POST['nightdiffval'])) ? $_POST['nightdiffval'] :'';

$nofindings = (isset($_POST['nofindings'])) ? $_POST['nofindings'] :'';

$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';


//20240802 revive 2nd set of timelog
$time_in2_hh = (isset($_POST['time_in2_hh'])) ? $_POST['time_in2_hh'] :'';
$time_in2_mm = (isset($_POST['time_in2_mm'])) ? $_POST['time_in2_mm'] :'';
$time_out2_hh = (isset($_POST['time_out2_hh'])) ? $_POST['time_out2_hh'] :'';
$time_out2_mm = (isset($_POST['time_out2_mm'])) ? $_POST['time_out2_mm'] :'';
$nextday2in = (isset($_POST['nextday2insw'])) ? $_POST['nextday2insw'] :'';
$nextday2out = (isset($_POST['nextday2outsw'])) ? $_POST['nextday2outsw'] :'';

$realvalwfh = (isset($_POST['realvalwfh'])) ? $_POST['realvalwfh'] :'';
$cityinclude = (isset($_POST['cityinclude'])) ? $_POST['cityinclude'] :'';



$shortenedin = (isset($_POST['shortenedin'])) ? $_POST['shortenedin'] :'';
$shortenedout = (isset($_POST['shortenedout'])) ? $_POST['shortenedout'] :'';




// set fixed vars //20240813
$stdofchrs=8;

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
	
// echo "<html><pre>";

// echo "<p>vartests...<br>GET: loginid:$loginid, idpaygroup:$idpaygroup, idcutoff:$idcutoff<br>";
// echo "POST: EmpID:$employeeid, idhrtapaygrpemplst:$idhrtapaygrpemplst</p>";

// echo "<p>Arrays:<br>";

    // start for loop
    foreach($cutstart as $val => $n) {
        // set blank vars to 0
        if($otbeforeinsw[$val]=="") { $otbeforeinsw[$val]=0; }
        if($otafteroutsw[$val]=="") { $otafteroutsw[$val]=0; }
        if($nextday2in[$val]=="") { $nextday2in[$val]=0; }
        if($nextday2out[$val]=="") { $nextday2out[$val]=0; }


	
        // test disp vars
    // echo "PRE cutstart:".$cutstart[$val].", val:$val, n:$n, restdaysw:".$restdaysw[$val].", timeinhh:".$time_in1_hh[$val].", timeinmm:".$time_in1_mm[$val].", otbeforeinsw:".$otbeforeinsw[$val].", timeouthh:".$time_out1_hh[$val].", timeoutmm:".$time_out1_mm[$val].", totaltime:".$totaltime[$val].", otafteroutsw:".$otafteroutsw[$val]."<br>nextday:".$nextday[$val].", timein2hh:".$time_in2_hh[$val].", timein2mm:".$time_in2_mm[$val].", timeout2hh:".$time_out2_hh[$val].", timeout2mm:".$time_out2_mm[$val].",nextday2in:".$nextday2in[$val].", nextday2out:".$nextday2out[$val].", mealallow:".$mealallow[$val].", leavid:".$leaveid[$val].", leavecd:".$leavecd[$val]."; leavedaydur:".$leavedaydur[$val].", projcharge:".$projcharge[$val]."<br>";
	



        // prepare variables

		$ShortenedTimeInDecimal = (((strtotime($shortenedout[$val]) - strtotime($shortenedin[$val]))/60)/60);


	$leavetypeval = $leavecd[$val];
	if ($realvalwfh[$val] == ""){
		$realvalwfh[$val] = 'NC';
	} else {
		$realvalwfh[$val] = $realvalwfh[$val];
	}


	$flagcity = 0;
	foreach($cityinclude as $valcity){
		if ($valcity == $n){
			$flagcity = 1;
			break;
		} 
	}



		list($hourout, $minuteout) = explode(':', $shiftout20);
		
		$shiftout1a = $n." ".$hourout.":".$minuteout.":00";
		$shiftout1b = $hourout.":".$minuteout.":00";
		$shiftout1c = strtotime($shiftout1b);
		$shiftout1 = date("Y-m-d H:i:s", strtotime($shiftout1a));
		$shiftout1unx = strtotime($shiftout1);


		
		list($hourin, $minutein) = explode(':', $shiftin20);
		
		$shiftin1a = $n." ".$hourin.":".$minutein.":00";
		$shiftin1b = $hourin.":".$minutein.":00";
		$shiftin1c = strtotime($shiftin1b);
		$shiftin1 = date("Y-m-d H:i:s", strtotime($shiftin1a));
		$shiftin1unx = strtotime($shiftin1);
	
	
		


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
	$timeout1c = date("Y-m-d H:i:s", strtotime($timeout1b)); //sikan time
	$timeout1unx = strtotime($timeout1c);

	if($nextday2in[$val]==1) {
	// add 1 day
	    $n2 = date("Y-m-d", strtotime($n . " +1 days"));
	} else {
	    $n2 = date("Y-m-d", strtotime($n));
	} //if-else
	$timein2a = $n2." ".$time_in2_hh[$val].":".$time_in2_mm[$val].":00";
	$timein2b = $time_in2_hh[$val].":".$time_in2_mm[$val].":00";
	$timein2c = strtotime($timein2b);
	$timein2 = date("Y-m-d H:i:s", strtotime($timein2a));
	$timein2unx = strtotime($timein2);

	if($nextday2out[$val]==1) {
	// add 1 day
	    $n2 = date("Y-m-d", strtotime($n . " +1 days"));
	} else {
	    $n2 = date("Y-m-d", strtotime($n));
	} //if-else
	$timeout2a = $n2." ".$time_out2_hh[$val].":".$time_out2_mm[$val].":00";
	$timeout2 = date("Y-m-d H:i:s", strtotime($timeout2a));
	// for db insert update purposes only
	// $timeout1b = $n." ".$time_out1_hh[$val].":".$time_out1_mm[$val].":00";
	$timeout2b = $n2." ".$time_out2_hh[$val].":".$time_out2_mm[$val].":00";
	$timeout2c = date("Y-m-d H:i:s", strtotime($timeout2b));
	$timeout2unx = strtotime($timeout2c);

// echo "POST totaltime:".$totaltime[$val]." where timeout1c:$timeout1c|".$nextday[$val].", timein1:$timein1, timeout2c:$timeout2c|".$nextday2out[$val].", timein2:$timein2|".$nextday2in[$val]."<br>";

    // start loop for manual checkbox
	

	// echo "<h1>$otafteroutsw</h1>";
	$checkboxmanual=0;
    foreach($checkboxman as $val3 => $n3) {
        if($n3==$n) { $checkboxmanual=1; }
    } 



    if($checkboxmanual==0) {
     if ($flexitime14 == 1){
		$totaltime[$val] = (((strtotime($timeout1c) - strtotime($timein1))/60)/60)+(((strtotime($timeout2c) - strtotime($timein2))/60)/60);

	}
	else {
		// +
		// (((strtotime($shiftout1) - strtotime($timein)) / 60) / 60)
	$totaltime[$val] = (
    (((strtotime($timeout1c) - strtotime($timein1)) / 60) / 60) + 
    (((strtotime($timeout2c) - strtotime($timein2)) / 60) / 60)
	
);
if ((strtotime($timein1) < strtotime($shiftin1))) {
	// If $early == 1, ignore the advanced time and calculate starting from $shiftin1
	if ($otbeforeinsw[$val] != 1) {
		$earlyTime = ((strtotime($shiftin1) - strtotime($timein1)) / 60) / 60;  // Early time in hours
		$totaltime[$val] -= $earlyTime;
		 
	}
		$totaltime[$val] = (((strtotime($timeout1c) - strtotime($timein1))/60)/60) + (((strtotime($timeout2c) - strtotime($timein2))/60)/60);
	
	
	

	
}



	}

	    if((strtotime($timein1)<=strtotime("$n 12:00 pm")) && (strtotime($timeout1)>=strtotime("$n 01:00 pm"))) {
	     
		    $totaltime[$val] = $totaltime[$val] - 1;
	    } //if
  // echo " tottimewlunch:".$totaltime[$val]." ";
	} //if


// echo "$timein1:$timeout1c <br>";
// echo "$timein2:$timeout2c <br>";



    // reset variables
    $otvalman=0; $utvalman=0; $otutuvalman=0; $nightdiffvalman=0; 
	$otordval=0; $otrestval=0; $otspval=0; $otlegalval=0; $otrest8val=0; $otsp8val=0; $otspsunval=0; $otspsun8val=0; $otlegal8val=0; $otlegalsunval=0; $otlegalsun8val=0;
	$otval1=0; $utval1=0; $otutval1=0; 
	
    if($checkboxmanual==1) {
        // get input fields POST vars as manual entries
        $otvalman = $otval[$val];
	    $utvalman = $utval[$val];
        $otutvalman = $otutval[$val];
	    $nightdiffvalman = $nightdiffval[$val];

    } else { //if-else if(checkboxmanual==1)
        // proceed to compute
		
		// check 1st if flexi-time is checked on indiv.info
		$res14query=""; $result14=""; $found14=0;
		$res14query="SELECT `idhrtapaygrpemplst`, `flexitime` FROM `tblhrtapaygrpemplst` WHERE `idtblhrtapaygrp`=$idpaygroup  AND `employeeid`='$employeeid'";
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
				$found14=1;
				$idhrtapaygrpemplst14 = $myrow14['idhrtapaygrpemplst'];
				$flexitime14 = $myrow14['flexitime'];
			} //while
		} //if
		



		// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

// echo "sikan time $timeout1c <br>";

		// if($checkboxmanual==0 && $flexitime14 == 0) {
		// 	// compute totaltime in decimal by hour
		// 	$totaltime[$val] = ( ( (strtotime($shiftout1) - strtotime($timein1)) /60) /60 )+(((strtotime($timeout2c) - strtotime($timein2))/60)/60);

		// 	if((strtotime($timein1)<=strtotime("$n 12:00 pm")) && (strtotime($timeout1)>=strtotime("$n 01:00 pm")) ) {
		// 		$totaltime[$val] = $totaltime[$val] - 1;
		// 	} 
	 
		// } //if

		// echo "<h1>$otvalnonflex</h1>";
		// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

		if( ($flexitime14==1 || $flexitime14==0) && $found14==1) {

			
			// start computation based on flexi-time
			// echo "<br><h1>FLEXI:$flexitime14 - $idpaygroup - $employeeid timeset1:$timein1,$timeout1c; timeset2:$timein2,$timeout2c; totaltm:".$totaltime[$val]."</h1><br>";
	
		
			// check and compute OT/ut values
			if($totaltime[$val]>0) {

				if ($restdaysw[$val] == 3 && $holidate[$val] == 'special'){
					// special holiday that falls on sunday & saturday (?)

					if ($totaltime[$val]> 8){
						$otspsun8val = $totaltime[$val] - $stdofchrs; 
						$otval1 = $totaltime[$val] - $stdofchrs;
						$otordval=0;

					} 
					$otspsunval = $totaltime[$val] - $otspsun8val;
					$otordval=0;
					
				} else if ($restdaysw[$val] == 3 && $holidate[$val] == 'legal'){

					if ($totaltime[$val]> 8){
						$otlegalsun8val = $totaltime[$val] - $stdofchrs; 
						$otval1 = $totaltime[$val] - $stdofchrs;
						$otordval=0;
						
					} 
					$otlegalsunval = $totaltime[$val] - $otlegalsun8val;
					$otordval=0;

			
				}
				else if ($holidate[$val] == 'legal'){
				
					if ($totaltime[$val]> 8){
						$otlegal8val = $totaltime[$val] - $stdofchrs; 
						$otval1 = $totaltime[$val] - $stdofchrs;
						

					} 
					$otlegalval = $totaltime[$val] - $otlegal8val;
					$otordval=0;
					

				} else if ($holidate[$val] == 'special' || ($holidate[$val] == 'city' && $flagcity == 1)){
			
					
					if ($totaltime[$val]> 8){
						$otsp8val = $totaltime[$val] - $stdofchrs; 
						$otval1 = $totaltime[$val] - $stdofchrs;
						$otordval=0;

					} 
					$otspval = $totaltime[$val] - $otval1;
					$otordval=0;
				} else if ($restdaysw[$val] == 1 || $restdaysw[$val] == 2 || $restdaysw[$val] == 3){
					// calculate ot of rest day sun sat & special with overtime and complete time
					
					if ($totaltime[$val]> 8){
						$otrest8val = $totaltime[$val] - $stdofchrs; 
						
						$otval1 = $totaltime[$val] - $stdofchrs;
						
					} 
					$otrestspval = $totaltime[$val];
					$otordval=0;
					

				} else {
					$otspsunval = 0;
					$otspsun8val = 0;
					$otrest8val = 0;
					$otrestspval = 0;
				}

				

				// overtimes ????
				 if($holidate[$val]  == 'shortened') {
					// if shortened
					if ($totaltime[$val] < $ShortenedTimeInDecimal){
						$utval1 = $ShortenedTimeInDecimal - $totaltime[$val]; 
						$otordval=0; $otrestspval=0; $otlegalval=0; $otval1=0; 
						$otutval1=$ShortenedTimeInDecimal - $totaltime[$val];
					} else if ($totaltime[$val] > $ShortenedTimeInDecimal){
						$otordval = $totaltime[$val] - $ShortenedTimeInDecimal; 
						$otval1 = $otordval; 
						$otutval1=$totaltime[$val]-$ShortenedTimeInDecimal;

					} else {
						$otordval=0; $otrestspval=0; $otlegalval=0; $otval1=0; $utval1=0; $otutval1=0;
					} 


				} else {
					// if not shortened

							if ($leavedaydur[$val] == 0.50 ){
								if($totaltime[$val] < 4.00 && $leavedaydur[$val] == 0.50 ){
									$utval1 = 4.00 - $totaltime[$val]; 
									$otordval=0; $otrestspval=0; $otlegalval=0; $otval1=0; 
									$otutval1=4.00-$totaltime[$val];
									
								} else if ($totaltime[$val] > 4.00){
									$totaltime[$val] = 4.00;
								}
							}	else if ($leavedaydur[$val] == 1){
								$totaltime[$val] = 8.00;
								$otordval=0; $otrestspval=0; $otlegalval=0; $otval1=0; $utval1 =0;

							}

							//  normal ot
							else if($totaltime[$val]<$stdofchrs) {
								if ($restdaysw[$val] == 1 || $restdaysw[$val] == 2 || $restdaysw[$val] == 3 || $restdaysw[$val] == 4 || $holidaytype21 == 'legal' || $holidaytype21 == 'special' || ($holidate[$val] == 'city' && $flagcity == 1)){
									$utval = 0;
									$utval1 = 0;
								} else{

									$utval1 = $stdofchrs - $totaltime[$val]; 
									$otordval=0; $otrestspval=0; $otlegalval=0; $otval1=0; 
									$otutval1=$totaltime[$val]-$stdofchrs;
									
								}
							}  else {
										$otordval = $totaltime[$val] - $stdofchrs; 
										$otval1 = $otordval; 
										$otutval1=$totaltime[$val]-$stdofchrs;
							} 


			}
// echo $otrestspval . " thisssssssssssssssssss";
					

			} else {

				$otordval=0; 
				$otrestspval=0; 
				$otlegalval=0; 
				$otval1=0; 
				$utval1=0; 
				$otutval1=0;
				
			} //if-else
			
		} else { //if($found14==1 && $flexitime14==1)
		    // start auto-compute

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

					include("hrtimeattotutval.php");
				// }
			} // end if($restdaysw[$val] == 1)

			// put in array otutval
			// $otutval[$val] = $otutval;
			
			// echo "test1 $n chk:$checkboxmanual, timein:".$timein1." timeout:".$timeout1." totaltime:".$totaltime[$val].", ot:".$otval[$val].", ut:".$utval[$val].", otutval:".$otutval[$val].", nightdiff:".$nightdiffval[$val]."\n";
			
		} //if-else if($found14==1 && $flexitime14==1)
	
		// compute night differential
		// code here 
		if(strtotime($timeout1) > strtotime("$n 10:00 pm") || strtotime($timein1) < strtotime("$n 06:00 am")) {
			if (strtotime($timeout1) >= strtotime("$n 10:00 pm")){
				$nightdiffval2[$val] = ((strtotime($timeout1c) - strtotime("$n 10:00 pm"))/60)/60;

				if($nightdiffval2[$val] > $stdofchrs) {
					$nightdiffval2[$val] = $stdofchrs;
				} //if
				$varndc1=1; $varndc2=0; $va0ndc3=0;
			} 


			// else if (strtotime($timein1) < strtotime("$n 06:00 am")){
				else if ((strtotime($timein1) >= strtotime("$n 12:01 am")) && (strtotime($timein1) <= strtotime("$n 6:00 am"))) {
				$nightdiffval2[$val] = ((strtotime("$n 06:00 am") - strtotime($timein1)  )/60)/60;

				if($nightdiffval2[$val] > $stdofchrs) {
					$nightdiffval2[$val] = $stdofchrs;
				} //if
				$varndc1=1; $varndc2=0; $va0ndc3=0;
			}
			
	    } else if(strtotime($timeout2c) > strtotime("$n 10:00 pm") ) {
			if(strtotime($timein2) > strtotime("$n 10:00 pm")) {
				$nightdiffval2[$val] = ((strtotime($timeout2c) - strtotime($timein2))/60)/60;
				$varndc21=1; $varndc22=0;
			} elseif(strtotime($timein2) <= strtotime("$n 10:00 pm")) {
			    $nightdiffval2[$val] = ((strtotime($timeout2c) - strtotime("$n 10:00 pm"))/60)/60;			
				$varndc21=0; $varndc22=1;
			} //if-else
			if($nightdiffval2[$val] > $stdofchrs) {
				$nightdiffval2[$val] = $stdofchrs;
			} //if
			$varndc1=0; $varndc2=1; $varndc3=0;
		} else {
            $nightdiffval2[$val]=0;
 			$varndc1=0; $varndc2=0; $varndc3=1;
       } //if-else

    } //if-else if(checkboxmanual==1)

    // start loop for no_findings checkbox
    $nofindingsval=0;
    foreach($nofindings as $val2 => $n2) {
        if($n2==$n) { $nofindingsval=1; }
    } // foreach($nofindings as $val2 => $n2)

    // echo "checkboxmanual:".$checkboxmanual.", otval:$otvalman|".$otval[$val].", utval:$utvalman|".$utval[$val].", otutval:$otutvalman|".$otutval[$val].", nightdiffval:$nightdiffvalman|".$nightdiffval[$val]."|".$nightdiffval2[$val].", ndc:$varndc1|$varndc2|$varndc3, varndc2:$varndc21|$varndc22, nd:".strtotime("$n 10:00 pm").", in2:".strtotime($timein2)." , out2:".strtotime($timeout2c)." , nofindingsval:$nofindingsval, remarks:".$remarks[$val].", out1:".strtotime($timeout1c).", out2:".strtotime($timeout2c).", nd:".strtotime("$n 10:00 pm")."<br>";

    // prepare variables
			$otbeforeinswval = $otbeforeinsw[$val];
			$otafteroutswval = $otafteroutsw[$val];
			$restdayswval = $restdaysw[$val];
			$nextdayswval = $nextday[$val];
			$mealallowswval = $mealallow[$val];
			// $leavetypeval = $leavecd[$val];
			// $leavedurationval = $leavedaydur[$val];
			// $totaltimeval = round($totaltime[$val], 2);
		

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

			


			// if ($holidate[$val] == 'city' && $flagcity == 1){
			// 	echo "found both <br>";
			// } 


			if($otafteroutsw[$val] == 1 ){
				// if ot is yes
				
				// $totaltimeval = $totaltime[$val];
				if ($restdaysw[$val] == 2 || $restdaysw[$val] == 3 || $holidate[$val] == 'legal' || $holidate[$val] == 'special' || ($holidate[$val] == 'city' && $flagcity == 1) ){
					$otvalfin = $totaltime[$val];
					$totaltime[$val] = $totaltime[$val];
					$utvalfin=0;
				} else {
					$totaltime[$val] = $totaltime[$val];
					$otvalfin = $otvalfin;
					



				}

				
			} else {

				if ($holidate[$val] == 'shortened'){
					// check if shortened and display shortened time
						if ($totaltime[$val] > $ShortenedTimeInDecimal){
							$totaltime[$val] = $ShortenedTimeInDecimal;

						} else {
							$totaltime[$val] = $totaltime[$val];

						}
				} else {
					// if not shortened keep ordinary time
				
					if ($totaltime[$val] > 8){
						$totaltime[$val] = 8;

					} else {
						$totaltime[$val] = $totaltime[$val];

					}
				}
				
			
				$otordval=0; 
				$otrestspval=0; 
				$otlegalval=0; 
				$otvalfin=0; 
				$otutvalfin=0;
				$otspsunval = 0;
				$otspsun8val = 0;
				$otrest8val = 0;
				$otrestspval = 0;
				$otspval = 0;
				$otsp8val = 0;

				if ($restdaysw[$val] == 2 || $restdaysw[$val] == 3 || $holidate[$val] == 'legal' || $holidate[$val] == 'special' ){
					$totaltime[$val] = 0.00;
				
					$otordval=0; 
					$otrestspval=0; 
					$otlegalval=0; 
					$otvalfin=0; 
					$utvalfin=0; 
					$otutvalfin=0;
					$otspsunval = 0;
					$otspsun8val = 0;
					$otrest8val = 0;
					$otrestspval = 0;
					$otspval = 0;
					$otsp8val = 0;


				} else{
				$totaltime[$val] = $totaltime[$val] - $otvalfin;
				$otvalfin = 0.00;
				}
				// $totaltimeval = $totaltime[$val] - $otval1;
				// echo "<br> its 0 $otval1 <br> $totaltimeval & $totaltime[$val] <br>";
			}
				// $otval = round($otval[$val], 2);
			// $utval = round($utval[$val], 2);
			// $otutval = $otutval[$val];
			// $nightdiffval = round($nightdiffval2[$val], 2);
			$projchargeval = $projcharge[$val];
			$remarksval = $remarks[$val];

			
			// $remarksval = "rest:$restdayswval, tottime:$totaltimeval, otut:$otutval, ot:$otval, ut:$utval";
			// if($leavetypeval=="") { $leavedurationval=0; } else { $leavedurationval=1; }
			// if($nightdiffval[$val]=="" || $nightdiffval2[$val] == '' || $nightdiffval2[$val] == '0' || $nightdiffval2[$val] == '0') { $nightdiffval=0; $nightdiffvalfin = 0; }

			
			/*$nofindingsval=0;
			foreach($nofindings as $val2 => $n2) {
				if($n2==$n) { $nofindingsval=1; }
			} // foreach($nofindings as $val2 => $n2) */
		// set vars if $nofindingsval==1
		if($nofindingsval==1) {
		    if($restdaysw[$val] == 1 || $holidaytype212 == "special" || $holidaytype212 == "legal" || ($holidate[$val] == 'city' && $flagcity == 1) ) {
			    $totaltime[$val] = 0; 
				$nightdiffvalfin = 0;
			    $otordval=0; 
				$otrestspval=0; 
				$otlegalval=0; 
				$otvalfin=0; 
				$utvalfin=0; 
				$otutvalfin=0;
		    } else {
			    $totaltime[$val] = $stdofchrs; 
				$nightdiffvalfin = 0;
			    $otordval=0; 
				$otrestspval=0; 
				$otlegalval=0; 
				$otvalfin=0; 
				$utvalfin=0; 
				$otutvalfin=0;
		    } //if($restdaysw[$val] == 1 || $holidaytype21 == "special" || $holidaytype21 == "legal") //for nofindings		
		} //if($nofindingsval==1)


	





		if ($restdaysw[$val] == 2 || $restdaysw[$val] == 3 || $holidate[$val] == 'legal' || $holidate[$val] == 'special' || ($holidate[$val] == 'city' && $flagcity == 1) ){

			$utvalfin=0;
		} else {
			if ($leavedaydur[$val] == 1 ){
				if ($leavetypeval == 'sd'){
						$utvalfin = 8.00;
						$totaltime[$val] = 0.00;
				} else {
					
					$totaltime[$val] = 8.00;
				}
			
			} else if ($leavedaydur[$val] == 0 && $totaltime[$val] == 0) {
				if ($holidate[$val] == 'shortened'){
					$utvalfin = $ShortenedTimeInDecimal;
				} else {
			
					$utvalfin = 8;
				}
			}
			 else {
				$totaltime[$val];
	
			}
			
		}


			
echo "no loop =".$newempcheckbox[$val]." - $n <br>";

	$newempbox = 0;
	foreach($newempcheckbox as $val23 => $n23) {
		if($n23 == $n) { $newempbox = 1; }
	}
	echo "with loop = ".$newempbox." - $n <br><br>";

	if ($newempbox == 1){
		if ($holidate[$val] == 'shortened'){
				$utvalfin = $ShortenedTimeInDecimal;
				$otutvalfin = $ShortenedTimeInDecimal;
		}else {
					$utvalfin = 8.00;
					$otutvalfin = 8.00;

		}
		$totaltime[$val] = 0;
		$otvalfin = 0;
		$nightdiffvalfin = 0;
		$otordval = 0;
		$otrestspval = 0;
		$otspval = 0;
		$otlegalval = 0;
		$otrest8val = 0;
		$otsp8val = 0;
		$otspsunval = 0;
		$otspsun8val = 0;
		$otlegal8val = 0;
		$otlegalsunval = 0;
		$otlegalsun8val = 0;
		
	} 



		//
		// db queries
		//
		// chk if exists and get id and update else insert
		$res11query = "SELECT * FROM tblhrtaemptimelog WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idcutoff=$idcutoff AND logdate=\"$n\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idhrtaemptimelog11 = $myrow11['idhrtaemptimelog'];
			} // while($myrow11 = $result11->fetch_assoc())
		} // if($result11->num_rows>0)
		// echo "$n --- $cutstart[$val] ---- $leavedaydur[$val] <br>";
		if($found11 == 1) {
			// update based on id
			if($otutval == ''){
				$otutval = 0;
			}
			$res12update = "UPDATE tblhrtaemptimelog
			SET timestamp='$now', 
				lastupdate='$loginid', 
				timein='$timein1', 
				timeout='$timeout1c', 
				holiday = '$holidate[$val]',
				otbeforeinsw='$otbeforeinswval', 
				otafteroutsw='$otafteroutswval', 
				restdaysw='$restdayswval', 
				nextdaysw='$nextdayswval', 
				mealallowsw='$mealallowswval', 
				transpo = '$transpo[$val]',
				leavetype='$leavetypeval', 
				leaveduration='$leavedaydur[$val]', 
				manualcompsw='$checkboxmanual', 
				totaltime='$totaltime[$val]', 
				otval='$otvalfin', 
				utval='$utvalfin', 
				otutval='$otutvalfin', 
				nightdiffval='$nightdiffvalfin', 
				projcharge='$projchargeval', 
				nofindings='$nofindingsval', 
				remarks='$remarksval', 
				timein2='$timein2', 
				timeout2='$timeout2c', 
				nextday2insw='$nextday2in[$val]', 
				nextday2outsw='$nextday2out[$val]', 
				otordval='$otordval', 
				otrestval='$otrestspval', 
				otspval='$otspval', 
				otlegalval='$otlegalval', 
				otrest8val='$otrest8val', 
				otsp8val='$otsp8val', 
				otspsunval='$otspsunval', 
				otspsun8val='$otspsun8val', 
				otlegal8val='$otlegal8val', 
				otlegalsunval='$otlegalsunval', 
				otlegalsun8val='$otlegalsun8val',
				wfhval='$realvalwfh[$val]',
				cityinclude = '$flagcity',
				newempflag = '$newempbox'
			WHERE idhrtaemptimelog='$idhrtaemptimelog11'
			 AND logdate=\"$n\";
";
			$result12 = $dbh2->query($res12update);
			// echo "$res12update";
			// echo "r12upd:".$res12update."<br>\r\n";				
			// var_dump($result12);
			
		} else {
			// insert query
			$res12insert = "INSERT INTO tblhrtaemptimelog
			SET timestamp='$now', 
				loginid='$loginid', 
				datecreated='$datenow', 
				lastupdate='$loginid', 
				employeeid='$employeeid', 
				idpaygroup='$idpaygroup', 
				idcutoff='$idcutoff', 
				cutstart='$cutstart14', 
				cutend='$cutend14', 
				logdate='$n', 
				timein='$timein1', 
				timeout='$timeout1c', 
				holiday = '$holidate',
				otbeforeinsw='$otbeforeinswval', 
				otafteroutsw='$otafteroutswval', 
				restdaysw='$restdayswval', 
				nextdaysw='$nextdayswval', 
				mealallowsw='$mealallowswval', 
				transpo = '$transpo[$val]',
				leavetype='$leavetypeval', 
				leaveduration='".$leavedaydur[$val]."', 
				manualcompsw='$checkboxmanual', 
				totaltime='".$totaltime[$val]."', 
				otval='$otvalfin', 
				utval='$utvalfin', 
				otutval='$otutvalfin', 
				nightdiffval='$nightdiffvalfin', 
				projcharge='$projchargeval', 
				nofindings='$nofindingsval', 
				remarks='$remarksval', 
				timein2='$timein2', 
				timeout2='$timeout2c', 
				nextday2insw='".$nextday2in[$val]."', 
				nextday2outsw='".$nextday2out[$val]."', 
				otordval='".$otordval."', 
				otrestval='".$otrestspval."', 
				otspval='".$otspval."', 
				otlegalval='".$otlegalval."', 
				otrest8val='".$otrest8val."', 
				otsp8val='".$otsp8val."', 
				otspsunval='".$otspsunval."', 
				otspsun8val='".$otspsun8val."', 
				otlegal8val='".$otlegal8val."', 
				otlegalsunval='".$otlegalsunval."', 
				wfhval='$realvalwfh[$val]', 
				cityinclude = '$flagcity',
				otlegalsun8val='".$otlegalsun8val."'
				newempflag = '$newempbox'
				
				";
				
			$result12 = $dbh2->query($res12insert);
			$insid = mysql_insert_id();
		} // end if($found11 == 1)

		//
		// display vars
		//
// echo $res12update ."<br> this is update";
// echo "<br>res12insert:".$res12insert."<br>\r\n";
		//
		// reset variables
    $otval1=0; $utval1=0; $otutval1=0;
	// echo "$transpo, <br>";

    } // foreach($cutstart as $val => $n)

// echo "</p>";
$querydesu = "SELECT * FROM `tblcontact` WHERE employeeid = $employeeid";
$result12 = $dbh2->query($querydesu);
if($result12->num_rows>0) {
	while($myrow11 = $result12->fetch_assoc()) {
	$found11 = 1;
	$nameFirst = $myrow11['name_last'];
	$nameLast = $myrow11['name_first'];

	} // while($myrow11 = $result11->fetch_assoc())
} // if(

$message = "<div class = 'text-center'><h4>Time and Attendance for <span class = 'fw-bold'>$nameLast, $nameFirst ($employeeid)</span> has been saved.</h4></div>  ";
$_SESSION['message'] = $message;

	echo '<script>';
echo 'window.location.href = "hrtimeatttimelogs.php?loginid='.$loginid.'&idpg='.$idpaygroup.'&idct='.$idcutoff.'&eid='.$employeeid.'";';
echo '</script>';




// echo "</pre></html>";

	//
	// redirect
	header("Location: hrtimeatttimelogs.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
	exit;
// echo "<h1>$mealallow</h1>";

	// echo "<p><a href=\"hrtimeatttimelogs.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid\">back</a></p>";
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
