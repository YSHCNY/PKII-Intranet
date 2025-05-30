<?php
//
// mitsuppreqdtl.php
// fr: vc/index.php
// indexlinks: $page==342

require '../includes/config.inc';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';
$srid = (isset($_GET['srid'])) ? $_GET['srid'] :'';

$iditsupportreq = (isset($_POST['idsr'])) ? $_POST['idsr'] :'';
$actor = (isset($_POST['ctgactor'])) ? $_POST['ctgactor'] :'';

if($srid!='') { $iditsupportreq=$srid; }

?>

	<div class="">
		<h3>IT Support Request</h3>
	</div>


	<div class="">

		<div class="">

<table class="table">
	<thead>
		<tr><th colspan="2" class="text-center">Technical Support Details</th></tr>
	</thead>
<?php include '../m/qrymitsuppreq5.php'; ?>
	<tbody>
		<tr><th class="text-right">Ticket no.</th><td class="text-left">
<?php
	if($ticketnum16==0) {
		echo "<p class='text-danger'>NO ticket number assigned</p>";
	} else {
		echo "<strong>$ticketnum16</strong>";
	} // if
?>
		</td></tr>
		<tr><th class="text-right">Request date</th><td class="text-left">
<?php
	echo "".date("Y-M-d H:i:s", strtotime($stamprequest16))."";
?>
		</td></tr>
<?php include '../m/qrymitsuppreq6.php'; ?>
		<tr><th class="text-right">Requested by</th><td class="text-left">
<?php
	echo "$name_last17, $name_first17 $name_middle17[0]";
	if($empposition17!='') { echo ",&nbsp;$empposition17"; }
	if($empdepartment17!='') { echo ", &nbsp;$empdepartment17"; }
?>
		</td></tr>
		<tr><th class="text-right">Request/s</th><td class="text-left">
<?php
	include '../m/qrymitsuppreq3.php';
	$param14 = count($idctgsuppreq14Arr);
	for($x2 = 0; $x2 < $param14; $x2++) {
		if(preg_match("/".$code14Arr[$x2]."/", "$requestctg16")) {
		echo "".$name14Arr[$x2]."<br>";
		} // if
	} // for
?>
		</td></tr>
		<tr><th class="text-right">Details</th><td class="text-left">
<?php echo "".nl2br($details16).""; ?>
		</td></tr>
		<tr><th class="text-right">Approval status</th><td class="text-left">
<?php
	if($approvectr16==0) {
		echo "Pending approval";
	} else if($approvectr16==1) {
		echo "Request Approved<br>".date("Y-M-d H:i:s", strtotime($approvestamp16))."";
	}
?>
		</td></tr>
		<tr><th class="text-right">Approver</th><td class="text-left">
<?php
	if($approvectr16==1) {
	// query tblcontact for approveempid16
	include '../m/qrymitsuppreq8a.php';
	echo "$name_last18a, $name_first18a - $empposition18a";
	} else if($approvectr16==0) {
	if($employeeid16==$employeeid0) {
	echo "<form method=\"POST\" action=\"mitsuppreq2.php?lst=1&lid=$loginid&sess=$session&p=342\" name=\"mitsuppreq2\">";
	echo "<select name=\"approver\">";
	include '../m/qrymitsuppreq8b.php';
	if($approver1empid18b!='') {
		include '../m/qrymitsuppreq8c.php';
		echo "<option value=\"$approver1empid18b\">$name_last18c, $name_first18c $name_middle18c[0]";
		if($empposition18c!='') { echo " - $empposition18c"; } // if
		if($empdepartment18c!='') { echo " - $empdepartment18c"; } // if
		echo "</option>";
	} // if
	if($approver2empid18b!='') {
		include '../m/qrymitsuppreq8d.php';
		echo "<option value=\"$approver2empid18b\">$name_last18d, $name_first18d $name_middle18d[0]";
		if($empposition18d!='') { echo " - $empposition18d"; } // if
		if($empdepartment18d!='') { echo " - $empdepartment18d"; } // if
		echo "</option>";
	} // if
	echo "</select>";
	} else if($approveempid16==$employeeid0) {
		// display approver readonly
		include '../m/qrymitsuppreq8e.php';
		echo "$name_last18e, $name_first18e";
		if($empposition18e!='') { echo " - $empposition18e"; } // if
		if($empdepartment18e!='') { echo " - $empdepartment18e"; } // if
	} // if($employeeid15==$employeeid)
	} // if($approvectr15==1)
?>
		</td></tr>
		<tr><th class="text-right">Action taken</th><td class="text-left">
<?php
	if($actionctg16!='') {
	// query tblitctgsuppreq
	include '../m/qrymitsuppreq9.php';
	if($found19==1) {
		if($actionctg16=='acc') {
		echo "<p class='text-success'><strong>$name19</strong></p>";
		} else if($actionctg16=='rqd') {
		echo "<p class='text-danger'><strong>$name19</strong></p>";
		} else {
		echo "<p class='text-warning'><strong>$name19</strong></p>";
		} // if($actionctg16=='acc')
	} // if($found19==1)
	if($actiondetails16!='') { echo "<br>".nl2br($actiondetails16).""; }
	} // if($actionctg15!='')
?>
		</td></tr>
		<tr><th class="text-right">Ticket status</th><td class="text-left">
<?php
	if($closeticketsw16==0) {
		if($ticketnum16==0) {
		echo "";
		} else {
		echo "OPEN";
		} // if($ticketnum15==0)
	} else if($closeticketsw16==1) {
		echo "<strong>CLOSED</strong><br>".date("Y-M-d H:i:s", strtotime($closestamp16))."";
	} // if($closeticketsw15==0)
