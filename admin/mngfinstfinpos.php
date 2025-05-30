<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
  echo "<p><font size=1>Manage >> Accounting Modules >> Statement of Financial Position</font></p>";

// start contents here...
  if($accesslevel >= 4) {
?>
  <table class="table table-bordered">
  <thead>
    <tr><th colspan="8" class="bg-secondary text-white text-center">Account Codes for Statement of Financial Position</th></tr>
  </thead>
  <tbody>
    <tr><td colspan="8">
      <table class="table table-bordered">
      <tr><th colspan="2" class="bg-secondary text-white">Add code</th></tr>
<?php
      echo "<form action=\"mngfinstfinposadd.php?loginid=$loginid\" method=\"POST\" name=\"mngfinstfinposadd\">";
      echo "<tr><th class='text-right'>Acct Description</th><td>";
      echo "<select name=\"acctname\">";
      echo "<option value=\"111,A,CA,Cash\">Assets > Current Assets > Cash</option>";
      echo "<option value=\"112,A,CA,Trade_and_other_receivables_-_net\">Assets > Current Assets > Trade and other receivables - net</option>";
      echo "<option value=\"113,A,CA,Work_in_progress\">Assets > Current Assets > Work in progress</option>";
      echo "<option value=\"114,A,CA,Other_current_assets\">Assets > Current Assets > Other current assets</option>";
      echo "<option value=\"121,A,NCA,Property_and_equipment_-_net\">Assets > Non-Current Assets > Property and equipment - net</option>";
      echo "<option value=\"122,A,NCA,Intangible_assets_-_net\">Assets > Non-Current Assets > Intangible assets - net</option>";
      echo "<option value=\"123,A,NCA,Deferred_tax_assets_-_net\">Assets > Non-Current Assets > Deferred tax assets - net</option>";
      echo "<option value=\"124,A,NCA,Other_non-current_assets\">Assets > Non-Current Assets > Other non-current assets</option>";
      echo "<option value=\"211,LE,CL,Trade_and_other_payables\">Liabilities and Equity > Current Liabilities > Trade and other payables</option>";
      echo "<option value=\"212,LE,CL,Loans_payable\">Liabilities and Equity > Current Liabilities > Loans payable</option>";
      echo "<option value=\"213,LE,CL,Dividends_payable\">Liabilities and Equity > Current Liabilities > Dividends payable</option>";
      echo "<option value=\"214,LE,CL,Income_tax_payable\">Liabilities and Equity > Current Liabilities > Income tax payable</option>";
      echo "<option value=\"221,LE,NCL,Retirement_benefit_obligation\">Liabilities and Equity > Non-Current Liability > Retirement benefit obligation</option>";
      echo "<option value=\"231,LE,E,Capital_stock\">Liabilities and Equity > Equity > Capital stock</option>";
      echo "<option value=\"232,LE,E,Retained_earnings\">Liabilities and Equity > Equity > Retained earnings</option>";
      echo "</select>";
      echo "</td><tr>";

      echo "<tr><th class='text-right'>Acct Code (from)</th><td>";
      echo "<select name=\"glcodefr\">";
      echo "<option value=''>-</option>";
      $res11query=""; $result11=""; $found11=0; $ctr11=0;
      $res11query="SELECT DISTINCT glcode, glrefid, glname FROM tblfinglref WHERE version=2 ORDER BY glcode ASC";
      $result11=$dbh2->query($res11query);
      if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $glcode11 = $myrow11['glcode'];
        $glrefid11 = $myrow11['glrefid'];
        $glname11 = $myrow11['glname'];
        echo "<option value=\"$glcode11\">$glname11 - $glcode11</option>";
        } // while
      } // if
      echo "</select>";
      echo "</td></tr>";

      echo "<tr><th class='text-right'>Acct Code (to)</th><td>";
      echo "<select name=\"glcodeto\">";
      echo "<option value=''>-</option>";
      $res12query=""; $result12=""; $found12=0; $ctr12=0;
      $res12query="SELECT DISTINCT glcode, glrefid, glname FROM tblfinglref WHERE version=2 ORDER BY glcode ASC";
      $result12=$dbh2->query($res12query);
      if($result12->num_rows>0) {
        while($myrow12=$result12->fetch_assoc()) {
        $found12=1;
        $glcode12 = $myrow12['glcode'];
        $glrefid12 = $myrow12['glrefid'];
        $glname12 = $myrow12['glname'];
        echo "<option value=\"$glcode12\">$glname12 - $glcode12</option>";
        } // while
      } // if
      echo "</select>";
      echo "</td></tr>";

      echo "<tr><th class=\"text-right\">Look-up side</th><td>";
      echo "<select name=\"lookupsd\">";
      echo "<option value=\"dr\">Debit</option>";
      echo "<option value=\"cr\">Credit</option>";
      echo "</select>";
      echo "</td></tr>";

      echo "<tr><th></th><td><button type=\"submit\" class=\"btn btn-success\">Add acct code/s</button></t></tr>";
      echo "</form>";
?>
      </table>
    </td></tr>
    <tr><th>Count</th><th>Description</th><th>Acct Code (From)</th><th>-to-</th><th>Acct Code (To)</th><th>Look-up side</th><th>Timestamp</th><th>Action</th></tr>
<?php
    $res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT idstfinpos, timestamp, refcd, refname, codefr, codeto, lookupsd FROM tblfinstfinposref ORDER BY refcd ASC, codefr ASC, codeto ASC";
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
      while($myrow14=$result14->fetch_assoc()) {
      $found14=1;
      $ctr14=$ctr14+1;
      $idstfinpos14 = $myrow14['idstfinpos'];
      $timestamp14 = $myrow14['timestamp'];
      $refcd14 = $myrow14['refcd'];
      $refname14 = $myrow14['refname'];
      $codefr14 = $myrow14['codefr'];
      $codeto14 = $myrow14['codeto'];
      $lookupsd14 = $myrow14['lookupsd'];
      if($lookupsd14=='dr') { $lookupsdfin="debit"; } else if($lookupsd14=='cr') { $lookupsdfin="credit"; }
      echo "<tr><td>$ctr14</td><td>$refname14</td><td>$codefr14</td><td>-to-</td><td>$codeto14</td><td>$lookupsdfin</td><td>".date('Y-M-d H:i:s', strtotime($timestamp14))."</td>";
      echo "<td><a href=\"./mngfinstfinposdel.php?loginid=$loginid&sfpid=$idstfinpos14\" class=\"btn btn-danger\" role=\"button\">Del</a></td></tr>";
      // reset variables
      $lookupsdfin="";
      } // while
    } // if
?>
  <tr><td colspan="10">-- eof --</td></tr>
  </tbody>
  </table>
<?php
  } // if

// end contents here...

// edit body-footer
    echo "<p><a href=\"./mngfinmods.php?loginid=$loginid\">Back</a></p>";

    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     // include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?> 
