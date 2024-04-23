
<div class = 'justify-content-center align-items-center mx-auto flex '>
<?php
	// generate dates
	if($yyyymm != "") {
		
		?>


<div class=" ">


<?php
	echo "<form action='./mactivitylogupdtvd.php?lst=1&lid=$loginid&sess=$session&p=14' class = 'border-0 p-5' method='POST' name='mactivitylogupdtvd'>";
	echo "<input type='hidden' name='monsel' value='$yyyymm'>";
	echo "<input type='hidden' name='cutmonth' value='$cutmonth'>";
	echo "<input type='hidden' name='eid' value='$employeeid0'>";


	?>

<!-- <div class="p-5 border shadow rounded-4 mx-auto my-5 Duplicatemaincards">
<!-- content here -->

	<!--</div> -->

	<?php
		$actrowctr=0;	
		while($cutstart <= $cutend) {
			$dateval = date("Y-M-d", strtotime($cutstart));
			$currentDate = date("Y-M-d");
	
			if ($dateval == $currentDate) {
				$bg = " border border-primary shadow-lg";
			} else {
				$bg = " border";
			}
			?>


<div class="p-5 bg-white rounded-4 <?php echo $bg; ?> mx-auto my-5 maincards">



	<div class="row ">
	<div class="col-6">
<?php
	
		// echo "$dateval<br>";
		// 20200506 get rowspan value based on no of task activities
		include '../m/qrymactivitylog6a.php';
		$param16a = count($actrowctr16aArr);
		for($x16a = 0; $x16a < $param16a; $x16a++) {
			$actrowctr=$actrowctr16aArr[$x16a];
		} //for
		if($actrowctr>1) {
			$actrowspan="rowspan='$actrowctr'";
		} else {
			$actrowspan="";	
		} //if-else
		if(date("D", strtotime($dateval)) == "Sun") {
		echo "<tr $actrowspan>
		<p class = 'text-muted' $actrowspan>Date: <span class = 'text-danger'>".date("Y-M-d", strtotime($dateval))."</span></p>
		<p class = 'text-muted' $actrowspan >Day: <span class = 'text-danger'>".date("D", strtotime($dateval))."</span></p>";
		} else {
    // 20210726 chk if holiday, then font color=red
	
    include '../m/qrymactivitylog1.php';
    if($found11b==1 && $yyyymmdd11b==$cutstart) {
		echo "<tr $actrowspan>
		
		<p class = 'text-muted ' $actrowspan>Date: <span class = 'text-danger'>".date("Y-M-d", strtotime($dateval))."</span></p>
		<p class = 'text-muted ' $actrowspan>Day: <span class = 'text-danger'>".date("D", strtotime($dateval))."</span></p>";
    } else {
		echo "<tr $actrowspan>
		<p class = 'text-muted ' $actrowspan>Date: <span class = 'maintext'>".date("Y-M-d", strtotime($dateval))."</span></p>
		<p class = 'text-muted ' $actrowspan >Day: <span class = 'maintext'>".date("D", strtotime($dateval))."</span></p>";
    } //if-else
		} // if(date("D", strtotime($dateval)) == "Sun")


		?>
</div>
<div class="col-6 text-end">
<?php
// wfh ============================================================================================================================================
    // 20210710 wfh column
    $wfhflag="";
    if($timein14val!="" || $timeout15val!="") {
    $wfhflag="On Site";
    } else {
        // chk if activity log has entries else blank
        if($actrowctr!=0) {
        $wfhflag="WFH";
		$cs = 'mainboxbg rounded-3 px-3 py-2 text-white';
        } else {
        $wfhflag="No entries";
		$cs = '';
        } //if-else
    } //if-else
                                                                        echo "<p $actrowspan > <span class='$cs'>$wfhflag</span></p>";
?>


</div>



<?php
// time ======================================================================================
		
		// display time log if exist
        $timein14val=""; $timeout15val="";
		if($att_userid12!='' && $att_userid12!=0) {
			                                                         echo "<p $actrowspan class=' text-muted'>Time In: <span class = 'maintext'>";
			include("../m/qrymactivitylog4.php");
			$param14 = count($hrattcheckinoutid14Arr);
			for($x=0; $x<$param14; $x++) {
				if($timein14Arr[$x] != "") {
                $timein14val=$timein14Arr[$x];
				
				echo date("G:i", strtotime($timein14Arr[$x]));
			
				// $timein14Arr[$x]="";
                                } // if
			} // for
                        if($found14==0) {
                            if($found14b==1 && date("G:i", strtotime($timestart14b))!="0:00") {
                                                                   echo "<i>".date("G:i", strtotime($timestart14b))."</i>";
                         
			// echo "|$found14|$found14b<br>$dateval|$cutstart|$timestart14b<br>$res14bquery";
                            } //if
                        } //if
                                                                      echo "</span></p>"; 
																	  
																	 
	
																	  $timein14Arr[$x]=""; $timestart14b=""; $res14query=""; $res14bquery="";



// timeout  ======================================================================================
                                                                                echo "<p $actrowspan class=' text-muted'>Time Out: <span class = 'maintext'>";
			include("../m/qrymactivitylog5.php");
			$param15 = count($hrattcheckinoutid15Arr);
			for($x=0; $x<$param15; $x++) {
				if($timeout15Arr[$x] != "") {
                  $timeout15val=$timeout15Arr[$x];
				echo date("G:i", strtotime($timeout15Arr[$x]));
			
				// $timeout15Arr[$x]="";
				} // if
			} // for
                        if($found15==0) {
                        if($found15b==1 && date("G:i", strtotime($timeend15b))!="0:00") {
                                                                                  echo "<i>".date("G:i", strtotime($timeend15b))."</i>";
                        
                        } //if
			// echo "$found15|$found15b|$timeend15b<br>$res15bquery";
                        } //if
						echo "</span></p>"; 
																			   $timeout15Arr[$x]=""; $timeend15b=""; $res15query=""; $res15bquery="";
		} else {

                    if($fk_uc_UserID12!='' && $fk_uc_UserID12!=0) {
                                                                           echo "<p $actrowspan class=' text-muted'>Time Out: <span class = 'maintext'>";
			include("../m/qrymactivitylog4.php");
			$param14 = count($hrattcheckinoutid14Arr);
			for($x=0; $x<$param14; $x++) {
				if($timein14Arr[$x] != "") {
$timein14val=$timein14Arr[$x];
				echo date("G:i", strtotime($timein14Arr[$x]));
				
				$timein14Arr[$x]="";
				} // if
			} // for
			echo "</span></p>"; 
																		  
																		 
																		 
			echo "<p $actrowspan class=' text-muted'>Time Out: <span class = 'maintext'>";
			include("../m/qrymactivitylog5.php");
			$param15 = count($hrattcheckinoutid15Arr);
			for($x=0; $x<$param15; $x++) {
				if($timeout15Arr[$x] != "") {
$timeout15val=$timeout15Arr[$x];
				echo date("G:i", strtotime($timeout15Arr[$x]));
			
				$timeout15Arr[$x]="";
				} // if
			} // for
			echo "</span></p>"; 
                    } else { 
                echo "<td $actrowspan></td><td $actrowspan></td>";
                    } //if-else
                } // if-else



?>




<?php




    // 20210709 compute timeduration from e-door logs
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



			
                include './mactivitylogqrywfhtimelog.php';

		// display activity log
		// echo "<table border='1' spacing='0' cellspacing='0' cellpadding='0'>";
		include("../m/qrymactivitylog6.php");
		$param16 = count($hractlogid16Arr);
		
		if($timestart16Arr[$x]!='' && $timeend16Arr[$x]!='') {
			if($timestart16Arr[$x]!='0000-00-00 00:00:00' && $timeend16Arr[$x]!='0000-00-00 00:00:00') {
			$timedur = (strtotime($timeend16Arr[$x]) - strtotime($timestart16Arr[$x]))/3600;
			echo "<p class = 'text-muted'>Duration: <span class = 'maintext'>".date('H:i', strtotime($timestart16Arr[$x]))."-".date('H:i', strtotime($timeend16Arr[$x]))."</span></p>";
			} //if
		} // if


		if($projcode16Arr[$x]!='') {				
			echo "<p class = 'maintext'><span class = 'submaintext'>Project:</span> ".$projcode16Arr[$x]." ";
			if($proj_sname16Arr[$x]=='') {
				echo "".substr($proj_fname16Arr[$x], 0 ,16)."";
			} else {
				echo "".$proj_sname16Arr[$x]."</p>";
			} //if-else
			} //if

		?>

		

</div>

		<?php
		
		if($param16>0) {
			
		for($x = 0; $x < $param16; $x++) {
			
			$timedur=0;

		// echo "<tr><td>";
		if($actrowctr>1) {
			if($x>=1) {
		                                                                        		
			} //if
		} //if
	


			$aid[$x]=$hractlogid16Arr[$x];

	
			echo "<div class = 'border-top py-3 my-3'>
			<p class = 'text-muted '>Details:</p>
			<p class = 'maintext fs-4'>".nl2br($activity16Arr[$x])."</p>";



			
			
	
echo "</div>";


?>
<div class="text-end pb-4">
<?php
		
			// echo "&nbsp;&nbsp;<font size=\"2\"><i><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=143&aid=".$hractlogid16Arr[$x]."\"><font color=\"blue\">Edit</font></a></i></font>";
			echo "&nbsp;&nbsp;<button type=\"button\" class=\"px-4 py-2 rounded-4 border-0 \"  style = 'background-color: #327134 !important;' onclick=\"javascript:window.location='index.php?lst=1&lid=$loginid&sess=$session&p=143&aid=".$hractlogid16Arr[$x]."'\"><svg width=\"23\" height=\"23\" viewBox=\"0 0 16 16\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
			<mask id=\"mask0_31_454\" style=\"mask-type:alpha\" maskUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"16\" height=\"16\">
			<rect width=\"16\" height=\"16\" fill=\"#D9D9D9\"/>
			</mask>
			<g mask=\"url(#mask0_31_454)\">
			<path d=\"M1.33325 15.9999V13.3333H14.6666V15.9999H1.33325ZM3.99992 10.6666H4.93325L10.1333 5.48325L9.18325 4.53325L3.99992 9.73325V10.6666ZM2.66659 11.9999V9.16659L10.1333 1.71659C10.2555 1.59436 10.3971 1.49992 10.5583 1.43325C10.7194 1.36659 10.8888 1.33325 11.0666 1.33325C11.2444 1.33325 11.4166 1.36659 11.5833 1.43325C11.7499 1.49992 11.8999 1.59992 12.0333 1.73325L12.9499 2.66659C13.0833 2.78881 13.1805 2.93325 13.2416 3.09992C13.3027 3.26659 13.3333 3.43881 13.3333 3.61659C13.3333 3.78325 13.3027 3.94714 13.2416 4.10825C13.1805 4.26936 13.0833 4.41659 12.9499 4.54992L5.49992 11.9999H2.66659Z\" fill=\"white\"/>
			</g>
			</svg>
			</button>";
			
			// echo "&nbsp;&nbsp;<font size=\"2\"><i><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=144&aid=".$hractlogid16Arr[$x]."\"><font color=\"red\">Del</font></a></i></font>";
			echo "&nbsp;&nbsp;<button type=\"button\" class=\"btnActlogDelete px-4 py-2 rounded-4 border-0\" style = 'background-color: #712A2A !important;' data-toggle=\"modal\" data-target=\"#myModal\" data-id='".$hractlogid16Arr[$x]."'><svg width=\"25\" height=\"25\" viewBox=\"0 0 16 16\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
			<mask id=\"mask0_31_459\" style=\"mask-type:alpha\" maskUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"16\" height=\"16\">
			<rect width=\"16\" height=\"16\" fill=\"#D9D9D9\"/>
			</mask>
			<g mask=\"url(#mask0_31_459)\">
			<path d=\"M4.66675 14C4.30008 14 3.98619 13.8694 3.72508 13.6083C3.46397 13.3472 3.33341 13.0333 3.33341 12.6667V4H2.66675V2.66667H6.00008V2H10.0001V2.66667H13.3334V4H12.6667V12.6667C12.6667 13.0333 12.5362 13.3472 12.2751 13.6083C12.014 13.8694 11.7001 14 11.3334 14H4.66675ZM11.3334 4H4.66675V12.6667H11.3334V4ZM6.00008 11.3333H7.33342V5.33333H6.00008V11.3333ZM8.66675 11.3333H10.0001V5.33333H8.66675V11.3333Z\" fill=\"white\"/>
			</g>
			</svg>
			</button>";
		
	


			?>
</div>
			<?php

	
			if($timestart16Arr[$x]!='' && $timeend16Arr[$x]!='') {
				if($timestart16Arr[$x]!='0000-00-00 00:00:00' && $timeend16Arr[$x]!='0000-00-00 00:00:00') {
				// echo "<strong>".number_format($timedur, 2)."</strong><br>man-hrs/task";
                                echo "<span class = 'text-muted '>Work Hours: </span><strong>".number_format($timedur, 2)."</strong><br>";
				} //if
			} // if
					
require '../includes/dbh.php';
		// query earliest timein14
		$res16bqry=""; $result16b=""; $found16b=0;
		$res16bqry="SELECT timestart FROM tblhractlog WHERE date='$arrcutdate0' AND employeeid='$employeeid0' AND (timestart<>'' OR timestart<>'0000-00-00 00:00:00') ORDER BY timestart ASC LIMIT 1";
		$result16b=$dbh->query($res16bqry);
		if($result16b->num_rows>0) {
			while($myrow16b=$result16b->fetch_assoc()) {
				$found16b=1;
				$timestart16b=$myrow16b['timestart'];
			} //while
		} //if
		// query latest timeout
		$res16cqry=""; $result16c=""; $found16c=0;
		$res16cqry="SELECT `timeend` FROM `tblhractlog` WHERE `date`='$arrcutdate0' AND `employeeid`='$employeeid0' AND (`timeend`<>'' OR `timeend`<>'0000-00-00 00:00:00') ORDER BY `timeend` DESC LIMIT 1";
		$result16c=$dbh->query($res16cqry);
		if($result16c->num_rows>0) {
			while($myrow16c=$result16c->fetch_assoc()) {
				$found16c=1;
				$timeend16c=$myrow16c['timeend'];
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
		
		// finalize computation of timevaldaily
		if($timein14Arr[$x]!='' && $timeout15Arr[$x]!='') {
		// reference: based on tblhrattcheckinout
			if(strtotime($timein14Arr[$x])<=strtotime($timeout15Arr[$x])) {
			$timevaldaily = number_format(((strtotime($timeout15Arr[$x]) - strtotime($timein14Arr[$x])) / 3600), 2);									
			} else {
			$timevaldaily = number_format(0, 2);
			} //if-else
		} else {
	    // ref: based on tblhractlog
		    if($timevaldlyactlog<$timevaldlyactlog2) {
			$timevaldaily = $timevaldlyactlog;
		    } else {
			$timevaldaily = $timevaldlyactlog2;
		    } //if-else
		} //if-else
		if($timeval16Arr[$x]!=0) {
			$timevaldaily=number_format($timeval16Arr[$x], 2);
		} //if

		if($x==0 && $actrowctr>1) {
		echo "<td $actrowspan><span class = 'text-muted '>Hours Redered: </span><input style='width: 80px !important;' class = 'px-2 border-1 rounded-3' type='number' step='any' name='timeval[]' value='$timevaldaily'><br>";
        // 20210709 disp time duration from e-door log if exists
        if($timeduredr!=0) {
        echo "<span class = 'text-muted '>e-Door sum: </span>(<strong>$timeduredr</strong>&nbsp;fr&nbsp;office e-door log)<br>";
        } //if

		echo "</td>";
		echo "</tr>";
		} //if

		if($actrowctr>1) {
			if($x>=1) {
		echo "</td></tr>";				
			} //if
		} //if-else
			
		// if($)
		} // for
		
		} else { //if($param16>0)
			echo "</td><td></td>";
		} //if($param16>0)

	if($actrowctr<=1) {	
	    if($timevaldaily=='') { $timevaldaily = number_format(0, 2); }
		echo "<td $actrowspan><span class = 'text-muted '>Hours Redered:</span> <input style='width: 80px !important;' class = 'px-2 border-1 rounded-3' type='number' step='any' name='timeval[]' value='$timevaldaily'><br>";
        // 20210709 disp time duration from e-door log if exists
        if($timeduredr!=0) {
        echo "<span class = 'text-muted '>E-Door sum: </span>(<strong>$timeduredr</strong>&nbsp;fr&nbsp;office e-door log)<br>";
        } 
		echo "</td>";
		echo "</tr>";
	} //if
	    // compute total man hrs based on timevaldaily
		$tottimevaldaily = number_format(($tottimevaldaily + $timevaldaily), 2);
		
		// increment date
		$cutstart = date("Y-m-d", strtotime($cutstart. " + 1 days"));
		
		// reset vars
		$timevaldlyactlog=0; $timevaldaily=0;

		?>
		</div>
		<?php
		} // while(strtotime($cutstart) <= strtotime($cutend))
	
		?>
</div>












<!-- summary ============================================================================================ -->
		<?php
	} // if($yyyymm != "")
	if($arrcutdate0!='') {
		?>
<div class = 'bg-white px-5 py-3 mx-5 mb-5 border'>
	<p class = 'text-start text-secondary'>Summary of Total Redered Hours</p>
		<?php
	echo "<p class='text-center maintext mb-0 fs-1 mt-2'>".$tottimevaldaily."</p>
	<p class='text-center text-muted fs-5'>Total man-hours</p>";
            if($tottimeduredr!=0) {
	    echo "<p class='text-center maintext mb-0 fs-1 mt-2'>".$tottimeduredr."</p>
		<p class='text-center text-muted fs-5'>Total hours from ofc e-door log</p>";
            } //if
	echo "<div class = 'mx-auto text-center '><button type='submit' class=' text-center rounded-3 text-white my-4 border-0 px-4 py-3 mainbgc' name='submtmvaldly' value='1'>Save</button></div>";
	echo "</form>";

	?>
</div>
	<?php
	} //if




?>
	<button id="scrollToCurrentDayButton" title = 'Scroll to current Day' class="floating-button"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar2-event" viewBox="0 0 16 16">
  <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
  <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5z"/>
</svg></button>


<style>
	.floating-button {
    position: fixed;
    bottom: 140px;
    right: 20px;
    padding: 10px 10px;
    background-color: #007bff;
    color: #fff;
	border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  font-size: 18px;
    cursor: pointer;
 
}
</style>


<script>
    // JavaScript code to get content of maincards and display it in Duplicatemaincards



	document.getElementById("scrollToCurrentDayButton").addEventListener("click", function() {
    // Get the current day card
    var currentDayCard = document.querySelector(".border-primary");
    if (currentDayCard) {
        // Scroll to the current day card
        currentDayCard.scrollIntoView({ behavior: "smooth", block: "center" });
    }
});



window.addEventListener('DOMContentLoaded', function() {
        var maincards = document.querySelectorAll('.maincards');
        var duplicatemaincards = document.querySelector('.Duplicatemaincards');
        
        maincards.forEach(function(card) {
            var content = card.innerHTML;
            duplicatemaincards.insertAdjacentHTML('beforeend', content);
        });
    });

</script>
