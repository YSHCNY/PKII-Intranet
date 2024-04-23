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

     $result = mysql_query("SELECT projectid, proj_num, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid = $pid", $dbh);
     while ($myrow = mysql_fetch_row($result))
     {
	$projectid = $myrow[0];
	$proj_num = $myrow[1];
	$proj_code = $myrow[2];
	$proj_fname = $myrow[3];
	$proj_sname = $myrow[4];
     }

  echo "<p><font color=red size=2>Warning: You are about to delete the record containing...</font><br>";
  echo "<font size=2>Project Code: $proj_code<br>";
  echo "Acronym: $proj_sname<br>";
  echo "Project Name: $proj_fname</p>";

  echo "<p>Are you sure?</p>";

  echo "<table border=0 spacing=1><tr><td>";
  echo "<form action=projdelete2.php?loginid=$loginid&pid=$pid method=post>";
  echo "<input type=submit value='Yes'></form></td><td>";
  echo "<form action=editproj.php?loginid=$loginid&pid=$pid method=post>";
  echo "<input type=submit value='No'></form></td></tr></table>";

//  echo "<p><a href=editproj.php?loginid=$loginid&pid=$pid>Back to Edit Project</a></p></font>";

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
