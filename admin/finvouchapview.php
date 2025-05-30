<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$acctspayablenumber0 = (isset($_GET['apn'])) ? $_GET['apn'] :'';

$apdate = (isset($_POST['yyyyap'])) ? $_POST['yyyyap'] :''."-".(isset($_POST['mmmap'])) ? $_POST['mmmap'] :''."-".(isset($_POST['ddap'])) ? $_POST['ddap'] :'';
$acctspayablenumber = (isset($_POST['apnumber'])) ? $_POST['apnumber'] :'';
$appayee = (isset($_POST['appayee'])) ? $_POST['appayee'] :'';
$explanation = (isset($_POST['explanation'])) ? $_POST['explanation'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  
	  //  contained header to make a push to contents and make the footer "sticky".
	echo "<section class=\"container\">";
	// echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr>";
	echo "<td colspan=\"6\">";
	echo "<header class=\"block\">";

if ($found == 1) {
     include ("headprint.php");
//     include ("header.php");
//     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" width=\"100%\" border=\"0\">";
      echo "<tr><th colspan=\"2\">Accounts Payable</th></tr>";

// get default version of glcode
		$res20query = "SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"";
		$result20=""; $found20=0; $ctr20=0;
		$result20=$dbh2->query($res20query);
		if($result20->num_rows>0) {
			while($myrow20 = $result20->fetch_assoc()) {
	$version20 = $myrow20['version'];
			} // while
		} // if

if($acctspayablenumber0 != '') {

  $res15query = "SELECT acctspayablenumber, payee, date, due_date FROM tblfinacctspayable WHERE acctspayablenumber = \"$acctspayablenumber0\"";
	$result15=""; $found15=0; $ctr15=0;
	$result15=$dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
    $found15 = 1;
    $acctspayablenumber15 = $myrow15['acctspayablenumber'];
    $appayee15 = $myrow15['payee'];
    $apdate15 = $myrow15['date'];
    $apduedate15 = $myrow15['due_date'];
		} // while
	} // if

  $res16query = "SELECT acctspayabletotid, acctspayablenumber, date, explanation, debittot, credittot FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber0\"";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
    $found16 = 1;
    $acctspayabletotid16 = $myrow16['acctspayabletotid'];
    $acctspayablenumber16 = $myrow16['acctspayablenumber'];
    $apdate16 = $myrow16['apdate'];
    $explanation16 = $myrow16['explanation'];
    $debittot16 = number_format($myrow16['debittot'],2);
    $credittot16 = number_format($myrow16['credittot'],2);
		} // while
	} // if
	

    echo "<tr><td>Date:&nbsp;<b>".date("Y-M-d", strtotime($apdate15))."</b></td> <td align=\"right\">AP No.:&nbsp; <b>$acctspayablenumber15</b></td></tr>";
    echo "<tr><td>Payee: <b>$appayee15</b><br></td> <td align=\"right\">Due Date: <b>".date("Y-M-d", strtotime($apduedate15))."</b></td></tr>";
	
		echo "</td></tr>";
		echo "</table>";
		echo "</header>";
		echo "</td>";
	
	
    echo "<tr><td colspan=\"2\"><div class=\"block push\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

    $res20query = "SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"";
		$result20=""; $found20=0; $ctr20=0;
		$result20=$dbh2->query($res20query);
		if($result20->num_rows>0) {
			while($myrow20=$result20->fetch_assoc()) {
			$found20=1;
			$version20 = $myrow20['version'];
			} // while
		} // if

		$res17query = "SELECT acctspayableid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber = \"$acctspayablenumber0\" ORDER BY acctspayableid ASC";
		$result17=""; $found17=0; $ctr17=0; $creditamttxt=0;
		$result17=$dbh2->query($res17query);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
	$found17 = 1;
	$acctspayableid17 = $myrow17['acctspayableid'];
	$glcode17 = $myrow17['glcode'];
	$glrefver17 = $myrow17['glrefver'];
	$glnamedetails17 = $myrow17['glnamedetails'];
	$projcode17 = $myrow17['projcode'];
	$particulars17 = $myrow17['particulars'];
	$debitamt17 = number_format($myrow17['debitamt'],2);
	$creditamt17 = number_format($myrow17['creditamt'],2);

	$res18query = "SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
	  $found18 = 1;
	  $glname18 = $myrow18['glname'];
		} // while
	} // if

	echo "<tr><td>$glcode17</td>";
	echo "<td>$projcode17</td>";
	echo "<td>".nl2br($particulars17)."</td><td align=\"right\">$debitamt17</td><td align=\"right\">$creditamt17</td>";
	echo "</tr>";

			} // while
		} // if

	// insert explanation
	echo "<tr><td colspan=\"2\"></td><td><i>".nl2br($explanation16)."</i></td><td colspan=\"2\"></td></tr>";

      echo "<tr><td colspan=\"2\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>$debittot16</b></td><td align=\"right\"><b>$credittot16</b></td></tr>";
    echo "</td></tr></table>";
    // echo "<tr><td colspan=\"2\" align=\"center\">Explanation<br>";
    // echo "<textarea rows=\"4\" cols=\"60\" name=\"explanation\" readonly>$explanation16</textarea></td></tr>";

	$res21query = "SELECT rfplabel, rfppreparedlbl, rfpprepared, rfppreparedpos, rfpcheckedlbl, rfpchecked, rfpcheckedpos, rfpapprovedlbl, rfpapproved, rfpapprovedpos, cvlabel, cvpreparedlbl, cvprepared, cvpreparedpos, cvcheckedlbl, cvchecked, cvcheckedpos, cvapproved1lbl, cvapproved1, cvapproved1pos, cvapproved2lbl, cvapproved2, cvapproved2pos FROM tblfinrptdisbursement WHERE rptdisbursementid=1";
	$result21=""; $found21=0; $ctr21=0;
	$result21=$dbh2->query($res21query);
	if($result21->num_rows>0) {
		while($myrow21=$result21->fetch_assoc()) {
    $found21 = 1;
    $rfplabel21 = $myrow21['rfplabel'];
    $rfppreparedlbl21 = $myrow21['rfppreparedlbl'];
    $rfpprepared21 = $myrow21['rfpprepared'];
    $rfppreparedpos21 = $myrow21['rfppreparedpos'];
    $rfpcheckedlbl21 = $myrow21['rfpcheckedlbl'];
    $rfpchecked21 = $myrow21['rfpchecked'];
    $rfpcheckedpos21 = $myrow21['rfpcheckedpos'];
    $rfpapprovedlbl21 = $myrow21['rfpapprovedlbl'];
    $rfpapproved21 = $myrow21['rfpapproved'];
    $rfpapprovedpos21 = $myrow21['rfpapprovedpos'];
    $cvlabel21 = $myrow21['cvlabel'];
    $cvpreparedlbl21 = $myrow21['cvpreparedlbl'];
    $cvprepared21 = $myrow21['cvprepared'];
    $cvpreparedpos21 = $myrow21['cvpreparedpos'];
    $cvcheckedlbl21 = $myrow21['cvcheckedlbl'];
    $cvchecked21 = $myrow21['cvchecked'];
    $cvcheckedpos21 = $myrow21['cvcheckedpos'];
    $cvapproved1lbl21 = $myrow21['cvapproved1lbl'];
    $cvapproved121 = $myrow21['cvapproved1'];
    $cvapproved1pos21 = $myrow21['cvapproved1pos'];
    $cvapproved2lbl21 = $myrow21['cvapproved2lbl'];
    $cvapproved221 = $myrow21['cvapproved2'];
    $cvapproved2pos21 = $myrow21['cvapproved2pos'];
		} // while
	} // if
	
		echo "</div>";
		echo "</td></tr>";	
		
		
	
		echo "<footer class=\"block\">"; // this is where all the contents that will go to the bottom of the page once printed.
		echo "<table class=\"fin\" border=\"0\" width=\"100%\">";
			echo "<tr><td colspan=\"2\">";
			echo "<div class=\"page_break\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				echo "<tr><div class=\"page_break\"><td colspan=\"6\" align=\"center\">Accounts Payable Voucher</td></tr>";
				echo "<tr><td align=\"center\"><br><br>$cvprepared21<br>$cvpreparedpos21</td>
						  <td align=\"center\"><br><br>$cvprepared21<br>$cvpreparedpos21</td>
						  <td align=\"center\"><br><br>$cvprepared21<br>$cvpreparedpos21</td>
						  <td align=\"center\"><br><br>$cvchecked21<br>$cvcheckedpos21</td>
					  </tr>";
				echo "<tr><td align=\"center\">Prepared By:</td>
						  <td align=\"center\">Checked By:</td>
						  <td align=\"center\">Recommending Approval:</td>
						  <td align=\"center\">Approved By:</td>
					  </tr>";
	
		
	// echo "</td>";
	

