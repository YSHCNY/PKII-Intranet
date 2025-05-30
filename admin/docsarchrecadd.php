<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$deptcd = $_GET['dpt'];

$found = 0;

if($loginid != "")
{
	include("logincheck.php");
}

if ($found == 1)
{
	include ("header.php");
  include ("sidebar.php");

  echo "<p><font size=1>Modules >> Documents Archiving >> Add item</font></p>";

  echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
  echo "<tr><th colspan=\"2\">Documents Archiving - Add item</th></tr>";

	// start module here
	echo "<form enctype=\"multipart/form-data\" action=\"docsarchrecadd2.php?loginid=$loginid\" method=\"post\" name=\"form1\">";

	echo "<tr><th align=\"right\">Date</th><td>";
	echo "<input type=\"date\" name=\"date\" value=\"$datenow\">";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Title</th><td>";
	echo "<input size=\"50\" name=\"title\">";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Description</th><td>";
	echo "<textarea rows=\"3\" cols=\"50\" name=\"description\"></textarea>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Department</th><td>";
	echo "<select name=\"deptcd\">";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT code, name FROM tbldeptcd ORDER BY iddeptcd ASC", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$code11 = $myrow11[0];
		$name11 = $myrow11[1];
		// if($code11 == $deptcd) { $deptcdsel="selected"; } else { $deptcdsel=""; }
		// echo "<option value=\"$code11\" $deptcdsel>$name11</option>";
		if($code11 == $deptcd) { $deptcdsel="selected"; } else { $deptcdsel=""; }
      if(preg_match("/$code11/", "$deptscd0")) {
		echo "<option value=\"$code11\" $deptcdsel>$name11</option>";
			} // if
		} // while
	} // if
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Project Code</th><td>";
    echo "<select name=\"projcode\">";
    echo "<option value=\"-\">-</option>";
    $result14 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY proj_code DESC", $dbh);
    while($myrow14 = mysql_fetch_row($result14))
    {
      $projectid14 = $myrow14[0];
      $proj_code14 = $myrow14[1];
      $proj_fname14 = $myrow14[2];
      $proj_sname14 = $myrow14[3];
      $proj_fname142 = substr("$proj_fname14", 0, 47); 
      if($proj_sname14 <> '') { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_sname14</option>"; }
      else
      { echo "<option value=\"$proj_code14\">$proj_code14 - $proj_fname142</option>"; }
    }
    echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Keywords</th><td>";
	echo "<textarea rows=\"4\" cols=\"50\" name=\"keywords\"></textarea>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Remarks</th><td>";
	echo "<textarea rows=\"4\" cols=\"50\" name=\"remarks\"></textarea>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">File Attachment</th><td>";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" />";
    echo "<input name=\"uploadedfile\" type=\"file\" />";
	echo "</td></tr>";

	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
	echo "</form>";

  echo "</table>";
  echo "<p><a href=\"docsarchive.php?loginid=$loginid&dpt=$deptcd\">Back</a></p>";

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
