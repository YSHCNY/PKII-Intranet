<?php



?> <!-- div class="row" -->

	<div class="container pt-5">
	<br><br>
	<div class = ''>
		<div class="border shadow rounded-3  p-4 m-5">

	<div class = 'text-center'>
	<p class="mb-0 <?php echo $maintext ?> fw-bold text-capitalize fs-4">overtime request </p>
	<p class = '<?php echo $subtext ?> fs-5' >Authirization Form (HRD-F-11)</p>
	</div>

<?php
	echo "<form method=\"POST\" action=\"index.php?lst=1&lid=$loginid&sess=$session&p=362\" class = 'p-3' name=\"mhrotfrmreq2\"> ";	
	echo "<input type=\"hidden\" name=\"requestorempid\" value=\"$employeeid0\">";
	echo "<input type=\"hidden\" name=\"deptcd\" value=\"$empdepartment0\">";
	echo "<input type=\"hidden\" name=\"ctgactor\" value=\"REQ\">";
?>
	
	<div class="row mt-4">
		<div class="col-lg-6">
			<div class = 'mb-4'>
				<p class="<?php echo $subtext ?> fs-5 mb-1">Requested by</p>
				<?php
					echo "<p class = '$maintext fs-4'>$name_last0, $name_first0 $name_middle0[0]";
					if($empposition0!='') { echo " of $empposition0"; }
					if($empdepartment0!='') { echo " of $empdepartment0"; }
				?>
				</p>
			</div>

		</div>


		<div class="col-lg-6">
			<div class = 'mb-4'>
				<p class="<?php echo $subtext ?> fs-5 mb-1">Date of Application</p>
				<input type="date" class = ' <?php echo "$maintext $mainbg" ?> fs-4 px-3  ' name="dateapplic" value="<?php echo $datenow; ?>" readonly>
			</div>

		</div>
	</div>
	
	


	<div class = 'mb-4'>
	<p class="<?php echo $subtext ?> fs-5 mb-1">Overtime date</p>
	<input type="date" class = 'rounded-3 <?php echo "$maintext $mainbg" ?> fs-4 px-3 border py-2 ' id="stamprequest" name="stamprequest" value="<?php echo $datenow; ?>">
	</div>

<?php
		include '../m/qryhrtapaygrpemplst.php';
		include '../m/qryhrtapayshiftctg.php';
		if($found12==1) {
			$shiftoutarr = split(':', $shiftout12);
			$shiftouthh = $shiftoutarr[0];
			$shiftoutmm = $shiftoutarr[1];
			$shiftout2hh = $shiftouthh+2;
			$durfrhh="$shiftouthh"; $durfrmm="$shiftoutmm"; $durtohh="$shiftout2hh"; $durtomm="$shiftoutmm";
		} else {
			$durfrhh="18"; $durfrmm="00"; $durtohh="20"; $durtomm="00";
		} // if-else
?>
<div class = 'mb-4'>
	<p class="<?php echo $subtext ?> fs-5 mb-1">Duration of Overtime</p>
		<input type="text" class="smalltext rounded-3 <?php echo "$maintext $mainbg" ?> fs-4 px-3 border py-2 " name="durationFrom" value="<?php echo $durfrhh; ?>">
		<input type="text" class="smalltext rounded-3 <?php echo "$maintext $mainbg" ?> fs-4 px-3 border py-2 " name="durationFrom1" value="<?php echo $durfrmm; ?>"><span class = 'px-3'>to</span>
		<input type="text" class="smalltext rounded-3 <?php echo "$maintext $mainbg" ?> fs-4 px-3 border py-2 " name="durationTo" value="<?php echo $durtohh; ?>">
		<input type="text" class="smalltext rounded-3 <?php echo "$maintext $mainbg" ?> fs-4 px-3 border py-2 " name="durationTo1" value="<?php echo $durtomm; ?>"> 
		</div>
	
