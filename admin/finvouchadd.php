<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$radiochecked = $_GET['rs'];
$username = $_POST['username'];
$password = $_POST['password'];

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
<script type="text/javascript" language="JavaScript">
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

<script language="JavaScript" src="./js/auto_search.js"></script>

<form name='voucher'>
  <tr><th colspan='4'>PKII Voucher - Data Entry</th></tr>
  <tr><td><input type='radio' name='type' value='checkvoucher' onClick="get_radio_value(1);" checked>Check Voucher</td>
  <td><input type='radio' name='type' value='acctspayable' onClick="get_radio_value(2);">Accounts Payable</td>
  <td><input type='radio' name='type' value='cashreceipt' onClick="get_radio_value(3);">Cash Receipt</td>
  <td><input type='radio' name='type' value='journal' onClick="get_radio_value(4);">Journal</td></tr>
</form>

<tr><td colspan='4'>
<div id='checkvoucher' <?php echo "$cvdvstyle"; ?>>
<?php
  echo "<form action=\"finvouchcvnew.php?loginid=$loginid\" method=\"post\" name=\"form1\">";
  echo "<table>";
    echo "<tr><td>Date<br>";
/*
    $cutarrdatenow = split("-", $datenow);
    $datenowyyyy = $cutarrdatenow[0];
    $datenowmmm = $cutarrdatenow[1];
    $datenowdd = $cutarrdatenow[2];
    echo "<input name=\"yyyycv\" size=\"4\" value=\"$yearnow\">";

    $selectjan=""; $selectfeb=""; $selectmar=""; $selectapr=""; $selectmay=""; $selectjun="";
    $selectjul=""; $selectaug=""; $selectsep=""; $selectoct=""; $selectnov=""; $selectdec="";
    if($datenowmmm == "01") { $selectjan = "selected"; }
    else if($datenowmmm == "02") { $selectfeb = "selected"; }
    else if($datenowmmm == "03") { $selectmar = "selected"; }
    else if($datenowmmm == "04") { $selectapr = "selected"; }
    else if($datenowmmm == "05") { $selectmay = "selected"; }
    else if($datenowmmm == "06") { $selectjun = "selected"; }
    else if($datenowmmm == "07") { $selectjul = "selected"; }
    else if($datenowmmm == "08") { $selectaug = "selected"; }
    else if($datenowmmm == "09") { $selectsep = "selected"; }
    else if($datenowmmm == "10") { $selectoct = "selected"; }
    else if($datenowmmm == "11") { $selectnov = "selected"; }
    else if($datenowmmm == "12") { $selectdec = "selected"; }
    else if($datenowmmm == "") { $selectmonth = "selected"; }
    else { $selectmonth = "selected"; }
    echo "<select name=\"mmmcv\">";
      echo "<option value=\"01\" $selectjan>Jan</option>";
      echo "<option value=\"02\" $selectfeb>Feb</option>";
      echo "<option value=\"03\" $selectmar>Mar</option>";
      echo "<option value=\"04\" $selectapr>Apr</option>";
      echo "<option value=\"05\" $selectmay>May</option>";
      echo "<option value=\"06\" $selectjun>Jun</option>";
      echo "<option value=\"07\" $selectjul>Jul</option>";
      echo "<option value=\"08\" $selectaug>Aug</option>";
      echo "<option value=\"09\" $selectsep>Sep</option>";
      echo "<option value=\"10\" $selectoct>Oct</option>";
      echo "<option value=\"11\" $selectnov>Nov</option>";
      echo "<option value=\"12\" $selectdec>Dec</option>";
    echo "</select>";

    $select01=""; $select02=""; $select03=""; $select04=""; $select05=""; $select06=""; $select07=""; $select08=""; $select09=""; $select10="";
    $select11=""; $select12=""; $select13=""; $select14=""; $select15=""; $select16=""; $select17=""; $select18=""; $select19=""; $select20="";
    $select21=""; $select22=""; $select23=""; $select24=""; $select25=""; $select26=""; $select27=""; $select28=""; $select29=""; $select30=""; $select31="";
    if($datenowdd == "01") { $select01 = "selected"; }
    else if ($datenowdd == "02") { $select02 = "selected"; }
    else if ($datenowdd == "03") { $select03 = "selected"; }
    else if ($datenowdd == "04") { $select04 = "selected"; }
    else if ($datenowdd == "05") { $select05 = "selected"; }
    else if ($datenowdd == "06") { $select06 = "selected"; }
    else if ($datenowdd == "07") { $select07 = "selected"; }
    else if ($datenowdd == "08") { $select08 = "selected"; }
    else if ($datenowdd == "09") { $select09 = "selected"; }
    else if ($datenowdd == "10") { $select10 = "selected"; }
    else if ($datenowdd == "11") { $select11 = "selected"; }
    else if ($datenowdd == "12") { $select12 = "selected"; }
    else if ($datenowdd == "13") { $select13 = "selected"; }
    else if ($datenowdd == "14") { $select14 = "selected"; }
    else if ($datenowdd == "15") { $select15 = "selected"; }
    else if ($datenowdd == "16") { $select16 = "selected"; }
    else if ($datenowdd == "17") { $select17 = "selected"; }
    else if ($datenowdd == "18") { $select18 = "selected"; }
    else if ($datenowdd == "19") { $select19 = "selected"; }
    else if ($datenowdd == "20") { $select20 = "selected"; }
    else if ($datenowdd == "21") { $select21 = "selected"; }
    else if ($datenowdd == "22") { $select22 = "selected"; }
    else if ($datenowdd == "23") { $select23 = "selected"; }
    else if ($datenowdd == "24") { $select24 = "selected"; }
    else if ($datenowdd == "25") { $select25 = "selected"; }
    else if ($datenowdd == "26") { $select26 = "selected"; }
    else if ($datenowdd == "27") { $select27 = "selected"; }
    else if ($datenowdd == "28") { $select28 = "selected"; }
    else if ($datenowdd == "29") { $select29 = "selected"; }
    else if ($datenowdd == "30") { $select30 = "selected"; }
    else if ($datenowdd == "31") { $select31 = "selected"; }
    else if ($datenowdd = "") { $selectday = "selected"; }
    else { $selectday = "selected"; }
    echo "<select name=\"ddcv\">";
      echo "<option value=\"01\" $select01>01</option>";
      echo "<option value=\"02\" $select02>02</option>";
      echo "<option value=\"03\" $select03>03</option>";
      echo "<option value=\"04\" $select04>04</option>";
      echo "<option value=\"05\" $select05>05</option>";
      echo "<option value=\"06\" $select06>06</option>";
      echo "<option value=\"07\" $select07>07</option>";
      echo "<option value=\"08\" $select08>08</option>";
      echo "<option value=\"09\" $select09>09</option>";
      echo "<option value=\"10\" $select10>10</option>";
      echo "<option value=\"11\" $select11>11</option>";
      echo "<option value=\"12\" $select12>12</option>";
      echo "<option value=\"13\" $select13>13</option>";
      echo "<option value=\"14\" $select14>14</option>";
      echo "<option value=\"15\" $select15>15</option>";
      echo "<option value=\"16\" $select16>16</option>";
      echo "<option value=\"17\" $select17>17</option>";
      echo "<option value=\"18\" $select18>18</option>";
      echo "<option value=\"19\" $select19>19</option>";
      echo "<option value=\"20\" $select20>20</option>";
      echo "<option value=\"21\" $select21>21</option>";
      echo "<option value=\"22\" $select22>22</option>";
      echo "<option value=\"23\" $select23>23</option>";
      echo "<option value=\"24\" $select24>24</option>";
      echo "<option value=\"25\" $select25>25</option>";
      echo "<option value=\"26\" $select26>26</option>";
      echo "<option value=\"27\" $select27>27</option>";
      echo "<option value=\"28\" $select28>28</option>";
      echo "<option value=\"29\" $select29>29</option>";
      echo "<option value=\"30\" $select30>30</option>";
      echo "<option value=\"31\" $select31>31</option>";
    echo "</select>";
*/
	echo "<input type='date' name=\"cvdate\" value=\"$datenow\" class=\"form-control\"	/>";
    echo "</td>";

    if($incrementeddisbursementnumber=='') {
    $res18query=""; $result18=""; $found18=0;
    $res18query="SELECT DISTINCT `disbursementnumber` FROM `tblfindisbursement` WHERE `disbursementnumber` >0 ORDER BY `date` DESC , `disbursementnumber` DESC LIMIT 1";
    $result18=$dbh2->query($res18query);
    if($result18->num_rows>0) {
        while($myrow18=$result18->fetch_assoc()) {
        $found18=1;
        $disbursementnumber18 = $myrow18['disbursementnumber'];
        } //while
    } //if
    if($found18==1) {
    $incrementeddisbursementnumber=$disbursementnumber18+1;
    } else {
    $incrementeddisbursementnumber=$disbursementnumber18;
    } //if-else
    } //if

    echo "<td>";
    // echo "$disbursementnumber18, $incrementeddisbursementnumber<br>";
    echo "Check Voucher No.<br>";
    // echo "<input placeholder='CV Number' id='txtCheckNumber' name=\"cvnumber\" size=\"10\" class='form-control'>";
    echo "<input placeholder='CV Number' name=\"cvnumber\" value=\"$incrementeddisbursementnumber\" size=\"10\" class='form-control'>";
    echo "</td></tr>";

    echo "<tr><td colspan=\"2\">Payee<br>";
		echo "<input id=\"radio1\" type=\"radio\" name=\"payeesw\" value=\"company\">";
		echo "<select name=\"payeecompanyid\" onchange=\"radioselect1()\" class='form-control'>";
		echo "<option value=\"\">select company</option>";
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("SELECT companyid, company, branch FROM tblcompany ORDER BY company ASC", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12=1;
			$companyid12 = $myrow12[0];
			$company12 = $myrow12[1];
			$branch12 = $myrow12[2];
			echo "<option value=\"$companyid12\">$company12";
			if($branch != "") { echo " - $branch12"; }
			echo "</option>";
			}
		}
		echo "</select>";
		echo "<br /><input id=\"radio2\" type=\"radio\" name=\"payeesw\" value=\"contactperson\">";
		echo "<select name=\"payeecontactid\" onchange=\"radioselect2()\" class='form-control'>";
		echo "<option value=\"\">select individual person</option>";
		$result14=""; $found14=0; $ctr14=0;
		// $result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.contact_type<>\"personnel\" OR (tblemployee.emp_record=\"active\" AND tblcontact.contact_type=\"personnel\") ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC", $dbh);
		$result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14=1;
			$contactid14 = $myrow14[0];
			$companyid14 = $myrow14[1];
			$employeeid14 = $myrow14[2];
			$name_last14 = $myrow14[3];
			$name_first14 = $myrow14[4];
			$name_middle14 = $myrow14[5];
			echo "<option value=\"$contactid14\">$name_first14";
			if($name_middle14 != "") { echo "&nbsp;$name_middle14[0]."; }
			echo "&nbsp;$name_last14";
			if($employeeid14 != '') { echo "&nbsp;($employeeid14)"; }
			echo "</option>";
			}
		}
		echo "</select>";
		/*
		echo "<input name=\"cvpayee\" size=\"30\" onkeyup=\"search(document.form1.cvpayee.value, document.form1.cvpayee, document.form1.cvpayee0, document.getElementById('contentcvpayee'), disbpayee, disbpayeeid)\")>";
		echo "<input name=\"cvpayee0\" type=\"hidden\">";
		echo "<div id=\"contentcvpayee\">";

		echo "</div>";
		$result11=""; $found11=0; $ctr11=0;
		// echo "<select name=\"cvpayeetest\">";
		$result11 = mysql_query("SELECT DISTINCT payee FROM tblfindisbursement ORDER BY payee ASC", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11=0;
			$payee11 = $myrow11[0];
			$disbpayeeid[$ctr11] = "$ctr11";
			$disbpayee[$ctr11] = "$payee11";
			// echo "<option value=\"$payee11\">$payee11</option>";
			$ctr11 = $ctr11 + 1;
			}
		}
		// echo "</select>";
		*/
		echo "</td></tr>";

    echo "<tr><td colspan=\"2\">Explanation<br><textarea rows=\"3\" cols=\"38\" name=\"explanation\" wrap=\"physical\" class='form-control'></textarea></td></tr>";

    echo "<tr><td><button type=\"submit\" class='btn btn-success'>Save & continue</button></form></td>";
    echo "<td><form action=\"finvouchmain.php?loginid=$loginid\" method=\"post\"><button type=\"submit\" class='btn btn-danger'>Cancel</button></td></form></tr>";
  echo "</table>";
