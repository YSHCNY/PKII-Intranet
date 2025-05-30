<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$finglrefdefaultid = $_POST['did'];

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
  echo "<p><font size=1>Manage >> Accounting Modules >> Acct Codes</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"8\">Saving default version of Acct Code</th></tr>";

// start contents here...

  include("datetimenow.php");

  echo "<tr><td>Details</td></tr>";

  echo "<tr><td>Setting value=on id:$finglrefdefaultid</td></tr>";
  $result12 = mysql_query("UPDATE tblfinglrefdefault SET defaultval=\"on\" WHERE finglrefdefaultid=$finglrefdefaultid", $dbh);

  $result14 = mysql_query("SELECT finglrefdefaultid FROM tblfinglrefdefault WHERE finglrefdefaultid<>$finglrefdefaultid", $dbh);  
  $found14 = 0;
  while($myrow14 = mysql_fetch_row($result14))
  {
    $found14 = 1;
    $finglrefdefaultid14 = $myrow14[0];

    echo "<tr><td>Setting value=off id:$finglrefdefaultid14</td></tr>";
    $result15 = mysql_query("UPDATE tblfinglrefdefault SET defaultval=\"off\" WHERE finglrefdefaultid=$finglrefdefaultid14", $dbh);
  }

  echo "<tr><td>Status: OK - Saved.</td></tr>";
  echo "<tr><td align=\"center\">";
  echo "<form action=\"mngfinglref.php?loginid=$loginid\" method=\"post\">";
  echo "<input type=\"submit\" value=\"OK\"></form></td></tr>";

// end contents here...

  echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngfinglref.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
