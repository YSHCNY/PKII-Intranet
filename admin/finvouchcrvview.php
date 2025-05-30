<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$crvnumber0 = $_GET['crvn'];

$crvdate = $_POST['yyyycrv']."-".$_POST['mmmcrv']."-".$_POST['ddcrv'];
$crvnumber = $_POST['crvnumber'];
$explanation = $_POST['explanation'];

// if($crvnumber == '') { $crvnumber = $crvnumber0; }

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

//  contained header to make a push to contents and make the footer "sticky".
	echo "<section class=\"container\">";
	echo "<td colspan=\"2\"><header class=\"block\">";

if ($found == 1)
{
     include ("headprint.php");
//     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" border=\"0\" width=\"100%\">";
      echo "<tr><th colspan=\"2\">Cash Receipt Voucher</th></tr>";

if($crvnumber0 != '')
{
  $result15 = mysql_query("SELECT cashreceiptnumber, payor, date, explanation, companyid, contactid, debitamt, creditamt FROM tblfincashreceipt WHERE cashreceiptnumber = \"$crvnumber0\"", $dbh);
  while ($myrow15 = mysql_fetch_row($result15))
  {
    $found15 = 1;
    $crvnumber15 = $myrow15[0];
		$payor15 = $myrow15[1];
    $crvdate15 = $myrow15[2];
    $explanation15 = $myrow15[3];
		$companyid15 = $myrow15[4];
		$contactid15 = $myrow15[5];
		$debitamt15 = $myrow15[6];
		$creditamt15 = $myrow15[7];
		// $debitamttot = round($debitamttot+$debitamt15, 2);
		// $creditamttot = round($creditamttot+$creditamt15, 2);
		// reset vars
		$debitamt15=0; $creditamt15=0;
  }

  $result16 = mysql_query("SELECT cashreceipttotid, cashreceiptnumber, date, explanation, debittot, credittot FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$crvnumber0\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $cashreceipttotid16 = $myrow16[0];
    $cashreceiptnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    // $debittot16 = $myrow16[4];
    // $credittot16 = $myrow16[5];
  }

    echo "<tr><td>Date:&nbsp;<b><u>".date("Y-M-d", strtotime($crvdate15))."</u></b></td><td align=\"right\">C.R. No.:&nbsp;<b><u>$crvnumber15</u></b></td></tr>";
		echo "<tr><td colspan=\"2\">Received from:&nbsp;";
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
		// echo "<b><input name=\"payor\" value=\"$payor15\" readonly></b>";
		echo "</td></tr>";
		echo "</table>";
		echo "</header>";
		echo "</td>";
	
    echo "<tr><td colspan=\"2\"><div class=\"block push\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

      $result17 = mysql_query("SELECT cashreceiptid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfincashreceipt WHERE cashreceiptnumber = \"$crvnumber0\" ORDER BY cashreceiptid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
	$found17 = 1;
	$cashreceiptid17 = $myrow17[0];
	$glcode17 = $myrow17[1];
	$glrefver17 = $myrow17[2];
	$glnamedetails17 = $myrow17[3];
	$projcode17 = $myrow17[4];
	$particulars17 = $myrow17[5];
	$debitamt17 = $myrow17[6];
	$creditamt17 = $myrow17[7];
	$debitamttot = round($debitamttot+$debitamt17, 2);
	$creditamttot = round($creditamttot+$creditamt17, 2);

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17", $dbh);
	while($myrow18 = mysql_fetch_row($result18))
	{
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode17</td>";
	echo "<td>".nl2br($particulars17)."</td><td align=\"right\">".number_format($debitamt17,2)."</td><td align=\"right\">".number_format($creditamt17,2)."</td>";
	echo "</tr>";

	// reset vars
	$debitamt17=0; $creditamt17=0;
      }
      echo "<tr><td>&nbsp;</td><td><i>".nl2br($explanation15)."</i></td><td>&nbsp;</td><td>&nbsp;</td></tr>";
      echo "<tr><td>&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>P&nbsp;".number_format($debitamttot,2)."</b></td><td align=\"right\"><b>P&nbsp;".number_format($creditamttot,2)."</b></td></tr>";
      echo "</table>";
	  echo "</div>";
    echo "</td></tr>";

    $result21 = mysql_query("SELECT preparedlbl, prepared, preparedpos, checkedlbl, checked, checkedpos, approvedlbl, approved, approvedpos FROM tblfinrptcashreceipt WHERE rptcashreceiptid=1", $dbh);
    while($myrow21 = mysql_fetch_row($result21))
    {
      $found21 = 1;
      $preparedlbl21 = $myrow21[0];
      $prepared21 = $myrow21[1];
      $preparedpos21 = $myrow21[2];
      $checkedlbl21 = $myrow21[3];
      $checked21 = $myrow21[4];
      $checkedpos21 = $myrow21[5];
      $approvedlbl21 = $myrow21[6];
      $approved21 = $myrow21[7];
      $approvedpos21 = $myrow21[8];
    }

	
    echo "<tr><td colspan=\"2\">";
	echo "<footer class=\"block\">";
	echo "<table class=\"fin\" border=\"0\" width=\"100%\">";
	  echo "<tr><td colspan=\"2\">";
      echo "<div class=\"page_break\"><table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td align=\"center\">$preparedlbl21</td><td align=\"center\">$checkedlbl21</td><td align=\"center\">$approvedlbl21</td></tr>";
		echo "<tr><td align=\"center\">$prepared21<br>$preparedpos21</td><td align=\"center\">$checked21<br>$checkedpos21</td><td align=\"center\"><b><u>$approved21</u></b><br>$approvedpos21</td></tr>";
      echo "</table>";
	  echo "</div>";
	  echo "</td>";
	echo "</footer>"; 
	echo "</table>";
    echo "</td></tr>";
	
	
/*    echo "<tr><td colspan=\"2\" align=\"center\"><form method=\"post\">";
    echo "<input type=\"button\" value=\"Close\" onclick=\"javascript:window.close();\"></form></td></tr>"; */
}
else if($crvnumber == '')
{
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Cash Receipt Number should not be blank. Please try again.</font></td></tr>";
}
else
{
  $found11 = 0;
  $result11 = mysql_query("SELECT cashreceiptnumber FROM tblfincashreceipt WHERE cashreceiptnumber = \"$crvnumber\"", $dbh);
  while ($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $crvnumber11 = $myrow11[0];
  }
  if($found11 == 1)
  {
    echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Warning: C.R. Number:$crvnumber11</b> already used. Please try again.</font></td></tr>";
  }
  else
  {
    echo "<tr><td>Date:&nbsp;<b><input name=\"crvdate\" value=\"$crvdate\" size=\"12\" readonly></b></td><td>C.R. No.:&nbsp;<b><input name=\"crvnumber\" value=\"$crvnumber\" size=\"12\" readonly></b></td></tr>";
    echo "<tr><td colspan=\"2\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

      $result17 = mysql_query("SELECT cashreceiptid, glcode, glnamedetails, projcode, particulars, debitamt, creditamt, explanation FROM tblfincashreceipt WHERE cashreceiptnumber = \"$crvnumber\" ORDER BY cashreceiptid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
	$found17 = 1;
	$cashreceiptid17 = $myrow17[0];
	$glcode17 = $myrow17[1];
	$glnamedetails17 = $myrow17[2];
	$projcode17 = $myrow17[3];
	$particulars17 = $myrow17[4];
	$debitamt17 = $myrow17[5];
	$creditamt17 = $myrow17[6];
	$explanation17 = $myrow17[7];
	$debitamttot = round($debitamttot+$debitamt17, 2);
	$creditamttot = round($creditamttot+$creditamt17, 2);

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$version20", $dbh);
	while($myrow18 = mysql_fetch_row($result18))
	{
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode17</td>";
	echo "<td>$projcode17</td>";
	echo "<td>".nl2br($particulars17)."</td><td align=\"right\">".number_format($debitamt17, 2)."</td><td align=\"right\">".number_format($creditamt17, 2)."</td>";
	echo "</tr>";

	// reset vars
	$debitamt17=0; $creditamt17=0;
      }

  $result16 = mysql_query("SELECT cashreceipttotid, cashreceiptnumber, date, explanation, debittot, credittot FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$crvnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $cashreceipttotid16 = $myrow16[0];
    $cashreceiptnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    // $debittot16 = $myrow16[4];
    // $credittot16 = $myrow16[5];
  } 
      echo "<tr><td colspan=\"2\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>".number_format($debitamttot, 2)."</b></td><td align=\"right\"><b>".number_format($creditamttot, 2)."</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\" align=\"center\">Explanation<br>";
    echo "<textarea rows=\"4\" cols=\"60\" name=\"explanation\" readonly>".nl2br($explanation17)."</textarea></td></tr>";

/*    echo "<tr><td colspan=\"2\" align=\"center\"><form method=\"post\">";
    echo "<input type=\"button\" value=\"Close\" onclick=\"javascript:window.close();\"></form></td></tr>"; */
  }
}
      echo "</table>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
	 echo "</section>";
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
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
<style type="text/css">
  @media print{
    .header-container{
      display: none;
    }
</style>
