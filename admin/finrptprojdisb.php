<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$projcodesel = $_POST['projcode'];
$schedule = $_POST['schedule'];
$yrmonthavlbl = $_POST['yrmonthavlbl'];
$quarterly = $_POST['quarterly'];
$yrquarterly = $_POST['yrquarterly'];
$yravlbl = $_POST['yravlbl'];

if($schedule != "") {
	if($schedule == "monthly") {
		$schedordnone=""; $schedordmonth="selected"; $schedordquarter=""; $schedordannual=""; $schedordall="";
	} else if($schedule == "quarterly") {
		$schedordnone=""; $schedordmonth=""; $schedordquarter="selected"; $schedordannual=""; $schedordall="";
	} else if($schedule == "annually") {
		$schedordnone=""; $schedordmonth=""; $schedordquarter=""; $schedordannual="selected"; $schedordall="";
	} else if($schedule == "all") {
		$schedordnone=""; $schedordmonth=""; $schedordquarter=""; $schedordannual=""; $schedordall="selected";
	}
} else { $schedordnone="selected"; $schedordmonth=""; $schedordquarter=""; $schedordannual=""; $schedordall=""; }

if($yrmonthavlbl=="") {
	$dtcutstart = date("Y-m", strtotime($datenow))."-"."01";
	$dtcutend = date("Y-m-t", strtotime($dtcutstart));
	$yrmonthavlbl = date("Y F", strtotime($datenow));
} else {
	$yrmontharr = split(" ", $yrmonthavlbl);
	$arryyyy = $yrmontharr[0];
	$arrmm = date("m", strtotime($yrmontharr[1]));
	$dtcutstart = $arryyyy . "-" . $arrmm . "-". "01";
	$dtcutend = date("Y-m-t", strtotime($dtcutstart));
}

if($quarterly!="") {
	if($quarterly == "1q") {
		$q1sel="selected"; $q2sel=""; $q3sel=""; $q4sel="";
		$dtcutstart = $yrquarterly."-"."01"."-"."01";
		$dtcutend = $yrquarterly."-"."03"."-"."31";
	} else if($quarterly == "2q") {
		$q1sel=""; $q2sel="selected"; $q3sel=""; $q4sel="";
		$dtcutstart = $yrquarterly."-"."04"."-"."01";
		$dtcutend = $yrquarterly."-"."06"."-"."30";
	} else if($quarterly == "3q") {
		$q1sel=""; $q2sel=""; $q3sel="selected"; $q4sel="";
		$dtcutstart = $yrquarterly."-"."07"."-"."01";
		$dtcutend = $yrquarterly."-"."09"."-"."30";
	} else if($quarterly == "4q") {
		$q1sel=""; $q2sel=""; $q3sel=""; $q4sel="selected";
		$dtcutstart = $yrquarterly."-"."10"."-"."01";
		$dtcutend = $yrquarterly."-"."12"."-"."31";
	}
}

