<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$iddocsarchives = $_GET['idda'];

$found = 0;

if($loginid != "")
{
	include("logincheck.php");
}

if ($found == 1)
{
	include ("header.php");
  include ("sidebar.php");

  echo "<p><font size=1>Modules >> Documents Archiving >> Edit item</font></p>";

  echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
  echo "<tr><th colspan=\"2\"><font color=\"red\">Deleting item...<br>Are you sure?</font></th></tr>";

	// start module here
	$result10=""; $found10=0; $ctr10=0;
	$result10 = mysql_query("SELECT timestamp, loginid, datecreated, createdby, title, description, keywords, date, ctgarchivetyp, deptcd, projcode, remarks, filename, filepath FROM tbldocsarchives WHERE iddocsarchives=$iddocsarchives", $dbh);
	if($result10 != "") {
		while($myrow10 = mysql_fetch_row($result10)) {
		$found10 = 1;
		$timestamp10 = $myrow10[0];
		$loginid10 = $myrow10[1];
		$datecreated10 = $myrow10[2];
		$createdby10 = $myrow10[3];
		$title10 = $myrow10[4];
		$description10 = $myrow10[5];
		$keywords10 = $myrow10[6];
		$date10 = $myrow10[7];
		$ctgarchivetyp10 = $myrow10[8];
		$deptcd10 = $myrow10[9];
		$projcode10 = $myrow10[10];
		$remarks10 = $myrow10[11];
		$filename10 = $myrow10[12];
		$filepath10 = $myrow10[13];
		}
	}

	echo "<tr><td colspan=\"2\">Details:<br>$title10<br>$description10<br>$deptcd10<br>$filename10</td></tr>";

	echo "<form action=\"docsarchrecdel2.php?loginid=$loginid&idda=$iddocsarchives\" method=\"post\" name=\"form1\">";
	echo "<tr><td align=\"center\">";
	echo "<input type=\"submit\" value=\"Yes\">";
	echo "</td>";
	echo "</form>";
	echo "<form action=\"docsarchive.php?loginid=$loginid&dpt=$deptcd10\" method=\"post\" name=\"form2\">";
	echo "<td align=\"center\">";
	echo "<input type=\"submit\" value=\"No\">";
	echo "</td></tr>";
	echo "</form>";

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