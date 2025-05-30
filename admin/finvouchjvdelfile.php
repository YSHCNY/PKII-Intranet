<?php 
//
// finvouchjvdelfile.php 20250505
// fr:finvouchjvnew.php
//
include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$journaltotid = (isset($_GET['jvtid'])) ? $_GET['jvtid'] :'';
$jvnumber0 = (isset($_GET['jvn'])) ? $_GET['jvn'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

    // query
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT filepath, filename FROM tblfinjournaltot WHERE journaltotid=$journaltotid AND journalnumber=\"$jvnumber0\"";
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
      $res12query = "UPDATE tblfinjournaltot SET filepath=\"\", filename=\"\" WHERE journaltotid=$journaltotid AND journalnumber=\"$jvnumber0\"";
	  $result12=$dbh2->query($res12query);
    }

    // insert log
    $logdetails = "loginid:". $loginid . " removed attached file:$filepath11/$filename11 from Journal voucher no. $jvnumber0 totid:$journaltotid";
	$res14query=""; $result14=""; $found14=0;
	$res14query="INSERT INTO tbllogs (timestamp, loginid, username, logdetails) VALUES (\"$now\", $loginid, \"$username\", \"$logdetails\")";
	$result14=$dbh2->query($res14query);

// redirect
   header("Location: finvouchjvnew.php?loginid=".$loginid."&jvn=".$jvnumber0."");
   exit;
   // echo "<p>id:$journaltotid|r11q:$res11query<br>r12q:$res12query<br><a href=\"finvouchjvnew.php?loginid=".$loginid."&jvn=".$jvnumber0."\">back</a></p>";

} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
