<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$groupname = (isset($_GET['groupname'])) ? $_GET['groupname'] :'';
$cutstart = (isset($_GET['cutstart'])) ? $_GET['cutstart'] :'';
$cutend = (isset($_GET['cutend'])) ? $_GET['cutend'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "p{font-family: Helvetica; font-size: 10pt;}";
     echo "B{font-family: Helvetica; font-size: 10pt;}";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Deleting cut-off period</b></font></td></tr>";

	echo "<tr><td colspan=2>Deleting groupname:<b>$groupname</b> with cutoff period: <b>$cutstart</b> -to- <b>$cutend</b><br>";

	echo "<tr><td colspan=2 align=center><font color=red><b>Are you sure?</b></font></td></tr>";
	echo "<tr><td align=center><form action=\"confipaytoolsdelcutoff2.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend\" method=\"post\">";
  echo "<input type=\"hidden\" name=\"groupcut\" value=\"$groupname,$cutstart,$cutend\">";
  echo "<input type=\"hidden\" name=\"vpw\" value=\"1\">";
	echo "<button type=\"submit\" class='btn btn-danger'>Yes</button></form></td>";
	echo "<td align=center><form action=\"confipaytools2.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend\" method=\"post\">";
  echo "<input type=\"hidden\" name=\"groupcut\" value=\"$groupname,$cutstart,$cutend\">";
  echo "<input type=\"hidden\" name=\"vpw\" value=\"1\">";
	echo "<button type=\"submit\" class='btn btn-default'>No</button></form></td></tr></table>";
    echo "</html>";

  $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 

