<?php 

require("db1.php");
include 'datetimenow.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$username = trim((isset($_POST['username'])) ? $_POST['username'] :'');
$oldpassword = trim((isset($_POST['oldpassword'])) ? $_POST['oldpassword'] :'');
$newpassword1 = trim((isset($_POST['newpassword1'])) ? $_POST['newpassword1'] :'');
$newpassword2 = trim((isset($_POST['newpassword2'])) ? $_POST['newpassword2'] :'');

$pwminlength=6;

$found = 0;

if($loginid != "") {
		include("logincheck.php");
}

if($found == 1) {
	// check if current password, new password and confirm new password are not blank
	if($oldpassword!='' && $newpassword1!='' && $newpassword2!='') {

		// include ("header.php");
		// include ("sidebar.php");


		// query password if correct
		$found2 = 0;
		$res2query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid AND adminpw=md5('$oldpassword')";
		$result2=""; $found2=0; $ctr2=0;
		$result2=$dbh2->query($res2query);
		if($result2->num_rows>0) {
			while($myrow2=$result2->fetch_assoc()) {
			$found2 = 1;
			$username = $myrow2['adminuid'];
			} // while
		} // if

		if($found2 == 1) {
			// check if newpass=cnewpass
			if($newpassword1==$newpassword2) {
				// password validations
		if(strlen($newpassword2) <= $pwminlength) {
        $passwordErr = "Your Password Must Contain At Least 7 Characters!";
	$clstxtclr="text-danger";
	$h4txtdisp=$passwordErr;
	$frmact="admchgpw.php?loginid=$loginid";
	$frmnm="admchgpass";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-primary";
	$btnnm="Back";
	include 'admupdatepw2.php';
    } elseif(!preg_match("#[0-9]+#",$newpassword2)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
	$clstxtclr="text-danger";
	$h4txtdisp=$passwordErr;
	$frmact="admchgpw.php?loginid=$loginid";
	$frmnm="admchgpass";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-primary";
	$btnnm="Back";
	include 'admupdatepw2.php';
    } elseif(!preg_match("#[A-Z]+#",$newpassword2) && !preg_match("#[a-z]+#",$newpassword2)) {
        $passwordErr = "Your Password Must Contain At Least 1 Letter!";
	$clstxtclr="text-danger";
	$h4txtdisp=$passwordErr;
	$frmact="admchgpw.php?loginid=$loginid";
	$frmnm="admchgpass";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-primary";
	$btnnm="Back";
	include 'admupdatepw2.php';
    } else {
        // $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
				// proceed update query
				// include '../m/qryupdatepwd.php';
				$res12query="UPDATE tbladminlogin SET adminpw=md5(\"$newpassword2\") WHERE adminloginid=$loginid AND adminuid=\"$username\"";
				$result12=""; $found12=0;
				$result12=$dbh2->query($res12query);
				// if update query is successful, display success notification
				if($result12) {

        // query employeeid and non-admin loginid from tblsysusracctmgt
        $res12bquery=""; $result12b=""; $found12b=0;
        $res12bquery="SELECT idtblsysusracctmgt, employeeid FROM tblsysusracctmgt WHERE admloginid=$loginid LIMIT 1";
        $result12b=$dbh2->query($res12bquery);
        if($result12b->num_rows>0) {
            while($myrow12b=$result12b->fetch_assoc()) {
            $found12b=1;
            $idtblsysusracctmgt12b = $myrow12b['idtblsysusracctmgt'];
            $employeeid12b = $myrow12b['employeeid'];
            } //while
        } //if

        if($found12b==1 && $employeeid12b!='') {
        // query non-admin loginid from tblsysusracctmgt
        $res12cquery=""; $result12c=""; $found12c=0;
        $res12cquery="SELECT idtblsysusracctmgt, loginid FROM tblsysusracctmgt WHERE employeeid=\"$employeeid12b\" AND admloginid=0";
        $result12c=$dbh2->query($res12cquery);
        if($result12c->num_rows>0) {
            while($myrow12c=$result12c->fetch_assoc()) {
            $found12c=1;
            $idtblsysusracctmgt12c = $myrow12c['idtblsysusracctmgt'];
            $loginid12c = $myrow12c['loginid'];
            } //while
        } //if
        } //if

        // update tblsysusracctmgt, set new pw and pw chg date
        if($found12b==1 && $idtblsysusracctmgt12b!='') {
        // update query for admloginid
        $res12dquery=""; $result12d=""; $found12d=0;
        $res12dquery="UPDATE tblsysusracctmgt SET timestamp=\"$now\", pwchangedt=\"$now\", pwlast=md5(\"$newpassword2\"), skippwctr=0, skiplastdt=\"\" WHERE idtblsysusracctmgt=$idtblsysusracctmgt12b AND admloginid=$loginid AND employeeid=\"$employeeid12b\"";
        $result12d=$dbh2->query($res12dquery);

        } //if

        if($found12c==1 && $idtblsysusracctmgt12c!='') {
        // update query for loginid
        $res12equery=""; $result12e=""; $found12e=0;
        $res12equery="UPDATE tblsysusracctmgt SET timestamp=\"$now\", pwchangedt=\"$now\", pwlast=md5(\"$newpassword2\"), skippwctr=0, skiplastdt=\"\" WHERE idtblsysusracctmgt=$idtblsysusracctmgt12c AND loginid=$loginid12c AND employeeid=\"$employeeid12b\"";
        $result12e=$dbh2->query($res12equery);

        } //if

					// display success and logout button
	$clstxtclr="text-success";
	$h4txtdisp="<font color='green'>Password changed! You need to logout, then login again with your new password.</font>";
	$frmact="admlogout.php?loginid=$loginid";
	$frmnm="logout";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-danger";
	$btnnm="Logout";
	include 'admupdatepw2.php';
					// log
					$logdetails="Password changed for user:$username with loginid:$loginid";
					// include '../m/qryinslog.php';

		// create log
    include('datetimenow.php');
		$res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16="";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			} // while
		} // if
    $adminlogdetails = "$loginid:$adminuid with EmpID $employeeid12b - Password changed.";
		$res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
		$result17=$dbh2->query($res17query);
				} else {
					// display update query error and contact sysad and display back to home button
	$clstxtclr="text-danger";
	$h4txtdisp="Error in changing password. Pls contact your IT administrator.";
	$frmact="admchgpw.php?loginid=$loginid";
	$frmnm="home";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-primary";
	$btnnm="Back";
	include 'admupdatepw2.php';
				} // if-else
    } // if-else password validations
			} else { // if($newpass==$cnewpass)
				// display new passwords do not match error
	$clstxtclr="text-danger";
	$h4txtdisp="New passwords entered, do not match.";
	$frmact="admchgpw.php?loginid=$loginid";
	$frmnm="home";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-primary";
	$btnnm="Back";
	include 'admupdatepw2.php';
			} // if($newpass==$cnewpass)
		} else { // if($found2 == 1)
			// display password error
	$clstxtclr="text-danger";
	$h4txtdisp="Error in current password. Pls try again.";
	$frmact="admchgpw.php?loginid=$loginid";
	$frmnm="home";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-primary";
	$btnnm="Back";
	include 'admupdatepw2.php';
		} // if($found2 == 1)

		} else { // if($password!='' && $newpass!='' && $cnewpass!='')
			// echo "<p><font color=red>Passwords do not match pls. press back button</font></p>";
			// echo "<p><a href=\"admchgpw.php?loginid=$loginid\">Back to Change Password</a></p>";
		// display blank form error and back to chg password page 41
	$clstxtclr="text-danger";
	$h4txtdisp="Error: blank input fields. Pls try again.";
	$frmact="admchgpw.php?loginid=$loginid";
	$frmnm="admchgpw";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-primary";
	$btnnm="Back";
	include 'admupdatepw2.php';
    } // if($password!='' && $newpass!='' && $cnewpass!='')

     include ("footer.php");
} else {
     include ("logindeny.php");
}
mysql_close($dbh);
$dbh2->close();
?> 
