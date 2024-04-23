<?php 

// finvouchapchgexpla.php
// crea 20211122 after receiving info fr ACBellen where no edit explanation function on APV
// fr finvouchapnew.php

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$apnumber = trim((isset($_GET['apvn'])) ? $_GET['apvn'] :'');
$apdate = trim((isset($_GET['apvdt'])) ? $_GET['apvdt'] :'');

$found = 0;

if($loginid != "") {
	include("logincheck.php");
}
?>

<script language="JavaScript" src="ts_picker.js"></script>  

<?php
if ($found == 1) {
	include ("header.php");
  include ("sidebar.php");

// start contents here

    // query explanation from tblfinacctspayabletot
    $res11query=""; $result11=""; $found11=0;
    // $res11query = "SELECT acctspayabletotid, explanation FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\" AND date=\"$apdate\"";
    $res11query = "SELECT acctspayabletotid, explanation FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\"";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11 = 1;
	$acctspayabletotid11 = $myrow11['acctspayabletotid'];
	$explanation11 = $myrow11['explanation'];
        } //while
    } //if

    // query payee from tblfinacctspayable
    $res11bquery=""; $result11b=""; $found11b=0;
    $res11bquery="SELECT acctspayableid, payee FROM tblfinacctspayable WHERE acctspayablenumber=\"$apnumber\" LIMIT 1";
    $result11b=$dbh2->query($res11bquery);
    if($result11b->num_rows>0) {
        while($myrow11b=$result11b->fetch_assoc()) {
        $found11b=1;
        $acctspayableid11b = $myrow11b['acctspayableid'];
        $payee11b = $myrow11b['payee'];
        } //while
    } //if

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Accts Payable Voucher - modify explanation</th></tr>";
	echo "<form action=\"finvouchapchgexpla2.php?loginid=$loginid&apn=$apnumber&apdt=$apdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td><b>$apdate</b></td></tr>";
	echo "<tr><th align=\"right\">A.P.Voucher no.</th><td><b>$apnumber</b></td></tr>";
	echo "<tr><th align=\"right\">Payee</th><td><b>$payee11b</b></td></tr>";
	echo "<tr><th align=\"right\">Explanation|f11:$found11|f11b:$found11b</th><td><textarea rows=\"4\" cols=\"60\" name=\"explanation\">$explanation11</textarea></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><button type=\"submit\" class=\"btn btn-success\">Submit</button></td></tr>";
	echo "</form>";
  echo "</table>";

  echo "<p><a href=\"finvouchapnew.php?loginid=$loginid&apn=$apnumber&apdt=$apdate\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
