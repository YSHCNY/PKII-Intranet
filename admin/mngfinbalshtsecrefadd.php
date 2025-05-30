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
  echo "<p><font size=1>Manage >> Accounting Modules >> Balance Sheet categories</font></p>";

// start contents here...

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"2\">Manage Balance Sheet categories - add new</th></tr>";

  echo "<form action=\"mngfinbalshtsecrefadd2.php?loginid=$loginid&ver=$ver\" method=\"post\">";

  echo "<tr><th align=\"right\">Code</th><td>";
	echo "<input name=\"code\" size=\"1\">";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Name</th><td>";
	echo "<input name=\"name\">";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Remarks</th><td>";
	echo "<textarea name=\"remarks\" cols=\"30\" rows=\"3\"></textarea>";
	echo "</td></tr>";

  echo "<tr><td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"Add\"></td></form></tr>";

  echo "</table>";

// end contents here...


// edit body-footer
     echo "<p><a href=\"mngfinbalshtsecref.php?loginid=$loginid&ver=$ver\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
