<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">


    <title>PKII Intranet</title>
    <link rel="icon" type="png/x-icon" href="./img/pkiiicon.ico">

            <!-- Bootstrap core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="css/loginbourbon.css" rel="stylesheet">
	<!-- <link href="css/bootstrap-reboot.min.css" rel="stylesheet"> -->
	<!-- <link href="css/stickyheader.css" rel="stylesheet"> -->
	

    <!-- CSS -->        
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400|Roboto:300,400,500"> -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <!-- <link rel="stylesheet" href="assets/css/animate.css"> -->
        <link rel="stylesheet" href="assets/css/style.css">
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
    #scrollToTopBtn {
  position: fixed;
  bottom: 20px;
  right: 75px;
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
  right: 20px;
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

</style>


<body>

<div id="scrollToTopBtn" style="display: none;">
  <button onclick="scrollToTop()"  class ='bg-primary' title="Go to top"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#FFFFFF" class="bi bi-chevron-double-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708z"/>
  <path fill-rule="evenodd" d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
</svg></button>
</div>





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
              
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries"
    }
            });

            $('#newapp').DataTable({
              
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries"
    }
            });

            $('#newleave').DataTable({
              
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries"
    }
            });


            $('#newleaveapp').DataTable({
              
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries"
    }
            });




        });


        

    </script>







