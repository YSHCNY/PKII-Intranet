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

  echo "<tr><th colspan=\"8\">Add GL Code</th></tr>";

// start contents here...

  include("datetimenow.php");

  echo "<form action=\"mngfinglrefadd2.php?loginid=$loginid\" method=\"post\">";
  echo "<tr><td>GL Code</td><td><input name=\"glcode\" size=\"15\"></td></tr>";
  echo "<tr><td>GL Name</td><td><input name=\"glname\" size=\"30\"></td></tr>";
  echo "<tr><td>Version</td><td><select name=\"version\">";
  echo "<option value=\"1\">1</option>";
  echo "<option value=\"2\">2</option>";
  echo "</select></td></tr>";
  echo "<tr><td>Remarks</td><td><textarea rows=\"2\" cols=\"40\" name=\"remarks\"></textarea></td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Save\"></form></td></tr>";

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