?>
</div>
<div id='acctspayable' <?php echo "$apdvstyle"; ?>>
<?php
  echo "<form action=\"finvouchapnew.php?loginid=$loginid\" method=\"post\" name=\"form2\">";
  echo "<table>";
    echo "<tr><td>Date<br>";

    $cutarrdatenow = split("-", $datenow);
    $datenowyyyy = $cutarrdatenow[0];
    $datenowmmm = $cutarrdatenow[1];
    $datenowdd = $cutarrdatenow[2];
/*
    echo "<input name=\"yyyyap\" size=\"4\" value=\"$yearnow\">";

    $selectjan=""; $selectfeb=""; $selectmar=""; $selectapr=""; $selectmay=""; $selectjun="";
    $selectjul=""; $selectaug=""; $selectsep=""; $selectoct=""; $selectnov=""; $selectdec="";
    if($datenowmmm == "01") { $selectjan = "selected"; }
    else if($datenowmmm == "02") { $selectfeb = "selected"; }
    else if($datenowmmm == "03") { $selectmar = "selected"; }
    else if($datenowmmm == "04") { $selectapr = "selected"; }
    else if($datenowmmm == "05") { $selectmay = "selected"; }
    else if($datenowmmm == "06") { $selectjun = "selected"; }
    else if($datenowmmm == "07") { $selectjul = "selected"; }
    else if($datenowmmm == "08") { $selectaug = "selected"; }
    else if($datenowmmm == "09") { $selectsep = "selected"; }
    else if($datenowmmm == "10") { $selectoct = "selected"; }
    else if($datenowmmm == "11") { $selectnov = "selected"; }
    else if($datenowmmm == "12") { $selectdec = "selected"; }
    else if($datenowmmm == "") { $selectmonth = "selected"; }
    else { $selectmonth = "selected"; }
    echo "<select name=\"mmmap\">";
      echo "<option value=\"01\" $selectjan>Jan</option>";
      echo "<option value=\"02\" $selectfeb>Feb</option>";
      echo "<option value=\"03\" $selectmar>Mar</option>";
      echo "<option value=\"04\" $selectapr>Apr</option>";
      echo "<option value=\"05\" $selectmay>May</option>";
      echo "<option value=\"06\" $selectjun>Jun</option>";
      echo "<option value=\"07\" $selectjul>Jul</option>";
      echo "<option value=\"08\" $selectaug>Aug</option>";
      echo "<option value=\"09\" $selectsep>Sep</option>";
      echo "<option value=\"10\" $selectoct>Oct</option>";
      echo "<option value=\"11\" $selectnov>Nov</option>";
      echo "<option value=\"12\" $selectdec>Dec</option>";
    echo "</select>";

    $select01=""; $select02=""; $select03=""; $select04=""; $select05=""; $select06=""; $select07=""; $select08=""; $select09=""; $select10="";
    $select11=""; $select12=""; $select13=""; $select14=""; $select15=""; $select16=""; $select17=""; $select18=""; $select19=""; $select20="";
    $select21=""; $select22=""; $select23=""; $select24=""; $select25=""; $select26=""; $select27=""; $select28=""; $select29=""; $select30=""; $select31="";
    if($datenowdd == "01") { $select01 = "selected"; }

    else if ($datenowdd == "02") { $select02 = "selected"; }
    else if ($datenowdd == "03") { $select03 = "selected"; }
    else if ($datenowdd == "04") { $select04 = "selected"; }
    else if ($datenowdd == "05") { $select05 = "selected"; }
    else if ($datenowdd == "06") { $select06 = "selected"; }
    else if ($datenowdd == "07") { $select07 = "selected"; }
    else if ($datenowdd == "08") { $select08 = "selected"; }
    else if ($datenowdd == "09") { $select09 = "selected"; }
    else if ($datenowdd == "10") { $select10 = "selected"; }
    else if ($datenowdd == "11") { $select11 = "selected"; }
    else if ($datenowdd == "12") { $select12 = "selected"; }
    else if ($datenowdd == "13") { $select13 = "selected"; }
    else if ($datenowdd == "14") { $select14 = "selected"; }
    else if ($datenowdd == "15") { $select15 = "selected"; }
    else if ($datenowdd == "16") { $select16 = "selected"; }
    else if ($datenowdd == "17") { $select17 = "selected"; }
    else if ($datenowdd == "18") { $select18 = "selected"; }
    else if ($datenowdd == "19") { $select19 = "selected"; }
    else if ($datenowdd == "20") { $select20 = "selected"; }
    else if ($datenowdd == "21") { $select21 = "selected"; }
    else if ($datenowdd == "22") { $select22 = "selected"; }
    else if ($datenowdd == "23") { $select23 = "selected"; }
    else if ($datenowdd == "24") { $select24 = "selected"; }
    else if ($datenowdd == "25") { $select25 = "selected"; }
    else if ($datenowdd == "26") { $select26 = "selected"; }
    else if ($datenowdd == "27") { $select27 = "selected"; }
    else if ($datenowdd == "28") { $select28 = "selected"; }
    else if ($datenowdd == "29") { $select29 = "selected"; }
    else if ($datenowdd == "30") { $select30 = "selected"; }
    else if ($datenowdd == "31") { $select31 = "selected"; }
    else if ($datenowdd = "") { $selectday = "selected"; }
    else { $selectday = "selected"; }
    echo "<select name=\"ddap\">";
      echo "<option value=\"01\" $select01>01</option>";
      echo "<option value=\"02\" $select02>02</option>";
      echo "<option value=\"03\" $select03>03</option>";
      echo "<option value=\"04\" $select04>04</option>";
      echo "<option value=\"05\" $select05>05</option>";
      echo "<option value=\"06\" $select06>06</option>";
      echo "<option value=\"07\" $select07>07</option>";
      echo "<option value=\"08\" $select08>08</option>";
      echo "<option value=\"09\" $select09>09</option>";
      echo "<option value=\"10\" $select10>10</option>";
      echo "<option value=\"11\" $select11>11</option>";
      echo "<option value=\"12\" $select12>12</option>";
      echo "<option value=\"13\" $select13>13</option>";
      echo "<option value=\"14\" $select14>14</option>";
      echo "<option value=\"15\" $select15>15</option>";
      echo "<option value=\"16\" $select16>16</option>";
      echo "<option value=\"17\" $select17>17</option>";
      echo "<option value=\"18\" $select18>18</option>";
      echo "<option value=\"19\" $select19>19</option>";
      echo "<option value=\"20\" $select20>20</option>";
      echo "<option value=\"21\" $select21>21</option>";
      echo "<option value=\"22\" $select22>22</option>";
      echo "<option value=\"23\" $select23>23</option>";
      echo "<option value=\"24\" $select24>24</option>";
      echo "<option value=\"25\" $select25>25</option>";
      echo "<option value=\"26\" $select26>26</option>";
      echo "<option value=\"27\" $select27>27</option>";
      echo "<option value=\"28\" $select28>28</option>";
      echo "<option value=\"29\" $select29>29</option>";
      echo "<option value=\"30\" $select30>30</option>";
      echo "<option value=\"31\" $select31>31</option>";
    echo "</select>";
*/
	echo "<input type='date' name=\"apdate\" value=\"$datenow\" class=\"form-control\"	/>";
    echo "</td>";

    //20230523 query last possible APV number and increment by 1 (+1)
    $res15query=""; $result15=""; $found15=0;
    $res15query="SELECT DISTINCT `acctspayablenumber` FROM `tblfinacctspayable` WHERE `acctspayablenumber`<>'' ORDER BY `date` DESC, `acctspayablenumber` DESC LIMIT 1";
    $result15=$dbh2->query($res15query);
    if($result15->num_rows>0) {
        while($myrow15=$result15->fetch_assoc()) {
        $found15=1;
        $acctspayablenumber15 = $myrow15['acctspayablenumber'];
        } //while
    } //if
    if($found15==1) {
        // $acctspayablenumber15fin=$acctspayablenumber15+1;
        $cutarrapno15 = explode("-", $acctspayablenumber15);
        $cutarrapno15fin0 = $cutarrapno15[0];
        $cutarrapno15fin1 = $cutarrapno15[1];
        $cutarrapno15fin2 = $cutarrapno15[2];
        $cutarrapno15fin3 = $cutarrapno15[3];
        if($cutarrapno15fin3!='') {
            $cutarrapno15fin3 = $cutarrapno15fin3+1;
            $acctspayablenumber15fin = "$cutarrapno15fin0"."-"."$cutarrapno15fin1"."-"."$cutarrapno15fin2"."-"."$cutarrapno15fin3";
        } else if($cutarrapno15fin2!='') {
            $cutarrapno15fin2 = $cutarrapno15fin2+1;
            $acctspayablenumber15fin = "$cutarrapno15fin0"."-"."$cutarrapno15fin1"."-"."$cutarrapno15fin2";
        } else if($cutarrapno15fin1!='') {
            $cutarrapno15fin1 = $cutarrapno15fin1+1;
            $acctspayablenumber15fin = "$cutarrapno15fin0"."-"."$cutarrapno15fin1";
        } else {
            $acctspayablenumber15fin="";
        } //if-else
    } else {
    $acctspayablenumber15fin="";
    } //if-else

    echo "<td>";
    // echo "$res15query<br>$acctspayablenumber15: $cutarrapno15fin0, $cutarrapno15fin1, $cutarrapno15fin2, $cutarrapno15fin3<br>";
    echo "Accts. Payable No.<br><input placeholder=\"APV No.\" name=\"apnumber\" value=\"$acctspayablenumber15fin\" size=\"10\" class=\"form-control\" /></td></tr>";
    echo "<tr><td colspan=\"2\">Payee<br>";
		// echo "<input name=\"appayee\" size=\"30\">";
    echo "<input id=\"radio5\" type=\"radio\" name=\"payeesw\" value=\"company\" />";
    echo "<select class=\"form-control\" name=\"apcompid\" id='apcomp' onchange=\"radioselect5()\">";
    echo "<option value=\"\">select company</option>";
    $result12=""; $found12=0; $ctr12=0;
    $result12 = mysql_query("SELECT companyid, company, branch FROM tblcompany ORDER BY company ASC", $dbh);
    if($result12 != "") {
      while($myrow12 = mysql_fetch_row($result12)) {
      $found12=1;
      $companyid12 = $myrow12[0];
      $company12 = $myrow12[1];
      $branch12 = $myrow12[2];
      echo "<option value=\"$companyid12\">$company12";
      if($branch12 != "") { echo " - $branch12"; }
      echo "</option>";
      }
    }
    echo "</select>";
    echo "<br /><input id=\"radio6\" type=\"radio\" name=\"payeesw\" value=\"contactperson\" />";
    echo "<select class=\"form-control\" name=\"payeecontactid\" id='apemp' onchange=\"radioselect6()\">";
    echo "<option value=\"\">select individual person</option>";
    $result14=""; $found14=0; $ctr14=0;
    // $result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.contact_type<>\"personnel\" OR (tblemployee.emp_record=\"active\" AND tblcontact.contact_type=\"personnel\") ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC", $dbh);
    $result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC", $dbh);
    if($result14 != "") {
      while($myrow14 = mysql_fetch_row($result14)) {
      $found14=1;
      $contactid14 = $myrow14[0];
      $companyid14 = $myrow14[1];
      $employeeid14 = $myrow14[2];
      $name_last14 = $myrow14[3];
      $name_first14 = $myrow14[4];
      $name_middle14 = $myrow14[5];
      echo "<option value=\"$contactid14\">$name_first14";
      if($name_middle14 != "") { echo "&nbsp;$name_middle14[0]."; }
      echo "&nbsp;$name_last14";
      if($employeeid14 != '') { echo "&nbsp;($employeeid14)"; }
      echo "</option>";
      }
    }
    echo "</select>";
    /*
    echo "<input name=\"cvpayee\" size=\"30\" onkeyup=\"search(document.form1.cvpayee.value, document.form1.cvpayee, document.form1.cvpayee0, document.getElementById('contentcvpayee'), disbpayee, disbpayeeid)\")>";
    echo "<input name=\"cvpayee0\" type=\"hidden\">";
    echo "<div id=\"contentcvpayee\">";

    echo "</div>";
    $result11=""; $found11=0; $ctr11=0;
    // echo "<select name=\"cvpayeetest\">";
    $result11 = mysql_query("SELECT DISTINCT payee FROM tblfindisbursement ORDER BY payee ASC", $dbh);
    if($result11 != "") {
      while($myrow11 = mysql_fetch_row($result11)) {
      $found11=0;
      $payee11 = $myrow11[0];
      $disbpayeeid[$ctr11] = "$ctr11";
      $disbpayee[$ctr11] = "$payee11";
      // echo "<option value=\"$payee11\">$payee11</option>";
      $ctr11 = $ctr11 + 1;
      }
    }
    // echo "</select>";
    */
    echo "</td></tr>";
		// echo "<input name=\"appayee\" size=\"30\" onkeyup=\"search(document.form2.appayee.value, document.form2.appayee, document.form2.appayee0, document.getElementById('contentappayee'), acctspaypayee, acctspaypayeeid)\")>";
		echo "<input name=\"appayee\" id='appayee' type=\"hidden\">";
		// echo "<div id=\"contentappayee\">";

		// echo "</div>";

		// $result12=""; $found12=0; $ctr12=0;
		// $result12 = mysql_query("SELECT DISTINCT payee FROM tblfinacctspayable ORDER BY payee ASC", $dbh);
		// if($result12 != "") {
		// 	while($myrow12 = mysql_fetch_row($result12)) {
		// 	$found12=0;
		// 	$payee12 = $myrow12[0];
		// 	$acctspaypayeeid[$ctr12] = "$ctr12";
		// 	$acctspaypayee[$ctr12] = "$payee12";
		// 	$ctr12 = $ctr12 + 1;
		// 	}
		// }

		echo "</td></tr>";
    echo "<tr><td colspan=\"2\">Due Date: <br><input placeholder='Select Date' type='date' name=\"duedate\" value=\"$datenow\" class=\"form-control\" /> </td></tr>";
    echo "<tr><td colspan=\"2\">Explanation<br><textarea placeholder=\"particulars, details or explanation\" class=\"form-control\" rows=\"3\" cols=\"38\" name=\"explanation\" wrap=\"physical\"></textarea></td></tr>";

    echo "<tr><td align=\"center\"><input type=\"submit\" value=\"Save & continue\" class=\"btn btn-success\" role=\"button\" /></form></td>";
    echo "<td align=\"center\"><form action=\"finvouchmain.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"Cancel\" class=\"btn btn-danger\" role=\"button\" /></td></form></tr>";
  echo "</table>";
