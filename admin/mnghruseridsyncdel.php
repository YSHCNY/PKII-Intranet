<?php 
//
// mnghruseridsyncdel.php //20210318
// fr mnghruseridsync.php
//
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhr701usrcrd = (isset($_POST['id'])) ? $_POST['id'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

// check if idhr701usrcrd exists
    $res11query=""; $result11=""; $found11=0;
    $res11query="SELECT idhr701usrcrd, uc_Addres, uc_Name, uc_UserID, fk_contactid, fk_employeeid FROM tblhr701usrcrd WHERE idhr701usrcrd=$idhr701usrcrd LIMIT 1";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
    while($myrow11=$result11->fetch_assoc()) {
    $found11=1;
    $idhr701usrcrd11 = $myrow11['idhr701usrcrd'];
    $uc_Addres11 = $myrow11['uc_Addres'];
    $uc_Name11 = $myrow11['uc_Name'];
    $uc_UserID11 = $myrow11['uc_UserID'];
    $fk_contactid11 = $myrow11['fk_contactid'];
    $fk_employeeid11 = $myrow11['fk_employeeid'];
    } //while
    } //if

    if($found11==1) {

    // delete record
    $res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="DELETE FROM tblhr701usrcrd WHERE idhr701usrcrd=$idhr701usrcrd AND uc_Addres=\"$uc_Addres11\"";
    $result14=$dbh2->query($res14query);

    // query tblhrattuserinfo record if exist, then clear fk contents
    $res15query=""; $result15=""; $found15=0;
    $res15query="SELECT hrattuserinfoid FROM tblhrattuserinfo WHERE fk_uc_ID=$idhr701usrcrd LIMIT 1";
    $result15=$dbh2->query($res15query);
    if($result15->num_rows>0) {
    while($myrow15=$result15->fetch_assoc()) {
    $found15=1;
    $hrattuserinfoid15 = $myrow15['hrattuserinfoid'];
    } //while
    } //if

    if($found15==1) {
        $res16query=""; $result16=""; $found16=0;
        // $res16query="UPDATE tblhrattuserinfo SET fk_uc_UserID=\"\", fk_uc_Addres=\"\", fk_uc_ID=0 WHERE hrattuserinfoid=$hrattuserinfoid15";
        // 20210701
        $res16query="DELETE FROM tblhrattuserinfo WHERE hrattuserinfoid=$hrattuserinfoid15";
        $result16=$dbh2->query($res16query);
    } //if

        // create log
    $adminlogdetails = "$loginid:$username - Deleted e-door userid:$idhr701usrcrd with uc_Addres:$uc_Addres11, uc_UserID:$uc_UserID11, cid:$fk_contactid11, eid:$fk_employeeid11";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
    $result17=$dbh2->query($res17query);

    } else {
    echo "<p><font color='red'>Record not found on door access. Pls try again.</font></p>";
    } //if

  // redirect
  header("Location: mnghruseridsync.php?loginid=$loginid");
  exit;
/*  echo "<p>f11:$found11, r11q:$res11query<br>";
  echo "f14:$found14, r14q:$res14query<br>";
  echo "f12:$found12, r12q:$res12query<br>";
  echo "f15:$found15, r16q:$res16query<br>";
  echo "r17q:$res17query</p>";
  echo "<p><a href='mnghrmod.php?loginid=$loginid' class='btn btn-default' role='button'>back</a></p>";
*/
//     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 

