<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

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

// check if wpacctcode and/or wpacctname exists
  $found11=0; $result11="";
  $result11 = mysql_query("SELECT acctname, glcodefr, glcodeto FROM tblfinbalshtref WHERE acctname=\"$acctname\" AND glrefver=$glrefver", $dbh);
  if($result11 != "")
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $acctname11 = $myrow11[0];
			$glcodefr11 = $myrow11[1];
			$glcodeto11 = $myrow11[2];
    }
  }

  if($found11 != 1) {
  // insert glcode
    $result12 = mysql_query("INSERT INTO tblfinbalshtref SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=\"$username\", tabpos=$tabpos, acctname=\"$acctname\", glcodefr=\"$glcodefr\", glcodeto=\"$glcodeto\", visible=\"$visiblefin\", glrefver=$glrefver, seq=$seq, section=$section, normbal=\"$normbal\", sectotal=$sectotal", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Add new balanche sheet account code: tab:$tabpos name:$acctname glcodes:$glcodefr-to-$glcodeto ver:$glrefver seq:$seq ctg:$section for PKII Voucher module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  } else {
  // display account exists error message
  }

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

