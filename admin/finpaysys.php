<?php 
include("db1.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] : '';

$found = 0;

if($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include ("header.php");
    include ("sidebar.php");
?>
<style>
	#hov{
		transition: transform 0.2s ease;
        border: 1px solid #0a1d44;
        background-color: white !important;
        transition: .3s ease;
	}
	#hov:hover{
        border: 1px solid #0a1d44;
        color: white !important;
        background-color: #0a1d44 !important;
		transform: translateY(-10px) !important;
	}
</style>
<div class=" shadow rounded p-5">
  <div class="mb-5">
    <h4 class="mb-0 pb-0">Payroll System</h4>
    <p class="">Manage automated payroll system.</p>
  </div>

  <div class="row text-center">
      <?php if($accesslevel >= 3): ?>
        <div class='col-lg-2 col-md-12 text-center m-2'>
        <a href="finpaysystasumm.php?loginid=<?php echo $loginid; ?>" id="hov" class="btn w-100 text-dark">Process Payroll</a>
    </div>

    <div class='col-lg-2 col-md-12 text-center m-2'>
        <a href="hrtimeattincome.php?loginid=<?php echo $loginid; ?>&frm=pyrll" id="hov" class="btn w-100 text-dark">Additional income</a>
    </div>

    <div class='col-lg-2 col-md-12 text-center m-2'>
        <a href="finpaysysded.php?loginid=<?php echo $loginid; ?>&frm=pyrll" id="hov" class="btn w-100 text-dark">Deductions</a>
    </div>
      <?php endif; ?>

      <?php if($accesslevel >= 4): ?>
        <div class='col-lg-2 col-md-12 text-center m-2'>
            <a href="finpaysyscompute.php?loginid=<?php echo $loginid; ?>" id="hov" class="btn w-100 text-dark">Re-Process payroll</a>
        </div>

        <div class='col-lg-2 col-md-12 text-center m-2'>
            <a href="finpaysyspost.php?loginid=<?php echo $loginid; ?>" id="hov" class="btn w-100 text-dark">Post-process tools</a>
        </div>
      <?php endif; ?>
  </div>
</div>
  <!-- <div class = 'col-lg-2 col-md-12 text-center m-2'>
              <form action="finpaysysempinfo.php?loginid=<?php echo $loginid; ?>" method="post" name="finpaysysempinfo">
                  <input id="hov" type="submit" value="Indiv.Info / Proj.Pct" class="btn " >
              </form>
          </div> -->

<?php
    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result = $dbh2->query($resquery); 
    include ("footer.php");
} else {
    include("logindeny.php");
}
$dbh2->close();
?>