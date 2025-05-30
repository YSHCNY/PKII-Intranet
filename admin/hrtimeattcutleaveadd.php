<?php 
// 20180908 hrtimeattcutleaveadd.php
require("db1.php");
include("datetimenow.php");



function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Store the random string in a variable
$randomString = generateRandomString();

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
// $idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$leavedate = (isset($_POST['leavedate'])) ? $_POST['leavedate'] :'';
$endleave = (isset($_POST['endleave'])) ? $_POST['endleave'] :'';
$idleavectg = (isset($_POST['idleavectg'])) ? $_POST['idleavectg'] :'';
$leavedur = (isset($_POST['leavedur'])) ? $_POST['leavedur'] :'';
$reason = (isset($_POST['reason'])) ? $_POST['reason'] :'';
$noform = (isset($_POST['noform'])) ? $_POST['noform'] :'';




$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

// start contents here


	// query paygroup, cutoff and empid if exists
	$res14query="SELECT * FROM tblhrtapaygrp INNER JOIN tblhrtacutoff ON tblhrtapaygrp.idtblhrtapaygrp=tblhrtacutoff.idhrtapaygrp INNER JOIN tblhrtapaygrpemplst ON tblhrtacutoff.idhrtapaygrp=tblhrtapaygrpemplst.idtblhrtapaygrp WHERE tblhrtapaygrp.idtblhrtapaygrp=$idpaygroup AND tblhrtapaygrpemplst.employeeid=\"$employeeid\" LIMIT 1";
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		} // while
	} // if

	// start deletion
if($found14==1) {

	// query paygroupname
	$res11query="SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idpaygroup";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$paygroupname11 = $myrow11['paygroupname'];
		} // while
	} // if

	
	// query leavename
	$res14query="SELECT * FROM tblhrtaleavectg WHERE idhrtaleavectg=$idleavectg";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		$name14 = $myrow14['name'];
		$lcode = $myrow14['code'];
		} // while
	} // if


	// insert to leavesaver


	$current_date = new DateTime($leavedate);
	$end_date = new DateTime($endleave);
	if ($lcode == 'hdv' || $lcode == 'hds' || $lcode == 'hdob'){
	$minusday = 0.5;
	} else {
	$minusday = 1.0;

	}


	while ($current_date <= $end_date) {
		// Check if the current day is a weekday (Monday-Friday)
		$day_of_week = $current_date->format('N'); // 'N' gives day of the week (1 = Monday, 7 = Sunday)
	
		if ($lcode == "ob" || $day_of_week < 6) {
			$log_date = $current_date->format('Y-m-d');
			$res124query = "INSERT INTO leavesaver (leavestart, leaveend, leavedays, count, leaveid, leavecode, empid, grpid, identifier) 
							VALUES ('$leavedate', '$endleave', '$log_date', '$minusday', '$idleavectg', '$lcode', '$employeeid', '$idpaygroup', '$randomString')";
			$result124 = $dbh2->query($res124query);
		}
		
		// Move to the next date
		$current_date->modify('+1 day');
		
	}

	if ($noform == 1){
 $res21423query = "SELECT *
    FROM leavesaver 
    WHERE leavestart = '$leavedate' 
    AND leaveend = '$endleave'";

$result21423 = $dbh2->query($res21423query);
echo "<br> $res21423query<br> ";

$log_dates = []; 

if ($result21423->num_rows > 0) {
    while ($myrow21423 = $result21423->fetch_assoc()) {
        $log_dates[] = $myrow21423['leavedays'];
    }
} 

foreach ($log_dates as $date) {
   echo "<br> $date <br> ";
    $inserttracker = "UPDATE tblhrtaemptimelog SET coltrack = 1 WHERE logdate = '$date' AND employeeid = '$employeeid'";
    $inserttrackerquery = $dbh2->query($inserttracker);
    if ($dbh2->query($inserttracker) === TRUE) {
      
        echo "Record UPDATE successfully from tblhrtaemptimelog <br>";

      
            } else {
                        

        echo "Error UPDATE record from tblhrtaemptimelog: " . $dbh2->error . "<br>";

        
      
        
            }

} 
	
	}
	

	// insert to leavesaver

	
	// echo "'$leavedate', '$endleave', '$log_date', '$minusday',";

		$res12query=""; $result12=""; $found12=0;
		$res12query = "UPDATE tblemployee
