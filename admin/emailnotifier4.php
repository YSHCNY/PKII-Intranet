<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
	include ("header.php");
    include ("sidebar.php");

    echo "<p><font size=1>Modules >> Custom pay notifier</font></p>";
	
    $cc1 = "aaroque@philkoei.com.ph";
     $cc2 = "aaroque@philkoei.com.ph, kbcruz@philkoei.com.ph";
     // echo "<html>";
?>
<STYLE TYPE="text/css">
<!--
TD{font-family: Helvetica; font-size: 10pt;}
--->
</STYLE>
<script language="JavaScript" src="ts_picker.js"></script>
<?php

     echo "<table class=\"fin\">";
     echo "<tr><th colspan='2'>Notifier Details for</th></tr>";

     echo "<form enctype=\"multipart/form-data\" action=\"sendmail2.php?loginid=$loginid&eid=$employeeid\" method=\"POST\" name=\"emailnotifier4\">";
    
	$resquery=""; $result="";
     $resquery="SELECT employeeid, name_first, name_last, email1, picfn, picpath FROM tblcontact WHERE employeeid =\"$employeeid\" AND contact_type=\"personnel\"";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
          $eid = $myrow['employeeid'];
          $name_first = $myrow['name_first'];
          $name_last = $myrow['name_last'];
          $email = $myrow['email1'];
		  $picfn = $myrow['picfn'];
		  $picpath = $myrow['picpath'];
		} //while
	} //if

    // echo "<tr><td colspan='2'>vartest rq:$resquery</td></tr>";

     echo "<tr><th colspan='2'>";
	if($picfn!='') {
	 echo "<img src=\"./images/$picpath/$picfn\" height=\"100\"> ";		 
	} //if
	 echo " $eid - <strong>$name_first $name_last</strong> - $email</th></tr>";

     echo "<tr><th class='text-right'>Project Name</th>";
     echo "<td>";
