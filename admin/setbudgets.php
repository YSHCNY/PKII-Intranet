<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$projcode = $_POST['pid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("addons.php");
     include ("header.php");
     include ("sidebar.php");


     

    // edit body-header
     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";

     $result11 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code = '".$projcode."'", $dbh);
      while ($myrow11 = mysql_fetch_row($result11))
      {
        $projfname = $myrow11[1];
        $projsname = $myrow11[2];
        $projfname2 = $projfname.' '.$projsname;
      } 

      echo "<h3>".$projcode." - ".$projfname2."</h3>";

     echo "<form action=\"projectreports.php?loginid=$loginid\" method=\"post\" name=\"form1\" id=\"form1\">";
     echo "<input type='hidden' name='pid' value='".$projcode."'/>";

     echo "<table class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>";
     echo "<thead>";
      echo "<th>Account Name</th>";
      echo "<th>Account Code from/to</th>";
      echo "<th>Budget Debit</th>";
     echo "</thead>";
     $resquery = "SELECT * from tblfinprojinsecondary WHERE status='1' ORDER BY acctcode_from ASC";
     $result = $dbh2->query($resquery);
    
     while($myrow = $result->fetch_assoc()) {
       echo "<tr>";
        echo "<td>".$myrow['secondary_account_name']."</td>";
        echo "<td>".$myrow['acctcode_from'].' - '.$myrow['acctcode_to']."</td>";
        $resqueryBudget = "SELECT * from tblfinprojincomestatement WHERE proj_code='".$projcode."' AND fk_projinsecondary_id =".$myrow['projinsecondary_id'];
            $resultBudget = $dbh2->query($resqueryBudget);
            if($resultBudget->num_rows > 0){
              while($myrowBudget = $resultBudget->fetch_assoc()) {
                $budgetDebit = $myrowBudget['budget_debit'];
                $budgetCredit = $myrowBudget['budget_credit'];
              } 
            } 
            else{
              $budgetCredit = 0;
              $budgetDebit = 0;
            }
            echo '<td colspan="1">';
            echo "<input type='text' name='budgetdebit[".$myrow['projinsecondary_id']."]' class='form-control txtNumber' value='".number_format($budgetDebit,2)."'/>";
            echo '</td>';
       echo "</tr>";
     } 
     ?>
     <script>
       $(document).ready(function(){
        $('body').delegate('.txtNumber','focus',function(){
          var value = $(this);
          value.val('');
        });
       });
     </script>

    
      <?php 
      echo "</table>";
      echo "<button type='submit' class='btn btn-success'>Submit</button>";
     echo '</form>';

     echo "<form action=\"projectreports.php?loginid=$loginid\" method=\"post\">";
     echo "<input type='hidden' name='pid' value='".$projcode."'/>";
      echo "<button type='submit' class='btn btn-warning'>Back</button>";
     echo '</form>';

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
