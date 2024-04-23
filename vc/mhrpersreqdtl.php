<?php
//
// mhrpersreqdtl.php
// fr: vc/mhrpersreq.php
// indexlinks: $page==352

require '../includes/config.inc';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$idhrpersreq0 = $_GET['prid']; // redirect fr: mhrpersreqadd2.php
$actor0 = $_GET['act'];
$dispsumm0 = $_GET['d'];

$idhrpersreq = (isset($_POST['idpr'])) ? $_POST['idpr'] :'';
$actor = (isset($_POST['ctgactor'])) ? $_POST['ctgactor'] :'';
$dispsumm = (isset($_POST['ds'])) ? $_POST['ds'] :'';

if($idhrpersreq0!='') { $idhrpersreq=$idhrpersreq0; }
if($actor0!='') { $actor=$actor0; }
if($dispsumm0!='') { $dispsumm=$dispsumm0; }

// var_dump($lst.$loginid.$session.$page.$idhrpersreq.$actor.$dispsumm);

//
// notes on actors
// REQ - requestor
// END - endorser (HR mngr)
// REC - recommending approver (VP)
// APP - approver (Pres)
// 

?>
	<div class="mainbgc my-5 p-5">
		<div class=""><h4 class = 'ms-5 py-5 text-white'>HR Personnel Requisition Form - Details</h4></div>
	</div>

	<div class="container">

		<div class="border rounded-4 px-5 py-3 shadow mt-3 mb-4">

	<div class = 'mt-3'>
	<p class="fw-bold maintext fs-4 text-center">Personnel Requisition Form (HRD-F-01) Details</p>
	</div>

<?php
	// query tblhrpersreq based on id
	include '../m/qryhrpersreqid.php';

?>
<div class = 'mt-4'>
	<p class="submaintext fs-6 mb-0">Request date</p>
<?php
	echo "<p class = 'maintext fs-5 '>".date("D Y-M-d", strtotime($requestdate11))."</p>";
	echo "<input type=\"hidden\" size=\"5\" name=\"requestdate\" value=\"$requestdate11\" readonly>";
?>
</div>	

<div class="mt-4">
	<p class="submaintext fs-6 mb-0">Employee type</p>
<?php
	echo "<p class = 'maintext fs-5 '>$emptyp11</p>";
	if($emptyp11=="Others") { echo " - $emptypothr11"; }
?>
	</div>


			<div class="row border rounded-3 p-4">
			<div class="col-lg-6 mt-3 ">
			<!-- start of pos information -->
						<div class = ' h-100  ' >
						<p class = 'fw-bold maintext fs-4'>Position information</p>

						<div class="mt-4">
						<p class="text-muted fs-6 mb-0">Position title</p>
					<?php echo " <p class = 'maintext fs-5 '> $position11 </p>";  ?>
					</div>

						<p class="text-muted fs-6 mb-0">Department</p>
					<?php echo " <p class = 'maintext fs-5 '> $deptcd11 </p>";  ?>
						

						<p class="text-muted fs-6 mb-0">Reports to</p>
					<?php echo " <p class = 'maintext fs-5 '> $reportstoposcd11 </p>";  ?>


					<p class="text-muted fs-6 mb-0">Position details</p>
					<?php
						if($posfilltyp11=="newposition") {
							$posdetailsfin="New Position";
						} else if($posfilltyp11=="replacement") {
							// query tblcontact
							$actorempid = $posfilltypempid11;
							include '../m/qryhrpersreqactor.php';
							$actorempid="";
							$posdetailsfin = "Replacement for $name_last12, $name_first12 $name_middle12[0]";
						} else if($possfilltyp11=="others") {
							$posdetailsfin = "Others:&nbsp;$posfilltypothr11";
						} // if
						echo "<p class = 'maintext fs-5 '>$posdetailsfin </p>";
					?>


					<p class="text-muted fs-6 mb-0">No. of staff needed</p>
					<?php echo "<p class = 'maintext fs-5 '>$staffneeded11</p>"; ?>
					</div>
			<!-- end of pos information -->
			</div>

			<div class="col-lg-6 mt-3  ">
			<!-- start of jobdesc -->
						<div class = 'h-100  ' >
						<p  class="fw-bold maintext fs-4">Job description (overview)</p>

						<div class="mt-4">
						<p class="text-muted fs-6 mb-0">Main responsibilities</p>
						<?php echo "<p class = 'maintext fs-5 '>".nl2br($jobdescresp11)."</p>"; ?>
						</div>

						<div class="mt-4">
						<p class="text-muted fs-6 mb-0">Specific duties</p>
						<?php echo "<p class = 'maintext fs-5 '>".nl2br($jobdescduties12)."</p>"; ?>
						</div>

						</div>
				<!-- end of jobdesc -->
				</div>

			</div>


