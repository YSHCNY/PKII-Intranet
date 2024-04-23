<?php
//
// mactivitylogedt.php
// fr: vc/index.php

// get variables
$lst=1;
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page=143;
$hractlogid = (isset($_GET['aid'])) ? $_GET['aid'] :'';

// query activity log based on id
include '../m/qrymactivitylog7.php';

?>
	<!-- <div class="mainbgc p-5">
		<div class="m-5"><h3 class = "text-white fs-3">Edit My Activity</h3></div>
		</div> -->
<br><br><br>
	<div class="container ">
		<div class="border my-5  mx-3 rounded-4 bg-white shadow p-5">
			<p class="maintext fw-bold fs-4">Edit Your Entry  <span class = 'fw-normal maintext'>on  date</span> <?php echo $date16; ?></p>
	


	<div class = 'mt-4'>
	<p class="text-muted fs-5 mb-1">Date</p>
	<input type="date" class = ' maintext border rounded-3 px-3 py-2 '  name="actdate" id='actdate' value="<?php echo $date16; ?>">
	</div>

	<div class = 'mt-4'>
	<p class="text-muted fs-5 mb-1">Details</p>
	<textarea class = 'maintext form-control' rows="5" cols="50" name="actdetails" id='actdetails'><?php echo "$activity16"; ?></textarea>
	</div>
	<!--20200504 insert more details for projcode and timeduration -->
	<!-- <tr><th colspan="2">Please fill-up below if required by your superiors</th></tr> -->
	<div class = 'mt-4'>
	<p class="text-muted fs-5 mb-1">Project</p>
	<div class="form-group">
    <select class="form-control" name="projcd" id='prjcd'>
	<option value="">-</option>
		<?php
		require '../includes/dbh.php';
			$res9qry=""; $result9=""; $found9=0; $ctr9=0;
			$res9qry="SELECT DISTINCT proj_code, proj_name FROM tblprojassign WHERE employeeid='$employeeid0' ORDER BY durationto DESC";
			$result9=$dbh->query($res9qry);
			if($result9->num_rows>0) {
				while($myrow9=$result9->fetch_assoc()) {
					$found9=1;
					$ctr9=$ctr9+1;
					$proj_code9 = trim($myrow9['proj_code']);
					$proj_name9 = trim($myrow9['proj_name']);
					if($proj_code9==$projcode16) {
						$projcodesel="selected";
					} else {
						$projcodesel="";
					} // if-else
					echo "<option value='$proj_code9' $projcodesel>$proj_code9 - $proj_name9</option>";
				} // while
			} // if
		?>
			</select>
</div></div>




	<?php // $tmstart=date('H:i', strtotime($now.'-1 hour')); ?>
	<div class="my-4">
       <p class = 'fst-italic fs-5 text-danger text-center' id = 'disappearingText'>For WFH activities, please fill-up your time log.</p>
	   </div>

	   <script>
  const textElement = document.getElementById("disappearingText");

  function toggleText() {
    if (textElement.style.opacity === "0") {
      textElement.style.opacity = "1";
    } else {
      textElement.style.opacity = "0";
    }
  }

  setInterval(toggleText, 900);
</script>

		<div class="row">
			<div class="col">
				<div>
				<p class = 'submaintext'>Time started</p>
						<div class="form-group">
						<!-- <input type="time" size="8" class="form-control" name="timestart" id='tmstart' value="<?php // echo $tmstart; ?>"> -->
								<?php
									if($timestart16!='') {
										if($timestart16!='0000-00-00 00:00:00') {
											$timestart16fin=date('H:i:s', strtotime($timestart16));
										} //if
									} // if

									echo "<input type='time' class='form-control' name=\"timestart\" value=\"$timestart16fin\" id='tmstart'>";

								?>
						</div>
				</div>
			</div>
			<div class="col">
				<div>
										
							<p class="submaintext">Time ended</p>
								<div class="form-group">
								<!-- <input type="time" size="8" class="form-control" name="timeend" id='tmend' value="<?php // echo date('H:i', strtotime($now)); ?>"> -->

							<?php
								if($timeend16!='') {
									if($timeend16!='0000-00-00 00:00:00') {
										$timeend16fin=date('H:i:s', strtotime($timeend16));
									} //if
								} // if 
								echo "<input type='time' class='form-control' name=\"timeend\" value=\"$timeend16fin\" id='tmend'>";
								
							?>
  
		     	</div>
			</div>

			</div>
		</div>
	

	
								<div>
	<p class="fs-5 text-danger">Notes:</p>

		<p class = 'fs-5 fst-italic maintext'>1.	Project drop-down list is for staffs with project assignments only. Please choose the corresponding project you are engaged for the day. If project is not available, please choose ‘-‘, and indicate the specific project on the Details part instead.</p>
		<p class = 'fs-5 fst-italic maintext'>2.	Time started and time ended are only for staffs who rendered work-from-home (WFH). Please indicate your time-in/out in reference to the email notification you sent to your superior. Kindly disregard this part if reported to the head office.</p>
		<p class = 'fs-5 fst-italic maintext'>3.	Time Started should be earlier than Time Ended.</p>
		</div>

	<input type="hidden" name="actlogid" id='actlogid' value="<?php echo $hractlogid; ?>">
	<input type="hidden" name="idlogin" id='idlogin' value="<?php echo $loginid; ?>">
	<input type="hidden" name="employeeid" id='employeeid' value="<?php echo $employeeid0; ?>">

	<div class="text-end">
		
