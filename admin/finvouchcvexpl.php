<?php 

include("db1.php");
include("datetimenow.php");

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

// start contents here

  echo "<table class=\"fin\" border=\"1\">";

  echo "<tr><th colspan=\"9\">Add Explanation for Check Vouchers and Debit Memos</th></tr>";
  echo "<tr><th>Count</th><th>C.V. No.</th><th>Explanation</th><th>DebitTotal</th><th>CreditTotal</th><th>Status</th><th colspan=\"2\">Action</th></tr>";

  $result11 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation, debittot, credittot, status FROM tblfindisbursementtot WHERE date >= \"2011-08-01\" AND date <= \"$datenow\" AND explanation = \"\" AND status <> \"cancelled\" ORDER BY date DESC, disbursementnumber DESC", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $disbursementtotid11 = $myrow11[0];
    $disbursementnumber11 = $myrow11[1];
    $date11 = $myrow11[2];
    $explanation11 = $myrow11[3];
    $debittot11 = $myrow11[4];
    $credittot11 = $myrow11[5];
    $status11 = $myrow11[6];

    $count1 = $count1 + 1;

    echo "<form action=\"finvouchcvexpl2.php?loginid=$loginid&dtid=$disbursementtotid11\" method=\"post\" name=\"myForm\">";

    echo "<tr><td align=\"center\">$count1</td><td><b>$disbursementnumber11</b></td><td><textarea name=\"explanation\" wrap=\"physical\">$explanation11</textarea></td>";
    if($debittot11 != $credittot11)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot11, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot11, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot11, 2)."</td><td align=\"right\">".number_format($credittot11, 2)."</td>";
    }
    if($status11 == "cancelled")
    {
      echo "<td><font color=\"red\"><i>$status11</i></font></td>";
    }
    else if($status11 != "")
    {
      echo "<td>$status11</td>";
    }
    else
    {
      $status11 = '';
      echo "<td>$status11</td>";
    }
    if($accesslevel >= 3 && $accesslevel <= 5)
    {
      if($status11 == "finalized" || $status11 == "cancelled")
      { echo "<td colspan=\"2\">&nbsp;</td><td>&nbsp;</td>"; }
      else
      {
        echo "<td colspan=\"2\"><input type=\"submit\" value=\"Save\"></td>";
      }
    }
    echo "</form></tr>";
  }

//  echo "<form action=\"finvouchlistcv.php?loginid=$loginid\" method=\"post\">";
//  echo "<tr><td colspan=\"8\" align=\"center\"><input type=\"submit\" value=\"Display\"></form></td></tr>";
  echo "</table>";

echo "<p><a href=\"finvouchmain.php?loginid=$loginid\">Back</a></p>";



// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
