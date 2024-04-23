<?php
//
// mhrotfrmreq.php
// fr: vc/index.php
// indexlinks: $page==361

require '../includes/config.inc';
require '../includes/dbh.php';


?>
	
	<div class="container pt-5">
	<br><br>
	
		<div class="border shadow rounded-3  p-4 m-5">
		<div class = 'text-center'>
	<p class="mb-0 maintext fw-bold text-capitalize fs-4">Leave application </p>
	<p class = 'submaintext fs-5' >Authirization Form (HRD-F-12)</p>
	</div>



<?php
	echo "<form method=\"POST\" action=\"index.php?lst=1&lid=$loginid&sess=$session&p=367\" name=\"mhrlvfrmreq2\">";	
	echo "<input type=\"hidden\" name=\"requestorempid\" value=\"$employeeid0\">";
	echo "<input type=\"hidden\" name=\"deptcd\" value=\"$empdepartment0\">";
	echo "<input type=\"hidden\" name=\"ctgactor\" value=\"REQ\">";
?>
	


	<?php 
			$resquery = "SELECT * from tblhrtaleavectg";
     		$result = $dbh->query($resquery);
     ?>

<div class="row my-4">
	<div class="col-lg-6">
				<div class = 'mb-4'>
							<p class="text-muted fs-5 mb-1">Requested by</p>	
			<?php
				echo "$name_last0, $name_first0 $name_middle0[0]";
				if($empposition0!='') { echo " of $empposition0"; }
				if($empdepartment0!='') { echo " of $empdepartment0"; }
			?>
					</p>
			</div>
	</div>
				<div class="col-lg-6">
				<div class = 'mb-4'>
				<p class="text-muted fs-5 mb-1">Date of Application</p>
				<input type="date" name="dateapplic" class = 'border-0 maintext fs-4 px-3  '  value="<?php echo $datenow; ?>" readonly>
				</div>
	</div>
</div>


<div class = 'mb-4'>
	<p class="text-muted fs-5 mb-1">Start Date</p>
	<input type="date" name="startdate" class = 'rounded-3 maintext fs-4 px-3 border py-2 ' id='startdate' value="<?php echo $datenow; ?>">
	</div>

<div class = 'mb-4'>
	<p class="text-muted fs-5 mb-1">End Date</p>
	<input type="date" name="enddate" class = 'rounded-3 maintext fs-4 px-3 border py-2 ' id="enddate" value="<?php echo $datenow; ?>">
	</div>

<div class = 'mb-4'>
	<p class="text-muted fs-5 mb-1">Leave Type</p>
	<select class="form-control" name="idleavectg">
		<?php
          	while($myrow = $result->fetch_assoc()) {
          		echo "<option value='".$myrow['idhrtaleavectg']."'>".$myrow['name']."</option>";
          	}

		?>
		</select>
		</div>

	
<?php
		include '../m/qryhrtapaygrpemplst.php';

?>

<?php
	// echo "<p>eid0:$employeeid0,dept0:$empdepartment0,f11:$found11$,idpaygrpemplst=$idhrtapaygrpemplst11,idpaygrp:$idtblhrtapaygrp11,idpayshift:$idhrtapayshiftctg11,actv:$activesw11<br>f12:$found12,durfrhh:$shiftouthh,durfrmm:$shiftoutmm</p>";
?>

	<div class = 'mb-4'>
	<p class="text-muted fs-5 mb-1">Reasons for Leave</p>
	<textarea class = 'form-control' style = 'height: 200px !important;' placeholder="Type Here.." name="details"></textarea>
	</div>


	
	

	<div class = 'mb-4'>
	<p class="text-muted fs-5 mb-1">Approver</p>
	<select class = 'bg-white border form-control rounded-3 px-3 py-2 maintext' name="approver">
	<?php

	$deptcd16=$empdepartment0;
	include '../m/qrymitsuppreq8b.php';
	if($approver1empid18b!='') {
	include '../m/qrymitsuppreq8c.php';
	echo "<option value=\"$approver1empid18b\">$name_last18c, $name_first18c $name_middle18c[0]";
	if($empposition18c!='') { echo "&nbsp;-&nbsp;$empposition18c"; }
	echo "&nbsp;-&nbsp;$empdepartment18c</option>";
	} // if
	if($approver2empid18b!='') {
	include '../m/qrymitsuppreq8d.php';
	echo "<option value=\"$approver2empid18b\">$name_last18d, $name_first18d $name_middle18d[0]";
	if($empposition18d!='') { echo "&nbsp;-&nbsp;$empposition18d"; }
	echo "&nbsp;-&nbsp;$empdepartment18d</option>";
	} // if
?>
</select>
</div>


	<div class = 'my-4 text-end'>
	<a class="maintext rounded-3 mx-3 px-3 py-2 border-0" href='<?php echo "index.php?lst=1&lid=$loginid&sess=$session&p=36";?>'>Cancel</a>
	<button id="btnsubmit" type="submit" class="secondarybgc text-white mx-3 rounded-3 px-3 py-2 border-0" value="submit">Submit request</button>
	</div>
<?php
	echo "</form>";
?>

		</div>
		
	</div> <!-- div class=row -->



<style type="text/css">
	.smalltext{
		width: 40px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		 //Display Only Date till today // 
		  var dtToday = new Date();
		  var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
		  var day = dtToday.getDate();
		  var dayend = dtToday.getDate() + 1;
		  var year = dtToday.getFullYear();
		  if(month < 10)
		      month = '0' + month.toString();
		  if(day < 10)
		      day = '0' + day.toString();

		  var maxDate = year + '-' + month + '-' + day;
		  var maxDate1 = year + '-' + month + '-' + dayend;
		  $('#startdate').attr('min', maxDate1);

		  $('#enddate').attr('min', maxDate1);
		  

		   
	});
</script>