<?php
echo "<a class=\"btn btn-danger text-white mx-2\" href = 'index.php?lst=1&lid=$loginid&sess=$session&p=14' >Cancel</a>";
	echo "<button class=\"btn btn-success mx-2\" onclick=\"javascript:window.location='index.php?lst=1&lid=$loginid&sess=$session&p=14'\" id='btnActdtlSubmit'>Submit</button>";
?>
</div>

		</div>

		
	</div> <!-- div class=row -->

<div class="modal fade" id='myModal' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Activity log</h5>
        
      </div>
      <div class="modal-body" id='myModalBody'>
    
      </div>
      <div class="modal-footer">
<?php
        echo "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\" id='btnCloseRedir' onclick=\"javascript:window.location='index.php?lst=1&lid=$loginid&sess=$session&p=14'\">Close</button>";
?>
      </div>
    </div>
  </div>

  </div>
</div>

<script>
$(document).ready(function(){

	$('#btnActdtlSubmit').on('click',function(){
			var actlogid = $('#actlogid').val();
			var loginid = $('#logID').val();
			var session = $('#sessionID').val();			
			var actdate = $('#actdate').val();
			var actdetails = $('#actdetails').val();
			var idlogin = $('#idlogin').val();
			var employeeid = $('#employeeid').val();
			var prjcd = $('#prjcd').val();
			var tmstart = $('#tmstart').val();
			var tmend = $('#tmend').val();
			$.ajax({
				url: "mactivitylogedt2.php?lst=1&lid="+loginid+"&sess="+session+"&p=143",
				type: 'POST',
				data: {
					actlogid: actlogid,
					idlogin: idlogin,
					employeeid: employeeid,
					actdate: actdate,
					actdetails: actdetails,
					prjcd: prjcd,
					tmstart: tmstart,
					tmend: tmend,
				},
				success: function(returnResult) {
					$('#myModalBody').html(returnResult);
					$('#myModal').modal('show');
				}
			});		
	});	

});

</script>


	<!-- /*
	echo "hh<select name='timestarthh' id='tmstarthh'>";
	echo "<option value=''>-</option>";
    for($tmstarthh=1; $tmstarthh<=12; $tmstarthh++) {
		if($tmstarthh==$tmstart16arrhh) {
			$tmstarthhsel="selected";
		} else {
			$tmstarthhsel="";
		} //if-else
		echo "<option value='$tmstarthh' $tmstarthhsel>$tmstarthh</option>";
	} // for
	echo "</select>";
	echo "</td>:<td>mm";
	echo "<select name='timestartmm' id='tmstartmm'>";
	// echo "<option value=''>-</option>";
    for($tmstartmm=0; $tmstartmm<=59; $tmstartmm++) {
		if($tmend16arrmm)
		echo "<option value='$tmstartmm'>$tmstartmm</option>";
	} // for
	echo "</select>";
	echo "</td><td>";
	echo "<select name='timestartampm' id='tmstartampm'>";
	echo "<option value='am'>am</option>";
	echo "<option value='pm'>pm</option>";
	echo "</select>";
	*/ 







	/*
	echo "hh<select name='timeendhh' id='tmendhh'>";
	echo "<option value=''>-</option>";
    for($tmendhh=1; $tmendhh<=12; $tmendhh++) {
		echo "<option value='$tmendhh'>$tmendhh</option>";
	} // for
	echo "</select>";
	echo "</td>:<td>mm";
	echo "<select name='timeendmm' id='tmendmm'>";
	// echo "<option value=''>-</option>";
    for($tmendmm=0; $tmendmm<=59; $tmendmm++) {
		echo "<option value='$tmendmm'>$tmendmm</option>";
	} // for
	echo "</select>";
	echo "</td><td>";
	echo "<select name='timeendampm' id='tmendampm'>";
	echo "<option value='pm'>pm</option>";
	echo "<option value='am'>am</option>";
	echo "</select>";
	*/

-->