<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$acctspayableid0 = (isset($_GET['apid'])) ? $_GET['apid'] :'';
$apnumber0 = trim((isset($_GET['apn'])) ? $_GET['apn'] :'');
$apnumber0 = htmlentities(stripslashes($apnumber0));
// 20250502
$appayee0 = (isset($_GET['appayee'])) ? $_GET['appayee'] :'';
$duedate0 = (isset($_GET['duedate'])) ? $_GET['duedate'] :'';

$apdate = (isset($_POST['apdate'])) ? $_POST['apdate'] :'';
$apnumber = trim((isset($_POST['apnumber'])) ? $_POST['apnumber'] :'');
$apnumber = htmlentities(stripslashes($apnumber));
$payeesw = (isset($_POST['payeesw'])) ? $_POST['payeesw'] :'';
$appayee = (isset($_POST['appayee'])) ? $_POST['appayee'] :'';
$apcompid = (isset($_POST['apcompid'])) ? $_POST['apcompid'] :'';
$payeecontactid = (isset($_POST['payeecontactid'])) ? $_POST['payeecontactid'] :'';
$explanation = trim((isset($_POST['explanation'])) ? $_POST['explanation'] :'');
$explanation = htmlentities(stripslashes($explanation));
$duedate = date('Y-m-d', strtotime((isset($_POST['duedate'])) ? $_POST['duedate'] :''));

if($apnumber0!="") {
	$apnumber=$apnumber0;
} //if
if($appayee0!="") {
	$appayee=$appayee0;
} //if
if($duedate0!="") {
	$duedate=$duedate0;
} //if

$apcompanyidfin=0; $apcontactidfin=0;

if($payeesw!='') {
	if($payeesw=='company') {
		if($apcompid!='') {
			$apcompanyidfin=$apcompid;
			$apcontactidfin=0;
		} elseif($payeecontactid!='') {
			$apcontactidfin=$payeecontactid;
			$apcompanyidfin=0;
		}
	} elseif($payeesw=='contactperson') {
		if($payeecontactid!='') {
			$apcontactidfin=$payeecontactid;
			$apcompanyidfin=0;
		} elseif($apcompid!='') {
			$apcompanyidfin=$apcompid;
			$apcontactidfin=0;
		}
	}
}

$companyidfin=$apcompanyidfin;
$contactidfin=$apcontactidfin;
include './finvouchlucompcontids.php';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" border=\"0\">";
      echo "<tr><th colspan=\"2\">Accounts Payable Voucher - Add new entry</th></tr>";

// choose default glcode version
    $res20query=""; $result20=""; $found20=0; $ctr20=0;
	$res20query="SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"";
	$result20=$dbh2->query($res20query);
	if($result20->num_rows>0) {
		while($myrow20=$result20->fetch_assoc()) {
  $version20 = $myrow20['version'];		
		} //while
	} //if

      if($version20 == 1) { $dynselglcode="20.10.208"; }
      else if($version20 == 2) { $dynselglcode="20.10.210"; }

// define approvers 2022014
  $res21query=""; $result21=""; $found21=0;
  $res21query="SELECT iditsupportapprover, approver1empid, approver2empid, approver3empid FROM tblitsupportapprover WHERE deptcd='FIN'";
  $result21=$dbh2->query($res21query);
  if($result21->num_rows>0) {
    while($myrow21=$result21->fetch_assoc()) {
    $found21=1;
    $iditsupportapprover21 = $myrow21['iditsupportapprover'];
    $approver1empid21 = $myrow21['approver1empid'];
    $approver2empid21 = $myrow21['approver2empid'];
	$approver3empid21 = $myrow21['approver3empid'];
    } //while
  } //if

