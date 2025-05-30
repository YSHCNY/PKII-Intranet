<?php 

include("db1.php");


$loginid = $_GET["loginid"];

$found = 0;

if($loginid != '')
{
	include("logincheck.php");
}

if ($found == 1)
{

	include ("header.php");
	include ("sidebar.php");

// start contents here
  echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";
     echo "<input type='hidden' id='loginid' value='".$loginid."'/>";
     ?>


     <div id="myModal" class="modal fade" role="dialog">
     <form id='frmAddEdit' method="POST" action='tjfunctions/addRequest.php'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Inventory Request</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <input type='hidden' value='<?php echo $username; ?>' id='actionId' name='actionId' />
                <div class='form-group'>
                    <select class="chosen-select" id="inventory" name="inventory">
                    	<option></option>
                    	<option disabled selected="">Inventory Code and Name</option>
                    	<?php 
					     $query = "SELECT * FROM tblinventory ";
					     $result = $dbh2->query($query);

					     while($row = $result->fetch_assoc()) 
					      {
					      	echo "<option value='".$row['inventory_code']."'>".$row['inventory_code']." - ".$row['inventory_name']."</option>";
					      }
                    	?>

                    </select>
                </div>
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='quantity' name='quantity' placeholder="Quantity" />   
                </div>
                <div class='form-group'>
                    <textarea rows="4" required="true" class='form-control' id='comment' name='comment' placeholder="Comment"></textarea>   
                </div>
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </form>
</div>



  <div id="viewModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Inventory Request</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <div class='form-group'>
                    <label>Request ID:</label><p id="requestid"></p>  
                </div>
                <div class='form-group'>
                    <label>Requested Asset:</label><p id="inventoryT"></p>  
                </div>
                <div class='form-group'>
                    <label>Status:</label><p id="status"></p>  
                </div>
                <div class='form-group'>
                    <label>Date:</label><p id="date"></p>  
                </div>
                <div class='form-group'>
                    <label>Quantity:</label><p id="quantityT"></p>  
                </div>
                <div class='form-group'>
                    <label>Approved By:</label><p id="approved"></p>  
                </div>
                <div class='form-group'>
                    <label>Budget:</label><p id="budgetT"></p>  
                </div>
                <div class='form-group'>
                    <label>Your Comment:</label><p id="commentT"></p>  
                </div>
                <div class='form-group'>
                    <label>Their Remarks:</label><p id="remarks"></p>  
                </div>
            </div>
            <div style="clear:both;"></div>
          </div>
        </div>
      </div>
</div>


<div id="approveModal" class="modal fade" role="dialog">
     <form id='frmApprove' method="POST" action='tjfunctions/approveRequest.php'>
      <input type='hidden' value='<?php echo $username; ?>' id='approveUser' name='approveUser' />
      <input type='hidden' value='0' id='approveId' name='approveId' />
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Approve Request</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <div class='form-group'>
                  <input type="text" class="form-control" id="budget" name="budget" placeholder="budget">
                </div>          
                <div class='form-group'>
                  <textarea class="form-control" rows="4" id="approveRemarks" name="approveRemarks"></textarea>
                </div>

            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </form>
</div>


     <input class='btn form-control' type="text" id="searchDT" placeholder="Search...."  style='width:30%; text-align: left; border: 1px solid #ddd;' />
     <select class="btn form-control" tabindex="2" id="filterClass" style="width:20%; border:2px solid #ddd;">
        <option disabled selected>Filter By Status</option>
        <option value="">All</option>
        <option value="Pending">Pending</option>
        <option value="Cancelled">Cancelled</option>
        <option value="Rejected">Rejected</option>
        <option value="Approved">Approved</option>
        <option value="Delivered">Delivered</option>
     </select>
         <!-- <button id="btnAdd" class="btn btn-primary" data-toggle='modal' data-target='#myModal'>Add New Request</button> -->
     <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
     <thead>
         <tr>
             <td>Request ID</td>
             <td>Asset Name</td>
             <td>Date Requested</td>
             <td>Quantity</td>
             <td>Status</td>
             <td>Actions</td>
         </tr> 
     <tbody>
      </tbody>
      </table>
      <script type="text/javascript">
    $(document).ready(function(){
            loadDatatable();

            // $('.chosen-select').chosen();

            $('#searchDT').keyup(function(){
            var oTable = $('#tblName').DataTable();
            oTable.search($(this).val()).draw() ;
            });

            $('#myModal').on('hidden.bs.modal', function (e) {
                addEditForm[0].reset();
                $('#actionId').val('0')
            });


            $('#filterClass').on('change',function(){
            var oTable = $('#tblName').DataTable();
            oTable.search($(this).find(":selected").val()).draw();
            });



            var addEditForm = $("#frmAddEdit");

            addEditForm.validate();
            addEditForm[0].reset();
            var optionsAddEditForm = {
            beforeSubmit: function () {
            },
            success: function (response) {
                if(response == '1')
                {swal('Error','Inventory code already used','error');}
                else
                {
                loadDatatable();
                swal("Success",'Successfully added data.','success');
                addEditForm[0].reset();
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');

                }

                
            }
        };
        addEditForm.ajaxForm(optionsAddEditForm);


        var approveForm = $("#frmApprove");

            approveForm.validate();
            approveForm[0].reset();
            var optionsapproveForm = {
            beforeSubmit: function () {
            },
            success: function (response) {
                loadDatatable();
                swal("Success",'Approved Request.','success');
                approveForm[0].reset();
                $('#approveModal').modal('hide');
                $('.modal-backdrop').css('display','none');
            }
        };
        approveForm.ajaxForm(optionsapproveForm);

        $('.chosen-select').chosen();


        $('body').delegate('.btn-view','click', function(){
            var id = $(this).data('id');

			      rows = new Array();
            $.ajax({
                url : 'tjfunctions/viewRequest.php',
                type : 'POST',
                dataType:"json",
                data : { id: id},
                success : function(data){
                    $('#requestid').text(data['1']);
                    $('#inventoryT').text(data['2']);
                    $('#status').text(data['3']);
                    $('#date').text(data['4']);
                    $('#quantityT').text(data['5']);
                    $('#approved').text(data['6']);
                    $('#commentT').text(data['7']);
                    $('#remarks').text(data['8']);
                    $('#budgetT').text(data['9']);

                    $('#viewModal').modal('show');

                }
            });   
        });


            $('body').delegate('.btn-cancel','click', function(){
            var id = $(this).data('id');
            swal({   
                title: "Are you sure?", 
                text: "We will not be able to process this request!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, cancel it!",   
                closeOnConfirm: false }, 
                function(){
                      $.ajax({
                        url : 'tjfunctions/cancelRequest.php',
                        type : 'POST',
                        data : {id: id},
                        success : function(data){
                        swal("Cancelled!", "Your request has been cancelled.", "success"); 
                        loadDatatable();

                        }
                    }); 
                }
            );
        });


            $('body').delegate('.btn-approve','click', function(){
            var id = $(this).data('id');
            $('#approveId').val(id);
            $('#approveModal').modal('show');
        });


    });



        function loadDatatable()
        {
            $('#tblName').dataTable().fnDestroy();
            var dataTable = $('#tblName').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "iDisplayLength": 4,
                    "ajax":{
                        url :"inventoryrequestdatatable.php?loginid="+$('#loginid').val(), // json datasource
                        type: "post",  // method  , by default get
                        error: function(){  // error handling
                            $(".tblName").html("");
                            $("#tblName").append('<tbody class="tblName"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#tblName").css("display","none");
                            
                        }
                    },
                    "columnDefs": [
                        { "width": "15%", "targets": 0 },
                        { "width": "20%", "targets": 1 },
                        { "width": "15%", "targets": 2 },
                        { "width": "10%", "targets": 3 },
                        { "width": "10%", "targets": 4 },
                        { "width": "30%", "targets": 5 },

                      ]
                } );
        }
      </script>
      </div>
      </div>
      <?php 


     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 

<style type="text/css">
	#tblName_length{display: none;}
#tblName_filter{display: none;}
.chosen-container.chosen-container-single {
    width: 100% !important; /* or any value that fits your needs */
}
</style>
