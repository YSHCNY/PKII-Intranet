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

     echo "<p><font size=1>Modules >> Custom pay notifier</font></p>";
/*
     echo "<p><center><img src=\"./images/page-under-construction1.jpg\"></center></p>";
*/
     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue width=800><font color=white><b>Custom Pay Notifier</b></font></td></tr>";

     echo "<tr><td><form action=emailnotifier3.php?loginid=$loginid method=POST target=frame>";
     echo "<select name=employeetype>";
     echo "<option value=consultant>consultant</option>";
     echo "<option value=employee>employee</option>";
     echo "<option value=others>others</option>";
     echo "</select>";
     echo "<input type=submit value=Go>";
     echo "</form></td></tr>";

     echo "<tr><td><iframe src=\"blank2.htm\" width=\"100%\" height=\"450\" name=\"frame\"><iframe></td></tr>";
     echo "</table>";

     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
