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
  echo "<tr><th colspan=\"2\">Accounts Payable Voucher - change APV number</th></tr>";
	echo "<form action=\"finvouchapvchgpayee2.php?loginid=$loginid&apvn=$apnumber&apvdt=$apdate\" method=\"post\" name=\"form1\">";
	echo "<tr><th align=\"right\">Date</th><td><strong>$apdate</strong>";

	echo "</td></tr>";
	echo "<tr><th align=\"right\">APV no.</th><td><strong>$apnumber</strong></td></tr>";
	echo "<tr><th align=\"right\" rowspan='2'>Payee</th><td>";

    if($company_id11!=0) {
		$compidchk="checked=company";
	} else {
		$compidchk="";
	} //if-else
    echo "<input id=\"radio1\" type=\"radio\" name=\"payeesw\" value=\"company\" />";
    // echo "<labe><input type=\"radio\" name=\"payeesw\" value=\"company\" /></label>";
    echo "<select class=\"form-control\" name=\"payeecompanyid\" id='apcomp' onchange=\"radioselect1()\">";
    echo "<option value=\"\">select company</option>";
    $res12query=""; $result12=""; $found12=0; $ctr12=0;
    $res12query="SELECT companyid, company, branch FROM tblcompany ORDER BY company ASC";
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12++;
      $companyid12 = $myrow12['companyid'];
      $company12 = $myrow12['company'];
      $branch12 = $myrow12['branch'];
	  if($companyid12==$company_id11) {
		  $compidsel="selected";
	  } else {
		  $compidsel="";
	  } //if-else
      echo "<option value=\"$companyid12\" $compidsel>$company12";
      if($branch12 != "") { echo " - $branch12"; }
      echo "</option>";			
		} //while
	} //if
    echo "</select>";
	echo "</td></tr>";

	echo "<tr><td>";
    if($contact_id11!=0) {
		$contidchk="checked=contactperson";
	} else {
		$contidchk="";
	} //if-else
    echo "<input id=\"radio2\" type=\"radio\" name=\"payeesw\" value=\"contactperson\" $contidchk />";
    echo "<select class=\"form-control\" name=\"payeecontactid\" id='apemp' onchange=\"radioselect2()\">";
    echo "<option value=\"\">select individual person</option>";
    $res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC";
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$ctr14++;
      $contactid14 = $myrow14['contactid'];
      $companyid14 = $myrow14['companyid'];
      $employeeid14 = $myrow14['employeeid'];
      $name_last14 = $myrow14['name_last'];
      $name_first14 = $myrow14['name_first'];
      $name_middle14 = $myrow14['name_middle'];
	  if($contact_id11==$contactid14) {
		  $contidsel="selected";
	  } else {
		  $contidsel="";
	  } //if-else
      echo "<option value=\"$contactid14\" $contidsel>$name_first14";
      if($name_middle14 != "") { echo "&nbsp;$name_middle14[0]."; }
      echo "&nbsp;$name_last14";
      if($employeeid14 != '') { echo "&nbsp;($employeeid14)"; }
      echo "</option>";			
		} //while
	} //if
    echo "</select>";	
	echo "</td></tr>";

	echo "<tr><td colspan=\"2\" align=\"center\"><button type=\"submit\" class='btn btn-success'>Save</button></td></tr>";
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

<SCRIPT type="text/javascript" language="JavaScript">

function radioselect2()
{
     document.getElementById('radio2').checked = true;
}
function radioselect1()
{
     document.getElementById('radio1').checked = true;	
}

</SCRIPT>