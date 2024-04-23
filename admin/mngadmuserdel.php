

<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$adminloginid = $_GET['admid'];
$adminuid = $_GET['admuid'];
$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header2.php");
     

?>


<div class  = 'text-center bg-danger p-5 my-5 mx-auto'>
  <div>
    <h5>Manage Admin Users - Delete</h5>
  </div>
  <div>
    <h1  class = ' text-white'><strong>Deleting admin user:</strong> <?php echo $adminuid; ?></h1>
    <p class = 'text-white fs-2'><i>Warning! This cant be undone.</i></p>
  </div>
  <div>
    <p class = 'text-white'><strong>Are you sure?</strong></p>
  </div>
  <div>

   <?php echo " <a href= 'mngadmuserdel2.php?loginid=$loginid&admid=$adminloginid&admuid=$adminuid' class = 'text-white border rounded-3 border-white bg-danger btn btn-lg' name='confirm' value='Yes'>Yes</a>"; ?>
   
 
   <a href = 'mngadmusers.php?loginid=<?php echo $loginid; ?>' class = 'text-danger border rounded-3 border-white bg-white btn btn-lg' value="No">No</a>
     
 
  </div>
  </div>



<?php

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);


}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

