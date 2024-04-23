<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Change Employee Number</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Change Employee Number</b</font></td></tr>";

     $result0 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$pid'", $dbh);
     while($myrow0 = mysql_fetch_row($result0))
     {
	$name_last = $myrow0[0];
	$name_first = $myrow0[1];
	$name_middle = $myrow0[2];
     }

     echo "<tr><td colspan=\"2\" align=\"center\"><b>$pid - $name_last, $name_first $name_middle[0]</b></td></tr>";
     echo "<tr><td>New Employee Number</td><td align=\"center\">";

     echo "<form action=personnelchgempid2.php?loginid=$loginid&eid=$pid method=POST>";
     echo "<input name=\"newemployeeid\" size=\"10\"></td></tr>";
     echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Change Employee Number\"></td></tr></form>";

     echo "</table>";
 
     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$pid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
