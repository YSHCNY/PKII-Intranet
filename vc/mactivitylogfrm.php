<div class="">
	<div class="bg-white p-5">

		<div class = "form-group">
		<label for="actdate" class = 'text-secondary fw-normal'>Date</label>
		<input type="date" size="10" class="form-control rounded-4 shadow-none bg-white border" name="actdate" id='actdate' value="<?php echo $datenow; ?>">
		</div>

		<div class="form-group">
			<label for="actdetails" class = 'text-secondary fw-normal'>Details</label>
			<textarea style="height:100px;" placeholder="Type here..." class="form-control rounded-4 shadow-none bg-white border" name="actdetails" id='actdetails'></textarea>
		</div>
		

	<!-- <tr><th colspan="2">Please fill-up below if required by your superiors | <?php echo date('H:i', strtotime("now")); ?></th></tr> -->
<?php
?>

	<div class="form-group">
	<label for="projcd" class = 'text-secondary fw-normal'>Project</label>
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
			echo "<option value='$proj_code9'>$proj_code9 - $proj_name9</option>";
		} // while
	} // if
?>
    </select>
</div>


	<!-- <input type="time" size="8" class="form-control" name="timestart" id='tmstart' value="<?php // echo $tmstart; ?>"> -->
	<div class="row border m-1 rounded-4 p-4">
	
		<div class="col ">
		<h5 class = "fw-bold text-center pb-5">Time Started</h5>	
	
<?php
	echo "<p class = 'text-secondary ms-5 ps-5 fw-normal'>Hour</p>";
	echo "<select name='timestarthh' class ='w-75 text-center bg-white form-control mx-auto m-3' id='tmstarthh'>";
	echo "<option selected disabled >HH</option>";
    for($tmstarthh=1; $tmstarthh<=12; $tmstarthh++) {
		echo "<option value='$tmstarthh'>$tmstarthh</option>";
	} // for
	echo "</select>";

	echo "<p class = 'text-secondary ms-5 ps-5 fw-normal'>Minutes</p>";
	echo "<select name='timestartmm' class ='w-75 text-center bg-white form-control mx-auto m-3' id='tmstartmm'>";
	echo "<option selected disabled >MM</option>";
    for($tmstartmm=0; $tmstartmm<=59; $tmstartmm++) {
		echo "<option value='$tmstartmm'>$tmstartmm</option>";
	} // for
	echo "</select>";

	echo "<p class = 'text-secondary ms-5 ps-5 fw-normal'>Time Period</p>";
	echo "<select name='timestartampm' class ='w-75 text-center bg-white form-control mx-auto m-3' id='tmstartampm'>";
	echo "<option selected disabled >TT</option>";
	echo "<option  value='am'>am</option>";
	echo "<option value='pm'>pm</option>";
	echo "</select>";

?>
	
 </div>
 <div class="col">
	

 <h5 class = "fw-bold text-center pb-5">Time Ended</h5>	

<?php
	echo "<p class = 'text-secondary ms-5 ps-5 fw-normal'>Hour</p>";
	echo "<select name='timeendhh' class ='w-75 text-center bg-white form-control mx-auto m-3' id='tmendhh'>";
	echo "<option selected disabled >HH</option>";
    for($tmendhh=1; $tmendhh<=12; $tmendhh++) {
		echo "<option value='$tmendhh'>$tmendhh</option>";
	} // for
	echo "</select>";

	echo "<p class = 'text-secondary ms-5 ps-5 fw-normal'>Minutes</p>";
	echo "<select name='timeendmm' class ='w-75 text-center bg-white form-control mx-auto m-3' id='tmendmm'>";
	echo "<option selected disabled >MM</option>";
    for($tmendmm=0; $tmendmm<=59; $tmendmm++) {
		echo "<option value='$tmendmm'>$tmendmm</option>";
	} // for
	echo "</select>";
	echo "</td><td>";

	echo "<p class = 'text-secondary ms-5 ps-5 fw-normal'>Time Period</p>";
	echo "<select name='timeendampm' class ='w-75 text-center bg-white form-control mx-auto m-3' id='tmendampm'>";
	echo "<option selected disabled >TT</option>";
	echo "<option  value='pm'>pm</option>";
	echo "<option value='am'>am</option>";
	echo "</select>";
	echo "</td>"
?>
    
</div>


	<div class = "container">
		<div class="my-4 p-4">
	<p class="text-start fs-5 text-danger d-none d-lg-block">Notes:</p>
	<p class = "fs-6 text-muted fst-italic d-none d-lg-block">1.	Project drop-down list is for staffs with project assignments only. Please choose the corresponding project you are engaged for the day. If project is not available, please choose ‘-‘, and indicate the specific project on the Details part instead.</p>
	<p class = "fs-6 text-muted fst-italic d-none d-lg-block">2.	Time started and time ended are only for staffs who rendered work-from-home (WFH). Please indicate your time-in/out in reference to the email notification you sent to your superior. Kindly disregard this part if reported to the head office.</p>
	<p class = "fs-6 text-muted fst-italic d-none d-lg-block">3.	Time Started should be earlier than Time Ended.</p>

	<input type="hidden" name="idlogin" id='idlogin' value="<?php echo $loginid; ?>">
	<input type="hidden" name="employeeid" id='employeeid' value="<?php echo $employeeid0; ?>">
	</div>
	</div>

	<div>
<button class="btn w-100 bg-success float-end  p-4 text-white" id='btnActdtlSubmit' onclick="closeModal()">Submit</button>
</div>


</div>

</div>
</div>

<!-- div class=row -->

<!-- <div class="modal fade" id='myModal' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Activity log</h5>
        
      </div>
      <div class="modal-body" id='myModalBody'>
    
      </div>
      <div class="modal-footer">
<?php
        // echo "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\" id='btnCloseRedir' onclick=\"javascript:window.location='index.php?lst=1&lid=$loginid&sess=$session&p=14'\">Close</button>";
?>
      </div>
    </div>
  </div>
</div> -->






<script>




$(document).ready(function(){

	$('#btnActdtlSubmit').on('click',function(){
			var loginid = $('#logID').val();
			var session = $('#sessionID').val();			
			var actdate = $('#actdate').val();
			var actdetails = $('#actdetails').val();
			var idlogin = $('#idlogin').val();
			var employeeid = $('#employeeid').val();
			var prjcd = $('#prjcd').val();
			var tmstarthh = $('#tmstarthh').val();
			var tmstartmm = $('#tmstartmm').val();
			var tmstartampm = $('#tmstartampm').val();
			var tmendhh = $('#tmendhh').val();
			var tmendmm = $('#tmendmm').val();
			var tmendampm = $('#tmendampm').val();
			$.ajax({
				url: "mactivitylogadd.php?lst=1&lid="+loginid+"&sess="+session+"&p=141",
				type: 'POST',
				data: {
					idlogin: idlogin,
					employeeid: employeeid,
					actdate: actdate,
					actdetails: actdetails,
					prjcd: prjcd, 
					tmstarthh: tmstarthh, 
					tmstartmm: tmstartmm, 
					tmstartampm: tmstartampm, 
					tmendhh: tmendhh, 
					tmendmm: tmendmm, 
					tmendampm: tmendampm,
					
				},
				success: function(returnResult) {
					$('#myModalBody').html(returnResult);
					$('#myModal').modal('show');
				}
			});		
	});	

	$('#btnCloseRedir').on('click',function() {
		var loginid = $('#logID').val();
		var session = $('#sessionID').val();
		if($loginid) {
			window.location	= "";
		}
	});

});

</script>


