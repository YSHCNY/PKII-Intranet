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

// start contents here...

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"2\">GAE (NK) Ref Codes - add new</th></tr>";

  echo "<form action=\"mngfinnkgaecdrefadd2.php?loginid=$loginid\" method=\"post\">";

  echo "<tr><th align=\"right\">GAE (NK) code</th><td><input name=\"nkgaecd\" size=\"20\"></td></tr>";

  echo "<tr><th align=\"right\">GAE (NK) Acct name</th><td><input name=\"nkgaeacctname\" size=\"50\"></td></tr>";

  // get next sequence number first and display
  $found15=0; $result15=""; $seq15="";
  $result15 = mysql_query("SELECT seq FROM tblfingaenkref ORDER BY seq DESC LIMIT 1", $dbh);
  if($result15 != "") {
    while($myrow15 = mysql_fetch_row($result15)) {
    $found15 = 1;
    $seq15 = $myrow15[0];
    }
  }
  if($seq15 != "") { $seqfin=$seq15+10; } else { $seqfin=10; }
  echo "<tr><th align=\"right\">Sequence order</th><td><input name=\"seq\" type=\"number\" min=\"01\" max=\"2000\" value=\"$seqfin\" size=\"5\"></td></tr>";

  echo "<td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"Add\"></td></form></tr>";

  echo "</table>";

// end contents here...


// edit body-footer
     echo "<p><a href=\"mngfinnkgaecdref.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 