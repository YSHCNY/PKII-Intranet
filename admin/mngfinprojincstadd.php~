<?php
//
// fn:mngfinprojincstadd.php
// fr:mngfinprojincst.php
//

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$acctname = (isset($_POST['acctname'])) ? $_POST['acctname'] :'';
$glcodefr = (isset($_POST['glcodefr'])) ? $_POST['glcodefr'] :'';
$glcodeto = (isset($_POST['glcodeto'])) ? $_POST['glcodeto'] :'';
$lookupsd = (isset($_POST['lookupsd'])) ? $_POST['lookupsd'] :'';
$tabpos = (isset($_POST['tabpos'])) ? $_POST['tabpos'] :'';

if($tabpos=='') { $tabpos=0; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($glcodefr!="" && $glcodeto!="") {
  // breakdown acctname and get refcd
  $refcdarr = split(",", $acctname);
  $refcdfin = $refcdarr[0];
  $refname = $refcdarr[1];
  $refnamefin = str_replace("_", " ", $refname);

	// query tblfinstfinposref if exists
	$res11query="SELECT idprojincstcdctg FROM tblfinprojincstcdctg WHERE acctcd=\"$refcdfin\" AND glcodefr=\"$glcodefr\" AND glcodeto=\"$glcodeto\" AND lookupsd=\"$lookupsd\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$idstfinpos11=$myrow11['idstfinpos'];
		} // while
	} // if

	if($found11==1) {
	// do not proceed
	echo "<h3 class='text-danger'>Sorry. Record exists. Pls try again.</h3>";
	echo "<p><a href='mngfinprojincst.php?loginid=$loginid' class='btn btn-secondary'>back</a></p>";
	} else {
	// proceed
	$res12query="INSERT INTO tblfinprojincstcdctg SET timestamp='$now', loginid=$loginid, datecreated='$now', createdby=$loginid, acctcd=\"$refcdfin\", acctnm1=\"$refnamefin\", acctnm2=\"\", glcodefr=\"$glcodefr\", glcodeto=\"$glcodeto\", glrefidfr=0, glrefidto=0, lookupsd=\"$lookupsd\", remarks=\"\", tabpos=$tabpos";
	$result12=$dbh2->query($res12query);
	// log
	$logdetails="Add new code category in tblfinprojincstcdctg for code categ of Project Income Statement. name:$refcdfin-$refnamefin codes fr:$glcodefr to:$glcodeto lookup:$lookupsd";
	$res16query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp='$now', adminuid='$username', adminlogdetails='$logdetails'";
	$result16=$dbh2->query($res16query);
	// redirect
	header("Location: mngfinprojincst.php?loginid=$loginid");
	exit;
	} // if-else

} // if

// echo "<p>vartest f11:$found11 r11qry: $res11query<br>r12qry: $res12query<br>r16qry: $res16query</p>";
// echo "<p><a href=\"./mngfinstfinpos.php?loginid=$loginid\">back</a></p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
