<?php
//
// mhrotlvfrm.php
// fr: vc/index.php
// indexlinks: $page==36

require '../includes/config.inc';
require '../includes/dbh.php';
session_start();

$tabpaneot=''; $tabpanelv='';
if($pgsrc=='ot') {
$tabpaneot="fade active in"; $ptclsot="active"; $tabpanelv=""; $ptclslv="";
} else if($pgsrc=='lv') {
$tabpaneot=""; $ptclsot=""; $tabpanelv="fade active in"; $ptclslv="active";
} else {
$tabpaneot="fade active in"; $ptclsot="active"; $tabpanelv=""; $ptclslv="";
}
?>


<style>
	
						td, th{
							font-size: 12px !important;
						}
							@media (max-width: 768px) {
							th, td {
								font-size: 10px !important;
							}
							}

							@media (min-width: 768px) {
								th, td {
									font-size: 10px; 
								}
								}

                /* Override bold font-weight for "Show entries" dropdown */
.dataTables_wrapper .dataTables_length label {
    font-weight: normal !important;
}

/* Override bold font-weight for "Search" input */
.dataTables_wrapper .dataTables_filter input {
    font-weight: normal !important;
}
				</style>
  <div class="mainbgc mt-5 p-5">
    <div class=""><h4 class = 'text-white p-5'>Overtime & Leave Form</h4></div>
  </div>

<!-- <div class="row">
    <div class="col-md-12"><?php echo "ps:$pgsrc, tpot:$tabpaneot, tplv:$tabpanelv"; ?></div>
  </div> -->

  <div class="container-fluid p-5  mt-3 mb-5">
	
  <?php
	if (isset($_SESSION['otrsuccess']) && $_SESSION['otrsuccess']) {
			// Display success alert
			echo '<div class = "container"><div id="success" class="alert-success text-white bg-success my-4 rounded-4 border transition delay-200 px-4 py-4 relative" role="alert">
					<strong class="fw-bold">Overtime Request</strong>
					<span class="block sm:inline">sent Successfully!</span>
				  </div></div>';
			// Unset the session variable to prevent displaying the alert again on page refresh
			unset($_SESSION['otrsuccess']);
		
			
		}
		?>
		<script>
				  
					const successAlerteditadd = document.getElementById('success');
					setTimeout(function() {
						successAlerteditadd.style.opacity = '0';
						setTimeout(function() {
							successAlerteditadd.style.display = 'none';
						},100); 
					}, 4000);
				</script>


<?php
	if (isset($_SESSION['lrsuccess']) && $_SESSION['lrsuccess']) {
			// Display success alert
			echo '<div class = "container"><div id="successLeave" class="alert-success text-white bg-success my-4 rounded-4 border transition delay-200 px-4 py-4 relative" role="alert">
					<strong class="fw-bold">Leave Request</strong>
					<span class="block sm:inline">sent Successfully!</span>
				  </div></div>';
			// Unset the session variable to prevent displaying the alert again on page refresh
			unset($_SESSION['lrsuccess']);
		
			
		}
		?>
		<script>
				  
					const successLeave = document.getElementById('successLeave');
					setTimeout(function() {
						successLeave.style.opacity = '0';
						setTimeout(function() {
							successLeave.style.display = 'none';
						},100); 
					}, 4000);
				</script>








<?php
	if (isset($_SESSION[$logdetails]) && $_SESSION[$logdetails]) {
			// Display success alert
      echo '<div class="container"><div id="logdetils" class="alert-info text-white bg-info my-4 rounded-4 border transition delay-200 px-4 py-4 relative" role="alert">
      <strong class="fw-bold">' . $logdetails . '</strong>
      
    </div></div>';

			// Unset the session variable to prevent displaying the alert again on page refresh
			unset($_SESSION[$logdetails]);
		
			
		}
		?>
		<script>
				  
					const successAlerteditaddView = document.getElementById('logdetils');
					setTimeout(function() {
						successAlerteditaddView.style.opacity = '0';
						setTimeout(function() {
							successAlerteditaddView.style.display = 'none';
						},100); 
					}, 4000);
				</script>


				  
	


    <div class="border rounded-3 p-5 shadow">

<!-- start main tabs here -->
  <ul id="myTabs" class="nav nav-tabs " role="tablist">
    <li role="presentation" class="<?php echo $ptclsot; ?>"><a href="#overtimeReq" class="maintext fs-5" id="hrot-tab" role="tab" data-toggle="tab" aria-controls="" aria-expanded="true">Overtime</a></li>
    <li role="presentation" class="<?php echo $ptclslv; ?>"><a href="#leaveReq" class="maintext fs-5" id="hrlv-tab" role="tab" data-toggle="tab" aria-controls="" aria-expanded="false">Leave</a></li>
  </ul>

  <div id="myTabContent" class="tab-content">

<?php
     echo "<div role=\"tabpanel\" class=\"tab-pane $tabpaneot\" id=\"overtimeReq\" aria-labelledby=\"hrot-tab\">";
    echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=361\" class = 'mt-4' method=\"POST\" name=\"frmhrotreq\" id=\"hrotreq\">";
