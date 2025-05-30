<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff = (isset($_GET['idct'])) ? $_GET['idct'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
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


  if($accesslevel >= 4) {

		$res11select=""; $result11=""; $found11=0; $ctr11=0;
		$res11select="SELECT cutstart, cutend, paygroupname FROM tblhrtacutoff WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup";
		$result11=$dbh2->query($res11select);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$cutstart11 = $myrow11['cutstart'];
			$cutend11 = $myrow11['cutend'];
			$paygroupname11 = $myrow11['paygroupname'];				
			} //while
		} //if
		
		$res12select=""; $result12=""; $found12=0; $ctr12=0;
		$res12select="SELECT COUNT(*) AS counter12 FROM tblhrtaemptimelog WHERE idpaygroup=$idpaygroup AND idcutoff=$idcutoff";
		$result12=$dbh2->query($res12select);
		if($result12->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found12 = 1;
			$counter12 = $myrow12['counter12'];			
			} //while
		} //if

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

     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
