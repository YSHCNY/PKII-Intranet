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
$found22 = 0;
$found23 = 0;
$counter1 = 0;
$counter2 = 0;
$projectassign0id0 = 0;

echo "<h3>module:insert employeeid for tblprojassign0</h3>";

$result = mysql_query("SELECT projectassign0id, employeeid, name_last, name_first FROM tblprojassign0 WHERE name_last != '' AND name_first != ''", $dbh);
while ($myrow = mysql_fetch_row($result))
{
  $found = 1;
  $counter1 = $counter1 + 1;
  $projectassign0id0 = $myrow[0];
  $employeeid0 = $myrow[1];
  $name_last0 = $myrow[2];
  $name_first0 = $myrow[3];
  $name_first1 = substr("$name_first0", 0, 4);

  $counter2 = 0;
  $found2 = 0;
  $employeeid = '';

  echo "Find: Rec# $projectassign0id0 $employeeid0 - $name_last0, $name_first0<br>";

  $result2 = mysql_query("SELECT employeeid, name_last, name_first FROM tblcontact WHERE name_last = '$name_last0' AND name_first LIKE '$name_first1%'", $dbh);
  while ($myrow2 = mysql_fetch_row($result2))
  {
	$found2 = 1;
	$found22 = 0;
	$counter2 = $counter2 + 1;
	$employeeid = $myrow2[0];
	$name_last = $myrow2[1];
	$name_first = $myrow2[2];
  }

   if ($found2 == 1)
   {
	echo "Result: $counter1. $employeeid vs ";

	$result22 = mysql_query("SELECT employeeid FROM tblemployee WHERE employee_type = 'employee' AND employeeid = '$employeeid'", $dbh);
	while ($myrow22 = mysql_fetch_row($result22))
	{
		$found22 = 1;
		$employeeid22 = $myrow22[0];

		if ($found22 == 1)
		{
			$employeeid = $employeeid22;
			echo "<b>$employeeid</b> for $name_last, $name_first or $name_first1<br>";
		}
		else
		{
		}
	}

//	if ($employeeid22 == '')
//	{
//		echo "$employeeid for $name_last, $name_first<br>";
//	}
//	else
//	{
//	}

   }
   else
   {
	$found23 = 0;
	echo "Result: $counter1. $employeeid vs ";

	$name_first3 = substr("$name_first0", 0, 1);

	$result23 = mysql_query("SELECT employeeid, name_last, name_first FROM tblcontact WHERE name_last = '$name_last0' AND name_first LIKE '$name_first3%' AND contact_type = 'personnel'", $dbh);

	while($myrow23 = mysql_fetch_row($result23))
	{
	  $found23 = 1;
	  $employeeid23 = $myrow23[0];
	  $name_last23 = $myrow23[1];
	  $name_first23 = $myrow23[2];
	  $employeeid = $employeeid23;
	  echo "<b>$employeeid</b> for $name_last23, $name_first23 or $name_first3<br>";
	}

//	echo "vartest: $employeeid23 - $name_last0, $name_first3<br>";
   }

  $result3 = mysql_query("UPDATE tblprojassign0 SET employeeid1 = '$employeeid' WHERE projectassign0id = $projectassign0id0", $dbh);

  echo "insert <b>$employeeid</b> on <b>$projectassign0id0</b><br>";

  echo "ok-eof<br><br>";
}
?>
</body></html>
