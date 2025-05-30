<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$reqtyp = (isset($_GET['rt'])) ? $_GET['rt'] :'';

if($reqtyp!='') {
  if($reqtyp=='ot') {
    $clsstatot="class=\"active\""; $tabpnotactv="in active"; $clsstatlv=""; $tabpnlvactv="";
  } else if($reqtyp=='lv') {
    $clsstatot=""; $tabpnotactv=""; $clsstatlv="class=\"active\""; $tabpnlvactv="in active";
  } // if-else
} else {
  $clsstatot="class=\"active\""; $tabpnotactv="in active"; $clsstatlv=""; $tabpnlvactv="";
} // if-else

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("addons.php");
     include ("header.php");
     include ("sidebar.php");
?>
<style>
  th, td{
    font-family: 'Poppins', sans-serif;
    vertical-align: middle !important;
  }  
</style>

     <div class='mainContainer'>
     <div class='container-fluid'>
<?php
     $resquery = "SELECT *, tblcontact.employeeid as employee_id from tblhrtaotreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtaotreq.employeeid ORDER BY durationfrom DESC";
     $result = $dbh2->query($resquery);
     $resquery1 = "SELECT *, tblcontact.employeeid as employee_id from tblhrtalvreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtalvreq.employeeid ORDER BY durationfrom DESC";
     $result1 = $dbh2->query($resquery1);

     // var_dump($resquery1);

     ?>
     <div class="row poppins">
        <ul class="nav nav-tabs">
        <li <?php echo $clsstatot; ?>><a data-toggle="tab" href="#Overtime">Overtime Requests</a></li>
        <li <?php echo $clsstatlv; ?>><a data-toggle="tab" href="#leaveRequests">Leave Requests</a></li>
      </ul>  
     </div>
    <div class="tab-content">
     
         <div id="Overtime" class="tab-pane fade <?php echo $tabpnotactv; ?>">
             <table id="tblName" class='table table-striped table-bordered table-hover dt-responsive nowrap no-footer dtr-inline collapsed dataTable shadow'>
             <thead>
                 <tr>
                     <th class='text-center px-4'>Employee ID</th>
                     <th>Requestor</th>
                     <th>Duration From</th>
                     <th>Duration To</th>
                     <th class='text-center px-4'>Total Hours</th>
                     <th>Reason</th>
                     <th class='text-center px-4'>Status</th>
                     <th class='text-center px-4'>Actions</th>
                 </tr>
             </thead>
             <tbody>
                  <?php 
                  while($myrow = $result->fetch_assoc()) {
                    $try = strtotime($myrow['durationto']) - strtotime($myrow['durationfrom']);
                    $hrs = $try/60/60;
                    if($myrow['statusta'] == 0){
                      $status = 'Pending'; $statclr='text-dark';
                    }elseif($myrow['statusta'] == 1){
                      $status = 'Approved'; $statclr='text-success';
                    }
                    elseif($myrow['statusta'] == 2){
                      $status = 'Disapproved'; $statclr='text-danger';
                    }
                    elseif($myrow['statusta'] == 3){
                      $status = 'Noted'; $statclr='text-success';
                    }
                    $btn = '';
                    if($status == 'Approved'){
                        // $btn = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Noted</button>";
                        $btn = "<button class='btn btn-success' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Noted</button>";
                    }

                    echo "<tr>";
                    echo "<td class='text-center'>".$myrow['employee_id']."</td>";
                    echo "<td>".$myrow['name_first']." ".$myrow['name_last']."</td>";
                    echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationfrom']))."</td>";
                    echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationto']))."</td>";
                    echo "<td class='text-center'>".number_format($hrs,2)."</td>";
                    echo "<td>".$myrow['reason']."</td>";
                    echo "<td class='$statclr text-center'><strong>".$status."</strong></td>";
                    echo "<td>";
                    echo "<form action=\"mngotreqdtl.php?loginid=$loginid\" method=\"POST\" name=\"mngotreqdtl\" class='my-2 text-center'>";
                    echo "<input type='hidden' name='otid' value='".$myrow['idhrtaotreq']."' />";
                    echo "<button type='submit' class='btn btn-info'>Details</button>";
                    echo "</form>";
                    if($myrow['statusta'] == 1){
                    echo "<form action=\"tjfunctions/notedotrequest.php?loginid=$loginid\" method=\"POST\" name=\"notedotrequest\">";
                    echo "<input type='hidden' name='otid' value='".$myrow['idhrtaotreq']."' />";
                      echo "".$btn."";
                    echo "</form>";
                    }
                    echo "</td>";
                    /* elseif($myrow['statusta'] == 3){
                      echo "<td>Noted Already</td>";
                    } 
                     else{
                      echo "<td>Not Approved</td>"; 
                    } */
                    echo "</tr>";
                    
                  }
                  ?>
             </tbody>
             </table>
        </div>
        <div id="leaveRequests" class="tab-pane fade <?php echo $tabpnlvactv; ?>">
            <table id="tblName" class='table table-striped table-bordered table-hover dt-responsive nowrap no-footer dtr-inline collapsed dataTable shadow'>
             <thead>
                 <tr>
                    <th class='text-center px-4'>Employee ID</th>
                    <th>Requestor</th>
                    <th>Duration From</th>
                    <th>Duration To</th>
                    <th class='text-center px-4'>Total Hours</th>
                    <th>Reason</th>
                    <th class='text-center px-4'>Status</th>
                    <th class='text-center px-4'>Actions</th>
                 </tr>
             </thead>
             <tbody>
                  <?php 
                  while($myrow1 = $result1->fetch_assoc()) {
                    $try1 = strtotime($myrow1['durationto']) - strtotime($myrow1['durationfrom']);
                    $hrs1 = $try1/60/60/24;
                    if($myrow1['statusta'] == 0){
                      $status1 = 'Pending'; $statclr1='text-dark';
                    }elseif($myrow1['statusta'] == 1){
                      $status1 = 'Approved'; $statclr1='text-success';
                    }
                    elseif($myrow1['statusta'] == 2){
                      $status1 = 'Disapproved'; $statclr1='text-danger';
                    }
                    elseif($myrow1['statusta'] == 3){
                      $status1 = 'Noted'; $statclr1='text-success';
                    }
                    $btn1 = '';
                    if($status1 == 'Approved'){
                        // $btn1 = "<button class='btn btn-success btn-approve1' data-id='".$myrow1['idhrtalvreq']."' style='margin-right:5px;'>Noted</button>";
                       $btn1 = "<button class='btn btn-success' data-id='".$myrow1['idhrtalvreq']."' style='margin-right:5px;'>Noted</button>";
                    }

                    echo "<tr>";
                    echo "<td class='text-center'>".$myrow1['employee_id']."</td>";
                    echo "<td>".$myrow1['name_first']." ".$myrow1['name_last']."</td>";
                    echo "<td>".date('F d, Y - h:i A', strtotime($myrow1['durationfrom']))."</td>";
                    echo "<td>".date('F d, Y - h:i A', strtotime($myrow1['durationto']))."</td>";
                    echo "<td class='text-center'>".number_format($hrs1,2)."</td>";
                    echo "<td>".$myrow1['reason']."</td>";
                    echo "<td class='$statclr1 text-center'><strong>".$status1."</strong></td>";
                    echo "<td>";
                    echo "<div class='d-flex justify-content-evenly'>";
                    echo "<form action=\"mnglvreqdtl.php?loginid=$loginid\" method=\"POST\" name=\"mnglvreqdtl\" class='m-0'>";
                    echo "<input type='hidden' name='lvid' value='".$myrow1['idhrtalvreq']."' />";
                    echo "<button type='submit' class='btn btn-info'>Details</button>";
                    echo "</form>";
                    if($myrow1['statusta'] == 1){
                    echo "<form action=\"tjfunctions/notedlvrequest.php?loginid=$loginid\" method=\"POST\" name=\"notedlvrequest\" class='m-0'>";
                    echo "<input type='hidden' name='lvid' value='".$myrow1['idhrtalvreq']."' />";
                      echo "".$btn1."";
                    echo "</form>";
                    }
                    echo "</div>";
                    echo "</td>";
                    /* elseif ($myrow1['statusta'] == 3){
                      echo "<td>Noted Already</td>";
                    }
                    else{
                      echo "<td>Not Approved</td>"; 
                    } */
                    echo "</tr>";
                    
                  }
                  ?>
             </tbody>
             </table>
        </div>
    </div>
     <script>
        $(document).ready(function(){

            $('body').delegate('.btn-approve','click',function(){
                var id = $(this).data('id');
                swal({   
                    title: "Are you sure?", 
                    text: "You want to note this request.",   
                    type: "info",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false }, 
                    function(){
                          $.ajax({
                            url : 'tjfunctions/notedotrequest.php',
                            type : 'POST',
                            data : {id: id},
                            success : function(data){
                            swal("Noted!", "OT request has been noted.", "success"); 
                            loadDatatable();

                            }
                        }); 
                    }
                );
            });


            $('body').delegate('.btn-approve1','click',function(){
                var id = $(this).data('id');
                swal({   
                    title: "Are you sure?", 
                    text: "You want to note this request.",   
                    type: "info",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false }, 
                    function(){
                          $.ajax({
                            url : 'tjfunctions/notedlvrequest.php',
                            type : 'POST',
                            data : {id: id},
                            success : function(data){
                            swal("Noted!", "Leave request has been noted.", "success"); 
                            loadDatatable();

                            }
                        }); 
                    }
                );
            });
        });

        
      </script>
      </div>
      </div>
      <?php 
    echo "<div class='d-flex justify-content-end m-3 poppins'><a href='index2.php?loginid=$loginid' class='btn btn-secondary'>Back</a></div>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
