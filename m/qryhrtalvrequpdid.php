<?php
//
// ./qryhrtalvrequpdid.php
// fr ./mhrlvfrmreq3.php
//
include '../includes/dbh.php';

  $res12query=""; $result12=""; $found12=0;
  $res12query="UPDATE tblhrtalvreq SET timestamp=\"$now\", loginid=$loginid, daysapproved=$daysapproved, approvectr=$apprctr, approvestamp=\"$now\", approverid=$loginid, approverempid=\"$employeeid0\", statusta=$statusta WHERE idhrtalvreq=$id";
  $result12=$dbh->query($res12query);

// close db conn
$dbh->close();
?>
