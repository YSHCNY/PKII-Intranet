<?php 

require("db1.php");

$loginid = $_GET['loginid'];

$groupname = trim($_POST['groupname']);
$confiaccesslevel = $_POST['confiaccesslevel'];
$usrpassword = trim($_POST['usrpassword']);

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

	// verify user password
	$res11query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid AND adminpw=md5('$usrpassword')";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("$res11query", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$adminuid11 = $myrow11[0];
		}
	}

	if($found11 == 1) {

		include("configrpadd2b.php");

	} else if($found11 == 0) {

		echo "<form method=\"post\" action=\"configrpadd2.php?loginid=$loginid\" name=\"myform1\">";
		echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
		echo "<input type=\"hidden\" name=\"confiaccesslevel\" value=\"$confiaccesslevel\">";
		echo "<input type=\"hidden\" name=\"datecreated\" value=\"$datecreated\">";
		echo "<tr><td colspan=\"2\"><h2><font color=\"red\">Sorry, password is incorrect.</font></h2></td></tr>";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"back\"></td></tr>";
		echo "</form>";

	}

	echo "</table>";

//     echo "<p><a href=configrpadd.php?loginid=$loginid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