SET 
    vacation = CASE 
        WHEN '$lcode' = 'hdv' THEN vacation - $leavedur
        WHEN '$lcode' = 'vacation' THEN vacation - $leavedur 
        ELSE vacation 
    END,
    sick = CASE 
        WHEN '$lcode' = 'hds' THEN sick - $leavedur
        WHEN '$lcode' = 'sick' THEN sick - $leavedur 
        ELSE sick 
    END,
    paternity = CASE 
        WHEN '$lcode' = 'paternity' THEN paternity - $leavedur 
        ELSE paternity 
    END,
    maternityn = CASE 
        WHEN '$lcode' = 'maternityn' THEN maternityn - $leavedur 
        ELSE maternityn 
    END,
    maternityc = CASE 
        WHEN '$lcode' = 'maternityc' THEN maternityc - $leavedur 
        ELSE maternityc 
    END,
    special = CASE 
        WHEN '$lcode' = 'special' THEN special - $leavedur 
        ELSE special 
    END
WHERE 
    employeeid = $employeeid
    AND '$lcode' IN ('vacation', 'sick', 'paternity', 'maternityn', 'special', 'maternityc', 'hdv', 'hds')";

echo "$lcode, $leavedur, $employeeid";
session_start();
	if($dbh2->query($res12query)=== TRUE){
		
$message = "Success! New Leave Added!";
$_SESSION['success_message'] = $message;
header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
	} else {
				
$message = "Something's Wrong";
$_SESSION['warning_message'] = $message;
header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");

	}
	// $res123query="INSERT INTO tblhrtaempleavechglog SET 
	// timestamp=\"$now\", 
	// loginid=$loginid, 
	// datecreated=\"$now\", 
	// createdby=$loginid, 
	// paygroupname=\"$paygroupname11\", 
	// employeeid=\"$employeeid\", 
	// leavedate='$leavedate', 
	// leaveenddate = '$endleave',
	// leavename=\"$name14\", 
	// leaveduration=\"$leavedur\", 
	// reason=\"$reason\", 
	// idhrtaleavectg=$idleavectg ";
	// $result123=$dbh2->query($res123query);
$statusta = 1;
$apprctr = 1;

	$res123query="INSERT INTO tblhrtalvreq 
	SET timestamp = '$now', 
    loginid = '$loginid', 
    datecreated = '$now', 
    daysapproved = '$leavedur', 
    approvectr = '$apprctr', 
    statusta = '$statusta', 
    approverid = '$loginid', 
    approverempid = '$employeeid0',  
    createdby = '$loginid', 
    paygroupname = '$paygroupname11', 
    employeeid = '$employeeid', 
    durationfrom = '$leavedate', 
    durationto = '$endleave', 
    leavename = '$name14', 
    reason = '$reason', 
    idhrtaleavectg = '$idleavectg',
	approvestamp = '$now'";
	$result123=$dbh2->query($res123query);

	

	// idhrtacutoff=$idcutoff

	// create log
    // include('datetimenow.php');
    $res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid LIMIT 1";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$adminuid=$myrows16['adminuid'];
			} // while
		} // if
    $adminlogdetails = "$loginid:$adminuid HR-TAL: Add leave entry empid: , paygrp: , cutoff: , leavedt: , leavetyp: , leavedur: ";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);

} // if


// echo "<p><a href=\"hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid\">back</a></p>";
	// redirect
  header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid");


  exit;
	//

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result=$dbh2->query($resquery);

//     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
