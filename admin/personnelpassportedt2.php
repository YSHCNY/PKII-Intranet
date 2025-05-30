<?php
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$idtblemppassport = (isset($_GET['idpp'])) ? $_GET['idpp'] :'';

$passportnum = (isset($_POST['passportnum'])) ? trim($_POST['passportnum']) :'';
$countrycd = (isset($_POST['countrycd'])) ? $_POST['countrycd'] :'';
$issuedby = (isset($_POST['issuedby'])) ? trim($_POST['issuedby']) :'';
$dateissued = (isset($_POST['dateissued'])) ? $_POST['dateissued'] :'';
$dateexpiry = (isset($_POST['dateexpiry'])) ? $_POST['dateexpiry'] :'';

$target_path0 = "./uploads/passport";
$filename = basename( $_FILES['uploadedfile']['name'] );
$filename1 = str_replace(' ', '_', $filename);
if($filename1 != "") { $filenamefin = $employeeid."_".$filename1; } else { $filenamefin=''; $target_path0=''; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

/* start here */

if($employeeid!='') {

	if($passportnum!='') {

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
			$res12query = "UPDATE tblemppassport SET timestamp=\"$now\", idlogin=\"$loginid\", passportnum=\"$passportnum\", countrycd=\"$countrycd\", issuedby=\"$issuedby\", dateissued=\"$dateissued\", dateexpiry=\"$dateexpiry\", filepath=\"$target_path0\", filename=\"$filenamefin\" WHERE idtblemppassport=$idtblemppassport";
			$result12 = $dbh2->query($res12query);

	if($filename1!='') {
		// upload file

	}
	$message = "Passport Details Updated Sucessfully!";
	$_SESSION['success_message'] = $message;
?>
	<script>
		   const employeeid = encodeURIComponent("<?php echo $employeeid; ?>");
		   const loginid = encodeURIComponent("<?php echo $loginid; ?>");
		   const insuranceempid = encodeURIComponent("<?php echo $idtblemppassport; ?>");

		   window.location.href = `personnelpassportedt.php?loginid=${loginid}&eid=${employeeid}&idpp=${insuranceempid}`;
	   </script>
		 <?php
	// insert logs
	// $idtblemppassport
	// redirect back
	exit;

	} // if($passportnum!='') 

} // if($employeeid!='')

/* end here */
	
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
