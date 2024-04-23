<?php
// this module will insert records from mysql.db24.tblfinjournal to tblfinjournaltot after computing the debit and credit total amounts; it will also insert the explanation field from the disbursement table

// db config
require('db24.php');

echo "<html><head><title>populate tblfinjournaltot db24 to maindb</title>";
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

echo "<h3>db:mysql.db24 - compute total journal and insert to tblfinjournaltot incl. explanation</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=12><b>I. Starting select query of tblfinjournal...</b></td></tr>";
echo "<tr><td>count</td><td>journid</td><td>journal#</td><td>date</td><td>glcode</td><td>debit</td><td>credit</td><td>debittot</td><td>credittot</td><td>status</td><td>explanation</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT journalid, journalnumber, date, glcode, debitamt, creditamt, explanation FROM tblfinjournal WHERE date >= \"2012-03-01\" AND date <= \"2014-01-31\" ORDER BY date ASC, journalnumber ASC", $db24);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;

    $journalid1 = $myrow1[0];
    $journalnumber1 = $myrow1[1];
    $date1 = $myrow1[2];
    $glcode1 = $myrow1[3];
    $debit1 = $myrow1[4];
    $credit1 = $myrow1[5];
    $explanation1 = $myrow1[6];

    $count1 = $count1 + 1;

    $debittot = $debittot + $debit1;
    $credittot = $credittot + $credit1;

    if($journalnumber1 != $journalnumber0)
    {
      $debittot = 0; $credittot = 0;
      $debittot = $debittot + $debit1;
      $credittot = $credittot + $credit1;
    }

    if ($debittot != $credittot)
    { $status="pending"; }
    else if ($debit1 == 0 && $credit1 == 0)
    { $status="cancelled"; }
    else { $status="finalized"; }

    echo "<tr><td>$count1</td><td>$journalid1</td><td>$journalnumber1</td><td>$date1</td><td>$glcode1</td><td align=\"right\">$debit1</td><td align=\"right\">$credit1</td><td align=\"right\">$debittot</td><td align=\"right\">$credittot</td><td>$status</td><td>$explanation1</td></tr>";

    if ($debittot == $credittot) {
			$result3=""; $found3=0;
			$result3 = mysql_query("SELECT journaltotid, journalnumber, date FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber1\"", $db24);
			if($result3 != "") {
				while($myrow3 = mysql_fetch_row($result3)) {
				$found3 = 1;
				$journaltotid3 = $myrow3[0];
				$journalnumber3 = $myrow3[1];
				$date3 = $myrow3[2];
				}
			}

			if($found3 != 1) {
      	echo "<tr><td colspan=\"2\"><font color=\"green\">Saving</font></td><td><font color=\"green\"><b>$journalnumber1</b></font></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align=\"right\">$debittot</td><td align=\"right\">$credittot</td><td>pending</td><td>$explanation1</td></tr>";

      	$result2 = mysql_query("INSERT INTO tblfinjournaltot SET journalnumber=\"$journalnumber1\", date=\"$date1\", explanation=\"$explanation1\", debittot=$debittot, credittot=$credittot, status=\"pending\"", $db24);
			}
      $count2 = $count2 + 1;
    }

    $journalnumber0 = $journalnumber1;
    $journalnumber1 = "";
    $debit1 = 0; $credit1 = 0;
    $debittmp = 0; $credittmp = 0;
    $status = "";
  }

  echo "<tr><td colspan=\"10\"><b>ok-eof saved $count2 records</b></td></tr>";

  echo "</table>";

echo "</body></html>";

mysql_close($db24);
mysql_close($db1);
?>
