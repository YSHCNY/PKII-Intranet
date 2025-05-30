<?php

//
// admpwskip.php // 20230112
//
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header2.php");
     // include ("sidebar.php");

// start contents here
// echo "1<br>";
    //query tblsysusracctmgt
    $res11query=""; $result11=""; $found11=0;
    $res11query="SELECT idtblsysusracctmgt, loginid, employeeid, pwchangedt, skippwctr, skiplastdt FROM tblsysusracctmgt WHERE admloginid=$loginid LIMIT 1";
    $result11=$dbh2->query($res11query);
    if($result11->num_rows>0) {
        while($myrow11=$result11->fetch_assoc()) {
        $found11=1;
        $idtblsysusracctmgt11 = $myrow11['idtblsysusracctmgt'];
        $loginid11 = $myrow11['loginid'];
        $employeeid11 = $myrow11['employeeid'];
        $pwchangedt11 = $myrow11['pwchangedt'];
        $skippwctr11 = $myrow11['skippwctr'];
        $skiplastdt11 = $myrow11['skiplastdt'];
        } //while
    } //if
// echo "r11q: $res11query <br />";
// echo "2<br>";

    if($found11==1) {
        $skippwctr = $skippwctr11 + 1;
        $skiplastdt = date('Y-m-d', strtotime('+1 month', strtotime($datenow)));
// echo "2.1<br>";
        if($skiplastdt11<$datenow) {
        // update query
        $res12query=""; $result12=""; $found12=0;
        $res12query="UPDATE tblsysusracctmgt SET skippwctr=$skippwctr, skiplastdt=\"$skiplastdt\" WHERE idtblsysusracctmgt=$idtblsysusracctmgt11";
        $result12=$dbh2->query($res12query);

    echo "<h3><font color='green'>Successfully skipped the change user password.</font></h3>";
    echo "<p>Date of next user login password change prompt reminder is on: ".date('Y-M-d', strtotime($skiplastdt))."</p>";

        
        } //if
// echo "2.2<br>";
        // query tblsysusracctmgt for non-admin
        $res14query=""; $result14=""; $found14=0;
        $res14query="SELECT idtblsysusracctmgt, admloginid, employeeid, pwchangedt, skippwctr, skiplastdt FROM tblsysusracctmgt WHERE loginid=$loginid AND admloginid=0 AND employeeid=\"$employeeid11\" LIMIT 1";
        $result14=$dbh2->query($res14query);
        if($result14->num_rows>0) {
            while($myrow14=$result14->fetch_assoc()) {
            $found14=1;
            $idtblsysusracctmgt14 = $myrow14['idtblsysusracctmgt'];
            $admloginid14 = $myrow14['admloginid'];
            $employeeid14 = $myrow14['employeeid'];
            $pwchangedt14 = $myrow14['pwchangedt'];
            $skippwctr14 = $myrow14['skippwctr'];
            $skiplastdt14 = $myrow14['skiplastdt'];
            } //while
        } //if
// echo "2.3<br>";

        if($found14==1) {
            $skippwctr2 = $skippwctr14 + 1;
            if($skiplastdt14<$datenow) {
            //update query

        // update query
        $res15query=""; $result15=""; $found15=0;
        $res15query="UPDATE tblsysusracctmgt SET skippwctr=$skippwctr2, skiplastdt=\"$skiplastdt\" WHERE idtblsysusracctmgt=$idtblsysusracctmgt14";
        $result15=$dbh2->query($res15query);
            } //if
        } //if
// echo "2.4<br>";

  // insert log
    // get adminuid first
	$res17query=""; $result17=""; $found17=0;
	$res17query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
	$result17=$dbh2->query($res17query);
	if($result17->num_rows>0) {
	    while($myrow17=$result17->fetch_assoc()) {
        $found17=1;
		$adminuid17 = $myrow17['adminuid'];
        }			
	}
  $logdetails="loginid:$loginid User $adminuid17 skipped user pw change. Next pw chg prompt on $skiplastdt. tblsysusracctmgt admid:$idtblsysusracctmgt11, non-admid:$idtblsysusracctmgt14";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid17', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);

    } //if

    echo "<p><a href=\"index.php\">back to Login</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");

} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
