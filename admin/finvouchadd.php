<?php 

include("db1.php");
include ("addons.php");
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
     ?>
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<style>
 .select2-container {
width: 100% !important;
padding: 0;
}
</style>

<script>
  $(document).ready(function() {
    $('#my-select').select2({
      
    });
  });

  $(document).ready(function() {
    $('#my-select2').select2({
      
    });
  });


  $(document).ready(function() {
    $('#apcomp').select2({
      
    });
  });

  $(document).ready(function() {
    $('#apemp').select2({
      
    });
  });
</script>
     <?php
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

<div class="">
	<a href="<?php echo 'finvouchmain.php?loginid=' . $loginid ?>" class = 'mainbtnclr btn text-white'>Back
	</a>
</div>

  <div class="my-5 p-4 shadow rounded-3">
    <div class = 'mb-4'>
    <h4 class = 'fw-semibold mb-0 pb-0'>List Vouchers </h4>
    <p>Data Entry of pkii vouchers</p>

    </div>

    <form name="voucher" class="m-0">
      <div class="d-flex justify-content-evenly align-content-center poppins">
        <div class="d-flex align-content-center gap-1">
          <input class="m-0" type='radio' name='type' value='checkvoucher' onClick="get_radio_value(1);" checked>
          <label class="m-0 d-flex align-items-center text-black">Check Voucher</label>
        </div>
        <div class="d-flex align-content-center gap-1">
          <input class="m-0" type='radio' name='type' value='acctspayable' onClick="get_radio_value(2);">
          <label class="m-0 d-flex align-items-center text-black">Accounts Payable</label>
        </div>
        <div class="d-flex align-content-center gap-1">
          <input class="m-0" type='radio' name='type' value='cashreceipt' onClick="get_radio_value(3);">
          <label class="m-0 d-flex align-items-center text-black">Cash Receipt</label>
        </div>
        <div class="d-flex align-content-center gap-1">
          <input class="m-0" type='radio' name='type' value='journal' onClick="get_radio_value(4);">
          <label class="m-0 d-flex align-items-center text-black">Journal</label>
        </div>
      </div>
    </form>
  </div>
<div id='checkvoucher' <?php echo "$cvdvstyle"; ?>>

<?php
  echo "<form action=\"finvouchcvnew.php?loginid=$loginid\" method=\"post\" class = 'shadow p-4 ' name=\"form1\">";
  echo "<h4 class = 'fw-semibold text-center'>Check Voucher</h4>";
    echo "<div class ='mt-2'><label for='select'>Date</label>";

	echo "<input type='date' name=\"cvdate\" value=\"$datenow\" class=\"form-control\"	/></div>";

    if($incrementeddisbursementnumber=='') {
    $res18query=""; $result18=""; $found18=0;
    $res18query="SELECT DISTINCT `disbursementnumber` FROM `tblfindisbursement` WHERE `disbursementnumber` >0 ORDER BY `date` DESC, `disbursementid` DESC, `disbursementnumber` DESC LIMIT 1";
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

    // echo "$disbursementnumber18, $incrementeddisbursementnumber<br>";
    echo "<div class ='mt-2'><label for='select'>Check Voucher No.</label>";
    // echo "<input placeholder='CV Number' id='txtCheckNumber' name=\"cvnumber\" size=\"10\" class='form-control'>";
    echo "<input placeholder='CV Number' name=\"cvnumber\" value=\"$incrementeddisbursementnumber\" size=\"10\" class='form-control'></div>";
    echo "";

    echo "<div class ='mt-2 '><label for='select'>Payee</label>";
		echo "<div class ='row mt-1 me-3'>
    <div class = 'col-1 text-end px-0'><input id=\"radio1\" type=\"radio\" name=\"payeesw\" value=\"company\" class = ''></div>";
		echo "<div class = 'col'><select name=\"payeecompanyid\" onchange=\"radioselect1()\" id = 'my-select' class='w-100'>";
		echo "<option value=\"\">select company</option>";
		$result12=""; $found12=0; $ctr12=0;
		$result12 = mysql_query("SELECT companyid, company, branch FROM tblcompany WHERE company IS NOT NULL AND company <> '' ORDER BY company asc", $dbh);
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
		echo "</select></div></div></div>";

		echo "<div class ='row mt-3 me-3'><div class = 'col-1 text-end px-0'><input id=\"radio2\" type=\"radio\" name=\"payeesw\" value=\"contactperson\" class = ''></div>";
		echo "<div class = 'col'><select name=\"payeecontactid\" onchange=\"radioselect2()\" id = 'my-select2' class='w-100'>";
		echo "<option value=\"\">select person</option>";
		$result14=""; $found14=0; $ctr14=0;
		// $result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.contact_type<>\"personnel\" OR (tblemployee.emp_record=\"active\" AND tblcontact.contact_type=\"personnel\") ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC", $dbh);
		$result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact WHERE 
    tblcontact.name_last IS NOT NULL AND tblcontact.name_last <> '' AND tblcontact.name_first IS NOT NULL AND tblcontact.name_first <> ''  ORDER BY  tblcontact.name_last ASC", $dbh);
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
		echo "</select></div></div>";
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
		echo "";

    echo "<label for = 'select'>Explanation</label><textarea rows=\"3\" cols=\"38\" name=\"explanation\" wrap=\"physical\" placeholder = 'Voucher Explanation Here...' class='form-control'></textarea>";


    echo "<td class=''><div class = 'text-end mt-3'><button type=\"submit\" class='btn text-white bg-success'>Save & continue</button></div></form>";
    echo "<td class='py-3'>";
  echo "";
?>
</div>







<!-- [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[CHECK VOUCHER]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]] -->










