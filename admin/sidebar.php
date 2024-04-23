<?php

include("addons.php");
$sql = "SELECT COUNT(*) FROM tblinventoryrequest WHERE request_status = 'Pending'";
$rs = mysql_query($sql);
$result = mysql_fetch_array($rs);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>

  
		<link rel="stylesheet" href="css/style.css">
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="tjaddons/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="tjaddons/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" rel="stylesheet">
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
 
 
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script src="tjaddons/bootstrap.min.js"></script>
    <script src="tjaddons/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

<script>
    $(document).ready(function() {
        $('#projects').DataTable({
              
              "lengthMenu": [[ 10, 25, 50, -1], [ 10, 25, 50, "All"]],
              "lengthChange": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


    $(document).ready(function() {
        $('#users').DataTable({
              
              "lengthMenu": [[ 25, 50, -1], [  25, 50, "All"]],
              "lengthChange": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


    $(document).ready(function() {
        $('#admins').DataTable({
              
              "lengthMenu": [[ 25, 50, -1], [  25, 50, "All"]],
              "lengthChange": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
    });



    $(document).ready(function() {
        $('#project2').DataTable({
              
              "lengthMenu": [[ 25, 50, -1], [  25, 50, "All"]],
              "lengthChange": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
    });


</script>
<style>
 



.dataTables_paginate,
.dataTables_info {
   font-size: 12px !important; 

  
}

.dataTables_length select
{
    border: 1px solid grey !important;
   border-radius: 10px !important;
   background-color: transparent !important;
}
.dataTables_wrapper .dataTables_length label {
   font-weight: normal !important;
}


.dataTables_wrapper .dataTables_filter input {
   font-weight: normal !important;
}



</style>
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
    
    <nav id='sidebar' class = ' shadow bg-white'>
   
        <div id='' class=" d-flex justify-content-center align-items-center">
           <div class="">
              <img src="pictures/newlogo.png"  width = '300' height = '20' class = ' img-fluid my-5  ' alt="" srcset="">
           </div>
  <!-- <a href="<?php echo generateCleanURL('projects.php', $loginid); ?>"><li class="fs-4 fs-sm-6 mb-2">Projects</li></a> -->
        </div>


<?php function generateCleanURL($page, $loginid) {
    return "https://192.168.0.223/pkii/admin/$page/$loginid";
}?>
 
     <div class="px-2 ofw">
        <ul id='menuList' class= 'list-unstyled components '>
        <a href="index2.php?loginid=<?php echo $loginid; ?>"><li  class="dropdownMenuListsolo fs-4 mt-4 px-3 py-2" ><span><i class="bi bi-speedometer"></i>Dashboard</span></li></a>
            <li id="direct" class="dropdownMenuList fs-4 mt-4 px-3 py-2" onclick="toggleHover('direct')" data-id='directory'><span><i class="bi bi-folder-fill"></i>Directory</span><span class="dropdownIcon"></li>

	
            <ul class="directory dropdownMenu mb-3 ">
            <?php if(substr($level, -11, 1) == 1): ?>
                <a   href="projects.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Projects</li></a>
              
            <?php endif; ?>
            <?php if(substr($level, -9, 1) == 1): ?>
                <a   href="personnel.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Personnel</li></a>
            <?php endif; ?>
            <?php if(substr($level, -7, 1) == 1): ?>
                <a   href="directorybiz.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Associates</li></a>
            <?php endif; ?>
            <?php if(substr($level, -23, 1) == 1): ?>
                <a   href="dirisodocs.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>ISO</li></a>
            <?php endif; ?>
             </ul>
    
            <li id="module" class="dropdownMenuList fs-4 mt-4 px-3 py-2" onclick="toggleHover('module')" data-id='modules'><span><i class="bi bi-inboxes-fill"></i>Module</span></li>
            <ul class='modules dropdownMenu mb-3'>
    <?php if(substr($level, -17, 1) == 1): ?>
        <a href="finvouchmain.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Vouchers</li></a>
    <?php endif; ?>
    <?php if(substr($level, -6, 1) == 1): ?>
        <a href="confipay.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Custom Payroll System</li></a>
    <?php endif; ?>
    <?php if(substr($level, -5, 1) == 1): ?>
        <a href="cutoff.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Employees Payslip</li></a>
    <?php endif; ?>
    <?php if(substr($level, -4, 1) == 1): ?>
        <a href="emailnotifier2.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Custom Pay Advisory</li></a>
    <?php endif; ?>
    <?php if(substr($level, -3, 1) == 1): ?>
        <a href="emppaybon00.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Special Pay Notifier</li></a>
    <?php endif; ?>
    <?php if(substr($level, -26, 1) == 1): ?>
        <a href="hrtimeatt.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Time & Attendance</li></a>
    <?php endif; ?>
    <?php if(substr($level, -27, 1) == 1): ?>
        <a href="finpaysys.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Payroll System</li></a>
    <?php endif; ?>
    <?php if(substr($level, -13, 1) == 1): ?>
        <a href="projassign.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Project Assignments</li></a>
    <?php endif; ?>
    <?php if(substr($level, -14, 1) == 1): ?>
        <a href="projassignexpiring.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Expiring Contracts</li></a>
    <?php endif; ?>
    <?php if(substr($level, -33, 1) == 1): ?>
        <a href="projbilling.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Project Billing</li></a>
    <?php endif; ?>
    <?php if(substr($level, -15, 1) == 1): ?>
        <a href="persrptmnu.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>HR Reports</li></a>
    <?php endif; ?>
    <?php if(substr($level, -20, 1) == 1): ?>
        <a href="finrptmnu.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Finance Reports</li></a>
    <?php endif; ?>
    <?php if(substr($level, -22, 1) == 1): ?>
        <a href="hrofctimelog.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Office time log</li></a>
    <?php endif; ?>
    <?php if(substr($level, -25, 1) == 1): ?>
        <a href="docsarchive.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Documents Archiving</li></a>
    <?php endif; ?>
    <?php if(substr($level, -29, 1) == 1): ?>
        <a href="itadmsuppreq.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>IT Support Request</li></a>
    <?php endif; ?>
    <?php if(substr($level, -42, 1) == 1 || substr($level, -43, 1) == 1): ?>
        <a href="mngotrequest.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>OT/Leave Requests</li></a>
    <?php endif; ?>
    <?php if(substr($level, -41, 1) == 1): ?>
        <a href="hrpersreq.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>HR Personnel Request</li></a>
    <?php endif; ?>
</ul>

    
            <li id="manage" class="dropdownMenuList fs-4 mt-4 px-3 py-2" onclick="toggleHover('manage')" data-id='manage'><span><i class="bi bi-gear-fill"></i>Manage</span></li>
            <ul class='manage dropdownMenu mb-3'>
    <?php if(substr($level, -10, 1) == 1): ?>
        <a href="project2.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Manage Projects</li></a>
    <?php endif; ?>
    <?php if(substr($level, -8, 1) == 1): ?>
        <a href="personneledit.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Manage Personnel</li></a>
    <?php endif; ?>
    <?php if(substr($level, -12, 1) == 1): ?>
        <a href="businessedit.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Business Contacts</li></a>
    <?php endif; ?>
    <?php if(substr($level, -18, 1) == 1): ?>
        <a href="mngfinmods.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Accounting Modules</li></a>
    <?php endif; ?>
    <?php if(substr($level, -21, 1) == 1): ?>
        <a href="mnghrmod.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>HR Modules</li></a>
    <?php endif; ?>
    <?php if(substr($level, -24, 1) == 1): ?>
        <a href="mngcateg.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Manage Categories</li></a>
    <?php endif; ?>
    <?php if(substr($level, -28, 1) == 1): ?>
        <a href="mngscheduler.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Scheduler</li></a>
    <?php endif; ?>
</ul>

<div class = 'border-bottom pb-3'>
            <li id="tool" class="dropdownMenuList fs-4 mt-4 px-3 py-2" onclick="toggleHover('tool')" data-id='tools'><span><i class="bi bi-tools"></i>Tools</span></li>
            <ul class='tools dropdownMenu mb-3'>
    <?php if(substr($level, -1, 1) == 1): ?>
        <a href="logping.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Ping Reports</li></a>
        <a href="lognotifier.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>Notifier Reports</li></a>
    <?php endif; ?>
    <?php if(substr($level, -16, 1) == 1): ?>
        <a href="sysadtools.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-4 fs-sm-6 mb-2'>SysAd Tools</li></a>
    <?php endif; ?>
 
</ul>
</div>
<?php if(substr($level, -19, 1) == 1): ?>
        <li id="userstool" class="dropdownMenuList fs-4 mt-4 px-3 py-2" onclick="toggleHover('userstool')" data-id='userstool'>Accounts Management</li>
        <ul class='userstool dropdownMenu mb-3'>
            <a href="mngstdusers.php?loginid=<?php echo $loginid; ?>"><li>Users</li></a>
            <a href="mngadmusers.php?loginid=<?php echo $loginid; ?>"><li>Admin</li></a>

        </ul>


        <li id="logs" class="dropdownMenuList fs-4 mt-4 px-3 py-2" onclick="toggleHover('logs')" data-id='logs'>Activity Logs</li>
        <ul class='logs dropdownMenu mb-3'>
            <a href="logadminuser.php?loginid=<?php echo $loginid; ?>"><li>Admin Logs</li></a>
            <a href="loguser.php?loginid=<?php echo $loginid; ?> "><li>User Logs</li></a>

        </ul>
    
    <?php endif; ?>
        </ul>
   
    </nav>
    </div>
    
    <!-- start main body here -->
    <div class="mt-5">
        <br>
        <div class="container p-0 mt-5">
        <div class="flicker-container text-center">
  <div class="flicker">
    <p class="fs-5 text-danger"><i><strong>Note:</strong> Only authorized PKII personnel with admin access are allowed to use this site.</i></p>
    <!-- Add more content here if needed -->
  </div>
</div>
        <!-- <div id="scrollTop" class="position-fixed end-0 me-5 mb-4 bg-white rounded-5" style="bottom: 45px; cursor: pointer;" onclick="scrollToTop()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35" height="35" fill="#3777ec">
                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM377 271c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-87-87-87 87c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9L239 167c9.4-9.4 24.6-9.4 33.9 0L377 271z"/>
            </svg>
        </div>

        <div id="scrollDown" class="position-fixed bottom-0 end-0 me-5 mb-4 bg-white rounded-5" style="cursor: pointer;" onclick="scrollToBottom()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35" height="35" fill="#3777ec">
                <path d="M256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM135 241c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l87 87 87-87c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L273 345c-9.4 9.4-24.6 9.4-33.9 0L135 241z"/>
            </svg>
        </div>

        <script>
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            function scrollToBottom() {
                window.scrollTo({
                    top: document.body.scrollHeight,
                    behavior: 'smooth'
                });
            }
        </script> -->
            <!-- Your main body content here -->
    
    <!-- Include any necessary JavaScript files here -->

    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        var previousElementId = null;

function toggleHover(id) {
    var currentElement = document.getElementById(id);
    
    if (currentElement.classList.contains('stay-hover')) {
        currentElement.classList.remove('stay-hover');
        previousElementId = null;
    } else {
        if (previousElementId !== null) {
            var previousElement = document.getElementById(previousElementId);
            previousElement.classList.remove('stay-hover');
        }

        currentElement.classList.add('stay-hover');
        previousElementId = id;
    }
}
    </script>
    <script>
        $(document).ready(function () {
            var openDropdown = null;

            $('li.dropdownMenuList').click(function (e) {
                e.preventDefault();
                var dropdownClass = "." + $(this).data('id');

                if (openDropdown && openDropdown !== dropdownClass) {
                    $(openDropdown).slideUp();
                    $(this).siblings().find('.dropdownIcon').removeClass('rotate');
                }

                $(dropdownClass).slideToggle();

                $(this).find('.dropdownIcon').toggleClass('rotate');

                openDropdown = openDropdown === dropdownClass ? null : dropdownClass;
            });

            $('#profname').click(function (e) {
                e.preventDefault();
                $('#myDropdown').slideToggle();
                e.stopPropagation();
            });

            $(document).click(function (e) {
                if (!$(e.target).closest('#profname').length && !$(e.target).closest('.dropdownMenuList').length) {
                    $('#myDropdown').slideUp();
                }
            });
        });
    </script>

</body>
</html>