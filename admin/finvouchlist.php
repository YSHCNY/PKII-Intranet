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

$cvtype = (isset($_POST['cvtype'])) ? $_POST['cvtype'] :'';

$cvsearchtype = (isset($_POST['cvsearchtype'])) ? $_POST['cvsearchtype'] :'';

if($cvtype == '') { $cvtype = 'all'; }

if($yrmonthavlbl == '') {
  $selyear = $yearnow;
  $selmonth = date("F", mktime(0, 0, 0, $monthnow));
  $yrmonthavlbl = $selyear." ".$selmonth;
}

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

<div class="poppins text-center mb-5">
  <h2>PKII Voucher - List</h2>
</div>
<table class="poppins w-100">
  <div class="my-5 py-4 shadow rounded-3">
    <form name="voucher" class="d-none">
      <div class="d-flex justify-content-evenly align-content-center poppins">
        <div class="d-flex align-content-center gap-1">
          <input class="m-0" type='radio' name='type' value='acctspayable' onClick="get_radio_value(1);" <?php echo "$apchecked"; ?>>
          <label class="m-0 d-flex align-items-center text-black">Accounts Payable</label>
        </div>
        <div class="d-flex align-content-center gap-1">
          <input class="m-0" type='radio' name='type' value='checkvoucher' onClick="get_radio_value(2);" <?php echo "$cvchecked"; ?>>
          <label class="m-0 d-flex align-items-center text-black">Check Voucher</label>
        </div>

        <div class="d-flex align-content-center gap-1">
          <input class="m-0" type='radio' name='type' value='cashreceipt' onClick="get_radio_value(3);" <?php echo "$crchecked"; ?>>
          <label class="m-0 d-flex align-items-center text-black">Cash Receipt</label>
        </div>

        <div class="d-flex align-content-center gap-1">
          <input class="m-0" type='radio' name='type' value='journal' onClick="get_radio_value(4);" <?php echo "$jvchecked"; ?>>
          <label class="m-0 d-flex align-items-center text-black">Journal</label>
        </div>
      </div>
    </form>
  </div>

  <tr>
    <td colspan='4'>

  <div id='acctspayable' <?php echo "$apdvstyle"; ?>>
  <table class="w-100 table table-hover poppins shadow">
      <div class="d-flex justify-content-end align-items-center gap-4 mb-4">
      <div class="d-flex align-items-center gap-2">
        <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=ap" method="post" target="_self">
          <select name="yrmonthavlbl" class="poppins">
            <option>Year-Month</option>
            <?php
            $res11query = "SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfinacctspayable WHERE acctspayableid <> '' ORDER BY date DESC";
            $result11 = $dbh2->query($res11query);
            if ($result11->num_rows > 0) {
              while ($myrow11 = $result11->fetch_assoc()) {
                $yyyymonth = $myrow11['yyyymonth'];
                $yrmonthsel = ($yrmonthavlbl == $yyyymonth) ? "selected" : "";
                echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
              }
            }
            ?>
          </select>
          <input type="submit" value="Submit" role="button" class="btn btn-info btn-sm poppins">
        </form>
      </div>
      <div class="d-flex align-items-center gap-2">
        <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=ap" method="post" target="_self" name="search">
          <input name="searchap" size="20" value="<?php echo $searchap; ?>" class="poppins px-2">
          <input type="submit" value="Search" role="button" class="btn btn-info btn-sm poppins">
        </form>
      </div>
      </div>

<?php
  $debitmonthtot = 0; $creditmonthtot = 0;
?>
<thead class="table-dark">
  <tr>
    <th>Count</th>
    <th>Date</th>
    <th>A.P. No.</th>
    <th>Payee</th>
    <th>Explanation</th>
    <th>DebitTotal</th>
    <th>CreditTotal</th>
    <th>DueDate</th>
    <th>Status</th>
    <th colspan="2">Action</th>
  </tr>