?>
</div>

<div id='cashreceipt' <?php echo "$crdvstyle"; ?>>
<?php
  echo "<form action=\"finvouchcrvnew.php?loginid=$loginid\" method=\"post\" name=\"form3\">";
  echo "<table>";
    echo "<tr><td>Date<br>";
/*
    $cutarrdatenow = explode("-", $datenow);
    $datenowyyyy = $cutarrdatenow[0];
    $datenowmmm = $cutarrdatenow[1];
    $datenowdd = $cutarrdatenow[2];
    echo "<input name=\"yyyycrv\" size=\"4\" value=\"$yearnow\" class='form-control'>";

    $selectjan=""; $selectfeb=""; $selectmar=""; $selectapr=""; $selectmay=""; $selectjun="";
    $selectjul=""; $selectaug=""; $selectsep=""; $selectoct=""; $selectnov=""; $selectdec="";
    if($datenowmmm == "01") { $selectjan = "selected"; }
    else if($datenowmmm == "02") { $selectfeb = "selected"; }
    else if($datenowmmm == "03") { $selectmar = "selected"; }
    else if($datenowmmm == "04") { $selectapr = "selected"; }
    else if($datenowmmm == "05") { $selectmay = "selected"; }
    else if($datenowmmm == "06") { $selectjun = "selected"; }
    else if($datenowmmm == "07") { $selectjul = "selected"; }
    else if($datenowmmm == "08") { $selectaug = "selected"; }
    else if($datenowmmm == "09") { $selectsep = "selected"; }
    else if($datenowmmm == "10") { $selectoct = "selected"; }
    else if($datenowmmm == "11") { $selectnov = "selected"; }
    else if($datenowmmm == "12") { $selectdec = "selected"; }
    else if($datenowmmm == "") { $selectmonth = "selected"; }
    else { $selectmonth = "selected"; }
    echo "<select name=\"mmmcrv\">";
      echo "<option value=\"01\" $selectjan>Jan</option>";
      echo "<option value=\"02\" $selectfeb>Feb</option>";
      echo "<option value=\"03\" $selectmar>Mar</option>";
      echo "<option value=\"04\" $selectapr>Apr</option>";
      echo "<option value=\"05\" $selectmay>May</option>";
      echo "<option value=\"06\" $selectjun>Jun</option>";
      echo "<option value=\"07\" $selectjul>Jul</option>";
      echo "<option value=\"08\" $selectaug>Aug</option>";
      echo "<option value=\"09\" $selectsep>Sep</option>";
      echo "<option value=\"10\" $selectoct>Oct</option>";
      echo "<option value=\"11\" $selectnov>Nov</option>";
      echo "<option value=\"12\" $selectdec>Dec</option>";
    echo "</select>";

    $select01=""; $select02=""; $select03=""; $select04=""; $select05=""; $select06=""; $select07=""; $select08=""; $select09=""; $select10="";
    $select11=""; $select12=""; $select13=""; $select14=""; $select15=""; $select16=""; $select17=""; $select18=""; $select19=""; $select20="";
    $select21=""; $select22=""; $select23=""; $select24=""; $select25=""; $select26=""; $select27=""; $select28=""; $select29=""; $select30=""; $select31="";
    if($datenowdd == "01") { $select01 = "selected"; }
    else if ($datenowdd == "02") { $select02 = "selected"; }
    else if ($datenowdd == "03") { $select03 = "selected"; }
    else if ($datenowdd == "04") { $select04 = "selected"; }
    else if ($datenowdd == "05") { $select05 = "selected"; }
    else if ($datenowdd == "06") { $select06 = "selected"; }
    else if ($datenowdd == "07") { $select07 = "selected"; }
    else if ($datenowdd == "08") { $select08 = "selected"; }
    else if ($datenowdd == "09") { $select09 = "selected"; }
    else if ($datenowdd == "10") { $select10 = "selected"; }
    else if ($datenowdd == "11") { $select11 = "selected"; }
    else if ($datenowdd == "12") { $select12 = "selected"; }
    else if ($datenowdd == "13") { $select13 = "selected"; }
    else if ($datenowdd == "14") { $select14 = "selected"; }
    else if ($datenowdd == "15") { $select15 = "selected"; }
    else if ($datenowdd == "16") { $select16 = "selected"; }
    else if ($datenowdd == "17") { $select17 = "selected"; }
    else if ($datenowdd == "18") { $select18 = "selected"; }
    else if ($datenowdd == "19") { $select19 = "selected"; }
    else if ($datenowdd == "20") { $select20 = "selected"; }
    else if ($datenowdd == "21") { $select21 = "selected"; }
    else if ($datenowdd == "22") { $select22 = "selected"; }
    else if ($datenowdd == "23") { $select23 = "selected"; }
    else if ($datenowdd == "24") { $select24 = "selected"; }
    else if ($datenowdd == "25") { $select25 = "selected"; }
    else if ($datenowdd == "26") { $select26 = "selected"; }
    else if ($datenowdd == "27") { $select27 = "selected"; }
    else if ($datenowdd == "28") { $select28 = "selected"; }
    else if ($datenowdd == "29") { $select29 = "selected"; }
    else if ($datenowdd == "30") { $select30 = "selected"; }
    else if ($datenowdd == "31") { $select31 = "selected"; }
    else if ($datenowdd = "") { $selectday = "selected"; }
    else { $selectday = "selected"; }
    echo "<select name=\"ddcrv\">";
      echo "<option value=\"01\" $select01>01</option>";
      echo "<option value=\"02\" $select02>02</option>";
      echo "<option value=\"03\" $select03>03</option>";
      echo "<option value=\"04\" $select04>04</option>";
      echo "<option value=\"05\" $select05>05</option>";
      echo "<option value=\"06\" $select06>06</option>";
      echo "<option value=\"07\" $select07>07</option>";
      echo "<option value=\"08\" $select08>08</option>";
      echo "<option value=\"09\" $select09>09</option>";
      echo "<option value=\"10\" $select10>10</option>";
      echo "<option value=\"11\" $select11>11</option>";
      echo "<option value=\"12\" $select12>12</option>";
      echo "<option value=\"13\" $select13>13</option>";
      echo "<option value=\"14\" $select14>14</option>";
      echo "<option value=\"15\" $select15>15</option>";
      echo "<option value=\"16\" $select16>16</option>";
      echo "<option value=\"17\" $select17>17</option>";
      echo "<option value=\"18\" $select18>18</option>";
      echo "<option value=\"19\" $select19>19</option>";
      echo "<option value=\"20\" $select20>20</option>";
      echo "<option value=\"21\" $select21>21</option>";
      echo "<option value=\"22\" $select22>22</option>";
      echo "<option value=\"23\" $select23>23</option>";
      echo "<option value=\"24\" $select24>24</option>";
      echo "<option value=\"25\" $select25>25</option>";
      echo "<option value=\"26\" $select26>26</option>";
      echo "<option value=\"27\" $select27>27</option>";
      echo "<option value=\"28\" $select28>28</option>";
      echo "<option value=\"29\" $select29>29</option>";
      echo "<option value=\"30\" $select30>30</option>";
      echo "<option value=\"31\" $select31>31</option>";
    echo "</select>";
*/
	echo "<input type='date' name=\"crvdate\" value=\"$datenow\" class=\"form-control\"	/>";
    echo "</td>";

    //20230523 pre-fill cashreceipt no., increment +1
    $res16query=""; $result16=""; $found16=0;
    $res16query="SELECT `cashreceiptnumber` FROM `tblfincashreceipt` WHERE `cashreceiptnumber` <> '' ORDER BY `date` DESC, `cashreceiptnumber` DESC LIMIT 1";
    $result16=$dbh2->query($res16query);
    if($result16->num_rows>0) {
        while($myrow16=$result16->fetch_assoc()) {
        $found16=1;
        $cashreceiptnumber16 = $myrow16['cashreceiptnumber'];
        } //while
    } //if
    if($found16==1) {
        $arrcrn16 = explode(".", $cashreceiptnumber16);
        $arrcrn16fin0 = $arrcrn16[0];
        $arrcrn16fin1 = $arrcrn16[1];
        $arrcrn16fin2 = $arrcrn16[2];
        if($arrcrn16fin1!='') {
        $arrcrn16fin1 = $arrcrn16fin1+1;
        $arrcrn16fin = $arrcrn16fin0.".".$arrcrn16fin1.".".$arrcrn16fin2;
        } else {
        $arrcrn16fin = $cashreceiptnumber16;
        } //if-else
    } else {
        $arrcrn16fin = $cashreceiptnumber16;
    } //if-else

    echo "<td>";
    // echo "$cashreceiptnumber16, ".$arrcrn16[0].", ".$arrcrn16[1].", ".$arrcrn16[2].": $arrcrn16fin0, $arrcrn16fin1, $arrcrn16fin2<br>";
    echo "Cash Receipt No.<br><input name=\"crvnumber\" value=\"$arrcrn16fin\" size=\"10\" class='form-control'></td></tr>";
		echo "<tr><td colspan=\"2\">Received from<br>";
		echo "<input id=\"radio3\" type=\"radio\" name=\"payorsw\" value=\"company\">";
		echo "<select name=\"payorcompanyid\" onchange=\"radioselect3()\" class='form-control'>";
		echo "<option value=\"\">select company</option>";
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("SELECT companyid, company, branch FROM tblcompany ORDER BY company ASC", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12=1;
			$companyid12 = $myrow12[0];
			$company12 = $myrow12[1];
			$branch12 = $myrow12[2];
			echo "<option value=\"$companyid12\">$company12";
			if($branch != "") { echo " - $branch12"; }
			echo "</option>";
			}
		}
		echo "</select>";
		echo "<br /><input id=\"radio4\" type=\"radio\" name=\"payorsw\" value=\"contactperson\">";
		echo "<select name=\"payorcontactid\" onchange=\"radioselect4()\" class='form-control'>";
		echo "<option value=\"\">select individual person</option>";
		$result14=""; $found14=0; $ctr14=0;
		// $result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.contact_type<>\"personnel\" OR (tblemployee.emp_record=\"active\" AND tblcontact.contact_type=\"personnel\") ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC", $dbh);
		$result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14=1;
			$contactid14 = $myrow14[0];
			$companyid14 = $myrow14[1];
			$employeeid14 = $myrow14[2];
			$name_last14 = $myrow14[3];
			$name_first14 = $myrow14[4];
			$name_middle14 = $myrow14[5];
			echo "<option value=\"$contactid14\">$name_first14";
			if($name_middle14 != "") { echo "&nbsp;$name_middle14[0]."; }
			echo "&nbsp;$name_last14";
			if($employeeid14 != '') { echo "&nbsp;($employeeid14)"; }
			echo "</option>";
			}
		}
		echo "</select>";
		/*
		// echo "<input name=\"payor\" size=\"25\">";
		echo "<input name=\"payor\" size=\"30\" onkeyup=\"search(document.form3.payor.value, document.form3.payor, document.form3.payor0, document.getElementById('contentpayor'), cshrcptpayor, cshrcptpayorid)\")>";
		echo "<input name=\"payor0\" type=\"hidden\">";
		echo "<div id=\"contentpayor\">";

		echo "</div>";

		$result14=""; $found14=0; $ctr14=0;
		$result14 = mysql_query("SELECT DISTINCT payor FROM tblfincashreceipt ORDER BY payor ASC", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14=0;
			$payor14 = $myrow14[0];
			$cshrcptpayorid[$ctr14] = "$ctr14";
			$cshrcptpayor[$ctr14] = "$payor14";
			$ctr14 = $ctr14 + 1;
			}
		}
		*/
		echo "</td></tr>";
    echo "<tr><td colspan=\"2\">Explanation<br><textarea rows=\"3\" cols=\"38\" name=\"explanation\" wrap=\"physical\" class='form-control'></textarea></td></tr>";
    echo "<tr><td><button type=\"submit\" class='btn btn-success'>Save & continue</button></form></td>";
    echo "<td><form action=\"finvouchmain.php?loginid=$loginid\" method=\"post\"><button type=\"submit\" class='btn btn-danger'>Cancel</button></td></form></tr>";
  echo "</table>";
