<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empdependentid = $_GET['did'];

$dependentlast = $_POST['dependentlast'];
$dependentfirst = $_POST['dependentfirst'];
$dependentmiddle = $_POST['dependentmiddle'];
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

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit dependents</font></p>";

	echo "<p><font color=green><b>Dependent details updated!</b></font></p>";

  $result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {    
	$found = 1;
	$name_last = $myrow[1];
	$name_first = $myrow[2];
	$name_middle = $myrow[3];
  }
  echo "For: $employeeid - $name_last, $name_first $name_middle[0]</p>";

  $result2 = mysql_query("UPDATE tblempdependent SET dependentlast='$dependentlast', dependentfirst='$dependentfirst',
	dependentmiddle='$dependentmiddle', dependentrelation='$dependentrelation'
	WHERE employeeid='$employeeid' AND empdependentid=$empdependentid", $dbh) or die ("Couldn't execute query.".mysql_error());

  echo "Details:<br>";
  echo "first = $dependentfirst<br>";
  echo "middle = $dependentmiddle<br>";
  echo "last = $dependentlast<br>";
  echo "relation = $dependentrelation<br>";
  echo "Update Record - OK<br>";

  echo "<p><a href=personnelempdependentedit.php?loginid=$loginid&eid=$employeeid&did=$empdependentid>Back to Edit Dependent</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

