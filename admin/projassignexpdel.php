<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$cutoffdate = $_GET['codate'];

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
     echo "<p><font size=1>Modules >> Project Assignments >> List of Expiring Contracts >> Delete cut-off</font></p>";

echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=red><font color=white><b>List of Expiring Contracts - Deleting cut-off</b></font></td></tr>";

// start contents here...

	$result1 = mysql_query("SELECT projassignexpiringid, cutoffdate, cutoffname, projassignid, projassign0id, employeeid, remarks FROM tblprojassignexpiring WHERE cutoffdate = '$cutoffdate'", $dbh);

	$found1 = 0;

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $projassignexpiringid = $myrow1[0];
//	  $cutoffdate = $myrow1[1];
	  $cutoffname = $myrow1[2];
	  $projassignid = $myrow1[3];
	  $projectassign0id = $myrow1[4];
	  $employeeid = $myrow1[5];
	  $remarks = $myrow1[6];

	  if ($found1 ==1)
	  {

	    $result2 = mysql_query("DELETE FROM tblprojassignexpiring WHERE cutoffdate = '$cutoffdate'", $dbh);
 
	    echo "<tr><td>deleting: $projassignexpiringid - $cutoffdate - $projassignid - $employeeid - $remarks</td></tr>";
	  }

	}

// end contents here...

     echo "<tr><td align=center><b>OK - eof</b></td></tr>";
     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=projassignexpiring.php?loginid=$loginid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
