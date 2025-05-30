<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff0 = (isset($_GET['idct'])) ? $_GET['idct'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff =  (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($idcutoff0 != "") { $idcutoff=$idcutoff0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
} // if
// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

if ($found == 1) {
?>
<script type="text/javascript" language="JavaScript">
function toggle(source) {
  checkboxesnf = document.getElementsByName('nofindings[]');
  for(var i=0, n=checkboxesnf.length; i<n; i++) {
    checkboxesnf[i].checked = source.checked;
  } // for
} // function
</script>
<?php
     include ("header.php");
     include ("sidebar.php");
	 ?>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
	 <?php
// edit body-header
    //  echo "<p><font size=1>Modules >> Time and Attendance >> Leave entry</font></p>";

   

// start contents here...
?>
<div class=" mb-4">

<?php include 'timeattmenu.php'; ?>
</div>
<?php
  if($accesslevel >= 3) {

		echo "<form action=\"hrtimeattcutleave.php?loginid=$loginid\" method=\"post\" name=\"hrtimeattcutleave\">";
?>


<?php
		echo "<div class = 'shadow p-3'>";

session_start();
	if (isset($_SESSION['success_message'])) {
	?>
		
			<div id="alertDiv" class="alert alert-success" role="alert">
		<?php echo $_SESSION['success_message']; ?>
		</div>
		
	<?php
		unset($_SESSION['success_message']);
	}
	?>
		<script>
   $(document).ready(function(){
            setTimeout(function(){
                $("#alertDiv").fadeOut("slow", function(){
                    $(this).remove();
                });
            }, 3000); 
        });
		</script>


<?php

if (isset($_SESSION['warning_message'])) {
	?>
		
			<div id="alertDivs" class="alert alert-danger" role="alert">
		<?php echo $_SESSION['warning_message']; ?>
		</div>
		
	<?php
		unset($_SESSION['warning_message']);
	}
	?>
		<script>
   $(document).ready(function(){
            setTimeout(function(){
                $("#alertDivs").fadeOut("slow", function(){
                    $(this).remove();
                });
            }, 3000); 
        });
		</script>
	
			<div class = 'px-5 py-2'>
				<h5 class = 'mb-0 pb-0 fw-bold'>Leave Entries</h5>
				<p class = 'text-secondary'>Manage leave entries of personnel per paygroup</p>
			</div>
		<?php
		// pay group name dropdown
		echo"<div class = 'row  p-4'>";
    echo "<div class='col px-5'> <p class = 'px-2 text-secondary'>Paygroup: </p> <select class='form-control' id = 'choices-select2' name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		if($idpaygroup == "") {
		echo "<option value=''>Select Paygroup</option>";
		}
		$res11query = "SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
			$paygroupname11 = $myrow11['paygroupname'];
			if($idtblhrtapaygrp11 == $idpaygroup) { $idpaygrpsel="selected"; } else { $idpaygrpsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idpaygrpsel>$paygroupname11</option>";
			}
		}
		echo "</select></div>";



		// individual personnel dropdown && $idcutoff != "" tblhrtaemptimelog.idcutoff=$idcutoff
		if($idpaygroup != ""  ) {
		echo "<div class='col px-5'> <p class = 'px-2 text-secondary'>Personnel: </p> ";
		echo "<select class='form-control' id = 'choices-select' name=\"empid\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select personnel</option>";
		// $res12query="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog LEFT JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid WHERE tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\" ORDER BY tblhrtaemptimelog.employeeid ASC";
		$res12query="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog LEFT JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid WHERE tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
		$result12=""; $found12=0;
		$result12 = $dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12 = $result12->fetch_assoc()) {
			$found12 = 1;
			$employeeid12 = $myrow12['employeeid'];
			$name_last12 = $myrow12['name_last'];
			$name_first12 = $myrow12['name_first'];
			$name_middle12 = $myrow12['name_middle'];
			if($employeeid12 == $employeeid) { $empidsel="selected"; } else { $empidsel=""; }
			echo "<option value=\"$employeeid12\" $empidsel>$employeeid12 - $name_last12, $name_first12 $name_middle12[0]</option>";
			}
		}
		echo "</select>";
		echo "</div></div>";
		
		} // if($idpaygroup != "" && $idcutoff != "")

		// submit button
	// 	echo "<td class='align-middle'>";
	// 	echo "<button type=\"submit\" class=\"btn btn-success poppins\">Submit</button>";
    // echo "</td>";

		echo "</form>";
