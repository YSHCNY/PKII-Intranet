<div class=" p-1 my-5">    
    
    <div class="row m-2">
      
    <?php
// At the top of your PHP script
// if (empty($_POST['monthselector']) && !isset($_GET['form_submitted'])) {
//     echo '<script>window.onload = function() { document.getElementById("myForm").submit(); };</script>';
//     // Add a parameter to prevent infinite loop
//     echo '<input type="hidden" name="form_submitted" value="1">';
// }
?>

        <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=ap" method="post" class = 'col-lg-6 col-auto ' id="myForm" target="_self">
                <div class="row">
                        <div class="col-auto d-flex align-items-center gap-3">
                           <label for="date">Date range:</label> 
                                    <div class="d-flex align-items-center gap-3">
                                    <select name = 'monthselector' value = '<?= $monthselector?>'class = 'form-select form-select-lg' onchange = 'this.form.submit();'>
                                      
                                        <?php 
                                        if ($monthselector == ""){
                                          echo "<option selected disabled>Choose Period</option>";
                                        }
                                        $sql = $dbh2->query("SELECT DISTINCT date_format(date, '%M %Y') as date FROM tblfinacctspayable WHERE acctspayableid<>'' ORDER BY acctspayableid DESC, acctspayablenumber DESC");
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
   



        
        <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=ap" method="post" class = 'col-lg-6 col-auto  d-flex justify-content-end' target="_self" name="search">
                <div class="row justify-content-end">
                    <div class="col-auto d-flex align-items-center gap-3">
                      <label for="select">Search:</label>

                        <input name="searchap" placeholder = 'Search Accounts Payable' class = 'form-control' size="20" value="<?php echo $searchap; ?>" >
                        <button type="submit" role="button" class="btn  btn-info btn-sm  " > <?php echo $searchicon?> </button>
                    </div>
                </div>
                    
        </form>
    

<script>


</script>

      </div>



<?php
  $debitmonthtot = 0; $creditmonthtot = 0;
  ?>

<div class="table-responsive">
<table class="table table-bordered table-hover  ">
<thead >
  <tr>
    <th>Date Created</th>
    <th>A.P. Number</th>
    <th>Payee</th>
    <th>Explanation</th>
    <th>Debit Total</th>
    <th>Credit Total</th>
    <th>Due Date</th>
    <th>Status</th>
	<th>Attachment</th>
    <th>Action</th>
  </tr>
</thead>
<?php

// if ($monthselector == "")
  $res11query=""; $result11=""; $found11=0;
  $res11query = "SELECT DISTINCT acctspayablenumber, payee, due_date, date FROM tblfinacctspayable WHERE acctspayableid<>'' AND DATE_FORMAT(date, '%M %Y') = '$monthselector' ORDER BY acctspayableid DESC, acctspayablenumber DESC";
    $result11=""; $found11=0;
  $result11=$dbh2->query($res11query);
