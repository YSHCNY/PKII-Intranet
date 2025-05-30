<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$groupname = $_GET['groupname'];

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
     echo "<h2>Personnel Bonus Notifier - Add new info</h2>";

// show selected employee

	$result = mysql_query("SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid='$employeeid'", $dbh);

	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $employeeid = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $name_last = $myrow[3];

	  echo "For: <b>$employeeid - $name_first $name_middle $name_last</b><br>";
	  echo "<p>";
	}

// start main bonus form

	echo "<FORM METHOD=POST ACTION=emppayboninfo5.php?loginid=$loginid&eid=$employeeid&groupname=$groupname>"; 
	echo "<table border=0 spacing=1>";

	echo "<tr><td>Gross Amount</td><td><input name=grossamt value=$grossamt></td></tr>";
	echo "<tr><td>Tax Deduction</td><td><input name=taxdeduct value=$taxdeduct></td></tr>";
	echo "<tr><td>Other Deductions</td><td><input name=otherdeduct value=$otherdeduct></td></tr>";
	echo "<tr><td>Net Amount</td><td><input name=netamt value=$netamt></td></tr>";
	echo "<td>&nbsp;</td>";
	echo "<td><INPUT TYPE=SUBMIT VALUE=Save></td></tr>";
	echo "</table>";
	echo "</FORM>";

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
