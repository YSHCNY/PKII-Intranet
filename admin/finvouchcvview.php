<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$cvnumber0 = (isset($_GET['cvn'])) ? $_GET['cvn'] :'';

$cvdate = $_POST['yyyycv']."-".$_POST['mmmcv']."-".$_POST['ddcv'];
$cvnumber = (isset($_POST['cvnumber'])) ? $_POST['cvnumber'] :'';
$cvpayee = (isset($_POST['cvpayee'])) ? $_POST['cvpayee'] :'';
$explanation = (isset($_POST['explanation'])) ? $_POST['explanation'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

	  //  contained header to make a push to contents and make the footer "sticky".
	echo "<section class=\"container\">";
	// echo "<table border=0 spacing=0 cellspacing=0 cellpadding=0><tr>";
	echo "<td colspan=\"2\">";
	echo "<header class=\"block\">";

if ($found == 1) {
     include ("headprint.php");
//     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" border=\"0\" width=\"100%\">";
      echo "<tr><th colspan=\"2\">Check Vouchers</th></tr>";

// get default version of glcode
      $result20 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
      while($myrow20 = mysql_fetch_row($result20))
      {
	$version20 = $myrow20[0];
      }

if($cvnumber0 != '') {
	// prep vars
	$debitamttot=0; $creditamttot=0;

  $result15 = mysql_query("SELECT disbursementnumber, disbursementtype, payee, date, companyid, contactid, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber = \"$cvnumber0\"", $dbh);
  while ($myrow15 = mysql_fetch_row($result15))
  {
    $found15 = 1;
    $cvnumber15 = $myrow15[0];
    $cvtype15 = $myrow15[1];
    $cvpayee15 = $myrow15[2];
    $cvdate15 = $myrow15[3];
		$companyid15 = $myrow15[4];
		$contactid15 = $myrow15[5];
		$debitamt15 = $myrow15[6];
		$creditamt15 = $myrow15[7];
		$debitamttot=$debitamttot+$debitamt15;
		$creditamttot=$creditamttot+$creditamt15;
		// reset variables
		$debitamt15=0; $creditamt15=0;
  }
	
  $result16 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber0\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $disbursementtotid16 = $myrow16[0];
    $disbursementnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    // $debittot16 = $myrow16[4];
    // $credittot16 = $myrow16[5];
  } 

    echo "<tr><td>Date:&nbsp;<b><u>".date("Y-M-d", strtotime($cvdate15))."</u></b></td><td align=\"right\">Ref. No.:&nbsp;<b><u>$cvnumber15</u></b></td></tr>";
    echo "<tr><td colspan=\"2\">Payee:&nbsp;";
		if((($companyid15!="") || ($companyid15!=0)) && (($contactid15=="") || ($contactid15==0))) {
			$result15a=""; $found15a=0; $ctr15a=0;
			$result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid15", $dbh);
			if($result15a != "") {
				while($myrow15a = mysql_fetch_row($result15a)) {
				$found15a = 1;
				$company15a = $myrow15a[0];
				$branch15a = $myrow15a[1];
				}
			}
			$company15afin = $company15a;
			if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
			echo "<b><u>$company15afin</u></b>";
		}
		if((($contactid15!="") || ($contactid15!=0)) && (($companyid15=="") || ($companyid15==0))) {
			$result15b=""; $found15b=0; $ctr15b=0;
			$result15b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid15", $dbh);
			if($result15b != "") {
				while($myrow15b = mysql_fetch_row($result15b)) { 
				$found15b = 1;
				$companyid15b = $myrow15b[0];
				$employeeid15b = $myrow15b[1];
				$name_last15b = $myrow15b[2];
				$name_first15b = $myrow15b[3];
				$name_middle15b = $myrow15b[4];
				}
			}
			$contactname15bfin = $name_first15b;
			if($name_middle15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_middle15b[0] . "."; }
			if($name_last15b != "") { $contactname15bfin = $contactname15bfin . "&nbsp;" . $name_last15b; }
			echo "<b><u>$contactname15bfin</u></b>";
		}
		if((($companyid15=="") && ($contactid15=="")) || (($companyid15==0) && ($contactid15==0))) {
			echo "<b><u>$payor15</u></b>";
		}
		// echo "<input size=\"50\" name=\"cvpayee\" value=\"$cvpayee15\" readonly>";
		echo "</td></tr>";
		echo "</table>";
		echo "</header>";
		echo "</td>";
	
    echo "<tr><td colspan=\"2\"><div class=\"block push\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

      $result20 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
      while($myrow20 = mysql_fetch_row($result20))
      {
	$version20 = $myrow20[0];
      }

      $result17 = mysql_query("SELECT disbursementid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber = \"$cvnumber0\" ORDER BY disbursementid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
	$found17 = 1;
	$disbursementid17 = $myrow17[0];
	$glcode17 = $myrow17[1];
	$glrefver17 = $myrow17[2];
	$glnamedetails17 = $myrow17[3];
	$projcode17 = $myrow17[4];
	$particulars17 = $myrow17[5];
	$debitamt17 = $myrow17[6];
	$creditamt17 = $myrow17[7];

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17", $dbh);
	while($myrow18 = mysql_fetch_row($result18))
	{
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode17</td>";
//	echo "<td>$projcode17 - $particulars17</td><td align=\"right\">".number_format($debitamt17,2)."</td><td align=\"right\">".number_format($creditamt17,2)."</td>";
	echo "<td>".nl2br($particulars17)."</td><td align=\"right\">".number_format($debitamt17,2)."</td><td align=\"right\">".number_format($creditamt17,2)."</td>";
	echo "</tr>";
      }

      echo "<tr><td><td><i>".nl2br($explanation16)."</i></td><td>&nbsp;</td><td>&nbsp;</td></tr>";

      echo "<tr><td>&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>P&nbsp;".number_format($debitamttot,2)."</b></td><td align=\"right\"><b>P&nbsp;".number_format($creditamttot,2)."</b></td></tr>";
      echo "</table>";
	  echo "</div>";
    echo "</td></tr>";
	
/*    $result21 = mysql_query("SELECT rfplabel, rfppreparedlbl, rfpprepared, rfppreparedpos, rfpcheckedlbl, rfpchecked, rfpcheckedpos, rfpapprovedlbl, rfpapproved, rfpapprovedpos, cvlabel, cvpreparedlbl, cvprepared, cvpreparedpos, cvcheckedlbl, cvchecked, cvcheckedpos, cvapproved1lbl, cvapproved1, cvapproved1pos, cvapproved2lbl, cvapproved2, cvapproved2pos FROM tblfinrptdisbursement WHERE rptdisbursementid=1", $dbh);
    while($myrow21 = mysql_fetch_row($result21))
    {
      $found12 = 1;
      $rfplabel21 = $myrow21[0];
      $rfppreparedlbl21 = $myrow21[1];
      $rfpprepared21 = $myrow21[2];
      $rfppreparedpos21 = $myrow21[3];
      $rfpcheckedlbl21 = $myrow21[4];
      $rfpchecked21 = $myrow21[5];
      $rfpcheckedpos21 = $myrow21[6];
      $rfpapprovedlbl21 = $myrow21[7];
      $rfpapproved21 = $myrow21[8];
      $rfpapprovedpos21 = $myrow21[9];
      $cvlabel21 = $myrow21[10];
      $cvpreparedlbl21 = $myrow21[11];
      $cvprepared21 = $myrow21[12];
      $cvpreparedpos21 = $myrow21[13];
      $cvcheckedlbl21 = $myrow21[14];
      $cvchecked21 = $myrow21[15];
      $cvcheckedpos21 = $myrow21[16];
      $cvapproved1lbl21 = $myrow21[17];
      $cvapproved121 = $myrow21[18];
      $cvapproved1pos21 = $myrow21[19];
      $cvapproved2lbl21 = $myrow21[20];
      $cvapproved221 = $myrow21[21];
      $cvapproved2pos21 = $myrow21[22];
    }
	
	echo "<td colspan=\"2\">";
	echo "<footer class=\"block\">";
	echo "<table class=\"fin\" border=\"0\" width=\"100%\">";
		echo "<tr><td colspan=\"2\">";
		echo "<div class=\"page_break\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<tr><td>";
			echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				echo "<tr><td colspan=\"2\" align=\"center\">$rfplabel21</td></tr>";
				echo "<tr><td align=\"center\">$rfppreparedlbl21</td><td align=\"center\">$rfpcheckedlbl21</td></tr>";
				echo "<tr><td align=\"center\">$rfpprepared21</td><td align=\"center\">$rfpchecked21</td></tr>";
				echo "<tr><td colspan=\"2\" align=\"center\">$rfpapprovedlbl21</td></tr>";
				echo "<tr><td colspan=\"2\" align=\"center\">$rfpapproved21<br>$rfpapprovedpos21</td></tr>";
			echo "</table>";
			echo "</td><td>";
		echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<tr><td colspan=\"2\" align=\"center\">$cvlabel21</td></tr>";
			echo "<tr><td align=\"center\">$cvpreparedlbl21</td><td align=\"center\">$cvcheckedlbl21</td></tr>";
			echo "<tr><td align=\"center\">$cvprepared21<br>$cvpreparedpos21</td><td align=\"center\">$cvchecked21<br>$cvcheckedpos21</td></tr>";
			echo "<tr><td colspan=\"2\" align=\"center\">$cvapproved1lbl21</td></tr>";
			echo "<tr><td align=\"center\">$cvapproved121<br>$cvapproved1pos21</td><td align=\"center\">$cvapproved221<br>$cvapproved2pos21</td></tr>";
		echo "</table>";
		echo "</div>";
		echo "</td></tr>";
*/

    // display signatory footer here
    // signatory footer template from journal voucher finvouchjvview.php as modified on 20220907 as reqd by ACTFIN ACB
    $res19query=""; $result19=""; $found19=0;
    $res19query = "SELECT approvedlbl, approved1, approved1pos, approved2, approved2pos, preparedlbl, prepared, preparedpos, checkedlbl, checked, checkedpos FROM tblfinrptjournal WHERE rptjournalid=1";
    $result19=$dbh2->query($res19query);
    if($result19->num_rows>0) {
        while($myrow19=$result19->fetch_assoc()) {
      $found19 = 1;
      $approvedlbl19 = $myrow19['approvedlbl'];
      $approved119 = $myrow19['approved1'];
      $approved1pos19 = $myrow19['approved1pos'];
      $approved219 = $myrow19['approved2'];
      $approved2pos19 = $myrow19['approved2pos'];
      $preparedlbl19 = $myrow19['preparedlbl'];
      $prepared19 = $myrow19['prepared'];
      $preparedpos19 = $myrow19['preparedpos'];
      $checkedlbl19 = $myrow19['checkedlbl'];
      $checked19 = $myrow19['checked'];
      $checkedpos19 = $myrow19['checkedpos'];
        } //while
    } //if
	
	echo "<tr><td colspan=\"2\">";
	echo "<footer class=\"block\">";
	echo "<table class=\"fin\" border=\"0\" width=\"100%\">";
	echo "<tr><td colspan=\"2\">";
      echo "<div class=\"page_break\"><table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	  echo "<tbody align=\"center\">";
	echo "<tr>";
        echo "<td align=\"left\">$preparedlbl19&nbsp;$prepared19</td>";
        echo "<td colspan=\"2\" align=\"center\">$approvedlbl19</td>";
        echo "</tr>";
		// echo "<tr><td align=\"center\"><b><u>$approved119</u></b><br>$approved1pos19</td><td align=\"center\"><b><u>$approved219</u></b><br>$approved2pos19</td><td>$checkedlbl19&nbsp;$checked19</td></tr>";
	// echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
        echo "<tr>";
        echo "<td align=\"left\">$checkedlbl19&nbsp;$checked19</td>";
        echo "<td colspan='2'></td>";
        echo "</tr>";
        // 20220923 insert last line for Recommending Approval
        echo "<tr>";
        echo "<td align=\"left\">Recommending Approval: ____________________<br>&nbsp;</td>";
        echo "<td align=\"center\">____________________<br>&nbsp;</td>";
        echo "<td align=\"center\">____________________<br>&nbsp;</td>";
        echo "</tr>";
	  echo "</tbody>";
	  echo "</div>";
      echo "</table>";
	// echo "</table>";
	// echo "</div>";
    echo "</td></tr>";


    // echo "<tr><td colspan=\"2\">";
	// echo "<div class=\"page_break\">";
        // echo "<table width=\"100%\" class=\"fin2\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

    // echo "</table>";
    // echo "</td></tr>"; 
    echo "<tr><td colspan=\"2\">";

        echo "RECEIVED FROM PKII CHECK NO. <b><u>$cvnumber15</b></u><br>";

    if($glrefver17 == 1)
    {
      $result22 = mysql_query("SELECT creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$cvnumber15\" AND glcode >= \"10.10.201\" AND glcode <= \"10.10.211\" AND glrefver = 1", $dbh);
    }
    else if($glrefver17 == 2)
    {
      $result22 = mysql_query("SELECT creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$cvnumber15\" AND glcode >= \"10.10.120\" AND glcode <= \"10.10.150\" AND glrefver = 2", $dbh);
    }
    while($myrow22 = mysql_fetch_row($result22))
    {
      $found22 = 1;
      $creditamt22 = $myrow22[0];
      $arrcreditamt = explode(".", $creditamt22);
      $creditamtwhole = $arrcreditamt[0];
      $creditamtdec = $arrcreditamt[1];
    }
    echo "AMOUNTING TO <b><u>".convert_number($creditamt22);
    if($creditamtdec != 0) { echo " & ".$creditamtdec."/100"; } else { echo ""; }
    echo " Pesos Only</u>&nbsp;<u>(P".number_format($creditamt22, 2).")</u></b>";

    echo "<br><br><center>_______________________________________________</center>";
    echo "<center>Signature over Printed Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center>";
    echo "</td></tr>";
	echo "</table>";
	echo "</div>";
	echo "</td></tr>";
	
	echo "</footer>";
	echo "</table>";
	echo "</td>";
	// echo "</tr></table>";
	echo "</section>";

/*    echo "<tr><td colspan=\"2\" align=\"center\"><form method=\"post\">";
    echo "<input type=\"button\" value=\"Close\" onclick=\"window.close()\"></form></td></tr>"; */

} else if($cvnumber == '' || $cvpayee == '') {

  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, CV Number &/or Payee should not be blank. Please try again.</font></td></tr>";

} else {

  $found11 = 0;
  $result11 = mysql_query("SELECT disbursementnumber FROM tblfindisbursement WHERE disbursementnumber = \"$cvnumber\"", $dbh);
  while ($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $disbursementnumber11 = $myrow11[0];
  }
  if($found11 == 1)
  {
    echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Warning: C.V. Number:$disbursementnumber11</b> already used. Please try again.</font></td></tr>";
  }
  else
  {
    echo "<form action=\"finvouchcvadd.php?loginid=$loginid\" method=\"post\">";
    echo "<tr><td>Date:&nbsp;<b><input name=\"cvdate\" value=\"$cvdate\" size=\"12\" readonly></b></td><td>CV No.:&nbsp;<b><input name=\"cvnumber\" value=\"$cvnumber\" size=\"12\" readonly></b></td></tr>";
    echo "<tr><td colspan=\"2\">Payee<br><input size=\"30\" name=\"cvpayee\" value=\"$cvpayee\" readonly></td></tr>";
    echo "<tr><td colspan=\"2\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

      $result17 = mysql_query("SELECT disbursementid, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber = \"$cvnumber\" ORDER BY disbursementid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
	$found17 = 1;
	$disbursementid17 = $myrow17[0];
	$glcode17 = $myrow17[1];
	$glnamedetails17 = $myrow17[2];
	$projcode17 = $myrow17[3];
	$particulars17 = $myrow17[4];
	$debitamt17 = $myrow17[5];
	$creditamt17 = $myrow17[6];

	$debitamttot=$debitamttot+$debitamt17;
	$creditamttot=$creditamttot+$creditamt17;

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$version20", $dbh);
	while($myrow18 = mysql_fetch_row($result18))
	{
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode17</td>";
	echo "<td>$projcode17</td>";
	echo "<td>".nl2br($particulars17)."</td><td align=\"right\">$debitamt17</td><td align=\"right\">$creditamt17</td>";
	echo "</tr>";

	// reset vars
	$debitamt17=0; $creditamt17=0;
      }

  $result16 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation, debittot, credittot FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $disbursementtotid16 = $myrow16[0];
    $disbursementnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    // $debittot16 = $myrow16[4];
    // $credittot16 = $myrow16[5];
  } 
      echo "<tr><td colspan=\"2\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>$debitamttot</b></td><td align=\"right\"><b>$creditamttot</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\">Explanation<br>";
    echo "<textarea rows=\"3\" cols=\"40\" name=\"explanation\" readonly>".nl2br($explanation)."</textarea></td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\"><form method=\"post\">";
    echo "<input type=\"button\" value=\"Close\" onclick=\"javascript:window.close();\"></form></td></tr>";
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