<div class = 'mt-4 p-4'>
<p class="fw-bold maintext fs-4">Timeframe</p>

<div class="mt-4">
<p class="text-muted fs-6 mb-0">Date needed</p>
<?php
	if($dateneedasap11=="asap") {
		$dateneedfin="ASAP";
	} else if($dateneedasap11=="date") {
		if($dateneeded11!='' || $dateneeded11!='0000-00-00') {
		$dateneedfin="".date("Y-M-d", strtotime($dateneeded11))."";
		} // if
	} // if
	echo "<p class = 'maintext fs-5 '>$dateneedfin</p>";
?>
</div>

<div class="mt-4">
<p class="text-muted fs-6 mb-0">Remarks</p>
<?php echo "<p class = 'maintext fs-5 '>".nl2br($remarks11)."</p>"; ?>
</div>

<p class="text-muted fs-6 mb-0">Requested by</p>
<?php
	$actorempid = $requestedbyempid11;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";
	echo "<p class = 'maintext fs-5 '>$name_last14, $name_first14 $name_middle14[0]";
	if($empposition14!='') { echo "of $empposition14"; }
	if($empdepartment14!='') { echo "of $empdepartment14"; }
	echo ", ".date("Y-M-d", strtotime($requestdate11))."</p>";
	if($requestedbyempid11==$employeeid0) {
		if($endorsectr11==0 && $requestctr11>=1) {
		// display re-submit button
		echo "<form action=\"mhrpersreqrerequest.php?lst=1&lid=$loginid&sess=$session&p=352\" class = 'text-end' method=\"POST\" name=\"mhrpersreqendors2\">";
		echo "<input type=\"hidden\" name=\"idpr\" value=\"$idhrpersreq\">";
		echo "<input type=\"hidden\" name=\"actor\" value=\"REQ\">";
		echo "<input type=\"hidden\" name=\"ds\" value=\"$dispsumm\">";
		echo "<button type='submit' class='secondarybgc px-3 py-2 border-0 text-white rounded-3'>Re-submit for endorsement</button>";
		echo "</form>";
		} // if
	} // if
?>
	

