<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$adminloginid = (isset($_GET['admid'])) ? $_GET['admid'] :'';

$deptcd = (isset($_POST['deptcd'])) ? $_POST['deptcd'] :'';

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

?>
<script language="JavaScript" src="ts_picker.js"></script>  
<?php

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	//
	// Manage scheduler - add item
	//

	echo "<table class=\"table\">";
	echo "<thead><tr><th colspan=\"2\">Manage scheduler - Add item</th></tr></thead><tbody>";
	echo "<tr><td>";
	// display column1
	echo "<table class='table table-striped'>";
	echo "<tr><th colspan='2'>intranet reminder/scheduler</th></tr>";
	echo "<form action=\"mngscheduleradd2.php?loginid=$loginid\" method=\"post\" name=\"frmmngschedadd2\">";
	echo "<tr><th class='text-right'>name</th><td><div class='form-group'><input class='form-control' placeholder='name' name=\"schedname\"></div></td></tr>";
	echo "<tr><th class='text-right'>from</th><td><div class='form-group'><input type=\"date\" class='form-control' name=\"datefrom\" value=\"$datenow\">";
	?>
  <!-- <a href="javascript:show_calendar('document.frmmngschedadd2.datefrom', document.frmmngschedadd2.datefrom.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
  <?php
	echo "</div></td></tr>";
	echo "<tr><th class='text-right'>to</th><td><div class='form-group'><input type=\"date\" class='form-control' name=\"dateto\" value=\"$datenow\">";
	?>
  <!-- <a href="javascript:show_calendar('document.frmmngschedadd2.dateto', document.frmmngschedadd2.dateto.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
  <?php
	echo "</div></td></tr>";
	echo "<tr><th class='text-right'>add'l details</th><td><div class='form-group'><textarea rows=\"3\" class='form-control' placeholder='additional details' name=\"details\"></textarea></div></td></tr>";
	echo "<tr><th class='text-right'>recurring</th><td><div class='form-group'><input type=\"checkbox\" name=\"recurring\">(yearly)</div></td></tr>";

	echo "<tr><th class='text-right'>department/s</th><td><div class='form-group'>";
	// display dept checkboxes if accesslevel > 4
	if($accesslevel>=4) {
	echo "<table border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	$res11query="SELECT iddeptcd, code, name FROM tbldeptcd ORDER BY iddeptcd ASC";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11=1;
		$ctr11 = $ctr11+1;
		$iddeptcd11 = $myrow11['iddeptcd'];
		$code11 = $myrow11['code'];
		$name11 = $myrow11['name'];
		if($code11==$empdepartment0) { $empdeptcdsel="checked"; } else { $empdeptcdsel=""; }
		echo "<input type=\"checkbox\" name=\"depts[]\" value=\"$code11\" $empdeptcdsel>$code11<br>";
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "</table>";
	echo "</div></td></tr>";
	} else {
	echo "<div class='form-group'><input type=\"checkbox\" class='form-control' name=\"depts\" value=\"$empdepartment0\" onclick=\"return false;\" checked /></div>$empdepartment0<br>";
	} // if($accesslevel>=4)

	// notify area
	echo "<tr><th class='text-right'>notify</th><td><div class='form-group'>";
	echo "<input type=\"checkbox\" name=\"notifysw\">&nbsp;";
	echo "<input type=\"date\" class='form-control' name=\"notifywhen\" value=\"$datenow\">";
	?>
  <!-- <a href="javascript:show_calendar('document.frmmngschedadd2.notifywhen', document.frmmngschedadd2.notifywhen.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
  <?php
	echo "&nbsp;";
	echo "<select class='form-control' name=\"notifywho\">";
	echo "<option value=''>-</option>";
	$res12query="SELECT tblcontact.email1 FROM tblcontact WHERE tblcontact.employeeid=$employeeid0";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12=1;
		$email112 = $myrow12['email1'];
		} // while($myrow12 = $result12->fetch_assoc())
	} // if($result12->num_rows>0)
	if($found12==1 && $email112!='') {
		echo "<option value=\"$email112\">$email112</option>";
	}
	echo "<option value=\"$empdepartment0\">$empdepartment0 dept</option>";
	echo "</select>";
	echo "</div></td></tr>";

	echo "<tr><td colspan=\"2\" align=\"center\">";
	// echo "<input type=\"submit\">";
	echo "<button type='submit' class='btn btn-success' name='submremind' value='1'>Submit</button>";
	echo "</td></tr>";
	echo "</form>";
    echo "</table></td><td>";
	
	// display column2
	echo "<form action='mngscheduleradd2.php?loginid=$loginid' method='POST' name='mngscheduleradd2'>";
	echo "<table class='table table-striped'>";
	echo "<tr><th colspan='2'>e-mail sender/scheduler</th></tr>";
	echo "<tr><th class='text-right'>department</th><td>";
	echo "<div class='form-group'>";
	echo "<select class='form-control' name='deptcd'>";
	$res11qry=""; $result11=""; $found11=0; $ctr11=0;
	$res11qry="SELECT iddeptcd, code, name FROM tbldeptcd ORDER BY iddeptcd ASC";
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11++;
			$iddeptcd11 = $myrow11['iddeptcd'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			if($code11==$empdepartment0) { $empdeptcdsel="selected"; } else { $empdeptcdsel=""; }
			echo "<option value='$code11' $empdeptcdsel>$name11</option>";
		} //while
	} //if
	echo "</select></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>date to be sent</th><td>";
	echo "<div class='form-group'><input type='date' class='form-control' name='emldate' value='$datenow'></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>time to be sent</th><td>";
	echo "<div class='form-group'>";
	echo "<select class='form-control' name='emltime'>";
	for($tm=0; $tm<=23; $tm++) {
		$tmfin=$tm.':00:00';
		echo "<option value='$tmfin'>$tmfin</option>";
	} //for
	echo "</select>";
	echo "</div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>from/reply-to</th><td>";
	echo "<div class='form-group'><input type='email' class='form-control' name='emlreplyto' value='noreply@philkoei.com.ph'></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>to</th><td>";
	echo "<div class='form-group'><textarea rows='3' class='form-control' placeholder='email(s) separated by comma' name='emlto'></textarea></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>cc</th><td>";
	echo "<div class='form-group'><textarea rows='3' class='form-control' placeholder='email(s) separated by comma' name='emlcc'></textarea></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>bcc</th><td>";
	echo "<div class='form-group'><textarea rows='3' class='form-control' placeholder='email(s) separated by comma' name='emlbcc'></textarea></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>subject</th><td>";
	echo "<div class='form-group'><input type='text' class='form-control' placeholder='subject' name='emlsubject'></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>message</th><td>";
	echo "<div class='form-group'><textarea rows='4' class='form-control' placeholder='body of message' name='emlbody'></textarea></div>";
	echo "</td></tr>";
	echo "<tr><td colspan='2' class='text-center'><button type='submit' class='btn btn-success' name='submemail' value='1'>Submit</button></td></tr>";
    echo "</table>";
	echo "</td>";
	echo "</tbody></table>";
	echo "</form>";

	echo "<p><a href=\"mngscheduler.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here
		$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
