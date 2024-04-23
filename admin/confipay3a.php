<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$confipaygrpid = (isset($_GET['cpgid'])) ? $_GET['cpgid'] :'';
$employeeid = (isset($_POST['eid'])) ? $_POST['eid'] :'';
$empalias = (isset($_POST['empalias'])) ? trim($_POST['empalias']) :'';
$groupname = (isset($_POST['gn'])) ? $_POST['gn'] :'';

$netbasicpay = (isset($_POST['netbasicpay'])) ? $_POST['netbasicpay'] :'';

$projallow = (isset($_POST['projallow'])) ? $_POST['projallow'] :'';
if($projallow == "") { $projallow = 0; }

$perdiem = (isset($_POST['perdiem'])) ? $_POST['perdiem'] :'';
if($perdiem == "") { $perdiem = 0; }

$transpoallow = (isset($_POST['transpoallow'])) ? $_POST['transpoallow'] :'';
if($transpoallow == "") { $transpoallow = 0; }

$vatstatus = (isset($_POST['vatstatus'])) ? $_POST['vatstatus'] :'';
$wtaxstatus = (isset($_POST['wtaxstatus'])) ? $_POST['wtaxstatus'] :'';
$exemptstatus = (isset($_POST['exemptstatus'])) ? $_POST['exemptstatus'] :'';
$withholdingtax = (isset($_POST['withholdingtax'])) ? $_POST['withholdingtax'] :'';

$wtaxopt2 = (isset($_POST['wtaxopt2'])) ? $_POST['wtaxopt2'] :'';
if($wtaxopt2 == "") { $wtaxopt2 = 10; }

$wtaxmode = (isset($_POST['wtaxmode'])) ? $_POST['wtaxmode'] :'';

$sssstatus = (isset($_POST['sssstatus'])) ? $_POST['sssstatus'] :'';
$sssee = (isset($_POST['sssee'])) ? $_POST['sssee'] :'';
$ssser = (isset($_POST['ssser'])) ? $_POST['ssser'] :'';
$sssec = (isset($_POST['sssec'])) ? $_POST['sssec'] :'';
$sssmode = (isset($_POST['sssmode'])) ? $_POST['sssmode'] :'';

$philhealthstatus = (isset($_POST['philhealthstatus'])) ? $_POST['philhealthstatus'] :'';
$philhealthee = (isset($_POST['philhealthee'])) ? $_POST['philhealthee'] :'';
$philhealther = (isset($_POST['philhealther'])) ? $_POST['philhealther'] :'';
$philhealthmode = (isset($_POST['philhealthmode'])) ? $_POST['philhealthmode'] :'';

$pagibigee = (isset($_POST['pagibigee'])) ? $_POST['pagibigee'] :'';
$pagibiger = (isset($_POST['pagibiger'])) ? $_POST['pagibiger'] :'';
$pagibigmode = (isset($_POST['pagibigmode'])) ? $_POST['pagibigmode'] :'';

$empstatus = (isset($_POST['empstatus'])) ? $_POST['empstatus'] :'';

$pagibigee2 = (isset($_POST['pagibigee2'])) ? $_POST['pagibigee2'] :'';
$pagibiger2 = (isset($_POST['pagibiger2'])) ? $_POST['pagibiger2'] :'';

$pagibigman1 = (isset($_POST['pagibigman1'])) ? $_POST['pagibigman1'] :'';
if($pagibigman1=="on") { $pagibigman1val=1; } else { $pagibigman1val=0; }
$pagibigman2 = (isset($_POST['pagibigman2'])) ? $_POST['pagibigman2'] :'';
if($pagibigman2=="on") { $pagibigman2val=1; } else { $pagibigman2val=0; }

// echo "<p>vartest pgibgmn1:$pagibigman1:$pagibigman1val, pgibgmn2:$pagibigman2:$pagibigman2val</p>";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
?>
	<html><head><STYLE TYPE="text/css">
	<!--
	  TD {
	    font-family: Helvetica; font-size: 10pt
	  }
	  body {
	    font-family: Helvetica; font-size: 10pt
	  }
	  h1 {
	    font-size: 120%
	  }
	  h2 {
	    font-size: 100%
	  }
	  a {
	    text-decoration: none
	  }
	  p {
	    font-family: Helvetica; font-size: 10pt
	  }
	--->
	</STYLE></head>
	<body>
<?php
     echo "<p><b>Updated Main Payroll Info</b></p>";

     if($empstatus == 'on')
     {
	$statusval = 'active';
     }
     else
     {
	$statusval = 'inactive';
     }

     if($vatstatus == 'on')
     {
	$vatstatusval='on';
     }
     else
     {
	$vatstatusval='off';
     }


     if($wtaxstatus == 'on')
     {
	$wtaxstatusval='on';
     }
     else
     {
	$wtaxstatusval='off';
     }

     if($sssstatus == 'on')
     {
	$sssstatusval='on';
     }
     else
     {
	$sssstatusval='off';
     }

     if($philhealthstatus == 'on')
     {
	$philhealthstatusval='on';
     }
     else
     {
	$philhealthstatusval='off';
     }

