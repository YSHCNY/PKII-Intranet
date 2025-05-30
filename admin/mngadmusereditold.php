<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$adminloginid = (isset($_GET['admid'])) ? $_GET['admid'] :'';

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

  if($accesslevel >= 4 && $accesslevel <= 5) {
    echo "<table class=\"table-striped\">";
    echo "<tr><th colspan=\"2\">Manage Admin Users - Edit</th></tr>";

    $res11query = "SELECT adminuid, remarks_login, adminloginlevel, employeeid, contactid, accesslevel, deptscd FROM tbladminlogin WHERE adminloginid=$adminloginid";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
      $found11 = 1;
      $adminuid11 = $myrow11['adminuid'];
      $remarks_login11 = $myrow11['remarks_login'];
      $adminloginlevel11 = $myrow11['adminloginlevel'];
      $employeeid11 = $myrow11['employeeid'];
      $contactid11 = $myrow11['contactid'];
      $accesslevel11 = $myrow11['accesslevel'];
      $deptscd11 = $myrow11['deptscd'];
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)

    $res12query = "SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid11\"";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $employeeid12 = $myrow12['employeeid'];
      $name_last12 = $myrow12['name_last'];
      $name_first12 = $myrow12['name_first'];
      $name_middle12 = $myrow12['name_middle'];
			} // while($myrow12=$result12->fetch_assoc())
		} // if($result12->num_rows>0)

    // 20190905
    $res14query="SELECT empdepartment FROM tblempdetails WHERE employeeid=\"$employeeid11\" LIMIT 1";
    $result14=""; $found14=0; $ctr14=0;
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
      while($myrow14 = $result14->fetch_assoc()) {
      $found14=1;
      $empdepartment14 = $myrow14['empdepartment'];
      } // while
    } // if

    echo "<form action=\"mngadmuseredit2.php?loginid=$loginid&admlid=$adminloginid\" method=\"post\">";
    echo "<tr><th>username</th><td><input name=\"adminuid\" value=\"$adminuid11\"></td></tr>";
    echo "<tr><th>link to personnel</th><td>";
