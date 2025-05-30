<?php 
// session
session_start();
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$adminloginid = (isset($_GET['admlid'])) ? $_GET['admlid'] :'';
// $adminloginid11 = (isset($_GET['admid'])) ? $_GET['admid'] :'';

$adminuid = (isset($_POST['adminuid'])) ? $_POST['adminuid'] :'';
$accesslevel0 = (isset($_POST['accesslevel'])) ? $_POST['accesslevel'] :'';

if((isset($_POST['mnumodfinreports'])) ? $_POST['mnumodfinreports'] :'' == 'on') { $mnumodfinreports = 1; } else if((isset($_POST['mnumodfinreports'])) ? $_POST['mnumodfinreports'] :'' == '') { $mnumodfinreports = 0; }
if((isset($_POST['mnutoolsmngusers'])) ? $_POST['mnutoolsmngusers'] :'' == 'on') { $mnutoolsmngusers = 1; } else if((isset($_POST['mnutoolsmngusers'])) ? $_POST['mnutoolsmngusers'] :'' == '') { $mnutoolsmngusers = 0; }
if((isset($_POST['mnumngacctgmodules'])) ? $_POST['mnumngacctgmodules'] :'' == 'on') { $mnumngacctgmodules = 1; } else if((isset($_POST['mnumngacctgmodules'])) ? $_POST['mnumngacctgmodules'] :'' == '') { $mnumngacctgmodules = 0; }
if((isset($_POST['mnumodvoucher'])) ? $_POST['mnumodvoucher'] :'' == 'on') { $mnumodvoucher = 1; } else if((isset($_POST['mnumodvoucher'])) ? $_POST['mnumodvoucher'] :'' == '') { $mnumodvoucher = 0; }
if((isset($_POST['mnutoolssysad'])) ? $_POST['mnutoolssysad'] :'' == 'on') { $mnutoolssysad = 1; } else if((isset($_POST['mnutoolssysad'])) ? $_POST['mnutoolssysad'] :'' == '') { $mnutoolssysad = 0; }
if((isset($_POST['mnumodhrreports'])) ? $_POST['mnumodhrreports'] :'' == 'on') { $mnumodhrreports = 1; } else if((isset($_POST['mnumodhrreports'])) ? $_POST['mnumodhrreports'] :'' == '') { $mnumodhrreports = 0; }
if((isset($_POST['mnumodsexpiringcontracts'])) ? $_POST['mnumodsexpiringcontracts'] :'' == 'on') { $mnumodsexpiringcontracts = 1; } else if((isset($_POST['mnumodsexpiringcontracts'])) ? $_POST['mnumodsexpiringcontracts'] :'' == '') { $mnumodsexpiringcontracts = 0; }
if((isset($_POST['mnumodspprojassign'])) ? $_POST['mnumodspprojassign'] :'' == 'on') { $mnumodspprojassign = 1; } else if((isset($_POST['mnumodspprojassign'])) ? $_POST['mnumodspprojassign'] :'' == '') { $mnumodspprojassign = 0; }
if((isset($_POST['mnumngbusiness'])) ? $_POST['mnumngbusiness'] :'' == 'on') { $mnumngbusiness = 1; } else if((isset($_POST['mnumngbusiness'])) ? $_POST['mnumngbusiness'] :'' == '') { $mnumngbusiness = 0; }
if((isset($_POST['mnudirprojects'])) ? $_POST['mnudirprojects'] :'' == 'on') { $mnudirprojects = 1; } else if((isset($_POST['mnudirprojects'])) ? $_POST['mnudirprojects'] :'' == '') { $mnudirprojects = 0; }
if((isset($_POST['mnumngprojects'])) ? $_POST['mnumngprojects'] :'' == 'on') { $mnumngprojects = 1; } else if((isset($_POST['mnumngprojects'])) ? $_POST['mnumngprojects'] :'' == '') { $mnumngprojects = 0; }
if((isset($_POST['mnudirpersonnel'])) ? $_POST['mnudirpersonnel'] :'' == 'on') { $mnudirpersonnel = 1; } else if((isset($_POST['mnudirpersonnel'])) ? $_POST['mnudirpersonnel'] :'' == '') { $mnudirpersonnel = 0; }
if((isset($_POST['mnumngpersonnel'])) ? $_POST['mnumngpersonnel'] :'' == 'on') { $mnumngpersonnel = 1; } else if((isset($_POST['mnumngpersonnel'])) ? $_POST['mnumngpersonnel'] :'' == '') { $mnumngpersonnel = 0; }
if((isset($_POST['mnudirbusiness'])) ? $_POST['mnudirbusiness'] :'' == 'on') { $mnudirbusiness = 1; } else if((isset($_POST['mnudirbusiness'])) ? $_POST['mnudirbusiness'] :'' == '') { $mnudirbusiness = 0; }
if((isset($_POST['mnumodcustpayroll'])) ? $_POST['mnumodcustpayroll'] :'' == 'on') { $mnumodcustpayroll = 1; } else if((isset($_POST['mnumodcustpayroll'])) ? $_POST['mnumodcustpayroll'] :'' == '') { $mnumodcustpayroll = 0; }
if((isset($_POST['mnumodemppayslip'])) ? $_POST['mnumodemppayslip'] :'' == 'on') { $mnumodemppayslip = 1; } else if((isset($_POST['mnumodemppayslip'])) ? $_POST['mnumodemppayslip'] :'' == '') { $mnumodemppayslip = 0; }
if((isset($_POST['mnumodcustpayadvisory'])) ? $_POST['mnumodcustpayadvisory'] :'' == 'on') { $mnumodcustpayadvisory = 1; } else if((isset($_POST['mnumodcustpayadvisory'])) ? $_POST['mnumodcustpayadvisory'] :'' == '') { $mnumodcustpayadvisory = 0; }
if((isset($_POST['mnumodsppaynotifier'])) ? $_POST['mnumodsppaynotifier'] :'' == 'on') { $mnumodsppaynotifier = 1; } else if((isset($_POST['mnumodsppaynotifier'])) ? $_POST['mnumodsppaynotifier'] :'' == '') { $mnumodsppaynotifier = 0; }
if((isset($_POST['mnutoolschgpass'])) ? $_POST['mnutoolschgpass'] :'' == 'on') { $mnutoolschgpass = 1; } else if((isset($_POST['mnutoolschgpass'])) ? $_POST['mnutoolschgpass'] :'' == '') { $mnutoolschgpass = 0; }
if((isset($_POST['mnutoolsviewlogs'])) ? $_POST['mnutoolsviewlogs'] :'' == 'on') { $mnutoolsviewlogs = 1; } else if((isset($_POST['mnutoolsviewlogs'])) ? $_POST['mnutoolsviewlogs'] :'' == '') { $mnutoolsviewlogs = 0; }
// new 20140306
// -21 hr modules
if((isset($_POST['mnumnghrmodules'])) ? $_POST['mnumnghrmodules'] :'' == 'on') { $mnumnghrmodules = 1; } else if((isset($_POST['mnumnghrmodules'])) ? $_POST['mnumnghrmodules'] :'' == '') { $mnumnghrmodules = 0; }
// -22 office time log
if((isset($_POST['mnumodhrtimelog'])) ? $_POST['mnumodhrtimelog'] :'' == 'on') { $mnumodhrtimelog = 1; } else if((isset($_POST['mnumodhrtimelog'])) ? $_POST['mnumodhrtimelog'] :'' == '') { $mnumodhrtimelog = 0; }
// -23 Directory > ISO Documents
if((isset($_POST['mnudirisodocs'])) ? $_POST['mnudirisodocs'] :'' == 'on') { $mnudirisodocs = 1; } else if((isset($_POST['mnudirisodocs'])) ? $_POST['mnudirisodocs'] :'' == '') { $mnudirisodocs = 0; }
// -24 Manage > Manage Categories
if((isset($_POST['mnumngcateg'])) ? $_POST['mnumngcateg'] :'' == 'on') { $mnumngcateg = 1; } else if((isset($_POST['mnumngcateg'])) ? $_POST['mnumngcateg'] :'' == '') { $mnumngcateg = 0; }
// -25 Modules > Documents Archiving
if((isset($_POST['mnumoddocsarchive'])) ? $_POST['mnumoddocsarchive'] :'' == 'on') { $mnumoddocsarchive = 1; } else if((isset($_POST['mnumoddocsarchive'])) ? $_POST['mnumoddocsarchive'] :'' == '') { $mnumoddocsarchive = 0; }
// update 20150407
// -26 Time & attendance
if((isset($_POST['mnumodhrtimeatt'])) ? $_POST['mnumodhrtimeatt'] :'' == 'on') { $mnumodhrtimeatt = 1; } else if((isset($_POST['mnumodhrtimeatt'])) ? $_POST['mnumodhrtimeatt'] :'' == '') { $mnumodhrtimeatt = 0; }
// -27 Payroll system
if((isset($_POST['mnumodfinpayrollsys'])) ? $_POST['mnumodfinpayrollsys'] :'' == 'on') { $mnumodfinpayrollsys = 1; } else if((isset($_POST['mnumodfinpayrollsys'])) ? $_POST['mnumodfinpayrollsys'] :'' == '') { $mnumodfinpayrollsys = 0; }
// -28 Manage Scheduler
if((isset($_POST['mnumngsched'])) ? $_POST['mnumngsched'] :'' == 'on') { $mnumngsched = 1; } else if((isset($_POST['mnumngsched'])) ? $_POST['mnumngsched'] :'' == '') { $mnumngsched = 0; }
// 20170809 add 1 item for it support request -29
// -29 IT Support Request 
if((isset($_POST['mnumoditsuppreq'])) ? $_POST['mnumoditsuppreq'] :'' == 'on') { $mnumoditsuppreq = 1; } else if((isset($_POST['mnumoditsuppreq'])) ? $_POST['mnumoditsuppreq'] :'' == '') { $mnumoditsuppreq = 0; }
// 20171023 (c/o tjmanalo)
// -30 Purchasing 
if((isset($_POST['mnumngpurch'])) ? $_POST['mnumngpurch'] :'' == 'on') { $mnumngpurch = "111"; } else if((isset($_POST['mnumngpurch'])) ? $_POST['mnumngpurch'] :'' == '') { $mnumngpurch = "000"; }
// 20190701
// -42 & -43 OT/Leave Request
if((isset($_POST['mnumodhrotlvreq'])) ? $_POST['mnumodhrotlvreq'] :'' == 'on') { $mnumodhrotlvreq = "11"; } else if((isset($_POST['mnumodhrotlvreq'])) ? $_POST['mnumodhrotlvreq'] :'' == '') { $mnumodhrotlvreq = "00"; }
// 20171023
// -41 Manage personnel requisition form
if((isset($_POST['mnumodhrpersreq'])) ? $_POST['mnumodhrpersreq'] :'' == 'on') { $mnumodhrpersreq = 1; } else if((isset($_POST['mnumodhrpersreq'])) ? $_POST['mnumodhrpersreq'] :'' == '') { $mnumodhrpersreq = 0; }
// 20181029
// -33 Module > Project Billing
if((isset($_POST['mnumodprojbilling'])) ? $_POST['mnumodprojbilling'] :'' == 'on') { $mnumodprojbilling = 1; } else if((isset($_POST['mnumodprojbilling'])) ? $_POST['mnumodprojbilling'] :'' == '') { $mnumodprojbilling = 0; }

