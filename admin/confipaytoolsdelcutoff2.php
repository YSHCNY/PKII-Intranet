<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$groupname = $_GET['groupname'];
$cutstart = $_GET['cutstart'];
$cutend = $_GET['cutend'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "p{font-family: Helvetica; font-size: 10pt;}";
     echo "B{font-family: Helvetica; font-size: 10pt;}";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head>";

	echo "<p><font color=green><b>Deleting cutoff period...</b></font></p>";

	$result0 = mysql_query("DELETE FROM tblconfipayroll WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"", $dbh);
	$result1 = mysql_query("DELETE FROM tblconfipayrolladd WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"", $dbh);
	$result2 = mysql_query("DELETE FROM tblconfipayrolldeduct WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"", $dbh);
	$result3 = mysql_query("DELETE FROM tblconfipayrollproj WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"", $dbh);
	$result4 = mysql_query("DELETE FROM tblconfipayrolltotal WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\"", $dbh);

	echo "<p><font color=red><b>Deleted groupname:$groupname with cutoff period: $cutstart -to- $cutend</b></font>";

//	echo "<p><a href=\"confipay.php?loginid==$loginid\">Back to Custom Payroll System</a></p>";
    echo "</html>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

