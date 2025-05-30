<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$radiochecked = (isset($_GET['rs'])) ? $_GET['rs'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';
$confiaccesslevel = (isset($_POST['confiaccesslevel'])) ? $_POST['confiaccesslevel'] :'';
$srcfile = (isset($_POST['srcfile'])) ? $_POST['srcfile'] :'';
if($radiochecked=="cutoff") {
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';
$groupcut = (isset($_POST['groupcut'])) ? $_POST['groupcut'] :'';
} else if($radiochecked=="onetime") {
$nameotp = (isset($_POST['nameotp'])) ? $_POST['nameotp'] :'';
$dateotp = (isset($_POST['dateotp'])) ? $_POST['dateotp'] :'';
} else {
$cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';
$cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';
$groupcut = (isset($_POST['groupcut'])) ? $_POST['groupcut'] :'';
} // if($radiochecked=="cutoff")

$usrpassword = (isset($_POST['usrpassword'])) ? $_POST['usrpassword'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
?>
	<html><body>
	<table class="fin">
<?php

	// query tbladminlogin if password is correct
	$res11query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid AND adminpw=md5('$usrpassword')";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$adminuid11 = $myrow11['adminuid'];
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	echo "<form action=\"$srcfile?loginid=$loginid&rs=$radiochecked\" method=\"post\" name=\"$srcfile\">";

	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
	echo "<input type=\"hidden\" name=\"srcfile\" value=\"$srcfile\">";
	if($radiochecked=="cutoff") {
	echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
	echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
	echo "<input type=\"hidden\" name=\"groupcut\" value=\"$groupcut\">";
	} else if($radiochecked=="onetime") {
	echo "<input type=\"hidden\" name=\"nameotp\" value=\"$nameotp\">";
	echo "<input type=\"hidden\" name=\"dateotp\" value=\"$dateotp\">";
	} else {
	echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
	echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
	echo "<input type=\"hidden\" name=\"groupcut\" value=\"$groupcut\">";
	} // if($radiochecked=="")

	//	echo "<tr><td colspan=\"2\">test $cutstart -to- $cutend</td></tr>";

	if($found11 == 1) {
		// redirect with validated pw
		echo "<tr><th colspan=\"2\"><font color=\"green\">Password validated for $adminuid11</font></th></tr>";
		echo "<input type=\"hidden\" name=\"vpw\" value=\"1\">";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Proceed\"></td></tr>";
	} else {
		// redirect with re-enter of pw query
		echo "<tr><th colspan=\"2\"><font color=\"red\">Password error! Please try again.</font></th></tr>";
		echo "<input type=\"hidden\" name=\"vpw\" value=\"0\">";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Back\"></td></tr>";		
	}
	echo "</form>";

?>
	</table></body></html>
<?php
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
