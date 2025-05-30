<?php
session_start();

    // Get the title from the URL, or set a default value
    $pageTitle = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'PKII Intranet';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">


    <title><?php echo $pageTitle; ?></title>
    <link rel="icon" type="png/x-icon" href="./img/pkiiicon.ico">

            <!-- Bootstrap core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="css/loginbourbon.css" rel="stylesheet"> -->
	<!-- <link href="css/bootstrap-reboot.min.css" rel="stylesheet"> -->
	<!-- <link href="css/stickyheader.css" rel="stylesheet"> -->
	
				
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@8.2.0/js/mdb.min.js"></script>

    <!-- CSS -->        
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400|Roboto:300,400,500"> -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <!-- <link rel="stylesheet" href="assets/css/animate.css"> -->
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
		

		<!-- js -->
        
    <script src="js/jquery.min.js"></script>
	<!--<script src="js/jquery-uimin.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
   


<style>
  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}


h1, h2, h3, h4, h5, h6, p, a {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  font-weight: 600;

}

.navbar {
	margin-bottom: 0;
	padding-top: 0;
	border: 0;
	-moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
	-o-transition: all .6s; -moz-transition: all .6s; -webkit-transition: all .6s; -ms-transition: all .6s; transition: all .6s;
}

a, a:hover, a:focus {
	color: #cce8f7; text-decoration: none;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}




    #scrollToTopBtn {
  position: fixed;
  bottom: 20px;
  right: 130px;
  z-index: 99;
}

#scrollToTopBtn button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  font-size: 18px;
  cursor: pointer;
  transition: .3s !important;
}

#scrollToTopBtn button:hover {
  background-color: #0056b3;
}





#newticket {
  position: fixed;
  bottom: 20px;
  right: 75px;
  z-index: 99;
}

#newticket button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  font-size: 18px;
  cursor: pointer;
  transition: .3s !important;
}

#newticket button:hover {
  background-color: #0056b3;
}



#emailfloat {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 99;
}


#emailfloat button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  font-size: 18px;
  cursor: pointer;
  transition: .3s !important;
}


.dark-mode {
      background-color: #212529 !important; 
    }

 
	.navbar{
		z-index: 2!important;
		position: sticky !important;
		top: 0 !important;
	}

  .bgforlight{
    background: rgb(27,50,97);
    background: linear-gradient(180deg, rgba(27,50,97,1) 0%, rgba(45,70,123,1) 20%, rgba(66,93,152,1) 42%, rgba(119,146,199,1) 69%, rgba(185,202,231,1) 91%, rgba(248,249,250,1) 100%);
  }

  .bgfordark{
    background: rgb(27,50,97) !important;
    background: linear-gradient(180deg, rgba(27,50,97,1) 0%, rgba(31,50,86,1) 25%, rgba(36,50,75,1) 50%, rgba(32,37,42,1) 75%, rgba(33,37,41,1) 88%) !important;
  }



.menunav{
  background-color: #1b3261 !important;
}
</style>


<?php


// 

