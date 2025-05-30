<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$apnumber = $_GET['apn'];


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
      echo "<tr><th colspan=\"2\">Accts Payable - Finalize Add new entry</th></tr>";

if($apnumber == "") { echo "<tr><td><font color=\"red\">Sorry, AP Number should not be blank. Please try again.</font></td></tr>"; }
else
{
  $debitamttot = 0;
  $creditamttot =0;

  $result11 = mysql_query("SELECT acctspayableid, acctspayablenumber, payee, date, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber=\"$apnumber\"", $dbh);

  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $acctspayableid11 = $myrow11[0];
    $acctspayablenumber11 = $myrow11[1];
    $payee11 = $myrow11[2];
    $date11 = $myrow11[3];
    $glcode11 = $myrow11[4];
    $glnamedetails11 = $myrow11[5];
    $projcode11 = $myrow11[6];
    $particulars11 = $myrow11[7];
    $debitamt11 = $myrow11[8];
    $creditamt11 = $myrow11[9];

    $debitamttot = $debitamttot + $debitamt11;
    $creditamttot = $creditamttot + $creditamt11;
  }

  $result12 = mysql_query("SELECT acctspayabletotid, acctspayablenumber, date, explanation, debittot, credittot  FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\"", $dbh);


  while($myrow12 = mysql_fetch_row($result12))
  {
    $found12 = 1;
    $acctspayabletotid12 = $myrow12[0];
    $acctspayablenumber12 = $myrow12[1];
    $date12 = $myrow12[2];
    $explanation12 = $myrow12[3];
    $debittot12 = $myrow12[4];
    $credittot12 = $myrow12[5];
  }

  if($found11 == 1 && $found12 == 1)
  {    
    $debitamttot = round($debitamttot, 2);
    $creditamttot = round($creditamttot, 2);
    $debittot12 = round($debittot12, 2);
    $credittot12 = round($credittot12, 2);
    if($debitamttot == $creditamttot && $debittot12 == $credittot12)
    {
      
      if($explanation12 <> "" && $acctspayablenumber11 <> "" && $date11 <> "" && $payee11 <> "")
      {
	echo "<tr><td colspan=\"2\">Saving Accts Payable...</td></tr>";
	echo "<tr><td>Details</td><td>";
	echo "Date: $date11<br>";
	echo "AP No.: $acctspayablenumber11<br>";
	echo "Payee: $payee11<br>";
	echo "Explanation: $explanation12<br>";
	echo "Total Amount: $debittot12 = $credittot12<br>";
	$status = "finalized";
	echo "</td></tr>";

	$result14 = mysql_query("UPDATE tblfinacctspayabletot SET date=\"$datenow\", explanation=\"$explanation12\", debittot=$debittot12, credittot=$credittot12, status=\"$status\" WHERE acctspayablenumber=\"$acctspayablenumber11\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Finalized Accts Payable No.:$acctspayablenumber11,Date:$date11,Payee:$payee11,Amt:$debittot12";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchlist.php?loginid=$loginid\" method=\"post\">";
	echo "<input type=\"submit\" value=\"OK\"></form></td></tr>";
      }
      else
      {
	echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Fields for Date, AP Number, Payee & Explanation should not be blank.</font></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchapnew.php?loginid=$loginid&apn=$apnumber\" method=\"post\">";
	echo "<input type=\"submit\" value=\"Back\"></form></td></tr>";
      }
    }
    else
    {
      // echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Debit and Credit amounts do not match. Please try again.</font></td></tr>";
      echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Debit and Credit amounts do not match. Please try again.</font><br>";
      echo "<p>debit:$debitamttot | credit:$creditamttot<br>";
      echo "debittotal:$debittot12 | credittotal:$credittot12</p>";
      echo "</td></tr>";
      echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchapnew.php?loginid=$loginid&apn=$apnumber\" method=\"post\">";
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