//
if($apnumber0 != '') {
//

    $res15query=""; $result15=""; $found15=0; $ctr15=0;
	$res15query="SELECT acctspayablenumber, payee, due_date, date, company_id, contact_id FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber0\"";
	$result15=$dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
			$found15=1; $ctr15++;
    $acctspayablenumber15 = $myrow15['acctspayablenumber'];
    $appayee15 = $myrow15['payee'];
    $apdate15 = $myrow15['date'];
    $apduedate15 = $myrow15['due_date'];
	$companyid15 = $myrow15['company_id'];
	$contactid15 = $myrow15['contact_id'];
	
	if($companyid15!=0) {
		//query tblcompany
		$res15bqry=""; $result15b=""; $found15b=0; $ctr15b=0;
		$res15bqry="SELECT company, branch FROM tblcompany WHERE companyid=$companyid15";
		$result15b=$dbh2->query($res15bqry);
		if($result15b->num_rows>0) {
			while($myrow15b=$result15b->fetch_assoc()) {
				$found15b=1;
				$ctr15b++;
				$companyname15b = $myrow15b['company'];
				$companybranch15b = $myrow15b['branch'];
				if($companybranch15b!='') {
					$payeefin = $companyname15b . " - " . $companybranch15b;
				} else {
					$payeefin = $companyname15b;
				}
			} //while
		} //if
	} elseif($contactid15!=0) {
		// query tblcontact
		$res15cqry=""; $result15c=""; $found15c=0; $ctr15c=0;
		$res15cqry="SELECT name_last, name_first, name_middle, employeeid FROM tblcontact WHERE contactid=$contactid15";
		$result15c=$dbh2->query($res15cqry);
		if($result15c->num_rows>0) {
			while($myrow15c=$result15c->fetch_assoc()) {
				$found15c=1;
				$ctr15c++;
				$name_last15c = $myrow15c['name_last'];
				$name_first15c = $myrow15c['name_first'];
				$name_middle15c = $myrow15c['name_middle'];
				$employeeid15c = $myrow15c['employeeid'];
				if($name_middle15c!='') {
					$payeefin = $name_first15c . " " . $name_middle15c[0] . ". " . $name_last15c;
				} else {
					$payeefin = $name_first15c . " " . $name_last15c;					
				}
			} //while
		} //if
	} //if-else	
		} //while
	} //if

    $res16query=""; $result16=""; $found16=0; $ctr16=0;
	$res16query="SELECT acctspayabletotid, acctspayablenumber, date, explanation, debittot, credittot, filepath, filename FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber0\"";
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
			$found16=1; $ctr16++;
    $acctspayabletotid16 = $myrow16['acctspayabletotid'];
    $acctspayablenumber16 = $myrow16['acctspayablenumber'];
    $date16 = $myrow16['date'];
    $explanation16 = $myrow16['explanation'];
    $debittot16 = $myrow16['debittot'];
    $credittot16 = $myrow16['credittot'];
	$filepath16 = $myrow16['filepath'];
	$filename16 = $myrow16['filename'];
			
		} //while
	} //if

