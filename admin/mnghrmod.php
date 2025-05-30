<?php 

include("db1.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

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
         transform: translateY(-5px);
    }
    #hovb:hover{
        color: white !important;
    }
</style>

<div class="poppins shadow p-5">

     <div class="text-start">
          <h2 class="mt-2 mb-4">HR Modules</h2>
     </div>
<?php
  if($accesslevel >= 4) {
?>
          <div>
          <form action="mnghrofctimelogsync.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
               <div class="w-50">
                    <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Sync time log</button>
               </div>
               <div class="w-50">
                    <h4>Upload/sync office time log of biometrics to intranet's maindb</h4>
               </div>
          </form>
          </div>
          <div>
          <form action="mnghruseridsync.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
               <div class="w-50">
                    <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Sync userid</button>
               </div>
               <div class="w-50">
                    <h4>Upload/sync userid of biometrics to intranet's maindb</h4>
               </div>
          </form>
          </div>
          <div>
          <form action="mnghrempidlink.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
               <div class="w-50">
                    <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Link EmployeeID</button>
               </div>
               <div class="w-50">
                    <h4>Link EmployeeID to Fingerprint Biometrics ID</h4>
               </div>
          </form>
          </div>
          <div>
          <form action="mnghrpositions.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
               <div class="w-50">
                    <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Job Positions</button>
               </div>
               <div class="w-50">
                    <h4>Manage job positions for employee profiles and project deployments</h4>
               </div>
          </form>
          </div>

    <hr class="border border-1 border-black">
     <div class="text-start">
          <h2 class="mt-2 mb-4">Time & Attendance</h2>
     </div>

          <div>
          <form action="otlvappmng.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
                    <div class="w-50">
                         <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Overtime & Leave Approver</button>
                    </div>
                    <div class="w-50">
                         <h4>Manage Overtime and Leave approver</h4>
                    </div>
          </form>
          <form action="mnghrempshiftctg.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
                    <div class="w-50">
                         <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Shifts category</button>
                    </div>
                    <div class="w-50">
                         <h4>Manage different shifts category for payroll system computation</h4>
                    </div>
          </form>
          </div>

          <div>
               <form action="hrtimeattholidays.php?loginid=<?php echo $loginid; ?>" method="post" name="modhrtaholidays" class="d-flex justify-content-between align-items-center">
                    <div class="w-50">
                         <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium"" role="button">Holidays</button>
                    </div>
                    <div class="w-50">
                         <h4>Manage holidays and shortened periods for time & attendance and payroll system</h4>
                    </div>
               </form>
          </div>
          <div>
               <form action="hrtimeattleave.php?loginid=<?php echo $loginid; ?>" method="post" name="modhrtaleave" class="d-flex justify-content-between align-items-center">
                    <div class="w-50">
                         <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Leave category</button>
                    </div>
                    <div class="w-50">
                         <h4>Manage type of leaves including quotas</h4>
                    </div>
               </form>
          </div>

    <hr class="border border-1 border-black">
    <div class="text-start">
         <h2 class="mt-2 mb-4">Government Benefits Tables</h2>
    </div>

          <div>
          <form action="mnghrbnftssscontrib.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
          <div class="w-50">
               <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">SSS contributions</button>
          </div>
          <div class="w-50">
               <h4>Manage SSS contributions table</h4>
          </div>
          </form>
          </div>
          <div>
          <form action="mnghrbnftphlhealth.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
               <div class="w-50">
                    <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Philhealth contributions</button>
               </div>
               <div class="w-50">
                    <h4>Manage Philhealth contributions table</h4>
               </div>
          </form>
          </div>
     <hr class="border border-1 border-black">
     <div class="text-start">
          <h2 class="mt-2 mb-4">Personnel Requisition Form</h2>
     </div>

          <div>
          <form action="mnghrpersreqappr.php?loginid=<?php echo $loginid; ?>" method="post" name="mnghrpersreqappr" class="d-flex justify-content-between align-items-center">
               <div class="w-50">
                    <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Personnel Requisition Approvers</button>
               </div>
               <div class="w-50">
                    <h4>Manage approvers of personnel requisition form</h4>
               </div>
          </form>
          </div>
          <div>
          <form action="mnghrpersreqsteps.php?loginid=<?php echo $loginid; ?>" method="post" name="mnghrpersreqsteps" class="d-flex justify-content-between align-items-center">
               <div class="w-50">
                    <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Recruitment steps</button>
               </div>
               <div class="w-50">
                    <h4>Manage titles of recruitment/hiring steps (1-10)</h4>
               </div>
          </form>
          </div>
<?php
  }
?>
     </div>

     <div class="my-5 d-flex justify-content-end">
          <a href="index2.php?loginid=<?php echo $loginid; ?>" id="hovb" class="poppins fw-semibold text-black border border-1 border-primary btn btn-outline-primary" style="padding: 10px 60px;" role="button">Back</a>
     </div>
<?php
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");

} else {

     include("logindeny.php");

}

$dbh2->close();
?> 
