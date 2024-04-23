<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$disbursementid = $_GET['did'];
$cvnumber = $_GET['cvn'];

/*
$cvdate = $_POST['yyyycv']."-".$_POST['mmmcv']."-".$_POST['ddcv'];
$cvnumber = $_POST['cvnumber'];
$cvpayee = $_POST['cvpayee'];
$explanation = $_POST['explanation'];
*/

// echo "<p>vartest $disbursementid, $cvnumber</p>";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

      echo "<table class=\"fin\" border=\"0\">";
      echo "<tr><th colspan=\"2\">Check Vouchers - Edit item</th></tr>";

// choose default glcode version
      $result20 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
      while($myrow20 = mysql_fetch_row($result20))
      {
	$version20 = $myrow20[0];
      }

      if($version20 == 1) { $dynselglcode="20.10.208"; }
      else if($version20 == 2) { $dynselglcode="20.10.210"; }

if(($cvnumber != '') && ($disbursementid != '')) {
  $result15 = mysql_query("SELECT disbursementnumber, disbursementtype, payee, date, explanation FROM tblfindisbursement WHERE disbursementid = $disbursementid AND disbursementnumber = \"$cvnumber\"", $dbh);
  while ($myrow15 = mysql_fetch_row($result15)) {
    $found15 = 1;
    $cvnumber15 = $myrow15[0];
    $cvtype15 = $myrow15[1];
    $cvpayee15 = $myrow15[2];
    $cvdate15 = $myrow15[3];
    $explanation15 = $myrow15[4];
  }

  $result16 = mysql_query("SELECT disbursementtotid, disbursementnumber, date, explanation, debittot, credittot FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16)) {
    $found16 = 1;
    $disbursementtotid16 = $myrow16[0];
    $disbursementnumber16 = $myrow16[1];
    $date16 = $myrow16[2];
    $explanation16 = $myrow16[3];
    $debittot16 = $myrow16[4];
    $credittot16 = $myrow16[5];
  }

  if ($explanation16 != '') { $explanationfin = $explanation16; }
  else if ($explanation15 != '') { $explanationfin = $explanation15; }

    echo "<form action=\"finvouchcvpartedit2.php?loginid=$loginid&did=$disbursementid&cvn=$cvnumber\" method=\"post\" name=\"myForm\">";
    echo "<tr><td>Date:&nbsp;<b><input name=\"cvdate\" value=\"$cvdate15\" size=\"12\" readonly></b></td><td>CV No.:&nbsp;<b><input name=\"cvnumber\" value=\"$cvnumber15\" size=\"12\" readonly></b></td></tr>";
    echo "<tr><td colspan=\"2\">Payee&nbsp;<input size=\"50\" name=\"cvpayee\" value=\"$cvpayee15\" readonly></td></tr>";

    echo "<tr><td colspan=\"2\"><table width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Ver</td><td>Project Code</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

      $result17 = mysql_query("SELECT disbursementid, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt, explanation FROM tblfindisbursement WHERE disbursementid = $disbursementid AND disbursementnumber = \"$cvnumber\"", $dbh);
      while ($myrow17 = mysql_fetch_row($result17)) {
	$found17 = 1;
	$disbursementid17 = $myrow17[0];
	$glcode17 = $myrow17[1];
	$glrefver17 = $myrow17[2];
	$glnamedetails17 = $myrow17[3];
	$projcode17 = $myrow17[4];
	$particulars17 = $myrow17[5];
	$debitamt17 = $myrow17[6];
	$creditamt17 = $myrow17[7];
	$explanation17 = $myrow17[8];

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode17\" AND version=$glrefver17", $dbh);
	while($myrow18 = mysql_fetch_row($result18)) {
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode17</td><td align=\"center\">$glrefver17</td>";
	echo "<td>$projcode17</td>";
	echo "<td>$particulars17</td><td align=\"right\">$debitamt17</td><td align=\"right\">$creditamt17</td>";
	echo "</tr>";
      }

    echo "</table></td></tr>";

		echo "<tr><td colspan=\"2\">Account Code<br>";
		echo "<select name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
    $result12 = mysql_query("SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 ORDER BY glcode ASC", $dbh);
    while($myrow12 = mysql_fetch_row($result12)) {
      $glcode12 = $myrow12[0];
      $glname12 = $myrow12[1];
			if($glcode12 == $glcode17) { $glcodesel="selected"; } else { $glcodesel=""; }
      echo "<option value=\"$glcode12\" $glcodesel>$glcode12 - $glname12</option>";
    }
    echo "</select><br>";

		// added 20180809 to display particulars if 20.10.210
		if($glcode17==$dynselglcode) {
		echo "$particulars17<br>";
		} // if

    //
    // dynamic pulldown
    //

    echo "<div id=myDynamicPullDown>";

    echo "</div>";

    echo "<input name=\"aepglcode\" type=\"Hidden\">";

    echo "Add'l.Details&nbsp<input name=\"glnamedetails\" size=\"35\" value=\"$glnamedetails17\">";
    echo "</td>";
		echo "</tr>";

		echo "<tr><td colspan=\"2\">Particulars<br><textarea rows=\"3\" cols=\"60\" name=\"particulars\"></textarea></td>";
		echo "</tr>";

		echo "<tr><td colspan=\"2\">Project Code<br><select name=\"projcode\">";
		if($projcode17 == '-') { echo "<option value=\"-\">-</option>"; }
    $result14 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY proj_code DESC", $dbh);
    while($myrow14 = mysql_fetch_row($result14)) {
      $projectid14 = $myrow14[0];
      $proj_code14 = $myrow14[1];
      $proj_fname14 = $myrow14[2];
      $proj_sname14 = $myrow14[3];
      $proj_fname142 = substr("$proj_fname14", 0, 47); 
			if($projcode17 == $proj_code14) { $projcodesel="selected"; } else { $projcodesel=""; }
      if($proj_sname14 <> '') { echo "<option value=\"$proj_code14\" $projcodesel>$proj_code14 - $proj_sname14</option>"; }
      else { echo "<option value=\"$proj_code14\" $projcodesel>$proj_code14 - $proj_fname142</option>"; }
    }
    echo "</select></td>";
		echo "</tr>";

		/*
		echo "<tr><td colspan=\"2\">NK Associate<br><select name=\"nkassoc\">";
		echo "<option value=\"-\">-</option>";
		echo "<option value=\"P01000\">P01000 - Nippon Koei Co., Ltd.</option>";
		echo "<option value=\"P01001\">P01001 - Domestic Consulting Administration</option>";
		echo "<option value=\"P01002\">P01002 - Overseas Consulting Administration</option>";
		echo "<option value=\"P01003\">P01003 - Power Engineering Administration</option>";
		echo "<option value=\"C03000\">C03000 - Nikki Corporation</option>";
		echo "</select>";
		echo "</td></tr>";

		echo "<tr><td colspan=\"2\">NK Code<br><select name=\"nkcode\">";
		echo "<option value=\"-\">-</option>";
		echo "<option value=\"200101\">200101 - Notes receivable-trade</option>";
		echo "<option value=\"200201\">200201 - Accounts receivable-trade</option>";
		echo "<option value=\"200501\">200501 - Work in process</option>";
		echo "<option value=\"200601\">200601 - Advance payments-trade</option>";
		echo "<option value=\"200701\">200701 - Short-term loans receivable</option>";
		echo "</select>";
		echo "</td></tr>";
		*/

    echo "<tr><td>Debit Amount<br><input name=\"debitamt\" size=\"12\" value=\"$debitamt17\"></td>";
    echo "<td>Credit Amount<br><input name=\"creditamt\" size=\"12\" value=\"$creditamt17\"></td></tr>";
		echo "<input type=\"hidden\" name=\"explanation\" value=\"$explanation17\">";
    echo "<tr><td colspan=\"2\" align=\"right\">";
    echo "<input type=\"submit\" value=\"Update\"></td></tr>";
		echo "</form>";

} else {

  echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, Disbursement ID or CV Number should not be blank. Please try again.</font></td></tr>";

}
      echo "</table>";

    echo "<p><a href=\"finvouchcvnew.php?loginid=$loginid&cvn=$cvnumber\">Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
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

//
// dynamic pulldown
//

function dynamicpulldown()
{
    var htmlStr = "";

    var selectedGlCode = document.getElementById('myGlCode').value;

//    alert(selectedGlCode);

    if(selectedGlCode == '<?php=$dynselglcode?>')
    {
         htmlStr = htmlStr + "<select id=\"aepglcodelist\" onclick=\"getSelected()\">";

         <?php
         $result = mysql_query("SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 AND glcode >= '60.00.00' AND glcode <= '70.80.199' ORDER BY glcode ASC", $dbh);
	 ?>
		htmlStr = htmlStr + "<option value=\"-\">-</option>";
	 <?php
         while($myrow = mysql_fetch_row($result))
         {
             $glcode = $myrow[0];
             $glname = $myrow[1];
             ?>
                  htmlStr = htmlStr + "<option value=\"<?php=$glcode?>\"><?php=$glcode?> - <?php=$glname?></option>";
             <?php
         }
         ?>

         htmlStr = htmlStr + "</select>";
    }

    document.getElementById('myDynamicPullDown').innerHTML = htmlStr;
}

function getSelected()
{
     document.myForm.aepglcode.value = document.getElementById('aepglcodelist').value;
}

</script>

<?php
mysql_close($dbh);
?>
