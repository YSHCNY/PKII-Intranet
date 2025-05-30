<?php   session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
  
	<link rel="stylesheet" href="css/styled.css">
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="tjaddons/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="tjaddons/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" rel="stylesheet">
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- core ui cdn -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-lBISJVJ49zh34fnUuAaSAyuYzQ2ioGvhm4As4Z1JFde0kVpaC1FFWD3f9adpZrdD" crossorigin="anonymous">



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/js/coreui.min.js" integrity="sha384-kiD3MgQ2eSqSjSfkoKS7/ipCvMvkfmpWHk3WRppeqnYxCVF0wQ+7gHzkXfJyvHbQ" crossorigin="anonymous"></script>

 


    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script src="tjaddons/bootstrap.min.js"></script>
    <script src="tjaddons/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>



    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />


<script>

$(document).ready(function() {
        $('#apv').DataTable({
            "order": [[0, "asc"]],
              "lengthMenu": [[ 50, -1], [50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });

$(document).ready(function() {
        $('#persinfdir').DataTable({
            "order": [[0, "asc"]],
              "lengthMenu": [[ 50, -1], [50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


$(document).ready(function() {
        $('#otlmngapp').DataTable({
            "order": [[0, "asc"]],
              "lengthMenu": [[ 50, -1], [50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


$(document).ready(function() {
        $('#mngproj').DataTable({
            "order": [[0, "asc"]],
              "lengthMenu": [[ 50, -1], [50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


    $(document).ready(function() {
        $('#mngproj2').DataTable({
            "order": [[4, "desc"]],
              "lengthMenu": [[ 10, -1], [10, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


$(document).ready(function() {
        $('#tmpprojass').DataTable({
            "order": [[0, "desc"]],
              "lengthMenu": [[ 10, 50, -1], [10, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


    $(document).ready(function() {
        $('#tmpprojass2').DataTable({
            "order": [[0, "desc"]],
              "lengthMenu": [[ 10, 50, -1], [10, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


$(document).ready(function() {
        $('#persproj').DataTable({
            "order": [[0, "desc"]],
              "lengthMenu": [[ 10, 50, -1], [10, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });



$(document).ready(function() {
        $('#personinfo').DataTable({
            "order": [[0, "desc"]],
              "lengthMenu": [[ 50, -1], [ 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });


    $(document).ready(function() {
        $('#projects').DataTable({
            "order": [[0, "desc"]],
              "lengthMenu": [[ 10, 25, 50, -1], [ 10, 25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });
    
    $(document).ready(function() {
        $('#users').DataTable({
            "order": [[0, "asc"]],
              "lengthMenu": [[ 25, 50, -1], [  25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    }
            });
    });

    $(document).ready(function() {
        $('#admins').DataTable({
            "order": [[0, "asc"]],
              "lengthMenu": [[ 25, 50, -1], [  25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
    });

    $(document).ready(function() {
        $('#project2').DataTable({
            "order": [[0, "desc"]],
              "lengthMenu": [[ 25, 50, -1], [  25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
            
    });



    // $(document).ready(function() {
    //     $('#support').DataTable({
    //         "order": [[0, "desc"]],
    //         "lengthMenu": [[ 50, -1], [ 50, "All"]],
    //           "lengthChange": true,
    //           "responsive": true,
    //           "language": {
    //             "lengthMenu": "Display _MENU_ Entries"
    // },
   
    //         });
            
    // });


    $(document).ready(function() {
        $('#finance').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[ 5, 10, 25, 50, -1], [ 5, 10, 25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
            
    });


    $(document).ready(function() {
        $('#cutieoff').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[ 5, 10, 25, 50, -1], [ 5, 10, 25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
            
    });



    
    $(document).ready(function() {
        $('#notlive').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[ 50, -1], [ 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
            
    });



    $(document).ready(function() {
        $('#personelcutie').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[-1], [ "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
            
    });



    $(document).ready(function() {
        $('#leavetblid').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });
            
    });




    $(document).ready(function() {
        $('#asswet').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });


            
            
    });


    $(document).ready(function() {
        $('#pigru').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });


            
            
    });

    
    $(document).ready(function() {
        $('#addedgp').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[-1], ["All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });


            
            
    });



    $(document).ready(function() {
        $('#edpged').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });


            
            
    });


    $(document).ready(function() {
        $('#LEAVETBL').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[ 50, -1], [ 50, "All"]],
              "lengthChange": true,
              "responsive": true,
              "language": {
                "lengthMenu": "Display _MENU_ Entries"
    },
   
            });


            
            
    });


    
</script>
<!-- <script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const sidebar = document.getElementById('sidebar');
    const sidebarOpen = document.getElementById('sidebarOpen');
    const sidebarClose = document.getElementById('sidebarClose');
    
    const toggleSidebar = (event) => {
      event.stopPropagation(); // Prevent the event from bubbling up to the window click event
      sidebar.classList.toggle('sidebar-hidden');
    };

    sidebarOpen.addEventListener('click', toggleSidebar);
    sidebarClose.addEventListener('click', toggleSidebar);

    window.addEventListener('click', (event) => {
      if (!sidebar.contains(event.target) && !sidebarOpen.contains(event.target)) {
        if (!sidebar.classList.contains('sidebar-hidden')) {
          sidebar.classList.add('sidebar-hidden');
        }
      }
    });
  });
</script> -->

<style>
.dataTables_paginate,
.dataTables_info {
   font-size: 12px; 
}
.dataTables_length select {
    border: 1px solid grey;
    border-radius: 10px;
    background-color: transparent ;
}
.dataTables_wrapper .dataTables_length label {
   font-weight: normal;
}
.dataTables_wrapper .dataTables_filter input {
   font-weight: normal;
}
.sidebar-hidden {
    transform: translateX(-101%) !important;
    transition: transform 0.3s ease !important;
}
/* #sidebar {
	z-index: 999 !important;
    transition: transform 0.3s ease !important;
} */
#sidebarOpen{
    cursor: pointer;
}
#sidebarOpen:hover{
    color: black !important;
}
#mdl::-webkit-scrollbar{
    width: 5px !important;
}
#mdl::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 5px;
}
#mdl::-webkit-scrollbar-thumb {
    background: #0f2c65;
    border-radius: 5px;
}
#mdl::-webkit-scrollbar-thumb:hover {
    background: #0a1d44;
}
#mdl::-webkit-scrollbar-button:single-button {
    background-color: transparent;
    display: block;
    border-style: solid;
    height: 5px;
    width: 10px;
}
#mdl::-webkit-scrollbar-button:single-button:vertical:decrement {
    border-color: transparent transparent #555 transparent;
}
#mdl::-webkit-scrollbar-button:single-button:vertical:increment {
    border-color: #555 transparent transparent transparent;
}

#mdl::-webkit-scrollbar-button:single-button:vertical:decrement:hover {
    border-color: transparent transparent #888 transparent;
}
#mdl::-webkit-scrollbar-button:single-button:vertical:increment:hover {
    border-color: #888 transparent transparent transparent;
}





.sidebar {
    height: 100vh;
    width: 18%;
    overflow-y: scroll;
}



.nav-group-items{
    background-color: #eaeaea;
    padding: 5px 15px 5px;
    margin: 3px 5px 3px;

   
}






.maintitle{
    color: #0a1d44 !important;
}



.maintitle:hover {
    color: white !important;
    background-color: #0a1d44 !important;
}

.maintitle:active {
    color: white !important;
    background-color: #04122b !important; 
}









</style>
</head>
<body>

<?php


$sql = "SELECT COUNT(*) AS result FROM tblinventoryrequest WHERE request_status = 'Pending'";
$rs = $dbh2->query($sql);
if($rs->num_rows>0) {
    while($myrow=$rs->fetch_assoc()) {
    $result=$myrow['result'];
    } //while
} //if
// $result = mysql_fetch_array($rs);


if (isset($_POST['accbtn'])) {
    $sy = $_POST['AccessCode'];
    $sql2 = "SELECT * FROM accesscodemngmnt";
    $rs2 = $dbh2->query($sql2);
    if ($rs2->num_rows > 0) {
        while ($row = $rs2->fetch_assoc()) {                 
        $SYY = $row['pass'];
        }

    if($sy == $SYY){
        
        // header("location: assetmngmnt.php?loginid= $loginid");
        echo "<script> alert('Success! Welcome $loginid'); </script> ";
        echo "<script>window.location.href='assetmngmnt.php?loginid=$loginid'</script>";
        
        exit();
    }else{
        echo "<script> alert('Incorrect Access Code'); </script> ";
       
        
    }


    }  
}




?>



<div class="wrapper d-flex align-items-stretch">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asset Management Access Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  
      <div class="modal-body">
      <input type="PASSWORD" name="AccessCode" placeholder="Input Access Code" class=" form-control shadow-none   mt-3 rounded-3 " id="inputfn">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-success" name="accbtn" type="submit">Save changes</button>
      </div>
     
    </div>
  </div>
</div>
</form>



<div class="modal fade" id="changeimageintra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change Intranet (Standard) Image display</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php include 'imgchanger.php';?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>


<div class="sidebar  sidebar-narrow-unfoldable border-end shadow-lg d-lg-block" id="myDiv">
  <div class="sidebar-header border-bottom ">
    
    <div class="sidebar-brand "><span>PKII</span></div>
    <button class = 'px-3 py-2 fs-4 fs-lg-5 fw-bold text-secondary border-0 bg-transparent d-md-none' id = 'removeBtn'>x</button>
  </div>

  <ul class="sidebar-nav" role="navigation">

    <!-- Logo -->
    <li class="nav-item text-center">
      <img src="pictures/newlogo.png" width="300" height="20" class="img-fluid my-5 pt-2" alt="Logo">
    </li>

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link fs-lg-4 fs-5 maintitle  mt-4 px-3 py-2 " href="index2.php?loginid=<?php echo $loginid; ?>">
        <i class="bi bi-windows"></i> <span class = 'mx-3'>Dashboard</span>
      </a>
    </li>

    <!-- Directory -->
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#" data-coreui-toggle="collapse" data-coreui-target="#tori">
        <i class="bi bi-folder-fill"></i>  <span class = 'mx-3'>Directory</span>
      </a>
      <ul class="nav-group-items" id = 'tori'>
        <?php if (substr($level, -11, 1) == 1): ?>
      
            <a class="nav-link" href="projects.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Projects</li></a>
        
        <?php endif; ?>
        <?php if (substr($level, -9, 1) == 1): ?>
         
            <a class="nav-link" href="personnel.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Personnel</li></a>
         
        <?php endif; ?>
        <?php if (substr($level, -7, 1) == 1): ?>
     
            <a class="nav-link" href="directorybiz.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Associates</li></a>
        
        <?php endif; ?>
        <?php if (substr($level, -23, 1) == 1): ?>
         
            <a class="nav-link" href="dirisodocs.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>ISO</li></a>
         
        <?php endif; ?>
        
      </ul>
    </li>

    <!-- IT Module -->
     <?php if (substr($level, -22, 1) == 0 &&
substr($level, -29, 1) == 0){} else {?>
    <li class="nav-item nav-group ">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#" data-coreui-toggle="collapse" data-coreui-target="#ayti">
        <i class="bi bi-cpu"></i> <span class = 'mx-3'> IT Module </span>
      </a>
      <ul class="nav-group-items" id = 'ayti'>
        <?php if (substr($level, -22, 1) == 1): ?>
        
            <a class="nav-link" href="hrofctimelog.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Office Time Log</li></a>
         
        <?php endif; ?>
        <?php if (substr($level, -29, 1) == 1): ?>
    
            <a class="nav-link" href="itsuppreqoriginal.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>IT Support Request</li></a>
          
 <a class="nav-link" href="logadminuser.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Admin Logs</li></a>

<a class="nav-link" href="loguser.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>User Logs</li></a>
        <?php endif; ?>
      </ul>
    </li>

<?php }?>

    <?php if (substr($level, -26, 1) == 0 &&
substr($level, -13, 1) == 0 &&
substr($level, -14, 1) == 0 &&
substr($level, -15, 1) == 0 &&
substr($level, -22, 1) == 0 &&
substr($level, -25, 1) == 0 &&
substr($level, -41, 1) == 0 &&
substr($level, -21, 1) == 0 ){} else {?>

    <!-- HR Module -->
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#" data-coreui-toggle="collapse" data-coreui-target="#itshar">
        <i class="bi bi-file-earmark-person"></i><span class = 'mx-3'> HR Module </span>
      </a>
      <ul class="nav-group-items" id = 'itshar'>
        <?php if (substr($level, -26, 1) == 1): ?>
           
            <a class="nav-link " href="hrtimeatt.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Time & Attendance</li></a>
      
        <?php endif; ?>
        <?php if (substr($level, -13, 1) == 1): ?>
     
            <a class="nav-link " href="projassign.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Project Assignments</li></a>
       
        <?php endif; ?>
        <!-- Additional HR Module items can go here -->

        <?php if(substr($level, -14, 1) == 1): ?>
                    <a class="nav-link" href="projassignexpiring.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Expiring Contracts</li></a>
                <?php endif; ?>
    
                <?php if(substr($level, -15, 1) == 1): ?>
                    <a class="nav-link" href="persrptmnu.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>HR Reports</li></a>
                <?php endif; ?>
    
                <?php if(substr($level, -22, 1) == 1): ?>
                    <a class="nav-link" href="hrofctimelog.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Office time log</li></a>
                <?php endif; ?>
                <?php if(substr($level, -25, 1) == 1): ?>
                    <a class="nav-link" href="docsarchive.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Documents Archiving</li></a>
                <?php endif; ?>
                <?php if(substr($level, -41, 1) == 1): ?>
                    <a class="nav-link" href="hrpersreq.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>HR Personnel Request</li></a>
                <?php endif; ?>
                <?php if(substr($level, -21, 1) == 1): ?>
                    <a class="nav-link" href="mnghrmod.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>HR Modules</li></a>
                <?php endif; ?>


      </ul>
    </li>
<?php }?>
    <!-- Finance Module -->

    <?php if (substr($level, -17, 1) == 0 &&
substr($level, -6, 1) == 0 &&
substr($level, -5, 1) == 0 &&
substr($level, -4, 1) == 0 &&
substr($level, -3, 1) == 0 &&
substr($level, -27, 1) == 0 &&
substr($level, -33, 1) == 0 &&
substr($level, -20, 1) == 0 &&
substr($level, -18, 1) == 0){} else {?>
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#" data-coreui-toggle="collapse" data-coreui-target="#finans">
        <i class="bi bi-cash-coin"></i> <span class = 'mx-3'>Finance Module</span>
      </a>
      <ul class="nav-group-items" id = 'finans'>
        <?php if (substr($level, -17, 1) == 1): ?>
        
            <a class="nav-link" href="finvouchmain.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Vouchers</li></a>
        
        <?php endif; ?>
        <?php if (substr($level, -6, 1) == 1): ?>
         
            <a class="nav-link" href="confipay.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Custom Payroll System</li></a>
      
        <?php endif; ?>
        <?php if(substr($level, -5, 1) == 1): ?>
                    <a class="nav-link" href="cutoff.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Employees Payslip</li></a>
                <?php endif; ?>
                <?php if(substr($level, -4, 1) == 1): ?>
                    <a class="nav-link" href="emailnotifier2.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Custom Pay Advisory</li></a>
                <?php endif; ?>
                <?php if(substr($level, -3, 1) == 1): ?>
                    <a class="nav-link" href="emppaybon00.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Special Pay Notifier</li></a>
                <?php endif; ?>
                <?php if(substr($level, -27, 1) == 1): ?>
                    <a class="nav-link" href="finpaysys.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Payroll System</li></a>
                <?php endif; ?>
                <?php if(substr($level, -33, 1) == 1): ?>
                    <a class="nav-link" href="projbilling.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Project Billing</li></a>
                <?php endif; ?>
                <?php if(substr($level, -20, 1) == 1): ?>
                    <a class="nav-link" href="finrptmnu.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Finance Reports</li></a>
                <?php endif; ?>
                <?php if(substr($level, -18, 1) == 1): ?>
                    <a class="nav-link" href="mngfinmods.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Accounting Modules</li></a>
                <?php endif; ?>
      </ul>
    </li>
<?php }?>


    <?php if (substr($level, -10, 1) == 0 && substr($level, -8, 1) == 0 && substr($level, -12, 1) == 0 && substr($level, -24, 1) == 0 && substr($level, -28, 1) == 0 ){} else {?>
    <!-- Manage -->
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#"  data-coreui-toggle="collapse" data-coreui-target="#manids">
        <i class="bi bi-gear-fill"></i> <span class = 'mx-3'>Manage</span>
      </a>
      <ul class="nav-group-items" id = 'manids'>
   
        <?php if (substr($level, -10, 1) == 1): ?>
        
            <a class="nav-link" href="project2.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Manage Projects</li></a>
      
        <?php endif; ?>
        <!-- Additional Manage items can go here -->
        <?php if(substr($level, -8, 1) == 1): ?>
                    <a class="nav-link" href="personneledit.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Manage Personnel</li></a>
                <?php endif; ?>
                <?php if(substr($level, -12, 1) == 1): ?>
                    <a class="nav-link" href="businessedit.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Business Contacts</li></a>
                <?php endif; ?>
        
             
                <?php if(substr($level, -24, 1) == 1): ?>
                    <a class="nav-link" href="mngcateg.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Manage Categories</li></a>
                <?php endif; ?>
                <?php if(substr($level, -28, 1) == 1): ?>
                    <a class="nav-link" href="mngscheduler.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Scheduler</li></a>
                <?php endif; ?>
              
      </ul>
    </li>

<?php }?>


    <!-- Tools -->
    <?php if(substr($level, -29, 1) != 1){?>

        <?php }else{ ?>


    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#"  data-coreui-toggle="collapse" data-coreui-target="#toolsu">
        <i class="bi bi-tools"></i> <span class = 'mx-3'>Tools</span>
      </a>
      <ul class="nav-group-items" id = 'toolsu'>
   
        <?php if(substr($level, -1, 1) == 1): ?>
                 <a class="nav-link" href="logping.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Ping Reports</li></a>
                  
        <a class="nav-link" href="lognotifier.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>Notifier Reports</li></a>

        <?php endif; ?>
        <?php if(substr($level, -16, 1) == 1): ?>
         <a class="nav-link" href="sysadtools.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6'>SysAd Tools</li></a>
                <?php endif; ?>
           
                <a class="nav-link"  href="#" data-toggle="modal" data-target="#changeimageintra"><li class = 'fs-5  fs-sm-6'>Change Image</li></a>
      </ul>
    </li>


  

   <?php } ?>


   <!-- <a  class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal"><li class = 'fs-5  fs-sm-6' >Asset Management</li></a> -->

    <!-- Accounts Management -->
     <?php if (substr($level, -29, 1) == 1){?>
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#" data-coreui-toggle="collapse" data-coreui-target="#accmanage">
        <i class="bi bi-people-fill"></i> <span class = 'mx-3'> Accounts Management </span>
      </a>
      <ul class="nav-group-items" id = 'accmanage'>
      
          <a class="nav-link fs-5  " href="mngstdusers.php?loginid=<?php echo $loginid; ?>">Users</a>
   
       
          <a class="nav-link fs-5  " href="mngadmusers.php?loginid=<?php echo $loginid; ?>">Admin</a>
       
      </ul>
    </li>
    <?php }  else {}?>


    <li class="nav-item nav-group border-top mt-5 ">
    <?php if(substr($level, -2, 1) == 1) { ?>
      <a class="nav-link fs-lg-4 maintitle mt-4 px-2 py-2" href="admchgpw.php?loginid=<?php echo$loginid;?>" >
      <?php echo $value->name_first.' '.$value->name_last; ?> <span><?php echo $profimg; ?></span> <span class = 'mx-3'><?php echo $first ?> <?php echo $last ?></span>

</a>
      <?php  } else { ?>

        <a class="nav-link fs-lg-4 maintitle mt-4 px-2 py-2" href="#" >
      <?php echo $value->name_first.' '.$value->name_last; ?> <span><?php echo $profimg; ?></span> <span class = 'mx-3'><?php echo $first ?> <?php echo $last ?></span>

</a>
        <?php }?>
    

      <a class="nav-link fs-lg-4 fs-4 maintitle mt-4 px-2 py-2" href="admlogout.php?admloginid=<?php echo $loginid; ?>" >
      <i class="bi bi-box-arrow-left"></i> <span class = 'mx-3'> Logout </span>

      </a>


            <form action="../vc/loginverify.php" class = 'nav-link    mt-4  py-2' method="post">
              <input type="hidden" name = 'username' value = "<?php echo $_SESSION['fetchunad'];?>">
              <input type="hidden" name = 'password' value = "<?php echo $_SESSION['fetchpassad'];?>">

             <button class = 'border-0 text-decoration-none bg-white ' type= 'submit'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg> Log in to Non-Admin</button>

              </form>
    

       
     
    </li>
  </ul>
</div>



    <nav id='' class='shadow bg-white'>
    <div class="d-flex justify-content-end position-relative">
        <div class="p-3 position-absolute z-3">
            <i id="sidebarOpen" class="bi bi-x-lg fs-5  text-secondary"></i>
        </div>
        <div class="">
            <div id='' class=" d-flex justify-content-center align-items-center">
            <div class="">
               
            </div>
            </div>
        </div>
    </div>

<?php function generateCleanURL($page, $loginid) {
    return "https://192.168.0.223/pkii/admin/$page/$loginid";
}?>
 
     <div class="px-2 ofw">
     
    </nav>
    </div>
  
    <!-- start main body here -->
    <div class="mt-5 ">
        <br>
    <div class="container-fluid w-75 p-0 mt-5">
    <div class="flicker-container text-center">
        <div class="flicker">
          <p class="fs-5  text-danger poppins"><i><strong>Note:</strong> Only authorized PKII personnel with admin access are allowed to use this site.</i></p>
        </div>
    </div>


    <?php

// session

	if (isset($_SESSION['success_message'])) {
	?>
		
			<div id="alertDiv" class="alert alert-success" role="alert">
		<?php echo $_SESSION['success_message']; ?>
		</div>

	<?php
		unset($_SESSION['success_message']);
	}
	?>
		<script>
   $(document).ready(function(){
            setTimeout(function(){
                $("#alertDiv").fadeOut("slow", function(){
                    $(this).remove();
                });
            }, 3000); 
        });
		</script>


<!-- error mesage -->
 <?php
	if (isset($_SESSION['error_message'])) {
	?>
		
			<div id="alertDiv" class="alert alert-danger" role="alert">
		<?php echo $_SESSION['error_message']; ?>
		</div>

	<?php
		unset($_SESSION['error_message']);
	}
	?>
		<script>
   $(document).ready(function(){
            setTimeout(function(){
                $("#alertDiv").fadeOut("slow", function(){
                    $(this).remove();
                });
            }, 3000); 
        });
		</script>

    




<?php

// session


if (isset($_SESSION['success_message_newper'])) {
    ?>
    <div id="alertDiv" class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_message_newper']; ?>
        <span id="countdownTimer" style="font-weight: bold;"> (5)</span>

    </div>
    <?php
    unset($_SESSION['success_message_newper']);
}
?>
<script>
$(document).ready(function() {
    var countdown = 5; 
    var interval = setInterval(function() {
        countdown--;
        $("#countdownTimer").text(` (${countdown})`);
        if (countdown <= 0) {
            clearInterval(interval);
        }
    }, 500);

    // Change fade-out time to 8 seconds (same as the countdown duration)
    setTimeout(function() {
        $("#alertDiv").fadeOut("slow", function() {
            $(this).remove();
        });
    }, 12000); // Match the countdown duration
});

</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script>
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
    </script> -->
    


</body>
</html>


