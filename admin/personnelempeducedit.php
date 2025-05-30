<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empeducationid = $_GET['edid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");


     echo "<tr><td bgcolor=blue colspan=2><b></b></td></tr>";

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

	echo "<div class = 'shadow mb-3 p-4'><h4>Edit Educational Attainment For:  $name_last, $name_first $name_middle[0] ($employeeid) - $position</h4></div>";

// start edit education

	$result2 = mysql_query("SELECT empeducationid, employeeid, empeducationctr, coursegraduated, yeargraduated, schoolgraduated, schooladdress, companyid FROM tblempeducation WHERE empeducationid=$empeducationid AND employeeid = '$employeeid'", $dbh);
   
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $empeducationid = $myrow2[0];
//	  $employeeid = $myrow2[1];
	  $empeducationctr = $myrow2[2];
	  $coursegraduated = $myrow2[3];
	  $yeargraduated = $myrow2[4];
	  $schoolgraduated = $myrow2[5];
	  $schooladdress = $myrow2[6];
	  $companyid = $myrow2[7];
	}
	echo "<table class = 'table table-striped table-hover table-bordered border'>";

	echo "<form action=personnelempeducedit2.php?loginid=$loginid&eid=$employeeid&edid=$empeducationid method=post>";
	echo "<tr><td align = 'right'>Course</td><td><input class ='form-control' name=coursegraduated value=\"$coursegraduated\"></td></tr>";
	echo "<tr><td align = 'right'>Year Graduated</td><td><input class ='form-control' name=yeargraduated value=\"$yeargraduated\"></td></tr>";
	echo "<tr><td align = 'right'>School/University Graduated</td><td><input class ='form-control' name=schoolgraduated value=\"$schoolgraduated\"></td></tr>";
	echo "<tr><td align = 'right'>Address</td><td><input class ='form-control' name=schooladdress value=\"$schooladdress\"></td></tr>";
	echo "</table>";
	echo "<div class = 'text-end'><a href=personneledit2.php?loginid=$loginid&pid=$employeeid class ='btn mx-1'>Cancel</a><button type='submit' class = 'btn mx-1 bg-success text-white'>Update Education Details</button></div>";
	
	echo"</form>";

// end edit education

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
