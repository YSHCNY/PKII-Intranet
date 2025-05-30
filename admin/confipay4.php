<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$netbasicpay = $_POST['netbasicpay'];
$withholdingtax = $_POST['withholdingtax'];
$sssee = $_POST['sssee'];
$ssser = $_POST['ssser'];
$philhealthee = $_POST['philhealthee'];
$philhealther = $_POST['philhealther'];
$pagibigee = $_POST['pagibigee'];
$pagibiger = $_POST['pagibiger'];
$status = $_POST['status'];

echo "$employeeid<br>";

echo "1$netbasicpay<br>";
echo "2$withholdingtax<br>";
echo "3$sssee<br>";
echo "4$ssser<br>";
echo "5$philhealthee<br>";
echo "6$philhealther<br>";
echo "7$pagibigee<br>";
echo "8$pagibiger<br>";
echo "$status<br>";

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
     echo "<head><title>Updated</title></head>";
     echo "<body>";
     echo "<h2>Updated</h2>";

     if($status == 'on')
     {
          $result = mysql_query("UPDATE tblconfipaymeminfo SET netbasicpay=$netbasicpay, withholdingtax=$withholdingtax,  sssee=$sssee, ssser=$ssser, philhealthee=$philhealthee,  philhealther=$philhealther, pagibigee=$pagibigee, pagibiger=$pagibiger, status='active' WHERE employeeid='$employeeid'");
     }
     else
     {
          $result = mysql_query("UPDATE tblconfipaymeminfo SET netbasicpay=$netbasicpay, withholdingtax=$withholdingtax,  sssee=$sssee, ssser=$ssser, philhealthee=$philhealthee,  philhealther=$philhealther, pagibigee=$pagibigee, pagibiger=$pagibiger, status='inactive' WHERE employeeid='$employeeid'");
     } 
     
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
