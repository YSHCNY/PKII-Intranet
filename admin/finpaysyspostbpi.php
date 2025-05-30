<?php
//
// finpaysyspostbpi.php on 20250115
// fr: finpaysyspost.php

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

// $idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
// $idcutoff0 = (isset($_GET['idct'])) ? $_GET['idct'] :'';
// $disptyp0 = (isset($_GET['dtyp'])) ? $_GET['dtyp'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($idcutoff0 != "") { $idcutoff=$idcutoff0; }
if($disptyp0 != "") { $disptyp=$disptyp0; }

if($idpaygroup==0) { $legacycutstart = $_POST['idcutoff']; $legacycutstart=$idcutoff; }

$payrollDate = (isset($_POST['payrollDate'])) ? $_POST['payrollDate'] :'';
$payrollDatefin = date('Y-m-d', strtotime($payrollDate));

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
  

// edit body-header

?>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
<?php
// start contents here...


  if($accesslevel >= 3) {
		echo "<form action=\"finpaysyspost.php?loginid=$loginid&pg=bpi&act=3\" method=\"post\" name=\"finpaysyspostbpi\" >";

		// pay group name dropdown
    echo "<div class = 'row p-4 border shadow'>
	
	<h4 class = 'm-4'>BPI BizLink Payroll Format";
	// echo "|$idpaygroup|$idcutoff|$idpaygrplegacysel|$idpaygrpsel|$idcutoffsel|$payrollDate|$payollDatefin";
	echo "</h4>";
	// echo "<p>Process whole payroll base on time and attendance</p>";
	
	echo "<div class='col-lg-4 col-12 my-2'>";
	echo "<select name=\"idpaygroup\" id='choices-select' onchange=\"this.form.submit()\">";
	// echo "<select name=\"idpaygroup\" id='choices-select'>";
		/* if($idpaygroup == "") {
			$idpaygrplegacysel=""; $idpaygrpsel="";
		echo "<option value=''>select paygroup</option>";
		} else if($idpaygroup==0) { 
		    $idpaygrplegacysel="selected"; $idpaygrpsel=""; 
		} //if-else if($idpaygroup==0)
		echo "<option value='0' $idpaygrplegacysel>legacy_cutoffs</option>"; */
		$res11query=""; $result11=""; $found11=0; $ctr11=0;
		$res11query="SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11['idtblhrtapaygrp'];
			$paygroupname11 = $myrow11['paygroupname'];
			if($idtblhrtapaygrp11 == $idpaygroup) { $idpaygrpsel="selected"; $idpaygrplegacysel=""; } else { $idpaygrpsel=""; $idpaygrplegacysel=""; }
			echo "<option value=\"$idtblhrtapaygrp11\" $idpaygrpsel>$paygroupname11</option>";
			}
		}
		echo "</select></div>";

		// cut-off period dropdown
		echo "<div class='col-lg-4 col-12 my-2'><select name=\"idcutoff\" id='choices-select2' onchange=\"this.form.submit()\">";
		// echo "<div class='col-lg-4 col-12 my-2'><select name=\"idcutoff\" id='choices-select2'>";
		if($idpaygroup>0) {

			// display payrollv2 cutoffs
		if($idcutoff == "") {
		echo "<option value=''>select cutoff</option>";
		}
		$res15query="SELECT DISTINCT fk_idhrtacutoff, cut_start, cut_end FROM tblemppayroll WHERE fk_idhrtapaygrp=$idpaygroup ORDER BY cut_start DESC";
		$result15=""; $found15=0; $ctr15=0;
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15 = $result15->fetch_assoc()) {
			$found15 = 1; $ctr15++;
			// $emppayrollid15 = $myrow15['idhrtacutoff'];
			$fk_idhrtacutoff15 = $myrow15['fk_idhrtacutoff'];
			$cut_start15 = $myrow15['cut_start'];
			$cut_end15 = $myrow15['cut_end'];
			if($fk_idhrtacutoff15 == $idcutoff) { $idcutoffsel="selected"; } else { $idcutoffsel=""; }
			echo "<option value=\"$fk_idhrtacutoff15\" $idcutoffsel>" . date('F d, Y', strtotime($cut_start15)) . " - " . date('F d, Y', strtotime($cut_end15)) . "</option>";

			}
		}
			
		} /* elseif($idpaygroup==0) { // if($idcutoff!=0)
		
			// display legacy or manual cutoff periods			
		$res15query=""; $result15=""; $found15=0; $ctr15=0;
		$res15query="SELECT DISTINCT cut_start, cut_end FROM tblemppayroll WHERE fk_idhrtapaygrp=0 AND fk_idhrtacutoff=0 ORDER BY cut_start DESC";
        $result15=$dbh2->query($res15query);
        if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15=1; $ctr15++;
			$cut_start15 = $myrow15['cut_start'];
			$cut_end15 = $myrow15['cut_end'];
			if($cut_start15 == $legacycutstart) { $legacycutstartsel="selected"; $idcutoffsel=""; } else { $legacycutstartsel=""; $idcustoffsel=""; }
			echo "<option value=\"$cut_start15\" $legacycutstartsel>" . date('Y-m-d', strtotime($cut_start15)) . " - " . date('Y-m-d', strtotime($cut_end15)) . "</option>";
			
			} //while
        } //if
		
		} //if-else if($idcutoff!=0) */
		echo "</select></div>";

		// display type
		// echo "<div class='col-lg-4 col-12 my-2'><select name=\"disptyp\" id='choices-select3' onchange=\"this.form.submit()\">";
		// if($disptyp == "") { echo "<option value=''>display type</option>"; }
		// else if($disptyp == "summary") { $disptypsummsel="selected"; $disptypdtldsel=""; }
		// else if($disptyp == "detailed") { $disptypsummsel=""; $disptypdtldsel="selected"; }
		// echo "<option value=\"summary\" $disptypsummsel>summary</option>";
		// echo "<option value=\"detailed\" $disptypdtldsel>detailed</option>";
		// echo "</select></div>";

    if($idpaygroup!="" && $idcutoff!="") {
		if($payrollDate!="") {
		// echo "<div class='col-lg-4 col-12 my-2'><input type=\"date\" name=\"payrollDate\" value=\"$payrollDatefin\" id='choices-select3' onchange=\"this.form.submit()\" placeholder=\"Input payroll date\">";
		echo "<div class='col-lg-4 col-12 my-2'><input type=\"date\" class='form-control' name=\"payrollDate\" value=\"$payrollDate\" id='choices-select3' placeholder=\"Input payroll date\">";
			
		} else {
		// echo "<div class='col-lg-4 col-12 my-2'><input type=\"text\" name=\"payrollDate\" value=\"\" id='choices-select3' onchange=\"this.form.submit()\" placeholder=\"Input payroll date\">";
		echo "<div class='col-lg-4 col-12 my-2'><input type=\"date\" class='form-control' name=\"payrollDate\" value=\"$datenow\" id='choices-select3' placeholder=\"Input payroll date\">";
		
		} //if-else
        echo "</div>";
	echo "<p>$idpaygroup|$idcutoff|$payrollDate</p>";
	} //if

		// submit button
		echo "<div class=' text-end mt-4'>";
		echo "<button type=\"submit\" class='btn btn-primary'>Submit</button>";
    echo "</div>";

		echo "</div></form>";
	echo "";
  } // endif accesslevel >= 4

  echo "";

	if($idpaygroup != "" && $idcutoff != "" && $payrollDate !="") {
		
		// query cut_start
		$res21query=""; $result21=""; $found21=0;
		$res21query="SELECT DISTINCT cut_start FROM tblemppayroll WHERE fk_idhrtapaygrp=$idpaygroup AND fk_idhrtacutoff=$idcutoff LIMIT 1";
		$result21=$dbh2->query($res21query);
		if($result21->num_rows>0) {
		while($myrow21=$result21->fetch_assoc()) {
			$found21=1;
			$cut_start21 = $myrow21['cut_start'];

		} //while			
		} //if
		
	echo "";
	//
	// display payroll summary on BPI Bizlink format based on selected paygroup and cutoff
	include("finpaysyspostbpi2.php");
	} // if($idpaygroup != "" && $idcutoff != "")
    echo "";

// end contents here...

     // echo "</table>";

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
      });

	  
    });


	document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('choices-select2');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
      });

	  
    });


/*	document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('choices-select3');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
      });

	  
    });
*/
  </script>


<style>
	.stickythis{
		position: sticky !important;
		bottom: 20 !important;
	}
</style>
		<?php
    
} else {
     include("logindeny.php");
}

$dbh2->close();
?>