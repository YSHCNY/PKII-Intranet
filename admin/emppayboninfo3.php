<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$groupname = $_GET['groupname'];

$employeeid = $_POST['employeeid'];
$grossamt = $_POST['grossamt'];
$taxpercent = $_POST['taxpercent'];
$taxdeduct = $_POST['taxdeduct'];
$otherdeduct = $_POST['otherdeduct'];
// $netamt = $_POST['netamt'];

// 20200103
$additional = $_POST['additional'];
if($additional=='') { $additional=0; }

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

	if($taxpercent <> "") { $taxdeduct = $grossamt * ($taxpercent/100); }

  // 202001013
  $grossamt1 = $grossamt + $additional;

	$netamt2 = $grossamt1 - ($taxdeduct + $otherdeduct);

	// update after computing
	$result3 = mysql_query("UPDATE tblemppaybonus SET date=\"$datecreated\", grossamt=$grossamt, taxpercent=\"$taxpercent\", taxdeduct=$taxdeduct, otherdeduct=$otherdeduct, netamt=$netamt2, additional=$additional WHERE employeeid = \"$employeeid\" AND groupname = \"$groupname\"", $dbh);

	// redirect back to emppayboninfo1.php
  header("Location: emppayboninfo1.php?loginid=$loginid&groupname=$groupname");
  exit;

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