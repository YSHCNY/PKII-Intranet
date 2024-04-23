<?php
require("../includes/dbh.php");


// $loginid0 = $_SESSION['loginid'];

$username = $dbh->real_escape_string(stripslashes(trim((isset($_POST['username'])) ? $_POST['username'] :'')));
$password = $dbh->real_escape_string(stripslashes(trim((isset($_POST['password'])) ? $_POST['password'] :'')));

if($username!='' && $password!='') {
    // query tbllogin
    include '../m/qrylogin.php';

    if($found0==1) {
        include '../m/qrylogin2.php';
        require("../includes/dbh.php");
        $logdetails="";
        $logdetails="$username has logged-in on $now";
        $res12query="";
        $res12query="INSERT INTO tbllogs SET timestamp='$now', loginid=$loginid0, username='$username', logdetails='$logdetails'";
        $result12=""; $found12=0; $ctr12=0;
        $result12=$dbh->query("$res12query");
        // clear logdetails
        $logdetails="";

        if($pwchangedt5==NULL || $pwchangedt5=='0000-00-00 00:00:00') {
            include '../m/qryupdsysusracctmgt.php';
            // redirect
            // header("Location: index.php?lst=$loginstat&lid=$loginid0&sess=$session"); old
            header("Location: index.php?lst=$loginstat&lid=$loginid0&sess=$session"); 
        } else {
            if($empdepartment0!='FIN') { 
                $usrpwexpiry='P90D'; 
                $usrpwexpiry2=90; 
                $deptintmos=3; 
            } else { 
                $usrpwexpiry2=30; 
                $deptintmos=1; 
            }

            if($skiplastdt5!='' || $skiplastdt5!='0000-00-00 00:00:00') {
                if(strtotime($skiplastdt5) > strtotime($pwchangedt5)) {
                    $pwchgdtplus30d = date('Y-m-d', strtotime($skiplastdt5));
                } else {
                    $pwchgdtplus30d = date('Y-m-d', strtotime('+'.$deptintmos.' month', strtotime($pwchangedt5)));
                } //if-else
            } else {
                $pwchgdtplus30d = date('Y-m-d', strtotime('+'.$deptintmos.' month', strtotime($pwchangedt5)));
            } //if-else







            if(strtotime($datenow) >= strtotime($pwchgdtplus30d)) {
                if($skippwctr5>=3 && (strtotime($skiplastdt5) >= strtotime($datenow))) {
                    //prompt to chg password or option to skip
                    echo "<p class='text-danger'>Your password is more than $deptintmos month/s.<br>For security, it is advisable to change your password now.<br>Please click to <strong><a href=\"index.php?lst=1&lid=$loginid0&sess=$session&p=41\" class='btn btn-success' role='button'>continue</a></strong> changing your password.</p>";
                } else { 
                    //prompt to chg password or option to skip
                    echo "<p class='text-danger'>Your password is more than $deptintmos month/s.<br>For security, it is advisable to change your password now.<br>Please click to <strong><a href=\"index.php?lst=1&lid=$loginid0&sess=$session&p=41\" class='btn btn-success' role='button'>continue</a></strong> changing your password or <strong><a href=\"mchgpassskip.php?lid=$loginid0\" class='btn btn-warning' role='button'>skip</a></strong> for some other time.</p>";
                } 
            } else { 
                // redirect
               
// Get the URL parameter and split it into segments
                // $urlSegments = explode('/', $_GET['url']);

                // // Assign segments to variables
                // $lst = $urlSegments[0];
                // $lid = $urlSegments[2];
                // $sess = $urlSegments[1];

// Now $lst, $lid, and $sess contain the values extracted from the URL

                // header("Location: index.php?lst=$loginstat&lid=$loginid0");
                header("Location: index.php?lst=$loginstat&lid=$loginid0&sess=$session");
            } 

            
        } //checker if expired or not


        
    } else { //cehcker of attemtps
        require("../includes/dbh.php");
        // display header
        include("header.php");

        //chk and update tblsysusracctmgt add 1 on attempt and log attemptdt
        $res14query=""; $result14=""; $found14=0;
        $res14query="SELECT tbllogin.loginid AS loginid, tblsysusracctmgt.attempt AS attempt FROM tbllogin LEFT JOIN tblsysusracctmgt ON tbllogin.loginid=tblsysusracctmgt.loginid WHERE tbllogin.username=\"$username\"";
        $result14=$dbh->query($res14query);
        if($result14->num_rows>0) {
            while($myrow14=$result14->fetch_assoc()) {
                $found14=1;
                $loginid14 = $myrow14['loginid'];
                $attempt14 = $myrow14['attempt'];
            } //while
        } //if
        if($found14==1) {
            $attempts = 0;
            $attempts = $attempt14 + 1;
            // update tblsysusracctmgt
            $res14bquery=""; $result14b="";
            $res14bquery="UPDATE tblsysusracctmgt SET attempt=$attempts, attemptstamp=\"$now\" WHERE loginid=$loginid14 AND admloginid=0";
            $result14b=$dbh->query($res14bquery);

            if($attempts>=$usrpwretries) {
                // disable user profile on intranet non-admin
                $res15query=""; $result15=""; $found15=0;
                $res15query="SELECT idloginstatus FROM tblloginstatus WHERE loginid=$loginid14";
                $result15=$dbh->query($res15query);
                if($result15->num_rows>0) {
                    while($myrow15=$result15->fetch_assoc()) {
                        $found15=1;
                        $idloginstatus15 = $myrow15['idloginstatus'];
                    } //while
                } //if
                if($found15==1) {
                    $res15bquery=""; $result15b=""; $disabled=1; $remarks="disabled on $now due to max login attempts reached.";
                    $res15bquery="UPDATE tblloginstatus SET timestamp=\"$now\", disabled=$disabled, remarks=\"$remarks\" WHERE idloginstatus=$idloginstatus15 AND loginid=$loginid14";
                    $result15b=$dbh->query($res15bquery);
                } //if($found15==1)

                // insert log
                $logdetails="";
                $logdetails="$username has reached the maximum login attempts on $now. user is now blocked from logging-in to the system.";
                $res12query="";
                $res12query="INSERT INTO tbllogs SET timestamp='$now', loginid=$loginid0, username='$username', logdetails='$logdetails'";
                $result12=""; $found12=0; $ctr12=0;
                $result12=$dbh->query("$res12query");
                // clear logdetails
                $logdetails="";

                echo "<p class='text-danger'>You have reached the maximum login attempts. Please contact IT support through Telegram or email:support@philkoei.com.ph<br><a href='index.php?lst=$loginstat' class='btn btn-primary' role='button'>back to login</a></p>";
                sleep(1);
            } else { 
                //if($attempts>=$usrpwretries)
                $loginstat=0;
                echo "<p class='text-danger'>WRONG password!<br>Login attempt:$attempts on $now where max=$usrpwretries.<br>Please click <a href='index.php?lst=$loginstat' class='btn btn-primary' role='button'>here</a> if you are not automatically redirected.</p>";
                sleep(1);
            } //if-else //if($attempts>=$usrpwretries)
        } else { //if-elseif($found14==1)
            $loginstat=0;
            echo "<p class='text-danger'>UNKOWN username!<br>Please click <a href='index.php?lst=$loginstat' class='btn btn-primary' role='button'>here</a> if you are not automatically redirected.</p>";
            sleep(1);
        } 
    } 

    
} 


