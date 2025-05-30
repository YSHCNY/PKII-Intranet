<?php 
require("db1.php");

include ("addons.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';
$company_type = isset($_POST['company_type']) ? $_POST['company_type'] : '';

$found = 0;

if($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include ("header.php");
    include ("sidebar.php");
?>

    <div class = 'p-5 border rounded-4 me-3'>
    <div class=" mb-5">
        <div class="">
            <p class="fs-3 mb-0 fw-semibold">Company Projects</p>
            <p class="fs-5 text-muted">Manage Projects Information <span class = 'fs-5 text-primary'><i>(click rows to view details)</i></span></p>
        </div>
 
      <style>
         tbody tr:hover {
      cursor: pointer !important;
 
    }
      </style>
    </div>
    <div class="container-fluid">
    <div class="table-responsive">

    <?php
        echo "<table class='table-striped table-bordered table-hover' style='width:100%' id ='projects'> ";
        echo "<thead class = ' fs-5 p-4 '>
                <tr>
                    <th>Code</th>
                    <th>Acronym</th>
                    <th>Project Name</th>
                    <th>Services</th>
                    <th>Period</th>
                    <th>Category</th>
                    <th>NK/Others Relationship</th>
                    <th>Classification</th>
            
                </tr>
              </thead>";
        echo "<tbody>";

        include("projectstbl.php");

        echo "</tbody></table>";
        
    

    $res12query = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result12 = $dbh2->query($res12query);
?>  

</div> 

</div>

    <div class="d-flex justify-content-end my-5">
       
    </div>
    </div>

    <div class="d-flex justify-content-end pt-5">
		<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
			<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
		</a>
    </div>
<?php
    include ("footer.php");
}
else {
    include ("logindeny.php");
}

$dbh2->close();
?>