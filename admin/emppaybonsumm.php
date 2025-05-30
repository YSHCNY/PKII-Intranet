<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$found = 0;

if($loginid != "")
{
     $result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid AND adminloginstat=1", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $found = 1;
          
          $loginid = $myrow[0];
          $username = $myrow[1];
          $loginstatus = $myrow[5];
          $level = $myrow[6];
     }
}

if ($found == 1)
{
     echo "<html>";
     echo "<img src=pkii_logo.gif>";
     echo "<h2>Personnel Bonus Notifier - Details</h2>";

     echo "Select Payroll Group:";

     echo "<form action=emppaybonsumm2.php?loginid=$loginid method=POST target=frame>";
     echo "<select name=groupname>";

     $result = mysql_query("SELECT DISTINCT groupname FROM tblemppaybongrp", $dbh);

     while ($myrow = mysql_fetch_row($result))
     {
	echo "<option value=$myrow[0]>$myrow[0]</option>";
     }
     echo "</select>";
     echo "<input type=submit value=Go>";
     echo "</form>";

     echo "<a href=emppaybon01.php?loginid=$loginid>Back to Bonus Notifier Menu</a><br>";
     echo "<p>";
     echo "<iframe src=blank3.htm width=100% height=300 name=frame><iframe>";

     echo "</html>";
}
else
{
     echo "<html>";
     
     echo "You are not logged in<br>";
     echo "<a href=login.htm>Login</a><br>";

     echo "</html>";
}

mysql_close($dbh);
?> 