//    echo "<form action=\"finvouchapadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">";
    // echo "<tr><td>dsadsaf: ".$apduedate15."</td></tr>";
    echo "<tr><td>Date:&nbsp;<strong><input class=\"form-control\" name=\"apdate\" value=\"".date('Y-M-d', strtotime($apdate15))."\" /></strong>";
	if($accesslevel >= 4 && $accesslevel <= 5) {
	echo "<i><a href=\"finvouchapvchgdt.php?loginid=$loginid&apvn=$apnumber0&apvdt=$apdate15\" class='btn btn-primary' role='button'>Change</a></i>";		
	} //if
	echo "</td><td>APV No.:&nbsp;<strong><input class=\"form-control\" name=\"apnumber\" value=\"$acctspayablenumber15\" readonly></strong>";
	if($accesslevel >= 4 && $accesslevel <= 5) {
	echo "<i><a href=\"finvouchapvchgnum.php?loginid=$loginid&apvn=$apnumber0&apvdt=$apdate15\" class='btn btn-primary' role='button'>Change</a></i>";		
	} //if
	echo "</td>";
    echo "</tr>";
    echo "<tr><td>Payee";
	// echo "vartest cmpid:$companyid15,cntid:$contactid15,f15b:$found15b,f15c:$found15c";
	if($companyid15==0 && $contactid15==0) {
		echo ":&nbsp;$appayee15";
	} //if
	echo "<br><strong><input class=\"form-control\" name=\"appayee\" value=\"$payeefin\" /></strong>";
	if($accesslevel >= 4 && $accesslevel <= 5) {
	echo "<i><a href=\"finvouchapvchgpayee.php?loginid=$loginid&apvn=$apnumber0&apvdt=$apdate15\" class='btn btn-primary' role='button'>Change</a></i>";
	} //if
	echo "</td>";
	echo "<input type=\"hidden\" name=\"apcompanyid\" value=\"$companyid15\" />";
	echo "<input type=\"hidden\" name=\"apcontactid\" value=\"$contactid15\" />";
    echo "<td>Due Date:<br><strong><input class=\"form-control\" type='text' name=\"apduedate\" value=\"".date('Y-M-d', strtotime($apduedate15))."\" /></strong>";
	if($accesslevel >= 4 && $accesslevel <= 5) {
	echo "<i><a href=\"finvouchapvchgduedt.php?loginid=$loginid&apvn=$apnumber0&apvddt=$apduedate15\" class='btn btn-primary' role='button'>Change</a></i>";		
	} //if
	echo "</td></tr>";

    echo "<tr><td colspan=\"2\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td><td colspan=\"2\">Action</td></tr>";

    $res17query=""; $result17=""; $found17=0; $ctr17=0;
    $res17query="SELECT acctspayableid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber0\" ORDER BY acctspayableid ASC";
    $result17=$dbh2->query($res17query);
    if($result17->num_rows>0) {
        while($myrow17=$result17->fetch_assoc()) {
  $found17=1; $ctr17++;
  $acctspayableid17 = $myrow17['acctspayableid'];
  $glcode17 = $myrow17['glcode'];
  $glrefver17 = $myrow17['glrefver'];
  $glnamedetails17 = $myrow17['glnamedetails'];
  $projcode17 = $myrow17['projcode'];
  $particulars17 = $myrow17['particulars'];
  $debitamt17 = $myrow17['debitamt'];
  $creditamt17 = $myrow17['creditamt'];

    $res18query=""; $result18=""; $found18=0; $ctr18=0;
  $resquery="SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17";
    $result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
    $found18 = 1;
    $glname18 = $myrow18['glname'];			
		} //while
	} //if

  echo "<tr><td>$glcode17</td>";
  echo "<td>$projcode17</td>";
  echo "<td>$particulars17</td><td align=\"right\">".number_format($debitamt17, 2)."</td><td align=\"right\">".number_format($creditamt17, 2)."</td>";
  echo "<td><a href=\"finvouchappartdel.php?loginid=$loginid&apid=$acctspayableid17&apn=$acctspayablenumber15\" class=\"btn btn-danger btn-sm\" role=\"button\" />Del</a></td>";
  echo "<td><a href=\"finvouchapvpartedit.php?loginid=$loginid&apid=$acctspayableid17&apn=$apnumber0\" class=\"btn btn-warning btn-sm\" role=\"button\" />Edit</a></td>";
  echo "</tr>";			
		} //while
    } //if

      echo "<tr><td colspan=\"2\">&nbsp;</td><td align=\"right\"><strong>TOTAL</strong></td><td align=\"right\">";
    if(round($debittot16,2)==round($credittot16,2)) {
	  echo "<strong style='color:green'>".number_format($debittot16, 2)."";
	  echo "</strong></td><td align=\"right\"><strong style='color:green'>";
	  echo "".number_format($credittot16, 2)."</strong>";		
	} else {
	  echo "<strong style='color:red'>".number_format($debittot16, 2)."";
	  echo "</strong></td><td align=\"right\"><strong style='color:red'>";
	  echo "".number_format($credittot16, 2)."</strong>";
	}
	  echo "</td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea class=\"form-control\" rows=\"4\" name=\"explanation\">$explanation16</textarea><i><a href=\"finvouchapchgexpla.php?loginid=$loginid&apvn=$apnumber0&apvdt=$apdate15\" class='btn btn-primary' role='button'>Change</a></i></td></tr>";

	//
	// 20250430 file upload facility
	echo "<tr><td colspan='2'>File attachment&nbsp;";
    if($filename16 != "") {
    echo "<a href=\"$filepath16/$filename16\" target=\"_blank\">$filename16</a>&nbsp;&nbsp;&nbsp;<i><a href=\"finvouchapvdelfile.php?loginid=$loginid&aptid=$acctspayabletotid16&apvn=$apnumber0\">Remove</a></i><br>";    
	} else {
	echo "<form enctype=\"multipart/form-data\" action=\"finvouchapvfileupload.php?loginid=$loginid&aptid=$acctspayabletotid16\" method=\"POST\" name=\"finvouchapvfileupload\">";
	echo "<input type=\"hidden\" name=\"acctspayabletotid\" value=\"$acctspayabletotid16\">";
	echo "<input type=\"hidden\" name=\"acctspayablenumber\" value=\"$acctspayablenumber16\">";
    echo "<input class = 'form-control'  placeholder ='00.00' type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />";
    echo "<input class = 'form-control'  placeholder ='00.00' name=\"uploadedfile\" type=\"file\" />";		
	echo "<button type='submit' class='btn btn-primary' name='btnAPVfileupload' value=1>Save uploaded file</button>";		
	echo "</form>";
	} // if($filename16 != "")
	echo "</td></tr>";

    echo "<form action=\"finvouchapadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">"; //fr line:165
	// include input fields fr above after moving the form
	echo "<input type=\"hidden\" name=\"apdate\" value=\"$apdate15\" />";
	echo "<input type=\"hidden\" name=\"apnumber\" value=\"$acctspayablenumber15\" />";
	echo "<input type=\"hidden\" name=\"appayee\" value=\"$payeefin\" />";
	echo "<input type=\"hidden\" name=\"apcompanyid\" value=\"$companyid15\" />";
	echo "<input type=\"hidden\" name=\"apcontactid\" value=\"$contactid15\" />";
	echo "<input type=\"hidden\" name=\"apduedate\" value=\"$apduedate15\" />";
	echo "<input type=\"hidden\" name=\"explanation\" value=\"$explanation16\" />";
	
    echo "<tr><th colspan=\"2\">Add new particulars</th></tr>";
    echo "<tr><td colspan=\"2\">Acct Code<br>";
    echo "<select class=\"form-control\" name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
    $res12query=""; $result12=""; $found12=0; $ctr12=0;
    $res12query="SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 ORDER BY glcode ASC";
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
			$found12=1; $ctr12++;
      $glcode12 = $myrow12['glcode'];
      $glname12 = $myrow12['glname'];
      echo "<option value=\"$glcode12\">$glcode12 - $glname12</option>";			
		} //while
	} //if
    echo "</select><br>";

    //
    // dynamic pulldown
    //

    echo "<div id=myDynamicPullDown>";

    echo "</div>";

    echo "<input class=\"form-control\" name=\"aepglcode\" type=\"Hidden\">";

    echo "Add'l.Details&nbsp;<input placeholder=\"additional details\" class=\"form-control\" name=\"glnamedetails\" size=\"35\">";
    echo "</td></tr>";

    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">Project Code<br>";
    echo "<select class=\"form-control\" name=\"projcode\">";
    echo "<option value=\"-\">-</option>";

    $res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY date_start DESC";
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
			$found14=1; $ctr14++;
      $projectid14 = $myrow14['projectid'];
      $proj_code14 = $myrow14['proj_code'];
      $proj_fname14 = $myrow14['proj_fname'];
      $proj_sname14 = $myrow14['proj_sname'];
      $proj_fname142 = substr("$proj_fname14", 0, 47); 
      if($proj_sname14 <> '') { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_sname14</option>"; }
      else
      { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_fname142</option>"; }

		} //while
	} //if

    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">Particulars<br>";
    echo "<textarea class=\"form-control\" rows=\"3\" name=\"particulars\"></textarea></td></tr>";
    echo "<tr><td>Debit Amount<br><input class=\"form-control\" type=\"number\" step=\"any\" name=\"debitamt\" value=\"0.00\" /></td>";
    echo "<td>Credit Amount<br><input class=\"form-control\" type=\"number\" step=\"any\" name=\"creditamt\" value=\"0.00\" /></td></tr>";
    echo "<tr><td>";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">";
      echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr align=\"center\"><td><button type=\"submit\" class=\"btn btn-success\">Add new item</button></form></td>";

    if(($accesslevel >= 4 && $accesslevel <= 5) && (($employeeid0 == $approver1empid21 || $employeeid0 == $approver2empid21)))
    {
      echo "<td><form action=\"finvouchapaddfin.php?loginid=$loginid&apn=$apnumber0\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Finalize AP\" class=\"btn btn-primary\" role=\"button\" /></form></td>";

      echo "<td><form action=\"finvouchapcancel.php?loginid=$loginid&apn=$apnumber0\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Cancel AP\" class=\"btn btn-danger\" role=\"button\" /></form></td>";
    }
      echo "</tr></table>";
    echo "</td></tr>";
    echo "</form>";
	