echo "employeeid:$employeeid<br>";
echo "groupname:$groupname<br>";

	// check confiaccesslevel if 5, then
	$res11query="SELECT accesslevel FROM tblconfipaygrp WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" AND accesslevel=5";
	$result11=""; $found11=0; $ctr11=0;
	/*
	$result11 = mysql_query("$res11query", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
	*/
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$confiaccesslevel11 = $myrow11['accesslevel'];
		}
	}
	if($confiaccesslevel11==5 && $accesslevel==5) {
		// prepare empalias' encryption
		if($empalias!="") {
		$encrypted = $mcrypt->encrypt($empalias);
		$empalias = $encrypted;
		echo "alias:$empalias<br>";
		}
	}


echo "netbasicpay:$netbasicpay<br>";
echo "projallow:$projallow<br>";
echo "perdiem:$perdiem<br>";
echo "transpoallow:$transpoallow<br>";
echo "vatstatus:$vatstatus<br>";
// echo "wtaxstatus:$wtaxstatus<br>";
echo "exempstatus:$exemptstatus<br>";
echo "wtax:$withholdingtax<br>";
echo "wtaxopt2:$wtaxopt2<br>";
echo "wtaxmode:$wtaxmode<br>";
// echo "sss-status:$sssstatus<br>";
echo "sss-ee:$sssee<br>";
echo "sss-er:$ssser<br>";
echo "sss-ec:$sssec<br>";
echo "sssmode:$sssmode<br>";
// echo "philhealth-status:$philhealthstatus<br>";
echo "philhealth-ee:$philhealthee<br>";
echo "philhealth-er:$philhealther<br>";
echo "philhealthmode:$philhealthmode<br>";
echo "pagibig-ee:$pagibigee<br>";
echo "pagibig-er:$pagibiger<br>";
echo "pagibig-ee2:$pagibigee2<br>";
echo "pagibig-er2:$pagibiger2<br>";
echo "pagibigmode:$pagibigmode<br>";
echo "pagibig1sthf:$pagibigman1val<br>";
echo "pagibig2ndhf:$pagibigman2val<br>";
echo "status:$empstatus,$statusval<br>";

	if($confipaygrpid!=0) {
	$resquery="UPDATE tblconfipaymeminfo SET timestamp=\"$now\", loginid=$loginid, empalias=\"$empalias\", netbasicpay=$netbasicpay, projallow=$projallow, perdiem=$perdiem, transpoallow=$transpoallow, vatstatus=\"$vatstatusval\", exemptstatus=\"$exemptstatus\", withholdingtax=$withholdingtax, wtaxopt2=$wtaxopt2, wtaxmode=\"$wtaxmode\", sssee=$sssee, ssser=$ssser, sssec=$sssec, sssmode=\"$sssmode\", philhealthee=$philhealthee,  philhealther=$philhealther, philhealthmode=\"$philhealthmode\", pagibigee=$pagibigee, pagibiger=$pagibiger, pagibigmode=\"$pagibigmode\", empstatus=\"$statusval\", pagibigee2=$pagibigee2, pagibiger2=$pagibiger2, pagibigman1=$pagibigman1val, pagibigman2=$pagibigman2val WHERE confipaygrpid=$confipaygrpid";
	// $resquery_a=1; $resquery_b=0;
	$result = $dbh2->query($resquery);
	} else {
	$resquery="UPDATE tblconfipaymeminfo SET timestamp=\"$now\", loginid=$loginid, empalias=\"$empalias\", netbasicpay=$netbasicpay, projallow=$projallow, perdiem=$perdiem, transpoallow=$transpoallow, vatstatus=\"$vatstatusval\", exemptstatus=\"$exemptstatus\", withholdingtax=$withholdingtax, wtaxopt2=$wtaxopt2, wtaxmode=\"$wtaxmode\", sssee=$sssee, ssser=$ssser, sssec=$sssec, sssmode=\"$sssmode\", philhealthee=$philhealthee,  philhealther=$philhealther, philhealthmode=\"$philhealthmode\", pagibigee=$pagibigee, pagibiger=$pagibiger, pagibigmode=\"$pagibigmode\", empstatus=\"$statusval\", confipaygrpid=$confipaygrpid, pagibigee2=$pagibigee2, pagibiger2=$pagibiger2, pagibigman1=$pagibigman1val, pagibigman2=$pagibigman2val WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\"";
	// $resquery_a=0; $resquery_b=1;
	$result = $dbh2->query($resquery);
	}

//	echo "vartest wtaxstatus:$wtaxstatus<br>";
//	echo "vartest wtaxstatusval:$wtaxstatusval<br>";
//	echo "vartest sssstatusval:$sssstatusval<br>";
// echo "vartest cpgid:$confipaygrpid, empid:$employeeid, grpnm:$groupname, rq:$resquery_a|$resquery_b<br>";


	echo "<p><i>//confipay3a.php</i></p>";
     
     echo "</html>";
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
