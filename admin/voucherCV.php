<div class=" py-3 my-5">

      
      
          
              <div class="row  mt-3 pt-3 mx-2">
          
                    <form action="finvouchlist.php?loginid=<?= $loginid ?>&rs=cv" class = 'col-lg-6 col-auto ' method="post" target="_self" name="dropdown">
                        <div class="row ">
                            <div class="col-auto ">
                            <label for="date">Date range:</label> 
                                    <div class="d-flex align-items-center gap-3">
                                  <select name = 'monthselector' value = '<?= $monthselector?>'class = 'form-select form-select-lg'>
                                      
                                        <?php 
                                        if ($monthselector == ""){
                                          echo "<option selected disabled>Choose Period</option>";
                                        }
                                        $sql = $dbh2->query("SELECT DISTINCT date_format(date, '%M %Y') as date FROM tblfindisbursement WHERE disbursementid <> '' ORDER BY disbursementid DESC ");
                                        if($sql->num_rows > 0){
                                          foreach($sql as $row){
                                            $selected = ($monthselector == $row['date']) ? 'selected disabled' : '';
                                              echo "<option $selected >". $row['date']."</option>";
                                          }
                                        }
                                        
                                       
                                        ?>
                                    </select>
                                </div>
                            </div>
                    

                                <?php
                                // echo "$yrmonthavlbl, $yrmonthavlbl2";
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
                            <div class="col-auto">
                                    <label for="cvtype">CV Type:</label> 
                                    <div class="d-flex align-items-center gap-3">
                                        <select name="cvtype" class="form-select form-select-lg">
                                            <option value="all" <?= $cvtypeall ?>>All CV</option>
                                            <option value="cv" <?= $cvtypecv ?>>Check Voucher</option>
                                            <option value="dm" <?= $cvtypedm ?>>Debit Memo</option>
                                            </select>
                                        <input type="submit" value="Submit" role="button" class="btn btn-info ">
                                    </div>
                                </div>

                        

                </div>

                    </form>
          

          <!-- Search CV Module -->
          <form action="finvouchlist.php?loginid=<?= $loginid ?>&rs=cv" method="post" class = 'col-lg-6 col-auto  d-flex justify-content-end' target="_self" name="search">
          <div class = 'd-flex justify-content-end'>

              <div class="row ">
                    <div class="col-auto ">
                        <label for="searchcv">Search:</label> 
                      <input name="searchcv" size="20" value="<?= $searchcv ?>" placeholder='Search Voucher' class="form-control px-2">
                    </div>
                  <div class="col-auto">
                            <label for="searchcv">CV Type:</label> 
                        <div class="d-flex align-items-center gap-3">
                          <select name="cvsearchtype" class="form-select form-select-lg">
                            <option value="any" <?= $cvsrchtypany ?>>any</option>
                            <option value="payee" <?= $cvsrchtyppayee ?>>payee/payor</option>
                            <option value="projcode" <?= $cvsrchtypprojcd ?>>proj_code</option>
                            <option value="particulars" <?= $cvsrchtypparti ?>>particulars</option>
                            <option value="explanation" <?= $cvsrchtypexpla ?>>explanation</option>
                          </select>
                                
                             <button type="submit" role="button" class="btn  btn-info   "> <?php echo $searchicon?> </button>

                        </div>
                        </div>

              </div>
                </div>
          </form>

 </div>
        
         


     

<?php
  
  $debitmonthtot = 0; $creditmonthtot = 0;
