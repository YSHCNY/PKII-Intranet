<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empproflicenseid = $_GET['eplid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");



     if ($employeeid == '')
     {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $name_last = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $position = $myrow[3];
	}

	echo "<div class = 'p-4 shadow'><h4>Edit Professional License For:  $name_last, $name_first $name_middle[0] ($employeeid) - $position</h4></div>";

// start edit prof license

	$result2 = mysql_query("SELECT * FROM tblempproflicense WHERE empproflicenseid=$empproflicenseid AND employeeid = '$employeeid'", $dbh);
   
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
//	  $empproflicenseid = $myrow2[0];
//	  $employeeid = $myrow2[1];
	  $regulatoryboard = $myrow2[2];
	  $profession = $myrow2[3];
	  $licensenumber = $myrow2[4];
	  $licensedate = $myrow2[5];
	}
	echo "<table class = 'table border table-bordered table-striped table-hover'>";

	echo "<form action=personnelempproflicedit2.php?loginid=$loginid&eid=$employeeid&eplid=$empproflicenseid method=post>";
	echo "<tr><td align='right'>Regulatory Board</td><td><input class = 'form-control' name=regulatoryboard value=\"$regulatoryboard\"></td></tr>";
	echo "<tr><td align='right'>Profession</td><td><input class = 'form-control' name=profession value=\"$profession\"></td></tr>";
	echo "<tr><td align='right'>License Number</td><td><input class = 'form-control' name=licensenumber value=\"$licensenumber\"></td></tr>";
	echo "<tr><td align='right'>License Date</td><td><input class = 'form-control' type = 'date' name=licensedate value=\"$licensedate\"></td></tr>";
	echo "</table><div class = 'text-end'><a href=personneledit2.php?loginid=$loginid&pid=$employeeid&eplid=$eplid class = 'btn'>Cancel</a> <button class = 'btn bg-success text-white' type = 'submit'>Update</button></div></form>";

// end edit prof license

     }
 
     echo "<p><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
