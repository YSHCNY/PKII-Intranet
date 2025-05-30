<?php 
//
// finvouchcvdelfile.php 20250430
// fr:finvouchcvnew.php
//
include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$disbursementtotid = (isset($_GET['dtid'])) ? $_GET['dtid'] :'';
$disbursementnumber = (isset($_GET['cvn'])) ? $_GET['cvn'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

    // query
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT filepath, filename FROM tblfindisbursementtot WHERE disbursementtotid=$disbursementtotid AND disbursementnumber=\"$disbursementnumber\"";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1; $ctr11++;
			$filepath11 = $myrow11['filepath'];
			$filename11 = $myrow11['filename'];
		} //while
	} //if
    
    // delete file if exists
    if($filename11 != "") {
      $filetodelete = "$filepath11/$filename11";
      unlink("$filetodelete");
      // update datacenter table
	  $res12query=""; $result12=""; $found12=0;
      $res12query = "UPDATE tblfindisbursementtot SET filepath=\"\", filename=\"\" WHERE disbursementtotid=$disbursementtotid AND disbursementnumber=\"$disbursementnumber\"";
	  $result12=$dbh2->query($res12query);
    }

    // insert log
    $logdetails = "loginid:". $loginid . " removed attached file:$filepath11/$filename11 from Disbursement voucher no. $disbursementnumber totid:$disbursementtotid";
	$res14query=""; $result14=""; $found14=0;
	$res14query="INSERT INTO tbllogs (timestamp, loginid, username, logdetails) VALUES (\"$now\", $loginid, \"$username\", \"$logdetails\")";
	$result14=$dbh2->query($res14query);

// redirect
   header("Location: finvouchcvnew.php?loginid=".$loginid."&cvn=".$disbursementnumber."");
   exit;

} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
