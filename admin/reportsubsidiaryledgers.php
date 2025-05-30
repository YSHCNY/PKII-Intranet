

<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$fromDate = date('Y-m-d',strtotime((isset($_POST['fromDate'])) ? $_POST['fromDate'] :''));
$d = new DateTime($fromDate);

$toDate = date('Y-m-d',strtotime((isset($_POST['toDate'])) ? $_POST['toDate'] :''));
$toDateOri = $toDate;
$toDate = date('Y-m-d',strtotime($toDate . "+1 days"));
$lastMonth =$d->modify('first day of last month');
$workingPaperDate = $lastMonth->format('Y-m-d');

$currMonth = date('m', strtotime($fromDate));

if($loginid!="") {
     include("logincheck.php");
}

if($found==1) {
     include ("header.php");
     include ("sidebar.php");
     
     $accountCodes = "SELECT * FROM tblfinglref where version = 2 ORDER BY glcode ASC";
     $acctResult = $dbh2->query($accountCodes);
// edit body-header
?>
<div class = 'p-5 shadow'>
<?php
  echo"<div class = 'mb-5 mt-2'>";
        echo "<p class='fs-3 fw-bold mb-0'>Philkoei International, Inc.</p>";
        echo "<p class='fs-4 text-muted'><i>Subsidiary Ledger</i></p>";
       echo "</div>";



     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";
     echo "<input type='hidden' id='loginid' value='".$loginid."'/>";
    //  echo "<p><font size=1>Modules >> Finance Reports >> Subsidiary - Ledgers</font></p>";
     echo '<form method="post" class = "text-center" action="reportsubsidiaryledgers.php?loginid='.$loginid.'">';
     ?>
      <script type="text/javascript">
        $(function() {
          $("#exportToExcel").click(function() {
            var data='<table>' + $("#tblName").html().replace(/<a\/?[^>]+>/gi,'')+'</table>';
            $('body').prepend("<form method='post' action='exportexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"'></form>");
            $('#ReportTableData').submit().remove();
        });
      });
      </script>
      <?php
      
        if (isset($_POST["glcode"]))
          {
            echo "<input type='hidden' id='placeholderFromDate' value='".$_POST['fromDate']."'/>";
            echo "<input type='hidden' id='placeholderToDate' value='".$_POST['toDate']."'/>";
            echo "<input type='hidden' id='placeholderGlcode' value='".$_POST['glcode']."'/>";
            echo "<input type='hidden' id='placeholderIndex' value='1'/>";
          }
          else{
            echo "<input type='hidden' id='placeholderIndex' value='0'/>";
          }

      ?>

      <script type="text/javascript">
        $(function() {

          var placeholderIndex = $('#placeholderIndex').val();
          if(placeholderIndex == '1' || placeholderIndex == 1)
          {
            $('#fromDate').val($('#placeholderFromDate').val());
            $('#toDate').val($('#placeholderToDate').val());
            $('#glcode').val($('#placeholderGlcode').val());
          }
        });
      </script>

      <input class='btn form-control' type="text" id="fromDate" name='fromDate' placeholder="from" style='width:20%; text-align: left; border: 1px solid #ddd;' />
       <input class='btn form-control' type="text" id="toDate" name="toDate" placeholder="To"  style='width:20%; text-align: left; border: 1px solid #ddd;' />
       <select id="glcode" name="glcode" class="form-control btn" style='width:30%; text-align: left; border: 1px solid #ddd;'>
          <option value="All">All</option>
          <?php 
            while($row = $acctResult->fetch_assoc()) 
              {
                echo "<option value='".$row['glcode']."'>".$row['glcode']. ' - '.$row['glname']."</option>";
              }
          ?>
       </select>
       <button type="submit" class="btn btnConfirm btn-primary" id="btnConfirm">Submit</button>
       <a href = '#' class = 'btn btn-success' id="exportToExcel">Excel</a>
     
       </form>

<style>
  tbody td{
    padding: 10px 5px 10px 5px !important;
  }

  th{
    padding: 10px 5px 10px 5px !important;
  }
</style>

<?php
 echo "<p class='text-start mt-5 mb-2 '>Displaying Entries from ".date('F Y', strtotime($fromDate))." to ".date('F Y', strtotime($toDateOri))."</p>";
?>
     <table id="tblName" class=' table-striped table-bordered table-hover '>
      <thead>
<?php
        // title head


     if (isset($_POST["fromDate"]))
     {

     if($_POST['glcode'] == 'All'){

       $accountCodes = "SELECT * FROM tblfinglref where version = 2";
       $acctResult = $dbh2->query($accountCodes);

     } else {

       $accountCodes = "SELECT * FROM tblfinglref where version = 2 AND glcode = '".$_POST['glcode']."'";
       $acctResult = $dbh2->query($accountCodes);

       $beginningBalance = 0;

        if($currMonth=='07' || $currMonth==07) {
            // get beg bal from working paper of june
            $getWorkingPaper = "SELECT begbalancedr, begbalancecr from tblfinworkpaper where glcode = '".$_POST['glcode']."' AND month = '".date('Y-m-01', strtotime($fromDate))."'";
            $getWorkingPaperRows = $dbh2->query($getWorkingPaper);

            while($rowTotal = $getWorkingPaperRows->fetch_assoc()) {
                $beginningBalance = $rowTotal['begbalancedr'];
				$beginningBalanceCr = $rowTotal['begbalancecr'];

        //20230613
        if($beginningBalanceCr!=0 && $beginningBalance==0) {
        $beginningBalance=-$beginningBalanceCr;
        } //if

            } //while

        } else {

        $getWorkingPaper = "SELECT * from tblfinworkpaper where glcode = '".$_POST['glcode']."' AND month = '".$workingPaperDate."'";
        $getWorkingPaperRows = $dbh2->query($getWorkingPaper);

        } //if-else

        while($rowTotal = $getWorkingPaperRows->fetch_assoc()) 
          {
            $beginningBalance = $rowTotal['balancesheetdr'];
			$beginningBalanceCr = $rowTotal['balancesheetcr'];

        //20230613
        if($beginningBalanceCr!=0 && $beginningBalance==0) {
        $beginningBalance=-$beginningBalanceCr;
        } //if

          }

     } //if-else

     $grandTotalCredit = 0;
     $grandTotalDebit = 0;

     while($row = $acctResult->fetch_assoc()) 
      {
        $sumDisbursementDebit = 0;
        $sumDisbursementCredit = 0;
        $sumCashReceiptDebit = 0;
        $sumCashReceiptCredit = 0;

        // 20210510
        $sumAcctsPayableDebit = 0;
        $sumAcctsPayableCredit = 0;

        $sumJournalDebit = 0;
        $sumJournalCredit = 0;
        $totalSubDebit = 0;
        $totalSubCredit = 0;

        echo "<tr>";
        echo "<th colspan='8'>".$row['glcode'] ." - ".$row['glname']."</th>";
        echo "</tr>";

        // echo "<tr><th colspan='8' class='text-left'>".$row['glcode'] ." - ".$row['glname']."</th></tr>";

        // column labels
?>
        <tr>
          <th>Ref. Number</th>
        <th>Date</th>
        <th>Payee</th>
        <th>Account</th>
        <th>Particulars</th>
        <th>Beginning Balance</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Ending Balance</th></tr>
      </thead>
     <tbody>

<?php

    // 20230712 loop bet dates https://tecadmin.net/php-loop-between-two-dates/
    $start_date = date_create("$fromDate");
    $end_date = date_create("$toDate");
    $interval = new DateInterval('P1D');
    $date_range = new DatePeriod($start_date, $interval, $end_date);
    // start loop per day on date_range
    foreach ($date_range as $date) {
        // echo $date->format('Y-m-d') . "<br>";

        //disbursement
        $subDisbursement = "SELECT * FROM tblfindisbursement WHERE date = \"".$date->format('Y-m-d')."\" AND glcode = '".$row['glcode']."' ORDER BY date ASC, disbursementnumber ASC";
        $subDisbursementResult = $dbh2->query($subDisbursement);
        while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
        {
          $companyid15 = $rowDisbursement['companyid'];
          $contactid15 = $rowDisbursement['contactid'];
          echo "<tr>";
            echo "<td><a href='finvouchcvview.php?loginid=".$loginid."&cvn=".$rowDisbursement['disbursementnumber']."' target=\"_blank\"><b>".$rowDisbursement['disbursementnumber']."</b></a></td>";
            // echo "<td>".$rowDisbursement['disbursementnumber'] ."</td>";


            echo "<td>".$rowDisbursement['date'] ."</td>";
            echo '<td>';
            if((($companyid15!="") || ($companyid15!=0)) && (($contactid15=="") || ($contactid15==0))) {
              $result15a=""; $found15a=0; $ctr15a=0;
              $result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid15", $dbh);
              if($result15a != "") {
                while($myrow15a = mysql_fetch_row($result15a)) {
                $found15a = 1;
                $company15a = $myrow15a[0];
                $branch15a = $myrow15a[1];
                }
              }
              $company15afin = $company15a;
              if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
              $company15afin2 = str_replace("'", "", $company15afin);
              echo "<b><u>$company15afin2</u></b>";
            }
            if((($contactid15!="") || ($contactid15!=0)) && (($companyid15=="") || ($companyid15==0))) {
              $result15b=""; $found15b=0; $ctr15b=0;
              $result15b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid15", $dbh);
              if($result15b != "") {
                while($myrow15b = mysql_fetch_row($result15b)) { 
                $found15b = 1;
                $companyid15b = $myrow15b[0];
                $employeeid15b = $myrow15b[1];
                $name_last15b = $myrow15b[2];
                $name_first15b = $myrow15b[3];
                $name_middle15b = $myrow15b[4];
                }
              }
              $contactname15bfin = $name_first15b;
              if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . " " . $name_middle15b[0] . "."; }
              if($name_last15b != "") { $contactname15bfin = $contactname15bfin . " " . $name_last15b; }
              $contactname15bfin2 = str_replace("'", "", $contactname15bfin);
              // $contactname15bfin2 = htmlentities($contactname15bfin2);
              // $contactname15bfin2 = htmlspecialchars($contactname15bfin2);
                $contactname15bfin2 = stripslashes(htmlentities(utf8_decode($contactname15bfin2)));
              echo "<b><u>$contactname15bfin2</u></b>";
            }
            echo '</td>';

            // echo "<td>".$rowDisbursement['particulars'] ."</td>";
            echo "<td>".str_replace("'", "", $rowDisbursement['particulars'])."</td>";
            // echo "<td>".$rowDisbursement['explanation'] ."</td>";
            echo "<td>".str_replace("'", "", $rowDisbursement['explanation'])."</td>";

			if(($row['glcode'] >= "10.20.000") && ($row['glcode'] <= "10.20.999.9"))
				if($beginningBalanceCr>0) {
					echo "<td class='text-right'>".number_format($beginningBalanceCr,2) ."</td>";
				} else {
					if($beginningBalance < 0) { echo "<td class='text-right'>1b1|(".number_format(abs($beginningBalance),2) .")</td>"; } 
					else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>"; }
					echo "<td class='text-right'>".number_format($rowDisbursement['debitamt'],2) ."</td>";
					echo "<td class='text-right'>".number_format($rowDisbursement['creditamt'],2) ."</td>";			
				} //if-else
			else {
            if($beginningBalance < 0) { echo "<td class='text-right'>(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>"; }
            echo "<td class='text-right'>".number_format($rowDisbursement['debitamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($rowDisbursement['creditamt'],2) ."</td>";			
			}
			

            if(($row['glcode'] >= "10.00.000") && ($row['glcode'] <= "10.40.140")) {
              $beginningBalance += $rowDisbursement['debitamt'];
              $beginningBalance -= $rowDisbursement['creditamt'];
            }

            else if(($row['glcode'] >= "20.00.000") && ($row['glcode'] <= "50.10.400")) {
              // $beginningBalance += $rowDisbursement['debitamt'];
              // $beginningBalance -= $rowDisbursement['creditamt'];					
			  $beginningBalance -= $rowDisbursement['debitamt'];
              $beginningBalance += $rowDisbursement['creditamt'];					
            }

            else if(($row['glcode'] >= "60.00.000") && ($row['glcode'] <= "72.00.000")) {
              // $beginningBalance += $rowDisbursement['debitamt'];
              // $beginningBalance -= $rowDisbursement['creditamt'];
			  $beginningBalance -= $rowDisbursement['debitamt'];
              $beginningBalance += $rowDisbursement['creditamt'];

            }

            else if(($row['glcode'] >= "80.00.000") && ($row['glcode'] <= "90.00.000")) {
              $beginningBalance -= $rowDisbursement['debitamt'];
              $beginningBalance += $rowDisbursement['creditamt'];
            }

            if($beginningBalance < 0) { echo "<td class='text-right'>(".number_format(abs($beginningBalance),2) .")</td>"; }

            else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>";}
            
          echo "</tr>";
          $sumDisbursementDebit = $sumDisbursementDebit + $rowDisbursement['debitamt'];
          $sumDisbursementCredit = $sumDisbursementCredit + $rowDisbursement['creditamt'];
        }
        // disp cash disbursement sub-total
        // echo "<tr><th colspan='6'>Sub-total for Cash Disbursement</th><th class='text-right'>".number_format($sumDisbursementDebit, 2)."</th><th class='text-right'>".number_format($sumDisbursementCredit, 2)."</th><th></th></tr>";
        //enddisbursement


        //cashreceipt

        $subCashReceipt = "SELECT * FROM tblfincashreceipt WHERE date = \"".$date->format('Y-m-d')."\" AND glcode = '".$row['glcode']."' ORDER BY date ASC, cashreceiptnumber ASC";
        $subCashReceiptResult = $dbh2->query($subCashReceipt);

        while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
        {

          $companyid16 = $rowCashReceipt['companyid'];
          $contactid16 = $rowCashReceipt['contactid'];

          echo "<tr>";
            
            echo "<td><a href='finvouchcrvview.php?loginid=".$loginid."&crvn=".$rowCashReceipt['cashreceiptnumber']."' target=\"_blank\"><b>".$rowCashReceipt['cashreceiptnumber']."</b></a></td>";
            // echo "<td>".$rowCashReceipt['cashreceiptnumber'] ."</td>";

            echo "<td>".$rowCashReceipt['date'] ."</td>";

            echo '<td>';
            if((($companyid16!="") || ($companyid16!=0)) && (($contactid16=="") || ($contactid16==0))) {
              $result15a=""; $found15a=0; $ctr15a=0;
              $result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid16", $dbh);
              if($result15a != "") {
                while($myrow15a = mysql_fetch_row($result15a)) {
                $found15a = 1;
                $company15a = $myrow15a[0];
                $branch15a = $myrow15a[1];
                }
              }
              $company15afin = $company15a;
              if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
              $company15afin2 = str_replace("'", "", $company15afin);
              echo "<b><u>$company15afin2</u></b>";
            }
            if((($companyid16=="") || ($companyid16==0)) && (($contactid16!="") || ($contactid16!=0))) {
              $result15b=""; $found15b=0; $ctr15b=0;
              $result15b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid16", $dbh);
              if($result15b != "") {
                while($myrow15b = mysql_fetch_row($result15b)) { 
                $found15b = 1;
                $companyid15b = $myrow15b[0];
                $employeeid15b = $myrow15b[1];
                $name_last15b = $myrow15b[2];
                $name_first15b = $myrow15b[3];
                $name_middle15b = $myrow15b[4];
                }
              }
              $contactname15bfin = $name_first15b;
              if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . " " . $name_middle15b[0] . "."; }
              if($name_last15b != "") { $contactname15bfin = $contactname15bfin . " " . $name_last15b; }
              $contactname15bfin2 = str_replace("'", "", $contactname15bfin);
                $contactname15bfin2 = stripslashes(htmlentities(utf8_decode($contactname15bfin2)));
              echo "<b><u>$contactname15bfin2</u></b>";
            }
            echo '</td>';

            // echo "<td>". $rowCashReceipt['particulars'] ."</td>";
            echo "<td>".str_replace("'", "", $rowCashReceipt['particulars'])."</td>";
            // echo "<td>". $rowCashReceipt['explanation'] ."</td>";
            echo "<td>".str_replace("'", "", $rowCashReceipt['explanation'])."</td>";
            if($beginningBalance < 0) { echo "<td class='text-right'>(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>"; }
            echo "<td class='text-right'>".number_format($rowCashReceipt['debitamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($rowCashReceipt['creditamt'],2) ."</td>";

            if(($row['glcode'] >= "10.00.000") && ($row['glcode'] <= "10.40.140")) {
              $beginningBalance += $rowCashReceipt['debitamt'];
              $beginningBalance -= $rowCashReceipt['creditamt'];
            }

            else if(($row['glcode'] >= "20.00.000") && ($row['glcode'] <= "50.10.400")) {
              // $beginningBalance += $rowCashReceipt['debitamt'];
              // $beginningBalance -= $rowCashReceipt['creditamt'];
              $beginningBalance -= $rowCashReceipt['debitamt'];
              $beginningBalance += $rowCashReceipt['creditamt'];
            }

            else if(($row['glcode'] >= "60.00.000") && ($row['glcode'] <= "72.00.000")) {
              // $beginningBalance += $rowCashReceipt['debitamt'];
              // $beginningBalance -= $rowCashReceipt['creditamt'];
              $beginningBalance -= $rowCashReceipt['debitamt'];
              $beginningBalance += $rowCashReceipt['creditamt'];
            }

            else if(($row['glcode'] >= "80.00.000") && ($row['glcode'] <= "90.00.000")) {
              $beginningBalance -= $rowCashReceipt['debitamt'];
              $beginningBalance += $rowCashReceipt['creditamt'];
            }

            if($beginningBalance < 0) { echo "<td class='text-right'>(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>";}
          echo "</tr>";
          $sumCashReceiptDebit = $sumCashReceiptDebit + $rowCashReceipt['debitamt'];
          $sumCashReceiptCredit = $sumCashReceiptCredit + $rowCashReceipt['creditamt'];
        }
        // disp cash receipt sub-total
        // echo "<tr><th colspan='6'>Sub-total for Cash Receipts</th><th class='text-right'>".number_format($sumCashReceiptDebit, 2)."</th><th class='text-right'>".number_format($sumCashReceiptCredit, 2)."</th><th></th></tr>";
          //endcashreceipt


        // 20210510
        // acctspayable
        $subAcctsPayable = "SELECT * FROM tblfinacctspayable WHERE date = \"".$date->format('Y-m-d')."\" AND glcode = '".$row['glcode']."' ORDER BY date ASC, acctspayablenumber ASC";
        $subAcctsPayableResult = $dbh2->query($subAcctsPayable);
// echo "<tr><td colspan='8'>$subAcctsPayable<br></td></tr>";
        while($rowAcctsPayable = $subAcctsPayableResult->fetch_assoc()) 
        {
          $companyid18 = $rowAcctsPayable['company_id'];
          $contactid18 = $rowAcctsPayable['contact_id'];
          echo "<tr>";
            echo "<td><a href='finvouchapview.php?loginid=".$loginid."&apn=".$rowAcctsPayable['acctspayablenumber']."' target=\"_blank\"><b>".$rowAcctsPayable['acctspayablenumber']."</b></a></td>";
            // echo "<td>".$rowAcctsPayable['acctspayablenumber'] ."</td>";

            echo "<td>".$rowAcctsPayable['date'] ."</td>";
            echo '<td>';
            if((($companyid18!="") || ($companyid18!=0)) && (($contactid18=="") || ($contactid18==0))) {
              $result18a=""; $found18a=0; $ctr18a=0;
              $res18aquery = "SELECT company, branch FROM tblcompany WHERE companyid=$companyid18";
              $result18a = $dbh2->query($res18aquery);
              if($result18a->num_rows>0) {
                while($myrow18a=$result18a->fetch_assoc()) {
                $found18a = 1;
                $company18a = $myrow18a['company'];
                $branch18a = $myrow18a['branch'];
                } //while
              } //if
              $company18afin = $company18a;
              if($branch18a!="") { $company18afin = $company18a . " - " . $branch18a; }
              $company18afin2 = str_replace("'", "", $company18afin);
              echo "<b><u>$company18afin2</u></b>";
            } //if
            if((($contactid18!="") || ($contactid18!=0)) && (($companyid18=="") || ($companyid18==0))) {
              $result18b=""; $found18b=0; $ctr18b=0;
              $res18bquery="SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid18";
              $result18b=$dbh2->query($res18bquery);
              if($result18b->num_rows>0) {
                while($myrow18b=$result18b->fetch_assoc()) {
                $found18b = 1;
                $companyid18b = $myrow18b['companyid'];
                $employeeid18b = $myrow18b['employeeid'];
                $name_last18b = $myrow18b['name_last'];
                $name_first18b = $myrow18b['name_first'];
                $name_middle18b = $myrow18b['name_middle'];
                } //while
              } //if
              $contactname18bfin = $name_first18b;
              if($name_middle18b != "") { $contactname18bfin = $contactname18bfin . " " . $name_middle18b[0] . "."; }
              if($name_last18b != "") { $contactname18bfin = $contactname18bfin . " " . $name_last18b; }
              $contactname18bfin2 = str_replace("'", "", $contactname18bfin);
                $contactname18bfin2 = stripslashes(htmlentities(utf8_decode($contactname18bfin2)));
              echo "<b><u>$contactname18bfin2</u></b>";
            }
            if($found18a==0 && $found18b==0) {
              echo "<b><u>".$rowAcctsPayable['payee']."</u></b>";
            } //if
            echo '</td>';

            // echo "<td>".$rowAcctsPayable['particulars'] ."</td>";
            echo "<td>".str_replace("'", "", $rowAcctsPayable['particulars']) ."</td>";
            // echo "<td>".str_replace("'", "", $rowAcctsPayable['explanation']) ."</td>";
            // echo "<td></td>";

        // query APV explanation in tblacctspayabletot
        $res19query=""; $result19=""; $found19=0;
        $res19query="SELECT explanation FROM tblfinacctspayabletot WHERE acctspayablenumber=\"".$rowAcctsPayable['acctspayablenumber']."\" LIMIT 1";
        $result19=$dbh2->query($res19query);
        if($result19->num_rows>0) {
            while($myrow19=$result19->fetch_assoc()) {
            $found19=1;
            $explanation19 = $myrow19['explanation'];
            } //while
        } //if
        if($found19==1 && $explanation19!="") {
        echo "<td>".str_replace("'", "", $explanation19) ."</td>";
        } else {
        echo "<td></td>";
        } //if-else


            if($beginningBalance < 0) { echo "<td class='text-right'>(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>"; }
            echo "<td class='text-right'>".number_format($rowAcctsPayable['debitamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($rowAcctsPayable['creditamt'],2) ."</td>";

            if(($row['glcode'] >= "10.00.000") && ($row['glcode'] <= "10.40.140")) {
              $beginningBalance += $rowAcctsPayable['debitamt'];
              $beginningBalance -= $rowAcctsPayable['creditamt'];
            }
            else if(($row['glcode'] >= "20.00.000") && ($row['glcode'] <= "20.10.209")) {
              // $beginningBalance += $rowAcctsPayable['debitamt'];
              // $beginningBalance -= $rowAcctsPayable['creditamt'];
              $beginningBalance -= $rowAcctsPayable['debitamt'];
              $beginningBalance += $rowAcctsPayable['creditamt'];
            } // 20.00.000 to 20.10.209
            else if($row['glcode'] == "20.10.210") {
              // $beginningBalance -= $rowAcctsPayable['debitamt'];
              // $beginningBalance += $rowAcctsPayable['creditamt'];
              $beginningBalance += $rowAcctsPayable['debitamt'];
              $beginningBalance -= $rowAcctsPayable['creditamt'];
            } // 20.10.210
            else if(($row['glcode'] >= "20.10.220") && ($row['glcode'] <= "50.10.400")) {
              // $beginningBalance += $rowAcctsPayable['debitamt'];
              // $beginningBalance -= $rowAcctsPayable['creditamt'];
              $beginningBalance -= $rowAcctsPayable['debitamt'];
              $beginningBalance += $rowAcctsPayable['creditamt'];
            } // 20.10.220 to 50.10.400
            else if(($row['glcode'] >= "60.00.000") && ($row['glcode'] <= "72.00.000")) {
              // $beginningBalance += $rowAcctsPayable['debitamt'];
              // $beginningBalance -= $rowAcctsPayable['creditamt'];
              $beginningBalance -= $rowAcctsPayable['debitamt'];
              $beginningBalance += $rowAcctsPayable['creditamt'];
            } // 20.10.220 to 50.10.400
            else if(($row['glcode'] >= "80.00.000") && ($row['glcode'] <= "90.00.000")) {
              $beginningBalance -= $rowAcctsPayable['debitamt'];
              $beginningBalance += $rowAcctsPayable['creditamt'];
            } // if - else if

            if($beginningBalance < 0) { echo "<td class='text-right'>(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>"; }
            
          echo "</tr>";
          $sumAcctsPayableDebit = $sumAcctsPayableDebit + $rowAcctsPayable['debitamt'];
          $sumAcctsPayableCredit = $sumAcctsPayableCredit + $rowAcctsPayable['creditamt'];
        } //while
        // disp accts payable sub-total
        // echo "<tr><th colspan='6'>Sub-total for Accounts Payable</th><th class='text-right'>".number_format($sumAcctsPayableDebit, 2)."</th><th class='text-right'>".number_format($sumAcctsPayableCredit, 2)."</th><th></th></tr>";
        // endacctspayable

          //JV
          $subJournal = "SELECT * FROM tblfinjournal WHERE date = \"".$date->format('Y-m-d')."\" AND glcode = '".$row['glcode']."' ORDER BY date ASC, journalnumber ASC";
        $subJournalResult = $dbh2->query($subJournal);

        while($rowJournal = $subJournalResult->fetch_assoc()) 
        {

          $companyid17 = $rowJournal['companyid'];
          $contactid17 = $rowJournal['contactid'];

          echo "<tr>";
            // echo "<td>".$rowJournal['journalnumber'] ."</td>";
            echo "<td><a href='finvouchjvview.php?loginid=".$loginid."&jvn=".$rowJournal['journalnumber']."' target=\"_blank\"><b>".$rowJournal['journalnumber']."</b></a></td>";

            echo "<td>".$rowJournal['date'] ."";
        // echo "<br>".$beginningBalance."|".$beginningBalanceCr."<br>".$getWorkingPaper."";
        echo "</td>";


            echo '<td>';
            if((($companyid17!="") || ($companyid17!=0)) && (($contactid17=="") || ($contactid17==0))) {
              $result15a=""; $found15a=0; $ctr15a=0;
              $result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid17", $dbh);
              if($result15a != "") {
                while($myrow15a = mysql_fetch_row($result15a)) {
                $found15a = 1;
                $company15a = $myrow15a[0];
                $branch15a = $myrow15a[1];
                }
              }
              $company15afin = $company15a;
              if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
              $company15afin2 = str_replace("'", "", $company15afin);
              echo "<b><u>$company15afin2</u></b>";
            }
            if((($companyid17!="") || ($companyid17!=0)) && (($contactid17=="") || ($contactid17==0))) {
              $result15b=""; $found15b=0; $ctr15b=0;
              $result15b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid17", $dbh);
              if($result15b != "") {
                while($myrow15b = mysql_fetch_row($result15b)) { 
                $found15b = 1;
                $companyid15b = $myrow15b[0];
                $employeeid15b = $myrow15b[1];
                $name_last15b = $myrow15b[2];
                $name_first15b = $myrow15b[3];
                $name_middle15b = $myrow15b[4];
                }
              }
              $contactname15bfin = $name_first15b;
              if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . " " . $name_middle15b[0] . "."; }
              if($name_last15b != "") { $contactname15bfin = $contactname15bfin . " " . $name_last15b; }
              $contactname15bfin2 = str_replace("'", "", $contactname15bfin);
                $contactname15bfin2 = stripslashes(htmlentities(utf8_decode($contactname15bfin2)));
              echo "<b><u>$contactname15bfin2</u></b>";
            }
            echo '</td>';

            // echo "<td>".$rowJournal['particulars'] ."</td>";
            echo "<td>".str_replace("'", "", $rowJournal['particulars'])."</td>";
            // echo "<td>".$rowJournal['explanation'] ."</td>";
            echo "<td>".str_replace("'", "", $rowJournal['explanation'])."</td>";

            if($beginningBalance < 0) { echo "<td class='text-right'>(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>";}
            echo "<td class='text-right'>".number_format($rowJournal['debitamt'],2) ."</td>";
            echo "<td class='text-right'>".number_format($rowJournal['creditamt'],2) ."</td>";

            if(($row['glcode'] >= "10.00.000") && ($row['glcode'] <= "10.40.140")) {
              $beginningBalance += $rowJournal['debitamt'];
              $beginningBalance -= $rowJournal['creditamt'];
            }

            else if(($row['glcode'] >= "20.00.000") && ($row['glcode'] <= "50.10.400")) {
/*                if($beginningBalance < 0) {
              $beginningBalance += $rowJournal['debitamt'];
                } else {

              $beginningBalance -= $rowJournal['debitamt'];
                } //if-else */
              // $beginningBalance += $rowJournal['debitamt'];
              // $beginningBalance -= $rowJournal['creditamt'];
              $beginningBalance -= $rowJournal['debitamt'];
              $beginningBalance += $rowJournal['creditamt'];
            }

            else if(($row['glcode'] >= "60.00.000") && ($row['glcode'] <= "72.00.000")) {
              // $beginningBalance += $rowJournal['debitamt'];
              // $beginningBalance -= $rowJournal['creditamt'];
              $beginningBalance -= $rowJournal['debitamt'];
              $beginningBalance += $rowJournal['creditamt'];
            }

            else if(($row['glcode'] >= "80.00.000") && ($row['glcode'] <= "90.00.000")) {
              $beginningBalance -= $rowJournal['debitamt'];
              $beginningBalance += $rowJournal['creditamt'];
            }

            if($beginningBalance < 0) { echo "<td class='text-right'>(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>".number_format($beginningBalance,2) ."</td>"; }
          echo "</tr>";
          $sumJournalDebit = $sumJournalDebit + $rowJournal['debitamt'];
          $sumJournalCredit = $sumJournalCredit + $rowJournal['creditamt'];
        }
        // disp JV sub-total
        // echo "<tr><th colspan='6'>Sub-total for Journal Vouchers</th><th class='text-right'>".number_format($sumJournalDebit, 2)."</th><th class='text-right'>".number_format($sumJournalCredit, 2)."</th><th></th></tr>";
          //END JV

          // compute AllTotal
          $allTotalDebit = $sumCashReceiptDebit+$sumDisbursementDebit+$sumJournalDebit+$sumAcctsPayableDebit;
          $allTotalCredit = $sumCashReceiptCredit+$sumDisbursementCredit+$sumJournalCredit+$sumAcctsPayableCredit;
		  

        //20230621 disp beg.balance if no other voucher entry
/*		if(($allTotalDebit==0 && $allTotalCredit==0) || ($allTotalDebit=='' && $allTotalCredit=='')) {
		echo "<tr><td colspan='4'></td>";
		// beginning balance
		    if($beginningBalance < 0) { echo "<td class='text-right'>1a|(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>1b|".number_format($beginningBalance,2) ."</td>"; }
		echo "<td></td><td></td>";
		// ending balance
		    if($beginningBalance < 0) { echo "<td class='text-right'>2a|(".number_format(abs($beginningBalance),2) .")</td>"; }
            else { echo "<td class='text-right'>2b|".number_format($beginningBalance,2) ."</td>"; }
		echo "</tr>";
		} //if */
		
   if($allTotalDebit!=0 && $allTotalCredit!=0) {
/*        // display AllTotal
          echo "<tr><td></td>";
            echo "<td colspan='4'><h3 style='font-size:18px; font-weight:700;'>".$date->format('Y-m-d')." TOTAL DEBIT/CREDIT</h3></td>";
            echo "<td colspan='1' class='text-right'><h3 style='font-size:18px; font-weight:700;'>".number_format($allTotalDebit,2)."</h3></td>";
            echo "<td colspan='1' class='text-right'><h3 style='font-size:18px; font-weight:700;'>".number_format($allTotalCredit,2)."</h3></td>";
          echo "<td></td></tr>"; */
          // compute grandTotal
          $grandTotalDebit = $allTotalDebit;
          $grandTotalCredit = $allTotalCredit;
          $pinakaTotalDebit += $allTotalDebit;
          $pinakaTotalCredit += $allTotalCredit;
    } //ifif($allTotalDebit!=0 && $allTotalCredit!=0)

    } //foreach


      } // if (isset($_POST["fromDate"]))


       echo "<tr>";
       echo "<td colspan='6'><h3 style='font-size:18px; font-weight:700;'>GRAND TOTAL: DEBIT/CREDIT</h3></td>";
       echo "<td colspan='1' class='text-right'><h3 style='font-size:18px; font-weight:700;'>".number_format($allTotalDebit,2)."</h3></td>";
       echo "<td colspan='1' class='text-right'><h3 style='font-size:18px; font-weight:700;'>".number_format($allTotalCredit,2)."</h3></td>";
	   echo "<td></td>";
       echo "</tr>";
      }

      ?>
      </tbody>
      </table>
      </div>



      <script>
        $(document).ready(function(){
            $('#fromDate').datepicker();
            $('#toDate').datepicker();
        });
      </script>
      </div>
      </div>
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


<script>
  $(document).ready(function(){
    $('#glcode').chosen();
  });
</script>
