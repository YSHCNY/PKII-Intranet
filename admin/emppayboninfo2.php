<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$groupname = $_GET['groupname'];

$employeeid = $_POST['employeeid'];
$grossamt = $_POST['grossamt'];
$taxdeduct = $_POST['taxdeduct'];
$otherdeduct = $_POST['otherdeduct'];
$netamt = $_POST['netamt'];

$datecreated = date("Y-m-d");

// echo "vartest id:$loginid empid:$employeeid group:$groupname<br>";

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

     echo "<h2>Details saved...</h2>";

//     foreach ($employeeid as $key => $value)
//     {
//	echo "vartest $value<br>";
//     }

//     foreach ($grossamt as $key => $value)
//     {
//	echo "vartest $value<br>";
//     }

//	$result1 = mysql_query("SELECT * FROM tblemppaybonus WHERE employeeid = '$value' AND groupname = '$groupname'", $dbh);
//	while ($myrow1 = mysql_fetch_row($result1))
//	{
//	  $found1 = 1;
//	  $employeeid1 = $myrow1[1];
	  	
//	  echo "vartest empid:$value $employeeid1 grp:$groupname date:$datecreated gross:$grossamt tax:$taxdeduct otherdeds:$otherdeduct net:$netamt<br>";

//	  $result2 = mysql_query("DELETE FROM tblemppaybonus WHERE groupname = '$groupname'", $dbh);

//	  $result3 = mysql_query("INSERT INTO tblemppaybonus (employeeid, groupname, date, grossamt, taxdeduct, otherdeduct, netamt) VALUES ('$value', '$groupname', '$datecreated', $grossamt, $taxdeduct, $otherdeduct, $netamt)", $dbh);
//	}



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
