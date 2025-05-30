<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];
$proj_code = $_GET['prjcd'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Project Assignment >> Change project code/name</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Change Project Code/Name</b></font></td></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
//	  $employeeid = $myrow[0];
	  $name_last = $myrow[1];
	  $name_first = $myrow[2];
	  $name_middle = $myrow[3];
	}

	echo "<tr><td colspan=2>For: <b>$employeeid - $name_last, $name_first $name_middle[0].</b></td></tr>";

	echo "<tr><td>Current Project Name</td><td>$proj_code - $proj_sname</td></tr>";
	echo "<tr><td>New Project Name</td><td>";

	echo "<form action=personnelprojassignchgproj2.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid&prjcd=$proj_code method=POST>";
	echo "<select class='chosen-select' name=proj_code>";
	echo "<option>Select</option>";

	$result2 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code != '' ORDER BY proj_code DESC", $dbh);
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $proj_code2 = $myrow2[0];
	  $proj_fname = $myrow2[1];
	  $proj_sname = $myrow2[2];
	  $proj_fname2 = substr("$proj_fname", 0, 50);

	  echo "<option name=proj_code value=$proj_code2>$proj_code2 - $proj_sname - $proj_fname2</option>";
	}

     echo "<tr><td>&nbsp;</td><td><input type=submit value='Update'></td></tr>";
     echo "</select></form></td></tr>";

     }

     echo "</table>";
 
     echo "<p><a href = personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 



<script>
		$(document).ready(function(){
			$('.chosen-select').chosen();
		});
</script>
