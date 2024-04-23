<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$cashreceiptid0 = $_GET['crid'];
$cashreceiptnumber0 = $_GET['crvn'];

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
      echo "<tr><th colspan=\"2\">Cash Receipt Voucher - Edit item</th></tr>";

		// get default version of glcode
      $result20 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
      while($myrow20 = mysql_fetch_row($result20))
      {
				$version20 = $myrow20[0];
      }

      if($version20 == 1) { $dynselglcode="20.10.208"; }
      else if($version20 == 2) { $dynselglcode="20.10.210"; }

	// query cash receipt voucher item details
	$result11=""; $found11=0;
	$result11 = mysql_query("SELECT payor, date, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt, explanation, companyid, contactid FROM tblfincashreceipt WHERE cashreceiptid=$cashreceiptid0 AND cashreceiptnumber=\"$cashreceiptnumber0\"", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$payor11 = $myrow11[0];
		$date11 = $myrow11[1];
		$glcode11 = $myrow11[2];
		$glrefver11 = $myrow11[3];
		$glnamedetails11 = $myrow11[4];
		$projcode11 = $myrow11[5];
		$particulars11 = $myrow11[6];
		$debitamt11 = $myrow11[7];
		$creditamt11 = $myrow11[8];
		$explanation11 = $myrow11[9];
		$companyid11 = $myrow11[10];
		$contactid11 = $myrow11[11];
		}
	}

	// query cashreceipttot table based on cashreceiptnumber
	$result12=""; $found12=0;
	$result12 = mysql_query("SELECT cashreceipttotid, date, explanation, debittot, credittot, status FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$cashreceiptnumber0\"", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$cashreceipttotid12 = $myrow12[0];
		$date12 = $myrow12[1];
		$explanation12 = $myrow12[2];
		$debittot12 = $myrow12[3];
		$credittot12 = $myrow12[4];
		$status12 = $myrow12[5];
		}
	}

  if ($explanation12 != '') { $explanationfin = $explanation12; }
  else if ($explanation11 != '') { $explanationfin = $explanation11; }

    echo "<form action=\"finvouchcrvpartedit2.php?loginid=$loginid&crid=$cashreceiptid0&crvn=$cashreceiptnumber0\" method=\"post\" name=\"myCRVForm\">";
    echo "<tr><td>Date:&nbsp;<u>$date11</u></td><td>C.R. No.:&nbsp;<u>$cashreceiptnumber0</u></td></tr>";
		echo "<tr><td colspan=\"2\">Received from:&nbsp;";
		if((($companyid11!="") || ($companyid11!=0)) && (($contactid11=="") || ($contactid11==0))) {
			$result15a=""; $found15a=0; $ctr15a=0;
			$result15a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid11", $dbh);
			if($result15a != "") {
				while($myrow15a = mysql_fetch_row($result15a)) {
				$found15a = 1;
				$company15a = $myrow15a[0];
				$branch15a = $myrow15a[1];
				}
			}
			$company15afin = $company15a;
			if($branch15a!="") { $company15afin = $company15a . " - " . $branch15a; }
			echo "<u>$company15afin</u>";
		}
		if((($contactid11!="") || ($contactid11!=0)) && (($companyid11=="") || ($companyid11==0))) {
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
			echo "<u>$contactname15bfin</u>";
		}
		if((($companyid11=="") && ($contactid11=="")) || (($companyid11==0) && ($contactid11==0))) {
			echo "<u>$payor11</u>";
		}
		// echo "<input name=\"payor\" value=\"$payor11\" size=\"25\" readonly>";
		echo "</td></tr>";
    echo "<tr><td colspan=\"2\"><table class=\"fin\" width=\"100%\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
      echo "<tr><td>Acct Code</td><td>Project Code</td><td>Ver</td><td>Particulars</td><td>Debit</td><td>Credit</td></tr>";

	$result18 = mysql_query("SELECT glname FROM tblfinglref WHERE glcode=\"$glcode11\" AND version=$glrefver11", $dbh);
	while($myrow18 = mysql_fetch_row($result18))
	{
	  $found18 = 1;
	  $glname18 = $myrow18[0];
	}

	echo "<tr><td>$glcode11</td>";
	echo "<td>$projcode11</td><td>$glrefver11</td>";
	echo "<td>$particulars11</td><td align=\"right\">$debitamt11</td><td align=\"right\">$creditamt11</td>";
	echo "</tr>";

		echo "</table></td></tr>";

    echo "<tr><th colspan=\"6\">Modify cash receipt voucher item</th></tr>";
    echo "<tr><td colspan=\"6\">Acct Code<br>";
    echo "<select name=\"glcode\" onchange=\"dynamicpulldown()\" id=\"myGlCode\">";
    $result14 = mysql_query("SELECT DISTINCT glcode, glname FROM tblfinglref WHERE version=$version20 ORDER BY glcode ASC", $dbh);
    while($myrow14 = mysql_fetch_row($result14))
    {
      $glcode14 = $myrow14[0];
      $glname14 = $myrow14[1];
			if($glcode14 == $glcode11) { $glcodesel="selected"; } else { $glcodesel=""; }
      echo "<option value=\"$glcode14\" $glcodesel>$glcode14 - $glname14</option>";
    }
    echo "</select><br>";

    //
    // dynamic pulldown
    //

    echo "<div id=myDynamicPullDown>";

    echo "</div>";

    echo "<input name=\"aepglcode\" type=\"Hidden\">";

    echo "Add'l.Details&nbsp<input name=\"glnamedetails\" value=\"$glnamedetails11\" size=\"35\">";
    echo "</td></tr>";

    echo "</td></tr>";

    echo "<tr><td colspan=\"6\">Project Code<br>";
    echo "<select name=\"projcode\">";
		if(($projcode11 != "") || ($projcode11 != "-")) {
    echo "<option value=\"-\">-</option>";
		}
    $result15 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid<>0 ORDER BY proj_code DESC", $dbh);
    while($myrow15 = mysql_fetch_row($result15))
    {
      $projectid15 = $myrow15[0];
      $proj_code15 = $myrow15[1];
      $proj_fname15 = $myrow15[2];
      $proj_sname15 = $myrow15[3];
      $proj_fname152 = substr("$proj_fname15", 0, 47);
			if($proj_code15 == $projcode11) { $projcodesel="selected"; } else { $projcodesel=""; }
      if($proj_sname15 <> '') { echo "<option value=\"$proj_code15\" $projcodesel>$proj_code15 - $proj_sname15</option>"; }
      else
      { echo "<option value=\"$proj_code15\" $projcodesel>$proj_code15 - $proj_fname152</option>"; }
    }
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td colspan=\"6\">Particulars<br>";
    echo "<textarea rows=\"6\" cols=\"60\" name=\"particulars\"></textarea></td></tr>";
    echo "<tr><td colspan=\"6\">";
			echo "<table width=\"100%\"><tr><td>Debit Amount<br><input name=\"debitamt\" size=\"12\" value=\"$debitamt11\"></td>";
			echo "<td>Credit Amount<br><input name=\"creditamt\" size=\"12\" value=\"$creditamt11\"></td></tr></table>";
		echo "</td></tr>";
    echo "<tr><td colspan=\"6\" align=\"right\"><input type=\"submit\" value=\"Update\"></td></tr>";
    echo "</form>";

      echo "</table>";

    echo "<p><a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber0\">Back</a></p>";

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
