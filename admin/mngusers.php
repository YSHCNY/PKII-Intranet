<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$username = $_POST['username'];
$password = $_POST['password'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

    echo "<table class=\"fin\" border=\"1\">";
    echo "<tr><th colspan=\"2\">Manage Users</th></tr>";
    echo "<tr>";
    echo "<td><form action=\"mngstdusers.php?loginid=$loginid\" method=\"post\">";
    echo "<input type=\"submit\" value=\"Standard Users\"></form></td>";
    echo "<td><form action=\"mngadmusers.php?loginid=$loginid\" method=\"post\">";
    echo "<input type=\"submit\" value=\"Admin Users\"></form></td>";
    echo "</table>";

    echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

// end contents here

?>

<?php

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
