<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$glrefid = $_GET['glid'];

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

  echo "<tr><th colspan=\"8\"><font color=\"red\">Deleting GL Code</font></th></tr>";

// start contents here...

  include("datetimenow.php");

  $result12 = mysql_query("SELECT glcode, glname, version FROM tblfinglref WHERE glrefid=$glrefid", $dbh);
  while($myrow12 = mysql_fetch_row($result12))
  {
    $found12 = 1;
    $glcode12 = $myrow12[0];
    $glname12 = $myrow12[1];
    $version12 = $myrow12[2];
  }
  
    echo "<tr><td>Details</td><td>";
    echo "GLrefid:$glrefid<br>";
    echo "GLcode:$glcode12<br>";
    echo "GLname:$glname12<br>";
    echo "Ver:$version12<br>";
    echo "</td></tr>";

    $result11 = mysql_query("DELETE FROM tblfinglref WHERE glrefid=$glrefid", $dbh);

    echo "<tr><td>Status</td><td>OK - Deleted.</td></tr>";

  echo "<tr><td colspan=\"2\" align=\"center\">";
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
