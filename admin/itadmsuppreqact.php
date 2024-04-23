<?php
// from itadmsuppreqdtl.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsupportreq = (isset($_POST['iditsupportreq'])) ? $_POST['iditsupportreq'] :'';
$actionctg = (isset($_POST['actionctg'])) ? $_POST['actionctg'] :'';
$actiondetails = (isset($_POST['actiondetails'])) ? $_POST['actiondetails'] :'';

$classreqtyp = (isset($_POST['classreqtyp'])) ? $_POST['classreqtyp'] :'';

$found = 0;
$accesslevel11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

	/*
	// query name based on loginid and empid
	$res10query="SELECT tblcontact.name_last, tblcontact.name_first FROM tbllogin LEFT JOIN tblcontact ON tbllogin.employeeid=tblcontact.employeeid WHERE tbllogin.loginid=$loginid AND tbllogin.employeeid=\"$employeeid0\"";
	$result10=""; $found10=0; $ctr10=0;
	$result10 = $dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10 = $result10->fetch_assoc()) {
		$found10 = 1;
		$ctr10 = $ctr10 + 1;
		$name_last10 = $myrow10['name_last'];
		$name_first10 = $myrow10['name_first'];
		} // while$myrow10 = $result10->fetch_assoc())
	} // if($result10->num_rows>0)
	*/

	// query tblitsupportreq
	$res11query="SELECT tblitsupportreq.ticketnum, tblitsupportreq.actionctr, tblitsupportreq.closeticketsw FROM tblitsupportreq WHERE tblitsupportreq.iditsupportreq=$iditsupportreq LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11 + 1;
		$ticketnum11 = $myrow11['ticketnum'];
		$actionctr11 = $myrow11['actionctr'];
                $closeticketsw11 = $myrow11['closeticketsw'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

	// increment actionctr
	$actionctr = $actionctr11 + 1;

	if($actionctg!='') {

	// update query
            if($closeticketsw11==1) {
	$res12query="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, actionctr=$actionctr, actionctg=\"$actionctg\", actiondetails=\"$actiondetails\", classreqtyp=$classreqtyp WHERE iditsupportreq=$iditsupportreq";
            } else {
	$res12query="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, actionid=$loginid, actionempid=\"$employeeid0\", actionctr=$actionctr, actionctg=\"$actionctg\", actiondetails=\"$actiondetails\", classreqtyp=$classreqtyp WHERE iditsupportreq=$iditsupportreq";
            } //if-else

	$result12 = $dbh2->query($res12query);
	// echo "<p>res12query:$res12query</p>";

		// prepare and log		
		$logdetails = "$loginid:$username - IT support request - updated actionctg:$actionctg details:$actiondetails for support id:$iditsupportreq ctg:$requestctg11 details:$details11";
		$res17query = "INSERT INTO tbladminlogs SET timestamp=\"$now\", loginid=$loginid, adminuid=\"$username\", adminlogdetails=\"$logdetails\"";
		$result17 = $dbh2->query($res17query);
		// echo "<br>$res17query</p>";

	// redirect
	//header("Location: itsuppreq.php?loginid=$loginid");
	// exit;

	} // if($actionctg!='')

	echo "<p><a href=\"itadmsuppreq.php?loginid=$loginid\">back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");
} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
