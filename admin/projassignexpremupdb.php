<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$projassignexpiringid = $_GET['prexpid'];
$cutoffdate = $_GET['codate'];
$projectassign0id = $_GET['pr0id'];
$employeeid = $_GET['eid'];

$remarks12 = $_POST['remarks12'];

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
     echo "<p><font size=1>Modules >> Project Assignments >> List of Expiring Contracts >> Update remarks</font></p>";

echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue><font color=white><b>List of Expiring Contracts - Saving remarks</b></font></td></tr>";

// start contents here...

	$result1 = mysql_query("UPDATE tblprojassignexpiring SET remarks = \"$remarks12\" WHERE projassignexpiringid = $projassignexpiringid AND projassign0id = $projectassign0id", $dbh);

	echo "<tr><td>$projassignexpiringid - $cutoffdate - $projectassign0id - $employeeid - $remarks12</td></tr>";

// end contents here...

     echo "<tr><td align=center><b>OK - Results saved</b></td></tr>";
     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=projassignexpcutoff.php?loginid=$loginid&codate1=$cutoffdate>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 