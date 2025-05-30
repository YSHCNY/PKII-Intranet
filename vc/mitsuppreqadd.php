<?php
//
// mitsuppreqadd.php
// fr: vc/index.php
// indexlinks: $page==341

require '../includes/config.inc';

$yyyymm = (isset($_POST['monsel'])) ? $_POST['monsel'] :'';

if($yyyymm=='') { $yyyymm="all"; }

if($yyyymm != "all") {
	$cutstart = $yyyymm."-"."01";
	$cutstartarr = split("-", $yyyymm);
	$cutyear = $cutstartarr[0];
	$cutmonth = $cutstartarr[1];
	// $cutstart = date("Y-m-01", strtotime($datenow));
} // if

?>
	<div class="">
		<div class="<?php echo $mainbg?> p-5">
	
		<p class="fw-bold <?php echo $maintext?> text-center mb-5">TECHNICAL SUPPORT FORM (ITD-F-03)</p>





<?php
	echo "<form method=\"POST\" action=\"mitsuppreq2.php?lst=1&lid=$loginid&sess=$session&p=34\" name=\"mitsuppreqadd2\">";
	echo "<input class = '' type=\"hidden\" name=\"requestorempid\" value=\"$employeeid0\">";
	echo "<input class = '' type=\"hidden\" name=\"deptcd\" value=\"$empdepartment0\">";
	echo "<input class = '' type=\"hidden\" name=\"ctgactor\" value=\"REQ\">";
?>

<input type="hidden" name="stamprequest" value="<?php echo $datenow; ?>">
	


<p class="hidden <?php echo $maintext?>">
<?php
	echo "$name_last0, $name_first0 $name_middle0[0]";
	if($empposition0!='') { echo "&nbsp;-&nbsp;$empposition0"; }
	if($empdepartment0!='') { echo "&nbsp;-&nbsp;$empdepartment0"; }
?>
	</p>
	
	

	<p class="text-start <?php echo $subtext?>  mt-4">Choose Request</p>
<div class="form-check <?php echo $mainbg ?> text-start border flex rounded p-5 ">

<div class = 'mx-5'>
	<?php
		include '../m/qrymitsuppreq3.php';
		// display result
		$param14=count($idctgsuppreq14Arr);
		for($z=0; $z<$param14; $z++) {
			$found14=1;
			$ctr14=$ctr14+1;
			echo "<input type=\"checkbox\" class =' $mainbg $subtext border border-2'  name=\"requestcd[]\" value=\"".$code14Arr[$z]."\">&nbsp;<span class = '$subtext'>".$name14Arr[$z]."</span><br>";
		} // for
?> </div></div>


	<div>
	<p class="text-start <?php echo $subtext?>  mt-4">Details</p>
	<textarea class = "form-control rounded <?php echo "$subtext $mainbg"?>" placeholder="Type details here..." name="details"></textarea>
	<p class="text-start <?php echo $subtext?>  mt-4">For approval</p>
	<select name="approver" class = 'form-control <?php echo "$subtext $mainbg"?> rounded'>
<?php
	$deptcd16=$empdepartment0;
	include '../m/qrymitsuppreq8b.php';
	if($approver1empid18b!='') {
	include '../m/qrymitsuppreq8c.php';
	echo "<option value=\"$approver1empid18b\">$name_last18c, $name_first18c $name_middle18c[0]";
	if($empposition18c!='') { echo "&nbsp;-&nbsp;$empposition18c"; }
	echo "&nbsp;-&nbsp;$empdepartment18c</option>";
	} // if
	if($approver2empid18b!='') {
	include '../m/qrymitsuppreq8d.php';
	echo "<option value=\"$approver2empid18b\">$name_last18d, $name_first18d $name_middle18d[0]";
	if($empposition18d!='') { echo "&nbsp;-&nbsp;$empposition18d"; }
	echo "&nbsp;-&nbsp;$empdepartment18d</option>";
	} // if
	if($approver3empid18b!='') {
	include '../m/qrymitsuppreq8n.php';
	echo "<option value=\"$approver3empid18b\">$name_last18n, $name_first18n $name_middle18n[0]";
	if($empposition18n!='') { echo "&nbsp;-&nbsp;$empposition18n"; }
	echo "&nbsp;-&nbsp;$empdepartment18n</option>";
	} // if
?>
	</select>
		
	<button type="submit" class = 'btn btn-primary text-white  rounded  my-4' value="submit">Submit request</button>

<?php
	echo "</form>";
?>

		</div>
	
		</div>


	</div>