<p class="text-muted fs-6 mb-0">Endorsed by</p>
<?php
	$actorempid=$endorseempid11;
	include("../m/qryhrpersreqactor.php");
	$actorempid="";
	if($actor=="END" && $endorseempid11==$employeeid0) {
		if($endorsectr11==0) {
			// display endorse button
			echo "<form action=\"mhrpersreqendorse.php?lst=1&lid=$loginid&sess=$session&p=352\" class = 'text-end' method=\"POST\" name=\"mhrpersreqendorse\">";
			echo "<input type=\"hidden\" name=\"idpr\" value=\"$idhrpersreq\">";
			echo "<input type=\"hidden\" name=\"actor\" value=\"END\">";
			echo "<input type=\"hidden\" name=\"endorseempid\" value=\"$employeeid0\">";
			echo "<input type=\"hidden\" name=\"endorsectr\" value=\"1\">";
			echo "<input type=\"hidden\" name=\"requestedbyempid\" value=\"$requestedbyempid11\">";
			echo "<input type=\"hidden\" name=\"ds\" value=\"$dispsumm\">";
			echo "<br><button type='submit' class='secondarybgc px-3 py-2 border-0 text-white rounded-3'>Endorse this request</button>";
			echo "</form>";
		} else if($endorsectr11>=1) {
			$endorsefin="<strong>$name_last12, $name_first12 $name_middle12[0]</strong>";
			if($endorsedate11!='' || $endorsedate11!='0000-00-00') {
				$endorsefin .= "&nbsp;on&nbsp;".date('Y-M-d H:i', strtotime($endorsedate11))."";
			} // if
		} // if
	} else {
		if($endorsectr11==0) {
			$endorsefin = "$name_last12, $name_first12 $name_middle12[0]. <b>(PENDING)</b> ";
		} else if($endorsectr11>=1) {
			$endorsefin="<strong>$name_last12, $name_first12 $name_middle12[0]. <b>(ENDORSEMENT APPROVED)</b></strong>";
			if($endorsedate11!='' || $endorsedate11!='0000-00-00') {
				$endorsefin .= "&nbsp;on&nbsp;".date('Y-M-d H:i', strtotime($endorsedate11))."";
			} // if
		} // if
	} // if
	echo "<p class = 'maintext fs-5 '>$endorsefin</p>";
?>
	

	<p class="text-muted fs-6 mb-0">Recommending approval</p>