// 20240412 redo manage meeting room scheduler
if((isset($_POST['mnudirmtgrmsched'])) ? $_POST['mnudirmtgrmsched'] :'' == 'on') { $mnudirmtgrmsched=1; } else if((isset($_POST['mnudirmtgrmsched'])) ? $_POST['mnudirmtgrmsched'] :'' == '') { $mnudirmtgrmsched=''; };

$adminloginlevel = "000000".$mnudirmtgrmsched.$mnumodhrotlvreq.$mnumodhrpersreq."0000000".$mnumodprojbilling.$mnumngpurch.$mnumoditsuppreq.$mnumngsched.$mnumodfinpayrollsys.$mnumodhrtimeatt.$mnumoddocsarchive.$mnumngcateg.$mnudirisodocs.$mnumodhrtimelog.$mnumnghrmodules.$mnumodfinreports.$mnutoolsmngusers.$mnumngacctgmodules.$mnumodvoucher.$mnutoolssysad.$mnumodhrreports.$mnumodsexpiringcontracts.$mnumodspprojassign.$mnumngbusiness.$mnudirprojects.$mnumngprojects.$mnudirpersonnel.$mnumngpersonnel.$mnudirbusiness.$mnumodcustpayroll.$mnumodemppayslip.$mnumodcustpayadvisory.$mnumodsppaynotifier.$mnutoolschgpass.$mnutoolsviewlogs;

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';

