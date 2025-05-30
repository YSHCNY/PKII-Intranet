<?php 
//
// finvouchapvpartedit2.php 20210208
// fr finvouchapvparedit.php

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$acctspayableid = (isset($_GET['apid'])) ? $_GET['apid'] :'';
$acctspayablenumber = (isset($_GET['apn'])) ? $_GET['apn'] :'';

$glcode = (isset($_POST['glcode'])) ? $_POST['glcode'] :'';
$aepglcode = (isset($_POST['aepglcode'])) ? $_POST['aepglcode'] :'';
$glnamedetails = (isset($_POST['glnamedetails'])) ? $_POST['glnamedetails'] :'';
// particulars
$projcode = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';
$debitamt = (isset($_POST['debitamt'])) ? $_POST['debitamt'] :'';
$creditamt = (isset($_POST['creditamt'])) ? $_POST['creditamt'] :'';

$status = "pending";

$found = 0;

if($loginid!="") {
     include("logincheck.php");
} //if

if($found==1) {
//     include ("header.php");
//     include ("sidebar.php");

// start contents here


  if($debitamt == '' && $creditamt == '') { $proceed = 0; }
  else { $proceed = 1; }

if($proceed == 0) {

  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, either debit or credit fields should have a value. Please try again.</font></td></tr>";
			echo "</table>";

} elseif($proceed == 1) {

// choose default glcode version
  $result17 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
  while($myrow17 = mysql_fetch_row($result17)) {
    $version17 = $myrow17[0];
  } //while

// get glname from current glcode
  if($glcode != '') {
    $result18 = mysql_query("SELECT glname FROM tblfinglref WHERE version=$version17 AND glcode=\"$glcode\"", $dbh);
    while($myrow18 = mysql_fetch_row($result18)) {
      $found18 = 1;
      $glname18 = $myrow18[0];
    } //while
    if($version17 == 1) {
    	if($glcode == "20.10.208" || $glname == "Accrued Expense Payable") {
     		$glname18 = "AEP";
     		$result20 = mysql_query("SELECT glname FROM tblfinglref WHERE version=$version17 AND glcode=\"$aepglcode\"", $dbh);
     		while($myrow20 = mysql_fetch_row($result20)) {
     			$found20 = 1;
     			$aepglname20 = $myrow20[0];
     		} //while
		if($aepglcode == '') {
		  $glname18 = "Accrued Expense Payable";
		} //if
     	} //if
    } elseif($version17 == 2) {
     	if($glcode == "20.10.210" || $glname == "Accrued Expense Payable") {
     		$glname18 = "AEP";
     		$result20 = mysql_query("SELECT glname FROM tblfinglref WHERE version=$version17 AND glcode=\"$aepglcode\"", $dbh);
     		while($myrow20 = mysql_fetch_row($result20)) {
     			$found20 = 1;
     			$aepglname20 = $myrow20[0];
     		} //while
     	} //if
    } //if-elseif
  } //if-elseif

// get projname from current projcode
  if($projcode!="-") {
		$result19=""; $found19=0;
    $result19 = mysql_query("SELECT proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$projcode\"", $dbh);
    while($myrow19 = mysql_fetch_row($result19)) {
      $found19 = 1;
      $proj_fname19 = $myrow19[0];
      $proj_sname19 = $myrow19[1];
    } //while
		if($found19 == 1) {
    	if($proj_sname19 == '') {
      	$proj_sname19 =  substr($proj_fname19, 0, 35);
			} //if
		} //if
  } //if

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

    $res12query=""; $result12="";
  $res12query="UPDATE tblfinacctspayable SET glcode=\"$glcode\", glrefver=\"$version17\", glnamedetails=\"$glnamedetails\", projcode=\"$projcode\", particulars=\"$allparticulars\", debitamt=\"$debitamt\", creditamt=\"$creditamt\" WHERE acctspayableid=$acctspayableid AND acctspayablenumber=\"$acctspayablenumber\"";
    $result12=$dbh2->query($res12query);

// update debittot and credittot
    $res11query=""; $result11=""; $found11=0; $ctr11=0;
  $res11query="SELECT debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber=\"$acctspayablenumber\" AND acctspayableid<>$acctspayableid";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $ctr11++;
        $debitamt11 = $myrow11['debitamt'];
        $creditamt11 = $myrow11['creditamt'];
    // compute total
    $debittot11 = $debittot11 + $debitamt11;
    $credittot11 = $credittot11 + $creditamt11;
    // reset vars
    $debitamt11 = 0; $creditamt11 = 0;
        } //while
    } //if

  if($debitamt == "") { $debitamt = 0; }
  if($creditamt == "") { $creditamt = 0; }

    $res16query=""; $result16=""; $found16=0;
    $res16query="SELECT acctspayabletotid, explanation FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber\"";
    $result16=$dbh2->query($res16query);
    if($result16->num_rows>0) {
        while($myrow16=$result16->fetch_assoc()) {
        $found16=1;
    $acctspayabletotid16 = $myrow16['acctspayabletotid'];
		$explanation16 = $myrow16['explanation'];
        } //while
    } //if

	if($explanation16 != "") { $explanationfin=$explanation16; }
	else if($explanation != "") { $explanationfin=$explanation; }

  if($found16 == 1) {

    // compute new total
    $debittot11 = $debittot11 + $debitamt;
    $credittot11 = $credittot11 + $creditamt;

    // update tblfinacctspayabletot
    $res14query=""; $result14="";
    $res14query="UPDATE tblfinacctspayabletot SET debittot=$debittot11, credittot=$credittot11 WHERE acctspayabletotid=$acctspayabletotid16 AND acctspayablenumber=\"$acctspayablenumber\"";
    $result14=$dbh2->query($res14query);

  } //if

// create log
    include('datetimenow.php');
    $res16query=""; $result16="";
    $res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
    $result16=$dbh2->query($res16query);
    if($result16->num_rows>0) {
        while($myrow16=$result16->fetch_assoc()) {
        $adminuid=$myrow16['adminuid'];
        } //while
    } //if
    $adminlogdetails = "$loginid:$adminloginuid - Modified AP Voucher item with APV_id:$acctspayableid APV_No.:$acctspayablenumber - details:$allparticulars, acctcode:$glcode, debit:$debitamt, credit:$creditamt";
    $res17query=""; $result17=""; $found17=0;
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
    $result17=$dbh2->query($res17query);
}

  header("Location: finvouchapnew.php?loginid=$loginid&apid=$acctspayableid&apn=$acctspayablenumber");
  exit;
  // echo "<p>r12q: $res12query<br>r14q: $res14query<br>r17q: $res17query</p>";
  // echo "<p><a href=\"finvouchapnew.php?loginid=$loginid&apid=$acctspayableid&apn=$acctspayablenumber\">continue...</a></p>";

// end contents here

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);

//     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
