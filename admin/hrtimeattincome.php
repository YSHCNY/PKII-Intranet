<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$pyrllpage = (isset($_GET['frm'])) ? $_GET['frm'] :'';
$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

?>
<?php
// edit body-header

 

// start contents here...

  if($accesslevel >= 4) {


	// display header
	include("hrtimeattincomeadd.php");


  } // endif accesslevel >= 4

// end contents here...



// edit body-footer

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