// FILTER AND TITLE LEVEL ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  } // endif accesslevel >= 4


	// display add button and leave entries tblhrtaemptimelog.idcutoff=$idcutoff AND
	if($employeeid!='') {

		// displaay employee name and date hired
		$res14query="SELECT * FROM tblhrtaemptimelog LEFT JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid LEFT JOIN tblemployee ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblhrtaempleavesumm ON tblhrtaemptimelog.idpaygroup=tblhrtaempleavesumm.idhrtaempleavesumm LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.idpaygroup=tblhrtapaygrpemplst.idtblhrtapaygrp WHERE tblcontact.contact_type=\"personnel\" AND tblcontact.employeeid=\"$employeeid\" LIMIT 1";
		$result14=""; $found14=0; $ctr14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$name_last14 = $myrow14['name_last'];
			$name_first14 = $myrow14['name_first'];
			$name_middle14 = $myrow14['name_middle'];
			$contact_gender14 = $myrow14['contact_gender'];
			$date_hired14 = $myrow14['date_hired'];
			$restday14 = $myrow14['restday'];
			$vl = $myrow14['vacation'];
			$sl = $myrow14['sick'];
			$pl = $myrow14['paternity'];
			$mc = $myrow14['maternityc'];
			$mn = $myrow14['maternityn'];
			$spl = $myrow14['special'];
			$asl = $myrow14['aspl'];
			} // while
		} // if


