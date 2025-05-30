<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> Accounting Modules</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"3\">Configure Cash Receipts Labels and Signatories</th></tr>";

// start contents here...
  if($accesslevel >= 3)
  {
    $result11 = mysql_query("SELECT rptcashreceiptid, preparedlbl, prepared, preparedpos, checkedlbl, checked, checkedpos, approvedlbl, approved, approvedpos, remarks FROM tblfinrptcashreceipt WHERE rptcashreceiptid <> ''", $dbh);
    if($result11 != '')
    {
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$rptcashreceiptid11 = $myrow11[0];
	$preparedlbl11 = $myrow11[1];
	$prepared11 = $myrow11[2];
	$preparedpos11 = $myrow11[3];
	$checkedlbl11 = $myrow11[4];
	$checked11 = $myrow11[5];
	$checkedpos11 = $myrow11[6];
	$approvedlbl11 = $myrow11[7];
	$approved11 = $myrow11[8];
	$approvedpos11 = $myrow11[9];
	$remarks11 = $myrow11[10];
      }
    }

    if($prepared11 == '')
    {
      $result12 = mysql_query("SELECT adminloginid, adminuid, employeeid, contactid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
      while($myrow12 = mysql_fetch_row($result12))
      {
	$found12 = 1;
	$adminloginid12 = $myrow12[0];
	$adminuid12 = $myrow12[1];
	$employeeid12 = $myrow12[2];
	$contactid12 = $myrow12[3];
      }

      $result14 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid12'", $dbh);
      while($myrow14 = mysql_fetch_row($result14))
      {
	$found14 = 1;
	$name_last14 = $myrow14[0];
	$name_first14 = $myrow14[1];
	$name_middle14 = $myrow14[2];
      }

      $prepared11 = $name_first14." ";
      if($name_middle14 != '') { $prepared11 = $prepared11."".$name_middle14[0].". "; }
      else  { $prepared11 = $prepared11." "; }
      $prepared11 = $prepared11.$name_last14;
    }
    echo "<form action=\"mngfinrptcashreceipt2.php?loginid=$loginid\" method=\"post\">";
    echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
    echo "<tr><td><input name=\"preparedlbl\" size=\"20\" value=\"$preparedlbl11\" /></td><td align=\"center\"><input name=\"checkedlbl\" size=\"20\" value=\"$checkedlbl11\" /></td><td align=\"center\"><input name=\"approvedlbl\" size=\"20\" value=\"$approvedlbl11\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"prepared\" size=\"30\" value=\"$prepared11\" /></td><td align=\"center\"><input name=\"checked\" size=\"30\" value=\"$checked11\" /></td><td align=\"center\"><input name=\"approved\" size=\"30\" value=\"$approved11\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"preparedpos\" size=\"20\" value=\"$preparedpos11\" /></td><td align=\"center\"><input name=\"checkedpos\" size=\"20\" value=\"$checkedpos11\" /></td><td align=\"center\"><input name=\"approvedpos\" size=\"20\" value=\"$approvedpos11\" /></td></tr>";
    echo "<tr><td colspan=\"3\" align=\"center\"><font size=\"1\"><i>Remarks</i></font><br><textarea name=\"remarks\" rows=\"3\" cols=\"40\">$remarks11</textarea></tr>";
    echo "<tr><td colspan=\"3\" align=\"center\"><input type=\"submit\" value=\"Save\"></form></td></tr>";
  }

// end contents here...
     echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngfinmods.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
