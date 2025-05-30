<?php 

include("db1.php");
include('datetimenow.php');

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idemppayrollctg = (isset($_POST['idctg'])) ? $_POST['idctg'] :'';
$code = (isset($_POST['code'])) ? $_POST['code'] :'';
$name = (isset($_POST['name'])) ? $_POST['name'] :'';
$amount = (isset($_POST['amount'])) ? $_POST['amount'] :'';
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
  // include ("header.php");
  // include ("sidebar.php");

  if($accesslevel >= 4 && $idemppayrollctg!="") {
		// insert new record
    $res11query=""; $result11="";
    $res11query="UPDATE tblemppayrollctg SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, code=\"$code\", name=\"$name\", amount=$amount, remarks=\"$remarks\" WHERE idemppayrollctg=$idemppayrollctg";
    $result11=$dbh2->query($res11query);

    // create log
    $res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
    $result16=$dbh2->query($res16query);
    if($result16->num_rows>0) {
      while($myrow16=$result16->fetch_assoc()) {
      $adminuid16=$myrow16['adminuid'];
      } // while
    } // if
    $adminlogdetails = "$loginid:$adminuid16 - modified payroll rates category with id:$emppayrollctg - code:$code name:$name rate:$amount";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"";
    $result17=$dbh2->query($res17query);
  } // if

  // echo "<p><a href=\"businessedit.php?loginid=$loginid\">Back</a><br>";
	header("Location: mngfinpayrates.php?loginid=$loginid");
  exit;
   
  $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
  $result=$dbh2->query($resquery); 

  // include ("footer.php");
} else {
  include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
