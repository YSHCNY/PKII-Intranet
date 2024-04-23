<?php
//
// mhrpersreqadd.php
// fr: vc/mhrpersreq.php
// indexlinks: $page==351

require '../includes/config.inc';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

?>


<style>
		.regular-font {
    font-weight: normal !important;
}
	</style>



	<div class="">
	
	

	<div class=" container my-5 pt-5">
		<div class="border rounded-4 shadow p-5">
		<div class = 'mt-4 mb-2 text-center'>
		<p class = 'fs-3 maintext mb-0 fw-bold'>HR Personnel Requisition Form</p>
		<p class="fs-4 submaintext ">Personnel Requisition Form (HRD-F-01)</p>
		</div>
<?php
	// display add new request form
	echo "<form action=\"mhrpersreqadd2.php?lst=1&lid=$loginid&sess=$session&p=35\" method=\"POST\" name=\"mhrpersreqadd2\">";
?>
	<div class = 'mt-3'>
			<p class="text-muted mb-0 fs-5">Request date</p>
			<?php
				echo "<p class ='maintext fs-4'>".date("D Y-M-d", strtotime($datenow))."</p>";
				echo "<input type=\"hidden\" size=\"5\" name=\"requestdate\" value=\"$now\" readonly>";
			?>
	</div>


	<div class = 'mt-4'>
		
			<!-- <input type="radio" class ='form-check-input' name="emptyp" value="Probationary" checked> Probitionary
			<input type="radio" class ='maintext fs-4 form-check-input' name="emptyp" value="Contractual"> Contractual
			<input type="radio" class ='maintext fs-4 form-check-input' name="emptyp" value="Consultant"> Consultant
			<input type="radio" class ='maintext fs-4 form-check-input' name="emptyp" value="Others"> Others (pls. specify) -->
			<p class="text-muted mb-0 fs-5">Employee type</p>
			
				<div class="form-check">
				<input type="radio" class="form-check-input" name="emptyp" id="probationary" value="Probationary" checked>
				<label class="form-check-label regular-font" for="probationary">Probationary</label>
				</div>
				<div class="form-check">
				<input type="radio" class="form-check-input" name="emptyp" id="contractual" value="Contractual">
				<label class="form-check-label regular-font" for="contractual">Contractual</label>
				</div>
				<div class="form-check">
				<input type="radio" class="form-check-input" name="emptyp" id="consultant" value="Consultant">
				<label class="form-check-label regular-font" for="consultant">Consultant</label>
				</div>
				<div class="form-check">
				<input type="radio" class="form-check-input" name="emptyp" id="others" value="Others">
				<label class="form-check-label regular-font" for="others">Others (pls. specify)</label>
				<input name="emptypothr" class = 'border p-1 rounded-3' placeholder = 'type here'>
				
				</div>

		
			
	</div>

<div class = 'py-4 px-5 border rounded-3 my-3'>
	<div class ='my-4 '>
	<p class="fw-bold maintext fs-4">Position information</p>
	</div>

	<div class="row">
    <div class="col-lg-4">
        <div class=''>
            <p class="text-muted mb-0 fs-5">Position title</p>
            <select class='bg-white border form-select fs-5 rounded-3 py-2 px-3' name="positioncd">
                <?php
                include("../m/qryhrpositionctg.php");
                $param11 = count($idhrpositionctg11Arr);
                for ($x11 = 0; $x11 < $param11; $x11++) {
                    echo "<option value=\"" . $idhrpositionctg11Arr[$x11] . "\">" . $name11Arr[$x11] . "</option>";
                } // for($x11=0; $x11<$param11; $x11++)
                ?>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="">
            <p class="text-muted mb-0 fs-5">Department</p>
            <select class='bg-white border form-select fs-5 rounded-3 py-2 px-3 ' name="deptcd">
                <?php
                include("../m/qryhrdeptcd.php");
                $param12 = count($code12Arr);
                for ($x12 = 0; $x12 < $param12; $x12++) {
                    echo "<option value=\"" . $code12Arr[$x12] . "\">" . $name12Arr[$x12] . "</option>";
                } // for
                ?>
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div>
            <p class="text-muted mb-0 fs-5">Reports to</p>
            <select class='bg-white border form-select fs-5 rounded-3 py-2 px-3 ' name="reportstoposcd">
                <?php
                $param11b = count($idhrpositionctg11Arr);
                for ($x11b = 0; $x11b < $param11b; $x11b++) {
                    echo "<option value=\"" . $idhrpositionctg11Arr[$x11b] . "\">" . $name11Arr[$x11b] . "</option>";
                } // for
                ?>
            </select>
        </div>
    </div>