</thead>
<?php
  $res11query = "SELECT DISTINCT acctspayablenumber, payee, due_date, date FROM tblfinacctspayable WHERE acctspayableid<>'' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, acctspayablenumber DESC";
  $result11=""; $found11=0;

  if($searchap != "") {

    $res14query = "(SELECT DISTINCT acctspayablenumber, date FROM tblfinacctspayable WHERE tblfinacctspayable.acctspayablenumber LIKE \"%$searchap%\" OR tblfinacctspayable.projcode LIKE \"%$searchap%\" OR tblfinacctspayable.particulars LIKE \"%$searchap%\" OR tblfinacctspayable.payee LIKE \"%$searchap%\") UNION (SELECT DISTINCT acctspayablenumber, date FROM tblfinacctspayabletot WHERE tblfinacctspayabletot.explanation LIKE \"%$searchap%\") ORDER BY date DESC";
    $result14=""; $found14=0;
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
    while($myrow14=$result14->fetch_assoc()) {
      $found14 = 1;
      $acctspayablenumber14 = $myrow14['acctspayablenumber'];

      $res11query = "SELECT DISTINCT acctspayablenumber, payee, due_date, date FROM tblfinacctspayable WHERE acctspayablenumber=\"$acctspayablenumber14\"";
      $result11=""; $found11=0;
      $result11=$dbh2->query($res11query);

  if($result11->num_rows>0) {
  while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $acctspayablenumber11 = $myrow11['acctspayablenumber'];
    $payee11 = $myrow11['payee'];
    $date11 = $myrow11['date'];
    $duedate11 = $myrow11['due_date'];

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $res12query = "SELECT explanation, debittot, credittot, status FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $explanation12 = $myrow12['explanation']; //20230522
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;
?>

<tr>
  <td align="center"><?php echo $count1; ?></td>
  <td><?php echo $date11; ?></td>
  <td><a href="finvouchapview.php?loginid=<?php echo $loginid; ?>&apn=<?php echo $acctspayablenumber11; ?>" target="_blank"><b><?php echo $acctspayablenumber11; ?></b></a></td>
  <td><a href="finvouchapview.php?loginid=<?php echo $loginid; ?>&apn=<?php echo $acctspayablenumber11; ?>" target="_blank"><?php echo $payee11; ?></a></td>
  <td><?php echo $explanation12; ?></td>
</tr>

<?php
    if($debittot12 != $credittot12) {
      echo "<td style=\"text-align: right;\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td style=\"text-align: right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td style=\"text-align: right;\">".number_format($debittot12, 2)."</td><td style=\"text-align: right\">".number_format($credittot12, 2)."</td>";
    }

    $statusdone=0;
    if(preg_match("/Done/i", $status12)) {
		  $statusdone=1; $status12="Done";
    }
    if($statusdone==1) {
      echo "<td style=\"text-align: right;>".date('Y-M-d', strtotime($duedate11))."</td>";		
    }

	if(strtotime($datenow) > strtotime($duedate11)) {
    echo "<td style=\"text-align: right; color: red\">".date('Y-M-d', strtotime($duedate11))."</td>";				
	} else {
    echo "<td style=\"text-align: right; color: green\">".date('Y-M-d', strtotime($duedate11))."</td>";		
	}
    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 != "") {
      echo "<td>$status12</td>";
    } else {
      $status12 = '';
      echo "<td>$status12</td>";
    }

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td colspan='2' align='center'><a href=\"finvouchmakecv.php?loginid=$loginid&apn=$acctspayablenumber11&duedate=$duedate11&payee=$payee11\" class=\"btn btn-primary btn-sm\" role=\"button\" />Make CV</a></td>";
      } else if($status12 == "cancelled") {
        echo "<td align='center'><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-danger btn-sm\" role=\"button\" />Del</a></td>";
        echo "<td></td>";
      } else {
        echo "<td align='center'><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-danger btn-sm\" role=\"button\" />Del</a></td>";
        echo "<td align='center'><a href=\"finvouchapnew.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-warning btn-sm\" role=\"button\" />Edit</a></td>";
      }
    }
    echo "</tr>";
  }
  }
    }
    }
  }

  $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
  while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $acctspayablenumber11 = $myrow11['acctspayablenumber'];
    $payee11 = $myrow11['payee'];
    $date11 = $myrow11['date'];
    $duedate11 = $myrow11['due_date'];  

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $res12query = "SELECT explanation, debittot, credittot, status FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber11\"";
    $result12="";
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $explanation12 = $myrow12['explanation']; //20230522
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count1</td><td>$date11</td><td><a href=\"finvouchapview.php?loginid=$loginid&apn=$acctspayablenumber11\" target=\"_blank\"><b>$acctspayablenumber11</b></a></td><td><a href=\"finvouchapview.php?loginid=$loginid&apn=$acctspayablenumber11\" target=\"_blank\">$payee11</a></td>";

    echo "<td>$explanation12</td>"; //20230522

    if($debittot12 != $credittot12) {
      echo "<td style=\"text-align: right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td style=\"text-align: right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td style=\"text-align:right\">".number_format($debittot12, 2)."</td><td style=\"text-align:right\">".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)

    $statusdone=0;
    if(preg_match("/Done/i", $status12)) {
		$statusdone=1; $status12="Done";
	} //if
	if($statusdone==1) {
    echo "<td style=\"text-align: right;>".date('Y-M-d', strtotime($duedate11))."</td>";		
	} //if

	if(strtotime($datenow) > strtotime($duedate11)) {
    echo "<td style=\"text-align: right; color: red\">".date('Y-M-d', strtotime($duedate11))."</td>";				
	} else {
    echo "<td style=\"text-align: right; color: green\">".date('Y-M-d', strtotime($duedate11))."</td>";		
	} //if-else		

    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 != "") {
      echo "<td>$status12</td>";
    } else {
      $status12 = '';
      echo "<td>$status12</td>";
    } // if($status12 == "cancelled")
	
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td colspan='2' align='center'><a href=\"finvouchmakecv.php?loginid=$loginid&apn=$acctspayablenumber11&duedate=$duedate11&payee=$payee11\" class=\"btn btn-primary btn-sm\" role=\"button\" />Make CV</a></td>";
      } else if($status12 == "cancelled") {
        echo "<td align='center'><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-danger btn-sm\" role=\"button\" />Del</a></td>";
        echo "<td></td>";
      } else {
        echo "<td align='center'><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-danger btn-sm\" role=\"button\" />Del</a></td>";
        echo "<td align='center'><a href=\"finvouchapnew.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-warning btn-sm\" role=\"button\" />Edit</a></td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
  } // while($myrow11=$result11->fetch_assoc())
  } // if($result11->num_rows>0)
  if($debitmonthtot != 0 && $creditmonthtot != 0) {
    echo "<tr><td colspan=\"5\" align=\"right\"><b>Total</b></td>";
	if(round($debitmonthtot,2)==round($creditmonthtot,2)) {
	echo "<td style=\"text-align: right; color: green\"><strong>".number_format($debitmonthtot,2)."</strong></td><td style=\"text-align: right; color: green\"><strong>".number_format($creditmonthtot,2)."</strong></td>";
	} else {
	echo "<td style=\"text-align: right; color: red\"><strong>".number_format($debitmonthtot,2)."</strong></td><td style=\"text-align: right; color: red\"><strong>".number_format($creditmonthtot,2)."</strong></td>";		
	} //if-else
	echo "<td colspan=\"4\">&nbsp;</td></tr>";
  } // if($debitmonthtot != 0 && $creditmonthtot != 0)
  echo "</table>";
