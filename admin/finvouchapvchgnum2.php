<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$apnumber = trim((isset($_GET['apvn'])) ? $_GET['apvn'] :'');
$apdate0 = trim((isset($_GET['apvdt'])) ? $_GET['apvdt'] :'');

$apvnumberfin = trim((isset($_POST['apnumbernew'])) ? $_POST['apnumbernew'] :'');

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

  if($accesslevel >= 4 && $accesslevel <= 5) {

    $res11query=""; $result11=""; $found11=0;
  $res11query="SELECT acctspayableid, acctspayablenumber, date, payee, company_id, contact_id FROM tblfinacctspayable WHERE acctspayablenumber=\"$apnumber\" AND date=\"$apdate0\"";
  $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
	  while($myrow11=$result11->fetch_assoc()) {
		  $found11=1;
		  $acctspayableid11 = $myrow11['acctspayableid'];
		  // $acctspayablenumber11 = $myrow11['acctspayablenumber'];
		  $date11 = $myrow11['date'];
		  $payee11 = $myrow11['payee'];
		  $company_id11 = $myrow11['company_id'];
		  $contact_id11 = $myrow11['contact_id'];
		  
		$companyidfin=$company_id11;
		$contactidfin=$contact_id11;
		include './finvouchlucompcontids.php';
		
		//update tblacctspayable
		$res12query=""; $result12=""; $found12=0;
		$res12query="UPDATE tblfinacctspayable SET acctspayablenumber=\"$apvnumberfin\" WHERE acctspayableid=$acctspayableid11 AND acctspayablenumber=\"$apnumber\"";
		$result12=$dbh2->query($res12query);
		
	  } //while
  } //if
  
  // query tblfinacctspayabletot
	$res14query=""; $result14=""; $found14=0; $ctr14=0;
	$res14query="SELECT acctspayabletotid FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\"";
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$ctr14++;
			$acctspayabletotid14 = $myrow14['acctspayabletotid'];
			
			// update tblfinacctspayabletot
			$res15query="UPDATE tblfinacctspayabletot SET acctspayablenumber=\"$apvnumberfin\" WHERE acctspayablenumber=\"$apnumber\" AND acctspayabletotid=$acctspayabletotid14";
			$result15=$dbh2->query($res15query);
			
		} //while
	} //if
	


// create log
    include('datetimenow.php');
	$res16query=""; $result16=""; $found16=0;
    $res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$adminuid=$myrow16['adminuid'];
		} //while
	} //if
    $adminlogdetails = "$loginid:$adminuid - Modified APV No. from:$apnumber to:$apvnumberfin with date:$apdate0, payee:$payeefin";
	$res17query=""; $result17="";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17=$dbh2->query($res17query);
  }

  header("Location: finvouchapnew.php?loginid=$loginid&apn=$apvnumberfin");
  exit;
  // echo "<p>r14q: $res14query | f14:$found14<br>r15q: $res15query<br></p>";
  // echo "<p><a href=\"finvouchapnew.php?loginid=$loginid&apn=$apvnumberfin\">continue...</a></p>";

  $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
  $result=$dbh2->query($resquery);

//     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>