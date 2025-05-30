<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$projid = $_GET['pid'];

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
     <form id='frmAddEdit' method="POST" action='tjfunctions/addMilestones.php'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Milestone</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <input type='hidden' value='0' id='actionId' name='actionId' />
                <input type='hidden' value='<?php echo $projid; ?>' id='projid' name='projid' />
                <input type='hidden' id='milestone' name='milestone' />


                <div class='form-group'>
                    <select class="form-control" name="milestones" id="milestones">
                        <?php 
                          $res11query="SELECT idprojctgmilestone, code, name, seq FROM tblprojctgmilestone ORDER BY seq ASC";
                          $result11=""; $found11=0; $ctr11=0;
                          $result11=$dbh2->query($res11query);
                          if($result11->num_rows>0) {
                            while($myrow11=$result11->fetch_assoc()) {
                            $found11=1;
                            $ctr11=$ctr11+1;
                            $idprojctgmilestone11 = $myrow11['idprojctgmilestone'];
                            $name11 = $myrow11['name'];
                            echo "<option value='".$idprojctgmilestone11."' >".$name11."</option>";
                            } // while
                          } // if
                        ?>
                    </select>   
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
         <button id="btnAdd" class="btn btn-primary" data-toggle='modal' data-target='#myModal'>Add Milestone</button>
     <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
     <thead>
         <tr>
             <td>Name</td>
             <td>Actions</td>
         </tr>
     </thead>
     <tbody>
      </tbody>
      </table>
      <script>
        $(document).ready(function(){
          $('#milestones').on('change',function(){
            var milestone = $('#milestones').val();
            $('#milestone').val(milestone);
          });

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
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 


