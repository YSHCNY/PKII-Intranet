<?php

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';
$dd1ticktyp = (isset($_POST['dd1ticktyp'])) ? $_POST['dd1ticktyp'] :'';
$dd2deptcd = (isset($_POST['dd2deptcd'])) ? $_POST['dd2deptcd'] :'';

if($yrmonthavlbl == '') {
  $selyear = $yearnow;
  $selmonth = date("F", mktime(0, 0, 0, $monthnow));
  $yrmonthavlbl = $selyear." ".$selmonth;
}
if($dd1ticktyp=='') { $dd1ticktyp="0"; }
if($dd2deptcd=='') { $dd2deptcd="ALL"; }

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

// validate again user's accesslevel
if(substr($level, -41, 1) == 1) {

	// display summary
	include("../vc/mhrpersreq.php");

} // if(substr($level, -41, 1) == 1)

// end contents here
?>
<div class="d-flex justify-content-end mt-5">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>
<?php
     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
