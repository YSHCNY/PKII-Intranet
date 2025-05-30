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
?>
<div class = 'shadow p-5 mx-1 my-3 poppins'>
<p class="text-center fs-3 fw-bold mb-0 poppins">Edit User Form</p>
<p class = 'fs-5 text-muted text-center poppins'>Edit user info and access.</p>


<?php
  if($accesslevel >= 4 && $accesslevel <= 5) {
  // Start session to retrieve the message
  session_start();
  if (isset($_SESSION['editsuccess'])) {
    // Display the alert using Bootstrap
    echo '<div id="alertsuccess" class="alert alert-success" role="alert">';
    echo $_SESSION['editsuccess'];
    echo '</div>';

  
    unset($_SESSION['editsuccess']);
}
?>

<script>
// JavaScript to hide the alert after 1 second
$(document).ready(function(){
    setTimeout(function(){
        $("#alertsuccess").fadeOut("slow", function(){
            $(this).remove();
        });
    }, 3000); 
});
</script>

<?php


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
    echo "<div>";
    echo "<p class = ' fs-3 mb-0 poppins'><span class = 'fw-bold' > $name_first12 $name_middle12[0]. $name_last12 </span> </p>";
 
  echo "</div>";


    echo "<form id='saveForm' action=\"mngadmuseredit2.php?loginid=$loginid&admlid=$adminloginid\" method=\"post\">";
    echo "<div class = 'mt-3'><p class = 'fs-5 text-muted mb-0 poppins'>Username</p>";
    echo "<input class = 'bg-white border rounded-2 px-3 py-2' name=\"adminuid\" value=\"$adminuid11\"></div>";
   
    echo "<div class = 'mt-3'><p  class = 'fs-5 text-muted mb-0 text-capitalize poppins'>link to personnel</p>";
//    echo "<b>$employeeid12 - $name_first12 $name_middle12[0] $name_last12</b>";
//    echo "&nbsp;&nbsp;<a href=\"mngadmuserchgpers.php?loginid=$loginid&admid=$adminloginid\">Change</a>";
    // 20211222 dropdown selection for all employees
		echo "<select class = 'bg-white border rounded-2 px-3 py-2' name=\"newempid\">";
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
		echo "</select></div>";


    echo "<div class = 'mt-3'><p  class = 'fs-5 text-muted mb-0 poppins'>Access Level</p>";
    $accesslevel1sel = ''; $accesslevel2sel = ''; $accesslevel3sel = ''; $accesslevel4sel = ''; $accesslevel5sel = '';
    if($accesslevel11 == 1) { $accesslevel1sel = "selected"; }
    else if($accesslevel11 == 2) { $accesslevel2sel = "selected"; }
    else if($accesslevel11 == 3) { $accesslevel3sel = "selected"; }
    else if($accesslevel11 == 4) { $accesslevel4sel = "selected"; }
    else if($accesslevel11 == 5) { $accesslevel5sel = "selected"; }
    echo "<select class = 'bg-white border rounded-2 px-3 py-2' name=\"accesslevel\">";
    echo "<option value=1 $accesslevel1sel>1 - Guest user</option>";
    echo "<option value=2 $accesslevel2sel>2 - Standard user</option>";
    echo "<option value=3 $accesslevel3sel>3 - Encoder</option>";
    echo "<option value=4 $accesslevel4sel>4 - Supervisor/Manager</option>";
		if($accesslevel==5 || $loginid==1) {
    echo "<option value=5 $accesslevel5sel>5 - Super User</option>";
		}
    echo "</select></div>";
 

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
    echo "<div class = 'mt-5'>
    <p class = 'fs-4 text-muted poppins' >Status</p>
   ";
    echo "<p>$remarksfin</p>";
    if($attempt15>=$usrpwretries) {
    echo "<a href=\"mngadmuserdisreset.php?loginid=$loginid&admlid=$adminloginid&idsuam=$idtblsysusracctmgt15\" class='btn btn-success' role='button'>Reset</a>";
    } else {
    echo "<span class = 'text-success fw-bold mx-4'>ACTIVE</span>";
    echo "<a href=\"./mngadmuserdisable.php?loginid=$loginid&admlid=$adminloginid&idsuam=$idtblsysusracctmgt15\" class='btn btn-danger' role='button'>Disable?</a>";
    } //if-else
 echo " </div>";


    echo "<div class = 'mt-5'>
    <p class = 'fs-4 text-muted poppins' >Departmental Access</p>
    </div>";
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
      echo "<div class=\"form-check\">";
echo "<label class=\"form-check-label\"><input class=\"form-check-input\" type=\"checkbox\" value=\"$code11\" name=\"deptscd1[]\" checked readonly > $code11</label><br>";
echo "</div>";
		} else if(preg_match("/$code11/", "$deptscd11")) {
      echo "<div class=\"form-check\">";
      echo "<label class=\"form-check-label\"><input class=\"form-check-input\" type=\"checkbox\" value=\"$code11\" name=\"deptscd2[]\"  checked> $code11</label><br>";
      echo "</div>";
		
		} else {

      echo "<div class=\"form-check\">";
      echo "<label class=\"form-check-label\"><input class=\"form-check-input\" type=\"checkbox\" value=\"$code11\" name=\"deptscd3[]\" $empdeptcdsel> $code11</label><br>";
      echo "</div>";
	
    } // if-else
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)



    echo "
    <div class = 'mt-5'>
    <p class = 'fs-4 text-muted poppins' >Module Permissions</p>
    </div>";


    ?>

    <div class="row">

    <div class="col-lg-3 col-md-6 col-sm-12">

    <div class = 'border rounded-3 p-4 m-2 h-100'>

    <?php
    echo "
    <div class = 'border-bottom px-2 mb-3'>
    <p class = 'fw-bold fs-3 text-center poppins'>Directory</p>
    </div>";
 
  
