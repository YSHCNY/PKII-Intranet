<?php
//
// vprojects.php
// fr: vc/index.php
//page 21

?>
	
	<div class="">
				<div class=" py-5 mainbgc">
				<h3 class = "text-white ms-5 fs-2 p-5">PKII Projects Listing</h3>
				</div>
			</div>
	<div class="">

	
			
		
		<div class="container my-5">
  <div class="row">
    <?php 
      include '../m/qryproj.php';

      $param11=count($projectidArr);
      for($x11 = 0; $x11 < $param11; $x11++) {
        $found11=1;
        $ctr11=$ctr11+1;
    ?>
    <div class="col-md-6 flex mt-5 ">
      <div class="card h-100 p-5 shadow bg-white rounded-4">
        <div class="card-body p-3">
          <h5 class="card-title"><?php echo $proj_codeArr[$x11]; ?></h5>
          <h6 class="card-subtitle mb-2 text-muted"><?php echo $proj_snameArr[$x11]; ?></h6>
          <h4 class="card-text fw-bold"><?php echo $proj_fnameArr[$x11]; ?></h4>
          <p class="card-text"><span class="text-secondary">Start Date:</span> <?php echo ($date_startArr[$x11]!='0000-00-00') ? date("Y-M-d", strtotime($date_startArr[$x11])) : ''; ?></p>
          <p class="card-text"><span class="text-secondary">End Date:</span> <?php echo ($date_endArr[$x11]!='0000-00-00') ? date("Y-M-d", strtotime($date_endArr[$x11])) : ''; ?></p>
          <form action="index.php?lst=1&lid=<?php echo $loginid; ?>&sess=<?php echo $session; ?>&p=211" method="POST" name="vprojmore">
            <input type="hidden" name="projectid" value="<?php echo $projectidArr[$x11]; ?>">
            <input type="hidden" name="projcode" value="<?php echo $proj_codeArr[$x11]; ?>">
            <button class='p-3 mt-3 border-0 rounded-4 secondarybgc text-white' type="submit">Click for More Info</button>
          </form>
        </div>
      </div>
    </div>
    <?php 
      } // for
      $dbh->close();
    ?>
  </div>
</div>



	</div><!-- class="row" -->