//
} else if($apnumber == '' || $appayee == '') {
//
	
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, AP Number &/or Payee should not be blank. Please try again.</font></td></tr>";

//
} else {
//

    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT acctspayablenumber FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber\"";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1; $ctr11++;
    $acctspayablenumber11 = $myrow11['acctspayablenumber'];			
		} //while
	} //if
  
  if($found11 == 1) {

    echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Warning: A.P. Number:$acctspayablenumber11</b> already used. Please try again.</font></td></tr>";

  } else {

    echo "<form action=\"finvouchapadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">";
    echo "<tr><td>Date:&nbsp;<strong><input placeholder=\"APV date\" class=\"form-control\" name=\"apdate\" value=\"".date('Y-M-d', strtotime($apdate))."\" readonly></strong></td><td>AP No.:&nbsp;<strong><input placeholder=\"APV No.\" class=\"form-control\" name=\"apnumber\" value=\"$apnumber\" readonly></strong></td></tr>";
    echo "<tr><td>Payee";
	// echo "tst-sw:$payeesw,compid:$apcompid|$apcompanyidfin,contid:$payeecontactid|$apcontactidfin";
	echo "<br><strong><input placeholder=\"payee\" class=\"form-control\" name=\"appayee\" value=\"$payeefin\" readonly></strong></td>";
	echo "<input type=\"hidden\" name=\"apcompanyid\" value=\"$apcompanyidfin\" />";
	echo "<input type=\"hidden\" name=\"apcontactid\" value=\"$apcontactidfin\" />";
    echo "<td>Due Date:<br><strong><input type='text' class=\"form-control\" name=\"apduedate\" value=\"".date('Y-M-d', strtotime($duedate))."\" readonly></strong> </td>";
    echo "</tr>";
    echo "<tr><td colspan=\"2\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td><td colspan=\"2\">Action</td></tr>";

    $res17query=""; $result17=""; $found17=0; $ctr17=0;
    $res17query="SELECT acctspayableid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber\" ORDER BY acctspayableid ASC";
	$result17=$dbh2->query($res17query);
	if($result17->num_rows>0) {
		while($myrow17=$result17->fetch_assoc()) {
  $found17 = 1; $ctr17++;
  $acctspayableid17 = $myrow17['acctspayableid'];
  $glcode17 = $myrow17['glcode'];
  $glrefver17 = $myrow17['glrefver'];
  $glnamedetails17 = $myrow17['glnamedetails'];
  $projcode17 = $myrow17['projcode'];
  $particulars17 = $myrow17['particulars'];
  $debitamt17 = $myrow17['debitamt'];
  $creditamt17 = $myrow17['creditamt'];

    $res18query=""; $result18=""; $found18=0; $ctr18=0;
    $res18query="SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17";
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
    $found18 = 1;
    $glname18 = $myrow18['glname'];			
		} //while
	} //if

  echo "<tr><td>$glcode17</td>";
  echo "<td>$projcode17</td>";
  echo "<td>$particulars17</td><td align=\"right\">$debitamt17</td><td align=\"right\">$creditamt17</td>";
  echo "<td><a href=\"finvouchappartdel.php?loginid=$loginid&apid=$acctspayableid17&apn=$apnumber\">Del</a></td>";
//  echo "<td><a href=\"finvouchappartedit.php?loginid=$loginid&apid=$acctspayableid17&apn=$cvnumber\">Edit</a></td>";
  echo "</tr>";
		
		} //while
	} //if

    $res16query=""; $result16=""; $found16=0; $ctr16=0;
    $res16query="SELECT acctspayabletotid, acctspayablenumber, date, explanation, debittot, credittot FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\"";
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
    $found16 = 1;
    $acctspayabletotid16 = $myrow16['acctspayabletotid'];
    $acctspayablenumber16 = $myrow16['acctspayablenumber'];
    $date16 = $myrow16['date'];
    $explanation16 = $myrow16['explanation'];
    $debittot16 = $myrow16['debittot'];
    $credittot16 = $myrow16['credittot'];
			
		} //while
	} //if

      echo "<tr><td colspan=\"2\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>$debittot16</b></td><td align=\"right\"><b>$credittot16</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea class=\"form-control\" rows=\"4\" name=\"explanation\">$explanation</textarea><font size=\"1\"><i><a href=\"finvouchapchgexpla.php?loginid=$loginid&apvn=$apnumber&apvdt=$apdate\">Change</a></i></font></td></tr>";
    echo "<tr><th colspan=\"2\">Add new particulars</th></tr>";
    echo "<tr><td colspan=\"2\">Acct Code<br>";
    echo "<select class=\"form-control\" name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
    $res12query=""; $result12=""; $found12=0; $ctr12=0;
    $res12query="SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 ORDER BY glcode ASC";
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
			$found12=1; $ctr12++;
      $glcode12 = $myrow12['glcode'];
      $glname12 = $myrow12['glname'];
      echo "<option value=\"$glcode12\">$glcode12 - $glname12</option>";
			
		} //while
	} //if
    echo "</select><br>";

    //
    // dynamic pulldown
    //

    echo "<div id=myDynamicPullDown>";

    echo "</div>";

    echo "<input name=\"aepglcode\" type=\"Hidden\">";

    echo "Add'l.Details&nbsp;<input placeholder=\"additional details\" class=\"form-control\" name=\"glnamedetails\">";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">Project Code<br>";
    echo "<select class=\"form-control\" name=\"projcode\">";
    echo "<option value=\"-\">-</option>";

	$res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY date_start DESC";
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
      $projectid14 = $myrow14['projectid'];
      $proj_code14 = $myrow14['proj_code'];
      $proj_fname14 = $myrow14['proj_fname'];
      $proj_sname14 = $myrow14['proj_sname'];
      $proj_fname142 = substr("$proj_fname14", 0, 47); 
      if($proj_sname14 <> '') { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_sname14</option>"; }
      else
      { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_fname142</option>"; }
  
		} //while
	} //if

    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">Particulars<br>";
    echo "<textarea placeholder=\"details, particulars or explanation\" class=\"form-control\" rows=\"3\" name=\"particulars\"></textarea></td></tr>";
    echo "<tr><td>Debit Amount<br><input placeholder=\"debit amount\" class=\"form-control\" type=\"number\" step=\"any\" name=\"debitamt\" value=\"0.00\" /></td>";
    echo "<td>Credit Amount<br><input placeholder=\"credit amount\" class=\"form-control\" type=\"number\" step=\"any\" name=\"creditamt\" value=\"0.00\" /></td></tr>";
    echo "<tr><td>";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\" align=\"center\">";
      echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr align=\"center\"><td><input type=\"submit\" value=\"Add new entry\" class=\"btn btn-success\" role=\"button\" /></form></td>";

    if(($accesslevel >= 4 && $accesslevel <= 5) && (($employeeid0 == $approver1empid21 || $employeeid0 == $approver2empid21)))
    {
      echo "<td><form action=\"finvouchapaddfin.php?loginid=$loginid&apn=$apnumber0\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Finalize AP\" class=\"btn btn-primary\" role=\"button\" /></form></td>";

      echo "<td><form action=\"finvouchapcancel.php?loginid=$loginid&apn=$apnumber0\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Cancel AP\" class=\"btn btn-danger\" role=\"button\" /></form></td>";
    }
      echo "</tr></table>";
    echo "</td></tr>";

    echo "</form>";
  }
}
      echo "</table>";

    echo "<br><p><a href=\"finvouchlist.php?loginid=$loginid&rs=ap\" class=\"btn btn-default\" role=\"button\" />Back</a></p>";