?>
</div>

<div id='checkvoucher' <?php echo "$cvdvstyle"; ?>>

<table class="table table-hover shadow poppins">
      <div class="d-flex justify-content-end align-items-center gap-4 mb-4">
            <div>
            <form action="finvouchlist.php?loginid=<?= $loginid ?>&rs=cv" method="post" target="_self" name="dropdown">
              <select name="yrmonthavlbl" class="poppins">
                <option>Year-Month</option>
                <?php
                $res11query = "SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfindisbursement WHERE disbursementid <> '' GROUP BY disbursementnumber ORDER BY date DESC";
                $result11 = "";
                $found11 = 0;
                $ctr11 = 0;
                $result11 = $dbh2->query($res11query);
                if ($result11->num_rows > 0) {
                  while ($myrow11 = $result11->fetch_assoc()) {
                    $found11 = 1;
                    $yyyymonth = $myrow11['yyyymonth'];
                    $yrmonthsel = ($yrmonthavlbl == $yyyymonth) ? "selected" : "";
                ?>
                    <option value="<?= $yyyymonth ?>" <?= $yrmonthsel ?>><?= $yyyymonth ?></option>
                <?php
                  }
                }
                ?>
              </select>
              <?php
              $cvtypeall = "";
              $cvtypecv = "";
              $cvtypedm = "";
              switch ($cvtype) {
                case 'all':
                  $cvtypeall = "selected";
                  break;
                case 'cv':
                  $cvtypecv = "selected";
                  break;
                case 'dm':
                  $cvtypedm = "selected";
                  break;
              }
              ?>
              <select name="cvtype" class="poppins">
                <option value="all" <?= $cvtypeall ?>>All CV</option>
                <option value="cv" <?= $cvtypecv ?>>Check Voucher</option>
                <option value="dm" <?= $cvtypedm ?>>Debit Memo</option>
              </select>
              <input type="submit" value="Submit" role="button" class="btn btn-info btn-sm poppins">
            </form>
            </div>

          <!-- Search CV Module -->
          <div>
          <form action="finvouchlist.php?loginid=<?= $loginid ?>&rs=cv" method="post" target="_self" name="search">
              <input name="searchcv" size="20" value="<?= $searchcv ?>" class="poppins px-2">
              <select name="cvsearchtype" class="poppins">
                <option value="any" <?= $cvsrchtypany ?>>any</option>
                <option value="payee" <?= $cvsrchtyppayee ?>>payee/payor</option>
                <option value="projcode" <?= $cvsrchtypprojcd ?>>proj_code</option>
                <option value="particulars" <?= $cvsrchtypparti ?>>particulars</option>
                <option value="explanation" <?= $cvsrchtypexpla ?>>explanation</option>
              </select>
              <input type="submit" value="Search" role="button" class="btn btn-info btn-sm poppins">
          </form>
          </div>
      </div>

<?php
  
  $debitmonthtot = 0; $creditmonthtot = 0;
?>
  <thead class="table-dark">
    <tr>
      <th>Count</th>
      <th>Date</th>
      <th>C.V. No.</th>
      <th>Payee</th>
      <th>Particulars</th>
      <th>DebitTotal</th>
      <th>CreditTotal</th>
      <th>Status</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
