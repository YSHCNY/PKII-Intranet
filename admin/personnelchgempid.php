<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

   
     echo "<div class = 'mb-3'><a class = 'btn mainbtnclr text-white ' href=personneledit2.php?loginid=$loginid&pid=$pid>Back</a></div>";

     echo "<div>";
     echo "<div>Change Employee Number</div>";

     $result0 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$pid'", $dbh);
     while($myrow0 = mysql_fetch_row($result0))
     {
	$name_last = $myrow0[0];
	$name_first = $myrow0[1];
	$name_middle = $myrow0[2];
     }

     echo "<div>$pid - $name_last, $name_first $name_middle[0]</div>";
     echo "<div>New Employee Number</div>";

     echo "<form action=personnelchgempid2.php?loginid=$loginid&eid=$pid method=POST>";
     echo "<input name=\"newemployeeid\" size=\"10\"></div>";
     echo "<div><input type=\"submit\" value=\"Change Employee Number\"></div></form>";

     echo "</div>";
 

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
