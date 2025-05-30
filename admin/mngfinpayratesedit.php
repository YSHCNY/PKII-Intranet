<?php 
// mngfinpayratesedit.php //20240917
// fr mngfinpayrates.php
require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idemppayrollctg = (isset($_GET['idctg'])) ? $_GET['idctg'] :'';

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
    if($idemppayrollctg!="") {
		
      // query tblemppayrollctg based on id
      $res11qry=""; $result11=""; $found11=0; // $ctr11=0;
      $res11qry="SELECT idemppayrollctg, code, name, amount, remarks FROM tblemppayrollctg WHERE idemppayrollctg=$idemppayrollctg";
      $result11=$dbh2->query($res11qry);
      if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        // $ctr11=$ctr11+1;
        // $idemppayrollctg11 = $myrow11['idemppayrollctg'];
        $code11 = $myrow11['code'];
        $name11 = $myrow11['name'];
        $amount11 = $myrow11['amount'];
        $remarks11 = $myrow11['remarks'];
        } // while
      } // if

    if($found11==1) {
      echo "<form action=\"mngfinpayratesedit2.php?loginid=$loginid\" method=\"POST\" name=\"mngfinpayratesedit2\">";
	  echo "<input type='hidden' name=\"idctg\" value=\"$idemppayrollctg\">";
      echo "<tr><th colspan=\"2\" class='text-right'>code</th><td colspan=\"3\">";
      echo "<div class='form-group'><input type=\"text\" name=\"code\" class='form-control' value=\"$code11\"></div>";
      echo "</td></tr>";
      echo "<tr><th colspan=\"2\" class='text-right'>name</th><td colspan=\"3\">";
      echo "<div class='form-group'><input type=\"text\" size=\"50\" name=\"name\" class='form-control' value=\"$name11\"></div>";
      echo "</td></tr>";
      echo "<tr><th colspan=\"2\" class='text-right'>rate</th><td colspan=\"3\">";
      echo "<div class='form-group'><input name=\"amount\" value=\"$amount11\" class='form-control'></div>";
      echo "</td></tr>";
      echo "<tr><th colspan=\"2\" class='text-right'>remarks</th><td colspan=\"3\">";
      echo "<div class='form-group'><textarea rows=\"3\" cols=\"50\" name=\"remarks\" class='form-control'>$remarks11</textarea></div>";
      echo "</td></tr>";
      echo "<tr><td colspan=\"2\" class=\"text-center\"></td><td colspan=\"3\"><button type=\"submit\" class=\"btn btn-success\">Save</button></td></tr>";
      echo "</form>";
	} //if($found11==1)
	} //if($idemppayrollctg!="")


  } // if($accesslevel >= 4)
?>
      </table></td></tr>
    </table>
<?php
// end contents here...

// edit body-footer
    echo "<p><a href=\"./mngfinpayrates.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     // include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?> 
