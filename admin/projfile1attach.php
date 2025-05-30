<?php

require("db1.php");
include './datetimenow.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$proj_code = $_POST['proj_code'];
$projectid = $_POST['projectid'];

$uploadedfile = trim($_POST['uploadedfile']);
$target_path0 = "./uploads/projdocs";
// $target_path1 = $target_path0 . "/" . $proj_code . "_PDS_";
$filename = basename( $_FILES['uploadedfile']['name'] );
$filename1 = str_replace(' ', '_', $filename);
if($filename1 != "") { $filename2 = $proj_code . "_PDS_" . $datenow . "_" . $filename1; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

if($filename1!='') {

  // start upload
  // start file upload if exists
  $target_path = $target_path0 . "/" . $filename1;
  if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $imagefile = $target_path0 . "/" . $filename1;
    $newimagefile = $target_path0 . "/" . $filename2;
    rename($imagefile, $newimagefile);
    echo "$target_path\n";
  } else {
    echo "There was an error uploading the file, please try again!<br>";
  } // if-else
  $filename1=$filename2;
  $filepath1=$target_path0;

} else {

  // query filename1 & filepath1 if exists, then disregard upload file
  $res12query=""; $result12=""; $found12=0;
  $res12query="SELECT filename1, filepath1 FROM tblproject1 WHERE proj_code=\"$proj_code\" LIMIT 1";
  $result12=$dbh2->query($res12query);
  if($result12->num_rows>0) {
    while($myrow12=$result12->fetch_assoc()) {
    $found12=1;
    $filename112 = $myrow12['filename1'];
    $filepath112 = $myrow12['filepath1'];
    } // while
  } // if
  if($found12==1) {
    $filename1=$filename112;
    $filepath1=$filepath112;
  } else {
    $filename1='';
    $filepath1='';
  } // if

} // if-else 

  // update query
  $resquery="UPDATE tblproject1 SET filename1=\"$filename1\", filepath1=\"$filepath1\" WHERE projectid=$pid AND proj_code=\"$proj_code\"";
	$result=$dbh2->query($resquery);

  // insert log
  $logdetails="Uploaded PDS file attachment $filepath1/$filename1 for projid:$pid, proj_code:$proj_code";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	header("Location: editproj.php?loginid=$loginid&pid=$pid");
	exit;

} else {
     include("logindeny.php");
}

$dbh2->close();
?>
