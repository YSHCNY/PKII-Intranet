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

  echo "<tr><th colspan=\"2\">Working Paper Account Codes - add new</th></tr>";

  echo "<form action=\"mngfinwprefadd2.php?loginid=$loginid&ver=$ver\" method=\"post\">";

  echo "<tr><th align=\"right\">Acct code</th><td><input name=\"wpacctcd\" size=\"10\"></td></tr>";
  echo "<tr><th align=\"right\">Acct name</th><td><input name=\"wpacctname\" size=\"50\"></td></tr>";

  // get next sequence number first and display
  $found15=0; $result15=""; $seq15="";
  $result15 = mysql_query("SELECT seq FROM tblfinworkpaperref ORDER BY seq ASC", $dbh);
  if($result15 != "") {
    while($myrow15 = mysql_fetch_row($result15)) {
    $found15 = 1;
    $seq15 = $myrow15[0];
    }
  }
  if($seq15 != "") { $seqfin=$seq15+1; } else { $seqfin=1; }
  echo "<tr><th align=\"right\">Sequence order</th><td><input name=\"seq\" type=\"number\" step=\"0.1\" min=\"01\" max=\"500\" value=\"$seqfin\"></td></tr>";

  // display chart of accts as initial glcode selection
  echo "<tr><th align=\"right\"></th><td>Note: please select a GL Code as initial item. You may use the Edit account function later for multiple GL codes in one account name.</td></tr>";
  echo "<tr><th align=\"right\">GL Code</th><td>";
  echo "<select name=\"glcode\">";
  $result11 = mysql_query("SELECT tblfinglref.glrefid, tblfinglref.glcode, tblfinglref.glname FROM tblfinglref LEFT JOIN tblfinworkpaperref ON tblfinglref.glcode = tblfinworkpaperref.glcode WHERE tblfinglref.version=$ver ORDER BY tblfinglref.glcode ASC", $dbh);
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
  echo "</select></td></tr>";
  echo "<input type=\"hidden\" name=\"glrefver\" value=\"$ver\">";
  echo "<td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"Add\"></td></form></tr>";

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
