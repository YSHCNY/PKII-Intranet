<?php 
//
// mnghruseridsyncupd.php //20210308
// fr mnghruseridsync.php
//
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhr701usrcrd = (isset($_POST['id'])) ? $_POST['id'] :'';
$contactid = (isset($_POST['cID'])) ? $_POST['cID'] :'';

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

    // query employeeid
    $res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid AND contact_type=\"personnel\" LIMIT 1";
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
    while($myrow14=$result14->fetch_assoc()) {
    $found14=1;
    $employeeid14 = $myrow14['employeeid'];
    $name_last14 = $myrow14['name_last'];
    $name_first14 = $myrow14['name_first'];
    $name_middle14 = $myrow14['name_middle'];
    $att_name = $name_first14."&nbsp;".$name_last14;

        if($found14==1) {

        // update queries
        $res12query=""; $result12=""; $found12=0;
        $res12query="UPDATE tblhr701usrcrd SET timestamp=\"$now\", loginid=$loginid, fk_contactid=$contactid, fk_employeeid=\"$employeeid14\" WHERE idhr701usrcrd=$idhr701usrcrd";
        $result12=$dbh2->query($res12query);

        $res15query=""; $result15=""; $found15=0;
        $res15query="SELECT hrattuserinfoid, att_userid, att_badgenumber, att_name, employeeid FROM tblhrattuserinfo WHERE employeeid=\"$employeeid14\" LIMIT 1";
        $result15=$dbh2->query($res15query);
        if($result15->num_rows>0) {
        while($myrow15=$result15->fetch_assoc()) {
        $found15=1;
        $hrattuserinfoid15 = $myrow15['hrattuserinfoid'];
        $att_userid15 = $myrow15['att_userid'];
        $att_badgenumber15 = $myrow15['att_badgenumber'];
        $att_name15 = $myrow15['att_name'];
        $employeeid15 = $myrow15['employeeid'];
        } //while
        } //if

        $res16query=""; $result16=""; $found16=0;
        if($found15==1 && $employeeid15==$employeeid14) {
            // update query
            $res16query="UPDATE tblhrattuserinfo SET timestamp=\"$now\", loginid=$loginid, fk_uc_UserID=\"$uc_UserID11\", fk_uc_Addres=\"$uc_Addres11\", fk_uc_ID=$idhr701usrcrd11 WHERE hrattuserinfoid=$hrattuserinfoid15 AND employeeid=\"$employeeid14\"";
        } else {
            // insert query
            $att_userid15=0;
            $res16query="INSERT INTO tblhrattuserinfo SET timestamp=\"$now\", loginid=$loginid, att_userid=$uc_UserID11, att_badgenumber=\"$employeeid14\", att_name=\"$att_name\", att_title=\"\", att_gender=\"\", employeeid=\"$employeeid14\", fk_uc_UserID=\"$uc_UserID11\", fk_uc_Addres=\"$uc_Addres11\", fk_uc_ID=$idhr701usrcrd11";
            // $res16query="INSERT INTO tblhrattuserinfo SET timestamp=\"$now\", loginid=$loginid, att_userid=$uc_UserID11, att_badgenumber=\"$employeeid14\", att_name=\"$att_name\", att_title=\"\", att_gender=\"\", employeeid=\"$employeeid14\"";
        } //if
        $result16=$dbh2->query($res16query);

        // create log
    $adminlogdetails = "$loginid:$username - Matched e-door userid:$idhr701usrcrd (fr cid:$fk_contactid11, eid:$fk_employeeid11, ucUID:$uc_UserID11:tblhr701usrcrd, attUID:$att_userid15:tblhrattuserinfo) to HR Masterlist contactid:$contactid with employeeid:$employeeid14 - $name_last14, $name_first14 $name_middle14";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
    $result17=$dbh2->query($res17query);

        } else {
        echo "<p><font color='red'>Record not found on HR masterlist. Pls try again.</font></p>";
        } //if-else

    } //while
    } //if

    } else {
    echo "<p><font color='red'>Record not found on door access. Pls try again.</font></p>";
    } //if

  // redirect
  header("Location: mnghruseridsync.php?loginid=$loginid");
  exit;
  /* echo "<p>f11:$found11, r11q:$res11query<br>";
  echo "f14:$found14, r14q:$res14query<br>";
  echo "f12:$found12, r12q:$res12query<br>";
  echo "f15:$found15, r16q:$res16query<br>";
  echo "r17q:$res17query</p>";
  echo "<p><a href='mnghrmod.php?loginid=$loginid' class='btn btn-default' role='button'>back</a></p>"; */

//     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 