$dbh->close();
?>















































































<?php

//
// loginverify.php
//
// 	require("../includes/dbh.php");

// $username = $dbh->real_escape_string(stripslashes(trim((isset($_POST['username'])) ? $_POST['username'] :'')));
// $password = $dbh->real_escape_string(stripslashes(trim((isset($_POST['password'])) ? $_POST['password'] :'')));

// if($username!='' && $password!='') {
// 	// query tbllogin
// 	include '../m/qrylogin.php';

//     if($found0==1) {

//                 include '../m/qrylogin2.php';
                
//                 require("../includes/dbh.php");
//                 $logdetails="";
//                 $logdetails="$username has logged-in on $now";
//                 $res12query="";
//                 $res12query="INSERT INTO tbllogs SET timestamp='$now', loginid=$loginid0, username='$username', logdetails='$logdetails'";
//                 $result12=""; $found12=0; $ctr12=0;
//                 $result12=$dbh->query("$res12query");
//                 // clear logdetails
//                 $logdetails="";

//         if($pwchangedt5==NULL || $pwchangedt5=='0000-00-00 00:00:00') {

//         include '../m/qryupdsysusracctmgt.php';

// 		// redirect
// 		header("Location: index.php?lst=$loginstat&lid=$loginid0&sess=$session");


//     } else { 

//         if($empdepartment0!='FIN') { $usrpwexpiry='P90D'; $usrpwexpiry2=90; $deptintmos=3; } else { $usrpwexpiry2=30; $deptintmos=1; }


//         if($skiplastdt5!='' || $skiplastdt5!='0000-00-00 00:00:00') {
//             if(strtotime($skiplastdt5) > strtotime($pwchangedt5)) {
//             $pwchgdtplus30d = date('Y-m-d', strtotime($skiplastdt5));
//             } else {
//         $pwchgdtplus30d = date('Y-m-d', strtotime('+'.$deptintmos.' month', strtotime($pwchangedt5)));
//             } //if-else
//         } else {
//         $pwchgdtplus30d = date('Y-m-d', strtotime('+'.$deptintmos.' month', strtotime($pwchangedt5)));
//         } //if-else

//         if(strtotime($datenow) >= strtotime($pwchgdtplus30d)) {

//             if($skippwctr5>=3 && (strtotime($skiplastdt5) >= strtotime($datenow))) {

//                     //prompt to chg password or option to skip
//                 echo "<p class='text-danger'>Your password is more than $deptintmos month/s.<br>For security, it is advisable to change your password now.<br>Please click to <strong><a href=\"index.php?lst=1&lid=$loginid0&sess=$session&p=41\" class='btn btn-success' role='button'>continue</a></strong> changing your password.</p>";