<?php
  if($cvtype == 'all') {
      $res11query = "SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid, explanation FROM tblfindisbursement WHERE disbursementid<>'' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" GROUP BY disbursementnumber ORDER BY date DESC, disbursementnumber DESC";
  } else if($cvtype == 'cv') {
      $res11query = "SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid, explanation FROM tblfindisbursement WHERE disbursementid<>'' AND disbursementnumber NOT LIKE '%DM%' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" GROUP BY disbursementnumber ORDER BY date DESC, disbursementnumber DESC";
  } else if($cvtype == 'dm') {
      $res11query = "SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid, explanation FROM tblfindisbursement WHERE disbursementid<>'' AND disbursementnumber LIKE '%DM%' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" GROUP BY disbursementnumber ORDER BY date DESC, disbursementnumber DESC";
  } // if($cvtype == 'all')

  if($searchcv != "") {
//    $result11 = mysql_query("SELECT DISTINCT tblfindisbursement.disbursementnumber, tblfindisbursement.disbursementtype, tblfindisbursement.payee, tblfindisbursement.date FROM tblfindisbursement LEFT JOIN tblfindisbursementtot ON tblfindisbursement.disbursementnumber = tblfindisbursementtot.disbursementnumber WHERE tblfindisbursement.disbursementnumber LIKE \"%$searchcv%\" OR tblfindisbursement.projcode LIKE \"%$searchcv%\" OR tblfindisbursement.particulars LIKE \"%$searchcv%\" OR tblfindisbursement.payee LIKE \"%$searchcv%\" OR tblfindisbursementtot.explanation LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC, tblfindisbursement.disbursementnumber DESC", $dbh);
    if($cvsearchtype == "any") {
    $res14query = "SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement LEFT JOIN tblcontact ON tblfindisbursement.contactid=tblcontact.contactid LEFT JOIN tblcompany ON tblfindisbursement.companyid=tblcompany.companyid WHERE tblfindisbursement.disbursementnumber LIKE \"%$searchcv%\" OR tblfindisbursement.projcode LIKE \"%$searchcv%\" OR tblfindisbursement.particulars LIKE \"%$searchcv%\" OR tblcompany.company LIKE \"%$searchcv%\" OR tblcontact.name_last LIKE \"%$searchcv%\" OR tblcontact.name_first LIKE \"%$searchcv%\" OR tblcontact.name_middle LIKE \"%$searchcv%\" OR tblfindisbursement.payee LIKE \"%$searchcv%\" OR tblfindisbursement.explanation LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC";
    } else if($cvsearchtype == "payee") {
    $res14query = "SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement LEFT JOIN tblcontact ON tblfindisbursement.contactid=tblcontact.contactid LEFT JOIN tblcompany ON tblfindisbursement.companyid=tblcompany.companyid WHERE tblcompany.company LIKE \"%$searchcv%\" OR tblcontact.name_last LIKE \"%$searchcv%\" OR tblcontact.name_first LIKE \"%$searchcv%\" OR tblcontact.name_middle LIKE \"%$searchcv%\" OR tblfindisbursement.payee LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC LIMIT 50";
    } else if($cvsearchtype == "projcode") {
    $res14query = "SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement WHERE tblfindisbursement.projcode LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC";
    } else if($cvsearchtype == "particulars") {
    $res14query = "SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement WHERE tblfindisbursement.particulars LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC";
    } else if($cvsearchtype == "explanation") {
    $res14query = "SELECT DISTINCT tblfindisbursement.disbursementnumber FROM tblfindisbursement WHERE tblfindisbursement.explanation LIKE \"%$searchcv%\" ORDER BY tblfindisbursement.date DESC";
    } // if($cvsearchtype == "any")
    $result14="";
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
      while($myrow14=$result14->fetch_assoc()) {
  $found14 = 1;
  $disbursementnumber14 = $myrow14['disbursementnumber'];

  $res11query = "SELECT DISTINCT tblfindisbursement.disbursementnumber, tblfindisbursement.disbursementtype, tblfindisbursement.date, tblfindisbursement.companyid, tblfindisbursement.contactid, tblfindisbursement.explanation FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber14\" ORDER BY date DESC, disbursementnumber DESC";
  $result11=""; $found11=0; $ctr11=0;
  $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
    while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $disbursementnumber11 = $myrow11['disbursementnumber'];
    $disbursementtype11 = $myrow11['disbursementtype'];
    // $payee11 = $myrow11[2];
    $date11 = $myrow11['date'];
    $companyid11 = $myrow11['companyid'];
    $contactid11 = $myrow11['contactid'];
    $explanation11 = $myrow11['explanation'];

    if(($companyid11 != "") || ($companyid11 != 0)) {
      $res11aquery = "SELECT company, branch FROM tblcompany WHERE companyid=$companyid11";
      $result11a=""; $found11a=0; $ctr11a=0;
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a = 1;
        $company11a = $myrow11a['company'];
        $branch11a = $myrow11a['branch'];
        } // while($myrow11a=$result11a->fetch_assoc())
      } // if($result11a->num_rows>0)
    } // if(($companyid11 != "") || ($companyid11 != 0))
    if(($contactid11 != "") || ($contactid11 != 0)) {
      $res11bquery = "SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid11";
      $result11b=""; $found11b=0; $ctr11b=0;
      $result11b=$dbh2->query($res11bquery);
      if($result11b->num_rows>0) {
        while($myrow11b=$result11b->fetch_assoc()) {
        $found11b = 1;
        $companyid11b = $myrow11b['companyid'];
        $employeeid11b = $myrow11b['employeeid'];
        $name_last11b = $myrow11b['name_last'];
        $name_first11b = $myrow11b['name_first'];
        $name_middle11b = $myrow11b['name_middle'];
        } // while($myrow11b=$result11b->fetch_assoc())
      } // if($result11b->num_rows>0)
    } // if(($contactid11 != "") || ($contactid11 != 0))
    // get old payee entry
    $res11bquery = "SELECT payee FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (payee<>'' OR payee IS NOT NULL)";
    $result11b=""; $found11b=0;
    $result11b=$dbh2->query($res11bquery);
    if($result11b->num_rows>0) {
      while($myrow11b=$result11b->fetch_assoc()) {
      $found11b = 1;
      $payee11b = $myrow11b['payee'];
      } // while($myrow11b=$result11b->fetch_assoc())
    } // if($result11b->num_rows>0)

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $res12query = "SELECT debittot, credittot, status FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count1</td><td>".date("Y-M-d", strtotime($date11))."</td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\"><b>$disbursementnumber11</b></a></td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\">";
    // echo "$payee11";
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
    echo "</a></td>";
    echo "<td>".nl2br($explanation11)."</td>";
    // echo "<td>$disbursementtype11</td>";
    if($debittot12 != $credittot12) {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)
    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 != "") {
      echo "<td>$status12</td>";
    } else {
      $status12 = '';
      echo "<td>$status12</td>";
    } // if($status12 == "cancelled")
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td></td>";
      } else {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td><a href=\"finvouchcvnew.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-warning btn-sm'>Edit</td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
    $companyid11=0; $contactid11=0; $payee11b="";
    } // while($myrow11=$result11->fetch_assoc())
  } // if($result11->num_rows>0)
      } // while($myrow14 = mysql_fetch_row($result14))
    } // if($result14 != "")
  } // if($searchcv != "")
  //
  // End Search CV Module
  //

  $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
  while($myrow11=$result11->fetch_assoc()) {
    /*
    $found11 = 1;
    $disbursementnumber11 = $myrow11[0];
    $disbursementtype11 = $myrow11[1];
    // $payee11 = $myrow11[2];
    $date11 = $myrow11[2];
    $companyid11 = $myrow11[3];
    $contactid11 = $myrow11[4];
    */
    $disbursementnumber11 = $myrow11['disbursementnumber'];
    $disbursementtype11 = $myrow11['disbursementtype'];
    // $payee11 = $myrow11[2];
    $date11 = $myrow11['date'];
    $companyid11 = $myrow11['companyid'];
    $contactid11 = $myrow11['contactid'];
    $explanation11 = $myrow11['explanation'];


    if(($companyid11 != "") || ($companyid11 != 0)) {
      $res11aquery = "SELECT company, branch FROM tblcompany WHERE companyid=$companyid11";
      $result11a=""; $found11a=0; $ctr11a=0;
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a = 1;
        $company11a = $myrow11a['company'];
        $branch11a = $myrow11a['branch'];
        } // while($myrow11a=$result11a->fetch_assoc())
      } // if($result11a->num_rows>0)
    } // if(($companyid11 != "") || ($companyid11 != 0))
    if(($contactid11 != "") || ($contactid11 != 0)) {
      $res11bquery = "SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid11";
      $result11b=""; $found11b=0; $ctr11b=0;
      $result11b=$dbh2->query($res11bquery);
      if($result11b->num_rows>0) {
        while($myrow11b=$result11b->fetch_assoc()) {
        $found11b = 1;
        $companyid11b = $myrow11b['companyid'];
        $employeeid11b = $myrow11b['employeeid'];
        $name_last11b = $myrow11b['name_last'];
        $name_first11b = $myrow11b['name_first'];
        $name_middle11b = $myrow11b['name_middle'];
        } // while($myrow11b=$result11b->fetch_assoc())
      } // if($result11b->num_rows>0)
    } // if(($contactid11 != "") || ($contactid11 != 0))

    // get old payee entry
    $res11bquery=""; $result11b=""; $found11b=0;
    $res11bquery = "SELECT payee FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber11\" AND (payee<>'' OR payee IS NOT NULL)";
    $result11b=$dbh2->query($res11bquery);
    if($result11b->num_rows>0) {
      while($myrow11b=$result11b->fetch_assoc()) {
      $found11b = 1;
      $payee11b = $myrow11b['payee'];
      } // while($myrow11b=$result11b->fetch_assoc())
    } // if($result11b->num_rows>0)

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $res12query = "SELECT debittot, credittot, status FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count1</td><td>".date("Y-M-d", strtotime($date11))."</td><td><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\"><b>$disbursementnumber11</b></a></td><td>";
    echo "<a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\">";
    if(($companyid11 != "") || ($companyid11 != 0)) {
      echo "<b>$company11a";
      if($branch11a != "") { echo "&nbsp;-&nbsp;$branch11a"; }
      echo "</b>";
    } // if(($companyid11 != "") || ($companyid11 != 0))
    if(($contactid11 != "") || ($contactid11 != 0)) {
      echo "<b>$name_first11b";
      if($name_middle11b != "") { echo "&nbsp;$name_middle11b[0]."; }
      echo "&nbsp;$name_last11b";
      echo "</b>";
    } // if(($contactid11 != "") || ($contactid11 != 0))
    if((($companyid11 == "") && ($contactid11 == "")) || (($companyid11 == 0) &&  ($contactid11 == 0))) {
      echo "<i>$payee11b</i>";
    } // if((($companyid11 == "") && ($contactid11 == "")) || (($companyid11 == 0) &&  ($contactid11 == 0)))
    // echo "$payee11";
    echo "</a></td>";
    echo "<td>".nl2br($explanation11)."</td>";
    // echo "<td>$disbursementtype11</td>";
    if($debittot12 != $credittot12) {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)
    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 != "") {
      echo "<td>$status12</td>";
    } else {
      $status12 = '';
      echo "<td>$status12</td>";
    } // if($status12 == "cancelled")
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td></td>";
      } else {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td><a href=\"finvouchcvnew.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-warning btn-sm'>Edit</td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
    // reset variables
    $company11a=""; $branch11a=""; $companyid11b=""; $employeeid11b=""; $name_last11b=""; $name_first11b=""; $name_middle11b=""; $payee11b="";
  } // while($myrow11=$result11->fetch_assoc())
  } // if($result11->num_rows>0)
  if($debitmonthtot != 0 && $creditmonthtot != 0) {
    echo "<tr><td colspan=\"5\" align=\"right\"><b>Total ";
    if($cvtype != 'all') { echo "".strtoupper($cvtype).""; }
    echo "</b></td><td><b>".number_format($debitmonthtot,2)."</b></td><td><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"3\">&nbsp;</td></tr>";
  } // if($debitmonthtot != 0 && $creditmonthtot != 0)
 // echo "<form action=\"finvouchlistcv.php?loginid=$loginid\" method=\"post\">";
 // echo "<tr><td colspan=\"8\" align=\"center\"><input type=\"submit\" value=\"Display\"></form></td></tr>";
  echo "</table>";
