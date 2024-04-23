<?php
// this module will insert records from mysql.db24.tblfincashreceipt to tblfincashreceipttot after computing the debit and credit total amounts; it will also insert the explanation field from tblfincashreceipt

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

echo "<h3>db:mysql.db24 - compute total cash receipt and insert to tblfincashreceipttot incl. explanation</h3>";

echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
echo "<tr><td colspan=12><b>I. Starting select query of cashreceipt...</b></td></tr>";
echo "<tr><td>count</td><td>crvid</td><td>crvnum</td><td>date</td><td>debit</td><td>credit</td><td>debittot</td><td>credittot</td><td>status</td><td>explanation</td></tr>";

  $count1 = 0;
  $found1 = 0;

  $result1 = mysql_query("SELECT cashreceiptid, cashreceiptnumber, date, debitamt, creditamt, explanation FROM tblfincashreceipt WHERE date >= \"2012-04-01\" AND date <= \"2014-01-31\" ORDER BY date ASC, cashreceiptnumber ASC", $db24);
  while ($myrow1 = mysql_fetch_row($result1))
  {
    $found1 = 1;

    $cashreceiptid1 = $myrow1[0];
    $cashreceiptnumber1 = $myrow1[1];
    $date1 = $myrow1[2];
    $debit1 = $myrow1[3];
    $credit1 = $myrow1[4];
    $explanation1 = $myrow1[5];

    $count1 = $count1 + 1;

    $debittot = $debittot + $debit1;
    $credittot = $credittot + $credit1;

    if($cashreceiptnumber1 != $cashreceiptnumber0)
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

    echo "<tr><td>$count1</td><td>$cashreceiptid1</td><td>$cashreceiptnumber1</td><td>$date1</td><td align=\"right\">$debit1</td><td align=\"right\">$credit1</td><td align=\"right\">$debittot</td><td align=\"right\">$credittot</td><td>$status</td><td>$explanation1</td></tr>";

    if(($status != "pending") && ($status == "finalized")) {
		//
		// check tblcashreceipttot if cashreceiptnumber exists else insert row
		//
			$result3=""; $found3=0;
			$result3 = mysql_query("SELECT cashreceipttotid, cashreceiptnumber, date FROM tblcashreceipttot WHERE cashreceiptnumber=\"$cashreceiptnumber1\"", $db24);
			if($result3 != "") {
				while($myrow3 = mysql_fetch_row($result3)) {
				$found3 = 1;
				$cashreceipttotid3 = $myrow3[0];
				$cashreceiptnumber3 = $myrow3[1];
				$date3 = $myrow3[2];
				}
			}
			if($found3 != 1) {
      	echo "<tr><td colspan=\"2\"><font color=\"green\">Saving</font></td><td><font color=\"green\"><b>$cashreceiptnumber1</b></font></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align=\"right\">$debittot</td><td align=\"right\">$credittot</td><td>$status</td><td>$explanation1</td></tr>";

      	$result2 = mysql_query("INSERT INTO tblfincashreceipttot SET cashreceiptnumber=\"$cashreceiptnumber1\", date=\"$date1\", explanation=\"$explanation1\", debittot=$debittot, credittot=$credittot, status=\"pending\"", $db24);
			} 
    }

    $cashreceiptnumber0 = $cashreceiptnumber1;
    $cashreceiptnumber1 = "";
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
