<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$username = $_POST['username'];
$password = $_POST['password'];

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
	  $accesslevel = $myrow[9];
     }
}
else
{
     $result = mysql_query("SELECT * FROM tbladminlogin WHERE adminuid='$username' AND adminpw='$password'", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $found = 1;

          $loginid = $myrow[0];
          $loginstatus = $myrow[5];
          $level = $myrow[6];
	  $accesslevel = $myrow[9];
     }
}  

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here
/*
    echo "<table class=\"fin\" border=\"1\">";
    echo "<tr><th colspan=\"2\">Vouchers</th></tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"finvouchlist.php?loginid=$loginid\" method=\"post\">";
    echo "<input type=\"submit\" value=\"List Vouchers\"></form></td>";
    echo "<td align=\"center\"><form action=\"finvouchadd.php?loginid=$loginid\" method=\"post\">";
    echo "<input type=\"submit\" value=\"Add new entry\"></form></td>";
    echo "</tr>";

    echo "<tr><th colspan=\"2\">Working Paper</th></tr>";
    echo "<tr>";
    echo "<td align=\"center\"><form action=\"finvouchworkplist.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"List\"></form></td>";
    if($accesslevel >= 4 && $accesslevel <= 5)
    {
      echo "<td align=\"center\"><form action=\"finvouchworkpgen.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"Generate\"></form></td>";
    }
    echo "</tr>";

//// Check Voucher - Add Explanation submodule
//// For troubleshooting only if voucher has no explanation
//    echo "<tr><td colspan=\"2\"><form action=\"finvouchcvexpl.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"Check Voucher - Add Explanation\"></td></tr>";
////
////
    echo "</table>";
*/

    echo "<h2>Sorry, page under maintenance. Data migration in progress.</h2>";
    echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>