<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$adminloginid = (isset($_GET['admid'])) ? $_GET['admid'] :'';

$deptcd = (isset($_POST['deptcd'])) ? trim($_POST['deptcd']) :'';
if($deptcd=="ALL") { $deptcdallsel="selected"; } else { $deptcdallsel=""; }

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	//
	// Manage scheduler
	//

	if($deptcd=='') {
		if($empdepartment0!='') {
			$deptcd=$empdepartment0;
		} // if($empdepartment0!='')
	} // if($deptcd=='')

	echo "<table class=\"table\">";

	echo "<tr><th colspan=\"2\">Intranet and e-mail scheduler</th></tr>";

	// display add button
	echo "<tr>";
	echo "<td colspan='2'>";
	echo "<form action=\"mngscheduleradd.php?loginid=$loginid\" method=\"post\" name=\"frmmngscheduleradd\">";
	// echo "<input type=\"submit\" value=\"Add new item\">";
	echo "<button type='submit' class='btn btn-primary'>Add new item</button>";
	echo "</form>";
	// echo "</td>";

	// chk accesslevel if >4 and display dept dropdown
	if($accesslevel >= 4) {
		// echo "<td>";
		echo "<form action=\"mngscheduler.php?loginid=$loginid\" method=\"post\" name=\"frmmngscheduler\">";
		echo "<div class='form-group'>";
		echo "<select class='form-control' name=\"deptcd\" onchange=\"this.form.submit()\">";
		if($deptcd=='') {
		echo "<option value=''>choose dept</option>";
		}
		// query dept list + all
		$res11query="SELECT iddeptcd, code, name FROM tbldeptcd ORDER BY iddeptcd ASC";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$iddeptcd11 = $myrow11['iddeptcd'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			if($code11==$deptcd) { $deptcdsel="selected"; } else { $deptcdsel=""; }
			echo "<option value=\"$code11\" $deptcdsel>$name11</option>";
			} // if($result11->num_rows>0)
		} // while($myrow11 = $result11->fetch_assoc())
		echo "<option value=\"ALL\" $deptcdallsel>ALL</option>";
		echo "<select>";
		// echo "<input type=\"submit\">";
		echo "<button type='submit' class='btn btn-primary'>submit</button>";
		echo "</form>";
		echo "</div>";
		echo "</td>";
	} else { // if($accesslevel >= 4)
		echo "<td></td>";
	} // if($accesslevel >= 4)
	echo "</tr>";

if($deptcd!="") {
// list items based on dropdown
echo "<tr class='table-dark'><th>intranet scheduler</th><th>e-mail scheduler</th></tr>";
echo "<tr><td>";
	echo "<table class='table table-striped table-bordered'>";
	echo "<tr><th>date/s</th><th>name</th><th>recurring</th><th>notify</th><th colspan=\"2\">action</th></tr>";
	if($deptcd=="ALL") {
	// $res12query="SELECT idtblscheduler, loginid, lastupdate, schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere, status FROM tblscheduler ORDER BY DATE_FORMAT(datefrom, '%m-%d') DESC";
	$res12query="SELECT idtblscheduler, loginid, lastupdate, schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere, status FROM tblscheduler ORDER BY timestamp DESC";
	} else { // if($deptcd=="ALL")
	// $res12query="SELECT idtblscheduler, loginid, lastupdate, schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere, status FROM tblscheduler WHERE deptcd LIKE \"%$deptcd%\" ORDER BY DATE_FORMAT(datefrom, '%m-%d') DESC";
	$res12query="SELECT idtblscheduler, loginid, lastupdate, schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere, status FROM tblscheduler WHERE deptcd LIKE \"%$deptcd%\" ORDER BY timestamp DESC";
	} // if($deptcd=="ALL")
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$ctr12 = $ctr12+1;
		$idtblscheduler12 = $myrow12['idtblscheduler'];
		$loginid12 = $myrow12['loginid'];
		$lastupdate12 = $myrow12['lastupdate'];
		$schedname12 = $myrow12['schedname'];
		$datefrom12 = $myrow12['datefrom'];
		$dateto12 = $myrow12['dateto'];
		$details12 = $myrow12['details'];
		$recurring12 = $myrow12['recurring'];
		$deptcd12 = $myrow12['deptcd'];
		$notifysw12 = $myrow12['notifysw'];
		$notifywhen12 = $myrow12['notifywhen'];
		$notifywho12 = $myrow12['notifywho'];
		$displaywhere12 = $myrow12['displaywhere'];
		$status12 = $myrow12['status'];
		// disp dates
		echo "<tr><td align=\"center\">";
		if($datefrom12==$dateto12) {
			echo "".date("D Y-M-d", strtotime($datefrom12))."";
		} else {
			echo "".date("D Y-M-d", strtotime($datefrom12))."<br>to<br>".date("D Y-M-d", strtotime($dateto12))."";
		}
		echo "</td>";
		// disp schedname
		echo "<td><b>$schedname12</b></td>";
		// disp recurring
		echo "<td align=\"center\">";
		if($recurring12==1) {
			echo "Yes";
		} else { // if($recurring12==1)
			echo "No";
		} // if($recurring12==1)
		echo "</td>";
		// disp notify
		echo "<td>";
		if($notifysw12==1) {
			echo "".date("D Y-M-d", strtotime($notifywhen12))."<br>$notifywho12";
		} else { // if($notifysw12==1)
			echo "";
		} // if($notifysw12==1)
		echo "</td>";

		// display action links if user=creator
		if($loginid==$loginid12) {
		echo "<td align=\"center\">";
		echo "<a href=\"mngscheduleredit.php?loginid=$loginid&idsc=$idtblscheduler12\" class='btn btn-warning' role='button'>edit</a>";
		echo "</td>";
		echo "<td align=\"center\"><a href=\"mngschedulerdel.php?loginid=$loginid&idsc=$idtblscheduler12\" class='btn btn-danger' role='button'>del</a></td>";
		} else {
		echo "<td></td>";
		echo "<td></td>";
		}
		echo "</tr>";
		} // while($myrow12 = $result12->fetch_assoc())
	} // if($result12->num_rows>0)
	echo "</table>";
