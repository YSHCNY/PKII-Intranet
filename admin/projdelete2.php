<html>
<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];

$found = 0;
$found2 = 0;

if($loginid != "")
{
     $result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid AND adminloginstat=1", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $found = 1;
          
          $loginid = $myrow[0];
          $username = $myrow[1];
          $loginstatus = $myrow[5];
          $level = $myrow[6];
     }
}

if ($found == 1)
{
     include ("header.php");

	$result = mysql_query("SELECT projectid, proj_num, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid='$pid'", $dbh);
   
     while ($myrow = mysql_fetch_row($result))
     {
	 $projectid = $myrow[0];
	 $proj_num = $myrow[1];
         $proj_code = $myrow[2];
         $proj_fname = $myrow[3];
         $proj_sname = $myrow[4];
     }

	$result2 = mysql_query("DELETE FROM tblproject1 WHERE projectid = $pid", $dbh);

	echo "<p><font color=red size=2>Deleted:</font><font size=2> $pid - $proj_code - $proj_sname</br>";
	echo "$proj_fname</p>";

	echo "<p><font size=2><a href=project2.php?loginid=$loginid>Back to Manage Projects</a></font></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

</html>
