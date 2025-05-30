<?php 
//
// finvouchcrvdelfile.php 20250505
// fr:finvouchcrvnew.php
//
include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$cashreceipttotid = (isset($_GET['crvtid'])) ? $_GET['crvtid'] :'';
$crvnumber0 = (isset($_GET['crvn'])) ? $_GET['crvn'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

    // query
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
	$res11query="SELECT filepath, filename FROM tblfincashreceipttot WHERE cashreceipttotid=$cashreceipttotid AND cashreceiptnumber=\"$crvnumber0\"";
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
      $res12query = "UPDATE tblfincashreceipttot SET filepath=\"\", filename=\"\" WHERE cashreceipttotid=$cashreceipttotid AND cashreceiptnumber=\"$crvnumber0\"";
	  $result12=$dbh2->query($res12query);
    }

    // insert log
    $logdetails = "loginid:". $loginid . " removed attached file:$filepath11/$filename11 from Cash Receipt voucher no. $crvnumber0 totid:$cashreceipttotid";
	$res14query=""; $result14=""; $found14=0;
	$res14query="INSERT INTO tbllogs (timestamp, loginid, username, logdetails) VALUES (\"$now\", $loginid, \"$username\", \"$logdetails\")";
	$result14=$dbh2->query($res14query);

// redirect
   header("Location: finvouchcrvnew.php?loginid=".$loginid."&crvn=".$crvnumber0."");
   exit;
   // echo "<p>id:$cashreceipttotid|r11q:$res11query<br>r12q:$res12query<br><a href=\"finvouchcrvnew.php?loginid=".$loginid."&crvn=".$cvnumber0."\">back</a></p>";

} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
