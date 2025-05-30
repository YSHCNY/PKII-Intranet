<?php
//
// vbizcontact.php
// fr: vc/index.php
//page 23

// get variables
$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';

if($page=='') { $page=23; }
?>

<div class=" p-5 <?php echo $hero?>" >
		<div class="text-center"><h3 class = 'mb-5 mt-2 py-5 fw-bold text-uppercase text-white'>business contact list</h3></div>
		
<div class="container ">
	<div class="flex p-5 <?php echo $mainbg ?> rounded  shadow">

	<div class="mx-auto text-center justify-content-center-align-items-center">
<?php
	echo "<form action=\"index.php?lst=$lst&lid=$loginid&sess=$session&p=$page\" method=\"POST\" name=\"vpersonnel\">";
?>

<?php
	if($disptyp=='' || $disptyp=='all') {
		$disptypallsel="selected"; $disptypprojsel=""; $disptypclientsel=""; $disptypassocsel=""; $disptypsuppliersel=""; $disptypuncategsel="";
	} else if($disptyp=='project') {
		$disptypallsel=""; $disptypprojsel="selected"; $disptypclientsel=""; $disptypassocsel=""; $disptypsuppliersel=""; $disptypuncategsel="";
	} else if($disptyp=='client') {
		$disptypallsel=""; $disptypprojsel=""; $disptypclientsel="selected"; $disptypassocsel=""; $disptypsuppliersel=""; $disptypuncategsel="";
	} else if($disptyp=='associate') {
		$disptypallsel=""; $disptypprojsel=""; $disptypclientsel=""; $disptypassocsel="selected"; $disptypsuppliersel=""; $disptypuncategsel="";
	} else if($disptyp=='supplier') {
		$disptypallsel=""; $disptypprojsel=""; $disptypclientsel=""; $disptypassocsel=""; $disptypsuppliersel="selected"; $disptypuncategsel="";
	} else if($disptyp=='uncategorized') {
		$disptypallsel=""; $disptypprojsel=""; $disptypclientsel=""; $disptypassocsel=""; $disptypsuppliersel=""; $disptypuncategsel="selected";
	} // if
	echo "<label for='disptyp' class='me-2 fw-normal $subtext'>Sort: </label>";
	echo "<select name=\"disptyp\" class = 'border-0 px-3 py-2 rounded'>";
	echo "<option value='all' $disptypallsel>All</option>";
	echo "<option value='project' $disptypprojsel>Projects</option>";
	echo "<option value='client' $disptypclientsel>Clients</option>";
	echo "<option value='associate' $disptypassocsel>Associate</option>";
	echo "<option value='supplier' $disptypsuppliersel>Suppliers</option>";
	echo "<option value='uncategorized' $disptypuncategsel>Uncategorized</option>";
	echo "</select>";
?>
	
	<button type="submit" class="btn btn-primary mb-1 rounded" value="submit">Submit</button>
	</div>
<?php
	echo "</form>";
?>
</div>
</div>
</div>



<div class="container my-5">
	<div class="row">
	
<?php
	//if($disptyp=='project') { echo "<th>Project</th>"; }
?>
                         

<?php 
	include '../m/qrybizcontact.php';

	echo "<table class='table $tableinfo table-bordered table-striped table-hover'>";
	echo "<thead class = ''>";
	echo "<tr>
			<th>Company</th>
			<th>Address</th>
			<th>Landline</th>
			<th>Fax</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Website</th>
			<th>Project</th>
		  </tr>";
	echo "</thead>";
	echo "<tbody>";
	
	$param11 = count($companyidArr);
	for($x11 = 0; $x11 < $param11; $x11++) {
		echo "<tr>";
	
		// Company Name
		echo "<td>";
		if($ofc_urlArr[$x11] != '') {
			echo "<a href='http://".$ofc_urlArr[$x11]."' target='_blank' class='text-primary'>".$companyArr[$x11]."</a>";
		} else {
			echo $companyArr[$x11];
		}
		echo "</td>";
	
		// Address
		echo "<td>";
		echo $ofc_address1Arr[$x11];
		if($ofc_address2Arr[$x11] != '') { echo ", ".$ofc_address2Arr[$x11]; }
		if($ofc_cityArr[$x11] != '') { echo ", ".$ofc_cityArr[$x11]; }
		if($ofc_provinceArr[$x11] != '') { echo ", ".$ofc_provinceArr[$x11]; }
		if($ofc_zipcodeArr[$x11] != '') { echo " ".$ofc_zipcodeArr[$x11]; }
		if($ofc_countryArr[$x11] != '') { echo " ".$ofc_countryArr[$x11]; }
		echo "</td>";
	
		// Landline
		echo "<td>";
		if($ofc_num1Arr[$x11] != '') {
			if($ofc_num1_ccArr[$x11] != '') { echo "+".$ofc_num1_ccArr[$x11]." "; }
			if($ofc_num1_acArr[$x11] != '') { echo $ofc_num1_acArr[$x11]." "; }
			echo $ofc_num1Arr[$x11];
			if($ofc_num1_extArr[$x11] != '') { echo " Ext. ".$ofc_num1_extArr[$x11]; }
		}
		echo "</td>";
	
		// Fax
		echo "<td>";
		if($ofc_faxArr[$x11] != '') {
			if($ofc_fax_ccArr[$x11] != '') { echo "+".$ofc_fax_ccArr[$x11]." "; }
			if($ofc_fax_acArr[$x11] != '') { echo $ofc_fax_acArr[$x11]." "; }
			echo $ofc_faxArr[$x11];
		}
		echo "</td>";
	
		// Mobile
		echo "<td>";
		if($ofc_mobileArr[$x11] != '') {
			if($ofc_mobile_ccArr[$x11] != '') { echo "+".$ofc_mobile_ccArr[$x11]." "; }
			if($ofc_mobile_acArr[$x11] != '') { echo $ofc_mobile_acArr[$x11]." "; }
			echo $ofc_mobileArr[$x11];
		}
		echo "</td>";
	
		// Email
		echo "<td>";
		if($ofc_emailArr[$x11] != '') {
			echo "<a href='mailto:".$ofc_emailArr[$x11]."' class='text-primary'>".$ofc_emailArr[$x11]."</a>";
		}
		echo "</td>";
	
		// Website
		echo "<td>";
		if($ofc_urlArr[$x11] != '') {
			echo "<a href='http://".$ofc_urlArr[$x11]."' target='_blank' class='text-primary'>".$ofc_urlArr[$x11]."</a>";
		}
		echo "</td>";
	
		// Project
		echo "<td>";
		if($disptyp == 'project') {
			$projcode = $proj_codeArr[$x11];
			include '../m/qryproj2.php';
			echo "Project: $proj_sname11";
		}
		echo "</td>";
	
		echo "</tr>";
	}
	
	echo "</tbody>";
	echo "</table>";
	
	$dbh->close();
?>


</div>
</div>
