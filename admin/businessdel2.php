<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_POST['loginid'])) ? $_POST['loginid'] :'';
$companyid = (isset($_POST['cid'])) ? $_POST['cid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

// query company id, name & branch
    $res11query=""; $result11=""; $found11=0;
	$res11query="SELECT companyid, company, branch, supplierid FROM tblcompany WHERE companyid=$companyid";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$companyid11 = $myrow11['companyid'];
			$company11 = $myrow11['company'];
			$branch11 = $myrow11['branch'];
			$supplierid11 = $myrow11['supplierid'];
		} //while
	} //if

// delete record
  $res12query = "DELETE FROM tblcompany WHERE companyid=$companyid11";
  $result12=$dbh2->query($res12query);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted company record: $companyid11 - $company11 - $branch11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: businessedit.php?loginid=$loginid");
  exit;

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);


//     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 