<div id='acctspayable' <?php echo "$apdvstyle"; ?>>
<?php
  echo "<form action=\"finvouchapnew.php?loginid=$loginid\" method=\"post\" class = 'shadow p-4 ' name=\"form2\">";
  echo "<h4 class = 'fw-semibold text-center'>Accounts Payable</h4>";

    echo "<label for='select'>Date</label>";

    $cutarrdatenow = split("-", $datenow);
    $datenowyyyy = $cutarrdatenow[0];
    $datenowmmm = $cutarrdatenow[1];
    $datenowdd = $cutarrdatenow[2];

	echo "<input type='date' name=\"apdate\" value=\"$datenow\" class=\"form-control\"	/>";
    echo "";

    //20230523 query last possible APV number and increment by 1 (+1)
    $res15query=""; $result15=""; $found15=0;
    $res15query="SELECT DISTINCT `acctspayablenumber` FROM `tblfinacctspayable` WHERE `acctspayablenumber`<>'' ORDER BY `date` DESC, `acctspayableid` DESC, `acctspayablenumber` DESC LIMIT 1";
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

    // echo "$res15query<br>$acctspayablenumber15: $cutarrapno15fin0, $cutarrapno15fin1, $cutarrapno15fin2, $cutarrapno15fin3<br>";
    echo "<div class ='mt-2'><label for='select'>Accounts Payable Number</label>";

    echo "<input placeholder=\"APV No.\" name=\"apnumber\" value=\"$acctspayablenumber15fin\" size=\"10\" class=\"form-control\" />";
    echo "<div class ='mt-2'><label for='select'>Payee</label>";

				echo "<div class ='row mt-1 me-3'>
    <div class = 'col-1 text-end px-0'><input id=\"radio5\" type=\"radio\" class = 'mx-2' name=\"payeesw\" value=\"company\" /></div>";
    echo "<div class = 'col'><select class=\"w-100\" name=\"apcompid\" id='apcomp' onchange=\"radioselect5()\">";
    echo "<option value=\"\">select company</option>";
    $result12=""; $found12=0; $ctr12=0;
    $result12 = mysql_query("SELECT companyid, company, branch FROM tblcompany WHERE company IS NOT NULL AND company <> '' ORDER BY company asc", $dbh);
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
    echo "</select></div></div></div></div>";

    
    echo "<div class ='row mt-3  me-3'><div class = 'col-1 text-end px-0'><input id=\"radio6\" type=\"radio\" name=\"payeesw\" value=\"contactperson\" /></div>";


    echo "<div class = 'col'><select class=\"w-100\" name=\"payeecontactid\" id='apemp' onchange=\"radioselect6()\">";
    echo "<option value=\"\">select individual person</option>";
    $result14=""; $found14=0; $ctr14=0;

    $result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact WHERE 
    tblcontact.name_last IS NOT NULL AND tblcontact.name_last <> '' AND tblcontact.name_first IS NOT NULL AND tblcontact.name_first <> ''  ORDER BY  tblcontact.name_last ASC", $dbh);
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
    echo "</select></div></div>";
   
    echo "";
	
		echo "<input name=\"appayee\" id='appayee' type=\"hidden\">";
	

		echo "";
    echo "<label for = 'select' class = 'mt-2' >Due Date</label><input placeholder='Select Date' type='date' name=\"duedate\" value=\"$datenow\" class=\"form-control\" /> ";
    echo "<label for = 'select' class = 'mt-2'>Explanation</label><textarea placeholder=\"Voucher Explanation...\" class=\"form-control\" rows=\"3\" cols=\"38\" name=\"explanation\" wrap=\"physical\"></textarea>";

    echo "<td class=''><div class='text-end my-3'><input type=\"submit\" value=\"Save & continue\" class='btn text-white bg-success' role=\"button\" /></div></form>";
    echo "<td class='py-3'>";
  echo "";
