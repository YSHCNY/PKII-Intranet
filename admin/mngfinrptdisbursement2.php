<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$rfplabel = $_POST['rfplabel'];
$rfppreparedlbl = $_POST['rfppreparedlbl'];
$rfpcheckedlbl = $_POST['rfpcheckedlbl'];
$rfpprepared = $_POST['rfpprepared'];
$rfpchecked = $_POST['rfpchecked'];
$rfppreparedpos = $_POST['rfppreparedpos'];
$rfpcheckedpos = $_POST['rfpcheckedpos'];
$rfpapprovedlbl = $_POST['rfpapprovedlbl'];
$rfpapproved = $_POST['rfpapproved'];
$rfpapprovedpos = $_POST['rfpapprovedpos'];
$cvlabel = $_POST['cvlabel'];
$cvpreparedlbl = $_POST['cvpreparedlbl'];
$cvcheckedlbl = $_POST['cvcheckedlbl'];
$cvprepared = $_POST['cvprepared'];
$cvchecked = $_POST['cvchecked'];
$cvpreparedpos = $_POST['cvpreparedpos'];
$cvcheckedpos = $_POST['cvcheckedpos'];
$cvapproved1lbl11 = $_POST['cvapproved1lbl'];
$cvapproved2lbl11 = $_POST['cvapproved2lbl'];
$cvapproved1 = $_POST['cvapproved1'];
$cvapproved2 = $_POST['cvapproved2'];
$cvapproved1pos = $_POST['cvapproved1pos'];
$cvapproved2pos = $_POST['cvapproved2pos'];
$remarks = $_POST['remarks'];

$found = 0;
$found11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// update template
  if($accesslevel >= 3)
  {
    $result11 = mysql_query("SELECT rptdisbursementid FROM tblfinrptdisbursement", $dbh);
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$rptdisbursementid11 = $myrow11[0];
      }

    if($found11 == 1)
    {
      $result12 = mysql_query("UPDATE tblfinrptdisbursement SET
	rfplabel=\"$rfplabel\",
	rfppreparedlbl=\"$rfppreparedlbl\",
	rfpcheckedlbl=\"$rfpcheckedlbl\",
	rfpprepared=\"$rfpprepared\",
	rfpchecked=\"$rfpchecked\",
	rfppreparedpos=\"$rfppreparedpos\",
	rfpcheckedpos=\"$rfpcheckedpos\",
	rfpapprovedlbl=\"$rfpapprovedlbl\",
	rfpapproved=\"$rfpapproved\",
	rfpapprovedpos=\"$rfpapprovedpos\",
	cvlabel=\"$cvlabel\",
	cvpreparedlbl=\"$cvpreparedlbl\",
	cvcheckedlbl=\"$cvcheckedlbl\",
	cvprepared=\"$cvprepared\",
	cvchecked=\"$cvchecked\",
	cvpreparedpos=\"$cvpreparedpos\",
	cvcheckedpos=\"$cvcheckedpos\",
	cvapproved1lbl=\"$cvapproved1lbl11\",
	cvapproved2lbl=\"$cvapproved2lbl11\",
	cvapproved1=\"$cvapproved1\",
	cvapproved2=\"$cvapproved2\",
	cvapproved1pos=\"$cvapproved1pos\",
	cvapproved2pos=\"$cvapproved2pos\",
	remarks=\"$remarks\"
      WHERE rptdisbursementid = $rptdisbursementid11", $dbh);
    }
    else
    {
      $result12 = mysql_query("INSERT INTO tblfinrptdisbursement (rfplabel, rfppreparedlbl, rfpcheckedlbl, rfpprepared,	rfpchecked, rfppreparedpos, rfpcheckedpos, rfpapprovedlbl, rfpapproved, rfpapprovedpos, cvlabel, cvpreparedlbl, cvcheckedlbl, cvprepared, cvchecked, cvpreparedpos, cvcheckedpos, cvapproved1lbl, cvapproved2lbl, cvapproved1, cvapproved2, cvapproved1pos, cvapproved2pos, remarks) VALUES (\"$rfplabel\", \"$rfppreparedlbl\", \"$rfpcheckedlbl\", \"$rfpprepared\", \"$rfpchecked\", \"$rfppreparedpos\", \"$rfpcheckedpos\", \"$rfpapprovedlbl\", \"$rfpapproved\", \"$rfpapprovedpos\", \"$cvlabel\", \"$cvpreparedlbl\", \"$cvcheckedlbl\", \"$cvprepared\", \"$cvchecked\", \"$cvpreparedpos\", \"$cvcheckedpos\", \"$cvapproved1lbl11\", \"$cvapproved2lbl11\", \"$cvapproved1\", \"$cvapproved2\", \"$cvapproved1pos\", \"$cvapproved2pos\", \"$remarks\")", $dbh);
    }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Updated report template of Check Voucher [tblfinrptdisbursement]";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

// redirect back to previous page
  header("Location: mngfinrptdisbursement.php?loginid=$loginid");
  exit;

  }

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
