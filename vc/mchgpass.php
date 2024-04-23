<?php
//
// mchgpass.php
// fr: vc/index.php -> menu.php -> indexlist.php
//page 41

include("../m/qryusernm.php"); 

?>


		<div class="mainbgc "> 
            <div class="p-3">
            <h3 class = 'p-5 text-white m-5 fs-3'>Change Password</h3>
            </div>
       
    </div>



<div class="container ">
    <div class="bg-white shadow-lg absolute rounded-3 my-5 p-5">
    <?php
 echo "<form method=\"post\" class = 'py-5' action=\"index.php?lst=1&lid=$loginid&sess=$session&p=411\" name=\"mchgpass2\">";
	echo "<input type=\"hidden\" name=\"username\" value=\"$username11\">";
?>

            <div class = 'px-5'>
                <p class = 'fw-bold fs-2 pt-2 mb-0'>Hello <?php echo $username11; ?>!</p>
                    <!-- <input class="form-control" id="username" name="username" placeholder="<?php echo '$username11'; ?>"  value="<?php echo '$username11'; ?>" /> -->
                <p class = 'pt-0 mt-1 text-muted fst-italic fs-5'>Note: Your password should have a minimum of at least <span class = 'fw-bold'>seven (7) alphanumeric characters,</span> with  <span class = 'fw-bold text-uppercase'>capital</span> and <span class = 'fw-bold'> lowercase letters </span>.</p>
            </div>
            

            <!-- input current password -->
                 <div class = 'p-5 flex w-md-50 w-100'>
                    <div class="form-floating mb-3">           
                        <input type="password" class="form-control" input autocomplete="current-password" class="form-control" placeholder="Current Password" id="password" name="password" type="password" />
                        <label for="password" class = 'fs-6 text-muted fw-normal'>Current Password</label>
                    </div>

            <!-- input new password -->
                    <div class="form-floating mb-3">
                        <input autocomplete="new-password" class="form-control" id="newpass" placeholder="New Password" name="newpass" type="password"  />
                        <label for="newpass" class = 'fs-6 text-muted fw-normal'>New Password</label>
                    </div>

            <!-- input confirm -->
                    <div class="form-floating mb-3">
                        <input autocomplete="new-password" class="form-control" id="cnewpass" placeholder="Confirm New Password" name ="cnewpass" type="password" />
                        <label for="cnewpass" class = 'fs-6 text-muted fw-normal'>Confirm New Password</label>
                    </div>

            <!-- button -->
                <input class="mainbgc p-3 border-0 rounded-3 text-white float-end my-3"  id="submit" type="submit" name="submit" value="Change password">


            <?php echo "</form>"; ?>
    
  



    </div>
</div>

 