$defaultadminloginlevel = "00000000000000000000000000000000000000010101000010";

// 20190905
$deptscd1 = (isset($_POST['deptscd1'])) ? $_POST['deptscd1'] :'';
$deptscd2 = (isset($_POST['deptscd2'])) ? $_POST['deptscd2'] :'';
$deptscd3 = (isset($_POST['deptscd3'])) ? $_POST['deptscd3'] :'';

	if(is_array($deptscd1)) {
		$deptscdfin1='';
		foreach($deptscd1 as $val1 => $n1) {
			$deptscdfin1 = $deptscdfin1 . $deptscd1[$val1] . "|";
		}
	} else { // if($depts=='Array')
		$deptscdfin1 = $deptscd1;
	} // if($depts=='Array')

	if(is_array($deptscd2)) {
		$deptscdfin2='';
		foreach($deptscd2 as $val2 => $n2) {
			$deptscdfin2 = $deptscdfin2 . $deptscd2[$val2] . "|";
		}
	} else { // if($depts=='Array')
		$deptscdfin2 = $deptscd2;
	} // if($depts=='Array')

	if(is_array($deptscd3)) {
		$deptscdfin3='';
		foreach($deptscd3 as $val3 => $n3) {
			$deptscdfin3 = $deptscdfin3 . $deptscd3[$val3] . "|";
		}
	} else { // if($depts=='Array')
		$deptscdfin3 = $deptscd3;
	} // if($depts=='Array')

	$deptscdfin = $deptscdfin1 . $deptscdfin2 . $deptscdfin3;

