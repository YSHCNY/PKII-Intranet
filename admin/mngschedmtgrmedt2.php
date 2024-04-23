<?php

//
// mngschedmtgrmedt2.php // 20200609
// fr mngschedmtgrmedt.php

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$submmtgrmedt2sw = (isset($_POST['submmtgrmedt2sw'])) ? $_POST['submmtgrmedt2sw'] :'';
if($submmtgrmedt2sw=='submit') {
	
	$idadmmtgrm = (isset($_POST['idadmmtgrm'])) ? $_POST['idadmmtgrm'] :'';
	$submmtgrmcdsw = (isset($_POST['submmtgrmcdsw'])) ? $_POST['submmtgrmcdsw'] :'';
	$submmtgrmaddsw = (isset($_POST['submmtgrmaddsw'])) ? $_POST['submmtgrmaddsw'] :'';
	$mtgrmcodeid = (isset($_POST['mtgrmcdid'])) ? $_POST['mtgrmcdid'] :'';
	$dtmtg = (isset($_POST['dtmtg'])) ? $_POST['dtmtg'] :'';
	$timestart = (isset($_POST['timestart'])) ? $_POST['timestart'] :'';
	$timestop = (isset($_POST['timestop'])) ? $_POST['timestop'] :'';
	$projcode = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';
	$topic = trim(addslashes((isset($_POST['topic'])) ? $_POST['topic'] :''));
	$notes = trim(addslashes((isset($_POST['notes'])) ? $_POST['notes'] :''));
	// compose date and timestart/timestop
	$dttmstart = date('Y-m-d H:i:s', strtotime($dtmtg . " " . $timestart));
	$dttmstop = date('Y-m-d H:i:s', strtotime($dtmtg . " " . $timestop));
	if(strtotime($dttmstart)>strtotime($dttmstop)) {
		$dttmstop = $dttmstart;
	} //if

    //20220104 list of eqpt needed categ, retrieve as $_POST
    $mtgrmeqptlst = (isset($_POST['mtgrmeqptlst'])) ? $_POST['mtgrmeqptlst'] :'';
    if(is_array($mtgrmeqptlst)) {
        $mtgrmeqptlstfin='';
        foreach($mtgrmeqptlst as $val1 => $n1) {
            $mtgrmeqptlstfin = $mtgrmeqptlstfin . $mtgrmeqptlst[$val1] . "|";
        }
    } else { // if($depts=='Array')
        $mtgrmeqptlstfin = $mtgrmeqptlst;
    } // if($depts=='Array')
	
} //if
// echo "<p>vartst id:$loginid, sw:$submmtgrmadd2sw, mtgrmcdid:$mtgrmcdid, idctgmr:$idadmctgmtgrm</p>";
$found = 0;

if($loginid != "") {
     include("logincheck.php");
} //if

if($found == 1) {

if($submmtgrmedt2sw=='submit') {
	// add query
	$res11query="UPDATE tbladmmtgrm SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, topic=\"$topic\", projcode=\"$projcode\", notes=\"$notes\", datemeeting=\"$dtmtg\", timedurfrom=\"$dttmstart\", timedurto=\"$dttmstop\", fk_admctgmtgrm=$mtgrmcodeid, eqptlst=\"$mtgrmeqptlstfin\" WHERE idadmmtgrm=$idadmmtgrm";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11!='') {
		$statustext="Successfully modified meeting room scheduler record.";
	// log
	$logdetails="Modified meeting room record in meeting room scheduler module. date:$dtmtg duration:$dttmstart-to-$dttmstop topic:$topic projcode:$projcode";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$adminuid', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	} else {
		$statustext = "Error in saving record. Pls try again or contact IT system administrator.";
	} // if-else
} // if

echo "<p>$statustext</p>";

echo "<form action='mngschedulermtgrm.php?loginid=$loginid' method='POST' name='mngschedulermtgrm'>";
	echo "<input type='hidden' name='submmtgrmcdsw' value='$submmtgrmcdsw'>";
	echo "<input type='hidden' name='mtgrmcdid' value='$mtgrmcodeid'>";
	// echo "<input type='hidden' name='submmtgrmaddsw' value='$submmtgrmaddsw'>";
	echo "<input type='hidden' name='idadmctgmtgrm' value='$mtgrmcodeid'>";
	// echo "<input type='hidden' name='submmtgrmadd2sw' value='$submmtgrmadd2sw'>";
echo "<p><button type='submit' class='btn btn-default' name='submmtgrmcdsw' value='$submmtgrmcdsw'>back</button></p>";
echo "</form>";
// echo "<p>vartest f11:$found11, cd:$code, nm:$name<br>res12qry:$res12query</p>";
	// redirect
	// exit(header("Location: mngschedulermtgrmctg.php?loginid=$loginid"));

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
