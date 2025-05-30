<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Personnel Bonus Notifier</font></p>";

     echo "<h2>Personnel Bonus Notifier - Details</h2>";

     echo "Select Payroll Group:";

     echo "<form action=\"emppaybonbpi1.php?loginid=$loginid\" method=\"POST\" target=\"frame\" name=\"emppbbpi1\">";

     echo "<select name=\"groupname\">";
    $resquery = "SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp WHERE accesslevel<=$accesslevel";
		$result = $dbh2->query($resquery);
		if($result->num_rows>0) {
		while ($myrow = $result->fetch_assoc()) {
	$found = 1;
	$groupname = $myrow['groupname'];
	$datecreated = $myrow['datecreated'];
	echo "<option value=\"$groupname\">$groupname - $datecreated</option>";
		} // while($myrow = $result->fetch_assoc())
		} // if($result->num_rows>0)
     echo "</select>";
     echo "<input type=\"submit\" value=\"Go\">";

     echo "</form>";

     echo "<a href=emppaybon01.php?loginid=$loginid>Back to Bonus Notifier Menu</a><br>";
     echo "<p>";
     echo "<iframe src=blank4.htm width=900 height=500 name=frame><iframe>";


     // echo "</html>";
}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
