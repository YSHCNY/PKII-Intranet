<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$wprefid = $_GET['wpid'];

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

// start contents here...

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"2\">Working Paper Account Codes - add new</th></tr>";

  echo "<form action=\"mngfinwprefedit2.php?loginid=$loginid&wpid=$wprefid\" method=\"post\">";

  $result10=""; $found10=0;
  $result10 = mysql_query("SELECT wpacctcd, wpacctname, glcode, glrefver, seq, status FROM tblfinworkpaperref WHERE wprefid=$wprefid", $dbh);
  if($result10 != "") {
    while($myrow10 = mysql_fetch_row($result10)) {
    $found10 = 1;
    $wpacctcd10 = $myrow10[0];
		$wpacctname10 = $myrow10[1];
		$glcode10 = $myrow10[2];
		$glrefver10 = $myrow10[3];
		$seq10 = $myrow10[4];
		$status10 = $myrow10[5];
    }
  }

  echo "<tr><th align=\"right\">Acct code</th><td><input name=\"wpacctcd\" size=\"10\" value=\"$wpacctcd10\"></td></tr>";
  echo "<tr><th align=\"right\">Acct name</th><td><input name=\"wpacctname\" size=\"50\" value=\"$wpacctname10\"></td></tr>";

  echo "<tr><th align=\"right\">Sequence order</th><td><input name=\"seq\" type=\"number\" step=\"0.1\" min=\"01\" max=\"500\" value=\"$seq10\"></td></tr>";

  // display chart of accts as initial glcode selection
  echo "<tr><th align=\"right\"></th><td>Note: please select a GL Code as initial item. You may use the Edit account function later for multiple GL codes in one account name.</td></tr>";
  echo "<tr><th align=\"right\">GL Code</th><td>";
  echo "<select name=\"glcode\">";
  $result11 = mysql_query("SELECT tblfinglref.glrefid, tblfinglref.glcode, tblfinglref.glname FROM tblfinglref LEFT JOIN tblfinworkpaperref ON tblfinglref.glcode = tblfinworkpaperref.glcode WHERE tblfinglref.version=$glrefver10 ORDER BY tblfinglref.glcode ASC", $dbh);
  if($result11 != '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $glrefid11 = $myrow11[0];
      $glcode11 = $myrow11[1];
      $glname11 = $myrow11[2];
			if($glcode11 == $glcode10) { $glcodesel="selected"; } else { $glcodesel=""; }
      echo "<option value=\"$glcode11\" $glcodesel>$glcode11 - $glname11</option>";
    }
  }
  echo "</select></td></tr>";
  echo "<input type=\"hidden\" name=\"glrefver\" value=\"$glrefver10\">";
  echo "<td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"Update\"></td></form></tr>";

  echo "</table>";

// end contents here...


// edit body-footer
     echo "<p><a href=\"mngfinwpref.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
