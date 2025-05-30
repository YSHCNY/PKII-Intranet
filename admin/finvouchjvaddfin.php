<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$journalnumber = $_GET['jvn'];

$explanation = $_POST['explanation'];

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

      echo "<table class=\"fin\" border=\"0\">";
      echo "<tr><th colspan=\"2\">Journal Voucher - Finalize Add new entry</th></tr>";

if($journalnumber == "") { echo "<tr><td><font color=\"red\">Sorry, J.V. Number should not be blank. Please try again.</font></td></tr>"; }
else
{
  $debitamttot = 0;
  $creditamttot =0;

  $result11 = mysql_query("SELECT journalid, journalnumber, date, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $journalid11 = $myrow11[0];
    $journalnumber11 = $myrow11[1];
    $date11 = $myrow11[2];
    $glcode11 = $myrow11[3];
    $glrefver11 = $myrow11[4];
    $glnamedetails11 = $myrow11[5];
    $projcode11 = $myrow11[6];
    $particulars11 = $myrow11[7];
    $debitamt11 = $myrow11[8];
    $creditamt11 = $myrow11[9];

    $debitamttot = $debitamttot + $debitamt11;
    $creditamttot = $creditamttot + $creditamt11;
  }

  $result12 = mysql_query("SELECT journaltotid, journalnumber, date, explanation, debittot, credittot  FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber\"", $dbh);
  while($myrow12 = mysql_fetch_row($result12))
  {
    $found12 = 1;
    $journaltotid12 = $myrow12[0];
    $journalnumber12 = $myrow12[1];
    $date12 = $myrow12[2];
    $explanation12 = $myrow12[3];
    $debittot12 = $myrow12[4];
    $credittot12 = $myrow12[5];
  }

  if($found11 == 1 && $found12 == 1)
  {
    if($debitamttot == $creditamttot && $debittot12 == $credittot12)
    {
      if($explanation12 <> "" && $journalnumber11 <> "" && $date11 <> "")
      {
	$status = "finalized";
	echo "<tr><td colspan=\"2\">Saving Journal...</td></tr>";
	echo "<tr><td>Details</td><td>";
	echo "Date: $date11<br>";
	echo "JV No.: $journalnumber11<br>";
	echo "Explanation: $explanation12<br>";
	echo "Total Amount: $debittot12 = $credittot12<br>";

	$result14 = mysql_query("UPDATE tblfinjournaltot SET date=\"$datenow\", explanation=\"$explanation12\", debittot=$debittot12, credittot=$credittot12, status=\"$status\" WHERE journaltotid=$journaltotid12 AND journalnumber=\"$journalnumber11\"", $dbh);

	echo "</td></tr>";

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Finalized Journal Voucher No.:$journalnumber11,Date:$date11,Amt:$debittot12";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchlist.php?loginid=$loginid&rs=jv\" method=\"post\">";
	echo "<input type=\"submit\" value=\"OK\"></form></td></tr>";
      }
      else
      {
	echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Fields for Date, JV No. & Explanation should not be blank.</font></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber\" method=\"post\">";
	echo "<input type=\"submit\" value=\"Back\"></form></td></tr>";
      }
    }
    else
    {
      echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Debit and Credit amounts do not match. Please try again.</font></td></tr>";
      echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber\" method=\"post\">";
      echo "<input type=\"submit\" value=\"Back\"></form></td></tr>";
    }
  }
}

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
