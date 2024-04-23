<?php
// this module will insert term_resign value to tblprojassign
// date value shall be copied from durationto and durationto2 based on cutoffdate

// db config
include("db1.php");

echo "<html><body>";

// initialize
$cutoffdate = '2010-12-31';
$found1 = 0;
$ctr1 = 0;
$found12 = 0;
$ctr2 = 0;

echo "<h3>module:update term_resign from durationto & durationto2 where date <= $cutoffdate</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=11><b>I. Starting update of durationto2...</b></td></tr>";
echo "<tr><td>count</td><td>id</td><td>refno</td><td>empid</td><td>projcode</td><td>durationfrom</td><td>durationto</td><td>durationfrom2</td><td>durationto2</td><td>termresign</td><td>status</td></tr>";

  $result1 = mysql_query("SELECT projassignid, ref_no, employeeid, proj_code, durationfrom, durationto, durationfrom2, durationto2, term_resign FROM tblprojassign WHERE employeeid <> '' AND durationto2 >= '1980-01-01' AND durationto2 <= '$cutoffdate' AND term_resign IS NULL ORDER BY durationto2 DESC", $dbh);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;
    $projassignid1 = $myrow1[0];
    $ref_no1 = $myrow1[1];
    $employeeid1 = $myrow1[2];
    $proj_code1 = $myrow1[3];
    $durationfrom1 = $myrow1[4];
    $durationto1 = $myrow1[5];
    $durationfrom21 = $myrow1[6];
    $durationto21 = $myrow1[7];
    $term_resign1 = $myrow1[8];

    if($durationto21 <= "$cutoffdate")
    {
      $ctr1 = $ctr1 + 1;
      echo "<tr><td>$ctr1</td><td>$projassignid1</td><td>$ref_no1</td><td>$employeeid1</td><td>$proj_code1</td><td>$durationfrom1</td><td>$durationto1</td><td>$durationfrom21</td><td><b>$durationto21</b></td><td>$term_resign1</td>";

      $result11 = mysql_query("UPDATE tblprojassign SET term_resign=\"$durationto21\" WHERE projassignid=$projassignid1 AND employeeid=\"$employeeid1\"", $dbh);

      $result12 = mysql_query("SELECT projassignid, ref_no, employeeid, proj_code, durationto2, term_resign FROM tblprojassign WHERE projassignid=$projassignid1 AND employeeid=\"$employeeid1\"", $dbh);
      while($myrow12 = mysql_fetch_row($result12))
      {
	$found12 = 1;
	$projassignid12 = $myrow12[0];
	$ref_no12 = $myrow12[1];
	$employeeid12 = $myrow12[2];
	$proj_code12 = $myrow12[3];
	$durationto212 = $myrow12[4];
	$term_resign12 = $myrow12[5];

	if($durationto212 == $term_resign212) { echo "<td><font color=\"green\">Updated</font></td>"; }
	else { echo "<td><font color=\"red\">$durationto212 <> $term_resign12</font></td>"; }
        echo "</tr>";
      }
    }
  }
  echo "<tr><td colspan=11><b>ok-eof</b></td></tr>";

echo "<tr><td colspan=11><b>II. Starting update of durationto...</b></td></tr>";
echo "<tr><td>count</td><td>id</td><td>refno</td><td>empid</td><td>projcode</td><td>durationfrom</td><td>durationto</td><td>durationfrom2</td><td>durationto2</td><td>termresign</td><td>status</td></tr>";

  $result2 = mysql_query("SELECT projassignid, ref_no, employeeid, proj_code, durationfrom, durationto, durationfrom2, durationto2, term_resign FROM tblprojassign WHERE employeeid <> '' AND durationto >= '1980-01-01' AND durationto <= '$cutoffdate' AND term_resign IS NULL ORDER BY durationto DESC", $dbh);
  while ($myrow2 = mysql_fetch_row($result2))
  {
    $found2 = 1;
    $projassignid2 = $myrow2[0];
    $ref_no2 = $myrow2[1];
    $employeeid2 = $myrow2[2];
    $proj_code2 = $myrow2[3];
    $durationfrom2 = $myrow2[4];
    $durationto2 = $myrow2[5];
    $durationfrom22 = $myrow2[6];
    $durationto22 = $myrow2[7];
    $term_resign2 = $myrow2[8];

    if($durationto2 <= "$cutoffdate")
    {
      $ctr2 = $ctr2 + 1;
      echo "<tr><td>$ctr2</td><td>$projassignid2</td><td>$ref_no2</td><td>$employeeid2</td><td>$proj_code2</td><td>$durationfrom2</td><td>$durationto2</td><td>$durationfrom22</td><td><b>$durationto22</b></td><td>$term_resign2</td>";

      $result21 = mysql_query("UPDATE tblprojassign SET term_resign=\"$durationto2\" WHERE projassignid=$projassignid2 AND employeeid=\"$employeeid2\"", $dbh);

      $result22 = mysql_query("SELECT projassignid, ref_no, employeeid, proj_code, durationto, term_resign FROM tblprojassign WHERE projassignid=$projassignid2 AND employeeid=\"$employeeid2\"", $dbh);
      while($myrow22 = mysql_fetch_row($result22))
      {
	$found22 = 1;
	$projassignid22 = $myrow22[0];
	$ref_no22 = $myrow22[1];
	$employeeid22 = $myrow22[2];
	$proj_code22 = $myrow22[3];
	$durationto22 = $myrow22[4];
	$term_resign22 = $myrow22[5];

	if($durationto22 == $term_resign22) { echo "<td><font color=\"green\">Updated</font></td>"; }
	else { echo "<td><font color=\"red\">$durationto22 <> $term_resign22</font></td>"; }
        echo "</tr>";
      }
    }
  }
  echo "<tr><td colspan=11><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($dbh);
?>
