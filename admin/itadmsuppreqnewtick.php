<?php
// from itadmsuppreqdtl.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsupportreq = (isset($_POST['iditsupportreq'])) ? $_POST['iditsupportreq'] :'';

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

	// query ticketnum from tblitsupportreq
	$res11query="SELECT tblitsupportreq.ticketnum FROM tblitsupportreq WHERE tblitsupportreq.ticketnum<>0 ORDER BY tblitsupportreq.ticketnum DESC LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11 + 1;
		$ticketnum11 = $myrow11['ticketnum'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

	// get current year and current month, compare to latest ticketnum and increment
	$curryear = date("Y", strtotime($datenow));
	$currmonth = date("m", strtotime($datenow));
	if($ticketnum11==0) {
		$ticketnumfin = $curryear . $currmonth . "01";
	} else {
		$ticketnumyyyy = substr($ticketnum11, 0, 4);
		$ticketnummm = substr($ticketnum11, 4, 2);
		$ticketnum = substr($ticketnum11, 6, 2);
		if($curryear==$ticketnumyyyy) {
			$ticketnumyyyyfin = $ticketnumyyyy;
		} else {
			$ticketnumyyyyfin = $curryear;
		} // if($curryear==$ticketnumyyyy)
		if($currmonth==$ticketnummm) {
			$ticketnummmfin = $ticketnummm;
		} else {
			$ticketnummmfin = $currmonth;
		} // if($currmonth==$ticketnummm)
		if($ticketnumyyyy==$curryear && $ticketnummm==$currmonth) {
			$ticketnum = $ticketnum+1;
			// ticketnum length if 1, add 0
			if(strlen($ticketnum)==1) {
				$ticketnum = "0" . $ticketnum;
			}
			$ticketnumfin = $ticketnumyyyy . $ticketnummm . $ticketnum;
		} else {
			$ticketnumfin = $curryear . $currmonth . "01";
		}
	} // if($ticketnum11!=0)

	// echo new ticket number
	echo "<br>New ticket number: $ticketnumfin";

	// update query
	$res12query="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, ticketnum=\"$ticketnumfin\", actionid=$loginid, actionempid=\"$employeeid0\" WHERE iditsupportreq=$iditsupportreq";
	$result12 = $dbh2->query($res12query);
	// echo "<p>res12query:$res12query</p>";

		// prepare and log		
		$logdetails = "$loginid:$username - IT support request - assign new ticket no. $ticketnumfin for support id:$iditsupportreq ctg:$requestctg11 details:$details11";
		$res17query = "INSERT INTO tbladminlogs SET timestamp=\"$now\", loginid=$loginid, adminuid=\"$username\", adminlogdetails=\"$logdetails\"";
		$result17 = $dbh2->query($res17query);
		// echo "<br>$res17query</p>";

	// redirect
	//header("Location: itsuppreq.php?loginid=$loginid");
	// exit;

	echo "<p><a href=\"itadmsuppreq.php?loginid=$loginid\">back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
