<?php 
//
// finrptstfinpos.php (20191104)
// fr: finrptgae.php
//
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$datefr0 = (isset($_POST['datefr'])) ? $_POST['datefr'] :'';
$dateto0 = (isset($_POST['dateto'])) ? $_POST['dateto'] :'';

$datefrprev = (isset($_POST['datefrprev'])) ? $_POST['datefrprev'] :'';
$datetoprev = (isset($_POST['datetoprev'])) ? $_POST['datetoprev'] :'';

if($datefr0!='') { $datefr=$datefr0; } else { $datefr=""; }
if($dateto0!='') { $dateto=$dateto0; } else { $dateto=""; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#exportToExcel").click(function() {
			var data='<table>' + $("#ReportTable").html().replace(/<a\/?[^>]+>/gi,'')+'</table>';
			$('body').prepend("<form method='post' action='exportexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"'></form>");
			$('#ReportTableData').submit().remove();
	});
});
</script>

<?php
// echo "<p>vartest dtfr:$datefr0, dtto:$dateto0, dtfrprv:$datefrprev, dttoprv:$datetoprev</p>";

// start contents here
?>
  <table class="table table-bordered">
  <thead>
    <tr><th colspan="10">
<?php
    echo "<form action=\"finrptstfinpos.php?loginid=$loginid\" method=\"POST\" name=\"finrptstfinpos\">";
    /* if($datefr=="" && $dateto=="") {
    // get current year
    $curryear = date("Y", strtotime($datenow));
    // compose 1st day of the current year
    $datefr = $curryear . "-01-01";
    // compose last day of the current year
    $dateto = $curryear . "-12-31";
    } // if
    // set dateto minus 1 year
    $compfigdate0 = new DateTime("$dateto");
    $compfigdate = $compfigdate0->modify('-1 year')->format('Y-m-d');
    if($compfigdate!='') {
      $prevyear = date("Y", strtotime($compfigdate));
      $dateprevfr = $prevyear . "-01-01";
      $dateprevto = $prevyear . "-12-31";
    } // if */
	echo "Current:<br>";
    echo "From:<input type=\"date\" name=\"datefr\" value=\"$datefr\">&nbsp;&nbsp;";
    echo "To:<input type=\"date\" name=\"dateto\" value=\"$dateto\">&nbsp;&nbsp;<br>";
	echo "Previous:<br>";
    echo "From:<input type=\"date\" name=\"datefrprev\" value=\"$datefrprev\">&nbsp;&nbsp;";
    echo "To:<input type=\"date\" name=\"datetoprev\" value=\"$datetoprev\">&nbsp;&nbsp;<br>";
    echo "<button type=\"submit\" class=\"btn btn-success\">Submit</button>";
    echo "</form>";
?>
    </th></tr>
  </thead></table>
