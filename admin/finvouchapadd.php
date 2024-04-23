<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$apdate = trim((isset($_POST['apdate'])) ? $_POST['apdate'] :'');
$apdate = date('Y-m-d', strtotime($apdate));

$apnumber = trim((isset($_POST['apnumber'])) ? $_POST['apnumber'] :'');
$appayee = trim((isset($_POST['appayee'])) ? $_POST['appayee'] :'');

$apcompanyid = (isset($_POST['apcompanyid'])) ? $_POST['apcompanyid'] :'';
$apcontactid = (isset($_POST['apcontactid'])) ? $_POST['apcontactid'] :'';

$explanation = trim((isset($_POST['explanation'])) ? $_POST['explanation'] :'');
$explanation = htmlentities(stripslashes($explanation));

$glcode = trim((isset($_POST['glcode'])) ? $_POST['glcode'] :'');
$aepglcode = trim((isset($_POST['aepglcode'])) ? $_POST['aepglcode'] :'');

$glnamedetails = trim((isset($_POST['glnamedetails'])) ? $_POST['glnamedetails'] :'');
$glnamedetails = htmlentities(stripslashes($glnamedetails));

$projcode = trim((isset($_POST['projcode'])) ? $_POST['projcode'] :'');

$particulars = trim((isset($_POST['particulars'])) ? $_POST['particulars'] :'');
$particulars = htmlentities(stripslashes($particulars));

$debitamt = (isset($_POST['debitamt'])) ? $_POST['debitamt'] :'';
$creditamt = (isset($_POST['creditamt'])) ? $_POST['creditamt'] :'';

$duedate = trim((isset($_POST['apduedate'])) ? $_POST['apduedate'] :'');
$duedate = date('Y-m-d', strtotime($duedate));

$status = "pending";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" border=\"0\">";
      echo "<tr><th colspan=\"2\">Accounts Payable - Add new entry</th></tr>";

  if($debitamt == '' && $creditamt == '') { $proceed = 0; }
  else { $proceed = 1; }

if($proceed == 0) {
	
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, debit or credit fields should have a value. Please try again.</font></td></tr>";

} else if($proceed == 1) {

// update debittot and credittot
  $result11 = mysql_query("SELECT debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber=\"$apnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11)) {
    $found11 = 1;
    $debitamt11 = $myrow11[0];
    $creditamt11 = $myrow11[1];

    $debittot11 = $debittot11 + $debitamt11;
    $credittot11 = $credittot11 + $creditamt11;

    $debitamt11 = 0; $creditamt11 = 0;
  } //while

  if($debitamt == "") { $debitamt = 0; }
  if($creditamt == "") { $creditamt = 0; }

// compute current debittot and credittot
  $debittot = $debittot11 + $debitamt;
  $credittot = $credittot11 + $creditamt;

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
//      if(!isset($_POST['aepglcode']))
//      {
    	if($glcode == "20.10.208" || $glname == "Accrued Expense Payable")
     	{
     		$glname18 = "AEP";
     		$result20 = mysql_query("SELECT glname FROM tblfinglref WHERE version=$version17 AND glcode=\"$aepglcode\"", $dbh);
     		while($myrow20 = mysql_fetch_row($result20))
     		{
     			$found20 = 1;
     			$aepglname20 = $myrow20[0];
     		}
     	}
//      }
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

  echo "<tr><td colspan=\"2\">Saving record details...</td></tr>";
  echo "<tr><td>Details</td><td>Date:$apdate, APno:$apnumber<br>";
  echo "Payee:$appayee<br>";
  echo "GLcode:\"$glcode\", AEPglcode:\"$aepglcode\", GLaddldetails:\"$glnamedetails\"<br>";
  echo "ProjCode:$projcode<br>";
  echo "Particulars:$allparticulars<br>";
  echo "DebitAmt:$debitamt<br>";
  echo "CreditAmt:$creditamt<br>";
  echo "</td></tr>";

  $res12query=""; $result12="";
  $res12query="INSERT INTO tblfinacctspayable SET acctspayablenumber=\"$apnumber\", payee=\"$appayee\", date=\"$apdate\", glcode=\"$glcode\", glrefver=\"$version17\", glnamedetails=\"$glnamedetails\", projcode=\"$projcode\", particulars=\"$allparticulars\", debitamt=\"$debitamt\", creditamt=\"$creditamt\" , due_date=\"$duedate\", trans_status=\"$status\", company_id=$apcompanyid, contact_id=$apcontactid";
  $result12=$dbh2->query($res12query);

  echo "<tr><td>Details2</td><td>APnumber:$apnumber<br>";
  echo "Date:$datenow<br>";
  echo "Due Date:$duedate<br>";
  echo "Explanation:$explanation<br>";
  echo "DebitTotal:$debittot<br>";
  echo "CreditTotal:$credittot<br>";
  echo "Status:$status<br>";
  echo "compid:$apcompanyid,contid:$apcontactid<br>";
  // echo "$res12query<br>";

  $result16 = mysql_query("SELECT acctspayabletotid FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $acctspayabletotid16 = $myrow16[0];
  }

  if($found16 == 1)
  {
    $result14 = mysql_query("UPDATE tblfinacctspayabletot SET date=\"$apdate\", explanation=\"$explanation\", debittot=$debittot, credittot=$credittot, status=\"$status\" WHERE acctspayabletotid=$acctspayabletotid16 AND acctspayablenumber=\"$apnumber\"", $dbh);
  }
  else
  {
    $result15 = mysql_query("INSERT INTO tblfinacctspayabletot SET acctspayablenumber=\"$apnumber\", date=\"$apdate\", explanation=\"$explanation\", debittot=$debittot, credittot=$credittot, status=\"$status\"", $dbh);
  }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Add new Accts Payable entry with AP:$apnumber - details:$allparticulars";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  echo "<tr><td>Status</td>";
  echo "<form action=\"finvouchapnew.php?loginid=$loginid&apid=$acctspayableid16&apn=$apnumber&appayee=$appayee&duedate=$duedate\" method=\"post\">";
  echo "<td><input type=\"submit\" value=\"OK\" class=\"btn btn-success\" role=\"button\" /></form></td></tr>";
}

    echo "</table>";

    echo "<p><a href=\"finvouchapnew.php?loginid=$loginid&apid=$acctspayableid16&apn=$apnumber\" class=\"btn btn-default\" role=\"button\" />Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

//     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
