<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$finbalshtrefid = $_GET['bsid'];

$tabpos = $_POST['tabpos'];
$acctname = trim($_POST['acctname']);
$seq = $_POST['seq'];
$glcodefr = trim($_POST['glcodefr']);
$glcodeto = trim($_POST['glcodeto']);
$visible = $_POST['visible'];
$section = $_POST['section'];
$sectotal = $_POST['sectotal'];
$normbal = $_POST['normbal'];
$glrefver = $_POST['glrefver'];

if($visible=="") { $visiblefin="off"; }
else if($visible=="on") { $visiblefin="on"; }

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

  // update glcode
    $result12 = mysql_query("UPDATE tblfinbalshtref SET timestamp=\"$now\", loginid=$loginid, tabpos=$tabpos, acctname=\"$acctname\", glcodefr=\"$glcodefr\", glcodeto=\"$glcodeto\", visible=\"$visiblefin\", glrefver=$glrefver, seq=$seq, section=$section, normbal=\"$normbal\", sectotal=$sectotal WHERE finbalshtrefid=$finbalshtrefid", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - balanche sheet account code modified. tab:$tabpos name:$acctname glcodes:$glcodefr-to-$glcodeto ver:$glrefver seq:$seq ctg:$section for PKII Voucher module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: mngfinbalshtref.php?loginid=$loginid&ver=$glrefver");
  exit;

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