//     echo "<select name=projectname>";

    $resquery=""; $result="";
     // $result = mysql_query("SELECT DISTINCT proj_name FROM tblprojassign WHERE employeeid='$employeeid' AND (proj_code != '' OR proj_code != 'Select Pro') AND proj_name != '' ORDER BY durationfrom ASC", $dbh);
	 $resquery="SELECT DISTINCT proj_name FROM tblprojassign WHERE employeeid='$employeeid' AND (proj_code != '' OR proj_code != 'Select Pro') AND proj_name != '' ORDER BY durationfrom DESC";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
          $proj_name = $myrow['proj_name'];
    
 //         echo "<option value=\"$proj_name\">$proj_name</option>";
	  // echo "<input type=checkbox name=projectname[] value=$proj_name checked=\"checked\">$proj_name<br>";
	  echo "<div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"projectname[]\" value=\"$proj_name\"><label>$proj_name</label></div><br>";			
		} //while
	} //if

		$res2query="";$result2=""; $found2=0; $ctr2=0;
		$res2query="SELECT DISTINCT projassignid FROM tblprojcdassign WHERE empid=\"$employeeid\"";
		$result2=$dbh2->query($res2query);
		if($result2->num_rows>0) {
			while($myrow2=$result2->fetch_assoc()) {
			$found2 = 1;
			$projassignid2 = $myrow2['projassignid'];

			echo "<div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"projectname[]\" value=\"$projassignid2\" checked=\"checked\"><label class='form-check-label'>";
			$res2bquery=""; $result2b=""; $found2b=0; $ctr2b=0;
			$res2bquery = "SELECT projectid, projcode, projname FROM tblprojcdassign WHERE empid=\"$employeeid\" AND projassignid=$projassignid2";
			$result2b=$dbh2->query($res2bquery);
			if($result2b->num_rows>0) {
				while($myrow2b=$result2b->fetch_assoc()) {
				$found2b = 1;
				$projectid2b = $myrow2b['projectid'];
				$projcode2b = $myrow2b['projcode'];
				$projname2b = $myrow2b['projname'];
				$ctr2b = $ctr2b + 1;
				if($ctr2b > 1) { echo " / "; }
				echo "$projname2b";					
				} //while
			} //if
			echo "</label></div><br>";				
			} //while
		} //if

     echo "<div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"projectname[]\" value=\"Others\"><label class='form-check-label'>Others&nbsp;</label>";
     echo "<input name=\"projectnameothers\"></div></td></tr>";
   
     echo "</select></td></tr>"; 
   
     echo "<tr><th class='text-right'>Pay Advisory Type</th>";

     echo "<td><div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"advisorytype[]\" value=\"Professional Fee\" checked=\"checked\"><label class='form-check-label'>Professional Fee</label></div><br>";
     echo "<div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"advisorytype[]\" value=\"Salary\"><label class='form-check-label'>Salary</label></div><br>";
     echo "<div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"advisorytype[]\" value=\"Per Diem\"><label class='form-check-label'>Per Diem</label></div><br>";
     echo "<div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"advisorytype[]\" value=\"Cash Advance\"><label class='form-check-label'>Cash Advance</label></div><br>";
     echo "<div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"advisorytype[]\" value=\"Allowance\"><label class='form-check-label'>Allowance</label></div><br>";
     echo "<div class='form-check'><input class=\"form-check-input\" type=\"checkbox\" name=\"advisorytype[]\" value=\"Others\"><label class='form-check-label'>Others&nbsp;</label>";
     echo "<input name=\"advisorytypeothers\"></div></td></tr>";

     echo "<tr><th class='text-right'>Amount</th>";
     echo "<td><div class='form-group'><input type='currency' name=\"payamount\"></div></td></tr>";
     echo "<tr><th class='text-right'>Currency</th>";
     echo "<td><div class='form-check'><input class='form-check-input' type=\"radio\" name=\"currency\" value=\"Philippine Peso\" checked=\"checked\"><label class='form-check-label'>Philippine Peso</label></div><br>";
     echo "<div class='form-check'><input class='form-check-input' type=\"radio\" name=\"currency\" value=\"US Dollars\"><label class='form-check-label'>United States Dollars</label></div><br>";
     echo "<div class='form-check'><input class='form-check-input' type=\"radio\" name=\"currency\" value=\"Japanese Yen\"><label class='form-check-label'>Japanese Yen</label></div><br>";
     echo "<div class='form-check'><input class='form-check-input' type=\"radio\" name=\"currency\" value=\"Others\"><label class='form-check-label'>Other currency&nbsp;</label>";
     echo "<input name=\"othercurrency\"></div></td></tr>";
     
     echo "<tr><th class='text-right'>Pay Type</th>";
     echo "<td><div class='form-check'><input class='form-check-input' type=\"radio\" name=\"paytype\" value=\"Cash\" checked=\"checked\"><label class='form-check-label'>CASH</label></div><br>";
     echo "------------<br>";
     echo "<div class='form-check'><input class='form-check-input' type=\"radio\" name=\"paytype\" value=\"Bank Acct\"><label class='form-check-label'>BANK Deposit</label></div><br>";

     echo "<table class='fin2'><tr><th class='text-right'>";
     echo "Bank Acct Info</th><td>";

    echo "<div class='form-group'>";
	echo "<select name=\"acct_num\">";
    $resquery=""; $result="";
    $resquery="SELECT acct_num, bank_name, bank_branch FROM tblbankacct WHERE employeeid='$employeeid'";
	$result=$dbh2->query($resquery);
    if($result->num_rows>0) {
        while($myrow=$result->fetch_assoc()) {
           $acct_num = $myrow['acct_num'];
           $bank_name = $myrow['bank_name'];
           $bank_branch = $myrow['bank_branch'];
           echo "<option value=\"$acct_num\">$bank_name $bank_branch $acct_num</option>";			
		} //while
    } //if
    echo "</select></div><br>";

     echo "Date Deposited";
   
     echo "<div class='form-group'><input type=\"date\" name=\"datedeposited\" value=\"$datenow\"></div>";
     ?>
     <!-- <a href="javascript:show_calendar('document.emailnotifier4.datedeposited', document.emailnotifier4.datedeposited.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
    <?php

     echo "</td></tr></table>";
     echo "------------<br>";

     echo "<div class='form-check'><input class='form-check-input' type=\"radio\" name=\"paytype\" value=\"Bank Deposit\"><label class='form-check-label'>BANK Deposit (custom)</label></div><br>";

     echo "<table class='fin2'><tr><th class='text-right'>Bank Name</th><td><div class='form-group'><input name=\"paytypebankname\"></div></td></tr>";
     echo "<tr><th class='text-right'>Bank Branch</th><td><div class='form-group'><input name=\"paytypebankbranch\"></div></td></tr>";
     echo "<tr><th class='text-right'>Acct Number</th><td><div class='form-group'><input name=\"paytypeacctnumber\"></div></td></tr>";
     echo "<tr><th class='text-right'>Acct Name</th><td><div class='form-group'><input name=\"paytypeacctname\"></div></td></tr>";
     echo "<tr><th class='text-right'>Acct Type</th><td><div class='form-group'><input name=\"paytypeaccttype\"></div></td></tr>";
     echo "<tr><th class='text-right'>Date Deposited";
     echo "</th><td><div class='form-group'><input type=\"date\" name=\"datedepositedcustom\" value=\"$datenow\"></div>";
     ?>
     <!-- <a href="javascript:show_calendar('document.emailnotifier4.datedepositedcustom', document.emailnotifier4.datedepositedcustom.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
    <?php

     echo "</td></tr></table>";

     echo "<tr><th class='text-right'>Optional: Additional Details</th>";
     echo "<td><div class='form-group'><textarea name=\"moredetails\" rows='5' cols='60'>&nbsp</textarea></div></td></tr>";

     echo "<tr><th class='text-right'>File attachment</th>";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\" />";
    echo "<td><input name=\"uploaded_file\" type=\"file\" />";
    echo "</td></tr>";

     echo "</td></tr></table>";

