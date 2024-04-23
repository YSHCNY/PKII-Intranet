<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$found = 0;

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
     echo "<tr><td bgcolor=blue><font color=white><b>Create Notifier Group</b></font></td></tr>";

     $result = mysql_query("SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp", $dbh);

     echo "<tr><td align=center><i>-List of Available Groups-</i></td></tr>";
     echo "<tr><td align=center>";
     echo "<p>";

     while ($myrow = mysql_fetch_row($result))
     {
	$found = 1;
	echo "<b>$myrow[0]</b> - $myrow[1]<br>";
     }
     echo "</td></tr>";

     echo "<tr><td align=center>";
     echo "<FORM METHOD=\"post\" ACTION=\"emppaybongrpadd2.php?loginid=$loginid\">";
     echo "<i>-Enter new group name-</i>";
     echo "<p><INPUT NAME=\"groupname\" VALUE=\"$groupname\">";
     echo "<p>";
     echo "<INPUT TYPE=SUBMIT></td></tr></table>";

     echo "<p><a href=emppaybon01.php?loginid=$loginid>Back</a></p>";

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
