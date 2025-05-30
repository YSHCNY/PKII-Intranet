<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$jvnumber0 = (isset($_GET['jvn'])) ? $_GET['jvn'] :'';

$jvdate = $_POST['yyyyjv']."-".$_POST['mmmjv']."-".$_POST['ddjv'];
$jvnumber = (isset($_POST['jvnumber'])) ? $_POST['jvnumber'] :'';
$explanation = (isset($_POST['explanation'])) ? $_POST['explanation'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

//  contained header to make a push to contents and make the footer "sticky".
	echo "<section class=\"container\">";
	echo "<td colspan=\"2\"><header class=\"block\">";

if ($found == 1) {
     include ("headprint.php");
//     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" border=\"0\" width=\"100%\">";
      echo "<tr><th colspan=\"2\">Journal Voucher</th></tr>";

if($jvnumber0 != '') {
  $result15 = mysql_query("SELECT journalnumber, date FROM tblfinjournal WHERE journalnumber = \"$jvnumber0\"", $dbh);
  while ($myrow15 = mysql_fetch_row($result15))
  {
    $found15 = 1;
    $jvnumber15 = $myrow15[0];
    $jvdate15 = $myrow15[1];
  }

  $result16 = mysql_query("SELECT journaltotid, journalnumber, date, explanation, debittot, credittot FROM tblfinjournaltot WHERE journalnumber=\"$jvnumber0\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $journaltotid16 = $myrow16[0];
    $journalnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    $debittot16 = $myrow16[4];
    $credittot16 = $myrow16[5];
  } 

    echo "<tr><td>Date:&nbsp;<b><u>$jvdate15</u></b></td><td align=\"right\">J.V. No.:&nbsp;<b><u>$jvnumber15</u></b></td></tr>";

	echo "</table>";
	echo "</header>";
	echo "</td>";
	
    echo "<tr><td colspan=\"2\"><div class=\"block push\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

      $result17 = mysql_query("SELECT journalid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinjournal WHERE journalnumber = \"$jvnumber0\" ORDER BY journalid ASC", $dbh);
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

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17", $dbh);
	while($myrow18 = mysql_fetch_row($result18))
	{
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode17</td>";
	echo "<td>$particulars17</td><td align=\"right\">".number_format($debitamt17, 2)."</td><td align=\"right\">".number_format($creditamt17, 2)."</td>";
	echo "</tr>";
      }

      echo "<tr><td><td><i>".nl2br($explanation16)."</i></td><td>&nbsp;</td><td>&nbsp;</td></tr>";
	  
      echo "<tr><td>&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>P&nbsp;".number_format($debittot16, 2)."</b></td><td align=\"right\"><b>P&nbsp;".number_format($credittot16, 2)."</b></td></tr>";
      echo "</table>";
	  echo "</div>";
    echo "</td></tr>";

    // display signatory footer here
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
        echo "<td>$preparedlbl19&nbsp;$prepared19</td>";
        echo "<td colspan=\"2\" align=\"center\">$approvedlbl19</td>";
        echo "</tr>";

	echo "<tr>";
        echo "<td>$checkedlbl19&nbsp;$checked19</td>";
        echo "<td align=\"center\"><b><u>$approved119</u></b><br>$approved1pos19</td>";
        echo "<td align=\"center\"><b><u>$approved219</u></b><br>$approved2pos19</td>";
        echo "</tr>";

	  echo "</tbody>";
      echo "</table>";
	  echo "</div>";
	echo "</table>";
	echo "</div>";
    echo "</td></tr>";

/*    echo "<tr><td colspan=\"2\" align=\"center\"><form method=\"post\">";
    echo "<input type=\"button\" value=\"Close\" onclick=\"javascript:window.close();\"></form></td></tr>"; */
} else if($jvnumber0 == '') {
  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Journal Voucher number should not be blank. Please try again.</font></td></tr>";
} else {
  $found11 = 0;
  $result11 = mysql_query("SELECT journalnumber FROM tblfinjournal WHERE journalnumber = \"$jvnumber\"", $dbh);
  while ($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $jvnumber11 = $myrow11[0];
  }
  if($found11 == 1)
  {
    echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Warning: Journal No.:$jvnumber11</b> already used. Please try again.</font></td></tr>";
  }
  else
  {
    echo "<tr><td>Date:&nbsp;<b><input name=\"jvdate\" value=\"$jvdate\" size=\"12\" readonly></b></td><td>J.V. No.:&nbsp;<b><input name=\"jvnumber\" value=\"$jvnumber\" size=\"12\" readonly></b></td></tr>";
    echo "<tr><td colspan=\"2\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

      $result17 = mysql_query("SELECT journalid, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinjournal WHERE journalnumber = \"$jvnumber\" ORDER BY journalid ASC", $dbh);
      while ($myrow17 = mysql_fetch_row($result17))
      {
	$found17 = 1;
	$journalid17 = $myrow17[0];
	$glcode17 = $myrow17[1];
	$glnamedetails17 = $myrow17[2];
	$projcode17 = $myrow17[3];
	$particulars17 = $myrow17[4];
	$debitamt17 = $myrow17[5];
	$creditamt17 = $myrow17[6];

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
      }

  $result16 = mysql_query("SELECT journaltotid, journalnumber, date, explanation, debittot, credittot FROM tblfinjournaltot WHERE journalnumber=\"$jvnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $journaltotid16 = $myrow16[0];
    $journalnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    $debittot16 = $myrow16[4];
    $credittot16 = $myrow16[5];
  } 
      echo "<tr><td colspan=\"2\">&nbsp;</td><td><b>Total</b></td><td align=\"right\"><b>$debittot16</b></td><td align=\"right\"><b>$credittot16</b></td></tr>";
    echo "</td></tr></table>";
    echo "<tr><td colspan=\"2\" align=\"center\">Explanation<br>";
    echo "<textarea rows=\"4\" cols=\"60\" name=\"explanation\" readonly>".nl2br($explanation16)."</textarea></td></tr>";

/*    echo "<tr><td colspan=\"2\" align=\"center\"><form method=\"post\">";
    echo "<input type=\"button\" value=\"Close\" onclick=\"javascript:window.close();\"></form></td></tr>"; */
  }
}
      echo "</table>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
    $result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
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