echo "<div class=\"form-check\">";
if(substr($adminloginlevel11, -11, 1) == 1) { $mnudirprojectssel = "checked"; } else { $mnudirprojectssel = ""; }
echo "<label class=\"form-check-label\"><input class=\"form-check-input\" type=\"checkbox\" name=\"mnudirprojects\" $mnudirprojectssel> Projects</label><br>";
echo "</div>";

echo "<div class=\"form-check\">";
if(substr($adminloginlevel11, -9, 1) == 1) { $mnudirpersonnelsel = "checked"; } else { $mnudirpersonnelsel = ""; }
echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnudirpersonnel\" $mnudirpersonnelsel id=\"mnudirpersonnel\">";
echo "<label class=\"form-check-label\" for=\"mnudirpersonnel\">Personnel</label>";
echo "</div>";

echo "<div class=\"form-check\">";
if(substr($adminloginlevel11, -7, 1) == 1) { $mnudirbusinesssel = "checked"; } else { $mnudirbusinesssel = ""; }
echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnudirbusiness\" $mnudirbusinesssel id=\"mnudirbusiness\">";
echo "<label class=\"form-check-label\" for=\"mnudirbusiness\">Business Contacts</label>";
echo "</div>";

echo "<div class=\"form-check\">";
if(substr($adminloginlevel11, -23, 1) == 1) { $mnudirisodocssel = "checked"; } else { $mnudirisodocssel = ""; }
echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnudirisodocs\" $mnudirisodocssel id=\"mnudirisodocs\">";
echo "<label class=\"form-check-label\" for=\"mnudirisodocs\">ISO Documents</label>";
echo "</div>";

echo "<div class=\"form-check\">";
if(substr($adminloginlevel11, -44, 1) == 1) { $mnudirmtgrmschedsel = "checked"; } else { $mnudirmtgrmschedsel = ""; }
echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnudirmtgrmsched\" $mnudirmtgrmschedsel id=\"mnudirmtgrmsched\">";
echo "<label class=\"form-check-label\" for=\"mnudirmtgrmsched\">Meeting Rooms Scheduler</label>";
echo "</div>";


