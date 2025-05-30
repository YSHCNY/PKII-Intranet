<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$groupname = $_GET['groupname'];

$grossamt = $_POST['grossamt'];
$taxdeduct = $_POST['taxdeduct'];
$otherdeduct = $_POST['otherdeduct'];
$netamt = $_POST['netamt'];

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
     echo "<head><title>Personnel Bonus Notifier</title></head>";
     echo "<body>";

	$netamt2 = $grossamt - ($taxdeduct + $otherdeduct);

//     if ($netamt2 == $netamt || $netamt == '')
     if ($netamt2 == $netamt)
     {
	$result = mysql_query("INSERT INTO tblemppaybonus (employeeid, groupname, grossamt, taxdeduct, otherdeduct, netamt) VALUES ('$employeeid', '$groupname', $grossamt, $taxdeduct, $otherdeduct, $netamt)", $dbh);

     echo "<h2>New bonus pay information created</h2>";

     }
     else
     {

	echo "<p><b><font color=red><b>Warning: Net amount entered is not correct based on calculation...</b></font></p>";

     }

     echo "Employeeid:$employeeid<br>";
     echo "Gross Amount:$grossamt<br>";
     echo "Tax Deduction:$taxdeduct<br>";
     echo "Other deductions:$otherdeduct<br>";
     echo "Net amount:$netamt<br>";

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
