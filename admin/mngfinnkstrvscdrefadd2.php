<?php 

include("db1.php");
include('datetimenow.php');

$loginid = $_GET['loginid'];

$nkstrvstype = $_POST['nkstrvstype'];
$nkstrvscode = $_POST['nkstrvscode'];
$nkstrvsnamej = $_POST['nkstrvsnamej'];
$nkstrvsnamee = $_POST['nkstrvsnamee'];
$nkstrvstabpos = $_POST['nkstrvstabpos'];
$nkstrvsseq = $_POST['nkstrvsseq'];
$nkstrvsformref = $_POST['nkstrvsformref'];
$nkstrvssheetref = $_POST['nkstrvssheetref'];
$nkstrvsremarks = $_POST['nkstrvsremarks'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
  // include ("header.php");
  // include ("sidebar.php");

  if($accesslevel >= 3 && $accesslevel <= 5)
  {
		// insert new record
		$result11 = mysql_query("INSERT INTO tblfinnkgacctref SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", type=\"$nkstrvstype\", code=\"$nkstrvscode\", name_j=\"$nkstrvsnamej\", name_e=\"$nkstrvsnamee\", seq=$nkstrvsseq, formref=\"$nkstrvsformref\", sheetref=\"$nkstrvssheetref\", tabpos=\"$nkstrvstabpos\", remarks=\"$nkstrvsremarks\"", $dbh);

    // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid16=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid16 - add new NK-Stravis acct code:$nkstrvscode name:$nkstrvsnamej-$nkstrvsnamee formsheet:$nkstrvsformref-$nkstrvssheetref";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }

  // echo "<p><a href=\"businessedit.php?loginid=$loginid\">Back</a><br>";
	header("Location: mngfinnkstrvscdref.php?loginid=$loginid");
  exit;
   
  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

  // include ("footer.php");
}
else
{
  include ("logindeny.php");
}

mysql_close($dbh);
?>