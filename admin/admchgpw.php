<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Tools >> Change Password</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Change user password</b></font></td></tr>";

		$resquery="SELECT adminuid FROM tbladminlogin WHERE adminloginid = $loginid";
		$result="";
		$result=$dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
	$adminuid = $myrow['adminuid'];
			} // while
		} // if

     echo "<tr><td colspan=2>for <b>$adminuid</b></td></tr>";
     echo "<tr><td colspan=2><i>Note: Your password should have a minimum of at least<br>seven (7) alphanumeric characters, with a combination of<br>capital and lowercase letters.</i></td></tr>";
    
     echo "<form method=post action=\"admupdatepw.php?loginid=$loginid\">";
echo "<input type=\"hidden\" name=\"username\" value=\"$adminuid\">";
     echo "<tr><td>Current password</td><td><input type=\"password\" name=\"oldpassword\"></td></tr>";
     echo "<tr><td>New password</td><td><input type=\"password\" name=\"newpassword1\"></td></tr>";
     echo "<tr><td>Confirm new password</td><td><input type=\"password\" name=\"newpassword2\"></td></tr>";
     echo "<tr><td>&nbsp;</td><td><input type=\"submit\" value=\"Change Password\"></td></tr>";
     echo "</form>";

     echo "</table>";

     // echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";
    echo "<p><a href=\"index.php\">back to Login</a></p>";

		$resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result="";
		$result=$dbh2->query($resquery);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
