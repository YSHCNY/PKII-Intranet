<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_POST['employeeid'];
$groupname = $_POST['groupname'];
$accesslevel = $_POST['accesslevel'];
$member = $_POST['member'];
$name_first = $_POST['name_first'];
$name_middle = $_POST['name_middle'];
$name_last = $_POST['name_last'];
$email1 = $_POST['email1'];

$found = 0;
$exist = 0;
$datecreated = date("Y-m-d");


if ($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><b>Creating Group Members</b></p>";

     foreach ($member as $val)
     {
	$result0 = mysql_query("SELECT employeeid, name_first, name_middle, name_last, email1 FROM tblcontact WHERE employeeid='$val'", $dbh);

	while ($myrow0 = mysql_fetch_row($result0))
	{
	  echo "Updating:$groupname - $myrow0[0] - name:$myrow0[1] $myrow0[2] $myrow0[3] - $myrow0[4] - datecreated:$datecreated - status:active<br>";
	}
	$result1 = mysql_query("INSERT INTO tblemppaybongrp (employeeid, groupname, datecreated, status, accesslevel) VALUES (\"$val\", \"$groupname\", \"$datecreated\", \"active\", $accesslevel)", $dbh);
	$result2 = mysql_query("INSERT INTO tblemppaybonus (employeeid, groupname, date, grossamt, taxdeduct, otherdeduct, netamt) VALUES (\"$val\", \"$groupname\", \"$datecreated\", 0, 0, 0, 0)", $dbh);
     }
     echo "<p>Finished updating...<br>";
     echo "<p><a href=emppaybon01.php?loginid=$loginid><b>Back to Bonus Notifier Menu</b></a><br>";    
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
