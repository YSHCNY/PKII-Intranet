<?php 

include("db1.php");
include("datetimenow.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$username = (isset($_POST['username'])) ? $_POST['username'] :'';
$password = (isset($_POST['password'])) ? $_POST['password'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';

if($yrmonthavlbl == '') {
  $selyear = $yearnow;
  $selmonth = date("F", mktime(0, 0, 0, $monthnow));
  $yrmonthavlbl = $selyear." ".$selmonth;
}

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

?>
<style>
  th, td{
    vertical-align: middle !important;
  }
</style>
<table>
  <tr>
    <td colspan="4">

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
  <div class="w-100  my-5 text-center gap-3">
      <h2 class="poppins text-black  fw-semibold m-0">PKII Working Paper</h2>
      <a href="#" id="exportToExcel">
        <i class="bi bi-file-earmark-arrow-down-fill fs-1"></i>
      </a>
  </div>
  <div class="my-4">
    <form action="finvouchworkplist.php?loginid=<?php echo $loginid; ?>" method="post" target="_self">
      <div class="d-flex align-items-center gap-3">
          <select name="yrmonthavlbl" class="poppins rounded-2 text-black" style="height: 34px; width: 250px">
            <option>Year-Month</option>
            <?php
            $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(month, '%Y %M') as yyyymonth FROM tblfinworkpaper WHERE workpaperid <> '' ORDER BY month DESC;", $dbh);
            while($myrow11 = mysql_fetch_row($result11)) {
              $found11 = 1;
              $yyyymonth = $myrow11[0];

              if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
              else { $yrmonthsel = ""; }
              ?>
                <option value="<?php echo $yyyymonth; ?>" <?php echo $yrmonthsel; ?>><?php echo $yyyymonth; ?></option>
              <?php
            }
            ?>
          </select>
          <input type="submit" value="Submit" class="poppins btn btn-success" style="height: 34px;">
        </div>
      </form>
    </div>

  <table id="ReportTable" class="table table-striped table-hover table-bordered poppins shadow">
    <tr>
      <th colspan="18" class=" fs-1 fw-semibold py-4">For the Month of <?php echo $yrmonthavlbl; ?></th>
    </tr>

<?php    

  $debitmonthtot = 0; $creditmonthtot = 0;

  ?>
  <tr>
      <th colspan="2" class="">Account</th>
      <th colspan="2" class="">Beginning Balance</th>
      <th colspan="2" class="">Cash Disbursement</th>
      <th colspan="2" class="">Accounts Payable</th>
      <th colspan="2" class="">Cash Receipt</th>
      <th colspan="2" class="">Journal Book</th>
      <th colspan="2" class="">Trial Balance</th>
      <th colspan="2" class="">Balance Sheet</th>
      <th colspan="2" class="">Income Statement</th>
  </tr>
  <tr>
      <td class=" fs-4 fw-semibold poppins">GL Code</td>
      <td class=" fs-4 fw-semibold poppins">GL Name</td>
      <td class=" fs-4 fw-semibold poppins">Debit</td>
      <td class=" fs-4 fw-semibold poppins">Credit</td>
      <td class=" fs-4 fw-semibold poppins">Debit</td>
      <td class=" fs-4 fw-semibold poppins">Credit</td>
      <td class=" fs-4 fw-semibold poppins">Debit</td>
      <td class=" fs-4 fw-semibold poppins">Credit</td>
      <td class=" fs-4 fw-semibold poppins">Debit</td>
      <td class=" fs-4 fw-semibold poppins">Credit</td>
      <td class=" fs-4 fw-semibold poppins">Debit</td>
      <td class=" fs-4 fw-semibold poppins">Credit</td>
      <td class=" fs-4 fw-semibold poppins">Debit</td>
      <td class=" fs-4 fw-semibold poppins">Credit</td>
      <td class=" fs-4 fw-semibold poppins">Debit</td>
      <td class=" fs-4 fw-semibold poppins">Credit</td>
      <td class=" fs-4 fw-semibold poppins">Debit</td>
      <td class=" fs-4 fw-semibold poppins">Credit</td>
  </tr>
  <?php  
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
    $res11query="SELECT DISTINCT workpaperid, month, glcode, glrefver, begbalancedr, begbalancecr, cashdisbursementdr, cashdisbursementcr, cashreceiptdr, cashreceiptcr, journaldr, journalcr, trialbalancedr, trialbalancecr, balancesheetdr, balancesheetcr, incomestatementdr, incomestatementcr, acctpayabledr, acctpayablecr FROM tblfinworkpaper WHERE workpaperid<>'' AND DATE_FORMAT(month, '%Y %M') = \"$yrmonthavlbl\" ORDER BY workpaperid ASC";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $ctr11++;
    $workpaperid11 = $myrow11['workpaperid'];
    $month11 = $myrow11['month'];
    $glcode11 = $myrow11['glcode'];
    $glrefver11 = $myrow11['glrefver'];
    $begbalancedr11 = $myrow11['begbalancedr'];
    $begbalancecr11 = $myrow11['begbalancecr'];
    $cashdisbursementdr11 = $myrow11['cashdisbursementdr'];
    $cashdisbursementcr11 = $myrow11['cashdisbursementcr'];
    $cashreceiptdr11 = $myrow11['cashreceiptdr'];
    $cashreceiptcr11 = $myrow11['cashreceiptcr'];
    $journaldr11 = $myrow11['journaldr'];
    $journalcr11 = $myrow11['journalcr'];
    $trialbalancedr11 = $myrow11['trialbalancedr'];
    $trialbalancecr11 = $myrow11['trialbalancecr'];
    $balancesheetdr11 = $myrow11['balancesheetdr'];
    $balancesheetcr11 = $myrow11['balancesheetcr'];
    $incomestatementdr11 = $myrow11['incomestatementdr'];
    $incomestatementcr11 = $myrow11['incomestatementcr'];
    $acctpayabledr11 = $myrow11['acctpayabledr'];
    $acctpayablecr11 = $myrow11['acctpayablecr'];

    $count1 = $count1 + 1;

    ?>
    <tr>
        <td class=" poppins"><?php echo $glcode11; ?></td>
    <?php
/*
    $result12 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode11\" AND version=\"$glrefver11\"", $dbh);
    if($result12 != '') {
      while($myrow12 = mysql_fetch_row($result12)) {
  $found12 = 1;
  $glname12 = $myrow12[0];
      } //while
    } //if
*/
// 20220725 new query fr tblfinglref to tblfinworkpaperref for acct name
    $res12query=""; $result12=""; $found12=0;
    $res12query="SELECT wpacctname FROM tblfinworkpaperref WHERE wpacctcd=\"$glcode11\" AND glrefver=2";
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
        while($myrow12=$result12->fetch_assoc()) {
          $found12=1;
          $wpacctname12 = $myrow12['wpacctname'];
        } //while
    } //if
      ?>
      <!-- <td class=" poppins"><?php echo $glname12; ?></td> -->
        <td class=" poppins"><?php echo $wpacctname12; ?></td>
        <td class=" poppins"><?php echo number_format($begbalancedr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($begbalancecr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($cashdisbursementdr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($cashdisbursementcr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($acctpayabledr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($acctpayablecr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($cashreceiptdr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($cashreceiptcr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($journaldr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($journalcr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($trialbalancedr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($trialbalancecr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($balancesheetdr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($balancesheetcr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($incomestatementdr11, 2); ?></td>
        <td class=" poppins"><?php echo number_format($incomestatementcr11, 2); ?></td>
      </tr>
      <?php
        } //while

    $res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT workpapertotid, begbalancedr, begbalancecr, cashdisbursementdr, cashdisbursementcr, cashreceiptdr, cashreceiptcr, journaldr, journalcr, trialbalancedr, trialbalancecr, balancesheetdr, balancesheetcr, incomestatementdr, incomestatementcr, balancesheetdrdiff, balancesheetcrdiff, incomestatementdrdiff, incomestatementcrdiff, balancesheetdrgrandtot, balancesheetcrgrandtot, incomestatementdrgrandtot, incomestatementcrgrandtot, status, remarks, acctpayabledrtot, acctpayablecrtot FROM tblfinworkpapertot WHERE DATE_FORMAT(month, '%Y %M') = \"$yrmonthavlbl\"";
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
        while($myrow14=$result14->fetch_assoc()) {
          $found14 = 1;
          $workpapertotid = $myrow14['workpapertotid'];
          $begbalancedrtot = $myrow14['begbalancedr'];
          $begbalancecrtot = $myrow14['begbalancecr'];
          $cashdisbursementdrtot = $myrow14['cashdisbursementdr'];
          $cashdisbursementcrtot = $myrow14['cashdisbursementcr'];
          $cashreceiptdrtot = $myrow14['cashreceiptdr'];
          $cashreceiptcrtot = $myrow14['cashreceiptcr'];
          $journaldrtot = $myrow14['journaldr'];
          $journalcrtot = $myrow14['journalcr'];
          $trialbalancedrtot = $myrow14['trialbalancedr'];
          $trialbalancecrtot = $myrow14['trialbalancecr'];
          $balancesheetdrtot = $myrow14['balancesheetdr'];
          $balancesheetcrtot = $myrow14['balancesheetcr'];
          $incomestatementdrtot = $myrow14['incomestatementdr'];
          $incomestatementcrtot = $myrow14['incomestatementcr'];
          $balancesheetdrdiff = $myrow14['balancesheetdrdiff'];
          $balancesheetcrdiff = $myrow14['balancesheetcrdiff'];
          $incomestatementdrdiff = $myrow14['incomestatementdrdiff'];
          $incomestatementcrdiff = $myrow14['incomestatementcrdiff'];
          $balancesheetdrgrandtot = $myrow14['balancesheetdrgrandtot'];
          $balancesheetcrgrandtot = $myrow14['balancesheetcrgrandtot'];
          $incomestatementdrgrandtot = $myrow14['incomestatementdrgrandtot'];
          $incomestatementcrgrandtot = $myrow14['incomestatementcrgrandtot'];
          $status14 = $myrow14['status'];
          $remarks14 = $myrow14['remarks'];
          $acctpayabledrtot = $myrow14['acctpayabledrtot'];
          $acctpayablecrtot = $myrow14['acctpayablecrtot'];
        } //while
    } //if
    ?>
      <tr>
        <th colspan="2" class="text-start poppins">Total</th>
        <th class=" poppins"><?php echo number_format($begbalancedrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($begbalancecrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($cashdisbursementdrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($cashdisbursementcrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($acctpayabledrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($acctpayablecrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($cashreceiptdrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($cashreceiptcrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($journaldrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($journalcrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($trialbalancedrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($trialbalancecrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($balancesheetdrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($balancesheetcrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($incomestatementdrtot, 2); ?></th>
        <th class=" poppins"><?php echo number_format($incomestatementcrtot, 2); ?></th>
      </tr>
      <tr>
        <td colspan="14">&nbsp;</td>
        <th class=" poppins"><?php echo number_format($balancesheetcrdiff, 2); ?></th>
        <th class=" poppins"><?php echo number_format($balancesheetdrdiff, 2); ?></th>
        <th class=" poppins"><?php echo number_format($incomestatementcrdiff, 2); ?></th>
        <th class=" poppins"><?php echo number_format($incomestatementdrdiff, 2); ?></th>
      </tr>
      <tr>
        <td colspan="14"></td>
        <th class=" poppins"><?php echo number_format($balancesheetdrtot - $balancesheetcrdiff, 2); ?></th>
        <th class=" poppins"><?php echo number_format($balancesheetcrtot + $balancesheetdrdiff, 2); ?></th>
        <th class=" poppins"><?php echo number_format($incomestatementdrtot + $incomestatementcrdiff, 2); ?></th>
        <th class=" poppins"><?php echo number_format($incomestatementcrtot - $incomestatementdrdiff, 2); ?></th>
      </tr>
    <?php
    } //if

  echo "</table>";
?>
    </td>
  </tr>
</table>

<div class="d-flex justify-content-end pt-5">
	<a href="<?php echo 'finvouchmain.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>

<?php
    $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery); 

    include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
