<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$acctspayablenumber = $_GET['apn'];
$cvnumber = $_POST['cvnumber'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  $subCashReceipt = "SELECT * FROM tblfinacctspayable LEFT JOIN tblfinacctspayabletot ON tblfinacctspayable.acctspayablenumber = tblfinacctspayabletot.acctspayablenumber WHERE tblfinacctspayable.acctspayablenumber=\"$acctspayablenumber\"";
  $subCashReceiptResult = $dbh2->query($subCashReceipt);
  $TotalCredit = 0;
  $TotalDebit = 0;
  $explanation = '';
  $payor = '';
  $postGlcode = $_POST['glcode'];
  $projcode = '';
  $particulars = $_POST['particular'];
  $totalCost = $_POST['totalcost'];
  $explanation = '';
  echo "<h3>Successfully Created CV</h3>";
  echo "<form action=\"finvouchlist.php?loginid=$loginid\" method=\"post\">";
  echo "<input type=\"submit\" value=\"Go Back To List Vouchers\"></form>";
  $status = 'Done -'. $cvnumber;

  $result2 = mysql_query("UPDATE tblfinacctspayabletot SET status='".$status."' WHERE acctspayablenumber='".$acctspayablenumber."'", $dbh);


  while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
  {

    if($rowCashReceipt['particulars'] == 'Accounts Payable Voucher'){
    $result = mysql_query("INSERT INTO tblfindisbursement SET disbursementnumber='".$cvnumber."', disbursementtype='Check', payee='".$rowCashReceipt['payee']."', date='".date('Y-m-d')."', glcode='".$rowCashReceipt['glcode']."', glrefver='".$rowCashReceipt['glrefver']."', projcode='".$rowCashReceipt['projcode']."', particulars='".$rowCashReceipt['particulars']."', debitamt=".$rowCashReceipt['creditamt'].", creditamt=".$rowCashReceipt['debitamt'].", explanation='".$rowCashReceipt['explanation'].' - '.$acctspayablenumber."'", $dbh);
      $payor = $rowCashReceipt['payee'];
      $projcode = $rowCashReceipt['projcode'];
      $TotalCredit += $rowCashReceipt['creditamt'];
      $TotalDebit += $rowCashReceipt['creditamt'];
    }

    else{
      $explanation = $rowCashReceipt['explanation'].' - '. $acctspayablenumber;
    }
  }

  $result4 = mysql_query("INSERT INTO tblfindisbursement SET disbursementnumber='".$cvnumber."', disbursementtype='Check', payee='".$payor."', date='".date('Y-m-d')."', glcode='".$postGlcode."', glrefver='2', projcode='".$projcode."', particulars='".$particulars."', debitamt=0, creditamt=".$totalCost.", explanation='".$explanation."'", $dbh);


  $result3 = mysql_query("INSERT INTO tblfindisbursementtot SET disbursementnumber='".$cvnumber."', date='".date('Y-m-d')."', debittot=".$TotalCredit.", credittot=".$TotalDebit.", explanation='".$explanation."', status='pending'", $dbh);

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

