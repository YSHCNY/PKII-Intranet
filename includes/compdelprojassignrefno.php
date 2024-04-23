<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection error" . mysql_errno() . " " . mysql_error());
mysql_select_db("maindb", $dbh) or die("Database Error" . mysql_errno() . " " . mysql_error());

echo "<html>";

echo "This module will display and delete records that matches tblprojassign.ref_no = tblprojassign0.ref_no...<br>";
echo "<table border=1 spacing=0><tr><td>Count</td><td>projassignid</td><td>ref_no</td><td>ref_no0</td><td>projassign0id</td><td>employeeid</td><td>employeeid1</td></tr>";

$result1 = mysql_query("SELECT tblprojassign.projassignid, tblprojassign.ref_no, tblprojassign.employeeid, tblprojassign0.projectassign0id, tblprojassign0.ref_no, tblprojassign0.employeeid1 FROM tblprojassign JOIN tblprojassign0 ON tblprojassign.ref_no = tblprojassign0.ref_no WHERE tblprojassign.ref_no = tblprojassign0.ref_no ORDER BY tblprojassign.employeeid ASC, tblprojassign.ref_no ASC", $dbh);

$ctr1 = 0;

while($myrow1 = mysql_fetch_row($result1))
{
  $found1 = 1;
  $ctr1 = $ctr1 + 1;
  $projassignid = $myrow1[0];
  $ref_no = $myrow1[1];
  $employeeid = $myrow1[2];
  $projectassign0id = $myrow1[3];
  $ref_no0 = $myrow1[4];
  $employeeid1 = $myrow1[5];

  echo "<tr><td>$ctr1</td><td>$projassignid</td><td>$ref_no</td><td>$ref_no0</td><td>$projassign0id</td><td>$employeeid</td><td>$employeeid1</td></tr>";

  $result2 = mysql_query("DELETE FROM tblprojassign WHERE ref_no = '$ref_no' AND projassignid = $projassignid", $dbh);
}

echo "</table><b>ok - <font color=red>$ctr1 records deleted</font></b></html>";

mysql_close($dbh);
?> 
