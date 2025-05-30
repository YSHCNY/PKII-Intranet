<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpersreq = (isset($_GET['idhpr'])) ? $_GET['idhpr'] :'';

$idhrpersreqcand22 = (isset($_POST['idhrpersreqcand'])) ? $_POST['idhrpersreqcand'] :'';
$contactid22 = (isset($_POST['contactid'])) ? $_POST['contactid'] :'';
$title = trim((isset($_POST['title'])) ? $_POST['title'] :'');
$uploadedfile = (isset($_POST['uploadedfile'])) ? $_POST['uploadedfile'] :'';
// MAX_FILE_SIZE
$empsection = "tblcontact";
$target_path0 = "./uploads/empfiles/tblcontact";

	// prepare filename
	$filename0 = basename( $_FILES['uploadedfile']['name'] );
	$filename = str_replace(' ', '_', $filename0);
	if($employeeid22!='') {
		$filenamefin = $contactid22."_".$employeeid22."_".$filename;
	} else {
		$filenamefin = $contactid22."__".$filename;
	} // if($employeeid22!='')


$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
//      include ("header.php");
//      include ("sidebar.php");

//     echo "<p><font size=1>Directory >> Manage Personnel >> Edit Project Assignment >> Update project assignment</font></p>";

//	echo "<p><font color=green><b>Project assignment updated!</b></font></p>";

  $res22query = "SELECT name_last, name_first, name_middle, employeeid FROM tblcontact WHERE contactid=$contactid22";
	$result22="";
	$result22=$dbh2->query($res22query);
	if($result22->num_rows>0) {
		while($myrow22=$result22->fetch_assoc()) {
	$found22 = 1;
	$name_last22 = $myrow22['name_last'];
	$name_first22 = $myrow22['name_first'];
	$name_middle22 = $myrow22['name_middle'];
	$employeeid22 = $myrow22['employeeid'];
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

  if($filename!='') {

  // start file upload if exists  
  $target_path = $target_path0 . "/" . $filename;
  if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $imagefile = $target_path0 . "/" . $filename;    
    $newimagefile = $target_path0 . "/" . $filenamefin;    
    rename($imagefile, $newimagefile);    
    // echo "$target_path0\n"; 
	// insert query
		$res23query = "INSERT INTO tblempfiles SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, title=\"$title\", empsection=\"$empsection\", filepath=\"$target_path0\", filename=\"$filenamefin\", contactid=$contactid22";
		$result23=$dbh2->query($res23query);
	// create log
    include('datetimenow.php');
    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16="";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16=$result16->fetch_assoc())
		} // if($result16->num_rows>0)
    $adminlogdetails = "$loginid:$adminloginuid - uploaded document file for HR personnel request module of candidate $contactid22 - $name_last22, $name_first22 $name_middle22[0] with idhrpersreq:$idhrpersreq and idhrpersreqcand:$idhrpersreqcand22";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
	$result17=$dbh2->query($res17query);
  } // if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
	// echo "<p>$res23query<br>$res17query</p>";
  } // if($filename != "")

	// redirect
	header("Location: hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq");
	exit;

  $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
	$result=$dbh2->query($resquery);

//      include ("footer.php");
} else {
     include("logindeny.php");
}
$dbh2->close();
?>
