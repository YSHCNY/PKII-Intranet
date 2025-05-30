<?php

include("db1.php");

$loginid = $_GET['loginid'];
$crvnumber0 = $_GET['crvn'];
$crvdate0 = $_GET['crvdt'];

		echo "<html><body>";
		echo "<p><font color=\"red\"><b>Sorry CRV number exists. Please try again.</b></font></p>";
		echo "<p><a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$crvnumber0&crvdate=$crvdate0\">Back</a></p>";
		echo "</body></html>";

?>


