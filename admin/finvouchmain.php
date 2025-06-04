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
<div class="my-3">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="btn  m-2 py-2 mainbtnclr text-white" >Back</button>
	</a>
</div>


<div class="p-4 rounded-2 shadow">
<div class=" mb-3 mx-2">
     <h3 class="">Manage Vouchers</h3>
</div>

<div class="row row-cols-sm-1 row-cols-md-1 row-cols-lg-3 p-4">
     <div class="col p-4  rounded-3 border ">
          <div class="">
               <h4 class="">Vouchers</h4>
          </div>

         
               
          <div class="">
     
               <a class= 'btn w-100 m-2 py-2 bg-info text-white' href="finvouchlist.php?loginid=<?php echo $loginid; ?>&rs=ap">List Vouchers</a>
               <a class= 'btn w-100 m-2 py-2 bg-info text-white' href="finvouchadd.php?loginid=<?php echo $loginid; ?>">Add new entry</a>
          </div>
          </div>
     

     <div class="col p-4  rounded-3 border ">
          <div class="">
               <h4 class="">Working Paper</h4>
          </div>
          <div class="">
            
               <?php if($accesslevel >= 4 && $accesslevel <= 5) { ?>
                    <a class= 'btn w-100 m-2 py-2 bg-info text-white' href="finvouchworkpgen.php?loginid=<?php echo $loginid; ?>">Generate</a>
                   
               <?php } ?>
          </div>
     </div>

     <div class="col p-4  rounded-3 border ">
          <div class="">
               <h4 class="">Stravis</h4>
          </div>
          <div class="">
               <a class= 'btn w-100 m-2 py-2 bg-info text-white' href="finstrvsamng.php?loginid=<?php echo $loginid; ?>">Form-A Manage</a>
               <a class= 'btn w-100 m-2 py-2 bg-info text-white' href="finstrvsalst.php?loginid=<?php echo $loginid; ?>">Form-A Generate</a>
            
          </div>
     </div>

</div>
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
