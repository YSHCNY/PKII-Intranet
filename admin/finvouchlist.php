<?php 

require("db1.php");
include("datetimenow.php");
include ("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$radiochecked = (isset($_GET['rs'])) ? $_GET['rs'] :'';
$username = (isset($_POST['username'])) ? $_POST['username'] :'';
$password = (isset($_POST['password'])) ? $_POST['password'] :'';

$searchcv = (isset($_POST['searchcv'])) ? $_POST['searchcv'] :'';
$searchap = (isset($_POST['searchap'])) ? $_POST['searchap'] :'';
$searchcr = (isset($_POST['searchcr'])) ? $_POST['searchcr'] :'';
$searchjv = (isset($_POST['searchjv'])) ? $_POST['searchjv'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';
$yrmonthavlbl2 = (isset($_POST['yrmonthavlbl2'])) ? $_POST['yrmonthavlbl2'] :'';




$cvtype = (isset($_POST['cvtype'])) ? $_POST['cvtype'] :'';

$cvsearchtype = (isset($_POST['cvsearchtype'])) ? $_POST['cvsearchtype'] :'';

if($cvtype == '') { $cvtype = 'all'; }




if ($yrmonthavlbl2 == "" && $yrmonthavlbl == ""){

$date = new DateTime('first day of this month');
$yrmonthavlbl = $date->format('Y-m-d');

$date = new DateTime('last day of this month');
$yrmonthavlbl2 = $date->format('Y-m-d');


}


// echo "$yrmonthavlbl2--$yrmonthavlbl";



// icons

$searchicon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>';

$editicon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
</svg>';

$deleteicon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg>';

$vouchericon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
  <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
  <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
</svg>';
// icons

if($radiochecked == "") {
  $apchecked = "checked";
  $cvdvstyle = "style='display:none;'";
  $apdvstyle = "";
  $crdvstyle = "style='display:none;'";
  $jvdvstyle = "style='display:none;'";



 
} else if($radiochecked == "cv") {
  $cvchecked = "checked";
  $cvdvstyle = "";
  $apdvstyle = "style='display:none;'";
  $crdvstyle = "style='display:none;'";
  $jvdvstyle = "style='display:none;'";
} else if($radiochecked == "ap") {
  $apchecked = "checked";
  $cvdvstyle = "style='display:none;'";
  $apdvstyle = "";
  $crdvstyle = "style='display:none;'";
  $jvdvstyle = "style='display:none;'";
} else if($radiochecked == "cr") {
  $crchecked = "checked";
  $cvdvstyle = "style='display:none;'";
  $apdvstyle = "style='display:none;'";
  $crdvstyle = "";
  $jvdvstyle = "style='display:none;'";
} else if($radiochecked == "jv") {
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

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

?>


<style>

  
.vtitle:hover{
    transition: .2s;
    background-color: #ededed;
    color: rgb(83, 83, 83);
}


    .ahover{
        text-decoration: none !important;
        color: rgb(53, 54, 54) !important;
        transition: .2s;
    }

    .ahover:hover{
        color: rgb(36, 192, 44) !important;
    }


th{
    white-space: nowrap !important;
    text-align: center !important;
    color: grey !important;
  
  
  }
  
  td{
    padding: 10px !important;
  }

  table {
    width: 100% !important;
  }

  label:has(input[type="radio"]:checked) {
     background-color: #31b0d5 !important;
  color: rgb(228, 228, 228);
}
</style>
<script type="text/javascript">
function get_radio_value(val) {
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

<div class="">
	<a href="<?php echo 'finvouchmain.php?loginid=' . $loginid ?>" class="mainbtnclr text-white btn">
		Back
	</a>
</div>



  <div class="px-0 pt-4  m-2 border shadow ">
    <div class="mb-5 px-4">
  <h4 class = 'mb-0 fw-semibold'>PKII Voucher</h4>
  <p>View and Manage PKII voucher list</p>
  </div> 
    <form name="voucher" class="">
      <div class="d-flex justify-content-evenly align-content-center ">


<div class="border w-100 text-center p-0">
    <label class="vtitle d-flex align-items-center text-center w-100 h-100 m-0 py-3 <?= $active1 ?>" style="cursor: pointer;" id='labelView1'>
        <input class="visually-hidden" type='radio' name='type' value='acctspayable' onClick="get_radio_value(1); toggleActive(this);" <?php echo "$apchecked"; ?>>
        Accounts Payable
    </label>
</div>

<div class="border w-100 text-center p-0">
    <label class="vtitle d-flex align-items-center text-center w-100 h-100 m-0 py-3 <?= $active2 ?>" style="cursor: pointer;" id='labelView2'>
        <input class="visually-hidden" type='radio' name='type' value='checkvoucher' onClick="get_radio_value(2); toggleActive(this);" <?php echo "$cvchecked"; ?>>
        Check Voucher
    </label>
</div>

<div class="border w-100 text-center p-0">
    <label class="vtitle d-flex align-items-center text-center w-100 h-100 m-0 py-3 <?= $active3 ?>" style="cursor: pointer;" id='labelView3'>
        <input class="visually-hidden" type='radio' name='type' value='cashreceipt' onClick="get_radio_value(3); toggleActive(this);" <?php echo "$crchecked"; ?>>
        Cash Receipt
    </label>
</div>

<div class="border w-100 text-center p-0">
    <label class="vtitle d-flex align-items-center text-center w-100 h-100 m-0 py-3 <?= $active4 ?>" style="cursor: pointer;" id='labelView4'>
        <input class="visually-hidden" type='radio' name='type' value='journal' onClick="get_radio_value(4); toggleActive(this);" <?php echo "$jvchecked"; ?>>
        Journal
    </label>
</div>

      </div>
    </form>
  
    
      <div class = 'px-2' id='acctspayable' <?php echo "$apdvstyle"; ?>>
    <?php include "voucherAP.php"; ?>
  </div>

  <div class = 'mx-2' id='checkvoucher' <?php echo "$cvdvstyle"; ?>>
    <?php include "voucherCV.php"; ?>
  </div>

  <div class = 'mx-2' id='cashreceipt' <?php echo "$crdvstyle"; ?>>
    <?php include "voucherCR.php"; ?>
  </div>

  <div class = 'mx-2' id='journal' <?php echo "$jvdvstyle"; ?>>
    <?php include "voucherJ.php"; ?>
  </div>



  </div>






<script>
function toggleActive(radio) {
    // Remove active class from all labels
    document.querySelectorAll('[id^="labelView"]').forEach(label => {
        label.classList.remove('active-label');
    });
    
    // Add active class to the clicked label
    if (radio.checked) {
        radio.parentElement.classList.add('active-label');
    }
}

// Initialize active state on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[name="type"]').forEach(radio => {
        if (radio.checked) {
            radio.parentElement.classList.add('active-label');
        }
    });
});
</script>

<?php



    $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