//20211222 from newEmpId dropdown
$newempid = trim((isset($_POST['newempid'])) ? $_POST['newempid'] :'');

$found = 0;
$found11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

  if($accesslevel >= 4 && $accesslevel <= 5) {


    if($adminloginid != '' && $adminuid != '') {
      // update user settings into tbladminlogin
      $res14query = "UPDATE tbladminlogin SET adminuid=\"$adminuid\", adminloginlevel=\"$adminloginlevel\", accesslevel=$accesslevel0, deptscd=\"$deptscdfin\", employeeid=\"$newempid\" WHERE adminloginid=$adminloginid AND adminuid=\"$adminuid\"";
			$result14="";
			$result14=$dbh2->query($res14query);

        //20221021 update query for tblsysusracctmgt set employeeid=newempid
        $res18query=""; $result18=""; $found18=1;
        $res18query="SELECT idtblsysusracctmgt FROM tblsysusracctmgt WHERE admloginid=$adminloginid LIMIT 1";
        $result18=$dbh2->query($res18query);
        if($result18->num_rows>0) {
            while($myrow18=$result18->fetch_assoc()) {
            $found18=1;
            $idtblsysusracctmgt18 = $myrow18['idtblsysusracctmgt'];
            } //while
        } //if
        if($found18==1) {
            $res19query=""; $result19=""; $found19=0;
            $res19query="UPDATE tblsysusracctmgt SET employeeid=\"$newempid\" WHERE idtblsysusracctmgt=$idtblsysusracctmgt18";
            $result19=$dbh2->query($res19query);
        } //if

		$editmessage = "Success! id:$adminuid | loginlevel:$adminloginlevel | accesslevel:$accesslevel0 | dept:$deptscdfin";
		$_SESSION['editsuccess'] = $editmessage;

    //   echo "id:$adminuid<br>loginlevel:$adminloginlevel<br>accesslevel:$accesslevel0<br>dept:$deptscdfin</td></tr>";

      // create log
      $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
			$result16=""; $found16=0;
			$result16=$dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16=$result16->fetch_assoc()) {
				$found16=1;
				$adminuid16=$myrow16['adminuid'];
				} // 
			} // 
      $adminlogdetails = "$loginid:$adminloginuid - Edit admin user:$adminuid, stat:0, level:$adminloginlevel, accesslevel:$accesslevel";
      $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"";
			$result17="";
			$result17=$dbh2->query($res17query);
    } // if($adminloginid != '' && $adminuid != '')

  } // if($accesslevel >= 4 && $accesslevel <= 5)

  echo '<script>';
  echo 'window.location.href = "mngadmuseredit.php?loginid=' . $loginid . '&admid=' . $adminloginid . '";';
  echo '</script>';
	  exit; 


     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