</div>


				<div class="mt-4">
					<p class="text-muted mb-0 fs-5">Position details</p>
					<div class="form-check mb-2">
						<input class="form-check-input" type="radio" name="posfilltyp" value="newposition" id="newPositionRadio" checked>
						<label class="form-check-label regular-font" for="newPositionRadio">New position</label><br>
					</div>
					<div class="form-check mb-2">
						<input class="form-check-input" type="radio" name="posfilltyp" value="replacement" id="replacementRadio">
						<label class="form-check-label regular-font" for="replacementRadio">Replacement for</label>
						<select class="form-select w-50 fs-5 rounded-3 py-2 px-3" name="posfillempid">
						<option value=''>Select personnel</option>
						<?php
						include("../m/qryhremployee.php");
						$param14 = count($employeeid14Arr);
						for ($x14 = 0; $x14 < $param14; $x14++) {
							echo "<option value=\"" . $employeeid14Arr[$x14] . "\">" . $name_last14Arr[$x14] . ", " . $name_first14Arr[$x14] . " " . substr($name_middle14Arr[$x14], 0, 1) . ".";
							// if($empposition14Arr[$x14]!='') { echo " - ".$empposition14Arr[$x14].""; }
							if ($empdepartment14Arr[$x14] != '') {
								echo " - " . $empdepartment14Arr[$x14] . "";
							}
							echo "</option>";
						} // for
						?>
					</select>
					</div>
					

					<div class="form-check mb-2">
					<input class="form-check-input" type="radio" name="posfilltyp" value="others" id="othersRadio">
					<label class="form-check-label regular-font" for="othersRadio">Others (please specify)</label>
					<input class="border p-1 rounded-3" type="text" name="posfillothr">
					</div>
			</div>		
			
					<div class="mt-4">
					<p class="text-muted mb-0 fs-5">No. of staff needed</p>
					<input class="border rounded-3 px-3 py-2" type="number" min="1" max="50" name="staffneeded" value="1">
					</div>	


</div> <!-- end of postition details  ========================================================-->




<div class = 'py-4 px-5 border rounded-3 my-3'>
	<div class="my-4">
	<p class="fw-bold maintext fs-4">Job description (overview)</p>
	</div>

	<div class="mt-4">
	<p class="text-muted mb-0 fs-5">Main responsibilities</p>
	<textarea class = 'form-control ' placeholder='Type here..' name="jobdescresp"></textarea>
	</div>

	<div class="mt-4">
	<p class="text-muted mb-0 fs-5">Specific duties</p>
	<textarea  class = 'form-control ' placeholder='Type here..' name="jobdescduties"></textarea>
	</div>
</div>


<!-- end of job description overview ======================= -->


<div class = 'py-4 px-5 border rounded-3 my-3'>
	<div class="my-4 ">
	<p class="fw-bold maintext fs-4">Timeframe</p>
	</div>

	<div class="mt-4">
		<p class="text-muted mb-0 fs-5">Date needed</p>
		<?php
			// compute date needed + 15 days
			$dateneeded = date("Y-m-d", strtotime($datenow . '+ 15 days'));
			echo "
			<div class = 'form-check'>
			<input type=\"radio\" name=\"dateneedtyp\" value=\"asap\" checked>
			<label class='form-check-label regular-font' for='dateneedtyp'>ASAP</label>
			</div>";


			echo "
			<div class = 'form-check'>
			<input type=\"radio\" name=\"dateneedtyp\" class = 'rounded-3 border px-3 py-2' value=\"date\">
			<label class='form-check-label regular-font' for='dateneeded'>Choose Date</label>
			<input type=\"date\" name=\"dateneeded\" value=\"$dateneeded\">
			
			</div>";
		?>
		</div>

	<div class="mt-4">
	<p class="text-muted mb-0 fs-5">Remarks</p>
	<textarea class = 'form-control ' placeholder='Type here..' name="remarks"></textarea>
	</div>
	
	<div class="mt-4 text-center">
	<p class="text-muted mb-0 fs-5">Requested by</p>
<?php
	echo "<p class = 'fs-4 maintext'>$name_last0, $name_first0 $name_middle0[0]. of";
	if($empposition0!='') { echo " - $empposition0"; }
	if($empdepartment0!='') { echo " $empdepartment0"; }
	echo "</p><input type=\"hidden\" name=\"requestorempid\" value=\"$employeeid0\">";
?>
</div>


<div class="mt-4 text-center">
	<p class="text-muted mb-0 fs-5">Endorsed by</p>
	
<?php
	// query other actors
	include("../m/qryhrpersreqctg.php");
	if($found15==1 && $endorsedempid15!='') {
		$actorempid=$endorsedempid15;
		include("../m/qryhrpersreqactor.php");
		$actorempid="";
		echo "<p class = 'fs-4 maintext'>$name_last12, $name_first12 $name_middle12[0].</p>";
		echo "<input type=\"hidden\" name=\"endorseempid\" value=\"$endorsedempid15\">";
		echo "<input type=\"hidden\" name=\"actor\" value=\"REQ\">";
	} // if
?>
</div>
</div>

<div class = 'text-end'>
	<a href = '<?php echo "index.php?lst=1&lid=$loginid&sess=$session&p=35"; ?>' class = 'bg-danger rounded-3 text-white px-3 py-2 border-0'>Cancel</a>
<button type="submit" class="secondarybgc px-3 py-2 rounded-3 border-0 text-white" value="Submit for endorsement">Submit for endorsement</button>
</div>
	</form>

		</div>
		</div>
	</div> <!-- div class=row -->

