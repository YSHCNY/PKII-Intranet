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

     echo "<tr><th colspan=\"2\">Configure Check Voucher Labels and Signatories</th></tr>";

// start contents here...
  if($accesslevel >= 3)
  {
    $result11 = mysql_query("SELECT rptdisbursementid, rfplabel, rfppreparedlbl, rfpprepared, rfppreparedpos, rfpcheckedlbl, rfpchecked, rfpcheckedpos, rfpapprovedlbl, rfpapproved, rfpapprovedpos, cvlabel, cvpreparedlbl, cvprepared, cvpreparedpos, cvcheckedlbl, cvchecked, cvcheckedpos, cvapproved1lbl, cvapproved1, cvapproved1pos, cvapproved2lbl, cvapproved2, cvapproved2pos, remarks FROM tblfinrptdisbursement WHERE rptdisbursementid <> ''", $dbh);
    if($result11 != '')
    {
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$rptdisbursementid11 = $myrow11[0];
	$rfplabel11 = $myrow11[1];
	$rfppreparedlbl11 = $myrow11[2];
	$rfpprepared11 = $myrow11[3];
	$rfppreparedpos11 = $myrow11[4];
	$rfpcheckedlbl11 = $myrow11[5];
	$rfpchecked11 = $myrow11[6];
	$rfpcheckedpos11 = $myrow11[7];
	$rfpapprovedlbl11 = $myrow11[8];
	$rfpapproved11 = $myrow11[9];
	$rfpapprovedpos11 = $myrow11[10];
	$cvlabel11 = $myrow11[11];
	$cvpreparedlbl11 = $myrow11[12];
	$cvprepared11 = $myrow11[13];
	$cvpreparedpos11 = $myrow11[14];
	$cvcheckedlbl11 = $myrow11[15];
	$cvchecked11 = $myrow11[16];
	$cvcheckedpos11 = $myrow11[17];
	$cvapproved1lbl11 = $myrow11[18];
	$cvapproved111 = $myrow11[19];
	$cvapproved1pos11 = $myrow11[20];
	$cvapproved2lbl11 = $myrow11[21];
	$cvapproved211 = $myrow11[22];
	$cvapproved2pos11 = $myrow11[23];
	$remarks11 = $myrow11[24];
      }
    }

    if($rfpprepared11 == '')
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

      $rfpprepared11 = $name_first14." ";
      if($name_middle14 != '') { $rfpprepared11 = $rfpprepared11."".$name_middle14[0].". "; }
      else  { $rfpprepared11 = $rfpprepared11." "; }
      $rfpprepared11 = $rfpprepared11.$name_last14;
    }
    echo "<form action=\"mngfinrptdisbursement2.php?loginid=$loginid\" method=\"post\">";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><font size=\"1\"><i>Request for Payment</i><br><input name=\"rfplabel\" size=\"20\" value=\"$rfplabel11\" /></font></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"rfppreparedlbl\" size=\"20\" value=\"$rfppreparedlbl11\" /></td><td align=\"center\"><input name=\"rfpcheckedlbl\" size=\"20\" value=\"$rfpcheckedlbl11\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"rfpprepared\" size=\"30\" value=\"$rfpprepared11\" /></td><td align=\"center\"><input name=\"rfpchecked\" size=\"30\" value=\"$rfpchecked11\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"rfppreparedpos\" size=\"20\" value=\"$rfppreparedpos11\" /></td><td align=\"center\"><input name=\"rfpcheckedpos\" size=\"20\" value=\"$rfpcheckedpos11\" /></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><input name=\"rfpapprovedlbl\" size=\"20\" value=\"$rfpapprovedlbl11\" /></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><input name=\"rfpapproved\" size=\"30\" value=\"$rfpapproved11\" /></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><input name=\"rfpapprovedpos\" size=\"20\" value=\"$rfpapprovedpos11\" /></td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><font size=\"1\"><i>Check Voucher</i></font><br><input name=\"cvlabel\" size=\"20\" value=\"$cvlabel11\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"cvpreparedlbl\" size=\"20\" value=\"$cvpreparedlbl11\" /></td><td align=\"center\"><input name=\"cvcheckedlbl\" size=\"20\" value=\"$cvcheckedlbl11\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"cvprepared\" size=\"30\" value=\"$cvprepared11\" /></td><td align=\"center\"><input name=\"cvchecked\" size=\"30\" value=\"$cvchecked11\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"cvpreparedpos\" size=\"20\" value=\"$cvpreparedpos11\" /></td><td align=\"center\"><input name=\"cvcheckedpos\" size=\"20\" value=\"$cvcheckedpos11\" /></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><input name=\"cvapproved1lbl\" size=\"20\" value=\"$cvapproved1lbl11\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"cvapproved1\" size=\"30\" value=\"$cvapproved111\" /></td><td align=\"center\"><input name=\"cvapproved2\" size=\"30\" value=\"$cvapproved211\" /></td></tr>";
    echo "<tr><td align=\"center\"><input name=\"cvapproved1pos\" size=\"20\" value=\"$cvapproved1pos11\" /></td><td align=\"center\"><input name=\"cvapproved2pos\" size=\"20\" value=\"$cvapproved2pos11\" /></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><font size=\"1\"><i>Remarks</i></font><br><textarea name=\"remarks\" rows=\"3\" cols=\"40\">$remarks11</textarea></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Save\"></form></td></tr>";
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
