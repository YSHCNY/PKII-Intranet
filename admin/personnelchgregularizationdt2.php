<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$newdate = (isset($_POST['regndt'])) ? $_POST['regndt'] :'';

// echo "<p>vartest rdt:$newdate</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

//     echo "<p><font size=1>Directory >> Manage Personnel >> Change Regularization Date</font></p>";

//	echo "<p><font color=green><b>Update successful!</b></font></p>";

        $res0query=""; $result0="";
	$res0query = "SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = \"$pid\" AND `contact_type`='personnel'";
        $result0=$dbh2->query($res0query);
        if($result0->num_rows>0) {
            while($myrow0=$result0->fetch_assoc()) {
	  $employeeid = $myrow0['employeeid'];
	  $name_last = $myrow0['name_last'];
	  $name_first = $myrow0['name_first'];
	  $name_middle = $myrow0['name_middle'];
            } //while
        } //if

//	echo "<p>Regularization Date changed for: <b>$pid - $name_last, $name_first $name_middle[0]</b> to $newdate</p>";

        $res12query=""; $result12="";
	$res12query="UPDATE tblemployee SET regularizationdt = \"$newdate\" WHERE employeeid='$pid'";
        $result12=$dbh2->query($res12query);

//	echo "regularization_date = $newdate<br>";
//	echo "Update Record - OK<br>";

//  echo "<p>";

//     echo "<p><a href=\"personneledit2.php?pid=$pid&loginid=$loginid\">Back to Edit Personnel Info</a><br>";

        if($result12!="") {

		// create log
        $res16query=""; $result16="";
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid LIMIT 1";
        $result16=$dbh2->query($res16query);
        if($result16->num_rows>0) {
            while($myrow16=$result16->fetch_assoc()) {
            $adminuid=$myrow16['adminuid'];
            } //while
        } //if

		$adminlogdetails = "$loginid:$adminuid - change or added date of regularization to: $newdate for employee: $employeeid - $name_last, $name_first $name_middle";
            $res17query=""; $result17="";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
            $result17=$dbh2->query($res17query);

        } //if

	// redirect
	header("Location: personneledit2.php?pid=$pid&loginid=$loginid");
	exit;
    // echo "<p>r12q: $res12query<br><br><a href=\"personneledit2.php?pid=$pid&loginid=$loginid\">tmp:back.btn</a></p>";

  $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

//     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 

