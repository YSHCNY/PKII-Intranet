<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];

$proj_code = $_POST['proj_code'];

$found = 0;

if($loginid != "")
{
	include("logincheck.php");
}


if ($found == 1)
{
	include ("header.php");
  include ("sidebar.php");

// start contents here

	echo "<font size=1>Directory >> Manage Projects >> Change Project Code</font><br>";

	$result11=""; $found11=0;
	$result11 = mysql_query("SELECT proj_num, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid=$pid", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$proj_num11 = $myrow11[0];
		$proj_code11 = $myrow11[1];
		$proj_fname11 = $myrow11[2];
		$proj_sname11 = $myrow11[3];
		}
	}

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Manage Projects - change project code</th></tr>";
	if(($accesslevel >= 4) && ($accesslevel <= 5)) {
	echo "<form action=\"projchgcd2.php?loginid=$loginid&pid=$pid\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">No.</th><td>$proj_num11</td></tr>";
	echo "<tr><th align=\"right\">Project code</th><td><input name=\"proj_code\" value=\"$proj_code11\"></td></tr>";
	echo "<tr><th align=\"right\">Acronym</th><td>$proj_sname11</td></tr>";
	echo "<tr><th align=\"right\">Project name</th><td>$proj_fname11</td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
	echo "</form>";
	} else {
	echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, your access level is not allowed on this page.</font></td></tr>";
	}
  echo "</table>";

  echo "<p><a href=\"editproj.php?loginid=$loginid&pid=$pid\">Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
