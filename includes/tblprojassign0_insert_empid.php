<html><body>
<?php
// this module will insert employeeid to all identified records in tblprojassign0
// the employeeid will be queried from tblcontact that will match their name_last & name_first

// db config
$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection error" . mysql_errno() . " " . mysql_error());
mysql_select_db("maindb", $dbh) or die("Database Error" . mysql_errno() . " " . mysql_error());

// initialize
$found = 0;
$found2 = 0;
$counter1 = 0;
$counter2 = 0;
$projectassign0id0 = 0;

echo "<h2>module:insert employeeid for tblprojassign0</h2>";

$result = mysql_query("SELECT projectassign0id, employeeid, name_last, name_first FROM tblprojassign0 WHERE employeeid = '' AND name_last != '' AND name_first != ''", $dbh);
while ($myrow = mysql_fetch_row($result))
{
  $found = 1;
  $counter1 = $counter1 + 1;
  $projectassign0id0 = $myrow[0];
  $employeeid0 = $myrow[1];
  $name_last0 = $myrow[2];
  $name_first0 = $myrow[3];

  $counter2 = 0;

  echo "Find: Rec# $projectassign0id0 $employeeid0 - $name_last0, $name_first0<br>";

  $result2 = mysql_query("SELECT employeeid, name_last, name_first FROM tblcontact WHERE name_last = '$name_last0' AND name_first = '$name_first0'", $dbh);
  while ($myrow2 = mysql_fetch_row($result2))
  {
	$found2 = 1;
	$counter2 = $counter2 + 1;
	$employeeid = $myrow2[0];
	$name_last = $myrow2[1];
	$name_first = $myrow2[2];

  echo "Result: $counter1. $employeeid vs ";

	$result22 = mysql_query("SELECT employeeid FROM tblemployee WHERE employee_type = 'employee' AND employeeid = '$employeeid'", $dbh);
	while ($myrow22 = mysql_fetch_row($result22))
	{
		$found22 = 1;
		$employeeid22 = $myrow22[0];

		if ($found22 == 1)
		{
			$employeeid = $employeeid22;
			echo "<b>$employeeid</b> for $name_last, $name_first<br>";
		}
		else
		{
		}
	}

	if ($employeeid22 == '')
	{
		echo "$employeeid for $name_last, $name_first<br>";
	}
	else
	{
	}

  $result3 = mysql_query("UPDATE tblprojassign0 SET employeeid = '$employeeid' WHERE projectassign0id = $projectassign0id0", $dbh);

	echo "insert <b>$employeeid</b> on <b>$projectassign0id0</b><br>";
  }

  echo "ok-eof<br><br>";
}
?>
</body></html>