if($_SESSION['drkmd'] == 0){
  // darkmode off

  $maintext = 'maintext';
  $subtext = 'text-muted';
  $mainbg = 'bg-white';
  $hero = 'bgforlight';
  $bodycolor = 'bg-light';

  // dashboard icon
  $iconColordash = '';

  // intra feed
  $ifeedalert = 'alert-success';

  // peronsal information
  $tableinfo = 'table-light';

  // Als 
  $theadof = 'table-dark';
  $currentday = 'info';
  $tblborder = 'border';

?>
<style>
 .secondarybgc{
   background-color: #006aff;
 }
 .maintext{
  color:#1b3261;
 }

.fc-toolbar {
  border: 1px solid #333 !important;
  color: white;
  padding: 10px;
}



.fc-list-event {
  cursor: pointer;
}

.fc-list-event:hover {
  color: black !important; /* White title */
  cursor: pointer;

}

a,
.fc-toolbar-title,
.fc-timegrid-slot-label{
  padding: 5px; 
  color: rgb(51, 51, 51) !important; 
}



</style>

<?php

  


}else{

  // darkmode on
  $maintext = 'maintext';
  $subtext = 'subtext';
  $mainbg = 'mainbg';
  $hero = 'bgfordark';
  $bodycolor = 'dark-mode';

   // dashboard icon
  $iconColordash = '#EDEDED';

   // intra feed
   $ifeedalert = 'alert-secondary';

    // peronsal information
    $tableinfo = 'table-dark';

    // Als 
  $theadof = 'table-light';
  $currentday = 'secondary';

  $tblborder = '';

  
  ?>
  
  <style>
     .secondarybgc{
   background-color: #0059d8;
 }

    .mainbg {
      background-color: #373d42;
    }
    .maintext{
    color: #e3e7ea !important;
  }

  .subtext{
    color: #7a8c96 !important;
  }



.fc-event {
  background-color: rgb(37, 101, 13) !important;
  border-color: rgb(52, 154, 14) !important;
}

.fc-day-today {
  background-color: rgb(28, 63, 15) !important; 
}



.fc-toolbar {
  background: #333;
  color: white;
  padding: 10px;
}



.fc-list-event {
  color: #fff !important; /* White title */
  cursor: pointer;
}

.fc-list-event:hover {
  color: black !important; /* White title */
  cursor: pointer;

}




a,
.fc-toolbar-title,
.fc-timegrid-slot-label{
  padding: 5px; 
  color: rgb(220, 219, 219) !important; 
}

.fc-event-title {
  color: #ffffff !important; 
}


      .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter label {
      color: white !important; /* Change to your desired color */
      font-weight: bold;
  }
  
  /* Change color of pagination text */
  .dataTables_wrapper .dataTables_paginate .paginate_button {
      color: #007bff !important; /* Change to your desired color */
  }

  .dataTables_wrapper .dataTables_info {
    color: white !important; /* Change to your desired color */
 
    font-size: 14px;
}

.dataTables_wrapper .dataTables_paginate{
  color: white;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    background-color: #007bff; /* Blue background */
    color: white !important; /* White text */
    border-radius: 5px; /* Rounded corners */
    padding: 5px 10px;
    margin: 2px;
    border: 1px solid #007bff;
}

/* Hover effect */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #0056b3; /* Darker blue */
    border: 1px solid #0056b3;
}

/* Active page button */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #0056b3 !important; /* Green for active page */
    border: 1px solid #0056b3;
    color: white !important;
}

/* Disabled button */
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    background-color: #ddd;
    color: #666 !important;
    border: 1px solid #ccc;
}

  </style>
  
  <?php
}
?>














<body class = '<?php echo $bodycolor?>  ' >





<script>
// Function to toggle the visibility of the scroll to top button
function toggleScrollToTopButton() {
  var scrollToTopBtn = document.getElementById("scrollToTopBtn");
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    scrollToTopBtn.style.display = "block";
  } else {
    scrollToTopBtn.style.display = "none";
  }
}

// Function to scroll to the top of the page
function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth' // Smooth scrolling
  });
}

// Event listener to toggle the button visibility on scroll
window.onscroll = function() {
  toggleScrollToTopButton();
};


</script>



<style>
 


  .dataTables_length select,
.dataTables_paginate,
.dataTables_info {
    font-size: 12px !important; /* Adjust the font size as needed */
}

                /* Override bold font-weight for "Show entries" dropdown */
                .dataTables_wrapper .dataTables_length label {
    font-weight: normal !important;
}

/* Override bold font-weight for "Search" input */
.dataTables_wrapper .dataTables_filter input {
    font-weight: normal !important;
}
</style>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
              
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries"
    }
            });


            $('#newot').DataTable({
              
              "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries",
        
    }
    
            });

            $('#newapp').DataTable({
              
              "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries",
        
    }
    
            });

            $('#newleave').DataTable({
              
              "lengthMenu": [[25, 50, -1], [ 25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries",
        
    }
    
            });


            $('#newleaveapp').DataTable({
              
              "lengthMenu": [[ 25, 50, -1], [ 25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries",
        
    }
    
            });




        });


        

    </script>

<?php
  $darkMode = $_SESSION['drkmd'];
?>
<!-- dark mode power -->
<style>
   .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: <?php echo $darkMode ? '#f1c40f' : '#343a40'; ?>;
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            cursor: pointer;
            z-index: 9999;
            transition: background 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
</style>



<button id="darkModeToggle" class="floating-button">
    <?php echo $darkMode ? '🌞' : '🌙'; ?>
</button>

<script>
$(document).ready(function() {
    $('#darkModeToggle').click(function() {
        $.post('toggle_dark_mode.php', function(response) {
            console.log("Dark mode status:", response); // Debugging
            location.reload(); // Reload to apply changes
        });
    });
});
</script>




<div id="scrollToTopBtn" style="display: none;">
  <button onclick="scrollToTop()"  class ='bg-primary' title="Go to top"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#FFFFFF" class="bi bi-chevron-double-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708z"/>
  <path fill-rule="evenodd" d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
</svg></button>
</div>