?>
</div>

<div id='cashreceipt' <?php echo "$crdvstyle"; ?>>

<table class="table table-hover shadow poppins">

    <div class="d-flex align-content-center justify-content-end gap-4 mb-4">
      <div class="d-flex align-content-center gap-2 h-50">
          <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=cr" method="post" target="_self">
              <select name="yrmonthavlbl" class="poppins">
                <option>Year-Month</option>
                <?php
                $res11query = "SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfincashreceipt WHERE cashreceiptid <> '' ORDER BY date DESC";
                $result11 = "";
                $found11 = 0;
                $result11 = $dbh2->query($res11query);
                if ($result11->num_rows > 0) {
                  while ($myrow11 = $result11->fetch_assoc()) {
                    $found11 = 1;
                    $yyyymonth = $myrow11['yyyymonth'];
                    if ($yrmonthavlbl == "$yyyymonth") {
                      $yrmonthsel = "selected";
                    } else {
                      $yrmonthsel = "";
                    }
                ?>
                    <option value="<?php echo $yyyymonth; ?>" <?php echo $yrmonthsel; ?>><?php echo $yyyymonth; ?></option>
                <?php
                  }
                }
                ?>
              </select>
              <input type="submit" value="Submit" role='button' class='btn btn-info btn-sm poppins'>
          </form>
      </div>
      <div class="d-flex align-content-center gap-2 h-50">
          <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=cr" method="post" target="_self" name="search">
              <input name="searchcr" size="20" value="<?php echo $searchcr; ?>" class="poppins px-2">
              <input type="submit" value="Search" role='button' class='btn btn-info btn-sm poppins'>
          </form>
      </div>
    </div>

