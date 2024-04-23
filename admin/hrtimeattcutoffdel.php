<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$idpaygroup = $_GET['idpg'];
$idcutoff = $_GET['idct'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");
?>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Delete Cut-off period</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

		 echo "<tr><th colspan=\"2\">Delete cut-off period</th></tr>";

// start contents here...


  if($accesslevel >= 4)
  {

		$res11select="SELECT cutstart, cutend, paygroupname FROM tblhrtacutoff WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("$res11select", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$cutstart11 = $myrow11[0];
			$cutend11 = $myrow11[1];
			$paygroupname11 = $myrow11[2];
			}
		}
		$res12select="SELECT COUNT(*) AS counter12 FROM tblhrtaemptimelog WHERE idpaygroup=$idpaygroup AND idcutoff=$idcutoff";
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("$res12select", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
			$counter12 = $myrow12[0];
			}
		}
	  echo "<tr><td colspan=\"2\" align=\"center\">";
		if($found11 == 1) {
			echo "<p><font color=\"red\">Deleting cutoff $cutstart11-to-$cutend11 from paygroup:$paygroupname11</font></p>";
		}
		if($found12 == 1) {
			echo "<p><font color=\"red\">Warning: there are $counter12 time log records under this cutoff.<br>Do you want to continue deleting?</font></p>";
		}
		echo "</td></tr>";

		echo "<tr>";
		echo "<form action=\"hrtimeattcutoffdel2.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff\" method=\"post\" name=\"modhrtacutoffdel2\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"Yes\"></td>";
		echo "</form>";
		echo "<form action=\"hrtimeattcutoff.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"modhrtacutoff\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"No\"></td>";
		echo "</form>";
		echo "</tr>";

	}

// end contents here...

     echo "</table>";

// edit body-footer
     // echo "<p><a href=\"hrtimeatt.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