// 	?>



		
	
		<div class="row border p-4 mx-5 mb-3 ">
			<div class="col">
			<div class="px-5">

			<div class="text-left">
				<h5 class=""><span class="fw-semibold">Personnel:</span> <?php echo "$name_last14, $name_first14 $name_middle14[0].($employeeid)"; ?></h5>
				
				<h5><span class="fw-semibold">Anniversary Date:</span>
				<?php echo  date("M d, Y (D)", strtotime($date_hired14)); ?></h5>
				</div>
				</div>
			</div>


			<div class="col">
			<div class="px-5">
					<div class=" text-left">
						<h5  class=''><span class = 'fw-semibold'>Vacation Leave Remaining:</span> <span class="text-danger"><?php if ($vl <= 0) { ?> <?php echo 'No Credits'; ?> <?php } else { ?><?php echo $vl; ?><?php } ?></span> </h5>

						<h5  class=''><span class = 'fw-semibold'>Sick Leave Remaining:</span>  <span class="text-danger"><?php if ($sl <= 0) { ?> <?php echo 'No Credits'; ?> <?php } else { ?><?php echo $sl; ?><?php } ?></span></h5>


						<?php if($contact_gender14=='Male') { ?>
						<h5  class=''><span class = 'fw-semibold'>Paternity Leave Remaining:</span> <span class="text-danger"><?php if ($pl <= 0) { ?> <?php echo 'No Credits'; ?> <?php } else { ?><?php echo $pl; ?><?php } ?></span> </h5> <?php }?>


						<?php if($contact_gender14=='Female') { ?>
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
		
			</div>
	<?php
		// display add leave form if no payroll processed
		// $res15query="SELECT idemppaycutoff FROM tblemppaycutoff WHERE idhrtapaygrp=$idpaygroup";
		// $result15=""; $found15=0; $ctr15=0;
		// $result15=$dbh2->query($res15query);
		// if($result15->num_rows>0) {
		// 	while($myrow15=$result15->fetch_assoc()) {
		// 	$found15=1;
		// 	$idemppaycutoff15=$myrow15['idemppaycutoff'];
		// 	} // while
		// } // if

		// echo "$res15quer";
		// echo "<tr class='align-middle'><td class='align-middle'>";
		// if($found15!=1 && $idemppaycutoff15=='') {
		echo "<form action=\"hrtimeattcutleaveadd.php?loginid=$loginid&leave=leavedate\" method=\"POST\" name=\"hrtimeattcutleaveadd\">";
		echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
		// echo "<input type=\"hidden\" name=\"idcutoff\" value=\"$idcutoff\">";
		echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";

		include './hrtimeattqryrestday.php';
		// query again custart to cutend based on idcutoff
		// include './hrtimeattqrycutoff.php';
	?>

		<div class="shadow 	border p-4">
		<p  class='text-center   fs-2 fw-semibold'><span class="">New Leave Form</span></p>

		



		


		<?php
		// while(strtotime($cutstart18) <= strtotime($cutend18)) {
		// 	$cutstartfin=$cutstart18;
		// 	include './hrtimeattqryholiday.php';
		// 	$dateday=date("D", strtotime($cutstartfin));
		// 	// display cutoff dates w/o rest day
		// 	if($found21==1) {
		// 	} else if($dateday==$restdaysunfin || $dateday==$restdaymonfin || $dateday==$restdaytuefin || $dateday==$restdaywedfin || $dateday==$restdaythufin || $dateday==$restdayfrifin || $dateday==$restdaysatfin) {
		// 	} else {
		// 		?>
			<!-- <option value="<?php // echo $cutstart18; ?>"><?php ///echo date("Y-M-d D", strtotime($cutstart18)); ?></option> -->
		
	<?php
		// 	}
		// 	// increment date
		// 	$cutstart18 = date("Y-m-d", strtotime("+1 day", strtotime($cutstart18)));
		// } // while
	
?>
	
	
		<!-- leave type -->
		 <div class = 'mt-5'>
		<h5 class="fw-medium mx-5"><span class="text-secondary">Leave Type</span></h5>
		<div class = 'mx-5'>
		<select id = 'selectctg' name="idleavectg"  class='form-control' required>
			<option value="" selected disabled>Leave Type</option>

			<?php

		$res16query="SELECT idhrtaleavectg, code, name FROM tblhrtaleavectg";
		$result16=""; $found16=0; $ctr16=0;
		$result16=$dbh2->query($res16query);
				if($result16->num_rows>0) {
					while($myrow16=$result16->fetch_assoc()) {
				$found16=1;
				$idhrtaleavectg16 = $myrow16['idhrtaleavectg'];
				$code16 = $myrow16['code'];
				$name16 = $myrow16['name'];
				if($contact_gender14=='Male') {
					if($code16=='paternity') { 
					echo "<option value= '$idhrtaleavectg16'> $name16 </option>";
					}
		
				} else if($contact_gender14=='Female') {
					if($code16=='maternityn' || $code16=='maternityc') { 
						echo "<option value='$idhrtaleavectg16'> $name16 </option>";
					 }
				}
				if($code16!='paternity' && $code16!='maternityn' && $code16!='maternityc' ) { 
					echo "<option value= '$idhrtaleavectg16'> $name16 </option> ";
				}
			}

			
		}
		?>
	
		</select>

		<p>Selected Leave Type: <span id="displayText">None</span></p>

<script>
	document.getElementById("selectctg").addEventListener("change", function() {
		var selectedText = this.value;
		document.getElementById("displayText").textContent = selectedText;
	});
</script>


		<p class = 'mx-2 my-3 text-warning' id = 'changeText'></p>
		</div>
		</div>


		<div class = 'mt-5'>
		<h5 class="fw-medium mx-5"><span class="text-secondary">Leave date</span></h5>
		
		<div class="row mx-5">
			
			<div class="col mx-2">
				<div class="row">
					<div class="col-2 text-end"><h5>Start</h5></div>
					<div class="col"><input name="leavedate" required class = 'form-control' id = "leavedate" type = "date" onchange="countWeekdays()"></input> </div>
				</div>
			
			</div>

			<div class="col mx-2">
				<div class="row">
				<div class="col-2 text-end"><h5>End</h5></div>
				<div class="col">
				<input name="endleave" required class = 'form-control' id = "endleave" type = "date" onchange="countWeekdays()"></input>
				</div>
				</div>
			</div>
		</div>

		<p class = 'text-warning my-2 ms-5 ' id="dateText"></p>

		</div>
	
		<!-- leave duration -->
		 <div class="mt-5">
		<h5 class="fw-medium mx-5"><span class="text-secondary">Leave Duration</span></h5>
<div class="mx-5">
		<input name="leavedur" width = '50%' id = "leavedur" class='form-control' placeholder = '0.00'></input>
		</div>
		</div>



		<div class="mt-3">
		<div class="form-check mx-5 text-center">
  <input class="form-check-input border border-primary" type="checkbox" value ='1' name = "noform" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Check if no form has been submitted
  </label>
</div>
</div>

		<!-- reason/remarks (optional) -->
		 <div class="mt-5">
		<h5 class="fw-medium mx-5"><span class="text-secondary">Remarks <i>(optional)</i></span></h5>
		
		<div class="mx-5">
		<textarea rows="3" cols="40" name="reason" placeholder="Remarks here..." class='form-control'></textarea>
		</div>
		</div>


	
		<!-- display note/s -->
		<h6 class = 'flickerleave text-danger text-center px-5 '><i>Note:</i> Please make sure leave is approved before clicking Add leave button, <b><u>Holidays not included in counting.</u></b></span></h6>



		
		<!-- add leave button -->
		 <div class="text-end mt-5 mx-5">
	<button type="submit" id = 'myButton' class="btn bg-success text-white ">Add leave</button>
	</div>
	
	</form>
	<?php
	
		echo "";
		// } // if
		

		//
		// list leave entries
		echo "<td>";
	?>
</div>

	<div class = 'px-5 py-4 mt-5 shadow'>

	<div class = 'mb-5'>
		<h4 class = ''>Approved Leaves</h4>
	</div>
	<div class="table-responsive">
		<table class='table table-hover  table-bordered p-5' width = '100%' id = 'LEAVETBL'>

		<thead>
		<tr class="">
			<th class=" fw-medium">Leave Date</th>
			<th class=" fw-medium">Leave Type</th>
			<th class=" fw-medium">Duration</th>
			<th class=" fw-medium">Reason</th>
			<th class=" fw-medium" >Action</th>
		

		</tr>
		</thead>
		<tbody>
	<?php
	
		// $employeeid = isset($_POST['empid']) ? $_POST['empid'] : '';
		$res17query = "SELECT *
                	   FROM tblhrtalvreq
                	   INNER JOIN tblhrtaleavectg ON tblhrtalvreq.idhrtaleavectg = tblhrtaleavectg.idhrtaleavectg WHERE statusta = 1 AND employeeid = $employeeid ORDER BY tblhrtalvreq.datecreated DESC";
		$result17 = "";
		$found17 = 0;
		$ctr17 = 0;
		// echo "$res17query";
		$result17 = $dbh2->query($res17query);
		if ($result17->num_rows > 0) {
			while ($myrow17 = $result17->fetch_assoc()) {
				$found17 = 1;
				$idhrtaempleavechglog17 = $myrow17['idhrtaempleavechglog'];
				$idhrtaleavectg = $myrow17['idhrtaleavectg'];
				$idhrtalvreq = $myrow17['idhrtalvreq'];
				$daysappr = $myrow17['daysapproved'];
				

				$identifier = $myrow17['identifier'];

				$froms = date("Y-m-d", strtotime($myrow17['durationfrom']));
				$tos = date("Y-m-d", strtotime($myrow17['durationto']));
				


				$from = $myrow17['durationfrom'];
				$to = $myrow17['durationto'];
				$difference_seconds = abs($durationto - $durationfrom);
				$days = floor($difference_seconds / (60 * 60 * 24));
        		$hours = floor(($difference_seconds - ($days * 60 * 60 * 24)) / (60 * 60));

				// $leavedate = $myrow17['datecreated'];
				$reason = $myrow17['reason'];
				$logid = $myrow17['employeeid'];
				$approve = $myrow17['approvectr'];
				$leavetype = $myrow17['name'];


				$durationfrom = strtotime($myrow17['durationfrom']);
$durationto = strtotime($myrow17['durationto']);

// Initialize the total_days variable
$total_days = 0;

// Loop through each day between the start and end dates
for ($currentDate = $durationfrom; $currentDate <= $durationto; $currentDate += 86400) { // 86400 seconds in a day
    // Get the day of the week (0 = Sunday, 6 = Saturday)
    $dayOfWeek = date('w', $currentDate);

    // Check if it's not a weekend (0 = Sunday, 6 = Saturday)
    if ($dayOfWeek != 0 && $dayOfWeek != 6) {
        $total_days++;
    }
}

// $total_days now contains the number of weekdays between the two dates

	?>
        <tr>
	
            <td class=" "><?php echo "$froms - $tos";//echo date("M d, Y (D)", strtotime($to)); ?> </td>
            <td class=" "><?php echo $leavetype; echo $lname; ?></td>
			<td class=" ">
				<?php 
				echo "$daysappr Days";

				
				?>
			</td>
            <td class=' '><?php echo $reason; ?></td>
            <td class=''>
				
					<a href="hrtimeattcutleaveedt.php?loginid=<?php echo $loginid; ?>&employeeid=<?php echo $employeeid?>&idpaygroup=<?php echo  $idpaygroup;?>&idhrtalvreq=<?php echo urlencode($idhrtalvreq); ?>&idhrtaleavectg=<?php echo urlencode($idhrtaleavectg); ?>&leavetype=<?php echo urlencode($leavetype); ?>&leaveduration=<?php echo urlencode($days); ?>&leavedurationh=<?php echo urlencode($hours); ?>&reason=<?php echo urlencode($reason); ?>&durationfrom=<?php echo urlencode($from); ?>&durationto=<?php echo urlencode($to); ?>" class="btn text-white bg-success ">
						Edit
					</a> 
					
					<!-- </td>
					<td> -->
					<a onclick="return confirm('Are you sure you want to delete this item?');" href="hrtimeattcutleavedlt.php?loginid=<?php echo $loginid; ?>&idhrtalvreq=<?php echo $idhrtalvreq; ?>&employeeid=<?php echo $employeeid?>&idhrtaleavectg=<?php echo $idhrtaleavectg; ?>&lname=<?php echo $leavetype; ?>&idpaygroup=<?php echo  $idpaygroup;?>&froms=<?php echo $froms?>&tos=<?php echo $tos ?>" class="btn  text-white bg-danger">
						Retract
					</a>
				
					</td>
  
        </tr>
		</tbody>
	<?php	  
			} // while
		} // if
		// echo "<tr><td colspan=5>list leave entries here<br>$res17query</td></tr>";
		echo "</table>";
	
		
		echo "</div>";
	} // if($employeeid!='')

