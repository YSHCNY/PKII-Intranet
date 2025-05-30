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
	
		<div class="border shadow rounded-3  p-5 m-5">
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
			$resquery = "SELECT * from tblhrtaleavectg WHERE idhrtaleavectg NOT IN (16,15,13,11,6)";
     		$result = $dbh->query($resquery);


		

		 
			 
		 ?>
    

<div class="row border p-4 mx-5 mb-3">
	<div class="col">
				<div class = 'px-5'>
					<h5 class=""><span class="fw-semibold">Requested by:</span> 	
			<?php
				echo "$name_last0, $name_first0 $name_middle0[0]";
				if($empposition0!='') { echo " of $empposition0"; }
				if($empdepartment0!='') { echo " of $empdepartment0"; }
			?>
					</h5>
					
		
				<h5 class=""><span class="fw-semibold">Date of Application:</span> <?php echo $datenow; ?>
				<input type="date" name="dateapplic" class = 'hidden'  value="<?php echo $datenow; ?>" readonly> </h5>
				</div>
			</div>



	<?php

$res14query="SELECT * FROM tblhrtaemptimelog LEFT JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid LEFT JOIN tblemployee ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblhrtaempleavesumm ON tblhrtaemptimelog.idpaygroup=tblhrtaempleavesumm.idhrtaempleavesumm LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.idpaygroup=tblhrtapaygrpemplst.idtblhrtapaygrp WHERE tblcontact.contact_type='personnel' AND tblcontact.employeeid=$employeeid0 LIMIT 1";
$result14=""; $found14=0; $ctr14=0;
$result14=$dbh->query($res14query);
if($result14->num_rows>0) {
	while($myrow14=$result14->fetch_assoc()) {
	$found14=1;
	$contact_gender = $myrow14['contact_gender'];
	$vl = $myrow14['vacation'];
	$sl = $myrow14['sick'];
	$pl = $myrow14['paternity'];
	$mc = $myrow14['maternityc'];
	$mn = $myrow14['maternityn'];
	$spl = $myrow14['special'];
	$asl = $myrow14['aspl'];
	} // while
} // if

?>

	<div class="col">
	<div class="px-5">
					<div class=" text-left">
						<h5  class=''><span class = 'fw-semibold'>Vacation Leave Remaining:</span> <span class="text-danger"><?php if ($vl <= 0) { ?> <?php echo 'No Credits'; ?> <?php } else { ?><?php echo $vl; ?><?php } ?></span> </h5>

						<h5  class=''><span class = 'fw-semibold'>Sick Leave Remaining:</span>  <span class="text-danger"><?php if ($sl <= 0) { ?> <?php echo 'No Credits'; ?> <?php } else { ?><?php echo $sl; ?><?php } ?></span></h5>


						<?php if($contact_gender=='Male') { ?>
						<h5  class=''><span class = 'fw-semibold'>Paternity Leave Remaining:</span> <span class="text-danger"><?php if ($pl <= 0) { ?> <?php echo 'No Credits'; ?> <?php } else { ?><?php echo $pl; ?><?php } ?></span> </h5> <?php }?>


						<?php if($contact_gender=='Female') { ?>
							<h5  class=''><span class = 'fw-semibold'>Maternity (N) Leave Remaining:</span> <span class="text-danger"><?php if ($mn <= 0) { ?> <?php echo 'No Credits'; ?> <?php } else { ?><?php echo $mn; ?><?php } ?></span> </h5> 
							
							<h5  class=''><span class = 'fw-semibold'>Maternity (C) Leave Remaining:</span> <span class="text-danger"><?php if ($mc <= 0) { ?> <?php echo 'No Credits'; ?> <?php } else { ?><?php echo $mc; ?><?php } ?></span> </h5> 
							
							<?php }?>
					</div>
				
				</div>
	</div>
</div>


<script>
				

				var slbalfin = <?php echo $sl; ?>;
		var vlbalfin = <?php echo $vl; ?>;
		var patbalfin = <?php echo $pl; ?>;

		var matnbalfin = <?php echo $mn; ?>;

		var matcbalfin = <?php echo $mc; ?>;
		
					
					</script>
 

 <div class = 'border p-5 mx-5'>
