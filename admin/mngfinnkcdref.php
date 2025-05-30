<?php 

include("db1.php");

$loginid = $_GET['loginid'];

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
  echo "<p><font size=1>Manage >> Accounting Modules >> NK-Stravis code ref</font></p>";

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

  echo "<tr><th colspan=\"8\">NK-Stravis Account Code References</th></tr>";

// start contents here...

  echo "<tr><td colspan=\"8\" align=\"center\">";
  echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><td align=\"center\"><form action=\"mngfinnkcdrefadd.php?loginid=$loginid\" method=\"post\">";
  echo "<input type=\"submit\" value=\"Add new Acct Code\"></form></td>";
  echo "<td align=\"center\"><form action=\"mngfinnkcdref.php?loginid=$loginid\" method=\"post\">";
  echo "Type<select name=\"nkcdtyp\">";
  echo "<option value=\"1\" $select1>1</option>";
  echo "<option value=\"2\" $select2>2</option>";
  echo "</select>";
  echo "<input type=\"submit\" value=\"Submit\"></form></td>";
  echo "<td align=\"center\"></td></tr>";
  echo "</table>";
  echo "</td></tr>";
  echo "<tr><th>Count</th><th>AcctCode</th><th>Name</th><th>Ver</th><th>DateModified</th><th>Remarks</th><th colspan=\"2\">Action</th></tr>";
  $result11 = mysql_query("SELECT DISTINCT glcode, glrefid, glname, version, date, remarks FROM tblfinglref WHERE version=$ver ORDER BY glcode ASC", $dbh);
  $found11 = 0;
  $date11 = 0;
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $glcode11 = $myrow11[0];
    $glrefid11 = $myrow11[1];
    $glname11 = $myrow11[2];
    $version11 = $myrow11[3];
    $date11 = $myrow11[4];
    $remarks11 = $myrow11[5];

    $count1 = $count1 + $found11;

    echo "<tr><td>$count1</td><td>$glcode11</td><td>$glname11</td><td>$version11</td><td>$date11</td><td>$remarks11</td>";
    if($accesslevel >= 4 && $accesslevel <= 5)
    {
      echo "<td><a href=\"mngfinglrefdel.php?loginid=$loginid&glid=$glrefid11\">Del</a></td>";
    }
    if($accesslevel >= 3 && $accesslevel <= 5)
    {
      echo "<td><a href=\"mngfinglrefedit.php?loginid=$loginid&glid=$glrefid11\">Edit</a></td></tr>";
    }
  }

// end contents here...

  echo "</table>";

// edit body-footer
     echo "<p><a href=\"mngfinmods.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
