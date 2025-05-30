<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$contract_id = (isset($_GET['cid'])) ? $_GET['cid'] :'';
$contractinvoice_id = (isset($_GET['ciid'])) ? $_GET['ciid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

  // query
  $res11query=""; $result11=""; $found11=0;
    $res11query = "SELECT contractinvoice_num, contractinvoice_filepath, contractinvoice_filename FROM tblcontractinvoice WHERE contractinvoice_id=$contractinvoice_id AND fk_contract_id=$contract_id";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $contractinvoice_num11 = $myrow11['contractinvoice_num'];
        $filepath11 = $myrow11['contractinvoice_filepath'];
        $filename11 = $myrow11['contractinvoice_filename'];
        } //while
    } //if
    
    // delete file if exists
    if($filename11 != "") {
      $filetodelete = "$filepath11/$filename11";
      unlink("$filetodelete");
      // update datacenter table
        $res12query=""; $result12="";
      $res12query = "UPDATE tblcontractinvoice SET timestamp=\"$now\", contractinvoice_filepath=\"\", contractinvoice_filename=\"\" WHERE contractinvoice_id=$contractinvoice_id AND fk_contract_id=$contract_id";
        $result12=$dbh2->query($res12query);
    } //if

    // insert log
    $logdetails = "loginid:". $loginid . " removed attached file from project contract with invoice no. $contractinvoice_id:$contractinvoice_num11 and contractid: $contract_id with a filename:$filepath11/$filename11";

    $res14query=""; $result14="";
    $res14query = "INSERT INTO tbladminlogs (timestamp, adminloginid, adminuid, adminlogdetails) VALUES (\"$now\", $loginid, \"$username\", \"$logdetails\")";
    $result14=$dbh2->query($res14query);

// redirect
   header("Location: projbillinvedt.php?loginid=$loginid&cid=$contract_id&ciid=$contractinvoice_id");
   exit;
// echo "<p>f11:$found11, r11q: $res11query<br>r12q: $res12query<br>r14q: $res14query</p>";
// echo "<p><a href='./projbillinvedt.php?loginid=$loginid&cid=$contract_id&ciid=$contractinvoice_id'>back</a></p>";

} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
