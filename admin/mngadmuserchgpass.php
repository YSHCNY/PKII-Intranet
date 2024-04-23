<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$adminloginid0 = $_GET['admid'];
$adminuid0 = $_GET['admuid'];
$genranchars = $_GET['genranchar'];

$found = 0;
$accesslevel11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

  if($accesslevel >= 4 && $accesslevel <= 5)
  {
   

    $result11 = mysql_query("SELECT adminpw, employeeid FROM tbladminlogin WHERE adminloginid=$adminloginid0 AND adminuid=\"$adminuid0\"", $dbh);
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $adminpw11 = $myrow11[0];
      $employeeid11 = $myrow11[1];
    }

    $result12 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid11\"", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $employeeid12 = $myrow12[0];
      $name_last12 = $myrow12[1];
      $name_first12 = $myrow12[2];
      $name_middle12 = $myrow12[3];
    }
?>
<div class = 'shadow p-5 m-3'>
  <div class = 'border-bottom pb-3 mb-5'>
    <p class = 'fs-2  mb-0'><span class  = 'text-muted'>Change Password for</span>  <span class = 'text-uppercase fw-bold '><?php echo "$employeeid12 - $name_first12 $name_middle12[0] $name_last12" ?></span>  </p>
  </div>
   <form action="mngadmuserchgpass2.php?loginid=<?php echo $loginid ?>&admid=<?php echo $adminloginid0 ?>&admuid=<?php echo $adminuid0 ?>" method="post">
    <label for="username" class = 'text-muted mb-0 text-regular fs-5'>Username:</label>
    <p class = 'fs-4 fw-bold'><?php echo $adminuid0 ?></p>
    <label for="linked_personnel" class = 'text-muted mb-0 text-regular fs-5'>Linked to personnel:</label>
    <p class = 'fs-4 fw-bold'><?php echo "$employeeid12 - $name_first12 $name_middle12[0] $name_last12" ?></p><br>
    <!-- Uncomment the following line if you want to include the change link -->
    <!-- <a href="mngadmuserchgpers.php?loginid=<?php echo $loginid ?>&admid=<?php echo $adminloginid ?>">Change</a> --><br>
    <label for="new_password"  class = 'text-muted mb-0 text-regular fs-5'>New Password:</label>
    <?php if($genranchars != ""): ?>
        <input type="text" name="adminpwnew" value="<?php echo $genranchars ?>">
    <?php else: ?>
        <input type="text" name="adminpwnew">
    <?php endif; ?>
   <a class = 'btn ' href="mngadmuserchgpassgenranchars.php?loginid=<?php echo $loginid ?>&admid=<?php echo $adminloginid0 ?>&admuid=<?php echo $adminuid0 ?>">Generate</a>
   <div class="text-end">
  <a href="mngadmusers.php?loginid=<?php echo $loginid; ?>" class = 'text-decoration-none text-dark mx-2'>Cancel</a>
    <button type="submit" class = 'btn mainbtnclr text-white mx-2' value="Save">Save</button>
    </div>
</form>
</div>
  <?php
  }
 

// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
