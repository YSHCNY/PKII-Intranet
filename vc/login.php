<br>



<?php
if(isset($_GET['loginstat']) && $_GET['loginstat'] == 'denied') {
    ?>
    <div id="login-notification">
        <p>Action Denied</p>
    </div>

    <style>
        #login-notification {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f44336; /* Red */
            color: white;
            padding: 15px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 9999; /* Ensure it's above other elements */
            display: block; /* Show notification */
        }
    </style>

    <script>
        // Redirect after a delay
        setTimeout(function() {
            window.location = './index.php';
        }, 10 00);
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
            font-weight:: bold;
            padding: 15px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 9999; /* Ensure it's above other elements */
            display: block; /* Show notification */
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


	<div class="container shadow-lg">
            <div class="row row-cols-md-2">


            <div class="col-lg-6  d-flex justify-content-center align-items-center">
    <form class="form-signin" method="POST" action="loginverify.php">
<!-- <form class="form-signin" method="POST" action="loginnew.php"> -->
   
        <div class = "mx-auto justify-content-center align-items-center text-center" >
            <img class="w-50 img-fluid pt-5 " src="img/newlogo.png">
        </div>
        
        <div class="form-group text-start mb-5 pt-5 textstyle">
        
                <p class="form-signin-heading text-dark fs-3 fw-bold mb-0">Welcome to Intranet</p>
                <p class="fs-5 text-dark">login to your account</p>
          
        </div>
        <div class="form-group text-center mb-5 d-flex mx-auto justify-content-center">
            <input type="text" class="form-control inputpadding w-75 rounded-4" name="username" placeholder="Enter Username" required autofocus />
          
        </div>
        <div class="form-group text-center mb-5  d-flex mx-auto justify-content-center">
            <input type="password" class="form-control inputpadding w-75  rounded-4"  name="password" placeholder="Enter Password" required />
         
        </div>
        <div class="form-group text-center d-flex mx-auto justify-content-center">
            <!-- <label class="checkbox">
            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
            </label> -->
        </div>
        <div class="form-group text-center d-flex mx-auto justify-content-center pb-5">
            <button class="btn btn-lg primary btn-block text-white w-75 rounded-4"  type="submit"><span class="fs-4">Log in</span></button>
            
 
        </div>

   
     

        <div class = ' text-center d-flex mx-auto justify-content-center'>
        <p class = 'text-muted fs-6 fst-italic'>or login as admin</p>
        </div>
        <div class="form-group text-center d-flex mx-auto justify-content-center mb-5 pb-5">
            
            <a href = 'https://192.168.0.10/pkii/admin' class="textmain "  type="button"><span class="fs-4">Admin</span></a>
        </div>
    </form>
  
</div>

        









            <div class="col-md-6 p-0 d-md-block d-none">

            <img class="" width = '1000' height = '800' src="img/Group 35.png">
            </div>

  </div> <!-- <div class="wrapper"> -->
  </div>  <!-- row -->
