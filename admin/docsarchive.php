<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$dpt = $_GET['dpt'];
$deptcd = $_POST['deptcd'];

if(($dpt != "") && ($deptcd == "")) { $deptcd=$dpt; }

$found = 0;

if($loginid != "")
{
	include("logincheck.php");
}

if ($found == 1)
{
	include ("header.php");
  include ("sidebar.php");

  echo "<p><font size=1>Modules >> Documents Archiving</font></p>";

  echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
  echo "<tr><th colspan=\"2\">Documents Archiving</th></tr>";

	// start module here
	echo "<tr>";
	echo "<form action=\"docsarchive.php?loginid=$loginid\" method=\"post\">"; 
	echo "<td colspan=\"2\" align=\"center\">";
	echo "<select name=\"deptcd\">";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT code, name FROM tbldeptcd ORDER BY iddeptcd ASC", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$code11 = $myrow11[0];
		$name11 = $myrow11[1];
		if($code11 == $deptcd) { $deptcdsel="selected"; } else { $deptcdsel=""; }
      if(preg_match("/$code11/", "$deptscd0")) {
		echo "<option value=\"$code11\" $deptcdsel>$name11</option>";
			} // if
		}
	}
	echo "</select>";
	echo "<input type=\"submit\">";
	echo "</td>";
	echo "</form>";
	echo "</tr>";

	if($deptcd != "") {
	// display results here
	echo "<form action=\"docsarchrecadd.php?loginid=$loginid&dpt=$deptcd\" method=\"post\">";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Add new item for $deptcd\"></td></tr>";
	echo "</form>";
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
	echo "<tr><th>date</th><th>title</th><th>description</th><th>attachment</th><th colspan=\"2\">action</th></tr>";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = mysql_query("SELECT iddocsarchives, timestamp, loginid, datecreated, createdby, title, description, keywords, date, ctgarchivetyp, deptcd, projcode, remarks, filename, filepath FROM tbldocsarchives WHERE deptcd=\"$deptcd\" ORDER BY date DESC, iddocsarchives DESC", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$iddocsarchives12 = $myrow12[0];
		$timestamp12 = $myrow12[1];
		$loginid12 = $myrow12[2];
		$datecreated12 = $myrow12[3];
		$createdby12 = $myrow12[4];
		$title12 = $myrow12[5];
		$description12 = $myrow12[6];
		$keywords12 = $myrow12[7];
		$date12 = $myrow12[8];
		$ctgarchivetyp12 = $myrow12[9];
		$deptcd12 = $myrow12[10];
		$projcode12 = $myrow12[11];
		$remarks12 = $myrow12[12];
		$filename12 = $myrow12[13];
		$filepath12 = $myrow12[14];
		echo "<tr><td>$date12</td><td>$title12</td><td>$description12</td><td><a href=\"$filepath12/$filename12\" target=\"_blank\">$filename12</a></td>";
		echo "<td><a href=\"docsarchrecedit.php?loginid=$loginid&idda=$iddocsarchives12\">edit</a></td>";
		echo "<td><a href=\"docsarchrecdel.php?loginid=$loginid&idda=$iddocsarchives12\">del</a></td>";
		}
	}
	echo "</table></td></tr>";
	// end results here
	}

  echo "</table>";
  echo "<p><a href=index2.php?loginid=$loginid>Back</a></p>";

	// end module here
  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

  include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 