<?php
// this function will migrate current/updated records of finglrefv2 from philkoei-023 dev server to intranet.server (192.168.0.10)

// db config

// uncomment to use
// require('db23.php');
// require('db1.php');

echo "<html><head><title>migr8findisbursement fr-dev-to-prod maindb</title>";
?>
<STYLE TYPE="text/css">
<!--
TH{font-family: Helvetica; font-size: 10pt; font-weight: 100%;}
TD{font-family: Helvetica; font-size: 10pt;}
--->
</STYLE>
<?php
echo "</head><body>";

// initialize
$glrefver = 1;
$ctr1 = 0;
$found12 = 0;
$ctr2 = 0;

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td></td><td colspan=\"9\">philkoei-023 dev server</td><td></td><td colspan=\"9\">intranet.server prod</td></tr>";
echo "<tr><td>count</td><td>disbursementnum</td><td>date</td><td>payee</td><td>glcode</td><td>ver</td><td>projcode</td><td>debit</td><td>credit</td><td>vs</td><td>count</td><td>disbursementnum</td><td>date</td><td>payee</td><td>glcode</td><td>ver</td><td>projcode</td><td>debit</td><td>credit</td><td><status</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt, explanation FROM tblfindisbursement WHERE date>\"2011-11-30\" ORDER BY date ASC", $db23);
  if($result1 != "") {
    while ($myrow1 = mysql_fetch_row($result1)) {
    $found1 = 1;

    $disbursementid1 = $myrow1[0];
    $disbursementnumber1 = $myrow1[1];
    $disbursementtype1 = $myrow1[2];
    $payee1 = $myrow1[3];
    $date1 = $myrow1[4];
    $glcode1 = $myrow1[5];
    $glrefver1 = $myrow1[6];
    $glnamedetails1 = $myrow1[7];
    $projcode1 = $myrow1[8];
    $particulars1 = $myrow1[9];
    $debitamt1 = $myrow1[10];
    $creditamt1 = $myrow1[11];
    $explanation1 = $myrow1[12];

    $count1 = $count1 + 1;

    echo "<tr><td>$count1</td><td>$disbursementnumber1</td><td>$date1</td><td>$payee1</td><td>$glcode1</td><td>$glrefver1</td><td>$projcode1</td><td>$debitamt1</td><td>$creditamt1</td>";
    echo "<td>&nbsp;</td>";

    $count2 = 0;
    $found2 = 0;

    $result2 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt, explanation FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber1\" AND date=\"$date1\" AND glcode=\"$glcode1\" AND debitamt=$debitamt1 AND creditamt=$creditamt1", $dbh);
    if($result2 != '') {
      while($myrow2 = mysql_fetch_row($result2)) {
        $found2 = 1;

	$disbursementid2 = $myrow2[0];
	$disbursementnumber2 = $myrow2[1];
	$disbursementtype2 = $myrow2[2];
	$payee2 = $myrow2[3];
	$date2 = $myrow2[4];
	$glcode2 = $myrow2[5];
	$glrefver2 = $myrow2[6];
	$glnamedetails2 = $myrow2[7];
	$projcode2 = $myrow2[8];
	$particulars2 = $myrow2[9];
	$debitamt2 = $myrow2[10];
	$creditamt2 = $myrow2[11];
	$explanation2 = $myrow2[12];

	$count2 = $count2 + 1;

	echo "<td>$count2</td><td>$disbursementnumber2</td><td>$date2</td><td>$payee2</td><td>$glcode2</td><td>$glrefver2</td><td>$projcode2</td><td>$debitamt2</td><td>$creditamt2</td>";
	if($disbursementnumber1 == $disbursementnumber2 || $date1 == $date2 || $payee1 == $payee2 || $glcode1 == $glcode2 || $glrefver1 == $glrefver2 || $projcode1 == $projcode2 || $debitamt1 == $debitamt2 || $creditamt1 == $creditamt2) {
	  echo "<td>as-is</td>";
	} else {
//	    $result3 = mysql_query("DELETE FROM tblfindisbursement WHERE disbursementid=$disbursementid2", $dbh);
//	    $result4 = mysql_query("INSERT INTO tblfindisbursement SET disbursementnumber=\"$disbursementnumber1\", disbursementtype=\"$disbursementtype1\", payee=\"$payee1\", date=\"$date1\", glcode=\"$glcode1\", glrefver=$glrefver1, glnamedetails=\"$glnamedetails1\", projcode=\"$projcode1\", particulars=\"$particulars1\", debitamt=$debitamt1, creditamt=$creditamt1, explanation=\"$explanation1\"", $dbh);
	echo "<td>update</td>";
	}
      }
    }

    if($found2 != 1) {
      echo "<td>$count1</td><td>$disbursementnumber1</td><td>$date1</td><td>$payee1</td><td>$glcode1</td><td>$glrefver1</td><td>$projcode1</td><td>$debitamt1</td><td>$creditamt1</td>";
	      $result5 = mysql_query("INSERT INTO tblfindisbursement SET disbursementnumber=\"$disbursementnumber1\", disbursementtype=\"$disbursementtype1\", payee=\"$payee1\", date=\"$date1\", glcode=\"$glcode1\", glrefver=$glrefver1, glnamedetails=\"$glnamedetails1\", projcode=\"$projcode1\", particulars=\"$particulars1\", debitamt=$debitamt1, creditamt=$creditamt1, explanation=\"$explanation1\"", $dbh);
      echo "<td>insert-newrecord</td>";
    }
    echo "</tr>";
    }
  }

  echo "<tr><td colspan=\"20\"><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db23);
?>
