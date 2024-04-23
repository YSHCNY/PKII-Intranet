<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_POST['employeeid'];
$groupname = $_POST['groupname'];
$datecreated = date("Y-m-d");

$found = 0;
$exist = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Personnel Bonus Notifier >> Create group</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=6><font color=white><b>Creating Group</b></font></td></tr>";

// check if groupname is existing
     $result = mysql_query("SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp WHERE groupname='$groupname'", $dbh);

//     if ($myrow = mysql_fetch_row($result))
//     {
//	$exist = 1;
//	echo "<b><font color=red>Groupname $myrow[0] exists.</font></b><br>";
//	echo "<p>Please enter another name.</p>";
//     }
//     elseif ($groupname == '')
//     {
//	echo "<b><font color=red>You have entered a blank groupname.</font></b><br>";
//	echo "<p>Please enter another name.</p>";
//     }
//     else
//     {

// display personnel list and get members 
	$exist = 0;

	echo "<tr><td colspan=5>Please select members for this group:<br><br>";

	echo "<form action=emppaybongrpadd3.php?loginid=$loginid method=POST>";

	echo "Groupname:<input name=\"groupname\" value=\"$groupname\">&nbsp;&nbsp;&nbsp;Accesslevel:";
	echo "<select name=\"accesslevel\">";
	echo "<option value=3>3</option>";
	echo "<option value=5>5</option>";
	echo "</td><td><i>Note:<br>Accesslevel:3 - All personnel group<br>Accesslevel:5 - Confidential group</i></td></tr>";

	$result2 = mysql_query("SELECT employeeid, name_first, name_middle, name_last, email1 FROM tblcontact WHERE employeeid<>'' ORDER BY name_last", $dbh);

	echo "<tr><td>Select</td><td>EmployeeID</td><td>Last</td><td>First</td><td>Middle</td><td>email</td></tr>";

	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $employeeid = $myrow2[0];
	  $name_first = $myrow2[1];
	  $name_middle = $myrow2[2];
	  $name_last = $myrow2[3];
	  $email1 = $myrow2[4];
//	  echo "$myrow2[0]";
//	  echo "$myrow2[1]";
//	  echo "$myrow2[2]";
//	  echo "$myrow2[3]<br>";
//	  echo "$employeeid - $name_first $name_middle $name_last<br>";
	  echo "<tr>";
	  echo "<td><input type=\"checkbox\" name=\"member[]\" value=\"$employeeid\"></td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle</td><td>$email1</td>";
	  echo "</tr>";
	}
	echo "</table><br>";
	echo "<INPUT TYPE=\"SUBMIT\"></form>";
//     }
     echo "<p><a href=emppaybongrpadd.php?loginid=$loginid>Back</a><br>";
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
