<?php 
//
// finvouchapchgexpla2.php //20211122
// fr finvouchchgexpla.php
//
include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$apnumber = trim((isset($_GET['apn'])) ? $_GET['apn'] :'');
$apdate = trim((isset($_GET['apdt'])) ? $_GET['apdt'] :'');

$explanation = (isset($_POST['explanation'])) ? $_POST['explanation'] :'';
$explanation = trim(mysql_real_escape_string($explanation));

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Modify CV record date...</b></font></p>";

    if($accesslevel >= 4 && $accesslevel <= 5) {

        $res11query=""; $result11=""; $found11=0;
        $res11query = "SELECT acctspayableid, date, payee FROM tblfinacctspayable WHERE acctspayablenumber=\"$apnumber\" AND date=\"$apdate\" LIMIT 1";
        $result11=$dbh2->query($res11query);
        if($result11->num_rows>0) {
            while($myrow11=$result11->fetch_assoc()) {
            $found11 = 1;
            $acctspayableid11 = $myrow11['acctspayableid'];
            $date11 = $myrow11['date'];
            $payee11 = $myrow11['payee'];

            $res11bquery=""; $result11b=""; $found11b=0;
            // $res11bquery="SELECT acctspayabletotid, date, explanation FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\" AND date=\"$apdate\" LIMIT 1";
            $res11bquery="SELECT acctspayabletotid, date, explanation FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$apnumber\" LIMIT 1";
            $result11b=$dbh2->query($res11bquery);
            if($result11b->num_rows>0) {
                while($myrow11b=$result11b->fetch_assoc()) {
                $found11b=1;
                $acctspayabletotid11b = $myrow11b['acctspayabletotid'];
                $date11b = $myrow11b['date'];
                $explanation11b = $myrow11b['explanation'];
                } //while
            } //if

            if($acctspayabletotid11b != 0) {
		$res12query=""; $result12=""; $found12=0;
		$res12query = "UPDATE tblfinacctspayabletot SET explanation=\"$explanation\" WHERE acctspayabletotid=$acctspayabletotid11b AND acctspayablenumber=\"$apnumber\"";
                $result12=$dbh2->query($res12query);
            } //if

            } //while
        } //if

// create log
    include('datetimenow.php');
    $res16query=""; $result16="";
    $res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
    $result16=$dbh2->query($res16query);
    if($result16->num_rows>0) {
        while($myrow16=$result16->fetch_assoc()) {
        $adminuid = $myrow16['adminuid'];
        } //while
    } //if
    $adminlogdetails = "$loginid:$adminuid - Modified explanation from: $explanation11b to:$explanation of APV:$apnumber, payee:$payee11, APdate:$apdate";
    $res17query=""; $result17="";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
    $result17=$dbh2->query($res17query);
  } //if

  header("Location: finvouchapnew.php?loginid=$loginid&apn=$apnumber&apdate=$apdate");
  exit;
// start remove in prod
/*  echo "<p>vartest apid:$acctspayableid11, aptotid:$acctspayabletotid11b, apn:$apnumber, apd:$apdate, expl:$explanation<br>r12q: $res12query</p>";
  echo "<p><a href=\"finvouchapnew.php?loginid=$loginid&apn=$apnumber&apdate=$apdate\">back</a></p>";
*/
// end remove in prod

    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result = $dbh2->query($resquery);

//     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
