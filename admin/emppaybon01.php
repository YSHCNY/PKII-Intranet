<?php 

include("db1.php");
include("addons.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';
$employeetype = isset($_POST['employeetype']) ? $_POST['employeetype'] : '';

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
          transform: translateY(-10px);
     }
     @media (max-width: 767px) {
          #pdiv {
               width: 50% !important;
          }
     }
</style>
<div class="poppins shadow p-5">
     <div class="text-center">
          <h2 class="m-0">Personnel Bonus Notifier</h2>
     </div>

    <!-- <form enctype="multipart/form-data" action=emppayproccsv.php method=POST>
        <input type=hidden name=MAX_FILE_SIZE value=50000 />
        Choose a file:<br /><input name=uploadedfile type=file /><br />
        <p><input type=submit value="Process this file" />
    </form> -->

     <div class="d-flex flex-column flex-md-row justify-content-evenly align-items-center my-5">
          <div  id="pdiv" class="w-25">
               <a id="hov" href="emppaybongrpadd.php?loginid=<?php echo $loginid; ?>" class="w-100 btn btn-outline-info py-4 d-flex flex-column align-items-center" role="button">
                    <i class="bi bi-person-plus-fill text-primary" style="font-size: 40px;"></i>
                    <h4 class="text-primary">Prepare Personnel</h4>
               </a>
          </div>
          <div id="pdiv" class="w-25">
               <a id="hov" href="emppayboninfo.php?loginid=<?php echo $loginid; ?>" class="w-100 btn btn-outline-info py-4 d-flex flex-column align-items-center" role="button">
                    <i class="bi bi-wallet-fill text-info-emphasis" style="font-size: 40px;"></i>
                    <h4 class="text-info-emphasis">Bonus Details</h4>
               </a>
          </div>
          <div id="pdiv" class="w-25">
               <a id="hov" href="emppaybonbpi.php?loginid=<?php echo $loginid; ?>" class="w-100 btn btn-outline-info py-4 d-flex flex-column align-items-center" role="button">
                    <i class="bi bi-currency-exchange text-success" style="font-size: 40px;"></i>
                    <h4 class="text-success">Create BPI Transaction</h4>
               </a>
          </div>
          <div id="pdiv" class="w-25">
               <a id="hov" href="emppaybonsend.php?loginid=<?php echo $loginid; ?>" class="w-100 btn btn-outline-info py-4 d-flex flex-column align-items-center" role="button">
                    <i class="bi bi-envelope-paper-fill text-danger" style="font-size: 40px;"></i>
                    <h4 class="text-danger">Send Emails</h4>
               </a>
          </div>
     </div>
</div>

<div class="my-5 d-flex justify-content-end">
     <a href="emppaybon00.php?loginid=<?php echo $loginid; ?>" class="poppins fw-semibold text-black border border-1 border-primary btn btn-outline-primary" style="padding: 1% 5.5%;" role="button">Back</a>
</div>

<?php 
    include ("footer.php");
} else {
    include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>