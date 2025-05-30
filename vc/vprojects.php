<?php
//
// vprojects.php
// fr: vc/index.php
//page 21

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!-- DataTables CSS -->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery (Required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
$(document).ready(function() {
    $('#projecttable').DataTable({
        pageLength: 50,
        lengthMenu: [[50, -1], [50, "All"]],
        order: [[3, 'desc']], // Sort by the second column (index starts from 0)
        language: {
            lengthMenu: "Display _MENU_ entries per page",
            info: "Showing _START_ to _END_ of _TOTAL_ entries"
        }
    });
});


</script>

<style>

  th{
    white-space: nowrap !important;
  }
</style>

	<div class="">
	<div class=" p-5 <?php echo $hero?>" >
		<div class="text-center"><h3 class = 'mb-5 mt-2 py-5 fw-bold text-uppercase text-white'>PKII PROJECT LISTINGS</h3></div>
		</div>
	</div>



<div class="container my-5">

<div class="shadow <?php echo $mainbg?>  rounded p-5">
<table class="table <?php echo $tableinfo?> table-bordered table-hover table-striped" id = 'projecttable'>
  <thead style="height: 60px;">
    <tr class = ''>
      <th  class="<?php echo $subtext?>">Project code</th>
      <th  class="<?php echo $subtext?>">Project Acronym</th>
      <th  class="<?php echo $subtext?>">Project Name</th>
      <th  class="<?php echo $subtext?>" >From</th>
      <th  class="<?php echo $subtext?>" >To</th>

      <th  class="<?php echo $subtext?>">Action</th>
    </tr>
  </thead>
<?php 

	include '../m/qryproj.php';

  $param11 = count($projectidArr);
  for ($x11 = 0; $x11 < $param11; $x11++) {
      $found11 = 1;
      $ctr11 = $ctr11 + 1;
  ?>
      <tr>
          <td class="text-center align-middle <?php echo $maintext?>"><strong><?php echo $proj_codeArr[$x11] ?></strong></td>
          <td class="text-center align-middle <?php echo $maintext?>"><strong><?php echo $proj_snameArr[$x11] ?></strong></td>
          <td class="align-middle <?php echo $maintext?>"><?php echo $proj_fnameArr[$x11] ?></td>
          <?php if ($date_startArr[$x11] != '0000-00-00') { ?>
              <td class="text-center align-middle <?php echo $maintext?>"><?php echo date("Y-M-d", strtotime($date_startArr[$x11])) ?></td>
          <?php } else { ?>
              <td class="text-center align-middle <?php echo $maintext?>"></td>
          <?php } ?>
          <?php if ($date_endArr[$x11] != '0000-00-00') { ?>
              <td class="text-center align-middle <?php echo $maintext?>"><?php echo date("Y-M-d", strtotime($date_endArr[$x11])) ?></td>
          <?php } else { ?>
              <td class="text-center align-middle <?php echo $maintext?>"></td>
          <?php } ?>
          <form action="index.php?lst=1&lid=<?php echo $loginid ?>&sess=<?php echo $session ?>&p=211" method="POST" name="vprojmore">
              <input type="hidden" name="projectid" value="<?php echo $projectidArr[$x11] ?>">
              <input type="hidden" name="projcode" value="<?php echo $proj_codeArr[$x11] ?>">
              <td class="align-middle "><button id="hov" class="btn btn-primary fw-medium" type="submit">More Info</button></td>
          </form>
      </tr>
  <?php 
  }

$dbh->close();
?> 
</table>
</div>

</div>




