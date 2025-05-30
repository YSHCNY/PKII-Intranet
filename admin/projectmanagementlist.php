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


     <input type="hidden" id="loginid" value="<?php echo $loginid; ?>" />
     <input class='btn form-control' type="text" id="searchDT" placeholder="Search...."  style='width:30%; text-align: left; border: 1px solid #ddd;' />
     <select class="btn form-control chosen-select" tabindex="2" id="filterClass" style="width:20%; border:2px solid #ddd;">
        <option disabled selected>Filter By</option>
        <option value="">All</option>
        <option value="On-Going">On-Going</option>
        <option value="Finished">Finished</option>
     </select>
     <table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
     <thead>
         <tr>
             <td>Project Code</td>
             <td>Project Name</td>
             <td>Status</td>
             <td>Start Date</td>
             <td>End Date</td>
             <td>Progress</td>
             <td>Graph</td>
             <td>Actions</td>
         </tr>
     </thead>
     <tbody>
      </tbody>
      </table>
      <script>
        $(document).ready(function(){
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


        });

        function loadDatatable()
        {
            $('#tblName').dataTable().fnDestroy();
            var dataTable = $('#tblName').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "iDisplayLength": 10,
                    "ajax":{
                        url :"getAllProjects.php?loginid="+$('#loginid').val(), // json datasource
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



<style type="text/css">
.progress {
  margin:20px auto;
  padding:0;
  width:90%;
  height:30px;
  overflow:hidden;
  background:#e5e5e5;
  border-radius:6px;
}

.bar {
    position:relative;
  float:left;
  min-width:1%;
  height:100%;
  background:cornflowerblue;
}

.percent {
    position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  margin:0;
  font-family:tahoma,arial,helvetica;
  font-size:12px;
  color:white;
}
</style>