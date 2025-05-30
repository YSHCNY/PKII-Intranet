<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idtblfinpaydeduct = (isset($_GET['fpdid'])) ? $_GET['fpdid'] :'';
$filesrc = (isset($_GET['fsrc'])) ? $_GET['fsrc'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$tab = (isset($_GET['tab'])) ? $_GET['tab'] :'';

if($tab!="") {
	if($tab=="l") { $tabinctyp="list"; }
	else if($tab=="a") { $tabinctyp="add"; }
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






// start contents here...

  if($accesslevel >= 4) {

	

	// insert deductions header
	


	// query tblfinpaydeduct
	$res11query = "SELECT tblfinpaydeduct.employeeid, tblfinpaydeduct.deductname, tblfinpaydeduct.deductamount, tblfinpaydeduct.deducttotal, tblfinpaydeduct.deductbalance, tblfinpaydeduct.datestart, tblfinpaydeduct.dateend, tblfinpaydeduct.status, tblfinpaydeduct.schedule, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblfinpaydeduct LEFT JOIN tblcontact ON tblfinpaydeduct.employeeid=tblcontact.employeeid WHERE tblfinpaydeduct.idtblfinpaydeduct=$idtblfinpaydeduct AND tblfinpaydeduct.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$employeeid = $myrow11['employeeid'];
		$deductname = $myrow11['deductname'];
		$deductamount = $myrow11['deductamount'];
		$deducttotal = $myrow11['deducttotal'];
		$deductbalance = $myrow11['deductbalance'];
		$datestart = $myrow11['datestart'];
		$dateend = $myrow11['dateend'];
		$status = $myrow11['status'];
		$schedule = $myrow11['schedule'];
		$name_last = $myrow11['name_last'];
		$name_first = $myrow11['name_first'];
		$name_middle = $myrow11['name_middle'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

	session_start();


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


  	echo "<div class = 'p-5 shadow '>
     <div class = 'mb-5'>
          <h4 class = 'mb-0'>Edit Income Deductions for <span class = 'fw-semibold'> $name_last, $name_first, $name_middle ($employeeid)</span></h4>
          <p class = 'text-secondary mt-0'>Edit Employees' Deduction per paygroup</p>
     </div>";


	if($employeeid != "") {
	
	


	// add income screen

	echo "<form action=\"finpaysysdededt2.php?loginid=$loginid&fpdid=$idtblfinpaydeduct\" method=\"post\" name=\"finpaysysdedadd\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"$tabinctyp\">";


	echo "<div class = ''>";
	echo "<label for = 'deductname'>Current Deduction Name : </label> <input name=\"deductname\" class = 'form-control'  placeholder = 'Title of deduction' value=\"$deductname\" required>";
	echo "</div>";

	echo "<div class = 'row my-5'>";

	echo "<div class = 'col-lg-4 col-12'><label for = 'deducttotal'>Current Total Deduction : </label> <input type=\"currency\" name=\"deducttotal\" class = 'form-control' placeholder ='0.00' value=\"$deducttotal\" required></div>";
	
	echo "<div class = 'col-lg-4 col-12'><label for = 'deductamount'>Current Amount For Deduction : </label><input type=\"currency\" name=\"deductamount\" class = 'form-control' placeholder ='0.00' value=\"$deductamount\" required></div>";

	echo "<div class = 'col-lg-4 col-12'><label for = 'deductbalance'>Current Balance : </label><input type=\"currency\" name=\"deductbalance\" class = 'form-control' placeholder ='0.00' value=\"$deductbalance\" required></div>";

	echo "</div>";

echo "<div class = 'row my-5'>";

	echo "<div class = 'col-lg-3 col-12'>";
	echo "<label for = 'datestart'>From : </label> <input type=\"date\" name=\"datestart\" class = 'form-control' value=\"$datestart\">";
	echo "</div>";

	echo "<div class = 'col-lg-3 col-12'>";
	echo "<label for = 'dateend'>To : </label><input type=\"date\" name=\"dateend\" class = 'form-control' value=\"$dateend\">";
	echo "</div>";



	if($schedule=="15th") { $schedsel15="selected"; $schedsel30=""; $schedselall=""; }
	else if($schedule=="30th") { $schedsel15=""; $schedsel30="selected"; $schedselall=""; }
	else if($schedule=="all") { $schedsel15=""; $schedsel30=""; $schedselall="selected"; }
	echo "<div class = 'col-lg-3 col-12'>";
	echo "<label for = 'schedule'>Current Schedule: </label><select name=\"schedule\" class = 'form-control'>";
	echo "<option value=\"all\" $schedselall>all</option>";
	echo "<option value=\"15th\" $schedsel15>15th only</option>";
	echo "<option value=\"30th\" $schedsel30>30th only</option>";
	echo "</select>";
	echo "</div>";


	if($status==1) { 
		$stat1sel="checked"; 

	}
	else if($status==0) { 
		$stat1sel=""; 
	}
	
	echo "<div class='col-lg-3 col-12 pt-5'>
	<label for='status'>Active Deduction</label>
	 <input type='checkbox' value = '' name='status' $stat1sel>

	</div>
	</div> ";

	
	echo "<input name = 'tab' type = 'hidden' value = '$tab'>";
	echo "<input name = 'idpg' type = 'hidden' value = '$idpaygroup'>";

	echo "<div class = 'text-end'>
	<a href=\"finpaysysded.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=$tab\" class = 'btn mx-3'>Done</a>";
	echo "<input type=\"submit\" class = 'btn bg-success text-white' value=\"Save Changes\"></div>";

	echo "</form>";


	} // if($employeeid!="")
	
	echo "</td></tr>";

  } // endif accesslevel >= 4

// end contents here...

     echo "</table>";

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
