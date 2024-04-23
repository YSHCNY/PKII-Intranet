<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];

$dependentfirst = $_POST['dependentfirst'];
$dependentmiddle = $_POST['dependentmiddle'];
$dependentlast = $_POST['dependentlast'];
$dependentbirthdate = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
$dependentrelation = $_POST['dependentrelation'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Change dependent's birthdate</font></p>";

  if ($dependentfirst == '')
  {
    echo "<p><font color=red><b>Sorry first name should not be blank</b></font><//p>";

    echo "<p><a href=personnelempdependentadd.php?loginid=$loginid&eid=$employeeid>Back</a></p>";
  }
  else
  {


	echo "<p><font color=green><b>Add new dependent successful!</b></font></p>";

	$result0 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
	  $name_last = $myrow0[0];
	  $name_first = $myrow0[1];
	  $name_middle = $myrow0[2];
	}

	echo "<p>For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b><br>";
	echo "New Dependent Record: $dependentfirst $dependentmiddle $dependentlast - $dependentbirthdate - $dependentrelation<br>";

	$result = mysql_query("INSERT INTO tblempdependent (employeeid, dependentlast, dependentfirst, dependentmiddle, dependentbirthdate, dependentrelation) VALUES ('$employeeid', '$dependentlast', '$dependentfirst', '$dependentmiddle', '$dependentbirthdate', '$dependentrelation')", $dbh) or die ("Couldn't execute query.".mysql_error());

	echo "employeeid = $employeeid<br>";
	echo "first = $dependentfirst<br>";
	echo "middle = $dependentmiddle<br>";
	echo "last = $dependentlast<br>";
	echo "birthdate = $dependentbirthdate<br>";
	echo "relation = $dependentrelation<br>";
	echo "Add new dependent record - OK<br>";

     echo "<p><a href = personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a></p>";

  }

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