<?php

  $debitmonthtot = 0; $creditmonthtot = 0;
?>
<thead class="table-dark">
  <tr>
    <th>Count</th>
    <th>Date</th>
    <th>C.R. No.</th>
    <th>Received from</th>
    <th>Particulars</th>
    <th>DebitTotal</th>
    <th>CreditTotal</th>
    <th>Status</th>
    <th colspan="2">Action</th>
  </tr>
</thead>
<?php
  $res11query = "SELECT DISTINCT cashreceiptnumber, date, companyid, contactid, explanation FROM tblfincashreceipt WHERE cashreceiptid<>'' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, cashreceiptnumber DESC";
  $result11="";
  if($searchcr != "") {
//    $result11 = mysql_query("SELECT DISTINCT tblfincashreceipt.cashreceiptnumber, tblfincashreceipt.date FROM tblfincashreceipt LEFT JOIN tblfincashreceipttot ON tblfincashreceipt.cashreceiptnumber = tblfincashreceipttot.cashreceiptnumber WHERE tblfincashreceipt.cashreceiptnumber LIKE \"%$searchcr\" OR tblfincashreceipt.projcode LIKE \"%$searchcr%\" OR tblfincashreceipt.particulars LIKE \"%$searchcr%\" OR tblfincashreceipttot.explanation LIKE \"%$searchcr%\" ORDER BY tblfincashreceipt.date DESC, tblfincashreceipt.cashreceiptnumber DESC LIMIT 0, 100", $dbh);

    $res14query = "(SELECT DISTINCT tblfincashreceipt.cashreceiptnumber FROM tblfincashreceipt LEFT JOIN tblcontact ON tblfincashreceipt.contactid=tblcontact.contactid LEFT JOIN tblcompany ON tblfincashreceipt.companyid=tblcompany.companyid WHERE tblfincashreceipt.cashreceiptnumber LIKE \"%$searchcr\" OR tblcompany.company LIKE \"%$searchcr%\" OR tblcontact.name_last LIKE \"%$searchcr%\" OR tblcontact.name_first LIKE \"%$searchcr%\" OR tblcontact.name_middle LIKE \"%$searchcr%\" OR tblfincashreceipt.payor LIKE \"%$searchcr%\" OR tblfincashreceipt.projcode LIKE \"%$searchcr%\" OR tblfincashreceipt.particulars LIKE \"%$searchcr%\" OR tblfincashreceipt.explanation LIKE \"%$searchcr%\") UNION (SELECT DISTINCT cashreceiptnumber FROM tblfincashreceipttot WHERE tblfincashreceipttot.explanation LIKE \"%$searchcr%\")";
    $result14=""; $found14=0;
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
    while($myrow14=$result14->fetch_assoc()) {
      $found14 = 1;
      $cashreceiptnumber14 = $myrow14['cashreceiptnumber'];

      $res11query = "SELECT DISTINCT cashreceiptnumber, payor, date, companyid, contactid FROM tblfincashreceipt WHERE cashreceiptnumber=\"$cashreceiptnumber14\" ORDER BY date DESC";
      $result11=""; $found11=0; $ctr11=0;
      $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
  while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $cashreceiptnumber11 = $myrow11['cashreceiptnumber'];
    $payor11 = $myrow11['payor'];
    $date11 = $myrow11['date'];
    $companyid11 = $myrow11['companyid'];
    $contactid11 = $myrow11['contactid'];

    if(($companyid11 != "") || ($companyid11 != 0)) {
      $res11aquery = "SELECT company, branch FROM tblcompany WHERE companyid=$companyid11";
      $result11a=""; $found11a=0; $ctr11a=0;
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a = 1;
        $company11a = $myrow11a['company'];
        $branch11a = $myrow11a['branch'];
        } // while($myrow11a=$result11a->fetch_assoc())
      } // if($result11a->num_rows>0)
    } // if(($companyid11 != "") || ($companyid11 != 0))
    if(($contactid11 != "") || ($contactid11 != 0)) {
      $res11bquery = "SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid11";
      $result11b=""; $found11b=0; $ctr11b=0;
      $result11b=$dbh2->query($res11bquery);
      if($result11b->num_rows>0) {
        while($myrow11b=$result11b->fetch_assoc()) {
        $found11b = 1;
        $companyid11b = $myrow11b['companyid'];
        $employeeid11b = $myrow11b['employeeid'];
        $name_last11b = $myrow11b['name_last'];
        $name_first11b = $myrow11b['name_first'];
        $name_middle11b = $myrow11b['name_middle'];
        } // while($myrow11b=$result11b->fetch_assoc())
      } // if($result11b->num_rows>0)
    } // if(($contactid11 != "") || ($contactid11 != 0))
    // get old payor value
    $res11bquery = "SELECT payor FROM tblfincashreceipt WHERE cashreceiptnumber=\"$cashreceiptnumber11\" AND (payor<>'' OR payor IS NOT NULL)";
    $result11b=""; $found11=0;
    $result11b=$dbh2->query($res11bquery);
    if($result11b->num_rows>0) {
      while($myrow11b=$result11b->fetch_assoc()) {
      $found11b = 1;
      $payor11b = $myrow11b['payor'];
      } // while($myrow11b=$result11b->fetch_assoc())
    } // if($result11b->num_rows>0)

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $res12query = "SELECT debittot, credittot, status FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$cashreceiptnumber11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

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

    if($debittot12 != $credittot12) {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)

    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 <> "") {
      echo "<td>$status12</td>";
    } else {
      $status = '';
      echo "<td>$status12</td>";
    } // if($status12 == "cancelled")

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td></td>";
      } else {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td><a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-warning btn-sm'>Edit</td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
  } // while($myrow11=$result11->fetch_assoc())
  } // if($result11->num_rows>0)
    } // while($myrow14=$result14->fetch_assoc())
    } // if($result14->num_rows>0)
  } // if($searchcr != "")
  //
  // End Search module for CRV
  //

  $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
  while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $cashreceiptnumber11 = $myrow11['cashreceiptnumber'];
    // $payor11 = $myrow11[1];
    $date11 = $myrow11['date'];
    $companyid11 = $myrow11['companyid'];
    $contactid11 = $myrow11['contactid'];
    $explanation11 = $myrow11['explanation'];

    if(($companyid11 != "") || ($companyid11 != 0)) {
      $res11aquery = "SELECT company, branch FROM tblcompany WHERE companyid=$companyid11";
      $result11a=""; $found11a=0; $ctr11a=0;
      $result11a=$dbh2->query($res11aquery);
      if($result11a->num_rows>0) {
        while($myrow11a=$result11a->fetch_assoc()) {
        $found11a = 1;
        $company11a = $myrow11a['company'];
        $branch11a = $myrow11a['branch'];
        } // while($myrow11a=$result11a->fetch_assoc())
      } // if($result11a->num_rows>0)
    } // if(($companyid11 != "") || ($companyid11 != 0))
    if(($contactid11 != "") || ($contactid11 != 0)) {
      $res11bquery = "SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid11";
      $result11b=""; $found11b=0; $ctr11b=0;
      $result11b=$dbh2->query($res11bquery);
      if($result11b->num_rows>0) {
        while($myrow11b=$result11b->fetch_assoc()) {
        $found11b = 1;
        $companyid11b = $myrow11b['companyid'];
        $employeeid11b = $myrow11b['employeeid'];
        $name_last11b = $myrow11b['name_last'];
        $name_first11b = $myrow11b['name_first'];
        $name_middle11b = $myrow11b['name_middle'];
        } // while($myrow11b=$result11b->fetch_assoc())
      } // if($result11b->num_rows>0)
    } // if(($contactid11 != "") || ($contactid11 != 0))
    // get old payor value
    $res11bquery = "SELECT payor FROM tblfincashreceipt WHERE cashreceiptnumber=\"$cashreceiptnumber11\" AND (payor<>'' OR payor IS NOT NULL)";
    $result11b=""; $found11=0;
    $result11b=$dbh2->query($res11bquery);
    if($result11b->num_rows>0) {
      while($myrow11b=$result11b->fetch_assoc()) {
      $found11b = 1;
      $payor11b = $myrow11b['payor'];
      } // while($myrow11b=$result11b->fetch_assoc())
    } // if($result11b->num_rows>0)

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $res12query = "SELECT debittot, credittot, status FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$cashreceiptnumber11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

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

    echo "<td>".nl2br($explanation11)."</td>";

    if($debittot12 != $credittot12) {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)

    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 <> "") {
      echo "<td>$status12</td>";
    } else {
      $status = '';
      echo "<td>$status12</td>";
    } // if($status12 == "cancelled")

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td></td>";
      } else {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td><a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-warning btn-sm'>Edit</td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
    // reset variables
    $company11a=""; $branch11a=""; $companyid11b=""; $employeeid11b=""; $name_last11b=""; $name_first11b=""; $name_middle11b=""; $payor11b="";
  } // while($myrow11=$result11->fetch_assoc())
  } // if($result11->num_rows>0)
  if($debitmonthtot != 0 && $creditmonthtot != 0) {
    echo "<tr><td colspan=\"5\" align=\"right\"><b>Total</b></td><td align=\"right\"><b>".number_format($debitmonthtot,2)."</b></td><td align=\"right\"><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"4\">&nbsp;</td></tr>";
  } // if($debitmonthtot != 0 && $creditmonthtot != 0)
