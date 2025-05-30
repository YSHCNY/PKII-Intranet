<?php 

require("db1.php");

$loginid = $_GET['loginid'];
$employeeid = trim($_POST['employeeid']);
$groupname = trim($_POST['groupname']);
$confiaccesslevel = $_POST['confiaccesslevel'];
$datecreated = date("Y-m-d");

$found = 0;
$exist = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Custom Payroll System >> Add group</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
     echo "<tr><th colspan=\"2\">Create Group Name</th></tr>";

// check if groupname is existing
     $result = mysql_query("SELECT DISTINCT groupname, datecreated FROM tblconfipaygrp WHERE groupname=\"$groupname\"", $dbh);

     if ($myrow = mysql_fetch_row($result))
     {
	$exist = 1;
	echo "<tr><td align=center><font color=red>Groupname <b>$myrow[0]</b> exists.</font><br><br>";
	echo "Please enter another name.</td></tr>";
     }
     elseif ($groupname == '')
     {
	echo "<tr><td align=center><font color=red>You have entered a blank groupname.</font><br><br>";
	echo "Please enter another name.</td></tr>";
     }
     else
     {

// display personnel list and get members 
	$exist = 0;

	if($confiaccesslevel >= 5) {

		echo "<form action=\"configrpaddchkpw.php?loginid=$loginid\" method=\"POST\" name=\"myform1\">";
		echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
		echo "<input type=\"hidden\" name=\"confiaccesslevel\" value=\"$confiaccesslevel\">";
		echo "<input type=\"hidden\" name=\"datecreated\" value=\"$datecreated\">";
		echo "<tr><th colspan=\"2\">Please re-enter your password for higher-level security access.</th></tr>";
		$res11query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("$res11query", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$adminuid11 = $myrow11[0];
			}
		}
		echo "<tr><th align=\"right\">user</th><th align=\"left\">$adminuid11</th></tr>";
		echo "<tr><th align=\"right\">password</th><td><input type=\"password\" name=\"usrpassword\"></td></tr>";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
		echo "</form>";

	} else if($confiaccesslevel <= 4) {

		include("configrpadd2b.php");

	} // if($accesslevel == 5) {
     } // if ($myrow = mysql_fetch_row($result))
     echo "</table>";

     echo "<p><a href=configrpadd.php?loginid=$loginid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
