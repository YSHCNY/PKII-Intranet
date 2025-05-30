<br>
<?php
session_start();

require("../includes/dbh.php");
if(isset($_GET['loginstat']) && $_GET['loginstat'] == 'denied') {
    ?>
    <div id="login-notification">
        <p>Action Denied</p>
    </div>


    <script>
        // Redirect after a delay
        setTimeout(function() {
            window.location = './index.php';
        }, 1000);
    </script>
    <?php
} elseif (isset($_GET['logged']) && $_GET['logged'] == 'out' && !isset($_SESSION['logout_notification_displayed'])) {
     $_SESSION['logout_notification_displayed'] = true;
    ?>
    <div id="login-notification">
        <p>Logged Out!</p>
    </div>

    <style>
        #login-notification {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #0A1D44;
            color: white;
            font-weight: bold;
            padding: 15px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 9999; /* Ensure it's above other elements */
            display: block; /* Show notification */
        }

        .form-control:focus {
    border-color: #0A1D44 !important;    /* Customize focus color if desired */
    box-shadow: none !important;         
}



    </style>

    <script>
        // Redirect after a delay
        setTimeout(function() {
            window.location = './index.php';
        }, 1000);



    </script>
    <?php
} // En



?>


<?php
    $getsql = "SELECT * FROM logimg WHERE activeimg = 1";
    $resultsql = $dbh->query($getsql);
    if($resultsql->num_rows>0){
        while($rowcols = $resultsql->fetch_assoc()){
            $imgname = $rowcols['filename'];
    
        }
    }
    
    if ($imgname == ""){
        $imgdisplay = "Group 35.png";
    } else {
        $imgdisplay = $imgname;
    }

    ?>


	<div class="container  p-5 animate__animated animate__rubberBand ">
<?php 
 $usrip= $_SERVER['REMOTE_ADDR'];
 $usrosbrowserver= $_SERVER['HTTP_USER_AGENT'];
$gethost = gethostname();

        if ($_SESSION['FLAG'] == 'Success'){
            $color = 'alert-success';
        } else if ($_SESSION['FLAG'] == 'Error') {
            $color =  'alert-danger';
        } else {
            $color =  'd-none';
        }


?>
<div class="alert <?php echo $color; ?>" role="alert" id="autoDismissAlert">
  <h4 class="alert-heading"><?php echo $_SESSION['message']; ?></h4>
  <p><?php echo $_SESSION['secmessage']; ?></p>
</div>

<script>
  setTimeout(function() {
    var alert = document.getElementById("autoDismissAlert");
    if (alert) {
      alert.style.transition = "opacity 0.5s ease";
      alert.style.opacity = "0";
      setTimeout(() => alert.remove(), 500); // Removes it from the DOM after fading out
    }
  }, 4000); // 3 seconds
</script>

<?php
unset($_SESSION['message']);
unset($_SESSION['secmessage']);
session_destroy();

?>
    
  

    <div id="formHUI" class="carousel slide  " data-ride="carousel">
  <div class="carousel-inner  ">
    <div class="carousel-item active">
      <!-- <img class="d-block w-100" src=".../800x400?auto=yes&bg=777&fg=555&text=First slide" alt="First slide"> -->
      <div class="row row-cols-md-2 bg-white rounded-3 ">


<div class="col-lg-6 p-5 mx-auto  d-flex justify-content-center align-items-center">

<form class="form-signin p-5   " method="POST" class = ' ' action="loginverify.php">
<!-- header image -->

<div class = "mx-auto  justify-content-center align-items-center text-center" >
<img class="w-50 img-fluid py-5 " src="img/newlogo.png">
</div>




<!-- input boxes -->

<div class="form-group py-2 mt-5 ">
<label for="username" class = 'text-secondary'>Enter your username</label>
<input type="text" class="form-control shadow h-50 w-full rounded-pill p-4" name="username" placeholder="Enter Username" required autofocus />
</div>

<div class="form-group py-2 mb-5">
<label for="password" class = 'text-secondary'>Enter your password:</label>
<input type="password" class="form-control shadow h-50 w-full rounded-pill p-4" id = 'password' name="password" autocomplete="off" placeholder="Enter Password" required />
</div>


<!-- button -->
<div class=" text-center">
<button class="border-0  btn-primary text-white p-3 w-100 rounded-pill my-1"  type="submit">Login</button>
<a href = '.././admin/index.php' class="  btn border  p-3 w-100 rounded-pill my-1"  >Admin</a>
</div>



<!-- help ups improve  -->
<div class="text-center my-5 pb-0 ">
<a class="box  py-2 px-3 rounded-3 border-0" href="#formHUI"  data-slide="next">
   Help Us Improve
  </a>
</div>

<div>

</div>
</form>

</div>



<div class="col-md-6 p-0 d-md-block   d-none ">


<img src="img/<?php echo $imgdisplay; ?>"  class = ' border rounded-4 img-fluid' style="width: 600px; height: 700px;">


</div>

</div> <!-- <div class="wrapper"> -->
    </div>




    
    <div class="carousel-item  p-4">
        <div class = 'p-4 d-block w-100'>
            <div>
                <div class = 'mb-5  rounded-3 px-4 py-2'>
                    <h4 class = 'mb-0 pb-0 fw-semibold'>Help us improve!</h4>
                    <p>Any comments, suggestions, or feedback provided by you shall be treated confidential and will be used solely for the purpose of improving our services.</p>
                </div>

                <form class = 'mt-4' method = 'post' action = 'sendHUI.php'>
            <input type="hidden" name = 'subjectHUI' value = 'Suggestions From Intranet!'>

            <input type="hidden" name = 'userip' value = '<?php echo $usrip ?>'>
            <input type="hidden" name = 'userbrow' value = '<?php echo $usrosbrowserver ?>'>
            <input type="hidden" name = 'userhost' value = '<?php echo $gethost ?>'>





                <div class="mb-3">
                <textarea class="form-control" name = 'feedbackHUI' style='height: 200px;' placeholder = 'We value your feedback—let us know your thoughts!' id="exampleFormControlTextarea1" rows="3" required></textarea>
                </div>

                <div class="mb-3 text-end">
                    <a class="btn rounded-3 border-0" href="#formHUI" role="button" data-slide="prev">
        Back to login
    </a>
    <button type="submit" class = 'bg-success text-white btn'>Submit</button>

                </div>
            </form>


            </div>


         
  </div>
    </div>
  


  </div>

</div>


          
  </div>  <!-- row -->
  </div

  <script src="capslockstate.js"></script>

  <script>
    // Get the input field


// Get the warning text
$(document).ready(function() {

/* 
* Bind to capslockstate events and update display based on state 
*/
$(window).bind("capsOn", function(event) {
    if ($("#password:focus").length > 0) {
        $("#capsWarning").show();
    }
});
$(window).bind("capsOff capsUnknown", function(event) {
    $("#capsWarning").hide();
});
$("#password").bind("focusout", function(event) {
    $("#capsWarning").hide();
});
$("#password").bind("focusin", function(event) {
    if ($(window).capslockstate("state") === true) {
        $("#capsWarning").show();
    }
});

/* 
* Initialize the capslockstate plugin.
* Monitoring is happening at the window level.
*/
$(window).capslockstate();

});

  </script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script>
$('.carousel').carousel({
  interval: false
})
</script>


<style>
      


</style>