<?php 

require './db1.php';
include("addons.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';
$employeetype = isset($_POST['employeetype']) ? $_POST['employeetype'] : '';

$found = 0;

if($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include './header.php';
    include './sidebar.php';
?>

<div class="poppins shadow p-5">
     <div class="text-center">
          <h2 class="m-0">Personnel Pay/Bonus Notifier</h2>
     </div>
     <div class="d-flex justify-content-center my-5">
          <div class="w-50 d-flex justify-content-center">
               <a href="./emppaybon01.php?loginid=<?php echo $loginid; ?>" class="btn btn-outline-info w-75" role="button">
                    <i class="bi bi-credit-card-fill text-primary" style="font-size: 50px;"></i>
                    <h3>Pay Notifier V1</h3>
               </a>
          </div>
          <div class="w-50 d-flex justify-content-center">
               <a href="./emppaybonV2.php?loginid=<?php echo $loginid; ?>" class="btn btn-outline-info w-75" role="button">
                    <i class="bi bi-credit-card-2-front-fill text-primary" style="font-size: 50px;"></i>
                    <h3>Pay Notifier V2</h3>
               </a>
          </div>
     </div>
</div>

<div class="my-5">
     <a href="index2.php?loginid=<?php echo $loginid; ?>" class="poppins fw-semibold text-black border border-1 border-primary btn btn-outline-primary" style="padding: 1% 5.5%;" role="button">Back</a>
</div>

<?php 
    include ("footer.php");
} else {
    include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
