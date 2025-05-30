<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$apnumber = trim((isset($_GET['apvn'])) ? $_GET['apvn'] :'');
$apdate0 = trim((isset($_GET['apvdt'])) ? $_GET['apvdt'] :'');

// $payeesw = (isset($_POST['payeesw'])) ? $_POST['payeesw'] :'';
// $payeecompanyid = (isset($_POST['apcompid'])) ? $_POST['apcompid'] :'';
// $payeecontactid = (isset($_POST['payeecontactid'])) ? $_POST['payeecontactid'] :'';
$payeesw = $_POST['payeesw'];
$payeecompanyid = $_POST['payeecompanyid'];
$payeecontactid = $_POST['payeecontactid'];

// echo "vartest<br>loginid:$loginid,apvn:$apnumber,apvdt:$apdate0;payeesw:$payeesw,compid:$payeecompanyid,contctid:$payeecontactid";

if($payeesw=='company') {
	$payeecontactid=0;
} elseif($payeesw=='contactperson') {
	$payeecompanyid=0;
} //if-elseif

// echo "<br>vartest2<br>loginid:$loginid,apvn:$apnumber,apvdt:$apdate0;payeesw:$payeesw,compid:$payeecompanyid,contctid:$payeecontactid";

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
		$payeefinori = $payeefin;
		
		if($payeesw=='company') {
			$payeecontactid=0;
			$companyidfin=$payeecompanyid;
			$contactidfin=$payeecontactid;
			include './finvouchlucompcontids.php';	
		} elseif($payeesw=='contactperson') {
			$payeecompanyid=0;
			$companyidfin=$payeecompanyid;
			$contactidfin=$payeecontactid;
			include './finvouchlucompcontids.php';
		} //if-else
			
		$res12query=""; $result12=""; $found12=0;
		$res12query="UPDATE tblfinacctspayable SET payee=\"$payeefin\", company_id=$payeecompanyid, contact_id=$payeecontactid WHERE acctspayableid=$acctspayableid11 AND acctspayablenumber=\"$apnumber\"";
		$result12=$dbh2->query($res12query);
// echo "<p>r12q: $res12query</p>";
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
    $adminlogdetails = "$loginid:$adminuid - Modified APV Payee from:$payeefinori,compid:$company_id11,contctid:$contact_id11 to:$payeefin,compid:$payeecompanyid,contctid:$payeecontactid with APV No.:$apnumber date:$apdate0";
	$res17query=""; $result17="";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17=$dbh2->query($res17query);
	// echo "<p>logdtl: $adminlogdetails<br>r17q: $res17query</p>";
  }

  header("Location: finvouchapnew.php?loginid=$loginid&apn=$apnumber");
  exit;
  // echo "<p><a href=\"finvouchapnew.php?loginid=$loginid&apn=$apnumber\">continue...</a></p>";

  $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
  $result=$dbh2->query($resquery);

//     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>