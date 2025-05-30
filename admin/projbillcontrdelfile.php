<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$contract_id = (isset($_GET['cid'])) ? $_GET['cid'] :'';
$proj_code = (isset($_GET['prjcd'])) ? $_GET['prjcd'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

  // query
  $res11query=""; $result11=""; $found11=0;
    $res11query = "SELECT contract_num, contract_filepath, contract_filename FROM tblcontract WHERE contract_id=$contract_id AND fk_projcode=\"$proj_code\"";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $contract_num11 = $myrow11['contract_num'];
        $filepath11 = $myrow11['contract_filepath'];
        $filename11 = $myrow11['contract_filename'];
        } //while
    } //if
    
    // delete file if exists
    if($filename11 != "") {
      $filetodelete = "$filepath11/$filename11";
      unlink("$filetodelete");
      // update datacenter table
        $res12query=""; $result12="";
      $res12query = "UPDATE tblcontract SET timestamp=\"$now\", contract_filepath=\"\", contract_filename=\"\" WHERE contract_id=$contract_id AND fk_projcode=\"$proj_code\"";
        $result12=$dbh2->query($res12query);
    } //if

    // insert log
    $logdetails = "loginid:". $loginid . " removed attached file from project contract with contract no. $contract_id:$contract_num11 and proj_cd: $proj_code with filename:$filepath11/$filename11";

    $res14query=""; $result14="";
    $res14query = "INSERT INTO tbladminlogs (timestamp, adminloginid, adminuid, adminlogdetails) VALUES (\"$now\", $loginid, \"$username\", \"$logdetails\")";
    $result14=$dbh2->query($res14query);

// redirect
   header("Location: projbillcontredt.php?loginid=$loginid&cid=$contract_id&prjid=$proj_code");
   exit;
// echo "<p>f11:$found11, r11q: $res11query<br>r12q: $res12query<br>r14q: $res14query</p>";
// echo "<p><a href='./projbillcontredt.php?loginid=$loginid&cid=$contract_id&prjid=$proj_code'>back</a></p>";

} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
