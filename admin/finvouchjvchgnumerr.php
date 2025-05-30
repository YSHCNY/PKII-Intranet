<?php

include("db1.php");

$loginid = $_GET['loginid'];
$jvnumber0 = $_GET['jvn'];
$jvdate0 = $_GET['jvdt'];

		echo "<html><body>";
		echo "<p><font color=\"red\"><b>Sorry Journal number exists. Please try again.</b></font></p>";
		echo "<p><a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$jvnumber0&jvdate=$jvdate0\">Back</a></p>";
		echo "</body></html>";

?>