//             } else { 
//                     //prompt to chg password or option to skip
//                  echo "<p class='text-danger'>Your password is more than $deptintmos month/s.<br>For security, it is advisable to change your password now.<br>Please click to <strong><a href=\"index.php?lst=1&lid=$loginid0&sess=$session&p=41\" class='btn btn-success' role='button'>continue</a></strong> changing your password or <strong><a href=\"mchgpassskip.php?lid=$loginid0\" class='btn btn-warning' role='button'>skip</a></strong> for some other time.</p>";


//             } 

//         } else { 


// 		// redirect
// 		header("Location: index.php?lst=$loginstat&lid=$loginid0&sess=$session");

//         } 

//     } 

// 	} else {

// 	require("../includes/dbh.php");

// 	// display header
// 	include("header.php");

//     //chk and update tblsysusracctmgt add 1 on attempt and log attemptdt
//     $res14query=""; $result14=""; $found14=0;
//     $res14query="SELECT tbllogin.loginid AS loginid, tblsysusracctmgt.attempt AS attempt FROM tbllogin LEFT JOIN tblsysusracctmgt ON tbllogin.loginid=tblsysusracctmgt.loginid WHERE tbllogin.username=\"$username\"";
//     $result14=$dbh->query($res14query);
//     if($result14->num_rows>0) {
//         while($myrow14=$result14->fetch_assoc()) {
//         $found14=1;
//         $loginid14 = $myrow14['loginid'];
//         $attempt14 = $myrow14['attempt'];
//         } //while
//     } //if
//     if($found14==1) {
//         $attempts = 0;
//         $attempts = $attempt14 + 1;
//         // update tblsysusracctmgt
//         $res14bquery=""; $result14b="";
//         $res14bquery="UPDATE tblsysusracctmgt SET attempt=$attempts, attemptstamp=\"$now\" WHERE loginid=$loginid14 AND admloginid=0";
//         $result14b=$dbh->query($res14bquery);

//         if($attempts>=$usrpwretries) {
//         // disable user profile on intranet non-admin
//         $res15query=""; $result15=""; $found15=0;
//         $res15query="SELECT idloginstatus FROM tblloginstatus WHERE loginid=$loginid14";
//         $result15=$dbh->query($res15query);
//         if($result15->num_rows>0) {
//             while($myrow15=$result15->fetch_assoc()) {
//             $found15=1;
//             $idloginstatus15 = $myrow15['idloginstatus'];
//             } //while
//         } //if
//         if($found15==1) {
//         $res15bquery=""; $result15b=""; $disabled=1; $remarks="disabled on $now due to max login attempts reached.";
//         $res15bquery="UPDATE tblloginstatus SET timestamp=\"$now\", disabled=$disabled, remarks=\"$remarks\" WHERE idloginstatus=$idloginstatus15 AND loginid=$loginid14";
//         $result15b=$dbh->query($res15bquery);
//         } //if($found15==1)

//   // insert log
// 	$logdetails="";
// 	$logdetails="$username has reached the maximum login attempts on $now. user is now blocked from logging-in to the system.";
// 	$res12query="";
// 	$res12query="INSERT INTO tbllogs SET timestamp='$now', loginid=$loginid0, username='$username', logdetails='$logdetails'";
// 	$result12=""; $found12=0; $ctr12=0;
// 	$result12=$dbh->query("$res12query");
// 	// clear logdetails
// 	$logdetails="";

//         echo "<p class='text-danger'>You have reached the maximum login attempts. Please contact IT support through Telegram or email:support@philkoei.com.ph<br><a href='index.php?lst=$loginstat' class='btn btn-primary' role='button'>back to login</a></p>";
//         sleep(1);
//         } else { //if($attempts>=$usrpwretries)
// 		$loginstat=0;
//         echo "<p class='text-danger'>WRONG password!<br>Login attempt:$attempts on $now where max=$usrpwretries.<br>Please click <a href='index.php?lst=$loginstat' class='btn btn-primary' role='button'>here</a> if you are not automatically redirected.</p>";
//         sleep(1);
//         } //if-else //if($attempts>=$usrpwretries)
//     } else { //if-elseif($found14==1)
// 		$loginstat=0;
//         echo "<p class='text-danger'>UNKOWN username!<br>Please click <a href='index.php?lst=$loginstat' class='btn btn-primary' role='button'>here</a> if you are not automatically redirected.</p>";
//         sleep(1);
//     } //if-else //if($found14==1)
// // echo "<p>vartest f14:$found14, attempt:$attempts<br>$res14query<br>$res14bquery</p>";
// 		// redirect to login
// 		// echo "<p><font color=\"red\">f0:$found0,f1:$found1 login failed.<br>$employeeid0|$contactid0<br>$username|$password|lst:$loginstat</font><br>res0qry:$res0query<br>res1qry:$res1query<br>$hostname, $dbusername, $dbuserpass, $dbname</p>";
// 		// redirect
// 		// header("Location: index.php?lst=$loginstat");
// 	} //if($found0==1)

// 	// echo "<p>f0:$found0|f1:$found1<br>res3query: $res3query</p>";
// } //if($username!='' && $password!='')

// db conn close
	// $dbh->close();

