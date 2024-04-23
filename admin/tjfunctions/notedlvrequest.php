<?php
//
// notedlvrequest.php
// fr ../mngotrequest.php

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$action = (isset($_POST['id'])) ? $_POST['id'] :'';
$idlv = (isset($_POST['lvid'])) ? $_POST['lvid'] :'';

include("../db1.php");

$found=0;

if($loginid != "") {
     include("../logincheck.php");
}
// echo "<p>id:$loginid,idlv:$idlv,f:$found</p>";

if ($found == 1) {
     include ("../addons.php");
//     include ("../header.php");
//     include ("../sidebar.php");

$resquery="UPDATE tblhrtalvreq SET timestamp='$now', loginid=$loginid, notedctr=1, notedstamp='$now', notedbyid=$loginid, notedbyempid='$employeeid0', statusta=3 WHERE idhrtalvreq=".$idlv."";
$result=$dbh2->query($resquery);

// $result = mysql_query("UPDATE tblhrtalvreq SET timestamp='$now', loginid=$loginid, notedctr=1, notedstamp='$now', notedbyid=$loginid, notedbyempid='$employeeid0', statusta=3 WHERE idhrtalvreq=".$action, $dbh);
// mysql_close($dbh);

  // insert log
  $logdetails="Leave request with id:$idlv has been NOTED by id:$loginid, empid:$employeeid0";
  $res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
  $result16=$dbh2->query($res16query);

echo "<p>res:$resquery</p>";
echo "<h4 class='text-success'>Noted!</h4>";
echo "<p><a href='../mngotrequest.php?loginid=$loginid' class='btn btn-light'>back</a></p>";

} // if

$dbh2->close();
?>