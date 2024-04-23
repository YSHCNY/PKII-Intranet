<?php 

require './db1.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$employeeid01 = (isset($_POST['eid'])) ? $_POST['eid'] :'';
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

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}
if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
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
// edit body-header
     echo "<p><font size=1>Modules >> HR >> Office time log</font></p>";

		// if($accesslevel>=4) { $colspan=6; } else { $colspan=5; }
		$colspan=9;

     echo "<table class=\"fin\">";

     echo "<tr><th colspan=\"$colspan\">Office Time Log</th></tr>";

// start contents here...
  if($accesslevel >= 3) {
    echo "<tr><form action=\"hrofctimelog.php?loginid=$loginid\" method=\"post\">";
	// 20200505
	// disp dropdowns for active-inactive-all status, then deptcd
	echo "<div class='form-group'><td><select class='form-control' name='empstat'>";
	if($empstat=='') {
	echo "<option value=''>select emp criteria</option>";		
	} //if
	if($empstat=='active') {
		$empstatactsel="selected"; $empstatinactsel=""; $empstatallsel="";
	} elseif($empstat=='inactive') {
		$empstatactsel=""; $empstatinactsel="selected";	$empstatallsel="";	
	} elseif($empstat=='all') {
		$empstatactsel=""; $empstatinactsel="";	$empstatallsel="selected";	
	} //if-elseif
	echo "<option value='active' $empstatactsel>Active</option>";
	echo "<option value='inactive' $empstatinactsel>Inactive</option>";
	echo "<option value='all' $empstatallsel>All (slow query)</option>";
	echo "</select></td></div>";
	
	echo "<div class='form-group'><td><select class='form-control' name='deptcd'>";
	if($deptcd=='') {
	echo "<option value=''>select dept</option>";
	} //if
	$res18qry=""; $result18=""; $found18=0; $ctr18=0;
	$res18qry="SELECT iddeptcd, code, name FROM tbldeptcd ORDER BY code ASC";
	$result18=$dbh2->query($res18qry);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
			$found18=1;
			$ctr18=$ctr18+1;
			$iddeptcd18 = $myrow18['iddeptcd'];
			$code18 = $myrow18['code'];
			$name18 = $myrow18['name'];
			if($code18==$deptcd) {
				$deptcdsel="selected";
			} else {
				$deptcdsel="";
			} //if-else
			echo "<option value='$code18' $deptcdsel>".$code18."</option>";
		} //while
	} //if
	if($deptcd=='all') { $deptcdselall="selected"; $deptcdsel=""; }
	echo "<option value='all' $deptcdselall>All (slow process)</option>";
	echo "</select></td></div>";
	if($empstat!='' && $deptcd!='') {
		// display other dropdowns
		
		// list all available personnel w/ timelog data
		echo "<div class='form-group'><td><select class='form-control' name=\"eid\">";
		if($employeeid01=='') {
			echo "<option value=''>select personnel</option>";
		} //if
		$res11qry=""; $result11=""; $found11=0; $ctr11=0;
		// $res11qry="SELECT DISTINCT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblhrattuserinfo ON tblcontact.employeeid=tblhrattuserinfo.employeeid LEFT JOIN tblhractlog ON tblcontact.employeeid=tblhractlog.employeeid WHERE tblcontact.contact_type='personnel' ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
		if($deptcd!='all') {
		$res11qry="SELECT DISTINCT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid LEFT JOIN tblhrattuserinfo ON tblcontact.employeeid=tblhrattuserinfo.employeeid LEFT JOIN tblhractlog ON tblcontact.employeeid=tblhractlog.employeeid WHERE tblcontact.contact_type='personnel' AND $wheremprecord AND tblempdetails.empdepartment='$deptcd' ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";			
		} else {
		$res11qry="SELECT DISTINCT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid LEFT JOIN tblhrattuserinfo ON tblcontact.employeeid=tblhrattuserinfo.employeeid LEFT JOIN tblhractlog ON tblcontact.employeeid=tblhractlog.employeeid WHERE tblcontact.contact_type='personnel' AND $wheremprecord ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";						
		} //if-else
		$result11=$dbh2->query($res11qry);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$employeeid11 = $myrow11['employeeid'];
			$name_last11 = $myrow11['name_last'];
			$name_first11 = $myrow11['name_first'];
			$name_middle11 = $myrow11['name_middle'];
			$empdepartment11 = $myrow11['empdepartment'];
			if($employeeid11 == $employeeid01) { $empidsel="selected"; } else { $empidsel=""; }
			echo "<option value=\"$employeeid11\" $empidsel>$employeeid11 - $name_last11, $name_first11";
			if($name_middle11!="") { echo "&nbsp;$name_middle11[0]."; }
			echo "</option>";				
			} //while
		} //if
		echo "</select></td></div>";
		
		if($employeeid01!='') {
			
		// list available year-month of timelog data
		echo "<div class='form-group'><td><select class='form-control' name=\"monsel\">";
		$res12qry=""; $result12=""; $found12=0; $ctr12=0;
		// $result12 = mysql_query("SELECT DISTINCT DATE_FORMAT(att_checktime, '%Y-%m' ) AS yyyymm FROM `tblhrattcheckinout` ORDER BY att_checktime DESC", $dbh);
		$res12qry="SELECT DISTINCT DATE_FORMAT(att_checktime, '%Y-%m' ) AS yyyymm FROM `tblhrattcheckinout` LEFT JOIN tblhrattuserinfo ON tblhrattcheckinout.att_userid=tblhrattuserinfo.att_userid WHERE tblhrattuserinfo.employeeid='$employeeid01' UNION SELECT DISTINCT DATE_FORMAT(date, '%Y-%m' ) AS yyyymm FROM `tblhractlog` WHERE tblhractlog.employeeid='$employeeid01' ORDER BY yyyymm DESC;";
		$result12=$dbh2->query($res12qry);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12 = 1;
			$yyyymm12 = $myrow12['yyyymm'];
			if($yyyymm12 == $yyyymm) { $yyyymmsel="selected"; } else { $yyyymmsel=""; }
			echo "<option value=\"$yyyymm12\" $yyyymmsel>".date("Y-M", strtotime($yyyymm12))."</option>";			
			} // while
		} // if
		echo "</select></td></div>";
		echo "<div class='form-group'><td><select class='form-control' name=\"cutmonth\">";
		if($cutmonth == "0") { $cutmo0sel="selected"; $cutmo1sel=""; $cutmo2sel=""; }
		else if($cutmonth == "1") { $cutmo0sel=""; $cutmo1sel="selected"; $cutmo2sel=""; }
		else if($cutmonth == "2") { $cutmo0sel=""; $cutmo1sel=""; $cutmo2sel="selected"; }
		else { $cutmo0sel="selected"; $cutmo1sel=""; $cutmo2sel=""; }
		echo "<option value=\"0\" $cutmo0sel>whole month</option>";
		echo "<option value=\"1\" $cutmo1sel>1st half</option>";
		echo "<option value=\"2\" $cutmo2sel>2nd half</option>";
		echo "</select></td></div>";
		
		} //if($employeeid01!='')

		
	} //if($empstat!='' && $deptcd!='')
    echo "<td><button type=submit class='btn btn-primary' name='submit' value='1'>submit</button></td></form></tr>";
    echo "</table><br>";
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
		
                echo "<table id=\"ReportTable\" class=\"fin\" border=\"1\">";
        echo "<tr><th colspan=\"$colspan\">";
        echo "<form action=\"hrofctimelogprtvw.php?loginid=$loginid\" method=\"POST\" target=\"_blank\" name=\"hrofctimelogprtvw\">";
        echo "<input type=\"hidden\" name=\"empid\" value=\"$employeeid01\">";
        echo "<input type=\"hidden\" name=\"monsel\" value=\"$yyyymm\">";
        echo "<input type=\"hidden\" name=\"cutmonth\" value=\"$cutmonth\">";
        echo "<input type=\"hidden\" name=\"empstat\" value=\"$empstat\">";
        echo "<input type=\"hidden\" name=\"deptcd\" value=\"$deptcd\">";
        echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\">Printable_view</button>";
        echo "</form>";
                echo "<a href=\"#\" id=\"exportToExcel\"><img src=\"./images/sheet.gif\"></a></th></tr>";
                echo "<tr><th rowspan=\"4\"><img src=\"./images/$picfn20\" height=\"90\"></th></tr>";
                echo "<tr><th colspan=\"$colspan\">Personnel Time and Activity Log</th></tr>";
                echo "<tr><th colspan=\"$colspan\">$name_last20, $name_first20 $name_middle20[0] - $deptcd</th></tr>";
                echo "<tr><th colspan=\"$colspan\">For the period ".date('Y-M-d', strtotime($cutstart))." -to- ".date('Y-M-d', strtotime($cutend))."</th></tr>";
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
			echo "<tr><td><font color=\"red\">".date("Y-M-d", strtotime($dateval))."</font></td><td align=\"center\"><font color=\"red\">".date("D", strtotime($dateval))."</font></td>";
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
			echo "<tr><td><font color=\"red\">".date("Y-M-d", strtotime($dateval))."</font></td><td align=\"center\"><font color=\"red\">".date("D", strtotime($dateval))."</font></td>";
    } else {
			echo "<tr><td>".date("Y-M-d", strtotime($dateval))."</td><td align=\"center\">".date("D", strtotime($dateval))."</td>";
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
/*
$res16aqry="SELECT `tblhractlog`.`activity` FROM `tblhractlog` WHERE `tblhractlog`.`date`=\"$arrcutdate0\" AND `tblhractlog`.`employeeid`=\"$employeeid01\"";
$result16a=$dbh2->query($res16aqry);
if($result16a->num_rows>0) {
  while($myrow16a=$result16a->fetch_assoc()) {
  $found16a=1;
  $activity16a=$myrow16a['activity'];
  } //while
} //if
echo "<br><br>eid01:$employeeid01|arrctdt0:$arrcutdate0|f16a:$found16a|$activity16a<br><br>$res16aqry";
echo "<br>|1";
*/
echo "</td>";
			echo "<td class='text-right'>".number_format($timeval16, 2)."</td>";
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
			// if($accesslevel>=4) { echo "<td align=\"center\"><a href=\"hrofctimelogedit.php?loginid=$loginid&eid=$employeeid01&uid=$att_userid14&iid=$hrattcheckinoutid14&oid=$hrattcheckinoutid15\">Edit</a></td>"; } else { echo "<td></td>"; }
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
    $res19query=""; $result19=""; $found19=0;
    $res19query="SELECT iditsupportapprover FROM tblitsupportapprover WHERE deptcd=\"$deptcd\" AND (approver1empid=\"$employeeid0\" OR approver2empid=\"$employeeid0\") LIMIT 1";
    $result19=$dbh2->query($res19query);
    if($result19->num_rows>0) {
        while($myrow19=$result19->fetch_assoc()) {
        $found19=1;
        $iditsupportapprover19 = $myrow19['iditsupportapprover'];
        } //while
    } //if
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
			echo "<td class='text-right'>";
			if($timevalrev1by16=='' && $employeeid01!=$employeeid0) {
			echo "<input type='number' step='any' size='4' name='timevalidate[]' value='$timevaldaily'>";
			// echo "<button type='submit' class='btn btn-success btn-sm' role='button' name='act' value='validate'>Validate</button>";
			} else {
				if($accesslevel>=5 && $employeeid01!=$employeeid0) {
			echo "<input type='number' step='any' size='4' name='timevalidate[]' value='$timevaldaily'>";
			// echo "<button type='submit' class='btn btn-success btn-sm' role='button' name='act' value='validate'>Validate</button>";					
				} else {
			echo "<font color='green'><strong>".$timevaldaily."</strong>&nbsp;hrs</font>";
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
				echo "<td class='text-right'>";
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
    echo "<td class='text-right'><i>$timeduredr</i></td>";
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
		echo "<tr><th colspan='6' class='text-right'>Total</th><th class='text-right'>".number_format($tottimeval16, 2)."</th>";
                echo "<th class='text-right'>".number_format($tottimevalrev116, 2)."</th>";

    // 20210710 disp total hrd e-foor log
    if($tottimeduredr!=0) {
    echo "<th class='text-right'><i>$tottimeduredr</i></th>";
    } else {
    echo "<th></th>";
    } //if-else
                echo "</tr>";
		echo "<tr><th colspan='$colspan' class='text-center'><button type='submit' class='btn btn-success' name='act' value='validate'>Save</button></th></tr>";
		echo "</form>";
	} //if($employeeid01!='')
  }

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"index2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

    $requery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include("logindeny.php");
} //if-else

mysql_close($dbh);
$dbh2->close();
?> 
