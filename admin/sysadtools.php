<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$hosttype = $_POST['hosttype'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=\"1\">Tools >> SysAd Tools</font></p>";

     echo "<table border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>";

     echo "<table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
     echo "<tr><td bgcolor=\"blue\" colspan=\"4\"><font color=\"white\"><b>SysAd Tools</b></font></td></tr>";

// start contents here...

    echo "<tr><form action=\"sysadtping.php?loginid=$loginid\" method=\"post\">";
    echo "<td align=\"center\">";
    echo "<select name=\"hosttype\">";
		/*
    echo "<option value=\"server\">Servers</option>";
    echo "<option value=\"router\">Routers</option>";
    echo "<option value=\"printer\">Printers</option>";
    echo "<option value=\"desktop\">Desktops</option>";
		*/
		$res11select="SELECT DISTINCT type FROM tblsysadping";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("$res11select", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$type11 = $myrow11[0];
			if($type11 == $hosttype) { $hsttypsel="selected"; } else { $hsttypsel=""; }
			echo "<option value=\"$type11\" $hsttypsel>$type11</option>";
			}
		}
    echo "</select><input type=\"submit\" value=\"Run Ping Hosts\"></td>";
		echo "</form>";
    echo "<td>Check servers and workstations if active</td>";
    echo "<form action=\"sysadtpingconfig.php?loginid=$loginid\" method=\"post\">";
		echo "<td align=\"center\">";
    echo "<input type=\"submit\" value=\"Configure Hosts\"></td>";
    echo "</form></tr>";

		echo "<tr><form action=\"./speedtest/index-php.html\" method=\"post\" target=\"_blank\" name=\"speedtest\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"Ookla Speedtest\">";
		echo "</td><td>run speedtest using ookla speedtest mini API</td><td></td>";
		echo "</form></tr>";

		echo "<tr><form action=\"sysadtspeedtest.php\" method=\"post\" target=\"_blank\" name=\"sysadtspeedtest\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"Local Speedtest\">";
		echo "</td><td>run speedtest using local server requests</td><td></td>";
		echo "</form></tr>";

    echo "<tr><form action=\"personnelinfomerge.php?loginid=$loginid\" method=\"POST\">";
		echo "<td align=\"center\">";
     echo "<input type=\"submit\" value=\"Merge Personnel Info\"></td><td>Will merge any personnel information</td><td></td></form></tr>";

//     echo "<tr>";
//     echo "<td><form action=sysad*****.php?loginid=$loginid method=post><input type=submit value=\"SysAd Tool #2\"></form></td>";
//     echo "<td>Type comments here...</td>";
//     echo "<td></td>";
//     echo "</tr>";

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 