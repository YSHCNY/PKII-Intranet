<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$acctspayableid0 = (isset($_GET['apid'])) ? $_GET['apid'] :'';
$apnumber0 = trim((isset($_GET['apn'])) ? $_GET['apn'] :'');
$apnumber0 = htmlentities(stripslashes($apnumber0));

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
      $result20 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
      while($myrow20 = mysql_fetch_row($result20))
      {
  $version20 = $myrow20[0];
      }

      if($version20 == 1) { $dynselglcode="20.10.208"; }
      else if($version20 == 2) { $dynselglcode="20.10.210"; }

// define approvers 2022014
  $res21query=""; $result21=""; $found21=0;
  $res21query="SELECT iditsupportapprover, approver1empid, approver2empid FROM tblitsupportapprover WHERE deptcd='FIN'";
  $result21=$dbh2->query($res21query);
  if($result21->num_rows>0) {
    while($myrow21=$result21->fetch_assoc()) {
    $found21=1;
    $iditsupportapprover21 = $myrow21['iditsupportapprover'];
    $approver1empid21 = $myrow21['approver1empid'];
    $approver2empid21 = $myrow21['approver2empid'];
    } //while
  } //if

//
if($apnumber0 != '') {
//

  $result15 = mysql_query("SELECT acctspayablenumber, payee, due_date, date, company_id, contact_id FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber0\"", $dbh);
  while ($myrow15 = mysql_fetch_row($result15)) {
    $found15 = 1;
    $acctspayablenumber15 = $myrow15[0];
    $appayee15 = $myrow15[1];
    $apdate15 = $myrow15[3];
    $apduedate15 = $myrow15[2];
	$companyid15 = $myrow15[4];
	$contactid15 = $myrow15[5];
	
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
	}
  }

  $result16 = mysql_query("SELECT acctspayabletotid, acctspayablenumber, date, explanation, debittot, credittot FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber0\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16)) {
    $found16 = 1;
    $acctspayabletotid16 = $myrow16[0];
    $acctspayablenumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    $debittot16 = $myrow16[4];
    $credittot16 = $myrow16[5];
  } 

    echo "<form action=\"finvouchapadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">";
    // echo "<tr><td>dsadsaf: ".$apduedate15."</td></tr>";
    echo "<tr><td>Date:&nbsp;<strong><input class=\"form-control\" name=\"apdate\" value=\"".date('Y-M-d', strtotime($apdate15))."\" /></strong>";
	if($accesslevel >= 4 && $accesslevel <= 5) {
	echo "<i><a href=\"finvouchapvchgdt.php?loginid=$loginid&apvn=$apnumber0&apvdt=$apdate15\">Change</a></i>";		
	} //if
	echo "</td><td>APV No.:&nbsp;<strong><input class=\"form-control\" name=\"apnumber\" value=\"$acctspayablenumber15\" readonly></strong>";
	if($accesslevel >= 4 && $accesslevel <= 5) {
	echo "<i><a href=\"finvouchapvchgnum.php?loginid=$loginid&apvn=$apnumber0&apvdt=$apdate15\">Change</a></i>";		
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
	echo "<i><a href=\"finvouchapvchgpayee.php?loginid=$loginid&apvn=$apnumber0&apvdt=$apdate15\">Change</a></i>";
	} //if
	echo "</td>";
	echo "<input type=\"hidden\" name=\"apcompanyid\" value=\"$companyid15\" />";
	echo "<input type=\"hidden\" name=\"apcontactid\" value=\"$contactid15\" />";
    echo "<td>Due Date:<br><strong><input class=\"form-control\" type='text' name=\"apduedate\" value=\"".date('Y-M-d', strtotime($apduedate15))."\" /></strong>";
	if($accesslevel >= 4 && $accesslevel <= 5) {
	echo "<i><a href=\"finvouchapvchgduedt.php?loginid=$loginid&apvn=$apnumber0&apvddt=$apduedate15\">Change</a></i>";		
	} //if
	echo "</td></tr>";

    echo "<tr><td colspan=\"2\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td><td colspan=\"2\">Action</td></tr>";

      $result17=""; $found17=0; $ctr17=0;
      $result17 = mysql_query("SELECT acctspayableid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber0\" ORDER BY acctspayableid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
  $found17 = 1;
  $ctr17++;
  $acctspayableid17 = $myrow17[0];
  $glcode17 = $myrow17[1];
  $glrefver17 = $myrow17[2];
  $glnamedetails17 = $myrow17[3];
  $projcode17 = $myrow17[4];
  $particulars17 = $myrow17[5];
  $debitamt17 = $myrow17[6];
  $creditamt17 = $myrow17[7];

  $result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17", $dbh);
  while($myrow18 = mysql_fetch_row($result18))
  {
    $found18 = 1;
    $glname18 = $myrow18[0];
  }

  echo "<tr><td>$glcode17</td>";
  echo "<td>$projcode17</td>";
  echo "<td>$particulars17</td><td align=\"right\">".number_format($debitamt17, 2)."</td><td align=\"right\">".number_format($creditamt17, 2)."</td>";
  echo "<td><a href=\"finvouchappartdel.php?loginid=$loginid&apid=$acctspayableid17&apn=$acctspayablenumber15\" class=\"btn btn-danger btn-sm\" role=\"button\" />Del</a></td>";
  echo "<td><a href=\"finvouchapvpartedit.php?loginid=$loginid&apid=$acctspayableid17&apn=$apnumber0\" class=\"btn btn-warning btn-sm\" role=\"button\" />Edit</a></td>";
  echo "</tr>";
      }

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
    echo "<textarea class=\"form-control\" rows=\"4\" name=\"explanation\">$explanation16</textarea><i><a href=\"finvouchapchgexpla.php?loginid=$loginid&apvn=$apnumber0&apvdt=$apdate15\">Change</a></i></td></tr>";
    echo "<tr><th colspan=\"2\">Add new particulars</th></tr>";
    echo "<tr><td colspan=\"2\">Acct Code<br>";
    echo "<select class=\"form-control\" name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
    $result12 = mysql_query("SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 ORDER BY glcode ASC", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $glcode12 = $myrow12[0];
      $glname12 = $myrow12[1];
      echo "<option value=\"$glcode12\">$glcode12 - $glname12</option>";
    }
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
    $result14 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY date_start DESC", $dbh);
    while($myrow14 = mysql_fetch_row($result14))
    {
      $projectid14 = $myrow14[0];
      $proj_code14 = $myrow14[1];
      $proj_fname14 = $myrow14[2];
      $proj_sname14 = $myrow14[3];
      $proj_fname142 = substr("$proj_fname14", 0, 47); 
      if($proj_sname14 <> '') { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_sname14</option>"; }
      else
      { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_fname142</option>"; }
    }
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
      echo "<tr align=\"center\"><td><input type=\"submit\" value=\"Add new item\" class=\"btn btn-success\" role=\"button\" /></form></td>";

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

  $found11 = 0;
  $result11 = mysql_query("SELECT acctspayablenumber FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber\"", $dbh);
  while ($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
    $acctspayablenumber11 = $myrow11[0];
  }
  
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

      $result17 = mysql_query("SELECT acctspayableid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber\" ORDER BY acctspayableid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
  $found17 = 1;
  $acctspayableid17 = $myrow17[0];
  $glcode17 = $myrow17[1];
  $glrefver17 = $myrow17[2];
  $glnamedetails17 = $myrow17[3];
  $projcode17 = $myrow17[4];
  $particulars17 = $myrow17[5];
  $debitamt17 = $myrow17[6];
  $creditamt17 = $myrow17[7];

  $result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17", $dbh);
  while($myrow18 = mysql_fetch_row($result18))
  {
    $found18 = 1;
    $glname18 = $myrow18[0];
  }

  echo "<tr><td>$glcode17</td>";
  echo "<td>$projcode17</td>";
  echo "<td>$particulars17</td><td align=\"right\">$debitamt17</td><td align=\"right\">$creditamt17</td>";
  echo "<td><a href=\"finvouchappartdel.php?loginid=$loginid&apid=$acctspayableid17&apn=$apnumber\">Del</a></td>";
//  echo "<td><a href=\"finvouchappartedit.php?loginid=$loginid&apid=$acctspayableid17&apn=$cvnumber\">Edit</a></td>";
  echo "</tr>";
      }

  $result16 = mysql_query("SELECT acctspayabletotid, acctspayablenumber, date, explanation, debittot, credittot FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $acctspayabletotid16 = $myrow16[0];
    $acctspayablenumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    $debittot16 = $myrow16[4];
    $credittot16 = $myrow16[5];
  } 
      echo "<tr><td colspan=\"2\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>$debittot16</b></td><td align=\"right\"><b>$credittot16</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea class=\"form-control\" rows=\"4\" name=\"explanation\">$explanation</textarea><font size=\"1\"><i><a href=\"finvouchapchgexpla.php?loginid=$loginid&apvn=$apnumber&apvdt=$apdate\">Change</a></i></font></td></tr>";
    echo "<tr><th colspan=\"2\">Add new particulars</th></tr>";
    echo "<tr><td colspan=\"2\">Acct Code<br>";
    echo "<select class=\"form-control\" name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
    $result12 = mysql_query("SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 ORDER BY glcode ASC", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $glcode12 = $myrow12[0];
      $glname12 = $myrow12[1];
      echo "<option value=\"$glcode12\">$glcode12 - $glname12</option>";
    }
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
    $result14 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY date_start DESC", $dbh);
    while($myrow14 = mysql_fetch_row($result14))
    {
      $projectid14 = $myrow14[0];
      $proj_code14 = $myrow14[1];
      $proj_fname14 = $myrow14[2];
      $proj_sname14 = $myrow14[3];
      $proj_fname142 = substr("$proj_fname14", 0, 47); 
      if($proj_sname14 <> '') { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_sname14</option>"; }
      else
      { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_fname142</option>"; }
    }
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

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

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
         $result = mysql_query("SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 AND glcode >= '60.00.00' AND glcode <= '70.80.199' ORDER BY glcode ASC", $dbh);
   ?>
    htmlStr = htmlStr + "<option value=\"-\">-</option>";
   <?php
         while($myrow = mysql_fetch_row($result))
         {
             $glcode = $myrow[0];
             $glname = $myrow[1];
             ?>
                  htmlStr = htmlStr + "<option value=\"<?=$glcode?>\"><?=$glcode?> - <?=$glname?></option>";
             <?php
         }
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
mysql_close($dbh);
$dbh2->close();
?>
