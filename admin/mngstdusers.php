<style>
table td, table th {
		font-family: 'Poppins', sans-serif !important;
    padding: 8px;
}
table tr {
    height: 50px;
}
</style>

<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here
?>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include "mngstduseradd.php"; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<div class="shadow p-5">

<?php
  if($accesslevel >= 4 && $accesslevel <= 5) {

        // Start session to retrieve the message
        session_start();
        if (isset($_SESSION['success'])) {
          // Display the alert using Bootstrap
          echo '<div id="alertsuccess" class="alert alert-success" role="alert">';
          echo $_SESSION['success'];
          echo '</div>';
    
        
          unset($_SESSION['success']);
      }
      ?>
    
    <script>
      // JavaScript to hide the alert after 1 second
      $(document).ready(function(){
          setTimeout(function(){
              $("#alertsuccess").fadeOut("slow", function(){
                  $(this).remove();
              });
          }, 3000); 
      });
    </script>
    
    
    <?php
    
    
        // Check if message exists in session
        if (isset($_SESSION['message'])) {
            // Display the alert using Bootstrap
            echo '<div id="alertDiv" class="alert alert-danger" role="alert">';
            echo $_SESSION['message'];
            echo '</div>';
    
          
            unset($_SESSION['message']);
        }
        ?>
    
    <script>
        // JavaScript to hide the alert after 1 second
        $(document).ready(function(){
            setTimeout(function(){
                $("#alertDiv").fadeOut("slow", function(){
                    $(this).remove();
                });
            }, 3000); 
        });
    </script>
    
    
    
    <?php
    session_start();
        if (isset($_SESSION['changepass'])) {
          // Display the alert using Bootstrap
          echo '<div id="changepass" class="alert alert-warning" role="alert">';
          echo $_SESSION['changepass'];
          echo '</div>';
    
        
          unset($_SESSION['changepass']);
      }
      ?>
    
    <script>
      // JavaScript to hide the alert after 1 second
      $(document).ready(function(){
          setTimeout(function(){
              $("#changepass").fadeOut("slow", function(){
                  $(this).remove();
              });
          }, 3000); 
      });
    </script>
    <?php

    
    echo "<div class = 'row' >";
    echo"<div class = 'col'>";
    echo "<p class = 'fs-4 text-dark mb-0 fw-bold'>User Login</p>";
    echo "<p class = 'fs-5 text-muted'>Manage user's login data</p>";
    echo "</div>";
    
    echo "<div class = 'col text-end mb-5'>";
    ?>
<button type="button" class="mainbtnclr px-3 py-2 border-0 text-decoration-none rounded-3 text-white" data-toggle="modal" data-target="#staticBackdrop">
  + New User 
</button>




<?php
    echo "</div>";
    echo "</div>";



   echo "<div class = 'table-responsive'>";
    echo "<table id = 'users' class='bg-white table-striped table-hover table-bordered' style='width:100%'>";


    echo "<thead>";
    echo "<tr class = 'text-muted text-capitalize'>";
    echo "<th>username</th>";
    echo "<th>created</th>";
    echo "<th>employee ID</th>";
    echo "<th>name</th>";
    echo "<th>status</th>";
    echo "<th >action</th>";
    echo "<th>Settings</th>";
 
    echo "</tr>";
    echo "</thead>";

    
    echo "<tbody>";
    $res11query = "SELECT loginid, username, password, date_created, time_login, time_logout, remarks_login, login_status, login_level, employeeid, contactid FROM tbllogin WHERE loginid <> '' ORDER BY loginid ASC";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
      $loginid11 = $myrow11['loginid'];
      $username11 = $myrow11['username'];
      $password11 = $myrow11['password'];
      $date_created11 = $myrow11['date_created'];
      $time_login11 = $myrow11['time_login'];
      $time_logout11 = $myrow11['time_logout'];
      $remarks_login11 = $myrow11['remarks_login'];
      $login_status11 = $myrow11['login_status'];
      $login_level11 = $myrow11['login_level'];
      $employeeid11 = $myrow11['employeeid'];
      $contactid11 = $myrow11['contactid'];

      $count11 = $count11 + 1;

      if($employeeid11!='') {
				$res12query="SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid11\"";
				$result12=""; $found12=0; $ctr12=0;
				$result12=$dbh2->query($res12query);
				if($result12->num_rows>0) {
					while($myrow12=$result12->fetch_assoc()) {
					$found12=1;
				  $name_last12 = $myrow12['name_last'];
				  $name_first12 = $myrow12['name_first'];
				  $name_middle12 = $myrow12['name_middle'];
					} // while
				} // if
      } else {
				$name_last12 = ''; $name_first12 = ''; $name_middle12 = '';
      } // if

    //20221014 chk tblsysusracctmgt if attempt>=5
    $res14query=""; $result14=""; $found14=0;
    $res14query="SELECT idtblsysusracctmgt, attempt FROM tblsysusracctmgt WHERE loginid=$loginid11 AND admloginid=0 LIMIT 1";
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
        while($myrow14=$result14->fetch_assoc()) {
        $found14=1;
        $idtblsysusracctmgt14 = $myrow14['idtblsysusracctmgt'];
        $attempt14 = $myrow14['attempt'];
        } //while
    } //if

    //20221021 chk tblsysusracctmgt for admlogin based on employeeid
    $res15query=""; $result15=""; $found15=0;
    $res15query="SELECT idtblsysusracctmgt, admloginid, attempt FROM tblsysusracctmgt WHERE employeeid=\"$employeeid11\" AND loginid=0";
    $result15=$dbh2->query($res15query);
    if($result15->num_rows>0) {
        while($myrow15=$result15->fetch_assoc()) {
        $found15=1;
        $idtblsysusracctmg15 = $myrow15['idtblsysusracctmgt'];
        $admloginid15 = $myrow15['admloginid'];
        $attempt15 = $myrow15['attempt'];
        } //while
    } //if

    // chk in tblloginstatus for both logintypes if disabled or not
    $res16aquery=""; $result16a=""; $found16a=0;
    $res16aquery="SELECT idloginstatus, status, disabled FROM tblloginstatus WHERE logintype=1 AND loginid=$loginid11";
    $result16a=$dbh2->query($res16aquery);
    if($result16a->num_rows>0) {
        while($myrow16a=$result16a->fetch_assoc()) {
        $found16a=1;
        $idloginstatus16a = $myrow16a['idloginstatus'];
        $status16a = $myrow16a['status'];
        $disabled16a = $myrow16a['disabled'];
        } //while
    } //if

    $res16bquery=""; $result16b=""; $found16b=0;
    $res16bquery="SELECT idloginstatus, status, disabled FROM tblloginstatus WHERE logintype=2 AND loginid=$admloginid15";
    $result16b=$dbh2->query($res16bquery);
    if($result16b->num_rows>0) {
        while($myrow16b=$result16b->fetch_assoc()) {
        $found16b=1;
        $idloginstatus16b = $myrow16b['idloginstatus'];
        $status16b = $myrow16b['status'];
        $disabled16b = $myrow16b['disabled'];
        } //while
    } //if

		if(strpos($remarks_login11, 'disabled') === FALSE) { 
        if($attempt14>=$usrpwretries || $attempt15>=$usrpwretries) {
        $fontclr="text-warning";
        $remadd="";
        if($attempt14>=$usrpwretries) { $remadd .= " on non-admin profile."; }
        if($attempt15>=$usrpwretries) { $remadd .= " on admin profile."; }
        $remarksfin = $remarks_login11." "."reached max password retries".$remadd;
        } else {
            if($disabled16a==1 || $disabled16b==1) {
        $fontclr="text-danger";
        $remarksfin = $remarks_login11." "."disabled account.";
            } else {
        $fontclr="#000000"; 
        $remarksfin = $remarks_login11;
            } //if-else
        } //if-else
    } else { 
        $fontclr="text-danger";
        $remarksfin = $remarks_login11;
    } //if-else

      echo "<tr class = '$fontclr'>";

       echo "<td>$username11</td>";
       echo "<td>".date('Y-M-d', strtotime($date_created11))."</td>";
       echo "<td>$employeeid11</td>";
       echo "<td>$name_last12, $name_first12 $name_middle12[0]</td>";
			echo "<td class = '$fontclr'>$remarksfin</td>";

      echo "<td>";
    
      echo "<div class = 'row'>";
 

    
      echo "<div class = 'col'>";

      echo "<a href=\"mngstduseredit.php?loginid=$loginid&stdlid=$loginid11&stduid=$username11\" class='px-3 py-2 rounded-3 border-0 bg-success text-white' role='button'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pencil-square\" viewBox=\"0 0 16 16\">
    <path d=\"M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z\"/>
    <path fill-rule=\"evenodd\" d=\"M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z\"/>
  </svg></a>";
    echo "</div>";

    echo "<div class = 'col'>";

  echo "<a href=\"mngstduserdel.php?loginid=$loginid&stdlid=$loginid11&stduid=$username11\" class='px-3 py-2 rounded-3 border-0 bg-danger text-white' role='button'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash3\" viewBox=\"0 0 16 16\">
        <path d=\"M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5\"/>
      </svg></a>";
      echo "</div>";

    echo "</div>";

      echo "</td>";

      echo "<td class = 'text-center'>";
  
      echo "<a href=\"mngstduserchgpass.php?loginid=$loginid&stdlid=$loginid11&stduid=$username11\" class='px-3 py-2 rounded-3 border-0 bg-warning ' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='#fff' class='bi bi-gear-wide' viewBox='0 0 16 16'>
      <path d='M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z'/></svg></a>";
    
      echo "</td>";

      echo "</tr>";

     
        //reset vars
        $remarksfin=""; $found16a=0; $disabled16a=""; $found16b=0; $disabled16b="";
			} // while
      echo "</tbody>";
		} // if
 
  } // if


  echo "</table>";
echo  "</div>";
  ?>
</div>

<div class="d-flex justify-content-end mt-5">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>

  <?php
// end contents here

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
