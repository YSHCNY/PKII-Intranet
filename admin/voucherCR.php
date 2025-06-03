<div class=" p-1 my-5">    
    
    <div class="row m-2">
      
        <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=cr" method="post" class = 'col-lg-6 col-auto ' target="_self">
                <div class="row">
                        <div class="col-auto d-flex align-items-center gap-3">
                           <label for="date">Date range:</label> 
                                    <div class="d-flex align-items-center gap-3">
                                    <select name = 'monthselector' value = '<?= $monthselector?>'class = 'form-select form-select-lg'>
                                      
                                        <?php 
                                        if ($monthselector == ""){
                                          echo "<option selected disabled>Choose Period</option>";
                                        }
                                        $sql = $dbh2->query("SELECT DISTINCT date_format(date, '%M %Y') as date FROM tblfincashreceipt WHERE cashreceiptid<>'' ORDER BY cashreceiptid DESC");
                                        if($sql->num_rows > 0){
                                          foreach($sql as $row){
                                            $selected = ($monthselector == $row['date']) ? 'selected' : '';
                                              echo "<option $selected >". $row['date']."</option>";
                                          }
                                        }
                                        
                                       
                                        ?>
                                    </select>
                                </div>
                            <input type="submit" value="Submit" role="button" class="btn btn-info btn-sm ">
                        </div>
                </div>
         
        </form>
        



                <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=cr" method="post" class = 'col-lg-6 col-auto  d-flex justify-content-end' target="_self" name="search">
                    <div class="row justify-content-end">
                        <div class="col-auto d-flex gap-3">
                             <label for="select">Search:</label>
                    <input name="searchcr" size="20" value="<?php echo $searchcr; ?>" class=" form-control"  placeholder = 'Search Cash Receipt'>
                    <button type="submit" role="button" class="btn  btn-info btn-sm  "> <?php echo $searchicon?> </button>
                    </div>
                    </div>
                </form>
    </div>

<?php

  $debitmonthtot = 0; $creditmonthtot = 0;
?>
<div class="table-responsive">
<table class="table table-bordered table-hover  ">
<thead class="thisonlytable-secondary">
  <tr>
    <th>Count</th>
    <th>Date</th>
    <th>C.R. No.</th>
    <th>Received from</th>
    <th>Particulars</th>
    <th>DebitTotal</th>
    <th>CreditTotal</th>
    <th>Status</th>
	<th>Attachment</th>
    <th>Action</th>
  </tr>
</thead>
<?php
  $res11query = "SELECT DISTINCT cashreceiptnumber, date, companyid, contactid, explanation FROM tblfincashreceipt WHERE cashreceiptid<>'' AND date_format(date, '%M %Y') = '$monthselector'  ORDER BY date DESC, cashreceiptnumber DESC";
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

    $res12query = "SELECT debittot, credittot, status, filepath, filename FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$cashreceiptnumber11\"";
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

    $count2 = $count2 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count2</td><td class=''>".date("F d, Y", strtotime($date11))."</td><td><a href=\"finvouchcrvview.php?loginid=$loginid&crvn=$cashreceiptnumber11\" target=\"_blank\"><b>$cashreceiptnumber11</b></a></td><td><a href=\"finvouchcrvview.php?loginid=$loginid&crvn=$cashreceiptnumber11\" target=\"_blank\">";
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
      echo "<td class=''><font color=\"red\">".number_format($debittot12, 2)."</font></td><td class=''><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td class=''>".number_format($debittot12, 2)."</td><td class=''>".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)

    if($status12 == "cancelled") {
      echo "<td class=''><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 <> "") {
      echo "<td class=''>$status12</td>";
    } else {
      $status = '';
      echo "<td class=''>$status12</td>";
    } // if($status12 == "cancelled")
	
//20250505 add col: file attachment
    if($filename12!="") {
		echo "<td><a href=\"./$filepath12/$filename12\" target=\"_blank\">$filename12</a></td>";
	} else {
		echo "<td></td>";
	} //if-else

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-danger btn-sm'>Delete</td>";
        echo "<td></td>";
      } else {
        
        echo "<td>  <div class='d-flex align-items-center gap-2'>
        <a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-warning btn-sm'>$editicon</a>
        <a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-danger btn-sm'>$deleteicon</a>
        </div></td>";
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

    $res12query = "SELECT debittot, credittot, status, filepath, filename FROM tblfincashreceipttot WHERE cashreceiptnumber=\"$cashreceiptnumber11\"";
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

    $count2 = $count2 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count2</td><td class=''>".date("F d, Y", strtotime($date11))."</td><td class=''><a href=\"finvouchcrvview.php?loginid=$loginid&crvn=$cashreceiptnumber11\" target=\"_blank\"><b>$cashreceiptnumber11</b></a></td><td class=''><a href=\"finvouchcrvview.php?loginid=$loginid&crvn=$cashreceiptnumber11\" target=\"_blank\">";
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
      echo "<td class=''><font color=\"red\">".number_format($debittot12, 2)."</font></td><td class=''><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td class=''>".number_format($debittot12, 2)."</td><td class=''>".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)

    if($status12 == "cancelled") {
      echo "<td class=''><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 <> "") {
      echo "<td class=''>$status12</td>";
    } else {
      $status = '';
      echo "<td class=''>$status12</td>";
    } // if($status12 == "cancelled")

//20250505 add col: file attachment
    if($filename12!="") {
		echo "<td><a href=\"./$filepath12/$filename12\" target=\"_blank\">$filename12</a></td>";
	} else {
		echo "<td></td>";
	} //if-else

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-danger btn-sm'>$deleteicon</td>";
        echo "<td></td>";
      } else {
        echo "<td>
        <div class='d-flex align-items-center gap-2'>
        <a href=\"finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-warning btn-sm'>$editicon</a>
        <a href=\"finvouchcrvdel.php?loginid=$loginid&crvn=$cashreceiptnumber11\" role='button' class='btn btn-danger btn-sm'>$deleteicon</a>
        </div>
    
        </td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
    // reset variables
    $company11a=""; $branch11a=""; $companyid11b=""; $employeeid11b=""; $name_last11b=""; $name_first11b=""; $name_middle11b=""; $payor11b="";
  } // while($myrow11=$result11->fetch_assoc())+
  
   if($debitmonthtot != 0 && $creditmonthtot != 0) {
    echo "<tr><td colspan=\"5\" class=''><b>Total</b></td><td class=''><b>".number_format($debitmonthtot,2)."</b></td><td class=''><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"4\">&nbsp;</td></tr>";
  } 
  }else {
    echo "<td align='center' colspan = '10'><h3 class = 'text-secondary'>No Record found.</h3></td>";
  }
 // if($debitmonthtot != 0 && $creditmonthtot != 0)
//  echo "<form action=\"finvouchlistcrv.php?loginid=$loginid\" method=\"post\">";
//  echo "<tr><td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Display\"></form></td></tr>";
  echo "</table>";
?>


<?php 
if ( $yrmonthavlbl2 == "" || $yrmonthavlbl2 == ""){echo "<div class='text-center'><h3 class = 'text-secondary'>No Date range selected.</h3></div>";}
?>

</div>
</div>
