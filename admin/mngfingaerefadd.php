<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$ver = $_GET['ver'];

if ($ver == '')
{
  $result10 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
  if($result10 != '')
  {
    while($myrow10 = mysql_fetch_row($result10))
    {
      $found10 = 1;
      $version10 = $myrow10[0];
    }
  }
  $ver = $version10;
}

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

  echo "<tr><th colspan=\"2\">GAE Ref Codes - add new</th></tr>";

  echo "<form action=\"mngfingaerefadd2.php?loginid=$loginid&ver=$ver\" method=\"post\">";

  echo "<tr><th align=\"right\">GAE code</th><td><input name=\"gaecd\" size=\"20\"></td></tr>";

  echo "<tr><th align=\"right\">Acct name</th><td><input name=\"acctname\" size=\"50\"></td></tr>";

  // get next sequence number first and display
  $found15=0; $result15=""; $seq15="";
  $result15 = mysql_query("SELECT seq FROM tblfingaeref ORDER BY seq DESC LIMIT 1", $dbh);
  if($result15 != "") {
    while($myrow15 = mysql_fetch_row($result15)) {
    $found15 = 1;
    $seq15 = $myrow15[0];
    }
  }
  if($seq15 != "") { $seqfin=$seq15+10; } else { $seqfin=10; }
  echo "<tr><th align=\"right\">Sequence order</th><td><input name=\"seq\" type=\"number\" min=\"01\" max=\"2000\" value=\"$seqfin\" size=\"5\"></td></tr>";

  echo "<tr><th align=\"right\">GL Code from</th><td>";
  echo "<select name=\"glcodefr\">";
	echo "<option value=''>-</option>";
  $result11 = mysql_query("SELECT tblfinglref.glrefid, tblfinglref.glcode, tblfinglref.glname FROM tblfinglref LEFT JOIN tblfinworkpaperref ON tblfinglref.glcode = tblfinworkpaperref.glcode WHERE tblfinglref.version=$ver AND (tblfinglref.glcode>=\"70.00.000\" AND tblfinglref.glcode<=\"70.99.999\") ORDER BY tblfinglref.glcode ASC", $dbh);
  if($result11 != '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $glrefid11 = $myrow11[0];
      $glcode11 = $myrow11[1];
      $glname11 = $myrow11[2];
      echo "<option value=\"$glcode11\">$glcode11 - $glname11</option>";
    }
  }
  echo "</select><br><font size=\"1\"><i>Note: if the account name has only 1 GL code, please input same GL Codes on both fields</i></font></td></tr>";

  echo "<tr><th align=\"right\">GL Code to</th><td>";
  echo "<select name=\"glcodeto\">";
	echo "<option value=''>-</option>";
  $result12 = mysql_query("SELECT tblfinglref.glrefid, tblfinglref.glcode, tblfinglref.glname FROM tblfinglref LEFT JOIN tblfinworkpaperref ON tblfinglref.glcode = tblfinworkpaperref.glcode WHERE tblfinglref.version=$ver AND (tblfinglref.glcode>=\"70.00.000\" AND tblfinglref.glcode<=\"70.99.999\") ORDER BY tblfinglref.glcode ASC", $dbh);
  if($result12 != '')
  {
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $glrefid12 = $myrow12[0];
      $glcode12 = $myrow12[1];
      $glname12 = $myrow12[2];
      echo "<option value=\"$glcode12\">$glcode12 - $glname12</option>";
    }
  }
  echo "</select><br><font size=\"1\"><i>Note: if the account name has only 1 GL code, please input same GL Codes on both fields</i></font></td></tr>";

  echo "<input type=\"hidden\" name=\"version\" value=\"$ver\">";
  echo "<td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"Add\"></td></form></tr>";

  echo "</table>";

// end contents here...


// edit body-footer
     echo "<p><a href=\"mngfingaeref.php?loginid=$loginid&ver=$ver\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 