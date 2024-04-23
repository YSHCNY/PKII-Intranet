<?php 

require ('./db1.php');

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
     echo "<h2>Consultants' Payroll System</h2>";

     echo "<p><a href=consgrp.php?loginid=$loginid><b>Payroll Group</b></a></p>";
     echo "<p><a href=consinfo.php?loginid=$loginid><b>Personnel Information</b></a></p>";

     echo "<p><a href=consrun.php?loginid=$loginid><b>RUN CONSULTANTS' PAYROLL SYSTEM</b></a></p>";

     echo "<p><a href=constools.php?loginid=$loginid><b>Post-Process Tools</b></a></p>";

     echo "<br>";
     echo "<a href=admlogin.php?loginid=$loginid>Back</a><br>";

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
