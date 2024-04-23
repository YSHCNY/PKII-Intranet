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
     echo "<p><font size=1>Manage >> Accounting Modules >> Acct Codes</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"2\">Acct Codes - Set Default</th></tr>";

// start contents here...

     echo "<tr><form action=\"mngfinglrefdefault2.php?loginid=$loginid\" method=\"post\">";

     $result11 = mysql_query("SELECT * FROM tblfinglrefdefault WHERE finglrefdefaultid<>'' ORDER BY version ASC", $dbh);
     while($myrow11 = mysql_fetch_row($result11))
     {
	$found11 = 1;
	$finglrefdefaultid11 = $myrow11[0];
	$version11 = $myrow11[1];
	$description11 = $myrow11[2];
	$defaultval11 = $myrow11[3];

	if($defaultval11 == 'on')
	{
     echo "<tr><td><input type=\"radio\" name=\"did\" value=\"$finglrefdefaultid11\" checked>$version11</option></td><td>$description11</td></tr>";	  
	}
	else if($defaultval11 == 'off')
	{
     echo "<tr><td><input type=\"radio\" name=\"did\" value=\"$finglrefdefaultid11\">$version11</option></td><td>$description11</td></tr>";
	}
	else
	{
     echo "<tr><td><input type=\"radio\" name=\"did\" value=\"$finglrefdefaultid11\">$version11</option></td><td>$description11</td></tr>";
	}
     }
     echo "</select></tr>";
     echo "<td colspan=\"2\" align=\"center\"><input type=submit value=\"Set Default\"></form></td>";
     echo "</tr>";


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
