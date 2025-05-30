<?php
//
// fr: ./qryhrtalvreqselid.php
// fr ./mhrlvfrmreq3.php
//
include '../includes/dbh.php';

  $res11query=""; $result11=""; $found11=0;
  $res11query="SELECT datelvreq, durationfrom, durationto, daysapproved, requestorid, employeeid, deptcd, reason, requestctr, approvectr, notedctr, requeststamp, approvestamp, notedstamp, approverid, approverempid, notedbyid, notedbyempid, comments, statusta, idhrtacutoff, idhrtaleavectg FROM tblhrtalvreq WHERE idhrtalvreq=$id LIMIT 1";
  $result11=$dbh->query($res11query);
  if($result11->num_rows>0) {
    while($myrow11=$result11->fetch_assoc()) {
    $found11=1;
    $datelvreq11 = $myrow11['datelvreq'];
    $durationfrom11 = $myrow11['durationfrom'];
    $durationto11 = $myrow11['durationto'];
    $daysapproved11 = $myrow11['daysapproved'];
    $requestorid11 = $myrow11['requestorid'];
    $employeeid11 = $myrow11['employeeid'];
    $deptcd11 = $myrow11['deptcd'];
    $reason11 = $myrow11['reason'];
    $requestctr11 = $myrow11['requestctr'];
    $approvectr11 = $myrow11['approvectr'];
    $notedctr11 = $myrow11['notedctr'];
    $requeststamp11 = $myrow11['requeststamp'];
    $approvestamp11 = $myrow11['approvestamp'];
    $notedstamp11 = $myrow11['notedstamp'];
    $approverid11 = $myrow11['approverid'];
    $approverempid11 = $myrow11['approverempid'];
    $notedbyid11 = $myrow11['notedbyid'];
    $notedbyempid11 = $myrow11['notedbyempid'];
    $comments11 = $myrow11['comments'];
    $statusta11 = $myrow11['statusta'];
    $idhrtacutoff11 = $myrow11['idhrtacutoff'];
    $idhrtaleavectg11 = $myrow11['idhrtaleavectg'];
    } // while
  } // if

// close db conn
$dbh->close();
?>