//    echo "<b>$employeeid12 - $name_first12 $name_middle12[0] $name_last12</b>";
//    echo "&nbsp;&nbsp;<a href=\"mngadmuserchgpers.php?loginid=$loginid&admid=$adminloginid\">Change</a>";
    // 20211222 dropdown selection for all employees
		echo "<select name=\"newempid\">";
		$res14query="SELECT tblemployee.employeeid, tblemployee.emp_record, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
		$result14=""; $found14=0; $ctr14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$ctr14=$ctr14+1;
			$employeeid14 = $myrow14['employeeid'];
			$emp_record14 = $myrow14['emp_record'];
			$name_last14 = $myrow14['name_last'];
			$name_first14 = $myrow14['name_first'];
			$name_middle14 = $myrow14['name_middle'];
			if($employeeid14==$employeeid12) {
			$empidsel="selected";
			} else {
			$empidsel="";
			} // if
			if($emp_record14=='inactive') {
			echo "<option value=\"$employeeid14\" $empidsel><i>$name_last14, $name_first14 $name_middle14[0] - ($employeeid14)</i></option>";
			} else {
			echo "<option value=\"$employeeid14\" $empidsel>$name_last14, $name_first14 $name_middle14[0] - ($employeeid14)</option>";
			} // if
			} // while
		} // if
		echo "</select>";
    echo "</td></tr>";

    echo "<tr><th>access level</th><td>";
    $accesslevel1sel = ''; $accesslevel2sel = ''; $accesslevel3sel = ''; $accesslevel4sel = ''; $accesslevel5sel = '';
    if($accesslevel11 == 1) { $accesslevel1sel = "selected"; }
    else if($accesslevel11 == 2) { $accesslevel2sel = "selected"; }
    else if($accesslevel11 == 3) { $accesslevel3sel = "selected"; }
    else if($accesslevel11 == 4) { $accesslevel4sel = "selected"; }
    else if($accesslevel11 == 5) { $accesslevel5sel = "selected"; }
    echo "<select name=\"accesslevel\">";
    echo "<option value=1 $accesslevel1sel>1 - Guest user</option>";
    echo "<option value=2 $accesslevel2sel>2 - Standard user</option>";
    echo "<option value=3 $accesslevel3sel>3 - Encoder</option>";
    echo "<option value=4 $accesslevel4sel>4 - Supervisor/Manager</option>";
		if($accesslevel==5 || $loginid==1) {
    echo "<option value=5 $accesslevel5sel>5 - Super User</option>";
		}
    echo "</select></td></tr>";

    //20221021 status if login attempts >=5
    $res15query=""; $result15=""; $found15=0; $remarksfin="";
    $res15query="SELECT idtblsysusracctmgt, attempt FROM tblsysusracctmgt WHERE loginid=0 AND admloginid=$adminloginid AND employeeid=\"$employeeid11\"";
    $result15=$dbh2->query($res15query);
    if($result15->num_rows>0) {
        while($myrow15=$result15->fetch_assoc()) {
        $found15=1;
        $idtblsysusracctmgt15 = $myrow15['idtblsysusracctmgt'];
        $attempt15 = $myrow15['attempt'];
        } //while
    } //if
    if($found15==1) {
        if($attempt15>=$usrpwretries) {
        $fontclr="#808080";
        $remadd="";
        if($attempt14>=$usrpwretries) { $remadd .= " on non-admin profile."; }
        if($attempt15>=$usrpwretries) { $remadd .= " on admin profile."; }
        $remarksfin = "<font color='red'><strong>DISABLED.</strong> User has reached max password retries".$remadd."</font>";
        } else {
        $fontclr="#000000"; 
        $remarksfin = "";
        } //if-else
    } else {
        $fontclr="#000000"; 
        $remarksfin = "";
    } //if-else
    echo "<tr><th>status</th>";
    echo "<td>$remarksfin";
    if($attempt15>=$usrpwretries) {
    echo "<br><a href=\"mngadmuserdisreset.php?loginid=$loginid&admlid=$adminloginid&idsuam=$idtblsysusracctmgt15\" class='btn btn-success' role='button'>Reset</a>";
    } else {
    echo "<strong><font color='green'>ACTIVE</font></strong>";
    echo "<br><a href=\"./mngadmuserdisable.php?loginid=$loginid&admlid=$adminloginid&idsuam=$idtblsysusracctmgt15\" class='btn btn-danger' role='button'>disable?</a>";
    } //if-else
    echo "</td>";
    echo "</tr>";

    echo "<tr><th>departmental<br>access</th><td>";
    // check deptcd in tblemployee
    // query tbldeptcd
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
		if(preg_match("/$code11/", "$empdepartment14")) {
		echo "<input type=\"checkbox\" name=\"deptscd1[]\" value=\"$code11\" checked readonly />$code11<br>";
		} else if(preg_match("/$code11/", "$deptscd11")) {
		echo "<input type=\"checkbox\" name=\"deptscd2[]\" value=\"$code11\" checked />$code11<br>";
		} else {
		echo "<input type=\"checkbox\" name=\"deptscd3[]\" value=\"$code11\" $empdeptcdsel />$code11<br>";
    } // if-else
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

    echo "</td></tr>";

    echo "<tr><th colspan=\"2\">modules permissions</th></tr>";

    echo "<tr><td colspan=\"2\">";
    echo "<table class=\"table-striped\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><th colspan=\"2\">Directory</th></tr>";
    if(substr($adminloginlevel11, -11, 1) == 1) { $mnudirprojectssel = "checked"; } else { $mnudirprojectssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnudirprojects\" $mnudirprojectssel></td><td>Projects</td></tr>";
    if(substr($adminloginlevel11, -9, 1) == 1) { $mnudirpersonnelsel = "checked"; } else { $mnudirpersonnelsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnudirpersonnel\" $mnudirpersonnelsel></td><td>Personnel</td></tr>";
    if(substr($adminloginlevel11, -7, 1) == 1) { $mnudirbusinesssel = "checked"; } else { $mnudirbusinesssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnudirbusiness\" $mnudirbusinesssel></td><td>Business Contacts</td></tr>";
    if(substr($adminloginlevel11, -23, 1) == 1) { $mnudirisodocssel = "checked"; } else { $mnudirisodocssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnudirisodocs\" $mnudirisodocssel></td><td>ISO Documents</td></tr>";
    if(substr($adminloginlevel11, -44, 1) == 1) { $mnudirmtgrmschedsel = "checked"; } else { $mnudirmtgrmschedsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnudirmtgrmsched\" $mnudirmtgrmschedsel></td><td>Meeting Rooms Scheduler</td></tr>";

    echo "<tr><th colspan=\"2\">Modules</th></tr>";
    if(substr($adminloginlevel11, -17, 1) == 1) { $mnumodvouchersel = "checked"; } else { $mnumodvouchersel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodvoucher\" $mnumodvouchersel></td><td>Vouchers</td></tr>";
    if(substr($adminloginlevel11, -6, 1) == 1) { $mnumodcustpayrollsel = "checked"; } else { $mnumodcustpayrollsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodcustpayroll\" $mnumodcustpayrollsel></td><td>Custom Payroll System</td></tr>";
    if(substr($adminloginlevel11, -5, 1) == 1) { $mnumodemppayslipsel = "checked"; } else { $mnumodemppayslipsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodemppayslip\" $mnumodemppayslipsel></td><td>Employees Payslip</td></tr>";
    if(substr($adminloginlevel11, -4, 1) == 1) { $mnumodcustpayadvisorysel = "checked"; } else { $mnumodcustpayadvisorysel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodcustpayadvisory\" $mnumodcustpayadvisorysel></td><td>Custom Pay Advisory</td></tr>";
    if(substr($adminloginlevel11, -3, 1) == 1) { $mnumodsppaynotifiersel = "checked"; } else { $mnumodsppaynotifiersel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodsppaynotifier\" $mnumodsppaynotifiersel></td><td>Special Pay Notifier</td></tr>";
		if(substr($adminloginlevel11, -26, 1) == 1) { $mnumodhrtimeattsel = "checked"; } else { $mnumodhrtimeattsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodhrtimeatt\" $mnumodhrtimeattsel></td><td>Time & Attendance</td></tr>";
		if(substr($adminloginlevel11, -27, 1) == 1) { $mnumodfinpayrollsyssel = "checked"; } else { $mnumodfinpayrollsyssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodfinpayrollsys\" $mnumodfinpayrollsyssel></td><td>Payroll System</td></tr>";
    if(substr($adminloginlevel11, -13, 1) == 1) { $mnumodprojassignsel = "checked"; } else { $mnumodprojassignsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodspprojassign\" $mnumodprojassignsel></td><td>Project Assignments</td></tr>";
    if(substr($adminloginlevel11, -14, 1) == 1) { $mnumodexpiringcontractssel = "checked"; } else { $mnumodexpiringcontractssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodsexpiringcontracts\" $mnumodexpiringcontractssel></td><td>Expiring Contracts</td></tr>";

		// 20181029
    if(substr($adminloginlevel11, -33, 1) == 1) { $mnumodprojbillingsel = "checked"; } else { $mnumodprojbillingsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodprojbilling\" $mnumodprojbillingsel></td><td>Project Billing</td></tr>";

    if(substr($adminloginlevel11, -15, 1) == 1) { $mnumodhrreportssel = "checked"; } else { $mnumodhrreportssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodhrreports\" $mnumodhrreportssel></td><td>HR Reports</td></tr>";
    if(substr($adminloginlevel11, -20, 1) == 1) { $mnumodfinreportssel = "checked"; } else { $mnumodfinreportssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodfinreports\" $mnumodfinreportssel></td><td>Finance Reports</td></tr>";
    if(substr($adminloginlevel11, -22, 1) == 1) { $mnumodhrtimelogsel = "checked"; } else { $mnumodhrtimelogsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodhrtimelog\" $mnumodhrtimelogsel></td><td>Office Time Log</td></tr>";
    if(substr($adminloginlevel11, -25, 1) == 1) { $mnumoddocsarchivesel = "checked"; } else { $mnumoddocsarchivesel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumoddocsarchive\" $mnumoddocsarchivesel></td><td>Documents Archiving</td></tr>";
    if(substr($adminloginlevel11, -29, 1) == 1) { $mnumoditsuppreqsel = "checked"; } else { $mnumoditsuppreqsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumoditsuppreq\" $mnumoditsuppreqsel></td><td>IT Support Request</td></tr>";

		// 20190701
    if(substr($adminloginlevel11, -42, 1) == 1 || substr($adminloginlevel11, -43, 1)) { $mnumodhrotlvreqsel = "checked"; } else { $mnumodhrotlvreqsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodhrotlvreq\" $mnumodhrotlvreqsel></td><td>OT/Leave Request</td></tr>";

    if(substr($adminloginlevel11, -41, 1) == 1) { $mnumodhrpersreqsel = "checked"; } else { $mnumodhrpersreqsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumodhrpersreq\" $mnumodhrpersreqsel></td><td>HR Personel Requisition</td></tr>";
    if(substr($adminloginlevel11, -30, 1) == 1) { $mnumngpurchsel = "checked"; } else { $mnumngpurchsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumngpurch\" $mnumngpurchsel></td><td>Purchasing</td></tr>";

    echo "<tr><th colspan=\"2\">Manage</th></tr>";
    if(substr($adminloginlevel11, -10, 1) == 1) { $mnumngprojectssel = "checked"; } else { $mnumngprojectssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumngprojects\" $mnumngprojectssel></td><td>Manage Projects</td></tr>";
    if(substr($adminloginlevel11, -8, 1) == 1) { $mnumngpersonnelsel = "checked"; } else { $mnumngpersonnelsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumngpersonnel\" $mnumngpersonnelsel></td><td>Manage Personnel</td></tr>";
    if(substr($adminloginlevel11, -12, 1) == 1) { $mnumngbusinesssel = "checked"; } else { $mnumngbusinesssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumngbusiness\" $mnumngbusinesssel></td><td>Business Contacts</td></tr>";
    if(substr($adminloginlevel11, -18, 1) == 1) { $mnumngacctgmodulessel = "checked"; } else { $mnumngacctgmodulessel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumngacctgmodules\" $mnumngacctgmodulessel></td><td>Accounting Modules</td></tr>";
    if(substr($adminloginlevel11, -21, 1) == 1) { $mnumnghrmodulesel = "checked"; } else { $mnumnghrmodulesel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumnghrmodules\" $mnumnghrmodulesel></td><td>Manage HR Modules</td></tr>";
    if(substr($adminloginlevel11, -24, 1) == 1) { $mnumngcategsel = "checked"; } else { $mnumngcategsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumngcateg\" $mnumngcategsel></td><td>Manage Categories</td></tr>";
    if(substr($adminloginlevel11, -28, 1) == 1) { $mnumngschedsel = "checked"; } else { $mnumngschedsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnumngsched\" $mnumngschedsel></td><td>Scheduler</td></tr>";

    echo "<tr><th colspan=\"2\">Tools</th></tr>";
    if(substr($adminloginlevel11, -2, 1) == 1) { $mnutoolschgpasssel = "checked"; } else { $mnutoolschgpasssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnutoolschgpass\" $mnutoolschgpasssel></td><td>Change Password</td></tr>";
    if(substr($adminloginlevel11, -1, 1) == 1) { $mnutoolsviewlogssel = "checked"; } else { $mnutoolsviewlogssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnutoolsviewlogs\" $mnutoolsviewlogssel></td><td>View Logs</td></tr>";
    if(substr($adminloginlevel11, -16, 1) == 1) { $mnutoolssysadsel = "checked"; } else { $mnutoolssysadsel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnutoolssysad\" $mnutoolssysadsel></td><td>SysAd Tools</td></tr>";
    if(substr($adminloginlevel11, -19, 1) == 1) { $mnutoolsmnguserssel = "checked"; } else { $mnutoolsmnguserssel = ""; }
    echo "<tr><td><input type=\"checkbox\" name=\"mnutoolsmngusers\" $mnutoolsmnguserssel></td><td>Manage Users</td></tr>";

    echo "</table>";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Save\"></form></td></tr>";
    echo "</table>";
  }
    echo "<br><p><a href=\"mngadmusers.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
		$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>






