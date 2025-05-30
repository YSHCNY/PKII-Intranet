<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$groupname = $_GET['gn'];
$confipaydeductid = $_GET['deductid'];

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
     echo "<head><title>Confidential Payroll</title></head>";
     echo "<body>";
     echo "<h2>Other deduction removed</h2>";

     $result = mysql_query("DELETE FROM tblconfipaymemdeduct WHERE employeeid = '$employeeid' AND confipaydeductid = $confipaydeductid", $dbh);

     echo "employeeid:$employeeid deleted<br>";
     echo "deductid:$confipaydeductid deleted<br>";

     echo "</body></html>";
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
