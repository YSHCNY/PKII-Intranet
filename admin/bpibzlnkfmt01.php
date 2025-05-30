<?php
require_once("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$cutoff = (isset($_POST['cutoff'])) ? $_POST['cutoff'] :'';

$cutoffarray = explode(" ", $cutoff);
$cutstart = $cutoffarray[0];
$cutend = $cutoffarray[1];

$found = 0;

if($loginid != "") {
	include("logincheck.php");
}

if($found == 1) {
    include ("header.php");
    include ("sidebar.php");

    echo "<p><font size=1>Modules >> Employees' payslip email notifier >> BPI BizLink File</font></p>";

    echo "<h2>BPI Payroll File Process</h2>";
    echo "<p>For payroll group and cutoff period:<br>";
    echo "<b>$cutstart to $cutend</b></p>";
	
	echo "<form action=\"bpibzlnkfmt02.php?loginid=$loginid\" method=\"POST\" name=\"bpibizlnkfmt02\">";
	echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
	echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";

	include("bpifspec1.php");

	echo "<p><input type=submit value=OK></p>";
	echo "</form>";

	echo "<p><a href=\"cutoff.php?loginid=$loginid\">back</a></p>";
    include ("footer.php");
} else {
    include ("logindeny.php");
}

$dbh2->close();
?>