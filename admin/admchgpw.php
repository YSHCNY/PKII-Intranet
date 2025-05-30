<?php 

include("db1.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] : '';

$found = 0;

if($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include("header.php");
    include("sidebar.php");

?>
<style>
     .toggle-password{
          font-size: 180%;
          cursor: pointer;
          width: 1% !important;
     }
     .password-input{
          width: 97%;
          margin-left: -18px !important;
     }
     .password-input:focus{
          outline: none !important;
     }
</style>
     <div class="poppins shadow p-5 border border-1 rounded-3">
          <div>
          <h3>Change User Password for
          
          <?php
          $resquery = "SELECT adminuid FROM tbladminlogin WHERE adminloginid = $loginid";
          $result = $dbh2->query($resquery);
          if($result->num_rows > 0) {
               while($myrow = $result->fetch_assoc()) {
                    $adminuid = $myrow['adminuid'];
               }
          }
          ?>

          <?php echo strtoupper($adminuid); ?>
          </h3>
          </div>
          <div class="mb-5">
               <i><strong>Note:</strong> Your password should have a minimum of at least seven (7) alphanumeric characters, with a combination of capital and lowercase letters.</i>
          </div>

          <form method="post" action="admupdatepw.php?loginid=<?php echo $loginid; ?>">
          <input type="hidden" name="username" value="<?php echo $adminuid; ?>">
               <div class="d-flex flex-column mb-3">
                    <label>Current password</label>
                    <div class="d-flex justify-content-between align-items-center border border-1 border-secondary rounded container-fluid">
                         <input type="password" name="oldpassword" class="password-input border-0 py-3 fw-normal">
                         <i class="toggle-password d-flex justify-content-center bi bi-eye"></i>
                    </div>
               </div>
               <div class="d-flex flex-column mb-3">
                    <label>New password</label>
                    <div class="d-flex justify-content-between align-items-center border border-1 border-secondary rounded container-fluid">
                         <input type="password" name="newpassword1" class="password-input border-0 py-3 fw-normal">
                         <i class="toggle-password d-flex justify-content-center bi bi-eye"></i>
                    </div>
               </div>
               <div class="d-flex flex-column mb-5">
                    <label>Confirm new password</label>
                    <div class="d-flex justify-content-between align-items-center border border-1 border-secondary rounded container-fluid">
                         <input type="password" name="newpassword2" class="password-input border-0 py-3 fw-normal">
                         <i class="toggle-password d-flex justify-content-center bi bi-eye"></i>
                    </div>
               </div>
               <div class="d-flex justify-content-end">
                    <input type="submit" value="Change Password" class="btn bg-success border border-1 border-success text-white fw-medium px-5 py-3">
               </div>
               <script>
               document.querySelectorAll('.toggle-password').forEach(function(togglePassword) {
                    togglePassword.addEventListener('click', function() {
                         var passwordInput = this.previousElementSibling;
                         if (passwordInput.getAttribute('type') === 'password') {
                              passwordInput.setAttribute('type', 'text');
                              this.classList.remove('bi-eye');
                              this.classList.add('bi-eye-slash-fill');
                         } else {
                              passwordInput.setAttribute('type', 'password');
                              this.classList.remove('bi-eye-slash-fill');
                              this.classList.add('bi-eye');
                         }
                    });
               });
               </script>
          </form>
     </div>

     <div class="d-flex justify-content-end my-5">
          <a href="<?php echo 'index.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
               <button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back to Login</button>
          </a>
     </div>

    <?php
    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $dbh2->query($resquery);

    include("footer.php");
} else {
    include("logindeny.php");
}

$dbh->close();
$dbh2->close();
?>