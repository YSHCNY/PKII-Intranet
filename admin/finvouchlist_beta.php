<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$radiochecked = $_GET['rs'];
$username = $_POST['username'];
$password = $_POST['password'];
$explanation = $_POST['explanation'];

$searchcv = $_POST['searchcv'];
$searchap = $_POST['searchap'];
$searchcr = $_POST['searchcr'];
$searchjv = $_POST['searchjv'];

$yrmonthavlbl = $_POST['yrmonthavlbl'];

$cvtype = $_POST['cvtype'];

$cvsearchtype = $_POST['cvsearchtype'];

if($cvtype == '') { $cvtype = 'all'; }

if($yrmonthavlbl == '')
{
  $selyear = $yearnow;
  $selmonth = date("F", mktime(0, 0, 0, $monthnow));
  $yrmonthavlbl = $selyear." ".$selmonth;
}

if($radiochecked == "")
{
  $cvchecked = "checked";
  $cvdvstyle = "";
  $apdvstyle = "style='display:none;'";
  $crdvstyle = "style='display:none;'";
  $jvdvstyle = "style='display:none;'";
}
else if($radiochecked == "cv")
{
  $cvchecked = "checked";
  $cvdvstyle = "";
  $apdvstyle = "style='display:none;'";
  $crdvstyle = "style='display:none;'";
  $jvdvstyle = "style='display:none;'";
}
else if($radiochecked == "ap")
{
  $apchecked = "checked";
  $cvdvstyle = "style='display:none;'";
  $apdvstyle = "";
  $crdvstyle = "style='display:none;'";
  $jvdvstyle = "style='display:none;'";
}
else if($radiochecked == "cr")
{
  $crchecked = "checked";
  $cvdvstyle = "style='display:none;'";
  $apdvstyle = "style='display:none;'";
  $crdvstyle = "";
  $jvdvstyle = "style='display:none;'";
}
else if($radiochecked == "jv")
{
  $jvchecked = "checked";
  $cvdvstyle = "style='display:none;'";
  $apdvstyle = "style='display:none;'";
  $crdvstyle = "style='display:none;'";
  $jvdvstyle = "";
}

if($cvsearchtype == "any") {
	$cvsrchtypany="selected"; $cvsrchtyppayee=""; $cvsrchtypprojcd=""; $cvsrchtypparti=""; $cvsrchtypexpla="";
} else if($cvsearchtype == "payee") {
	$cvsrchtypany=""; $cvsrchtyppayee="selected"; $cvsrchtypprojcd=""; $cvsrchtypparti=""; $cvsrchtypexpla="";
} else if($cvsearchtype == "projcode") {
	$cvsrchtypany=""; $cvsrchtyppayee=""; $cvsrchtypprojcd="selected"; $cvsrchtypparti=""; $cvsrchtypexpla="";
} else if($cvsearchtype == "particulars") {
	$cvsrchtypany=""; $cvsrchtyppayee=""; $cvsrchtypprojcd=""; $cvsrchtypparti="selected"; $cvsrchtypexpla="";
} else if($cvsearchtype == "explanation") {
	$cvsrchtypany=""; $cvsrchtyppayee=""; $cvsrchtypprojcd=""; $cvsrchtypparti=""; $cvsrchtypexpla="selected";
} else {
	$cvsrchtypany="selected"; $cvsrchtyppayee=""; $cvsrchtypprojcd=""; $cvsrchtypparti=""; $cvsrchtypexpla="";
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

?>
<script type="text/javascript">
function get_radio_value(val)
{
  val = val - 1;
  for (var i=0; i < document.voucher.type.length; i++){
    if(i==val){
      document.voucher.type[i].checked = true;
    }
  }
  for (var i=0; i < document.voucher.type.length; i++){
    if (document.voucher.type[i].checked)
    {
      var rad_val = document.voucher.type[i].value;
      document.getElementById(rad_val).style.display = "block";
    }
    else {
      var rad_val = document.voucher.type[i].value;
      document.getElementById(rad_val).style.display = "none";
    }
  }
}
</script>

<form name='voucher'>
  <tr><th colspan='4'>PKII Voucher - List</th></tr>
  <tr><td><input type='radio' name='type' value='checkvoucher' onClick="get_radio_value(1);" <?php echo "$cvchecked"; ?>>Check Voucher</td>
  <td><input type='radio' name='type' value='acctspayable' onClick="get_radio_value(2);" <?php echo "$apchecked"; ?>>Accounts Payable</td>
  <td><input type='radio' name='type' value='cashreceipt' onClick="get_radio_value(3);" <?php echo "$crchecked"; ?>>Cash Receipt</td>
  <td><input type='radio' name='type' value='journal' onClick="get_radio_value(4);" <?php echo "$jvchecked"; ?>>Journal</td></tr>
</form>

<tr><td colspan='4'>
<div id='checkvoucher' <?php echo "$cvdvstyle"; ?>>
<?php
  echo "<table class=\"fin\" border=\"1\">";

  echo "<tr><td colspan=\"10\" align=\"center\">";
  echo "<table class=\"fin\" border=\"0\"><tr><td>";
    echo "<form action=\"finvouchlist.php?loginid=$loginid&rs=cv\" method=\"post\" target=\"_self\" name=\"dropdown\">";
    echo "<select name=\"yrmonthavlbl\">";
    echo "<option>Year-Month</option>";

    $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfindisbursement WHERE disbursementid <> '' ORDER BY date DESC;", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $yyyymonth = $myrow11[0];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
    }
    echo "</select>";

    if($cvtype == 'all') { $cvtypeall = "selected"; }
    else if($cvtype == 'cv') { $cvtypecv = "selected"; }
    else if($cvtype == 'dm') { $cvtypedm = "selected"; }
    echo "<select name=\"cvtype\">";
    echo "<option value=\"all\" $cvtypeall>All CV</option>";
    echo "<option value=\"cv\" $cvtypecv>Check Voucher</option>";
    echo "<option value=\"dm\" $cvtypedm>Debit Memo</option>";
    echo "</select>";
    echo "<input type=\"submit\" value=\"Submit\"></form>";
  echo "</td>";

