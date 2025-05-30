<?php 

require("db1.php");
include("clsmcrypt.php");
include("addons");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$found = 0;

$mcrypt = new MCrypt($pin);

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");
?>
<style>
     #cp-apg{
          height: 250px;
     }
     #CPSD{
          font-size: 60px;
     }
</style>
<div class="text-center mb-5">
     <h2 class="poppins">Confidential Payroll</h2>
</div>
<div class="poppins border border-1 rounded-2 shadow py-3">
<?php
if(substr($level, -6, 1) == 1) {
     $result0 = mysql_query("SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
     while ($myrow0 = mysql_fetch_row($result0)) {
          $found0 = 1;
          $employeeid = $myrow0[0];
          $accesslevel = $myrow0[1];
     }

     if($accesslevel == 5) {
        $result1 = mysql_query("SELECT DISTINCT groupname, datecreated, accesslevel FROM tblconfipaygrp WHERE accesslevel<=5", $dbh);
     }
     else {
        $result1 = mysql_query("SELECT DISTINCT groupname, datecreated, accesslevel FROM tblconfipaygrp WHERE accesslevel<=3", $dbh);
     }
?>
     <h3 class="text-center mb-5">Add Payroll Group</h3>
     <h4 class="text-center">List of Available Payroll Groups</h4>
     <div class="text-center mb-5">
<?php
    while ($myrow1 = mysql_fetch_row($result1)) {
          $found1 = 1;
          $groupname1 = $myrow1[0];
          $datecreated1 = $myrow1[1];
          $confiaccesslevel1 = $myrow1[2];
          if($confiaccesslevel1 >= 5 && $accesslevel >= 5) {
               $decrypted = $mcrypt->decrypt($groupname1);
               $groupname1 = $decrypted;
               echo "<p>$groupname1 $datecreated1</p>";
          } else if($confiaccesslevel1 <= 4) {
               echo "<p class='poppins'><b>$groupname1 </b>" . date("M d, Y", strtotime($datecreated1)) . "</p>";
          }
    }
?>
    </div>
    <div class="text-center">
        <form method="post" action="configrpadd2.php?loginid=<?php echo $loginid ?>" class="d-flex flex-column align-items-center">
               <h4>Enter new payroll group name</h4>
               <input type="text" name="groupname" required class="text-black border border-1 border-black rounded-2 px-2 mb-3" style="width: 275px; height: 35px;">
               <select name="confiaccesslevel" class="bg-transparent text-black border border-1 border-black rounded-2 px-2 mb-5" style="width: 275px; height: 35px;">
                    <option value="3">Level 3 : Standard</option>
                    <?php if($accesslevel==5) { ?>
                         <option value="5">Level 5 : Confidential</option>
                    <?php } ?>
               </select>
               <input type="submit" value="Add Pay Group" class="btn btn-success fw-medium" style="width: 275px; height: 40px;">
        </form>
    </div>

<?php
     } else {
?>
     <div id="cp-apg" class="bg-danger-subtle border border-1 border-danger d-flex justify-content-center align-items-center gap-3 poppins rounded-2 shadow">
          <i id="CPSD" class="bi bi-info-circle-fill text-danger"></i>
          <h2 class="m-0 text-danger">Sorry, you don't have access to this page.</h2>
     </div>
<?php
}

?>
</div>

<div class="d-flex justify-content-end mt-4">
     <a href="<?php echo 'confipay.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
          <button class="rounded-3 border border-1 px-3" style="height: 40px; background-color: #0a1d44;">Back to Custom Payroll Menu</button>
     </a>
</div>

<?php

$result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>