//  echo "<form action=\"finvouchlistcrv.php?loginid=$loginid\" method=\"post\">";
//  echo "<tr><td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Display\"></form></td></tr>";
  echo "</table>";
?>
</div>

<div id='journal' <?php echo "$jvdvstyle"; ?>>

<table class="table table-hover shadow poppins">
      <div class="d-flex align-content-center justify-content-end gap-4 mb-4">
        <div class="d-flex align-content-center gap-2 h-50>
          <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=jv" method="post" tartget="_self">
              <select name="yrmonthavlbl" class="poppins">
                <option>Year-Month</option>
                <?php
                $res11query = "SELECT DISTINCT DATE_FORMAT(date, '%Y %M') as yyyymonth FROM tblfinjournal WHERE journalid <> '' ORDER BY date DESC";
                $result11 = "";
                $result11 = $dbh2->query($res11query);
                if ($result11->num_rows > 0) {
                  while ($myrow11 = $result11->fetch_assoc()) {
                    $found11 = 1;
                    $yyyymonth = $myrow11['yyyymonth'];
                    if ($yrmonthavlbl == "$yyyymonth") {
                      $yrmonthsel = "selected";
                    } else {
                      $yrmonthsel = "";
                    }
                ?>
                    <option value="<?php echo $yyyymonth; ?>" <?php echo $yrmonthsel; ?>><?php echo $yyyymonth; ?></option>
                <?php
                  } // if($result11->num_rows>0)
                } // while($myrow11=$result11->fetch_assoc())
                ?>
              </select>
              <input type="submit" value="Submit" role='button' class='btn btn-info btn-sm poppins'>
          </form>
        </div>
        <div class="d-flex align-content-center gap-2 h-50>
          <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=jv" method="post" target="_self" name="search">
              <input name="searchjv" size="20" value="<?php echo $searchjv; ?>" class="poppins px-2">
              <input type="submit" value="Search" role='button' class='btn btn-info btn-sm poppins'>
          </form>
        </div>
      </div>