//
// Search CV Module
//
  echo "<form action=\"finvouchlist.php?loginid=$loginid&rs=cv\" method=\"post\" target=\"_self\" name=\"search\">";
  echo "<td><input name=\"searchcv\" size=\"20\" value=\"$searchcv\">";
	echo "<select name=\"cvsearchtype\">";
	echo "<option value=\"any\" $cvsrchtypany>any</option>";
	echo "<option value=\"payee\" $cvsrchtyppayee>payee</option>";
	echo "<option value=\"projcode\" $cvsrchtypprojcd>proj_code</option>";
	echo "<option value=\"particulars\" $cvsrchtypparti>particulars</option>";
	echo "<option value=\"explanation\" $cvsrchtypexpla>explanation</option>";
	echo "</select>";
	echo "<input type=\"submit\" value=\"Search\"></form></td></tr>";
  echo "</table>";
  echo "</td></tr>";

  $debitmonthtot = 0; $creditmonthtot = 0;

  echo "<tr><th>Count</th><th>Date</th><th>C.V. No.</th><th>Payee</th><th>Type</th><th>DebitTotal</th><th>CreditTotal</th><th>Status</td><th colspan=\"2\">Action</th><th>Explanation</th></tr>";

  if($cvtype == 'all')
  {
      $result11 = mysql_query("SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid FROM tblfindisbursement WHERE disbursementid<>'' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, disbursementnumber DESC", $dbh);
  }
  else if($cvtype == 'cv')
  {
      $result11 = mysql_query("SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid FROM tblfindisbursement WHERE disbursementid<>'' AND disbursementnumber NOT LIKE '%DM%' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, disbursementnumber DESC", $dbh);
  }
  else if($cvtype == 'dm')
  {
      $result11 = mysql_query("SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid FROM tblfindisbursement WHERE disbursementid<>'' AND disbursementnumber LIKE '%DM%' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, disbursementnumber DESC", $dbh);
  }

  if($searchcv != "") {
//    $result11 = mysql_query("SELECT DISTINCT tblfindisbursement.disbursementnumber, tblfindisbursement.disbursementtype, tblfindisbursement.payee, tblfindisbursement.date FROM tblfindisbursement LEFT JOIN tblfindisbursementtot ON tblfindisbursement.disbursementnumber = tblfindisbursementtot.disbursementnumber WHERE tblfindisbursement.disbursementnumber LIKE \"%$searchcv%\" OR tblfindisbursement.projcode LIKE \"%$searchcv%\" OR tblfindisbursement.particulars LIKE \"%$searchcv%\" OR tblfindisbursement.payee LIKE \"%$searchcv%\" OR tblfindisbursementtot.explanation LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC, tblfindisbursement.disbursementnumber DESC", $dbh);
		if($cvsearchtype == "any") {
    $result14 = mysql_query("SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement WHERE tblfindisbursement.disbursementnumber LIKE \"%$searchcv%\" OR tblfindisbursement.projcode LIKE \"%$searchcv%\" OR tblfindisbursement.particulars LIKE \"%$searchcv%\" OR tblfindisbursement.payee LIKE \"%$searchcv%\" OR tblfindisbursement.explanation LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC", $dbh);
		} else if($cvsearchtype == "payee") {
    $result14 = mysql_query("SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement WHERE tblfindisbursement.payee LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC", $dbh);
		} else if($cvsearchtype == "projcode") {
    $result14 = mysql_query("SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement WHERE tblfindisbursement.projcode LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC", $dbh);
		} else if($cvsearchtype == "particulars") {
    $result14 = mysql_query("SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement WHERE tblfindisbursement.particulars LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC", $dbh);
		} else if($cvsearchtype == "explanation") {
    $result14 = mysql_query("SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement WHERE tblfindisbursement.explanation LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC", $dbh);
		}
    if($result14 != "") {
      while($myrow14 = mysql_fetch_row($result14)) {
	$found14 = 1;
	$disbursementnumber14 = $myrow14[0];

	$result11 = mysql_query("SELECT DISTINCT disbursementnumber, disbursementtype, payee, date, companyid, contactid, explanation FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber14\" ORDER BY date DESC, disbursementnumber DESC", $dbh);

  if($result11 != "") {
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $disbursementnumber11 = $myrow11[0];
    $disbursementtype11 = $myrow11[1];
    $payee11 = $myrow11[2];
    $date11 = $myrow11[3];
		$companyid11 = $myrow11[4];
		$contactid11 = $myrow11[5];
	$explanation11 = $myrow11[6];	

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $result12 = mysql_query("SELECT debittot, credittot, status, explanation FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debittot12 = $myrow12[0];
      $credittot12 = $myrow12[1];
      $status12 = $myrow12[2];
	  $explanation12 = $myrow12[3];
    }

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count1</td><td>".date("Y-M-d", strtotime($date11))."</td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\"><b>$disbursementnumber11</b></a></td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\">";
		// echo "$payee11";
		echo "</a></td><td>$disbursementtype11</td>";
    if($debittot12 != $credittot12)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    }
    if($status12 == "cancelled")
    {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    }
    else if($status12 != "")
    {
      echo "<td>$explanation11</td>";
    }
    else
    {
      $status12 = '';
      echo "<td>$explanation11</td>";
    }
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
				echo "<td>&nbsp;</td><td>&nbsp;</td>";
			} else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\">Del</td>";
        echo "<td></td>";
      } else {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\">Del</td>";
        echo "<td><a href=\"finvouchcvnew.php?loginid=$loginid&cvn=$disbursementnumber11\">Edit</td>";
			}
    }
	echo "<td>$explanation11</td>";
    echo "</tr>";
  }
  }
      }
    }
  }
  //
  // End Search CV Module
  //

  if($result11 != "") {
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $disbursementnumber11 = $myrow11[0];
    $disbursementtype11 = $myrow11[1];
    // $payee11 = $myrow11[2];
    $date11 = $myrow11[2];
		$companyid11 = $myrow11[3];
		$contactid11 = $myrow11[4];

		if(($companyid11 != "") || ($companyid11 != 0)) {
			$result11a=""; $found11a=0; $ctr11a=0;
			$result11a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid11", $dbh);
			if($result11a != "") {
				while($myrow11a = mysql_fetch_row($result11a)) {
				$found11a = 1;
				$company11a = $myrow11a[0];
				$branch11a = $myrow11a[1];
				}
			}
		}
		if(($contactid11 != "") || ($contactid11 != 0)) {
			$result11b=""; $found11b=0; $ctr11b=0;
			$result11b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid11", $dbh);
			if($result11b != "") {
				while($myrow11b = mysql_fetch_row($result11b)) {
				$found11b = 1;
				$companyid11b = $myrow11b[0];
				$employeeid11b = $myrow11b[1];
				$name_last11b = $myrow11b[2];
				$name_first11b = $myrow11b[3];
				$name_middle11b = $myrow11b[4];
				}
			}
		}

		// get old payee entry
		$result11b=""; $found11b=0;
		$result11b = mysql_query("SELECT payee FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (payee<>'' OR payee IS NOT NULL)", $dbh);
		if($result11b != "") {
			while($myrow11b = mysql_fetch_row($result11b)) {
			$found11b = 1;
			$payee11b = $myrow11b[0];
			}
		}

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $result12 = mysql_query("SELECT debittot, credittot, status FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debittot12 = $myrow12[0];
      $credittot12 = $myrow12[1];
      $status12 = $myrow12[2];
    }

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count1</td><td>".date("Y-M-d", strtotime($date11))."</td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\"><b>$disbursementnumber11</b></a></td><td>";
		echo "<a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\">";
		if(($companyid11 != "") || ($companyid11 != 0)) {
			echo "<b>$company11a";
			if($branch11a != "") { echo "&nbsp;-&nbsp;$branch11a"; }
			echo "</b>";
		}
		if(($contactid11 != "") || ($contactid11 != 0)) {
			echo "<b>$name_first11b";
			if($name_middle11b != "") { echo "&nbsp;$name_middle11b[0]."; }
			echo "&nbsp;$name_last11b";
			echo "</b>";
		}
		if((($companyid11 == "") && ($contactid11 == "")) || (($companyid11 == 0) &&  ($contactid11 == 0))) {
			echo "<i>$payee11b</i>";
		}
		// echo "$payee11";
		echo "</a></td><td>$disbursementtype11</td>";
    if($debittot12 != $credittot12)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    }
    if($status12 == "cancelled")
    {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    }
    else if($status12 != "")
    {
      echo "<td>$status12</td>";
    }
    else
    {
      $status12 = '';
      echo "<td>$status12</td>";
    }
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
				echo "<td>&nbsp;</td><td>&nbsp;</td>";
			} else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\">Del</td>";
        echo "<td></td>";
      } else {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\">Del</td>";
        echo "<td><a href=\"finvouchcvnew.php?loginid=$loginid&cvn=$disbursementnumber11\">Edit</td>";
			}
    }
    echo "</tr>";
		// reset variables
		$company11a=""; $branch11a=""; $companyid11b=""; $employeeid11b=""; $name_last11b=""; $name_first11b=""; $name_middle11b=""; $payee11b="";
  }
  }
  if($debitmonthtot != 0 && $creditmonthtot != 0)
  {
    echo "<tr><td colspan=\"5\" align=\"right\"><b>Total ";
    if($cvtype != 'all') { echo "".strtoupper($cvtype).""; }
    echo "</b></td><td><b>".number_format($debitmonthtot,2)."</b></td><td><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"3\">&nbsp;</td></tr>";
  }
 // echo "<form action=\"finvouchlistcv.php?loginid=$loginid\" method=\"post\">";
 // echo "<tr><td colspan=\"8\" align=\"center\"><input type=\"submit\" value=\"Display\"></form></td></tr>";
  echo "</table>";
