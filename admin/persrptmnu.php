<?php 
include("db1.php");
include("addons.php");

$loginid = $_GET['loginid'];
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
               transition: transform 0.3s ease;
          }
          #hov:hover{
               color: white !important;
               transform: translateY(-10px);
          }
          #hovb:hover{
               color: white !important;
          }
     </style>
     <div class="poppins shadow p-5">
          <div class="text-center">
               <h2 class="mt-0 mb-5">HR Reports</h2>
          </div>
          <div class="d-flex justify-content-evenly">
               <div style="width: 15%;">
                    <form action="persrptemployee.php?loginid=<?php echo $loginid; ?>" method="post">
                         <input type="submit" value="List of Employees" id="hov" class="w-100 h-100 p-4 fs-4 fw-medium border border-1 border-primary rounded-3 btn btn-outline-primary">
                    </form>
               </div>
               <div style="width: 15%;">
                    <form action="persrptconsultant.php?loginid=<?php echo $loginid; ?>" method="post">
                         <input type="submit" value="List of Consultants" id="hov" class="w-100 h-100 p-4 fs-4 fw-medium border border-1 border-primary rounded-3 btn btn-outline-primary">
                    </form>
               </div>
               <div style="width: 15%;">
                    <form action="persrptbenefits.php?loginid=<?php echo $loginid; ?>" method="post">
                         <input type="submit" value="List of Gov't ID's" id="hov" class="w-100 h-100 p-4 fs-4 fw-medium border border-1 border-primary rounded-3 btn btn-outline-primary">
                    </form>
               </div>
               <div style="width: 15%;">
                    <form action="persrptphilhealther2.php?loginid=<?php echo $loginid; ?>" method="post">
                         <input type="submit" value="Philhealth ER2" id="hov" class="w-100 h-100 p-4 fs-4 fw-medium border border-1 border-primary rounded-3 btn btn-outline-primary">
                    </form>
               </div>
               <div style="width: 15%;">
                    <form action="persrptemails.php?loginid=<?php echo $loginid; ?>" method="post">
                         <input type="submit" value="List of emails" id="hov" class="w-100 h-100 p-4 fs-4 fw-medium border border-1 border-primary rounded-3 btn btn-outline-primary">
                    </form>
               </div>
               <div style="width: 15%;">
                    <form action="persrptbdays.php?loginid=<?php echo $loginid; ?>" method="post">
                         <input type="submit" value="List of birthdays" id="hov" class="w-100 h-100 p-4 fs-4 fw-medium border border-1 border-primary rounded-3 btn btn-outline-primary">
                    </form>
               </div>
          </div>
     </div>

     <div class="my-5 d-flex justify-content-end">
          <a href="index2.php?loginid=<?php echo $loginid; ?>" id="hovb" class="poppins fw-semibold text-black border border-1 border-primary btn btn-outline-primary" style="padding: 1% 5.5%;" role="button">Back</a>
     </div>

<?php
    $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 
    include ("footer.php");
} else {
    include("logindeny.php");
}

mysql_close($dbh);
?> 