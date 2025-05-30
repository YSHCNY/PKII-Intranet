<?php 
 // Start session to retrieve the message
 session_start();
require("db1.php");
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

<style>
	   tbody tr:hover {
      cursor: pointer !important;
 
    }
</style>

<!-- alerttttttttttttttttttttt -->
	<?php
    
    
	// Check if message exists in session
	if (isset($_SESSION['deleted'])) {
		// Display the alert using Bootstrap
		echo '<div id="alertDiv" class="alert alert-danger" role="alert">';
		echo $_SESSION['deleted'];
		echo '</div>';

	  
		unset($_SESSION['deleted']);
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
    
	if (isset($_SESSION['added'])) {
	  // Display the alert using Bootstrap
	  echo '<div id="alertsuccess" class="alert alert-success" role="alert">';
	  echo $_SESSION['added'];
	  echo '</div>';

	
	  unset($_SESSION['added']);
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

<div class=" mb-4">
<!-- <a href="<?php echo 'hrtimeatt.php?loginid=' . $loginid ?>" class="text-white  text-decoration-none mainbtnclr btn">
		Back
	</a> -->
	<?php include 'timeattmenu.php'; ?>
	</div>
<div class=" shadow  mb-4 p-5">
	
    <?php 
	

	
	if($accesslevel >= 4): ?>
        <form action="hrtimeattpaygrpadd.php?loginid=<?php echo $loginid; ?>" method="post" name="modhrtapaygrpadd" class="">
		<h5 class="fw-bold mb-0">Pay Group</h5>
		<p class = 'text-secondary'>Manage pay group lists</p>
		<div class=" ">
			<div class="row gap-4">
				<div class= ' '>
					
					<p class="fw-medium text-secondary mb-1">Pay group name: </p>
					<input name="paygroupname" placeholder="Enter Pay Group Name" required class="p-4  form-control rounded" >
				</div>
				<div class = ''>
					<p class="fw-medium text-secondary mb-1">Description: </p>
					<textarea placeholder="Description here..." name="remarks" class="form-control p-4  rounded"></textarea>
				</div>
				<div class="text-sm-end text-center  mt-4">
					<button type="submit" class="btn bg-success text-white">Add pay group</button>
				</div>
			</div>
		</div>
        </form>
    <?php endif; ?>
	</div>



<div class="table-responsive p-5 shadow mt-4 mb-2">

<div class ='mb-5 '>
<h5 class="fw-medium mb-0">Pay Group List</h5>
<p class="text-info"><i>(Click rows to manage list)</i></p>
</div>


	<table class="table-bordered table-hover" width = '100%' id = 'pigru'>
	<thead>
    <tr class="">
		<th class="p-4  text-secondary">Pay Group Name</th>
		<th class="py-4  text-secondary">Description</th>
		<th class="py-4 text-center text-secondary" >Action</th>
	</tr>
	</thead>
<tbody>
    <?php
    $result11=""; $found11=0; $ctr11=0;
    $result11 = mysql_query("SELECT idtblhrtapaygrp, datecreated, paygroupname, remarks FROM tblhrtapaygrp ORDER BY timestamp DESC", $dbh);
    if($result11 != "") {
        while($myrow11 = mysql_fetch_row($result11)) {
            $found11 = 1;
            $idtblhrtapaygrp11 = $myrow11[0];
            $datecreated11 = $myrow11[1];
            $paygroupname11 = $myrow11[2];
            $remarks11 = $myrow11[3];
    ?>
	<!-- <a class="fs-4 fw-medium" href=""></a> -->
            <tr class='clickable-row' data-href='hrtimeattpaygrpedit.php?loginid=<?php echo $loginid; ?>&idpg=<?php echo $idtblhrtapaygrp11; ?>' target='_blank'>
				<!-- <a class="fs-4 fw-medium" href="hrtimeattpaygrpedit.php?loginid=<?php echo $loginid; ?>&idpg=<?php echo $idtblhrtapaygrp11; ?>"></a> -->
				<td class="  "><?php echo $paygroupname11; ?></td>
				<td class=" "><?php echo $remarks11; ?></td>
           
            	<td class=" text-center"><a class="text-white" href="hrtimeattpaygrpdel.php?loginid=<?php echo $loginid; ?>&idpg=<?php echo $idtblhrtapaygrp11; ?>&idpgbtn=true&idpgname=<?php echo $paygroupname11; ?>" onClick="return confirm('Are you absolutely sure you want to delete?');"><button type="button" class="btn bg-danger text-white">Delete</button></a></td>
			</tr>
    <?php
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

mysql_close($dbh);
$dbh2->close();
?>



<script>
document.addEventListener("DOMContentLoaded", function() {
    var rows = document.querySelectorAll(".clickable-row");
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});

</script>