<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$iddocsarchives = $_GET['idda'];

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

	// query based on id from tbldocsarchives
	$result10=""; $found10=0; $ctr10=0;
	$result10 = mysql_query("SELECT timestamp, loginid, datecreated, createdby, title, description, keywords, date, ctgarchivetyp, deptcd, projcode, remarks, filename, filepath FROM tbldocsarchives WHERE iddocsarchives=$iddocsarchives", $dbh);
	if($result10 != "") {
		while($myrow10 = mysql_fetch_row($result10)) {
		$found10 = 1;
		$timestamp10 = $myrow10[0];
		$loginid10 = $myrow10[1];
		$datecreated10 = $myrow10[2];
		$createdby10 = $myrow10[3];
		$title10 = $myrow10[4];
		$description10 = $myrow10[5];
		$keywords10 = $myrow10[6];
		$date10 = $myrow10[7];
		$ctgarchivetyp10 = $myrow10[8];
		$deptcd10 = $myrow10[9];
		$projcode10 = $myrow10[10];
		$remarks10 = $myrow10[11];
		$filename10 = $myrow10[12];
		$filepath10 = $myrow10[13];
		}
	}

	// delete file if exists
  if($filename10 != "") {
  	$filetodelete = "$filepath10/$filename10";
   	unlink("$filetodelete");
    // update datacenter table
    $result12 = mysql_query("UPDATE tbldocsarchives SET timestamp=\"$now\", loginid=$loginid, filepath=\"\", filename=\"\" WHERE iddocsarchives=$iddocsarchives", $dbh);
  }


  // create log
      $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
      while($myrow16 = mysql_fetch_row($result16))
      { $adminuid16=$myrow16[0]; }
      $adminlogdetails = "$loginid:$adminloginuid - deleted file attachment on an item in Docs Archives title:$title10, desc:$description10, dept:$deptcd10, deletedfile:$filename10";
      $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"", $dbh);


	// redirect
    header("Location: docsarchrecedit.php?loginid=$loginid&idda=$iddocsarchives");
    exit;

// end contents here

//  include("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
