<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff0 = (isset($_GET['idct'])) ? $_GET['idct'] :'';
$disptyp0 = (isset($_GET['dtyp'])) ? $_GET['dtyp'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($idcutoff0 != "") { $idcutoff=$idcutoff0; }
if($disptyp0 != "") { $disptyp=$disptyp0; }

// echo "<p>vartest idpg:$idpaygroup, idct:$idcutoff, dtyp:$disptyp</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header

?>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
<?php
// start contents here...


  if($accesslevel >= 3) {
		echo "<form action=\"finpaysystasumm.php?loginid=$loginid\" method=\"post\" name=\"finpaysystasumm\" >";
		echo "<div class = 'mb-3'><a href=\"finpaysys.php?loginid=$loginid\" class='btn mainbtnclr text-white' >Back</a></div>";

		// pay group name dropdown
    echo "<div class = 'row p-4 border shadow'>
	<div class = 'mb-4'>
	<h4 class = 'mb-0 pb-0 mt-4'>Process Payroll</h4>";
	echo "<p>Process whole payroll base on time and attendance.</p></div>";
	
	echo "<div class='col-lg-4 col-12 my-2'><select name=\"idpaygroup\" id='choices-select' onchange=\"this.form.submit()\">";
		if($idpaygroup == "") {
		echo "<option value=''>select paygroup</option>";
		}
		$res11query="SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
		/*
		$result11 = mysql_query("", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
		*/
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
			$paygroupname11 = $myrow11['paygroupname'];
			if($idtblhrtapaygrp11 == $idpaygroup) { $idpaygrpsel="selected"; } else { $idpaygrpsel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idpaygrpsel>$paygroupname11</option>";
			}
		}
		echo "</select></div>";

		// cut-off period dropdown
		echo "<div class='col-lg-4 col-12 my-2'><select name=\"idcutoff\" id='choices-select2' onchange=\"this.form.submit()\">";
		if($idcutoff == "") {
		echo "<option value=''>select cutoff</option>";
		}
		$res15query="SELECT idhrtacutoff, cutstart, cutend, paygroupname, remarks FROM tblhrtacutoff WHERE idhrtapaygrp=$idpaygroup ORDER BY cutstart ASC";
		$result15=""; $found15=0; $ctr15=0;
		/*
		$result15 = mysql_query("", $dbh);
		if($result15 != "") {
			while($myrow15 = mysql_fetch_row($result15)) {
		*/
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15 = $result15->fetch_assoc()) {
			$found15 = 1;
			$idhrtacutoff15 = $myrow15['idhrtacutoff'];
			$cutstart15 = $myrow15['cutstart'];
			$cutend15 = $myrow15['cutend'];
			$paygroupname15 = $myrow15['paygroupname'];
			$remarks15 = $myrow15['remarks'];
			$ctr15 = $ctr15 + 1;
			if($idhrtacutoff15 == $idcutoff) { $idcutoffsel="selected"; } else { $idcutoffsel=""; }
			echo "<option value=\"$idhrtacutoff15\" $idcutoffsel>" . date('F d, Y', strtotime($cutstart15)) . " - " . date('F d, Y', strtotime($cutend15)) . "</option>";

			}
		}
		echo "</select></div>";

		// display type
		echo "<div class='col-lg-4 col-12 my-2'><select name=\"disptyp\" id='choices-select3' onchange=\"this.form.submit()\">";
		if($disptyp == "") { echo "<option value=''>display type</option>"; }
		else if($disptyp == "summary") { $disptypsummsel="selected"; $disptypdtldsel=""; }
		else if($disptyp == "detailed") { $disptypsummsel=""; $disptypdtldsel="selected"; }
		echo "<option value=\"summary\" $disptypsummsel>summary</option>";
		echo "<option value=\"detailed\" $disptypdtldsel>detailed</option>";
		echo "</select></div>";

		// submit button
		echo "<div class=' text-end mt-4'>";
		echo "<button type=\"submit\" class='btn btn-primary'>Submit</button>";
    echo "</div>";

		echo "</div></form>";
	echo "";
  } // endif accesslevel >= 4

  echo "";

if ($idpaygroup != "" && $idcutoff != "") {

    // Display individual info based on selected dropdown personnel
    include("hrtimeattsumm2.php");

    $res12query = "SELECT idemppaycutoff FROM tblemppaycutoff WHERE idhrtapaygrp=$idpaygroup AND idhrtacutoff=$idcutoff";
    $result12 = $dbh2->query($res12query);

    $found12 = 0; // Default to no record found
    if ($result12->num_rows > 0) {
        while ($myrow12 = $result12->fetch_assoc()) {
            $found12 = 1; // Set inside the loop if records exist
            $idemppaycutoff12 = $myrow12['idemppaycutoff'];
        }
    }

    // Ensure correct button logic
    if ($found12 == 0) {
        $DIS = '';
        $btntext = 'Process Payroll';
        $btnclass = 'btn-success';
    } else {
        $DIS = 'disabled';
        $btntext = 'Payroll Already Processed';
        $btnclass = 'btn-secondary';
    }

    // Debugging output to check values
    // echo "<!-- DEBUG: found12 = $found12, DIS = $DIS, btnclass = $btnclass, btntext = $btntext -->";

    // Ensure form always prints
    echo "<form method='POST' action='payrollProcess.php?loginid=$loginid' class='stickythis shadow bg-white border text-end rounded-3 p-4' name='processPayrollForm'>";
    echo "<input type='hidden' name='idpaygroup' value='" . htmlspecialchars($idpaygroup) . "' />";
    echo "<input type='hidden' name='idcutoff' value='" . htmlspecialchars($idcutoff) . "' />";
    echo "<button class='btn $btnclass' $DIS>$btntext</button>";
    echo "</form>";
}

    echo "";

   
	


		// Process Payroll|$found12|$idpaygroup|$idcutoff
// echo var_dump($res12query);

// end contents here...

     echo "</table>";

// edit body-footer


     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid"; 
		$result = $dbh2->query($resquery);

		?>
 <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('choices-select');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
		shouldSort: false,
      });

	  
    });


	document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('choices-select2');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
		shouldSort: false,
      });

	  
    });


	document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('choices-select3');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
		shouldSort: false,
      });

	  
    });
  </script>


<style>
	.stickythis{
		position: sticky !important;
		bottom: 20 !important;
	}
</style>
		<?php
     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
