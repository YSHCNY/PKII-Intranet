<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idscheduler = (isset($_GET['idsc'])) ? $_GET['idsc'] :'';

$schedname = (isset($_POST['schedname'])) ? trim($_POST['schedname']) :'';
$datefrom = (isset($_POST['datefrom'])) ? $_POST['datefrom'] :'';
$dateto = (isset($_POST['dateto'])) ? $_POST['dateto'] :'';
$details = (isset($_POST['details'])) ? trim($_POST['details']) :'';
$recurring = (isset($_POST['recurring'])) ? $_POST['recurring'] :'';
$depts = (isset($_POST['depts'])) ? $_POST['depts'] :'';
$notifysw = (isset($_POST['notifysw'])) ? $_POST['notifysw'] :'';
$notifywhen = (isset($_POST['notifywhen'])) ? $_POST['notifywhen'] :'';
$notifywho = (isset($_POST['notifywho'])) ? $_POST['notifywho'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

if($schedname!='') {

	$datefrom = date("Y-m-d", strtotime($datefrom));
	$dateto = date("Y-m-d", strtotime($dateto));

	if($recurring=="on") {
		$recurringfin=1;
	} else { // if($recurring=="On")
		$recurringfin=0;
	} // if($recurring=="On")

	if(is_array($depts)) {
		$deptsfin='';
		foreach($depts as $val1 => $n1) {
			$deptsfin = $deptsfin . $depts[$val1] . "|";
		}
	} else { // if($depts=='Array')
		$deptsfin = $depts;
	} // if($depts=='Array')

	if($notifysw=="on") {
		$notifyswfin=1;
		$notifywhen = date("Y-m-d", strtotime($notifywhen));
		if (filter_var($notifywho, FILTER_VALIDATE_EMAIL)) {
  		$notifywhofin = "mailto:$notifywho";
		} else { // if (filter_var($notifywho, FILTER_VALIDATE_EMAIL))
  		$notifywhofin = "dept:$notifywho";
		} // if (filter_var($notifywho, FILTER_VALIDATE_EMAIL))
	} else { // if($notifysw=="On")
		$notifyswfin=0; $notifywhen=''; $notifywho='';
	} // if($notifysw=="On")

	$res12query="UPDATE tblscheduler SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, schedname=\"$schedname\", datefrom=\"$datefrom\", dateto=\"$dateto\", details=\"$details\", recurring=$recurringfin, deptcd=\"$deptsfin\", notifysw=$notifyswfin, notifywhen=\"$notifywhen\", notifywho=\"$notifywhofin\", displaywhere='', status='' WHERE idtblscheduler=$idscheduler";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);

	// echo "<p>vartest $res12query</p>";

		$adminlogdetails = "$loginid:$username - modify record in scheduler: $schedname $datefrom-to-$dateto recurring:$recurringfin deptcd:$deptsfin notify:$notifyswfin";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// echo "<p>vartest $res17query</p>";

} else { // if($schedname!='')

	// echo "<h2><font color=\"red\">Sorry scheduler name and date exist on record. Pls try a different name.</font></h2>";
	// echo "<p><a href=\"mngscheduler.php?loginid=$loginid\">back</a></p>";

} // if($schedname!='')


	// redirect
	header("Location: mngscheduler.php?loginid=$loginid");
	exit;
	// echo "<p><a href=\"mngscheduler.php?loginid=$loginid\">back</p>";

}
else
{
     include ("logindeny.php");
}

$dbh2->close();
?>
