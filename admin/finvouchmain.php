<?php 

include("db1.php");
include("datetimenow.php");
include ("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] : '';
$username = (isset($_POST['username'])) ? $_POST['username'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here
?>
<style>
     #mvp-div{
          height: 300px;
     }
</style>
<div class="d-flex justify-content-center mb-5">
     <h2 class="poppins">Manage Vouchers</h2>
</div>
<div id="mvp-div" class="d-flex justify-content-evenly py-5 poppins rounded-2 shadow">

     <div class="bg-success-subtle w-25 py-2 px-5 border border-1 border-success-subtle rounded-3 shadow">
          <div class="h-25 d-flex justify-content-center align-items-center border-bottom border-success-subtle">
               <h2 class="m-0 text-black">Vouchers</h2>
          </div>
          <div class="h-75 px-3 d-flex flex-column justify-content-center align-items-center">
               <form action="finvouchlist.php?loginid=<?php echo $loginid; ?>" method="post" class="w-100">
                    <input type="submit" value="List Vouchers" role="button" class="btn btn-info w-100">
               </form>
               <form action="finvouchadd.php?loginid=<?php echo $loginid; ?>" method="post" class="w-100">
                    <input type="submit" value="Add new entry" role="button" class="btn btn-info w-100">
               </form>
          </div>
     </div>

     <div class="bg-primary-subtle w-25 py-2 px-5 border border-1 border-primary-subtle rounded-3 shadow">
          <div class="h-25 d-flex justify-content-center align-items-center border-bottom border-primary-subtle">
               <h2 class="m-0 text-black">Working Paper</h2>
          </div>
          <div class="h-75 px-3 d-flex flex-column justify-content-center align-items-center">
               <form action="finvouchworkplist.php?loginid=<?php echo $loginid; ?>" method="post" class="w-100">
                    <input type="submit" value="List" role="button" class="btn btn-info w-100">
               </form>
               <?php if($accesslevel >= 4 && $accesslevel <= 5) { ?>
                    <form action="finvouchworkpgen.php?loginid=<?php echo $loginid; ?>" method="post" class="w-100">
                         <input type="submit" value="Generate" role="button" class="btn btn-info w-100">
                    </form>
               <?php } ?>
          </div>
     </div>

     <div class="bg-warning-subtle w-25 py-2 px-5 border border-1 border-warning-subtle rounded-3 shadow">
          <div class="h-25 d-flex justify-content-center align-items-center border-bottom border-warning-subtle">
               <h2 class="m-0 text-black">Stravis</h2>
          </div>
          <div class="h-75 px-3 d-flex flex-column justify-content-center align-items-center">
               <form action="finstrvsamng.php?loginid=<?php echo $loginid; ?>" method="post" class="w-100">
                    <input type="submit" value="Form-A Manage" role="button" class="btn btn-info w-100">
               </form>
               <form action="finstrvsalst.php?loginid=<?php echo $loginid; ?>" method="post" class="w-100">
                    <input type="submit" value="Form-A Generate" role="button" class="btn btn-info w-100">
               </form>
          </div>
     </div>

</div>
<div class="d-flex justify-content-end mt-4">
     <button class="border border-1 rounded-3" style="width: 12.5%; height: 40px; background-color: #0a1d44;">
        <a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">Back</a>
     </button>
</div>

<?php
// end contents here

$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
$result=$dbh2->query($resquery); 

include ("footer.php");
} else {
    include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