// echo "<label><input type=\"checkbox\" name=\"mnudirprojects\" $mnudirprojectssel> Projects</label><br>";
// echo "<tr><td><input type=\"checkbox\" name=\"mnudirpersonnel\" $mnudirpersonnelsel></td><td>Personnel</td></tr>";
// echo "<tr><td><input type=\"checkbox\" name=\"mnudirbusiness\" $mnudirbusinesssel></td><td>Business Contacts</td></tr>";
// echo "<tr><td><input type=\"checkbox\" name=\"mnudirisodocs\" $mnudirisodocssel></td><td>ISO Documents</td></tr>";


?>
</div>
</div>


<div class="col-lg-3 col-md-6 col-sm-12">
<div class = 'border rounded-3 p-4 m-2 h-100'>
<?php
    echo "<div class = 'border-bottom px-2 mb-3'>
    <p class = 'fw-bold fs-3 text-center'>Modules</p>
    </div>";
    if(substr($adminloginlevel11, -17, 1) == 1) { $mnumodvouchersel = "checked"; } else { $mnumodvouchersel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodvoucher\" $mnumodvouchersel id=\"mnumodvoucher\">";
    echo "<label class=\"form-check-label\" for=\"mnumodvoucher\">Vouchers</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -6, 1) == 1) { $mnumodcustpayrollsel = "checked"; } else { $mnumodcustpayrollsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodcustpayroll\" $mnumodcustpayrollsel id=\"mnumodcustpayroll\">";
    echo "<label class=\"form-check-label\" for=\"mnumodcustpayroll\">Custom Payroll System</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -5, 1) == 1) { $mnumodemppayslipsel = "checked"; } else { $mnumodemppayslipsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodemppayslip\" $mnumodemppayslipsel id=\"mnumodemppayslip\">";
    echo "<label class=\"form-check-label\" for=\"mnumodemppayslip\">Employees Payslip</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -4, 1) == 1) { $mnumodcustpayadvisorysel = "checked"; } else { $mnumodcustpayadvisorysel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodcustpayadvisory\" $mnumodcustpayadvisorysel id=\"mnumodcustpayadvisory\">";
    echo "<label class=\"form-check-label\" for=\"mnumodcustpayadvisory\">Custom Pay Advisory</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -3, 1) == 1) { $mnumodsppaynotifiersel = "checked"; } else { $mnumodsppaynotifiersel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodsppaynotifier\" $mnumodsppaynotifiersel id=\"mnumodsppaynotifier\">";
    echo "<label class=\"form-check-label\" for=\"mnumodsppaynotifier\">Special Pay Notifier</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -26, 1) == 1) { $mnumodhrtimeattsel = "checked"; } else { $mnumodhrtimeattsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodhrtimeatt\" $mnumodhrtimeattsel id=\"mnumodhrtimeatt\">";
    echo "<label class=\"form-check-label\" for=\"mnumodhrtimeatt\">Time & Attendance</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -27, 1) == 1) { $mnumodfinpayrollsyssel = "checked"; } else { $mnumodfinpayrollsyssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodfinpayrollsys\" $mnumodfinpayrollsyssel id=\"mnumodfinpayrollsys\">";
    echo "<label class=\"form-check-label\" for=\"mnumodfinpayrollsys\">Payroll System</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -13, 1) == 1) { $mnumodprojassignsel = "checked"; } else { $mnumodprojassignsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodspprojassign\" $mnumodprojassignsel id=\"mnumodspprojassign\">";
    echo "<label class=\"form-check-label\" for=\"mnumodspprojassign\">Project Assignments</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -14, 1) == 1) { $mnumodexpiringcontractssel = "checked"; } else { $mnumodexpiringcontractssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodsexpiringcontracts\" $mnumodexpiringcontractssel id=\"mnumodsexpiringcontracts\">";
    echo "<label class=\"form-check-label\" for=\"mnumodsexpiringcontracts\">Expiring Contracts</label>";
    echo "</div>";

    
    if(substr($adminloginlevel11, -33, 1) == 1) { $mnumodprojbillingsel = "checked"; } else { $mnumodprojbillingsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodprojbilling\" $mnumodprojbillingsel id=\"mnumodprojbilling\">";
    echo "<label class=\"form-check-label\" for=\"mnumodprojbilling\">Project Billing</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -15, 1) == 1) { $mnumodhrreportssel = "checked"; } else { $mnumodhrreportssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodhrreports\" $mnumodhrreportssel id=\"mnumodhrreports\">";
    echo "<label class=\"form-check-label\" for=\"mnumodhrreports\">HR Reports</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -20, 1) == 1) { $mnumodfinreportssel = "checked"; } else { $mnumodfinreportssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodfinreports\" $mnumodfinreportssel id=\"mnumodfinreports\">";
    echo "<label class=\"form-check-label\" for=\"mnumodfinreports\">Finance Reports</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -22, 1) == 1) { $mnumodhrtimelogsel = "checked"; } else { $mnumodhrtimelogsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodhrtimelog\" $mnumodhrtimelogsel id=\"mnumodhrtimelog\">";
    echo "<label class=\"form-check-label\" for=\"mnumodhrtimelog\">Office Time Log</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -25, 1) == 1) { $mnumoddocsarchivesel = "checked"; } else { $mnumoddocsarchivesel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumoddocsarchive\" $mnumoddocsarchivesel id=\"mnumoddocsarchive\">";
    echo "<label class=\"form-check-label\" for=\"mnumoddocsarchive\">Documents Archiving</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -29, 1) == 1) { $mnumoditsuppreqsel = "checked"; } else { $mnumoditsuppreqsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumoditsuppreq\" $mnumoditsuppreqsel id=\"mnumoditsuppreq\">";
    echo "<label class=\"form-check-label\" for=\"mnumoditsuppreq\">IT Support Request</label>";
    echo "</div>";
    
    // 20190701
    if(substr($adminloginlevel11, -42, 1) == 1 || substr($adminloginlevel11, -43, 1)) { $mnumodhrotlvreqsel = "checked"; } else { $mnumodhrotlvreqsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodhrotlvreq\" $mnumodhrotlvreqsel id=\"mnumodhrotlvreq\">";
    echo "<label class=\"form-check-label\" for=\"mnumodhrotlvreq\">OT/Leave Request</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -41, 1) == 1) { $mnumodhrpersreqsel = "checked"; } else { $mnumodhrpersreqsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumodhrpersreq\" $mnumodhrpersreqsel id=\"mnumodhrpersreq\">";
    echo "<label class=\"form-check-label\" for=\"mnumodhrpersreq\">HR Personnel Requisition</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -30, 1) == 1) { $mnumngpurchsel = "checked"; } else { $mnumngpurchsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumngpurch\" $mnumngpurchsel id=\"mnumngpurch\">";
    echo "<label class=\"form-check-label\" for=\"mnumngpurch\">Purchasing</label>";
    echo "</div>";
    




    ?>
</div>
</div>


<div class="col-lg-3 col-md-6 col-sm-12">
<div class = 'border rounded-3 p-4 m-2 h-100'>
<?php



    echo "<div class = 'border-bottom px-2 mb-3'>
    <p class = 'fw-bold fs-3 text-center'>Manage</p>
    </div>";

    if(substr($adminloginlevel11, -10, 1) == 1) { $mnumngprojectssel = "checked"; } else { $mnumngprojectssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumngprojects\" $mnumngprojectssel id=\"mnumngprojects\">";
    echo "<label class=\"form-check-label\" for=\"mnumngprojects\">Manage Projects</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -8, 1) == 1) { $mnumngpersonnelsel = "checked"; } else { $mnumngpersonnelsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumngpersonnel\" $mnumngpersonnelsel id=\"mnumngpersonnel\">";
    echo "<label class=\"form-check-label\" for=\"mnumngpersonnel\">Manage Personnel</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -12, 1) == 1) { $mnumngbusinesssel = "checked"; } else { $mnumngbusinesssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumngbusiness\" $mnumngbusinesssel id=\"mnumngbusiness\">";
    echo "<label class=\"form-check-label\" for=\"mnumngbusiness\">Business Contacts</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -18, 1) == 1) { $mnumngacctgmodulessel = "checked"; } else { $mnumngacctgmodulessel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumngacctgmodules\" $mnumngacctgmodulessel id=\"mnumngacctgmodules\">";
    echo "<label class=\"form-check-label\" for=\"mnumngacctgmodules\">Accounting Modules</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -21, 1) == 1) { $mnumnghrmodulesel = "checked"; } else { $mnumnghrmodulesel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumnghrmodules\" $mnumnghrmodulesel id=\"mnumnghrmodules\">";
    echo "<label class=\"form-check-label\" for=\"mnumnghrmodules\">Manage HR Modules</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -24, 1) == 1) { $mnumngcategsel = "checked"; } else { $mnumngcategsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumngcateg\" $mnumngcategsel id=\"mnumngcateg\">";
    echo "<label class=\"form-check-label\" for=\"mnumngcateg\">Manage Categories</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -28, 1) == 1) { $mnumngschedsel = "checked"; } else { $mnumngschedsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnumngsched\" $mnumngschedsel id=\"mnumngsched\">";
    echo "<label class=\"form-check-label\" for=\"mnumngsched\">Scheduler</label>";
    echo "</div>";
    


    ?>

</div>
</div>


<div class="col-lg-3 col-md-6 col-sm-12">
<div class = 'border rounded-3 p-4 m-2 h-100'>
<?php
    echo "<div class = 'border-bottom px-2 mb-3'>
    <p class = 'fw-bold fs-3 text-center'>Tools</p>
    </div>";
    
    if(substr($adminloginlevel11, -2, 1) == 1) { $mnutoolschgpasssel = "checked"; } else { $mnutoolschgpasssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnutoolschgpass\" $mnutoolschgpasssel id=\"mnutoolschgpass\">";
    echo "<label class=\"form-check-label\" for=\"mnutoolschgpass\">Change Password</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -1, 1) == 1) { $mnutoolsviewlogssel = "checked"; } else { $mnutoolsviewlogssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnutoolsviewlogs\" $mnutoolsviewlogssel id=\"mnutoolsviewlogs\">";
    echo "<label class=\"form-check-label\" for=\"mnutoolsviewlogs\">View Logs</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -16, 1) == 1) { $mnutoolssysadsel = "checked"; } else { $mnutoolssysadsel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnutoolssysad\" $mnutoolssysadsel id=\"mnutoolssysad\">";
    echo "<label class=\"form-check-label\" for=\"mnutoolssysad\">SysAd Tools</label>";
    echo "</div>";
    
    if(substr($adminloginlevel11, -19, 1) == 1) { $mnutoolsmnguserssel = "checked"; } else { $mnutoolsmnguserssel = ""; }
    echo "<div class=\"form-check\">";
    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"mnutoolsmngusers\" $mnutoolsmnguserssel id=\"mnutoolsmngusers\">";
    echo "<label class=\"form-check-label\" for=\"mnutoolsmngusers\">Manage Users</label>";
    echo "</div>";
    
    ?>
</div>
</div>


</div> <!-- row --->
<?php

    echo "<div class = 'text-end mt-5'>
    <a href=\"mngadmusers.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a>
    <button type=\"button\" class = 'btn mainbtnclr rounded-3 text-white' value=\"Save\" data-toggle='modal' data-target='#confirmModal'>Save</button>
    </div></form>";
  
    echo "<div class='modal fade' id='confirmModal' tabindex='-1' role='dialog' aria-labelledby='confirmModalLabel' aria-hidden='true'>";
    echo "<div class='modal-dialog' role='document'>";
    echo "<div class='modal-content'>";
    echo "<div class='modal-header'>";
    echo "<h5 class='modal-title' id='confirmModalLabel'>Confirm Save</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    echo "</div>";
    echo "<div class='modal-body'>";
    echo "Are you sure you want to save these changes?";
    echo "</div>";
    echo "<div class='modal-footer'>";
    echo "<button type='button' class='btn btn-danger' data-dismiss='modal'>No</button>";
    echo "<button type='button' class='btn btn-success' id='confirmSave'>Yes</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    
    echo "<script>
    document.getElementById('confirmSave').addEventListener('click', function() {
        document.getElementById('saveForm').submit();
    });
    </script>";

  }
   

// end contents here
?>
</div>

<?php
     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
		$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