echo "</td><td>";

    // disp column2 for email notifier scheduler
	echo "<table class='table table-striped table-bordered'>";
	echo "<thead><tr><th>count</th><th>datetime</th><th>from</th><th>to</th><th>cc</th><th>bcc</th><th>subject</th><th>body</th><th>file</th><th>actions</th></tr></thead>";
	echo "<tbody>";
	$res11qry=""; $result11=""; $found11=0; $ctr11=0;
	$res11qry="SELECT idtblscheduleremail, deptcd, emldatetime, emlreplyto, emlto, emlcc, emlbcc, emlsubject, emlbody, emlfilepath, emlfilename FROM tblscheduleremail WHERE deptcd=\"$deptcd\" ORDER BY emldatetime DESC";
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11++;
			$idtblscheduleremail = $myrow11['idtblscheduleremail'];
			$emldatetime = $myrow11['emldatetime'];
			$emlreplyto = $myrow11['emlreplyto'];
			$emlto = $myrow11['emlto'];
			if(strlen($emlto)>800) {
				$emlto=substr("$emlto", 0, 800);
				$emlto.=" ...";
			} //if
			$emlcc = $myrow11['emlcc'];
			if(strlen($emlcc)>800) {
				$emlcc=substr("$emlcc", 0, 800);
				$emlcc.=" ...";
			} //if
			$emlbcc = $myrow11['emlbcc'];
			if(strlen($emlbcc)>800) {
				$emlbcc=substr("$emlbcc", 0, 800);
				$emlbcc.=" ...";
			} //if
			$emlsubject = $myrow11['emlsubject'];
			$emlbody = $myrow11['emlbody'];
			if(strlen($emlbody)>850) {
				$emlbody=substr("$emlbody", 0, 850);
				$emlbody.=" ...";
			} //if
			$emlfilepath = $myrow11['emlfilepath'];
			$emlfilename = $myrow11['emlfilename'];
			echo "<tr><td>$ctr11</td><td>$emldatetime</td><td>$emlreplyto</td><td>$emlto</td><td>$emlcc</td><td>$emlbcc</td><td>$emlsubject</td><td>".nl2br($emlbody)."</td><td>$emlfilename</td>";
			echo "<td><a href='mngscheduleremailedtdel.php?loginid=$loginid&act=emledt&id=$idtblscheduleremail' class='btn btn-warning' role='button'>edit<a></td><td><a href='mngscheduleremailedtdel.php?loginid=$loginid&act=emldel&id=$idtblscheduleremail' class='btn btn-danger' role='button'>del</a></td></tr>";
		} //while
	} //if
	echo "</tbody>";
	echo "</table>";

echo "</td></tr>";
} // if($deptcd!="")

	echo "</table>";

	echo "<p><a href=\"mngscheduler0.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here
		$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
