<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$date = trim($_POST['date']);
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$deptcd = trim($_POST['deptcd']);
$projcode = trim($_POST['projcode']);
$keywords = trim($_POST['keywords']);
$remarks = trim($_POST['remarks']);
// $MAX_FILE_SIZE = $_POST['MAX_FILE_SIZE'];
$uploadedfile = trim($_POST['uploadedfile']);

$target_path0 = "./transfers/archives";
$target_path1 = $target_path0 . "/" . $deptcd;
$filename = basename( $_FILES['uploadedfile']['name'] );
$filename1 = str_replace(' ', '_', $filename);
if($filename1 != "") { $filename2 = $date."_".$filename1; }

$found = 0;

if($loginid != "")
{
	include("logincheck.php");
}

if ($found == 1)
{
//  include('header.php');
//  include('sidebar.php');

// start contents here

if($title != "") {

// insert values to tbldocsarchives
if($filename1 != "") {

  $result12 = mysql_query("INSERT INTO tbldocsarchives SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, title=\"$title\", description=\"$description\", keywords=\"$keywords\", date=\"$date\", deptcd=\"$deptcd\", projcode=\"$projcode\", remarks=\"$remarks\", filename=\"$filename2\", filepath=\"$target_path1\"", $dbh);
  
  // start file upload if exists  
  $target_path = $target_path0 . "/" . $deptcd . "/" . $filename1;
  if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {   
    $imagefile = $target_path0 . "/" . $deptcd . "/" . $filename1;    
    $newimagefile = $target_path0 . "/" . $deptcd . "/" . $filename2;    
    rename($imagefile, $newimagefile);    
    echo "$target_path\n"; 
  } else {
    echo "There was an error uploading the file, please try again!<br>";
  }

} else {

  $result12 = mysql_query("INSERT INTO tbldocsarchives SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, title=\"$title\", description=\"$description\", keywords=\"$keywords\", date=\"$date\", deptcd=\"$deptcd\", projcode=\"$projcode\", remarks=\"$remarks\"", $dbh);  

}
  
  // create log
      $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
      while($myrow16 = mysql_fetch_row($result16))
      { $adminuid16=$myrow16[0]; }
      $adminlogdetails = "$loginid:$adminloginuid - Add new item in Docs Archives title:$title, desc:$description, dept:$deptcd, file:$filename2";
      $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"", $dbh);


// redirect
    header("Location: docsarchive.php?loginid=$loginid&dpt=$deptcd");
    exit;

} else {
	echo "<p><font color=\"red\">Sorry title field should not be blank. Please try again.</font></p>";
	echo "<p><a href=\"docsarchrecadd.php?loginid=$loginid&dpt=$deptcd\">Back</a></p>";
}


// end contents here

//  include("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>