<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$jvdate = $_POST['jvdate'];
$jvnumber = $_POST['jvnumber'];
$explanation = $_POST['explanation'];
$explanation = mysql_real_escape_string($explanation);

$glcode = $_POST['glcode'];
$aepglcode = $_POST['aepglcode'];
$glnamedetails = $_POST['glnamedetails'];
$glnamedetails = mysql_real_escape_string($glnamedetails);
$projcode = $_POST['projcode'];
$particulars = $_POST['particulars'];
$debitamt = $_POST['debitamt'];
$creditamt = $_POST['creditamt'];

$status = "pending";

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
      echo "<tr><th colspan=\"2\">Journal Vouchers - Add new entry</th></tr>";

  if($debitamt == '' && $creditamt == '') { $proceed = 0; }
  else { $proceed = 1; }

if($proceed == 0)
{
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, debit or credit field should have a value. Please try again.</font></td></tr>";
}
else if($proceed == 1)
{
  $result11 = mysql_query("SELECT journalid, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$jvnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $journalid11 = $myrow11[0];
    $debitamt11 = $myrow11[1];
    $creditamt11 = $myrow11[2];

    $debitamtfin = $debitamtfin + $debitamt11;
    $creditamtfin = $creditamtfin + $creditamt11;

    $debitamt11 = 0; $creditamt11 = 0;
  }

  if($debitamt == "") { $debitamt = 0; }
  if($creditamt == "") { $creditamt = 0; }

  $debittot = $debitamtfin + $debitamt;
  $credittot = $creditamtfin + $creditamt;

// choose default glcode version
  $result17 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
  while($myrow17 = mysql_fetch_row($result17))
  {
    $version17 = $myrow17[0];
  }

// get glname from current glcode
  if($glcode != '')
  {
    $result18 = mysql_query("SELECT glname FROM tblfinglref WHERE version=$version17 AND glcode=\"$glcode\"", $dbh);
    while($myrow18 = mysql_fetch_row($result18))
    {
      $found18 = 1;
      $glname18 = $myrow18[0];
    }
    if($version17 == 1)
    {
    	if($glcode == "20.10.208" || $glname == "Accrued Expense Payable")
     	{
     		$glname18 = "AEP";
     		$result20 = mysql_query("SELECT glname FROM tblfinglref WHERE version=$version17 AND glcode=\"$aepglcode\"", $dbh);
     		while($myrow20 = mysql_fetch_row($result20))
     		{
     			$found20 = 1;
     			$aepglname20 = $myrow20[0];
     		}
		if($aepglcode == '')
		{
		  $glname18 = "Accrued Expense Payable";
		}
     	}
    }
    else if($version17 == 2)
    {
     	if($glcode == "20.10.210" || $glname == "Accrued Expense Payable")
     	{
     		$glname18 = "AEP";
     		$result20 = mysql_query("SELECT glname FROM tblfinglref WHERE version=$version17 AND glcode=\"$aepglcode\"", $dbh);
     		while($myrow20 = mysql_fetch_row($result20))
     		{
     			$found20 = 1;
     			$aepglname20 = $myrow20[0];
     		}
     	}
    }
  }

// get projname from current projcode
  if($projcode != '-' || $projcode != '')
  {
    $result19 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcode\"", $dbh);
    while($myrow19 = mysql_fetch_row($result19))
    {
      $found19 = 1;
      $proj_fname19 = $myrow19[0];
      $proj_sname19 = $myrow19[1];
    }
    if($proj_sname19 == '')
    {
      $proj_sname19 =  substr($proj_fname19, 0, 35);
    }
  }

// combine glname, glnamedetails, projname, particulars to particulars variable
  $allparticulars = "$glname18";
  if($aepglcode != '' || $aepglname20 != '')
  {
  	$allparticulars = "$allparticulars"." - "."$aepglname20";
  }
  if($glnamedetails != '')
  {
    $allparticulars = "$allparticulars"." - "."$glnamedetails";
  }
  if($proj_sname19 != '')
  {
  	$allparticulars = "$allparticulars"." - "."$proj_sname19";
  }
  if($particulars != '')
  {
  	$allparticulars = "$allparticulars"." - "."$particulars";
  }
	$allparticulars = mysql_real_escape_string($allparticulars);

  echo "<tr><td colspan=\"2\">Saving record details...</td></tr>";
  echo "<tr><td>Details</td><td>";
  echo "GLcode:\"$glcode\", AEPglcode:\"$aepglcode\", GLaddldetails:\"$glnamedetails\"<br>";
  echo "ProjCode:$projcode<br>";
  echo "Particulars:$allparticulars<br>";
  echo "DebitAmt:$debitamt<br>";
  echo "CreditAmt:$creditamt<br>";
  echo "</td></tr>";

// insert into tblfincashreceipt
  $result12 = mysql_query("INSERT INTO tblfinjournal SET journalnumber=\"$jvnumber\", date=\"$jvdate\", glcode=\"$glcode\", glrefver=$version17, glnamedetails=\"$glnamedetails\", projcode=\"$projcode\", particulars=\"$allparticulars\", debitamt=$debitamt, creditamt=$creditamt, explanation=\"$explanation\"", $dbh);


// compute for tblfincashreceipttot and update
  $result16 = mysql_query("SELECT journaltotid FROM tblfinjournaltot WHERE journalnumber=\"$jvnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $journaltotid16 = $myrow16[0];
  }

  if($found16 == 1)
  {
    $result17 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$jvnumber\"", $dbh);
    while($myrow17 = mysql_fetch_row($result17))
    {
      $found17 = 1;
      $debitamt17 = $myrow17[0];
      $creditamt17 = $myrow17[1];

      $debittot17 = $debittot17 + $debitamt17;
      $credittot17 = $credittot17 + $creditamt17;

      $debitamt17 = 0;
      $creditamt17 = 0;
    }
    $result14 = mysql_query("UPDATE tblfinjournaltot SET explanation=\"$explanation\", debittot=$debittot17, credittot=$credittot17, status=\"$status\" WHERE journalnumber=\"$jvnumber\"", $dbh);
  }
  else
  {
    $result15 = mysql_query("INSERT INTO tblfinjournaltot SET journalnumber=\"$jvnumber\", date=\"$cvdate\", explanation=\"$explanation\", debittot=\"$debittot\", credittot=\"$credittot\", status=\"$status\"", $dbh);
  }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Add new Journal Voucher entry with JV:$jvnumber - details:$allparticulars";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  echo "<tr><td>Status</td>";
  echo "<form action=\"finvouchjvnew.php?loginid=$loginid&jvid=$journalid16&jvn=$jvnumber\" method=\"post\">";
  echo "<td><input type=\"submit\" value=\"OK\"></form></td></tr>";
}

    echo "</table>";

    echo "<p><a href=\"finvouchjvnew.php?loginid=$loginid&jvid=$journalid16&jvn=$jvnumber\">Back</a></p>";

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