// end contents here...

     echo "</table></div>";

// edit body-footer
?>
<!-- <div class="d-flex justify-content-end pt-5">
	<a href="<?php echo 'hrtimeatt.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div> -->
<?php
     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>

<script>
	document.getElementById('selectctg').addEventListener('change', function() {
    const selectedValue = this.value;
    const button = document.getElementById('myButton');

	
	const p = document.getElementById('changeText');

    // Remove existing classes


    // Add new class based on selection
    if ((selectedValue === '1' || selectedValue === '18' )&&  slbalfin <= 0) { //sick leave
        button.disabled = true;
		p.textContent = 'Not enough leave credits';


    } else if ((selectedValue === '2' || selectedValue === '17') && vlbalfin <= 0) { //vacation leave
        button.disabled = true;
		p.textContent = 'Not enough leave credits';

    }else if (selectedValue === '3' && patbalfin <= 0) { //vacation leave
        button.disabled = true;
		p.textContent = 'Not enough leave credits';

    } else if (selectedValue === '4' && matnbalfin <= 0) { //vacation leave
        button.disabled = true;
		p.textContent = 'Not enough leave credits';

    } else if (selectedValue === '5' && matcbalfin <= 0) { //vacation leave
        button.disabled = true;
		p.textContent = 'Not enough leave credits';



    } else {
		button.disabled = false;
		p.textContent = '';

	}


		});









		const dropdown = document.getElementById("selectctg");

        function countWeekdays() {
            const startDate = new Date(document.getElementById('leavedate').value);
            const endDate = new Date(document.getElementById('endleave').value);
			const selectedValue = parseInt(document.getElementById('selectctg').value);
			let count = 0;
			let dayValue;
			let fixt;
			const button = document.getElementById('myButton');
			const p = document.getElementById('dateText');
			

			if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
				button.disabled = true;
				p.textContent = 'End date Earlier than start...'

			} else {
				button.disabled = false;
				p.textContent = ''


			}


			if (selectedValue == 17 || selectedValue == 18  || selectedValue ==  19 ) {
				dayValue = 0.5; // Half day
				fixt = 2;
			} else {
				dayValue = 1; // Full day
				fixt = 1
			}

            // Ensure startDate is before endDate
            if (isNaN(startDate) || isNaN(endDate) || startDate > endDate) {
                document.getElementById('leavedur').value = '';
                return;
            }

            // Loop through the dates
            for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                const day = d.getDay();
                // Count only Monday to Friday (1-5)

				if (selectedValue == 13 || selectedValue == 19){
					count+= dayValue;
				} else {
					if (day !== 0 && day !== 6) {
                    count+= dayValue;
                }

				}
              
            }

            // Display the count in the input field
            document.getElementById('leavedur').value = count.toFixed(1);
        }


	
    </script>



<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('choices-select');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
		shouldSort: false,
      });
    });


	document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('choices-select2');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
		shouldSort: false,
      });
    });




  </script>