<?php

require("db1.php");
include("addons.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';
$employeetype = isset($_POST['employeetype']) ? $_POST['employeetype'] : '';

$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include("header.php");
    include("sidebar.php");

?>
<style>
     #cps-div{
          height: 250px;
     }
     #CPS{
          font-size: 50px;
     }
     #CPSD{
          font-size: 60px;
     }
     #hov{
		transition: transform 0.3s ease;
	}
	#hov:hover{
		transform: translateY(-10px) !important;
	}
</style>
<div class="d-flex justify-content-center mb-5">
     <h2 class="poppins">Custom Payroll System</h2>
</div>
<div id="cps-div" class="d-flex justify-content-evenly poppins rounded-2 shadow">
        <?php
        if (substr($level, -6, 1) == 1) {
          ?>
          <div class="w-25 d-flex justify-content-center align-items-center">
             <a id="hov" href="configrpadd.php?loginid=<?= $loginid ?>" class="btn btn-outline-info w-75 h-75 d-flex flex-column justify-content-center align-items-center" role="button">
                  <i id="CPS" class="bi bi-people-fill text-primary"></i>
                  <h4 class="text-dark">Create Pay Group</h4>
             </a>
          </div>
          <div class="w-25 d-flex justify-content-center align-items-center">
             <a id="hov" href="confipay1.php?loginid=<?= $loginid ?>" class="btn btn-outline-info w-75 h-75 d-flex flex-column justify-content-center align-items-center" role="button">
                  <i id="CPS" class="bi bi-person-fill text-success"></i>
                  <h4 class="text-dark">Individual Info</h4>
             </a>
          </div>
          <div class="w-25 d-flex justify-content-center align-items-center">
             <a id="hov" href="confipayrun.php?loginid=<?= $loginid ?>" class="btn btn-outline-info w-75 h-75 d-flex flex-column justify-content-center align-items-center" role="button">
                  <i id="CPS" class="bi bi-credit-card-2-front-fill text-warning"></i>
                  <h4 class="text-dark">Run Payroll System</h4>
             </a>
          </div>
          <div class="w-25 d-flex justify-content-center align-items-center">
             <a id="hov" href="confipaytools.php?loginid=<?= $loginid ?>" class="btn btn-outline-info w-75 h-75 d-flex flex-column justify-content-center align-items-center" role="button">
                  <i id="CPS" class="bi bi-wrench-adjustable-circle-fill text-danger"></i>
                  <h4 class="text-dark">Post-Process Tools</h4>
             </a>
          </div>
          <?php
        } else {
          ?>
          <div id="cps-div" class="bg-danger-subtle border border-1 border-danger d-flex justify-content-center align-items-center gap-3 poppins rounded-2 shadow">
               <i id="CPSD" class="bi bi-info-circle-fill text-danger"></i>
               <h2 class="m-0 text-danger">Sorry, you don't have access to this page.</h2>
          </div>
          <?php
        }
        ?>
</div>
<div class="d-flex justify-content-end pt-5">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>
<?php

    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result = $dbh2->query($resquery);

    include("footer.php");
} else {
    include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>