// echo $res11query ;


  if($searchap != "") {

    $res14query = "(SELECT DISTINCT acctspayablenumber, date FROM tblfinacctspayable WHERE tblfinacctspayable.acctspayablenumber LIKE \"%$searchap%\" OR tblfinacctspayable.projcode LIKE \"%$searchap%\" OR tblfinacctspayable.particulars LIKE \"%$searchap%\" OR tblfinacctspayable.payee LIKE \"%$searchap%\") UNION (SELECT DISTINCT acctspayablenumber, date FROM tblfinacctspayabletot WHERE tblfinacctspayabletot.explanation LIKE \"%$searchap%\") ORDER BY acctspayablenumber DESC";

    // echo $res14query;
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

    $res12query = "SELECT explanation, debittot, credittot, status, filepath, filename FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber11\"";
    $result12=""; $found12=0;
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $explanation12 = $myrow12['explanation']; //20230522
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
?>

<tr>
  <!-- <td align="center"><?php //echo $count1; ?></td> -->
  <td><?php echo date('F d, Y', strtotime($date11)); ?></td>
  <td><a href="finvouchapview.php?loginid=<?php echo $loginid; ?>&apn=<?php echo $acctspayablenumber11;  ?>" class = 'ahover text-decoration-none' target="_blank"><b><?php echo $acctspayablenumber11; ?></b></a></td>
  <td><a href="finvouchapview.php?loginid=<?php echo $loginid; ?>&apn=<?php echo $acctspayablenumber11;  ?>" class = 'ahover text-decoration-none' target="_blank"><?php echo $payee11; ?></a></td>
  <td><?php echo $explanation12; ?></td>

<?php
    if($debittot12 != $credittot12) {
      echo "<td style=\"text-align: center;\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td style=\"text-align: right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td style=\"text-align: center;\">".number_format($debittot12, 2)."</td><td style=\"text-align: right\">".number_format($credittot12, 2)."</td>";
    }

    $statusdone=0;
    if(preg_match("/Done/i", $status12)) {
		  $statusdone=1; $status12="Done";
    }
    if($statusdone==1) {
      echo "<td style=\"text-align: center;>".date('F d, Y', strtotime($duedate11))."</td>";		
    }

	if(strtotime($datenow) > strtotime($duedate11)) {
    echo "<td style=\"text-align: center; color: red\">".date('F d, Y', strtotime($duedate11))."</td>";				
	} else {
    echo "<td style=\"text-align: center; color: green\">".date('F d, Y', strtotime($duedate11))."</td>";		
	}
    if($status12 == "cancelled") {
      echo "<td><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 != "") {
      echo "<td>$status12</td>";
    } else {
      $status12 = '';
      echo "<td>$status12</td>";
    }
	
	//20250502 insert col for file Attachment
	if($filename12!="") {
		echo "<td><a href=\"./$filepath12/$filename12\" target=\"_blank\">$filename12</a></td>";
	} else {
		echo "<td></td>";
	} //if-else

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td colspan='2' align='center'><a href=\"finvouchmakecv.php?loginid=$loginid&apn=$acctspayablenumber11&duedate=$duedate11&payee=$payee11\" class=\"btn btn-primary \" role=\"button\" />$vouchericon </a></td>";
      } else if($status12 == "cancelled") {
        echo "<td align='center'><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-danger \" role=\"button\" />$deleteicon</a></td>";
        echo "<td></td>";
      } else {
        echo "<td align='center'>
         <div class='d-flex align-items-center gap-3'>
         <a href=\"finvouchapnew.php?loginid=$loginid&apn=$acctspayablenumber11\"class=\"btn btn-warning \" role=\"button\" />$editicon</a>
        <a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-danger \" role=\"button\" />$deleteicon</a>
        </div>
       </td>";
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

    $res12query = "SELECT explanation, debittot, credittot, status, filepath, filename FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber11\"";
    $result12="";
    $result12=$dbh2->query($res12query);
    if($result12->num_rows>0) {
      while($myrow12=$result12->fetch_assoc()) {
      $found12 = 1;
      $explanation12 = $myrow12['explanation']; //20230522
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

    echo "<tr>";
    // 
    echo " <td class=''>".date('F d, Y', strtotime($date11))."</td>
    <td class=''><a href=\"finvouchapview.php?loginid=$loginid&apn=$acctspayablenumber11\" class = 'ahover text-decoration-none\' target=\"_blank\"><b>$acctspayablenumber11</b></a></td>
    <td class=''><a href=\"finvouchapview.php?loginid=$loginid&apn=$acctspayablenumber11\" class = 'ahover text-decoration-none\' target=\"_blank\">$payee11</a></td>";

    echo "<td>$explanation12</td>"; //20230522

    if($debittot12 != $credittot12) {
      echo "<td class='' style=\"text-align: right\"><font color=\"red\">".number_format($debittot12, 2)."</font></td><td style=\"text-align: right\"><font color=\"red\">".number_format($credittot12, 2)."</font></td>";
    } else {
      echo "<td class='' style=\"text-align:right\">".number_format($debittot12, 2)."</td><td class=''>".number_format($credittot12, 2)."</td>";
    } // if($debittot12 != $credittot12)

    $statusdone=0;
    if(preg_match("/Done/i", $status12)) {
		$statusdone=1; $status12="Done";
	} //if
	if($statusdone==1) {
    echo "<td class='' style=\"text-align: right;>".date('F d, Y', strtotime($duedate11))."</td>";		
	} //if

	if(strtotime($datenow) > strtotime($duedate11)) {
    echo "<td class='' style=\"text-align: right; color: red\">".date('F d, Y', strtotime($duedate11))."</td>";				
	} else {
    echo "<td class='' style=\"text-align: right; color: green\">".date('F d, Y', strtotime($duedate11))."</td>";		
	} //if-else		

    if($status12 == "cancelled") {
      echo "<td class=''><font color=\"red\"><i>$status12</i></font></td>";
    } else if($status12 != "") {
      echo "<td class=''>$status12</td>";
    } else {
      $status12 = '';
      echo "<td class=''>$status12</td>";
    } // if($status12 == "cancelled")
	
    //20250502 insert col for file Attachment
	if($filename12!="") {
		echo "<td><a href=\"./$filepath12/$filename12\" target=\"_blank\">$filename12</a></td>";
	} else {
		echo "<td></td>";
	} //if-else

    if($accesslevel >= 3 && $accesslevel <= 5) {
      if($status12 == "finalized") {
        echo "<td colspan='2' align='center'><a href=\"finvouchmakecv.php?loginid=$loginid&apn=$acctspayablenumber11&duedate=$duedate11&payee=$payee11\" class=\"btn  btn-success \" role=\"button\" />$vouchericon </a></td>";
      } else if($status12 == "cancelled") {
        echo "<td align='center'><a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-danger \" role=\"button\" />$deleteicon</a></td>";
      
      } else {
        echo "<td align='center'>
            <div class='d-flex align-items-center gap-3'>
            <a href=\"finvouchapnew.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-warning \" role=\"button\" />$editicon</a>
            <a href=\"finvouchapdel.php?loginid=$loginid&apn=$acctspayablenumber11\" class=\"btn btn-danger \" role=\"button\" />$deleteicon</a>
            </div>
        </td>";
      } // if($status12 == "finalized")
    } // if($accesslevel >= 3 && $accesslevel <= 5)
    echo "</tr>";
  } // while($myrow11=$result11->fetch_assoc())
  }else {
    echo "<td colspan = '10' align='center' ><h3 class = 'text-secondary'>No Record found.</h3></td>";
  }
  if($debitmonthtot != 0 && $creditmonthtot != 0) {
    echo "<tr><td colspan=\"4\" class=''><b>Total</b></td>";
	if(round($debitmonthtot,2)==round($creditmonthtot,2)) {
	echo "<td style=\"text-align: right; color: green\"><strong>".number_format($debitmonthtot,2)."</strong></td><td style=\"text-align: right; color: green\"><strong>".number_format($creditmonthtot,2)."</strong></td>";
	} else {
	echo "<td style=\"text-align: right; color: red\"><strong>".number_format($debitmonthtot,2)."</strong></td><td style=\"text-align: right; color: red\"><strong>".number_format($creditmonthtot,2)."</strong></td>";		
	} //if-else
	echo "<td colspan=\"4\">&nbsp;</td></tr>";
  } // if($debitmonthtot != 0 && $creditmonthtot != 0)
 


?>

</table>

</div>



</div>
