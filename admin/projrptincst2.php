<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$projcode = (isset($_GET['pid'])) ? $_GET['pid'] :'';
$reporttype = (isset($_POST['rpttyp'])) ? $_POST['rpttyp'] :'';
$pisdatefr = (isset($_POST['pisdatefr'])) ? $_POST['pisdatefr'] :'';
$pisdateto = (isset($_POST['pisdateto'])) ? $_POST['pisdateto'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header2.php");
     // include ("sidebar.php");

  if($projcode!='' && $pisdatefr!='' && $pisdateto!='') {
  // query project
  $res11query=""; $result11=""; $found11=0;
  $res11query="SELECT projectid, proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcode\" LIMIT 1";
  $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
    while($myrow11=$result11->fetch_assoc()) {
    $found11=1;
    $projectid11 = $myrow11['projectid'];
    $proj_fname11 = $myrow11['proj_fname'];
    $proj_sname11 = $myrow11['proj_sname'];
    if($proj_sname11=='') { $projname=$proj_fname11; } else { $projname=$proj_sname11; }
    } // while
  } // if
  // display report
?>
  <div>
    <table class="table table-striped table-bordered">

    <thead>
      <tr><th colspan="10">PHILKOEI INTERNATIONAL, INC.</th></tr>
      <tr><th colspan="10">Income Statement</th></tr>
      <tr><th colspan="10">As of <?php echo date('Y-M-d', strtotime($pisdateto)); ?></th></tr>
      <tr><th colspan="10">&nbsp;</th></tr>
      <tr><th colspan="7">Name of Project:</th><th colspan="3"><?php echo $projname; ?></th></tr>
      <tr><th colspan="7">Period Covered:</th><th colspan="3"><?php echo "".date('Y-M-d', strtotime($pisdatefr))." - ".date('Y-M-d', strtotime($pisdateto)).""; ?></th></tr>
      <tr><th colspan="10">&nbsp;</th></tr>
    </thead>

    <tbody>
      <tr><th colspan="7"></th><th colspan="2">ACTUAL</th><th>% CHANGE</th></tr>
<?php
      // for 1.00 Service Revenue
      $res12query=""; $result12=""; $found12=0; $ctr12=0;
      $res12query="SELECT acctnm1, glcodefr, glcodeto, lookupsd, tabpos FROM tblfinprojincstcdctg WHERE acctcd>='1.0' AND acctcd<='1.99' ORDER BY acctcd ASC";
      $result12=$dbh2->query($res12query);
      if($result12->num_rows>0) {
        while($myrow12=$result12->fetch_assoc()) {
        $found12=1;
        $ctr12=$ctr12+1;
        $acctnm112 = $myrow12['acctnm1'];
        $glcodefr12 = $myrow12['glcodefr'];
        $glcodeto12 = $myrow12['glcodeto'];
        $lookupsd12 = $myrow12['lookupsd'];
        $tabpos12 = $myrow12['tabpos'];
        if($tabpos12==1) {
          echo "<tr><td colspan='7'><strong>$acctnm112</strong></td><td></td><td align='right'>";
          $res14query=""; $result14=""; $found14=0; $ctr14=0;
          $res14query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr12\" AND glcode<=\"$glcodeto12\"";
          $result14=$dbh2->query($res14query);
          if($result14->num_rows>0) {
            while($myrow14=$result14->fetch_assoc()) {
            $found14=1;
            $ctr14=$ctr14+1;
            $debitamt14 = $myrow14['debitamt'];
            $creditamt14 = $myrow14['creditamt'];
            $totdebitamt14 += $debitamt14;
            $totcreditamt14 += $creditamt14;
            // reset vars
            $debitamt14=0; $creditamt14=0;
            } // while
          } // if
          $res14bquery=""; $result14b=""; $found14b=0; $ctr14b=0;
          $res14bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr12\" AND glcode<=\"$glcodeto12\"";
          $result14b=$dbh2->query($res14bquery);
          if($result14b->num_rows>0) {
            while($myrow14b=$result14b->fetch_assoc()) {
            $found14b=1;
            $ctr14b=$ctr14b+1;
            $debitamt14b = $myrow14b['debitamt'];
            $creditamt14b = $myrow14b['creditamt'];
            $totdebitamt14b += $debitamt14b;
            $totcreditamt14b += $creditamt14b;
            // reset vars
            $debitamt14b=0; $creditamt14b=0;
            } // while
          } // if
          $res14cquery=""; $result14c=""; $found14c=0; $ctr14c=0;
          $res14cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr12\" AND glcode<=\"$glcodeto12\"";
          $result14c=$dbh2->query($res14cquery);
          if($result14c->num_rows>0) {
            while($myrow14c=$result14c->fetch_assoc()) {
            $found14c=1;
            $ctr14c=$ctr14c+1;
            $debitamt14c = $myrow14c['debitamt'];
            $creditamt14c = $myrow14c['creditamt'];
            $totdebitamt14c += $debitamt14c;
            $totcreditamt14c += $creditamt14c;
            // reset vars
            $debitamt14c=0; $creditamt14c=0;
            } // while
          } // if
          $res14dquery=""; $result14d=""; $found14d=0; $ctr14d=0;
          $res14dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr12\" AND glcode<=\"$glcodeto12\"";
          $result14d=$dbh2->query($res14dquery);
          if($result14d->num_rows>0) {
            while($myrow14d=$result14d->fetch_assoc()) {
            $found14d=1;
            $ctr14d=$ctr14d+1;
            $debitamt14d = $myrow14d['debitamt'];
            $creditamt14d = $myrow14d['creditamt'];
            $totdebitamt14d += $debitamt14d;
            $totcreditamt14d += $creditamt14d;
            // reset vars
            $debitamt14d=0; $creditamt14d=0;
            } // while
          } // if
          $totdebitamt14bcd = $totdebitamt14 + $totdebitamt14b + $totdebitamt14c + $totdebitamt14d;
          $totcreditamt14bcd = $totcreditamt14 + $totcreditamt14b + $totcreditamt14c + $totcreditamt14d;
          echo "dr:".number_format($totdebitamt14bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt14bcd, 2);
          echo "</td><td></td></tr>";
          // reset vars
          $totdebitamt14=0; $totcreditamt14=0;
          $totdebitamt14b=0; $totcreditamt14b=0;
          $totdebitamt14c=0; $totcreditamt14c=0;
          $totdebitamt14d=0; $totcreditamt14d=0;
        } else if($tabpos12==3) {
          echo "<tr><td colspan='2'></td><td colspan='5'>$acctnm112</td><td align='right'>";
          $res15query=""; $result15=""; $found15=0; $ctr15=0;
          $res15query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr12\" AND glcode<=\"$glcodeto12\"";
          $result15=$dbh2->query($res15query);
          if($result15->num_rows>0) {
            while($myrow15=$result15->fetch_assoc()) {
            $found15=1;
            $ctr15=$ctr15+1;
            $debitamt15 = $myrow15['debitamt'];
            $creditamt15 = $myrow15['creditamt'];
            $totdebitamt15 += $debitamt15;
            $totcreditamt15 += $creditamt15;
            // reset vars
            $debitamt15=0; $creditamt15=0;
            } // while
          } // if
          $res15bquery=""; $result15b=""; $found15b=0; $ctr15b=0;
          $res15bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr12\" AND glcode<=\"$glcodeto12\"";
          $result15b=$dbh2->query($res15bquery);
          if($result15b->num_rows>0) {
            while($myrow15b=$result15b->fetch_assoc()) {
            $found15b=1;
            $ctr15b=$ctr15b+1;
            $debitamt15b = $myrow15b['debitamt'];
            $creditamt15b = $myrow15b['creditamt'];
            $totdebitamt15b += $debitamt15b;
            $totcreditamt15b += $creditamt15b;
            // reset vars
            $debitamt15b=0; $creditamt15b=0;
            } // while
          } // if
          $res15cquery=""; $result15c=""; $found15c=0; $ctr15c=0;
          $res15cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr12\" AND glcode<=\"$glcodeto12\"";
          $result15c=$dbh2->query($res15cquery);
          if($result15c->num_rows>0) {
            while($myrow15c=$result15c->fetch_assoc()) {
            $found15c=1;
            $ctr15c=$ctr15c+1;
            $debitamt15c = $myrow15c['debitamt'];
            $creditamt15c = $myrow15c['creditamt'];
            $totdebitamt15c += $debitamt15c;
            $totcreditamt15c += $creditamt15c;
            // reset vars
            $debitamt15c=0; $creditamt15c=0;
            } // while
          } // if
          $res15dquery=""; $result15d=""; $found15d=0; $ctr15d=0;
          $res15dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr12\" AND glcode<=\"$glcodeto12\"";
          $result15d=$dbh2->query($res15dquery);
          if($result15d->num_rows>0) {
            while($myrow15d=$result15d->fetch_assoc()) {
            $found15d=1;
            $ctr15d=$ctr15d+1;
            $debitamt15d = $myrow15d['debitamt'];
            $creditamt15d = $myrow15d['creditamt'];
            $totdebitamt15d += $debitamt15d;
            $totcreditamt15d += $creditamt15d;
            // reset vars
            $debitamt15d=0; $creditamt15d=0;
            } // while
          } // if
          $totdebitamt15bcd = $totdebitamt15 + $totdebitamt15b + $totdebitamt15c + $totdebitamt15d;
          $totcreditamt15bcd = $totcreditamt15 + $totcreditamt15b + $totcreditamt15c + $totcreditamt15d;
          echo "dr:".number_format($totdebitamt15bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt15bcd, 2);
          echo "</td><td></td><td></td></tr>";
          // reset vars
          $totdebitamt15=0; $totcreditamt15=0;
          $totdebitamt15b=0; $totcreditamt15b=0;
          $totdebitamt15c=0; $totcreditamt15c=0;
          $totdebitamt15d=0; $totcreditamt15d=0;
        } // if-else
        } // while
      } // if
echo "<p>f12:$found12, f14:$found14<br>r12q: $res12query<br>r14q: $res14query<br>r15q: $res15query</p>";

      // for 2.00 Less: Cost of Services
      $res16query=""; $result16=""; $found16=0; $ctr16=0;
      $res16query="SELECT acctnm1, glcodefr, glcodeto, lookupsd, tabpos FROM tblfinprojincstcdctg WHERE acctcd>='2.0' AND acctcd<='2.99' ORDER BY acctcd ASC";
      $result16=$dbh2->query($res16query);
      if($result16->num_rows>0) {
        while($myrow16=$result16->fetch_assoc()) {
        $found16=1;
        $ctr16=$ctr16+1;
        $acctnm116 = $myrow16['acctnm1'];
        $glcodefr16 = $myrow16['glcodefr'];
        $glcodeto16 = $myrow16['glcodeto'];
        $lookupsd16 = $myrow16['lookupsd'];
        $tabpos16 = $myrow16['tabpos'];
        if($tabpos16==1) {
          echo "<tr><td colspan='7'><strong>$acctnm116</strong></td><td></td><td align='right'>";
          $res17query=""; $result17=""; $found17=0; $ctr17=0;
          $res17query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr16\" AND glcode<=\"$glcodeto16\"";
          $result17=$dbh2->query($res17query);
          if($result17->num_rows>0) {
            while($myrow17=$result17->fetch_assoc()) {
            $found17=1;
            $ctr17=$ctr17+1;
            $debitamt17 = $myrow17['debitamt'];
            $creditamt17 = $myrow17['creditamt'];
            $totdebitamt17 += $debitamt17;
            $totcreditamt17 += $creditamt17;
echo "$glcodefr16-to-$glcodeto16 cv:".number_format($debitamt17, 2)."|".number_format($creditamt17, 2)." cvtot:".number_format($totdebitamt17, 2)."|".number_format($totcreditamt17, 2)."<br>";
            // reset vars
            $debitamt17=0; $creditamt17=0;
            } // while
          } // if
          $res17bquery=""; $result17b=""; $found17b=0; $ctr17b=0;
          $res17bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr16\" AND glcode<=\"$glcodeto16\"";
          $result17b=$dbh2->query($res17bquery);
          if($result17b->num_rows>0) {
            while($myrow17b=$result17b->fetch_assoc()) {
            $found17b=1;
            $ctr17b=$ctr17b+1;
            $debitamt17b = $myrow17b['debitamt'];
            $creditamt17b = $myrow17b['creditamt'];
            $totdebitamt17b += $debitamt17b;
            $totcreditamt17b += $creditamt17b;
echo "$glcodefr16-to-$glcodeto16 ap:".number_format($debitamt17b, 2)."|".number_format($creditamt17b, 2)." aptot:".number_format($totdebitamt17b, 2)."|".number_format($totcreditamt17b, 2)."<br>";
            // reset vars
            $debitamt17b=0; $creditamt17b=0;
            } // while
          } // if
          $res17cquery=""; $result17c=""; $found17c=0; $ctr17c=0;
          $res17cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr16\" AND glcode<=\"$glcodeto16\"";
          $result17c=$dbh2->query($res17cquery);
          if($result17c->num_rows>0) {
            while($myrow17c=$result17c->fetch_assoc()) {
            $found17c=1;
            $ctr17c=$ctr17c+1;
            $debitamt17c = $myrow17c['debitamt'];
            $creditamt17c = $myrow17c['creditamt'];
            $totdebitamt17c += $debitamt17c;
            $totcreditamt17c += $creditamt17c;
echo "$glcodefr16-to-$glcodeto16 crv:".number_format($debitamt17c, 2)."|".number_format($creditamt17c, 2)." crvtot:".number_format($totdebitamt17c, 2)."|".number_format($totcreditamt17c, 2)."<br>";
            // reset vars
            $debitamt17c=0; $creditamt17c=0;
            } // while
          } // if
          $res17dquery=""; $result17d=""; $found17d=0; $ctr17d=0;
          $res17dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr16\" AND glcode<=\"$glcodeto16\"";
          $result17d=$dbh2->query($res17dquery);
          if($result17d->num_rows>0) {
            while($myrow17d=$result17d->fetch_assoc()) {
            $found17d=1;
            $ctr17d=$ctr17d+1;
            $debitamt17d = $myrow17d['debitamt'];
            $creditamt17d = $myrow17d['creditamt'];
            $totdebitamt17d += $debitamt17d;
            $totcreditamt17d += $creditamt17d;
echo "$glcodefr16-to-$glcodeto16 jv:".number_format($debitamt17d, 2)."|".number_format($creditamt17d, 2)." jvtot:".number_format($totdebitamt17d, 2)."|".number_format($totcreditamt17d, 2)."<br>";
            // reset vars
            $debitamt17d=0; $creditamt17d=0;
            } // while
          } // if
          $totdebitamt17bcd = $totdebitamt17 + $totdebitamt17b + $totdebitamt17c + $totdebitamt17d;
          $totcreditamt17bcd = $totcreditamt17 + $totcreditamt17b + $totcreditamt17c + $totcreditamt17d;
          echo "dr:".number_format($totdebitamt17bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt17bcd, 2);
          echo "</td><td></td></tr>";
          // reset vars
          $totdebitamt17=0; $totcreditamt17=0;
          $totdebitamt17b=0; $totcreditamt17b=0;
          $totdebitamt17c=0; $totcreditamt17c=0;
          $totdebitamt17d=0; $totcreditamt17d=0;
        } else if($tabpos16==3) {
          echo "<tr><td colspan='2'></td><td colspan='5'>$acctnm116</td><td align='right'>";
          $res18query=""; $result18=""; $found18=0; $ctr18=0;
          $res18query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr16\" AND glcode<=\"$glcodeto16\"";
          $result18=$dbh2->query($res18query);
          if($result18->num_rows>0) {
            while($myrow18=$result18->fetch_assoc()) {
            $found18=1;
            $ctr18=$ctr18+1;
            $debitamt18 = $myrow18['debitamt'];
            $creditamt18 = $myrow18['creditamt'];
            $totdebitamt18 += $debitamt18;
            $totcreditamt18 += $creditamt18;
            $gtotdebitamt18 += $totdebitamt18;
            $gtotcreditamt18 += $totcreditamt18;
echo "$glcodefr16-to-$glcodeto16 cv:".number_format($debitamt18, 2)."|".number_format($creditamt18, 2)." cvtot:".number_format($totdebitamt18, 2)."|".number_format($totcreditamt18, 2)." cvgtot:".number_format($gtotdebitamt18, 2)."|".number_format($gtotcreditamt18, 2)."<br>";
            // reset vars
            $debitamt18=0; $creditamt18=0;
            } // while
          } // if
          $res18bquery=""; $result18b=""; $found18b=0; $ctr18b=0;
          $res18bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr16\" AND glcode<=\"$glcodeto16\"";
          $result18b=$dbh2->query($res18bquery);
          if($result18b->num_rows>0) {
            while($myrow18b=$result18b->fetch_assoc()) {
            $found18b=1;
            $ctr18b=$ctr18b+1;
            $debitamt18b = $myrow18b['debitamt'];
            $creditamt18b = $myrow18b['creditamt'];
            $totdebitamt18b += $debitamt18b;
            $totcreditamt18b += $creditamt18b;
            $gtotdebitamt18 += $totdebitamt18b;
            $gtotcreditamt18 += $totcreditamt18b;
echo "$glcodefr16-to-$glcodeto16 ap:".number_format($debitamt18b, 2)."|".number_format($creditamt18b, 2)." aptot:".number_format($totdebitamt18b, 2)."|".number_format($totcreditamt18b, 2)." apgtot:".number_format($gtotdebitamt18, 2)."|".number_format($gtotcreditamt18, 2)."<br>";
            // reset vars
            $debitamt18b=0; $creditamt18b=0;
            } // while
          } // if
          $res18cquery=""; $result18c=""; $found18c=0; $ctr18c=0;
          $res18cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr16\" AND glcode<=\"$glcodeto16\"";
          $result18c=$dbh2->query($res18cquery);
          if($result18c->num_rows>0) {
            while($myrow18c=$result18c->fetch_assoc()) {
            $found18c=1;
            $ctr18c=$ctr18c+1;
            $debitamt18c = $myrow18c['debitamt'];
            $creditamt18c = $myrow18c['creditamt'];
            $totdebitamt18c += $debitamt18c;
            $totcreditamt18c += $creditamt18c;
            $gtotdebitamt18 += $totdebitamt18c;
            $gtotcreditamt18 += $totcreditamt18c;
echo "$glcodefr16-to-$glcodeto16 crv:".number_format($debitamt18c, 2)."|".number_format($creditamt18c, 2)." crvtot:".number_format($totdebitamt18c, 2)."|".number_format($totcreditamt18c, 2)." crvgtot:".number_format($gtotdebitamt18, 2)."|".number_format($gtotcreditamt18, 2)."<br>";
            // reset vars
            $debitamt18c=0; $creditamt18c=0;
            } // while
          } // if
          $res18dquery=""; $result18d=""; $found18d=0; $ctr18d=0;
          $res18dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr16\" AND glcode<=\"$glcodeto16\"";
          $result18d=$dbh2->query($res18dquery);
          if($result18d->num_rows>0) {
            while($myrow18d=$result18d->fetch_assoc()) {
            $found18d=1;
            $ctr18d=$ctr18d+1;
            $debitamt18d = $myrow18d['debitamt'];
            $creditamt18d = $myrow18d['creditamt'];
            $totdebitamt18d += $debitamt18d;
            $totcreditamt18d += $creditamt18d;
            $gtotdebitamt18 += $totdebitamt18d;
            $gtotcreditamt18 += $totcreditamt18d;
echo "$glcodefr16-to-$glcodeto16 jv:".number_format($debitamt18d, 2)."|".number_format($creditamt18d, 2)." jvtot:".number_format($totdebitamt18d, 2)."|".number_format($totcreditamt18d, 2)." jvgtot:".number_format($gtotdebitamt18, 2)."|".number_format($gtotcreditamt18, 2)."<br>";
            // reset vars
            $debitamt18d=0; $creditamt18d=0;
            } // while
          } // if
          $totdebitamt18bcd = $totdebitamt18 + $totdebitamt18b + $totdebitamt18c + $totdebitamt18d;
          $totcreditamt18bcd = $totcreditamt18 + $totcreditamt18b + $totcreditamt18c + $totcreditamt18d;
          echo "dr:".number_format($totdebitamt18bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt18bcd, 2);
          echo "</td><td></td><td></td></tr>";
          // reset vars
          $totdebitamt18=0; $totcreditamt18=0;
          $totdebitamt18b=0; $totcreditamt18b=0;
          $totdebitamt18c=0; $totcreditamt18c=0;
          $totdebitamt18d=0; $totcreditamt18d=0;
        } // if-else
        } // while
      } // if
      echo "<tr><td colspan='7'><strong>Gross Profit</strong></td><td></td><td align='right'><strong>";
      echo "dr:".number_format($totdebitamt18bcd, 2)."<br>";
      echo "cr:".number_format($totcreditamt18bcd, 2);
      echo "</strong></td><td></td><td></td></tr>";
echo "<p>f12:$found12, f16:$found16<br>r16q: $res16query<br>r17q: $res17query<br>r18q: $res18query</p>";

      // for 3.00 Less: Other Operating Expenses
      $res19query=""; $result19=""; $found19=0; $ctr19=0;
      $res19query="SELECT acctnm1, glcodefr, glcodeto, lookupsd, tabpos FROM tblfinprojincstcdctg WHERE acctcd>='3.0' AND acctcd<='3.99' ORDER BY acctcd ASC";
      $result19=$dbh2->query($res19query);
      if($result19->num_rows>0) {
        while($myrow19=$result19->fetch_assoc()) {
        $found19=1;
        $ctr19=$ctr19+1;
        $acctnm119 = $myrow19['acctnm1'];
        $glcodefr19 = $myrow19['glcodefr'];
        $glcodeto19 = $myrow19['glcodeto'];
        $lookupsd19 = $myrow19['lookupsd'];
        $tabpos19 = $myrow19['tabpos'];
        if($tabpos19==1) {
          echo "<tr><td colspan='7'><strong>$acctnm119</strong></td><td></td><td align='right'>";
          $res20query=""; $result20=""; $found20=0; $ctr20=0;
          $res20query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr19\" AND glcode<=\"$glcodeto19\"";
          $result20=$dbh2->query($res20query);
          if($result20->num_rows>0) {
            while($myrow20=$result20->fetch_assoc()) {
            $found20=1;
            $ctr20=$ctr20+1;
            $debitamt20 = $myrow20['debitamt'];
            $creditamt20 = $myrow20['creditamt'];
            $totdebitamt20 += $debitamt20;
            $totcreditamt20 += $creditamt20;
echo "$glcodefr19-to-$glcodeto19 cv:".number_format($debitamt20, 2)."|".number_format($creditamt20, 2)." cvtot:".number_format($totdebitamt20, 2)."|".number_format($totcreditamt20, 2)."<br>";
            // reset vars
            $debitamt20=0; $creditamt20=0;
            } // while
          } // if
          $res20bquery=""; $result20b=""; $found20b=0; $ctr20b=0;
          $res20bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr19\" AND glcode<=\"$glcodeto19\"";
          $result20b=$dbh2->query($res20bquery);
          if($result20b->num_rows>0) {
            while($myrow20b=$result20b->fetch_assoc()) {
            $found20b=1;
            $ctr20b=$ctr20b+1;
            $debitamt20b = $myrow20b['debitamt'];
            $creditamt20b = $myrow20b['creditamt'];
            $totdebitamt20b += $debitamt20b;
            $totcreditamt20b += $creditamt20b;
echo "$glcodefr19-to-$glcodeto19 ap:".number_format($debitamt20b, 2)."|".number_format($creditamt20b, 2)." aptot:".number_format($totdebitamt20b, 2)."|".number_format($totcreditamt20b, 2)."<br>";
            // reset vars
            $debitamt20b=0; $creditamt20b=0;
            } // while
          } // if
          $res20cquery=""; $result20c=""; $found20c=0; $ctr20c=0;
          $res20cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr19\" AND glcode<=\"$glcodeto19\"";
          $result20c=$dbh2->query($res20cquery);
          if($result20c->num_rows>0) {
            while($myrow20c=$result20c->fetch_assoc()) {
            $found20c=1;
            $ctr20c=$ctr20c+1;
            $debitamt20c = $myrow20c['debitamt'];
            $creditamt20c = $myrow20c['creditamt'];
            $totdebitamt20c += $debitamt20c;
            $totcreditamt20c += $creditamt20c;
echo "$glcodefr19-to-$glcodeto19 crv:".number_format($debitamt20c, 2)."|".number_format($creditamt20c, 2)." crvtot:".number_format($totdebitamt20c, 2)."|".number_format($totcreditamt20c, 2)."<br>";
            // reset vars
            $debitamt20c=0; $creditamt20c=0;
            } // while
          } // if
          $res20dquery=""; $result20d=""; $found20d=0; $ctr20d=0;
          $res20dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr19\" AND glcode<=\"$glcodeto19\"";
          $result20d=$dbh2->query($res20dquery);
          if($result20d->num_rows>0) {
            while($myrow20d=$result20d->fetch_assoc()) {
            $found20d=1;
            $ctr20d=$ctr20d+1;
            $debitamt20d = $myrow20d['debitamt'];
            $creditamt20d = $myrow20d['creditamt'];
            $totdebitamt20d += $debitamt20d;
            $totcreditamt20d += $creditamt20d;
echo "$glcodefr19-to-$glcodeto19 jv:".number_format($debitamt20d, 2)."|".number_format($creditamt20d, 2)." jvtot:".number_format($totdebitamt20d, 2)."|".number_format($totcreditamt20d, 2)."<br>";
            // reset vars
            $debitamt20d=0; $creditamt20d=0;
            } // while
          } // if
          $totdebitamt20bcd = $totdebitamt20 + $totdebitamt20b + $totdebitamt20c + $totdebitamt20d;
          $totcreditamt20bcd = $totcreditamt20 + $totcreditamt20b + $totcreditamt20c + $totcreditamt20d;
          echo "dr:".number_format($totdebitamt20bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt20bcd, 2);
          echo "</td><td></td></tr>";
          // reset vars
          $totdebitamt20=0; $totcreditamt20=0;
          $totdebitamt20b=0; $totcreditamt20b=0;
          $totdebitamt20c=0; $totcreditamt20c=0;
          $totdebitamt20c=0; $totcreditamt20c=0;
        } else if($tabpos19==3) {
          echo "<tr><td colspan='2'></td><td colspan='5'>$acctnm119</td><td align='right'>";
          $res21query=""; $result21=""; $found21=0; $ctr21=0;
          $res21query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr19\" AND glcode<=\"$glcodeto19\"";
          $result21=$dbh2->query($res21query);
          if($result21->num_rows>0) {
            while($myrow21=$result21->fetch_assoc()) {
            $found21=1;
            $ctr21=$ctr21+1;
            $debitamt21 = $myrow21['debitamt'];
            $creditamt21 = $myrow21['creditamt'];
            $totdebitamt21 += $debitamt21;
            $totcreditamt21 += $creditamt21;
            $gtotdebitamt21 += $totdebitamt21;
            $gtotcreditamt21 += $totcreditamt21;
echo "$glcodefr19-to-$glcodeto19 cv:".number_format($debitamt21, 2)."|".number_format($creditamt21, 2)." cvtot:".number_format($totdebitamt21, 2)."|".number_format($totcreditamt21, 2)." cvgtot:".number_format($gtotdebitamt21, 2)."|".number_format($gtotcreditamt21, 2)."<br>";
            // reset vars
            $debitamt21=0; $creditamt21=0;
            } // while
          } // if
          $res21bquery=""; $result21b=""; $found21b=0; $ctr21b=0;
          $res21bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr19\" AND glcode<=\"$glcodeto19\"";
          $result21b=$dbh2->query($res21bquery);
          if($result21b->num_rows>0) {
            while($myrow21b=$result21b->fetch_assoc()) {
            $found21b=1;
            $ctr21b=$ctr21b+1;
            $debitamt21b = $myrow21b['debitamt'];
            $creditamt21b = $myrow21b['creditamt'];
            $totdebitamt21b += $debitamt21b;
            $totcreditamt21b += $creditamt21b;
            $gtotdebitamt21 += $totdebitamt21b;
            $gtotcreditamt21 += $totcreditamt21b;
echo "$glcodefr19-to-$glcodeto19 ap:".number_format($debitamt21b, 2)."|".number_format($creditamt21b, 2)." aptot:".number_format($totdebitamt21b, 2)."|".number_format($totcreditamt21b, 2)." apgtot:".number_format($gtotdebitamt21, 2)."|".number_format($gtotcreditamt21, 2)."<br>";
            // reset vars
            $debitamt21b=0; $creditamt21b=0;
            } // while
          } // if
          $res21cquery=""; $result21c=""; $found21c=0; $ctr21c=0;
          $res21cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr19\" AND glcode<=\"$glcodeto19\"";
          $result21c=$dbh2->query($res21cquery);
          if($result21c->num_rows>0) {
            while($myrow21c=$result21c->fetch_assoc()) {
            $found21c=1;
            $ctr21c=$ctr21c+1;
            $debitamt21c = $myrow21c['debitamt'];
            $creditamt21c = $myrow21c['creditamt'];
            $totdebitamt21c += $debitamt21c;
            $totcreditamt21c += $creditamt21c;
            $gtotdebitamt21 += $totdebitamt21c;
            $gtotcreditamt21 += $totcreditamt21c;
echo "$glcodefr19-to-$glcodeto19 crv:".number_format($debitamt21c, 2)."|".number_format($creditamt21c, 2)." crvtot:".number_format($totdebitamt21c, 2)."|".number_format($totcreditamt21c, 2)." crvgtot:".number_format($gtotdebitamt21, 2)."|".number_format($gtotcreditamt21, 2)."<br>";
            // reset vars
            $debitamt21c=0; $creditamt21c=0;
            } // while
          } // if
          $res21dquery=""; $result21d=""; $found21d=0; $ctr21d=0;
          $res21dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr19\" AND glcode<=\"$glcodeto19\"";
          $result21d=$dbh2->query($res21dquery);
          if($result21d->num_rows>0) {
            while($myrow21d=$result21d->fetch_assoc()) {
            $found21d=1;
            $ctr21d=$ctr21d+1;
            $debitamt21d = $myrow21d['debitamt'];
            $creditamt21d = $myrow21d['creditamt'];
            $totdebitamt21d += $debitamt21d;
            $totcreditamt21d += $creditamt21d;
            $gtotdebitamt21 += $totdebitamt21d;
            $gtotcreditamt21 += $totcreditamt21d;
echo "$glcodefr19-to-$glcodeto19 jv:".number_format($debitamt21d, 2)."|".number_format($creditamt21d, 2)." jvtot:".number_format($totdebitamt21d, 2)."|".number_format($totcreditamt21d, 2)." jvgtot:".number_format($gtotdebitamt21, 2)."|".number_format($gtotcreditamt21, 2)."<br>";
            // reset vars
            $debitamt21d=0; $creditamt21d=0;
            } // while
          } // if
          $totdebitamt21bcd = $totdebitamt21 + $totdebitamt21b + $totdebitamt21c + $totdebitamt21d;
          $totcreditamt21bcd = $totcreditamt21 + $totcreditamt21b + $totcreditamt21c + $totcreditamt21d;
          echo "dr:".number_format($totdebitamt21bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt21bcd, 2);
          echo "</td><td></td><td></td></tr>";
          // reset vars
          $totdebitamt21=0; $totcreditamt21=0;
          $totdebitamt21b=0; $totcreditamt21b=0;
          $totdebitamt21c=0; $totcreditamt21c=0;
          $totdebitamt21d=0; $totcreditamt21d=0;
        } // if-else
        } // while
      } // if
      echo "<tr><td colspan='7'><strong>Operating Profit</strong></td><td></td><td align='right'><strong>";
      echo "dr:".number_format($totdebitamt21bcd, 2)."<br>";
      echo "cr:".number_format($totcreditamt21bcd, 2);
      echo "</strong></td><td></td><td></td></tr>";
echo "<p>f12:$found12, f16:$found19<br>r19q: $res19query<br>r20q: $res20query<br>r21q: $res21query</p>";

      // for 4.00 Add/(Less): Other Income (Charges) - Net
      $res22query=""; $result22=""; $found22=0; $ctr22=0;
      $res22query="SELECT acctnm1, glcodefr, glcodeto, lookupsd, tabpos FROM tblfinprojincstcdctg WHERE acctcd>='4.0' AND acctcd<='4.99' ORDER BY acctcd ASC";
      $result22=$dbh2->query($res22query);
      if($result22->num_rows>0) {
        while($myrow22=$result22->fetch_assoc()) {
        $found22=1;
        $ctr22=$ctr22+1;
        $acctnm122 = $myrow22['acctnm1'];
        $glcodefr22 = $myrow22['glcodefr'];
        $glcodeto22 = $myrow22['glcodeto'];
        $lookupsd22 = $myrow22['lookupsd'];
        $tabpos22 = $myrow22['tabpos'];
        if($tabpos22==1) {
          echo "<tr><td colspan='7'><strong>$acctnm122</strong></td><td></td><td align='right'>";
          $res23query=""; $result23=""; $found23=0; $ctr23=0;
          $res23query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr22\" AND glcode<=\"$glcodeto22\"";
          $result23=$dbh2->query($res23query);
          if($result23->num_rows>0) {
            while($myrow23=$result23->fetch_assoc()) {
            $found23=1;
            $ctr23=$ctr23+1;
            $debitamt23 = $myrow23['debitamt'];
            $creditamt23 = $myrow23['creditamt'];
            $totdebitamt23 += $debitamt23;
            $totcreditamt23 += $creditamt23;
echo "$glcodefr22-to-$glcodeto22 cv:".number_format($debitamt23, 2)."|".number_format($creditamt23, 2)." cvtot:".number_format($totdebitamt23, 2)."|".number_format($totcreditamt23, 2)."<br>";
            // reset vars
            $debitamt23=0; $creditamt23=0;
            } // while
          } // if
          $res23bquery=""; $result23b=""; $found23b=0; $ctr23b=0;
          $res23bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr22\" AND glcode<=\"$glcodeto22\"";
          $result23b=$dbh2->query($res23bquery);
          if($result23b->num_rows>0) {
            while($myrow23b=$result23b->fetch_assoc()) {
            $found23b=1;
            $ctr23b=$ctr23b+1;
            $debitamt23b = $myrow23b['debitamt'];
            $creditamt23b = $myrow23b['creditamt'];
            $totdebitamt23b += $debitamt23b;
            $totcreditamt23b += $creditamt23b;
echo "$glcodefr22-to-$glcodeto22 ap:".number_format($debitamt23b, 2)."|".number_format($creditamt23b, 2)." aptot:".number_format($totdebitamt23b, 2)."|".number_format($totcreditamt23b, 2)."<br>";
            // reset vars
            $debitamt23b=0; $creditamt23b=0;
            } // while
          } // if
          $res23cquery=""; $result23c=""; $found23c=0; $ctr23c=0;
          $res23cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr22\" AND glcode<=\"$glcodeto22\"";
          $result23c=$dbh2->query($res23cquery);
          if($result23c->num_rows>0) {
            while($myrow23c=$result23c->fetch_assoc()) {
            $found23c=1;
            $ctr23c=$ctr23c+1;
            $debitamt23c = $myrow23c['debitamt'];
            $creditamt23c = $myrow23c['creditamt'];
            $totdebitamt23c += $debitamt23c;
            $totcreditamt23c += $creditamt23c;
echo "$glcodefr22-to-$glcodeto22 crv:".number_format($debitamt23c, 2)."|".number_format($creditamt23c, 2)." crvtot:".number_format($totdebitamt23c, 2)."|".number_format($totcreditamt23c, 2)."<br>";
            // reset vars
            $debitamt23c=0; $creditamt23c=0;
            } // while
          } // if
          $res23dquery=""; $result23d=""; $found23d=0; $ctr23d=0;
          $res23dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr22\" AND glcode<=\"$glcodeto22\"";
          $result23d=$dbh2->query($res23dquery);
          if($result23d->num_rows>0) {
            while($myrow23d=$result23d->fetch_assoc()) {
            $found23d=1;
            $ctr23d=$ctr23d+1;
            $debitamt23d = $myrow23d['debitamt'];
            $creditamt23d = $myrow23d['creditamt'];
            $totdebitamt23d += $debitamt23d;
            $totcreditamt23d += $creditamt23d;
echo "$glcodefr22-to-$glcodeto22 jv:".number_format($debitamt23d, 2)."|".number_format($creditamt23d, 2)." jvtot:".number_format($totdebitamt23d, 2)."|".number_format($totcreditamt23d, 2)."<br>";
            // reset vars
            $debitamt23d=0; $creditamt23d=0;
            } // while
          } // if
          $totdebitamt23bcd = $totdebitamt23 + $debitamt23b + $totdebitamt23c + $totdebitamt23d;
          $totcreditamt23bcd = $totcreditamt23 + $totcreditamt23b + $totcreditamt23c + $totcreditamt23d;
          echo "dr:".number_format($totdebitamt23bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt23bcd, 2);
          echo "</td><td></td></tr>";
          // reset vars
          $totdebitamt23=0; $totcreditamt23=0;
          $totdebitamt23b=0; $totcreditamt23b=0;
          $totdebitamt23c=0; $totcreditamt23c=0;
          $totdebitamt23d=0; $totcreditamt23d=0;
        } else if($tabpos22==3) {
          echo "<tr><td colspan='2'></td><td colspan='5'>$acctnm122</td><td align='right'>";
          $res24query=""; $result24=""; $found24=0; $ctr24=0;
          $res24query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr22\" AND glcode<=\"$glcodeto22\"";
          $result24=$dbh2->query($res24query);
          if($result24->num_rows>0) {
            while($myrow24=$result24->fetch_assoc()) {
            $found24=1;
            $ctr24=$ctr24+1;
            $debitamt24 = $myrow24['debitamt'];
            $creditamt24 = $myrow24['creditamt'];
            $totdebitamt24 += $debitamt24;
            $totcreditamt24 += $creditamt24;
            $gtotdebitamt24 += $totdebitamt24;
            $gtotcreditamt24 += $totcreditamt24;
echo "$glcodefr22-to-$glcodeto22 cv:".number_format($debitamt24, 2)."|".number_format($creditamt24, 2)." cvtot:".number_format($totdebitamt24, 2)."|".number_format($totcreditamt24, 2)." cvgtot:".number_format($gtotdebitamt24, 2)."|".number_format($gtotcreditamt24, 2)."<br>";
            // reset vars
            $debitamt24=0; $creditamt24=0;
            } // while
          } // if
          $res24bquery=""; $result24b=""; $found24b=0; $ctr24b=0;
          $res24bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr22\" AND glcode<=\"$glcodeto22\"";
          $result24b=$dbh2->query($res24bquery);
          if($result24b->num_rows>0) {
            while($myrow24b=$result24b->fetch_assoc()) {
            $found24b=1;
            $ctr24b=$ctr24b+1;
            $debitamt24b = $myrow24b['debitamt'];
            $creditamt24b = $myrow24b['creditamt'];
            $totdebitamt24b += $debitamt24b;
            $totcreditamt24b += $creditamt24b;
            $gtotdebitamt24 += $totdebitamt24b;
            $gtotcreditamt24 += $totcreditamt24b;
echo "$glcodefr22-to-$glcodeto22 ap:".number_format($debitamt24b, 2)."|".number_format($creditamt24b, 2)." aptot:".number_format($totdebitamt24b, 2)."|".number_format($totcreditamt24b, 2)." apgtot:".number_format($gtotdebitamt24, 2)."|".number_format($gtotcreditamt24, 2)."<br>";
            // reset vars
            $debitamt24b=0; $creditamt24b=0;
            } // while
          } // if
          $res24cquery=""; $result24c=""; $found24c=0; $ctr24c=0;
          $res24cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr22\" AND glcode<=\"$glcodeto22\"";
          $result24c=$dbh2->query($res24cquery);
          if($result24c->num_rows>0) {
            while($myrow24c=$result24c->fetch_assoc()) {
            $found24c=1;
            $ctr24c=$ctr24c+1;
            $debitamt24c = $myrow24c['debitamt'];
            $creditamt24c = $myrow24c['creditamt'];
            $totdebitamt24c += $debitamt24c;
            $totcreditamt24c += $creditamt24c;
            $gtotdebitamt24 += $totdebitamt24c;
            $gtotcreditamt24 += $totcreditamt24c;
echo "$glcodefr22-to-$glcodeto22 crv:".number_format($debitamt24c, 2)."|".number_format($creditamt24c, 2)." crvtot:".number_format($totdebitamt24c, 2)."|".number_format($totcreditamt24c, 2)." crvgtot:".number_format($gtotdebitamt24, 2)."|".number_format($gtotcreditamt24, 2)."<br>";
            // reset vars
            $debitamt24c=0; $creditamt24c=0;
            } // while
          } // if
          $res24dquery=""; $result24d=""; $found24d=0; $ctr24d=0;
          $res24dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr22\" AND glcode<=\"$glcodeto22\"";
          $result24d=$dbh2->query($res24dquery);
          if($result24d->num_rows>0) {
            while($myrow24d=$result24d->fetch_assoc()) {
            $found24d=1;
            $ctr24d=$ctr24d+1;
            $debitamt24d = $myrow24d['debitamt'];
            $creditamt24d = $myrow24d['creditamt'];
            $totdebitamt24d += $debitamt24d;
            $totcreditamt24d += $creditamt24d;
            $gtotdebitamt24 += $totdebitamt24d;
            $gtotcreditamt24 += $totcreditamt24d;
echo "$glcodefr22-to-$glcodeto22 jv:".number_format($debitamt24d, 2)."|".number_format($creditamt24d, 2)." jvtot:".number_format($totdebitamt24d, 2)."|".number_format($totcreditamt24d, 2)." jvgtot:".number_format($gtotdebitamt24, 2)."|".number_format($gtotcreditamt24, 2)."<br>";
            // reset vars
            $debitamt24d=0; $creditamt24d=0;
            } // while
          } // if
          $totdebitamt24bcd = $totdebitamt24 + $totdebitamt24b + $totdebitamt24c + $totdebitamt24d;
          $totcreditamt24bcd = $totcreditamt24 + $totcreditamt24b + $totcreditamt24c + $totcreditamt24d;
          echo "dr:".number_format($totdebitamt24bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt24bcd, 2);
          echo "</td><td></td><td></td></tr>";
          // reset vars
          $totdebitamt24=0; $totcreditamt24=0;
          $totdebitamt24b=0; $totcreditamt24b=0;
          $totdebitamt24c=0; $totcreditamt24c=0;
          $totdebitamt24d=0; $totcreditamt24d=0;
        } // if-else
        } // while
      } // if
      echo "<tr><td colspan='7'><strong>Profit Before Tax</strong></td><td></td><td align='right'><strong>";
      echo "dr:".number_format($gtotdebitamt24, 2)."<br>";
      echo "cr:".number_format($gtotcreditamt24, 2);
      echo "</strong></td><td></td><td></td></tr>";
echo "<p>f12:$found12, f22:$found22<br>r22q: $res22query<br>r23q: $res23query<br>r24q: $res24query</p>";

      // for 5.00 Less: Tax Expense
      $res25query=""; $result25=""; $found25=0; $ctr25=0;
      $res25query="SELECT acctnm1, glcodefr, glcodeto, lookupsd, tabpos FROM tblfinprojincstcdctg WHERE acctcd>='5.0' AND acctcd<='5.99' ORDER BY acctcd ASC";
      $result25=$dbh2->query($res25query);
      if($result25->num_rows>0) {
        while($myrow25=$result25->fetch_assoc()) {
        $found25=1;
        $ctr25=$ctr25+1;
        $acctnm125 = $myrow25['acctnm1'];
        $glcodefr25 = $myrow25['glcodefr'];
        $glcodeto25 = $myrow25['glcodeto'];
        $lookupsd25 = $myrow25['lookupsd'];
        $tabpos25 = $myrow25['tabpos'];
        if($tabpos25==1) {
          echo "<tr><td colspan='7'><strong>$acctnm125</strong></td><td></td><td align='right'>";
          $res26query=""; $result26=""; $found26=0; $ctr26=0;
          $res26query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr25\" AND glcode<=\"$glcodeto25\"";
          $result26=$dbh2->query($res26query);
          if($result26->num_rows>0) {
            while($myrow26=$result26->fetch_assoc()) {
            $found26=1;
            $ctr26=$ctr26+1;
            $debitamt26 = $myrow26['debitamt'];
            $creditamt26 = $myrow26['creditamt'];
            $totdebitamt26 += $debitamt26;
            $totcreditamt26 += $creditamt26;
echo "$glcodefr25-to-$glcodeto25 cv:".number_format($debitamt26, 2)."|".number_format($creditamt26, 2)." cvtot:".number_format($totdebitamt26, 2)."|".number_format($totcreditamt26, 2)."<br>";
            // reset vars
            $debitamt26=0; $creditamt26=0;
            } // while
          } // if
          $res26bquery=""; $result26b=""; $found26b=0; $ctr26b=0;
          $res26bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr25\" AND glcode<=\"$glcodeto25\"";
          $result26b=$dbh2->query($res26bquery);
          if($result26b->num_rows>0) {
            while($myrow26b=$result26b->fetch_assoc()) {
            $found26b=1;
            $ctr26b=$ctr26b+1;
            $debitamt26b = $myrow26b['debitamt'];
            $creditamt26b = $myrow26b['creditamt'];
            $totdebitamt26b += $debitamt26b;
            $totcreditamt26b += $creditamt26b;
echo "$glcodefr25-to-$glcodeto25 ap:".number_format($debitamt26b, 2)."|".number_format($creditamt26b, 2)." aptot:".number_format($totdebitamt26b, 2)."|".number_format($totcreditamt26b, 2)."<br>";
            // reset vars
            $debitamt26b=0; $creditamt26b=0;
            } // while
          } // if
          $res26cquery=""; $result26c=""; $found26c=0; $ctr26c=0;
          $res26cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr25\" AND glcode<=\"$glcodeto25\"";
          $result26c=$dbh2->query($res26cquery);
          if($result26c->num_rows>0) {
            while($myrow26c=$result26c->fetch_assoc()) {
            $found26c=1;
            $ctr26c=$ctr26c+1;
            $debitamt26c = $myrow26c['debitamt'];
            $creditamt26c = $myrow26c['creditamt'];
            $totdebitamt26c += $debitamt26c;
            $totcreditamt26c += $creditamt26c;
echo "$glcodefr25-to-$glcodeto25 crv:".number_format($debitamt26c, 2)."|".number_format($creditamt26c, 2)." crvtot:".number_format($totdebitamt26c, 2)."|".number_format($totcreditamt26c, 2)."<br>";
            // reset vars
            $debitamt26c=0; $creditamt26c=0;
            } // while
          } // if
          $res26dquery=""; $result26d=""; $found26d=0; $ctr26d=0;
          $res26dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr25\" AND glcode<=\"$glcodeto25\"";
          $result26d=$dbh2->query($res26dquery);
          if($result26d->num_rows>0) {
            while($myrow26d=$result26d->fetch_assoc()) {
            $found26d=1;
            $ctr26d=$ctr26d+1;
            $debitamt26d = $myrow26d['debitamt'];
            $creditamt26d = $myrow26d['creditamt'];
            $totdebitamt26d += $debitamt26d;
            $totcreditamt26d += $creditamt26d;
echo "$glcodefr25-to-$glcodeto25 jv:".number_format($debitamt26d, 2)."|".number_format($creditamt26d, 2)." jvtot:".number_format($totdebitamt26d, 2)."|".number_format($totcreditamt26d, 2)."<br>";
            // reset vars
            $debitamt26d=0; $creditamt26d=0;
            } // while
          } // if
          $totdebitamt26bcd = $totdebitamt26 + $totdebitamt26b + $totdebitamt26c + $totdebitamt26d;
          $totcreditamt26bcd = $totcreditamt26 + $totcreditamt26b + $totcreditamt26c + $totcreditamt26d;
          echo "dr:".number_format($totdebitamt26bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt26bcd, 2);
          echo "</td><td></td></tr>";
          // reset vars
          $totdebitamt26=0; $totcreditamt26=0;
          $totdebitamt26b=0; $totcreditamt26b=0;
          $totdebitamt26c=0; $totcreditamt26c=0;
          $totdebitamt26d=0; $totcreditamt26d=0;
        } else if($tabpos25==3) {
          echo "<tr><td colspan='2'></td><td colspan='5'>$acctnm125</td><td align='right'>";
          $res27query=""; $result27=""; $found27=0; $ctr27=0;
          $res27query="SELECT debitamt, creditamt FROM tblfindisbursement WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr25\" AND glcode<=\"$glcodeto25\"";
          $result27=$dbh2->query($res27query);
          if($result27->num_rows>0) {
            while($myrow27=$result27->fetch_assoc()) {
            $found27=1;
            $ctr27=$ctr27+1;
            $debitamt27 = $myrow27['debitamt'];
            $creditamt27 = $myrow27['creditamt'];
            $totdebitamt27 += $debitamt27;
            $totcreditamt27 += $creditamt27;
            $gtotdebitamt27 += $totdebitamt27;
            $gtotcreditamt27 += $totcreditamt27;
echo "$glcodefr25-to-$glcodeto25 cv:".number_format($debitamt27, 2)."|".number_format($creditamt27, 2)." cvtot:".number_format($totdebitamt27, 2)."|".number_format($totcreditamt27, 2)." cvgtot:".number_format($gtotdebitamt27, 2)."|".number_format($gtotcreditamt27, 2)."<br>";
            // reset vars
            $debitamt27=0; $creditamt27=0;
            } // while
          } // if
          $res27bquery=""; $result27b=""; $found27b=0; $ctr27b=0;
          $res27bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr25\" AND glcode<=\"$glcodeto25\"";
          $result27b=$dbh2->query($res27bquery);
          if($result27b->num_rows>0) {
            while($myrow27b=$result27b->fetch_assoc()) {
            $found27b=1;
            $ctr27b=$ctr27b+1;
            $debitamt27b = $myrow27b['debitamt'];
            $creditamt27b = $myrow27b['creditamt'];
            $totdebitamt27b += $debitamt27b;
            $totcreditamt27b += $creditamt27b;
            $gtotdebitamt27 += $totdebitamt27b;
            $gtotcreditamt27 += $totcreditamt27b;
echo "$glcodefr25-to-$glcodeto25 ap:".number_format($debitamt27b, 2)."|".number_format($creditamt27b, 2)." aptot:".number_format($totdebitamt27b, 2)."|".number_format($totcreditamt27b, 2)." cvgtot:".number_format($gtotdebitamt27, 2)."|".number_format($gtotcreditamt27, 2)."<br>";
            // reset vars
            $debitamt27b=0; $creditamt27b=0;
            } // while
          } // if
          $res27cquery=""; $result27c=""; $found27c=0; $ctr27c=0;
          $res27cquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr25\" AND glcode<=\"$glcodeto25\"";
          $result27c=$dbh2->query($res27cquery);
          if($result27c->num_rows>0) {
            while($myrow27c=$result27c->fetch_assoc()) {
            $found27c=1;
            $ctr27c=$ctr27c+1;
            $debitamt27c = $myrow27c['debitamt'];
            $creditamt27c = $myrow27c['creditamt'];
            $totdebitamt27c += $debitamt27c;
            $totcreditamt27c += $creditamt27c;
            $gtotdebitamt27 += $totdebitamt27c;
            $gtotcreditamt27 += $totcreditamt27c;
echo "$glcodefr25-to-$glcodeto25 crv:".number_format($debitamt27c, 2)."|".number_format($creditamt27c, 2)." crvtot:".number_format($totdebitamt27c, 2)."|".number_format($totcreditamt27c, 2)." cvgtot:".number_format($gtotdebitamt27, 2)."|".number_format($gtotcreditamt27, 2)."<br>";
            // reset vars
            $debitamt27c=0; $creditamt27c=0;
            } // while
          } // if
          $res27dquery=""; $result27d=""; $found27d=0; $ctr27d=0;
          $res27dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE projcode=\"$projcode\" AND glrefver=2 AND glcode>=\"$glcodefr25\" AND glcode<=\"$glcodeto25\"";
          $result27d=$dbh2->query($res27dquery);
          if($result27d->num_rows>0) {
            while($myrow27d=$result27d->fetch_assoc()) {
            $found27d=1;
            $ctr27d=$ctr27d+1;
            $debitamt27d = $myrow27d['debitamt'];
            $creditamt27d = $myrow27d['creditamt'];
            $totdebitamt27d += $debitamt27d;
            $totcreditamt27d += $creditamt27d;
            $gtotdebitamt27 += $totdebitamt27d;
            $gtotcreditamt27 += $totcreditamt27d;
echo "$glcodefr25-to-$glcodeto25 jv:".number_format($debitamt27d, 2)."|".number_format($creditamt27d, 2)." jvtot:".number_format($totdebitamt27d, 2)."|".number_format($totcreditamt27d, 2)." cvgtot:".number_format($gtotdebitamt27, 2)."|".number_format($gtotcreditamt27, 2)."<br>";
            // reset vars
            $debitamt27d=0; $creditamt27d=0;
            } // while
          } // if
          $totdebitamt26bcd = $totdebitamt27 + $totdebitamt27b + $totdebitamt27c + $totdebitamt27d;
          $totcreditamt26bcd = $totcreditamt27 + $totcreditamt27b + $totdebitamt27c + $totcreditamt27d;
          echo "dr:".number_format($totdebitamt27bcd, 2)."<br>";
          echo "cr:".number_format($totcreditamt27bcd, 2);
          echo "</td><td></td><td></td></tr>";
          // reset vars
          $totdebitamt27=0; $totcreditamt27=0;
          $totdebitamt27b=0; $totcreditamt27b=0;
          $totdebitamt27c=0; $totcreditamt27c=0;
          $totdebitamt27d=0; $totcreditamt27d=0;
        } // if-else
        } // while
      } // if
      echo "<tr><td colspan='7'><strong>Net Profit</strong></td><td></td><td align='right'><stong>";
      echo "dr:".number_format($gtotdebitamt27, 2)."<br>";
      echo "cr:".number_format($gtotcreditamt27, 2);
      echo "</strong></td><td></td><td></td></tr>";
echo "<p>f12:$found12, f25:$found25<br>r25q: $res25query<br>r26q: $res26query<br>r27q: $res27query</p>";
?>
    </tbody>

    </table>
  </div>
<?php
  } // if

     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer2.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 