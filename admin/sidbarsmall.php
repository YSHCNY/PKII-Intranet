
<style>
    .gibheight{
        height: 100vh;
    }
</style>

<div class = 'gibheight'>
  <ul class="sidebar-nav" role="navigation">

    <!-- Logo -->
    <li class="nav-item text-center">
      <img src="pictures/newlogo.png" width="300" height="20" class="img-fluid mb-5 pt-2" alt="Logo">
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
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#" data-coreui-toggle="collapse" data-coreui-target="#ayti">
        <i class="bi bi-cpu"></i> <span class = 'mx-3'> IT Module </span>
      </a>
      <ul class="nav-group-items" id = 'ayti'>
        <?php if (substr($level, -22, 1) == 1): ?>
        
            <a class="nav-link" href="hrofctimelog.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Office Time Log</li></a>
         
        <?php endif; ?>
        <?php if (substr($level, -29, 1) == 1): ?>
    
            <a class="nav-link" href="itadmsuppreq.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>IT Support Request</li></a>
          
 <a class="nav-link" href="logadminuser.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>Admin Logs</li></a>

<a class="nav-link" href="loguser.php?loginid=<?php echo $loginid; ?>"><li class = 'fs-5  fs-sm-6 '>User Logs</li></a>
        <?php endif; ?>
      </ul>
    </li>

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

    <!-- Finance Module -->
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

    <!-- Tools -->
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
                <a  class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal"><li class = 'fs-5  fs-sm-6' >Asset Management</li></a>
           
      </ul>
    </li>

    <!-- Accounts Management -->
    <li class="nav-item nav-group">
      <a class="nav-link nav-group-toggle fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="#" data-coreui-toggle="collapse" data-coreui-target="#accmanage">
        <i class="bi bi-people-fill"></i> <span class = 'mx-3'> Accounts Management </span>
      </a>
      <ul class="nav-group-items" id = 'accmanage'>
      
          <a class="nav-link fs-5  " href="mngstdusers.php?loginid=<?php echo $loginid; ?>">Users</a>
   
       
          <a class="nav-link fs-5  " href="mngadmusers.php?loginid=<?php echo $loginid; ?>">Admin</a>
       
      </ul>
    </li>



    <li class="nav-item nav-group border-top ">
    <?php if(substr($level, -2, 1) == 1) { ?>
      <a class="nav-link fs-lg-4 fs-5 maintitle mt-4 px-2 py-2" href="admchgpw.php?loginid=<?php echo$loginid;?>" >
      <?php  } ?>
      <div id="" class=""><?php echo $value->name_first.' '.$value->name_last; ?> <span><?php echo $profimg; ?></span> <span class = 'mx-3'><?php echo $first ?> <?php echo $last ?></span></div>

      </a>

      <a class="nav-link fs-lg-4 fs-5 maintitle mt-4 px-3 py-2" href="admlogout.php?loginid=<?php echo$loginid;?>" >
      <i class="bi bi-box-arrow-left"></i> <span class = 'mx-3'> Logout </span>

      </a>
    

       
     
    </li>


  </ul>
</div>