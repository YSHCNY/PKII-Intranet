<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> HR Reports</font></p>";

     echo "<table class=\"fin\" border=\"1\"><tr><td>";

     echo "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpanning=\"0\">";
     echo "<tr><th colspan=2>HR Reports</th></tr>";

// start contents here...

     echo "<tr>";
     echo "<td align=\"center\"><form action=persrptemployee.php?loginid=$loginid method=post><input type=submit value=\"List of Employees\"></form></td>";
     echo "<td>Displays the list of active or inactive EMPLOYEES with current project assignments and their rates.</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<td align=\"center\"><form action=persrptconsultant.php?loginid=$loginid method=post><input type=submit value=\"List of Consultants\"></form></td>";
     echo "<td>Displays the list of active or inactive CONSULTANTS with current project assignments and their rates.</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<td align=\"center\"><form action=persrptbenefits.php?loginid=$loginid method=post><input type=submit value=\"List of Gov't ID's\"></form></td>";
     echo "<td>Displays the list of PERSONNELS with details re HR information including Gov't. Benefits ID numbers.</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<td align=\"center\"><form action=\"persrptphilhealther2.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"Philhealth ER2\"></form></td>";
     echo "<td>Displays the list of PERSONNELS with Philhealth Nos., Current Salary and Date of Employment.</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<td align=\"center\"><form action=\"persrptemails.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"List of emails\"></form></td>";
     echo "<td>Displays filtered email list based on dropdown selection.</td>";
     echo "</tr>";

     echo "<tr>";
     echo "<td align=\"center\"><form action=\"persrptbdays.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"List of birthdays\"></form></td>";
     echo "<td>Displays list of birthdates based on selected month.</td>";
     echo "</tr>";

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 