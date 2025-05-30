<?php

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

$confipaymemprojid = $_POST['confipaymemprojid'];
$manmonths = $_POST['manmonths'];
$manmonthscurr = $_POST['manmonthscurr'];
$manmonthsreq = $_POST['manmonthsreq'];
$manmonthsbal = $_POST['manmonthsbal'];
$lumpsum = $_POST['lumpsum'];
$lumpsumcurr = $_POST['lumpsumcurr'];
$lumpsumreq = $_POST['lumpsumreq'];
$lumpsumbal = $_POST['lumpsumbal'];
$amount = $_POST['amount'];
$current = $_POST['current'];
$requested = $_POST['requested'];
$balance = $_POST['balance'];
$details = $_POST['details'];

$status = "active";

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
	    font-family: verdana, arial, sans-serif
	  }
	  h1 {
	    font-size: 120%
	  color: brown
	  }
	  a {
	    text-decoration: none
	  }
	  p {
	    font-size: 90%
	  }
	--->
	</STYLE></head>
	<body>
<?
//     include ("header.php");
//     include ("sidebar.php");

//     echo "<p><font size=1>Modules >> Custom Payroll System - Projects Details</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue><font color=white><b>Custom Payroll System - Projects Details</b></font></td></tr>";
     echo "<tr><td>";

    $count = 0;

      $key2 = 0;
      $key2b = 0;
      $key = 0;

    echo "<tr><td>Updating Projects Details for current payroll</td></tr>";

    $result11 = mysql_query("SELECT confipaymemprojid, employeeid, groupname FROM tblconfipaymemproj WHERE employeeid = \"$employeeid\" AND groupname=\"$groupname\" AND confipaymemprojid=$confipaymemprojid", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $confipaymemprojid11 = $myrow11[0];
      $employeeid11 = $myrow11[1];
      $groupname11 = $myrow11[2];
    }

    foreach($confipaymemprojid as $key=>$value)
    {
      $confipaymemprojid = $value;
      $count = $count + 1;


      echo "<tr><td>vartest count:$count, eid:$employeeid, gn:$groupname, cmpid:$confipaymemprojid, mm:$manmonths[$key], mmcurr:$manmonthscurr[$key], mmreq:$manmonthsreq[$key], mmbal:$manmonthsbal[$key], ls:$lumpsum[$key], lscurr:$lumpsumcurr[$key], lsreq:$lumpsumreq[$key], lsbal:$lumpsumbal[$key], amt:$amount[$key], curr:$current[$key], req:$requested[$key], bal:$balance[$key], details:$projectdetails[$key]</td></tr>";


      $result14 = mysql_query("UPDATE tblconfipaymemproj SET timestamp=\"$now\", loginid=$loginid, manmonths=\"$manmonths[$key]\", manmonthscurr=\"$manmonthscurr[$key]\", manmonthsreq=\"$manmonthsreq[$key]\", manmonthsbal=\"$manmonthsbal[$key]\", lumpsum=\"$lumpsum[$key]\", lumpsumcurr=\"$lumpsumcurr[$key]\", lumpsumreq=\"$lumpsumreq[$key]\", lumpsumbal=\"$lumpsumbal[$key]\", amount=\"$amount[$key]\", current=\"$current[$key]\", requested=\"$requested[$key]\", balance=\"$balance[$key]\", details=\"$details[$key]\", status=\"$status\" WHERE confipaymemprojid=$confipaymemprojid AND employeeid=\"$employeeid\" AND groupname=\"$groupname\"", $dbh);
    }

// && $i < count($manmonthscurr) && $i < count($manmonthsbal) && $i < count($amount) && $i < count($current) && $i < count($balance) && $i < count($projectdetails)

/*
	    echo "<tr><td>$employeeid - $groupname - $projectnameothers - $projectdetailsothers<br>";

	    $found11 = 0;

	    $result11 = mysql_query("SELECT confipaymemprojid, employeeid, groupname, proj_name FROM tblconfipaymemproj WHERE employeeid = \"$employeeid\" AND groupname=\"$groupname\" AND proj_name=\"$projectnameothers\"", $dbh);
	    while($myrow11 = mysql_fetch_row($result11))
	    {
	      $found11 = 1;
	      $confipaymemprojid11 = $myrow11[0];
	      $employeeid11 = $myrow11[1];
	      $groupname11 = $myrow11[2];
	      $proj_name11 = $myrow11[3];
	    }

	    if($found11 == 1)
	    {
	      $result12 = mysql_query("UPDATE tblconfipaymemproj SET details=\"$projectdetailsothers\" WHERE confipaymemprojid=$confipaymemprojid11 AND employeeid = \"$employeeid\" AND groupname=\"$groupname\" AND proj_name=\"$projectnameothers\"", $dbh);
	      echo "Record updated.<br>";
	    }
	    else
	    {
	      $result14 = mysql_query("INSERT INTO tblconfipaymemproj (employeeid, groupname, proj_name, details) VALUES (\"$employeeid\", \"$groupname\", \"$projectnameothers\", \"$projectdetailsothers\")", $dbh);
	      echo "New record saved.<br>";
	    }
	    echo "</td></tr>";

      }
    }

    echo "</td></tr>";
*/

     echo "</table>";

     echo "<p><a href=\"confipay3.php?loginid=$loginid&cpgid=$confipaygrpid\">Back to Personnel Data</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

//     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

  mysql_close($dbh);

  function FormatMoney($number) {
    $number = preg_replace("/[^0-9\.]/", "", str_replace(',','.',$number));
    if (substr($number,-3,1)=='.') {
        $sents = '.'.substr($number,-2);
        $number = substr($number,0,strlen($number)-3);
    } elseif (substr($number,-2,1)=='.') {
        $sents = '.'.substr($number,-1);
        $number = substr($number,0,strlen($number)-2);
    } else {
        $sents = '.00';
    }
    $number = preg_replace("/[^0-9]/", "", $number);
    return number_format($number.$sents,2,'.','');
  }

?>

