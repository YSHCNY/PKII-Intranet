<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$passportnum = (isset($_POST['passportnum'])) ? trim($_POST['passportnum']) :'';
$countrycd = (isset($_POST['countrycd'])) ? $_POST['countrycd'] :'';
$issuedby = (isset($_POST['issuedby'])) ? trim($_POST['issuedby']) :'';
$dateissued = (isset($_POST['dateissued'])) ? $_POST['dateissued'] :'';
$dateexpiry = (isset($_POST['dateexpiry'])) ? $_POST['dateexpiry'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

/* start here */

if($employeeid!='') {

	if($passportnum!='') {
		// query passport number if exists, then notify display edit window
		$res11query = "SELECT idtblemppassport FROM tblemppassport WHERE employeeid=\"$employeeid\" AND passportnum=\"$passportnum\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idtblemppassport = $myrow11['idtblemppassport'];
			} // while($myrow11 = $result11->fetch_assoc())
		} // if($result11->num_rows>0)
		if($found11 == 1) {
			// warn user that passportnumber exists
			echo "<h2><font color=\"red\">Sorry, passport number exists on this personnel. Pls try again.</font></h2>";
			echo "<p><a href=\"personnelpassportadd.php?loginid=$loginid&eid=$employeeid\">back</a></p>";
		} else { // if($found11 == 1)
			// query contactid of personnel thru employeeid
			$res14query = "SELECT contactid FROM tblcontact WHERE employeeid=\"$employeeid\" AND contact_type=\"personnel\"";
			$result14 = $dbh2->query($res14query);
			if($result14->num_rows>0) {
				while($myrow14 = $result14->fetch_assoc()) {
				$found14 = 1;
				$contactid14 = $myrow14['contactid'];
				} // while($myrow14 = $result14->fetch_assoc())
			} // if($result14->num_rows>0)
			// insert new record to tblemppassport
			$res12query = "INSERT INTO tblemppassport SET timestamp=\"$now\", idlogin=\"$loginid\", datecreated=\"$datenow\", createdby=$loginid, passportnum=\"$passportnum\", countrycd=\"$countrycd\", issuedby=\"$issuedby\", dateissued=\"$dateissued\", dateexpiry=\"$dateexpiry\", employeeid=\"$employeeid\", contactid=$contactid14";
			$result12 = $dbh2->query($res12query);
		} // if($found11 == 1)

	} // if($passportnum!='') 

} // if($employeeid!='')

/* end here */

	// redirect back
	header("Location: personneledit2.php?loginid=$loginid&pid=$employeeid");
	exit;
	
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
