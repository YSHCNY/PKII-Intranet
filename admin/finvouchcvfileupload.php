<?php
//
// finvouchcvfileupload.php 20250430
// fr finvouchcvnew.php
//
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$disbursementtotid = (isset($_GET['dtid'])) ? $_GET['dtid'] :'';
$disbursementtotid2 = (isset($_POST['disbursementtotid'])) ? $_POST['disbursementtotid'] :'';
$disbursementnumber = (isset($_POST['disbursementnumber'])) ? $_POST['disbursementnumber'] :'';
$btnCVfileupload = (isset($_POST['btnCVfileupload'])) ? $_POST['btnCVfileupload'] :'';

$target_path0 = "./uploads/finvouch";
$filename = basename( $_FILES['uploadedfile']['name'] );
$filename1 = str_replace(' ', '_', $filename);
if($filename1 != "") { $filenamefin = $disbursementnumber."_".$filename1; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if($found == 1) {
     // include ("header.php");
     // include ("sidebar.php");

// start contents here

    if($filename1!="" && $btnCVfileupload==1) {

    $res2query=""; $result2="";
    $res2query = "UPDATE tblfindisbursementtot SET filepath=\"$target_path0\", filename=\"$filenamefin\" WHERE disbursementtotid=$disbursementtotid AND disbursementnumber=\"$disbursementnumber\"";
    $result2=$dbh2->query($res2query);

    // start file upload if exists  
  $target_path = $target_path0 . "/" . $filename1;
  if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $imagefile = $target_path0 . "/" . $filename1;    
    $newimagefile = $target_path0 . "/" . $filenamefin;    
    rename($imagefile, $newimagefile);    
    echo "$target_path0\n"; 
  } else {
    echo "There was an error uploading the file, please try again!<br>";
  } // if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))

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
    $adminlogdetails = "$loginid:$adminloginuid - Uploaded file attachment for Disbursement voucher $disbursementnumber id:$disbursementtotid2 filepath:$target_path0, filename:$filenamefin";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
		$result17=$dbh2->query($res17query);

    } //if($filename1 != "")
		
	// redirect back to finvouchcvnew
	header("Location: finvouchcvnew.php?loginid=".$loginid."&cvn=".$disbursementnumber."");
	// echo "<p>$res2query<br><a href=\"finvouchcvnew.php?loginid=".$loginid."&cvn=".$disbursementnumber."\">back</a></p>";
// end contents here

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>