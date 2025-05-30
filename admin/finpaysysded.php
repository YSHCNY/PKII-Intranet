<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$employeeid0 = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$tab0 = (isset($_GET['tab'])) ? $_GET['tab'] :'';


$geturl = (isset($_GET['frm'])) ? $_GET['frm'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($employeeid0 != "") { $employeeid=$employeeid0; }
if($tab0!="") {
	if($tab0=="l") { $tabinctyp="list"; }
	else if($tab0=="a") { $tabinctyp="add"; }
}

// echo "<p>vartest idpg:$idpaygroup, empid:$employeeid</p>";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");
?>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
// edit body-header

echo "<div class = 'mb-3'>";
if ($geturl == 'talm'){
    include 'timeattmenu.php';

} else {
     echo "<a href=\"finpaysys.php?loginid=$loginid\" class = 'mainbtnclr px-3 py-2 rounded-3 text-white btn'>Back</a>";

}
echo "</div>";
// start contents here...

  if($accesslevel >= 4) {

	

	// insert deductions header
	// include("finpaysysdedhdr.php");

     

	echo "<div class = 'px-5 pt-4 shadow'>
     <div class = 'mb-4'>
          <h5 class = 'mb-0 fw-bold'>Income Deductions</h5>
          <p class = 'text-secondary mt-0'>Manage Employees' Deduction per paygroup</p>
     </div>
     ";
	


	// echo "<div class=\"col border-bottom\">";
	// echo "<form action=\"finpaysysdedl.php?loginid=$loginid\" method=\"post\" name=\"finpaysysdedl\">";
	// echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"list\">";
	// echo "<input type=\"submit\" class = 'bg-transparent rounded-0 btn  border border-bottom-0 py-3  w-100' value=\"List\" $tabinctypsellist>";
	// echo "</form>";
	// echo "</div>";
	session_start();


if (isset($_SESSION['delete'])) {
		echo '<div id="deleted" class="alert alert-warning" role="alert">'
			. $_SESSION['delete'] .
			'</div>';

		// Clear the alert after displaying it
		unset($_SESSION['delete']);
	}
	?>
  <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleted = document.getElementById('deleted');
            if (deleted) {
                setTimeout(() => {
                    deleted.classList.remove('show');
                    deleted.classList.add('fade');
                    deleted.classList.add('d-none');

                }, 3000); // 3 seconds
            }
        });
    </script>


<?php

	// Display the alert if it exists in the session
	if (isset($_SESSION['success'])) {
		echo '<div id="alert" class="alert alert-success" role="alert">'
			. $_SESSION['success'] .
			'</div>';

		// Clear the alert after displaying it
		unset($_SESSION['success']);
	}
	?>
  <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alert = document.getElementById('alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    alert.classList.add('d-none');

                }, 3000); // 3 seconds
            }
        });
    </script>



<?php
if (isset($_SESSION['error'])) {
		echo '<div id="error" class="alert alert-danger" role="alert">'
			. $_SESSION['error'] .
			'</div>';

		// Clear the alert after displaying it
		unset($_SESSION['error']);
	}
	?>
  <script>
        document.addEventListener("DOMContentLoaded", function () {
            const error = document.getElementById('error');
            if (error) {
                setTimeout(() => {
                    error.classList.remove('show');
                    error.classList.add('fade');
                    error.classList.add('d-none');

                }, 3000); // 3 seconds
            }
        });
    </script>

	<?php
	include "finpaysysdeda.php";

  } // endif accesslevel >= 4

	//
	// display individual info based on selected dropdown personnel
	//
	$filesrc = "finpaysysded";
	// include("finpaysysded2.php");

// end contents here...



// edit body-footer

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
