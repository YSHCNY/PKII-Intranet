<?php

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

// echo "<p>vartest cpgid:$confipaygrpid, eid:$employeeid, gn:$groupname</p>";

$netbasicpay = $_POST['netbasicpay'];

$projallow = $_POST['projallow'];
if($projallow == "") { $projallow = 0.00; }

$perdiem = $_POST['perdiem'];
if($perdiem == "") { $perdiem = 0.00; }

$transpoallow = $_POST['transpoallow'];
if($transpoallow == "") { $transpoallow = 0.00; }

$withholdingtax = $_POST['withholdingtax'];

$wtaxopt2 = $_POST['wtaxopt2'];
if($wtaxopt2 == "") { $wtaxopt2 = 0; }

$sssee = $_POST['sssee'];
$ssser = $_POST['ssser'];
$sssec = $_POST['sssec'];
$philhealthee = $_POST['philhealthee'];
$philhealther = $_POST['philhealther'];
$pagibigee = $_POST['pagibigee'];
$pagibiger = $_POST['pagibiger'];
$empstatus = $_POST['empstatus'];

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
		Table {
			background:#D3E4E5;
			border:1px solid gray;
			border-collapse:collapse;
			font:normal 12px verdana, arial, helvetica, sans-serif;
		}
		TH {
			font-family: Helvetica; font-size: 10pt; font-weight: bold;
		}
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

//  echo "filename:confipaynewmain2.php<br>";
//  echo "vartest: loginid:$loginid, employeeid:$employeeid, groupname:$groupname<br>";

	include("mcryptdec.php");

  echo "<p><b>New salary info created</b></p>";
	echo "eid:$employeeid, grp:$groupname<br>";
  echo "netbasicpay:$netbasicpay<br>";
  echo "projallow:$projallow<br>";
  echo "perdiem:$perdiem<br>";
  echo "transpoallow:$transpoallow<br>";
  echo "withholdingtax:$withholdingtax<br>";
  echo "wtaxopt2:$wtaxopt2<br>";
  echo "sssee:$sssee<br>";
  echo "ssser:$ssser<br>";
  echo "sssec:$sssec<br>";
  echo "philhealthee:$philhealthee<br>";
  echo "philhealther:$philhealther<br>";
  echo "pagibigee:$pagibigee<br>";
  echo "pagibiger:$pagibiger<br>";
  echo "empstatus:$empstatus</p>";

	include("mcryptenc.php");

  if ($empstatus == "on") {
		$statusfin="active";
	} else {
		$statusfin="inactive";
	}

	// check if confipaymeminfo exists
	$res12query="SELECT confipaymemid FROM tblconfipaymeminfo WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\" AND confipaygrpid=$confipaygrpid";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = mysql_query("$res12query", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12=1;
		$confipaymemid12 = $myrow12[0];
		}
	}

	if($found12 == 1) {
	$result11 = mysql_query("UPDATE tblconfipaymeminfo SET timestamp=\"$now\", loginid=$loginid, netbasicpay=$netbasicpay, projallow=$projallow, perdiem=$perdiem, transpoallow=$transpoallow, withholdingtax=$withholdingtax, wtaxopt2=$wtaxopt2, sssee=$sssee, ssser=$ssser, sssec=$sssec, philhealthee=$philhealthee, philhealther=$philhealther, pagibigee=$pagibigee, pagibiger=$pagibiger, empstatus=\"$statusfin\", confipaygrpid=$confipaygrpid WHERE confipaymemid=$confipaymemid12 AND employeeid=\"$employeeid\" AND groupname=\"$groupname\"", $dbh);
	// echo "<p>f12:$found12 - update</p>";
	} else if($found12 == 0) {
	$result11 = mysql_query("INSERT INTO tblconfipaymeminfo (timestamp, loginid, employeeid, groupname, netbasicpay, projallow, perdiem, transpoallow, withholdingtax, wtaxopt2, sssee, ssser, sssec, philhealthee, philhealther, pagibigee, pagibiger, empstatus, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", $netbasicpay, $projallow, $perdiem, $transpoallow, $withholdingtax, $wtaxopt2, $sssee, $ssser, $sssec, $philhealthee, $philhealther, $pagibigee, $pagibiger, \"$statusfin\", $confipaygrpid)", $dbh);
	// echo "<p>f12:$found12 - insert</p>";
	}

  echo "</body></html>";
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

