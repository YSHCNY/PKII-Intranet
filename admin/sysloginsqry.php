<?php
//
// sysloginsqry.php
// 20210428
// req: $logdtl string

// require './dbh.php';
// include './datetimenow.php';

$resquery=""; $result=""; $syslog=0;
$resquery="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$logdtl\"";
$result=$dbh2->query($resquery);
if($result!='') {
    $syslog=1;
} else {
    $syslog=0;
} //if-else

?>
