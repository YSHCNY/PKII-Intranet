<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Project Assignment >> Add project</font></p>";

     echo "<table class=\"fin\" border=\"1\">";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add project</b></font></td></tr>";

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

	echo "<tr><th align=\"right\">choose project</th><td>";

	echo "<form action=\"personnelprojassignaddproj2.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\" method=\"post\" name=\"form1\">";
	echo "<select class='chosen-select' name=\"projectid\">";
	echo "<option>Select</option>";

	$result2 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code != '' ORDER BY proj_code DESC", $dbh);
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
		$projectid = $myrow2[0];
	  $proj_code2 = $myrow2[1];
	  $proj_fname = $myrow2[2];
	  $proj_sname = $myrow2[3];
	  $proj_fname2 = substr("$proj_fname", 0, 50);

	  echo "<option value=\"$projectid\">$proj_code2 - $proj_sname - $proj_fname2</option>";
	}
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">work duration</th><td>";
		echo "<input type=\"number\" name=\"duration\" value=\"0\" step=\"any\">";
		echo "<select name=\"durationprop\">";
	echo "<option value=''>Select</option>";
	echo "<option value=\"lumpsum\">Lumpsum</option>";
	echo "<option value=\"man-days\">Man-Days</option>";
	echo "<option value=\"man-months\">Man-Months</option>";
	echo "<option value=\"man-years\">Man-Years</option>";
	echo "<option value=\"others\">Others</option>";
		echo "</select>";
	echo "</td></tr>";

     echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
     echo "</form></td></tr>";
     }

     echo "</table>";
 
     echo "<p><a href =\"personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid\">Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     // include ("footer.php");
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