?>
<div class="row px-3 pb-4">
  <div class="col-lg-6">
    <p class = 'fw-bold fs-4 mb-0 maintext'>Overtime Requests </p>
    <p class = 'fs-6 text-muted'>List of OT requests and approvers</p>
  </div>
  <div class="col-lg-6 text-end">
  <button  class="secondarybgc text-white rounded-3 px-3 py-2 border-0">New OT request</button>
  </div>
</div>
    
    </form>

    <?php 

  $res18bquery="SELECT * FROM tblitsupportapprover WHERE approver1empid='".$employeeid0."' OR approver2empid = '".$employeeid0."'";
  $result18b=""; $found18b=0; $ctr18b=0;
  $result18b=$dbh->query($res18bquery);



  $resquery1 = "SELECT *, tblcontact.employeeid as employee_id from tblhrtaotreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtaotreq.employeeid WHERE tblhrtaotreq.approverempid = ".$employeeid0." ORDER BY tblhrtaotreq.durationfrom DESC";
    $result1 = $dbh->query($resquery1);

    $resquery = "SELECT *, tblcontact.employeeid as employee_id from tblhrtaotreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtaotreq.employeeid WHERE tblhrtaotreq.employeeid = ".$employeeid0." ORDER BY tblhrtaotreq.durationfrom DESC";

    $result = $dbh->query($resquery);

  // echo "<p>qry:$resquery</p>";

    ?>
    <div class="table-responsive p-5 mb-4">
      <p class = 'fw-bold submaintext2 fs-3'>Requests</p>

    <table id="newot" class=' table-striped table-hover ' style="width:100%">
     <thead class = 'text-muted'>
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
     <tbody class = 'maintext'>
      
     <?php 
      include "ottable.php";?>
     </tbody>
     </table>
     </div>


     <div class="table-responsive p-5 mt-4">
      <p class = 'fw-bold submaintext2 fs-3'>Approvers</p>

    <table id="newapp" class=' table-striped table-hover ' style="width:100%">
     <thead class = 'text-muted'>
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
     <tbody class = 'maintext'>
      
     <?php 
      include "ottableapp.php";?>

      
     </tbody>
     </table>
     </div>





    </div>




<?php
    echo "<div role=\"tabpanel\" class=\"tab-pane $tabpanelv\" id=\"leaveReq\" aria-labelledby=\"hrlv-tab\">";
    echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=366\"  class = ' mt-4' method=\"POST\" name=\"frmhrlvreq\" id=\"hrlvreq\">";
?>
    <div class="row px-3 pb-4">
  <div class="col-lg-6">
    <p class = 'fw-bold fs-4 mb-0 maintext'>Leave Requests </p>
    <p class = 'fs-6 text-muted'>List of Leave requests and approvers</p>
  </div>
  <div class="col-lg-6 text-end">
  <button class="secondarybgc text-white rounded-3 px-3 py-2 border-0">New Leave request</button>
  </div>
</div>
    </form>

     <?php 

  $res18bquery="SELECT * FROM tblitsupportapprover WHERE approver1empid='".$employeeid0."' OR approver2empid = '".$employeeid0."'";
  $result18b=""; $found18b=0; $ctr18b=0;
  $result18b=$dbh->query($res18bquery);



   $resquery1 = "SELECT *, tblcontact.employeeid as employee_id from tblhrtalvreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtalvreq.employeeid WHERE tblhrtalvreq.approverempid = ".$employeeid0." ORDER BY tblhrtalvreq.durationfrom DESC";
     $result1 = $dbh->query($resquery1);

    $resquery = "SELECT *, tblcontact.employeeid as employee_id from tblhrtalvreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtalvreq.employeeid WHERE tblhrtalvreq.employeeid = ".$employeeid0." ORDER BY tblhrtalvreq.durationfrom DESC";

     $result = $dbh->query($resquery);

  // echo "<p>qry:$resquery</p>";

    ?>

<div class="table-responsive p-5 mb-4">
    <p class='fw-bold submaintext2 fs-3'>Requests</p>

    <table id="newleave" class='table-striped table-hover' style="width:100%">
        <thead class='text-muted'>
            <tr>
                <td>Employee ID</td>
                <td>Requestor</td>
                <td>Duration From</td>
                <td>Duration To</td>
                <td>Reason</td>
                <td>Status</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody class='maintnext'>
     
        <?php include 'leavetbl.php'; ?>
        </tbody>
    </table>
</div>





     <div class="table-responsive p-5 mb-4">
      <p class = 'fw-bold submaintext2 fs-3'>Approver</p>

    <table id="newleaveapp" class='table-striped table-hover' style="width:100%">
     <thead class = 'text-muted'>
         <tr>
             <td>Employee ID</td>
             <td>Requestor</td>
             <td>Duration From</td>
             <td>Duration To</td>

             <td>Reason</td>
             <td>Status</td>
             <td>Actions</td>
         
         </tr>
     </thead>
     <tbody class = 'maintnext'>
      <?php include ("leavetblapp.php"); ?>
     </tbody>
</thead>
    </table>


     </div>











    
    </div>



    </div>
  </div>



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
