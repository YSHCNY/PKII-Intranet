<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idtblhrtapaygrp = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Time and Attendance >> Pay group</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

	echo "<tr><th colspan=\"6\">Edit pay group</th></tr>";

  if($accesslevel >= 4) {
		// query paygroup details based on id
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT paygroupname, remarks FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idtblhrtapaygrp", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$paygroupname11 = $myrow11[0];
			$remarks11 = $myrow11[1];
			}
		}
		echo "<form action=\"hrtimeattpaygrpedit2.php?loginid=$loginid&idpg=$idtblhrtapaygrp\" method=\"post\" name=\"modhrtapaygrpedit\">";
	  echo "<tr><td colspan=\"6\" align=\"center\">";
		echo "<font color=\"red\"><b>*</b></font><input size=\"40\" name=\"paygroupname\" value=\"$paygroupname11\">";
		echo "</td></tr>";
		echo "<tr><td colspan=\"6\" align=\"center\">";
		echo "Description<br>";
		echo "<textarea name=\"remarks\" rows=\"2\" cols=\"40\">$remarks11</textarea>";
		echo "</td></tr>";
	  echo "<tr><td colspan=\"6\" align=\"center\">";
		echo "<input type=\"submit\" value=\"Update\">";
		echo "</td></tr>";
		echo "</form>";
	}

	echo "<tr><td colspan=\"6\" align=\"center\">Note:&nbsp;<font color=\"red\"><b>*</b></font> - required field</td></tr>";

	
	echo "<tr><td colspan=\"6\">";
	echo "</td></tr>";

	echo "<form action=\"hrtimeattpaygrpaddemp.php?loginid=$loginid&idpg=$idtblhrtapaygrp\" method=\"post\" name=\"modhrtapaygrpaddemp\">";
	echo "<tr><th colspan=\"6\">List of members&nbsp;";
	// echo "<input type=\"submit\" value=\"add\">";
	echo "<button type=\"submit\" class=\"btn btn-primary\">Add members</button>";
	echo "</th></tr>";
	echo "</form>";
	echo "<tr><th>count</th><th>emp_no</th><th>name</th><th>action</th></tr>";

	$result12=""; $found12=0; $ctr12=0;
	$result12 = mysql_query("SELECT tblhrtapaygrpemplst.idhrtapaygrpemplst, tblhrtapaygrpemplst.employeeid, tblhrtapaygrpemplst.contactid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.position FROM tblhrtapaygrpemplst INNER JOIN tblemployee ON tblhrtapaygrpemplst.employeeid=tblemployee.employeeid INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.idtblhrtapaygrp=$idtblhrtapaygrp ORDER BY tblcontact.name_last ASC", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$idhrtapaygrpemplst12 = $myrow12[0];
		$employeeid12 = $myrow12[1];
		$contactid12 = $myrow12[2];
		$name_last12 = $myrow12[3];
		$name_first12 = $myrow12[4];
		$name_middle12 = $myrow12[5];
		$contact_gender12 = $myrow12[6];
		$position12 = $myrow12[7];
		$ctr12 = $ctr12 + 1;
		echo "<tr><td>$ctr12</td><td>$employeeid12</td><td>$name_last12, $name_first12 $name_middle12[0]</td><td><button type=\"button\" class=\"btn btn-danger\"><a href=\"hrtimeattpaygrpempdel.php?loginid=$loginid&idpg=$idtblhrtapaygrp&idel=$idhrtapaygrpemplst12&eid=$employeeid12\">remove</a></button></td></tr>";
		}
	}

// end contents here...

     echo "</table>";

// edit body-footer
     // echo "<p><a href=\"hrtimeattpaygrp.php?loginid=$loginid\">Back</a></p>";
	 echo "<p><button type=\"button\" class=\"btn btn-default\"><a href=\"hrtimeattpaygrp.php?loginid=$loginid\">Back</a></button></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>