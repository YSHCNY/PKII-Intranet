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
     echo "<p><font size=1>Modules >> Project Assignments >> List of Expiring Contracts >> Finalize</font></p>";

echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue><font color=white><b>List of Expiring Contracts - Finalizing</b></font></td></tr>";

// start contents here...

	include ("datetimenow.php");

	$result1 = mysql_query("SELECT projassignexpiringid, cutoffdate, cutoffname, projassignid, projassign0id, employeeid, remarks FROM tblprojassignexpiring WHERE cutoffdate = '$cutoffdate'", $dbh);

	while($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $projassignexpiringid = $myrow1[0];
	  $cutoffdate = $myrow1[1];
	  $cutoffname = $myrow1[2];
	  $projassignid = $myrow1[3];
	  $projectassign0id = $myrow1[4];
	  $employeeid1 = $myrow1[5];
	  $remarks = $myrow1[6];

	  if ($remarks != '')
	  {
	    $result6 = mysql_query("SELECT durationto, durationto2 FROM tblprojassign WHERE projassignid=$projassignid AND employeeid=\"$employeeid1\"", $dbh);
	    $found6 = 0;
	    while($myrow6 = mysql_fetch_row($result6))
	    {
	      $found6 = 1;
	      $durationto6 = $myrow6[0];
	      $durationto26 = $myrow6[1];

	      $dateend6 = '';

	      if($durationto26 == '' || $durationto26 == '0000-00-00')
	      {
		$dateend6 = "$durationto6";
	      }
	      else if($durationto6 == '' || $durationto6 == '0000-00-00')
	      {
		$dateend6 = "$durationto26";
	      }
	    }
	    $result2 = mysql_query("UPDATE tblprojassign SET remarks = \"$remarks\", term_resign = \"$dateend6\" WHERE projassignid = $projassignid AND employeeid = \"$employeeid1\"", $dbh);
 
	    echo "<tr><td>$projassignexpiringid - $cutoffdate - $projassignid - $employeeid1 - $remarks - $dateend6</td></tr>";

	    if($projassign0id <> '')
	    {
	      $result4 = mysql_query("UPDATE tblprojassign0 SET remarks = \"$remarks\", term_resign = \"$dateend6\" WHERE projectassign0id = $projectassign0id AND employeeid1 = \"$employeeid1\"", $dbh);

	      echo "<tr><td>$projassignexpiringid - $cutoffdate - $projectassign0id - $employeeid1 - $remarks - $dateend6</td></tr>";
	    }

	    $result5 = mysql_query("UPDATE tblprojassignexpiring SET stat_finalized = \"yes\" WHERE projassignexpiringid = $projassignexpiringid AND cutoffdate = \"$cutoffdate\"", $dbh);

	    echo "<tr><td>$projassignexpiringid - $cutoffdate - stat_finalized:yes</td></tr>";
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
