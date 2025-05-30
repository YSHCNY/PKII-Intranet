<?php
//
// mhrotlvfrm.php
// fr: vc/index.php
// indexlinks: $page==36

require '../includes/config.inc';
require '../includes/dbh.php';
require 'addons.php';
?>
    <div class="row">
        <div class="col-md-12"><h3>Overtime/Leave Form</h3></div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
    <tr><td>
<!-- start main tabs here -->
    <ul id="myTabs" class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#overtimeReq" class="text-primary" id="hrot-tab" role="tab" data-toggle="tab" aria-controls="overtime" aria-expanded="true">Overtime request</a></li>
        <li role="presentation" class=""><a href="#leaveReq" class="text-primary" id="hrlv-tab" role="tab" data-toggle="tab" aria-controls="leave" aria-expanded="false">Leave request</a></li>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="overtimeReq" aria-labelledby="hrot-tab">
<?php
        echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=361\" method=\"POST\" name=\"frmhrotreq\" id=\"hrotreq\">";
?>
        <p><button class="btn btn-primary">Add new OT request</button></p>
        </form>

        <?php 

        $res18bquery="SELECT * FROM tblitsupportapprover WHERE approver1empid='".$employeeid0."' OR approver2empid = '".$employeeid0."'";
    $result18b=""; $found18b=0; $ctr18b=0;
    $result18b=$dbh->query($res18bquery);
    if($result18b->num_rows>0) {
    $resquery = "SELECT *, tblcontact.employeeid as employee_id from tblhrtaotreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtaotreq.employeeid WHERE tblhrtaotreq.approverid = ".$employeeid0;
     $result = $dbh->query($resquery);
    } // if
    else{
        $resquery = "SELECT *, tblcontact.employeeid as employee_id from tblhrtaotreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtaotreq.employeeid WHERE tblhrtaotreq.requestorid = ".$loginid;
     $result = $dbh->query($resquery);
    }

    

        ?>

        <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
     <thead>
         <tr>
             <td>Employee ID</td>
             <td>Requestor</td>
             <td>Duration From</td>
             <td>Duration To</td>
             <td>Total Hours</td>
             <td>Reason</td>
             <td>Status</td>
             <td>Actions</td>
         </tr>
     </thead>
     <tbody>
     <?php 

          while($myrow = $result->fetch_assoc()) {
            $try = strtotime($myrow['durationto']) - strtotime($myrow['durationfrom']);
            $hrs = $try/60/60;
            $status = ($myrow['statusta'] == 0 ? 'Pending' : 'Approved');
            $btn = '';
            if($status == 'Pending'){
                $btn = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Approve</button>";
                $btn .= "<button class='btn btn-danger btn-disapprove' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Disapprove</button>";
            }

            echo "<tr>";
            echo "<td>".$myrow['employee_id']."</td>";
            echo "<td>".$myrow['name_first']." ".$myrow['name_last']."</td>";
            echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationfrom']))."</td>";
            echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationto']))."</td>";
            echo "<td>".$hrs."</td>";
            echo "<td>".$myrow['reason']."</td>";
            echo "<td>".$status."</td>";
            // echo "<td>".$myrow['approverid']."</td>";

            if($myrow['approverid'] == $employeeid0){
              echo "<td><a class='btn btn-info btn-view' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=364&otid=".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Details</a>".$btn."</td>";
            }
            else{
              echo "<td><a class='btn btn-info btn-view' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=364&otid=".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Details</a></td>"; 
            }
            echo "</tr>";
            
          }
          ?>
     </tbody>
     </table>
        <hr>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="leaveReq" aria-labelledby="hrlv-tab">
<?php
        echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=366\" type=\"POST\" name=\"frmhrlvreq\" id=\"hrlvreq\">";
?>
        <p><button class="btn btn-primary">Add new Leave request</button></p>
        </form>
        <hr>
        </div>
    </div>
    </td></tr>
        </div>
        <div class="col-md-1"></div>
    </div> <!-- div class=row -->

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
<table class="table table-striped">
<thead>
</thead>
<tbody>

</tbody>
</table>
        </div>
        <div class="col-md-1"></div>
    </div> <!-- div class=row -->

<script>
    $(document).ready(function(){
        $('body').delegate('.btn-approve','click',function(){
                var id = $(this).data('id');
                swal({   
                    title: "Are you sure?", 
                    text: "You want to approve this request.",   
                    type: "info",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false }, 
                    function(){
                          $.ajax({
                            url : 'tjfunctions/approveotrequest.php',
                            type : 'POST',
                            data : {id: id},
                            success : function(data){
                            swal("Approved!", "Your request has been approved.", "success"); 
                            loadDatatable();

                            }
                        }); 
                    }
                );
            });


            $('body').delegate('.btn-disapprove','click',function(){
                var id = $(this).data('id');
                swal({   
                    title: "Are you sure?", 
                    text: "You want to disapprove this request.",   
                    type: "info",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false }, 
                    function(){
                          $.ajax({
                            url : 'tjfunctions/disapproveotrequest.php',
                            type : 'POST',
                            data : {id: id},
                            success : function(data){
                            swal("Cancelled!", "Your request has been disapproved.", "success"); 
                            loadDatatable();

                            }
                        }); 
                    }
                );
            });
    });
</script>