<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empeducationid = $_GET['edid'];

$coursegraduated = $_POST['coursegraduated'];
$yeargraduated = $_POST['yeargraduated'];
$schoolgraduated = $_POST['schoolgraduated'];
$schooladdress = $_POST['schooladdress'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit education</font></p>";

  echo "<p><font color=green><b>Update Educational Attainment Successful!</b></font></p>";

  $result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {    
	$found = 1;
	$name_last = $myrow[1];
	$name_first = $myrow[2];
	$name_middle = $myrow[3];
  }
  echo "<p>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b></p>";

  if ($empeducationid == '')
  {
	$result1 = mysql_query("INSERT INTO tblempeducation (employeeid, coursegraduated, yeargraduated, schoolgraduated, schooladdress) VALUES ('$employeeid', '$coursegraduated', '$yeargraduated', '$schoolgraduated', '$schooladdress')", $dbh) or die("Couldn't execute query.".mysql_eror());

  }
  else
  {
	$result2 = mysql_query("UPDATE tblempeducation SET employeeid='$employeeid', coursegraduated='$coursegraduated', yeargraduated='$yeargraduated', schoolgraduated='$schoolgraduated', schooladdress='$schooladdress' WHERE empeducationid = $empeducationid AND employeeid = '$employeeid'", $dbh) or die("Couldn't execute query.".mysql_error());
  }

  echo "Details:<br>";
  echo "employeeid=$employeeid<br>";
  echo "coursegraduated=$coursegraduated<br>";
  echo "yeargraduated=$yeargraduated<br>";
  echo "schoolgraduated=$schoolgraduated<br>";
  echo "schooladdress=$schooladdress<br>";
  echo "Update Record - OK<br>";

  echo "<p>";

  echo "<a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Updated record details of:$employeeid - $name_last, $name_first, $name_middle[0]. Details updated: coursegraduated = '$coursegraduated', yeargraduated = '$yeargraduated', schoolgraduated =  '$schoolgraduated', schooladdress = , '$schooladdress' ";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);


  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

