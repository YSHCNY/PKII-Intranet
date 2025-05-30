<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$apnumber = trim((isset($_GET['apvn'])) ? $_GET['apvn'] :'');
$apdate = trim((isset($_GET['apvdt'])) ? $_GET['apvdt'] :'');

$found = 0;

if($loginid != "") {
	include("logincheck.php");
}
?>

<script language="JavaScript" src="ts_picker.js"></script>  

<?php
if($found == 1) {
	include ("header.php");
  include ("sidebar.php");

// start contents here

	$res11query=""; $result11=""; $found11=0;
	$res11query="SELECT payee, company_id, contact_id FROM tblfinacctspayable WHERE acctspayablenumber=\"$apnumber\" AND date=\"$apdate\" LIMIT 1";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$payee11 = $myrow11['payee'];
			$company_id11 = $myrow11['company_id'];
			$contact_id11 = $myrow11['contact_id'];
		} //while
	} //if
	
	if($found11==1) {
		$companyidfin=$company_id11;
		$contactidfin=$contact_id11;
		include './finvouchlucompcontids.php';
	} //if

  echo "<table class=\"fin\" border=\"1\">";
  echo "<tr><th colspan=\"2\">Accounts Payable Voucher - change date</th></tr>";
	echo "<form action=\"finvouchapvchgdt2.php?loginid=$loginid&apvn=$apnumber&apvdt=$apdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td><input class='form-control' type='date' name=\"apvnewdate\" value=\"$apdate\">";

	echo "</td></tr>";
	echo "<tr><th align=\"right\">APV no.</th><td><b>$apnumber</b></td></tr>";
	echo "<tr><th align=\"right\">Payee</th><td><b>$payeefin</b></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Save\" class='btn btn-success' role='button'></td></tr>";
	echo "</form>";
  echo "</table>";

  echo "<p><a href=\"finvouchapnew.php?loginid=$loginid&apn=$apnumber\" class='btn btn-default' role='button'>Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
} else {
     include ("logindeny.php");
} //if-else

mysql_close($dbh);
$dbh2->close();
?>