?>
</div>
<div id='acctspayable' <?php echo "$apdvstyle"; ?>>
<?php
  echo "<table class=\"fin\" width=\"100%\" border=\"1\">";

// start filtering by available months
  echo "<tr><td colspan=\"9\" align=\"center\">";
    echo "<table class=\"fin\" border=\"0\">";
    echo "<form action=\"finvouchlist.php?loginid=$loginid&rs=ap\" method=\"post\" tartget=\"_self\">";
    echo "<tr><td><select name=\"yrmonthavlbl\">";
    echo "<option>Year-Month</option>";

    $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfinacctspayable WHERE acctspayableid <> '' ORDER BY date DESC", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $yyyymonth = $myrow11[0];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
    }
    echo "</select>";
    echo "<input type=\"submit\" value=\"Submit\"></form></td>";
// end filtering by available months

  //
  // Start Search AP Module
  //
    echo "<form action=\"finvouchlist.php?loginid=$loginid&rs=ap\" method=\"post\" target=\"_self\" name=\"search\">";
    echo "<td><input name=\"searchap\" size=\"20\" value=\"$searchap\"><input type=\"submit\" value=\"Search\"></form></td></tr>";
    echo "</table>";

  echo "</td></tr>";

  $debitmonthtot = 0; $creditmonthtot = 0;

  echo "<tr><th>Count</th><th>Date</th><th>A.P. No.</th><th>Payee</th><th>DebitTotal</th><th>CreditTotal</th><th>Status</td><th colspan=\"2\">Action</th></tr>";
  $result11 = mysql_query("SELECT DISTINCT acctspayablenumber, payee, date FROM tblfinacctspayable WHERE acctspayableid<>'' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, acctspayablenumber DESC", $dbh);

  if($searchap != "") {
//    $result11 = mysql_query("SELECT DISTINCT acctspayablenumber, payee, date FROM tblfinacctspayable LEFT JOIN tblfinacctspayabletot ON tblfinacctspayable.acctspayablenumber = tblfinacctspayabletot.acctspayablenumber WHERE tblfinacctspayable.acctspayablenumber LIKE \"%$searchap%\" OR tblfinacctspayable.projcode LIKE \"%$searchap%\" OR tblfinacctspayable.particulars LIKE \"%$searchap%\" OR tblfinacctspayable.payee LIKE \"%$searchap%\" OR tblfinacctspayabletot.explanation LIKE \"%$searchap%\" ORDER BY tblfinacctspayable.date DESC, tblfinacctspayable.acctspayablenumber DESC", $dbh);

    $result14 = mysql_query("(SELECT DISTINCT acctspayablenumber FROM tblfinacctspayable WHERE tblfinacctspayable.acctspayablenumber LIKE \"%$searchap%\" OR tblfinacctspayable.projcode LIKE \"%$searchap%\" OR tblfinacctspayable.particulars LIKE \"%$searchap%\" OR tblfinacctspayable.payee LIKE \"%$searchap%\") UNION (SELECT DISTINCT acctspayablenumber FROM tblfinacctspayabletot WHERE tblfinacctspayabletot.explanation LIKE \"%$searchap%\")", $dbh);
    if($result14 != "") {
    while($myrow14 = mysql_fetch_row($result14)) {
      $found14 = 1;
      $acctspayablenumber14 = $myrow14[0];

      $result11 = mysql_query("SELECT DISTINCT acctspayablenumber, payee, date FROM tblfinacctspayable WHERE acctspayablenumber=\"$acctspayablenumber14\" ORDER BY date DESC, acctspayablenumber DESC", $dbh);

  if($result11 != "") {
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $acctspayablenumber11 = $myrow11[0];
    $payee11 = $myrow11[1];
    $date11 = $myrow11[2];

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $result12 = mysql_query("SELECT debittot, credittot, status FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debittot12 = $myrow12[0];
      $credittot12 = $myrow12[1];
      $status12 = $myrow12[2];
    }

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count1</td><td>$date11</td><td><a href=\"finvouchapview.php?loginid=$loginid&apn=$acctspayablenumber11\" target=\"_blank\"><b>$acctspayablenumber11</b></a></td><td><a href=\"finvouchapview.php?loginid=$loginid&apn=$acctspayablenumber11\" target=\"_blank\">$payee11</a></td>";
    if($debittot12 != $credittot12)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    }
    if($status12 == "cancelled")
    {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    }
    else if($status12 != "")
    {
      echo "<td>$status12</td>";
    }
    else
    {
      $status12 = '';
      echo "<td>$status12</td>";
    }
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
				echo "<td>&nbsp;</td><td>&nbsp;</td>";
			} else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\">Del</td>";
        echo "<td></td>";
			} else {
        echo "<td><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\">Del</td>";
        echo "<td><a href=\"finvouchapnew.php?loginid=$loginid&apn=$acctspayablenumber11\">Edit</td>";
      }
    }
    echo "</tr>";
  }
  }
    }
    }
  }
  //
  // End Search AP Module
  //

  if($result11 != "") {
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $acctspayablenumber11 = $myrow11[0];
    $payee11 = $myrow11[1];
    $date11 = $myrow11[2];

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $result12 = mysql_query("SELECT debittot, credittot, status FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debittot12 = $myrow12[0];
      $credittot12 = $myrow12[1];
      $status12 = $myrow12[2];
    }

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count1</td><td>$date11</td><td><a href=\"finvouchapview.php?loginid=$loginid&apn=$acctspayablenumber11\" target=\"_blank\"><b>$acctspayablenumber11</b></a></td><td><a href=\"finvouchapview.php?loginid=$loginid&apn=$acctspayablenumber11\" target=\"_blank\">$payee11</a></td>";
    if($debittot12 != $credittot12)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    }
    if($status12 == "cancelled")
    {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    }
    else if($status12 != "")
    {
      echo "<td>$status12</td>";
    }
    else
    {
      $status12 = '';
      echo "<td>$status12</td>";
    }
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
				echo "<td>&nbsp;</td><td>&nbsp;</td>";
			} else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\">Del</td>";
        echo "<td></td>";
			} else {
        echo "<td><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\">Del</td>";
        echo "<td><a href=\"finvouchapnew.php?loginid=$loginid&apn=$acctspayablenumber11\">Edit</td>";
      }
    }
    echo "</tr>";
  }
  }
  if($debitmonthtot != 0 && $creditmonthtot != 0)
  {
    echo "<tr><td colspan=\"4\" align=\"right\"><b>Total</b></td><td><b>".number_format($debitmonthtot,2)."</b></td><td><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"3\">&nbsp;</td></tr>";
  }
  echo "</table>";