?>
</div>

<div id='journal' <?php echo "$jvdvstyle"; ?>>
<?php
  echo "<form action=\"finvouchjvnew.php?loginid=$loginid\" method=\"post\" name=\"form4\">";
  echo "<table width='100%';>";
    echo "<tr><td>Date<br>";
/*
    $cutarrdatenow = split("-", $datenow);
    $datenowyyyy = $cutarrdatenow[0];
    $datenowmmm = $cutarrdatenow[1];
    $datenowdd = $cutarrdatenow[2];
    echo "<input name=\"yyyyjv\" size=\"4\" value=\"$yearnow\">";

    $selectjan=""; $selectfeb=""; $selectmar=""; $selectapr=""; $selectmay=""; $selectjun="";
    $selectjul=""; $selectaug=""; $selectsep=""; $selectoct=""; $selectnov=""; $selectdec="";
    if($datenowmmm == "01") { $selectjan = "selected"; }
    else if($datenowmmm == "02") { $selectfeb = "selected"; }
    else if($datenowmmm == "03") { $selectmar = "selected"; }
    else if($datenowmmm == "04") { $selectapr = "selected"; }
    else if($datenowmmm == "05") { $selectmay = "selected"; }
    else if($datenowmmm == "06") { $selectjun = "selected"; }
    else if($datenowmmm == "07") { $selectjul = "selected"; }
    else if($datenowmmm == "08") { $selectaug = "selected"; }
    else if($datenowmmm == "09") { $selectsep = "selected"; }
    else if($datenowmmm == "10") { $selectoct = "selected"; }
    else if($datenowmmm == "11") { $selectnov = "selected"; }
    else if($datenowmmm == "12") { $selectdec = "selected"; }
    else if($datenowmmm == "") { $selectmonth = "selected"; }
    else { $selectmonth = "selected"; }
    echo "<select name=\"mmmjv\">";
      echo "<option value=\"01\" $selectjan>Jan</option>";
      echo "<option value=\"02\" $selectfeb>Feb</option>";
      echo "<option value=\"03\" $selectmar>Mar</option>";
      echo "<option value=\"04\" $selectapr>Apr</option>";
      echo "<option value=\"05\" $selectmay>May</option>";
      echo "<option value=\"06\" $selectjun>Jun</option>";
      echo "<option value=\"07\" $selectjul>Jul</option>";
      echo "<option value=\"08\" $selectaug>Aug</option>";
      echo "<option value=\"09\" $selectsep>Sep</option>";
      echo "<option value=\"10\" $selectoct>Oct</option>";
      echo "<option value=\"11\" $selectnov>Nov</option>";
      echo "<option value=\"12\" $selectdec>Dec</option>";
    echo "</select>";

    $select01=""; $select02=""; $select03=""; $select04=""; $select05=""; $select06=""; $select07=""; $select08=""; $select09=""; $select10="";
    $select11=""; $select12=""; $select13=""; $select14=""; $select15=""; $select16=""; $select17=""; $select18=""; $select19=""; $select20="";
    $select21=""; $select22=""; $select23=""; $select24=""; $select25=""; $select26=""; $select27=""; $select28=""; $select29=""; $select30=""; $select31="";
    if($datenowdd == "01") { $select01 = "selected"; }
    else if ($datenowdd == "02") { $select02 = "selected"; }
    else if ($datenowdd == "03") { $select03 = "selected"; }
    else if ($datenowdd == "04") { $select04 = "selected"; }
    else if ($datenowdd == "05") { $select05 = "selected"; }
    else if ($datenowdd == "06") { $select06 = "selected"; }
    else if ($datenowdd == "07") { $select07 = "selected"; }
    else if ($datenowdd == "08") { $select08 = "selected"; }
    else if ($datenowdd == "09") { $select09 = "selected"; }
    else if ($datenowdd == "10") { $select10 = "selected"; }
    else if ($datenowdd == "11") { $select11 = "selected"; }
    else if ($datenowdd == "12") { $select12 = "selected"; }
    else if ($datenowdd == "13") { $select13 = "selected"; }
    else if ($datenowdd == "14") { $select14 = "selected"; }
    else if ($datenowdd == "15") { $select15 = "selected"; }
    else if ($datenowdd == "16") { $select16 = "selected"; }
    else if ($datenowdd == "17") { $select17 = "selected"; }
    else if ($datenowdd == "18") { $select18 = "selected"; }
    else if ($datenowdd == "19") { $select19 = "selected"; }
    else if ($datenowdd == "20") { $select20 = "selected"; }
    else if ($datenowdd == "21") { $select21 = "selected"; }
    else if ($datenowdd == "22") { $select22 = "selected"; }
    else if ($datenowdd == "23") { $select23 = "selected"; }
    else if ($datenowdd == "24") { $select24 = "selected"; }
    else if ($datenowdd == "25") { $select25 = "selected"; }
    else if ($datenowdd == "26") { $select26 = "selected"; }
    else if ($datenowdd == "27") { $select27 = "selected"; }
    else if ($datenowdd == "28") { $select28 = "selected"; }
    else if ($datenowdd == "29") { $select29 = "selected"; }
    else if ($datenowdd == "30") { $select30 = "selected"; }
    else if ($datenowdd == "31") { $select31 = "selected"; }
    else if ($datenowdd = "") { $selectday = "selected"; }
    else { $selectday = "selected"; }
    echo "<select name=\"ddjv\">";
      echo "<option value=\"01\" $select01>01</option>";
      echo "<option value=\"02\" $select02>02</option>";
      echo "<option value=\"03\" $select03>03</option>";
      echo "<option value=\"04\" $select04>04</option>";
      echo "<option value=\"05\" $select05>05</option>";
      echo "<option value=\"06\" $select06>06</option>";
      echo "<option value=\"07\" $select07>07</option>";
      echo "<option value=\"08\" $select08>08</option>";
      echo "<option value=\"09\" $select09>09</option>";
      echo "<option value=\"10\" $select10>10</option>";
      echo "<option value=\"11\" $select11>11</option>";
      echo "<option value=\"12\" $select12>12</option>";
      echo "<option value=\"13\" $select13>13</option>";
      echo "<option value=\"14\" $select14>14</option>";
      echo "<option value=\"15\" $select15>15</option>";
      echo "<option value=\"16\" $select16>16</option>";
      echo "<option value=\"17\" $select17>17</option>";
      echo "<option value=\"18\" $select18>18</option>";
      echo "<option value=\"19\" $select19>19</option>";
      echo "<option value=\"20\" $select20>20</option>";
      echo "<option value=\"21\" $select21>21</option>";
      echo "<option value=\"22\" $select22>22</option>";
      echo "<option value=\"23\" $select23>23</option>";
      echo "<option value=\"24\" $select24>24</option>";
      echo "<option value=\"25\" $select25>25</option>";
      echo "<option value=\"26\" $select26>26</option>";
      echo "<option value=\"27\" $select27>27</option>";
      echo "<option value=\"28\" $select28>28</option>";
      echo "<option value=\"29\" $select29>29</option>";
      echo "<option value=\"30\" $select30>30</option>";
      echo "<option value=\"31\" $select31>31</option>";
    echo "</select>";
*/
	echo "<input type='date' name=\"jvdate\" value=\"$datenow\" class=\"form-control\"	/>";
    echo "</td>";

    //20230523 query latest jvnumber and increment by 1
    $res17query=""; $result17=""; $found17=0;
    $res17query="SELECT DISTINCT `journalnumber` FROM `tblfinjournal` WHERE `journalnumber` <> '' ORDER BY `date` DESC , `journalnumber` DESC LIMIT 1";
    $result17=$dbh2->query($res17query);
    if($result17->num_rows>0) {
        while($myrow17=$result17->fetch_assoc()) {
        $found17=1;
        $journalnumber17=$myrow17['journalnumber'];
        } //while
    } //if
    if($found17==1) {
        $arrjvn17 = explode(".", $journalnumber17);
        $arrjvn17fin0 = $arrjvn17[0];
        $arrjvn17fin1 = $arrjvn17[1];
        $arrjvn17fin2 = $arrjvn17[2];
        if($arrjvn17fin2!='') {
        $arrjvn17fin2 = $arrjvn17fin2+1;
        $jvn17fin = $arrjvn17fin0.".".$arrjvn17fin1.".".sprintf("%02d", $arrjvn17fin2);
        } else {
        $jvn17fin = $journalnumber17;
        } //if-else
    } else {
        $jvn17fin = $journalnumber17;
    } //if-else

    echo "<td>";
    // echo "$journalnumber17, $arrjvn17: $arrjvn17fin0, $arrjvn17fin1, $arrjvn17fin2 res: $jvn17fin<br>";
    echo "Journal Voucher No.<br><input name=\"jvnumber\" value=\"$jvn17fin\" size=\"10\" class='form-control'></td></tr>";

    echo "<tr><td colspan=\"2\">Explanation<br><textarea rows=\"3\" cols=\"38\" name=\"explanation\" wrap=\"physical\" class='form-control'></textarea></td></tr>";

    echo "<tr><td><button class='btn btn-success' type=\"submit\">Save & continue</button></form></td>";

    echo "<td><form action=\"finvouchmain.php?loginid=$loginid\" method=\"post\"><button type=\"submit\" class='btn btn-danger'>Cancel</button></td></form></tr>";
  echo "</table>";
