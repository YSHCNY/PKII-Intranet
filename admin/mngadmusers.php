
<style>
  table td, table th {
    padding: 8px;
}


table tr {
    height: 50px;
}
</style>

<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">New Admin User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'mngadmuseradd.php';?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 
      </div>
    </div>
  </div>
</div>


<div class="shadow  p-4">


<?php

  if($accesslevel >= 4 && $accesslevel <= 5) {




    
    // Start session to retrieve the message
    session_start();
    if (isset($_SESSION['success'])) {
      // Display the alert using Bootstrap
      echo '<div id="alertsuccess" class="alert alert-success" role="alert">';
      echo $_SESSION['success'];
      echo '</div>';

    
      unset($_SESSION['success']);
  }
  ?>

<script>
  // JavaScript to hide the alert after 1 second
  $(document).ready(function(){
      setTimeout(function(){
          $("#alertsuccess").fadeOut("slow", function(){
              $(this).remove();
          });
      }, 3000); 
  });
</script>


<?php


    // Check if message exists in session
    if (isset($_SESSION['message'])) {
        // Display the alert using Bootstrap
        echo '<div id="alertDiv" class="alert alert-danger" role="alert">';
        echo $_SESSION['message'];
        echo '</div>';

      
        unset($_SESSION['message']);
    }
    ?>

<script>
    // JavaScript to hide the alert after 1 second
    $(document).ready(function(){
        setTimeout(function(){
            $("#alertDiv").fadeOut("slow", function(){
                $(this).remove();
            });
        }, 3000); 
    });
</script>



<?php
session_start();
    if (isset($_SESSION['changepass'])) {
      // Display the alert using Bootstrap
      echo '<div id="changepass" class="alert alert-warning" role="alert">';
      echo $_SESSION['changepass'];
      echo '</div>';

    
      unset($_SESSION['changepass']);
  }
  ?>

<script>
  // JavaScript to hide the alert after 1 second
  $(document).ready(function(){
      setTimeout(function(){
          $("#changepass").fadeOut("slow", function(){
              $(this).remove();
          });
      }, 3000); 
  });
</script>
<?php
   
    echo "<div class = 'row p-4' >";
    echo"<div class = 'col'>";
    echo "<p class = 'fs-4 text-dark mb-0 fw-bold'>Admin Login</p>";
    echo "<p class = 'fs-5 text-muted'>Manage admin user's login data</p>";
    echo "</div>";

    echo "<div class = 'col '>";

    ?>
<!-- Button trigger modal -->
<div class="text-end">
<button type="button" class = 'mainbtnclr px-3 py-2 border-0 text-decoration-none rounded-3 text-white' data-toggle="modal" data-target="#staticBackdrop">
  + New Admin
</button>
</div>



<?php
    echo "</div>";
    
    echo "</div>";



   echo "<div class = 'table-responsive'>";
    echo "<table id = 'admins' class='bg-white table-striped table-hover' style='width:100%'>";

echo "<thead>";
    echo "<tr>";

  echo "<th>User</th>";
  echo "<th>User Level</th>";
  echo "<th>Created</th>";
  echo "<th>Employee ID</th>";
  echo "<th>Name</th>";
  echo "<th>Status</th>";
  echo "<th>Change password</th>";
  echo "<th>Edit</th>";
  echo "<th>Remove</th>";

  echo "</tr>";
echo "</thead>";

  echo "<tbody>";
  include 'manageadmintbl.php';
    echo "</tbody>";
  }

  echo "</table>";
// end contents here
?>
</div>

  <?php
     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
		$result=$dbh2->query($resquery);
 
     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