?>
<div class="table-responsive">
<table class="table table-bordered table-hover" >
  <thead class="thisonlytable-secondary">
    <tr>
    
      <th>Date</th>
      <th>C.V. No.</th>
      <th>Payee</th>
      <th>Particulars</th>
      <th>DebitTotal</th>
      <th>CreditTotal</th>
      <th>Status</th>
	  <th>Attachment</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
   
    <?php

  if($cvtype == 'all') {
      $res11query = "SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid, explanation 
FROM tblfindisbursement 
WHERE disbursementid <> '' 
AND date_format(date, '%M %Y') = '$monthselector' ORDER BY date DESC, disbursementid DESC";
  } else if($cvtype == 'cv') {


$res11query = "SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid, explanation 
FROM tblfindisbursement 
WHERE disbursementid<>''
 AND disbursementnumber NOT LIKE '%DM%' AND date_format(date, '%M %Y') = '$monthselector'  ORDER BY date DESC, disbursementnumber DESC";


  } else if($cvtype == 'dm') {
      $res11query = "SELECT DISTINCT disbursementnumber, disbursementtype, date, companyid, contactid, explanation 
FROM tblfindisbursement 
WHERE disbursementid<>''
 AND disbursementnumber LIKE '%DM%' AND date_format(date, '%M %Y') = '$monthselector'  ORDER BY date DESC, disbursementnumber DESC";
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

    $res12query = "SELECT debittot, credittot, status, filepath, filename FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
	  $filepath12 = $myrow12['filepath'];
	  $filename12 = $myrow12['filename'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td class=''>".date("F d, Y", strtotime($date11))."</td><td class=''><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" class = 'ahover' target=\"_blank\"><b>$disbursementnumber11</b></a></td><td class=''><a href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" class = 'ahover' target=\"_blank\">";
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
      echo "<td class=''><font color=\"red\">".number_format($debittot12, 2)."</font></td><td class=''><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td class=''>".number_format($debittot12, 2)."</td><td class=''>".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)
    if($status12 == "cancelled") {
      echo "<td class=''><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 != "") {
      echo "<td class=''>$status12</td>";
    } else {
      $status12 = '';
      echo "<td class=''>$status12</td>";
    } // if($status12 == "cancelled")
		
	if($filename12!="") {
		echo "<td><a href=\"$filepath12/$filename12\" target=\"_blank\">".$filename12."</a></td>";
	} else {
		echo "<td></td>";		
	} //if-else
		
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-danger '>Delete</td>";
        echo "<td></td>";
      } else {
        echo "<td>
        <div class='d-flex align-items-center gap-3'>
        <a href=\"finvouchcvnew.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-warning '>$editicon</a>
        <a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-danger '>$deleteicon</a>
        </div>
        </td>";
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

    $res12query = "SELECT debittot, credittot, status, filepath, filename FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
	  $filepath12 = $myrow12['filepath'];
	  $filename12 = $myrow12['filename'];
      } // while($myrow12=$result12->fetch_assoc())
    } // if($result12->num_rows>0)

    $count1 = $count1 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td class=''>".date("F d, Y", strtotime($date11))."</td><td class=''><a class = 'ahover' href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\"><b>$disbursementnumber11</b></a></td><td class=''>";
    echo "<a class = 'ahover' href=\"finvouchcvview.php?loginid=$loginid&cvn=$disbursementnumber11\" target=\"_blank\">";
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
      echo "<td class=''><font color=\"red\">".number_format($debittot12, 2)."</font></td><td class=''><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td class=''>".number_format($debittot12, 2)."</td><td class=''>".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)
    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 != "") {
      echo "<td>$status12</td>";
    } else {
      $status12 = '';
      echo "<td>$status12</td>";
    } // if($status12 == "cancelled")

	if($filename12!="") {
		echo "<td><a href=\"$filepath12/$filename12\" target=\"_blank\">".$filename12."</a></td>";
	} else {
		echo "<td></td>";		
	} //if-else

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td></td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-danger '>$deleteicon</td>";
    
      } else {
        echo "<td>
        <div class='d-flex align-items-center gap-3'>
        <a href=\"finvouchcvnew.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-warning '>$editicon</a>
        <a href=\"finvouchcvdel.php?loginid=$loginid&cvn=$disbursementnumber11\" role='button' class='btn btn-danger '>$deleteicon</a>
        </div>
        </td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
    // reset variables
    $company11a=""; $branch11a=""; $companyid11b=""; $employeeid11b=""; $name_last11b=""; $name_first11b=""; $name_middle11b=""; $payee11b="";
  } // while($myrow11=$result11->fetch_assoc())
  } else {
    echo "<td colspan = '10' align='center' ><h3 class = 'text-secondary'>No Record found.</h3></td>";
  }
  if($debitmonthtot != 0 && $creditmonthtot != 0) {
    echo "<td colspan=\"5\" class=''><b>Total ";
    if($cvtype != 'all') { echo "".strtoupper($cvtype).""; }
    echo "</b></td'><td class=''><b>".number_format($debitmonthtot,2)."</b></td><td class=''><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"3\">&nbsp;</td>";
  } // if($debitmonthtot != 0 && $creditmonthtot != 0)


  echo "
    

  </tbody>
</table>";
?>
</div>



</div>
