 <div class=" py-3 my-5">

      
      
          
              <div class="row  mt-3 pt-3 mx-2">

          <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=jv" method="post" class = 'col-lg-6 col-auto ' target="_self">

          <div class="row">
            <div class="col-auto d-flex gap-3 align-items-center">
                      <label for="date">Date range:</label> 
                                    <div class="d-flex align-items-center gap-3">
                                    <input type = 'date' value = "<?= $yrmonthavlbl?>" name = 'yrmonthavlbl' class = 'form-control'>
                                    <span ><i class = 'text-secondary'> to</i> </span>
                                    <input type = 'date' value = "<?= $yrmonthavlbl2?>" name = 'yrmonthavlbl2' class = 'form-control'>
                                </div>
                            <input type="submit" value="Submit" role="button" class="btn btn-info btn-sm ">
                       
              </div>
              </div>
          </form>

       

          <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=jv" method="post" target="_self" name="search" class = 'col-lg-6 col-auto  d-flex justify-content-end'>
            <div class="row justify-content-end">
       
          <div class="d-flex align-item-center gap-3 col-auto">
                      <label for="select">Search:</label>
              <input name="searchjv" placeholder='Search Journal' class="form-control px-2" size="20" value="<?php echo $searchjv; ?>" >
               <button type="submit" role="button" class="btn  btn-info   "> <?php echo $searchicon?> </button>
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
    <th >Count</th>
    <th >Date</th>
    <th >J.V. No.</th>
    <th >DebitTotal</th>
    <th >CreditTotal</th>
    <th >Status</th>
	<th >Attachment</th>
    <th >Action</th>
  </tr>
</thead>
<?php
  $res11query = "SELECT DISTINCT journalnumber, date FROM tblfinjournal WHERE journalid<>'' AND date BETWEEN '$yrmonthavlbl' AND '$yrmonthavlbl2' ORDER BY date DESC, journalnumber DESC";
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

    $res12query = "SELECT debittot, credittot, status, filepath, filename FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber11\"";
    $result12="";
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

    $count3 = $count3 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count3</td><td class=''>".date("F d, Y", strtotime($date11))."</td>";
    echo "<td class=''><a href=\"finvouchjvview.php?loginid=$loginid&jvn=$journalnumber11\" target=\"_blank\"><b>$journalnumber11</b></a></td>";

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

    if($filename12!="") {
		echo "<td><a href=\"./$filepath12/$filename12\" target=\"_blank\">$filename12</a></td>";
	} else {
		echo "<td></td>";
	} //if-else
		
    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-danger btn-sm'>Delete</td>";
        echo "<td></td>";
      } else {
        echo "<td>  <div class='d-flex align-items-center gap-2'>
        <a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-warning btn-sm'>$editicon</a>
        <a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-danger btn-sm'>$deleteicon</a></div></td>";
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

    $res12query = "SELECT debittot, credittot, status, filepath, filename FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber11\"";
    $result12="";
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $debittot12 = $myrow12['debittot'];
      $credittot12 = $myrow12['credittot'];
      $status12 = $myrow12['status'];
	  $filepath12 = $myrow12['filepath'];
	  $filename12 = $myrow12['filename'];
      } // 
    } // 

    $count3 = $count3 + 1;

    $debitmonthtot = $debitmonthtot + $debittot12;
    $creditmonthtot = $creditmonthtot + $credittot12;

    echo "<tr><td align=\"center\">$count3</td><td class=''>".date("F d, Y", strtotime($date11))."</td>";
    echo "<td class=''><a href=\"finvouchjvview.php?loginid=$loginid&jvn=$journalnumber11\" target=\"_blank\"><b>$journalnumber11</b></a></td>";

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

    if($filename12!="") {
		echo "<td><a href=\"./$filepath12/$filename12\" target=\"_blank\">$filename12</a></td>";
	} else {
		echo "<td></td>";
	} //if-else

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td>&nbsp;</td><td>&nbsp;</td>";
      } else if($status12 == "cancelled") {
        echo "<td class=''><a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-danger btn-sm'>$deleteicon</td>";
   
      } else {
        echo "<td class=''>
        <div class='d-flex align-items-center gap-2'>
        <a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-warning btn-sm'>$editicon</a>
        <a href=\"finvouchjvdel.php?loginid=$loginid&jvn=$journalnumber11\" role='button' class='btn btn-danger btn-sm'>$deleteicon</a></div>
        </td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)

    echo "</tr>";
  }
    if($debitmonthtot != 0 && $creditmonthtot != 0) {
    echo "<tr><td colspan=\"3\" class=''><b>Total</b></td><td class=''><b>".number_format($debitmonthtot,2)."</b></td><td class=''><b>".number_format($creditmonthtot,2)."</b></td><td colspan=\"3\">&nbsp;</td></tr>";
  } // if($debitmonthtot != 0 && $creditmonthtot != 0)
  echo "<tr>";
  echo "<td colspan=\"8\" align=\"center\"><form action=\"finvouchlistjv.php?loginid=$loginid\" method=\"post\">
  <input type=\"submit\" value=\"Display\" id='hov' class='btn btn-outline-primary border border-1 border-primary fw-medium '>
  </form>
  </td>
  </tr>";

  }else {
    echo "<td colspan = '10' align = 'center'><h3 class = 'text-secondary'>No Record found.</h3></td>";
  }

  echo "</table>";
?>


<?php 
if ( $yrmonthavlbl2 == "" || $yrmonthavlbl2 == ""){echo "<div class='text-center'><h3 class = 'text-secondary'>No Date range selected.</h3></div>";}
?> </div>
</div>
