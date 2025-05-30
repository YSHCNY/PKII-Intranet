<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$preparedlbl = $_POST['preparedlbl'];
$checkedlbl = $_POST['checkedlbl'];
$approvedlbl = $_POST['approvedlbl'];
$prepared = $_POST['prepared'];
$checked = $_POST['checked'];
$approved = $_POST['approved'];
$preparedpos = $_POST['preparedpos'];
$checkedpos = $_POST['checkedpos'];
$approvedpos = $_POST['approvedpos'];
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
    $result11 = mysql_query("SELECT rptcashreceiptid FROM tblfinrptcashreceipt", $dbh);
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$rptcashreceiptid11 = $myrow11[0];
      }

    if($found11 == 1)
    {
      $result12 = mysql_query("UPDATE tblfinrptcashreceipt SET
	preparedlbl=\"$preparedlbl\",
	checkedlbl=\"$checkedlbl\",
	approvedlbl=\"$approvedlbl\",
	prepared=\"$prepared\",
	checked=\"$checked\",
	approved=\"$approved\",
	preparedpos=\"$preparedpos\",
	checkedpos=\"$checkedpos\",
	approvedpos=\"$approvedpos\",
	remarks=\"$remarks\"
      WHERE rptcashreceiptid = $rptcashreceiptid11", $dbh);
    }
    else
    {
      $result12 = mysql_query("INSERT INTO tblfinrptcashreceipt (preparedlbl, checkedlbl, approvedlbl, prepared, checked, approved, preparedpos, checkedpos, approvedpos, remarks) VALUES (\"$preparedlbl\", \"$checkedlbl\", \"$approvedlbl\", \"$prepared\", \"$checked\", \"$approved\", \"$preparedpos\", \"$checkedpos\", \"$rfpapprovedpos\", \"$remarks\")", $dbh);
    }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Updated report template of Cash Receipts [tblfinrptcashreceipt]";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

// redirect back to previous page
  header("Location: mngfinrptcashreceipt.php?loginid=$loginid");
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
