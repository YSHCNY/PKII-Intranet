<?php 

require './db1.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$employeeid01 = (isset($_POST['empid'])) ? $_POST['empid'] :'';
$yyyymm = (isset($_POST['monsel'])) ? $_POST['monsel'] :'';
$cutmonth = (isset($_POST['cutmonth'])) ? $_POST['cutmonth'] :'';
$empstat = (isset($_POST['empstat'])) ? $_POST['empstat'] :'';
$deptcd = (isset($_POST['deptcd'])) ? $_POST['deptcd'] :'';

if(($yyyymm == " ") || ($yyyymm == "")) {
	$cutstart = date("Y-m-01", strtotime($datenow));
} else {
	$cutstart = $yyyymm."-"."01";
} //if-else

if($cutmonth == "") { $cutmonth="0"; }

if($cutmonth == "0") {
	$cutstart = $yyyymm."-"."01";
	$cutend = date("Y-m-t", strtotime("$cutstart"));
} elseif($cutmonth == "1") {
	$cutstartarr = split("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutend = $cutstartyyyy . "-" . $cutstartmm . "-" . "15";
} elseif($cutmonth == "2") {
  $cutend = date("Y-m-t", strtotime("$cutstart"));
	$cutstartarr = split("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutstart = $cutstartyyyy . "-" . $cutstartmm . "-" . "16";
} //if-elseif

if($empstat=='active') {
	$wheremprecord="tblemployee.emp_record='active'";
} elseif($empstat=='inactive') {
	$wheremprecord="tblemployee.emp_record='inactive'";;	
} elseif($empstat=='all') {
	$wheremprecord="(tblemployee.emp_record='active' OR tblemployee.emp_record='inactive')";
} //if-elseif

$colspan=8;

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}
if ($found == 1) {
     include ("header2.php");
     // include ("sidebar.php");

// echo "<tr><td colspan='$colspan'>r11q: ".$res11qry."</td></tr>";

    if($employeeid01!='') {

        // query personnel full name
        $res20query=""; $result20=""; $found20=0;
        $res20query="SELECT contactid, name_last, name_first, name_middle, picfn FROM tblcontact WHERE employeeid=\"$employeeid01\" AND contact_type=\"personnel\" LIMIT 1";
        $result20=$dbh2->query($res20query);
        if($result20->num_rows>0) {
            while($myrow20=$result20->fetch_assoc()) {
            $found20=1;
            $contactid20 = $myrow20['contactid'];
            $name_last20 = $myrow20['name_last'];
            $name_first20 = $myrow20['name_first'];
            $name_middle20 = $myrow20['name_middle'];
            $picfn20 = $myrow20['picfn'];

            } //while
        } //if
		
                echo "<table id=\"ReportTable\" class=\"fin2\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
                echo "<tr><th rowspan=\"4\"><img src=\"./images/$picfn20\" height=\"90\"></th></tr>";
                echo "<tr><th colspan=\"$colspan\" align='left'>Personnel Time and Activity Log</th></tr>";
                echo "<tr><th colspan=\"$colspan\" align='left'>$name_last20, $name_first20 $name_middle20[0] - $deptcd</th></tr>";
                echo "<tr><th colspan=\"$colspan\" align='left'>For the period ".date('Y-M-d', strtotime($cutstart))." -to- ".date('Y-M-d', strtotime($cutend))."</th></tr>";
		// check if personnel has records on biometrics device
		$res17qry=""; $result17=""; $found17=0; $ctr17=0;
		$res17qry="SELECT att_userid FROM tblhrattuserinfo WHERE employeeid=\"$employeeid01\"";
		$result17=$dbh2->query($res17qry);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
			$found17 = 1;
			$att_userid17 = $myrow17['att_userid'];				
			} // while
		} // if

		echo "<tr><th colspan=\"2\">Date";
		// echo "|f17:".$found17.", auid:".$att_userid17."";
		echo "</th>";
		if($att_userid17 != "") { 
		echo "<th>Time-IN</th><th>Time-OUT</th>";
		}
		echo "<th>Wfh?</th><th>Activity</th><th>Staff-declared time (hrs)</th><th>Validate rendered time (hrs)</th><th>Ofc e-door log (hrs)</th>";
		// if($accesslevel>=4) { echo "<th>Action</th>"; }
		echo "</tr>";
		// generate time log
		if($yyyymm != "") {
		while(strtotime($cutstart) <= strtotime($cutend)) {
			$dateval = date("Y-M-d", strtotime($cutstart));
			// echo "$dateval<br>";
			if(date("D", strtotime($dateval)) == "Sun") {
			echo "<tr><td align='center'><font color=\"red\">".date("Y-M-d", strtotime($dateval))."</font></td><td align=\"center\"><font color=\"red\">".date("D", strtotime($dateval))."</font></td>";
			} else {
    // 20210726 query tblhrtaholiday if date is a holiday, then font=red
    $res11bquery=""; $result11b=""; $found11b=0;
    $res11bquery="SELECT DATE_FORMAT(applic_date, '%Y-%m-%d') AS yyyymmdd FROM tblhrtaholidays WHERE applic_date=\"$cutstart\" AND (holidaytype=\"legal\" OR holidaytype=\"special\") LIMIT 1";
    $result11b=$dbh2->query($res11bquery);
    if($result11b->num_rows>0) {
        while($myrow11b=$result11b->fetch_assoc()) {
        $found11b=1;
        $yyyymmdd11b = $myrow11b['yyyymmdd'];
        } //while
    } //if
    if($found11b==1 && $yyyymmdd11b==$cutstart) {
			echo "<tr><td align='center'><font color=\"red\">".date("Y-M-d", strtotime($dateval))."</font></td><td align=\"center\"><font color=\"red\">".date("D", strtotime($dateval))."</font></td>";
    } else {
			echo "<tr><td align='center'>".date("Y-M-d", strtotime($dateval))."</td><td align=\"center\">".date("D", strtotime($dateval))."</td>";
    } //if-else
			}

    // declare/reset vars
    $empID0tmp=$employeeid0;
    $employeeid0=$employeeid01;
    $timein14val=""; $timeout15val="";

		if($att_userid17 != "") { 

			echo "<td align=\"center\">";
			$res14qry="";$result14=""; $found14=0; $ctr14=0;
			$res14qry="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid01\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC";
			$result14=$dbh2->query($res14qry);
			if($result14->num_rows>0) {
				while($myrow14=$result14->fetch_assoc()) {
				$found14 = 1;
				$ctr14=$ctr14+1;
				$hrattcheckinoutid14 = $myrow14['hrattcheckinout'];
				$timein14 = $myrow14['att_checktime'];
				$att_userid14 = $myrow14['att_userid'];
				if($timein14 != "") {
				echo date("G:i", strtotime($timein14));
    $timein14val=$timein14;
				echo "<br>";
				$timevaldlyattchkin=$timein14; $timein14="";
				} //if					
				} // while
			} // if
			echo "</td>";
			echo "<td align=\"center\">";
			$res15qry=""; $result15=""; $found15=0; $ctr15=0;
			$res15qry="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid01\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"o\" ORDER BY tblhrattcheckinout.att_checktime DESC";
			$result15=$dbh2->query($res15qry);
			if($result15->num_rows>0) {
				while($myrow15=$result15->fetch_assoc()) {
				$found15 = 1;
				$ctr15=$ctr15+1;
				$hrattcheckinoutid15 = $myrow15['hrattcheckinoutid'];
				$timeout15 = $myrow15['att_checktime'];
				if($timeout15 != "") {
				echo date("G:i", strtotime($timeout15));
    $timeout15val=$timeout15;
				echo "<br>";
				$timevaldlyattchkout=$timeout15; $timeout15="";
				} //if
				} // while
			} // if
			echo "</td>";
		}

    // 20210710 display wfh column
    $wfhflag="";
    if($timein14val!="" || $timeout15val!="") {
    $wfhflag="N";
    } else {
        // chk if activity log has entries else blank
        $actrowctr=0; $dbh=$bh2;
        // include '../m/qrymactivitylog6a.php';
        $dateval=date('Y-m-d', strtotime($dateval));
	$res16aquery=""; $result16a=""; $found16a=0; $ctr16a=0;
	$res16aquery="SELECT count(*) AS actrowctr FROM tblhractlog WHERE tblhractlog.date=\"$dateval\" AND tblhractlog.employeeid=\"$employeeid0\"";
	// $res16query="SELECT hractlogid, activity, remarks, remarksby, projcode, timestart, timeend FROM tblhractlog WHERE date=\"$arrcutdate0\" AND employeeid=\"$employeeid0\" ORDER BY timestamp DESC";
	$result16a=$dbh2->query($res16aquery);
	$actrowctr16aArr=array();
	if($result16a->num_rows>0) {
                $found16a=1;
		while($myrow16a=$result16a->fetch_assoc()) {
		array_push($actrowctr16aArr, $myrow16a['actrowctr']);
		} // while
	} // if
	$param16a = count($actrowctr16aArr);
	for($x16a = 0; $x16a < $param16a; $x16a++) {
	    $actrowctr=$actrowctr16aArr[$x16a];
	} //for
        if($actrowctr!=0) {
        $wfhflag="Y";
        } else {
        $wfhflag="";
        } //if-else
    } //if-else
    echo "<td align='center'>$wfhflag</td>";

    // 20210710 compute timeduration from e-door logs
    $timein14aval=0; $timein14a=""; $timeout15aval=0; $timeout15a=""; $timeduredr=0;
    // include '../m/qrymactivitylog4a.php';
	$result14a=""; $found14a=0; $ctr14a=0;
        $res14aquery="SELECT tblhrattcheckinout.hrattcheckinoutid, tblhrattcheckinout.att_checktime, tblhrattcheckinout.att_userid FROM tblhrattcheckinout LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid=\"$employeeid0\" AND (tblhrattcheckinout.att_checktime>=\"$cutstart 00:00:00\" AND tblhrattcheckinout.att_checktime<=\"$cutstart 23:59:59\") AND tblhrattcheckinout.att_checktype=\"I\" ORDER BY tblhrattcheckinout.att_checktime ASC LIMIT 1";
	$result14a=$dbh2->query($res14aquery);
	if($result14a->num_rows>0) {
		while($myrow14a=$result14a->fetch_assoc()) {
                $found14a = 1;
		$hrattcheckinoutid14a = $myrow14a['hrattcheckinoutid'];
		$timein14a = $myrow14a['att_checktime'];
		$att_userid14a = $myrow14a['att_userid'];
		} // while
	} // if
    $timein14aval=$timein14a;
    // include '../m/qrymactivitylog5a.php';
	$result15a=""; $found15a=0; $ctr15a=0;
	$res15aquery="SELECT `tblhrattcheckinout`.`hrattcheckinoutid`, `tblhrattcheckinout`.`att_checktime` FROM `tblhrattcheckinout` LEFT JOIN `tblhrattuserinfo` ON `tblhrattcheckinout`.`att_userid`=`tblhrattuserinfo`.`att_userid` WHERE `tblhrattuserinfo`.`employeeid`=\"$employeeid0\" AND (`tblhrattcheckinout`.`att_checktime`>=\"$cutstart 00:00:00\" AND `tblhrattcheckinout`.`att_checktime`<=\"$cutstart 23:59:59\") AND `tblhrattcheckinout`.`att_checktype`=\"o\" ORDER BY `tblhrattcheckinout`.`att_checktime` DESC LIMIT 1";
	$result15a=$dbh2->query($res15aquery);
	if($result15a->num_rows>0) {
		while($myrow15a=$result15a->fetch_assoc()) {
                $found15a = 1;
		$hrattcheckinoutid15a = $myrow15a['hrattcheckinoutid'];
		$timeout15a = $myrow15a['att_checktime'];
		} // while
	} // if
    $timeout15aval=$timeout15a;
    if(strtotime($timein14aval)!=0 && strtotime($timeout15aval)!=0) {
        if(strtotime($timeout15aval)>strtotime($timein14aval)) {
        $timeduredr = number_format(((strtotime($timeout15aval) - strtotime($timein14aval)) / 3600), 2);
        $tottimeduredr = number_format(($tottimeduredr + $timeduredr), 2);
        } //if
    } //if

    // declare back tmp vars
    $employeeid0=$empID0tmp;
    
            $timevaldlyactlog=0;
			$timevaldlyactlog = number_format($timevaldlyactlog, 2);
			
			$arrcutdate = split(" ", $cutstart);
			$arrcutdate0 = $arrcutdate[0];
			
			echo "<td>";
// echo "$res14aquery<br><br>$res15aquery<br><br>$hrattcheckinoutid15a|$timeout15a|$timeout15val|$employeeid0|$employeeid01|$arrcutdate0|f14a:$found14a|f15a:$found15a<br><br>";
			
			$res16qry=""; $result16=""; $found16=0; $ctr16=0; $timeendprev="";
			$res16qry="SELECT tblhractlog.hractlogid, tblhractlog.activity, tblhractlog.remarks, tblhractlog.remarksby, tblhractlog.timeval, tblhractlog.timevalrev1, tblhractlog.timevalrev1by, tblhractlog.projcode, tblhractlog.timestart, tblhractlog.timeend, tblproject1.proj_fname, tblproject1.proj_sname FROM tblhractlog LEFT JOIN tblproject1 ON tblhractlog.projcode=tblproject1.proj_code WHERE tblhractlog.date=\"$arrcutdate0\" AND tblhractlog.employeeid=\"$employeeid01\" ORDER BY tblhractlog.timestamp DESC";
			$result16=$dbh2->query($res16qry);
			if($result16->num_rows>0) {
				while($myrow16=$result16->fetch_assoc()) {
				$found16 = 1;
				$hractlogid16 = $myrow16['hractlogid'];
				$activity16 = $myrow16['activity'];
				$remarks16 = $myrow16['remarks'];
				$remarksby16 = $myrow16['remarksby'];
				$projcode16 = $myrow16['projcode'];
				$timestart16 = $myrow16['timestart'];
				$timeend16 = $myrow16['timeend'];
				$timeval16 = $myrow16['timeval'];
				$timevalrev116 = $myrow16['timevalrev1'];
				$timevalrev1by16 = $myrow16['timevalrev1by'];
				$proj_fname16 = $myrow16['proj_fname']; 
				$proj_sname16 = $myrow16['proj_sname'];
				$ctr16 = $ctr16+1;
				if($ctr16 > 1) { echo "<br /><br />"; }
				echo nl2br($activity16);
				if($projcode16!='') {
					if($proj_sname16=='') {
						$projfin=substr($proj_fname16, 0, 16);
					} else {
						$projfin=$proj_sname16;
					} //if
					echo "&nbsp;for&nbsp;".$projcode16.":<strong>".$projfin."</strong>";
				} // if
				$timeval=0;
				if($timestart16!='' && $timeend16!='') {
					if($timestart16!='0000-00-00 00:00:00' && $timeend16!='0000-00-00 00:00:00') {
						$timeval = (strtotime($timeend16) - strtotime($timestart16)) / 3600;
						echo "&nbsp;duration&nbsp;".date('H:i', strtotime($timestart16))."-".date('H:i', strtotime($timeend16))."&nbsp<strong>".number_format($timeval, 2)."</strong>";
					} //if
				} //if
				$timevaldlyactlog = number_format($timevaldlyactlog + $timeval, 2);
				} //while
			} // if
			// echo "<br><br>$res16qry<br><br>$activity16";

echo "</td>";
			echo "<td align='right'>".number_format($timeval16, 2)."</td>";
			// get earliest time-in
			$res16bqry=""; $result16b=""; $found16b=0;
			$res16bqry="SELECT `timestart` FROM `tblhractlog` WHERE `date`='$arrcutdate0' AND `employeeid`='$employeeid01' AND (`timestart`<>'' OR `timestart`<>'0000-00-00 00:00:00') ORDER BY `timestart` ASC LIMIT 1";
			$result16b=$dbh2->query($res16bqry);
			if($result16b->num_rows>0) {
				while($myrow16b=$result16b->fetch_assoc()) {
					$found16b=1;
					$timestart16b = $myrow16b['timestart'];
				} // while
			} // if
			// get oldest time-output
			$res16cqry=""; $result16c=""; $found16c=0;
			$res16cqry="SELECT `timeend` FROM `tblhractlog` WHERE `date`='$arrcutdate0' AND `employeeid`='$employeeid01' AND (`timeend`<>'' OR `timeend`<>'0000-00-00 00:00:00') ORDER BY `timeend` DESC LIMIT 1";
			$result16c=$dbh2->query($res16cqry);
			if($result16c->num_rows>0) {
				while($myrow16c=$result16c->fetch_assoc()) {
					$found16c=1;
					$timeend16c = $myrow16c['timeend'];
				} //while
			} //if
			$timevaldlyactlog2=number_format(0, 2);
			if($found16b==1 && $found16c==1) {
				if($timestart16b!='' && $timeend16c!='') {
					if(strtotime($timestart16b)<=strtotime($timeend16c)) {
					$timevaldlyactlog2 = number_format(((strtotime($timeend16c) - strtotime($timestart16b)) / 3600), 2);
					} //if
				} //if
			} //if
			// echo "|f16b:".$found16b.":".$timestart16b.", f16c:".$found16c.":".$timeend16c."";
			if($timevaldlyattchkin!='' && $timevaldlyattchkout!='') {
				if(strtotime($timevaldlyattchkin)<=strtotime($timevaldlyattchkout)) {
				$timevaldaily = number_format(((strtotime($timevaldlyattchkout) - strtotime($timevaldlyattchkin)) / 3600), 2);									
				} else {
				$timevaldaily = number_format(0, 2);
				} //if-else
			} else {
			    if($timevaldlyactlog<$timevaldlyactlog2) {
				$timevaldaily = $timevaldlyactlog;
			    } else {
				$timevaldaily = $timevaldlyactlog2;
			    } //if-else
			} //if-else
			if($timeval16!=0) {
				$timevaldaily=$timeval16;
			} //if
			if($timevalrev116!=0) {
				$timevaldaily=$timevalrev116;
			} //if
    // 20210726 query IT support approvers and allow to validate based on assigned dept
    /* $res19query=""; $result19=""; $found19=0;
    $res19query="SELECT iditsupportapprover FROM tblitsupportapprover WHERE deptcd=\"$deptcd\" AND (approver1empid=\"$employeeid0\" OR approver2empid=\"$employeeid0\") LIMIT 1";
    $result19=$dbh2->query($res19query);
    if($result19->num_rows>0) {
        while($myrow19=$result19->fetch_assoc()) {
        $found19=1;
        $iditsupportapprover19 = $myrow19['iditsupportapprover'];
        } //while
    } //if */

			// if($accesslevel>=4 && preg_match("/\bMGT\b/i", $deptscd0)) {
                        if($found19==1) {
				// show input time value and validate button
			echo "<form action='hrofcactlogtmval.php?loginid=$loginid&' method='POST' name='hrofcactlogtmval'>";
			echo "<input type='hidden' name='dt' value='$arrcutdate0'>";
			echo "<input type='hidden' name='actid' value='$hractlogid16'>";
			echo "<input type='hidden' name='eid' value='$employeeid01'>";
			echo "<input type='hidden' name='monsel' value='$yyyymm'>";
			echo "<input type='hidden' name='cutmonth' value='$cutmonth'>";
			echo "<input type='hidden' name='empstat' value='$empstat'>";
			echo "<input type='hidden' name='deptcd' value='$deptcd'>";
			echo "<td align='right'>";
			if($timevalrev1by16=='' && $employeeid01!=$employeeid0) {
			echo "<input type='number' step='any' size='4' name='timevalidate[]' value='$timevaldaily'>";
			// echo "<button type='submit' class='btn btn-success btn-sm' role='button' name='act' value='validate'>Validate</button>";
			} else {
				if($accesslevel>=5 && $employeeid01!=$employeeid0) {
			echo "<input type='number' step='any' size='4' name='timevalidate[]' value='$timevaldaily'>";
			// echo "<button type='submit' class='btn btn-success btn-sm' role='button' name='act' value='validate'>Validate</button>";					
				} else {
			echo "<font color='green'><strong>".$timevaldaily."</strong></font>";
			echo "<input type='hidden' name='timevalidate[]' value='$timevaldaily'>";
				} //if-else
			} //if-else

			if($timevalrev1by16!='') {
				echo "<br><font color='green'>validated by <strong>".$timevalrev1by16."</strong></font>";
			} // if
			// echo "|".$timevaldlyactlog."|".$timevaldlyactlog2."|".$timevalrev116."";
			echo "</td>";
			} else {
				// hide validate button
				echo "<td align='right'>";
			if($timevalrev1by16!='') {
				echo "<font color='green'><strong>".$timevaldaily."</strong>&nbsp;hrs</font>";
				echo "<br><font color='green'>validated by <strong>".$timevalrev1by16."</strong></font>";
			echo "<input type='hidden' name='timevalidate[]' value='$timevaldaily'>";
			} else {
				echo "<font color='grey'><i>".$timevaldaily."</i></font>";
				echo "<br><font color='grey'><i>not validated</i></font>";
			echo "<input type='hidden' name='timevalidate[]' value='$timevaldaily'>";
			} // if
				echo "</td>";
			} // if-else

    // 20210710 disp e-door log hrs
    if($timeduredr!=0) {
    echo "<td align='right'><i>$timeduredr</i></td>";
    } else {
    echo "<td></td>";
    } //if-else

			echo "</tr>";
			$tottimeval16=$tottimeval16+$timeval16;
			$tottimevalrev116=$tottimevalrev116+$timevalrev116;
			$cutstart = date("Y-m-d", strtotime($cutstart. " + 1 days"));
			$timevalrev1by16=""; $timevalrev116=0; $timevaldaily=0; $timevaldlyattchkin=""; $timevaldlyattchkout=""; $timeval16=0;
		}
		}
		echo "<tr><th colspan='6' align='right'>Total</th><th align='right'>".number_format($tottimeval16, 2)."</th>";
                echo "<th align='right'>".number_format($tottimevalrev116, 2)."</th>";

    // 20210710 disp total hrd e-foor log
    if($tottimeduredr!=0) {
    echo "<th align='right'><i>$tottimeduredr</i></th>";
    } else {
    echo "<th></th>";
    } //if-else
                echo "</tr>";

	} //if($employeeid01!='')

// end contents here...

     echo "</table>";

// edit body-footer
     // echo "<p><a href=\"index2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

    $requery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	 

     // include ("footer.php");
} else {
     include("logindeny.php");
} //if-else

mysql_close($dbh);
$dbh2->close();
?> 
