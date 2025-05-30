<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$acctspayablenumber = $_GET['apn'];
$duedate = $_GET['duedate'];
$payee = $_GET['payee'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");



  echo "<table style='width:60%;' class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th align='left' colspan=\"4\" align=\"center\">Accts Payable details</th></tr>";
  echo "<tr><td align='left' colspan=\"4\" align=\"center\"><font color=\"red\"><b>Making CV record.</td></tr>";
  echo "<tr><td align='left' colspan=\"4\" align=\"center\"><font color=\"red\"><b>AP NO: $acctspayablenumber.</td></tr>";
  echo "<tr><td align='left' colspan=\"4\" align=\"center\"><font color=\"red\"><b>Payee: $payee.</td></tr>";
  echo "<tr><td align='left' colspan=\"4\" align=\"center\"><font color=\"red\"><b>Due Date: $duedate.</td></tr>";
  echo "<tr>";
  echo "<td>Particulars</td>";
  echo "<td>Explanation</td>";
  echo "<td>Debit</td>";
  echo "<td>Credit</td>";
  echo "</tr>";
  $subCashReceipt = "SELECT * FROM tblfinacctspayable LEFT JOIN tblfinacctspayabletot ON tblfinacctspayable.acctspayablenumber = tblfinacctspayabletot.acctspayablenumber WHERE tblfinacctspayable.acctspayablenumber=\"$acctspayablenumber\"";
  $subCashReceiptResult = $dbh2->query($subCashReceipt);
  $TotalCredit = 0;
  $TotalDebit = 0;
  while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
  {

    if($rowCashReceipt['particulars'] == 'Accounts Payable Voucher'){
      echo '<tr>';
      echo "<td>".$rowCashReceipt['particulars'] ."</td>";
      echo "<td>".$rowCashReceipt['explanation'] ."</td>";
      echo "<td>".number_format($rowCashReceipt['creditamt'],2) ."</td>";
      echo "<td>".number_format($rowCashReceipt['debitamt'],2) ."</td>";
      echo '</tr>';
      $TotalCredit += $rowCashReceipt['creditamt'];
      $TotalDebit += $rowCashReceipt['creditamt'];
    }
  }
   echo '<tr>';
      echo "<td>";
      ?>
      <select id="glcodeSelect" name="glcodeSelect" class="form-control btn" style=' text-align: left; border: 1px solid #ddd;'>
          <option value="10.10.120">Cash in Bank</option>
          <option value="10.10.121">Cash in Bank-BPI </option>
          <option value="10.10.121.A">Cash in Bank-BPI CAPeso</option>
          <option value="10.10.121.B">Cash in Bank-BPI SAPeso</option>
          <option value="10.10.121.C">Cash in Bank-BPI SA$</option>
          <option value="10.10.121.D">Cash in Bank-BPI SAJPY</option>
          <option value="10.10.122.A">Cash in Bank-BOT CA Peso</option>
          <option value="10.10.122.B">Cash in Bank-BOT SA Peso</option>
          <option value="10.10.122.C">Cash in Bank-BOT SA$</option>
          <option value="10.10.122.D">Cash in Bank-BOT SAJPY</option>
          <option value="10.10.123.A">Cash in Bank-BDO CAPeso </option>
          <option value="10.10.123.B">Cash in Bank-BDO SA Peso</option>
          <option value="10.10.124.A">Cash in Bank-Mizuho CA Peso</option>
          <option value="10.10.124.B">Cash in Bank-Mizuho SA Peso</option>
          <option value="10.10.126">Cash in Bank-Other Banks</option>
       </select>

      <?php
      echo "</td>";
      echo "<td>".'Payment for Accounts Payable Voucher'."</td>";
      echo "<td>".number_format(0,2) ."</td>";
      echo "<td>".number_format($TotalDebit,2) ."</td>";
      echo '</tr>';


  echo "<tr>";
  echo "<td colspan='2'><b>Grand Total Debit/Credit:</b></td>";
  echo "<td><b>".number_format($TotalDebit,2)."</b></td>";
  echo "<td><b>".number_format($TotalCredit,2)."</b></td>";
  echo "</tr>";

  echo "<tr>";
  echo "<form method=\"post\" action=\"finvouchmakeccv.php?loginid=$loginid&apn=$acctspayablenumber\">";
  echo "<input type='hidden' id='totalcost' name='totalcost' value='".$TotalDebit."' />";
  echo "<td colspan = '2' align='center'>";
    echo "<label>CV NUMBER:</label> <input type='text' style='width: 50%; display:inline-block;' class='form-control' name='cvnumber' id='cvnumber' placeholder='Input CV Number'/>";

    ?>
      <input type="hidden" id="particular" name="particular">
      <input type="hidden" id="glcode" name="glcode" />
      <script>
        $(document).ready(function(){
            $('#glcodeSelect').on('change',function(){
              var glcode = $('#glcodeSelect option:selected').val();
              var particular = $('#glcodeSelect option:selected').text();
              $('#glcode').val(glcode);
              $('#particular').val(particular);
            });
        });
      </script>


    <?php
  echo "</td>";
  echo "<td colspan = '2' align='center'><input type=\"submit\" value=\"Yes\"></td></form></tr>";
  echo "</table>";


  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);
     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

