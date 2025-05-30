<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$crvnumber0 = trim((isset($_GET['crvn'])) ? $_GET['crvn'] :'');

// $crvdate = $_POST['yyyycrv']."-".$_POST['mmmcrv']."-".$_POST['ddcrv'];
$crvdate = trim((isset($_POST['crvdate'])) ? $_POST['crvdate'] :'');
$crvnumber = trim((isset($_POST['crvnumber'])) ? $_POST['crvnumber'] :'');
// $payor = trim($_POST['payor']);
$explanation = trim((isset($_POST['explanation'])) ? $_POST['explanation'] :'');

$payorsw = (isset($_POST['payorsw'])) ? $_POST['payorsw'] :'';
$payorcompanyid = (isset($_POST['payorcompanyid'])) ? $_POST['payorcompanyid'] :'';
$payorcontactid = (isset($_POST['payorcontactid'])) ? $_POST['payorcontactid'] :'';

// if($crvnumber == '') { $crvnumber = $crvnumber0; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" border=\"0\">";
      echo "<tr><th colspan=\"2\">Cash Receipt Voucher - Add new entry</th></tr>";

// get default version of glcode
    $res20query=""; $result20=""; $found20=0; $ctr20=0;
    $res20query="SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"";
	$result20=$dbh2->query($res20query);
	if($result20->num_rows>0) {
		while($myrow20=$result20->fetch_assoc()) {
			$found20=1; $ctr20++;
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

if($crvnumber0 != '') {
    $res15query=""; $result15=""; $found15=0; $ctr15=0;
    $res15query="SELECT cashreceiptnumber, payor, date, explanation, companyid, contactid, debitamt, creditamt FROM tblfincashreceipt WHERE cashreceiptnumber = \"$crvnumber0\"";
	$result15=$dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
    $found15 = 1; $ctr15++;
    $crvnumber15 = $myrow15['cashreceiptnumber'];
		$payor15 = $myrow15['payor'];
    $crvdate15 = $myrow15['date'];
    $explanation15 = $myrow15['explanation'];
		$companyid15 = $myrow15['companyid'];
		$contactid15 = $myrow15['contactid'];
		$debitamt15 = $myrow15['debitamt'];
		$creditamt15 = $myrow15['creditamt'];
		// $debitamttot = round($debitamttot+$debitamt15, 2);
		// $creditamttot = round($creditamttot+$creditamt15, 2);
		// reset vars
		// $debitamt15=0; $creditamt15=0;
		} //while
	} //if

    $res16query=""; $result16=""; $found16=0; $ctr16=0;
    $res16query="SELECT cashreceipttotid, cashreceiptnumber, date, explanation, debittot, credittot, filepath, filename FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$crvnumber0\"";
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
			$found16=1; $ctr16++;
    $cashreceipttotid16 = $myrow16['cashreceipttotid'];
    $cashreceiptnumber16 = $myrow16['cashreceiptnumber'];
    $date16 = $myrow16['date'];
    $explanation16 = $myrow16['explanation'];
    // $debittot16 = $myrow16['debittot'];
    // $credittot16 = $myrow16['credittot'];
			$filepath16 = $myrow16['filepath'];
			$filename16 = $myrow16['filename'];
		} //while
	} //if

  if ($explanation15 != '') { $explanationfin = $explanation15; }
  else if ($explanation16 != '') { $explanationfin = $explanation16; }

