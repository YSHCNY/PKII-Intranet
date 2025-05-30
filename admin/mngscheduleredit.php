<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idscheduler = (isset($_GET['idsc'])) ? $_GET['idsc'] :'';

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
	// Manage scheduler - edit item
	//

	// query record
	$res14query="SELECT schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere, status FROM tblscheduler WHERE idtblscheduler=$idscheduler";
	$result14=""; $found14=0; $ctr14=0;
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$ctr14 = $ctr14+1;
		$schedname14 = $myrow14['schedname'];
		$datefrom14 = $myrow14['datefrom'];
		$datefrom14 = date("Y-m-d", strtotime($datefrom14));
		$dateto14 = $myrow14['dateto'];
		$dateto14 = date("Y-m-d", strtotime($dateto14));
		$details14 = $myrow14['details'];
		$recurring14 = $myrow14['recurring'];
		$deptcd14 = $myrow14['deptcd'];
		$notifysw14 = $myrow14['notifysw'];
		$notifywhen14 = $myrow14['notifywhen'];
		$notifywhen14 = date("Y-m-d", strtotime($notifywhen14));
		$notifywho14 = $myrow14['notifywho'];
		$displaywhere14 = $myrow14['displaywhere'];
		$status14 = $myrow14['status'];
		} // while($myrow14 = $result14->fetch_assoc())
	} // if($result14->num_rows>0)

	// display input fields with queried values
	echo "<table class=\"fin\">";
	echo "<tr><th colspan=\"2\">Manage scheduler - Edit item</th></tr>";
	echo "<form action=\"mngscheduleredit2.php?loginid=$loginid&idsc=$idscheduler\" method=\"post\" name=\"frmmngschededit2\">";
	echo "<tr><th align=\"right\">name</th><td><input size=\"60\" name=\"schedname\" value=\"$schedname14\"></td></tr>";
	echo "<tr><th align=\"right\">from</th><td><input type=\"date\" name=\"datefrom\" value=\"$datefrom14\">";
	?>
  <a href="javascript:show_calendar('document.frmmngschededit2.datefrom', document.frmmngschededit2.datefrom.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "</td></tr>";
	echo "<tr><th align=\"right\">to</th><td><input type=\"date\" name=\"dateto\" value=\"$dateto14\">";
	?>
  <a href="javascript:show_calendar('document.frmmngschededit2.dateto', document.frmmngschededit2.dateto.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "</td></tr>";
	echo "<tr><th align=\"right\">add'l details</th><td><textarea rows=\"3\" cols=\"60\" name=\"details\">$details14</textarea></td></tr>";
	echo "<tr><th align=\"right\">recurring</th><td>";
	if($recurring14==1) {
	echo "<input type=\"checkbox\" name=\"recurring\" checked>(yearly)";
	} else if($recurring14==0) {
	echo "<input type=\"checkbox\" name=\"recurring\">(yearly)";
	}
	echo "</td></tr>";

	echo "<tr><th align=\"right\">department/s</th><td>";
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
		if(preg_match("/$code11/", "$deptcd14")) {
			$empdeptcdsel="checked";
		} else {
			$empdeptcdsel="";
		}
		echo "<input type=\"checkbox\" name=\"depts[]\" value=\"$code11\" $empdeptcdsel />$code11<br>";
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "</table>";
	echo "</td></tr>";
	} else {
	echo "<input type=\"checkbox\" name=\"depts\" value=\"$empdepartment0\" onclick=\"return false;\" checked />$empdepartment0<br>";
	} // if($accesslevel>=4)

	// notify area
	echo "<tr><th align=\"right\">notify</th><td>";
	if($notifysw14==1) { $notifswsel="checked"; } else { $notifswsel=""; }
	echo "<input type=\"checkbox\" name=\"notifysw\" $notifswsel />&nbsp;";
	echo "<input type=\"date\" name=\"notifywhen\" value=\"$notifywhen14\">";
	?>
  <a href="javascript:show_calendar('document.frmmngschededit2.notifywhen', document.frmmngschededit2.notifywhen.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	echo "&nbsp;";
	echo "<select name=\"notifywho\">";
	if(preg_match("/mailto/", "$notifywho14")) {
		$mailsel="selected"; $deptsel=""; $nonesel="";
	} else if(preg_match("/dept/", "$notifywho14")) {
		$mailsel=""; $deptsel="selected"; $nonesel="";
	} else {
		$mailsel=""; $deptsel=""; $nonesel="selected";
	}
	echo "<option value='' $nonesel>-</option>";
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
		echo "<option value=\"$email112\" $mailsel>$email112</option>";
	}
	echo "<option value=\"$empdepartment0\" $deptsel>$empdepartment0 dept</option>";
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
	echo "</form>";

	echo "</table>";

	echo "<p><a href=\"mngscheduler.php?loginid=$loginid\">Back</a></p>";

// end contents here
		$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
