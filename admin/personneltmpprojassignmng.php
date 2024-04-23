<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$tmpprojtype = $_POST['tmpprojtype'];
$tmpprojorder = $_POST['tmpprojorder'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Manage >> Personnel >> tmp.Project Assignments</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=13><font color=white><b>Manage tmp.Project Assignments</b></font></td></tr>";
     echo "<tr><td colspan=13>";

// start tmp.project assignments

     echo "<form action=personneltmpprojassignmng.php?loginid=$loginid method=POST>";
     echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr>";

     echo "<td valign=bottom><font size=1>Choose criteria for personnels</font><br>";
     echo "<select name=tmpprojtype>";
     echo "<option value=withEmpNum selected>with Employee Numbers</option>";
     echo "<option value=withoutEmpNum>without Employee Numbers</option>";
     echo "<option value=allEmp>ALL</option>";
     echo "</select></td>";

     echo "<td valign=bottom><font size=1>Sort by</font><br>";
     echo "<select name=tmpprojorder>";
     echo "<option value=name_last selected>Last Name</option>";
     echo "<option value=name_first>First Name</option>";
     echo "<option value=employeeid>Employee Number</option>";
     echo "<option value=proj_name>Project</option>";
     echo "<option value=position>Position</option>";
     echo "<option value=durationfrom>Proj. Duration (From)</option>";
     echo "<option value=durationto>Proj. Duration (To)</option>";
     echo "</select></td>";

     echo "<td valign=bottom><input type=submit value=Go></td>";
     echo "</tr></table>";
     echo "</form>";

     echo "</td></tr>";

     if($tmpprojtype == 'withEmpNum')
     {
	$result9 = mysql_query("SELECT projectassign0id, ref_no, employeeid, employeeid1, name_last, name_first, name_middle, proj_code, proj_name, position, durationfrom, durationto FROM tblprojassign0 WHERE employeeid1 <> '' ORDER BY $tmpprojorder", $dbh);

	$empprojctr = 0;

	echo "<tr><td colspan=13>Displaying list: <b>$tmpprojtype</b> in <b>$tmpprojorder</b> order.</td></tr>";

	echo "<tr><td bgcolor=yellow>Ctr</td><td bgcolor=yellow>Ref#</td><td bgcolor=yellow>OldEmp#</td><td bgcolor=yellow>Employee#</td><td bgcolor=yellow>LastName</td><td bgcolor=yellow>FirstName</td><td bgcolor=yellow>Middle</td><td bgcolor=yellow>ProjectName</td><td bgcolor=yellow>Position</td><td bgcolor=yellow>From</td><td bgcolor=yellow>To</td><td bgcolor=yellow>Action1</td><td bgcolor=yellow>Action2</td></tr>";
	while ($myrow9 = mysql_fetch_row($result9))
	{
	  $found9 = 1;
	  $projectassign0id = $myrow9[0];
	  $ref_no = $myrow9[1];
	  $employeeid = $myrow9[2];
	  $employeeid1 = $myrow9[3];
	  $name_last = $myrow9[4];
	  $name_first = $myrow9[5];
	  $name_middle = $myrow9[6];
	  $proj_code = $myrow9[7];
	  $proj_name = $myrow9[8];
	  $position = $myrow9[9];
	  $durationfrom = $myrow9[10];
	  $durationto = $myrow9[11];

	  $empprojctr = $empprojctr + 1;

	  echo "<tr><td>$empprojctr</td><td>$ref_no</td><td>$employeeid</td><td>$employeeid1</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td><td>$proj_name</td><td>$position</td><td>$durationfrom</td><td>$durationto</td>";
	  echo "<td><a href=personneltmpprojassignupd2.php?loginid=$loginid&pr0id=$projectassign0id&eid=$employeeid1&prjid=$projectassign0id>Propagate</a></td>";
	  echo "<td><a href=personneltmpprojassignedit3.php?loginid=$loginid&pr0id=$projectassign0id&eid=$employeeid1&prjid=$projectassign0id>Edit</a></td></tr>";
	}
     }
     else if($tmpprojtype == 'withoutEmpNum')
     {
	$result9 = mysql_query("SELECT projectassign0id, ref_no, employeeid, employeeid1, name_last, name_first, name_middle, proj_code, proj_name, position, durationfrom, durationto FROM tblprojassign0 WHERE employeeid1 = '' ORDER BY $tmpprojorder", $dbh);

	$empprojctr = 0;

	echo "<tr><td colspan=12>Displaying list: <b>$tmpprojtype</b> in <b>$tmpprojorder</b> order.</td></tr>";

	echo "<tr><td>Ctr</td><td>Ref#</td><td>OldEmp#</td><td>Employee#</td><td>LastName</td><td>FirstName</td><td>Middle</td><td>ProjectName</td><td>Position</td><td>From</td><td>To</td><td>Action1</td></tr>";
	while ($myrow9 = mysql_fetch_row($result9))
	{
	  $found9 = 1;
	  $projectassign0id = $myrow9[0];
	  $ref_no = $myrow9[1];
	  $employeeid = $myrow9[2];
	  $employeeid1 = $myrow9[3];
	  $name_last = $myrow9[4];
	  $name_first = $myrow9[5];
	  $name_middle = $myrow9[6];
	  $proj_code = $myrow9[7];
	  $proj_name = $myrow9[8];
	  $position = $myrow9[9];
	  $durationfrom = $myrow9[10];
	  $durationto = $myrow9[11];

	  $empprojctr = $empprojctr + 1;

	  echo "<tr><td>$empprojctr</td><td>$ref_no</td><td>$employeeid</td><td>$employeeid1</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td><td>$proj_name</td><td>$position</td><td>$durationfrom</td><td>$durationto</td>";
//	  echo "<td><a href=personneltmpprojassignupd2.php?loginid=$loginid&eid=$employeeid1&prjid=$projectassign0id>Propagate</a></td>";
	  echo "<td><a href=personneltmpprojassignedit3.php?loginid=$loginid&eid=$employeeid1&prjid=$projectassign0id>Edit</a></td></tr>";
	}
     }
     else if($tmpprojtype == 'allEmp')
     {
	$result9 = mysql_query("SELECT projectassign0id, ref_no, employeeid, name_last, name_first, name_middle, proj_code, proj_name, position, durationfrom, durationto FROM tblprojassign0 WHERE projectassign0id <> '' ORDER BY $tmpprojorder", $dbh);

	$empprojctr = 0;

	echo "<tr><td colspan=11>Displaying list: <b>$tmpprojtype</b> in <b>$tmpprojorder</b> order.</td></tr>";

	echo "<tr><td>Ctr</td><td>Ref#</td><td>Employee#</td><td>LastName</td><td>FirstName</td><td>Middle</td><td>ProjectName</td><td>Position</td><td>From</td><td>To</td><td>Action1</td></tr>";
	while ($myrow9 = mysql_fetch_row($result9))
	{
	  $found9 = 1;
	  $projectassign0id = $myrow9[0];
	  $ref_no = $myrow9[1];
	  $employeeid = $myrow9[2];
	  $name_last = $myrow9[3];
	  $name_first = $myrow9[4];
	  $name_middle = $myrow9[5];
	  $proj_code = $myrow9[6];
	  $proj_name = $myrow9[7];
	  $position = $myrow9[8];
	  $durationfrom = $myrow9[9];
	  $durationto = $myrow9[10];

	  $empprojctr = $empprojctr + 1;

	  echo "<tr><td>$empprojctr</td><td>$ref_no</td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td><td>$proj_name</td><td>$position</td><td>$durationfrom</td><td>$durationto</td>";
//	  echo "<td><a href=personneltmpprojassignupd2.php?loginid=$loginid&eid=$employeeid&prjid=$projectassign0id>Propagate</a></td>";
	  echo "<td><a href=personneltmpprojassignedit3.php?loginid=$loginid&eid=$employeeid&prjid=$projectassign0id>Edit</a></td></tr>";
	}
     }

// end tmp.project assignments

     echo "</table>"; 
   
     echo "<p><a href=personneledit.php?loginid=$loginid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
