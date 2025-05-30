<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$cvnumber = $_GET['cvn'];

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
      echo "<tr><th colspan=\"2\">Check Vouchers - Finalize Add new entry</th></tr>";

if($cvnumber == "") { echo "<tr><td><font color=\"red\">Sorry, CV Number should not be blank. Please try again.</font></td></tr>"; }
else
{
  $debitamttot = 0;
  $creditamttot =0;

  $result11 = mysql_query("SELECT disbursementid, disbursementnumber, disbursementtype, payee, date, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$cvnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $disbursementid11 = $myrow11[0];
    $disbursementnumber11 = $myrow11[1];
    $disbursementtype11 = $myrow11[2];
    $payee11 = $myrow11[3];
    $date11 = $myrow11[4];
    $glcode11 = $myrow11[5];
    $glnamedetails11 = $myrow11[6];
    $projcode11 = $myrow11[7];
    $particulars11 = $myrow11[8];
    $debitamt11 = $myrow11[9];
    $creditamt11 = $myrow11[10];

    $debitamttot = $debitamttot + $debitamt11;
    $creditamttot = $creditamttot + $creditamt11;
  }

  $result12 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation, debittot, credittot  FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber\"", $dbh);
  while($myrow12 = mysql_fetch_row($result12))
  {
    $found12 = 1;
    $disbursementtotid12 = $myrow12[0];
    $disbursementnumber12 = $myrow12[1];
    $date12 = $myrow12[2];
    $explanation12 = $myrow12[3];
    $debittot12 = $myrow12[4];
    $credittot12 = $myrow12[5];
  }

  if($found11 == 1 && $found12 == 1)
  {
    if($debitamttot == $creditamttot && $debittot12 == $credittot12)
    {
      if($explanation12 <> "" && $disbursementnumber11 <> "" && $date11 <> "" && $payee11 <> "")
      {
	echo "<tr><td colspan=\"2\">Saving Check Voucher...</td></tr>";
	echo "<tr><td>Details</td><td>";
	echo "Date: $date11<br>";
	echo "CV No.: $disbursementnumber11<br>";
	echo "Payee: $payee11<br>";
	echo "Explanation: $explanation12<br>";
	echo "Total Amount: $debittot12 = $credittot12<br>";
	$status = "finalized";
	echo "</td></tr>";

	$result14 = mysql_query("UPDATE tblfindisbursementtot SET date=\"$datenow\", explanation=\"$explanation12\", debittot=$debittot12, credittot=$credittot12, status=\"$status\" WHERE disbursementnumber=\"$disbursementnumber11\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Finalized Check Voucher No.:$disbursementnumber11,Date:$date11,Payee:$payee11,Amt:$debittot12";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchlist.php?loginid=$loginid\" method=\"post\">";
	echo "<input type=\"submit\" value=\"OK\"></form></td></tr>";
      }
      else
      {
	echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Fields for Date, CV Number, Disbursement & Explanation should not be blank.</font></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchcvnew.php?loginid=$loginid&cvn=$cvnumber\" method=\"post\">";
	echo "<input type=\"submit\" value=\"Back\"></form></td></tr>";
      }
    }
    else
    {
      echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Debit and Credit amounts do not match. Please try again.</font></td></tr>";
      echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchcvnew.php?loginid=$loginid&cvn=$cvnumber\" method=\"post\">";
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
