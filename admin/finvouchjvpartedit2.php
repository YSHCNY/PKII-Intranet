<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$journalid0 = $_GET['jvid'];
$journalnumber0 = $_GET['jvn'];

$glcode = $_POST['glcode'];
$aepglcode = $_POST['aepglcode'];
$glnamedetails = $_POST['glnamedetails'];
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
//     include ("header.php");
//     include ("sidebar.php");

// start contents here


  if($debitamt == '' && $creditamt == '') { $proceed = 0; }
  else { $proceed = 1; }

if($proceed == 0)

{
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, debit or credit fields should have a value. Please try again.</font></td></tr>";
			echo "</table>";
}

else if($proceed == 1)

{
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
  if(($projcode != "-") || ($projcode != ""))
  {
		$result19=""; $found19=0;
    $result19 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcode\"", $dbh);
    while($myrow19 = mysql_fetch_row($result19))
    {
      $found19 = 1;
      $proj_fname19 = $myrow19[0];
      $proj_sname19 = $myrow19[1];
    }
		if($found19 == 1) {
    	if($proj_sname19 == '') {
      	$proj_sname19 =  substr($proj_fname19, 0, 35);
			}
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


  $result12 = mysql_query("UPDATE tblfinjournal SET glcode=\"$glcode\", glrefver=\"$version17\", glnamedetails=\"$glnamedetails\", projcode=\"$projcode\", particulars=\"$allparticulars\", debitamt=\"$debitamt\", creditamt=\"$creditamt\" WHERE journalid=$journalid0 AND journalnumber=\"$journalnumber0\"", $dbh);


// update debittot and credittot
  $result11 = mysql_query("SELECT date, debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber0\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
		$date11 = $myrow11[0];
    $debitamt11 = $myrow11[1];
    $creditamt11 = $myrow11[2];

    $debittot11 = $debittot11 + $debitamt11;
    $credittot11 = $credittot11 + $creditamt11;

    $debitamt11 = 0; $creditamt11 = 0;
  }

  if($debitamt == "") { $debitamt = 0; }
  if($creditamt == "") { $creditamt = 0; }

	$result16=""; $found16=0;
  $result16 = mysql_query("SELECT journaltotid, explanation FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber0\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $journaltotid16 = $myrow16[0];
		$explanation16 = $myrow16[1];
  }

	if($explanation16 != "") { $explanationfin=$explanation16; }
	else if($explanation != "") { $explanationfin=$explanation; }

  if($found16 == 1)
  {
    $result14 = mysql_query("UPDATE tblfinjournaltot SET date=\"$datenow\", debittot=$debittot11, credittot=$credittot11, status=\"$status\" WHERE journaltotid=$journaltotid16 AND journalnumber=\"$journalnumber0\"", $dbh);
  }
  else
  {
    $result15 = mysql_query("INSERT INTO tblfinjournaltot SET journalnumber=\"$journalnumber0\", date=\"$date11\", explanation=\"$explanationfin\", debittot=$debittot11, credittot=$credittot11, status=\"$status\"", $dbh);
  }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Modified Journal Voucher item with JV:$journalnumber0 - details:$allparticulars, acctcode:$glcode, debit:$debitamt, credit:$creditamt";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

}

  header("Location: finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber0");
  exit;

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

//     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>