<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empproflicenseid = $_GET['eplid'];

$regulatoryboard = $_POST['regulatoryboard'];
$profession = $_POST['profession'];
$licensenumber = $_POST['licensenumber'];
$licensedate = $_POST['licensedate'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Professional License</font></p>";

  echo "<p><font color=green><b>Update Professional License Successful!</b></font></p>";

  $result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {    
	$found = 1;
	$name_last = $myrow[1];
	$name_first = $myrow[2];
	$name_middle = $myrow[3];
  }
  echo "<p>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b></p>";

  if ($empproflicenseid == '')
  {
	$result1 = mysql_query("INSERT INTO tblempproflicense (employeeid, regulatoryboard, profession, licensenumber, licensedate) VALUES ('$employeeid', '$regulatoryboard', '$profession', '$licensenumber', '$licensedate')", $dbh) or die("Couldn't execute query.".mysql_eror());

  }
  else
  {
	$result2 = mysql_query("UPDATE tblempproflicense SET employeeid='$employeeid', regulatoryboard='$regulatoryboard', profession='$profession', licensenumber='$licensenumber', licensedate='$licensedate' WHERE empproflicenseid = $empproflicenseid AND employeeid = '$employeeid'", $dbh) or die("Couldn't execute query.".mysql_error());
  }

  echo "Details:<br>";
  echo "employeeid=$employeeid<br>";
  echo "regulatoryboard=$regulatoryboard<br>";
  echo "profession=$profession<br>";
  echo "licensenumber=$licensenumber<br>";
  echo "licensedate=$licensedate<br>";
  echo "Update Record - OK<br>";

  echo "<p>";

  echo "<a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

