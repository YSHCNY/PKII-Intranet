<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
  echo "<p><font size=1>Manage >> Accounting Modules >> Payroll rates</font></p>";

// start contents here...
  if($accesslevel >= 4) {
?>
  <table class="table table-bordered">
  <thead>
    <tr><th colspan="8" class="bg-secondary text-white text-center">Payroll rates fixed values</th></tr>
  </thead>
  <tbody>
    <tr><td colspan="8">
      <table class="table table-bordered">
      <!-- <tr><th colspan="2" class="bg-secondary text-white">Add code</th></tr> -->
<?php
      echo "<form action=\"mngfinpayratesadd.php?loginid=$loginid\" method=\"POST\" name=\"mngfinpayratesadd\">";
      echo "<tr><th colspan=\"2\" class='text-right'>code</th><td colspan=\"3\">";
      echo "<input type=\"text\" name=\"code\">";
      echo "</td></tr>";
      echo "<tr><th colspan=\"2\" class='text-right'>name</th><td colspan=\"3\">";
      echo "<input type=\"text\" size=\"50\" name=\"name\">";
      echo "</td></tr>";
      echo "<tr><th colspan=\"2\" class='text-right'>amount</th><td colspan=\"3\">";
      echo "<input name=\"amount\" value=\"0.00\">";
      echo "</td></tr>";
      echo "<tr><th colspan=\"2\" class='text-right'>remarks</th><td colspan=\"3\">";
      echo "<textarea rows=\"3\" cols=\"50\" name=\"remarks\"></textarea>";
      echo "</td></tr>";
      echo "<tr><td colspan=\"2\" class=\"text-center\"></td><td colspan=\"3\"><button type=\"submit\" class=\"btn btn-success\">Add category</button></td></tr>";
      echo "</form>";
      // display headers
      echo "<tr><th>code</th><th>name</th><th>amount</th><th>remarks</th><th>action</th></tr>";
      // query tblemppayrollctg
      $res11qry=""; $result11=""; $found11=0; $ctr11=0;
      $res11qry="SELECT idemppayrollctg, code, name, amount, remarks FROM tblemppayrollctg ORDER BY idemppayrollctg DESC";
      $result11=$dbh2->query($res11qry);
      if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $ctr11=$ctr11+1;
        $idemppayrollctg11 = $myrow11['idemppayrollctg'];
        $code11 = $myrow11['code'];
        $name11 = $myrow11['name'];
        $amount11 = $myrow11['amount'];
        $remarks11 = $myrow11['remarks'];
        echo "<tr><td>$code11</td><td>$name11</td><td>$amount11</td><td>$remarks11</td>";
        echo "<td><button class=\"btn btn-danger\"><a href=\"mngfinpayratesdel.php?loginid=$loginid&idctg=$idemppayrollctg11\">Del</a></button></td>";
        echo "</tr>";
        } // while
      } // if

  } // else
?>
      </table></td></tr>
    </table>
<?php
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
