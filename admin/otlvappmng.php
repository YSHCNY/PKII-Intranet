<?php 

include("db1.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>

<?php

?>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Approver</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  action = 'otlvappmnginsert.php?loginid=<?php echo $loginid; ?>' method = 'POST'>
        <?php include 'otlvappmngadd.php'; ?>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  type = 'submit' class="btn text-white bg-success">Appoint Approver</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="mb-4">
    <a href="mnghrmod.php?loginid=<?php echo $loginid; ?>" class = 'mainbtnclr text-decoration-none text-white btn'>Back</a>
</div>
<div class = 'shadow border p-4'>
    <h4 class = 'mb-0 pb-0'>Overtime & Leave Approver</h4><p>Manage approver for overtime and leave.</p>
</div>


<div class = 'p-4 border my-5 shadow table-responsive'>
    <div class = 'text-end my-4'>
        <button data-toggle='modal' data-target='#staticBackdrop' class = 'btn bg-success text-white'>+ Add Approver</button>
    </div>
<table id = 'otlmngapp' width = '100%' class = 'table table-lg table-bordered table-striped table-hover'>
    <thead>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
                $Sql1 = "SELECT ManagerApproverID FROM tblManagerApproverOTLeave WHERE ManagerApproverID != 0";
                $resultsql1 = $dbh2->query($Sql1);

                if ($resultsql1->num_rows > 0){
                    while($row = $resultsql1->fetch_assoc()){
                        $approver = $row['ManagerApproverID']; 
                  
                     
               

                $Sql2 = "SELECT * FROM tblcontact LEFT JOIN tblManagerApproverOTLeave on tblcontact.employeeid COLLATE latin1_general_ci = tblManagerApproverOTLeave.ManagerApproverID COLLATE latin1_general_ci WHERE tblcontact.employeeid= $approver";
                $resultsql2 = $dbh2->query($Sql2);
                if ($resultsql2->num_rows > 0){
                    while($row2 = $resultsql2->fetch_assoc()){
                        $Last = $row2['name_last']; 
                        $Name = $row2['name_first']; 
                        $Middle = $row2['name_middle'];
                        $dept = $row2['deptcd'];
                        $ManagerID = $row2['ManagerApproverID'];

                     

                             
                        echo "<tr>";
                        echo "<td>". "$Last, " . "$Name " . "$Middle[0]" ." (".$ManagerID.")</td>";
                        echo "<td>". $dept ."</td>";
                        echo "<td> <a href = 'otlvdel.php?loginid=$loginid&delid=$ManagerID' class = 'btn bg-danger text-white text-decoration-none' >Remove</a></td>";




                        echo "</tr>";
                            }
                     
                }
            
            }
            }
           
        ?>
    </tbody>
</table>

</div>





<?php
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");

} else {

     include("logindeny.php");

}

$dbh2->close();
?> 
