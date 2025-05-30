<?php
//
// finvouchapvfileupload.php 20250502
// fr finvouchapnew.php
//
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$acctspayabletotid = (isset($_GET['aptid'])) ? $_GET['aptid'] :'';
$acctspayablenumber0 = (isset($_GET['apvn'])) ? $_GET['apvn'] :'';
$acctspayabletotid2 = (isset($_POST['acctspayabletotid'])) ? $_POST['acctspayabletotid'] :'';
$acctspayablenumber = (isset($_POST['acctspayablenumber'])) ? $_POST['acctspayablenumber'] :'';
$btnAPVfileupload = (isset($_POST['btnAPVfileupload'])) ? $_POST['btnAPVfileupload'] :'';

$target_path0 = "./uploads/finvouch";
$filename = basename( $_FILES['uploadedfile']['name'] );
$filename1 = str_replace(' ', '_', $filename);
if($filename1 != "") { $filenamefin = $acctspayablenumber."_".$filename1; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if($found == 1) {
     // include ("header.php");
     // include ("sidebar.php");

// start contents here

    if($filename1!="" && $btnAPVfileupload==1) {

    $res2query=""; $result2="";
    $res2query = "UPDATE tblfinacctspayabletot SET filepath=\"$target_path0\", filename=\"$filenamefin\" WHERE acctspayabletotid=$acctspayabletotid AND acctspayablenumber=\"$acctspayablenumber\"";
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
    $adminlogdetails = "$loginid:$adminloginuid - Uploaded file attachment for Accts Payable voucher $acctspayablenumber id:$acctspayabletotid2 filepath:$target_path0, filename:$filenamefin";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
		$result17=$dbh2->query($res17query);

    } //if($filename1 != "")
		
	// redirect back to finvouchcvnew
	header("Location: finvouchapnew.php?loginid=".$loginid."&apn=".$acctspayablenumber."");

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>