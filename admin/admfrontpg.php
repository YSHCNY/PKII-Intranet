<?php
    include ("header.php");
    include ("sidebar.php");
    include ("datetimenow.php");
    include ("addons.php");
?>

<?php
    $usrip=$_SERVER['REMOTE_ADDR'];
    $usrosbrowserver=$_SERVER['HTTP_USER_AGENT'];

    $logdetails = "loginid:". $loginid . " logged-in from ip:$usrip using:$usrosbrowserver<br /><br />";

    $chgdtpw="";

    if($pwchangedt5!="" || $skiplastdt5!="") {
        if($pwchangedt5!="0000-00-00 00:00:00" || $skiplastdt5!="0000-00-00 00:00:00") {

        if(strtotime($skiplastdt5) > strtotime($pwchangedt5)) {
            $daystochgpwprompt = round((strtotime($skiplastdt5) - strtotime($now)) / (60 * 60 * 24));
        } else {
            $daystochgpwprompt = round($usrpwexpiry2 - ((strtotime($now) - strtotime($pwchangedt5)) / (60 * 60 * 24)));
        }

            echo "Days left to change your intranet login password:&nbsp;<strong>";

        if($daystochgpwprompt<=5) {
            echo "<font color='red'>$daystochgpwprompt</font>";
        } else {
            echo "$daystochgpwprompt";
        }

            echo "</strong><br /><br />";
        }
    }
		include('ddash.php');
?>
	

