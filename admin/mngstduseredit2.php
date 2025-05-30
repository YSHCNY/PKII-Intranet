<?php 
// session
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$loginid0 = (isset($_GET['stdlid'])) ? $_GET['stdlid'] :'';

$username0 = (isset($_POST['username'])) ? $_POST['username'] :'';
$newempid = (isset($_POST['newempid'])) ? $_POST['newempid'] :'';
$loginremarks = (isset($_POST['loginremarks'])) ? $_POST['loginremarks'] :'';

// employeeid = $_POST['employeeid'];

$found = 0;
$found11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
		// include ("header.php");
		// include ("sidebar.php");

	if($username0!='') {
		// chk existing empid
		$res11query="SELECT date_created, time_login, time_logout, remarks_login, login_status, login_level, employeeid, contactid FROM tbllogin WHERE loginid=$loginid0 AND username=\"$username0\"";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$date_created11 = $myrow11['date_created'];
			$time_login11 = $myrow11['time_login'];
			$time_logout11 = $myrow11['time_logout'];
			$remarks_login11 = $myrow11['remarks_login'];
			$login_status11 = $myrow11['login_status'];
			$login_level11 = $myrow11['login_level'];
			$employeeid11 = $myrow11['employeeid'];
			$contactid11 = $myrow11['contactid'];
			} // while
		} // if

		if($found11==1) {

			if($employeeid11!=$newempid) {
			// update tbllogin
			$res12query="UPDATE tbllogin SET employeeid=\"$newempid\" WHERE loginid=$loginid0 AND username=\"$username0\"";
			$result12="";
			$result12=$dbh2->query($res12query);
			} // if

			if($loginremarks=='disabled') {
			// set remarks_login to disabled
			$remarks_login=$loginremarks.$remarks_login11;
			$login_status=0;
			$disabled=1;
			$logintype=1;
			// update tbllogin and tblloginstatus
			$res14query="UPDATE tbllogin SET remarks_login=\"$remarks_login\", login_status=$login_status WHERE loginid=$loginid0 AND username=\"$username0\"";
			$result14="";
			$result14=$dbh2->query($res14query);
			$res15query="UPDATE tblloginstatus SET session='', status=$login_status, disabled=$disabled WHERE loginid=$loginid0 AND logintype=$logintype";
			$result15="";
			$result15=$dbh2->query($res15query);

			$message = "Success! user <b>$username0</b> account has been <b>DISABLED</b>";
			$_SESSION['success'] = $message;



			} else {
			$remarks_login=""; $login_status=1; $disabled=0; $logintype=1;
			$res14query="UPDATE tbllogin SET remarks_login=\"$remarks_login\", login_status=$login_status WHERE loginid=$loginid0 AND username=\"$username0\"";
			$result14="";
			$result14=$dbh2->query($res14query);
			$res15query="UPDATE tblloginstatus SET session='', status=$login_status, disabled=$disabled WHERE loginid=$loginid0 AND logintype=$logintype";
			$result15="";
			$result15=$dbh2->query($res15query);
			$message = "Success! user <b>$username0</b> account has been <b>ENABLED</b>";
			$_SESSION['success'] = $message;
        //20221014 upd tblsysusracctmgt set attempt=0
        $res18query=""; $result18=""; $found18=0;
        $res18query="UPDATE tblsysusracctmgt SET attempt=0 WHERE loginid=$loginid0 AND admloginid=0";
        $result18=$dbh2->query($res18query);
			} // if

      // create log
      $res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
			$result16="";
			$result16=$dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16=$result16->fetch_assoc()) {
				$found16=1;
				$adminuid16=$myrow16['adminuid'];
				} // while
			} // if
      $adminlogdetails = "loginid:$loginid:$adminuid16 - Edit standard (non-admin) user $loginid0:$username0, empid:$newempid, status:$login_status, disabled:$disabled";
      $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"";
			$result17="";
			$result17=$dbh2->query($res17query);
			
		} // if
	} // if

		// echo "<p>vartest l0:$loginid0, un:$username0, neweid:$newempid, lrem:$loginremarks|$remarks_login, f11:$found11<br>$res11query<br>$res12query<br>$res14query<br>$res15query<br>f16:$found16 - $res1query<br>$res17query</p>";

		$resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery);

		// redirect
		// header("Location: mngstduseredit.php?loginid=$loginid&stdlid=$loginid0&stduid=$username0");
		echo '<script>';
		echo 'window.location.href = "mngstdusers.php?loginid=' .$loginid .'";';
		echo '</script>';
			exit; 

		header("Location: mngstdusers.php?loginid=$loginid");
		exit;

		// include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>