?>
		</td></tr>

<?php
	if($employeeid16==$employeeid0) {
		$actor="REQ";
		if($approvectr16==0) {
		echo "<input type=\"hidden\" name=\"idsr\" value=\"$iditsupportreq\">";
		echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
		echo "<input type=\"hidden\" name=\"requestctr\" value=\"1\">";
		echo "<tr><td colspan=\"2\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\" value=\"Re-submit for approval\">Re-submit for approval</button>";
		echo "</td></tr>";
		}
	} // if($employeeid16==$employeeid0)
	echo "</form>";

	if($approveempid16==$employeeid0) {
		$actor="APP";
		if($approvectr16==0) {
		echo "<form method=\"POST\" action=\"mitsuppreq2.php?lst=1&lid=$loginid&sess=$session&p=342\" name=\"mitsuppreq2\">";
		echo "<input type=\"hidden\" name=\"idsr\" value=\"$iditsupportreq\">";
		echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
		echo "<input type=\"hidden\" name=\"approvectr\" value=\"1\">";
		echo "<tr><td colspan=\"2\" align=\"center\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\" value=\"Approve and Send Support Request\">Approve and Send Support Request</button>";
		echo "</td></tr>";
		echo "</form>";
		} // if($approvectr15==0)
	} // if($approveempid15==$employeeid)

?>

<!-- >>>>>>>>>>>>>> Satisfaction rating <<<<<<<<<<<<<<<<<<<< -->
<?php
	// display if requestor, not filled-up and action='acc' (accomplished)
	if($approvectr16>=1) {
	if($employeeid16==$employeeid0) {
		if($actionctr16>=1 && $actionctg16=='acc') {
			if($scoreval16==0 && $scoreempid16=='') {
			// display scoresheet and submit
			echo "<form method=\"POST\" action=\"mitsuppreqscore.php?lst=1&lid=$loginid&sess=$session&p=342\" name=\"mitsuppreqscore\">";
			echo "<input type=\"hidden\" name=\"idsr\" value=\"$iditsupportreq\">";
			echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
?>
			<tr><th class="text-right">Satisfaction rating</th><td class="text-left">
			<i>How satisfied are you on this support ticket?</i><br>
<?php
			echo "<select name=\"scoreval\">";
			echo "<option value=''>-</option>";
			echo "<option value=\"5\">5 stars (100%)</option>";
			echo "<option value=\"4\">4 stars (80%)</option>";
			echo "<option value=\"3\">3 stars (60%)</option>";
			echo "<option value=\"2\">2 stars (40%)</option>";
			echo "<option value=\"1\">1 star (20%)</option>";
			echo "</select>";
?>
			<br><i>Please provide your comments below based on your satisfaction rating</i><br>
<?php
			echo "<textarea rows=\"5\" cols=\"50\" name=\"scoreremarks\"></textarea>";
			echo "<br><button class=\"btn btn-primary\" type=\"submit\" value=\"Submit score\">Submit score</button>";
?>
			</td></tr>
<?php
			echo "</form>";
			} else {
			// display score
			if($scoreval16==1) {
			$scorepct="20% satisfied"; $scoreclr="text-danger";
			} else if($scoreval16==2) {
			$scorepct="40% satisfied"; $scoreclr="text-warning";
			} else if($scoreval16==3) {
			$scorepct="60% satisfied"; $scoreclr="text-warning";
			} else if($scoreval16==4) {
			$scorepct="80% satisfied"; $scoreclr="text-warning";
			} else if($scoreval16==5) {
			$scorepct="100% satisfied"; $scoreclr="text-success";
			} // if($scoreval15==1)
?>
			<tr><th class="text-right">Satisfaction rating</th><td class="text-left">
<?php
			echo "<p class=\"$scoreclr\"><strong>$scoreval16&nbsp;stars&nbsp;($scorepct)</strong></p>";
			if($scorestamp16!='0000-00-00 00:00:00') {
			echo "<br>".date("Y-M-d H:i:s", strtotime($scorestamp16))."";
			} // if
			if($scoreremarks16!='') {
			echo "<br>".nl2br($scoreremarks16)."";
			} // if($scoreremarks!='')
?>
			</td></tr>
<?php
			} // if($scoreval==0 && $scoreempid=='')
		} // if($actionctr>=1 && $actionctg=='acc')
	} // if($employeeid15==$employeeid)
	} // if($approvectr15>=1)
?>

<!-- >>>>>>>>>>>>>> Comments area <<<<<<<<<<<<<<<<<<<< -->
		<tr><th colspan="2" class="text-center">Comments/clarification area</th></tr>
<?php
	if($closeticketsw16!=1) {
	echo "<form method=\"POST\" action=\"mitsuppreqcomments.php?lst=1&lid=$loginid&sess=$session&p=342\" name=\"mitsuppreqcomments\">";
	echo "<input type=\"hidden\" name=\"idsr\" value=\"$iditsupportreq\">";
	echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
?>
	<tr><td colspan="2" class="text-center">
<?php
	echo "<textarea rows=\"5\" cols=\"70\" name=\"comments\"></textarea>";
	echo "<br><button class=\"btn btn-primary\" type=\"submit\" value=\"Submit\">Submit comment/clarification</button>";
?>
	</td></tr>
	</form>
<?php
	} // if($closeticketsw16!=1)
	echo "<tr><td colspan=\"2\" class=\"text-left\">".nl2br($comments16)."</td></tr>";
?>
	</tbody>
</table>
		</div>
		
	</div> 

