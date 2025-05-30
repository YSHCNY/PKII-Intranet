<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("addons.php");
     include ("header.php");
     include ("sidebar.php");
    // edit body-header
     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";
     ?>

     <div id="myModal" class="modal fade" role="dialog">
     <form id='frmAddEdit' method="POST" action='tjfunctions/addPrimaryAccountCode.php'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Project Account Code Primary</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <input type='hidden' value='0' id='actionId' name='actionId' />
                <input type='hidden' value='<?php echo $loginid; ?>' id='loginid' name='loginid' />
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='accountCode' name='accountCode' placeholder="Account Code" />   
                </div>
                <div class='form-group'>
                    <input type="text" required="true" class='form-control' id='accountName' name='accountName' placeholder="Account Name" />   
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
     <!-- <input class='btn form-control' type="text" id="searchDT" placeholder="Search...."  style='width:30%; text-align: left; border: 1px solid #ddd;' /> -->
         <button id="btnAdd" class="btn btn-primary">Add Primary Account Code</button>
     <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
     <thead>
         <tr>
             <td>ID</td>
             <td>Account Code</td>
             <td>Account Name</td>
             <td>Created At</td>
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

                }  
            }};
            addEditForm.ajaxForm(optionsAddEditForm);
            loadDatatable();

 

            $('body').delegate('.btn-edit','click', function(){
            var id = $(this).data('id');

              $.ajax({
                  url : 'tjfunctions/viewPrimaryAccountCode.php',
                  type : 'POST',
                  dataType:"json",
                  data : { id: id},
                  success : function(data){
                      $('#accountCode').val(data['1']);
                      $('#accountName').val(data['2']);
                      $('#actionId').val(id);

                      $('#myModal').modal('show');

                      }
                  });   
              });

            $('#btnAdd').on('click',function(){
              $('#myModal').modal('show');
            });



            $('body').delegate('.btn-delete','click', function(){
            var id = $(this).data('id');
                swal({   
                    title: "Are you sure?", 
                    text: "You want to delete this item!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false }, 
                    function(){
                          $.ajax({
                            url : 'tjfunctions/deletePrimaryAccountCode.php',
                            type : 'POST',
                            data : {id: id},
                            success : function(data){
                            swal("Deleted!", "Your has been Deleted!", "success"); 
                            loadDatatable();

                            }
                        }); 
                    }
                );
            });

            // $('.chosen-select').chosen();
            $('#searchDT').keyup(function(){
            var oTable = $('#tblName').DataTable();
            oTable.search($(this).val()).draw() ;
            });

            $('#myModal').on('hidden.bs.modal', function (e) {
                addEditForm[0].reset();
                $('#actionId').val('0');
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
                        url :"projectprimaryaccountcode.php", // json datasource
                        type: "post",  // method  , by default get
                        error: function(){  // error handling
                            $(".tblName").html("");
                            $("#tblName").append('<tbody class="tblName"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#tblName").css("display","none");
                            
                        }
                    },
                    "columnDefs": [
                        { "width": "10%", "targets": 0 },
                        { "width": "20%", "targets": 1 },
                        { "width": "30%", "targets": 2 },
                        { "width": "20%", "targets": 3 },
                        { "width": "20%", "targets": 4 },
                      ]
                } );
        }
      </script>
      </div>
      </div>
      <style type="text/css">
        #myModal{
          top:65px;
        }
      </style>
      <?php 
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
