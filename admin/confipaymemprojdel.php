<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$employeeid10 = $_GET['eid'];
$groupname10 = $_GET['gn'];
$confipaymemprojid10 = $_GET['cmpid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// query record
  $result11 = mysql_query("SELECT employeeid, groupname, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2 FROM tblconfipaymemproj WHERE employeeid=\"$employeeid10\" AND groupname=\"$groupname10\" AND confipaymemprojid=$confipaymemprojid10", $dbh);
  if($result11 != '') {
    while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
    $employeeid11 = $myrow11[0];
    $groupname11 = $myrow11[1];
    $proj_code11 = $myrow11[2];
    $proj_name11 = $myrow11[3];
    $position11 = $myrow11[4];
    $durationfrom11 = $myrow11[5];
    $durationto11 = $myrow11[6];
    $durationfrom211 = $myrow11[7];
    $durationto211 = $myrow11[8];
    }
  }

  echo "<table border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><td colspan=\"2\">Deleting project <b>$proj_code11 $proj_name11</b><br>Addl details:<br><b>$position</b><br>$durationfrom11-to-$durationto11<br>$durationfrom211-to-$durationto211</td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>Are you sure?</b></font></td></tr>";
  echo "<tr><form method=\"post\" action=\"confipaymemprojdel2.php?loginid=$loginid&eid=$employeeid10&gn=$groupname10&cmpid=$confipaymemprojid10\"><td align=\"center\"><input type=\"submit\" value=\"Yes\"></form></td>";
  echo "<form method=\"post\" action=\"confipay3.php?loginid=$loginid&eid=$employeeid10&gn=$groupname10\"><td align=\"center\"><input type=\"submit\" value=\"No\"></form></td></tr>";
  echo "</table>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);


//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

