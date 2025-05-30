<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$idtblemppassport = (isset($_GET['idpp'])) ? $_GET['idpp'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

/* start here */

if($employeeid!='') {

	if($idtblemppassport!='') {

			// query contactid of personnel thru employeeid
			$res14query = "SELECT contactid FROM tblcontact WHERE employeeid=\"$employeeid\" AND contact_type=\"personnel\"";
			$result14 = $dbh2->query($res14query);
			if($result14->num_rows>0) {
				while($myrow14 = $result14->fetch_assoc()) {
				$found14 = 1;
				$contactid14 = $myrow14['contactid'];
				} // while($myrow14 = $result14->fetch_assoc())
			} // if($result14->num_rows>0)

			// query tblemppassport record

			// delete record
			$res12query = "DELETE FROM tblemppassport WHERE idtblemppassport=$idtblemppassport AND employeeid=\"$employeeid\"";
			$result12 = $dbh2->query($res12query);

			// insert log

	} // if($idtblemppassport!='') 

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
