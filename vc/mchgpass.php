<?php
//
// mchgpass.php
// fr: vc/index.php -> menu.php -> indexlist.php
//page 41

include("../m/qryusernm.php"); 

?>


		<div class="mainbgc "> 
        <div class=" p-5 <?php echo $hero?>" >
        <div class="text-center"><h3 class = 'mb-5 mt-2 py-5 fw-bold text-uppercase text-white'>change password</h3></div>
            </div>
       
    </div>



<div class="container ">
    <div class="<?php echo "$mainbg"?> border shadow absolute rounded-3 my-5 p-5">
    <?php
 echo "<form method=\"post\" class = 'py-5' action=\"index.php?lst=1&lid=$loginid&sess=$session&p=411\" name=\"mchgpass2\">";
	echo "<input type=\"hidden\" name=\"username\" value=\"$username11\">";
?>

            <div class = 'px-5'>
                <p class = 'fw-bold fs-2 pt-2 <?php echo "$maintext"?> mb-0'>Hello <?php echo $username11; ?>!</p>
                    <!-- <input class="<?php echo "$mainbg $maintext"?> form-control" id="username" name="username" placeholder="<?php echo '$username11'; ?>"  value="<?php echo '$username11'; ?>" /> -->
                <p class = 'pt-0 mt-1 <?php echo "$subtext"?> fst-italic <?php echo "$subtext"?> fs-5'>Note: Your password should have a minimum of at least <span class = 'fw-bold'>seven (7) alphanumeric characters,</span> with  <span class = 'fw-bold text-uppercase'>capital</span> and <span class = 'fw-bold'> lowercase letters </span>.</p>
            </div>
            

            <!-- input current password -->
                 <div class = 'p-5 flex w-md-50 w-100'>
                    <div class="form-floating mb-3">           
                        <input type="password" class="<?php echo "$mainbg $maintext"?> form-control" input autocomplete="current-password" class="<?php echo "$mainbg $maintext"?> form-control" placeholder="Current Password" id="password" name="password" type="password" />
                        <label for="password" class = 'fs-6 <?php echo "$subtext"?> fw-normal'>Current Password</label>
                    </div>

            <!-- input new password -->
                    <div class="form-floating mb-3">
                        <input autocomplete="new-password" class="<?php echo "$mainbg $maintext"?> form-control" id="newpass" placeholder="New Password" name="newpass" type="password"  />
                        <label for="newpass" class = 'fs-6 <?php echo "$subtext"?> fw-normal'>New Password</label>
                    </div>

            <!-- input confirm -->
                    <div class="form-floating mb-3">
                        <input autocomplete="new-password" class="<?php echo "$mainbg $maintext"?> form-control" id="cnewpass" placeholder="Confirm New Password" name ="cnewpass" type="password" />
                        <label for="cnewpass" class = 'fs-6 <?php echo "$subtext"?> fw-normal'>Confirm New Password</label>
                    </div>

            <!-- button -->
             <div class="text-end">
                <input class="btn btn-primary"  id="submit" type="submit" name="submit" value="Change password">
                </div>

            <?php echo "</form>"; ?>
    
  



    </div>
</div>

 