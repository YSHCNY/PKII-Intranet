<?php
//
// vpersonnel.php
// fr: vc/index.php
//page 22

// get variables
$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';

if($page=='') { $page=22; }
?>

		<div class=" mt-5 p-5 mainbgc" >
			<h4 class = "ms-5 pt-5 text-white">PKII Active Personnels List</h4>
		
<div class="container">
	<div class="flex p-5 bg-white rounded-5 shadow-lg">
<?php
	echo "<form action=\"index.php?lst=$lst&lid=$loginid&sess=$session&p=$page\" class =\"mx-auto\" method=\"POST\" name=\"vpersonnel\">";
?>
	<div class="mx-auto text-center justify-content-center-align-items-center">
<?php
	if($disptyp=='' || $disptyp=='all') {
		$disptypallsel="selected"; $disptypempsel=""; $disptypconsel="";
	} else if($disptyp=='employee') {
		$disptypallsel=""; $disptypempsel="selected"; $disptypconsel="";
	} else if($disptyp=='consultant') {
		$disptypallsel=""; $disptypempsel=""; $disptypconsel="selected";
	} // if
	echo "<label for='disptyp' class='me-2 fw-normal'>Sort: </label>";
	echo "<select name = 'disptyp' class =\" rounded-3 border-0 px-3 py-2 align-items-center\" name=\"disptyp\">";
	echo "<option value='all' $disptypallsel>All</option>";
	echo "<option value='employee' $disptypempsel>Employees</option>";
	echo "<option value='consultant' $disptypconsel>Consultants</option>";
	echo "</select>";
?>
	
	<button type="submit" class="secondarybgc border-0 rounded-4 px-3 py-2 text-white text-center" value="submit">Submit</button>
	</div>

<?php
	echo "</form>";
?>
</div>
</div>

</div>


<div class="container">
<div class = 'mt-5 text-center'>
	<p class = 'fw-bold fs-4 maintext mb-0'>Our Active Personnel</p>
	<p class = 'submaintext fs-5'>List of our Active Personnel <span class = 'fst-italic text-primary fs-6'>(Click cards to email)</span> </p>
</div>
<div class="row">
    <?php 
    include '../m/qrypersonnel.php';
    $param11 = count($employeeidArr);
    for($x11 = 0; $x11 < $param11; $x11++) {
        echo "<div class='col-md-6 col-lg-4 col-12 my-4'>";

        echo "<a href='mailto:".$email1Arr[$x11]."' > 
		<div class='card rounded-5 viewss h-100 shadow-lg my-5 p-5' >";
        echo "<img src='$pathavatar/".$picfnArr[$x11]."' class='mx-auto card-img-top border rounded-circle' style='width: 120px; height: 120px;'>";
        echo "<div class='card-body text-center '>";
		
        echo "
		<div class = 'mt-5'>
		<p class='card-title  fw-bold fs-4 mb-0'> ".$name_lastArr[$x11].", ".$name_firstArr[$x11]." ".substr($name_middleArr[$x11], 0, 1)."</p>";
		
        echo "<p class='card-text  fs-5 mb-0'>".$email1Arr[$x11]."</p>";
		echo "
		</div>";


        echo "</div>";
        echo "</div> </a>";

        echo "</div>";
    }
    $dbh->close();
    ?> 
</div>

</div>







<?php 

$dbh->close();
?> 