if($schedule=="annually") {
	if($yravlbl!="") {
		$dtcutstart = $yravlbl."-"."01"."-"."01";
		$dtcutend = $yravlbl."-"."12"."-"."31";
	} else {
		$dtcutstart = $yearnow."-"."01"."-"."01";
		$dtcutend = $yearnow."-"."12"."-"."31";
		$yravlbl = $yearnow;
	}
}

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

    echo "<table class=\"fin\" border=\"1\">";
    echo "<tr><th colspan=\"2\">Project's Disbursement Summary</th></tr>";
    echo "<tr>";
    echo "<form action=\"finrptprojdisb.php?loginid=$loginid\" method=\"post\" name=\"form1\" id=\"form1\">";
    echo "<td colspan=\"2\"><select id=\"projcode\" name=\"projcode\" onchange=\"getProjSched()\">";
    $result11 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code != '' ORDER BY proj_code DESC", $dbh);
    echo "<option>Select Project</option>";
    while ($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $projcode = $myrow11[0];
      $projfname = $myrow11[1];
      $projsname = $myrow11[2];
      $projfname2 = substr("$projfname", 0, 30);

      if($projcode == $projcodesel) { $projcodeselected = "selected"; }
      else { $projcodeselected = ""; }
      echo "<option name=proj_code value=\"$projcode\" $projcodeselected>$projcode - $projsname - $projfname2</option>";
    }
		echo "</select>";
    echo "<br>";

		// display schedule options
		echo "<select name=\"schedule\" onchange=\"this.form.submit()\">";
		echo "<option value='' $schedordnone>Select</option>";
		echo "<option value=\"monthly\" $schedordmonth>Monthly</option>";
		echo "<option value=\"quarterly\" $schedordquarter>Quarterly</option>";
		echo "<option value=\"annually\" $schedordannual>Annually</option>";
		echo "<option value=\"all\" $schedordall>ALL</option>";
		echo "</select>";

	if($schedule=="monthly") {
		// if schedule is monthly
    echo "<select name=\"yrmonthavlbl\">";
    echo "<option>Year-Month</option>";

		$result11=""; $found11=0;
		// $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth, projcode FROM (SELECT DISTINCT date, projcode FROM tblfindisbursement UNION SELECT DISTINCT date, projcode FROM tblfincashreceipt UNION SELECT DISTINCT date, projcode from tblfinjournal) t WHERE projcode=\"$projcodesel\" ORDER BY date DESC", $dbh);
		$result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth, projcode FROM tblfindisbursement WHERE projcode=\"$projcodesel\" ORDER BY date DESC", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $yyyymonth = $myrow11[0];
			$projcode11 = $myrow11[1];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
    }
    echo "</select>";
	} else if($schedule=="quarterly") {
		// if schedule is quarterly
		echo "<select name=\"quarterly\">";
		echo "<option value=\"1q\" $q1sel>1st quarter</option>";
		echo "<option value=\"2q\" $q2sel>2nd quarter</option>";
		echo "<option value=\"3q\" $q3sel>3rd quarter</option>";
		echo "<option value=\"4q\" $q4sel>4th quarter</option>";
		echo "</select>";
		echo "<select name=\"yrquarterly\">";
		$result14=""; $found14=0;
		// $result14 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y') as yyyy, projcode FROM (SELECT DISTINCT date, projcode FROM tblfindisbursement UNION SELECT DISTINCT date, projcode FROM tblfincashreceipt UNION SELECT DISTINCT date, projcode from tblfinjournal) t WHERE projcode=\"$projcodesel\" ORDER BY date DESC", $dbh);
		$result14 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y') as yyyy, projcode FROM tblfindisbursement WHERE projcode=\"$projcodesel\" ORDER BY date DESC", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14 = 1;
			$yyyy14 = $myrow14[0];
			if($yrquarterly == "$yyyy14") { $yrquartersel="selected"; } else { $yrquartersel=""; }
			echo "<option value=\"$yyyy14\" $yrquartersel>$yyyy14</option>";
			}
		}
		echo "</select>";
	} else if($schedule=="annually") {
		// if schedule is annually
		echo "<select name=\"yravlbl\">";
		if($yravlbl=="") { echo "<option>Select year</option>"; }
		// query years available
		$result12=""; $found12=0;
		// $result12 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y') as yyyy, projcode FROM (SELECT DISTINCT date, projcode FROM tblfindisbursement UNION SELECT DISTINCT date, projcode FROM tblfincashreceipt UNION SELECT DISTINCT date, projcode from tblfinjournal) t WHERE projcode=\"$projcodesel\" ORDER BY date DESC", $dbh);
		$result12 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y') as yyyy, projcode FROM tblfindisbursement WHERE projcode=\"$projcodesel\" ORDER BY date DESC", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12 = 1;
      $yyyy12 = $myrow12[0];
      if($yravlbl == "$yyyy12") { $yrsel = "selected"; }
      else { $yrsel = ""; }
      echo "<option value=\"$yyyy12\" $yrsel>$yyyy12</option>";			
			}
		}
		echo "</select>";
	}


    echo "<input type=\"submit\" value=\"Submit\"></td></form>";
    echo "</tr>";

    echo "<tr><td colspan=\"2\">";
    echo "<table width=\"100%\" class=\"fin\" border=\"1\">";
    $result14 = mysql_query("SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code = \"$projcodesel\"", $dbh);
    echo "<option>Select Project</option>";
    while ($myrow14 = mysql_fetch_row($result14))
    {
      $found14 = 1;
      $projcode14 = $myrow14[0];
      $projfname14 = $myrow14[1];
      $projsname14 = $myrow14[2];
      $projfname214 = substr("$projfname14", 0, 50);
    }
    echo "<tr><th colspan=\"7\">Displaying <b>$projcodesel - $projsname14 - $projfname214</b></th></tr>";
    echo "<tr><th>count</th><th>cvnum</th><th>date</th><th>payee</th><th>particulars</th><th>dr</th><th>cr</th></tr>";

  if($projcodesel != "") {
		if($schedule != "all") {
    $result12 = mysql_query("SELECT disbursementnumber, payee, date, glcode, projcode, particulars, debitamt, creditamt, companyid, contactid FROM tblfindisbursement WHERE projcode=\"$projcodesel\" AND date>=\"$dtcutstart\" AND date<=\"$dtcutend\" ORDER BY date DESC", $dbh);
		} else {
    $result12 = mysql_query("SELECT disbursementnumber, payee, date, glcode, projcode, particulars, debitamt, creditamt, companyid, contactid FROM tblfindisbursement WHERE projcode=\"$projcodesel\" ORDER BY date DESC", $dbh);
		}
    if($result12 != "") {
    while($myrow12 = mysql_fetch_row($result12)) {
      $found12 = 1;
      $disbursementnumber12 = $myrow12[0];
      $payee12 = $myrow12[1];
      $date12 = $myrow12[2];
      $glcode12 = $myrow12[3];
      $projcode12 = $myrow12[4];
      $particulars12 = $myrow12[5];
      $debitamt12 = $myrow12[6];
      $creditamt12 = $myrow12[7];
			$companyid12 = $myrow12[8];
			$contactid12 = $myrow12[9];

      $count12 = $count12 + 1;

      echo "<tr><td>$count12</td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber12\" target=\"_blank\">$disbursementnumber12</a></td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber12\" target=\"_blank\">$date12</a></td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber12\" target=\"_blank\">";

			// echo "$payee12";
		if((($companyid12!="") || ($companyid12!=0)) && (($contactid12=="") || ($contactid12==0))) {
			$result12a=""; $found12a=0; $ctr12a=0;
			$result12a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid12", $dbh);
			if($result12a != "") {
				while($myrow12a = mysql_fetch_row($result12a)) {
				$found12a = 1;
				$company12a = $myrow12a[0];
				$branch12a = $myrow12a[1];
				}
			}
			$company12afin = $company12a;
			if($branch12a!="") { $company12afin = $company12a . " - " . $branch12a; }
			echo "$company12afin";
		}
		if((($contactid12!="") || ($contactid12!=0)) && (($companyid12=="") || ($companyid12==0))) {
			$result12b=""; $found12b=0; $ctr12b=0;
			$result12b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid12", $dbh);
			if($result12b != "") {
				while($myrow12b = mysql_fetch_row($result12b)) { 
				$found12b = 1;
				$companyid12b = $myrow12b[0];
				$employeeid12b = $myrow12b[1];
				$name_last12b = $myrow12b[2];
				$name_first12b = $myrow12b[3];
				$name_middle12b = $myrow12b[4];
				}
			}
			$contactname12bfin = $name_first12b;
			if($name_middle12b != "") { $contactname12bfin = $contactname12bfin . "&nbsp;" . $name_middle12b[0] . "."; }
			if($name_last12b != "") { $contactname12bfin = $contactname12bfin . "&nbsp;" . $name_last12b; }
			echo "$contactname12bfin";
		}
		if((($companyid12=="") && ($contactid12=="")) || (($companyid12==0) && ($contactid12==0))) {
			echo "$payor12";
		}

			echo "</a></td><td>$particulars12</td><td align=\"right\">".number_format($debitamt12, 2)."</td><td align=\"right\">".number_format($creditamt12, 2)."</td></tr>";

      $debittot = $debittot + $debitamt12;
      $credittot = $credittot + $creditamt12;

      $debitamt12 = 0; $creditamt12 = 0;
    }
    }
  }

    echo "<tr><th colspan=\"5\" align=\"right\">Total</th><th align=\"right\">".number_format($debittot, 2)."</th><th align=\"right\">".number_format($credittot, 2).
"</th></tr>";
	
    echo "</table>";
    echo "</td></tr>";
    echo "</table>";

    echo "<p><a href=\"finrptmnu.php?loginid=$loginid\">Back</a></p>";

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>

<script>

function getProjSched() {
	var e = document.getElementById("projcode");
	var projcodeValue = e.options[e.selectedIndex].value;

	url = "fingetprojcd.php?prjid=" +  projcodeValue;

	if (window.XMLHttpRequest) { // Mozilla, Safari, ...
		httpRequest = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE
		try {
			httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
		}
	}

	if (!httpRequest) {
		alert('Giving up :( Cannot create an XMLHTTP instance');
		return false;
	}

	httpRequest.onreadystatechange = loadListViewResults1;
	httpRequest.open('GET', url);
	httpRequest.send();
}

</script>
