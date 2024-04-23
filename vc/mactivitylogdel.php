<?php
// set get vars
$loginstat = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = trim((isset($_GET['sess'])) ? $_GET['sess'] :'');
$page = trim((isset($_GET['p'])) ? $_GET['p'] :'');

$hractlogid = $_POST['aid'];
$monsel = $_POST['ms'];
$cutmonth = $_POST['cm'];
// $idl = $_POST['idl'];
// echo "<h4>lst:$loginstat, lid:$loginid, sess:$session, p:$page, hractlogid:$hractlogid<br>$monsel,$cutmonth</h4>";
if($hractlogid!='') {
	// include '../m/qrymactlogdel.php';
	// db conn string
require '../includes/dbh.php';

	// delete query
	$res11query="DELETE FROM tblhractlog WHERE hractlogid=$hractlogid";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh->query($res11query);
	
		// query username and prep vars for ./m/qryinslog.php
		$res12aquery="";
		$res12aquery="SELECT username FROM tbllogin WHERE loginid=$loginid";
		// $res12aquery="SELECT `tblhractlog`.`loginid` AS loginid, `tbllogin`.`username` AS username FROM `tblhractlog` LEFT JOIN `tbllogin` ON `tblhractlog`.`loginid`=`tbllogin`.`loginid` WHERE `tblhractlog`.`hractlogid`=$hractlogid";
		$result12a=""; $found12a=0;
		$result12a=$dbh->query($res12aquery);
		if($result12a->num_rows>0) {
			while($myrow12a=$result12a->fetch_assoc()) {
				$found12a=1;
				$username12a = $myrow12a['username'];
			} // while
		} // if
		
	// create log
	$logdetails = "deleted activity log with id:$hractlogid for date:$datenow";
	// insert query
	// include '../m/qryinslog.php';
	$res12query="";
	$res12query="INSERT INTO tbllogs SET timestamp='$now', loginid=$loginid, username='$username12a', logdetails='$logdetails'";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh->query($res12query);
	// clear logdetails
	$logdetails="";

	} // if


// close database
$dbh->close();

if($result11) {

	// echo '<h4 class="modal-title" id="myModalLabel"><font color="green">Activity log saved</font></h4>';

} else {

	// echo '<h4 class="modal-title" id="myModalLabel"><font color="red">Error in saving activity log</font></h4>';

} // if 

// redirect
header("location:index.php?lst=1&lid=$loginid&sess=$session&p=14&ms=$monsel&cm=$cutmonth");
exit;
// echo "$loginid, $idl<br>$res11query<br>$res12aquery<br>$res12query<br>";
// echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=14&ms=$monsel&cm=$cutmonth\">back</a>";
?>