//
//
// insert amount in words
	// query creditamt
	$res19query="SELECT acctspayableid, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber = \"$acctspayablenumber0\" AND glcode=\"20.10.100\" AND glrefver=2 LIMIT 1";
	$result19=""; $found19=0; $ctr19=0;
	$result19=$dbh2->query($res19query);
	if($result19->num_rows>0) {
		while($myrow19=$result19->fetch_assoc()) {
		$found19=1;
		$acctspayableid19 = $myrow19['acctspayableid'];
		$debitamt19 = $myrow19['debitamt'];
		$creditamt19 = $myrow19['creditamt'];
		} // while
	} // if
	if($found19==1) {
    $arrcreditamt = explode('.', $creditamt19);
    $creditamtwhole = $arrcreditamt[0];
    $creditamtdec = $arrcreditamt[1];
		echo "<tr><td colspan=\"4\" align=\"left\">AMOUNTING TO <strong><u>".convert_number($creditamt19)."";
    if($creditamtdec != 0) { echo " & ".$creditamtdec."/100"; } else { echo ""; }
    echo " Pesos Only</u>&nbsp;<u>(P".number_format($creditamt19, 2).")</u></strong>";
		// echo "<br>txt:$creditamttxt|whl:$creditamtwhole|dec:$creditamtdec";
		echo "</td></tr>";
	} // if