?>
</div>
<div id='cashreceipt' <?php echo "$crdvstyle"; ?>>
<?php
  echo "<table class=\"fin\" width=\"100%\" border=\"1\">";

// start filtering by available months
  echo "<tr><td colspan=\"9\" align=\"center\">";
    echo "<table class=\"fin\" border=\"0\"><tr>";
    echo "<form action=\"finvouchlist.php?loginid=$loginid&rs=cr\" method=\"post\" target=\"_self\">";
    echo "<td><select name=\"yrmonthavlbl\">";
    echo "<option>Year-Month</option>";

    $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfincashreceipt WHERE cashreceiptid <> '' ORDER BY date DESC", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $yyyymonth = $myrow11[0];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
    }
    echo "</select>";
    echo "<input type=\"submit\" value=\"Submit\"></form></td>";
// end filtering by available months

  //
  // Start search CR Module
  //
    echo "<form action=\"finvouchlist.php?loginid=$loginid&rs=cr\" method=\"post\" target=\"_self\" name=\"search\">";
    echo "<td><input name=\"searchcr\" size=\"20\" value=\"$searchcr\"><input type=\"submit\" value=\"Search\"></form></td></tr>";
    echo "</table>";

  echo "</td></tr>";

  $debitmonthtot = 0; $creditmonthtot = 0;

  echo "<tr><th>Count</th><th>Date</th><th>C.R. No.</th><th>Received from</th><th>DebitTotal</th><th>CreditTotal</th><th>Status</th><th colspan=\"2\">Action</th></tr>";
  $result11 = mysql_query("SELECT DISTINCT cashreceiptnumber, date, companyid, contactid FROM tblfincashreceipt WHERE cashreceiptid<>'' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, cashreceiptnumber DESC", $dbh);
  if($searchcr != "") {
//    $result11 = mysql_query("SELECT DISTINCT tblfincashreceipt.cashreceiptnumber, tblfincashreceipt.date FROM tblfincashreceipt LEFT JOIN tblfincashreceipttot ON tblfincashreceipt.cashreceiptnumber = tblfincashreceipttot.cashreceiptnumber WHERE tblfincashreceipt.cashreceiptnumber LIKE \"%$searchcr\" OR tblfincashreceipt.projcode LIKE \"%$searchcr%\" OR tblfincashreceipt.particulars LIKE \"%$searchcr%\" OR tblfincashreceipttot.explanation LIKE \"%$searchcr%\" ORDER BY tblfincashreceipt.date DESC, tblfincashreceipt.cashreceiptnumber DESC LIMIT 0, 100", $dbh);

    $result14 = mysql_query("(SELECT DISTINCT cashreceiptnumber FROM tblfincashreceipt WHERE tblfincashreceipt.cashreceiptnumber LIKE \"%$searchcr\" OR tblfincashreceipt.projcode LIKE \"%$searchcr%\" OR tblfincashreceipt.particulars LIKE \"%$searchcr%\") UNION (SELECT DISTINCT cashreceiptnumber FROM tblfincashreceipttot WHERE tblfincashreceipttot.explanation LIKE \"%$searchcr%\")", $dbh);
    if($result14 != "") {
    while($myrow14 = mysql_fetch_row($result14)) {
      $found14 = 1;
      $cashreceiptnumber14 = $myrow14[0];

      $result11 = mysql_query("SELECT DISTINCT cashreceiptnumber, payor, date FROM tblfincashreceipt WHERE cashreceiptnumber=\"$cashreceiptnumber14\" ORDER BY date DESC, cashreceiptnumber DESC", $dbh);
  if($result11 != '') {
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $cashreceiptnumber11 = $myrow11[0];
		// $payor11 = $myrow11[1];
    $date11 = $myrow11[2];

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $result12 = mysql_query("SELECT debittot, credittot, status FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$cashreceiptnumber11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debittot12 = $myrow12[0];
      $credittot12 = $myrow12[1];
      $status12 = $myrow12[2];
    }

    $count2 = $count2 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count2</td><td>".date("Y-M-d", strtotime($date11))."</td><td><a href=\"finvouchcrvview.php?loginid=$loginid&crvn=$cashreceiptnumber11\" target=\"_blank\"><b>$cashreceiptnumber11</b></a></td><td><a href=\"finvouchcrvview.php?loginid=$loginid&crvn=$cashreceiptnumber11\" target=\"_blank\">";
		// echo "$payor11";
		echo "</a></td>";

    if($debittot12 != $credittot12)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    }

    if($status12 == "cancelled")
    {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    }
    else if($status12 <> "")
    {
      echo "<td>$status12</td>";
    }
    else
    {
      $status = '';
      echo "<td>$status12</td>";
    }

    if($accesslevel >= 3 && $accesslevel <= 5)
    {
      if($status12 == "finalized") {
				echo "<td>&nbsp;</td><td>&nbsp;</td>";
			} else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\">Del</td>";
        echo "<td></td>";
			} else {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\">Del</td>";
        echo "<td><a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber11\">Edit</td>";
			}
    }
    echo "</tr>";
  }
  }
    }
    }
  }
  //
  // End Search module for CRV
  //

  if($result11 != '') {
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $cashreceiptnumber11 = $myrow11[0];
		// $payor11 = $myrow11[1];
    $date11 = $myrow11[1];
		$companyid11 = $myrow11[2];
		$contactid11 = $myrow11[3];

		if(($companyid11 != "") || ($companyid11 != 0)) {
			$result11a=""; $found11a=0; $ctr11a=0;
			$result11a = mysql_query("SELECT company, branch FROM tblcompany WHERE companyid=$companyid11", $dbh);
			if($result11a != "") {
				while($myrow11a = mysql_fetch_row($result11a)) {
				$found11a = 1;
				$company11a = $myrow11a[0];
				$branch11a = $myrow11a[1];
				}
			}
		}
		if(($contactid11 != "") || ($contactid11 != 0)) {
			$result11b=""; $found11b=0; $ctr11b=0;
			$result11b = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid11", $dbh);
			if($result11b != "") {
				while($myrow11b = mysql_fetch_row($result11b)) {
				$found11b = 1;
				$companyid11b = $myrow11b[0];
				$employeeid11b = $myrow11b[1];
				$name_last11b = $myrow11b[2];
				$name_first11b = $myrow11b[3];
				$name_middle11b = $myrow11b[4];
				}
			}
		}

		// get old payor value
		$result11b=""; $found11=0;
		$result11b = mysql_query("SELECT payor FROM tblfincashreceipt WHERE cashreceiptnumber=\"$cashreceiptnumber11\" AND (payor<>'' OR payor IS NOT NULL)", $dbh);
		if($result11b != "") {
			while($myrow11b = mysql_fetch_row($result11b)) {
			$found11b = 1;
			$payor11b = $myrow11b[0];
			}
		}

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $result12 = mysql_query("SELECT debittot, credittot, status FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$cashreceiptnumber11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debittot12 = $myrow12[0];
      $credittot12 = $myrow12[1];
      $status12 = $myrow12[2];
    }

    $count2 = $count2 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count2</td><td>".date("Y-M-d", strtotime($date11))."</td><td><a href=\"finvouchcrvview.php?loginid=$loginid&crvn=$cashreceiptnumber11\" target=\"_blank\"><b>$cashreceiptnumber11</b></a></td><td><a href=\"finvouchcrvview.php?loginid=$loginid&crvn=$cashreceiptnumber11\" target=\"_blank\">";
		// echo "$payor11";
		if(($companyid11 != "") || ($companyid11 != 0)) {
			echo "<b>$company11a";
			if($branch11a != "") { echo "&nbsp;-&nbsp;$branch11a"; }
			echo "</b>";
		}
		if(($contactid11 != "") || ($contactid11 != 0)) {
			echo "<b>$name_first11b";
			if($name_middle11b != "") { echo "&nbsp;$name_middle11b[0]."; }
			echo "&nbsp;$name_last11b";
			echo "</b>";
		}
		if((($companyid11 == "") && ($contactid11 == "")) || (($companyid11 == 0) &&  ($contactid11 == 0))) {
			echo "<i>$payor11b</i>";
		}
		echo "</a></td>";

    if($debittot12 != $credittot12)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    }

    if($status12 == "cancelled")
    {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    }
    else if($status12 <> "")
    {
      echo "<td>$status12</td>";
    }
    else
    {
      $status = '';
      echo "<td>$status12</td>";
    }

    if($accesslevel >= 3 && $accesslevel <= 5)
    {
      if($status12 == "finalized") {
				echo "<td>&nbsp;</td><td>&nbsp;</td>";
			} else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\">Del</td>";
        echo "<td></td>";
			} else {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\">Del</td>";
        echo "<td><a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber11\">Edit</td>";
			}
    }
    echo "</tr>";
		// reset variables
		$company11a=""; $branch11a=""; $companyid11b=""; $employeeid11b=""; $name_last11b=""; $name_first11b=""; $name_middle11b=""; $payor11b="";
  }
  }
  if($debitmonthtot != 0 && $creditmonthtot != 0)
  {
    echo "<tr><td colspan=\"4\" align=\"right\"><b>Total</b></td><td align=\"right\"><b>".number_format($debitmonthtot,2)."</b></td><td align=\"right\"><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"4\">&nbsp;</td></tr>";
  }