//    echo "<form action=\"finvouchcrvadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">";
    echo "<tr><td>Date:&nbsp;<b><input name=\"crvdate\" value=\"$crvdate15\" size=\"12\" readonly></b><a href=\"finvouchcrvchgdate.php?loginid=$loginid&crvn=$crvnumber0&crvdt=$crvdate15\" class='btn btn-primary' role='button'><font size=\"1\"><i>Change</i></font></a></td><td>C.R. No.:&nbsp;<b><input name=\"crvnumber\" value=\"$crvnumber15\" size=\"12\" readonly></b><a href=\"finvouchcrvchgnum.php?loginid=$loginid&crvn=$crvnumber0&crvdt=$crvdate15\" class='btn btn-primary' role='button'><font size=\"1\"><i>Change</i></font></a></td></tr>";
		echo "<tr><td colspan=\"2\">Received from";
		if((($companyid15!="") || ($companyid15!=0)) && (($contactid15=="") || ($contactid15==0))) {
			$res15aquery=""; $result15a=""; $found15a=0; $ctr15a=0;
			$res15aquery="SELECT company, branch FROM tblcompany WHERE companyid=$companyid15";
			$result15a=$dbh2->query($res15aquery);
			if($result15a->num_rows>0) {
				while($myrow15a=$result15a->fetch_assoc()) {
				$found15a = 1; $ctr15a++;
				$company15a = $myrow15a['company'];
				$branch15a = $myrow15a['branch'];
				} //while
			} //if
			$company15afin = $company15a;
			if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
			echo "<input type=\"hidden\" name=\"payorsw\" value=\"company\">";
			echo "<input type=\"hidden\" name=\"payorcompanyid\" value=\"$companyid15\">";
			echo "<input name=\"payor\" value=\"$company15afin\" size=\"25\" readonly>";
		} //if
		if((($contactid15!="") || ($contactid15!=0)) && (($companyid15=="") || ($companyid15==0))) {
			$res15bquery=""; $result15b=""; $found15b=0; $ctr15b=0;
			$res15bquery="SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid15";
			$result15b=$dbh2->query($res15bquery);
			if($result15b->num_rows>0) {
				while($myrow15b=$result15b->fetch_assoc()) {
				$found15b = 1; $ctr15b++;
				$companyid15b = $myrow15b['companyid'];
				$employeeid15b = $myrow15b['employeeid'];
				$name_last15b = $myrow15b['name_last'];
				$name_first15b = $myrow15b['name_first'];
				$name_middle15b = $myrow15b['name_middle'];
				} //while
			} //if
			$contactname15bfin = $name_first15b;
			if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_middle15b[0] . "."; }
			if($name_last15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_last15b; }
			echo "<input type=\"hidden\" name=\"payorsw\" value=\"contactperson\">";
			echo "<input type=\"hidden\" name=\"payorcontactid\" value=\"$contactid15\">";
        echo "<input name=\"payor\" value=\"$contactname15bfin\" size=\"25\" readonly>";
		}
		if((($companyid15=="") && ($contactid15=="")) || (($companyid15==0) && ($contactid15==0))) {
			echo "<input name=\"payor\" value=\"$payor15\" size=\"25\" readonly>";
		}		
		echo "<a href=\"finvouchcrvchgpayor.php?loginid=$loginid&crvn=$crvnumber0&crvdt=$crvdate15\" class='btn btn-primary' role='button'><font size=\"1\"><i>Change</i></font></a></td></tr>";
    echo "<tr><td colspan=\"2\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Ver</td><td>Particulars</td><td>Debit</td><td>Credit</td><td colspan=\"2\">Action</td></tr>";

        $res17query=""; $result17=""; $found17=0; $ctr17=0;
        $res17query="SELECT cashreceiptid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfincashreceipt WHERE cashreceiptnumber = \"$crvnumber0\" ORDER BY cashreceiptid ASC";
		$result17=$dbh2->query($res17query);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
				$found17=1; $ctr17++;
	$cashreceiptid17 = $myrow17['cashreceiptid'];
	$glcode17 = $myrow17['glcode'];
	$glrefver17 = $myrow17['glrefver'];
	$glnamedetails17 = $myrow17['glnamedetails'];
	$projcode17 = $myrow17['projcode'];
	$particulars17 = $myrow17['particulars'];
	$debitamt17 = $myrow17['debitamt'];
	$creditamt17 = $myrow17['creditamt'];
	$debitamttot = $debitamttot+$debitamt17;
	$creditamttot = $creditamttot+$creditamt17;

        $res18query=""; $result18=""; $found18=0; $ctr18=0;
        $res18query="SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17";
		$result18=$dbh2->query($res18query);
		if($result18->num_rows>0) {
			while($myrow18=$result18->fetch_assoc()) {
	  $found18 = 1; $ctr18++;
	  $glname18 = $myrow18['glname'];
			} //while
		} //if

	echo "<tr><td>$glcode17</td>";
	echo "<td>$projcode17</td><td>$glrefver17</td>";
	echo "<td>$particulars17</td><td align=\"right\">".number_format($debitamt17, 2)."</td><td align=\"right\">".number_format($creditamt17, 2)."</td>";
	echo "<td><a href=\"finvouchcrvpartdel.php?loginid=$loginid&crid=$cashreceiptid17&crvn=$crvnumber15\" class='btn btn-danger' role='button'>Del</a></td>";
	echo "<td><a href=\"finvouchcrvpartedit.php?loginid=$loginid&crid=$cashreceiptid17&crvn=$crvnumber15\" class='btn btn-warning' role='button'>Edit</a></td>";
	echo "</tr>";

	// reset vars
	$debitamt17=0; $creditamt17;
	
			} //while
		} //if

      echo "<tr><td colspan=\"3\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>".number_format($debitamttot, 2)."</b></td><td align=\"right\"><b>".number_format($creditamttot, 2)."</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea rows=\"4\" cols=\"60\" name=\"explanation\">$explanationfin</textarea><font size=\"1\"><i><a href=\"finvouchcrvchgexpla.php?loginid=$loginid&crvn=$crvnumber0&crvdt=$crvdate15\" class='btn btn-primary' role='button'>Change</a></i></font></td></tr>";

    //
	//20250505 file uploader
	echo "<tr><td colspan='2'>File attachment&nbsp;";
    if($filename16 != "") {
    echo "<a href=\"$filepath16/$filename16\" target=\"_blank\">$filename16</a>&nbsp;&nbsp;&nbsp;<i><a href=\"finvouchcrvdelfile.php?loginid=$loginid&crvtid=$cashreceipttotid16&crvn=$crvnumber0\">Remove</a></i><br>";    
	} else {
	echo "<form enctype=\"multipart/form-data\" action=\"finvouchcrvfileupload.php?loginid=$loginid&crvtid=$cashreceipttotid16&crvn=$crvnumber0\" method=\"POST\" name=\"finvouchcrvfileupload\">";
	echo "<input type=\"hidden\" name=\"cashreceipttotid\" value=\"$cashreceipttotid16\">";
	echo "<input type=\"hidden\" name=\"cashreceiptnumber\" value=\"$cashreceiptnumber16\">";
    echo "<input class = 'form-control'  placeholder ='00.00' type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />";
    echo "<input class = 'form-control'  placeholder ='00.00' name=\"uploadedfile\" type=\"file\" />";		
	echo "<button type='submit' class='btn btn-success' name='btnCRVfileupload' value=1>Save uploaded file</button>";		
	echo "</form>";
	} // if($filename16 != "")
	echo "</td></tr>";
	
	// relocate form here...
    echo "<form action=\"finvouchcrvadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">"; // fr ln.105
    echo "<input type=\"hidden\" name=\"crvdate\" value=\"$crvdate15\">";
	echo "<input type=\"hidden\" name=\"crvnumber\" value=\"$crvnumber15\">";
	echo "<input type=\"hidden\" name=\"payorsw\" value=\"company\">";
	echo "<input type=\"hidden\" name=\"payorcompanyid\" value=\"$companyid15\">";
	echo "<input type=\"hidden\" name=\"payor\" value=\"$company15afin\">";
	echo "<input type=\"hidden\" name=\"payorsw\" value=\"contactperson\">";
	echo "<input type=\"hidden\" name=\"payorcontactid\" value=\"$contactid15\">";
	echo "<input type=\"hidden\" name=\"payor\" value=\"$contactname15bfin\">";
	echo "<input type=\"hidden\" name=\"payor\" value=\"$payor15\">";
	echo "<input type=\"hidden\" name=\"explanation\" value=\"$explanationfin\">";

    echo "<tr><th colspan=\"2\">Add new particulars</th></tr>";
    echo "<tr><td colspan=\"2\">Acct Code<br>";
    echo "<select name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
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

    echo "Add'l.Details&nbsp<input name=\"glnamedetails\" size=\"35\">";
    echo "</td></tr>";

    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">Project Code<br>";
    echo "<select name=\"projcode\">";
    echo "<option value=\"-\">-</option>";
	$res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY proj_code DESC";
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
    echo "<textarea rows=\"3\" cols=\"60\" name=\"particulars\"></textarea></td></tr>";
    echo "<tr><td>Debit Amount<br><input name=\"debitamt\" size=\"12\"></td>";
    echo "<td>Credit Amount<br><input name=\"creditamt\" size=\"12\"></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr align=\"center\"><td><button type=\"submit\" class='btn btn-success'>Add new entry</button></form></td>";

    if(($accesslevel >= 4 && $accesslevel <= 5) && (($employeeid0 == $approver1empid21 || $employeeid0 == $approver2empid21)))
    {
      echo "<td><form action=\"finvouchcrvaddfin.php?loginid=$loginid&crvn=$crvnumber0\" method=\"post\">";
      echo "<button type=\"submit\" class='btn btn-success'>Finalize Cash Receipt</button></form></td>";
      echo "<td><form action=\"finvouchcrvcancel.php?loginid=$loginid&crvn=$crvnumber0\" method=\"post\">";
      echo "<button type=\"submit\" class='btn btn-danger'>Cancel Cash Receipt</button></form></td></tr>";
    }

    echo "</table></td></tr>";
    echo "</form>";
	
} else if($crvnumber == '') {
	
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Cash Receipt Number should not be blank. Please try again.</font></td></tr>";
  
} else {
	
    $res11query=""; $result11=""; $found11 = 0; $ctr11=0;
	$res11query="SELECT cashreceiptnumber FROM tblfincashreceipt WHERE cashreceiptnumber = \"$crvnumber\"";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1; $ctr11++;
    $crvnumber11 = $myrow11['cashreceiptnumber'];			
		} //while
	} //if

  if($found11 == 1) {
	  
    echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Warning: C.R. Number:$crvnumber11</b> already used. Please try again.</font></td></tr>";
	
  } else {

    echo "<form action=\"finvouchcrvadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">";
    echo "<tr><td>Date:&nbsp;<b><input name=\"crvdate\" value=\"$crvdate\" size=\"12\" readonly></b></td><td>C.R. No.:&nbsp;<b><input name=\"crvnumber\" value=\"$crvnumber\" size=\"12\" readonly></b></td></tr>";
		echo "<tr><td colspan=\"2\">Received from:&nbsp;<b>";

		if($payorsw=="company") {
			$res19query=""; $result19=""; $found19=0; $ctr19=0;
			$res19query="SELECT company, branch FROM tblcompany WHERE companyid=$payorcompanyid";
			$result19=$dbh2->query($res19query);
			if($result19->num_rows>0) {
				while($myrow19=$result19->fetch_assoc()) {
				$found19 = 1; $ctr19++;
				$company19 = $myrow19['company'];
				$branch19 = $myrow19['branch'];					
				} //while
			} //if
			echo "$company19";
			if($branch19 != "") { echo " - $branch19"; }
			echo "<input type=\"hidden\" name=\"payorsw\" value=\"company\">";
			echo "<input type=\"hidden\" name=\"payorcompanyid\" value=\"$payorcompanyid\">";
		} else if($payorsw=="contactperson") {
			$res20query=""; $result20=""; $found20=0; $ctr20=0;
			$res20query="SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$payorcontactid";
			$result20=$dbh2->query($res20query);
			if($result20->num_rows>0) {
				while($myrow20=$result20->fetch_assoc()) {
				$found20 = 1; $ctr20++;
				$companyid20 = $myrow20['companyid'];
				$employeeid20 = $myrow20['employeeid'];
				$name_last20 = $myrow20['name_last'];
				$name_first20 = $myrow20['name_first'];
				$name_middle20 = $myrow20['name_middle'];
					
				} //while
			} //if
			echo "$name_first20";
			if($name_middle20 != "") { echo "&nbsp;$name_middle20[0]."; }
			if($name_last20 != "") { echo "&nbsp;$name_last20"; }
			echo "<input type=\"hidden\" name=\"payorsw\" value=\"contactperson\">";
			echo "<input type=\"hidden\" name=\"payorcontactid\" value=\"$payorcontactid\">";
		}

		// echo "<input name=\"payor\" value=\"$payor\" size=\"25\" readonly>";
		echo "</b></td></tr>";
    echo "<tr><td colspan=\"2\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td><td colspan=\"2\">Action</td></tr>";
        $res17query=""; $result17=""; $found17=0; $ctr17=0;
		$res17query="SELECT cashreceiptid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfincashreceipt WHERE cashreceiptnumber = \"$crvnumber\" ORDER BY cashreceiptid ASC";
		$result17=$dbh2->query($res17query);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
	$found17 = 1; $ctr17++;
	$cashreceiptid17 = $myrow17['cashreceiptid'];
	$glcode17 = $myrow17['glcode'];
	$glrefver17 = $myrow17['glrefver'];
	$glnamedetails17 = $myrow17['glnamedetails'];
	$projcode17 = $myrow17['projcode'];
	$particulars17 = $myrow17['particulars'];
	$debitamt17 = $myrow17['debitamt'];
	$creditamt17 = $myrow17['creditamt'];
	$debitamttot = round($debitamttot+$debitamt17, 2);
	$creditamttot = round($creditamttot+$creditamt17, 2);

        $res18query=""; $result18=""; $found18=0; $ctr18=0;
		$res18query="SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17";
		$result18=$dbh2->query($res18query);
		if($result18->num_rows>0) {
			while($myrow18=$result18->fetch_assoc()) {
	  $found18 = 1; $ctr18++;
	  $glname18 = $myrow18['glname'];
			} //while
		} //if

	echo "<tr><td>$glcode17</td>";
	echo "<td>$projcode17</td>";
	echo "<td>$particulars17</td><td align=\"right\">".number_format($debitamt17, 2)."</td><td align=\"right\">".number_format($creditamt17, 2)."</td>";
	echo "<td><a href=\"finvouchcrvpartdel.php?loginid=$loginid&crid=$cashreceiptid17&crvn=$crvnumber\" class='btn btn-danger' role='button'>Del</a></td>";
	echo "<td><a href=\"finvouchcrvpartedit.php?loginid=$loginid&crid=$cashreceiptid17&crvn=$crvnumber\" class='btn btn-warning' role='button'>Edit</a></td>";
	echo "</tr>";

	// reset vars
	$debitamt17=0; $creditamt17=0;				
			} //while
		} //if

    $res16query=""; $result16=""; $found16=0; $ctr16=0;
    $res16query="SELECT cashreceipttotid, cashreceiptnumber, date, explanation, debittot, credittot FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$crvnumber\"";
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
    $found16 = 1; $ctr16++;
    $cashreceipttotid16 = $myrow16['cashreceipttotid'];
    $cashreceiptnumber16 = $myrow16['cashreceiptnumber'];
    $date16 = $myrow16['date'];
    $explanation16 = $myrow16['explanation'];
    // $debittot16 = $myrow16['debittot'];
    // $credittot16 = $myrow16['credittot'];	
		} //while
	} //if

      echo "<tr><td colspan=\"2\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>".number_format($debitamttot, 2)."</b></td><td align=\"right\"><b>".number_format($creditamttot, 2)."</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea rows=\"4\" cols=\"60\" name=\"explanation\">$explanation</textarea></td></tr>";
		
    echo "<tr><th colspan=\"2\">Add new particulars</th></tr>";
    echo "<tr><td colspan=\"2\">Acct Code<br>";
    echo "<select name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
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

    //
    // dynamic pulldown
    //

    echo "<div id=myDynamicPullDown>";

    echo "</div>";

    echo "<input name=\"aepglcode\" type=\"Hidden\">";

    echo "Add'l.Details&nbsp<input name=\"glnamedetails\" size=\"35\">";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">Project Code<br>";
    echo "<select name=\"projcode\">";
    echo "<option value=\"-\">-</option>";
	$res14query=""; $result14=""; $found14=0; $ctr14++;
    $res14query="SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY proj_code DESC";
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
    echo "<textarea rows=\"3\" cols=\"60\" name=\"particulars\"></textarea></td></tr>";
    echo "<tr><td>Debit Amount<br><input name=\"debitamt\" size=\"12\"></td>";
    echo "<td>Credit Amount<br><input name=\"creditamt\" size=\"12\"></td></tr>";

    echo "<tr><td colspan=\"2\" align=\"center\"><table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr align=\"center\"><td align=\"center\"><button type=\"submit\" class='btn btn-success'>Add new entry</button></form></td>";

    if(($accesslevel >= 4 && $accesslevel <= 5) && (($employeeid0 == $approver1empid21 || $employeeid0 == $approver2empid21)))
    {
      echo "<td><form action=\"finvouchcrvaddfin.php?loginid=$loginid&crvn=$crvnumber0\" method=\"post\">";
      echo "<button type=\"submit\" class='btn btn-success'>Finalize Cash Receipt</button></form></td>";
      echo "<td><form action=\"finvouchcrvcancel.php?loginid=$loginid&crvn=$crvnumber0\" method=\"post\">";
      echo "<button type=\"submit\" class='btn btn-danger'>Cancel Cash Receipt</button></form></td></tr>";
    }

    echo "</table></td></tr>";
    echo "</form>";
  } //if($found11 == 1)
}
      echo "</table>";

    echo "<p><a href=\"finvouchlist.php?loginid=$loginid&rs=cr\" class='btn btn-default' role='button'>Back</a></p>";

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
         htmlStr = htmlStr + "<select id=\"aepglcodelist\" onclick=\"getSelected()\">";

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
