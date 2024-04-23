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
     <form id='frmAddEdit' method="POST" action='tjfunctions/addSecondaryAccountCode.php'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Project Account Code Secondary</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <input type='hidden' value='0' id='actionId' name='actionId' />
                <input type='hidden' value='<?php echo $loginid; ?>' id='loginid' name='loginid' />
                <div class="form-group">
                  <select id="primprojid" name="primprojid" class="form-control">
                  <?php 
                    $result11 = mysql_query("SELECT projinprim_id, account_code , account_name FROM tblfinprojinprimary WHERE status = '1'", $dbh);
                      echo "<option>Select Primary Account Code</option>";
                      while ($myrow11 = mysql_fetch_row($result11))
                      {
                        $projinprim_id = $myrow11[0];
                        $account_code = $myrow11[1];
                        $account_name = $myrow11[2];
                        echo "<option value=\"$projinprim_id\">$account_code - $account_name</option>";
                      }
                  ?>
                  </select>
                </div>
                <div class='form-group'>

                    <?php 

                    echo "<select name='accountCodeFrom' id='accountCodeFrom' class='form-control'>";
                    $result11 = mysql_query("SELECT tblfinglref.glrefid, tblfinglref.glcode, tblfinglref.glname FROM tblfinglref WHERE tblfinglref.version='2' ORDER BY tblfinglref.glcode ASC", $dbh);
                    if($result11 != '')
                    {
                      while($myrow11 = mysql_fetch_row($result11))
                      {
                        $glrefid11 = $myrow11[0];
                        $glcode11 = $myrow11[1];
                        $glname11 = $myrow11[2];
                        echo "<option value=\"$glcode11\">$glcode11 - $glname11</option>";
                      }
                    }
                    echo "</select>";

                    ?>
                    <!-- <input type="text" required="true" class='form-control' id='accountCodeFrom' name='accountCodeFrom' placeholder="Account Code From" />    -->
                </div>
                <div class='form-group'>

                    <?php 
                      $result11 = mysql_query("SELECT tblfinglref.glrefid, tblfinglref.glcode, tblfinglref.glname FROM tblfinglref WHERE tblfinglref.version='2' ORDER BY tblfinglref.glcode ASC", $dbh);
                      echo "<select name='accountCodeTo' id='accountCodeTo' class='form-control'>";
                      if($result11 != '')
                      {
                        while($myrow11 = mysql_fetch_row($result11))
                        {
                          $glrefid11 = $myrow11[0];
                          $glcode11 = $myrow11[1];
                          $glname11 = $myrow11[2];
                          echo "<option value=\"$glcode11\">$glcode11 - $glname11</option>";
                        }
                      }
                      echo "</select>";

                    ?>
                    <!-- <input type="text" required="true" class='form-control' id='accountCodeTo' name='accountCodeTo' placeholder="Account Code To" />    -->
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
         <button id="btnAdd" class="btn btn-primary">Add Secondary Account Code</button>
     <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
     <thead>
         <tr>
             <td>ID</td>
             <td>Primary Account Code</td>
             <td>Account Code From</td>
             <td>Account Code To</td>
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
                  swal('Error','Account Code From cannot be greater than To','error');
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
            loadDatatable();

            

            $('#accountCodeTo').on('change',function(){
              var accountCodeFrom = $('#accountCodeFrom').val();
              var accountCodeTo = $('#accountCodeTo').val();

              $.ajax({
                  url : 'tjfunctions/validateAccountCodes.php',
                  type : 'POST',
                  dataType:"json",
                  data : { accountCodeFrom: accountCodeFrom, accountCodeTo: accountCodeTo},
                  success : function(data){
                        if(data == '1'){
                          swal('Error','Account Code From cannot be greater than To','error');
                        }
                        else{}

                      }
                  });   
              });

 

            $('body').delegate('.btn-edit','click', function(){
            var id = $(this).data('id');

              $.ajax({
                  url : 'tjfunctions/viewSecondaryAccountCode.php',
                  type : 'POST',
                  dataType:"json",
                  data : { id: id},
                  success : function(data){
                      $('#primprojid').val(data['1']);
                      $('#accountCodeFrom').val(data['2']);
                      $('#accountCodeTo').val(data['3']);
                      $('#accountName').val(data['4']);
                      $('#actionId').val(id);

                      $('#myModal').modal('show');

                      }
                  });   
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
                            url : 'tjfunctions/deleteSecondaryAccountCode.php',
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


            $('#btnAdd').on('click',function(){
              $('#myModal').modal('show');
            });

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
                    "iDisplayLength": 10,
                    "ajax":{
                        url :"projectSecondaryAccountCode.php", // json datasource
                        type: "post",  // method  , by default get
                        error: function(){  // error handling
                            $(".tblName").html("");
                            $("#tblName").append('<tbody class="tblName"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#tblName").css("display","none");
                            
                        }
                    },
                    "columnDefs": [
                        { "width": "5%", "targets": 0 },
                        { "width": "20%", "targets": 1 },
                        { "width": "15%", "targets": 2 },
                        { "width": "15%", "targets": 3 },
                        { "width": "15%", "targets": 4 },
                        { "width": "10%", "targets": 5 },
                        { "width": "20%", "targets": 6 }
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