//  echo "<form action=\"finvouchlistcrv.php?loginid=$loginid\" method=\"post\">";
//  echo "<tr><td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Display\"></form></td></tr>";
  echo "</table>";
?>
</div>
<div id='journal' <?php echo "$jvdvstyle"; ?>>
<?php
  echo "<table class=\"fin\" width=\"100%\" border=\"1\">";

// start filtering by available months
  echo "<tr><td colspan=\"8\" align=\"center\">";
    echo "<table class=\"fin\" border=\"0\"><tr>";
    echo "<form action=\"finvouchlist.php?loginid=$loginid&rs=jv\" method=\"post\" tartget=\"_self\">";
    echo "<td><select name=\"yrmonthavlbl\">";
    echo "<option>Year-Month</option>";

    $result11 = mysql_query("SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfinjournal WHERE journalid <> '' ORDER BY date DESC", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $yyyymonth = $myrow11[0];

      if($yrmonthavlbl == "$yyyymonth") { $yrmonthsel = "selected"; }
      else { $yrmonthsel = ""; }

      echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
    }
    echo "</select>";
    echo "<input type=\"submit\" value=\"Submit\"></form>";
  echo "</td>";
// end filtering by available months

  //
  // Start Search JV Module
  //
    echo "<form action=\"finvouchlist.php?loginid=$loginid&rs=jv\" method=\"post\" target=\"_self\" name=\"search\">";
    echo "<td><input name=\"searchjv\" size=\"20\" value=\"$searchjv\"><input type=\"submit\" value=\"Search\"></form></td></tr>";
    echo "</table>";

  $debitmonthtot = 0; $creditmonthtot = 0;

  echo "<tr><th>Count</th><th>Date</th><th>J.V. No.</th><th>DebitTotal</th><th>CreditTotal</th><th>Status</th><th colspan=\"2\">Action</th></tr>";

  $result11 = mysql_query("SELECT DISTINCT journalnumber, date FROM tblfinjournal WHERE journalid<>'' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, journalnumber DESC", $dbh);

  if($searchjv != "") {
//    $result11 = mysql_query("SELECT DISTINCT tblfinjournal.journalnumber, tblfinjournal.date FROM tblfinjournal LEFT JOIN tblfinjournaltot ON tblfinjournal.journalnumber = tblfinjournaltot.journalnumber WHERE tblfinjournal.journalnumber LIKE \"%$searchjv%\" OR tblfinjournal.projcode LIKE \"%$searchjv%\" OR tblfinjournal.particulars LIKE \"%$searchjv%\" OR tblfinjournaltot.explanation LIKE \"%$searchjv%\" ORDER BY tblfinjournal.date DESC, tblfinjournal.journalnumber DESC", $dbh);
    $result14 = mysql_query("(SELECT DISTINCT journalnumber FROM tblfinjournal WHERE tblfinjournal.journalnumber LIKE \"%$searchjv%\" OR tblfinjournal.projcode LIKE \"%$searchjv%\" OR tblfinjournal.particulars LIKE \"%$searchjv%\") UNION (SELECT DISTINCT journalnumber FROM tblfinjournaltot WHERE tblfinjournaltot.explanation LIKE \"%$searchjv%\")", $dbh);
    if($result14 != "") {
    while($myrow14 = mysql_fetch_row($result14)) {
      $found14 = 1;
      $journalnumber14 = $myrow14[0];

      $result11 = mysql_query("SELECT DISTINCT journalnumber, date FROM tblfinjournal WHERE journalnumber=\"$journalnumber14\" ORDER BY date DESC, journalnumber DESC", $dbh);
  if($result11 != "") {
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $journalnumber11 = $myrow11[0];
    $date11 = $myrow11[1];

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $result12 = mysql_query("SELECT debittot, credittot, status FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debittot12 = $myrow12[0];
      $credittot12 = $myrow12[1];
      $status12 = $myrow12[2];
    }

    $count3 = $count3 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count3</td><td>".date("Y-M-d", strtotime($date11))."</td>";
    echo "<td><a href=\"finvouchjvview.php?loginid=$loginid&jvn=$journalnumber11\" target=\"_blank\"><b>$journalnumber11</b></a></td>";

    if($debittot12 != $credittot12)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    }

    if($status12 == "cancelled")

    {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    }
    else if($status12 <> "")
    {
      echo "<td>$status12</td>";
    }
    else
    {
      $status = '';
      echo "<td>$status12</td>";
    }
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
				echo "<td>&nbsp;</td><td>&nbsp;</td>";
			} else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\">Del</td>";
        echo "<td></td>";
			} else {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\">Del</td>";
        echo "<td><a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber11\">Edit</td>";
      }
    }
    echo "</tr>";
  }
  }
    }
    }
  }
  //
  // End Search JV module
  //

  if($result11 != "") {
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $journalnumber11 = $myrow11[0];
    $date11 = $myrow11[1];

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $result12 = mysql_query("SELECT debittot, credittot, status FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debittot12 = $myrow12[0];
      $credittot12 = $myrow12[1];
      $status12 = $myrow12[2];
    }

    $count3 = $count3 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count3</td><td>".date("Y-M-d", strtotime($date11))."</td>";
    echo "<td><a href=\"finvouchjvview.php?loginid=$loginid&jvn=$journalnumber11\" target=\"_blank\"><b>$journalnumber11</b></a></td>";

    if($debittot12 != $credittot12)
    {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    }
    else
    {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    }

    if($status12 == "cancelled")

    {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    }
    else if($status12 <> "")
    {
      echo "<td>$status12</td>";
    }
    else
    {
      $status = '';
      echo "<td>$status12</td>";
    }

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
				echo "<td>&nbsp;</td><td>&nbsp;</td>";
			} else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\">Del</td>";
        echo "<td></td>";
			} else {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\">Del</td>";
        echo "<td><a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber11\">Edit</td>";
      }
    }

    echo "</tr>";
  }
  }
  if($debitmonthtot != 0 && $creditmonthtot != 0)
  {
    echo "<tr><td colspan=\"3\" align=\"right\"><b>Total</b></td><td><b>".number_format($debitmonthtot,2)."</b></td><td><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"3\">&nbsp;</td></tr>";
  }
  echo "<form action=\"finvouchlistjv.php?loginid=$loginid\" method=\"post\">";
  echo "<tr><td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Display\"></form></td></tr>";
  echo "</table>";
?>
</div>
</td></tr>
<?php
echo "</table>";

echo "<p><a href=\"finvouchmain.php?loginid=$loginid\">Back</a></p>";



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
