<?php
session_start();
include 'header.php';
//
// mactivitylogupdtvd.php // 20200506
// fr: mactivitylog.php
// update query for estimated total man-hrs per day
//
require '../includes/dbh.php';



$lst = (isset($_GET['lst'])) ? $_GET['lst'] :''; // 1
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :''; // 14

$submitsw = (isset($_POST['submtmvaldly'])) ? $_POST['submtmvaldly'] :'';
if($submitsw==1) {
	$yyyymm = (isset($_POST['monsel'])) ? $_POST['monsel'] :'';
	$cutmonth = (isset($_POST['cutmonth'])) ? $_POST['cutmonth'] :'';
	$employeeid0 = (isset($_POST['eid'])) ? $_POST['eid'] :'';
	$timeval = (isset($_POST['timeval']) && is_array($_POST['timeval'])) ? $_POST['timeval'] : [];
	$logid = (isset($_POST['logid']) && is_array($_POST['logid'])) ? $_POST['logid'] : [];




	// prep cutoff date range
	$cutstart = $yyyymm."-"."01";
	if($cutmonth==0) {
		// whole month
	$cutstartarr = explode("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutend = date("Y-m-t", strtotime("$cutstart"));		
	$ctrcutoff=1;
	} elseif($cutmonth==1) {
		// 1st half 1-15
	$cutstartarr = explode("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutend = $cutstartyyyy . "-" . $cutstartmm . "-" . "15";		
	$ctrcutoff=1;
	} elseif($cutmonth==2) {
		// 2nd half 16-28/29/30/31
	$cutend = date("Y-m-t", strtotime("$cutstart"));
	$cutstartarr = explode("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutstart = $cutstartyyyy . "-" . $cutstartmm . "-" . "16";		
	$ctrcutoff=16;
	} //if-elseif
	echo "<div class = 'container'>";

	echo "<div class = 'p-4 border rounded-3 shadow my-5'>";
	echo "<h4 class = 'text-center'>Updating daily hours worked</h4>	";
	


	foreach ($logid as $index => $id) {
	


		$res12qry="UPDATE tblhractlog SET timestamp='$now', loginid=$loginid, timeval= {$timeval[$index]} WHERE employeeid='$employeeid0' AND hractlogid='$id'";
		$result12=$dbh->query($res12qry);
		$idinsert = mysqli_insert_id($dbh);
		

	}
$_SESSION['editsuccess']=true;

?>
<script type="text/javascript">
    // Capture the PHP session variables
    var lst = '<?php echo $lst; ?>';
    var loginid = '<?php echo $loginid; ?>';
    var session = '<?php echo $session; ?>';
    var page = '<?php echo $page; ?>';

    // Set the session name (for the session variable)

    // Redirect to the new location with parameters
    window.location.href = './index.php?lst=' + encodeURIComponent(lst) + 
                           '&lid=' + encodeURIComponent(loginid) + 
                           '&sess=' + encodeURIComponent(session) + 
                           '&p=' + encodeURIComponent(page);
</script>
<?php

	// foreach($timeval as $val) {

// echo "$cutstart - $cutend ->> $val <br> ";
		// echo "$val <-- time recs <br>";
		// // prep dates
		// $cutdate = "".$cutstartyyyy."-".$cutstartmm."-".$ctrcutoff."";
		// $cutdate = date('Y-m-d', strtotime($cutdate));
		// $msginfo="";
		// // query tblhractlog based on empid and dates
		// $res11qry=""; $result11=""; $found11=0; $ctr11=0;
		// $res11qry="SELECT hractlogid, timeval FROM tblhractlog WHERE employeeid='$employeeid0' AND date='$cutdate'";
		// $result11=$dbh->query($res11qry);
		// if($result11->num_rows>0) {
		// 	while($myrow11=$result11->fetch_assoc()) {
		// 		$found11=1;
		// 		$ctr11++;
		// 		$hractlogid11=$myrow11['hractlogid'];
		// 		$timeval11=$myrow11['timeval'];
		// 		if($timeval11!=$val) {
			
		// 		} else {
		// 			// no change
		// 			$msginfo="empID: <span class = 'fw-bold fs-4'>$employeeid0</span>  
		// 			 on: <span class = 'fw-bold fs-4'>$cutdate</span>  $timeval11 no change.";
		// 		} //if
		// 	} //while
		// } //if


	// 	echo "$hractlogid11 $cutdate<br> $res11qry <br>";
	// 	if($val!='') {
	// 		$val=sprintf("%.2f", $val);
	// 		echo "tf is this $val";
	// 	$res12qry=""; $result12=""; $found12=0; $idinsert="";
	// 	$res12qry="UPDATE tblhractlog SET timestamp='$now', loginid=$loginid, timeval=$val WHERE employeeid='$employeeid0' AND date='$cutdate'";
	// 	$result12=$dbh->query($res12qry);
	// 	$idinsert = mysqli_insert_id($dbh);
	// 	echo "$res12qry <br>";

	// 	} //if

	// 	if($result12!='') {
	// 	$msginfo="empID: <span class = 'fw-bold fs-4'>$employeeid0</span> <br>
	// 	 on: <span class = 'fw-bold fs-4'>$cutdate</span> 
	// 	 old:$timeval11 to new:$val > <font color='green'>record/s updated.</font>";
	// 	} else {
	// 	$msginfo="empID: <span class = 'fw-bold fs-4'>$employeeid0</span>  
	// 	 on: <span class = 'fw-bold fs-4'>$cutdate</span> 
	// 	 old:$timeval11 to new:$val > <font color='red'>error in updating record/s.</font>";
	// 	} //if

	// 	// echo "$res11qry";

	// 	if($found11==0) {
	// 		// no change
	// 		$msginfo="empID: <span class = 'fw-bold fs-4'>$employeeid0</span>  
	// 		 on: <span class = 'fw-bold fs-4'>$cutdate</span>  No activity found  no update (pls add an activity log first).";
	// 	} //if
	// 	if($msginfo!='') { 
			
	// 		echo "<p class = 'fs-4'>". $msginfo."</p>";
	
		
		
	// 	}
	// 	// // echo "".date('Y-m-d', strtotime($cutdate))." - ".$val."<br />".$res11qry."<br /><br />";
	// 	// $ctrcutoff++;
	// } //foreach

	echo "<form action='./index.php?lst=$lst&lid=$loginid&sess=$session&p=$page' class = 'text-end' method='POST' name='index_mactivitylog'>";
// echo "<input type='hidden' name='ms_get' value='$yyyymm'>";
// echo "<input type='hidden' name='cm_get' value='$cutmonth'>";
echo "<input type='hidden' name='monsel' value='$yyyymm'>";
echo "<input type='hidden' name='cutmonth' value='$cutmonth'>";
echo "<input type='hidden' name='eid' value='$employeeid0'>";
echo "<button type='submit' class='btn btn-success' name='submbckmactlog' value='1'>Back</button>";
echo "</form>";


	echo "</div>";
	echo "</div>";
	// create log
	$logdetails = "Updated man-hrs of daily time values for eid:$employeeid0 cutoff:$cutstart-to-$cutend";
	include '../m/qryusernm.php';
	if($username11!='') { $username0 = $username11; }
	include '../m/qryinslog.php';
	
	}

//if

// echo "<p>test $lst, $loginid, $session, $page";
//echo "<br>$submitsw, $yyyymm, $cutmonth, $employeeid0, $timeval, $cutstart -to- $cutend";
// echo "</p>";



$dbh->close();
?>