?>
</div>
</td></tr>
<?php
echo "</table>";

echo "<p><a href=\"finvouchmain.php?loginid=$loginid\" class=\"btn btn-default\" role=\"button\" />Back</a></p>";




// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

?>

<SCRIPT type="text/javascript" language="JavaScript">

var disbpayeeid = [
<?php
	if($disbpayeeid != "") {
  foreach ($disbpayeeid as $value)
  {
       echo "$value,";
  }
  echo "0";
	}
?>
];

var disbpayee = [
<?php
	if($disbpayee != "") {
  foreach ($disbpayee as $value)
  {
       echo "\"$value\",";
  }
  echo "\"Select\"";
	}
?>
];

var acctspaypayeeid = [
<?php
	if($acctspaypayeeid != "") {
  foreach ($acctspaypayeeid as $value)
  {
       echo "$value,";
  }
  echo "0";
	}
?>
];

var acctspaypayee = [
<?php
	if($acctspaypayee != "") {
  foreach ($acctspaypayee as $value)
  {
       echo "\"$value\",";
  }
  echo "\"Select\"";
	}
?>
];

var cshrcptpayorid = [
<?php
	if($cshrcptpayorid != "") {
  foreach ($cshrcptpayorid as $value)
  {
       echo "$value,";
  }
  echo "0";
	}
?>
];

