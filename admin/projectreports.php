

<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

    if(isset($_GET['pid'])) {
        $projectId = $_GET['pid'];
    } else if(isset($_POST['pid'])) {
     $projectId = $_POST['pid'];
    } //if-else
    $projcode=$projectId; 

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

    echo "<div>";
    echo "<table class=\"fin\" border=\"1\">";
    echo "<tr><th colspan=\"2\">Project Accounts Summary</th></tr>";
    echo "<tr>";
    echo "<form action=\"projectreports.php?loginid=$loginid\" method=\"post\" name=\"form1\" id=\"form1\">";
    echo "<td colspan=\"2\"><select id=\"pid\" name=\"pid\">";
    $result11 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code != '' ORDER BY proj_code DESC", $dbh);
    echo "<option>Select Project</option>";
    while ($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $projcode = $myrow11[0];
      $projfname = $myrow11[1];
      $projsname = $myrow11[2];
      $projfname2 = $projfname;

      if($projcode == $projcodesel) { $projcodeselected = "selected"; }
      else { $projcodeselected = ""; }
      echo "<option name=\"proj_code\" value=\"$projcode\" $projcodeselected>$projcode - $projsname - $projfname2</option>";
    }
    echo "</select>";

    echo "<input type=\"submit\" value=\"Submit\"></td></form>";
    echo "</tr></table></div>";

    if($projectId!="") {

      echo "<input type='hidden' id='projectcode' value='".$projectId."' />";
      ?>
      <script>
        $(document).ready(function(){
            $('#pid').val($('#projectcode').val());
        });
      </script>

      <?php

      $resquery = "SELECT * from tblproject1 WHERE projectid='".$projectId."'";
      $result = $dbh2->query($resquery);

      $projname = '';
      $projcode = '';
      $datestart = '';
      $services = '';
      $projclass = '';

      while($myrow = $result->fetch_assoc()) {
        $projsname = $myrow['proj_sname'];
        $projname = $myrow['proj_fname'];
        $projcode = $myrow['proj_code'];
        $datestart = $myrow['date_start'];
        $services = $myrow['proj_sname'];
        $projclass = $myrow['proj_class'];
      } 
      $totalDisbursmentDebit = 0;
      $totalDisbursmentCredit = 0;
      $totalJournalDebit = 0;
      $totalJournalCredit = 0;
      $totalCashReceiptDebit = 0;
      $totalCashReceiptCredit = 0;

        $subDisbursement = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfindisbursement WHERE projcode = '".$projcode."'";
        $subDisbursementResult = $dbh2->query($subDisbursement);
        while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
        {
          $totalDisbursmentDebit = $rowDisbursement['gtotaldebit'];
          $totalDisbursmentCredit = $rowDisbursement['gtotalcredit'];
        }

        $subJournal = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfinjournal WHERE projcode = '".$projcode."'";
        $subJournalResult = $dbh2->query($subJournal);
        while($rowJournal = $subJournalResult->fetch_assoc()) 
        {
          $totalJournalDebit = $rowJournal['gtotaldebit'];
          $totalJournalCredit = $rowJournal['gtotalcredit'];
        }

         $subCashReceipt = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfincashreceipt WHERE projcode = '".$projcode."'";
        $subCashReceiptResult = $dbh2->query($subCashReceipt);
        while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
        {
          $totalCashReceiptDebit = $rowCashReceipt['gtotaldebit'];
          $totalCashReceiptCredit = $rowCashReceipt['gtotalcredit'];
        }


// edit body-header
     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";
     echo "<input type='hidden' id='loginid' value='".$loginid."'/>";
     ?>
     <h3 id="projacro">
<?php 
        echo "$projcode - ";
        if($proj_sname!="") { echo "$projsname "; } else { echo "$projname"; }
?> 
     </h3>
    <h4>
<?php
        echo "Date started:$datestart - Class:$projclass";
?>
    </h4>
       <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Transactions</a></li>
        <li><a data-toggle="tab" href="#menu1">Disbursement Graph</a></li>
        <li><a data-toggle="tab" href="#menu2">Cash Receipt Graph</a></li>
        <li><a data-toggle="tab" href="#menu3">Journal Graph</a></li>
        <li><a data-toggle="tab" href="#menu4">GAE</a></li>
        <li><a data-toggle="tab" href="#menu5">Direct Cost</a></li>
        <li><a data-toggle="tab" href="#menu6">Income Statement<br>Budget Variance</a></li>
        <li><a data-toggle="tab" href="#menu7">Cash flow/Cash position</a></li>
        <li><a data-toggle="tab" href="#menu8">Income Statement</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
               <div class="col-md-4">
                 <h4>
                   Total Debit: 
                   <span style="font-weight: 700;">PHP <?php echo number_format($totalDisbursmentDebit+ $totalCashReceiptDebit+ $totalJournalDebit,2); ?></span>
                 </h4>  
               </div>
               <div class="col-md-4">
                 <h4>
                 Total Credit: 
                   <span style="font-weight: 700;">PHP <?php echo number_format($totalDisbursmentCredit+$totalCashReceiptCredit+$totalJournalCredit,2); ?></span>
                </h4>
               </div>
               <div class="col-md-4"></div>
               
               <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
                <thead>
                  <th>Ref. Number</th>
                  <th>Name</th>
                  <th>Book</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <!-- <th>Balance</th> -->

                </thead>
               <tbody>
               <?php 
               $grandTotalCredit = 0;
               $grandTotalDebit = 0;
               $grandTotal = 0;
                  $sumDisbursementDebit = 0;
                  $sumDisbursementCredit = 0;
                  $sumCashReceiptDebit = 0;
                  $sumCashReceiptCredit = 0;
                  $sumJournalDebit = 0;
                  $sumJournalCredit = 0;
                  $totalSubDebit = 0;
                  $totalSubCredit = 0;
                  //disbursement
                  $subDisbursement = "SELECT * FROM tblfindisbursement WHERE projcode = '".$projcode."'";
                  $subDisbursementResult = $dbh2->query($subDisbursement);
                  while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
                  {
                    $sumDisbursementDebit = $sumDisbursementDebit + $rowDisbursement['debitamt'];
                    $sumDisbursementCredit = $sumDisbursementCredit + $rowDisbursement['creditamt'];
                    $grandTotal = $grandTotal + $sumDisbursementCredit - $sumDisbursementDebit;
                    echo "<tr>";
                      echo "<td>".$rowDisbursement['disbursementnumber'] ."</td>";
                      echo "<td>".$rowDisbursement['particulars'] ." ". $rowDisbursement['explanation'] ."</td>";
                      echo "<td>Disbursement Book</td>";
                      echo "<td>".number_format($rowDisbursement['debitamt'],2) ."</td>";
                      echo "<td>".number_format($rowDisbursement['creditamt'],2) ."</td>";
                      // echo "<td>".number_format($grandTotal,2) ."</td>";
                    echo "</tr>";
                    if($rowDisbursement['creditamt'] == 0){
                      echo "<input type='hidden' class='disbursementDebitAmount' value='".$rowDisbursement['debitamt']."' />";
                      echo "<input type='hidden' class='disbursementDebitMonth' value='".date('m',strtotime($rowDisbursement['date']))."' />";
                    echo "<input type='hidden' class='disbursementDebitYear' value='".date('Y',strtotime($rowDisbursement['date']))."' />";
                    echo "<input type='hidden' class='disbursementDebitDay' value='".date('d',strtotime($rowDisbursement['date']))."' />";
                    }

                    if($rowDisbursement['debitamt'] == 0){
                      echo "<input type='hidden' class='disbursementCreditAmount' value='".$rowDisbursement['creditamt']."' />";
                      echo "<input type='hidden' class='disbursementCreditMonth' value='".date('m',strtotime($rowDisbursement['date']))."' />";
                      echo "<input type='hidden' class='disbursementCreditYear' value='".date('Y',strtotime($rowDisbursement['date']))."' />";
                      echo "<input type='hidden' class='disbursementCreditDay' value='".date('d',strtotime($rowDisbursement['date']))."' />";
                      
                    }
                    if ($rowDisbursement['debitamt'] != 0 && $rowDisbursement['creditamt'] != 0){
                      echo "<input type='hidden' class='disbursementDebitAmount' value='".$rowDisbursement['debitamt']."' />";
                      echo "<input type='hidden' class='disbursementDebitMonth' value='".date('m',strtotime($rowDisbursement['date']))."' />";
                    echo "<input type='hidden' class='disbursementDebitYear' value='".date('Y',strtotime($rowDisbursement['date']))."' />";
                    echo "<input type='hidden' class='disbursementDebitDay' value='".date('d',strtotime($rowDisbursement['date']))."' />";

                      echo "<input type='hidden' class='disbursementCreditAmount' value='".$rowDisbursement['creditamt']."' />";
                      echo "<input type='hidden' class='disbursementCreditMonth' value='".date('m',strtotime($rowDisbursement['date']))."' />";
                      echo "<input type='hidden' class='disbursementCreditYear' value='".date('Y',strtotime($rowDisbursement['date']))."' />";
                      echo "<input type='hidden' class='disbursementCreditDay' value='".date('d',strtotime($rowDisbursement['date']))."' />";
                    }
                    
                    
                  }
                  //enddisbursement

                  //cashreceipt
                  $subCashReceipt = "SELECT * FROM tblfincashreceipt WHERE projcode = '".$projcode."'";
                  $subCashReceiptResult = $dbh2->query($subCashReceipt);

                  while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
                  {
                    echo "<tr>";
                      echo "<td>".$rowCashReceipt['cashreceiptnumber'] ."</td>";
                      echo "<td>".$rowCashReceipt['particulars'] ." ".$rowCashReceipt['explanation'] ."</td>";
                      echo "<td>Cash Receipt Book</td>";
                      echo "<td>".number_format($rowCashReceipt['debitamt'],2) ."</td>";
                      echo "<td>".number_format($rowCashReceipt['creditamt'],2) ."</td>";
                    echo "</tr>";


                    if($rowCashReceipt['creditamt'] == 0){
                      echo "<input type='hidden' class='CashReceiptDebitAmount' value='".$rowCashReceipt['debitamt']."' />";
                      echo "<input type='hidden' class='CashReceiptDebitMonth' value='".date('m',strtotime($rowCashReceipt['date']))."' />";
                    echo "<input type='hidden' class='CashReceiptDebitYear' value='".date('Y',strtotime($rowCashReceipt['date']))."' />";
                    echo "<input type='hidden' class='CashReceiptDebitDay' value='".date('d',strtotime($rowCashReceipt['date']))."' />";
                    }

                    if($rowCashReceipt['debitamt'] == 0){
                      echo "<input type='hidden' class='CashReceiptCreditAmount' value='".$rowCashReceipt['creditamt']."' />";
                      echo "<input type='hidden' class='CashReceiptCreditMonth' value='".date('m',strtotime($rowCashReceipt['date']))."' />";
                      echo "<input type='hidden' class='CashReceiptCreditYear' value='".date('Y',strtotime($rowCashReceipt['date']))."' />";
                      echo "<input type='hidden' class='CashReceiptCreditDay' value='".date('d',strtotime($rowCashReceipt['date']))."' />";
                      
                    }
                    if ($rowCashReceipt['debitamt'] != 0 && $rowCashReceipt['creditamt'] != 0){
                      echo "<input type='hidden' class='CashReceiptDebitAmount' value='".$rowCashReceipt['debitamt']."' />";
                      echo "<input type='hidden' class='CashReceiptDebitMonth' value='".date('m',strtotime($rowCashReceipt['date']))."' />";
                    echo "<input type='hidden' class='CashReceiptDebitYear' value='".date('Y',strtotime($rowCashReceipt['date']))."' />";
                    echo "<input type='hidden' class='CashReceiptDebitDay' value='".date('d',strtotime($rowCashReceipt['date']))."' />";

                      echo "<input type='hidden' class='CashReceiptCreditAmount' value='".$rowCashReceipt['creditamt']."' />";
                      echo "<input type='hidden' class='CashReceiptCreditMonth' value='".date('m',strtotime($rowCashReceipt['date']))."' />";
                      echo "<input type='hidden' class='CashReceiptCreditYear' value='".date('Y',strtotime($rowCashReceipt['date']))."' />";
                      echo "<input type='hidden' class='CashReceiptCreditDay' value='".date('d',strtotime($rowCashReceipt['date']))."' />";
                    }
                  }
                  //endcashreceipt

                  //JV Start
                  $subJournal = "SELECT * FROM tblfinjournal WHERE  projcode = '".$projcode."'";
                  $subJournalResult = $dbh2->query($subJournal);

                  while($rowJournal = $subJournalResult->fetch_assoc()) 
                  {
                    echo "<tr>";
                      echo "<td>".$rowJournal['journalnumber'] ."</td>";
                      echo "<td>".$rowJournal['particulars'] ." ".$rowJournal['explanation'] ."</td>";
                      echo "<td>Journal Voucher Book</td>";
                      echo "<td>".number_format($rowJournal['debitamt'],2) ."</td>";
                      echo "<td>".number_format($rowJournal['creditamt'],2) ."</td>";
                    echo "</tr>";

                    if($rowJournal['creditamt'] == 0){
                      echo "<input type='hidden' class='JournalDebitAmount' value='".$rowJournal['debitamt']."' />";
                      echo "<input type='hidden' class='JournalDebitMonth' value='".date('m',strtotime($rowJournal['date']))."' />";
                    echo "<input type='hidden' class='JournalDebitYear' value='".date('Y',strtotime($rowJournal['date']))."' />";
                    echo "<input type='hidden' class='JournalDebitDay' value='".date('d',strtotime($rowJournal['date']))."' />";
                    }

                    if($rowJournal['debitamt'] == 0){
                      echo "<input type='hidden' class='JournalCreditAmount' value='".$rowJournal['creditamt']."' />";
                      echo "<input type='hidden' class='JournalCreditMonth' value='".date('m',strtotime($rowJournal['date']))."' />";
                      echo "<input type='hidden' class='JournalCreditYear' value='".date('Y',strtotime($rowJournal['date']))."' />";
                      echo "<input type='hidden' class='JournalCreditDay' value='".date('d',strtotime($rowJournal['date']))."' />";
                      
                    }
                    if ($rowJournal['debitamt'] != 0 && $rowJournal['creditamt'] != 0){
                      echo "<input type='hidden' class='JournalDebitAmount' value='".$rowJournal['debitamt']."' />";
                      echo "<input type='hidden' class='JournalDebitMonth' value='".date('m',strtotime($rowJournal['date']))."' />";
                    echo "<input type='hidden' class='JournalDebitYear' value='".date('Y',strtotime($rowJournal['date']))."' />";
                    echo "<input type='hidden' class='JournalDebitDay' value='".date('d',strtotime($rowJournal['date']))."' />";

                      echo "<input type='hidden' class='JournalCreditAmount' value='".$rowJournal['creditamt']."' />";
                      echo "<input type='hidden' class='JournalCreditMonth' value='".date('m',strtotime($rowJournal['date']))."' />";
                      echo "<input type='hidden' class='JournalCreditYear' value='".date('Y',strtotime($rowJournal['date']))."' />";
                      echo "<input type='hidden' class='JournalCreditDay' value='".date('d',strtotime($rowJournal['date']))."' />";
                    }
                  }

                  //JV End
                ?>
                </tbody>
              </table>
        </div>
        <div id="menu1" class="tab-pane fade">
          <div id="graphContainer">
          </div>
        </div>

        <div id="menu2" class="tab-pane fade">
          <div id="graphContainerCashReceipt">
          </div>
        </div>

        <div id="menu3" class="tab-pane fade">
          <div id="graphContainerJournal">
          </div>
        </div>

        <div id="menu4" class="tab-pane fade">
               <div class="col-md-4"></div>
               
               <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
                <thead>
                  <th>Ref. Number</th>
                  <th>Name</th>
                  <th>Book</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <!-- <th>Balance</th> -->

                </thead>
               <tbody>
               <?php 
               $accountCodes = "SELECT * FROM tblfinglref WHERE version = 2 AND glname LIKE '%GAEq%'";
              $acctResult = $dbh2->query($accountCodes);

              while($row = $acctResult->fetch_assoc()) {
                    $grandTotalCredit = 0;
                    $grandTotalDebit = 0;
                    $grandTotal = 0;
                    $sumDisbursementDebit = 0;
                    $sumDisbursementCredit = 0;
                    $sumCashReceiptDebit = 0;
                    $sumCashReceiptCredit = 0;
                    $sumJournalDebit = 0;
                    $sumJournalCredit = 0;
                    $totalSubDebit = 0;
                    $totalSubCredit = 0;
                    //disbursement
                    $subDisbursement = "SELECT * FROM tblfindisbursement WHERE projcode = '".$projcode."' AND glcode = '".$row['glcode']."'";
                    $subDisbursementResult = $dbh2->query($subDisbursement);
                    while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
                    {
                      $sumDisbursementDebit = $sumDisbursementDebit + $rowDisbursement['debitamt'];
                      $sumDisbursementCredit = $sumDisbursementCredit + $rowDisbursement['creditamt'];
                      $grandTotal = $grandTotal + $sumDisbursementCredit - $sumDisbursementDebit;
                      echo "<tr>";
                        echo "<td>".$rowDisbursement['disbursementnumber'] ."</td>";
                        echo "<td>".$rowDisbursement['particulars'] ." ". $rowDisbursement['explanation'] ."</td>";
                        echo "<td>Disbursement Book</td>";
                        echo "<td>".number_format($rowDisbursement['debitamt'],2) ."</td>";
                        echo "<td>".number_format($rowDisbursement['creditamt'],2) ."</td>";
                        // echo "<td>".number_format($grandTotal,2) ."</td>";
                      echo "</tr>";
                    }
                    //enddisbursement

                    //cashreceipt
                    $subCashReceipt = "SELECT * FROM tblfincashreceipt WHERE projcode = '".$projcode."' AND glcode = '".$row['glcode']."'";
                    $subCashReceiptResult = $dbh2->query($subCashReceipt);

                    while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
                    {
                      echo "<tr>";
                        echo "<td>".$rowCashReceipt['cashreceiptnumber'] ."</td>";
                        echo "<td>".$rowCashReceipt['particulars'] ." ".$rowCashReceipt['explanation'] ."</td>";
                        echo "<td>Cash Receipt Book</td>";
                        echo "<td>".number_format($rowCashReceipt['debitamt'],2) ."</td>";
                        echo "<td>".number_format($rowCashReceipt['creditamt'],2) ."</td>";
                      echo "</tr>";
                    }
                    //endcashreceipt

                    //JV Start
                    $subJournal = "SELECT * FROM tblfinjournal WHERE projcode = '".$projcode."' AND glcode = '".$row['glcode']."'";
                    $subJournalResult = $dbh2->query($subJournal);

                    while($rowJournal = $subJournalResult->fetch_assoc()) 
                    {
                      echo "<tr>";
                        echo "<td>".$rowJournal['journalnumber'] ."</td>";
                        echo "<td>".$rowJournal['particulars'] ." ".$rowJournal['explanation'] ."</td>";
                        echo "<td>Journal Voucher Book</td>";
                        echo "<td>".number_format($rowJournal['debitamt'],2) ."</td>";
                        echo "<td>".number_format($rowJournal['creditamt'],2) ."</td>";
                      echo "</tr>";
                    }
                    //JV END
              }
                  
                ?>
                </tbody>
              </table>
      </div>

      <div id="menu5" class="tab-pane fade">
               <div class="col-md-4">
               </div>
               <div class="col-md-4"></div>
               
               <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
                <thead>
                  <th>Ref. Number</th>
                  <th>Name</th>
                  <th>Book</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <!-- <th>Balance</th> -->

                </thead>
               <tbody>
               <?php 
               $accountCodes = "SELECT * FROM tblfinglref where version = 2 AND glname LIKE '%DC%'";
               $acctResult = $dbh2->query($accountCodes);

              while($row = $acctResult->fetch_assoc()) {
                    $grandTotalCredit = 0;
                    $grandTotalDebit = 0;
                    $grandTotal = 0;
                    $sumDisbursementDebit = 0;
                    $sumDisbursementCredit = 0;
                    $sumCashReceiptDebit = 0;
                    $sumCashReceiptCredit = 0;
                    $sumJournalDebit = 0;
                    $sumJournalCredit = 0;
                    $totalSubDebit = 0;
                    $totalSubCredit = 0;
                    //disbursement
                    $subDisbursement = "SELECT * FROM tblfindisbursement WHERE projcode = '".$projcode."' AND glcode = '".$row['glcode']."'";
                    $subDisbursementResult = $dbh2->query($subDisbursement);
                    while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
                    {
                      $sumDisbursementDebit = $sumDisbursementDebit + $rowDisbursement['debitamt'];
                      $sumDisbursementCredit = $sumDisbursementCredit + $rowDisbursement['creditamt'];
                      $grandTotal = $grandTotal + $sumDisbursementCredit - $sumDisbursementDebit;
                      echo "<tr>";
                        echo "<td>".$rowDisbursement['disbursementnumber'] ."</td>";
                        echo "<td>".$rowDisbursement['particulars'] ." ". $rowDisbursement['explanation'] ."</td>";
                        echo "<td>Disbursement Book</td>";
                        echo "<td>".number_format($rowDisbursement['debitamt'],2) ."</td>";
                        echo "<td>".number_format($rowDisbursement['creditamt'],2) ."</td>";
                        // echo "<td>".number_format($grandTotal,2) ."</td>";
                      echo "</tr>";
                    }
                    //enddisbursement

                    //cashreceipt
                    $subCashReceipt = "SELECT * FROM tblfincashreceipt WHERE projcode = '".$projcode."' AND glcode = '".$row['glcode']."'";
                    $subCashReceiptResult = $dbh2->query($subCashReceipt);

                    while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
                    {
                      echo "<tr>";
                        echo "<td>".$rowCashReceipt['cashreceiptnumber'] ."</td>";
                        echo "<td>".$rowCashReceipt['particulars'] ." ".$rowCashReceipt['explanation'] ."</td>";
                        echo "<td>Cash Receipt Book</td>";
                        echo "<td>".number_format($rowCashReceipt['debitamt'],2) ."</td>";
                        echo "<td>".number_format($rowCashReceipt['creditamt'],2) ."</td>";
                      echo "</tr>";
                    }
                    //endcashreceipt

                    //JV Start
                    $subJournal = "SELECT * FROM tblfinjournal WHERE projcode = '".$projcode."' AND glcode = '".$row['glcode']."'";
                    $subJournalResult = $dbh2->query($subJournal);

                    while($rowJournal = $subJournalResult->fetch_assoc()) 
                    {
                      echo "<tr>";
                        echo "<td>".$rowJournal['journalnumber'] ."</td>";
                        echo "<td>".$rowJournal['particulars'] ." ".$rowJournal['explanation'] ."</td>";
                        echo "<td>Journal Voucher Book</td>";
                        echo "<td>".number_format($rowJournal['debitamt'],2) ."</td>";
                        echo "<td>".number_format($rowJournal['creditamt'],2) ."</td>";
                      echo "</tr>";
                    }
                    //JV END
              }
                  
                ?>
                </tbody>
              </table>
      </div> <!-- id=menu5 -->

      <div id="menu6" class="tab-pane fade">
               <?php 

                  include('incomestatementproject.php');
               ?>
      </div> <!-- id=menu6 -->

      <div id="menu7" class="tab-pane fade">
               <?php 

                  include('cashflow.php');
               ?>
      </div> <!-- id=menu7 -->

      <div id="menu8" class="tab-pane fade">
               <?php 
                  include('projrptincst.php');
               ?>
      </div> <!-- id=menu8 -->

      </div>
      </div>

      <?php 

    } //if($projetId!="")
      ?>

<link rel="stylesheet" type="text/css" href="tjaddons/projectreports.css">
<script src="tjaddons/charts.js"></script>
<script src="tjaddons/projectreports.js"></script>
      <?php 
     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