<?php
	// echo "<p>eid0:$employeeid0,dept0:$empdepartment0,f11:$found11$,idpaygrpemplst=$idhrtapaygrpemplst11,idpaygrp:$idtblhrtapaygrp11,idpayshift:$idhrtapayshiftctg11,actv:$activesw11<br>f12:$found12,durfrhh:$shiftouthh,durfrmm:$shiftoutmm</p>";
?>
	
	<div class = 'mb-4'>
	<p class="<?php echo $subtext ?> fs-5 mb-1">Reasons for Overtime</p>
	<textarea class = 'form-control  <?php echo "$maintext $mainbg" ?>' style = 'height: 200px !important;' placeholder="Type Here.." name="details"></textarea>
	</div>

	<div class = 'mb-4'>
	<p class="<?php echo $subtext ?> fs-5 mb-1">Approver</p>
	<select class=' border form-control rounded-3 px-3 py-2 <?php echo "$maintext $mainbg" ?>' name="approver">
    <?php
include '../includes/dbh.php';

    // Correct SQL query variable name
    $fetchapprov = "SELECT * FROM tblManagerApproverOTLeave 
                    LEFT JOIN tblcontact 
                    ON tblManagerApproverOTLeave.ManagerApproverID = tblcontact.employeeid 
                    WHERE tblManagerApproverOTLeave.deptcd = '$empdepartment0'";
    $resultFetch = $dbh->query($fetchapprov);

    if ($resultFetch->num_rows > 0) {
        while ($myrowfetch = $resultFetch->fetch_assoc()) {
            $empidapp = htmlspecialchars($myrowfetch['ManagerApproverID']);
            $lastappr = htmlspecialchars($myrowfetch['name_last']);
            $firstappr = htmlspecialchars($myrowfetch['name_first']);
            $middleappr = htmlspecialchars($myrowfetch['name_middle']);

            echo "<option value='$empidapp'>$lastappr, $firstappr $middleappr ($empidapp)</option>";
        }
    } else {
        // Handle no results found
        echo "<option value=''>No approvers test found</option>";
    }
    ?>
</select>
	

	

	<!-- // $deptcd16=$empdepartment0;
	// include '../m/qrymitsuppreq8b.php';
	// if($approver1empid18b!='') {
	// include '../m/qrymitsuppreq8c.php';
	// echo "<option value=\"$approver1empid18b\">$name_last18c, $name_first18c $name_middle18c[0]";
	// if($empposition18c!='') { echo "&nbsp;-&nbsp;$empposition18c"; }
	// echo "&nbsp;-&nbsp;$empdepartment18c</option>";
	// } // if
	// if($approver2empid18b!='') {
	// include '../m/qrymitsuppreq8d.php';
	// echo "<option value=\"$approver2empid18b\">$name_last18d, $name_first18d $name_middle18d[0]";
	// if($empposition18d!='') { echo "&nbsp;-&nbsp;$empposition18d"; }
	// echo "&nbsp;-&nbsp;$empdepartment18d</option>";
	// } // if -->

</div>

	<div class = 'my-4 text-end'>
	<a class="<?php echo $maintext ?> rounded-3 mx-3 px-3 py-2 border" href='<?php echo "index.php?lst=1&lid=$loginid&sess=$session&p=36";?>'>Cancel</a>
	<button id="btnsubmit" type="submit" class="secondarybgc text-white mx-3 rounded-3 px-3 py-2 border" value="submit">Submit request</button>
	</div>
<?php
	echo "</form>";
?>

		</div>
	
	</div> <!-- div class=row -->

	</div>

<style type="text/css">
	.smalltext{
		width: 40px;
	}
</style>

<!-- <script type="text/javascript">
	$(document).ready(function(){
		 //Display Only Date till today // 
		  var dtToday = new Date();
		  var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
		  var day = dtToday.getDate();
		  var dayend = dtToday.getDate() ;
		  var year = dtToday.getFullYear();
		  if(month < 10)
		      month = '0' + month.toString();
		  if(day < 10)
		      day = '0' + day.toString();

		  var maxDate = year + '-' + month + '-' + day;
		  var maxDate1 = year + '-' + month + '-' + dayend;

		  $('#stamprequest').attr('min', maxDate1);
		   
	});
</script> -->