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
     echo "<p><font size=1>Modules >> HR Reports</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>HR Reports</b></font></td></tr>";

// start contents here...

     echo "<tr>";
     echo "<td><form action=persrptemployee.php?loginid=$loginid method=post><input type=submit value=\"List of Employees\"></form></td>";
     echo "<td>Displays the list of active or inactive EMPLOYEES with current project assignments and their rates.</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<td><form action=persrptconsultant.php?loginid=$loginid method=post><input type=submit value=\"List of Consultants\"></form></td>";
     echo "<td>Displays the list of active or inactive CONSULTANTS with current project assignments and their rates.</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<td><form action=persrptbenefits.php?loginid=$loginid method=post><input type=submit value=\"List of Gov't ID's\"></form></td>";
     echo "<td>Displays the list of PERSONNELS with details re HR information including Gov't. Benefits ID numbers.</td>";
     echo "</tr>";

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
