<?php
// this module will insert records from mysql.db24.tblfindisbursement to tblfincashreceipt after filtering if disbursementnumber is for cashreceipt

// db config
require('db24.php');

echo "<html><head><title>populatevouchdb24tomaindb</title>";
?>
<STYLE TYPE="text/css">
<!--
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

echo "<h3>db:mysql.db24 - determine tblfindisbursement if cash receipt and move to tblfincashreceipt</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=12><b>I. Starting select query of disbursement...</b></td></tr>";
echo "<tr><td>count</td><td>disbid</td><td>voucher</td><td>date</td><td>glcode</td><td>ver</td><td>gldetails</td><td>projcode</td><td>particulars</td><td>debit</td><td>credit</td><td>explanation</td><td>action</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt, explanation FROM tblfindisbursement WHERE disbursementnumber LIKE '%.%' AND date >= \"2012-01-01\" AND date <= \"2014-01-31\" ORDER BY date ASC, disbursementnumber ASC", $db24);
  while ($myrow1 = mysql_fetch_row($result1))
  {
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
    $debit1 = $myrow1[10];
    $credit1 = $myrow1[11];
    $explanation1 = $myrow1[12];

    $count1 = $count1 + 1;

    $debittot = $debittot + $debit1;
    $credittot = $credittot + $credit1;

    if($disbursementnumber1 != $disbursementnumber0)
    {
      $debittot = 0; $credittot = 0;
      $debittot = $debittot + $debit1;
      $credittot = $credittot + $credit1;
    }

    if ($debittot != $credittot)
    { $status="pending"; }
    else { $status="finalized"; }
    if (fnmatch("*CANCELLED*", $payee1))
    { $status="cancelled"; }

    echo "<tr><td>$count1</td><td>$disbursementid1</td><td>$disbursementnumber1</td><td>$date1</td><td>$glcode1</td><td>$glrefver1</td><td>$glnamedetails1</td><td>$projcode1</td><td>$particulars1</td><td align=\"right\">$debit1</td><td align=\"right\">$credit1</td><td>$explanation1</td>";

		$result3=""; $found3=0;
		$result3 = mysql_query("SELECT cashreceiptid, cashreceiptnumber FROM tblfincashreceipt WHERE cashreceiptnumber=\"$disbursementnumber1\" AND date=\"$date1\" AND glcode=\"$glcode1\" AND debitamt=$debit1 AND creditamt=$credit1", $db24);
		if($result3 != "") {
			while($myrow3 = mysql_fetch_row($result3)) {
			$found3 = 1;
			$cashreceiptid3 = $myrow3[0];
			$cashreceiptnumber3 = $myrow[1];
			}
		}

		if($found3 != 1) {
		   $result2 = mysql_query("INSERT INTO tblfincashreceipt SET cashreceiptnumber=\"$disbursementnumber1\", date=\"$date1\", glcode=\"$glcode1\", glrefver=$glrefver1, glnamedetails=\"$glnamedetails1\", projcode=\"$projcode1\", particulars=\"$particulars1\", debitamt=$debit1, creditamt=$credit1, explanation=\"$explanation1\"", $db24);
			echo "<td><font color=\"green\">inserted</font></td>";
		}
		$result5 = mysql_query("DELETE FROM tblfindisbursement WHERE disbursementid=$disbursementid1 AND disbursementnumber=\"$disbursementnumber1\"", $db24);

		echo "</tr>";

    $disbursementnumber0 = $disbursementnumber1;
    $disbursementnumber1 = "";
    $debit1 = 0; $credit1 = 0;
    $debittmp = 0; $credittmp = 0;
    $status = "";
  }

  echo "<tr><td colspan=\"10\"><b>ok-eof</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db24);
mysql_close($db1);
?>