<?php

  $debitmonthtot = 0; $creditmonthtot = 0;
?>
<thead class="table-dark">
  <tr>
    <th>Count</th>
    <th>Date</th>
    <th>J.V. No.</th>
    <th>DebitTotal</th>
    <th>CreditTotal</th>
    <th>Status</th>
    <th colspan="2">Action</th>
  </tr>
</thead>
<?php
  $res11query = "SELECT DISTINCT journalnumber, date FROM tblfinjournal WHERE journalid<>'' AND DATE_FORMAT(date, '%Y %M') = \"$yrmonthavlbl\" ORDER BY date DESC, journalnumber DESC";
  $result11="";

  if($searchjv != "") {
//    $result11 = mysql_query("SELECT DISTINCT tblfinjournal.journalnumber, tblfinjournal.date FROM tblfinjournal LEFT JOIN tblfinjournaltot ON tblfinjournal.journalnumber = tblfinjournaltot.journalnumber WHERE tblfinjournal.journalnumber LIKE \"%$searchjv%\" OR tblfinjournal.projcode LIKE \"%$searchjv%\" OR tblfinjournal.particulars LIKE \"%$searchjv%\" OR tblfinjournaltot.explanation LIKE \"%$searchjv%\" ORDER BY tblfinjournal.date DESC, tblfinjournal.journalnumber DESC", $dbh);
    $res14query = "(SELECT DISTINCT journalnumber FROM tblfinjournal WHERE tblfinjournal.journalnumber LIKE \"%$searchjv%\" OR tblfinjournal.projcode LIKE \"%$searchjv%\" OR tblfinjournal.particulars LIKE \"%$searchjv%\") UNION (SELECT DISTINCT journalnumber FROM tblfinjournaltot WHERE tblfinjournaltot.explanation LIKE \"%$searchjv%\")";
    if($result14->num_rows>0) {
    while($myrow14=$result14->fetch_assoc()) {
      $found14 = 1;
      $journalnumber14 = $myrow14['journalnumber'];

      $res11query = "SELECT DISTINCT journalnumber, date FROM tblfinjournal WHERE journalnumber=\"$journalnumber14\" ORDER BY date DESC, journalnumber DESC";
      $result11="";
      $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
  while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $journalnumber11 = $myrow11['journalnumber'];
    $date11 = $myrow11['date'];

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $res12query = "SELECT debittot, credittot, status FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber11\"";
    $result12="";
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

    $count3 = $count3 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count3</td><td>".date("Y-M-d", strtotime($date11))."</td>";
    echo "<td><a href=\"finvouchjvview.php?loginid=$loginid&jvn=$journalnumber11\" target=\"_blank\"><b>$journalnumber11</b></a></td>";

    if($debittot12 != $credittot12) {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)

    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 <> "") {
      echo "<td>$status12</td>";
    } else {
      $status = '';
      echo "<td>$status12</td>";
    } // if($status12 == "cancelled")
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td></td>";
      } else {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td><a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-warning btn-sm'>Edit</td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
  }
  }
    }
    }
  }
  //
  // End Search JV module
  //

  $result11=$dbh2->query($res11query);
  if($result11->num_rows>0) {
  while($myrow11=$result11->fetch_assoc()) {
    $found11 = 1;
    $journalnumber11 = $myrow11['journalnumber'];
    $date11 = $myrow11['date'];

    $debittot12 = 0; $credittot12 = 0; $status12 = '';

    $res12query = "SELECT debittot, credittot, status FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber11\"";
    $result12="";
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
      } // 
    } // 

    $count3 = $count3 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count3</td><td>".date("Y-M-d", strtotime($date11))."</td>";
    echo "<td><a href=\"finvouchjvview.php?loginid=$loginid&jvn=$journalnumber11\" target=\"_blank\"><b>$journalnumber11</b></a></td>";

    if($debittot12 != $credittot12) {
      echo "<td align=\"right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td align=\"right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td align=\"right\">".number_format($debittot12, 2)."</td><td align=\"right\">".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)

    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 <> "") {
      echo "<td>$status12</td>";
    } else {
      $status = '';
      echo "<td>$status12</td>";
    } // if($status12 == "cancelled")

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td></td>";
      } else {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-danger btn-sm'>Del</td>";
        echo "<td><a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-warning btn-sm'>Edit</td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)

    echo "</tr>";
  }
  }
  if($debitmonthtot != 0 && $creditmonthtot != 0) {
    echo "<tr><td colspan=\"3\" align=\"right\"><b>Total</b></td><td><b>".number_format($debitmonthtot,2)."</b></td><td><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"3\">&nbsp;</td></tr>";
  } // if($debitmonthtot != 0 && $creditmonthtot != 0)
  echo "<form action=\"finvouchlistjv.php?loginid=$loginid\" method=\"post\">";
  echo "<tr><td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Display\"></form></td></tr>";
  echo "</table>";
?>
</div>
</td></tr>
<?php
echo "</table>";

?>

<div class="d-flex justify-content-end">
<button class="border-0 rounded-3" style="width: 12.5%; height: 40px; background-color: #0a1d44;">
    <a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">Back</a>
</button>
</div>

<?php

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>