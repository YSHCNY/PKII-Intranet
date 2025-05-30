<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['pid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

  // query
  $result11=""; $found11=0;
    $result11 = mysql_query("SELECT filepath, filename, ref_no, proj_name FROM tblprojassign WHERE projassignid=$projassignid AND employeeid=\"$employeeid\"", $dbh);
    if($result11 != "") {
      while($myrow11 = mysql_fetch_row($result11)) {
      $found11 = 1;
      $filepath11 = $myrow11[0];
      $filename11 = $myrow11[1];
      $ref_no11 = $myrow11[2];
      $proj_name11 = $myrow11[3];
      }
    }
    
    // delete file if exists
    if($filename11 != "") {
      $filetodelete = "$filepath11/$filename11";
      unlink("$filetodelete");
      // update datacenter table
      $result12 = mysql_query("UPDATE tblprojassign SET projdate=\"$datenow\", filepath=\"\", filename=\"\" WHERE projassignid=$projassignid AND employeeid=\"$employeeid\"", $dbh);
    }

    // insert log
    $logdetails = "loginid:". $loginid . " removed attached file from empid:$employeeid, ref:$ref_no11, proj:$proj_name11, file:$filepath11/$filename11";

    $result14 = mysql_query("INSERT INTO tbllogs (timestamp, loginid, username, logdetails) VALUES (\"$now\", $loginid, \"$username\", \"$logdetails\")", $dbh);

// redirect
   header("Location: personnelprojassignedit.php?loginid=$loginid&eid=$employeeid&prjid=$projassignid");
   exit;

}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
