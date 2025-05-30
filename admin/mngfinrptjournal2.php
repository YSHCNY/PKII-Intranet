<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$preparedlbl = $_POST['preparedlbl'];
$prepared = $_POST['prepared'];
$preparedpos = $_POST['preparedpos'];
$checkedlbl = $_POST['checkedlbl'];
$checked = $_POST['checked'];
$checkedpos = $_POST['checkedpos'];
$approvedlbl = $_POST['approvedlbl'];
$approved1 = $_POST['approved1'];
$approved1pos = $_POST['approved1pos'];
$approved2 = $_POST['approved2'];
$approved2pos = $_POST['approved2pos'];
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
    $result11 = mysql_query("SELECT rptjournalid FROM tblfinrptjournal", $dbh);
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$rptjournalid11 = $myrow11[0];
      }

    if($found11 == 1)
    {
      $result12 = mysql_query("UPDATE tblfinrptjournal SET
	preparedlbl=\"$preparedlbl\",
	prepared=\"$prepared\",
	preparedpos=\"$preparedpos\",
	checkedlbl=\"$checkedlbl\",
	checked=\"$checked\",
	checkedpos=\"$checkedpos\",
	approvedlbl=\"$approvedlbl\",
	approved1=\"$approved1\",
	approved1pos=\"$approved1pos\",
	approved2=\"$approved2\",
	approved2pos=\"$approved2pos\",
	remarks=\"$remarks\"
      WHERE rptjournalid = $rptjournalid11", $dbh);
    }
    else
    {
      $result12 = mysql_query("INSERT INTO tblfinrptjournal (preparedlbl, prepared, preparedpos, checkedlbl, checked, checkedpos, approvedlbl, approved1, approved1pos, approved2, approved2pos, remarks) VALUES (\"$preparedlbl\", \"$prepared\", \"$preparedpos\", \"$checkedlbl\", \"$checked\", \"$checkedpos\", \"$approvedlbl\", \"$approved1\", \"$approved1pos\", \"$approved2\", \"$approved2pos\", \"$remarks\")", $dbh);
    }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Updated report template of Journal Voucher [tblfinrptjournal]";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

// redirect back to previous page
  header("Location: mngfinrptjournal.php?loginid=$loginid");
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