<div class = 'mt-4'>
<h5 class="fw-medium mx-5"><span class="text-secondary">Leave Type</span></h5>
<div class = 'mx-5'>
	<select id = 'selectctg' class="form-control" name="idleavectg">
	<option value="" selected disabled>Leave Type</option>

			<?php

		$res16query="SELECT idhrtaleavectg, code, name FROM tblhrtaleavectg";
		$result16=""; $found16=0; $ctr16=0;
		$result16=$dbh->query($res16query);
				if($result16->num_rows>0) {
					while($myrow16=$result16->fetch_assoc()) {
				$found16=1;
				$idhrtaleavectg16 = $myrow16['idhrtaleavectg'];
				$code16 = $myrow16['code'];
				$name16 = $myrow16['name'];
				if($contact_gender=='Male') {
					if($code16=='paternity') { 
					echo "<option value= '$idhrtaleavectg16'> $name16 </option>";
					}
		
				} else if($contact_gender=='Female') {
					if($code16=='maternityn' || $code16=='maternityc') { 
						echo "<option value='$idhrtaleavectg16'> $name16 </option>";
					 }
				}
				if($code16!='paternity' && $code16!='maternityn' && $code16!='maternityc' && $code16!='rsl'&& $code16!='ob'&& $code16!='sd'&& $code16!='special' && $code16!='aspl' ) { 
					echo "<option value= '$idhrtaleavectg16'> $name16 </option> ";
				}
			}

			
		}
		?>
	 
		</select>
		<p class = 'mx-2 my-3 text-warning' id = 'changeText'></p>

	</div>
		</div>

	
	
		<div class = 'mt-5'>


		<h5 class="fw-medium mx-5"><span class="text-secondary">Leave date</span></h5>

		<div class="row mx-5">
			
			<div class="col mx-2">
				<div class="row">
					<div class="col-2 text-end"><h5>Start</h5></div>
					<div class="col"><input name="startdate" required class = 'form-control' id = "startdate" type = "date" onchange="countWeekdays()"></input> </div>
				</div>
			
			</div>

			<div class="col mx-2">
				<div class="row">
				<div class="col-2 text-end"><h5>End</h5></div>
				<div class="col">
				<input name="enddate" required class = 'form-control' id = "enddate" type = "date" onchange="countWeekdays()"></input>
				</div>
				</div>
			</div>
		</div>

		<p class = 'text-warning my-2 ms-5 ' id="dateText"></p>
	</div>


	<div class="mt-5">
		<h5 class="fw-medium mx-5"><span class="text-secondary">Leave Duration</span></h5>
<div class="mx-5">
		<input name="leavedur" width = '50%' id = "leavedur" class='form-control' placeholder = '0.00'></input>
		</div>
		</div>

<?php
		include '../m/qryhrtapaygrpemplst.php';

?>

<?php
	// echo "<p>eid0:$employeeid0,dept0:$empdepartment0,f11:$found11$,idpaygrpemplst=$idhrtapaygrpemplst11,idpaygrp:$idtblhrtapaygrp11,idpayshift:$idhrtapayshiftctg11,actv:$activesw11<br>f12:$found12,durfrhh:$shiftouthh,durfrmm:$shiftoutmm</p>";
?>

<div class="mt-5">
		<h5 class="fw-medium mx-5"><span class="text-secondary">Remarks <i>(optional)</i></span></h5>
		
		<div class="mx-5">
		<textarea rows="3" cols="40" name="details" placeholder="Remarks here..." class='form-control'></textarea>
		</div>
		</div>


	
	

	<div class = 'mt-5'>
	<h5 class="fw-medium mx-5"><span class="text-secondary">Request To</span></h5>
	<div class="mx-5">

	<select class = 'bg-white border form-control rounded-3 px-3 py-2 maintext' name="approver">
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
	// $deptcd16=$empdepartment0;
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
	// } // if
?>
</select>
</div>
</div>


</div>


	<div class = 'my-4 text-end'>
	<a class="maintext rounded-3 mx-3 px-3 py-2 border-0" href='<?php echo "index.php?lst=1&lid=$loginid&sess=$session&p=36";?>'>Cancel</a>
	<button id="myButton" type="submit" class="secondarybgc text-white mx-3 rounded-3 px-3 py-2 border-0" value="submit">Submit request</button>
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





	document.getElementById('selectctg').addEventListener('change', function() {
    const selectedValue = this.value;
    const button = document.getElementById('myButton');

    // Remove existing classes


    // Add new class based on selection
    if (selectedValue === '1' && slbalfin <= 0) { //sick leave
        button.disabled = true;
    } else if (selectedValue === '2' && vlbalfin <= 0) { //vacation leave
        button.disabled = true;
    }else if (selectedValue === '3' && patbalfin <= 0) { //vacation leave
        button.disabled = true;
    } else if (selectedValue === '4' && matnbalfin <= 0) { //vacation leave
        button.disabled = true;
    } else if (selectedValue === '5' && matcbalfin <= 0) { //vacation leave
        button.disabled = true;
    } else {
		button.disabled = false;
	}


		});





        
		const dropdown = document.getElementById("selectctg");

function countWeekdays() {
	const startDate = new Date(document.getElementById('startdate').value);
	const endDate = new Date(document.getElementById('enddate').value);
	let count = 0;
	let dayValue;
	let fixt;
	const selectedValue = dropdown.value;
	const button = document.getElementById('myButton');
	const p = document.getElementById('dateText');
	

	if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
		button.disabled = true;
		p.textContent = 'End date Earlier than start...'

	} else {
		button.disabled = false;
		p.textContent = ''


	}


	if (selectedValue == 17 || selectedValue == 18 ) {
		dayValue = 0.5; // Half day
		fixt = 2;
	} else {
		dayValue = 1; // Full day
		fixt = 1
	}

	// Ensure startDate is before endDate
	if (startDate > endDate || isNaN(startDate) || isNaN(endDate)) {
		document.getElementById('leavedur').value = '';
		return;
	}

	// Loop through the dates
	for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
		const day = d.getDay();
		// Count only Monday to Friday (1-5)
		if (day !== 0 && day !== 6) {
			count+= dayValue;
		}
	}

	// Display the count in the input field
	document.getElementById('leavedur').value = count.toFixed(1);
}




</script>

