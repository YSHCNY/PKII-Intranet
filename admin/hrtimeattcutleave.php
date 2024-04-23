<?php 

session_start(); // Start the session to use session variables

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

	if (isset($_SESSION['success_message'])) {
	?>
		<div id="successMessage" class="position-absolute" style="top: 100px; left: 50%; transform: translate(-50%, -50%);">
			<div class="bg-white d-flex align-items-center rounded-4 shadow px-4 gap-4" style="width: 500px; height: 70px; border: 3.5px solid #00c04b;">
				<span style="color: #00c04b; font-size: 35px;"><i class="bi bi-check-circle"></i></span>
				<span>
					<h4 class="poppins m-0" style="color: #00c04b;">Edited Successfully</h4>
					<h6 class="poppins m-0 text-muted">Records has been updated successfully.</h6>
				</span>
			</div>
		</div>
	<?php
		unset($_SESSION['success_message']);
	}
	?>
		<script>
		setTimeout(function() {
			var successMessage = document.getElementById('successMessage');
			if (successMessage) {
				successMessage.remove();
			}
		}, 3000);
		</script>
	<?php
// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Leave entry</font></p>";

     echo "<table class='fin table border border-1 shadow poppins'>";

// start contents here...

  echo "<tr><td colspan=\"2\">";

  if($accesslevel >= 3) {
	echo "<table class='fin border border-1'>";
	echo "<tr>";
		echo "<form action=\"hrtimeattcutleave.php?loginid=$loginid\" method=\"post\" name=\"hrtimeattcutleave\">";

		// pay group name dropdown
    echo "<td class='align-middle'><select class='poppins' name=\"idpaygroup\" onchange=\"this.form.submit()\">";
		if($idpaygroup == "") {
		echo "<option value=''>select paygroup</option>";
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
		echo "</select></td>";

		// cut-off period dropdown
		echo "<td class='align-middle'><select class='poppins' name=\"idcutoff\" onchange=\"this.form.submit()\">";
		if($idcutoff == "") {
		echo "<option value=''>select cutoff</option>";
		}
		$res15query = "SELECT idhrtacutoff, cutstart, cutend, paygroupname, remarks FROM tblhrtacutoff WHERE idhrtapaygrp=$idpaygroup ORDER BY cutstart DESC";
		$result15=""; $found15=0; $ctr15=0;
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15 = $result15->fetch_assoc()) {
			$found15 = 1;
			$idhrtacutoff15 = $myrow15['idhrtacutoff'];
			$cutstart15 = $myrow15['cutstart'];
			$cutend15 = $myrow15['cutend'];
			$paygroupname15 = $myrow15['paygroupname'];
			$remarks15 = $myrow15['remarks'];
			$ctr15 = $ctr15 + 1;
			if($idhrtacutoff15 == $idcutoff) { $idcutoffsel="selected"; } else { $idcutoffsel=""; }
			echo "<option value=\"$idhrtacutoff15\" $idcutoffsel>$cutstart15-to-$cutend15</option>";
			}
		}
		echo "</select></td>";

		// individual personnel dropdown
		if($idpaygroup != "" && $idcutoff != "") {
		echo "<td class='align-middle'>";
		echo "<select class='poppins' name=\"empid\" onchange=\"this.form.submit()\">";
		echo "<option value=''>select personnel</option>";
		$res12query="SELECT DISTINCT tblhrtaemptimelog.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaemptimelog LEFT JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid WHERE tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\" ORDER BY tblhrtaemptimelog.employeeid ASC";
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
		echo "</td>";
		} // if($idpaygroup != "" && $idcutoff != "")

		// submit button
		echo "<td class='align-middle'>";
		echo "<button type=\"submit\" class=\"btn btn-success poppins\">Submit</button>";
    echo "</td>";

		echo "</form>";
	echo "</tr>";
	echo "</table>";
  } // endif accesslevel >= 4

  echo "</td></tr>";

	// display add button and leave entries
	if($employeeid!='') {
		echo "<table class='fin table border border-1 shadow poppins'>";
		// display employee name and date hired
		$res14query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblemployee.date_hired, tblhrtapaygrpemplst.restday FROM tblhrtaemptimelog LEFT JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid LEFT JOIN tblemployee ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblhrtaempleavesumm ON tblhrtaemptimelog.idpaygroup=tblhrtaempleavesumm.idhrtaempleavesumm LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.idpaygroup=tblhrtapaygrpemplst.idtblhrtapaygrp WHERE tblhrtaemptimelog.idcutoff=$idcutoff AND tblhrtaemptimelog.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\" AND tblcontact.employeeid=\"$employeeid\" LIMIT 1";
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
			} // while
		} // if

	// query VL balance
	// query tblhrtaempleavesumm for bal
	$where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=2 AND tblhrtaleavectg.code=\"vacation\")";
	$orderby17="tblhrtaempleavesumm.datestart DESC";
	include './hrtimeattqrylvsumm.php';
	if($found17==1) {
	$vlbal17=$bal17;
	// echo "<input name=\"vlbal\" size=\"3\" value=\"$vlbal17\">";
	} else {
	// query tblhrtaleavectg for quota
	$where18="tblhrtaleavectg.idhrtaleavectg=2 AND tblhrtaleavectg.code=\"vacation\"";
	include './hrtimeattqrylvctg.php';
	// echo "<input name=\"vlbal\" size=\"3\" value=\"$quota18\">";
	$vlbal17=$quota18;
	} // if
	$vldur=0; $vlbalfin=0;
	// query tblhrtaempleavechglog, deduct duration
	$res17aquery="SELECT tblhrtaempleavechglog.leaveduration FROM tblhrtaempleavechglog WHERE tblhrtaempleavechglog.idhrtacutoff=$idcutoff AND tblhrtaempleavechglog.employeeid=\"$employeeid\" AND tblhrtaempleavechglog.idhrtaleavectg=2";
	$result17a=""; $found17a=0; $ctr17a=0;
	$result17a=$dbh2->query($res17aquery);
	if($result17a->num_rows>0) {
		while($myrow17a=$result17a->fetch_assoc()) {
		$found17a=1;
		$leaveduration17a=$myrow17a['leaveduration'];
		$vldur=$vldur+$leaveduration17a;
		} // while
	} // if
	$vlbalfin=$vlbal17-$vldur;

	// query SL balance
	// query tblhrtaempleavesumm for bal
	$where17="tblhrtaempleavesumm.employeeid=\"$employeeid\" AND tblhrtaempleavesumm.idpaygroup=$idpaygroup AND (tblhrtaleavectg.idhrtaleavectg=1 AND tblhrtaleavectg.code=\"sick\")";
	$orderby17="tblhrtaempleavesumm.datestart DESC";
	include './hrtimeattqrylvsumm.php';
	if($found17==1) {
	$slbal17=$bal17;
	// echo "<input name=\"slbal\" size=\"3\" value=\"$slbal17\">";
	} else {
	// query tblhrtaleavectg for quota
	$where18="tblhrtaleavectg.idhrtaleavectg=1 AND tblhrtaleavectg.code=\"sick\"";
	include './hrtimeattqrylvctg.php';
	// echo "<input name=\"slbal\" size=\"3\" value=\"$quota18\">";
	$slbal17=$quota18;
	} // if
	$sldur=0; $slbalfin=0;
	// query tblhrtaempleavechglog, deduct duration
	$res17bquery="SELECT tblhrtaempleavechglog.leaveduration FROM tblhrtaempleavechglog WHERE tblhrtaempleavechglog.idhrtacutoff=$idcutoff AND tblhrtaempleavechglog.employeeid=\"$employeeid\" AND tblhrtaempleavechglog.idhrtaleavectg=1";
	$result17b=""; $found17b=0; $ctr17b=0;
	$result17b=$dbh2->query($res17bquery);
	if($result17b->num_rows>0) {
		while($myrow17b=$result17b->fetch_assoc()) {
		$found17b=1;
		$leaveduration17b=$myrow17b['leaveduration'];
		$sldur=$sldur+$leaveduration17b;
		} // while
	} // if
	$slbalfin=$slbal17-$sldur;

	?>
		<tr class='table-dark shadow'>
		<th colspan="2">
			<div class="d-flex justify-content-between align-items-center fw-medium" style="padding-right: 5%;">
				<span><?php echo "<strong>$name_last14, $name_first14 $name_middle14[0].</strong>- $employeeid <br> Anniversary Date: " . date("M d, Y (D)", strtotime($date_hired14)); ?></span>
				<div class="d-flex justify-content-between align-items-center gap-2">
					<div class="d-flex flex-column">
						<span>V Leave Credits:</span>
						<span>S Leave Credits:</span>
					</div>
					<div class="d-flex flex-column align-items-center">
						<span> <?php if ($vlbalfin <= 0) { ?><font color="red"><?php echo $vlbalfin; ?></font><?php } else { ?><?php echo $vlbalfin; ?><?php } ?></span>
						<span> <?php if ($slbalfin <= 0) { ?><font color="red"><?php echo $slbalfin; ?></font><?php } else { ?><?php echo $slbalfin; ?><?php } ?></span>
					</div>
				</div>
			</div>
		</th>
		</tr>
	<?php
		// display add leave form if no payroll processed
		$res15query="SELECT idemppaycutoff FROM tblemppaycutoff WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup";
		$result15=""; $found15=0; $ctr15=0;
		$result15=$dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15=1;
			$idemppaycutoff15=$myrow15['idemppaycutoff'];
			} // while
		} // if
		echo "<tr class='align-middle'><td class='align-middle'>";
		if($found15!=1 && $idemppaycutoff15=='') {
		echo "<form action=\"hrtimeattcutleaveadd.php?loginid=$loginid\" method=\"POST\" name=\"hrtimeattcutleaveadd\">";
		echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
		echo "<input type=\"hidden\" name=\"idcutoff\" value=\"$idcutoff\">";
		echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
		echo "<table class='table table-hover shadow poppins'>";
		//
		// generate leave date
		include './hrtimeattqryrestday.php';
		// query again custart to cutend based on idcutoff
		include './hrtimeattqrycutoff.php';
	?>
		<tr class='table-info'><td colspan="2" class='text-center fs-2 fw-semibold poppins'>Add New Leave</td></tr>
		<tr><th align="right" class="fw-medium">Leave date</th><td>
		<select name="leavedate" class='poppins'>
		<?php
		while(strtotime($cutstart18) <= strtotime($cutend18)) {
			$cutstartfin=$cutstart18;
			include './hrtimeattqryholiday.php';
			$dateday=date("D", strtotime($cutstartfin));
			// display cutoff dates w/o rest day
			if($found21==1) {
			} else if($dateday==$restdaysunfin || $dateday==$restdaymonfin || $dateday==$restdaytuefin || $dateday==$restdaywedfin || $dateday==$restdaythufin || $dateday==$restdayfrifin || $dateday==$restdaysatfin) {
			} else {
				?>
				<option value="<?php echo $cutstart18; ?>"><?php echo date("Y-M-d D", strtotime($cutstart18)); ?></option>
				<?php
			}
			// increment date
			$cutstart18 = date("Y-m-d", strtotime("+1 day", strtotime($cutstart18)));
		} // while
		?>
		</select>
		</td></tr>
		<!-- leave type -->
		<tr><th align="right" class="fw-medium">Leave type</th><td>
		<select name="idleavectg" class='poppins'>
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
					if($code16=='paternity') { ?><option value="<?php echo $idhrtaleavectg16; ?>"><?php echo $name16; ?></option><?php }
				} else if($contact_gender14=='Female') {
					if($code16=='maternityn' || $code16=='maternityc') { ?><option value="<?php echo $idhrtaleavectg16; ?>"><?php echo $name16; ?></option><?php }
				}
				if($code16!='paternity' && $code16!='maternityn' && $code16!='maternityc' && $code16!='sd' && $code16!='ob') { ?><option value="<?php echo $idhrtaleavectg16; ?>"><?php echo $name16; ?></option><?php }
			}
		}
		?>
		</select>
		</td></tr>
		<!-- leave duration -->
		<tr><th align="right" class="fw-medium">Leave duration</th><td>
		<select name="leavedur" class='poppins'>
			<option value="1.00">1.0 day</option>
			<option value="0.50a">0.5 day (am)</option>
			<option value="0.50p">0.5 day (pm)</option>
		</select>
		</td></tr>
		<!-- reason/remarks (optional) -->
		<tr><th align="right" class="fw-medium">Reason/remarks (optional)</th><td>
		<textarea rows="3" cols="40" name="reason" class='poppins'></textarea>
		</td></tr>
		<!-- display note/s -->
		<tr><td class='poppins' colspan="2">Note: Pls make sure leave is approved before clicking Add leave button</td></tr>
		<!-- add leave button -->
		<tr><td colspan="2" align="center" class="fw-medium"><button type="submit" class="btn btn-success poppins">Add leave</button></td></tr>
	<?php
		echo "</table>";
		echo "</form>";
		} // if
		echo "</td>";

		//
		// list leave entries
		echo "<td>";
	?>
		<table class='table border border-1 shadow poppins'>
		<tr class="table-info">
			<th class="text-center fw-medium">Leave Date</th>
			<th class="text-center fw-medium">Leave Type</th>
			<th class="text-center fw-medium">Duration</th>
			<th class="text-center fw-medium">Reason</th>
			<th class="text-center fw-medium" colspan=\"2\">Action</th>
		</tr>
	<?php
		$employeeid = isset($_POST['empid']) ? $_POST['empid'] : '';
		$res17query = "SELECT tblhrtalvreq.*, tblhrtaleavectg.*
                	   FROM tblhrtalvreq
                	   INNER JOIN tblhrtaleavectg ON tblhrtalvreq.idhrtaleavectg = tblhrtaleavectg.idhrtaleavectg;";
		$result17 = "";
		$found17 = 0;
		$ctr17 = 0;
		$result17 = $dbh2->query($res17query);
		if ($result17->num_rows > 0) {
			while ($myrow17 = $result17->fetch_assoc()) {
				$found17 = 1;
				$idhrtaempleavechglog17 = $myrow17['idhrtaempleavechglog'];
				$idhrtaleavectg = $myrow17['idhrtaleavectg'];
				$idhrtalvreq = $myrow17['idhrtalvreq'];

				$durationfrom = strtotime($myrow17['durationfrom']);
				$durationto = strtotime($myrow17['durationto']);
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
	?>
        <tr>
		<?php if ($employeeid == $logid && $approve == 1) : ?>
            <td class="text-center poppins"><?php echo date("M d, Y (D)", strtotime($to)); ?></td>
            <td class="text-center poppins"><?php echo $leavetype; ?></td>
			<td class="text-center poppins">
				<?php 
				if ($days == 0 || $days == 1) {
					if ($hours == 0) {
						echo "$days day";
					} else {
						echo "$days day & $hours hour ";
					}
				} else {
					if ($hours == 0) {
						echo "$days days";
					} else {
						echo "$days days & $hours hours";
					}
				}
				?>
			</td>
            <td class='poppins'><?php echo $reason; ?></td>
            <td class='poppins'>
				<div class="d-flex gap-2">
					<a href="hrtimeattcutleaveedt.php?loginid=<?php echo $loginid; ?>&idhrtalvreq=<?php echo urlencode($idhrtalvreq); ?>&idhrtaleavectg=<?php echo urlencode($idhrtaleavectg); ?>&leavetype=<?php echo urlencode($leavetype); ?>&leaveduration=<?php echo urlencode($days); ?>&leavedurationh=<?php echo urlencode($hours); ?>&reason=<?php echo urlencode($reason); ?>&durationfrom=<?php echo urlencode($from); ?>&durationto=<?php echo urlencode($to); ?>" class="d-flex align-items-center m-0 h-100">
						<button type="button" class="btn btn-warning h-75 text-muted fw-medium">Edit</button>
					</a>
					<a href="hrtimeattcutleavedlt.php?loginid=<?php echo $loginid; ?>&idhrtalvreq=<?php echo $idhrtalvreq; ?>&idhrtaleavectg=<?php echo $idhrtaleavectg; ?>" class="d-flex align-items-center m-0 h-100">
						<button type="button" class="btn btn-danger h-75 text-muted fw-medium">Delete</button>
					</a>
				</div>
            </td>
        <?php endif; ?>
        </tr>
	<?php	  
			} // while
		} // if
		// echo "<tr><td colspan=5>list leave entries here<br>$res17query</td></tr>";
		echo "</table>";
		echo "</td></tr>";
		echo "</div>";
	} // if($employeeid!='')

// end contents here...

     echo "</table>";

// edit body-footer
?>
	<div class="d-flex justify-content-end pt-5">
	<button class="border-0 rounded-3" style="width: 12.5%; height: 40px; background-color: #0a1d44;">
		<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">Back</a>
	</button>
	</div>
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

