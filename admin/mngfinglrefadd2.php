<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$glcode = $_POST['glcode'];
$glname = $_POST['glname'];
$version = $_POST['version'];
$remarks = $_POST['remarks'];

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

  echo "<tr><th colspan=\"8\">Saving new GL Code</th></tr>";

// start contents here...

  include("datetimenow.php");

if($glcode <> "" && $glname <> "")
{
  $result12 = mysql_query("SELECT glrefid, glcode, glname FROM tblfinglref WHERE glcode=\"$glcode\" AND version=$version", $dbh);
  $found12 = 0;
  while($myrow12 = mysql_fetch_row($result12))
  {
    $found12 = 1;
    $glcode12 = $myrow12[1];
    $glname12 = $myrow12[2];
  }

  $result14 = mysql_query("SELECT glrefid, glcode, glname FROM tblfinglref WHERE glname=\"$glname\" AND version=$version", $dbh);
  $found14 = 0;
  while($myrow14 = mysql_fetch_row($result14))
  {
    $found14 = 1;
    $glcode14 = $myrow14[1];
    $glname14 = $myrow14[2];
  }

  if($found12 == 1 OR $found14 == 1)
  {
    echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, GL Code or GL Name existing. Please try again.</font></td></tr>";
//    echo "<tr><td colspan=\"2\">$glcode=$glcode12, $glname=$glname14</td></tr>";
  }
  else
  {
    echo "<tr><td>Details</td><td>";
    echo "GLcode:$glcode<br>";
    echo "GLname:$glname<br>";
    echo "Ver:$version<br>";
    echo "Updated:$datenow<br>";
    echo "Remarks:$remarks<br>";
    echo "</td></tr>";

    $result11 = mysql_query("INSERT INTO tblfinglref SET glcode=\"$glcode\", glname=\"$glname\", version=$version, date=\"$datenow\", remarks=\"$remarks\"", $dbh);

    echo "<tr><td>Status</td><td>OK - Saved.</td></tr>";
  }

  echo "<tr><td colspan=\"2\" align=\"center\">";
  echo "<form action=\"mngfinglref.php?loginid=$loginid\" method=\"post\">";
  echo "<input type=\"submit\" value=\"OK\"></form></td></tr>";
}
else
{
    echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, GL Code or GL Name should not be blank. Please try again.</font></td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\">";
  echo "<form action=\"mngfinglrefadd.php?loginid=$loginid\" method=\"post\">";
  echo "<input type=\"submit\" value=\"OK\"></form></td></tr>";
}

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
