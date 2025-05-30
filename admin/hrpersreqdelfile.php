<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpersreq = (isset($_GET['idhpr'])) ? $_GET['idhpr'] :'';
$idempfiles = (isset($_GET['idef'])) ? $_GET['idef'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

  // query tblempfiles
  $res11query = "SELECT idempfiles, filepath, filename, employeeid, contactid FROM tblempfiles WHERE idempfiles=$idempfiles";
  $result11=""; $found11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idempfiles11 = $myrow11['idempfiles'];
		$filepath11 = $myrow11['filepath'];
		$filename11 = $myrow11['filename'];
		$employeeid11 = $myrow11['employeeid'];
		$contactid11 = $myrow11['contactid'];
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	// verify and delete
	if($found11==1 && $idempfiles==$idempfiles11) {
    // delete file if exists
    if($filename11 != "") {
      $filetodelete = "$filepath11/$filename11";
      unlink("$filetodelete");
      // delete record from table
      $res12query = "DELETE FROM tblempfiles WHERE idempfiles=$idempfiles";
			$result12=""; $found12=0;
			$result12=$dbh2->query($res12query);
	    // insert log
	    $logdetails = "loginid:". $loginid . " deleted file from tblempfiles with idempfiles:$idempfiles empid:$employeeid11, contactid:$contactid11 from HR Personnel Request - Recruitment Process Monitoring module";
	    $res14query = "INSERT INTO tbllogs (timestamp, loginid, username, logdetails) VALUES (\"$now\", $loginid, \"$username\", \"$logdetails\")";
			$result14=""; $found14=0;
			$result14=$dbh2->query($res14query);
    } // if($filename11 != "")
	} // if($found11==1 && $idempfiles==$idempfiles11)

	// redirect
   header("Location: hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq");
   exit;

} else {
     include("logindeny.php");
}

$dbh2->close();
?>