echo "<hr>";

     echo "<table class=\"fin\">";
     echo "<tr><th colspan='2'>Email Template</th></tr>";

     echo "<tr><th class='text-right'>To</th><td><div class='form-group'><input name=\"to\" value=\"$email\"></div></td></tr>";

    $resquery=""; $result="";
    $resquery="SELECT * FROM tblemailnotifier WHERE notifierid=2";
    $result=$dbh2->query($resquery);
    if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
          $from = $myrow['from'];
          $subject = $myrow['subject'];
          $header = $myrow['header'];
          $footer = $myrow['footer'];
          $notes = $myrow['notes'];			
		} //while
	} //if

     echo "<tr><th class='text-right'>From</th><td><div class='form-group'><input name=\"from\" value=\"$from\"></div></td></tr>";

    $resquery=""; $result="";
    $resquery="SELECT tblcontact.email1 FROM tblcontact JOIN tbladminlogin ON tblcontact.employeeid = tbladminlogin.employeeid WHERE tbladminlogin.adminloginid=$loginid";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
          $bcc = $myrow['email1'];			
		} //while
	} //if
    $ccfin="";
    if($bcc!='') {
        if($bcc=="kbcruz@philkoei.com.ph") {
        $ccfin = $cc1;
        } else {
        $ccfin = $cc2;
        } //if-else
    } //if
    
     echo "<tr><th class='text-right'><i>Cc</i></th><td><div class='form-group'><input name=\"cc\" value=\"$ccfin\"></div></td></tr>";
     echo "<tr><th class='text-right'><i>Bcc</i></th><td><div class='form-group'><input name=\"bcc\" value=\"$bcc\"></div></td></tr>";

     echo "<tr><th class='text-right'>Subject</th><td><div class='form-group'><input name=\"subject\" value=\"$subject\"></div></td></tr>";
     echo "<tr><th class='text-right'>Header</th><td><div class='form-group'><textarea name=\"header\">$header</textarea></div></td></tr>";
     echo "<tr><th class='text-right'>Salary Details</th><td><div class='form-group'><textarea name=\"salary\" readonly>{Pls. review email body details above before sending}</textarea></div></td></tr>";
     echo "<tr><th class='text-right'>Footer</th><td><div class='form-group'><textarea name=\"footer\">$footer</textarea></div></td></tr>";
     echo "<tr><th class='text-right'>Notes</th><td><div class='form-group'><textarea name=\"notes\">$notes</textarea></div></td></tr>";

     echo "<tr><td colspan='2'><button type=\"submit\" class='btn btn-primary'>Preview></button></td></tr>";
     echo "</table>";
     echo "</form>";

     echo "<script language=javascript>";
     echo "function mypopup()";
     echo "{";
     echo "alert(\"this is a test\")";
     echo "}"; 
     echo "</script>";
    //  echo "</html>";
    echo "<p><a href=\"emailnotifier2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