// end contents here

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

?>

<script language="javascript">

// This function goes through the options for the given
// drop down box and removes them in preparation for
// a new set of values

function emptyList( box ) {
  // Set each option to null thus removing it
  while ( box.options.length ) box.options[0] = null;
}

// This function assigns new drop down options to the given
// drop down box from the list of lists specified

function fillList( box, arr ) {
  // arr[0] holds the display text
  // arr[1] are the values

  for ( i = 0; i < arr[0].length; i++ ) {

    // Create a new drop down option with the
    // display text and value from arr

    option = new Option( arr[0][i], arr[1][i] );

    // Add to the end of the existing options

    box.options[box.length] = option;
  }

  // Preselect option 0

  box.selectedIndex=0;
}

// This function performs a drop down list option change by first
// emptying the existing option list and then assigning a new set

function changeList( box ) {
  // Isolate the appropriate list by using the value
  // of the currently selected option

  list = lists[box.options[box.selectedIndex].value];

  // Next empty the slave list

  emptyList( box.form.slave );

  // Then assign the new list values

  fillList( box.form.slave, list );
}

//
// dynamic pulldown
//

function dynamicpulldown()
{
    var htmlStr = "";

    var selectedGlCode = document.getElementById('myGlCode').value;

//    alert(selectedGlCode);

    if(selectedGlCode == '<?=$dynselglcode?>')
    {
         htmlStr = htmlStr + "<select class=\"form-control\" id=\"aepglcodelist\" onclick=\"getSelected()\">";

         <?php
         $resquery="SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 AND glcode >= '60.00.00' AND glcode <= '70.80.199' ORDER BY glcode ASC";
		 $result=$dbh2->query($resquery);
   ?>
    htmlStr = htmlStr + "<option value=\"-\">-</option>";
   <?php
        if($result->num_rows>0) {
		   while($myrow=$result->fetch_assoc()) {
             $glcode = $myrow['glcode'];
             $glname = $myrow['glname'];
             ?>
                  htmlStr = htmlStr + "<option value=\"<?=$glcode?>\"><?=$glcode?> - <?=$glname?></option>";
             <?php
			   
		   } //while
        } //if
         ?>

         htmlStr = htmlStr + "</select>";
    }

    document.getElementById('myDynamicPullDown').innerHTML = htmlStr;
}

function getSelected()
{
     document.myForm.aepglcode.value = document.getElementById('aepglcodelist').value;
}

</script>

<?php
// mysql_close($dbh);
$dbh2->close();
?>