//
//
    // echo "<tr><td colspan=\"2\" align=\"center\">";
		// echo "<br><br>____________________________________________<br>Signature over Printed Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
		echo "</table>";
		echo "</table>";
		echo "</div>";
echo "</div>";
echo "</footer>";
echo "</section>";
/*    echo "<tr><td colspan=\"2\" align=\"center\"><form method=\"post\">";
    echo "<input type=\"button\" value=\"Close\" onclick=\"window.close()\"></form></td></tr>"; */
//
//
} else if($acctspayablenumber == '' || $appayee == '') {
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, AP Number &/or Payee should not be blank. Please try again.</font></td></tr>";

//
//
} else {

  $res11query = "SELECT acctspayablenumber FROM tblfinacctspayable WHERE acctspayablenumber = \"$acctspayablenumber\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $acctspayablenumber11 = $myrow11['acctspayablenumber'];
		} // while
	} // if
  if($found11 == 1) {
    echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Warning: A.P. Number:$acctspayablenumber11</b> already used. Please try again.</font></td></tr>";
  } else {
    echo "<form action=\"finvouchapadd.php?loginid=$loginid\" method=\"post\">";
    echo "<tr><td>Date:&nbsp;<b><input name=\"apdate\" value=\"$acctspayabledate\" size=\"12\" readonly></b></td><td>AP No.:&nbsp;<b><input name=\"apnumber\" value=\"$acctspayablenumber\" size=\"12\" readonly></b></td></tr>";
    echo "<tr><td colspan=\"2\">Payee<br><input size=\"30\" name=\"appayee\" value=\"$appayee\" readonly></td></tr>";
    echo "<tr><td colspan=\"2\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

    $res17query = "SELECT acctspayableid, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber = \"$apnumber\" ORDER BY acctspayableid ASC";
		$result17=""; $found17=0; $ctr17=0;
		$result17=$dbh2->query($res17query);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
	$found17 = 1;
	$acctspayableid17 = $myrow17['acctspayableid'];
	$glcode17 = $myrow17['glcode'];
	$glnamedetails17 = $myrow17['glnamedetails'];https://192.168.0.10/pkii/admin/finvouchapview.php?loginid=31&apn=APV.10.002.2018
	$projcode17 = $myrow17['projcode'];
	$particulars17 = $myrow17['particulars'];
	$debitamt17 = $myrow17['debitamt'];
	$creditamt17 = $myrow17['creditamt'];

	$res18query = "SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$version20";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
	  $found18 = 1;
	  $glname18 = $myrow18['glname'];
		} // while
	} // if

	echo "<tr><td>$glcode17</td>";
	echo "<td>$projcode17</td>";
	echo "<td>".nl2br($particulars17)."</td><td align=\"right\">$debitamt17</td><td align=\"right\">$creditamt17</td>";
	echo "</tr>";
			} // while
		} // if

  $res16query = "SELECT acctspayabletotid, acctspayablenumber, date, explanation, debittot, credittot FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber\"";
	$result16=""; $found16=0; $ctr16=0;
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
    $found16 = 1;
    $acctspayabletotid16 = $myrow16['acctspayabletotid'];
    $acctspayablenumber16 = $myrow16['acctspayablenumber'];
    $date16 = $myrow16['date'];
    $explanation16 = $myrow16['explanation'];
    $debittot16 = $myrow16['debittot'];
    $credittot16 = $myrow16['credittot'];
		} // while
	} // if

      echo "<tr><td colspan=\"2\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>$debittot16</b></td><td align=\"right\"><b>$credittot16</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea rows=\"3\" cols=\"40\" name=\"explanation\" readonly>".nl2br($explanation)."</textarea></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><br><br>____________________________________________<br>Signature over Printed Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
