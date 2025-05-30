<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$cutoffdate0 = $_GET['codate'];
$cutoffname = $_GET['coname'];

$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];

$cutoffdate = $year . "-" . $month . "-" . $day;

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
     echo "<p><font size=1>Modules >> Project Assignments >> List of Expiring Contracts</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>List of Expiring Contracts Menu</b></font></td></tr>";

// start contents here...

     echo "<tr>";

     echo "<td><form action=projassignexpgenerate.php?loginid=$loginid method=post><input type=submit value=\"Generate cut-off\"></form></td>";
     echo "<td><form action=projassignexpcutoff.php?loginid=$loginid method=post><input type=submit value=\"Choose cut-off\"></form></td>";

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
