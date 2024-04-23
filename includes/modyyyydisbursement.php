<?php

$hostname	= "localhost";
$dbname		= "maindb";
$dbuser	= "root";
$dbuserpass	= "sysad";

$dbh = mysql_connect("$hostname", "$dbuser", "$dbuserpass") or die("Connection Error");
mysql_select_db("$dbname", $dbh) or die("Database Error");

$count = 0;
$found1 = 0;
?>

<table border="1" spacing="0">
<h3>modyyyydisbursement.php - will modify date from 2012-% to 2011-%</h3>
<?
  $result1 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, debitamt, creditamt FROM tblfindisbursement WHERE date LIKE '2012-%' ORDER BY disbursementid ASC, date ASC", $dbh);
  if($result1 != '') {
    while($myrow1 = mysql_fetch_row($result1)) {
    $found1 = 1;
    $disbursementid1 = $myrow1[0];
    $disbursementnumber1 = $myrow1[1];
    $disbursementtype1 = $myrow1[2];
    $payee1 = $myrow1[3];
    $date1 = $myrow1[4];
    $debitamt1 = $myrow1[5];
    $creditamt1 = $myrow1[6];

    $count = $count + 1;

    echo "<tr><th>count</th><th>id</th><th>cvnum</th><th>type</th><th>payee</th><th>dr</th><th>cr</th><th>datecurr</th><th>datenew</th><</tr>";
    echo "<tr><td>$count</td><td>$disbursementid1</td><td>$disbursementnumber1</td><td>$disbursementtype1</td><td>$payee1</td><td>$debitamt1</td><td>$creditamt1</td><td>$date1</td>";

    $arrdate1 = split("-", $date1);
    $arrdate1yyyy = $arrdate1[0];
    $arrdate1mm = $arrdate1[1];
    $arrdate1dd = $arrdate1[2];

    if($arrdate1yyyy == '2012') { $arrdate1yyyy2 = '2011'; } else { $arrdate1yyyy2 = $arrdate1yyyy; }
    $datenew = $arrdate1yyyy2."-".$arrdate1mm."-".$arrdate1dd;

//    $result2 = mysql_query("UPDATE tblfindisbursement SET date='$datenew' WHERE disbursementid=$disbursementid1 AND disbursementnumber='$disbursementnumber1'", $dbh);

    echo "<td>$datenew</td></tr>";
    }
  }
?>

</table>
