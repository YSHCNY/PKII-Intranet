<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$finstrvsfrmaid = $_GET['strvsid'];

$yravlbl = $_POST['yravlbl'];
$qtravlbl = $_POST['qtravlbl'];
$projrelref = $_POST['projrelref'];

$transyear = $_POST['transyear'];
$transmonth = $_POST['transmonth'];
$frmasheet = $_POST['frmasheet'];
$acctcode = $_POST['acctcode'];
$transvalue = $_POST['transvalue'];
$projcode = $_POST['projcode'];
$amtincurr = $_POST['amtincurr'];
$currtyp = $_POST['currtyp'];
$transcontent = $_POST['transcontent'];
$accttranscounterpart = $_POST['accttranscounterpart'];
$remarks = $_POST['remarks'];

$transdate = $transyear . "-" . $transmonth . "-" . "01";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// start contents here

	// get acctname from acctcode
	$result11=""; $found11=0;
	$result11 = mysql_query("SELECT name_e FROM tblfinnkgacctref WHERE code=\"$acctcode\"", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$name_e11 = $myrow11[0];
		}
	}

  $result12 = mysql_query("UPDATE tblfinstrvsfrma SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", transdate=\"$transdate\", projrelrefcd=\"$frmasheet\", acctcd=\"$acctcode\", transvalue=\"$transvalue\", projcode=\"$projcode\", amttranscurr=\"$amtincurr\", currtyp=\"$currtyp\", contenttrans=\"$transcontent\", transacct=\"$accttranscounterpart\", remarks=\"$remarks\" WHERE tblfinstrvsfrmaid=$finstrvsfrmaid", $dbh);


// create log
    // include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - NK-Stravis Form-A EDITED item with details: date:$transdate, sheet:$frmasheet, $acctcode-$name_e11, value:$transvalue, projcode:$projcode, amtcurrtyp:$amtincurr-$currtyp, content:$transcontent, acctctrpart:$accttranscounterpart, remarks:$remarks";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: finstrvsamng.php?loginid=$loginid&yravlbl=$yravlbl&qtravlbl=$qtravlbl&projrelref=$projrelref");
  exit;

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

//     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
