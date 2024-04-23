<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("addons.php");
     include ("header.php");
     include ("sidebar.php");
    // edit body-header
     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";
     ?>

     <div id="restockModal" class="modal fade" role="dialog">
     <form id='frmRestock' method="POST" action='tjfunctions/restock.php'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Restock Inventory</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <input type='hidden' value='0' id='restockId' name='restockId' />
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='quantity' name='quantity' placeholder="Quantity" />   
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </form>
</div>


     <div id="myModal" class="modal fade" role="dialog">
     <form id='frmAddEdit' method="POST" action='tjfunctions/addInventory.php'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Inventory</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <input type='hidden' value='0' id='actionId' name='actionId' />
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='inventory' name='inventory' placeholder="Inventory Name" />   
                </div>
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='code' name='code' placeholder="Inventory Code" />   
                </div>
                <div class='form-group'>
                    <select class="form-control" name="classification" id="classification">
                        <option disabled selected>Inventory Classification</option>
                        <option value="Fixed Asset">Fixed Asset</option>
                        <option value="Office Supplies">Office Supplies</option>
                    </select>   
                </div>
                <div class='form-group'>
                    <select class="form-control" name="inventorytype" id="inventorytype">
                        <option disabled selected>Inventory Type</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Mouse">Mouse</option>
                        <option value="Paper">Paper</option>
                    </select>   
                </div>
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='holder' name='holder' placeholder="Current Holder" />   
                </div>
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='date' name='date' placeholder="Date Bought" />   
                </div>
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='restock' name='restock' placeholder="Inventory Restock" />   
                </div>
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='quantity' name='quantity' placeholder="Quantity" />   
                </div>
            </div>
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
     <select class="btn form-control chosen-select" tabindex="2" id="filterClass" style="width:20%; border:2px solid #ddd;">
        <option disabled selected>Filter By</option>
        <option value="">All</option>
        <option value="Fixed Asset">Fixed Asset</option>
        <option value="Office Supplies">Office Supplies</option>
     </select>
         <button id="btnAdd" class="btn btn-primary" data-toggle='modal' data-target='#myModal'>Add Inventory</button>
     <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
     <thead>
         <tr>
             <td>Name</td>
             <td>Code</td>
             <td>Classification</td>
             <td>Holder</td>
             <td>Date Logged</td>
             <td>Quantity Left</td>
             <td>Restock Quantity</td>
             <td>Actions</td>
         </tr>
     </thead>
     <tbody>
      </tbody>
      </table>
      <script>
        $(document).ready(function(){

           var addEditForm = $("#frmAddEdit");

            addEditForm.validate();
            addEditForm[0].reset();
            var optionsAddEditForm = {
            beforeSubmit: function () {
            },
            success: function (response) {
                if(response == '1')
                {
                  swal('Error','Inventory code already used','error');
                }
                else
                {
                loadDatatable();
                swal("Success",'Successfully added data.','success');
                addEditForm[0].reset();
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');

                }  
            }};
        addEditForm.ajaxForm(optionsAddEditForm);

        var restockForm = $("#frmRestock");

            restockForm.validate();
            restockForm[0].reset();
            var optionsrestockForm = {
            beforeSubmit: function () {
            },
            success: function (response) {
                if(response == '1')
                {
                  swal('Error','Inventory code already used','error');
                }
                else
                {
                loadDatatable();
                swal("Success",'Successfully Added Inventory.','success');
                restockForm[0].reset();
                $('#restockModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                }

                
            }
        };
        restockForm.ajaxForm(optionsrestockForm);
            loadDatatable();

            $('body').delegate('.btn-make','click',function(){

              $('#restockModal').modal('show');
              $('#restockId').val($(this).data('id'));

            });



            // $('.chosen-select').chosen();
            $('#searchDT').keyup(function(){
            var oTable = $('#tblName').DataTable();
            oTable.search($(this).val()).draw() ;
            });

            $('#filterClass').on('change',function(){
            var oTable = $('#tblName').DataTable();
            oTable.search($(this).find(":selected").val()).draw();
            });

            $('#date').datepicker();



            $('#myModal').on('hidden.bs.modal', function (e) {
                addEditForm[0].reset();
                $('#actionId').val('0')
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
                        url :"datatablesample.php", // json datasource
                        type: "post",  // method  , by default get
                        error: function(){  // error handling
                            $(".tblName").html("");
                            $("#tblName").append('<tbody class="tblName"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#tblName").css("display","none");
                            
                        }
                    },
                    "columnDefs": [
                        { "width": "13%", "targets": 0 },
                        { "width": "12%", "targets": 1 },
                        { "width": "12%", "targets": 2 },
                        { "width": "18%", "targets": 3 },
                        { "width": "8%", "targets": 4 },
                        { "width": "8%", "targets": 5 },
                        { "width": "8%", "targets": 6 },
                        { "width": "21%", "targets": 7 },
                      ]
                } );
        }
      </script>
      </div>
      </div>
      <?php 
     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