<?php
	// prep ICG recoappr
	if($recoappricgempid11!='') {
	// query recoappricgempid
	$actorempid=$recoappricgempid11;
	include '../m/qryhrpersreqactor.php';
	$actorempid="";
	} // if
	if($result11==1 && $recoappricgempid11!='') {
	$recoappricgempidsw=1;
	} else { $recoappricgempidsw=0; } // if
	// prep DCG recoappr
	if($recoapprdcgempid11!='') {
	// query recoapprdcgempid
	$actorempid=$recoapprdcgempid11;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";
	} // if
	if($result11==1 && $recoapprdcgempid11!='') {
	$recoapprdcgempidsw=1;
	} else { $recoapprdcgempidsw=0; } // if
	// start display
	if($actor=="REC") {
		// ICG
		if($recoappricgctr11==0) {
			if($endorsectr11>=1) {
				if($recoappricgempid11==$employeeid0) {
				// display form button
				echo "<form action=\"mhrpersreqrecoappr.php?lst=1&lid=$loginid&sess=$session&p=352\" class = 'text-end' method=\"POST\" name=\"mhrpersreqrecoappr\">";
				echo "<input type=\"hidden\" name=\"idpr\" value=\"$idhrpersreq\">";
				echo "<input type=\"hidden\" name=\"actor\" value=\"$actor\">";
				echo "<input type=\"hidden\" name=\"recoapprempid\" value=\"$recoappricgempid11\">";
				echo "<input type=\"hidden\" name=\"ds\" value=\"$dispsummmhrpersreqrecoappr\">";
				echo "<input type=\"hidden\" name=\"recoapprtyp\" value=\"ICG\">";
				echo "<button type=\"submit\" class=\"secondarybgc px-3 py-2 border-0 text-white rounded-3\">Recommend (ICG)</button>";
				echo "</form>";
				} else {
				$recoappricgfin="<p class = 'maintext fs-5 '>$name_last12, $name_first12 $name_middle12[0]. <b>(ICG PENDING)</b><span class = 'hidden'> ($recoappricgempid11)</span></p>";
				} // if
			} else {
				$recoappricgfin="";
			} // if
		} else if($recoappricgctr11>=1) {
			$recoappricgfin="<p class = 'maintext fs-5 '>$name_last12, $name_first12 $name_middle12[0] on ".date('Y-M-d H:i', strtotime($recoappricgdate11))." <b>(ICG APPROVED)</b></p>";
		} // if
		// DCG
		if($recoapprdcgctr11==0) {
			if($endorsectr11>=1) {
				if($recoapprdcgempid11==$employeeid0) {
				// display form button
				echo "<form action=\"mhrpersreqrecoappr.php?lst=1&lid=$loginid&sess=$session&p=352\" class = 'text-end' method=\"POST\" name=\"mhrpersreqrecoappr\">";
				echo "<input type=\"hidden\" name=\"idpr\" value=\"$idhrpersreq\">";
				echo "<input type=\"hidden\" name=\"actor\" value=\"$actor\">";
				echo "<input type=\"hidden\" name=\"actorempid\" value=\"$recoapprdcgempid11\">";
				echo "<input type=\"hidden\" name=\"ds\" value=\"$dispsumm\">";
				echo "<input type=\"hidden\" name=\"recoapprtyp\" value=\"DCG\">";
				echo "<button type=\"submit\" class=\"secondarybgc px-3 py-2 border-0 text-white rounded-3\">Recommend (DCG)</button>";
				echo "</form>";
				} else {
				$recoapprdcgfin="<p class = 'maintext fs-5 '> $name_last14, $name_first14 $name_middle14[0]. <b>(DCG PENDING)</b> <span class = 'hidden'>$recoapprdcgempid11</span></p>";
				} // if
			} else {
				$recoapprdcgfin="";
			} // if
		} else if($recoapprdcgctr11>=1) {
			$recoapprdcgfin="<p class = 'maintext fs-5 '>$name_last14, $name_first14 $name_middle14[0] on ".date('Y-M-d H:i', strtotime($recoappricgdate11))." <b>(DCG APPROVED)</b></p>";
		} // if

	} else { // if($actor=="REC")
		// ICG
		if($recoappricgctr11==0) {
			if($recoappricgempid11!='') {
			$recoappricgfin="<p class = 'maintext fs-5 '>$name_last12, $name_first12 $name_middle12[0]. <b>(ICG PENDING)</b><span class = 'hidden'> ($recoappricgempid11)</span></p>";
			} else {
			$recoappricgfin="";
			} // if
		} else if($recoappricgctr11>=1) {
			$recoappricgfin="<p class = 'maintext fs-5 '>$name_last12, $name_first12 $name_middle12[0]. <b>(ICG APPROVED)</b><span class = 'hidden'> ($recoappricgempid11)</span>";
			if($recoappricgdate11!='' || $recoappricgdate11!='0000-00-00') {
			$recoappricgfin .= " on ".date('Y-M-d H:i', strtotime($recoappricgdate11))."</p>";
			} // if
		} // if
		// DCG
		if($recoapprdcgctr11==0) {
			if($recoapprdcgempid11!='') {
			$recoapprdcgfin="DCG: PENDING<br>$name_last14, $name_first14 $name_middle14[0] ($recoapprdcgempid11)";
			} else {
			$recoapprdcgfin="";
			} // if
		} else if($recoapprdcgctr11>=1) {
			$recoapprdcgfin="<strong>DCG: OK<br>$name_last14, $name_first14 $name_middle14[0]</strong>";
			if($recoapprdcgdate11!='' || $recoapprdcgdate11!='0000-00-00') {
			$recoapprdcgfin .= "&nbsp;on&nbsp;".date('Y-M-d H:i', strtotime($recoapprdcgdate11))."";
			} // if
		} // if
	} // if($actor=="REC")
	// display recommending approval
	if($recoappricgempidsw==1) {
	echo "$recoappricgfin";
	} // if
	if($recoappricgempidsw==1 && $recoapprdcgempidsw==1) {
	echo "<br>";
	} // if
	if($recoapprdcgempidsw==1) {
	echo "$recoapprdcgfin";
	} // if
?>







