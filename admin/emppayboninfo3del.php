<?php
//
// emppayboninfo3del.php //20220506
// fr: emppayboninfo1.php
//

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$groupname = (isset($_GET['groupname'])) ? $_GET['groupname'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';

if($loginid != "") {
     include("logincheck.php");
} //if

if ($found == 1) {
// start contents here

    if($employeeid!='' && $groupname!='') {

        $res11query="DELETE FROM tblemppaybongrp WHERE groupname=\"$groupname\" AND employeeid=\"$employeeid\"";
        $result11=$dbh2->query($res11query);

        $res12query="DELETE FROM tblemppaybonus WHERE groupname=\"$groupname\" AND employeeid=\"$employeeid\"";
        $result12=$dbh2->query($res12query);

    } //if

    header( "Location: emppayboninfo1.php?loginid=$loginid&groupname=$groupname" );
    exit;

// end contents
} else {
     include ("logindeny.php");
} //if-else

?>
