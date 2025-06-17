<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup0 = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff0 = (isset($_GET['idct'])) ? $_GET['idct'] :'';
$disptyp0 = (isset($_GET['dtyp'])) ? $_GET['dtyp'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';
$employeeid = (isset($_POST['empid'])) ? $_POST['empid'] :'';

if($idpaygroup0 != "") { $idpaygroup=$idpaygroup0; }
if($idcutoff0 != "") { $idcutoff=$idcutoff0; }
if($disptyp0 != "") { $disptyp=$disptyp0; }

// echo "<p>vartest idpg:$idpaygroup, idct:$idcutoff, dtyp:$disptyp</p>";

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebarforTAL.php");
	 echo "<div class = 'mb-3'>";
	 include 'timeattmenu.php';
 echo "</div>";

// edit body-header


?>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
<div class="container">
	<?php

?>
<div class="shadow p-4 rounded mb-5">
	
<?php

	echo "<div class = 'mb-5 mt-3 mx-3'>";
	echo "<h5 class = 'fw-bold mb-0 pb-0'>Timelog Summary</h5>";
	echo "<p class = 'text-secondary'>View both detailed and summary of timelogs per cutoff period</p>";
	echo "</div>";

  if($accesslevel >= 3) {

		echo "<form action=\"hrtimeattsumm.php?loginid=$loginid\" method=\"post\" name=\"modhrtasummary\">";

		// pay group name dropdown

		echo "<div class = 'row row-cols-1 row-cols-sm-2  row-cols-md-3 mx-5 g-4'>";
		echo "<div class = 'col'>";
    echo "<select name=\"idpaygroup\" id = 'Newchoice' onchange=\"this.form.submit()\">";
		if($idpaygroup == "") {
		echo "<option value=''>select paygroup</option>";
		}
		$res11query="SELECT idtblhrtapaygrp, paygroupname FROM tblhrtapaygrp ORDER BY timestamp DESC";
		$result11=""; $found11=0; $ctr11=0;
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
		echo "</select>";
		echo "</div>";




		// cut-off period dropdown
		echo "<div class = 'col'>";

		echo "<select name=\"idcutoff\" id = 'Newchoice2' onchange=\"this.form.submit()\">";
		if($idcutoff == "") {
		echo "<option value=''>select cutoff</option>";
		}
		$res15query="SELECT idhrtacutoff, cutstart, cutend, paygroupname, remarks FROM tblhrtacutoff WHERE idhrtapaygrp=$idpaygroup ORDER BY cutstart DESC";
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
					echo "<option value=\"$idhrtacutoff15\" $idcutoffsel>".date('m-d-Y', strtotime($cutstart15))." to ".date('m-d-Y', strtotime($cutend15))."</option>";
					}
				}
				echo "</select>";
		echo "</div>";


		// display type
		echo "<div class = 'col'>";
				
				echo "<select name=\"disptyp\" id = 'Newchoice3' onchange=\"this.form.submit()\">";
				if($disptyp == "") { echo "<option value=''>display type</option>"; }
				else if($disptyp == "summary") { $disptypsummsel="selected"; $disptypdtldsel=""; }
				else if($disptyp == "detailed") { $disptypsummsel=""; $disptypdtldsel="selected"; }
				echo "<option value=\"summary\" $disptypsummsel>summary</option>";
				echo "<option value=\"detailed\" $disptypdtldsel>detailed</option>";
				echo "</select>";
		echo "</div>";

	

		// submit button
		echo "</div>";

		// echo "<input type=\"submit\">";
		echo "<div class = 'text-end mt-3 mx-5 px-2'>";

		echo "<button type=\"submit\" class=\"btn btn-primary \">Submit</button>";
		echo "</div>";


		echo "</form>";

  } // endif accesslevel >= 4
?>
</div>
</div>

<?php


	//
	// display individual info based on selected dropdown personnel
	//
	if($idpaygroup != "" && $idcutoff != "") {

		if ($disptyp == "detailed"){
			?>
<button class = 'floatmenot h1 shadow-lg'  onclick="printTable()"><i class="bi bi-printer-fill"></i></button>

			<?php
		}
	//
	// disp detailed or summary list
	//
	
	include("hrtimeattsumm2.php");
	
	//
	} // if($idpaygroup != "" && $idcutoff != "")



// end contents here...


?>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('Newchoice');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
		shouldSort: false,
		shouldSortItems: false,
      });
    });

	document.addEventListener('DOMContentLoaded', () => {
  const selectElement = document.getElementById('Newchoice2');
  const choices = new Choices(selectElement, {
    removeItemButton: true,
    searchEnabled: true,
    shouldSort: false,
    shouldSortItems: false,
 
  });
});

	document.addEventListener('DOMContentLoaded', () => {
      const selectElement = document.getElementById('Newchoice3');
      const choices = new Choices(selectElement, {
        removeItemButton: true, // Enable remove button for selected items
        searchEnabled: true,    // Allow searching
      });
    });
  </script>
<?php
// edit body-footer
echo "<div class = 'container'>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid"; 
		$result = $dbh2->query($resquery);

		echo "</div>";
     include ("footer.php");

} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