<div class="mt-5">
<p class="text-muted fs-6 mb-0">Approved by</p>
<?php
	if($approveempid11!='') {
		// query approver
		$actorempid=$approveempid11;
		include '../m/qryhrpersreqactor.php';
		$actorempid="";
	} // if
	if($actor=="APP") {
		if($approveempid11==$employeeid0) {
			if($approvectr11==0) {
				if(($recoappricgctr11>=1 || $recoapprdcgctr11>=1) && $endorsectr11>=1) {
				// display approve button
				echo "<form action=\"mhrpersreqapprove.php?lst=1&lid=$loginid&sess=$session&p=352\" class = 'text-end' method=\"POST\" name=\"mhrpersreqappr\">";
				echo "<input type=\"hidden\" name=\"idpr\" value=\"$idhrpersreq\">";
				echo "<input type=\"hidden\" name=\"actor\" value=\"$actor\">";
				echo "<input type=\"hidden\" name=\"actorempid\" value=\"$approveempid11\">";
				echo "<input type=\"hidden\" name=\"ds\" value=\"$dispsumm\">";
				echo "<button type=\"submit\" class=\"btn btn-success\">Approve</button>";
				echo "</form>";
				} else {
				$approvefin="";
				} // if
			} else if($approvectr11>=1) {
				$approvefin="<strong>$name_last12, $name_first12 $name_middle12[0]</strong>";
				if($approvedate11!='' || $approvedate11!='0000-00-00') {
				$approvefin .= "&nbsp;on ".date('Y-M-d H:i', strtotime($approvedate11))."";
				} // if
			} // if
		} // if($approveempid11==$employeeid0)
	} else { // if($actor=="APP")
		if($approvectr11==0) {
			if(($recoappricgctr11>=1 || $recoapprdcgctr11>=1) && $endorsectr11>=1) {
			$approvefin="PENDING, for approval by:<br>$name_last12, $name_first12 $name_middle12[0]";
			} else {
			$approvefin="";
			} // if
		} else if($approvectr11>=1) {
			$approvefin="<strong>$name_last12, $name_first12 $name_middle12[0]</strong>";
			if($approvedate11!='' || $approvedate11!='0000-00-00') {
			$approvefin .= "&nbsp;on&nbsp;".date('Y-M-d H:i', strtotime($approvedate11))."";
			} // if
		} // if
	} // if($actor=="APP")
	// display approver
	echo "<p class = 'maintext fs-5 '>$approvefin</p>";
?>

</div>
</div>





<p class="text-muted fs-6 mb-0">comments/clarifications</p>
<?php
	echo "<form action=\"mhrpersreqcomments.php?lst=1&lid=$loginid&sess=$session&p=352\" method=\"POST\" name=\"mhrpersreqcomments\">";
	echo "<input type=\"hidden\" name=\"idpr\" value=\"$idhrpersreq\">";
	echo "<input type=\"hidden\" name=\"actor\" value=\"$actor\">";
	echo "<input type=\"hidden\" name=\"ds\" value=\"$dispsumm\">";
	echo "<input type=\"hidden\" name=\"actorempid\" value=\"$employeeid0\">";

?>

<?php
	
	echo "<textarea class = 'form-control' placeholder = '$name_last0, $name_first0 $name_middle0[0]:' name=\"comments\"></textarea>";
?>
	
	<div class="text-end my-4">
	<button type="submit" class="secondarybgc px-3 py-2 border-0 text-white rounded-3">Submit comment/clarification</button>
	</div>
<?php echo "</form>"; ?>

<?php echo "
<div class = 'border rounded-3 px-3 py-2'>
<p class = 'submaintext fs-5 px-3'>Comments:</p>
<p class = ' maintext '>".nl2br($comments11)."</p></div>"; 
?>
	
	

		</div>
	
	</div> <!-- div class=row -->

<?php
	//
	// recruitment steps

?>
