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
  echo "<p><font size=1>Manage >> Accounting Modules >> Project Income Statement</font></p>";

// start contents here...
  if($accesslevel >= 4) {
?>
  <table class="table table-bordered">
  <thead>
    <tr><th colspan="8" class="bg-secondary text-white text-center">Account Codes for Project Income Statement</th></tr>
  </thead>
  <tbody>
    <tr><td colspan="8">
      <table class="table table-bordered">
      <tr><th colspan="2" class="bg-secondary text-white">Add code</th></tr>
<?php
      echo "<form action=\"mngfinprojincstadd.php?loginid=$loginid\" method=\"POST\" name=\"mngfinprojincstadd\">";
      echo "<tr><th class='text-right'>Acct Description</th><td>";
      echo "<select name=\"acctname\">";
      echo "<option value=\"1.00,Service_Revenue\">1.00 Service Revenue</option>";
      echo "<option value=\"1.01,Revenue_Accounts\">Service Revenue > 1.01 Revenue Accounts</option>";
      echo "<option value=\"2.00,Less:_Cost_of_Services\">2.00 Less: Cost of Services</option>";
      echo "<option value=\"2.01,Outside_Services\">Less: Cost of Services > 2.01 Outside Services</option>";
      echo "<option value=\"2.02,Salaries_&_Employees_Benefits\">Less: Cost of Services > 2.02 Salaries & Employees Benefits</option>";
      echo "<option value=\"2.03,Rentals\">Less: Cost of Services > 2.03 Rentals</option>";
      echo "<option value=\"2.04,Utilities\">Less: Cost of Services > 2.04 Utilities</option>";
      echo "<option value=\"2.05,Communication\">Less: Cost of Services > 2.05 Communication</option>";
      echo "<option value=\"2.06,Transportation_and_Travel\">Less: Cost of Services > 2.06 Transportation and Travel</option>";
      echo "<option value=\"2.07,Repairs_and_Maintenance\">Less: Cost of Services > 2.07 Repairs and Maintenance</option>";
      echo "<option value=\"2.08,Gasoline_and_Oil\">Less: Cost of Services > 2.08 Gasoline and Oil</option>";
      echo "<option value=\"2.09,Supplies\">Less: Cost of Services > 2.09 Supplies</option>";
      echo "<option value=\"2.10,Taxes_and_Licenses\">Less: Cost of Services > 2.10 Taxes and Licenses</option>";
      echo "<option value=\"2.11,Insurance\">Less: Cost of Services > 2.11 Insurance</option>";
      echo "<option value=\"2.12,Association_and_Subcontract\">Less: Cost of Services > 2.12 Association and Subcontract</option>";
      echo "<option value=\"2.13,Representation\">Less: Cost of Services > 2.13 Representation</option>";
      echo "<option value=\"2.14,Depreciation\">Less: Cost of Services > 2.14 Depreciation</option>";
      echo "<option value=\"2.15,Amortization\">Less: Cost of Services > 2.15 Amortization</option>";
      echo "<option value=\"2.16,Miscellaneous\">Less: Cost of Services > 2.16 Miscellaneous</option>";
      echo "<option value=\"3.00,Less:_Other_Operating_Expenses\">3.00 Less: Other Operating Expenses</option>";
      echo "<option value=\"3.01,Salaries_and_Employee_Benefits\">Less: Other Operating Expenses > 3.01 Salaries and Employee Benefits</option>";
      echo "<option value=\"3.02,Sports_and_Recreation\">Less: Other Operating Expenses > 3.02 Sports and Recreation</option>";
      echo "<option value=\"3.03,Manpower_&_Recruitment\">Less: Other Operating Expenses > 3.03 Manpower & Recruitment</option>";
      echo "<option value=\"3.04,Meeting_&_Conference\">Less: Other Operating Expenses > 3.04 Meeting & Conference</option>";
      echo "<option value=\"3.05,Membership_Dues\">Less: Other Operating Expenses > 3.05 Membership Dues</option>";
      echo "<option value=\"3.06,Office_Rental\">Less: Other Operating Expenses > 3.06 Office Rental</option>";
      echo "<option value=\"3.07,Utilities\">Less: Other Operating Expenses > 3.07 Utilities</option>";
      echo "<option value=\"3.08,Communication\">Less: Other Operating Expenses > 3.08 Communication</option>";
      echo "<option value=\"3.09,Transportation_and_Travel\">Less: Other Operating Expenses > 3.09 Transportation and Travel</option>";
      echo "<option value=\"3.10,Repairs_and_Maintenance\">Less: Other Operating Expenses > 3.10 Repairs and Maintenance</option>";
      echo "<option value=\"3.11,Gas_and_Oil\">Less: Other Operating Expenses > 3.11 Gas and Oil</option>";
      echo "<option value=\"3.12,Office_Supplies\">Less: Other Operating Expenses > 3.12 Office Supplies</option>";
      echo "<option value=\"3.13,Taxes_and_Licenses\">Less: Other Operating Expenses > 3.13 Taxes and Licenses</option>";
      echo "<option value=\"3.14,Insurance\">Less: Other Operating Expenses > 3.14 Insurance</option>";
      echo "<option value=\"3.15,Professional_Fees\">Less: Other Operating Expenses > 3.15 Professional Fees</option>";
      echo "<option value=\"3.16,Association_and_Subcontract\">Less: Other Operating Expenses > 3.16 Association and Subcontract</option>";
      echo "<option value=\"3.17,Representation\">Less: Other Operating Expenses > 3.17 Representation</option>";
      echo "<option value=\"3.18,Depreciation\">Less: Other Operating Expenses > 3.18 Depreciation</option>";
      echo "<option value=\"3.19,Amortization\">Less: Other Operating Expenses > 3.19 Amortization</option>";
      echo "<option value=\"3.20,Miscellaneous\">Less: Other Operating Expenses > 3.20 Miscellaneous</option>";
      echo "<option value=\"4.00,Add/(Less):_Other_Income_(Charge)_-_Net\">4.00 Add/(Less): Other Income (Charges) - Net</option>";
      echo "<option value=\"4.01,Forex_Gains/_(Losses)_-_Net\">Add/(Less): Other Income (Charges) - Net > 4.01 Forex Gains/ (Losses) - Net</option>";
      echo "<option value=\"4.02,Finance_Income_/_Int._Income\">Add/(Less): Other Income (Charges) - Net > 4.02 Finance Income / Int. Income</option>";
      echo "<option value=\"4.03,Int._Income_from_Bank_Deposits\">Add/(Less): Other Income (Charges) - Net > 4.03 Int. Income from Bank Deposits</option>";
      echo "<option value=\"4.04,Gain_/(Loss)_on_Asset_Disposal\">Add/(Less): Other Income (Charges) - Net > 4.04 Gain /(Loss) on Asset Disposal</option>";
      echo "<option value=\"4.05,Other_Income\">Add/(Less): Other Income (Charges) - Net > 4.05 Other Income</option>";
      echo "<option value=\"4.06,Finance_Costs_/_Int._Expense\">Add/(Less): Other Income (Charges) - Net > 4.06 Finance Costs / Int. Expense</option>";
      echo "<option value=\"5.00,Less:_Tax_Expense\">5.00 Less: Tax Expense</option>";
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

      if($tabpos14!='') {
        if($tabpos14==0) {
          $tabpos0sel="selected"; $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel=""; $tabpos6sel=""; $tabpos7sel=""; $tabpos8sel="";
        } else if($tabpos14==1) {
          $tabpos0sel=""; $tabpos1sel="selected"; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel=""; $tabpos6sel=""; $tabpos7sel=""; $tabpos8sel="";
        } else if($tabpos14==2) {
          $tabpos0sel=""; $tabpos1sel=""; $tabpos2sel="selected"; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel=""; $tabpos6sel=""; $tabpos7sel=""; $tabpos8sel="";
        } else if($tabpos14==3) {
          $tabpos0sel=""; $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel="selected"; $tabpos4sel=""; $tabpos5sel=""; $tabpos6sel=""; $tabpos7sel=""; $tabpos8sel="";
        } else if($tabpos14==4) {
          $tabpos0sel=""; $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel="selected"; $tabpos5sel=""; $tabpos6sel=""; $tabpos7sel=""; $tabpos8sel="";
        } else if($tabpos14==5) {
          $tabpos0sel=""; $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel="selected"; $tabpos6sel=""; $tabpos7sel=""; $tabpos8sel="";
        } else if($tabpos14==6) {
          $tabpos0sel=""; $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel=""; $tabpos6sel="selected"; $tabpos7sel=""; $tabpos8sel="";
        } else if($tabpos14==7) {
          $tabpos0sel=""; $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel=""; $tabpos6sel=""; $tabpos7sel="selected"; $tabpos8sel="";
        } else if($tabpos14==8) {
          $tabpos0sel=""; $tabpos1sel=""; $tabpos2sel=""; $tabpos3sel=""; $tabpos4sel=""; $tabpos5sel=""; $tabpos6sel=""; $tabpos7sel=""; $tabpos8sel="selected";
        } // if-else
      } // if
      echo "<tr><th class=\"text-right\">Tab position</th><td>";
      echo "<select name=\"tabpos\">";
      echo "<option value='0' $tabpos0sel>0</option>";
      echo "<option value='1' $tabpos1sel>1</option>";
      echo "<option value='2' $tabpos2sel>2</option>";
      echo "<option value='3' $tabpos3sel>3</option>";
      echo "<option value='4' $tabpos4sel>4</option>";
      echo "<option value='5' $tabpos5sel>5</option>";
      echo "<option value='6' $tabpos6sel>6</option>";
      echo "<option value='7' $tabpos7sel>7</option>";
      echo "<option value='8' $tabpos8sel>8</option>";
      echo "</select>";
      echo "</td></tr>";

      echo "<tr><th></th><td><button type=\"submit\" class=\"btn btn-success\">Add acct code/s</button></t></tr>";
      echo "</form>";
?>
      </table>
    </td></tr>
    <tr><th>Count</th><th>No.</th><th>Description</th><th>Tab pos.</th><th>Acct Code (From)</th><th>-to-</th><th>Acct Code (To)</th><th>Look-up side</th><th>Timestamp</th><th>Action</th></tr>
<?php
    $res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT idprojincstcdctg, timestamp, acctcd, acctnm1, glcodefr, glcodeto, lookupsd, tabpos FROM tblfinprojincstcdctg ORDER BY acctcd ASC, glcodefr ASC, glcodeto ASC";
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
      while($myrow14=$result14->fetch_assoc()) {
      $found14=1;
      $ctr14=$ctr14+1;
      $idprojincstcdctg14 = $myrow14['idprojincstcdctg'];
      $timestamp14 = $myrow14['timestamp'];
      $acctcd14 = $myrow14['acctcd'];
      $acctnm114 = $myrow14['acctnm1'];
      $glcodefr14 = $myrow14['glcodefr'];
      $glcodeto14 = $myrow14['glcodeto'];
      $lookupsd14 = $myrow14['lookupsd'];
      $tabpos14 = $myrow14['tabpos'];

      if($lookupsd14=='dr') { $lookupsdfin="debit"; } else if($lookupsd14=='cr') { $lookupsdfin="credit"; }
      echo "<tr><td>$ctr14</td><td>$acctcd14</td><td>$acctnm114</td><td>$tabpos14</td><td>$glcodefr14</td><td>-to-</td><td>$glcodeto14</td><td>$lookupsdfin</td><td>".date('Y-M-d H:i:s', strtotime($timestamp14))."</td>";
      echo "<td><a href=\"./mngfinprojincstdel.php?loginid=$loginid&pisid=$idprojincstcdctg14\" class=\"btn btn-danger\" role=\"button\">Del</a></td></tr>";
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
