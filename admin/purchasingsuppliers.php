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
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<div class='mainContainer'>";
     echo "<div class='container-fluid'>";

     echo "<p><font size=1>Manage >> Suppliers Modules</font></p>";

     ?>


     <div id="myModal" class="modal fade" role="dialog">
     <form id='frmAddEdit' method="POST" action='tjfunctions/addEditSupplier.php'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Supplier</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                <input type='hidden' value='0' id='actionId' name='actionId' />
                <div class='form-group'>
                    <input type="text" class='form-control' id='company' name='company' placeholder="Company Name" />   
                </div>
                <div class='form-group'>
                    <textarea rows='3' class='form-control' id="address1" name='address1' placeholder="address"></textarea>   
                </div>
                <div class='form-group'>
                    <textarea rows='3' class='form-control' id="address2" name='address2' placeholder="address 2"></textarea>   
                </div>
                <div class='form-group'>
                    <input type="text" class='form-control' id='city' name='city' placeholder="City Name" />   
                </div>
                <div class='form-group'>
                    <input type="text" class='form-control' id='personnel' name='personnel' placeholder="Contact Person" />   
                </div>
                <div class='form-group'>
                    <input type="text" class='form-control' id='contact' name='contact' placeholder="Contact #" />   
                </div>
                <div class='form-group'>
                    <input type="text" class='form-control' id='fax' name='fax' placeholder="Fax #" />   
                </div>
                <div class='form-group'>
                    <input type="text" class='form-control' id='tin' name='tin' placeholder="Tin #" />   
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
         <button id="btnAdd" class="btn btn-primary" data-toggle='modal' data-target='#myModal'>Add Supplier</button>
     <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
     <thead>
         <tr>
             <td>Company Name</td>
             <td>Address</td>
             <td>Contact Person</td>
             <td>Contact #</td>
             <td>Fax #</td>
             <td>Tin #</td>
             <td>ACTIONS</td>
         </tr>
     </thead>
     <tbody>
     <?php 

     $supplier = "SELECT * FROM tblcompany where company_type = 'supplier' ";
     $supplierResult = $dbh2->query($supplier);

     while($row = $supplierResult->fetch_assoc()) 
      {
        echo "<tr>";
        echo "<td>".$row['company'] ."</td>";
        echo "<td>".$row['ofc_address1'].' '.$row['ofc_address2'] .' '.$row['ofc_city']. "</td>";
        echo "<td>".$row['personnel'] ."</td>";
        echo "<td>".$row['ofc_num1'] ."</td>";
        echo "<td>".$row['ofc_fax'] ."</td>";
        echo "<td>".$row['tin_number'] ."</td>";
        echo "<td>"."<button class='btnupdate btn btn-success' data-id='".$row['companyid']."'> Update </button>"."</td>";
        echo "</tr>";

      }

      ?>
      </tbody>
      </table>
      <script>
        $(document).ready(function(){
            loadDatatable();
            $('#searchDT').keyup(function(){
            var oTable = $('#tblName').DataTable();
            oTable.search($(this).val()).draw() ;
            });


        });

        $('body').delegate('.btnupdate','click',function(){
            var id = $(this).data('id');
            $('#actionId').val(id);

            rows = new Array();
            $.ajax({
                url : 'tjfunctions/viewSupplier.php',
                type : 'POST',
                dataType:"json",
                data : { id: id},
                success : function(data){
                    $('#company').val(data['1']);
                    $('#address1').val(data['2']);
                    $('#address2').val(data['3']);
                    $('#city').val(data['4']);
                    $('#personnel').val(data['5']);
                    $('#contact').val(data['6']);
                    $('#fax').val(data['7']);
                    $('#tin').val(data['8']);
                    

                    $('#myModal').modal('show');
                    

                }
            }); 
        });


        var addEditForm = $("#frmAddEdit");

            addEditForm.validate();
            addEditForm[0].reset();
            var optionsAddEditForm = {
            beforeSubmit: function () {
            },
            success: function (response) {
                $('#myM odal').modal('hide');
                swal({ 
                  title: "success",
                  text: "Success",
                  type: "success" 
                  },
                  function(){
                    location.reload();
                });



            }
        };
        addEditForm.ajaxForm(optionsAddEditForm);



        function loadDatatable()
        {
            $('#tblName').dataTable().fnDestroy();
            $('#tblName').dataTable({
                "scrollCollapse": true,
                "sDom": '<"top">t<"bottom"<"col-md-6"i><"col-md-6"p>><"clear">',
                "pagingType": "full_numbers",
                "autoWidth": true,
                "iDisplayLength": 7,
                "sSearch": true,
                // "aoColumnDefs": [   
                //     { "width": "20%"},
                //     { "width": "20%"},
                //     { "width": "20%"},
                // ],
               
            });
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