?>
</div>








<!-- [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[ACCOUNTS PAYABLE]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]] -->





<div id='cashreceipt' <?php echo "$crdvstyle"; ?>>
<?php
  echo "<form action=\"finvouchcrvnew.php?loginid=$loginid\" method=\"post\" class = 'shadow p-4' name=\"form3\">";
   
  echo "<h4 class = 'fw-semibold text-center'>Cash Reciept</h4>";

    //20230523 pre-fill cashreceipt no., increment +1
    $res16query=""; $result16=""; $found16=0;
    $res16query="SELECT `cashreceiptnumber` FROM `tblfincashreceipt` WHERE `cashreceiptnumber` <> '' ORDER BY `date` DESC, `cashreceiptid` DESC, `cashreceiptnumber` DESC LIMIT 1";
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

  
    echo "<label for='select'>Date</label>";

    echo "<input type='date' name=\"crvdate\" value=\"$datenow\" class=\"form-control\"/>";

    
    // echo "$cashreceiptnumber16, ".$arrcrn16[0].", ".$arrcrn16[1].", ".$arrcrn16[2].": $arrcrn16fin0, $arrcrn16fin1, $arrcrn16fin2<br>";
  
    echo "<label for='select'>Cash Receipt No</label><input name=\"crvnumber\" value=\"$arrcrn16fin\" size=\"10\" class='form-control'>";
		echo "<label for='select'>Recieved From</label>";

  echo "<div class ='row mt-1 me-3'>
    <div class = 'col-1 text-end px-0'><input id=\"radio3\" type=\"radio\" name=\"payorsw\" value=\"company\"></div>";
		echo "<div class = 'col'><select name=\"payorcompanyid\" onchange=\"radioselect3()\" class='form-control'>";
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
		echo "</select></div></div> ";

		echo "<div class ='row mt-3  me-3'><div class = 'col-1 text-end px-0'><input id=\"radio4\" type=\"radio\" name=\"payorsw\" value=\"contactperson\"></div>";
		echo "<div class = 'col'><select name=\"payorcontactid\" onchange=\"radioselect4()\" class='form-control'>";
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
		echo "</select></div></div>";
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
		echo "";
    echo "<label for = 'select' class = 'mt-2'>Explanation</label><textarea rows=\"3\" cols=\"38\" name=\"explanation\" placeholder = 'Explanation here...' wrap=\"physical\" class='form-control'></textarea>";
    echo "<td class='py-3'><div class='text-end my-3'><input type=\"submit\" value=\"Save & continue\" class='btn text-white bg-success' role=\"button\" /></div></form>";
    echo "<td class='py-3'>";
  echo "";
?>
</div>



<!-- [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[cash reciept]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]] -->





<div id='journal' <?php echo "$jvdvstyle"; ?>>
<?php
  echo "<form action=\"finvouchjvnew.php?loginid=$loginid\" method=\"post\" name=\"form4\" class = 'shadow p-4 '>";
  echo "<h4 class = 'fw-semibold text-center'>Journal</h4>";

  echo "<label for='select'>Date</label>";

	echo "<input type='date' name=\"jvdate\" value=\"$datenow\" class=\"form-control\"	/>";
    echo "";

    //20230523 query latest jvnumber and increment by 1
    $res17query=""; $result17=""; $found17=0;
    $res17query="SELECT DISTINCT `journalnumber` FROM `tblfinjournal` WHERE `journalnumber` <> '' ORDER BY `date` DESC, `journalid` DESC, `journalnumber` DESC LIMIT 1";
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

    echo "";
    // echo "$journalnumber17, $arrjvn17: $arrjvn17fin0, $arrjvn17fin1, $arrjvn17fin2 res: $jvn17fin<br>";
    echo "<label for='select' class = 'mt-3'>Journal Voucher Number</label><input name=\"jvnumber\" value=\"$jvn17fin\" size=\"10\" class='form-control'>";

    echo "<label for = 'select' class = 'mt-2'>Explanation</label><textarea rows=\"3\" cols=\"38\" name=\"explanation\" placeholder=\"Journal Explanation...\" wrap=\"physical\" class='form-control'></textarea>";

    echo "<td class=''><div class='text-end my-3'><input type=\"submit\" value=\"Save & continue\" class='btn text-white bg-success' role=\"button\" /></div></form>";
   
?>
</div>




<?php

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


