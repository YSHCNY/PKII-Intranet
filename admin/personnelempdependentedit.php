<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empdependentid = $_GET['did'];

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
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b</td></tr>";
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

	echo "<div class = 'shadow p-4 '><h4>Edit Dependents For: $name_last, $name_first $name_middle[0] ($employeeid) - $position</h4></div>";

// start edit dependent

	$result2 = mysql_query("SELECT * FROM tblempdependent WHERE employeeid = '$employeeid' AND empdependentid = $empdependentid", $dbh);

	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $empdependentid = $myrow2[0];
//	  $employeeid = $myrow2[1];
	  $empdependentctr = $myrow2[2];
	  $dependentlast = $myrow2[3];
	  $dependentfirst = $myrow2[4];
	  $dependentmiddle = $myrow2[5];
	  $dependentbirthdate = $myrow2[6];
	  $dependentrelation = $myrow2[7];
	}
	echo "<table class = 'table table-hover table-striped table-bordered border'>";


	echo "<form action=personnelempdependentedit2.php?loginid=$loginid&eid=$employeeid&did=$empdependentid method=post>";

	echo "<tr><td align='right'>Name</td><td>";
	echo "<table><tr><td><input  class ='form-control'  name=dependentfirst value='$dependentfirst'></td>";
	echo "<td><input class ='form-control'  name=dependentmiddle value='$dependentmiddle'></td><td><input class ='form-control'  name=dependentlast value='$dependentlast'></td></tr>";
	echo "<tr><td><i>First</i</td><td><i>Middle</i</td><td><i>Last</i</td></tr></table></td></tr>";

	echo "<tr><td align='right'>Birthdate</td><td> <input class = 'form-control' name='dependentbirthdate' type='date' value ='$dependentbirthdate'></td></tr>";

	echo "<tr><td align='right'>Relationship</td><td><input class ='form-control'  name=dependentrelation value='$dependentrelation'></td></tr>";


     }

     echo "</table>";
	 echo "<div class ='text-end'><a href=personneledit2.php?loginid=$loginid&pid=$employeeid class = 'mx-1 btn'>Back</a> <button type=submit class = 'bg-success mx-1 text-white btn'>Update</button></div></form>";



     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