/*    echo "<tr><td colspan=\"2\" align=\"center\"><form method=\"post\">";
    echo "<input type=\"button\" value=\"Close\" onclick=\"javascript:window.close();\"></form></td></tr>"; */


  }
}
      echo "</table>";

// end contents here

    $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
		$result=$dbh2->query($resquery);

     include ("footer.php");

} else {

     include ("logindeny.php");

}

mysql_close($dbh);
$dbh2->close();

function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 

    $Gn = floor($number / 1000000);  /* Millions (giga) */ 
    $number -= $Gn * 1000000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Million"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", 
        "Seventy", "Eighty", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            // $res .= " and ";
					$res .= " "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 

?>

<script language="javascript">

// This function goes through the options for the given
// drop down box and removes them in preparation for
// a new set of values

function emptyList( box ) {
	// Set each option to null thus removing it
	while ( box.options.length ) box.options[0] = null;
}

// This function assigns new drop down options to the given
// drop down box from the list of lists specified

function fillList( box, arr ) {
	// arr[0] holds the display text
	// arr[1] are the values

	for ( i = 0; i < arr[0].length; i++ ) {

		// Create a new drop down option with the
		// display text and value from arr

		option = new Option( arr[0][i], arr[1][i] );

		// Add to the end of the existing options

		box.options[box.length] = option;
	}

	// Preselect option 0

	box.selectedIndex=0;
}

// This function performs a drop down list option change by first
// emptying the existing option list and then assigning a new set

function changeList( box ) {
	// Isolate the appropriate list by using the value
	// of the currently selected option

	list = lists[box.options[box.selectedIndex].value];

	// Next empty the slave list

	emptyList( box.form.slave );

	// Then assign the new list values

	fillList( box.form.slave, list );
}
</script>
<style>
  body > table.fin {
    background: none;
    width: 85%;
    margin: 0 auto;
    margin-top: 105px;
}

@media print{
  .header-container{
    display: none;
  }
}
</style>
