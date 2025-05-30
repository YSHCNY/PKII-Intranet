<?php 

include("db1.php");
include("datetimenow.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$wpgendate = (isset($_GET['gd'])) ? $_GET['gd'] :'';

$cutarrwpgendate = split("-", $wpgendate);
$wpgenyear = $cutarrwpgendate[0];
$wpgenmonth = $cutarrwpgendate[1];

if($wpgenmonth == "01" || $wpgenmonth == 1) { 
    $prevmonth = 12; 
    $prevyear = $wpgenyear-1; 
} else { 
    $prevmonth = $wpgenmonth-1; 
    $prevyear = $wpgenyear; 
}

$prevdate = $prevyear."-".$prevmonth."-"."1";

$result11 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
if($result11 != '') {
    while($myrow11 = mysql_fetch_row($result11)) {
        $found11 = 1;
        $version11 = $myrow11[0];
    }
}
$glrefver = $version11;

$found = 0;

if($loginid != "") {
    include("logincheck.php");
}  

if ($found == 1) {
    include ("header.php");
    include ("sidebar.php");
?>

<div class="shadow p-5">
     <h3 class=" text-black fw-semibold m-0">PKII Working Paper for <?php echo date('F (Y)', strtotime($wpgendate)); ?></h3>
   

</div>
<div class = 'shadow my-2 p-4 rounded'>
<h4  class=" fw-semibold">Beginning Balance Entries</h4>
<table class=" table table-bordered table-hover">


  <tr class = 'info'>

    <th class=" fw-medium">Code</th>
    <th class="fw-medium">Name</th>
    <th class=" fw-medium">Debit</th>
    <th class=" fw-medium">Credit</th>
  </tr>
  <tbody>

  <form action="finvouchworkpgen2run.php?loginid=<?php echo $loginid ?>&gd=<?php echo $wpgendate ?>" method="post">
  <?php
  if($glrefver == 1) {
      $result11 = mysql_query("SELECT wprefid, glcode, glrefver, status FROM tblfinworkpaperref WHERE glrefver=$glrefver", $dbh);
      if($result11 != "") {
          $count = 0;
          while($myrow11 = mysql_fetch_row($result11)) {
              $found11 = 1;
              $wprefid11 = $myrow11[0];
              $glcode11 = $myrow11[1];
              $glrefver11 = $myrow11[2];
              $count = $count + 1;
              ?>
                <tr>
                  <!-- <td class=" "><?php echo $count; ?></td> -->
                  <td class=" "><input class="hidden" name="glcode[]" value="<?php echo $glcode11; ?>" size="8" readonly><?php echo $glcode11; ?></td>
                  <td class=" ">
              <?php
              $result12 = mysql_query("SELECT glname FROM tblfinglref WHERE version=$glrefver AND glcode=\"$glcode11\"", $dbh);
              if($result12 != "") {
                  while($myrow12 = mysql_fetch_row($result12)) {
                      $glname12 = $myrow12[0];
                  }
              }

              $result15 = mysql_query("SELECT trialbalancedr, trialbalancecr FROM tblfinworkpaper WHERE month=\"$prevdate\" AND glcode=\"$glcode11\" AND glrefver=$glrefver", $dbh);
              if($result15 != '') {
                  while($myrow15 = mysql_fetch_row($result15)) {
                      $trialbalancedr15 = $myrow15[0];
                      $trialbalancecr15 = $myrow15[1];
                  }
              }
              ?>
                  <?php echo $glname12; ?>
                  </td>
                  <td class=" "><input class="debitamt" name="debitamt[]" value="<?php echo $trialbalancedr15; ?>"></td>
                  <td class=" "><input class="creditamt" name="creditamt[]" value="<?php echo $trialbalancecr15; ?>"></td>
                </tr>
              <?php
              $trialbalancedr15 = 0; 
              $trialbalancecr15 = 0;
          }
      }
  } else if($glrefver == 2) {

    $totbbdebit=0; 
    $totbbcredit=0;

    $result11 = mysql_query("SELECT DISTINCT wpacctcd, wpacctname, glrefver, status FROM tblfinworkpaperref WHERE glrefver=$glrefver ORDER BY wpacctcd ASC, seq ASC", $dbh);
    if($result11 != "") {
        $count = 0;
        while($myrow11 = mysql_fetch_row($result11)) {
            $found11 = 1;
            $wpacctcd11 = $myrow11[0];
            $wpacctname11 = $myrow11[1];
            $glrefver11 = $myrow11[2];
            $count = $count + 1;
            ?>
              <tr>

                <td class=" "><input class="hidden" name="wpacctcd[]" value="<?php echo $wpacctcd11; ?>" size="8" readonly><?php echo $wpacctcd11; ?></td>
                <td class=" ">
            <?php
            $result15 = mysql_query("SELECT trialbalancedr, trialbalancecr FROM tblfinworkpaper WHERE month=\"$prevdate\" AND glcode=\"$wpacctcd11\" AND glrefver=$glrefver", $dbh);
            if($result15 != '') {
                while($myrow15 = mysql_fetch_row($result15)) {
                    $trialbalancedr15 = $myrow15[0];
                    $trialbalancecr15 = $myrow15[1];
                }
            }
            ?>
              <?php echo $wpacctname11; ?>
              </td>
              <td class="debit-cell"><input class="debitamt" name="debitamt[]" value="<?php echo $trialbalancedr15; ?>" oninput="calculateTotal()"></td>
              <td class="credit-cell"><input class="creditamt" name="creditamt[]" value="<?php echo $trialbalancecr15; ?>" oninput="calculateTotal()"></td>
            </tr>
            <?php
            $totbbdebit = $totbbdebit + $trialbalancedr15;
            $totbbcredit = $totbbcredit + $trialbalancecr15;

            $trialbalancedr15 = 0; 
            $trialbalancecr15 = 0;
        }
    }
}
            ?>
            </tbody>
            <tfoot class = ''>
              <tr class = 'info'>
                <th colspan='2' class='text-left pl-5'>Total:</th>
                <th id='totalDebit' class=''><?php echo number_format($totbbdebit, 2); ?></th>
                <th id='totalCredit' class=''><?php echo number_format($totbbcredit, 2); ?></th>
              </tr>
              <tr>
              </tfoot>

              
<!-- <script>
    function calculateTotal() {
    let totalDebit = 0;
    let totalCredit = 0;

    // Loop through debit and credit inputs and sum their values
    document.querySelectorAll('.debitamt').forEach(input => {
        totalDebit += parseFloat(input.value) || 0;
    });
    document.querySelectorAll('.creditamt').forEach(input => {
        totalCredit += parseFloat(input.value) || 0;
    });




    // Update totals in the table
    document.getElementById('totalDebit').textContent = totalDebit.toFixed(2);
    document.getElementById('totalCredit').textContent = totalCredit.toFixed(2);

    if (totalDebit === totalCredit) {
            document.getElementById('totalDebit').style.backgroundColor = '';
            document.getElementById('totalCredit').style.backgroundColor = '';
        } else {
            document.getElementById('totalDebit').style.backgroundColor = 'red';
            document.getElementById('totalCredit').style.backgroundColor = 'red';
        }
    
}



</script> -->
            

<script>
    function calculateTotal() {
    let totalDebit = 0;
    let totalCredit = 0;

    // Loop through debit and credit inputs and sum their values
    document.querySelectorAll('.debitamt').forEach(input => {
        totalDebit += parseFloat(input.value) || 0;
    });
    document.querySelectorAll('.creditamt').forEach(input => {
        totalCredit += parseFloat(input.value) || 0;
    });


    // Update totals in the table
    document.getElementById('totalDebit').textContent = totalDebit.toFixed(2);
    document.getElementById('totalCredit').textContent = totalCredit.toFixed(2);
    
}



</script>
            




              
     
     
</table>
<div class="text-end">
<button type='submit' class='btn bg-success text-white  rounded-3'>Generate Working Paper</button>
</div>
             </form>
</div>


<div class="d-flex justify-content-end mt-4">
    <button class="border border-1 rounded-3" style="width: 12.5%; height: 40px; background-color: #0a1d44;">
        <a href="finvouchworkpgen.php?loginid=<?php echo $loginid ?>" class="text-white text-decoration-none  fw-medium fs-4">Back</a>
    </button>
</div>

<?php
$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
$result=$dbh2->query($resquery); 
include ("footer.php");

} else {
    include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>


<style>
    tfoot{
        position: sticky;
        bottom: 0;
        z-index: 1;
        height: 3em;

    }

    th{
        position: sticky;
        top: 3.6em;
        z-index: 1; 
    }

    td,th{
        text-align: center;
    }

    table{
        white-space: nowrap;
    }
</style>