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

     echo "<p><font size=1>Manage Personnel >> Merge Personnel Info</font></p>";

     echo "<table class=\"fin\" border=\"1\">";
     echo "<tr><th colspan=\"2\">Merge Personnel Information</th></tr>";

     echo "<form action=\"personnelinfomerge2.php?loginid=$loginid\" method=\"POST\">";
     echo "<tr><th colspan=\"2\">Source personnel</th></tr>";
     echo "<tr><td colspan=\"2\"><select name=\"employeeidsrc\">";
     $found11 = 0;
     $result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' ORDER BY tblcontact.name_last ASC", $dbh);
     if($result11 != "") {
	while($myrow11 = mysql_fetch_row($result11)) {
	$found11 = 1;
	$employeeid11 = $myrow11[0];
	$name_first11 = $myrow11[1];
	$name_last11 = $myrow11[2];
	$name_middle11 = $myrow11[3];
	echo "<option value=\"$employeeid11\">$employeeid11 - $name_last11, $name_first11 $name_middle11[0].</option>";
	}
     }
     echo "</td></tr>";
     echo "<tr><th colspan=\"2\">Target personnel</th></tr>";
     echo "<tr><td colspan=\"2\"><select name=\"employeeidtrgt\">";
     $found12 = 0;
     $result12 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' ORDER BY tblcontact.name_last ASC", $dbh);
     if($result12 != "") {
	while($myrow12 = mysql_fetch_row($result12)) {
	$found12 = 1;
	$employeeid12 = $myrow12[0];
	$name_first12 = $myrow12[1];
	$name_last12 = $myrow12[2];
	$name_middle12 = $myrow12[3];
	echo "<option value=\"$employeeid12\">$employeeid12 - $name_last12, $name_first12 $name_middle12[0].</option>";
	}
     }
     echo "</td></tr>";
     echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Merge\"></td></form></tr>";

     echo "</table>";

     echo "<p><a href=\"personneledit.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