<?php
  if($datefr!='' && $dateto!='') {
  echo "<table id=\"ReportTable\" class=\"table table-bordered\"><thead>";
?>
    <tr><th><a href="#" id="exportToExcel"><img src="./images/sheet.gif"></a></th><th colspan="9" class="text-center">PHILKOEI INTERNATIONAL INC.</th></tr>
    <tr><th colspan="10" class="text-center">STATEMENT OF FINANCIAL POSITION</th></tr>
    <tr><th colspan="10" class="text-center"><?php echo "".date('F j, Y', strtotime($dateto)).""; ?></th></tr>
    <tr><th colspan="10" class="text-center font-italic">(With Comparative Figures as of <?php echo date('Y-M-d', strtotime($datetoprev)); ?>)</th></tr>
    <tr><th colspan="10" class="text-center font-italic">(Amounts in Philippine Pesos)</th></tr>
  </thead>
  <tbody>
    <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th class="text-center"><u><?php echo "".date('Y', strtotime($datefr)).""; ?></u></th><th></th><th class="text-center"><u><?php echo "".date('Y', strtotime($datefrprev)).""; ?></u></th></tr>
    <tr><th></th><th class="text-center" colspan="4">ASSETS</th><th></th><th></th><th></th><th></th><th></th></tr>
    <tr><th></th><th colspan="4">CURRENT ASSETS</th><th></th><th></th><th></th><th></th><th></th></tr>
<?php
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT refcd, refname FROM tblfinstfinposref WHERE refcd>=\"100\" AND refcd<=\"119\" ORDER BY refcd ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
      while($myrow11=$result11->fetch_assoc()) {
      $found11=1;
      $ctr11=$ctr11+1;
      $refcd11 = $myrow11['refcd'];
      $refname11 = $myrow11['refname'];
	  
      // query tblfindisbursement current year
      $res11aquery=""; $result11a=""; $found11a=0; $ctr11a=0;
      $res11aquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a=1;
        $ctr11a=$ctr11a+1;
        $codefr11a = $myrow11a['codefr'];
        $codeto11a = $myrow11a['codeto'];
        $lookupsd11a = $myrow11a['lookupsd'];
        if($lookupsd11a=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11a=='cr') { $lookupsdfin="creditamt"; }
        $res11bquery=""; $result11b=""; $found11b=0; $ctr11b=0; $totamt11b=0;
        $res11bquery="SELECT disbursementid, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result11b=$dbh2->query($res11bquery);
        if($result11b->num_rows>0) {
          while($myrow11b=$result11b->fetch_assoc()) {
          // reset variables
          $totdebitamt11b=0; $totcreditamt11b=0;
          $found11b=1;
          $ctr11b=$ctr11b+1;
          $disbursementid11b = $myrow11b['disbursementid'];
          $debitamt11b = $myrow11b['debitamt'];
          $creditamt11b = $myrow11b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt11b>0 && $creditamt11b>0) {
          $totdebitamt11b = $debitamt11b - $creditamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } else {
          $totdebitamt11b = $debitamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt11b>0 && $debitamt11b>0) {
          $totcreditamt11b = $creditamt11b - $debitamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } else {
          $totcreditamt11b = $creditamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } // if-else
          } // if-else
// echo "<p>$codefr11a - $codeto11a: id:$disbursementid11b, lu:$lookupsd11a, dr:$debitamt11b|$totdebitamt11b, cr:$creditamt11b|$totcreditamt11b, tot:$totamt11b</p>";
          } // while
        } // if
        $res12bquery=""; $result12b=""; $found12b=0; $ctr12b=0; $totamt12b=0;
        $res12bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result12b=$dbh2->query($res12bquery);
        if($result12b->num_rows>0) {
          while($myrow12b=$result12b->fetch_assoc()) {
          $found12b=1;
          $ctr12b=$ctr12b+1;
          $debitamt12b = $myrow12b['debitamt'];
          $creditamt12b = $myrow12b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt12b>0 && $creditamt12b>0) {
          $totdebitamt12b = $debitamt12b - $creditamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } else {
          $totdebitamt12b = $debitamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt12b>0 && $debitamt12b>0) {
          $totcreditamt12b = $creditamt12b - $debitamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } else {
          $totcreditamt12b = $creditamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14bquery=""; $result14b=""; $found14b=0; $ctr14b=0; $totamt14b=0;
        $res14bquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result14b=$dbh2->query($res14bquery);
        if($result14b->num_rows>0) {
          while($myrow14b=$result14b->fetch_assoc()) {
          $found14b=1;
          $ctr14b=$ctr14b+1;
          $debitamt14b = $myrow14b['debitamt'];
          $creditamt14b = $myrow14b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt14b>0 && $creditamt14b>0) {
          $totdebitamt14b = $debitamt14b - $creditamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } else {
          $totdebitamt14b = $debitamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt14b>0 && $debitamt14b>0) {
          $totcreditamt14b = $creditamt14b - $debitamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } else {
          $totcreditamt14b = $creditamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15bquery=""; $result15b=""; $found15b=0; $ctr15b=0; $totamt15b=0;
        $res15bquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result15b=$dbh2->query($res15bquery);
        if($result15b->num_rows>0) {
          while($myrow15b=$result15b->fetch_assoc()) {
          $found15b=1;
          $ctr15b=$ctr15b+1;
          $debitamt15b = $myrow15b['debitamt'];
          $creditamt15b = $myrow15b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt15b>0 && $creditamt15b>0) {
          $totdebitamt15b = $debitamt15b - $creditamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } else {
          $totdebitamt15b = $debitamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt15b>0 && $debitamt15b>0) {
          $totcreditamt15b = $creditamt15b - $debitamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } else {
          $totcreditamt15b = $creditamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11a = $totamt11b + $totamt12b + $totamt14b + $totamt15b;
        $totalcurrentassets += $subtot11a;
// echo "<p>$res11query<br>$res11aquery<br>$res11bquery<br>$res12bquery<br>$res14bquery<br>$res15bquery<br></p>";
// echo "<p>$refcd11 $refname11: $codefr11a - $codeto11a: cv:".number_format($totamt11b, 2).", ap:".number_format($totamt12b, 2).", cr:".number_format($totamt14b, 2).", jv:".number_format($totamt15b, 2).", subtot:".number_format($subtot11a, 2).", ";
// echo "tot:".number_format($totalcurrentassets, 2)."<br></p>";
        } // while
      } // if
      $grandtotcurrentassets += $totalcurrentassets;
      echo "<tr>";
      echo "<td></td><td></td>";
      echo "<td colspan=\"3\">$refname11</td>";
      echo "<td></td>";
      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalcurrentassets, 2)."</td>";

      // query tblfindisbursement previous year
      $res11cquery=""; $result11c=""; $found11c=0; $ctr11c=0; $lookupsdfin="";
      $res11cquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11c=$dbh2->query($res11cquery);
      if($result11c->num_rows>0) {
        while($myrow11c=$result11c->fetch_assoc()) {
        $found11c=1;
        $ctr11c=$ctr11c+1;
        $codefr11c = $myrow11c['codefr'];
        $codeto11c = $myrow11c['codeto'];
        $lookupsd11c = $myrow11c['lookupsd'];
        if($lookupsd11c=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11c=='cr') { $lookupsdfin="creditamt"; }
        $res11dquery=""; $result11d=""; $found11d=0; $ctr11d=0; $totamt11d=0;
        $res11dquery="SELECT date, glcode, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result11d=$dbh2->query($res11dquery);
        if($result11d->num_rows>0) {
          while($myrow11d=$result11d->fetch_assoc()) {
          $found11d=1;
          $ctr11d=$ctr11d+1;
          $date11d = $myrow11d['date'];
          $glcode11d = $myrow11d['glcode'];
          $debitamt11d = $myrow11d['debitamt'];
          $creditamt11d = $myrow11d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt11d>0 && $creditamt11d>0) {
          $totdebitamt11d = $debitamt11d - $creditamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } else {
          $totdebitamt11d = $debitamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt11d>0 && $debitamt11d>0) {
          $totcreditamt11d = $creditamt11d - $debitamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } else {
          $totcreditamt11d = $creditamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res12dquery=""; $result12d=""; $found12d=0; $ctr12d=0; $totamt12d=0;
        $res12dquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result12d=$dbh2->query($res12dquery);
        if($result12d->num_rows>0) {
          while($myrow12d=$result12d->fetch_assoc()) {
          $found12d=1;
          $ctr12d=$ctr12d+1;
          $debitamt12d = $myrow12d['debitamt'];
          $creditamt12d = $myrow12d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt12d>0 && $creditamt12d>0) {
          $totdebitamt12d = $debitamt12d - $creditamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } else {
          $totdebitamt12d = $debitamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt12d>0 && $debitamt12d>0) {
          $totcreditamt12d = $creditamt12d - $debitamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } else {
          $totcreditamt12d = $creditamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14dquery=""; $result14d=""; $found14d=0; $ctr14d=0; $totamt14d=0;
        $res14dquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result14d=$dbh2->query($res14dquery);
        if($result14d->num_rows>0) {
          while($myrow14d=$result14d->fetch_assoc()) {
          $found14d=1;
          $ctr14d=$ctr14d+1;
          $debitamt14d = $myrow14d['debitamt'];
          $creditamt14d = $myrow14d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt14d>0 && $creditamt14d>0) {
          $totdebitamt14d = $debitamt14d - $creditamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } else {
          $totdebitamt14d = $debitamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt14d>0 && $debitamt14d>0) {
          $totcreditamt14d = $creditamt14d - $debitamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } else {
          $totcreditamt14d = $creditamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15dquery=""; $result15d=""; $found15d=0; $ctr15d=0; $totamt15d=0;
        $res15dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result15d=$dbh2->query($res15dquery);
        if($result15d->num_rows>0) {
          while($myrow15d=$result15d->fetch_assoc()) {
          $found15d=1;
          $ctr15d=$ctr15d+1;
          $debitamt15d = $myrow15d['debitamt'];
          $creditamt15d = $myrow15d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt15d>0 && $creditamt15d>0) {
          $totdebitamt15d = $debitamt15d - $creditamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } else {
          $totdebitamt15d = $debitamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt15d>0 && $debitamt15d>0) {
          $totcreditamt15d = $creditamt15d - $debitamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } else {
          $totcreditamt15d = $creditamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11c = $totamt11d + $totamt12d + $totamt14d + $totamt15d;
	  $totalprevassets += $subtot11c;
// echo "<p>$res11query<br>$res11cquery<br>$res11dquery<br>$res12dquery<br>$res14dquery<br>$res15dquery<br></p>";
// echo "<p>$codefr11c - $codeto11c: cv:$totamt11d, ap:$totamt12d, cr:$totamt14d, jv:$totamt15d, subtot:$subtot11c<br></p>";
        } // while
      } // if
      $grandtotprevassets += $totalprevassets;
      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalprevassets, 2)."</td>";
      echo "</tr>";
    // echo "<tr><td colspan='10'>r11q:$res11query<br>r11aq:$res11aquery<br>r11bq:$res11bquery<br>r11cq:$res11cquery<br>r11dquery:$res11dquery</td></tr>";
        // reset variable
        $totalcurrentassets=0; $totalprevassets=0;
      } // while
    } // if
    echo "<tr><th></th><th></th><th></th><th colspan=\"2\">Total Current Assets</th><th></th><th>P</th><th class='text-right'>".number_format($grandtotcurrentassets, 2)."</th><th>P</th><th class='text-right'>".number_format($grandtotprevassets, 2)."</th></tr>";
?>

    <tr><th></th><th colspan="4">NON-CURRENT ASSETS</th><th></th><th></th><th></th><th></th><th></th></tr>
<?php
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT refcd, refname FROM tblfinstfinposref WHERE refcd>=\"120\" AND refcd<=\"129\" ORDER BY refcd ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
      while($myrow11=$result11->fetch_assoc()) {
      $found11=1;
      $ctr11=$ctr11+1;
      $refcd11 = $myrow11['refcd'];
      $refname11 = $myrow11['refname'];

      // query tblfindisbursement current year
      $res11aquery=""; $result11a=""; $found11a=0; $ctr11a=0;
      $res11aquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a=1;
        $ctr11a=$ctr11a+1;
        $codefr11a = $myrow11a['codefr'];
        $codeto11a = $myrow11a['codeto'];
        $lookupsd11a = $myrow11a['lookupsd'];
        if($lookupsd11a=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11a=='cr') { $lookupsdfin="creditamt"; }
        $res11bquery=""; $result11b=""; $found11b=0; $ctr11b=0; $totamt11b=0;
        $res11bquery="SELECT disbursementid, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result11b=$dbh2->query($res11bquery);
        if($result11b->num_rows>0) {

          while($myrow11b=$result11b->fetch_assoc()) {
          // reset variables
          $totdebitamt11b=0; $totcreditamt11b=0;
          $found11b=1;
          $ctr11b=$ctr11b+1;
          $disbursementid11b = $myrow11b['disbursementid'];
          $debitamt11b = $myrow11b['debitamt'];
          $creditamt11b = $myrow11b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt11b>0 && $creditamt11b>0) {
          $totdebitamt11b = $debitamt11b - $creditamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } else {
          $totdebitamt11b = $debitamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt11b>0 && $debitamt11b>0) {
          $totcreditamt11b = $creditamt11b - $debitamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } else {
          $totcreditamt11b = $creditamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } // if-else
          } // if-else
// echo "<p>$codefr11a - $codeto11a: id:$disbursementid11b, lu:$lookupsd11a, dr:$debitamt11b|$totdebitamt11b, cr:$creditamt11b|$totcreditamt11b, tot:$totamt11b</p>";
          } // while
        } // if
        $res12bquery=""; $result12b=""; $found12b=0; $ctr12b=0; $totamt12b=0;
        $res12bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result12b=$dbh2->query($res12bquery);
        if($result12b->num_rows>0) {
          while($myrow12b=$result12b->fetch_assoc()) {
          $found12b=1;
          $ctr12b=$ctr12b+1;
          $debitamt12b = $myrow12b['debitamt'];
          $creditamt12b = $myrow12b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt12b>0 && $creditamt12b>0) {
          $totdebitamt12b = $debitamt12b - $creditamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } else {
          $totdebitamt12b = $debitamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt12b>0 && $debitamt12b>0) {
          $totcreditamt12b = $creditamt12b - $debitamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } else {
          $totcreditamt12b = $creditamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14bquery=""; $result14b=""; $found14b=0; $ctr14b=0; $totamt14b=0;
        $res14bquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result14b=$dbh2->query($res14bquery);
        if($result14b->num_rows>0) {
          while($myrow14b=$result14b->fetch_assoc()) {
          $found14b=1;
          $ctr14b=$ctr14b+1;
          $debitamt14b = $myrow14b['debitamt'];
          $creditamt14b = $myrow14b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt14b>0 && $creditamt14b>0) {
          $totdebitamt14b = $debitamt14b - $creditamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } else {
          $totdebitamt14b = $debitamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt14b>0 && $debitamt14b>0) {
          $totcreditamt14b = $creditamt14b - $debitamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } else {
          $totcreditamt14b = $creditamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15bquery=""; $result15b=""; $found15b=0; $ctr15b=0; $totamt15b=0;
        $res15bquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result15b=$dbh2->query($res15bquery);
        if($result15b->num_rows>0) {
          while($myrow15b=$result15b->fetch_assoc()) {
          $found15b=1;
          $ctr15b=$ctr15b+1;
          $debitamt15b = $myrow15b['debitamt'];
          $creditamt15b = $myrow15b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt15b>0 && $creditamt15b>0) {
          $totdebitamt15b = $debitamt15b - $creditamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } else {
          $totdebitamt15b = $debitamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt15b>0 && $debitamt15b>0) {
          $totcreditamt15b = $creditamt15b - $debitamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } else {
          $totcreditamt15b = $creditamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11a = $totamt11b + $totamt12b + $totamt14b + $totamt15b;
        $totalcurrentnoncurrassets += $subtot11a;
// echo "<p>$res11query<br>$res11aquery<br>$res11bquery<br>$res12bquery<br>$res14bquery<br>$res15bquery<br></p>";
// echo "<p>$refcd11 $refname11: $codefr11a - $codeto11a: cv:".number_format($totamt11b, 2).", ap:".number_format($totamt12b, 2).", cr:".number_format($totamt14b, 2).", jv:".number_format($totamt15b, 2).", subtot:".number_format($subtot11a, 2).", ";
// echo "tot:".number_format($totalcurrentassets, 2)."<br></p>";
        } // while
      } // if
      $grandtotcurrentnoncurrassets += $totalcurrentnoncurrassets;
      echo "<tr>";
      echo "<td></td><td></td>";
      echo "<td colspan=\"3\">$refname11</td>";
      echo "<td></td>";
      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalcurrentnoncurrassets, 2)."</td>";

      // query tblfindisbursement previous year
      $res11cquery=""; $result11c=""; $found11c=0; $ctr11c=0; $lookupsdfin="";
      $res11cquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11c=$dbh2->query($res11cquery);
      if($result11c->num_rows>0) {
        while($myrow11c=$result11c->fetch_assoc()) {
        $found11c=1;
        $ctr11c=$ctr11c+1;
        $codefr11c = $myrow11c['codefr'];
        $codeto11c = $myrow11c['codeto'];
        $lookupsd11c = $myrow11c['lookupsd'];
        if($lookupsd11c=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11c=='cr') { $lookupsdfin="creditamt"; }
        $res11dquery=""; $result11d=""; $found11d=0; $ctr11d=0; $totamt11d=0;
        $res11dquery="SELECT date, glcode, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result11d=$dbh2->query($res11dquery);
        if($result11d->num_rows>0) {
          while($myrow11d=$result11d->fetch_assoc()) {
          $found11d=1;
          $ctr11d=$ctr11d+1;
          $date11d = $myrow11d['date'];
          $glcode11d = $myrow11d['glcode'];
          $debitamt11d = $myrow11d['debitamt'];
          $creditamt11d = $myrow11d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt11d>0 && $creditamt11d>0) {
          $totdebitamt11d = $debitamt11d - $creditamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } else {
          $totdebitamt11d = $debitamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt11d>0 && $debitamt11d>0) {
          $totcreditamt11d = $creditamt11d - $debitamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } else {
          $totcreditamt11d = $creditamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res12dquery=""; $result12d=""; $found12d=0; $ctr12d=0; $totamt12d=0;
        $res12dquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result12d=$dbh2->query($res12dquery);
        if($result12d->num_rows>0) {
          while($myrow12d=$result12d->fetch_assoc()) {
          $found12d=1;
          $ctr12d=$ctr12d+1;
          $debitamt12d = $myrow12d['debitamt'];
          $creditamt12d = $myrow12d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt12d>0 && $creditamt12d>0) {
          $totdebitamt12d = $debitamt12d - $creditamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } else {
          $totdebitamt12d = $debitamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt12d>0 && $debitamt12d>0) {
          $totcreditamt12d = $creditamt12d - $debitamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } else {
          $totcreditamt12d = $creditamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14dquery=""; $result14d=""; $found14d=0; $ctr14d=0; $totamt14d=0;
        $res14dquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result14d=$dbh2->query($res14dquery);
        if($result14d->num_rows>0) {
          while($myrow14d=$result14d->fetch_assoc()) {
          $found14d=1;
          $ctr14d=$ctr14d+1;
          $debitamt14d = $myrow14d['debitamt'];
          $creditamt14d = $myrow14d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt14d>0 && $creditamt14d>0) {
          $totdebitamt14d = $debitamt14d - $creditamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } else {
          $totdebitamt14d = $debitamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt14d>0 && $debitamt14d>0) {
          $totcreditamt14d = $creditamt14d - $debitamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } else {
          $totcreditamt14d = $creditamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15dquery=""; $result15d=""; $found15d=0; $ctr15d=0; $totamt15d=0;
        $res15dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result15d=$dbh2->query($res15dquery);
        if($result15d->num_rows>0) {
          while($myrow15d=$result15d->fetch_assoc()) {
          $found15d=1;
          $ctr15d=$ctr15d+1;
          $debitamt15d = $myrow15d['debitamt'];
          $creditamt15d = $myrow15d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt15d>0 && $creditamt15d>0) {
          $totdebitamt15d = $debitamt15d - $creditamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } else {
          $totdebitamt15d = $debitamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt15d>0 && $debitamt15d>0) {
          $totcreditamt15d = $creditamt15d - $debitamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } else {
          $totcreditamt15d = $creditamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11c = $totamt11d + $totamt12d + $totamt14d + $totamt15d;
	  $totalprevnoncurrassets += $subtot11c;
// echo "<p>$res11query<br>$res11cquery<br>$res11dquery<br>$res12dquery<br>$res14dquery<br>$res15dquery<br></p>";
// echo "<p>$codefr11c - $codeto11c: cv:$totamt11d, ap:$totamt12d, cr:$totamt14d, jv:$totamt15d, subtot:$subtot11c<br></p>";
        } // while
      } // if

      $grandtotprevnoncurrassets += $totalprevnoncurrassets;
      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalprevnoncurrassets, 2)."</td>";
      echo "</tr>";
    // echo "<tr><td colspan='10'>r11q:$res11query<br>r11aq:$res11aquery<br>r11bq:$res11bquery<br>r11cq:$res11cquery<br>r11dquery:$res11dquery</td></tr>";

        // reset variable
        $totalcurrentnoncurrassets=0; $totalprevnoncurrassets=0;

      } // while
    } // if
    echo "<tr><th></th><th></th><th></th><th colspan=\"2\">Total Non-Current Assets</th><th></th><th>P</th><th class='text-right'>".number_format($grandtotcurrentnoncurrassets, 2)."</th><th>P</th><th class='text-right'>".number_format($grandtotprevnoncurrassets, 2)."</th></tr>";
    // echo "<tr><td colspan='10'>r11q:$res11query</td></tr>";

    // compute total assets
    $finaltotalassets = $grandtotcurrentassets + $grandtotcurrentnoncurrassets;
    $finaltotalprevassets = $grandtotprevassets + $grandtotprevnoncurrassets;

    // display total assets
    echo "<tr><th></th><th colspan=\"4\">TOTAL ASSETS</th><th></th><th>P</th><th class='text-right'>".number_format($finaltotalassets, 2)."</th><th>P</th><th class='text-right'>".number_format($finaltotalprevassets, 2)."</th></tr>";

?>

    <tr><th></th><th class="text-center" colspan="4">LIABILITIES AND EQUITIES</th><th></th><th></th><th></th><th></th><th></th></tr>
    <tr><th></th><th colspan="4">CURRENT LIABILITIES</th><th></th><th></th><th></th><th></th><th></th></tr>
<?php
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT refcd, refname FROM tblfinstfinposref WHERE refcd>=\"210\" AND refcd<=\"219\" ORDER BY refcd ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
      while($myrow11=$result11->fetch_assoc()) {
      $found11=1;
      $ctr11=$ctr11+1;
      $refcd11 = $myrow11['refcd'];
      $refname11 = $myrow11['refname'];

      // query tblfindisbursement current year
      $res11aquery=""; $result11a=""; $found11a=0; $ctr11a=0;
      $res11aquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a=1;
        $ctr11a=$ctr11a+1;
        $codefr11a = $myrow11a['codefr'];
        $codeto11a = $myrow11a['codeto'];
        $lookupsd11a = $myrow11a['lookupsd'];
        if($lookupsd11a=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11a=='cr') { $lookupsdfin="creditamt"; }
        $res11bquery=""; $result11b=""; $found11b=0; $ctr11b=0; $totamt11b=0;
        $res11bquery="SELECT disbursementid, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result11b=$dbh2->query($res11bquery);
        if($result11b->num_rows>0) {
          while($myrow11b=$result11b->fetch_assoc()) {
          // reset variables
          $totdebitamt11b=0; $totcreditamt11b=0;
          $found11b=1;
          $ctr11b=$ctr11b+1;
          $disbursementid11b = $myrow11b['disbursementid'];
          $debitamt11b = $myrow11b['debitamt'];
          $creditamt11b = $myrow11b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt11b>0 && $creditamt11b>0) {
          $totdebitamt11b = $debitamt11b - $creditamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } else {
          $totdebitamt11b = $debitamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt11b>0 && $debitamt11b>0) {
          $totcreditamt11b = $creditamt11b - $debitamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } else {
          $totcreditamt11b = $creditamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } // if-else
          } // if-else
// echo "<p>$codefr11a - $codeto11a: id:$disbursementid11b, lu:$lookupsd11a, dr:$debitamt11b|$totdebitamt11b, cr:$creditamt11b|$totcreditamt11b, tot:$totamt11b</p>";
          } // while
        } // if
        $res12bquery=""; $result12b=""; $found12b=0; $ctr12b=0; $totamt12b=0;
        $res12bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result12b=$dbh2->query($res12bquery);
        if($result12b->num_rows>0) {
          while($myrow12b=$result12b->fetch_assoc()) {
          $found12b=1;
          $ctr12b=$ctr12b+1;
          $debitamt12b = $myrow12b['debitamt'];
          $creditamt12b = $myrow12b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt12b>0 && $creditamt12b>0) {
          $totdebitamt12b = $debitamt12b - $creditamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } else {
          $totdebitamt12b = $debitamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt12b>0 && $debitamt12b>0) {
          $totcreditamt12b = $creditamt12b - $debitamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } else {
          $totcreditamt12b = $creditamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14bquery=""; $result14b=""; $found14b=0; $ctr14b=0; $totamt14b=0;
        $res14bquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result14b=$dbh2->query($res14bquery);
        if($result14b->num_rows>0) {
          while($myrow14b=$result14b->fetch_assoc()) {
          $found14b=1;
          $ctr14b=$ctr14b+1;
          $debitamt14b = $myrow14b['debitamt'];
          $creditamt14b = $myrow14b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt14b>0 && $creditamt14b>0) {
          $totdebitamt14b = $debitamt14b - $creditamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } else {
          $totdebitamt14b = $debitamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt14b>0 && $debitamt14b>0) {
          $totcreditamt14b = $creditamt14b - $debitamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } else {
          $totcreditamt14b = $creditamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15bquery=""; $result15b=""; $found15b=0; $ctr15b=0; $totamt15b=0;
        $res15bquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result15b=$dbh2->query($res15bquery);
        if($result15b->num_rows>0) {
          while($myrow15b=$result15b->fetch_assoc()) {
          $found15b=1;
          $ctr15b=$ctr15b+1;
          $debitamt15b = $myrow15b['debitamt'];
          $creditamt15b = $myrow15b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt15b>0 && $creditamt15b>0) {
          $totdebitamt15b = $debitamt15b - $creditamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } else {
          $totdebitamt15b = $debitamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt15b>0 && $debitamt15b>0) {
          $totcreditamt15b = $creditamt15b - $debitamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } else {
          $totcreditamt15b = $creditamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11a = $totamt11b + $totamt12b + $totamt14b + $totamt15b;
        $totalcurrentliabilities += $subtot11a;
// echo "<p>$res11query<br>$res11aquery<br>$res11bquery<br>$res12bquery<br>$res14bquery<br>$res15bquery<br></p>";
// echo "<p>$refcd11 $refname11: lu:$lookupsd11a fr:$codefr11a to:$codeto11a: cv:".number_format($totamt11b, 2).", ap:".number_format($totamt12b, 2).", cr:".number_format($totamt14b, 2).", jv:".number_format($totamt15b, 2).", subtot:".number_format($subtot11a, 2).", ";
// echo "tot:".number_format($totalcurrentliabilities, 2)."<br></p>";
        } // while
      } // if
      $grandtotcurrentliabilities += $totalcurrentliabilities;
      echo "<tr>";
      echo "<td></td><td></td>";
      echo "<td colspan=\"3\">$refname11</td>";
      echo "<td></td>";
      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalcurrentliabilities, 2)."</td>";

      // query tblfindisbursement previous year
      $res11cquery=""; $result11c=""; $found11c=0; $ctr11c=0; $lookupsdfin="";
      $res11cquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11c=$dbh2->query($res11cquery);
      if($result11c->num_rows>0) {
        while($myrow11c=$result11c->fetch_assoc()) {
        $found11c=1;
        $ctr11c=$ctr11c+1;
        $codefr11c = $myrow11c['codefr'];
        $codeto11c = $myrow11c['codeto'];
        $lookupsd11c = $myrow11c['lookupsd'];
        if($lookupsd11c=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11c=='cr') { $lookupsdfin="creditamt"; }
        $res11dquery=""; $result11d=""; $found11d=0; $ctr11d=0; $totamt11d=0;
        $res11dquery="SELECT date, glcode, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result11d=$dbh2->query($res11dquery);
        if($result11d->num_rows>0) {
          while($myrow11d=$result11d->fetch_assoc()) {
          $found11d=1;
          $ctr11d=$ctr11d+1;
          $date11d = $myrow11d['date'];
          $glcode11d = $myrow11d['glcode'];
          $debitamt11d = $myrow11d['debitamt'];
          $creditamt11d = $myrow11d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt11d>0 && $creditamt11d>0) {
          $totdebitamt11d = $debitamt11d - $creditamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } else {
          $totdebitamt11d = $debitamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt11d>0 && $debitamt11d>0) {
          $totcreditamt11d = $creditamt11d - $debitamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } else {
          $totcreditamt11d = $creditamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res12dquery=""; $result12d=""; $found12d=0; $ctr12d=0; $totamt12d=0;
        $res12dquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result12d=$dbh2->query($res12dquery);
        if($result12d->num_rows>0) {
          while($myrow12d=$result12d->fetch_assoc()) {
          $found12d=1;
          $ctr12d=$ctr12d+1;
          $debitamt12d = $myrow12d['debitamt'];
          $creditamt12d = $myrow12d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt12d>0 && $creditamt12d>0) {
          $totdebitamt12d = $debitamt12d - $creditamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } else {
          $totdebitamt12d = $debitamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt12d>0 && $debitamt12d>0) {
          $totcreditamt12d = $creditamt12d - $debitamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } else {
          $totcreditamt12d = $creditamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14dquery=""; $result14d=""; $found14d=0; $ctr14d=0; $totamt14d=0;
        $res14dquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result14d=$dbh2->query($res14dquery);
        if($result14d->num_rows>0) {
          while($myrow14d=$result14d->fetch_assoc()) {
          $found14d=1;
          $ctr14d=$ctr14d+1;
          $debitamt14d = $myrow14d['debitamt'];
          $creditamt14d = $myrow14d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt14d>0 && $creditamt14d>0) {
          $totdebitamt14d = $debitamt14d - $creditamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } else {
          $totdebitamt14d = $debitamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt14d>0 && $debitamt14d>0) {
          $totcreditamt14d = $creditamt14d - $debitamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } else {
          $totcreditamt14d = $creditamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15dquery=""; $result15d=""; $found15d=0; $ctr15d=0; $totamt15d=0;
        $res15dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result15d=$dbh2->query($res15dquery);
        if($result15d->num_rows>0) {
          while($myrow15d=$result15d->fetch_assoc()) {
          $found15d=1;
          $ctr15d=$ctr15d+1;
          $debitamt15d = $myrow15d['debitamt'];
          $creditamt15d = $myrow15d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt15d>0 && $creditamt15d>0) {
          $totdebitamt15d = $debitamt15d - $creditamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } else {
          $totdebitamt15d = $debitamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt15d>0 && $debitamt15d>0) {
          $totcreditamt15d = $creditamt15d - $debitamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } else {
          $totcreditamt15d = $creditamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11c = $totamt11d + $totamt12d + $totamt14d + $totamt15d;
	  $totalprevcurrentliabilities += $subtot11c;
// echo "<p>$res11query<br>$res11cquery<br>$res11dquery<br>$res12dquery<br>$res14dquery<br>$res15dquery<br></p>";
// echo "<p>$codefr11c - $codeto11c: cv:$totamt11d, ap:$totamt12d, cr:$totamt14d, jv:$totamt15d, subtot:$subtot11c<br></p>";
        } // while
      } // if

      $grandtotprevcurrentliabilities += $totalprevcurrentliabilities;

      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalprevcurrentliabilities, 2)."</td>";
      echo "</tr>";
    // echo "<tr><td colspan='10'>r11q:$res11query<br>r11aq:$res11aquery<br>r11bq:$res11bquery<br>r11cq:$res11cquery<br>r11dquery:$res11dquery</td></tr>";

        // reset variable
        $totalcurrentliabilities=0; $totalprevcurrentliabilities=0;

      } // while
    } // if
    echo "<tr><th></th><th></th><th></th><th colspan=\"2\">Total Current Liabilities</th><th></th><th>P</th><th class='text-right'>".number_format($grandtotcurrentliabilities, 2)."</th><th>P</th><th class='text-right'>".number_format($grandtotprevcurrentliabilities, 2)."</th></tr>";
    // echo "<tr><td colspan='10'>r11q:$res11query</td></tr>";
?>

    <tr><th></th><th colspan="4">NON-CURRENT LIABILITY</th><th></th><th></th><th></th><th></th><th></th></tr>
<?php
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT refcd, refname FROM tblfinstfinposref WHERE refcd>=\"220\" AND refcd<=\"229\" ORDER BY refcd ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
      while($myrow11=$result11->fetch_assoc()) {
      $found11=1;
      $ctr11=$ctr11+1;
      $refcd11 = $myrow11['refcd'];
      $refname11 = $myrow11['refname'];

      // query tblfindisbursement current year
      $res11aquery=""; $result11a=""; $found11a=0; $ctr11a=0;
      $res11aquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a=1;
        $ctr11a=$ctr11a+1;
        $codefr11a = $myrow11a['codefr'];
        $codeto11a = $myrow11a['codeto'];
        $lookupsd11a = $myrow11a['lookupsd'];
        if($lookupsd11a=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11a=='cr') { $lookupsdfin="creditamt"; }
        $res11bquery=""; $result11b=""; $found11b=0; $ctr11b=0; $totamt11b=0;
        $res11bquery="SELECT disbursementid, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result11b=$dbh2->query($res11bquery);
        if($result11b->num_rows>0) {
          while($myrow11b=$result11b->fetch_assoc()) {
          // reset variables
          $totdebitamt11b=0; $totcreditamt11b=0;
          $found11b=1;
          $ctr11b=$ctr11b+1;
          $disbursementid11b = $myrow11b['disbursementid'];
          $debitamt11b = $myrow11b['debitamt'];
          $creditamt11b = $myrow11b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt11b>0 && $creditamt11b>0) {
          $totdebitamt11b = $debitamt11b - $creditamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } else {
          $totdebitamt11b = $debitamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt11b>0 && $debitamt11b>0) {
          $totcreditamt11b = $creditamt11b - $debitamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } else {
          $totcreditamt11b = $creditamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } // if-else
          } // if-else
// echo "<p>$codefr11a - $codeto11a: id:$disbursementid11b, lu:$lookupsd11a, dr:$debitamt11b|$totdebitamt11b, cr:$creditamt11b|$totcreditamt11b, tot:$totamt11b</p>";
          } // while
        } // if
        $res12bquery=""; $result12b=""; $found12b=0; $ctr12b=0; $totamt12b=0;
        $res12bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result12b=$dbh2->query($res12bquery);
        if($result12b->num_rows>0) {
          while($myrow12b=$result12b->fetch_assoc()) {
          $found12b=1;
          $ctr12b=$ctr12b+1;
          $debitamt12b = $myrow12b['debitamt'];
          $creditamt12b = $myrow12b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt12b>0 && $creditamt12b>0) {
          $totdebitamt12b = $debitamt12b - $creditamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } else {
          $totdebitamt12b = $debitamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt12b>0 && $debitamt12b>0) {
          $totcreditamt12b = $creditamt12b - $debitamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } else {
          $totcreditamt12b = $creditamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14bquery=""; $result14b=""; $found14b=0; $ctr14b=0; $totamt14b=0;
        $res14bquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result14b=$dbh2->query($res14bquery);
        if($result14b->num_rows>0) {
          while($myrow14b=$result14b->fetch_assoc()) {
          $found14b=1;
          $ctr14b=$ctr14b+1;
          $debitamt14b = $myrow14b['debitamt'];
          $creditamt14b = $myrow14b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt14b>0 && $creditamt14b>0) {
          $totdebitamt14b = $debitamt14b - $creditamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } else {
          $totdebitamt14b = $debitamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt14b>0 && $debitamt14b>0) {
          $totcreditamt14b = $creditamt14b - $debitamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } else {
          $totcreditamt14b = $creditamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15bquery=""; $result15b=""; $found15b=0; $ctr15b=0; $totamt15b=0;
        $res15bquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result15b=$dbh2->query($res15bquery);
        if($result15b->num_rows>0) {
          while($myrow15b=$result15b->fetch_assoc()) {
          $found15b=1;
          $ctr15b=$ctr15b+1;
          $debitamt15b = $myrow15b['debitamt'];
          $creditamt15b = $myrow15b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt15b>0 && $creditamt15b>0) {
          $totdebitamt15b = $debitamt15b - $creditamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } else {
          $totdebitamt15b = $debitamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt15b>0 && $debitamt15b>0) {
          $totcreditamt15b = $creditamt15b - $debitamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } else {
          $totcreditamt15b = $creditamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11a = $totamt11b + $totamt12b + $totamt14b + $totamt15b;
        $totalcurrentnoncurrliabilities += $subtot11a;
// echo "<p>$res11query<br>$res11aquery<br>$res11bquery<br>$res12bquery<br>$res14bquery<br>$res15bquery<br></p>";
// echo "<p>$refcd11 $refname11: $codefr11a - $codeto11a: cv:".number_format($totamt11b, 2).", ap:".number_format($totamt12b, 2).", cr:".number_format($totamt14b, 2).", jv:".number_format($totamt15b, 2).", subtot:".number_format($subtot11a, 2).", ";
// echo "tot:".number_format($totalcurrentassets, 2)."<br></p>";
        } // while
      } // if
      $grandtotcurrentnoncurrliabilities += $totalcurrentnoncurrliabilities;
      echo "<tr>";
      echo "<td></td><td></td>";
      echo "<td colspan=\"3\">$refname11</td>";
      echo "<td></td>";
      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalcurrentnoncurrliabilities, 2)."</td>";

      // query tblfindisbursement previous year
      $res11cquery=""; $result11c=""; $found11c=0; $ctr11c=0; $lookupsdfin="";
      $res11cquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11c=$dbh2->query($res11cquery);
      if($result11c->num_rows>0) {
        while($myrow11c=$result11c->fetch_assoc()) {
        $found11c=1;
        $ctr11c=$ctr11c+1;
        $codefr11c = $myrow11c['codefr'];
        $codeto11c = $myrow11c['codeto'];
        $lookupsd11c = $myrow11c['lookupsd'];
        if($lookupsd11c=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11c=='cr') { $lookupsdfin="creditamt"; }
        $res11dquery=""; $result11d=""; $found11d=0; $ctr11d=0; $totamt11d=0;
        $res11dquery="SELECT date, glcode, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result11d=$dbh2->query($res11dquery);
        if($result11d->num_rows>0) {
          while($myrow11d=$result11d->fetch_assoc()) {
          $found11d=1;
          $ctr11d=$ctr11d+1;
          $date11d = $myrow11d['date'];
          $glcode11d = $myrow11d['glcode'];
          $debitamt11d = $myrow11d['debitamt'];
          $creditamt11d = $myrow11d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt11d>0 && $creditamt11d>0) {
          $totdebitamt11d = $debitamt11d - $creditamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } else {
          $totdebitamt11d = $debitamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt11d>0 && $debitamt11d>0) {
          $totcreditamt11d = $creditamt11d - $debitamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } else {
          $totcreditamt11d = $creditamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res12dquery=""; $result12d=""; $found12d=0; $ctr12d=0; $totamt12d=0;
        $res12dquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result12d=$dbh2->query($res12dquery);
        if($result12d->num_rows>0) {
          while($myrow12d=$result12d->fetch_assoc()) {
          $found12d=1;
          $ctr12d=$ctr12d+1;
          $debitamt12d = $myrow12d['debitamt'];
          $creditamt12d = $myrow12d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt12d>0 && $creditamt12d>0) {
          $totdebitamt12d = $debitamt12d - $creditamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } else {
          $totdebitamt12d = $debitamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt12d>0 && $debitamt12d>0) {
          $totcreditamt12d = $creditamt12d - $debitamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } else {
          $totcreditamt12d = $creditamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14dquery=""; $result14d=""; $found14d=0; $ctr14d=0; $totamt14d=0;
        $res14dquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result14d=$dbh2->query($res14dquery);
        if($result14d->num_rows>0) {
          while($myrow14d=$result14d->fetch_assoc()) {
          $found14d=1;
          $ctr14d=$ctr14d+1;
          $debitamt14d = $myrow14d['debitamt'];
          $creditamt14d = $myrow14d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt14d>0 && $creditamt14d>0) {
          $totdebitamt14d = $debitamt14d - $creditamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } else {
          $totdebitamt14d = $debitamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt14d>0 && $debitamt14d>0) {
          $totcreditamt14d = $creditamt14d - $debitamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } else {
          $totcreditamt14d = $creditamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15dquery=""; $result15d=""; $found15d=0; $ctr15d=0; $totamt15d=0;
        $res15dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result15d=$dbh2->query($res15dquery);
        if($result15d->num_rows>0) {
          while($myrow15d=$result15d->fetch_assoc()) {
          $found15d=1;
          $ctr15d=$ctr15d+1;
          $debitamt15d = $myrow15d['debitamt'];
          $creditamt15d = $myrow15d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt15d>0 && $creditamt15d>0) {
          $totdebitamt15d = $debitamt15d - $creditamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } else {
          $totdebitamt15d = $debitamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt15d>0 && $debitamt15d>0) {
          $totcreditamt15d = $creditamt15d - $debitamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } else {
          $totcreditamt15d = $creditamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11c = $totamt11d + $totamt12d + $totamt14d + $totamt15d;
	  $totalprevnoncurrliabilities += $subtot11c;
// echo "<p>$res11query<br>$res11cquery<br>$res11dquery<br>$res12dquery<br>$res14dquery<br>$res15dquery<br></p>";
// echo "<p>$codefr11c - $codeto11c: cv:$totamt11d, ap:$totamt12d, cr:$totamt14d, jv:$totamt15d, subtot:$subtot11c<br></p>";
        } // while
      } // if

      $grandtotprevnoncurrliabilities += $totalprevnoncurrliabilities;

      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalprevnoncurrliabilities, 2)."</td>";
      echo "</tr>";
    // echo "<tr><td colspan='10'>r11q:$res11query<br>r11aq:$res11aquery<br>r11bq:$res11bquery<br>r11cq:$res11cquery<br>r11dquery:$res11dquery</td></tr>";

        // reset variable
        $totalcurrentliabilities=0; $totalprevnoncurrliabilities=0;

      } // while
    } // if

    // echo "<tr><td colspan='10'>r11q:$res11query</td></tr>";

    // compute total liabilities
    $finaltotalliability = $grandtotcurrentliabilities + $grandtotcurrentnoncurrliabilities;
    $finaltotalprevliability = $grandtotprevcurrentliabilities + $grandtotprevnoncurrliabilities;

    // display total liabilities
    echo "<tr><th></th><th></th><th></th><th colspan=\"2\">Total Non-Current Liability</th><th></th><th>P</th><th class='text-right'>".number_format($finaltotalliability, 2)."</th><th>P</th><th class='text-right'>".number_format($finaltotalprevliability, 2)."</th></tr>";

?>

    <tr><th></th><th colspan="4">EQUITY</th><th></th><th></th><th></th><th></th><th></th></tr>
<?php
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT refcd, refname FROM tblfinstfinposref WHERE refcd>=\"230\" AND refcd<=\"239\" ORDER BY refcd ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
      while($myrow11=$result11->fetch_assoc()) {
      $found11=1;
      $ctr11=$ctr11+1;
      $refcd11 = $myrow11['refcd'];
      $refname11 = $myrow11['refname'];

      // query tblfindisbursement current year
      $res11aquery=""; $result11a=""; $found11a=0; $ctr11a=0;
      $res11aquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a=1;
        $ctr11a=$ctr11a+1;
        $codefr11a = $myrow11a['codefr'];
        $codeto11a = $myrow11a['codeto'];
        $lookupsd11a = $myrow11a['lookupsd'];
        if($lookupsd11a=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11a=='cr') { $lookupsdfin="creditamt"; }
        $res11bquery=""; $result11b=""; $found11b=0; $ctr11b=0; $totamt11b=0;
        $res11bquery="SELECT disbursementid, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result11b=$dbh2->query($res11bquery);
        if($result11b->num_rows>0) {
          while($myrow11b=$result11b->fetch_assoc()) {
          // reset variables
          $totdebitamt11b=0; $totcreditamt11b=0;
          $found11b=1;
          $ctr11b=$ctr11b+1;
          $disbursementid11b = $myrow11b['disbursementid'];
          $debitamt11b = $myrow11b['debitamt'];
          $creditamt11b = $myrow11b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt11b>0 && $creditamt11b>0) {
          $totdebitamt11b = $debitamt11b - $creditamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } else {
          $totdebitamt11b = $debitamt11b;
          $totamt11b = $totamt11b + $totdebitamt11b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt11b>0 && $debitamt11b>0) {
          $totcreditamt11b = $creditamt11b - $debitamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } else {
          $totcreditamt11b = $creditamt11b;
          $totamt11b = $totamt11b + $totcreditamt11b;
            } // if-else
          } // if-else
// echo "<p>$codefr11a - $codeto11a: id:$disbursementid11b, lu:$lookupsd11a, dr:$debitamt11b|$totdebitamt11b, cr:$creditamt11b|$totcreditamt11b, tot:$totamt11b</p>";
          } // while
        } // if
        $res12bquery=""; $result12b=""; $found12b=0; $ctr12b=0; $totamt12b=0;
        $res12bquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result12b=$dbh2->query($res12bquery);
        if($result12b->num_rows>0) {
          while($myrow12b=$result12b->fetch_assoc()) {
          $found12b=1;
          $ctr12b=$ctr12b+1;
          $debitamt12b = $myrow12b['debitamt'];
          $creditamt12b = $myrow12b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt12b>0 && $creditamt12b>0) {
          $totdebitamt12b = $debitamt12b - $creditamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } else {
          $totdebitamt12b = $debitamt12b;
          $totamt12b = $totamt12b + $totdebitamt12b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt12b>0 && $debitamt12b>0) {
          $totcreditamt12b = $creditamt12b - $debitamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } else {
          $totcreditamt12b = $creditamt12b;
          $totamt12b = $totamt12b + $totcreditamt12b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14bquery=""; $result14b=""; $found14b=0; $ctr14b=0; $totamt14b=0;
        $res14bquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result14b=$dbh2->query($res14bquery);
        if($result14b->num_rows>0) {
          while($myrow14b=$result14b->fetch_assoc()) {
          $found14b=1;
          $ctr14b=$ctr14b+1;
          $debitamt14b = $myrow14b['debitamt'];
          $creditamt14b = $myrow14b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt14b>0 && $creditamt14b>0) {
          $totdebitamt14b = $debitamt14b - $creditamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } else {
          $totdebitamt14b = $debitamt14b;
          $totamt14b = $totamt14b + $totdebitamt14b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt14b>0 && $debitamt14b>0) {
          $totcreditamt14b = $creditamt14b - $debitamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } else {
          $totcreditamt14b = $creditamt14b;
          $totamt14b = $totamt14b + $totcreditamt14b;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15bquery=""; $result15b=""; $found15b=0; $ctr15b=0; $totamt15b=0;
        $res15bquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11a\" AND glcode<=\"$codeto11a\") AND (date>=\"$datefr\" AND date<=\"$dateto\") AND glrefver=2";
        $result15b=$dbh2->query($res15bquery);
        if($result15b->num_rows>0) {
          while($myrow15b=$result15b->fetch_assoc()) {
          $found15b=1;
          $ctr15b=$ctr15b+1;
          $debitamt15b = $myrow15b['debitamt'];
          $creditamt15b = $myrow15b['creditamt'];
          if($lookupsd11a=='dr') {
            if($debitamt15b>0 && $creditamt15b>0) {
          $totdebitamt15b = $debitamt15b - $creditamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } else {
          $totdebitamt15b = $debitamt15b;
          $totamt15b = $totamt15b + $totdebitamt15b;
            } // if-else
          } else if($lookupsd11a=='cr') {
            if($creditamt15b>0 && $debitamt15b>0) {
          $totcreditamt15b = $creditamt15b - $debitamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } else {
          $totcreditamt15b = $creditamt15b;
          $totamt15b = $totamt15b + $totcreditamt15b;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11a = $totamt11b + $totamt12b + $totamt14b + $totamt15b;
        $totalcurrentequity += $subtot11a;
// echo "<p>$res11query<br>$res11aquery<br>$res11bquery<br>$res12bquery<br>$res14bquery<br>$res15bquery<br></p>";
// echo "<p>$refcd11 $refname11: $codefr11a - $codeto11a: cv:".number_format($totamt11b, 2).", ap:".number_format($totamt12b, 2).", cr:".number_format($totamt14b, 2).", jv:".number_format($totamt15b, 2).", subtot:".number_format($subtot11a, 2).", ";
// echo "tot:".number_format($totalcurrentassets, 2)."<br></p>";
        } // while
      } // if
      $grandtotcurrentequity += $totalcurrentequity;
      echo "<tr>";
      echo "<td></td><td></td>";
      echo "<td colspan=\"3\">$refname11</td>";
      echo "<td></td>";
      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalcurrentequity, 2)."</td>";

      // query tblfindisbursement previous year
      $res11cquery=""; $result11c=""; $found11c=0; $ctr11c=0; $lookupsdfin="";
      $res11cquery="SELECT codefr, codeto, lookupsd FROM tblfinstfinposref WHERE refcd=\"$refcd11\" ORDER BY codefr ASC";
      $result11c=$dbh2->query($res11cquery);
      if($result11c->num_rows>0) {
        while($myrow11c=$result11c->fetch_assoc()) {
        $found11c=1;
        $ctr11c=$ctr11c+1;
        $codefr11c = $myrow11c['codefr'];
        $codeto11c = $myrow11c['codeto'];
        $lookupsd11c = $myrow11c['lookupsd'];
        if($lookupsd11c=='dr') { $lookupsdfin="debitamt"; } else if($lookupsd11c=='cr') { $lookupsdfin="creditamt"; }
        $res11dquery=""; $result11d=""; $found11d=0; $ctr11d=0; $totamt11d=0;
        $res11dquery="SELECT date, glcode, debitamt, creditamt FROM tblfindisbursement WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result11d=$dbh2->query($res11dquery);
        if($result11d->num_rows>0) {
          while($myrow11d=$result11d->fetch_assoc()) {
          $found11d=1;
          $ctr11d=$ctr11d+1;
          $date11d = $myrow11d['date'];
          $glcode11d = $myrow11d['glcode'];
          $debitamt11d = $myrow11d['debitamt'];
          $creditamt11d = $myrow11d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt11d>0 && $creditamt11d>0) {
          $totdebitamt11d = $debitamt11d - $creditamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } else {
          $totdebitamt11d = $debitamt11d;
          $totamt11d = $totamt11d + $totdebitamt11d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt11d>0 && $debitamt11d>0) {
          $totcreditamt11d = $creditamt11d - $debitamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } else {
          $totcreditamt11d = $creditamt11d;
          $totamt11d = $totamt11d + $totcreditamt11d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res12dquery=""; $result12d=""; $found12d=0; $ctr12d=0; $totamt12d=0;
        $res12dquery="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result12d=$dbh2->query($res12dquery);
        if($result12d->num_rows>0) {
          while($myrow12d=$result12d->fetch_assoc()) {
          $found12d=1;
          $ctr12d=$ctr12d+1;
          $debitamt12d = $myrow12d['debitamt'];
          $creditamt12d = $myrow12d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt12d>0 && $creditamt12d>0) {
          $totdebitamt12d = $debitamt12d - $creditamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } else {
          $totdebitamt12d = $debitamt12d;
          $totamt12d = $totamt12d + $totdebitamt12d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt12d>0 && $debitamt12d>0) {
          $totcreditamt12d = $creditamt12d - $debitamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } else {
          $totcreditamt12d = $creditamt12d;
          $totamt12d = $totamt12d + $totcreditamt12d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res14dquery=""; $result14d=""; $found14d=0; $ctr14d=0; $totamt14d=0;
        $res14dquery="SELECT debitamt, creditamt FROM tblfincashreceipt WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result14d=$dbh2->query($res14dquery);
        if($result14d->num_rows>0) {
          while($myrow14d=$result14d->fetch_assoc()) {
          $found14d=1;
          $ctr14d=$ctr14d+1;
          $debitamt14d = $myrow14d['debitamt'];
          $creditamt14d = $myrow14d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt14d>0 && $creditamt14d>0) {
          $totdebitamt14d = $debitamt14d - $creditamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } else {
          $totdebitamt14d = $debitamt14d;
          $totamt14d = $totamt14d + $totdebitamt14d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt14d>0 && $debitamt14d>0) {
          $totcreditamt14d = $creditamt14d - $debitamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } else {
          $totcreditamt14d = $creditamt14d;
          $totamt14d = $totamt14d + $totcreditamt14d;
            } // if-else
          } // if-else
          } // while
        } // if
        $res15dquery=""; $result15d=""; $found15d=0; $ctr15d=0; $totamt15d=0;
        $res15dquery="SELECT debitamt, creditamt FROM tblfinjournal WHERE (glcode>=\"$codefr11c\" AND glcode<=\"$codeto11c\") AND (date>=\"$datefrprev\" AND date<=\"$datetoprev\") AND glrefver=2";
        $result15d=$dbh2->query($res15dquery);
        if($result15d->num_rows>0) {
          while($myrow15d=$result15d->fetch_assoc()) {
          $found15d=1;
          $ctr15d=$ctr15d+1;
          $debitamt15d = $myrow15d['debitamt'];
          $creditamt15d = $myrow15d['creditamt'];
          if($lookupsd11c=='dr') {
            if($debitamt15d>0 && $creditamt15d>0) {
          $totdebitamt15d = $debitamt15d - $creditamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } else {
          $totdebitamt15d = $debitamt15d;
          $totamt15d = $totamt15d + $totdebitamt15d;
            } // if-else
          } else if($lookupsd11c=='cr') {
            if($creditamt15d>0 && $debitamt15d>0) {
          $totcreditamt15d = $creditamt15d - $debitamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } else {
          $totcreditamt15d = $creditamt15d;
          $totamt15d = $totamt15d + $totcreditamt15d;
            } // if-else
          } // if-else
          } // while
        } // if
        // compute sub-total
        $subtot11c = $totamt11d + $totamt12d + $totamt14d + $totamt15d;
	  $totalprevequity += $subtot11c;
// echo "<p>$res11query<br>$res11cquery<br>$res11dquery<br>$res12dquery<br>$res14dquery<br>$res15dquery<br></p>";
// echo "<p>$codefr11c - $codeto11c: cv:$totamt11d, ap:$totamt12d, cr:$totamt14d, jv:$totamt15d, subtot:$subtot11c<br></p>";
        } // while
      } // if

      $grandtotprevequity += $totalprevequity;

      if($ctr11==1) { echo "<td>P</td>"; } else { echo "<td></td>"; }
      echo "<td class='text-right'>".number_format($totalprevequity, 2)."</td>";
      echo "</tr>";
    // echo "<tr><td colspan='10'>r11q:$res11query<br>r11aq:$res11aquery<br>r11bq:$res11bquery<br>r11cq:$res11cquery<br>r11dquery:$res11dquery</td></tr>";

        // reset variable
        $totalcurrentequity=0; $totalprevequity=0;

      } // while
    } // if
    // echo "<tr><td colspan='10'>r11q:$res11query</td></tr>";

    // display total equity
    echo "<tr><th></th><th></th><th></th><th colspan=\"2\">Total Equity</th><th></th><th>P</th><th class='text-right'>".number_format($grandtotcurrentequity, 2)."</th><th>P</th><th class='text-right'>".number_format($grandtotprevequity, 2)."</th></tr>";

    // compute total liabilities and equity
    $totalcurrentliabequity = $finaltotalliability + $grandtotcurrentequity;
    $totalprevliabequity = $finaltotalprevliability + $grandtotprevequity;

    // display grand total liab and equity
    echo "<tr><th></th><th colspan=\"4\">TOTAL LIABILITIES AND EQUITY</th><th></th><th>P</th><th class='text-right'>".number_format($totalcurrentliabequity, 2)."</th><th>P</th><th class='text-right'>".number_format($totalprevliabequity, 2)."</th></tr>";

?>

  </tbody>
<?php	  
  } // if
?>
  </table>
<?php
  echo "<p><a href=\"finrptmnu.php?loginid=$loginid\" class=\"btn btn-secondary\" role=\"button\">Back</a></p>";

// end contents here

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>