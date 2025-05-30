<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$idtblemppassport = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

  // query
	$res11query = "SELECT filepath, filename FROM tblemppassport WHERE idtblemppassport=$idtblemppassport AND employeeid=\"$employeeid\"";
  $result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
  if($result11->num_rows>0) {
    while($myrow11 = $result11->fetch_assoc()) {
    $found11 = 1;
    $filepath11 = $myrow11['filepath'];
    $filename11 = $myrow11['filename'];
    } 
  }
    
  // delete file if exists
  if($filename11 != "") {
    $filetodelete = "$filepath11/$filename11";
    unlink("$filetodelete");
    // update datacenter table
    $result12 = mysql_query("UPDATE tblemppassport SET timestamp=\"$now\", filepath=\"\", filename=\"\" WHERE idtblemppassport=$idtblemppassport AND employeeid=\"$employeeid\"", $dbh);
  }

  // insert log
  $logdetails = "loginid:". $loginid . " removed attached file from empid:$employeeid, file:$filepath11/$filename11";

  $result14 = mysql_query("INSERT INTO tbllogs (timestamp, loginid, username, logdetails) VALUES (\"$now\", $loginid, \"$username\", \"$logdetails\")", $dbh);

	// redirect
  header("Location: personnelpassportedt.php?loginid=$loginid&eid=$employeeid&idpp=$idtblemppassport");
  exit;

} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
