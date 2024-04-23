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

<div class=" mt-5 p-5 mainbgc" >
			<h4 class = "ms-5 pt-5 text-white">Business Contact List</h4>
		
<div class="container ">
	<div class="flex p-5 bg-white rounded-5  shadow-lg">

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
	echo "<label for='disptyp' class='me-2 fw-normal'>Sort: </label>";
	echo "<select name=\"disptyp\" class = 'border-0 px-3 py-2 rounded-3'>";
	echo "<option value='all' $disptypallsel>All</option>";
	echo "<option value='project' $disptypprojsel>Projects</option>";
	echo "<option value='client' $disptypclientsel>Clients</option>";
	echo "<option value='associate' $disptypassocsel>Associate</option>";
	echo "<option value='supplier' $disptypsuppliersel>Suppliers</option>";
	echo "<option value='uncategorized' $disptypuncategsel>Uncategorized</option>";
	echo "</select>";
?>
	
	<button type="submit" class="border-0 secondarybgc text-white px-3 py-2 rounded-3" value="submit">Submit</button>
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

	$param11 = count($companyidArr);
	for($x11 = 0; $x11 < $param11; $x11++) {
		echo "<div class='col-md-6 mb-3'>";
		echo "<div class='card mb-3  rounded-3 border-1 h-100 p-5'>";
		echo "<h6 class = 'card-header bg-white border-0 text-muted'>Contact Detail</h6>";
		echo "<div class='card-body py-2'>";
		if($ofc_urlArr[$x11]!='') {
			echo "<h4 class='card-title text-uppercase maintext'><a href=\"http://".$ofc_urlArr[$x11]."\" target=\"_blank\" class=\"text-primary\">".$companyArr[$x11]."</a></h4>";
		} else {
			echo "<h4 class='card-title text-uppercase maintext '>".$companyArr[$x11]."</h4>";
		}
		echo "<h5 class='card-text text-secondary'>";
		echo "<address>";
		echo "".$ofc_address1Arr[$x11]."";
		if($ofc_address2Arr[$x11]!='') {
			echo ",&nbsp;".$ofc_address2Arr[$x11]."";
		}
		if($ofc_cityArr[$x11]!='') {
			echo ",&nbsp;".$ofc_cityArr[$x11]."";
		}
		if($ofc_provinceArr[$x11]!='') {
			echo ",&nbsp;".$ofc_provinceArr[$x11]."";
		}
		if($ofc_zipcodeArr[$x11]!='') {
			echo "&nbsp;".$ofc_zipcodeArr[$x11]."";
		}
		if($ofc_countryArr[$x11]!='') {
			echo "&nbsp;".$ofc_countryArr[$x11]."";
		}
		echo "</address>";
		echo "<br>";
		if($ofc_num1Arr[$x11]!='') {
			echo "Landline: &nbsp;";
			if($ofc_num1_ccArrArr[$x11]!='') { echo "+".$ofc_num1_ccArr[$x11]."&nbsp;"; }
			if($ofc_num1_acArr[$x11]!='') { echo "".$ofc_num1_acArr[$x11]."&nbsp;"; }
			echo "".$ofc_num1Arr[$x11]."";
			if($ofc_num1_extArr[$x11]!='') { echo "&nbsp;Ext.&nbsp;".$ofc_num1_extArr[$x11].""; }
			echo "<br>";
		}
		if($ofc_faxArr[$x11]!='') {
			echo "Fax: &nbsp;";
			if($ofc_fax_ccArr[$x11]!='') { echo "+".$ofc_fax_ccArr[$x11]."&nbsp;"; }
			if($ofc_fax_acArr[$x11]!='') { echo "$ofc_fax_acArr&nbsp;"; }
			echo "".$ofc_faxArr[$x11]."";
			echo "<br>";
		}
		if($ofc_mobileArr[$x11]!='') {
			echo "Mobile: &nbsp;";
			if($ofc_mobile_ccArr[$x11]!='') { echo "+".$ofc_mobile_ccArr[$x11].""; }
			if($ofc_mobile_acArr[$x11]!='') { echo "".$ofc_mobile_acArr[$x11]."&nbsp;"; }
			echo "".$ofc_mobileArr[$x11]."";
			echo "<br>";
		}
		echo "<a href='mailto:".$ofc_emailArr[$x11]."' class=\"text-primary\">".$ofc_emailArr[$x11]."</a>";
		echo "<br>";
		if($ofc_urlArr[$x11]!='') {
			echo "<a href=\"http://".$ofc_urlArr[$x11]."\" target=\"_blank\" class=\"text-primary\">".$ofc_urlArr[$x11]."</a>";
		}
		echo "</h5>";
		if($disptyp=='project') {
			$projcode=$proj_codeArr[$x11];
			include '../m/qryproj2.php';
			echo "<p class='card-text'>Project: $proj_sname11</p>";
		}
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}
	$dbh->close();
?>


</div>
</div>
