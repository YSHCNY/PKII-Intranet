<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$cvnumber0 = trim($_GET['cvn']);

// $cvdate = $_POST['yyyycv']."-".$_POST['mmmcv']."-".$_POST['ddcv'];
$cvdate = $_POST['cvdate'];
$cvnumber = trim($_POST['cvnumber']);
// $cvpayee = $_POST['cvpayee'];
$explanation = $_POST['explanation'];

$payeesw = $_POST['payeesw'];
$payeecompanyid = $_POST['payeecompanyid'];
$payeecontactid = $_POST['payeecontactid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" border=\"0\">";
      echo "<tr><th colspan=\"2\">Check Vouchers - Add new entry</th></tr>";

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

if($cvnumber0 != '')
{
  $result15 = mysql_query("SELECT disbursementnumber, disbursementtype, payee, date, explanation, companyid, contactid, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber = \"$cvnumber0\"", $dbh);
  while ($myrow15 = mysql_fetch_row($result15))
  {
    $found15 = 1;
    $cvnumber15 = $myrow15[0];
    $cvtype15 = $myrow15[1];
    $cvpayee15 = $myrow15[2];
    $cvdate15 = $myrow15[3];
    $explanation15 = $myrow15[4];
		$companyid15 = $myrow15[5];
		$contactid15 = $myrow15[6];
		$debitamt15 = $myrow15[7];
		$creditamt15 = $myrow15[8];
		// $debitamttot = $debitamttot+$debitamt15;
		// $creditamttot = $creditamttot+$creditamt15;
		// reset vars
		$debitamt15=0; $creditamt15=0;
  }

  $result16 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation, debittot, credittot FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber0\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $disbursementtotid16 = $myrow16[0];
    $disbursementnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    // $debittot16 = $myrow16[4];
    // $credittot16 = $myrow16[5];
  }

  if ($explanation16 != '') { $explanationfin = $explanation16; }
  else if ($explanation15 != '') { $explanationfin = $explanation15; }

    echo "<form action=\"finvouchcvadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">";
    echo "<tr>";
		if(($accesslevel >= 4) && ($accesslevel <= 5)) {
		echo "<td>Date:&nbsp;<b><input name=\"cvdate\" value=\"$cvdate15\" size=\"12\" readonly></b><a href=\"finvouchcvchgdate.php?loginid=$loginid&cvn=$cvnumber0&cvdt=$cvdate15\"><font size=\"1\"><i>Change</i></font></a></td>";
		echo "<td>CV No.:&nbsp;<b><input name=\"cvnumber\" value=\"$cvnumber15\" size=\"12\" readonly></b><a href=\"finvouchcvchgnum.php?loginid=$loginid&cvn=$cvnumber0&cvdt=$cvdate15\"><font size=\"1\"><i>Change</i></font></a></td></tr>";
    echo "<tr><td colspan=\"2\">Payee:<br>";
		if((($companyid15!="") || ($companyid15!=0)) && (($contactid15=="") || ($contactid15==0))) {
			$result15a=""; $found15a=0; $ctr15a=0;
			$result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid15", $dbh);
			if($result15a != "") {
				while($myrow15a = mysql_fetch_row($result15a)) {
				$found15a = 1;
				$company15a = $myrow15a[0];
				$branch15a = $myrow15a[1];
				}
			}
			$company15afin = $company15a;
			if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
			echo "<input type=\"hidden\" name=\"payeesw\" value=\"company\">";
			echo "<input type=\"hidden\" name=\"payeecompanyid\" value=\"$companyid15\">";
			echo "<input name=\"payee\" value=\"$company15afin\" size=\"25\" readonly>";
		}
		if((($contactid15!="") || ($contactid15!=0)) && (($companyid15=="") || ($companyid15==0))) {
			$result15b=""; $found15b=0; $ctr15b=0;
			$result15b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid15", $dbh);
			if($result15b != "") {
				while($myrow15b = mysql_fetch_row($result15b)) { 
				$found15b = 1;
				$companyid15b = $myrow15b[0];
				$employeeid15b = $myrow15b[1];
				$name_last15b = $myrow15b[2];
				$name_first15b = $myrow15b[3];
				$name_middle15b = $myrow15b[4];
				}
			}
			$contactname15bfin = $name_first15b;
			if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_middle15b[0] . "."; }
			if($name_last15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_last15b; }
			echo "<input type=\"hidden\" name=\"payeesw\" value=\"contactperson\">";
			echo "<input type=\"hidden\" name=\"payeecontactid\" value=\"$contactid15\">";
			echo "<input name=\"payee\" value=\"$contactname15bfin\" size=\"25\" readonly>";
		}
		if((($companyid15=="") && ($contactid15=="")) || (($companyid15==0) && ($contactid15==0))) {
			echo "<input name=\"payee\" value=\"$cvpayee15\" size=\"25\" readonly>";
		}
		// echo "<input size=\"50\" name=\"cvpayee\" value=\"$cvpayee15\" readonly>";
		echo "<a href=\"finvouchcvchgpayee.php?loginid=$loginid&cvn=$cvnumber0&cvdt=$cvdate15\"><font size=\"1\"><i>Change</i></font></a>";
		echo "</td></tr>";

		} else if($accesslevel <= 3) {

		echo "<td>Date:&nbsp;<b><input name=\"cvdate\" value=\"$cvdate15\" size=\"12\" readonly></b></td>";
		echo "<td>CV No.:&nbsp;<b><input name=\"cvnumber\" value=\"$cvnumber15\" size=\"12\" readonly></b></td></tr>";
    echo "<tr><td colspan=\"2\">Payee:<br>";
		if((($companyid15!="") || ($companyid15!=0)) && (($contactid15=="") || ($contactid15==0))) {
			$result15a=""; $found15a=0; $ctr15a=0;
			$result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid15", $dbh);
			if($result15a != "") {
				while($myrow15a = mysql_fetch_row($result15a)) {
				$found15a = 1;
				$company15a = $myrow15a[0];
				$branch15a = $myrow15a[1];
				}
			}
			$company15afin = $company15a;
			if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
			echo "<input type=\"hidden\" name=\"payeesw\" value=\"company\">";
			echo "<input type=\"hidden\" name=\"payeecompanyid\" value=\"$companyid15\">";
			echo "<input name=\"payee\" value=\"$company15afin\" size=\"25\" readonly>";
		}
		if((($contactid15!="") || ($contactid15!=0)) && (($companyid15=="") || ($companyid15==0))) {
			$result15b=""; $found15b=0; $ctr15b=0;
			$result15b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid15", $dbh);
			if($result15b != "") {
				while($myrow15b = mysql_fetch_row($result15b)) { 
				$found15b = 1;
				$companyid15b = $myrow15b[0];
				$employeeid15b = $myrow15b[1];
				$name_last15b = $myrow15b[2];
				$name_first15b = $myrow15b[3];
				$name_middle15b = $myrow15b[4];
				}
			}
			$contactname15bfin = $name_first15b;
			if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_middle15b[0] . "."; }
			if($name_last15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_last15b; }
			echo "<input type=\"hidden\" name=\"payeesw\" value=\"contactperson\">";
			echo "<input type=\"hidden\" name=\"payeecontactid\" value=\"$contactid15\">";
			echo "<input name=\"payee\" value=\"$contactname15bfin\" size=\"25\" readonly>";
		}
		if((($companyid15=="") && ($contactid15=="")) || (($companyid15==0) && ($contactid15==0))) {
			echo "<input name=\"payee\" value=\"$cvpayee15\" size=\"25\" readonly>";
		}
		// echo "<input size=\"50\" name=\"cvpayee\" value=\"$cvpayee15\" readonly>";
		echo "</td></tr>";

		}

    echo "<tr><td colspan=\"2\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Ver</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td><td colspan=\"2\" align=\"center\">Action</td></tr>";

      $result17 = mysql_query("SELECT disbursementid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber = \"$cvnumber0\" ORDER BY disbursementid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
	$found17 = 1;
	$disbursementid17 = $myrow17[0];
	$glcode17 = $myrow17[1];
	$glrefver17 = $myrow17[2];
	$glnamedetails17 = $myrow17[3];
	$projcode17 = $myrow17[4];
	$particulars17 = $myrow17[5];
	$debitamt17 = $myrow17[6];
	$creditamt17 = $myrow17[7];
	$debitamttot=$debitamttot+$debitamt17;
	$creditamttot=$creditamttot+$creditamt17;

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17", $dbh);
	while($myrow18 = mysql_fetch_row($result18))
	{
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode17</td><td align=\"center\">$glrefver17</td>";
	echo "<td>$projcode17</td>";
	echo "<td>$particulars17</td><td align=\"right\">".number_format($debitamt17, 2)."</td><td align=\"right\">".number_format($creditamt17, 2)."</td>";
	echo "<td><a href=\"finvouchcvpartdel.php?loginid=$loginid&did=$disbursementid17&cvn=$cvnumber15\">Del</a></td>";
	echo "<td><a href=\"finvouchcvpartedit.php?loginid=$loginid&did=$disbursementid17&cvn=$cvnumber15\">Edit</a></td>";
	echo "</tr>";
      }

      echo "<tr><td colspan=\"3\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>".number_format($debitamttot, 2)."</b></td><td align=\"right\"><b>".number_format($creditamttot, 2)."</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea rows=\"4\" cols=\"60\" name=\"explanation\" readonly>$explanationfin</textarea><font size=\"1\"><i><a href=\"finvouchcvchgexpla.php?loginid=$loginid&cvn=$cvnumber0&cvdt=$cvdate15\">Change</a></i></font></td></tr>";
    echo "<tr><th colspan=\"2\">Add new particulars</th></tr>";
    echo "<tr><td colspan=\"2\">Acct Code<br>";
    echo "<select name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
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

    echo "Add'l.Details&nbsp<input name=\"glnamedetails\" size=\"35\">";
    echo "</td></tr>";

    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">Project Code<br>";
    echo "<select name=\"projcode\">";
    echo "<option value=\"-\">-</option>";
    $result14 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY proj_code DESC", $dbh);
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
    echo "<textarea rows=\"3\" cols=\"60\" name=\"particulars\"></textarea></td></tr>";
    echo "<tr><td>Debit Amount<br><input name=\"debitamt\" size=\"12\"></td>";
    echo "<td>Credit Amount<br><input name=\"creditamt\" size=\"12\"></td></tr>";
    echo "<tr><td>";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">";
      echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr align=\"center\"><td><input type=\"submit\" value=\"Add new entry\"></form></td>";

    if(($accesslevel >= 4 && $accesslevel <= 5) && (($employeeid0 == $approver1empid21 || $employeeid0 == $approver2empid21)))
    {
      echo "<td><form action=\"finvouchcvaddfin.php?loginid=$loginid&cvn=$cvnumber0\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Finalize CV\"></form></td>";

      echo "<td><form action=\"finvouchcvcancel.php?loginid=$loginid&cvn=$cvnumber0\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Cancel CV\"></form></td>";
    }
      echo "</tr></table>";
    echo "</td></tr>";
    echo "</form>";
}
else if($cvnumber == '')
{
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, CV Number should not be blank. Please try again.</font></td></tr>";
}
else
{
  $found11 = 0;
  $result11 = mysql_query("SELECT disbursementnumber FROM tblfindisbursement WHERE disbursementnumber = \"$cvnumber\"", $dbh);
  while ($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $disbursementnumber11 = $myrow11[0];
  }
  if($found11 == 1)
  {
    echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Warning: C.V. Number:$disbursementnumber11</b> already used. Please try again.</font></td></tr>";
  }
  else

  {
    echo "<form action=\"finvouchcvadd.php?loginid=$loginid\" method=\"post\" name=\"myForm\">";
    echo "<tr><td>Date:&nbsp;<b><input name=\"cvdate\" value=\"$cvdate\" size=\"12\" readonly></b></td><td>CV No.:&nbsp;<b><input name=\"cvnumber\" value=\"$cvnumber\" size=\"12\" readonly></b></td></tr>";
    echo "<tr><td colspan=\"2\">Payee:<br>";

		if($payeesw=="company") {
			$result19=""; $found19=0; $ctr19=0;
			$result19 = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$payeecompanyid", $dbh);
			if($result19 != "") {
				while($myrow19 = mysql_fetch_row($result19)) {
				$found19 = 1;
				$company19 = $myrow19[0];
				$branch19 = $myrow19[1];
				}
			}
			echo "$company19";
			if($branch19 != "") { echo " - $branch19"; }
			echo "<input type=\"hidden\" name=\"payeesw\" value=\"company\">";
			echo "<input type=\"hidden\" name=\"payeecompanyid\" value=\"$payeecompanyid\">";
		} else if($payeesw=="contactperson") {
			$result20=""; $found20=0; $ctr20=0;
			$result20 = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$payeecontactid", $dbh);
			if($result20 != "") {
				while($myrow20 = mysql_fetch_row($result20)) {
				$found20 = 1;
				$companyid20 = $myrow20[0];
				$employeeid20 = $myrow20[1];
				$name_last20 = $myrow20[2];
				$name_first20 = $myrow20[3];
				$name_middle20 = $myrow20[4];
				}
			}
			echo "$name_first20";
			if($name_middle20 != "") { echo "&nbsp;$name_middle20[0]."; }
			if($name_last20 != "") { echo "&nbsp;$name_last20"; }
			echo "<input type=\"hidden\" name=\"payeesw\" value=\"contactperson\">";
			echo "<input type=\"hidden\" name=\"payeecontactid\" value=\"$payeecontactid\">";
		}

		// echo "<input size=\"30\" name=\"cvpayee\" value=\"$cvpayee\" readonly>";
		echo "</td></tr>";
    echo "<tr><td colspan=\"2\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Ver</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td><td colspan=\"2\">Action</td></tr>";

      $result17 = mysql_query("SELECT disbursementid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber = \"$cvnumber\" ORDER BY disbursementid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
	$found17 = 1;
	$disbursementid17 = $myrow17[0];
	$glcode17 = $myrow17[1];
	$glrefver17 = $myrow17[2];
	$glnamedetails17 = $myrow17[3];
	$projcode17 = $myrow17[4];
	$particulars17 = $myrow17[5];
	$debitamt17 = $myrow17[6];
	$creditamt17 = $myrow17[7];
	$debitamttot=$debitamttot+$debitamt17;
	$creditamttot=$creditamttot+$creditamt17;

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17", $dbh);
	while($myrow18 = mysql_fetch_row($result18))
	{
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode17</td><td align=\"center\">$glrefver17</td>";
	echo "<td>$projcode17</td>";
	echo "<td>$particulars17</td><td align=\"right\">".number_format($debitamt17, 2)."</td><td align=\"right\">".number_format($creditamt17, 2)."</td>";
	echo "<td><a href=\"finvouchcvpartdel.php?loginid=$loginid&did=$disbursementid17&cvn=$cvnumber\">Del</a></td>";
	echo "<td><a href=\"finvouchcvpartedit.php?loginid=$loginid&did=$disbursementid17&cvn=$cvnumber\">Edit</a></td>";
	echo "</tr>";

	// reset vars
	$debitamt17=0; $creditamt17=0;
      }

  $result16 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation, debittot, credittot FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $disbursementtotid16 = $myrow16[0];
    $disbursementnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    // $debittot16 = $myrow16[4];
    // $credittot16 = $myrow16[5];
  } 
      echo "<tr><td colspan=\"3\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>".number_format($debitamttot, 2)."</b></td><td align=\"right\"><b>".number_format($creditamttot, 2)."</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea rows=\"4\" cols=\"60\" name=\"explanation\">$explanation</textarea></td></tr>";
    echo "<tr><th colspan=\"2\">Add new particulars</th></tr>";
    echo "<tr><td colspan=\"2\">Acct Code<br>";
    echo "<select name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
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

    echo "Add'l.Details&nbsp<input name=\"glnamedetails\" size=\"35\">";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">Project Code<br>";
    echo "<select name=\"projcode\">";
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
    echo "<textarea rows=\"3\" cols=\"50\" name=\"particulars\"></textarea></td></tr>";
    echo "<tr><td>Debit Amount<br><input name=\"debitamt\" size=\"12\"></td>";
    echo "<td>Credit Amount<br><input name=\"creditamt\" size=\"12\"></td></tr>";
    echo "<tr><td>";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\" align=\"center\">";
      echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr align=\"center\"><td><input type=\"submit\" value=\"Add new entry\"></form></td>";

    if(($accesslevel >= 4 && $accesslevel <= 5) && (($employeeid0 == $approver1empid21 || $employeeid0 == $approver2empid21)))
    {
      echo "<td><form action=\"finvouchcvaddfin.php?loginid=$loginid&cvn=$cvnumber0\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Finalize CV\"></form></td>";

      echo "<td><form action=\"finvouchcvcancel.php?loginid=$loginid&cvn=$cvnumber0\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Cancel CV\"></form></td>";
    }
      echo "</tr></table>";
    echo "</td></tr>";

    echo "</form>";
  }
}
      echo "</table>";

    echo "<p><a href=\"finvouchlist.php?loginid=$loginid&rs=cv\">Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
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