var cshrcptpayor = [
<?php
	if($cshrcptpayor != "") {
  foreach ($cshrcptpayor as $value)
  {
       echo "\"$value\",";
  }
  echo "\"Select\"";
	}
?>
];

function radioselect2()
{
     document.getElementById('radio2').checked = true;
}
function radioselect1()
{
     document.getElementById('radio1').checked = true;	
}

function radioselect3()
{
     document.getElementById('radio3').checked = true;
}
function radioselect4()
{
     document.getElementById('radio4').checked = true;	
}

function radioselect5()
{
     document.getElementById('radio5').checked = true;
}
function radioselect6()
{
     document.getElementById('radio6').checked = true;	
}

</SCRIPT>
<?php
mysql_close($dbh);
$dbh2->close;
?>


<script>
  $(document).ready(function(){

    $('#apcomp').on('change',function(){
      var compName = $(this).selected().val();
      $('#appayee').val(compName)
    });

     $('#apemp').on('change',function(){
      var empName = $(this).selected().val();
      $('#appayee').val(empName)
    });

     $.ajax({
          url : 'tjfunctions/checkvoucherincrement.php', 
          type : 'GET',
          dataType:"json",
          success : function(data){
            $('#txtCheckNumber').val(data);
          }
      }); 

    $('#txtCheckNumber').on('blur',function(){
      var cvnumber = $(this).val();
      $.ajax({
          url : 'tjfunctions/checkvouchervalidation.php', 
          type : 'POST',
          dataType:"json",
          data : { cvnumber: cvnumber},
          success : function(data){
              if(data == 1 || data == '1')
              {
                swal('','Check Voucher Number ' + cvnumber + ' is already used!','warning');
              }

          }
      });   
    });

    $('#duedate').datepicker();


  });
</script>