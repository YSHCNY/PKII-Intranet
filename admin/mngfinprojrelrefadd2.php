<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$code = (isset($_POST['code'])) ? $_POST['code'] :'';
// $name = $_POST['name'];
$companytyp = (isset($_POST['companytyp'])) ? $_POST['companytyp'] :'';
$companyid = (isset($_POST['companyid'])) ? $_POST['companyid'] :'';
$companynamemanual = (isset($_POST['companynamemanual'])) ? $_POST['companynamemanual'] :'';
$tablevel = (isset($_POST['tablevel'])) ? $_POST['tablevel'] :'';
$seq = (isset($_POST['seq'])) ? $_POST['seq'] :'';
$nkconso = (isset($_POST['nkconso'])) ? $_POST['nkconso'] :'';
$codeprev = (isset($_POST['codeprev'])) ? $_POST['codeprev'] :'';
$strvssht = (isset($_POST['strvssht'])) ? $_POST['strvssht'] :'';
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';

// echo "<p>vartest code:$code, companytyp:$companytyp, companyid:$companyid, companynamemanual:$companynamemanual</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

// start contents here

	// check companyid and code first if exists before adding
	if($companyid!=0) {
	$res11query="SELECT projrelrefid FROM tblprojrelref WHERE code=\"$code\" OR companyid=$companyid";
	} else {
	$res11query="SELECT projrelrefid FROM tblprojrelref WHERE code=\"$code\"";
	} // if
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11+1;
		$projrelrefid11 = $myrow11['projrelrefid'];
		} // while
	} // if

// echo "<p>f11:$found11, qry:$res11query</p>";

	if($found11 == 1) {
	// stop

	echo "<p><h2><font color=\"red\">Sorry, code or companyid exists.</font></h2></p>";
	echo "<p><a href=\"mngfinprojrelref.php?loginid=$loginid\">back</a></p>";

	} else if($found11 == 0) {
	// continue

	if($companytyp=='dropdown') {

	$res12query="SELECT company FROM tblcompany WHERE companyid=$companyid";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$company12 = $myrow12['company'];
		} // while
	} // if

	} else if($companytyp=="manual") {

	$company12=$companynamemanual;
	$companyid=0;

	} // if

  $res14query = "INSERT INTO tblprojrelref SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", code=\"$code\", name=\"$company12\", companyid=$companyid, level=$tablevel, seq=$seq, nkconso=$nkconso, codeprev=\"$codeprev\", strvssht=\"$strvssht\", remarks=\"$remarks\"";
	$result14=$dbh2->query($res14query);

// create log
    // include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - added new project relationship with details: $code - $company12, compid:$companyid, level:$level, seq:$seq, nkconso:$nkconso, codeprev:$codeprev, strvssht:$strvssht, remarks:$remarks";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);

	} // if

	// echo "<p>test qry:$res14query</p>";

  header("Location: mngfinprojrelref.php?loginid=$loginid");
  exit;

// end contents here

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result=$dbh2->query($resquery);

//     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
