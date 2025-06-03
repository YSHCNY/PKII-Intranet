<?php 

$loginstat = (isset($_POST['lst'])) ? $_POST['lst'] :'';
$loginid = (isset($_POST['lid'])) ? $_POST['lid'] :'';
$session = (isset($_POST['sess'])) ? $_POST['sess'] :'';
$page = (isset($_POST['p'])) ? $_POST['p'] :'';
$cutmonth = (isset($_POST['cm'])) ? $_POST['cm'] :'';
$yyyymm = (isset($_POST['ms'])) ? $_POST['ms'] :'';

////////////////////////
// set timezone and other date/time variables
////////////////////////
	date_default_timezone_set('Asia/Manila');
	$now = date("Y-m-d H:i:s", time());
	$datenow = date("Y-m-d");
	$yearnow = date("Y");
	$monthnow = date("n");

if(($yyyymm == " ") || ($yyyymm == "")) {
	$cutstart = date("Y-m-01", strtotime($datenow));
} else {
	$cutstart = $yyyymm."-"."01";
}

if($cutmonth == "") { $cutmonth="0"; }

if($cutmonth == "0") {
  $cutend = date("Y-m-t", strtotime("$cutstart"));
	$cutmonthfin = "month";
} else if($cutmonth == "1") {
	$cutstartarr = split("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutend = $cutstartyyyy . "-" . $cutstartmm . "-" . "15";
	$cutmonthfin = "1st half";
} else if($cutmonth == "2") {
  $cutend = date("Y-m-t", strtotime("$cutstart"));
	$cutstartarr = split("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutstart = $cutstartyyyy . "-" . $cutstartmm . "-" . "16";
	$cutmonthfin = "2nd half";
}

// echo "<p>lst:$loginstat,lid:$loginid,sess:$session,p:$page,cm:$cutmonth,ms:$yyyymm,cs:$cutstart,ce:$cutend,dn:$datenow,</p>";

if($loginstat==1 && $loginid != "") {
	// check loginid and session is valid
	include("../m/qryloginverify.php");

	if($found0==1) {

		$checkicon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
</svg>';
	
$xicon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>';
	?>
<style>


		table{
			border-collapse: collapse;
		}
		table th{
			white-space: nowrap !important;
		text-align: center !important;
	}

	table .fh{
		color: rgb(73, 72, 72) !important;
	}

	table .sh{
		color: rgb(2, 36, 104) !important;
	}

	table #remarks{
		padding-inline: 2rem !important;
	}

	table #datetd{
		text-align: center !important;
		white-space: nowrap !important;

	}


	/* tr {
  page-break-inside: avoid; 
} */
 /* uncomment to avoid unwated broken rows on printing */

	
	table #thactdetails{	
    min-width: 25rem;
    max-width: 25rem;
    white-space: nowrap;
  
	}



	@media print {
	

    @page {
        
        margin: 3mm;  /* Remove margins */
    }
  

}
</style>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
	<div class="">

<?php

	// start display contents
	echo "<table class=\"table table-bordered\" border = '1'";
echo "<tr><td  colspan=\"9\" align='center'>
<img src='./img/newlogo.png' width = '300' name='pkiilogo1b'>
</td></tr>";
	echo "<tr>
		<td colspan = '9' align = 'center' >
			
				<span class ='mx-5'><b>Name:</b> $name_last0, $name_first0 $name_middle0[0]. ($employeeid0)</span>
				<span class ='mx-5'><b>Department:</b> $empdepartment0</span>
				<span class ='mx-5'><b>Period:</b>  ".date("F Y", strtotime($yyyymm))." (<span class = 'text-capitalize'>$cutmonthfin</span>)</span>

			
		</td>
	</tr>";
?>

<tr>
	<th colspan = '4' class = 'fh'>Timesheet</th>
	<th  class = 'fh'></th>
	<th colspan = '3' class = 'fh'>Time Summary</th>
	<th  class = 'fh'></th>



</tr>
<?php
	echo "<tr>
	<th colspan=\"\"class = 'sh'>Date</th>
	";

	// check if personnel has records on biometrics device
	include '../m/qrymactivitylog2.php';

	if($att_userid12 != "") {
		echo "<th class = 'sh'>IN</th><th class = 'sh'>OUT</th>";
	}

        echo "<th class = 'sh'>WFH</th>";
	echo "<th class = 'sh' id = 'thactdetails'>Acitvity Details</th>";

	?>
		<th	class = 'sh'>WFH</th>
				<th class = 'sh'>Rendered</th>
				<th class = 'sh'>Door Log</th>

<?php
	
	echo "<th class = 'sh' id = 'remarks'>Remarks</th>";
	echo "</tr>";


	// generate time log
	if($yyyymm != "") {
	while(strtotime($cutstart) <= strtotime($cutend)) {
		$dateval = date("Y-M-d", strtotime($cutstart));
		// echo "$dateval<br>";
		if(date("D", strtotime($dateval)) == "Sun") {
		echo "<tr><td id = 'datetd'><font color=\"red\">".date("Y-M-d", strtotime($dateval))."</font><br> <font color=\"red\">(".date("l", strtotime($dateval)).")</font></td>";
		} else {
    // 20210726 chk if holiday, then font color=red
			include '../m/qrymactivitylog1.php';
			if($found11b==1 && $yyyymmdd11b==$cutstart) {
				echo "<tr><td id = 'datetd'><font color=\"red\">".date("Y-M-d", strtotime($dateval))."</font><br> <font color=\"red\">(".date("l", strtotime($dateval)).")</font></td>";
			} else {
					echo "<tr><td id = 'datetd'>".date("Y-M-d", strtotime($dateval))." <br>(".date("l", strtotime($dateval)).")</td>";
			} //if-else
		} // if(date("D", strtotime($dateval)) == "Sun")

$timein14val=""; $timeout15val="";
		if($att_userid12 != "") { 
			echo "<td align=\"center\">";
			// query atttimein
			include '../m/qrymactivitylog4.php';
	// echo "<p>qrytimein:$res14query</p>";
			// for loop
			$param14 = count($hrattcheckinoutid14Arr);
			for($x=0; $x<$param14; $x++) {
				if($timein14Arr[$x] != "") {
				$timein14val=$timein14Arr[$x];
				echo date("G:i", strtotime($timein14Arr[$x]));
				echo "<br>";
				$timein14Arr[$x]="";
				} // if
			} // for
                        if($found14==0) {
                            if($found14b==1 && date("G:i", strtotime($timestart14b))!="0:00") {
                            echo "<i><font color=gray>".date("G:i", strtotime($timestart14b))."</font></i>";
                            echo "<br>";
			// echo "|$found14|$found14b<br>$dateval|$cutstart|$timestart14b<br>$res14bquery";
                            } //if
							 echo "</td>"; $timein14Arr[$x]=""; $timestart14b=""; $res14query=""; $res14bquery="";
                        } //if
                       
					

			echo "<td align=\"center\">";
			// query atttimeout
			include '../m/qrymactivitylog5.php';
			// for loop
			$param15 = count($hrattcheckinoutid15Arr);
			for($x=0; $x<$param15; $x++) {
				if($timeout15Arr[$x] != "") {
$timeout15val=$timeout15Arr[$x];
				echo date("G:i", strtotime($timeout15Arr[$x]));
				echo "<br>";
				$timeout15Arr[$x]="";
				} // if
			} // for
                        if($found15==0) {
                        if($found15b==1 && date("G:i", strtotime($timeend15b))!="0:00") {
                            echo "<i><font color=grey>".date("G:i", strtotime($timeend15b))."</font></i>";
                            echo "<br>";
                        } //if
			// echo "$found15|$found15b|$timeend15b<br>$res15bquery";
                        } //if
                        echo "</td>"; $timeout15Arr[$x]=""; $timeend15b=""; $res15query=""; $res15bquery="";
		} // if($att_userid12 != "")

    // display wfh column
    $wfhflag="";
    if($timein14val!="" || $timeout15val!="") {
    $wfhflag="$xicon";
    } else {
        // chk if activity log has entries else blank
        $actrowctr=0;
        include '../m/qrymactivitylog6a.php';
	$param16a = count($actrowctr16aArr);
	for($x16a = 0; $x16a < $param16a; $x16a++) {
	    $actrowctr=$actrowctr16aArr[$x16a];
	} //for
        if($actrowctr!=0) {
        $wfhflag="$checkicon";
        } else {
        $wfhflag="";
        } //if-else
    } //if-else
    echo "<td align='center'>$wfhflag</td>";

    // 20210710 compute timeduration from e-door logs
    $timein14aval=0; $timein14a=""; $timeout15aval=0; $timeout15a=""; $timeduredr=0;
    include '../m/qrymactivitylog4a.php';
    $timein14aval=$timein14a;
    include '../m/qrymactivitylog5a.php';
    $timeout15aval=$timeout15a;
    if(strtotime($timein14aval)!=0 && strtotime($timeout15aval)!=0) {
        if(strtotime($timeout15aval)>strtotime($timein14aval)) {
        $timeduredr = number_format(((strtotime($timeout15aval) - strtotime($timein14aval)) / 3600), 2);
        $tottimeduredr = number_format(($tottimeduredr + $timeduredr), 2);
        } //if
    } //if

		$arrcutdate = split(" ", $cutstart);
		$arrcutdate0 = $arrcutdate[0];
		
	
		// query attactivity
		include '../m/qrymactivitylog6.php';
		// for loop
		$param16 = count($hractlogid16Arr);
		for($x = 0; $x < $param16; $x++) {
	
			// if($x > 0) { echo "<br /><br />"; }

			if ($activity16Arr[$x] != ""){
			echo "<td id = 'actlogid' >";
			
			echo "".nl2br($activity16Arr[$x])."";
			
			$timevaldailyactlog=$timeval16Arr[$x];
			// disp proj
			if($projcode16Arr[$x]!='') {				
			echo "<br><br>Project: ".$projcode16Arr[$x]."";
			if($proj_sname16Arr[$x]=='') {
				echo "".substr($proj_fname16Arr[$x], 0 ,16)."";
			} else {
				echo "<strong>".$proj_sname16Arr[$x]."</strong>";
			} //if-else
			} //if
		    // disp timestart timeend if exist
			if($timestart16Arr[$x]!='' && $timeend16Arr[$x]!='') {
				if($timestart16Arr[$x]!='0000-00-00 00:00:00' && $timeend16Arr[$x]!='0000-00-00 00:00:00') {
				$timedur = (strtotime($timeend16Arr[$x]) - strtotime($timestart16Arr[$x]))/3600;
				echo "<br><br> ".date('H:i', strtotime($timestart16Arr[$x]))." - ".date('H:i', strtotime($timeend16Arr[$x]))."";
				} //if
			} // if
			echo "</td>";
			} else {
			echo "<td >";
			echo "</td>";

		}

			


			// prep and disp est. man-hrs per activity
			if($timestart16Arr[$x]!='' && $timeend16Arr[$x]!='') {				
			  if($timestart16Arr[$x]!='0000-00-00 00:00:00' && $timeend16Arr[$x]!='0000-00-00 00:00:00') {
				$timevaldaily = (strtotime($timeend16Arr[$x]) - strtotime($timestart16Arr[$x]))/3600;
			  }
			}
			// echo "<td width='2%'>|</td>";
		
		
			echo "<td align='center'>".number_format($timevaldaily, 2)."</td>";
			

		

		
			// reset var
			$timevaldaily='';
		} // for
		
	
		// 20200508
    if($timevaldailyactlog!=0) {
    echo "<td align='right'><strong>".number_format($timevaldailyactlog, 2)."</strong></td>";
    } else {
    echo "<td></td>";
    } //if-else

    if($timeduredr!=0) {
    echo "<td align='right'><i>$timeduredr</i></td>";
    } else {
    echo "<td></td>";
    } //if-else
		
    echo "<td></td>";
	


		echo "</tr>";
	    // compute total man hrs
		$tottimevaldaily = number_format(($tottimevaldaily + $timevaldailyactlog), 2);
		$cutstart = date("Y-m-d", strtotime($cutstart. " + 1 days"));
		// reset var
		$timevaldailyactlog=""; $timedur="";
	} // while(strtotime($cutstart) <= strtotime($cutend))

	echo "<tr><th colspan='6' align='right'>Total Man Hours</th><th>".number_format($tottimevaldaily, 2)."</th>";
        echo "<th align='right'><i>$tottimeduredr</i></th>";
        echo "<th></th></tr>";

	echo "<table class = 'mt-5' border=\"0\" width=\"100%\">";
		echo "<tr><td >";
		echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<tr><td align=\"center\">Submitted By:</td><td align=\"center\">Approved By:</td></tr>";
			echo "<tr><td align=\"center\"><br>_______________________<br/>Personnel</td><td align=\"center\"><br>_______________________</td></tr>";
		echo "</table>";
		echo "</td>";
	} // if

	echo "</table>";

	// end display contents
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<?php
	include './footer2.php';
	} // if($found0==1)

} // if($loginstat==1...
?>
